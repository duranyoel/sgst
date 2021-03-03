<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ArticlesController
 * @author yoelduran
 */
class ArticlesController extends AppController {

    public function ajax_search() {

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        if ($this->Session->read('role') == 'superuser') {
            $query = [
                'fields' => [
                    'Article.*'
                ],
                'recursive' => 3,
                'conditions' => [],
                'order' => [],
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => intval($this->request->query('start')), // start tiene la página
                'limit' => intval($this->request->query('length')), // length la cantidad de registros
            ];
        } else if ($this->Session->read('role') == 'admin') {
            $query = $this->Article->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('Office.user_id' => $this->Session->read('Auth.User.id')), "");
        } else {
            $query = $this->Article->listaRoleUser(
                    intval($this->request->query('start')), intval($this->request->query('length')), "", "");
        }

        //debug($query);
        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo
        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular


        $items = $this->Article->find('all', $query);
        //debug($items);
        //$log = $this->User->getDataSource()->getLog(false, false);       
        //pr($log);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Article->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Article->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Article']['id'],
                $item['Article']['nombre'],
                $item['Article']['descripcion'],
                //$this->Time->format('d/m/Y H:i:s', $item['Advance']['fecha']),
                $item['Pattern']['nombre'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Article']['created'],
                $item['Article']['modified'],
            ];
        }
        $response = [
            'draw' => intval($this->request->query('draw')),
            'recordsTotal' => $countTotal,
            'recordsFiltered' => $countFiltered,
            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        // pr($response);
        return $this->response;
    }

    public function index() {
        
    }

    public function add() {
        $marcas = $this->Trademark->find('list', array('fields' => 'Trademark.nombre', 'order' => 'Trademark.nombre'));
        $this->set('marcas', $marcas);
        $modelos = $this->Pattern->find('list', array('fields' => 'Pattern.nombre', 'order' => 'Pattern.nombre'));
        $this->set('modelos', $modelos);
        $id = $this->Session->read('Auth.User.id');
        if ($this->Session->read('role') == 'superuser') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                //'conditions' => array('User.id' => $id),
                'group' => array('Office.id'),
            ));
        } else {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'conditions' => array('User.id' => $id),
                'group' => array('Office.id'),
                'joins' => array(
                    //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                    array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Office.user_id')),
                //array('table' => 'offices', 'alias' => 'Office', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
                )
            ));
        }
        $this->set('offices', $offices);
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Article->getDataSource();
                $Transaccion->begin();
                //pr($d);

                if ($d['Article']['image']['name'] != '') {

                    if ($this->validarImagen($d['Article']['image']) == false) {

                        if ($d['Article']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Article']['image'], 'articles');
                            //pr($im);
                            $this->Article->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Article->set('office_id', $d['Article']['office_id']);
                $this->Article->set('model_id', $d['Article']['model_id']);
                $this->Article->set('nombre', ucwords($d['Article']['nombre']));
                $this->Article->set('costo', $d['Article']['costo']);
                $this->Article->set('codigo', $d['Article']['codigo']);
                $this->Article->set('color', $d['Article']['color']);
                $this->Article->set('descripcion', $d['Article']['descripcion']);

                if ($this->Article->validates()) {
                    if ($this->Article->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Articulo Registrado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function edit($id = null) {
        $datos = $this->Article->findById($id);
        $this->set('datos', $datos);
        if ($this->Session->read('role') != 'superuser') {
            if (empty($datos)) {
                $this->redirect('index');
            }
            if (!$this->userarticulo($id)) {
                $this->redirect('index');
            }
        }
        $marcas = $this->Trademark->find('list', array('fields' => 'Trademark.nombre', 'order' => 'Trademark.nombre'));
        $this->set('marcas', $marcas);
        $modelos = $this->Pattern->find('list', array('fields' => 'Pattern.nombre', 'order' => 'Pattern.nombre'));
        $this->set('modelos', $modelos);
        $id_user = $this->Session->read('Auth.User.id');

        if ($this->Session->read('role') == 'superuser') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                //'conditions' => array('User.id' => $id),
                'group' => array('Office.id'),
            ));
        } else {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'conditions' => array('User.id' => $id_user),
                'group' => array('Office.id'),
                'joins' => array(
                    //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                    array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Office.user_id')),
                //array('table' => 'offices', 'alias' => 'Office', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
                )
            ));
        }

        $this->set('offices', $offices);
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Article->getDataSource();
                $Transaccion->begin();
                //pr($d);

                if ($d['Article']['image']['name'] != '') {

                    if ($this->validarImagen($d['Article']['image']) == false) {

                        if ($d['Article']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Article']['image'], 'articles');
                            //pr($im);
                            $this->borrarImagenPc($datos['Article']['imagen'], 'articles');
                            $this->Article->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                $this->Article->id = $id; //$perfil['Profile']['id'];
                $this->Article->set('office_id', $d['Article']['office_id']);
                $this->Article->set('model_id', $d['Article']['model_id']);
                $this->Article->set('nombre', ucwords($d['Article']['nombre']));
                $this->Article->set('costo', $d['Article']['costo']);
                $this->Article->set('codigo', $d['Article']['codigo']);
                $this->Article->set('color', $d['Article']['color']);
                $this->Article->set('descripcion', $d['Article']['descripcion']);

                if ($this->Article->validates()) {
                    if ($this->Article->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Articulo Actualizado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function view($id = null) {
        $datos = $this->Article->find('first', array('conditions' => 'Article.id=' . $id, 'recursive' => 3));
        $this->set('datos', $datos);
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->userarticulo($id)) {
                $this->redirect('index');
            }
            if (empty($datos)) {
                $this->redirect('index');
            }
        }
    }

    public function buscar_articulo_soporte() {
        if ($this->request->is('post')) {
            $nombre = $this->request->data['ServiceStatu']['buscar'];

            $busquedad = $this->Article->buscararticulos($nombre, $this->Session->read('Auth.User.id'));
            //$log = $this->Article->getDataSource()->getLog(false, false);       
            //spr($log);
            $this->set('articulos', $busquedad);
        }
    }

}

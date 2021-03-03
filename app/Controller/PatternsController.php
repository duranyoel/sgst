<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP patternsController
 * @author yoelduran
 */
class PatternsController extends AppController {

    public function ajax_search() {
       
        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        if ($this->Session->read('role') == 'superuser') {
            $query = [
                'fields' => [
                    'Pattern.*'
                ],
                'recursive' => 3,
                'conditions' => [],
                'order' => [],
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => intval($this->request->query('start')), // start tiene la página
                'limit' => intval($this->request->query('length')), // length la cantidad de registros
            ];
        } else if ($this->Session->read('role') == 'admin'){
            $query = $this->Pattern->lista(
                    intval($this->request->query('start')), 
                    intval($this->request->query('length')), 
                    "", "");
        }else{
            $query = $this->Pattern->listaRoleUser(
                    intval($this->request->query('start')), 
                    intval($this->request->query('length')), 
                    "", "");
        }

        //debug($query);
        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo
       

        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular


        $items = $this->Pattern->find('all', $query);
        //debug($items);
        //$log = $this->User->getDataSource()->getLog(false, false);       
        //pr($log);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Pattern->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Pattern->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Pattern']['id'],
                $item['Pattern']['nombre'],
                $item['Pattern']['descripcion'],
                //$this->Time->format('d/m/Y H:i:s', $item['Advance']['fecha']),
                $item['Trademark']['nombre'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
               
                $item['Pattern']['created'],
                $item['Pattern']['modified'],
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
        
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Pattern->getDataSource();
                $Transaccion->begin();
                //pr($d);
                
              if ($d['Pattern']['image']['name'] != '') {

                    if ($this->validarImagen($d['Pattern']['image']) == false) {

                        if ($d['Pattern']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Pattern']['image'], 'patterns');
                            //pr($im);
                            $this->Pattern->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Pattern->set('nombre', ucfirst($d['Pattern']['nombre']));
                $this->Pattern->set('descripcion', $d['Pattern']['descripcion']);
               
                if ($this->Pattern->validates()) {
                    if ($this->Pattern->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Modelo Registrado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }
    public function edit($id=null) {
        $datos = $this->Pattern->findById($id);
        $this->set('datos', $datos);
        if (empty($datos)) {
            $this->redirect('index');
        }
        $marcas = $this->Trademark->find('list', array('fields' => 'Trademark.nombre', 'order' => 'Trademark.nombre'));
        $this->set('marcas', $marcas);
        
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Pattern->getDataSource();
                $Transaccion->begin();
                //pr($d);
                
              if ($d['Pattern']['image']['name'] != '') {

                    if ($this->validarImagen($d['Pattern']['image']) == false) {

                        if ($d['Pattern']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Pattern']['image'], 'patterns');
                            //pr($im);
                            $this->borrarImagenPc($datos['Pattern']['imagen'], 'patterns');
                            $this->Pattern->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                $this->Pattern->id =$id; //$perfil['Profile']['id'];
                $this->Pattern->set('nombre', ucfirst($d['Pattern']['nombre']));
                $this->Pattern->set('descripcion', $d['Pattern']['descripcion']);
               
                if ($this->Pattern->validates()) {
                    if ($this->Pattern->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Modelo Actualizado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }
    public function view($id=null) {
        $datos = $this->Pattern->findById($id);
        $this->set('datos', $datos);
    }
    public function get_by_marca() {
        if ($this->request->data['Article']['marca']) {
            $id = $this->request->data['Article']['marca'];
        }



        $modelos = $this->Pattern->find('list', array(
            'conditions' => array('trademark_id' => $id),
            'recursive' => -1, 'fields' => 'id,nombre'
        ));

        $this->set('modelos', $modelos);
        $this->layout = 'ajax';
    }

}

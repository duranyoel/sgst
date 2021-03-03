<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP CustomersControllers
 * @author yoelduran
 */
class AdvancesController extends AppController {

    public $name = 'Advances';

    public function ajax_search() {
      

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        if ($this->Session->read('role') == 'superuser') {
            $query = [
                'fields' => [
                    'Advance.*'
                ],
                'recursive' => 3,
                'conditions' => [],
                'order' => [],
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => intval($this->request->query('start')), // start tiene la página
                'limit' => intval($this->request->query('length')), // length la cantidad de registros
            ];
        } else if ($this->Session->read('role') == 'admin') {
            $query = $this->Advance->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('Office.user_id' => $this->Session->read('Auth.User.id')), "");
        } else {
            $query = $this->Advance->listaRoleUser(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('OfficeUser.user_id' => $this->Session->read('Auth.User.id')), "");
        }

      

        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular


        $items = $this->Advance->find('all', $query);
        //debug($items);
        //$log = $this->User->getDataSource()->getLog(false, false);       
        //pr($log);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Advance->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Advance->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Advance']['id'],
                $item['Service']['nombre'],
                $item['Advance']['monto'],
                //$this->Time->format('d/m/Y H:i:s', $item['Advance']['fecha']),
                $item['Advance']['fecha'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Advance']['observacion'],
                $item['Advance']['created'],
                $item['Advance']['modified'],
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

    public function index($id = null) {
        
    }

    public function add($id = null) {
        if ($id != null) {
            $services = $this->Service->find('list', array('fields' => 'Service.nombre',
                'order' => 'Service.nombre',
                'conditions' => 'Service.id=' . $id));
            $this->set('services', $services);
        } else {
            $services = $this->Service->find('list', array(
                'fields' => 'Service.nombre',
                'order' => 'Service.nombre',
                'recursive' => 3,
                'conditions' => array('Office.user_id' => $this->Session->read('Auth.User.id'))
            ));
            $this->set('services', $services);
        }



        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Advance->getDataSource();
                $Transaccion->begin();
                //pr($d);

                if ($d['Advance']['monto'] > $d['total']) {
                    $this->Session->setFlash(__($this->alertdanger('Error el monto no puede ser superior al total del servicio.')));
                    return;
                }
                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Advance->set('monto', $d['Advance']['monto']);

                $this->Advance->set('fecha', $d['Advance']['fecha']);
                $this->Advance->set('observacion', $d['Advance']['observacion']);
                $this->Advance->set('service_id', $d['Advance']['service_id']);

                if ($this->Advance->validates()) {
                    if ($this->Advance->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Abono/Adelanto Registrado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function get_total() {
        $this->layout = 'ajax';
        if ($this->request->data['Advance']['service_id']) {
            $service_id = $this->request->data['Advance']['service_id'];
        }

        $totalabonos = $this->Advance->query($this->Advance->sumTotales($service_id));
        $this->set('servicestotales', $totalabonos);
        
        $articlesservicestotales = $this->ArticleService->query($this->ArticleService->sumTotales($service_id));
        $this->set('articlesservicestotales', $articlesservicestotales);
        
        
        // pr($totalabonos);
        $services = $this->Service->find('first', array('conditions' => 'Service.id=' . $service_id));
        $this->set('servicios', $services);
    }

    public function edit($id = null) {
        $datos = $this->Advance->findById($id);
        if ($this->Session->read('role') != 'superuser') {
            if (empty($datos)) {
                $this->redirect('index');
            }
            if (!$this->adelantos($id)) {
                $this->redirect('index');
            }
        }
        $this->set('datos', $datos);

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Advance->getDataSource();
                $Transaccion->begin();
                //pr($d);

                if ($d['Advance']['monto'] > $datos['Advance']['monto']) {
                    $this->Session->setFlash(__($this->alertdanger('Error el monto no puede ser superior al total del servicio.')));
                    return;
                }
                $this->Advance->id = $id;
                $this->Advance->set('monto', $d['Advance']['monto']);

                $this->Advance->set('fecha', $d['Advance']['fecha']);
                $this->Advance->set('observacion', $d['Advance']['observacion']);
                //$this->Advance->set('service_id', $d['Advance']['service_id']);

                if ($this->Advance->validates()) {
                    if ($this->Advance->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Abono/Adelanto Registrado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function view($id = null) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->adelantos($id)) {
                $this->redirect('index');
            }
        }
        $datos = $this->Advance->findById($id);
        $this->set('datos', $datos);
    }

}

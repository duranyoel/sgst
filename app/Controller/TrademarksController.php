<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TrademarksController
 * @author yoelduran
 */
class TrademarksController extends AppController {
    public $name = 'Trademarks';
    
    public function ajax_search() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
       

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
            $query = [
                'fields' => [
                    'Trademark.*'
                ],
                'recursive' => 0,
                'conditions' => [],
                
            ];

      

        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular


        $items = $this->Trademark->find('all', $query);
        //debug($items);
        //$log = $this->User->getDataSource()->getLog(false, false);       
        //pr($log);
        // hacemos esto para obtener la cuenta total de registros filtrados
       
       
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Trademark']['id'],
                $item['Trademark']['nombre'],
              
                $item['Trademark']['descripcion'],
                $item['Trademark']['created'],
                $item['Trademark']['modified'],
            ];
        }
        $response = [
           
            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        // pr($response);
        return $this->response;
    }
    public function index() {
        if($this->Session->read('role')!='superuser'){
            $this->redirect(array('controller'=>'dashboard','action'=>'index'));
        }
    }
    
    public function add() {
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Trademark->getDataSource();
                $Transaccion->begin();
                //pr($d);
                
              if ($d['Trademark']['image']['name'] != '') {

                    if ($this->validarImagen($d['Trademark']['image']) == false) {

                        if ($d['Trademark']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Trademark']['image'], 'trademarks');
                            //pr($im);
                            $this->Trademark->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Trademark->set('nombre', $d['Trademark']['nombre']);
                $this->Trademark->set('descripcion', $d['Trademark']['descripcion']);
               
                if ($this->Trademark->validates()) {
                    if ($this->Trademark->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Marca Registrado Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }
    public function edit($id=null) {
        $datos = $this->Trademark->findById($id);
        if (empty($datos)) {
            $this->redirect('index');
        }
        $this->set('datos', $datos);
        
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Trademark->getDataSource();
                $Transaccion->begin();
                //pr($d);
                
              if ($d['Trademark']['image']['name'] != '') {

                    if ($this->validarImagen($d['Trademark']['image']) == false) {

                        if ($d['Trademark']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Trademark']['image'], 'trademarks');
                            //pr($im);
                            $this->borrarImagenPc($datos['Trademark']['imagen'], 'trademarks');
                            $this->Trademark->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                $this->Trademark->id= $id;
                $this->Trademark->set('nombre', $d['Trademark']['nombre']);
                $this->Trademark->set('descripcion', $d['Trademark']['descripcion']);
               
                if ($this->Trademark->validates()) {
                    if ($this->Trademark->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Marca actualizada Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }
    public function view($id=null) {
        $datos = $this->Trademark->findById($id);
        $this->set('datos', $datos);
    }
    public function delete($id=null){
        $this->Trademark->id = $id;
        if (!$this->Trademark->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Trademark->delete()) {
            $this->Flash->success(__('Registro eliminado con exito.'));
        } else {
            $this->Flash->error(__('El registro no puede ser borrado.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ServicesController
 * @author yoelduran
 */
class ServicesController extends AppController {

    public $name = 'Services';

    public function ajax_search() {


        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno

        if ($this->Session->read('role') == 'superuser') {
            $query = $this->Service->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), "");
        } else if ($this->Session->read('role') == 'admin') {
            $query = $this->Service->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('User.id' => $this->Session->read('Auth.User.id')), "");
        } else {
            $query = $this->Service->listaRoleUser(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('OfficeUser.user_id' => $this->Session->read('Auth.User.id')), "");
        }




        $items = $this->Service->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados

        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Service']['id'],
                $item['Service']['nombre'],
                $item['Service']['codigo'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Customer']['nombres'],
                $item['Office']['nombre'],
            ];
        }
        $response = [

            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        //pr($response);
        return $this->response;
    }

    public function ajax_listado_reparados() {

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno

        if ($this->Session->read('role') == 'superuser') {
            $query = $this->Service->listaReparados(
                    intval($this->request->query('start')), intval($this->request->query('length')), "", "");
        } else if ($this->Session->read('role') == 'admin') {
            $query = $this->Service->listaReparados(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('User.id' => $this->Session->read('Auth.User.id'), 'ServiceStatu.estatus' => 'Reparado'), "");
        } else {
            $query = $this->Service->listaRoleUserReparados(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('OfficeUser.user_id' => $this->Session->read('Auth.User.id'), 'ServiceStatu.estatus' => 'Reparado'), "");
        }




        $items = $this->Service->find('all', $query);

        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Service']['id'],
                $item['Service']['nombre'],
                $item['Service']['codigo'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Customer']['nombres'],
                $item['Office']['nombre'],
                $item['Service']['created'],
                $item['Service']['modified'],
            ];
        }
        $response = [

            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        //pr($response);
        return $this->response;
    }

    public function index() {
        
    }

    public function listadoreparados() {
        
    }

    public function add($id_customer = null) {
        $id_user = $this->Session->read('Auth.User.id');
        if ($this->Session->read('role') == 'superuser') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                //'conditions' => array('Office.user_id' => $id_user),
                'group' => array('Office.id'),
            ));
        } else if ($this->Session->read('role') == 'admin') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'conditions' => array('Office.user_id' => $id_user),
                'group' => array('Office.id'),
            ));
        } else {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'recursive' => 0,
                'conditions' => array('OfficeUser.user_id' => $id_user),
                'joins' => array(
                    array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
                ),
                'group' => array('Office.id'),
            ));
        }
        $this->set('offices', $offices);
        if ($id_customer != null) {
            $customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => $id_customer)));
            $this->set('customer', $customer);
            //pr($customer);
        } else {
            $customer = null;
            $this->set('customer', $customer);
        }

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Service->getDataSource();
                $Transaccion->begin();

                //$this->User->id /=; //$perfil['Profile']['id'];



                $this->Customer->set('apellidos', ucwords($d['Service']['apellidos']));
                $this->Customer->set('nombres', ucwords($d['Service']['nombres']));
                $this->Customer->set('cedula', $d['Service']['cedula']);
                $this->Customer->set('direccion', ucwords($d['Service']['direccion']));
                $this->Customer->set('telefono', $d['Service']['telefono']);
                $this->Customer->set('tipo', $d['Service']['tipo']);
                $this->Customer->set('email', $d['Service']['email']);


                $this->Service->set('user_id', $id_user);
                $this->Service->set('office_id', $d['Service']['office_id']);
                $this->Service->set('nombre', ucwords($d['Service']['nombre']));
                $this->Service->set('codigo', $d['Service']['codigo']);
                $this->Service->set('color', $d['Service']['color']);
                $this->Service->set('num_serie', $d['Service']['num_serie']);
                $this->Service->set('fecha_entrega', $d['Service']['fecha_entrega']);
                $this->Service->set('fecha_recibido', $d['Service']['fecha_recibido']);


                if ($d['Service']['image']['name'] != '') {

                    if ($this->validarImagen($d['Service']['image']) == false) {

                        if ($d['Service']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Service']['image'], 'customers');
                            $this->borrarImagenPc($customer['Customer']['imagen'], 'customers');
                            $this->Customer->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                // verificamos si el cliente esta registrado y solo giardamos los datos del servicio
                if ($d['Service']['id_customer'] != '') {
                    $this->Service->set('customer_id', $d['Service']['id_customer']);
                    $this->Customer->id = $d['Service']['id_customer'];
                    if ($this->Customer->save($d)) {
                        if ($this->Service->save($d)) {
                            $this->ServiceStatu->set('user_id', $id_user);
                            $this->ServiceStatu->set('service_id', $this->Service->id);
                            $this->ServiceStatu->set('estatus', 'Recibido');
                            $this->ServiceStatu->set('descripcion', 'Recepción del equipo');
                            if ($this->ServiceStatu->save($d)) {
                                $swtransaccion = 1;
                                $this->correo($d['Service']['email'], 'Gracias por confiar en nosotros su orden esta siendo procesada ', array('codigo' => $d['Service']['codigo'],
                                    'apellidos' => $d['Service']['apellidos'],
                                    'nombres' => $d['Service']['nombres']), 'customers');
                            }
                        }
                    }
                } else {
                    // El cliente no esta registrado y se procede a crear el cliente junto con la orden de servicio
                    if ($this->Customer->validates()) {
                        if ($this->Customer->save($d)) {
                            $this->Service->set('customer_id', $this->Customer->id);
                            if ($this->Service->save($d)) {
                                $this->ServiceStatu->set('user_id', $id_user);
                                $this->ServiceStatu->set('service_id', $this->Service->id);
                                $this->ServiceStatu->set('estatus', 'Recibido');
                                if ($this->ServiceStatu->save($d)) {
                                    $swtransaccion = 1;
                                    $this->correo($d['Service']['email'], 'Gracias por confiar en nosotros su orden esta siendo procesada ', array('codigo' => $d['Service']['codigo'],
                                        'apellidos' => $d['Service']['apellidos'],
                                        'nombres' => $d['Service']['nombres']), 'customers');
                                }
                            }
                        }
                    }
                }



                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Orden de servicio registrada')));

                    $this->redirect('view/' . $this->Service->id);
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function edit($id) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        $id_user = $this->Session->read('Auth.User.id');
        if ($this->Session->read('role') == 'superuser') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                //'conditions' => array('Office.user_id' => $id_user),
                'group' => array('Office.id'),
            ));
        } else if ($this->Session->read('role') == 'admin') {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'conditions' => array('Office.user_id' => $id_user),
                'group' => array('Office.id'),
            ));
        } else {
            $offices = $this->Office->find('list', array(
                'fields' => 'Office.nombre',
                'order' => 'Office.nombre',
                'recursive' => 0,
                'conditions' => array('OfficeUser.user_id' => $id_user),
                'joins' => array(
                    array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
                ),
                'group' => array('Office.id'),
            ));
        }

        $this->set('offices', $offices);
        $datos = $this->Service->findById($id);
        $this->set('datos', $datos);

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;
                //pr($d);
                $Transaccion = $this->Service->getDataSource();
                $Transaccion->begin();

                //$this->User->id /=; //$perfil['Profile']['id'];



                $this->Customer->set('apellidos', ucwords($d['Service']['apellidos']));
                $this->Customer->set('nombres', ucwords($d['Service']['nombres']));
                $this->Customer->set('cedula', $d['Service']['cedula']);
                $this->Customer->set('direccion', ucwords($d['Service']['direccion']));
                $this->Customer->set('telefono', $d['Service']['telefono']);
                $this->Customer->set('tipo', $d['Service']['tipo']);
                $this->Customer->set('email', $d['Service']['email']);

                $this->Service->set('user_id', $id_user);
                $this->Service->set('office_id', $d['Service']['office_id']);
                $this->Service->set('nombre', ucwords($d['Service']['nombre']));
                $this->Service->set('codigo', $d['Service']['codigo']);
                $this->Service->set('color', $d['Service']['color']);
                $this->Service->set('num_serie', $d['Service']['num_serie']);
                $this->Service->set('fecha_entrega', $d['Service']['fecha_entregas']);
                $this->Service->set('fecha_recibido', $d['Service']['fecha_recibidos']);


                if ($d['Service']['image']['name'] != '') {

                    if ($this->validarImagen($d['Service']['image']) == false) {

                        if ($d['Service']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Service']['image'], 'customers');
                            if($datos['Customer']['imagen']!=''){
                                $this->borrarImagenPc($datos['Customer']['imagen'], 'customers');
                            }
                           
                            $this->Customer->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }
                $this->Service->id = $id;
                $this->Customer->id = $d['Service']['customer_id'];
                if ($this->Customer->validates()) {
                    if ($this->Customer->save($d)) {
                        if ($this->Service->save($d)) {
                            $swtransaccion = 1;
                            $this->correo($d['Service']['email'], 'Gracias por confiar en nosotros su orden esta siendo procesada ', array('codigo' => $d['Service']['codigo'],
                                'apellidos' => $d['Service']['apellidos'],
                                'nombres' => $d['Service']['nombres']), 'customers');
                        }
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Orden de servicio actualizada')));

                    $this->redirect('view/' . $this->Service->id);
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function view($id) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        $id_user = $this->Session->read('Auth.User.id');
        $datos = $this->Service->detallesServicio($id);
        $this->set('datos', $datos);
        $listado_articulos = $this->ArticleService->listadoArticleService($id);
        $this->set('articulosagregados', $listado_articulos);
        $articlesservicestotales = $this->ArticleService->query($this->ArticleService->sumTotales($id));
        $this->set('articlesservicestotales', $articlesservicestotales);

        $advances = $this->Advance->find('all', array('conditions' => 'Advance.service_id=' . $id));
        $this->set('advances', $advances);
    }

    public function imprimir_orden($id) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        $bus = $this->data;
        $this->Service->recursive = 0;
        $datos = $this->Service->findById($id);
        $this->set('datos', $datos);



        if (!$datos) {
            $this->Flash->error(__('Error.'));
            //$this->Session->setFlash('no has seleccionado ningun pdf.');
            //$this->redirect(array('action'=>'index'));
        }
        // Sobrescribimos para que no aparezcan los resultados de debuggin
        // ya que sino daria un error al generar el pdf.
        Configure::write('debug', 0);

        $this->layout = 'pdf'; //esto usara el layout pdf.ctp
        $this->render();
    }

    public function imprimir_factura($id = null, $estatus = null) {
        $id_user = $this->Session->read('Auth.User.id');
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        if ($estatus == 'Entregar') {
            $swtransaccion = 0;
            $d = $this->request->data;

            $Transaccion = $this->ServiceStatu->getDataSource();
            $Transaccion->begin();
            $this->ServiceStatu->set('user_id', $id_user);
            $this->ServiceStatu->set('service_id', $id);
            $this->ServiceStatu->set('estatus', 'Entregado');
            $this->ServiceStatu->set('descripcion', 'El cliente pago factura y se le entrego el equipo');

            if ($this->ServiceStatu->validates()) {
                if ($this->ServiceStatu->save($d)) {
                    $swtransaccion = 1;
                }
            }


            if ($swtransaccion == 0) {
                $Transaccion->rollback();
            } else {
                $Transaccion->commit();
            } //SI 
        }
        $bus = $this->data;
        $this->Service->recursive = 0;
        $datos = $this->Service->findById($id);
        $this->set('datos', $datos);
        $listado_articulos = $this->ArticleService->listadoArticleService($id);

        $this->set('articulosagregados', $listado_articulos);
        $articlesservicestotales = $this->ArticleService->query($this->ArticleService->sumTotales($id));
        $this->set('articlesservicestotales', $articlesservicestotales);


        if (!$datos) {
            $this->Flash->error(__('Error.'));
            //$this->Session->setFlash('no has seleccionado ningun pdf.');
            //$this->redirect(array('action'=>'index'));
        }
        // Sobrescribimos para que no aparezcan los resultados de debuggin
        // ya que sino daria un error al generar el pdf.
        Configure::write('debug', 0);

        $this->layout = 'pdf'; //esto usara el layout pdf.ctp
        $this->render();
    }

    //Area de soporte
    public function soporte($id = null) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        $id_user = $this->Session->read('Auth.User.id');
        $datos = $this->Service->detallesServicio($id);
        $this->set('datos', $datos);
        $listado_articulos = $this->ArticleService->listadoArticleService($id);
        $this->set('articulosagregados', $listado_articulos);
        //pr($datos);
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->ServiceStatu->getDataSource();
                $Transaccion->begin();
                $this->ServiceStatu->set('user_id', $id_user);
                $this->ServiceStatu->set('service_id', $id);
                $this->ServiceStatu->set('estatus', $d['ServiceStatu']['estatus']);
                $this->ServiceStatu->set('descripcion', $d['ServiceStatu']['descripcion']);

                if ($this->ServiceStatu->validates()) {
                    if ($this->ServiceStatu->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Registro ingresado')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function soporte_lista_ajax() {


        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        $id_user = $this->Session->read('Auth.User.id');
        if ($this->Session->read('role') == 'superuser') {
            $query = $this->ServiceStatu->listadoRoleSuperUser(intval($this->request->query('start')), intval($this->request->query('length')), "", array('ServiceStatu.created DESC'));
        } else if ($this->Session->read('role') == 'admin') {
            $query = $this->ServiceStatu->listadoRoleAdmin(intval($this->request->query('start')), intval($this->request->query('length')), array('Office.user_id' => $id_user), "");
        } else {
            $query = $this->ServiceStatu->listadoRoleUser(intval($this->request->query('start')), intval($this->request->query('length')), array('OfficeUser.user_id' => $id_user), array('ServiceStatu.created ASC'));
        }





        $items = $this->ServiceStatu->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->ServiceStatu->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->ServiceStatu->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Service']['id'],
                $item['Service']['nombre'],
                $item['Service']['codigo'],
                $item['ServiceStatu']['estatus'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['ServiceStatu']['descripcion'],
                $item['User']['nombres'] . ' ' . $item['User']['apellidos'],
                $item['ServiceStatu']['created'],
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
        //pr($response);
        return $this->response;
    }

    public function soporte_lista() {
        
    }

    public function soporte_detalles($id = null) {
        if ($this->Session->read('role') != 'superuser') {
            if (!$this->servicios($id)) {
                $this->redirect('index');
            }
        }
        $datos = $this->Service->detallesServicio($id);
        //pr($datos);
        $this->set('datos', $datos);
        $listado_articulos = $this->ArticleService->listadoArticleService($id);
        $this->set('articulosagregados', $listado_articulos);
    }

    public function addarticle() {
        if ($this->request->is('post')) {

            //
            //$busquedad = $this->Article->buscararticulos($nombre, $this->Session->read('Auth.User.id'));
            //$log = $this->Article->getDataSource()->getLog(false, false);       
            //spr($log);
            //$this->set('articulos', $busquedad);

            $swtransaccion = 0;
            $d = $this->request->data;
            //pr($d);
            $Transaccion = $this->ArticleService->getDataSource();
            $Transaccion->begin();

            //$this->User->id /=; //$perfil['Profile']['id'];
            //$this->ArticleService->set('service_id', $d['ServiceStatu']['services_id']);
            //$this->ArticleService->set('article_id', $d['articles_id']);
            //$this->ArticleService->set('observacion', $d['descripcionarticle']);
            $this->ArticleService->create(
                    array(
                        'service_id' => $d['ServiceStatu']['services_id'],
                        'article_id' => $d['articles_id'],
                        'observacion' => $d['descripcionarticle']));
            if ($this->ArticleService->save($d)) {
                $swtransaccion = 1;
            }

            //$log = $this->ArticleService->getDataSource()->getLog(false, false);       
            //pr($log);


            if ($swtransaccion == 0) {
                $Transaccion->rollback();
            } else {
                $Transaccion->commit();

                // $this->redirect('view/' . $this->Service->id);
            } //SI
            $listado_articulos = $this->ArticleService->listadoArticleService($d['ServiceStatu']['services_id']);
            $this->set('servicearticle', $listado_articulos);
        }
    }

    public function deletearticleservice($id = null, $id_service = null) {
        if ($this->request->is('post')) {

            $this->ArticleService->id = $id;
            if (!$this->ArticleService->exists()) {
                throw new NotFoundException(__('Invalid country'));
            }
            $this->request->allowMethod('post', 'delete');
            if ($this->ArticleService->delete()) {
                $this->Flash->success(__('The country has been deleted.'));
            } else {
                $this->Flash->error(__('The country could not be deleted. Please, try again.'));
            }
            $this->layout = 'ajax';
            $listado_articulos = $this->ArticleService->listadoArticleService($id_service);
            $this->set('servicearticle', $listado_articulos);
            //$this->redirect(array('controller'=>'services','action'=>'soporte/'.$id));
        }
    }

}

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
class CustomersController extends AppController {

    public function ajax_search() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        //if ($this->Session->read('role') == 'superuser') {
        //} else {
        //  $query = $this->Customer->lista(intval($this->request->query('start')), intval($this->request->query('length')), array('User.id' => $this->Session->read('Auth.User.id')), "");
        //}
        $query = $this->Customer->lista("", "", "", "");
        //pr($query);
        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo




        $items = $this->Customer->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados

        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Customer']['id'],
                $item['Customer']['cedula'],
                $item['Customer']['apellidos'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Customer']['nombres'],
                $item['Customer']['created'],
                $item['Customer']['modified'],
            ];
        }
        $response = [
            //'draw' => intval($this->request->query('draw')),
            //'recordsTotal' => $countTotal,
            //'recordsFiltered' => $countFiltered,
            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        //pr($response);
        return $this->response;
    }

    public function ajax_service() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        $_columnsMap = [
            // 0 => '' en este caso no tengo posición 0 porque esa columna se usa para mostrar las acciones y no datos
            0 => 'Customer.id',
            1 => 'Customer.cedula',
            2 => 'Customer.apellidos',
            3 => 'Customer.nombres'
        ];

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        //if ($this->Session->read('role') == 'superuser') {
        //} else {
        //  $query = $this->Customer->lista(intval($this->request->query('start')), intval($this->request->query('length')), array('User.id' => $this->Session->read('Auth.User.id')), "");
        //}
        $query = $this->Customer->lista(intval($this->request->query('start')), intval($this->request->query('length')), "", "");
        //pr($query);
        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo
        $req_order = $this->request->query('order');
        if ($req_order) {
            foreach ($req_order as $order) {
                $query['order'][$_columnsMap[intval($order['column'])]] = $order['dir'];
            }
        }

        // busqueda global, en este parámetro del request->query tenemos lo que se haya ingresado en el campo de busqueda 
        // general del datatable, el campo común de búsqueda, configurar la búsqueda acá según las necesidades de cada uno
        if ($this->request->query('search.value')) {
            $val = $this->request->query('search.value');
            $query['conditions'] += ['or' => [
                    'Customer.cedula LIKE' => "%{$val}%",
                    'Customer.apellidos LIKE' => "%{$val}%",
                    'Customer.nombres LIKE' => "%{$val}%",
            ]];
        }



        $items = $this->Customer->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Customer->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Customer->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Customer']['id'],
                $item['Customer']['cedula'],
                $item['Customer']['apellidos'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Customer']['nombres']
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

    public function index() {
        
    }

    public function add() {
        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Service->getDataSource();
                $Transaccion->begin();

                //$this->Customer->id =$id; //$perfil['Profile']['id'];



                $this->Customer->set('apellidos', ucwords($d['Customer']['apellidos']));
                $this->Customer->set('nombres', ucwords($d['Customer']['nombres']));
                $this->Customer->set('cedula', $d['Customer']['cedula']);
                $this->Customer->set('direccion', ucwords($d['Customer']['direccion']));
                $this->Customer->set('telefono', $d['Customer']['telefono']);
                $this->Customer->set('tipo', $d['Customer']['tipo']);
                $this->Customer->set('email', $d['Customer']['email']);




                if ($d['Customer']['image']['name'] != '') {

                    if ($this->validarImagen($d['Customer']['image']) == false) {

                        if ($d['Customer']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Customer']['image'], 'customers');
                            $this->Customer->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }

                // El cliente no esta registrado y se procede a crear el cliente junto con la orden de servicio
                if ($this->Customer->validates()) {
                    if ($this->Customer->save($d)) {
                        $swtransaccion = 1;
                    }
                }




                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Cliente actualizado')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function edit($id = null) {
        $datos = $this->Customer->find('first', array('conditions' => array('Customer.id' => $id)));
        $this->set('datos', $datos);

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Service->getDataSource();
                $Transaccion->begin();

                $this->Customer->id = $id; //$perfil['Profile']['id'];



                $this->Customer->set('apellidos', ucwords($d['Customer']['apellidos']));
                $this->Customer->set('nombres', ucwords($d['Customer']['nombres']));
                $this->Customer->set('cedula', $d['Customer']['cedula']);
                $this->Customer->set('direccion', ucwords($d['Customer']['direccion']));
                $this->Customer->set('telefono', $d['Customer']['telefono']);
                $this->Customer->set('tipo', $d['Customer']['tipo']);
                $this->Customer->set('email', $d['Customer']['email']);




                if ($d['Customer']['image']['name'] != '') {

                    if ($this->validarImagen($d['Customer']['image']) == false) {

                        if ($d['Customer']['image']['name'] != "") {

                            $im = $this->subirImagen($d['Customer']['image'], 'customers');
                            if ($datos['Customer']['imagen'] != '') {
                                $this->borrarImagenPc($datos['Customer']['imagen'], 'customers');
                            }

                            $this->Customer->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }

                // El cliente no esta registrado y se procede a crear el cliente junto con la orden de servicio
                if ($this->Customer->validates()) {
                    if ($this->Customer->save($d)) {
                        $swtransaccion = 1;
                    }
                }




                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo registrar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Cliente actualizado')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function view($id = null) {
        $datos = $this->Customer->find('first', array('conditions' => array('Customer.id' => $id)));
        $this->set('datos', $datos);
    }

}

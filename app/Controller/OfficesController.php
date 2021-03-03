<?php

App::uses('AppController', 'Controller');

/**
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class OfficesController extends AppController {

    public $name = 'Offices';

    public function ajax_search() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        $_columnsMap = [
            // 0 => '' en este caso no tengo posición 0 porque esa columna se usa para mostrar las acciones y no datos
            0 => 'Office.id',
            1 => 'Office.nombre',
            2 => 'Office.telefono',
            3 => 'Office.direccion',
            4 => 'Office.created', // si consultamos sobre algun modelo relacionado
            5 => 'Office.modified',
        ];

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno

        if ($this->Session->read('role') == 'superuser') {
            $query = [
                'fields' => [
                    'Office.*'
                ],
                'recursive' => 3,
                'conditions' => [],
                'order' => [],
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => intval($this->request->query('start')), // start tiene la página
                'limit' => intval($this->request->query('length')), // length la cantidad de registros
            ];
        } else {
            $query = $this->Office->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('Office.user_id' => $this->Session->read('Auth.User.id')), "");
        }
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
                    'Office.nombre LIKE' => "%{$val}%",
                    'Office.telefono LIKE' => "%{$val}%",
                    'Office.direccion LIKE' => "%{$val}%",
            ]];
        }



        $items = $this->Office->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Office->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Office->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Office']['id'],
                $item['Office']['nombre'],
                $item['Office']['telefono'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Office']['direccion'],
                $item['Office']['created'],
                $item['Office']['modified'],
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

                $Transaccion = $this->Office->getDataSource();
                $Transaccion->begin();

                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Office->set('nombre', $d['Office']['nombre']);

                $this->Office->set('direccion', $d['Office']['direccion']);
                $this->Office->set('telefono', $d['Office']['telefono']);
                $this->Office->set('user_id', $this->Session->read('Auth.User.id'));

                if ($this->Office->validates()) {
                    if ($this->Office->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Empresa Registrada Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function edit($id) {
        $datos = $this->Office->findById($id);
       
        if ($this->Session->read('role') != 'superuser') {
            if (empty($datos)) {
                $this->redirect('index');
            }
            if (!$this->useroffices($id)) {
                $this->redirect('index');
            }
        }
        $this->set('datos', $datos);

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->Office->getDataSource();
                $Transaccion->begin();

                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->Office->set('nombre', $d['Office']['nombre']);

                $this->Office->set('direccion', $d['Office']['direccion']);
                $this->Office->set('telefono', $d['Office']['telefono']);

                $this->Office->id = $id;
                if ($this->Office->validates()) {
                    if ($this->Office->save($d)) {
                        $swtransaccion = 1;
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Empresa Actualizada Con Exito')));

                    $this->redirect('index');
                } //SI 
            }
        } catch (Exception $ex) {
            
        }
    }

    public function view($id) {
         $datos = $this->Office->findById($id);
        $this->set('datos', $datos);
        if ($this->Session->read('role') != 'superuser') {
            if (empty($datos)) {
                $this->redirect('index');
            }
            if (!$this->useroffices($id)) {
                $this->redirect('index');
            }
        }
       
    }

}

?>
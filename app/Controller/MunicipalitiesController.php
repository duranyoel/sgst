<?php

App::uses('AppController', 'Controller');

/**
 * Municipalities Controller
 *
 * @property Municipality $Municipality
 * @property PaginatorComponent $Paginator
 */
class MunicipalitiesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

//    public function beforeFilter() {
//        parent::beforeFilter();
//        $this->Auth->allow('index', 'view', 'delete', 'add', 'getByEstados');
//    }

    /**
     * index method
     *
     * @return void
     */
    public function ajax_search() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        $_columnsMap = [
            // 0 => '' en este caso no tengo posición 0 porque esa columna se usa para mostrar las acciones y no datos
            1 => 'Municipality.id',
            2 => 'Municipality.nombre',
            3 => 'State.nombre',
            4 => 'Municipality.created',
            5 => 'Municipality.modified',
                //6 => ''
        ];

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        $query = [
            'fields' => [
                'Municipality.*', 'State.nombre'
            ],
            'recursive' => 0,
            'conditions' => [],
            'order' => ['Municipality.id'],
            
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => intval($this->request->query('start')), // start tiene la página
            'limit' => intval($this->request->query('length')), // length la cantidad de registros
        ];

        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo
        $req_order = $this->request->query('order');
        //pr($req_order);
        if ($req_order) {
            foreach ($req_order as $order) {
               // $query['order'][$_columnsMap[intval($order['column'])]];
            }
        }

        // busqueda global, en este parámetro del request->query tenemos lo que se haya ingresado en el campo de busqueda 
        // general del datatable, el campo común de búsqueda, configurar la búsqueda acá según las necesidades de cada uno
//        if ($this->request->query('search.value')) {
//            $val = $this->request->query('search.value');
//            $query['conditions'] += ['or' => [
//                    'Municipality.nombre LIKE' => "%{$val}%",
//                    'State.nombre LIKE' => "%{$val}%",
//            ]];
//        }

        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular
        $req_columns = $this->request->query('columns');
//        if ($req_columns) {
//            foreach ($req_columns as $column) {
//                // busqueda
//                if (!array_key_exists(intval($column['data']), $_columnsMap) ||
//                        $column['searchable'] !== 'true' || empty($column['search']['value'])
//                ) {
//                   $req_columns = $this->request->query('columns');
//        if ($req_columns) {
//         continue;
//                }
//                $colName = $_columnsMap[intval($column['data'])];
//                $search = $column['search']['value'];
//                // el modo de búsqueda dependerá de los tipos de datos y las necesidades de cada uno, adaptar a cada caso
//                switch ($colName) {
//                    case 'Municipality.nombre':
//                        $query['conditions']['Municipality.nombre LIKE'] = "{$search}%";
//                        break;
//                    case 'State.nombre':
//                        $query['conditions']['State.nombre LIKE'] = "{$search}%";
//                        break;
//                }
//            }
//        }


        $items = $this->Municipality->find('all', $query);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->Municipality->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->Municipality->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente 
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['Municipality']['id'],
                $item['Municipality']['nombre'],
                $item['State']['nombre'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['Municipality']['created'],
                $item['Municipality']['modified'],
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
        pr($response);
        return $this->response;
    }

    public function index() {
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        //$this->layout = "default1";
        if (!$this->Municipality->exists($id)) {
            throw new NotFoundException(__('Invalid municipality'));
        }
        $options = array('conditions' => array('Municipality.' . $this->Municipality->primaryKey => $id));
        $this->set('municipality', $this->Municipality->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        //$this->layout = "default1";
        if ($this->request->is('post')) {
            $this->Municipality->create();
            if ($this->Municipality->save($this->request->data)) {
                $this->Flash->success(__('The municipality has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The municipality could not be saved. Please, try again.'));
            }
        }
        $states = $this->Municipality->State->find('list', array('order' => 'State.nombre'));
        $this->set(compact('states'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        //$this->layout = "default1";
        if (!$this->Municipality->exists($id)) {
            throw new NotFoundException(__('Invalid municipality'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Municipality->save($this->request->data)) {
                $this->Flash->success(__('The municipality has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The municipality could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Municipality.' . $this->Municipality->primaryKey => $id));
            $this->request->data = $this->Municipality->find('first', $options);
        }
        $states = $this->Municipality->State->find('list', array('order' => 'State.nombre'));
        $this->set(compact('states'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Municipality->id = $id;
        if (!$this->Municipality->exists()) {
            throw new NotFoundException(__('Invalid municipality'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Municipality->delete()) {
            $this->Flash->success(__('The municipality has been deleted.'));
        } else {
            $this->Flash->error(__('The municipality could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function getByEstados() {

        if ($this->request->data['User']['states']) {
            $estado_id = $this->request->data['User']['states'];
        }



        $municipios = $this->Municipality->find('list', array(
            'conditions' => array('state_id' => $estado_id),
            'recursive' => -1, 'fields' => 'id,nombre'
        ));

        $this->set('municipalities', $municipios);
        $this->layout = 'ajax';
    }

}

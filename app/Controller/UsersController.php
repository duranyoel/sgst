<?php

App::uses('AppController', 'Controller');

/**
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

    public $name = 'Users';

    //Filtramos los permisos que tiene el usuario en este controlador
    // public function beforeFilter() {
    //     parent::beforeFilter();
    //     //$this->Auth->allow('registro', 'logout', 'login');
    // }
    public function ajax_search1() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        // $_columnsMap = [
        //     // 0 => '' en este caso no tengo posición 0 porque esa columna se usa para mostrar las acciones y no datos
        //     0 => 'User.id',
        //     1 => 'User.apellidos',
        //     2 => 'User.nombres',
        //     3 => 'User.cedula',
        //     4 => 'User.creado', // si consultamos sobre algun modelo relacionado
        //     5 => 'User.modificado',
        // ];
        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        if ($this->Session->read('role') == 'superuser') {
            $query = $this->User->query('SELECT
                        User.id as Ids,
                        User.cedula as Cedula,
                        User.apellidos as Apellidos,
                        User.nombres AS Nombres,
                        User.role AS Role,
                        User.estatus as Estatus
                        
                        FROM
                            users as User');
            //pr($query);
        } else {
            $result = $this->User->listadoUsersIndex($this->Session->read('Auth.User.id'));
            $query = $this->User->query($result);
        }
//        $log = $this->User->getDataSource()->getLog(false, false);       
//        pr($log);
//        pr($query);
        //debug($query);
        // ordenamiento, revisamos si datatable establece algún orden particular, puede ser por más de una columna
        // datatables usa el índice númerico de la columna por la que se ordena, usamos el columnsMap para obtener el campo
        // $req_order = $this->request->query('order');
        // if ($req_order) {
        //     foreach ($req_order as $order) {
        //         $query['order'][$_columnsMap[intval($order['column'])]] = $order['dir'];
        //     }
        // }
        // busqueda global, en este parámetro del request->query tenemos lo que se haya ingresado en el campo de busqueda
        // general del datatable, el campo común de búsqueda, configurar la búsqueda acá según las necesidades de cada uno
        // if ($this->request->query('search.value')) {
        //     $val = $this->request->query('search.value');
        //     $query['conditions'] += ['or' => [
        //             'User.apellidos LIKE' => "%{$val}%",
        //             'User.nombres LIKE' => "%{$val}%",
        //             'User.cedula LIKE' => "%{$val}%",
        //     ]];
        // }
        //pr($query);
        //$items = $this->User->find('all');
        //debug($items);
        // $log = $this->User->getDataSource()->getLog(false, false);
        //pr($log);
        //pr($query);
        // hacemos esto para obtener la cuenta total de registros filtrados
        //unset($query['offset'], $query['limit']);
        //$countFiltered = $this->User->find('count', $query);
        // cuenta total de registros, para informar al datatables
        //$countTotal = $this->User->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($query as $item => $value) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente
            // con el $_columnsMap
            //pr($value);
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $value['User']['Ids'],
                $value['User']['Apellidos'],
                $value['User']['Nombres'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $value['User']['Cedula'],
                $value['User']['Role'],
                $value['User']['Estatus']
            ];
        }
        //pr($data);
        $response = [
            'draw' => intval($this->request->query('draw')),
            //'recordsTotal' => $countTotal,
            //'recordsFiltered' => $countFiltered,
            'data' => $data
        ];
        $this->response->type('json');
        $this->response->body(json_encode($response));
        // pr($response);
        return $this->response;
    }

    public function ajax_search() {
        // acá hay que mapear la posición de la columna en la tabla con el campo que representa
        $_columnsMap = [
            // 0 => '' en este caso no tengo posición 0 porque esa columna se usa para mostrar las acciones y no datos
            0 => 'User.id',
            1 => 'User.apellidos',
            2 => 'User.nombres',
            3 => 'User.cedula',
            4 => 'User.created', // si consultamos sobre algun modelo relacionado
            5 => 'User.modified',
        ];

        // preparamos los parámetros de la consulta, esta parte depende de las necesidades de cada uno
        if ($this->Session->read('role') == 'superuser') {
            $query = [
                'fields' => [
                    'User.*'
                ],
                'recursive' => 3,
                'conditions' => [],
                'order' => [],
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => intval($this->request->query('start')), // start tiene la página
                'limit' => intval($this->request->query('length')), // length la cantidad de registros
            ];
        } else {
            $query = $this->User->lista(
                    intval($this->request->query('start')), intval($this->request->query('length')), array('User.id' => $this->Session->read('Auth.User.id')), "");
        }

        //debug($query);
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
                    'User.apellidos LIKE' => "%{$val}%",
                    'User.nombres LIKE' => "%{$val}%",
                    'User.cedula LIKE' => "%{$val}%",
            ]];
        }

        // busqueda por columna, ahora vamos a ver si hay criterios de búsqueda por cada columna en particular
        // esto es si se usaron los inputs de búsquedas de cada columna en particular
        $req_columns = $this->request->query('columns');
        if ($req_columns) {
            foreach ($req_columns as $column) {
                // busqueda
                if (!array_key_exists(intval($column['data']), $_columnsMap) ||
                        $column['searchable'] !== 'true' || empty($column['search']['value'])
                ) {
                    continue;
                }
                $colName = $_columnsMap[intval($column['data'])];
                $search = $column['search']['value'];
                // el modo de búsqueda dependerá de los tipos de datos y las necesidades de cada uno, adaptar a cada caso
                switch ($colName) {
                    case 'User.apellidos':
                        $query['conditions']['User.apellidos LIKE'] = "{$search}%";
                        break;
                    case 'User.nombres':
                        $query['conditions']['User.nombres LIKE'] = "{$search}%";
                        break;
                    case 'User.cedula':
                        $query['conditions']['User.cedula LIKE'] = "{$search}%";
                        break;
                }
            }
        }


        $items = $this->User->find('all', $query);
        //debug($items);
        //$log = $this->User->getDataSource()->getLog(false, false);
        //pr($log);
        // hacemos esto para obtener la cuenta total de registros filtrados
        unset($query['offset'], $query['limit']);
        $countFiltered = $this->User->find('count', $query);

        // cuenta total de registros, para informar al datatables
        $countTotal = $this->User->find('count', ['recursive' => -1]);
        $data = [];
        foreach ($items as $item) {
            // tenemos que armar los datos para enviarlos al datatables, es importante que coincida exactamente
            // con el $_columnsMap
            $data[] = [
                //'--', // primera columna, no la usamos para datos
                $item['User']['id'],
                $item['User']['apellidos'],
                $item['User']['nombres'],
                //number_format($item['Item']['campo_tres'], 0, ',', '.'), // si querés formatear algún campo, debe hacer aquí
                $item['User']['cedula'],
                $item['User']['created'],
                $item['User']['modified'],
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

    public function login() {
        if ($this->Session->read('Auth.User.id') != 0) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        $this->layout = "login_registro";
        if ($this->request->is('post')) {
            $d = $this->request->data;



            $du = $this->User->find('first', array('conditions' => array(
                    "User.username" => $d['User']['username'])));

            if (isset($du['User']['id'])) {
                if ($du['User']['borrado'] != "1") {

                    if ($du['User']['estatus'] == "Activo") {


                        if ($this->Auth->login()) {
                            $id = $this->Session->read('Auth.User.id');

                            $this->Session->write('role', $du['User']['role']);
                            $fecha = date("Y-m-d H:i:s");
                            //$this->User->id = $id;
                            $this->Login->set('user_id', $id);
                            $this->Login->set('ip', $this->capturarip());
                            if ($this->Login->save()) {
                                //$this->Login->set('user_id', $id);
                                $this->redirect($this->Auth->redirect());
                            }
                        } else {
                            $this->Session->setFlash(__($this->alertdanger('Usuario o Contraseña incorrecta')));
                            //$this->Flash->error(__('Usuario o Contraseña incorrecta'));
                        }
                    } else {
                        $this->Session->setFlash(__($this->alertdanger('Disculpa tu usuario esta bloqueado te invitamos a que te comuniques con el administrador del sistema')));
                    }
                } else {
                    $this->Session->setFlash(__($this->alertdanger('Disculpa este usuario a sido borrado por seguridad y no puedes usar este email, te invitamos a que te comuniques con el administrador del sistema')));
                }
            } else {
                $this->Session->setFlash(__($this->alertdanger('Disculpe este usuario no esta registrado en nuestro sistema')));
            }
        }
    }

    public function register() {
        if ($this->Session->read('Auth.User.id') != 0) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        $this->layout = "login_registro";
        if ($this->request->is('post')) {

            $d = $this->request->data;
            $this->User->create();
            if ($this->User->exists()) {
                throw new NotFoundException(__('Usuario ya en uso'));
            } else if ($d['User']['password'] != $d['User']['reppassword']) {
                $this->Session->setFlash(__($this->alertdanger('Disculpe las contraseñas no son iguales')));
            } else {

                $this->User->set('role', 'admin');
                $this->User->set('apellidos', $d['User']['apellidos']);
                $this->User->set('nombres', $d['User']['nombres']);
                $this->User->set('cedula', $d['User']['cedula']);

                $this->User->set('ip', $this->capturarip());
                if ($this->User->save($this->request->data)) {
                    $this->correo($d['User']['username'], 'Bienvenido a nuestra pagina ', array('username' => $d['User']['username'],
                        'password' => $d['User']['password']), 'registro');

                    $this->Session->setFlash(__($this->alertsuccess('Registro Ingresado Con Exito')));
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                } else {
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo guardar el usuario.')));
                }
            }
        }
    }

    public function index() {
        //$this->layout = "admin";
    }

    public function add() {


        //Busco la lista de paises registrados para llenar los select
        $countries = $this->Country->find('list', array('fields' => 'Country.nombre', 'order' => 'Country.nombre'));
        $this->set('countries', $countries);

        //Busco la lista de estados registrados para llenar los select
        $states = $this->State->find('list', array('fields' => 'State.nombre', 'order' => 'State.nombre'));
        $this->set('states', $states);

        //Busco la lista de municipios registrados para llenar los select
        $municipalities = $this->Municipality->find('list', array('fields' => 'Municipality.nombre', 'order' => 'Municipality.nombre'));
        $this->set('municipalities', $municipalities);

        //Listado de empresas registradas por el usuario
        $query = $this->Office->listadoOfficesUsers($this->Session->read('Auth.User.id'), $this->Session->read('role'));
        $items = $this->Office->query($query);

        $this->set('oficinas', $items);

        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;

                $Transaccion = $this->User->getDataSource();
                $Transaccion->begin();

                //$this->User->id /=; //$perfil['Profile']['id'];
                $this->User->set('cedula', $d['User']['cedula']);
                $this->User->set('apellidos', ucwords($d['User']['apellidos']));
                $this->User->set('nombres', ucwords($d['User']['nombres']));
                $this->User->set('sexo', $d['User']['sexo']);
                $this->User->set('userlogid', $this->Session->read('Auth.User.id'));

                $this->User->set('direccion', $d['User']['direccion']);
                $this->User->set('municipality_id', $d['User']['municipality_id']);
                $this->User->set('cargo', $d['User']['cargo']);
                $this->User->set('telefono', $d['User']['telefono']);
                $this->User->set('tipo_legal', $d['User']['tipo_legal']);


                $this->User->set('username', $d['User']['username']);

                if ($d['User']['passwordnuevo'] == null && $d['User']['reppassword'] == null) {
                    $this->Session->setFlash(__($this->alertdanger('Error las contraseñas no pueden estar en blanco.')));
                    return;
                    //$this->User->set('password', $d['User']['passwordactual']);
                } else {
                    if ($d['User']['passwordnuevo'] != $d['User']['reppassword']) {
                        $this->Session->setFlash(__($this->alertdanger('Error las contraseñas no son iguales.')));
                        return;
                    } else {
                        $this->User->set('password', $d['User']['passwordnuevo']);
                    }
                }

                $this->User->set('role', $d['User']['role']);
                $this->User->set('estatus', $d['User']['estatus']);

                if ($d['User']['image']['name'] != '') {

                    if ($this->validarImagen($d['User']['image']) == false) {

                        if ($d['User']['image']['name'] != "") {

                            $im = $this->subirImagen($d['User']['image'], 'users');
                            //pr($im);
                            $this->User->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }

                if ($this->User->validates()) {
                    if ($this->User->save($d)) {

                        if (isset($d['ofiid'])) {
                            $check = $d['ofiid'];
                            $contador = count($check);

                            for ($i = 0; $i < $contador; $i++) {
                                $posicion = $check[$i];

                                $this->OfficeUser->create(array('office_id' => $posicion, 'user_id' => $this->User->id));

                                $this->OfficeUser->save($d);
                            }
                        }
                        $swtransaccion = 1;
                        $this->correo($d['User']['username'], 'Bienvenido a nuestra pagina ', array('username' => $d['User']['username'],
                            'password' => $d['User']['passwordnuevo']), 'registro');
                    }
                }


                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo Registrar el usuario verifique la información.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Usuario Registrado Con Exito')));

                    $this->redirect('index');
                } //SI
            }
        } catch (Exception $ex) {
            
        }
    }

    public function edit($id = null) {
        $id_user = $this->Session->read('Auth.User.id');

        if ($this->Session->read('role') != 'superuser') {
            if (!$this->oficinauser($id)) {
                $this->redirect('index');
            }
        }
        $datos = $this->User->datos($id);
        if (empty($datos)) {
            $this->redirect('index');
        }
        $this->set('usuario', $datos);

        //Busco la lista de paises registrados para llenar los select
        $countries = $this->Country->find('list', array('fields' => 'Country.nombre', 'order' => 'Country.nombre'));
        $this->set('countries', $countries);

        //Busco la lista de estados registrados para llenar los select
        $states = $this->State->find('list', array('fields' => 'State.nombre', 'order' => 'State.nombre'));
        $this->set('states', $states);

        //Busco la lista de municipios registrados para llenar los select
        $municipalities = $this->Municipality->find('list', array('fields' => 'Municipality.nombre', 'order' => 'Municipality.nombre'));
        $this->set('municipalities', $municipalities);

        //Listado de empresas registradas y no asignadas a el usuario
        $query = $this->Office->listadoUsersEdit($id, $this->Session->read('Auth.User.id'), $this->Session->read('role'));
        $items = $this->Office->query($query);
        $this->set('oficinas', $items);
        //Listado de empresas asignadas
        $querysi = $this->Office->listadoOfficesUsersEditAsignadas($id, $this->Session->read('role'));
        $itemssi = $this->Office->query($querysi);
        $this->set('oficinassi', $itemssi);



        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;
                //pr($d);
                //die();
                $Transaccion = $this->User->getDataSource();
                $Transaccion->begin();

                $this->User->id = $id; //$perfil['Profile']['id'];
                $this->User->set('cedula', $d['User']['cedula']);
                $this->User->set('apellidos', ucwords($d['User']['apellidos']));
                $this->User->set('nombres', ucwords($d['User']['nombres']));
                $this->User->set('sexo', $d['User']['sexo']);
                $this->User->set('userlogid', $this->Session->read('Auth.User.id'));

                $this->User->set('direccion', $d['User']['direccion']);
                $this->User->set('municipality_id', $d['User']['municipality_id']);
                $this->User->set('cargo', $d['User']['cargo']);
                $this->User->set('telefono', $d['User']['telefono']);
                $this->User->set('tipo_legal', $d['User']['tipo_legal']);


                $this->User->set('usuario', $d['User']['username']);

                if ($d['User']['passwordnuevo'] == null && $d['User']['reppassword'] == null) {
                    //$this->User->set('password', $d['User']['passwordactual']);
                } else {
                    if ($d['User']['passwordnuevo'] != $d['User']['reppassword']) {
                        $this->Session->setFlash(__($this->alertdanger('Error las contraseñas no son iguales.')));
                        return;
                    } else {
                        $this->User->set('password', $d['User']['passwordnuevo']);
                    }
                }

                $this->User->set('role', $d['User']['role']);
                $this->User->set('estatus', $d['User']['estatus']);

                if ($d['User']['image']['name'] != '') {

                    if ($this->validarImagen($d['User']['image']) == false) {

                        if ($d['User']['image']['name'] != "") {

                            $im = $this->subirImagen($d['User']['image'], 'users');
                            //pr($im);
                            $this->borrarImagenPc($datos['User']['imagen'], 'users');
                            $this->User->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }

                if ($this->User->validates()) {
                    if ($this->User->save($d)) {

                        //valido si la variable tiene valores del listado de oficinas no asigndas
                        if (isset($d['ofiid'])) {
                            $check = $d['ofiid'];
                            $contador = count($check);

                            for ($i = 0; $i < $contador; $i++) {
                                $posicion = $check[$i];

                                $this->OfficeUser->create(array('office_id' => $posicion, 'user_id' => $this->User->id));
                                $this->OfficeUser->save($d);
                            }
                        }
                        //valido si la variable tiene valores del listado de oficinas asigndas
                        if (isset($d['ofiidsi'])) {
                            $check = $d['ofiidsi'];
                            $contador = count($check);

                            for ($i = 0; $i < $contador; $i++) {
                                $posicion = $check[$i];
                                $this->OfficeUser->delete($posicion);
                            }
                        }
                        $swtransaccion = 1;
                        $this->correo($d['User']['username'], 'Actualización de datos ', array('username' => $d['User']['username'],
                            'password' => $d['User']['passwordnuevo']), 'edit');
                    }
                }



                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Datos Actualizados Con Exito')));

                    $this->redirect('index');
                } //SI
            }
        } catch (Exception $ex) {
            
        }
    }

    public function logout() {

        //$this->User->query('Update users set estatus=0 where id='.$this->Auth->user('id'));
        //$this->Hybridauth->logout();
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null) {
        if (isset($this->params['requested'])) {

            $dato = $this->User->datos($id);
            if (!empty($dato)) {
                return $dato;
            } else {
                $this->redirect(array('controller' => 'dashboard', 'action' => 'home'));
            }
        } else {
            if ($this->Session->read('role') != 'superuser') {
                if (!$this->oficinauser($id)) {
                    $this->redirect('index');
                }
            }
            $dato = $this->User->datos($id);
            if (empty($dato)) {
                $this->redirect('index');
            }
            $this->set('datos', $dato);
            //Listado de empresas registradas por el usuario
            $query = $this->Office->listadoOfficesUsersView($id, $this->Session->read('role'));
            $items = $this->Office->query($query);
            $this->set('items', $items);
            pr($items);
            //listado de ingresos al sistema
            $logins = $this->Login->find('all', array('conditions' => 'Login.user_id=' . $id, 'limit' => 30, 'order' => 'created DESC'));
            $this->set('logins', $logins);
            $lastlogin = $this->Login->find('first', array('conditions' => 'Login.user_id=' . $id, 'order' => 'created DESC'));
            $this->set('lastlogin', $lastlogin);
        }
    }

    public function profile() {
        $id = $this->Session->read('Auth.User.id');
        $dato = $this->User->datos($id);
        if (empty($dato)) {
            $this->redirect('index');
        }
        $this->set('datos', $dato);
        //Listado de empresas registradas por el usuario
        $query = $this->Office->listadoOfficesUsersView($id, $this->Session->read('role'));
        $items = $this->Office->query($query);
        $this->set('oficinas', $items);
        //pr($items);
        //listado de ingresos al sistema
        $logins = $this->Login->find('all', array('conditions' => 'Login.user_id=' . $id, 'limit' => 30, 'order' => 'created DESC'));
        $this->set('logins', $logins);
        $lastlogin = $this->Login->find('first', array('conditions' => 'Login.user_id=' . $id, 'order' => 'created DESC'));
        $this->set('lastlogin', $lastlogin);

        $start_date = date('2020-02-01'); //should be in YYYY-MM-DD format
        $services = $this->Service->find('all', array('conditions' => array('Service.created >= date_sub(curdate(), interval 2 day)')));
        //pr($services);
        //busco detalles de servicios para las ultimas actividades
        //$datos = $this->Service->find('all',array('conditions'=>'User.id='.$id,''));
        $this->set('services', $services);
        $estatus_servicios = $this->ServiceStatu->find('all', array(
            'conditions' => array('ServiceStatu.created >= date_sub(curdate(), interval 2 day)'),
            'joins' => array(
                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
            )
                )
        );
        //$listado_articulos = $this->ArticleService->listadoArticleService($id);
        $this->set('estatus_servicios', $estatus_servicios);
    }

    public function edit_profile() {
        //$this->layout = "admin";
        $id = $this->Session->read('Auth.User.id');
        $datos = $this->User->datos($id);
        if (empty($datos)) {
            $this->redirect('index');
        }
        $this->set('usuario', $datos);

        //Busco la lista de paises registrados para llenar los select
        $countries = $this->Country->find('list', array('fields' => 'Country.nombre', 'order' => 'Country.nombre'));
        $this->set('countries', $countries);

        //Busco la lista de estados registrados para llenar los select
        $states = $this->State->find('list', array('fields' => 'State.nombre', 'order' => 'State.nombre'));
        $this->set('states', $states);

        //Busco la lista de municipios registrados para llenar los select
        $municipalities = $this->Municipality->find('list', array('fields' => 'Municipality.nombre', 'order' => 'Municipality.nombre'));
        $this->set('municipalities', $municipalities);



        try {
            if ($this->request->is(array('post', 'put'))) {
                $swtransaccion = 0;
                $d = $this->request->data;
                //pr($d);
                //die();
                $Transaccion = $this->User->getDataSource();
                $Transaccion->begin();

                $this->User->id = $id; //$perfil['Profile']['id'];
                $this->User->set('cedula', $d['User']['cedula']);
                $this->User->set('apellidos', ucwords($d['User']['apellidos']));
                $this->User->set('nombres', ucwords($d['User']['nombres']));
                $this->User->set('sexo', $d['User']['sexo']);
                $this->User->set('userlogid', $this->Session->read('Auth.User.id'));

                $this->User->set('direccion', $d['User']['direccion']);
                $this->User->set('municipality_id', $d['User']['municipality_id']);
                $this->User->set('cargo', $d['User']['cargo']);
                $this->User->set('telefono', $d['User']['telefono']);
                $this->User->set('tipo_legal', $d['User']['tipo_legal']);


                $this->User->set('usuario', $d['User']['username']);
                $this->User->set('role', $this->Session->read('role'));
                $this->User->set('estatus', 'Activo');
                if ($d['User']['passwordnuevo'] == null && $d['User']['reppassword'] == null) {
                    //$this->User->set('password', $d['User']['passwordactual']);
                } else {
                    if ($d['User']['passwordnuevo'] != $d['User']['reppassword']) {
                        $this->Session->setFlash(__($this->alertdanger('Error las contraseñas no son iguales.')));
                        return;
                    } else {
                        $this->User->set('password', $d['User']['passwordnuevo']);
                    }
                }

                if ($d['User']['image']['name'] != '') {

                    if ($this->validarImagen($d['User']['image']) == false) {

                        if ($d['User']['image']['name'] != "") {

                            $im = $this->subirImagen($d['User']['image'], 'users');
                            //pr($im);
                            $this->borrarImagenPc($datos['User']['imagen'], 'users');
                            $this->User->set('imagen', $im);
                        }
                    } else {
                        return;
                    }
                }

                if ($this->User->validates()) {
                    if ($this->User->save($d)) {


                        $swtransaccion = 1;
//                        $this->correo($d['User']['username'], 'Actualización de datos ', array('username' => $d['User']['username'],
//                            'password' => $d['User']['passwordnuevo']), 'edit');
                    }
                }



                if ($swtransaccion == 0) {
                    $Transaccion->rollback();
                    $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                } else {
                    $Transaccion->commit();
                    $this->Session->setFlash(__($this->alertsuccess('Datos Actualizados Con Exito')));

                    $this->redirect('profile');
                } //SI
            }
        } catch (Exception $ex) {
            
        }
    }

    public function recover() {
        if ($this->Session->read('Auth.User.id') != 0) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        $this->layout = "login_registro";
        try {
            if ($this->request->is(array('post', 'put'))) {
                $d = $this->request->data;
                $datos = $this->User->find('first', array('conditions' => array('username' => $d['User']['username'])));

                if ($datos) {
                    $swtransaccion = 0;
                    $d = $this->request->data;

                    $Transaccion = $this->User->getDataSource();
                    $Transaccion->begin();

                    $this->User->id = $datos['User']['id'];
                    $pass = rand(000000, 100000);

                    $this->User->set('password', $pass);

                    if ($this->User->save($d)) {


                        $swtransaccion = 1;
                        $this->correo($d['User']['username'], 'Solicitud recuperacion de datos', array('username' => $datos['User']['username'],
                            'password' => $pass), 'recover');
                    }

                    if ($swtransaccion == 0) {
                        $Transaccion->rollback();
                        $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar sus datos.')));
                    } else {
                        $Transaccion->commit();
                        $this->Session->setFlash(__($this->alertsuccess('Datos actualizados, por favor verifique su email')));

                        $this->redirect('login');
                    }
                } else {
                    $this->Session->setFlash(__($this->alertdanger('Error usuario no registrado, verifique su email.')));
                }
            }
        } catch (Exception $ex) {
            
        }
    }

    public function estatus($id = null) {
        if ($this->Session->read('role') != 'superuser') {
            $this->redirect('index');
        } else {
            $user = $this->User->find('first', array('conditions' => 'User.id=' . $id));
            //
            $this->set('datos', $user);
            try {
                if ($this->request->is(array('post', 'put'))) {
                    $swtransaccion = 0;
                    $d = $this->request->data;
                    
                    //die();
                    $Transaccion = $this->User->getDataSource();
                    $Transaccion->begin();

                    $this->User->id = $id; //$perfil['Profile']['id'];

                    $this->User->set('estatus', $d['User']['estatus']);



                    if ($this->User->save($d)) {
pr($d);
                        //valido si la variable tiene valores del listado de oficinas no asigndas

                        $swtransaccion = 1;
                        $this->correo($user['User']['username'], 'Activación/Bloqueo de usuario', array('estatus' => $d['User']['estatus']), 'estatus');
                    }




                    if ($swtransaccion == 0) {
                        $Transaccion->rollback();
                        $this->Session->setFlash(__($this->alertdanger('Error no se pudo actualizar los datos.')));
                    } else {
                        $Transaccion->commit();
                        $this->Session->setFlash(__($this->alertsuccess('Usuario Actualizados Con Exito')));

                        $this->redirect('index');
                    } //SI
                }
            } catch (Exception $ex) {
                //pr($ex);
            }
        }
    }

}

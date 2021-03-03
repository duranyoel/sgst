<?php

App::uses('AppController', 'Controller');

/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 */
class LocationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

//    public function beforeFilter() {
//        parent::beforeFilter();
//        $this->Auth->allow('index', 'view', 'delete', 'add','getByMunicipios');
//    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->layout = "default1";
         if ($this->request->is('post') && !empty($this->data["buscar"])) {

            $bus = $this->data["buscar"];
            $this->Location->recursive = 0;
            $this->paginate['Location']['limit'] = 50;
            $this->Paginator->settings = $this->paginate;

             $this->set('locations', $this->Paginator->paginate(
                            'Location', "Location.nombre LIKE '%" . trim($bus) . "%' OR "
                            . "Municipality.nombre LIKE '%" . trim($bus) . "%'"
                        )
                    );
           
        } else {
            if($id = $this->Session->read('role')!='admin'){
                $this->redirect(array('controller'=>'pages','action' => 'index'));
            }
            $this->Location->recursive = 0;
            $this->paginate['Location']['limit'] = 50;
            $this->Paginator->settings = $this->paginate;
            $this->set('locations', $this->Paginator->paginate());
            
        }
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->layout = "default1";
        if (!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
        $this->set('location', $this->Location->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->layout = "default1";
        if ($this->request->is('post')) {
            $this->Location->create();
            if ($this->Location->save($this->request->data)) {
                $this->Flash->success(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The location could not be saved. Please, try again.'));
            }
        }
        $municipalities = $this->Location->Municipality->find('list',array('order'=>'Municipality.nombre'));
        $this->set(compact('municipalities'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->layout = "default1";
        if (!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Location->save($this->request->data)) {
                $this->Flash->success(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The location could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
            $this->request->data = $this->Location->find('first', $options);
        }
        $municipalities = $this->Location->Municipality->find('list',array('order'=>'Municipality.nombre'));
        $this->set(compact('municipalities'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Location->id = $id;
        if (!$this->Location->exists()) {
            throw new NotFoundException(__('Invalid location'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Location->delete()) {
            $this->Flash->success(__('The location has been deleted.'));
        } else {
            $this->Flash->error(__('The location could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

public function getByMunicipios() {

        if ($this->request->data['User']['municipalities']) {
            $municipio_id = $this->request->data['User']['municipalities'];
        } 


        $parroquias = $this->Location->find('list', array(
            'conditions' => array('municipality_id' => $municipio_id),
            'recursive' => -1, 'fields' => 'id,nombre'
        ));

        $this->set('locations', $parroquias);
        $this->layout = 'ajax';
    }
    
}

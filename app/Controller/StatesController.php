<?php

App::uses('AppController', 'Controller');

/**
 * States Controller
 *
 * @property State $State
 * @property PaginatorComponent $Paginator
 */
class StatesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        //$this->layout = "default1";
         if ($this->request->is('post') && !empty($this->data["buscar"])) {

            $bus = $this->data["buscar"];
            $this->State->recursive = 0;
            $this->paginate['State']['limit'] = 100;
            $this->Paginator->settings = $this->paginate;

             $this->set('states', $this->Paginator->paginate(
                            'State', "State.nombre LIKE '%" . trim($bus) . "%' OR "
                     . "Country.nombre LIKE '%" . trim($bus) . "%'"
                           
                        )
                    );
           
        } else {
            if($id = $this->Session->read('role')!='admin'){
                $this->redirect(array('controller'=>'pages','action' => 'index'));
            }
            $this->State->recursive = 0;
            $this->paginate['State']['limit'] = 30;
            $this->Paginator->settings = $this->paginate;
            $this->set('states', $this->Paginator->paginate());
            
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
        //$this->layout = "default1";
        if (!$this->State->exists($id)) {
            throw new NotFoundException(__('Invalid state'));
        }
        $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
        $this->set('state', $this->State->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        //$this->layout = "default1";
        if ($this->request->is('post')) {
            $this->State->create();
            if ($this->State->save($this->request->data)) {
                $this->Flash->success(__('The state has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $countries = $this->State->Country->find('list',array('order'=>'Country.nombre'));
        $this->set(compact('countries'));
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
        if (!$this->State->exists($id)) {
            throw new NotFoundException(__('Invalid state'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->State->save($this->request->data)) {
                $this->Flash->success(__('The state has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
            $this->request->data = $this->State->find('first', $options);
        }
        $countries = $this->State->Country->find('list',array('order'=>'Country.nombre'));
        $this->set(compact('countries'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->State->id = $id;
        if (!$this->State->exists()) {
            throw new NotFoundException(__('Invalid state'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->State->delete()) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    public function getByCountries() {

        if ($this->request->data['User']['countries']) {
            $countries = $this->request->data['User']['countries'];
        }



        $states = $this->State->find('list', array(
            'conditions' => array('country_id' => $countries),
            'recursive' => -1, 'fields' => 'id,nombre'
        ));

        $this->set('states', $states);
        $this->layout = 'ajax';
    }
}

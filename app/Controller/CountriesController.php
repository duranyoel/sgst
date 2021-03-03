<?php

App::uses('AppController', 'Controller');

/**
 * Countries Controller
 *
 * @property Country $Country
 * @property PaginatorComponent $Paginator
 */
class CountriesController extends AppController {

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
        $this->layout = "default1";
        if ($this->request->is('post') && !empty($this->data["buscar"])) {

            $bus = $this->data["buscar"];
            $this->Country->recursive = 0;
            $this->paginate['Country']['limit'] = 130;
            $this->Paginator->settings = $this->paginate;

             $this->set('countries', $this->Paginator->paginate(
                            'Country', "Country.nombre LIKE '%" . trim($bus) . "%'"
                           
                        )
                    );
           
        } else {
            if($id = $this->Session->read('role')!='admin'){
                $this->redirect(array('controller'=>'pages','action' => 'index'));
            }
            $this->Country->recursive = 0;
            $this->paginate['Country']['limit'] = 30;
            $this->Paginator->settings = $this->paginate;
            $this->set('countries', $this->Paginator->paginate());
            
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
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
        $this->set('country', $this->Country->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->layout = "default1";
        if ($this->request->is('post')) {
            $this->Country->create();
            if ($this->Country->save($this->request->data)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
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
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Country->save($this->request->data)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
            $this->request->data = $this->Country->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Country->id = $id;
        if (!$this->Country->exists()) {
            throw new NotFoundException(__('Invalid country'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Country->delete()) {
            $this->Flash->success(__('The country has been deleted.'));
        } else {
            $this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}

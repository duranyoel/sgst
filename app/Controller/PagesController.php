<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP FrontsController
 * @author yoelduran
 */
class PagesController extends AppController {

    public function index($id) {
        $this->redirect('home');
    }

    public function home() {
        $this->layout = "front";
        if ($this->request->is(array('post', 'put'))) {
            $d = $this->request->data;
             $this->correo('yoelduran25@gmail.com', $d['Pages']['asunto'], 
                    array(
                        'nombres' => $d['Pages']['nombres'],
                        'apellidos' => $d['Pages']['apellidos'],
                        'email' => $d['Pages']['email'],
                        'telefono' => $d['Pages']['telefono'],
                        'asunto' => $d['Pages']['asunto'],

                        'mensaje' => $d['Pages']['mensaje']
                    ), 
                    'contacto');
        }
    }

    public function listar() {
        if ($this->request->is('post')) {
            $codigo = $this->request->data['Pages']['codigo'];
            //pr($this->request->data);
            $datos = $this->ServiceStatu->find('all', array('conditions' => array('Service.codigo' => $codigo)));
            //pr($datos);
            $this->set('datos', $datos);
        }
    }
    
    public function manual() {
        
    }
}

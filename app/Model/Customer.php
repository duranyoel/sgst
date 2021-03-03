<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Customer
 * @author yoelduran
 */
class Customer extends AppModel {
    public $name = 'Customer';
    
    public $useTable = "customers";

    public $validate = array(
        'cedula' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Cedula Requerido'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'on' => array('create', 'update'),
                'message' => 'Cliente ya existe'
            )
        ),
        'nombres' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Nombres Requerida'
            )
        ),
        'apellidos' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Apellidos Requerida'
            )
        )
    );
    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Customer.*'
            ),
            'recursive' => 0,
                'conditions' => $conditions,
                'order' => $order,
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => $offset, // start tiene la página
                'limit' => $limit, // length la cantidad de 
                
                
            );
        return $query;

    }
    
}

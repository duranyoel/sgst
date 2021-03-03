<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Model
 * @author yoelduran
 */
class Pattern extends AppModel {
    
    public $name = 'Pattern';
    public $useTable = "models";
    public $belongsTo = array(
        'Trademark' => array(
            'className' => 'Trademark',
            'foreignKey' => 'trademark_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $validate = array(
        'nombre' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Nombre Requerido'
            )
        ),
        'descripcion' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Descripción Requerida'
            )
        )
    );
    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Pattern.*', 'Trademark.*'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            //'group'=>array('User.id'),
            'joins' => array(
                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                //array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
            //array('table' => 'offices', 'alias' => 'Office', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
            )
        );
        return $query;
    }
}

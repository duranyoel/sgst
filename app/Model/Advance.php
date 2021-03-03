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
class Advance extends AppModel {

    public $name = 'Advance';
    public $useTable = "advances";
    public $belongsTo = array(
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $validate = array(
        'service_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Requerido'
            )
        ),
        'monto' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Requerida'
            )
        )
    );
    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Advance.*', 'Service.*'
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
                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
            //array('table' => 'offices', 'alias' => 'Office', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
            )
        );
        return $query;
    }
    public function listaRoleUser($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Advance.*', 'Service.*'
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
                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
            )
        );
        return $query;
    }

    public function sumTotales($id = null) {
        $query = "SELECT SUM(monto) AS Total FROM `advances` WHERE service_id=" . $id . "";
        return $query;
    }

}

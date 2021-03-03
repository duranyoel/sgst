<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ServiceStatu
 * @author yoelduran
 */
class ServiceStatu extends AppModel {
    public $name = 'ServiceStatu';
    public $useTable = "service_status";
    
    public $belongsTo = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
        public function listadoRoleSuperUser($offset = "", $limit = "", $conditions = array(), $order = array()) {
            $query = array(
            'fields' => array(
                'ServiceStatu.*', 'Service.*','User.*'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            //'group' => array('Service.id'),
                
            'joins' => array(

                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                //array('table' => 'municipalities', 'alias' => 'Municipality', 'type' => 'LEFT', 'conditions' => array('Municipality.id = User.municipality_id')),
                //array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                //array('table' => 'countries', 'alias' => 'Country', 'type' => 'LEFT', 'conditions' => array('Country.id = State.country_id')),
            ),
            
        );
        return $query;
        }
        public function listadoRoleAdmin($offset = "", $limit = "", $conditions = array(), $order = array()) {
            $query = array(
            'fields' => array(
                'ServiceStatu.*', 'Service.*','User.*'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            //'group' => array('Service.id'),
                
            'joins' => array(
                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
            ),
            
        );
        return $query;
        }
        public function listadoRoleUser($offset = "", $limit = "", $conditions = array(), $order = array()) {
            $query = array(
            'fields' => array(
                'ServiceStatu.*', 'Service.*','User.*'
            ),
            'recursive' => 3,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            //'group' => array('Service.id'),
                
            'joins' => array(

                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                //array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                //array('table' => 'countries', 'alias' => 'Country', 'type' => 'LEFT', 'conditions' => array('Country.id = State.country_id')),
            ),
            
        );
        return $query;
        }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Service
 * @author yoelduran
 */
class Service extends AppModel {

    public $name = 'Service';
    public $useTable = "services";

    public $belongsTo = array(
		'Office' => array(
			'className' => 'Office',
			'foreignKey' => 'office_id',
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
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public $hasMany = "ServiceStatu";
    //public $hasManyAndBelongsTo='User';

    public $validate = array(
        'nombre' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Nombre Requerido'
            )
        ),
        'office_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => ' Requerida'
            )
        ),
        'fecha_recibido' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => ' Requerida'
            )
        ),
        'fecha_entrega' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => ' Requerida'
            )
        ),
        'costo_servicio' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => ' Requerida'
            )
        ),
        'codigo' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Codigo Requerido'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'on' => array('create', 'update'),
                'message' => 'Codigo ya existe'
            )
        ),
    );
    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Service.*', 'Customer.*','Office.nombre'
            ),
            'recursive' => 2,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            'group' => array('Service.id'),
            'joins' => array(

                array('table' => 'service_status', 'alias' => 'ServiceStatu', 'type' => 'INNER', 'conditions' => array('Service.id = ServiceStatu.service_id')),
                
            ),
            
        );
        return $query;
    }
    public function listaReparados($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Service.*', 'Customer.*','Office.nombre'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            'group' => array('Service.id'),
            'joins' => array(

                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                array('table' => 'service_status', 'alias' => 'ServiceStatu', 'type' => 'LEFT', 'conditions' => array('Service.id = ServiceStatu.service_id')),
            ),
            
        );
        return $query;
    }
    public function listaRoleUserReparados($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Service.*', 'Customer.*','Office.nombre'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            'group' => array('Service.id'),
            'joins' => array(

                array('table' => 'service_status', 'alias' => 'ServiceStatu', 'type' => 'LEFT', 'conditions' => array('Service.id = ServiceStatu.service_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
            ),
            
        );
        return $query;
    }
    public function listaSuper($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Service.*', 'Customer.*','Office.nombre'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            'group' => array('Service.id'),
            
        );
        return $query;
    }
    
    public function listaRoleUser($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Service.*', 'Customer.*','Office.nombre'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de 
            'group' => array('Service.id'),
            'joins' => array(

                array('table' => 'service_status', 'alias' => 'ServiceStatu', 'type' => 'LEFT', 'conditions' => array('Service.id = ServiceStatu.service_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                //array('table' => 'countries', 'alias' => 'Country', 'type' => 'LEFT', 'conditions' => array('Country.id = State.country_id')),
            ),
            
        );
        return $query;
    }

    public function detallesServicio($id) {
        $query = $this->find(
                'first', array(
                    'conditions'=>array('Service.id'=>$id),
                    'recursive'=>3
                )
        );

       
        return $query;
    }
    public function gaficaOrdenes() {
        $query = array(
            'fields' => array(
                'Service.id,Service.fecha_recibido,costo_servicio',
            ),
            'recursive' => 0,
            //'conditions' => $conditions,
            
            //'group' => array('Service.fecha_recibido'),
            
        );

       
        return $query;
    }
    public function listadoServiciosXUsuario($user_id=null) {
        $query=  $this->find('all'
                ,array(
                    'fields'=>array('Service.nombre'),
                    'conditions'=>array('Office.user_id'=>$user_id),
                    'recursive'=>0
                ));
        return $query;
        
    }

}

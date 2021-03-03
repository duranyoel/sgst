<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Article
 * @author yoelduran
 */
class Article extends AppModel {
    public $name = 'Article';
    public $useTable = "articles";
    public $belongsTo = array(
        'Office' => array(
            'className' => 'Office',
            'foreignKey' => 'office_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Pattern' => array(
            'className' => 'Pattern',
            'foreignKey' => 'model_id',
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
                'Article.*', 'Pattern.*'
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
    
     public function buscararticulos($nombre,$id_user) {
           $query = $this->find('first',array
                   (
                   'fields'=>array
                       (
                       'Article.id',
                       'Article.nombre',
                       'Article.codigo',
                       'Article.costo'
                       ),
                    'conditions'=>array("(Article.nombre LIKE '%".$nombre."%' OR Article.codigo LIKE '%".$nombre."%')",
                        '(Office.user_id='.$id_user.' OR OfficeUser.user_id='.$id_user.')'),
                    'recursive'=>0,
                    'joins' => array(

                //array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('Office.id = Service.office_id')),
                        array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                        //array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                        //array('table' => 'countries', 'alias' => 'Country', 'type' => 'LEFT', 'conditions' => array('Country.id = State.country_id')),
                    ),
                ));
                
            return $query; 
            //pr($query);
        }
}

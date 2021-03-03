<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ArticleService
 * @author yoelduran
 */
class ArticleService extends AppModel {

    public $name = 'ArticleService';
    public $useTable = "article_service";
    public $belongsTo = array(
        'Article' => array(
            'className' => 'Article',
            'foreignKey' => 'article_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public function listadoArticleService($id=null) {
        $query=  $this->find('all'
                ,array(
                    'conditions'=>array('ArticleService.service_id'=>$id),
                    'recursive'=>3
                ));
        return $query;
        
    }
    
    public function sumTotales($id = null) {
        $query = "SELECT SUM(costo) AS Total FROM `article_service` WHERE service_id=" . $id . "";
        return $query;
    }


}

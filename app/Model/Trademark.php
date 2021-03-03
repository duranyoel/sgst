<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Trademark
 * @author yoelduran
 */
class Trademark extends AppModel {
    public $name = 'Trademark';
    public $useTable = "trademarks";
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
}
?>
<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $name = 'User';
    public $useTable = "users";
    //public $hasMany = array("Office");


    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Email Requerido'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'on' => array('create', 'update'),
                'message' => 'Usuario ya existe'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Contraseña Requerida'
            )
        )
    );

    public function beforeSave($options = null) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

  
    public function datos($id = null) {

        $datos = $this->find('first', array(
            'fields' => array(
                'User.*',
                'State.nombre',
                'Municipality.nombre',
                'Country.nombre',
                'Country.id',
                'State.id',
                'Municipality.id',
            ),
            'joins' => array(
                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                array('table' => 'municipalities', 'alias' => 'Municipality', 'type' => 'LEFT', 'conditions' => array('Municipality.id = User.municipality_id')),
                array('table' => 'states', 'alias' => 'State', 'type' => 'LEFT', 'conditions' => array('State.id = Municipality.state_id')),
                array('table' => 'countries', 'alias' => 'Country', 'type' => 'LEFT', 'conditions' => array('Country.id = State.country_id')),
            ),
            'recursive' => 3,
            'conditions' => array('User.id' => $id, 'User.borrado' => 0)
        ));

        return $datos;
    }

    //Listado de usuarios con oficinas en ajax
    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'User.*'
            ),
            'recursive' => 0,
            'conditions' => $conditions,
            'order' => $order,
            // datatables manda los parámetros de página y cantidad de registros en el query: start y length
            'offset' => $offset, // start tiene la página
            'limit' => $limit, // length la cantidad de
            'group' => array('User.id'),
            'joins' => array(
                array('table' => 'offices', 'alias' => 'Office', 'type' => 'LEFT', 'conditions' => array('User.id = Office.user_id')),
                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
            )
        );
        return $query;
    }

    public function listadoUsersIndex($iduser) {
        //pr($role);
        $query = "SELECT
                    User.id as Ids,
                    User.cedula as Cedula,
                    User.apellidos as Apellidos,
                    User.nombres AS Nombres,
                    User.role AS Role,
                    User.estatus as Estatus
                    FROM
                    users as User
                    INNER JOIN offices_users AS OfficeUser ON User.id = OfficeUser.user_id
                    INNER JOIN offices AS Office ON Office.id = OfficeUser.office_id
                    WHERE Office.user_id=" . $iduser . "
                    GROUP BY User.id";
        return $query;
    }

}

?>

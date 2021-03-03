<?php



class Office extends AppModel {

    public $name = 'Office';

    public $useTable = "offices";
    //public $hasMany = "User";
    //public $hasMany = "OfficeUser";
    public $hasManyAndBelongsTo=array('User','Office');
    public $belongsTo = array(

		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
    );

    public function lista($offset = "", $limit = "", $conditions = array(), $order = array()) {
        $query = array(
            'fields' => array(
                'Office.*'
            ),
            'recursive' => 0,
                'conditions' => $conditions,
                'order' => $order,
                // datatables manda los parámetros de página y cantidad de registros en el query: start y length
                'offset' => $offset, // start tiene la página
                'limit' => $limit, // length la cantidad de
                'group'=>array('Office.id'),
                'joins' => array(

                //array('table' => 'locations', 'alias' => 'Location', 'type' => 'LEFT', 'conditions' => array('Location.id = User.location_id')),
                array('table' => 'offices_users', 'alias' => 'OfficeUser', 'type' => 'LEFT', 'conditions' => array('Office.id = OfficeUser.office_id')),
                //array('table' => 'offices', 'alias' => 'Office', 'type' => 'INNER', 'conditions' => array('Office.id = OfficeUser.office_id')),
                )

            );

        return $query;

    }
    public function listadoOfficesUsers($iduser)
    {
        //pr($role);
        $query = "SELECT
                            Office.id as Ids,
                            Office.nombre as Nombre,
                            Office.telefono as Telefono,
                            Office.direccion AS Direccion,
                            Office.created as Creado,
                            Office.modified as Modificado

                        FROM
                            offices AS Office

                         

                            WHERE Office.user_id =".$iduser."

                            Group By Office.id
                        UNION

                        SELECT
                        '' as Ids,
                        '' as Cedula,
                        '' as Apellidos,
                        '' AS Nombres,
                        '' as Creado,
                        '' as Modificado

                        FROM
                            users as User


                            INNER JOIN offices_users AS OfficeUser ON User.id = OfficeUser.user_id";
        return $query;

    }
    public function listadoUsersEdit($id,$iduser,$role)
    {
        //pr($role);
        $query = "SELECT * FROM offices AS Officce
                    
                    INNER JOIN users AS User ON Officce.user_id=User.id
                    WHERE (Officce.user_id = ".$iduser.") AND (
                    NOT EXISTS(
                    	SELECT id FROM offices_users AS OfficeUser
                        WHERE (OfficeUser.office_id = Officce.id) AND (OfficeUser.user_id= ".$id.")
                        
                    )
                    )
                    GROUP BY Officce.id";
        return $query;

    }
    public function listadoOfficesUsersEditAsignadas($iduser,$role)
    {
    
         $query = "SELECT *,OfficceUser.id AS id_office_user FROM offices AS Officce
                    INNER JOIN offices_users AS OfficceUser ON Officce.id=OfficceUser.office_id
                    INNER JOIN users AS User ON Officce.user_id=User.id
                    WHERE 
                        
                        (OfficceUser.user_id =".$iduser.") OR (Officce.user_id = ".$iduser.")
                    GROUP BY Officce.id";
        return $query;
   
       

    }
    public function listadoOfficesUsersView($iduser,$role)
    {
        $query = "SELECT *,OfficceUser.id AS id_office_user FROM offices AS Officce
                    LEFT JOIN offices_users AS OfficceUser ON Officce.id=OfficceUser.office_id
                    INNER JOIN users AS User ON Officce.user_id=User.id
                    WHERE (OfficceUser.user_id =".$iduser.") OR (Officce.user_id = ".$iduser.")
                    GROUP BY Officce.id";
        return $query;

    }

}

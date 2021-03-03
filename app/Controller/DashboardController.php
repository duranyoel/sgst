<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP Dashboard
 * @author yoelduran
 */
class DashboardController extends AppController {

   

    public function index() {
        //Get data from model
        //Get the last 10 rounds for score graph
//        $rounds = $this->Service->find(
//                'all', array(
////                'conditions' => array(
////                    'Round.user_id' => $this->Auth->user('id')
////                    ),
//                'order' => array('Service.created' => 'ASC'),
//                'limit' => 10,
//                'fields' => array(
//                        'Service.created',
//                        'Service.costo_servicio'
//                    )
//                )
//        );
//        
        //pr($rounds);
        //die();
//Setup data for 
//
        $id_user = $this->Session->read('Auth.User.id');
        if($this->Session->read('role')=="superuser"){
            $rounds = $this->Service->query("SELECT
                                SUM( Service.costo_servicio ) AS Monto,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d/%m/%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                 WHERE  Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
            $roundscount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d/%m/%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                 WHERE  Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
            $repaircount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d/%m/%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                LEFT JOIN service_status AS OfficeUser ON Service.id = OfficeUser.service_id
                                 WHERE  Service.created >= date_sub(curdate(), interval 30 day) AND OfficeUser.estatus='Reparado' 
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
        }else if($this->Session->read('role')=="admin"){
             $rounds = $this->Service->query("SELECT
                                SUM( Service.costo_servicio ) AS Monto,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d-%m-%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                 WHERE Office.user_id = ".$id_user." AND Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
             $roundscount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d-%m-%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                 WHERE Office.user_id = ".$id_user." AND Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
             $roundrepaircount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d/%m/%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                LEFT JOIN service_status AS OfficeUser ON Service.id = OfficeUser.service_id
                                 WHERE  Service.created >= date_sub(curdate(), interval 30 day) 
                                 AND OfficeUser.estatus='Reparado' AND Office.user_id = ".$id_user."
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
        }else{
            $rounds = $this->Service->query("SELECT
                                SUM( Service.costo_servicio ) AS Monto,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d-%m-%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                LEFT JOIN offices_users AS OfficeUser ON Office.id = OfficeUser.office_id 
                                 WHERE OfficeUser.user_id = ".$id_user." AND Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
            $roundscount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d-%m-%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                LEFT JOIN offices_users AS OfficeUser ON Office.id = OfficeUser.office_id 
                                 WHERE OfficeUser.user_id = ".$id_user." AND Service.created >= date_sub(curdate(), interval 30 day)
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
            $roundrepaircount = $this->Service->query("SELECT
                                COUNT( Service.id ) AS Cantidad,
                                 CONCAT(Office.nombre,'(',DATE_FORMAT( Service.created , '%d/%m/%Y' ),')')AS Fecha
                                FROM
                                        services AS Service
                                LEFT JOIN offices AS Office ON Service.office_id = Office.id
                                LEFT JOIN offices_users AS OfficeUser ON Office.id = OfficeUser.office_id 
                                LEFT JOIN service_status AS OfficeUser ON Service.id = OfficeUser.service_id
                                 WHERE  Service.created >= date_sub(curdate(), interval 30 day) 
                                 AND OfficeUser.estatus='Reparado'  AND OfficeUser.user_id = ".$id_user."
                                GROUP BY
                                        DATE_FORMAT(Service.created,'%Y-%m-%d'),Office.nombre
                                
                                        ");
        }
       
        
        //pr($rounds);
        //die();
        $chart = new GoogleChart();

        $chart->type("AreaChart");
        //Options array holds all options for Chart API
        $chart->options(array('title' => "Saldos Ultimos 30 Dias",'width'=>1000));
        $chart->div('area');
        $chart->columns(array(
            //Each column key should correspond to a field in your data array
            'Fecha' => array(
                //Tells the chart what type of data this is
                'type' => 'string',
                //The chart label for this column			
                'label' => 'Oficina/Fecha'
            ),
            'Monto' => array(
                'type' => 'number',
                'label' => 'Total'
            )
        ));

//Loop through our data and creates data rows
//Data will be added to rows based on the column keys above (event_date, score).
//If there are missing fields in your data or the keys do not match, then this will not work.
//        foreach ($model as $round) {
//            $chart->addRow($round['Service']);
//        }

//You can also use this way to loop through data and creates data rows: 
        
        foreach($rounds as $row){
            //$chart->addRow(array('event_date' => $row['Model']['field1'], 'score' => $row['Model']['field2']));
            $chart->addRow(array('Fecha' => $row[0]['Fecha'], 'Monto' => $row[0]['Monto']));
        }


//You can also manually add rows: 
        //$chart->addRow(array('event_date' => '1/1/2012', 'score' => 55));

//Set the chart for your view
        $this->set(compact('chart'));
        
        
        $chartbar = new GoogleChart();

        $chartbar->type("BarChart");
        //Options array holds all options for Chart API
        $chartbar->options(array('title' => "Saldos Ultimos 30 Dias",'width'=>1000));
        $chartbar->div('chartbar');
        $chartbar->columns(array(
            //Each column key should correspond to a field in your data array
            'Fecha' => array(
                //Tells the chart what type of data this is
                'type' => 'string',
                //The chart label for this column			
                'label' => 'Oficina/Fecha'
            ),
            'Monto' => array(
                'type' => 'number',
                'label' => 'Total'
            )
        ));
        
        foreach($rounds as $row){
            //$chart->addRow(array('event_date' => $row['Model']['field1'], 'score' => $row['Model']['field2']));
            $chartbar->addRow(array('Fecha' => $row[0]['Fecha'], 'Monto' => $row[0]['Monto']));
        }
        
        
        $chartcount = new GoogleChart();

        $chartcount->type("LineChart");
        //Options array holds all options for Chart API
        $chartcount->options(array('title' => "Recepciones Ultimos 30 Dias",'width'=>1000));
        $chartcount->div('countchart');
        $chartcount->columns(array(
            //Each column key should correspond to a field in your data array
            'Fecha' => array(
                //Tells the chart what type of data this is
                'type' => 'string',
                //The chart label for this column			
                'label' => 'Oficina/Fecha'
            ),
            'Cantidad' => array(
                'type' => 'number',
                'label' => 'Total'
            )
        ));

//Loop through our data and creates data rows
//Data will be added to rows based on the column keys above (event_date, score).
//If there are missing fields in your data or the keys do not match, then this will not work.
//        foreach ($model as $round) {
//            $chart->addRow($round['Service']);
//        }

//You can also use this way to loop through data and creates data rows: 
        
        foreach($roundscount as $row){
            //$chart->addRow(array('event_date' => $row['Model']['field1'], 'score' => $row['Model']['field2']));
            $chartcount->addRow(array('Fecha' => $row[0]['Fecha'], 'Cantidad' => $row[0]['Cantidad']));
        }
        
        
        $repaircount = new GoogleChart();

        $repaircount->type("LineChart");
        //Options array holds all options for Chart API
        $repaircount->options(array('title' => "Reparaciones Ultimos 30 Dias",'width'=>1000));
        $repaircount->div('repairchart');
        $repaircount->columns(array(
            //Each column key should correspond to a field in your data array
            'Fecha' => array(
                //Tells the chart what type of data this is
                'type' => 'string',
                //The chart label for this column			
                'label' => 'Oficina/Fecha'
            ),
            'Cantidad' => array(
                'type' => 'number',
                'label' => 'Total'
            )
        ));

//Loop through our data and creates data rows
//Data will be added to rows based on the column keys above (event_date, score).
//If there are missing fields in your data or the keys do not match, then this will not work.
//        foreach ($model as $round) {
//            $chart->addRow($round['Service']);
//        }

//You can also use this way to loop through data and creates data rows: 
        
        foreach($roundrepaircount as $row){
            //$chart->addRow(array('event_date' => $row['Model']['field1'], 'score' => $row['Model']['field2']));
            $repaircount->addRow(array('Fecha' => $row[0]['Fecha'], 'Cantidad' => $row[0]['Cantidad']));
        }
        
        
        $this->set(compact('chartbar'));
        $this->set(compact('chartcount'));
        $this->set(compact('repaircount'));
    }

}

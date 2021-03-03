<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('CakeText', 'Utility');
App::uses('GoogleChart', 'GoogleChart.Lib');
class AppController extends Controller {

    public $paginate = array(
        'limit' => 10,
    );
    public $uses = array(
        'State', 'Municipality', 'Location', 'Country',
        "User", 'Office','OfficeUser','Login','Service','Customer',
        'ServiceStatu','Advance','Pattern','Trademark','Article','ArticleService'
    );
    public $helpers = array('Form', 'Html', 'Js', 'Time', 'Session', 'Combinator.Combinator','GoogleChart.GoogleChart');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'home'),
            'authorize' => array('Controller') // Added this line
        ),
        'Email',
        'Paginator',
        'Flash',
        'RequestHandler'
    );

   
    //funcion para validar que el usuario a editar pertece a la oficina del admin
    public function oficinauser($id=null) {
        $id_user = $this->Session->read('Auth.User.id');
        
        
        $oficina= $this->Office->query('SELECT
            sgst.offices_users.id,
            sgst.offices.nombre AS Nombre,
            sgst.offices.user_id AS OfficeUserId,
            sgst.offices.id AS OfficeId,
            sgst.offices_users.user_id
        FROM
            sgst.offices
            INNER JOIN sgst.offices_users ON sgst.offices.id = sgst.offices_users.office_id
            WHERE offices.user_id ='.$id_user.' AND offices_users.user_id='.$id);
        
        
        if(!empty($oficina)){
            return true;
        }
        return false;
    }
    // funcion para validar que el articulo pertenezca a la oficina del usuario
    public function userarticulo($id=null) {
         $id_user = $this->Session->read('Auth.User.id');
         $art = $this->Article->query('SELECT
                    sgst.articles.id
            FROM
                    sgst.offices
                    INNER JOIN sgst.articles
                     ON sgst.offices.id = sgst.articles.office_id
            WHERE sgst.offices.user_id ='.$id_user.' AND sgst.articles.id ='.$id);
         if (!empty($art)) {
             return true;
         }
         return false;
         
    }
    //funcion de validacion que los servicios pertenecen a la oficina del usuario
    public function servicios($id=null) {
         $id_user = $this->Session->read('Auth.User.id');
         $art = $this->Article->query('SELECT
                                sgst.services.id
                        FROM
                                sgst.offices
                                INNER JOIN sgst.services
                                 ON sgst.offices.id = sgst.services.office_id
                                left JOIN sgst.offices_users
                                 ON sgst.offices.id = sgst.offices_users.office_id
                        WHERE
                                sgst.services.id = '.$id.'
                                AND (sgst.offices.user_id = '.$id_user.'
                        OR offices_users.user_id = '.$id_user.')');
         if (!empty($art)) {
             return true;
         }
         return false;
    }
    
     //funcion de validacion que los adelantos pertenecen a la oficina del usuario
    public function adelantos($id=null) {
         $id_user = $this->Session->read('Auth.User.id');
         $art = $this->Article->query('SELECT    sgst.advances.id
                        FROM
                                sgst.offices
                                INNER JOIN sgst.services
                                 ON sgst.offices.id = sgst.services.office_id
                                INNER JOIN sgst.advances
                                 ON sgst.services.id = sgst.advances.service_id
                                LEFT OUTER JOIN sgst.offices_users
                                 ON sgst.offices.id = sgst.offices_users.office_id

                        WHERE 
                        sgst.advances.id = '.$id.'
                        AND (sgst.offices.user_id = '.$id_user.'
                        OR offices_users.user_id = '.$id_user.')');
         if (!empty($art)) {
             return true;
         }
         return false;
    }
    //funcion de validacion que los adelantos pertenecen a la oficina del usuario
    public function useroffices($id=null) {
         $id_user = $this->Session->read('Auth.User.id');
         $art = $this->Office->find('first', array('conditions'=>'Office.id='.$id.' AND Office.user_id='.$id_user));
        
         if (!empty($art)) {
             return true;
         }
         return false;
    }
    
    public function inicializarAuth() {


        $this->Auth->loginError = 'El nombre de usuario y/o la contraseña no son correctos. Por favor, inténtalo otra vez';
        $this->Auth->authError = 'Para entrar en la zona privada tienes que autenticarte';

        $this->Session->write('Auth.redirect', null);
    }

    public function beforeFilter() {
        $permissions = array('register', 'login', 'logout', 'getByEstados',
            'getByMunicipios', 'home', 'getByCountries','recover','listar','manual');  // array con métodos públicos
        parent::beforeFilter();
        if ($this->Auth->user('role') == 'admin'):              // True si el usuario está logeado
            array_push($permissions, 'ajax_search', 
                    'imprimir_detalles', 'index', 
                    'add', 'edit', 'view','imprimir_factura','graficos','ajax_service',
                    'get_total','ajax_search1','soporte','soporte_lista','soporte_lista_ajax',
                    'soporte_detalles','get_by_marca','buscar_articulo_soporte','addarticle',
                    'deletearticleservice','profile','edit_profile','imprimir_orden',
                    'listadoreparados','ajax_listado_reparados');  // estos métodos sólo para usuarios logeados
            $this->inicializarAuth();
        elseif ($this->Auth->user('role') == 'user'):
            array_push($permissions, 'ajax_search', 
                    'imprimir_detalles', 'imprimir_factura', 'graficos', 'index', 
                    'view', 'edit', 'ajax_service', 
                    'get_total', 'ajax_search', 'soporte', 'soporte_lista', 
                    'soporte_lista_ajax', 'soporte_detalles', 'get_by_marca', 'add',
                    'buscar_articulo_soporte','addarticle','deletearticleservice',
                    'profile','edit_profile','imprimir_orden','listadoreparados',
                    'ajax_listado_reparados');  // estos métodos sólo para usuarios logeados
            $this->inicializarAuth();

        elseif ($this->Auth->user('role') == 'superuser'):
            array_push($permissions, 'ajax_search', 'add',
                    'imprimir_detalles', 'imprimir_factura', 'index', 'view', 
                    'edit', 'graficos', 'ajax_service', 'get_total',
                    'ajax_search1', 'soporte', 'soporte_lista', 
                    'soporte_lista_ajax', 'soporte_detalles', 'get_by_marca', 'agregar',
                    'buscar_articulo_soporte','addarticle','deletearticleservice',
                    'profile','edit_profile','imprimir_orden','listadoreparados',
                    'ajax_listado_reparados','estatus');  // estos métodos sólo para usuarios logeados
            $this->inicializarAuth();
        endif;
        $this->Auth->allow($permissions);  // coloco permisos
        $this->inicializarAuth();
    }

    public function isAuthorized() {
        if (isset($this->params[Configure::read('Routing.admin')])): // si estoy en la zona admin
            if ($this->Auth->user('role') == 'admin'):  // si soy un usuario logeado y del grupo admin
                return true; // Welcome!
            endif;
        endif;

        return false; // go away !!
    }

    public function correo($para = null, $subject = null, $body = null, $plantilla = null) {

        $this->Email->smtpOptions = array(
            'tls' => false,
            'transport' => 'Smtp',
            'port' => '465',
            //'port' => '587',
            'timeout' => '60',
            'host' => 'localhost',
            'username' => '',
            'password' => '');
        $this->Email->to = $para;
        //$this->Email->bcc = array('yoelduran25@gmail.com');
        $this->Email->subject = $subject;
        $this->Email->replyTo = 'admin';
        $this->Email->from = 'Sistema Gestión Soporte Tecnico';

        $this->Email->sendAs = 'html'; // queremos enviar un lindo email
        //Variables de la vista        
        $this->set('body', $body);

        /* Configurar método de entrega */
        $this->Email->delivery = 'smtp';
        //NO PASAMOS ARGUMENTOS A SEND()
        $this->Email->send('', $plantilla, '');
    }

    public function capturarip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
            //Is it a proxy address
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function borrarImagenPc($nombre = null, $modelo = null) {
        $dirPath = APP . WEBROOT_DIR . DS . "img" . DS . "uploads" . DS . $modelo;
        $gestor = opendir($dirPath);
        $directorio = readdir($gestor);
        $archivo = $dirPath . DS . $nombre;



        if (file_exists($archivo)) {
            unlink($archivo);
            return true;
        }
        return false;
    }

    public function subirImagen($imagen = null, $modelo) {

        $dirPath = APP . DS . WEBROOT_DIR . DS . "img" . DS . "uploads" . DS . $modelo;
        $rs = @mkdir($dirPath, '0775');
        //chmod($dirPath, 0777);
        # MIME types permitidos
        $mime = array('image/jpg',
            'image/jpeg',
            'image/pjpeg',
            'image/gif',
            'image/png');
        # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
        if (!in_array($imagen['type'], $mime)) {
            $error = true;
            $this->Flash->error(__('Ups! Solamente puedes subir imágenes con la extensión GIF, JPG, JPEG, PJPEG o PNG ' . $imagen['name']));
        }
        # Le decimos al usuario que se olvido de subir un archivo
        elseif ($imagen['type'] == '') {
            $error = true;
            $this->Flash->error(__('Hey -.-, te olvidaste de un pequeño detalle... No subiste ningún archivo!'));
        }
        # Indicamos hasta que peso de archivo puede subir el usuario.
        /* elseif( $imagen['size'] < 2000000 ) 
          {
          $error = true;
          $this->Session->setFlash(__('<div class="alert alert-success">
          <button class="close" data-dismiss="alert"><span>&times;</span></button>
          Wow! El archivo que estas subiendo tiene sobrepeso! B&aacute;jalo hasta  '.$imagen['size'].' que es lo máximo que aceptamos :)
          </div>'));

          } */
        # Si el archivo cumple con las expectativas quiere decir que la variable $error viene vacia y se ejecutará la función que colocaremos ahí
        if (empty($error)) {

            # Extraemos los datos del array
            # Le agregamos una id unica para evitar duplicado
            //$filename = uniqid(microtime()) . $filename;
            # Con explore() obtenemos la extensión del archivo
            $ext = end(explode('.', $imagen['name']));
            # Encryptamos el nombre del archivo con md5() para evitar que el archivo tenga otra extensión y acortamos el nombre con substr()
            $nombre = substr(md5($imagen['name']), 0, 15);
            # Le devolvemos la extensión al archivo
            $tiempo = date('YmdHis'); //.microtime();
            $filename = $tiempo . $nombre . '.' . $ext; //. $imagen['name'];
            # Creamos una variable con la ruta en donde estará alojada la imagen
            $filepath = $dirPath . DS . $filename;

            # Movemos el archivo temporal a donde lo queremos colocar
            move_uploaded_file($imagen['tmp_name'], $filepath);
            # Le cambiamos los permisos al archivo
            chmod($filepath, 0644);

            return $filename;
        }
    }

    public function validarImagen($imagen = null) {


        $mime = array('image/jpg',
            'image/jpeg',
            'image/pjpeg',
            'image/gif',
            'image/png');
        # Buscamos si el archivo que subimos tiene el MIME type que permitimos en nuestra subida
        if (!in_array($imagen['type'], $mime)) {
            $this->Flash->error(__('Ups! Solamente puedes subir imágenes con la extensión GIF, JPG, JPEG, PJPEG o PNG'));

            return true;
        }
        # Le decimos al usuario que se olvido de subir un archivo
        elseif ($imagen['type'] == '') {
            $this->Flash->error(__('Hey -.-, te olvidaste de un pequeño detalle... No subiste ningún archivo!'));
            return true;
        }
        # Indicamos hasta que peso de archivo puede subir el usuario.
        /* elseif( $imagen['size'] <= 2000000 ) 
          {

          $this->Session->setFlash(__('<div class="alert alert-success">
          <button class="close" data-dismiss="alert"><span>&times;</span></button>
          Wow! El archivo que estas subiendo tiene sobrepeso! B&aacute;jalo hasta  2MB que es lo máximo que aceptamos :)
          </div>'));
          return true;

          } */
        return false;
    }

    public function calcularfecha($birthdate) {
        $adjust = (date("md") >= date("md", strtotime($birthdate))) ? 0 : -1; // Si aún no hemos llegado al día y mes en este año restamos 1
        $years = date("Y") - date("Y", strtotime($birthdate)); // Calculamos el número de años 
        return $years + $adjust; // Sumamos la diferencia de años más el ajuste
    }

    public function validar_fecha($fecha) {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $fecha)) {
            return true;
        } else {
            return false;
        }
    }

    public function validar_email($email) {
        if (preg_match(
                        '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
            return true;
        } else {
            return false;
        }
    }

    public function alertsuccess($mensaje = null) {
        $ms = '<div class="box-body">
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>  <i class="icon fa fa-check"></i> Información!</h4>
                    ' . $mensaje . '
                  </div>
                </div>';
        return $ms;
    }

    public function alertdanger($mensaje = null) {
        $ms = '<div class="box-body"><div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Atención!</h4>
                ' . $mensaje . '
              </div></div>';
        return $ms;
    }

    public function alertinfo($mensaje = null) {
        $ms = '<div class="box-body">                 
                  <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Información!</h4>
                    ' . $mensaje . '
                  </div>
                  
                </div>';
        return $ms;
    }

    public function alertwarning($mensaje = null) {
        $ms = '<div class="box-body">     
                  <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                    ' . $mensaje . '
                  </div>    
                </div>';
        return $ms;
    }

}

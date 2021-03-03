<?php //
ob_end_clean();
ob_start();
App::import('Vendor', 'tcpdf/xtcpdf');
//
//require_once(APP . 'Vendor' . DS . 'tcpdf' . DS . 'config' . DS . 'lang' .DS . 'eng.php');
//require_once (APP . 'Vendor' . DS . 'tcpdf' . DS . 'xtcpdf.php');
require_once (APP . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');
//
$tcpdf = new XTCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$textfont = 'freesans'; // looks better, finer, and more condensed than
//'dejavusans'
//
$tcpdf->SetAuthor("");
$tcpdf->SetAutoPageBreak(true,20);
$tcpdf->setHeaderFont(array($textfont, '', 10));
$tcpdf->xheadercolor = array(255, 255, 255);
$tcpdf->xheadertext = '';
//$tcpdf->xfootertext = date('j/n/Y H:i:s');
//$tcpdf->Footer();
//
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// Now you position and print your page content
// example:
$tcpdf->AddPage();
$tcpdf->SetTextColor(0, 0, 0);
//
//
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf->Image(APP.'webroot'.DS.'img'.DS.'logo1.png',10,5,20,20);

$t ='<table border="1" cellpadding="5" cellspacing="0" width="100%" frame="below">
            <tr>
                <td>Sistema de Gestion De Soporte Tecnico <br>'.$datos['Office']['nombre'].'</td>
                <td></td>
                               
            </tr>
             
             </table>';
////$tcpdf->writeHTMLCell(derecho, izquierdo, margen derecho, margen superior,$t,0, 1, 0, true, 'C',false);
$tcpdf->writeHTMLCell('', 20, 30, 5, $t, 0, 1, 0, true, 'C', false);
//$tcpdf->SetFont('times', '', 11);
//

//$pdf->Image(K_PATH_IMAGES.'foto.png',222,15,30,25);

//Imprimo tabal de datos
$tcpdf->SetFont('times', '', 11);
$bloqueo =$datos['Service']['bloqueo'] == '0' ? 'No' : 'Si';
$garantia=$datos['Service']['garantia'] == '0' ? 'No' : 'Si';
$cuerpo = '<table border="1" cellpadding="5" cellspacing="0" width="100%" frame="below">
            <tr bgcolor="#F7F9FB" style="font-weight: bold;text-transform: uppercase;text-align: left;">

                <th colspan="4">Codigo: '.$datos['Service']['codigo'].'</th>                    
             </tr >
             <tr bgcolor="#F7F9FB" style="font-weight: bold; text-align: left;">

                     <th colspan="4">Datos Del Cliente</th>
                                         
             </tr >
            
            <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Apellidos:</th>
                <th>Nombres:</th>
                <th>Cedula:</th>
                <th>Teléfono:</th>
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Customer']['apellidos'].'</td>
                <td>'.$datos['Customer']['nombres'].'</td>
                <td>'.$datos['Customer']['cedula'].'</td>
                <td>'.$datos['Customer']['telefono'].'</td>
                
            </tr>

            <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Email:</th>
                <th>Tipo:</th>
                <th colspan="3">Direccion:</th>
               
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Customer']['email'].'</td>
                <td>'.$datos['Customer']['tipo'].'</td>
                <td colspan="2">'.$datos['Customer']['direccion'].'</td>
               
                
            </tr>
            <tr bgcolor="#F7F9FB" style="font-weight: bold; text-align: left;">

                     <th colspan="4">Datos De La Orden De Servicio</th>
                                         
             </tr >
           <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Nombre Oficina/Local:</th>
                <th>Tipo de servicio:</th>
                <th>Codigo:</th>
                <th>Numero de Serie:</th>
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Office']['nombre'].'</td>
                <td>'.$datos['Service']['tipo_servicio'].'</td>
                <td>'.$datos['Service']['codigo'].'</td>
                <td>'.$datos['Service']['num_serie'].'</td>
                
            </tr>
            <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Nombre:</th>
                <th>Color:</th>
                <th>Bloqueo?:</th>
                <th>Usuario:</th>
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Service']['nombre'].'</td>
                <td>'.$datos['Service']['color'].'</td>
                <td>'.$bloqueo.'</td>
                <td>'.$datos['Service']['usuario'].'</td>
                
            </tr>
            <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Clave:</th>
                <th>Fecha Recibido:</th>
                <th>Fecha Posible Entrega:</th>
                <th>Garantia:</th>
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Service']['clave'].'</td>
                <td>'.$this->Time->format('d/m/Y', $datos['Service']['fecha_recibido']).'</td>
                <td>'.$this->Time->format('d/m/Y', $datos['Service']['fecha_entrega']).'</td>
                <td>'.$garantia.'</td>
                
            </tr>
            <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th>Dias de garantia:</th>
                <th>Costo del servicio:</th>
                <th>Descripción del equipo:</th>
                <th>Estado:</th>
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td>'.$datos['Service']['dias_garantia'].'</td>
                <td>'.$this->Number->format($datos['Service']['costo_servicio'], array(
                        'places' => 2,
                        
                        'escape' => false,
                        'decimals' => '.',
                        'thousands' => ','
                    )).'</td>
                <td>'.$datos['Service']['descripcion'].'</td>
                <td>'.$datos['Service']['estado'].'</td>
                
            </tr>
             <tr bgcolor="#F7F9FB"  style="font-weight: bold;text-transform: uppercase;text-align: left;">
                <th colspan="4">Detalle del servicio/Observaciones:</th>
               
                
            </tr>
        
        
            <tr  style="text-transform: uppercase;text-align: left;">
                <td colspan="4">'.$datos['Service']['observaciones'].'</td>
               
                
            </tr>

        </table>';

$tcpdf->writeHTMLCell(0,0, 5, 30,$cuerpo,0, 1, 0, true, 'C',false);


$tabla = '<table border="0" cellpadding="5" cellspacing="0" width="100%">
            <tr style="font-weight: bold;text-transform: uppercase;text-align: left;">

                <td colspan="2"></td>
                <td colspan="2"></td>                    
             </tr >
             <tr style="font-weight: bold;text-transform: uppercase;text-align: left;">

                <td colspan="2"></td>
                <td colspan="2"></td>                    
             </tr >
            <tr style="font-weight: bold;text-transform: uppercase;text-align: left;">

                <td colspan="2">Entrega: ___________________________________</td>
                <td colspan="2">Recibe: ___________________________________</td>                    
             </tr >
        </table>';
$tcpdf->writeHTMLCell(0,0, 5, '',$tabla,0, 1, 0, true, 'C',true);
//
$tcpdf->Output('Factura.pdf', 'I');
ob_end_flush();
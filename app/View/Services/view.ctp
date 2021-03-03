<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-briefcase"></i> Detalles de la orden de servicio <b style="text-transform: uppercase;"><?php echo $datos['Service']['nombre'] ?></b> </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <h4>Datos Del Cliente</h4>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="cedula">Cedula:</label>
                    <p><?php echo $datos['Customer']['cedula']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="apellidos">Apellidos:</label>
                    <p><?php echo $datos['Customer']['apellidos']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="nombres">Nombres:</label>
                    <p><?php echo $datos['Customer']['nombres']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="email">Email:</label>
                    <p><?php echo $datos['Customer']['email']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="telefono">Teléfono:</label>
                    <p><?php echo $datos['Customer']['telefono']; ?></p>
                </div>

                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Tipo:</label>
                    <p><?php echo $datos['Customer']['tipo']; ?></p>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="file">Imagen:</label>
                    <p><?php
                        if ($datos['Customer']['imagen'] == 'Ninguna' || $datos['Customer']['imagen'] == null) {
                            echo $this->Html->image('avatar5.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                        } else {
                            echo $this->Html->image('uploads/customers/' . $datos['Customer']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                        }
                        ?></p>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="direccion">Dirección:</label>
                    <p><?php echo $datos['Customer']['direccion']; ?></p>

                </div>
            </div>

        </div> 
        <div class="row">
            <div class="col-lg-12">
                <h4>Datos de la orden de servicio</h4>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Oficina/Local:</label>
                    <p><?php echo $datos['Office']['nombre']; ?></p>
                </div>

                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Tipo de servicio:</label>
                    <p><?php echo $datos['Service']['tipo_servicio']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="codigo">Codigo:</label>
                    <p><?php echo $datos['Service']['codigo']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="num_serie">Numero De Serie:</label>
                    <p><?php echo $datos['Service']['num_serie']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="nombre">Nombre:</label>
                    <p><?php echo $datos['Service']['nombre']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="color">Color:</label>
                    <p><?php echo $datos['Service']['color']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Bloqueo?:</label>
                    <p><?php echo $datos['Service']['bloqueo'] == '0' ? 'No' : 'Si'; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="usuario">Usuario  si posee:</label>
                    <p><?php echo $datos['Service']['usuario']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="clave">Clave:</label>
                    <p><?php echo $datos['Service']['clave']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="fecha_recibido">Fecha Recibido:</label>
                    <p><?php echo $this->Time->format('d/m/Y', $datos['Service']['fecha_recibido']); ?></p>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="fecha_entrega">Fecha Posible Entrega:</label>
                    <p><?php echo $this->Time->format('d/m/Y', $datos['Service']['fecha_entrega']); ?></p>
                </div>

                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Garantia?:</label>
                    <p><?php echo $datos['Service']['garantia'] == '0' ? 'No' : 'Si'; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="fecha_entrega">Dias De Garantia:</label>
                    <p><?php echo $datos['Service']['dias_garantia']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="fecha_entrega">Costo del servicio:</label>
                    <p><?php echo $this->Number->format($datos['Service']['costo_servicio'], array(
                            'places' => 2,
                            'escape' => false,
                            'decimals' => '.',
                            'thousands' => ','
                        )); ?></p>
                </div>
                <hr>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="direccion">Descripción del equipo:</label>
                    <p><?php echo $datos['Service']['descripcion']; ?></p>

                </div>

                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="estado">Estado del equipo:</label>
                    <p><?php echo $datos['Service']['estado']; ?></p>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="observaciones">Detalle del servicio/Observaciones:</label>
                    <p><?php echo $datos['Service']['observaciones']; ?></p>

                </div>
            </div>


        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
    <div class="box-footer">

<?php
echo $this->Html->link(__(' Imprimir Orden'), array('action' => 'imprimir_orden/' . $datos['Service']['id']), array('class' => 'btn btn-flat btn-success fa fa-print', 'title' => 'Imprimir Orden'));
?>&nbsp;
        <?php
        echo $this->Html->link(__(' Agregar abono/adelanto'), array('controller' => 'advances', 'action' => 'add/' . $datos['Service']['id']), array('class' => 'btn btn-flat btn-warning fa fa-money', 'title' => 'Agregar abono/adelanto'));
        ?>
        &nbsp;

        <?php
        if (!empty($advances)) {

            // code...

            echo '<a class="btn btn-flat btn-warning fa fa-money" data-toggle="modal" data-target="#advances">

                Listar abono/adelanto

              </a>';
        }
        ?>

    </div>
    <!-- /.box-body -->
</div>
<div class="modal fade" id="advances">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Total Abonado Hasta Ahora</h4>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Monto</th>
                            <th>Observación</th>
                            <th>Fecha</th>
                        </tr>
                            <?php foreach ($advances as $lista): ?>
                            <tr>
                                <td><?php echo h($lista['Advance']['id']); ?>&nbsp;</td>
                                <td>
                                    <?php
                                    echo $this->Html->link($this->Number->format($lista['Advance']['monto'], array(
                                                'places' => 2,
                                                'escape' => false,
                                                'decimals' => '.',
                                                'thousands' => ','
                                            )), array('controller' => 'advances', 'action' => 'view', $lista['Advance']['id']));
                                    ?>
                                </td>
                                <td><?php echo h($lista['Advance']['observacion']); ?>&nbsp;</td>
                                <td><?php echo $this->Time->format('d/m/Y', h($lista['Advance']['fecha'])); ?>&nbsp;</td>
                            </tr>
                                    <?php
                                    $total = $total + $lista['Advance']['monto'];
                                endforeach;
                                ?>
                        <tr>
                            <th colspan="3">Total Servicio</th>
                            <th>
                        <?php
                        if(isset($articlesservicestotales)){
                                $totalcosto=$datos['Service']['costo_servicio']+$articlesservicestotales[0][0]['Total'];
                            }else{
                                $totalcosto=$datos['Service']['costo_servicio'];
                            }
                        
                        echo $this->Number->format($totalcosto, array(
                            'places' => 2,
                            'escape' => false,
                            'decimals' => '.',
                            'thousands' => ','
                        ));
                        ?></th>
                        </tr>
                        <tr>
                            <th colspan="3">Total Abonado</th>
                            <th><?php
                                echo $this->Number->format($total, array(
                                    'places' => 2,
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
                               
                                ?></th>
                        </tr>
                        <tr>
                            <th colspan="3">Porcentaje Abonado</th>
                            <th><?php
                                
                                $porcentaje = ($total * 100)/$totalcosto;
                                $porfinal =  $this->Number->toPercentage($porcentaje);
                                if($porfinal <= 25){
                                    echo '<span class="label label-danger">'.$porfinal.'</span>';
                                }else if($porfinal >= 26 && $porfinal <= 50){
                                    echo '<span class="label label-warning">'.$porfinal.'</span>';
                                }else if($porfinal >= 51 && $porfinal <= 75){
                                    echo '<span class="label label-info">'.$porfinal.'</span>';
                                }else if($porfinal >= 76 && $porfinal <= 99){
                                    echo '<span class="label label-primary">'.$porfinal.'</span>';
                                }else if($porfinal ==100){
                                    echo '<span class="label label-success">'.$porfinal.'</span>';
                                }
                                
                                
                                ?></th>
                        </tr>
                        <tr>
                            <th colspan="3">Resta</th>
                            <th><?php
                                echo $this->Number->format($totalcosto - $total, array(
                                    'places' => 2,
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
                                ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

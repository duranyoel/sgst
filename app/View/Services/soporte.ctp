<?php
echo $this->Form->create('ServiceStatu', array('role' => 'form',
    'type' => 'file'));
echo $this->Form->input('services_id', array(
    'id' => 'servicesart_id',
    'type' => 'hidden',
    'value' => $datos['Service']['id'],
    'required' => 'false'
));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-briefcase"></i> Registro de soportes/revisiones para la orden de servicio <b style="text-transform: uppercase;"><?php echo $datos['Service']['nombre'] ?></b> </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Del Cliente</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Datos De La Orden</a></li>
                        <li><a href="#tab_soporte" data-toggle="tab">Area de soporte</a></li>
                        <li><a href="#tab_articulos" data-toggle="tab">Agregar piezas/articulos a la orden</a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="row">

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
                                    <p><?php
                                        echo $this->Number->format($datos['Service']['costo_servicio'], array(
                                            'places' => 2,
                                            'escape' => false,
                                            'decimals' => '.',
                                            'thousands' => ','
                                        ));
?></p>
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_soporte">

                            <div class="form-group">
                                <label for="direccion">Estatus Actual:</label>
                                <p><table class="table table-hover">
                                    <tr>

                                        <th>Estatus</th>
                                        <th>Observación</th>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                    </tr>
                                    <?php foreach ($datos['ServiceStatu'] as $lista): ?>
                                            <tr>
                                                <td><?php echo h($lista['estatus']); ?>&nbsp;</td>

                                                <td><?php echo h($lista['descripcion']); ?>&nbsp;</td>
                                                <td><?php echo $this->Time->format('d/m/Y h:i:s a', h($lista['created'])); ?>&nbsp;</td>
                                                <td><?php echo h($lista['User']['nombres'] . " " . $lista['User']['apellidos']); ?>&nbsp;</td>
                                            </tr>
                                        <?php
                                    endforeach;
                                    ?>

                                </table>
                                </p>

                            </div>
                            <div class="form-group">
                                <label>Cambiar estatus:</label>
                                    <?php
                                    echo $this->Form->input('estatus', array('label' => false,
                                        'class' => 'form-control', 'style' => 'width: 100%;',
                                        'title' => 'Por Favor Seleccione',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                        //'default'=>$datos['Customer']['tipo'],
                                        'options' => array('Revision' => 'Revision',
                                            'Reparacion' => 'Reparacion',
                                            'Reparado' => 'Reparado',
                                            'Entregado' => 'Entregado',)))
                                    ?>  

                            </div>
                               
                            <div class="form-group">
                                <label>Observaciones y/o detalles:</label>
                                <?php
                                echo $this->Form->input('descripcion', array('class' =>
                                    'form-control',
                                    'placeholder' => '',
                                    'label' => false,
                                    'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;',
                                    'title' => 'Ingrese una descripcion general del equipo',
                                    'type' => 'textarea'));
                                ?>  

                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_articulos">

                            <div class="form-group">
                                <label for="cedula">Por favor busque y seleccione los respuestos/articulos:</label>
                                <div class="input-group date">

                                    <?php
                                    echo $this->Form->input('buscar', array('class' =>
                                        'form-control', 'placeholder' => 'Microchip',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese el nombre del articulo o pieza a buscar'));
                                    ?> 
                                    <div class="input-group-btn">
                                        <button type="button" onclick="articles.buscar_articulo_soporte()" class="btn btn-info btn-flat">Buscar</button>

                                    </div>
                                </div>
                                <div id="tablaarticulos">

                                </div>



                            </div>



                           
                            <div id="articulosagregados">
                                 <?php if (!empty($articulosagregados)) {
                                ?>
                                    <div class="form-group">
                            <label>Lista de respuesto/articulos agregados:</label>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="danger">
                                            <th>Id</th>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Costo</th>
                                           
                                            <th class="actions"><?php echo __('Acción'); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            foreach ($articulosagregados as $lista):  ?>
                                            <tr>
                                                <td><?php echo $this->Form->input('ServiceArticleId', array(
                                                    'id'=>'servicearticle_id',
                                                    'type' => 'hidden',
                                                    'value' => $lista['ArticleService']['id'],
                                                    'required' => 'false'
                                                ));  echo $lista['ArticleService']['id']; ?>&nbsp;</td>
                                                <td><?php echo $lista['Article']['codigo']; ?>&nbsp;</td>
                                                <td><?php echo $lista['Article']['nombre']; ?>&nbsp;</td>
                                                <td><?php echo $lista['ArticleService']['observacion'];?>&nbsp;</td>
                                                <td><?php  echo $this->Number->format($lista['Article']['costo'], array(
                                                        'places' => 2,
                                                        'escape' => false,
                                                        'decimals' => '.',
                                                        'thousands' => ','
                                                    ));?>&nbsp;</td>
                                                
                                                <td class="actions">
                                                    <button type="button" class="btn btn-danger btn-sm btn-flat" onCLick="articles.deletearticleservice(<?php echo $lista['ArticleService']['id']; ?>)"><span class="fa fa-trash"></span>&nbsp;Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php 
                                        
                                        $total = $total + $lista['Article']['costo'];
                                        endforeach; ?>
                                            <tr>
                                                <th colspan="4">Total Servicio</th>
                                                <th>
                                                    <?php
                                                    echo $this->Number->format($total, array(
                                                        'places' => 2,
                                                        'escape' => false,
                                                        'decimals' => '.',
                                                        'thousands' => ','
                                                    ));
                                                    ?>
                                                </th>
                                            </tr>       
                                    </tbody>

                                </table>
                            </div>
                        </div>

                                <?php }
                            ?>
                            </div>




                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>








        </div>

    </div> 


    <!-- /.row -->
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">Submit</button>       
</div>
<!-- /.box-body -->
<?php
echo $this->Form->end();
?>
<script type="application/javascript">
    actualnamespace.push('articles/add');
</script>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Detalles del soportes/revisiones para la orden de servicio <b style="text-transform: uppercase;"><?php echo $datos['Service']['nombre'] ?></b> </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos Del Cliente</h3>
                    </div>
                    <div class="panel-body">
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
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos De La Orden De Servicio</h3>
                    </div>
                    <div class="panel-body">
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
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos Generales Del Soporte Realizado</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="direccion">Estatus:</label>
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

                        <div id="articulosagregados">
                            <?php if (!empty($articulosagregados)) {
                                ?>
                                <div class="form-group">
                                    <label>Lista de respuesto/articulos agregados:</label>


                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="danger">
                                                <th>Id</th>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                
                                                <th>Descripción</th>
                                                <th>Costo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($articulosagregados as $lista): ?>
                                                <tr>
                                                    <td><?php
                                                        echo $this->Form->input('ServiceArticleId', array(
                                                            'id' => 'servicearticle_id',
                                                            'type' => 'hidden',
                                                            'value' => $lista['ArticleService']['id'],
                                                            'required' => 'false'
                                                        ));
                                                        echo $lista['ArticleService']['id'];
                                                        ?>&nbsp;</td>
                                                    <td><?php echo $lista['Article']['codigo']; ?>&nbsp;</td>
                                                    <td><?php echo $lista['Article']['nombre']; ?>&nbsp;</td>
                                                    <td><?php echo $lista['ArticleService']['observacion']; ?>&nbsp;</td>
                                                    <td><?php
                                                        echo $this->Number->format($lista['Article']['costo'], array(
                                                            'places' => 2,
                                                            'escape' => false,
                                                            'decimals' => '.',
                                                            'thousands' => ','
                                                        ));
                                                        ?>&nbsp;</td>
                                                    

                                                </tr>
                                                <?php $total = $total + $lista['Article']['costo'];
                                            endforeach; ?>
                                            <tr>
                                                <th colspan="4">Total  por respuestos</th>
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
                                            <tr>
                                                <th colspan="4">Total general del servicio</th>
                                                <th>
                                                    <?php
                                                    $totalgeneral = $total + $datos['Service']['costo_servicio'];
                                                    echo $this->Number->format($totalgeneral, array(
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

<?php } ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Total general de la factura del servicio</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $totalgeneral = $total + $datos['Service']['costo_servicio'];
                        echo $this->Number->format($totalgeneral, array(
                            'places' => 2,
                            'escape' => false,
                            'decimals' => '.',
                            'thousands' => ','
                        ));
                        ?>
                    </div>
                </div>

            </div>








        </div>

    </div> 

    <div class="box-footer">

        <?php
        echo $this->Html->link(__(' Imprimir Factura'), array('action' => 'imprimir_factura/' . $datos['Service']['id']), array('class' => 'btn btn-flat btn-success fa fa-print', 'title' => 'Imprimir Factura'));
        ?>&nbsp;
        <?php
        $entregado = false;
        foreach ($datos['ServiceStatu'] as $value) {
            if($value['estatus']=='Entregado'){
               $entregado=true;
                
            }
        }
        if(!$entregado){
            echo $this->Html->link(__(' Imprimir Factura y entregar equipo'), array('action' => 'imprimir_factura', $datos['Service']['id'],'Entregar'), array('class' => 'btn btn-flat btn-success fa fa-print', 'title' => 'Imprimir Factura'));
        }
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
    <!-- /.row -->
</div>

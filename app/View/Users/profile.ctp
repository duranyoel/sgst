<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?php
                if ($datos['User']['imagen'] == 'Ninguna' || $datos['User']['imagen'] == null) {
                    echo $this->Html->image('avatar5.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                } else {
                    echo $this->Html->image('uploads/users/' . $datos['User']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                }
                ?>

                <h3 class="profile-username text-center">
                    <?php
                    if ($datos['User']['apellidos'] != null) {
                        echo $this->Html->link($datos['User']['nombres'] . " " . $datos['User']['apellidos'], '');
                    } else {
                        echo $this->Html->link($datos['User']['username'], '');
                    }
                    ?></h3>
                <p class="text-muted text-center"><?php
                    if ($datos['User']['cargo'] != null) {
                        echo $datos['User']['cargo'];
                    } else {
                        echo 'No Posee Cargo';
                    }
                    ?></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Ultimo Ingreso</b> <a class="pull-right">
                            <?php
                            echo $this->Time->format('d/m/Y H:i:s', $lastlogin['Login']['created']);
                            ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Fecha Regsitro</b> <a class="pull-right"><?php
                            echo $this->Time->format('d/m/Y H:i:s', $datos['User']['created']);
                            ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Ult Actualización</b> <a class="pull-right"><?php
                            echo $this->Time->format('d/m/Y H:i:s', $datos['User']['modified']);
                            ?></a>
                    </li>
                </ul>
                <?php echo $this->Html->link('Modificar', array('controller'=>'users','action'=>'edit_profile'), array('class'=>'btn btn-primary btn-block btn-flat'))?>
               
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Acerca de mi</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-map-marker margin-r-5"></i>  Dirección</strong>
                <p class="text-muted">
                    <?php
                    if ($datos['User']['direccion'] != null) {
                        echo $datos['User']['direccion'];
                    } else {
                        echo 'No Posee Dirección Registrada';
                    }
                    ?>
                </p>

                <hr>

                <strong><i class="fa fa-mobile-phone margin-r-5"></i> Teléfono</strong>
                <p class="text-muted"><?php
                    if ($datos['User']['telefono'] != null) {
                        echo $datos['User']['telefono'];
                    } else {
                        echo 'No Posee Teléfono Registrada';
                    }
                    ?></p>

                <hr>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
               
                <li><a href="#settings" data-toggle="tab">Oficinas</a></li>
                <?php
                if ($this->Session->read('role') == "superuser") {
                    echo '<li><a href="#registro" data-toggle="tab">Registro Ingresos</a></li>';
                }
                ?>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <h3> Ultimas ordenes de servicios recibidas</h3>
                    <hr>
                    <?php
                    foreach ($services as $servicios):
                        ?>
                        <div class="post">
                            <div class="user-block">

                                <?php
                                if ($servicios['User']['imagen'] == 'Ninguna' || $servicios['User']['imagen'] == null) {
                                    echo $this->Html->image('avatar5.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle img-bordered-sm'));
                                } else {
                                    echo $this->Html->image('uploads/users/' . $servicios['User']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle img-bordered-sm'));
                                }
                                ?>
                                
                                <span class='username'>
                                    <a href="#"><?php echo $servicios['User']['nombres']?></a>
                                    <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                                </span>
                                <span class='description'><?php echo $servicios['Service']['created']?></span>
                            </div><!-- /.user-block -->
                            <p>
                                <?php echo $servicios['Service']['nombre']?>
                            </p>
                            <p>
                                <?php echo $servicios['Service']['descripcion']?>
                            </p>
                            <p>
                                <?php echo $servicios['Service']['observaciones']?>
                            </p>
                           
                        </div>

                        <?php
                    endforeach;
                    ?>
                    <!-- /.post -->
                    <h3> Ultimos soportes realizados</h3>
                    <hr>
                     <?php
                    foreach ($estatus_servicios as $serviciosestatus):
                        ?>
                        <div class="post">
                            <div class="user-block">

                                <?php
                                if ($serviciosestatus['User']['imagen'] == 'Ninguna' || $serviciosestatus['User']['imagen'] == null) {
                                    echo $this->Html->image('avatar5.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle img-bordered-sm'));
                                } else {
                                    echo $this->Html->image('uploads/users/' . $serviciosestatus['User']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle img-bordered-sm'));
                                }
                                ?>
                                
                                <span class='username'>
                                    <a href="#"><?php echo $serviciosestatus['User']['nombres']?></a>
                                    <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                                </span>
                                <span class='description'><?php echo $serviciosestatus['ServiceStatu']['created']?></span>
                            </div><!-- /.user-block -->
                            <p>
                                <?php 
                                
                                echo $serviciosestatus['ServiceStatu']['estatus'];
                                
                                ?>
                            </p>
                            <p>
                                <?php 
                                
                               
                                echo $serviciosestatus['ServiceStatu']['descripcion'];
                                ?>
                            </p>
                           
                        </div>

                        <?php
                    endforeach;
                    ?>
                    <!-- Post -->
                    <!-- /.post -->
                </div><!-- /.tab-pane -->
                

                <div class="tab-pane" id="settings">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Oficinas Registradas</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>

                                </tr>
                                <?php foreach ($oficinas as $listado): ?>
                                    <tr>
                                        <td><?php echo h($listado['Officce']['id']); ?>&nbsp;</td>
                                        <td><?php echo h($listado['Officce']['nombre']); ?>&nbsp;</td>
                                        <td><?php echo h($listado['Officce']['telefono']); ?>&nbsp;</td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <!-- /.box-body -->

                    </div>
                </div><!-- /.tab-pane -->
                <?php
                if ($this->Session->read('role') == "superuser") {
                    ?>
                    <div class="tab-pane" id="registro">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Registro De Ingreso Al Sistema</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Ip</th>
                                        <th>Fecha</th>

                                    </tr>
    <?php foreach ($logins as $listado): ?>
                                        <tr>
                                            <td><?php echo h($listado['Login']['id']); ?>&nbsp;</td>
                                            <td><?php echo h($listado['Login']['ip']); ?>&nbsp;</td>
                                            <td><?php echo h($listado['Login']['created']); ?>&nbsp;</td>
                                        </tr>
    <?php endforeach; ?>
                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                    </div><!-- /.tab-pane -->
    <?php
}
?>
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->

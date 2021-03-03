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
                        echo $this->Html->link($datos['User']['nombres'] . " " . $datos['User']['apellidos'],'');
                    } else {
                        echo $this->Html->link($datos['User']['username'],'');
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

                <?php echo $this->Html->link('Modificar', array('controller'=>'users','action'=>'edit',$datos['User']['id']), array('class'=>'btn btn-primary btn-block btn-flat'))?>
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
                
                <li class="active"><a href="#settings" data-toggle="tab">Oficinas</a></li>
                <?php
                    if ($this->Session->read('role') == "superuser") {
                        echo '<li><a href="#registro" data-toggle="tab">Registro Ingresos</a></li>';
                    }
                ?>
            </ul>
            <div class="tab-content">
               

                <div class="tab-pane active" id="settings" >
                    <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Oficinas Asignadas</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Nombre</th>
                              <th>Telefono</th>

                            </tr>
                            <?php foreach ($items as $listado): ?>
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

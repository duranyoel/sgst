<?php
echo $this->Form->create('Service', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"></i> Modificacion de datos de ordenes de servcios </h3>
    </div>
    <div class="box-body">
        <div class="">
            <div class="">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Del Cliente</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Datos De La Orden</a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="cedula">Cedula:</label>
                                    <?php
                                    echo $this->Form->input('cedula', array('class' =>
                                        'form-control', 'placeholder' => '12345678',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Customer']['cedula'],
                                        'title' => 'Por Favor Ingrese Su Cedula'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="apellidos">Apellidos:</label>
                                    <?php
                                    echo $this->Form->input('apellidos', array('class' =>
                                        'form-control', 'placeholder' => 'Potter',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Customer']['apellidos'],
                                        'title' => 'Por Favor Ingrese Sus Apellidos'));
                                     echo $this->Form->input('customer_id', array(
                                        'label' => false, 'type' => 'hidden',
                                        'value'=>$datos['Customer']['id']));
                                    ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="nombres">Nombres:</label>
                                    <?php
                                    echo $this->Form->input('nombres', array('class' =>
                                        'form-control', 'placeholder' => 'Harry',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Customer']['nombres'],
                                        'title' => 'Por Favor Ingrese Sus Nombres'));
                                    ?>  
                                </div>
                                
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="email">Email:</label>
                                    <?php
                                    echo $this->Form->input('email', array('class' =>
                                        'form-control', 'placeholder' => 'demo@gmail.com',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Customer']['email'],
                                        'title' => 'Por Favor Ingrese email'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="telefono">Teléfono:</label>
                                    <?php
                                    echo $this->Form->input('telefono', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Customer']['telefono'],
                                        'data-inputmask'=>'"mask":"(+99)(999) 999-9999"', 'data-mask',
                                        'title' => 'Por Favor Ingrese Su Telefono'));
                                    ?>  
                                </div>
                                                          
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Tipo:</label>
                                        <?php
                                        echo $this->Form->input('tipo', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Tipo',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'default'=>$datos['Customer']['tipo'],
                                            'options' => array('Natural' => 'Natural',
                                                'Juridico' => 'Juridico')))
                                        ?>  

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="file">Imagen:</label>
                                        <?php
                                        echo $this->Form->input('image', array('class' =>
                                            'form-control', 'placeholder' => 'Tecnico',
                                            'label' => false, 'maxlength' => '100',
                                            'title' => 'Por Favor Ingrese Su Cargo',
                                            //'id'=>'file',
                                            'type' => 'file'));
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        //'value' => $usuario['User']['cargo']));
                                        ?>  

                                </div>
                                <?php if (!empty($datos)) {
                                    ?>
                                    <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                        <label for="file">Imagen Actual:</label>
                                        <p><?php
                                            if ($datos['Customer']['imagen'] == 'Ninguna' || $datos['Customer']['imagen'] == null) {
                                                echo $this->Html->image('avatar5.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                                            } else {
                                                echo $this->Html->image('uploads/customers/' . $datos['Customer']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'profile-user-img img-responsive img-circle'));
                                            }
                                            ?></p>

                                    </div>


                                    <?php
                                }
                                ?>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="direccion">Dirección:</label>
                                        <?php
                                        echo $this->Form->input('direccion', array('class' =>
                                            'form-control', 'placeholder' => 'Calle el centro',
                                            'label' => false, 'maxlength' => '100',
                                            'title' => 'Por Favor Ingrese Su Cargo',
                                            'value'=>$datos['Customer']['direccion'],
                                            'type' => 'textarea'));
                                        ?>  

                                </div>
                                
                            </div>  

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Oficina/Local:</label>
                                        <?php
                                        echo $this->Form->input('office_id', array('label' => false,
                                            'class' => 'form-control select2', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Estatus',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'options' => $offices,
                                            'default'=>$datos['Service']['office_id'],
                                            ))
                                        ?>   
                                </div>
                                
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Tipo de servicio:</label>
                                        <?php
                                        echo $this->Form->input('tipo_servicio', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Estatus',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'default'=>$datos['Service']['tipo_servicio'],
                                            'options' => array(
                                                'Computador' => 'Computador',                                           
                                                'Portatil' => 'Portatil',
                                                'Psp' => 'Psp',
                                                'Tv' => 'Tv',
                                                'Otros' => 'Otros',
                                                )))
                                        ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="codigo">Codigo:</label>
                                    <?php
                                    echo $this->Form->input('codigo', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        
                                        'value'=>$datos['Service']['codigo'],
                                        'readonly'=>true,
                                        
                                        'title' => 'Por Favor Ingrese Codigo De Orden'));
                                    
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="num_serie">Numero De Serie:</label>
                                    <?php
                                    echo $this->Form->input('num_serie', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['num_serie'],
                                        'title' => 'Por Favor ingrese numero de serie si posee el equipo'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="nombre">Nombre:</label>
                                    <?php
                                    echo $this->Form->input('nombre', array('class' =>
                                        'form-control', 'placeholder' => 'Telefono Iphone',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['nombre'],
                                        'title' => 'Por Favor Ingrese Un Nombre'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="color">Color:</label>
                                    <?php
                                    echo $this->Form->input('color', array('class' =>
                                        'form-control', 'placeholder' => 'Negro con blanco',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['color'],
                                        'title' => 'Por Favor Ingrese Un Color'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Bloqueo?:</label>
                                        <?php
                                        echo $this->Form->input('bloqueo', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Estatus',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'default'=>$datos['Service']['bloqueo'],
                                            'options' => array(
                                                
                                                '0' => 'No',
                                                '1' => 'Si',
                                                )))
                                        ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="usuario">Usuario  si posee:</label>
                                    <?php
                                    echo $this->Form->input('usuario', array('class' =>
                                        'form-control', 'placeholder' => 'Admin',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['usuario'],
                                        'title' => 'Por Favor Ingrese el usuario si este posee'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="clave">Clave:</label>
                                    <?php
                                    echo $this->Form->input('clave', array('class' =>
                                        'form-control', 'placeholder' => '12345678',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['clave'],
                                        'title' => 'Por Favor Ingrese la clave si este posee'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="fecha_recibido">Fecha Recibido:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <?php
                                    echo $this->Form->input('fecha_recibidos', array('class' =>
                                        'form-control pull-right', 'placeholder' => '12345678',
                                        'label' => false, 'maxlength' => '100',
                                        'id'=>'datepicker',
                                        'value'=>$this->Time->format('Y-m-d', $datos['Service']['fecha_recibido']),
                                        'title' => 'Por Favor Ingrese la fecha de recepción del equipo'));
                                    ?> 
                                      
                                    </div>
                                     
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="fecha_entrega">Fecha Posible Entrega:</label>
                                   <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <?php
                                        echo $this->Form->input('fecha_entregas', array('class' =>
                                        'form-control pull-right', 'placeholder' => '12345678',
                                        'label' => false, 'maxlength' => '100',
                                        'id'=>'datepickerentrega',
                                        'value'=>$this->Time->format('Y-m-d', $datos['Service']['fecha_entrega']),
                                        'title' => 'Por Favor Ingrese la fecha de entrega del equipo'));
                                    ?> 
                                      
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Garantia?:</label>
                                        <?php
                                        echo $this->Form->input('garantia', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione Si tiene garantia',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'default'=>$datos['Service']['garantia'],
                                            'options' => array(
                                                
                                                '0' => 'No',
                                                '1' => 'Si',
                                                )))
                                        ?>   
                                </div>
                               <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="fecha_entrega">Dias De Garantia:</label>
                                    <?php
                                    echo $this->Form->input('dias_garantia', array('class' =>
                                        'form-control', 'placeholder' => '30',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['dias_garantia'],
                                        'title' => 'Por Favor Ingrese los dia de garantia del equipo'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="fecha_entrega">Costo del servicio:</label>
                                    <?php
                                    echo $this->Form->input('costo_servicio', array('class' =>
                                        'form-control', 'placeholder' => '30000',
                                        'label' => false, 'maxlength' => '100',
                                        'value'=>$datos['Service']['costo_servicio'],
                                        'title' => 'Por Favor Ingrese el costo total  del servicio'));
                                    ?>  
                                </div>
                                <hr>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="descripcion">Descripción del equipo:</label>
                                        <?php
                                        echo $this->Form->input('descripcion', array('class' =>
                                            'form-control', 'placeholder' => 'Telefono negro con blanco,emei n°xxxxx,Computador negro marca acer',
                                            'label' => false,
                                            'value'=>$datos['Service']['descripcion'],
                                            'title' => 'Ingrese una descripcion general del equipo',
                                            'type' => 'textarea'));
                                        ?>  

                                </div>
                                    
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="estado">Estado del equipo:</label>
                                        <?php
                                        echo $this->Form->input('estado', array('class' =>
                                            'form-control', 'placeholder' => 'El equipo le faltan las teclas A,B,C',
                                            'label' => false,
                                            'value'=>$datos['Service']['estado'],
                                            'title' => 'Ingrese el estado general del equipo',
                                            'type' => 'textarea'));
                                        ?>  

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="observaciones">Detalle del servicio/Observaciones:</label>
                                        <?php
                                        echo $this->Form->input('observaciones', array('class' =>
                                            'form-control', 'placeholder' => 'El cliente  hizo abono de 20',
                                            'label' => false,
                                            'value'=>$datos['Service']['observaciones'],
                                            'title' => 'Ingrese algun detalle u observación para la orden de servicio',
                                            'type' => 'textarea'));
                                        ?>  

                                </div>
                                

                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
    </div>
    <!-- /.box-body -->
</div>
<?php
echo $this->Form->end();
?>
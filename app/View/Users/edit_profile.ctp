<?php
echo $this->Form->create('User', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"></i> Editar Datos De Usuario</h3>
    </div>
    <div class="box-body">
        <div class="">
            <div class="">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Personales</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Datos De Usuario</a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="apellidos">Apellidos:</label>
                                    <?php
                                    echo $this->Form->input('apellidos', array('class' =>
                                        'form-control', 'placeholder' => 'Potter',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Sus Apellidos',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['apellidos']));
                                    ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="nombres">Nombres:</label>
                                    <?php
                                    echo $this->Form->input('nombres', array('class' =>
                                        'form-control', 'placeholder' => 'Harry',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Sus Nombres',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['nombres']));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="cedula">Cedula:</label>
                                    <?php
                                    echo $this->Form->input('cedula', array('class' =>
                                        'form-control', 'placeholder' => '12345678',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Su Cedula',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['cedula']));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="telefono">Teléfono:</label>
                                    <?php
                                    echo $this->Form->input('telefono', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Su Telefono',
                                        'data-inputmask'=>'"mask":"(+99)(999) 999-9999"', 'data-mask',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['telefono']));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="exampleInputEmail1">Cargo:</label>
                                    <?php
                                    echo $this->Form->input('cargo', array('class' =>
                                        'form-control', 'placeholder' => 'Tecnico',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Su Cargo',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['cargo']));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Pais:</label>
                                    <?php
                                    echo $this->Form->input('countries', array('label' => false,
                                        'class' => 'form-control select2',
                                        'type' => 'select', 'style' => 'width: 100%;',
                                        'title' => 'Por Favor Seleccione Un Pais',
                                        'options' => array('Seleccione' => 'Seleccione', $countries),
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'default' => $usuario['Country']['id']));
                                    $this->Js->get('#UserCountries')->event(
                                            'change', $this->Js->request(array(
                                                'controller' => 'states',
                                                'action' => 'getByCountries'), array(
                                                'update' => '#UserStates',
                                                'async' => true,
                                                'dataExpression' => true,
                                                'method' => 'post',
                                                'data' => $this->Js->serializeForm(array('isForm' => true,
                                                    'inline' => true)))));
                                    ?>

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Estado:</label>

                                    <?php
                                    echo $this->Form->input('states', array('label' => false,
                                        'class' => 'form-control select2',
                                        'type' => 'select', 'style' => 'width: 100%;',
                                        'title' => 'Por Favor Seleccione Un Municipio',
                                        'options' => array('Seleccione' => 'Seleccione', $states),
                                        'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'default' => $usuario['State']['id']));
                                    $this->Js->get('#UserStates')->event(
                                            'change', $this->Js->request(array(
                                                'controller' => 'municipalities',
                                                'action' => 'getByEstados'), array(
                                                'update' => '#UserMunicipalityId',
                                                'async' => true,
                                                'dataExpression' => true,
                                                'method' => 'post',
                                                'data' => $this->Js->serializeForm(array('isForm' => true,
                                                    'inline' => true)))));
                                    ?>


                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Municipio/Ciudad:</label>
                                        <?php
                                        echo $this->Form->input('municipality_id', array('label' => false,
                                            'class' => 'form-control select2',
                                            'type' => 'select', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione Un Municipio',
                                            'options' => array('Seleccione' => 'Seleccione', $municipalities),
                                            'data-placement' => 'top', 'data-rel' => 'tooltip',
                                            'default' => $usuario['Municipality']['id']));

                                        if (count($municipalities) == 0) {
                                            echo '<button class="glyphicon glyphicon-lock form-control-feedback"></button>';
                                        }
                                        ?>

                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Sexo:</label>
                                        <?php
                                        echo $this->Form->input('sexo', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Sexo',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'options' => array('Femenino' => 'Femenino',
                                                'Masculino' => 'Masculino'),
                                            'selected' => $usuario['User']['sexo']))
                                        ?>   

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Tipo:</label>
                                        <?php
                                        echo $this->Form->input('tipo_legal', array('label' => false,
                                            'class' => 'form-control', 'style' => 'width: 100%;',
                                            'title' => 'Por Favor Seleccione El Tipo',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                                            'options' => array('Natural' => 'Natural',
                                                'Juridico' => 'Juridico'),
                                            'selected' => $usuario['User']['tipo_legal']))
                                        ?>  

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="direccion">Dirección:</label>
                                        <?php
                                        echo $this->Form->input('direccion', array('class' =>
                                            'form-control', 'placeholder' => 'Cale el centro',
                                            'label' => false, 'maxlength' => '100',
                                            'title' => 'Por Favor Ingrese Su Cargo',
                                            'type' => 'textarea',
                                            //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                            'value' => $usuario['User']['direccion']));
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
                            </div>  

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="username">Usuario:</label>
                                    <?php
                                    echo $this->Form->input('username', array('class' =>
                                        'form-control', 'placeholder' => 'demo@gmail.com',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Su Usuario',
                                        //'data-placement' => 'top', 'data-rel' => 'tooltip',
                                        'value' => $usuario['User']['username']));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="password">Contraseña:</label>
                                    <?php
                                    echo $this->Form->input('passwordnuevo', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Ingrese Su Nueva Contreseña',
                                        'type' => 'password'));
                                    
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="reppassword">Rep Contraseña:</label>
                                    <?php
                                    echo $this->Form->input('reppassword', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Por Favor Repita la contraseña',
                                        'type' => 'password'));
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

<script type="application/javascript">
    actualnamespace.push('Filtros/general');
</script>
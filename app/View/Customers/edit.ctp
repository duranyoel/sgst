<?php
echo $this->Form->create('Customer', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"></i> Editar datos de clientes</h3>
    </div>
    <div class="box-body">
        <div class="">
            <div class="">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Del Cliente</a></li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="cedula">Cedula:</label>
                                    <?php
                                    echo $this->Form->input('cedula', array('class' =>
                                        'form-control', 'placeholder' => 'Potter',
                                        'label' => false, 'maxlength' => '100',
                                        'required',
                                        'value' => $datos['Customer']['cedula'],
                                        'title' => 'Por Favor Ingrese Sus Apellidos'));
                                    ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="apellidos">Apellidos:</label>
                                    <?php
                                    echo $this->Form->input('apellidos', array('class' =>
                                        'form-control', 'placeholder' => 'Potter',
                                        'label' => false, 'maxlength' => '100',
                                        'required',
                                        'value' => $datos['Customer']['apellidos'],
                                        'title' => 'Por Favor Ingrese Sus Apellidos'));
                                    ?>   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="nombres">Nombres:</label>
                                    <?php
                                    echo $this->Form->input('nombres', array('class' =>
                                        'form-control', 'placeholder' => 'Harry',
                                        'label' => false, 'maxlength' => '100',
                                        'required',
                                        'value' => $datos['Customer']['nombres'],
                                        'title' => 'Por Favor Ingrese Sus Nombres'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="email">Email:</label>
                                    <?php
                                    echo $this->Form->input('email', array('class' =>
                                        'form-control', 'placeholder' => 'demo@gmail.com',
                                        'label' => false, 'maxlength' => '100',
                                        'required',
                                        'value' => $datos['Customer']['email'],
                                        'type' => 'email',
                                        'title' => 'Por Favor Ingrese email'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="telefono">Teléfono:</label>
                                    <?php
                                    echo $this->Form->input('telefono', array('class' =>
                                        'form-control', 'placeholder' => '',
                                        'label' => false, 'maxlength' => '100',
                                        'value' => $datos['Customer']['telefono'],
                                        'data-inputmask' => '"mask":"(+99)(999) 999-9999"', 'data-mask',
                                        'title' => 'Por Favor Ingrese Su Telefono'));
                                    ?>  
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label>Tipo:</label>
                                    <?php
                                    echo $this->Form->input('tipo', array('label' => false,
                                        'class' => 'form-control', 'style' => 'width: 100%;',
                                        'title' => 'Por Favor Seleccione El Tipo',
                                        'default' => $datos['Customer']['tipo'],
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
                                        'type' => 'file'));
                                    ?>  

                                </div>
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
                                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                                    <label for="direccion">Dirección:</label>
                                    <?php
                                    echo $this->Form->input('direccion', array('class' =>
                                        'form-control', 'placeholder' => 'Calle el centro',
                                        'label' => false, 'maxlength' => '100',
                                        'title' => 'Dirección',
                                        'value' => $datos['Customer']['direccion'],
                                        'type' => 'textarea'));
                                    ?>  

                                </div>

                            </div>  

                        </div>
                        <!-- /.tab-pane -->

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
<?php
echo $this->Form->create('Office', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de datos de su empresa</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <?php
                echo $this->Form->input('nombre', array('class' =>
                    'form-control', 'placeholder' => 'demo empresa',
                    'label' => false, 'maxlength' => '100',
                    'value'=>$datos['Office']['nombre'],
                    'title' => 'Por Favor Ingrese El nombre de su empresa'));
                ?>  
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <?php
                echo $this->Form->input('telefono', array('class' =>
                    'form-control', 'placeholder' => 'demo empresa',
                    'value'=>$datos['Office']['telefono'],
                    'data-inputmask'=>'"mask":"(+99)(999) 999-9999"', 'data-mask',
                    'label' => false, 'maxlength' => '100',
                    'title' => 'Por Favor Ingrese el numero de telefono de la empresa'));
                ?>  
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <?php
                echo $this->Form->input('direccion', array('class' =>
                    'form-control', 'placeholder' => 'Cale el centro',
                    'label' => false, 'maxlength' => '100',
                    'value'=>$datos['Office']['direccion'],
                    'title' => 'Por Favor Ingrese Su direccion',
                    'type' => 'textarea'));
                ?>  
            </div>


        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        </div>
    </form>
</div>
<?php
echo $this->Form->end();
?>
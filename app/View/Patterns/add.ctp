<?php
echo $this->Form->create('Pattern', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de modelos de equipos/articulos/respuestos</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
        <div class="form-group">
            <label>Marca:</label>
            <?php
            echo $this->Form->input('trademark_id', array('label' => false,
                'class' => 'form-control select2',
                'type' => 'select', 'style' => 'width: 100%;',
                'title' => 'Por Favor Seleccione',
                //'default'=>$services['Service']['nombre'],
                'options' => array('Seleccione' => 'Seleccione', $marcas)));
            ?>

        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <?php
            echo $this->Form->input('nombre', array('class' =>
                'form-control', 'placeholder' => 'Demo',
                'label' => false, 'maxlength' => '100',
                'title' => 'Por Favor Ingrese El nombre del modelo'));
            ?>  
        </div>
        <div class="form-group">
            <label for="file">Imagen:</label>
            <?php
            echo $this->Form->input('image', array('class' =>
                'form-control', 'placeholder' => '',
                'label' => false, 'maxlength' => '100',
                'title' => 'Por Favor Ingrese Su Cargo',
                //'id'=>'file',
                'type' => 'file'));
           
            ?>  

        </div>
        <div class="form-group">
            <label for="direccion">Descripción:</label>
            <?php
            echo $this->Form->input('descripcion', array('class' =>
                'form-control', 'placeholder' => '',
                'label' => false, 'maxlength' => '500',
                'title' => 'Por Favor Ingrese una descripción',
                'type' => 'textarea'));
            ?>  
        </div>


    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Guardar</button>
    </div>

</div>
<?php
echo $this->Form->end();
?>

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
                'default'=>$datos['Pattern']['trademark_id'],
                'options' => array('Seleccione' => 'Seleccione', $marcas)));
            ?>

        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <?php
            echo $this->Form->input('nombre', array('class' =>
                'form-control', 'placeholder' => 'demo empresa',
                'label' => false, 'maxlength' => '100',
                'value'=>$datos['Pattern']['nombre'],
                'title' => 'Por Favor Ingrese El nombre del modelo'));
            ?>  
        </div>
        <div class="form-group">
            <label for="file">Imagen:</label>
            <?php
            echo $this->Form->input('image', array('class' =>
                'form-control', 'placeholder' => 'Tecnico',
                'label' => false, 'maxlength' => '100',
                'title' => 'Por Favor Ingrese Su Cargo',
                //'id'=>'file',
                
                'type' => 'file'));
           
            ?>  

        </div>
        <div class="form-group">
                    <label for="file">Imagen Actual:</label>
                    <p><?php 
                    
                    if ($datos['Pattern']['imagen'] == 'Ninguna' || $datos['Pattern']['imagen'] == null) {
                    echo $this->Html->image('avatar5.png', array('alt' => 'Foto', 'border' => '0', 
                        'class' => 'profile-user-img img-responsive'));
                        } else {
                            echo $this->Html->image('uploads/patterns/' . $datos['Pattern']['imagen'],
                                    array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        }
                       
                 ?></p>

                </div>
        <div class="form-group">
            <label for="direccion">Descripción:</label>
            <?php
            echo $this->Form->input('descripcion', array('class' =>
                'form-control', 'placeholder' => '',
                'label' => false, 'maxlength' => '500',
                'value'=>$datos['Pattern']['descripcion'],
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

<script>
//$(document).ready(function () {
//    $("#AdvanceServiceId").on('change',function(){
//        $.ajax({
//           type:"POST",
//           url:"getTotal",
//           success:function(msg){
//               $("#total").html(msg);
//           }
//        });
//    });
//    
//});    
</script>
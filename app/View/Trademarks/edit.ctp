<?php
echo $this->Form->create('Trademark', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de datos de marcas</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <?php
                echo $this->Form->input('nombre', array('class' =>
                    'form-control', 'placeholder' => 'Demo Marca',
                    'label' => false, 'maxlength' => '100',
                    'value'=>$datos['Trademark']['nombre'],
                    'title' => 'Por Favor Ingrese El nombre de la marca'));
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
                    
                    if ($datos['Trademark']['imagen'] == 'Ninguna' || $datos['Trademark']['imagen'] == null) {
                    echo $this->Html->image('avatar5.png', array('alt' => 'Foto', 'border' => '0', 
                        'class' => 'profile-user-img img-responsive'));
                        } else {
                            echo $this->Html->image('uploads/trademarks/' . $datos['Trademark']['imagen'],
                                    array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        }
                
                 ?></p>

                </div>
            <div class="form-group">
                <label for="direccion">Descripcion:</label>
                <?php
                echo $this->Form->input('descripcion', array('class' =>
                    'form-control', 'placeholder' => 'Marca 1',
                    'label' => false, 'maxlength' => '100',
                    'value'=>$datos['Trademark']['descripcion'],
                    'title' => 'Por favor ingrese una descripcion',
                    'type' => 'textarea'));
                ?>  
            </div>
            

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        </div>
    
</div>
<?php
echo $this->Form->end();
?>
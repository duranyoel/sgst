<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle del modelo <?php echo $datos['Trademark']['nombre']; ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 
        <div class="box-body">
            <div class="form-group">
                <label>Nombre:</label>
                <p><?php echo $datos['Trademark']['nombre']; ?></p>    

            </div>
            
          
            <div class="form-group">
                    <label for="file">Imagen:</label>
                    <p><?php
                        if ($datos['Trademark']['imagen'] == 'Ninguna' || $datos['Trademark']['imagen'] == null) {
                            echo $this->Html->image('avatar5.png', array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        } else {
                            echo $this->Html->image('uploads/trademarks/' . $datos['Trademark']['imagen'], array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        }
                        ?></p>

            </div>
            <div class="form-group">
                <label for="direccion">Descripción:</label>
                <p><?php echo $datos['Trademark']['descripcion']; ?></p>
            </div>
            

        </div>
        <!-- /.box-body -->
   
</div>

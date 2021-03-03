<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle del modelo <?php echo $datos['Pattern']['nombre']; ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 
        <div class="box-body">
            <div class="form-group">
                <label>Marca:</label>
                <p><?php echo $datos['Trademark']['nombre']; ?></p>    

            </div>
            
           
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <p><?php echo $datos['Pattern']['nombre']; ?></p>
            </div>
            <div class="form-group">
                    <label for="file">Imagen:</label>
                    <p><?php
                        if ($datos['Pattern']['imagen'] == 'Ninguna' || $datos['Pattern']['imagen'] == null) {
                            echo $this->Html->image('avatar5.png', array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        } else {
                            echo $this->Html->image('uploads/patterns/' . $datos['Pattern']['imagen'], array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        }
                        ?></p>

            </div>
            <div class="form-group">
                <label for="direccion">Descripción:</label>
                <p><?php echo $datos['Pattern']['descripcion']; ?></p>
            </div>
            

        </div>
        <!-- /.box-body -->
   
</div>

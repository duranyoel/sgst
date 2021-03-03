<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle del articulo <?php echo $datos['Article']['nombre']; ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 
        <div class="box-body">
            <div class="form-group">
                <label>Marca:</label>
                <p><?php echo $datos['Pattern']['Trademark']['nombre']; ?></p>    

            </div>
            <div class="form-group">
                <label>Modelo:</label>
                <p><?php echo $datos['Pattern']['nombre']; ?></p>    

            </div>
            <div class="form-group">
                <label>Costo:</label>
                <p><?php  echo $this->Number->format( $datos['Article']['costo'], array(
                            'places' => 2,
                            'escape' => false,
                            'decimals' => '.',
                            'thousands' => ','
                        ));
                 ?></p>    

            </div>
           
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <p><?php echo $datos['Article']['nombre']; ?></p>
            </div>
            <div class="form-group">
                <label for="nombre">Codigo:</label>
                <p><?php echo $datos['Article']['codigo']; ?></p>
            </div>
            <div class="form-group">
                <label for="nombre">Color:</label>
                <p><?php echo $datos['Article']['color']; ?></p>
            </div>
            <div class="form-group">
                    <label for="file">Imagen:</label>
                    <p><?php
                        if ($datos['Article']['imagen'] == 'Ninguna' || $datos['Article']['imagen'] == null) {
                            echo $this->Html->image('avatar5.png', array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        } else {
                            echo $this->Html->image('uploads/articles/' . $datos['Article']['imagen'], array('alt' => 'Foto', 'border' => '0', 'class' => 'profile-user-img img-responsive'));
                        }
                        ?></p>

            </div>
            <div class="form-group">
                <label for="direccion">Descripción:</label>
                <p><?php echo $datos['Article']['descripcion']; ?></p>
            </div>
            

        </div>
        <!-- /.box-body -->
   
</div>

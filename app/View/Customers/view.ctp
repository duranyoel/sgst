<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> Datos del cliente <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-edit')) .
                                $this->Html->tag('span', 'Editar'), '/customers/edit/'.$datos['Customer']['id'], array('escape' => false));
                        ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="cedula">Cedula:</label>
                    <p><?php echo $datos['Customer']['cedula']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="apellidos">Apellidos:</label>
                    <p><?php echo $datos['Customer']['apellidos']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="nombres">Nombres:</label>
                    <p><?php echo $datos['Customer']['nombres']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="email">Email:</label>
                    <p><?php echo $datos['Customer']['email']; ?></p>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="telefono">Teléfono:</label>
                    <p><?php echo $datos['Customer']['telefono']; ?></p>
                </div>

                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label>Tipo:</label>
                    <p><?php echo $datos['Customer']['tipo']; ?></p>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                    <label for="file">Imagen:</label>
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
                    <p><?php echo $datos['Customer']['direccion']; ?></p>

                </div>
            </div>

        </div> 
       
        <!-- /.row -->

        <!-- /.row -->
    </div>
    
    <!-- /.box-body -->
</div>
<!-- /.modal -->

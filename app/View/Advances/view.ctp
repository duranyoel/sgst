<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Adelantos/abonos de servicios</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 
        <div class="box-body">
            <div class="form-group">
                <label>Servicio:</label>
                <p><?php echo $datos['Service']['nombre']; ?></p>    

            </div>
            
           
            <div class="form-group">
                <label for="nombre">Monto:</label>
                <p><?php echo $datos['Advance']['monto']; ?></p>
            </div>
            <div class="form-group">
                <label for="telefono">Fecha:</label>
                <p><?php echo $this->Time->format('d/m/Y H:i:s', $datos['Advance']['fecha']);?></p>
            </div>
            <div class="form-group">
                <label for="direccion">Descripción:</label>
                <p><?php echo $datos['Advance']['observacion']; ?></p>
            </div>
            

        </div>
        <!-- /.box-body -->
   
</div>

<?php
echo $this->Form->create('Advance', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Editar de adelantos/abonos de servicios</h3>
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
            <?php
            echo $this->Form->input('monto', array('class' =>
                'form-control', 'placeholder' => '20000',
                'label' => false, 'maxlength' => '100',
                'type' => 'number',
                'value'=>$datos['Advance']['monto'],
                'title' => 'Por Favor Ingrese El monto'));
            ?>  
        </div>
        <div class="form-group">
            <label for="telefono">Fecha:</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <?php
                echo $this->Form->input('fecha', array('class' =>
                    'form-control pull-right', 'placeholder' => '12345678',
                    'label' => false, 'maxlength' => '100',
                    'id' => 'datepicker',
                    'type' => 'text',
                     'value'=>$datos['Advance']['fecha'],
                    'title' => 'Por Favor Ingrese la fecha de recepción'));
                ?> 

            </div>
        </div>
        <div class="form-group">
            <label for="direccion">Descripción:</label>
            <?php
            echo $this->Form->input('observacion', array('class' =>
                'form-control', 'placeholder' => 'El cliente abona la mitad del servicio',
                'label' => false, 'maxlength' => '500',
                 'value'=>$datos['Advance']['observacion'],
                'title' => 'Por Favor Ingrese una descripción',
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
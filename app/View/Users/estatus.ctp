<?php
echo $this->Form->create('User', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"></i> Editar Datos De Usuario</h3>
    </div>
    <div class="box-body">
        <div class="row">

            <div class="form-group col-md-6 col-sm-6 col-lg-3 col-xl-4">
                <label>Estatus:</label>
                <?php
                echo $this->Form->input('estatus', array('label' => false,
                    'class' => 'form-control', 'style' => 'width: 100%;',
                    'title' => 'Por Favor Seleccione El Estatus',
                    //'data-placement' => 'top', 'data-rel' => 'tooltip', 'data-placeholder' => 'Seleccione Uno',
                    'options' => array('Activo' => 'Activo',
                        'Bloqueado' => 'Bloqueado'),
                    'selected' => $datos['User']['estatus']))
                ?>   
            </div>


        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
    </div>
    <!-- /.box-body -->
</div>
<?php
echo $this->Form->end();
?>

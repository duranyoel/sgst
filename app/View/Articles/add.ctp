<?php
echo $this->Form->create('Article', array('role' => 'form',
    'type' => 'file'));
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de equipos/articulos/respuestos</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
        <div class="form-group col-md-6">
            <label>Oficina:</label>
            <?php
            echo $this->Form->input('office_id', array('label' => false,
                'class' => 'form-control select2',
                'type' => 'select', 'style' => 'width: 100%;',
                'title' => 'Por Favor Seleccione',
                //'default'=>$services['Service']['nombre'],
                'options' => array('Seleccione' => 'Seleccione', $offices)));
            ?>

        </div>
        <div class="form-group col-md-6">
            <label>Marca:</label>
            <?php
            echo $this->Form->input('marca', array('label' => false,
                'class' => 'form-control select2',
                'type' => 'select', 'style' => 'width: 100%;',
                'title' => 'Por Favor Seleccione',
                //'default'=>$services['Service']['nombre'],
                'options' => array('Seleccione' => 'Seleccione', $marcas)));
            
            ?>

        </div>
        <div class="form-group col-md-6">
            <label>Modelo:</label>
            <?php
            echo $this->Form->input('model_id', array('label' => false,
                'class' => 'form-control select2',
                'type' => 'select', 'style' => 'width: 100%;',
                'title' => 'Por Favor Seleccione',
                //'default'=>$services['Service']['nombre'],
                'options' => array('Seleccione' => 'Seleccione', $modelos)));
            $this->Js->get('#ArticleMarca')->event(
                        'change', $this->Js->request(array(
                            'controller' => 'patterns',
                            'action' => 'get_by_marca'), array(
                            'update' => '#ArticleModelId',
                            'async' => true,
                            'dataExpression' => true,
                            'method' => 'post',
                            'data' => $this->Js->serializeForm(array('isForm' => true,
                                'inline' => true)))));
            ?>

        </div>
        <div class="form-group col-md-6">
            <label for="nombre">Costo:</label>
            <?php
            echo $this->Form->input('costo', array('class' =>
                'form-control', 'placeholder' => '5000',
                'label' => false, 'maxlength' => '100',
                'title' => 'Por Favor Ingrese El costo del articulo'));
            ?>  
        </div>
        <div class="form-group col-md-6">
            <label for="nombre">Nombre:</label>
            <?php
            echo $this->Form->input('nombre', array('class' =>
                'form-control', 'placeholder' => 'demo',
                'label' => false, 'maxlength' => '100',
                'title' => 'Por Favor Ingrese El nombre del modelo'));
            ?>  
        </div>
        <div class="form-group col-md-6">
            <label for="nombre">Codigo:</label>
            <?php
            echo $this->Form->input('codigo', array('class' =>
                'form-control', 'placeholder' => '',
                'label' => false, 'maxlength' => '100',
                'type'=>'number',
                'title' => ''));
            ?>  
        </div>
        <div class="form-group col-md-6">
            <label for="nombre">Color:</label>
            <?php
            echo $this->Form->input('color', array('class' =>
                'form-control', 'placeholder' => '15552',
                'label' => false, 'maxlength' => '100',                
                'title' => ''));
            ?>  
        </div>
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-12">
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
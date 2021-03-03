<label for="nombre">Total costo del servicio:</label>
<?php
//pr($articlesservicestotales);
if(isset($articlesservicestotales)){
    $totalcosto=$servicios['Service']['costo_servicio']+$articlesservicestotales[0][0]['Total'];
}else{
    $totalcosto=$servicios['Service']['costo_servicio'];
}

echo $this->Form->input('total', array('class' =>
    'form-control', 'placeholder' => '20000',
    'label' => false, 'maxlength' => '100',
    'type'=>'number',
    'readonly'=>true,
    'value'=>$totalcosto,
    'title' => 'Monto total del servicio'));
?>  
<div class="form-group">
    <label for="nombre">Total abonado hasta ahora:</label> 
    <?php
    echo $this->Form->input('totalabonos', array('class' =>
        'form-control', 'placeholder' => '20000',
        'label' => false, 'maxlength' => '100',
        'type'=>'number',
        'readonly'=>true,
        'value'=>$servicestotales[0][0]['Total'],
        'title' => 'Monto total abonado del servicio'));
?>  
</div>
<div class="form-group">
    <label for="nombre">Resta:</label> 
    <?php
    $resto = $totalcosto - $servicestotales[0][0]['Total'];
    echo $this->Form->input('resto', array('class' =>
        'form-control', 'placeholder' => '20000',
        'label' => false, 'maxlength' => '100',
        'type'=>'number',
        'readonly'=>true,
        'value'=>$resto,
        'title' => 'Total deuda del servicio'));
?>  
</div>
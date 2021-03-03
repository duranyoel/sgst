
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="danger">
                <th>Id</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Costo</th>
                 <th>Descripción</th>
                <th class="actions"><?php echo __('Acción'); ?></th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($articulos as $lista): 
                echo $this->Form->input('articles_id', array(
                    'id'=>'articles_id',
                    'type'=>'hidden',
                    'value'=>   $lista['id'],
                    'required'=>'false'
                    
                    ));
            
             echo $this->Form->input('nombre', array(
                    'id'=>'nombre',
                    'type'=>'hidden',
                    'value'=>   $lista['nombre'],
                    'required'=>'false'
                    
                    )); 
             echo $this->Form->input('codigo', array(
                    'id'=>'codigo',
                    'type'=>'hidden',
                    'value'=>   $lista['codigo'],
                    'required'=>'false'
                    
                    ));
             
              echo $this->Form->input('costo', array(
                    'id'=>'costo',
                    'type'=>'hidden',
                    'value'=>   $lista['costo'],
                    'required'=>'false'
                    
                    ));
              
                    
                    ?>
                <tr>
                    <td><?php echo $this->Html->link(__(h($lista['id'])), array('action' => 'view', $lista['id']),array('parent'=>'blank')); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link(__(h($lista['codigo'])), array('action' => 'view', $lista['id']),array('parent'=>'blank')); ?>&nbsp;</td>


                    <td><?php echo $lista['nombre']; ?>&nbsp;</td>
                    <td><?php  echo $this->Number->format($lista['costo'], array(
                                                        'places' => 2,
                                                        'escape' => false,
                                                        'decimals' => '.',
                                                        'thousands' => ','
                                                    ));?>&nbsp;</td>
                    <td><?php echo $this->Form->input('descripcionarticle', array('class' =>
                                    'form-control',
                                    'placeholder' => '',
                                    'label' => false,
                                    'rows'=>2,
                                    'title' => 'Ingrese una descripcion general',
                                    'type' => 'textarea')); ?>&nbsp;</td>
                    <td class="actions">
                        <button type="button" class="btn btn-primary btn-sm btn-flat" onCLick="articles.addarticle();"><span class="fa fa-plus"></span>&nbsp;Agregar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
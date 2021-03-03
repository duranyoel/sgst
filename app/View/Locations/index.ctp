<div class="col-md-2">
    <h4 class="titulomenu">Menu</h4>
    <aside>

        <div class="list-group">

                  <?php 
                 
                 echo $this->Html->link(' Paises', 
                                array('controller'=>'countries','action'=>'index'),
                              array('class'=>'list-group-item glyphicon glyphicon-list','title'=>'Paises'));
                 echo $this->Html->link(' Estados', 
                                array('controller'=>'states','action'=>'index'),
                              array('class'=>'list-group-item glyphicon glyphicon-list','title'=>'Estados'));
                 echo $this->Html->link(' Municipios', 
                                array('controller'=>'municipalities','action'=>'index'),
                              array('class'=>'list-group-item glyphicon glyphicon-list','title'=>'Municipios'));
                 echo $this->Html->link(' Parroquias', 
                                array('controller'=>'locations','action'=>'index'),
                              array('class'=>'list-group-item active glyphicon glyphicon-list','title'=>'Parroquias'));
                 
                  ?>



        </div>
    </aside>
</div>
<div class="col-md-10">
    <h2><?php echo __('Locations'); ?></h2>
    <?php echo $this->Form->create('Location', array('class' => 'form-inline')); ?>
    <div class="input-group">
        <input type="text" class="form-control" name="buscar" placeholder="Buscar" title="Por Favor Ingrese su Busquedad">

    </div>


    <button class="btn btn-flat btn-primary" type="submit">
        <span class="glyphicon glyphicon-search"></span>&nbsp;Buscar
    </button>
    <hr>   

<?php 
	echo $this->Html->link(__(' Agregar Registro'), array('action' => 'add'), array('class' => 'btn btn-flat btn-success glyphicon glyphicon-plus', 'title' => 'Agregar Nuevos Registros')); 
	echo '&nbsp;',$this->Html->link(__(' Imprimir Listado'), array('controller'=>'datos','action' => 'imprimir','ext' => 'pdf'), array('class' => 'btn btn-flat btn-success glyphicon glyphicon-print', 'title' => 'Agregar Nuevos Registros'));
?>
<?php echo $this->Form->end() ?>
    <hr>
    <div class="locations index">
        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('municipality_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('borrado'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
	<?php foreach ($locations as $location): ?>
                <tr>
                    <td><?php echo h($location['Location']['id']); ?>&nbsp;</td>
                    <td>
			<?php echo $this->Html->link($location['Municipality']['nombre'], array('controller' => 'municipalities', 'action' => 'view', $location['Municipality']['id'])); ?>
                    </td>
                    <td><?php echo h($location['Location']['nombre']); ?>&nbsp;</td>
                    
                    <td><?php if ($location['Location']['borrado']){
                        echo 'Si';
                    }else{
                        echo 'No';
                    }
                     ?>&nbsp;</td>
                    <td><?php echo $this->Time->format('d/m/Y',h($location['Location']['created'])); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format('d/m/Y',h($location['Location']['modified'])); ?>&nbsp;</td>
                    
                    <td class="actions">
                        <div class="btn-group">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Acción
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php echo $this->Html->link(__('Ver'), array('action' => 'view', $location['Location']['id'])); ?></li>
                                <li><?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $location['Location']['id'])); ?></li>



                            </ul>
                        </div>
			
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('paginado'); ?>
    </div>

</div>

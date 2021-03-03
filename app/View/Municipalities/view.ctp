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
    <div class="municipalities view">
        <h2><?php echo __('Municipality'); ?></h2>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd>
			<?php echo h($municipality['Municipality']['id']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Nombre'); ?></dt>
            <dd>
			<?php echo h($municipality['Municipality']['nombre']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('State'); ?></dt>
            <dd>
			<?php echo $this->Html->link($municipality['State']['nombre'], array('controller' => 'states', 'action' => 'view', $municipality['State']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Borrado'); ?></dt>
            <dd><?php if ($municipality['Municipality']['borrado']){
                        echo 'Si';
                    }else{
                        echo 'No';
                    }
                     ?>
			
                &nbsp;
            </dd>
            
            <dt><?php echo __('Created'); ?></dt>
            <dd>
			<?php echo h($municipality['Municipality']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
			<?php echo h($municipality['Municipality']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
    
    <div class="related">
        <h3><?php echo __('Related Locations'); ?></h3>
	<?php if (!empty($municipality['Location'])): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed table-striped">
            <tr>
                <th><?php echo __('Id'); ?></th>
               
                <th><?php echo __('Nombre'); ?></th>
                <th><?php echo __('Borrado'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php foreach ($municipality['Location'] as $location): ?>
            <tr>
                <td><?php echo $location['id']; ?></td>
                
                <td><?php echo $location['nombre']; ?></td>
                <td><?php echo $location['borrado']; ?></td>
                <td><?php echo $location['created']; ?></td>
                <td><?php echo $location['modified']; ?></td>
                <td class="actions">
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Acción
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link(__('Ver'), array('controller' => 'locations','action' => 'view', $location['id'])); ?></li>
                            <li><?php echo $this->Html->link(__('Editar'), array('controller' => 'locations','action' => 'edit', $location['id'])); ?></li>



                        </ul>
                    </div>
                </td>
            </tr>
	<?php endforeach; ?>
        </table>
<?php endif; ?>
<div class="actions">
            <?php 
	echo $this->Html->link(__(' Agregar Registro'), array('controller' => 'locations','action' => 'add'), array('class' => 'btn btn-flat btn-success glyphicon glyphicon-plus', 'title' => 'Agregar Nuevos Registros')); ?>

        </div>
        
    </div>
</div>

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
    <div class="countries view">
        <h2><?php echo __('Pais'); ?></h2>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd>
			<?php echo h($country['Country']['id']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Nombre'); ?></dt>
            <dd>
			<?php echo h($country['Country']['nombre']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
			<?php echo h($country['Country']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
			<?php echo h($country['Country']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>

    <div class="related">
        <h3><?php echo __('Related Estados'); ?></h3>
	<?php if (!empty($country['State'])): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed table-striped">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Country Id'); ?></th>
                <th><?php echo __('Nombre'); ?></th>
                <th><?php echo __('Borrado'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
	<?php foreach ($country['State'] as $state): ?>
            <tr>
                <td><?php echo $state['id']; ?></td>
                <td><?php echo $state['country_id']; ?></td>
                <td><?php echo $state['nombre']; ?></td>
                <td><?php echo $state['borrado']; ?></td>
                <td><?php echo $state['created']; ?></td>
                <td><?php echo $state['modified']; ?></td>
                <td class="actions">
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Acción
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link(__('Ver'), array('controller' => 'states','action' => 'view', $state['id'])); ?></li>
                            <li><?php echo $this->Html->link(__('Editar'), array('controller' => 'states','action' => 'edit', $state['id'])); ?></li>



                        </ul>
                    </div>

                </td>
            </tr>
	<?php endforeach; ?>
        </table>
<?php endif; ?>
        <div class="actions">
            <?php 
	echo $this->Html->link(__(' Agregar Registro'), array('controller' => 'states','action' => 'add'), array('class' => 'btn btn-flat btn-success glyphicon glyphicon-plus', 'title' => 'Agregar Nuevos Registros')); ?>

        </div>

    </div>
</div>

<div class="locations view">
<h2><?php echo __('Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Municipality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($location['Municipality']['id'], array('controller' => 'municipalities', 'action' => 'view', $location['Municipality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($location['Location']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Borrado'); ?></dt>
		<dd>
			<?php echo h($location['Location']['borrado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($location['Location']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($location['Location']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $location['Location']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Municipalities'), array('controller' => 'municipalities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Municipality'), array('controller' => 'municipalities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Datos'), array('controller' => 'datos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dato'), array('controller' => 'datos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Datos'); ?></h3>
	<?php if (!empty($location['Dato'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Apellidos'); ?></th>
		<th><?php echo __('Nombres'); ?></th>
		<th><?php echo __('Cedula'); ?></th>
		<th><?php echo __('Telefono'); ?></th>
		<th><?php echo __('Sexo'); ?></th>
		<th><?php echo __('Direccion'); ?></th>
		<th><?php echo __('Centrovotacion'); ?></th>
		<th><?php echo __('Edad'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($location['Dato'] as $dato): ?>
		<tr>
			<td><?php echo $dato['id']; ?></td>
			<td><?php echo $dato['location_id']; ?></td>
			<td><?php echo $dato['apellidos']; ?></td>
			<td><?php echo $dato['nombres']; ?></td>
			<td><?php echo $dato['cedula']; ?></td>
			<td><?php echo $dato['telefono']; ?></td>
			<td><?php echo $dato['sexo']; ?></td>
			<td><?php echo $dato['direccion']; ?></td>
			<td><?php echo $dato['centrovotacion']; ?></td>
			<td><?php echo $dato['edad']; ?></td>
			<td><?php echo $dato['created']; ?></td>
			<td><?php echo $dato['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'datos', 'action' => 'view', $dato['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'datos', 'action' => 'edit', $dato['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'datos', 'action' => 'delete', $dato['id']), array('confirm' => __('Are you sure you want to delete # %s?', $dato['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dato'), array('controller' => 'datos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

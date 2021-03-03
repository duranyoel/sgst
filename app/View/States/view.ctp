<div class="states view">
<h2><?php echo __('State'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($state['State']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($state['Country']['id'], array('controller' => 'countries', 'action' => 'view', $state['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($state['State']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Borrado'); ?></dt>
		<dd>
			<?php echo h($state['State']['borrado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($state['State']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($state['State']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit State'), array('action' => 'edit', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete State'), array('action' => 'delete', $state['State']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $state['State']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Municipalities'), array('controller' => 'municipalities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Municipality'), array('controller' => 'municipalities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Municipalities'); ?></h3>
	<?php if (!empty($state['Municipality'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('State Id'); ?></th>
		<th><?php echo __('Borrado'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($state['Municipality'] as $municipality): ?>
		<tr>
			<td><?php echo $municipality['id']; ?></td>
			<td><?php echo $municipality['nombre']; ?></td>
			<td><?php echo $municipality['state_id']; ?></td>
			<td><?php echo $municipality['borrado']; ?></td>
			<td><?php echo $municipality['created']; ?></td>
			<td><?php echo $municipality['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'municipalities', 'action' => 'view', $municipality['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'municipalities', 'action' => 'edit', $municipality['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'municipalities', 'action' => 'delete', $municipality['id']), array('confirm' => __('Are you sure you want to delete # %s?', $municipality['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Municipality'), array('controller' => 'municipalities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

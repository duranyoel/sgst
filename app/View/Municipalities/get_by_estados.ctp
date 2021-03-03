<option value="Todos">Todos</option>
<?php foreach ($municipalities as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>
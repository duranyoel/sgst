<option value="Todos">Todos</option>
<?php foreach ($locations as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>
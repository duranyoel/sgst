<!-- Main Footer -->
<footer class="main-footer">
<!-- To the right -->
	<div class="pull-right hidden-xs">
       <?php echo $this->fetch('title'); ?>
	</div>
<!-- Default to the left -->
<strong>Copyright &copy; 2015 <?php 
echo $this->Html->link('Sistema De Gestión De Servicios Tecnicos', array('controller'=>'pages','action'=>'index'));
echo $this->element('sql_dump'); ?>.</strong> Algunos Derechos Reservados.
</footer>
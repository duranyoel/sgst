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
    <div class="locations form">
<?php echo $this->Form->create('Location'); ?>
        <fieldset>
            <legend><?php echo __('Editar Parroquias'); ?></legend>
            <div class="form-group col-xs-6">
                <label for="Estado">Municipio:<em>(*)</em></label>
            <?php
            echo $this->Form->input('municipality_id', array('label' => false,
                'class'=>'form-control',
                'title'=>'Por Favor seleccione el Municipio'))
            ?>                
            </div>
            <div class="form-group col-xs-6">
                <label for="Nombre">Nombre:<em>(*)</em></label>
            <?php
           echo $this->Form->input('nombre', array('class'=>'form-control','label' => false));
            ?>

            </div>
            <div class="form-group col-xs-6">
                <label for="Borrado">Borrado:<em>(*)</em></label>
            <?php
           echo $this->Form->input('borrado', array('label' => 'Si/No'));
            ?>
                <?php
		echo $this->Form->input('id');
		
	?>
            </div>
	
        </fieldset>
        <button class="btn btn-flat btn-primary pull-right" type="submit">
            <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
        </button>
<?php echo $this->Form->end(); ?>
    </div>

</div>

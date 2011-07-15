<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Add Submodulo'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Submodulo');?>
	<?php
		echo "<fieldset>".$this->Form->input('modulo_id', array('label'=>__('Modulo_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('tabla', array('label'=>__('Tabla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('disponiblepara', array('label'=>__('Disponiblepara',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('orden', array('label'=>__('Orden',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Esactivo',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Modulos', true), array('controller' => 'modulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Modulo', true), array('controller' => 'modulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Crops', true), array('controller' => 'crops', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('controller' => 'crops', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('controller' => 'multimedias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('controller' => 'opinionesmodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Valoraciones', true), array('controller' => 'valoraciones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Valoracion', true), array('controller' => 'valoraciones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
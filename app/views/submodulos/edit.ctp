<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Edit Submodulo'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Submodulo');?>
	<?php
		echo "".$this->Form->input('id', array('label'=>__('Id',true)))."";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('tabla', array('label'=>__('Tabla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Es activo',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $this->Form->value('Submodulo.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Submodulo.nombre'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
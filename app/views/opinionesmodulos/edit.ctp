<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Edit Opinionesmodulo'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Opinionesmodulo');?>
	<?php
		echo "<fieldset>".$this->Form->input('id', array('label'=>__('Id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('submodulo_id', array('label'=>__('Submodulo_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('itemid', array('label'=>__('Itemid',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('opinion_id', array('label'=>__('Opinion_id',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $this->Form->value('Opinionesmodulo.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Opinionesmodulo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Editar Localidad'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Localidad');?>
	<?php
		echo "".$this->Form->input('id', array('label'=>__('Id',true)))."";
		echo "<fieldset>".$this->Form->input('provincia_id', array('label'=>__('Provincia',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Localidad',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar este Localidad', true), array('action' => 'delete', $this->Form->value('Localidad.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Localidad.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Localidades', true), array('action' => 'index'));?></li>
<!-- 		<li><?php //echo $this->Html->link(__('Listado de Provincias', true), array('controller' => 'provincias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php //echo $this->Html->link(__('Nuevo Provincia', true), array('controller' => 'provincias', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php //echo $this->Html->link(__('Listado de Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php //echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Editar Provincia'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Provincia');?>
	<?php
		echo "".$this->Form->input('id', array('label'=>__('Id',true)))."";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Provincia',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar esta Provincia', true), array('action' => 'delete', $this->Form->value('Provincia.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Provincia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Provincias', true), array('action' => 'index'));?></li>
<!-- 		<li><?php //echo $this->Html->link(__('Listado de Localidades', true), array('controller' => 'localidades', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php //echo $this->Html->link(__('Nuevo Localidad', true), array('controller' => 'localidades', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
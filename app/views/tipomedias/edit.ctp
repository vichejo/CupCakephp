<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Edit Tipomedia'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Tipomedia');?>
	<?php
		echo "<fieldset>".$this->Form->input('id', array('label'=>__('Id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esvisible', array('label'=>__('Esvisible',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esmodificable', array('label'=>__('Esmodificable',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $this->Form->value('Tipomedia.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Tipomedia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Tipomedias', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('controller' => 'multimedias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
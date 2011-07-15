<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Edit Group'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Group');?>
	<?php
		echo "<fieldset>".$this->Form->input('id', array('label'=>__('Id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('name', array('label'=>__('Name',true)))."</fieldset>";
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
		<li><?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $this->Form->value('Group.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Groups', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo User', true), array('controller' => 'users', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Add Opinion'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Opinion');?>
	<?php
		echo "<fieldset>".$this->Form->input('usuario_id', array('label'=>__('Usuario_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripcion',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('email', array('label'=>__('Email',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Esactivo',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('controller' => 'opinionesmodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
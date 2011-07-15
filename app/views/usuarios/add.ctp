<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nuevo Usuario'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Usuario');?>
	<?php
		echo "<fieldset>".$this->Form->input('userid', array('label'=>__('User id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('email', array('label'=>__('Email',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('recordatorio', array('label'=>__('Recordatorio',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('telefono', array('label'=>__('Teléfono',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('localidad', array('label'=>__('Localidad',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('direccion', array('label'=>__('Dirección',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('provincia', array('label'=>__('Provincia',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('pais', array('label'=>__('Pais',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('web', array('label'=>__('Web',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Usuarios', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
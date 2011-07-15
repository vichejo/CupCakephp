<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir Sección'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Seccion');?>
	<?php
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Secciones', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
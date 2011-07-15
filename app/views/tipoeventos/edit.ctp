<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Modificar Tipo de Evento'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Tipoevento');?>
	<?php
		echo "".$this->Form->input('id')."";
		echo "<fieldset>".$this->Form->input('tipo', array('label'=>__('Tipo',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esvisible', array('label'=>__('Esvisible',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esmodificable', array('label'=>__('Esmodificable',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar este Tipo de Evento', true), array('action' => 'delete', $this->Form->value('Tipoevento.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Tipoevento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Tipo de Eventos', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
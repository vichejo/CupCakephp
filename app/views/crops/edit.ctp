<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Modificar Crop'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Crop');?>
	<?php
		echo "".$this->Form->input('id')."";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('ancho', array('label'=>__('Ancho',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('alto', array('label'=>__('Alto',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('submodulo_id', array('label'=>__('pertenece al Submodulo',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('Imagen')."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar este Crop', true), array('action' => 'delete', $this->Form->value('Crop.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Crop.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Crops', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>

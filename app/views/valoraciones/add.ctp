<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Add Valoracion'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Valoracion');?>
	<?php
		echo "<fieldset>".$this->Form->input('itemid', array('label'=>__('Itemid',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('submodulo_id', array('label'=>__('Submodulo_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('valoracion', array('label'=>__('Valoracion',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('votos', array('label'=>__('Votos',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('visitas', array('label'=>__('Visitas',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Valoraciones', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
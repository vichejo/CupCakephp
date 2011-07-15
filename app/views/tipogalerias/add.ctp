<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Add Tipogaleria'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Tipogaleria');?>
	<?php
		echo "<fieldset>".$this->Form->input('tipo', array('label'=>__('Tipo',true)))."</fieldset>";
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
		<li><?php echo $this->Html->link(__('Listado de Tipogalerias', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Galerias', true), array('controller' => 'galerias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('controller' => 'galerias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
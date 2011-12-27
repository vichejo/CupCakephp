<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir Tipo de Galeria'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Tipogaleria');?>
	<?php
		echo "<fieldset>".$this->Form->input('tipo', array('label'=>__('Tipo',true)))."</fieldset>";   
                echo "<fieldset>".$this->Form->input('tipocrop', array('label'=>__('Realizar crop a',true), 'options'=>array('1' => '1 sola imagen', '2' => 'todas las imagenes')))."</fieldset>";
                echo "<fieldset>".$this->Form->input('crop_id', array('label'=>__('Crop aplicable',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Es activo',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Tipos de galerias', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Galerias', true), array('controller' => 'galerias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('controller' => 'galerias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
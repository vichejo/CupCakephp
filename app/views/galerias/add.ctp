<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nueva Galeria'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Galeria');?>
	<?php
		echo "<fieldset>".$this->Form->input('tipogaleria_id', array('label'=>__('Tipo de galeria',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar?',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('esdestacado', array('label'=>__('Esdestacado',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Galerias', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
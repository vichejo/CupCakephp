<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir una Localidad'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Localidad');?>
	<?php
		echo "<fieldset>".$this->Form->input('provincia_id', array('label'=>__('Provincia',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Localidad',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Localidades', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
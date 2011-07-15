<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Add Contacto'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Contacto');?>
	<?php
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('email', array('label'=>__('Email',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('telefono', array('label'=>__('Telefono',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('direccion', array('label'=>__('Direccion',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('localidad', array('label'=>__('Localidad',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('provincia', array('label'=>__('Provincia',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('pais', array('label'=>__('Pais',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('asunto', array('label'=>__('Asunto',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('consulta', array('label'=>__('Consulta',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('filename', array('label'=>__('Filename',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Contactos', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
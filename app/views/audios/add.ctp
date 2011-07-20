<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nuevo Audio'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Audio', array('enctype' => 'multipart/form-data', 'action' => 'add'));?>
	<?php
		echo "<fieldset>".$this->Form->input('categoria_id', array('label'=>__('Categoría',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('url', array('label'=>__('Url',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('filename', array('label'=>__('Archivo',true), 'between'=>'<br />','type'=>'file'))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('zoom', array('label'=>__('Zoom',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('latitud', array('label'=>__('Latitud',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('longitud', array('label'=>__('Longitud',true)))."</fieldset>";
		echo "".$this->Form->input('espublico', array('label'=>__('Es público',true), 'checked'=>true, 'type'=>'hidden'))."";
		//echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true), 'checked'=>true))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Audios', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
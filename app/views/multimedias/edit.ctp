<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Edit Multimedia'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Multimedia');?>
	<?php
		echo "<fieldset>".$this->Form->input('id', array('label'=>__('Id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('submodulo_id', array('label'=>__('Submodulo_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('itemid', array('label'=>__('Itemid',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('imagen_id', array('label'=>__('Imagen_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('video_id', array('label'=>__('Video_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('audio_id', array('label'=>__('Audio_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('link_id', array('label'=>__('Link_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('fichero_id', array('label'=>__('Fichero_id',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esdestacado', array('label'=>__('Esdestacado',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('tipomedia_id', array('label'=>__('Tipomedia_id',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear/Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $this->Form->value('Multimedia.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Multimedia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Imagenes', true), array('controller' => 'imagenes', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Imagen', true), array('controller' => 'imagenes', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Audios', true), array('controller' => 'audios', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Audio', true), array('controller' => 'audios', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Links', true), array('controller' => 'links', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Link', true), array('controller' => 'links', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Ficheros', true), array('controller' => 'ficheros', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Fichero', true), array('controller' => 'ficheros', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Tipomedias', true), array('controller' => 'tipomedias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Tipomedia', true), array('controller' => 'tipomedias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
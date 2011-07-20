<section id="main" class="column"> 
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Modificar Imagen'); ?></h3></header>
        <div class="module_content">
        <?php echo $this->Form->create('Imagen');?>
	<?php 
		echo "".$this->Form->input('id')."";
		echo "<fieldset>".$this->Form->input('categoria_id', array('label'=>__('Categoría',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('url', array('label'=>__('Url',true)))."</fieldset>";
		echo "<fieldset class='trescuartos_width'>".$this->Form->input('filename', array('label'=>__('Archivo',true), 'readonly' => 'readonly', 'disabled'=>'disabled'))."</fieldset>";
		//echo "<fieldset class='uncuarto'>".$this->Html->image('../upcontent/images/thumbnails/'.$this->data['Imagen']['filename'], array('class'=>'imagenes_listados'))."</fieldset>";
      		echo "<fieldset class='uncuarto'>";
                echo "<a href='/imagenes/show/".$this->data['Imagen']['id']."/big' class = 'cloud-zoom' id='zoom1' rel=\"adjustX: -20, adjustY:-40, position:'left', zoomWidth:400, zoomHeight:340\">
                        <img src='/app/webroot/upcontent/images/thumbnails/".$this->data['Imagen']['filename']."' class='imagenes_listado' alt='' title='".$this->data['Imagen']['titulo']."' /></a>";
                echo "</fieldset>";

		//echo "<fieldset>".$this->Form->input('zoom', array('label'=>__('Zoom',true)))."</fieldset>";
                //echo "<fieldset>".$this->Form->input('latitud', array('label'=>__('Latitud',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('longitud', array('label'=>__('Longitud',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('guardaroriginal', array('label'=>__('Se dispone de original?',true), 'disabled'=>'disabled'))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Es activo',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('Crop')."</fieldset>";
	?>
        <?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar esta imágen', true), array('action' => 'delete', $this->Form->value('Imagen.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Imagen.titulo'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Imágenes', true), array('action' => 'index'));?></li>

                <li><?php echo $this->Html->link(__('Realizar Crops a esta imágen', true), array('action' => 'add_crop', $this->Form->value('Imagen.id'))); ?></li>

<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>

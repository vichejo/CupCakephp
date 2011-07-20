<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Modificar Vídeo'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Video', array('enctype' => 'multipart/form-data', 'action' => 'edit'));?>
	<?php
		echo "".$this->Form->input('id')."";
		echo "<fieldset>".$this->Form->input('categoria_id', array('label'=>__('Categoría',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
               /* 
                echo "<fieldset>";
                $thefilename = $this->data['Video']['filename'];
		if ($thefilename!=""){ ?>
                    <label for="fichero_Actual">Video:</label>
                    <div id="fichero_actual"> 
                      <a href="#" title=""><?=$thefilename?></a>
                      <!-- <p>Para modificar el Fichero actual y subir otro distinto, seleccione uno nuevo a continuación y el actual será reemplazado por el nuevo; Si desea eliminarlo y no asociar ninguno pulse 'Eliminar Fichero asociado'.</p> -->
                      <p>Para modificar el Vídeo actual y subir otro distinto, seleccione uno nuevo a continuación y el actual será reemplazado por el nuevo.</p>
                    </div>
          <?php }
		echo $form->input('filename', array('between'=>'<br />','type'=>'file', 'label' => 'Nuevo Fichero' ));
		//if ($thefilename!=""){
                //    echo $form->input('sinfichero',array( 'label' => 'Eliminar Fichero asociado', 'type' => 'checkbox'));                  
                //}
                echo "<input type='hidden' name='data[Video][sinfichero]'value='0'>";
                echo "</fieldset>";*/

                                
		//echo "<fieldset>".$this->Form->input('url', array('label'=>__('Url',true)))."</fieldset>";
                echo "<fieldset>".$this->Form->input('contenido', array('label'=>__('Contenido (iframe)',true)))."</fieldset>";                                
		//echo "<fieldset>".$this->Form->input('zoom', array('label'=>__('Zoom',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('latitud', array('label'=>__('Latitud',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('longitud', array('label'=>__('Longitud',true)))."</fieldset>";
		echo "".$this->Form->input('espublico', array('label'=>__('Es público',true), 'disabled'=>'disabled','type'=>'hidden'))."";
		//echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Es activo',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar este Vídeo', true), array('action' => 'delete', $this->Form->value('Video.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Video.titulo'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Vídeos', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
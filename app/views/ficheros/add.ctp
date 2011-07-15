<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3 class="tabs_involved"><?php __('Añadir nuevo Fichero'); ?></h3>
            <ul class="tabs">
                <li><a href="#tab1"><?php __('Uno solo')?></a></li>
                <li><a href="#tab2"><?php __('Varios a categoría')?></a></li>
            </ul>
        </header>
        <div class="tab_container">
            <div id="tab1" class="tab_content">
                <div class="module_content">
        <?php echo $this->Form->create('Fichero', array('enctype' => 'multipart/form-data', 'action' => 'add'));?>
	<?php
		echo "<fieldset>".$this->Form->input('categoria_id')."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array( 'label' => __('Titulo',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array( 'label' => __('Entradilla',true)))."</fieldset>";
                //echo "<fieldset>".$this->Form->input('url', array( 'label' => __('Url para ficheros externos',true)))."</fieldset>";
                echo "<fieldset>".$this->Form->input('filename', array('label'=>__('Archivo',true), 'between'=>'<br />','type'=>'file'))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array( 'label' => __('Descripción',true)))."</fieldset>";
       		echo "<fieldset>".$this->Form->input('espublico',array('label'=>__('Es público',true), 'checked'=>true))."</fieldset>";
                echo "<fieldset>".$this->Form->input('esactivo',array('label'=>__('Activar',true), 'checked'=>true))."</fieldset>";
	?>
        <?php echo $this->Form->end(__('Crear', true));?>
                </div>
            </div>
            <div id="tab2" class="tab_content">
                <div class="module_content">
                    <div>
                        <ul>
                            <li><?php __("Seleccionar una categoría y si se guardará una copia del fichero original de forma privada.");?></li>
                            <li><?php __("Arrastrar o Añadir ficheros con 'Add files'; Pulsar en 'Start upload' para añadirlos al cargador.");?></li>
                            <li><?php __("Pulsa en 'Subir ficheros' para grabar los ficheros en el servidor."); ?></li>
                        </ul>
                    </div>
                    <?php echo $this->Form->create('Fichero',array('action' => 'uploadfiles', 'name'=>'FicheroAddForm2','id'=>'FicheroAddForm2'));?>
                    <div id="uploader">Parece que tu navegador no soporta la subida de ficheros nativa. Actualiza tu navegador a una versión más actual.</div>
                    <?php
                        echo "<fieldset>".$this->Form->input('categoria_id', array( 'label' => 'Categoría'))."</fieldset>"; 
              		echo "<fieldset>".$this->Form->input('espublico',array('label'=>'Es público', 'checked'=>true))."</fieldset>"; 
                    ?>
                        
                    <div class="spacer"></div>
                    <?php echo $this->Form->end(__('Subir ficheros',true));?>
                </div>
            </div>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Ficheros', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header>
            <h3 class="tabs_involved"><?php __('Editar Galería'); ?></h3>
            <ul class="tabs">
                <li><a href="#tab1"><?php __('Datos')?></a></li>
                <li><a href="#tab2"><?php __('Imágenes')?></a></li>
            </ul>
        </header>
        <div class="tab_container">
            <div id="tab1" class="tab_content"> 
                <div class="module_content">
                <?php echo $this->Form->create('Galeria');?>
                <?php
                        echo "".$this->Form->input('id', array('label'=>__('Id',true)))."";
                        echo "<fieldset>".$this->Form->input('tipogaleria_id', array('label'=>__('Tipo de galeria_id',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Es activa',true)))."</fieldset>";
                        //echo "<fieldset>".$this->Form->input('esdestacado', array('label'=>__('Esdestacado',true)))."</fieldset>";
                ?>
                <?php echo $this->Form->end(__('Guardar', true));?>
                </div>
            </div>
            <div id="tab2" class="tab_content">
                <!-- Añadir Imagenes -->
                <div class="module_content">
                   <?php 
                    if (!empty($cupc_related_multimedia)){ 
                        foreach($cupc_related_multimedia as $etiqueta){ ?>
                    <article class="module multimedia_related">
                        <header><h3><?php __($etiqueta.' relacionadas');?></h3></header>
                        <div class="contenidos_mm_relacionados" id="contenidos_mm_<?=$etiqueta?>">
                        <?php $elementos=$etiqueta."_html";
                            foreach($$elementos as $ind=>$elemento){ 
                                print $elemento;
                             } ?>
                        </div>
                        <button class="anadir_multimedia" rel='{"tipo":"<?=$etiqueta?>", "item_id":<?=$cupc_item_id;?>, "modulo_id":<?=$cupc_submodulo_id;?>}'>Añadir <?=$etiqueta?></button>
                    </article>
                    <?php }    
                    } ?>  
                </div>
                <!-- Imagenes -->
            </div>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar esta Galería', true), array('action' => 'delete', $this->Form->value('Galeria.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Galeria.titulo'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Galerías', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    <article>
        <?php echo $this->element('panel_multimedias');?>         
    </article>
</section>
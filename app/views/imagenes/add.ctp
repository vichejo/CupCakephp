<section id="main" class="column"> 
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3 class="tabs_involved"><?php __('Añadir nueva Imagen'); ?></h3>
            <ul class="tabs">
                <li><a href="#tab1"><?php __('Una sola')?></a></li>
                <li><a href="#tab2"><?php __('Varias a categoría')?></a></li>
            </ul>
        </header>
        <div class="tab_container">
            <div id="tab1" class="tab_content">               
                <div class="module_content">
        <?php echo $this->Form->create('Imagen', array('enctype' => 'multipart/form-data', 'action' => 'add'));?>
                <?php
                        echo "<fieldset>".$this->Form->input('categoria_id', array('label'=>__('Categoría',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Ttulo',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripción',true)))."</fieldset>";
                        //echo "<fieldset>".$this->Form->input('url', array('label'=>__('Url',true)))."</fieldset>";
                        //
                        //echo "<fieldset>".$this->Form->input('filename', array('label'=>__('Filename',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('filename', array('label'=>__('Archivo',true), 'between'=>'<br />','type'=>'file'))."</fieldset>";

                        //echo "<fieldset>".$this->Form->input('zoom', array('label'=>__('Zoom',true)))."</fieldset>";
                        //echo "<fieldset>".$this->Form->input('latitud', array('label'=>__('Latitud',true)))."</fieldset>";
                        //echo "<fieldset>".$this->Form->input('longitud', array('label'=>__('Longitud',true)))."</fieldset>";
                        echo "<fieldset>".$this->Form->input('guardaroriginal', array('label'=>__('Guardar original',true)))."</fieldset>";
                        //echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true), 'checked'=>true))."</fieldset>";
			//echo "<fieldset>".$this->Form->input('Crop')."</fieldset>";
                ?>
        <?php echo $this->Form->end(__('Crear', true));?>
                </div>
            </div>
            <div id="tab2" class="tab_content">
                <div class="module_content">
                    <div>
                        <ul>
                            <li><?php __("Seleccionar una categoría y si se guardará el original como archivo privado.");?></li>
                            <li><?php __("Arrastrar al cargador o pulsar en 'Añadir imagenes' para añadir las imágenes.");?></li>
                            <li><?php __("Pulsa en 'Subir ficheros' para grabar los ficheros en el servidor."); ?></li>
                        </ul>
                    </div>
                    <div class="spacer"></div>
                    <div id="fileupload">
                    <?php echo $this->Form->create('Imagen',array('action' => 'uploadimages', 'name'=>'ImagenesAddForm2','id'=>'ImagenesAddForm2'));?>
                    <?php
                        echo "<fieldset>".$this->Form->input('categoria_id', array( 'label' => __('Categoría',true)))."</fieldset>"; 
              		echo "<fieldset>".$this->Form->input('guardaroriginal',array('label'=>__('Guardar originales',true), 'value'=>'0'))."</fieldset>"; 
                    ?>
                    
                    <div class="fileupload-buttonbar">
                        <label class="fileinput-button">
                            <span>Añadir imagenes...</span>
                            <input type="file" name="files[]" multiple>
                        </label>
                        <button type="submit" class="start">Subir Ficheros</button>
                        <!-- <button type="reset" class="cancel">Cancel upload</button>
                        <button type="button" class="delete">Delete files</button> -->
                    </div>
                                                            
                    <?php 
                        //echo $this->Form->end(__('Subir imágenes',true));
                        echo "</form>";
                    ?>
                    
                    <div class="fileupload-content">
                        <table class="files"></table>
                        <div class="fileupload-progressbar"></div>
                    </div>
                    <script id="template-upload" type="text/x-jquery-tmpl">
                        <tr class="template-upload{{if error}} ui-state-error{{/if}}">
                            <td class="preview"></td>
                            <td class="name">${name}</td>
                            <td class="size">${sizef}</td>
                            {{if error}}
                                <td class="error" colspan="2">Error:
                                    {{if error === 'maxFileSize'}}File is too big
                                    {{else error === 'minFileSize'}}File is too small
                                    {{else error === 'acceptFileTypes'}}Filetype not allowed
                                    {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                            {{else}}
                                <td class="progress"><div></div></td>
                                <td class="start"><button>Start</button></td>
                            {{/if}}
                            <td class="cancel"><button>Cancel</button></td>
                        </tr>
                    </script>
                    <script id="template-download" type="text/x-jquery-tmpl">
                        <tr class="template-download{{if error}} ui-state-error{{/if}}">
                            {{if error}}
                                <td></td>
                                <td class="name">${name}</td>
                                <td class="size">${sizef}</td>
                                <td class="error" colspan="2">Error:
                                    {{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
                                    {{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
                                    {{else error === 3}}File was only partially uploaded
                                    {{else error === 4}}No File was uploaded
                                    {{else error === 5}}Missing a temporary folder
                                    {{else error === 6}}Failed to write file to disk
                                    {{else error === 7}}File upload stopped by extension
                                    {{else error === 'maxFileSize'}}File is too big
                                    {{else error === 'minFileSize'}}File is too small
                                    {{else error === 'acceptFileTypes'}}Filetype not allowed
                                    {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                                    {{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
                                    {{else error === 'emptyResult'}}Empty file upload result
                                    {{else}}${error}
                                    {{/if}}
                                </td>
                            {{else}}
                                <td class="preview">
                                    {{if thumbnail_url}}
                                        <a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
                                    {{/if}}
                                </td>
                                <td class="name">
                                    <a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
                                </td>
                                <td class="size">${sizef}</td>
                                <td colspan="2"></td>
                            {{/if}}
                            <td class="delete">
                                <button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
                            </td>
                        </tr>
                    </script>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Imágenes', true), array('action' => 'index'));?></li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>

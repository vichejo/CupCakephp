<section id="main" class="column">
    <?php //echo $this->Session->flash(); ?>
    <?php //echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Crops disponibles...');?></h3></header>

        <article>
        <div id="accordion">
            <?php foreach($submodulos as $indice=>$submdatos){ //print_r($submdatos); 
                if (!empty($submdatos['Crop'])){
                    $realizados=0;
                    foreach($submdatos['Crop'] as $indcorp=>$datcrops){
                        if (in_array($datcrops['id'], $arraycrops)) $realizados++;
                    }
            ?>
            <h4><a href="#"><?php echo $submdatos['Submodulo']['nombre']; echo "&nbsp;&nbsp;&nbsp;&nbsp; (<span id='crealizados".$submdatos['Submodulo']['id']."'>".$realizados."</span> realizados de ".count($submdatos['Crop'])." disponibles)";?></a></h4>
            <div>            
                <ul>
                <?php foreach($submdatos['Crop'] as $indcrop=>$datcrops){ 
                        $hecho=0;
                        if (in_array($datcrops['id'], $arraycrops)) $hecho=1;
                    ?>
                        <li>
                        <?php 
                        if ($hecho){
                                echo "<img id='img".$datcrops['id']."' src='/upcontent/images/crops/".$imagen['Imagen']['id']."/".$datcrops['id'].".jpg' class='imagenes_crops'>";
                                echo "<input type='text' value='/imagenes/show/".$imagen['Imagen']['id']."/crop/".$datcrops['id']."' >";
                        }else{
                            echo "<img id='img".$datcrops['id']."' src='javascript:;' class='imagenes_crops'> ";
                            echo "<input type='text' id='inputurl".$datcrops['id']."' style='display:none' value='/imagenes/show/".$imagen['Imagen']['id']."/crop/".$datcrops['id']."' >";
                            
                        }
                        echo $datcrops['titulo']." --> <b>".$datcrops['ancho']."</b>x<b>".$datcrops['alto']."</b>px "; //(".$datcrops['para'].") ...... "; 
                        if (!$hecho){
                            $estilogenerar="style=\"display:block\" ";
                            $estiloeliminar="style=\"display:none\"";
                        }else{
                            $estilogenerar="style=\"display:none\"";
                            $estiloeliminar="style=\"display:block\"";
                        }
                        echo "<div id='gen".$datcrops['id']."' ".$estilogenerar."><button class='generar' rel='{\"id\":".$datcrops['id'].",\"imagen\":".$imagen['Imagen']['id'].",\"ancho\":".$datcrops['ancho'].",\"alto\":".$datcrops['alto'].",\"submodulo\":".$datcrops['submodulo_id']."}'>Generar</button></div>";
                        echo "<div id='can".$datcrops['id']."' ".$estiloeliminar."><button class='eliminar' rel='{\"id\":".$datcrops['id'].",\"imagen\":".$imagen['Imagen']['id'].",\"ancho\":".$datcrops['ancho'].",\"alto\":".$datcrops['alto'].",\"aplicable\":\"".$datcrops['para']."\",\"titulo\":\"".$datcrops['titulo']."\",\"submodulo\":".$datcrops['submodulo_id']."}'>Eliminar</button></div>";
                        ?></li>

                <?php }?>
                    </ul>
                </div>
            <?php }} ?>
        </div>
        </article>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Imagen', true), array('action' => 'edit', $imagen['Imagen']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Imagen', true), array('action' => 'delete', $imagen['Imagen']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $imagen['Imagen']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Imágenes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Imagen', true), array('action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    <article>
        <div id="dialog-modal" title="Creando crop...">
            <input type="hidden" id="jix" name="x" />
            <input type="hidden" id="jiy" name="y" />
            <input type="hidden" id="jiw" name="w" />
            <input type="hidden" id="jih" name="h" />
            <?php echo "<img src='/imagenes/show/".$imagen['Imagen']['id']."/big' id='jcrop_target' class='imagenes_crop'>"; ?>
        </div>
        <div id="dialog-modal2" title="Eliminando crop...">
            <p></p>
        </div>
    </article>
  
  
</section>
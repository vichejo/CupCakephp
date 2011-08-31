<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3 class="con_opciones"><?php __('Listado de Imagenes');?></h3>
                <select name="imagenes_categorias" id="imagenes_categorias">
                    <?php 
                        if(!empty($categorias)){
                            foreach($categorias as $ind=>$cat){?>                       
                                <option value="<?=$ind?>" <?php if ($selectedcat==$ind) echo 'selected'; ?>><?=$cat?></option>
                    <? }} ?>
                </select>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Categoría',true),'categoria_id');?></th>-->
                    <th><?php echo $this->Paginator->sort(__('Título',true),'titulo');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <th><?php echo $this->Paginator->sort(__('Descripcion',true),'descripcion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Url',true),'url');?></th> -->
                    <!--  <th><?php echo $this->Paginator->sort(__('Filename',true),'filename');?></th>
                    <th><?php echo $this->Paginator->sort(__('Latitud',true),'latitud');?></th>
                    <th><?php echo $this->Paginator->sort(__('Zoom',true),'zoom');?></th>
                    <th><?php echo $this->Paginator->sort(__('Longitud',true),'longitud');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Original?',true),'guardaroriginal');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Activo?',true),'esactivo');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('#Crops',true),'ncrops');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($imagenes as $imagen): 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
                <td><?php 
                    //echo $this->Html->image('../upcontent/images/thumbnails/'.$imagen['Imagen']['filename'], array('class'=>'imagenes_listados'));
                    echo "<a href='/imagenes/show/".$imagen['Imagen']['id']."/big' class = 'cloud-zoom' id='zoom".$imagen['Imagen']['id']."' rel='adjustX: 10, adjustY:-80, zoomWidth:400, zoomHeight:340'>
                        <img src='/imagenes/show/".$imagen['Imagen']['id']."/mini' class='imagenes_listados' alt='' title='".$imagen['Imagen']['titulo']."' /></a>";
                    ?>
                </td>
                
		<!-- <td><?php echo $imagen['Imagen']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($imagen['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $imagen['Categoria']['id'])); ?>
		</td> -->
		<td><?php echo $imagen['Imagen']['titulo']; ?>&nbsp;</td>
		<!-- <td><?php echo $imagen['Imagen']['entradilla']; ?>&nbsp;</td>
		<td><?php echo $imagen['Imagen']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $imagen['Imagen']['url']; ?>&nbsp;</td> -->
		<!--<td><?php echo $imagen['Imagen']['filename']; ?>&nbsp;</td>
		 <td><?php echo $imagen['Imagen']['latitud']; ?>&nbsp;</td>
		<td><?php echo $imagen['Imagen']['zoom']; ?>&nbsp;</td>
		<td><?php echo $imagen['Imagen']['longitud']; ?>&nbsp;</td> -->
		<td><?php echo ($imagen['Imagen']['guardaroriginal']==0)?'NO':'SI'; ?>&nbsp;</td>
		<!-- <td><?php echo ($imagen['Imagen']['esactivo']==0)?'NO':'SI'; ?>&nbsp;</td> -->
		<td><?php echo $this->Html->link(count($imagen['Crop']), array('controller' => 'imagenes', 'action' => 'add_crop', $imagen['Imagen']['id'])); ?>&nbsp;</td>
		<!-- <td><?php echo $imagen['Imagen']['created']; ?>&nbsp;</td>
		<td><?php echo $imagen['Imagen']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $imagen['Imagen']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $imagen['Imagen']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $imagen['Imagen']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $imagen['Imagen']['titulo'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>      
        <footer>
            <?php
            echo $this->Paginator->counter(array(
            'format' => __('Página %page% de %pages%', true)
            ));
            ?>            <div class="paging">
                	<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
             | 	<?php echo $this->Paginator->numbers();?>
 |
                	<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
            </div>
        </footer>
    </article>

    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Nueva Imagen', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
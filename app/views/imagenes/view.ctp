<section id="main" class="column"> 
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle de la Imagen');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoría'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($imagen['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $imagen['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Título'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['entradilla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['descripcion']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $imagen['Imagen']['url']; 
                        echo "<input type='text' value='/imagenes/show/".$imagen['Imagen']['id']."' >";
                        ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Archivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['filename']; ?>
			&nbsp;
		</dd> 
               	<dt<?php if ($i % 2 == 0) echo $class;?>>...</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo "<img src='/imagenes/descargar/".$imagen['Imagen']['id']."' class='imagenes_detalles'>"; 
                            //echo "<a href='/imagenes/descargar/".$imagen['Imagen']['id']."' class = 'cloud-zoom' id='zoom1' rel=\"position:'inside'\">
                            //<img src='/imagenes/descargar/".$imagen['Imagen']['id']."' class='imagenes_detalles' alt='' title='".$imagen['Imagen']['titulo']."' /></a>";
                            
                            echo "<a href='/imagenes/show/".$imagen['Imagen']['id']."/big' class = 'cloud-zoom' id='zoom1' rel=\"position:'inside'\">
                            <img src='/imagenes/show/".$imagen['Imagen']['id']."/big' class='imagenes_detalles' alt='' title='".$imagen['Imagen']['titulo']."' /></a>";
                        ?>
			&nbsp;
		</dd>
               <!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zoom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['zoom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Latitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['latitud']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Longitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['longitud']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Guardar original como privado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($imagen['Imagen']['guardaroriginal']==0)? 'NO':'SI'; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($imagen['Imagen']['esactivo']==0)? 'NO':'SI'; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de creación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('d-m-Y H:i',$imagen['Imagen']['created']); ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $imagen['Imagen']['modified']; ?>
			&nbsp;
		</dd> -->
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar esta Imagen', true), array('action' => 'edit', $imagen['Imagen']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar esta Imagen', true), array('action' => 'delete', $imagen['Imagen']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $imagen['Imagen']['titulo'])); ?> </li>
                <li><?php echo $this->Html->link(__('Realizar Crops a esta imágen', true), array('action' => 'add_crop', $imagen['Imagen']['id'])); ?></li>

		<li><?php echo $this->Html->link(__('Listado de Imágenes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Imagen', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
   
<article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Crops');?></h3></header>
        <div class="related">
	<?php if (!empty($imagen['Crop'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th></th>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Ancho'); ?></th>
		<th><?php __('Alto'); ?></th>
                <th><?php __('Url'); ?></th>
		<!-- <th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Para'); ?></th> -->
		<!-- <th class="actions"><?php __('Acciones');?></th> -->
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($imagen['Crop'] as $crop):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
                        <td><?php echo $this->Html->image('../upcontent/images/crops/'.$imagen['Imagen']['id'].'/'.$crop['id'].'.jpg', array('class'=>'imagenes_crops')); ?></td>
			<td><?php echo $crop['titulo'];?></td>
			<td><?php echo $crop['ancho'];?></td>
			<td><?php echo $crop['alto'];?></td>
                        <td><?php //echo $imagen['Imagen']['url']; 
                        echo "<input type='text' value='/imagenes/show/".$imagen['Imagen']['id']."/crop/".$crop['id']."' >";
                        ?></td>
			<!-- <td><?php echo $crop['submodulo_id'];?></td>
			<td><?php echo $crop['para'];?></td> -->
			<!-- <td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'crops', 'action' => 'view', $crop['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'crops', 'action' => 'edit', $crop['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'crops', 'action' => 'delete', $crop['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $crop['id'])); ?>
			</td> -->
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

</section>

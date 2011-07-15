<section id="main" class="column"> 
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Crop');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crop['Crop']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Título'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crop['Crop']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ancho'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crop['Crop']['ancho']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crop['Crop']['alto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('pertenece al Submodulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($crop['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $crop['Submodulo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Para aplicar a'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crop['Crop']['para']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Crop', true), array('action' => 'edit', $crop['Crop']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Crop', true), array('action' => 'delete', $crop['Crop']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $crop['Crop']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Crops', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php //echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php //echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    

<article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Imagenes');?></h3></header>
        <div class="related">
	<?php if (!empty($crop['Imagen'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Categoria Id'); ?></th>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Filename'); ?></th>
		<th><?php __('Filesize'); ?></th>
		<th><?php __('Latitud'); ?></th>
		<th><?php __('Zoom'); ?></th>
		<th><?php __('Longitud'); ?></th>
		<th><?php __('Guardaroriginal'); ?></th>
		<th><?php __('Esactivo'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($crop['Imagen'] as $imagen):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $imagen['id'];?></td>
			<td><?php echo $imagen['categoria_id'];?></td>
			<td><?php echo $imagen['titulo'];?></td>
			<td><?php echo $imagen['entradilla'];?></td>
			<td><?php echo $imagen['descripcion'];?></td>
			<td><?php echo $imagen['url'];?></td>
			<td><?php echo $imagen['filename'];?></td>
			<td><?php echo $imagen['filesize'];?></td>
			<td><?php echo $imagen['latitud'];?></td>
			<td><?php echo $imagen['zoom'];?></td>
			<td><?php echo $imagen['longitud'];?></td>
			<td><?php echo $imagen['guardaroriginal'];?></td>
			<td><?php echo $imagen['esactivo'];?></td>
			<td><?php echo $imagen['created'];?></td>
			<td><?php echo $imagen['modified'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'imagenes', 'action' => 'view', $imagen['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'imagenes', 'action' => 'edit', $imagen['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'imagenes', 'action' => 'delete', $imagen['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $imagen['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
   <!-- <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <article>
		<ul>
			<li><?php echo $this->Html->link(__('Nuevo Imagen', true), array('controller' => 'imagenes', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

</section>

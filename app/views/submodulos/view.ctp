<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Submodulo');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($submodulo['Modulo']['nombre'], array('controller' => 'modulos', 'action' => 'view', $submodulo['Modulo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tabla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['tabla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Disponiblepara'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['disponiblepara']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orden'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['orden']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esactivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['esactivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $submodulo['Submodulo']['modified']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Submodulo', true), array('action' => 'edit', $submodulo['Submodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Submodulo', true), array('action' => 'delete', $submodulo['Submodulo']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $submodulo['Submodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Modulos', true), array('controller' => 'modulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Modulo', true), array('controller' => 'modulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Crops', true), array('controller' => 'crops', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('controller' => 'crops', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('controller' => 'multimedias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('controller' => 'opinionesmodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Valoraciones', true), array('controller' => 'valoraciones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Valoracion', true), array('controller' => 'valoraciones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Crops');?></h3></header>
        <div class="related">
	<?php if (!empty($submodulo['Crop'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Ancho'); ?></th>
		<th><?php __('Alto'); ?></th>
		<th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Para'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($submodulo['Crop'] as $crop):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $crop['id'];?></td>
			<td><?php echo $crop['titulo'];?></td>
			<td><?php echo $crop['ancho'];?></td>
			<td><?php echo $crop['alto'];?></td>
			<td><?php echo $crop['submodulo_id'];?></td>
			<td><?php echo $crop['para'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'crops', 'action' => 'view', $crop['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'crops', 'action' => 'edit', $crop['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'crops', 'action' => 'delete', $crop['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $crop['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('controller' => 'crops', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Multimedias');?></h3></header>
        <div class="related">
	<?php if (!empty($submodulo['Multimedia'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Itemid'); ?></th>
		<th><?php __('Imagen Id'); ?></th>
		<th><?php __('Video Id'); ?></th>
		<th><?php __('Audio Id'); ?></th>
		<th><?php __('Link Id'); ?></th>
		<th><?php __('Fichero Id'); ?></th>
		<th><?php __('Esdestacado'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Tipomedia Id'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($submodulo['Multimedia'] as $multimedia):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $multimedia['id'];?></td>
			<td><?php echo $multimedia['submodulo_id'];?></td>
			<td><?php echo $multimedia['itemid'];?></td>
			<td><?php echo $multimedia['imagen_id'];?></td>
			<td><?php echo $multimedia['video_id'];?></td>
			<td><?php echo $multimedia['audio_id'];?></td>
			<td><?php echo $multimedia['link_id'];?></td>
			<td><?php echo $multimedia['fichero_id'];?></td>
			<td><?php echo $multimedia['esdestacado'];?></td>
			<td><?php echo $multimedia['created'];?></td>
			<td><?php echo $multimedia['modified'];?></td>
			<td><?php echo $multimedia['tipomedia_id'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'multimedias', 'action' => 'view', $multimedia['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'multimedias', 'action' => 'edit', $multimedia['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'multimedias', 'action' => 'delete', $multimedia['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $multimedia['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Opinionesmodulos');?></h3></header>
        <div class="related">
	<?php if (!empty($submodulo['Opinionesmodulo'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Itemid'); ?></th>
		<th><?php __('Opinion Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($submodulo['Opinionesmodulo'] as $opinionesmodulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $opinionesmodulo['id'];?></td>
			<td><?php echo $opinionesmodulo['submodulo_id'];?></td>
			<td><?php echo $opinionesmodulo['itemid'];?></td>
			<td><?php echo $opinionesmodulo['opinion_id'];?></td>
			<td><?php echo $opinionesmodulo['created'];?></td>
			<td><?php echo $opinionesmodulo['modified'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'opinionesmodulos', 'action' => 'view', $opinionesmodulo['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'opinionesmodulos', 'action' => 'edit', $opinionesmodulo['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'opinionesmodulos', 'action' => 'delete', $opinionesmodulo['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $opinionesmodulo['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Valoraciones');?></h3></header>
        <div class="related">
	<?php if (!empty($submodulo['Valoracion'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Itemid'); ?></th>
		<th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Valoracion'); ?></th>
		<th><?php __('Votos'); ?></th>
		<th><?php __('Visitas'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($submodulo['Valoracion'] as $valoracion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $valoracion['id'];?></td>
			<td><?php echo $valoracion['itemid'];?></td>
			<td><?php echo $valoracion['submodulo_id'];?></td>
			<td><?php echo $valoracion['valoracion'];?></td>
			<td><?php echo $valoracion['votos'];?></td>
			<td><?php echo $valoracion['visitas'];?></td>
			<td><?php echo $valoracion['created'];?></td>
			<td><?php echo $valoracion['modified'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'valoraciones', 'action' => 'view', $valoracion['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'valoraciones', 'action' => 'edit', $valoracion['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'valoraciones', 'action' => 'delete', $valoracion['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $valoracion['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Valoracion', true), array('controller' => 'valoraciones', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

</section>
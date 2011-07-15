<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Tipomedia');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomedia['Tipomedia']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomedia['Tipomedia']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esvisible'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomedia['Tipomedia']['esvisible']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esmodificable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipomedia['Tipomedia']['esmodificable']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Tipomedia', true), array('action' => 'edit', $tipomedia['Tipomedia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Tipomedia', true), array('action' => 'delete', $tipomedia['Tipomedia']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $tipomedia['Tipomedia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Tipomedias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipomedia', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('controller' => 'multimedias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Multimedias');?></h3></header>
        <div class="related">
	<?php if (!empty($tipomedia['Multimedia'])):?>
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
		foreach ($tipomedia['Multimedia'] as $multimedia):
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

</section>
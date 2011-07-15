<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle del Link');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($link['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $link['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['entradilla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esactivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($link['Link']['esactivo']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $link['Link']['modified']; ?>
			&nbsp;
		</dd> -->
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3>Actions</h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Link', true), array('action' => 'edit', $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Link', true), array('action' => 'delete', $link['Link']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Links', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Link', true), array('action' => 'add')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
    <!--    <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Related Multimedias');?></h3></header>
        <div class="related">
	<?php if (!empty($link['Multimedia'])):?>
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
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($link['Multimedia'] as $multimedia):
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
				<?php echo $this->Html->link(__('View', true), array('controller' => 'multimedias', 'action' => 'view', $multimedia['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'multimedias', 'action' => 'edit', $multimedia['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'multimedias', 'action' => 'delete', $multimedia['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $multimedia['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div> -->

</section>
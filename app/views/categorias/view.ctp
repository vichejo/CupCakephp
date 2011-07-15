<?php
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle de la Categoría');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['entradilla']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['modified']; ?>
			&nbsp;
		</dd> -->
                <?php if ($grupoAuth==1){ ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es visible'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($categoria['Categoria']['esvisible']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es modificable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($categoria['Categoria']['esmodificable']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
                <?php } ?>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar esta Categoría', true), array('action' => 'edit', $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar esta Categoría', true), array('action' => 'delete', $categoria['Categoria']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $categoria['Categoria']['nombre'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_3_quarter" style="clear:both;">
        <header><h3><?php __('Related Audios');?></h3></header>
        <div class="related">
	<?php if (!empty($categoria['Audio'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Filename'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($categoria['Audio'] as $audio):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $audio['titulo'];?></td>
			<td><?php echo $audio['entradilla'];?></td>
			<td><?php echo $audio['url'];?></td>
			<td><?php echo $audio['filename'];?></td>
			<td><?php echo ($audio['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('View', true), "title"=>__('View', true))),  array('controller' => 'audios', 'action' => 'view', $audio['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Edit', true), "title"=>__('Edit', true))),  array('controller' => 'audios', 'action' => 'edit', $audio['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Delete', true), "title"=>__('Delete', true))), array('controller' => 'audios', 'action' => 'delete', $audio['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $audio['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

        <article class="module width_3_quarter" style="clear:both;">
        <header><h3><?php __('Related Ficheros');?></h3></header>
        <div class="related">
	<?php if (!empty($categoria['Fichero'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Filename'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($categoria['Fichero'] as $fichero):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fichero['titulo'];?></td>
			<td><?php echo $fichero['entradilla'];?></td>
			<td><?php echo $fichero['url'];?></td>
			<td><?php echo $fichero['filename'];?></td>
			<td><?php echo ($fichero['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('View', true), "title"=>__('View', true))),  array('controller' => 'ficheros', 'action' => 'view', $fichero['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Edit', true), "title"=>__('Edit', true))),  array('controller' => 'ficheros', 'action' => 'edit', $fichero['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Delete', true), "title"=>__('Delete', true))), array('controller' => 'ficheros', 'action' => 'delete', $fichero['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $fichero['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

        <article class="module width_3_quarter" style="clear:both;">
        <header><h3><?php __('Related Imagenes');?></h3></header>
        <div class="related">
	<?php if (!empty($categoria['Imagen'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Filename'); ?></th>
		<th><?php __('Original'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($categoria['Imagen'] as $imagen):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $imagen['titulo'];?></td>
			<td><?php echo $imagen['url'];?></td>
			<td><?php echo $imagen['filename'];?></td>
			<td><?php echo ($imagen['guardaroriginal']==0)?'NO':'SI';?></td>
			<td><?php echo ($imagen['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('View', true), "title"=>__('View', true))),  array('controller' => 'imagenes', 'action' => 'view', $imagen['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Edit', true), "title"=>__('Edit', true))),  array('controller' => 'imagenes', 'action' => 'edit', $imagen['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Delete', true), "title"=>__('Delete', true))), array('controller' => 'imagenes', 'action' => 'delete', $imagen['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $imagen['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

        <article class="module width_3_quarter" style="clear:both;">
        <header><h3><?php __('Related Links');?></h3></header>
        <div class="related">
	<?php if (!empty($categoria['Link'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($categoria['Link'] as $link):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $link['titulo'];?></td>
			<td><?php echo $link['entradilla'];?></td>
			<td><?php echo $link['url'];?></td>
			<td><?php echo ($link['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('View', true), "title"=>__('View', true))),  array('controller' => 'links', 'action' => 'view', $link['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Edit', true), "title"=>__('Edit', true))),  array('controller' => 'links', 'action' => 'edit', $link['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Delete', true), "title"=>__('Delete', true))), array('controller' => 'links', 'action' => 'delete', $link['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $link['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

        <article class="module width_3_quarter" style="clear:both;">
        <header><h3><?php __('Related Videos');?></h3></header>
        <div class="related">
	<?php if (!empty($categoria['Video'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($categoria['Video'] as $video):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $video['titulo'];?></td>
			<td><?php echo $video['entradilla'];?></td>
			<td><?php echo $video['url'];?></td>
			<td><?php echo ($video['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('View', true), "title"=>__('View', true))),  array('controller' => 'videos', 'action' => 'view', $video['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Edit', true), "title"=>__('Edit', true))),  array('controller' => 'videos', 'action' => 'edit', $video['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Delete', true), "title"=>__('Delete', true))), array('controller' => 'videos', 'action' => 'delete', $video['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $video['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div>

</section>
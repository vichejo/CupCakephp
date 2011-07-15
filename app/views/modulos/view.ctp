<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter">
        <header><h3>Detalle de <?php  __('Modulo');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orden'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['orden']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esactivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['esactivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modulo['Modulo']['modified']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Modulo', true), array('action' => 'edit', $modulo['Modulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Modulo', true), array('action' => 'delete', $modulo['Modulo']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $modulo['Modulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Modulos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Modulo', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Submodulos');?></h3></header>
        <div class="related">
	<?php if (!empty($modulo['Submodulo'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Modulo Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Tabla'); ?></th>
		<th><?php __('Disponiblepara'); ?></th>
		<th><?php __('Orden'); ?></th>
		<th><?php __('Esactivo'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($modulo['Submodulo'] as $submodulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $submodulo['id'];?></td>
			<td><?php echo $submodulo['modulo_id'];?></td>
			<td><?php echo $submodulo['nombre'];?></td>
			<td><?php echo $submodulo['tabla'];?></td>
			<td><?php echo $submodulo['disponiblepara'];?></td>
			<td><?php echo $submodulo['orden'];?></td>
			<td><?php echo $submodulo['esactivo'];?></td>
			<td><?php echo $submodulo['created'];?></td>
			<td><?php echo $submodulo['modified'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'submodulos', 'action' => 'view', $submodulo['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'submodulos', 'action' => 'edit', $submodulo['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'submodulos', 'action' => 'delete', $submodulo['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $submodulo['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

</section>
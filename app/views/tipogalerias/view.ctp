<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Tipogaleria');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipogaleria['Tipogaleria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipogaleria['Tipogaleria']['tipo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Realizar crop a'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($tipogaleria['Tipogaleria']['tipocrop']==1)?"Solo 1":"Todas"; ?>
			&nbsp;
		</dd>
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($tipogaleria['Tipogaleria']['esactivo']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>

            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Tipogaleria', true), array('action' => 'edit', $tipogaleria['Tipogaleria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Tipogaleria', true), array('action' => 'delete', $tipogaleria['Tipogaleria']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $tipogaleria['Tipogaleria']['tipo'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Tipogalerias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipogaleria', true), array('action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Galerias relacionadas');?></h3></header>
        <div class="related">
	<?php if (!empty($tipogaleria['Galeria'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<!--<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th> -->
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
    		<!--<th><?php __('Descripcion'); ?></th>
		<th><?php __('Tipogaleria Id'); ?></th> -->
		<th><?php __('Es activo'); ?></th>
		<!-- <th><?php __('Es destacado'); ?></th> -->
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($tipogaleria['Galeria'] as $galeria):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<!-- <td><?php echo $galeria['id'];?></td>
			<td><?php echo $galeria['created'];?></td>
			<td><?php echo $galeria['modified'];?></td> -->
			<td><?php echo $galeria['titulo'];?></td>
			<td><?php echo $galeria['entradilla'];?></td>
			<!-- <td><?php echo $galeria['descripcion'];?></td>
			<td><?php echo $galeria['tipogaleria_id'];?></td>-->
			<td><?php echo ($galeria['esactivo'])?'NO':'SI';?></td>
			<!-- <td><?php echo $galeria['esdestacado'];?></td> -->
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'galerias', 'action' => 'view', $galeria['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'galerias', 'action' => 'edit', $galeria['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'galerias', 'action' => 'delete', $galeria['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $galeria['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('controller' => 'galerias', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

</section>
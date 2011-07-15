<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle del Tipo de Evento');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoevento['Tipoevento']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoevento['Tipoevento']['tipo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es visible'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoevento['Tipoevento']['esvisible']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es modificable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoevento['Tipoevento']['esmodificable']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Tipo de Evento', true), array('action' => 'edit', $tipoevento['Tipoevento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Tipo de Evento', true), array('action' => 'delete', $tipoevento['Tipoevento']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $tipoevento['Tipoevento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Tipos de Eventos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipo de Evento', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Eventos');?></h3></header>
        <div class="related">
	<?php if (!empty($tipoevento['Evento'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Tipoevento Id'); ?></th>
		<th><?php __('Seccion Id'); ?></th>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Entradilla'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Fechainicio'); ?></th>
		<th><?php __('Fechafin'); ?></th>
		<th><?php __('Zoom'); ?></th>
		<th><?php __('Longitud'); ?></th>
		<th><?php __('Latitud'); ?></th>
		<th><?php __('Esactivo'); ?></th>
		<th><?php __('Esdestacado'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($tipoevento['Evento'] as $evento):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $evento['id'];?></td>
			<td><?php echo $evento['tipoevento_id'];?></td>
			<td><?php echo $evento['seccion_id'];?></td>
			<td><?php echo $evento['titulo'];?></td>
			<td><?php echo $evento['entradilla'];?></td>
			<td><?php echo $evento['descripcion'];?></td>
			<td><?php echo $evento['fechainicio'];?></td>
			<td><?php echo $evento['fechafin'];?></td>
			<td><?php echo $evento['zoom'];?></td>
			<td><?php echo $evento['longitud'];?></td>
			<td><?php echo $evento['latitud'];?></td>
			<td><?php echo $evento['esactivo'];?></td>
			<td><?php echo $evento['esdestacado'];?></td>
			<td><?php echo $evento['created'];?></td>
			<td><?php echo $evento['modified'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'eventos', 'action' => 'view', $evento['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'eventos', 'action' => 'edit', $evento['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'eventos', 'action' => 'delete', $evento['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $evento['id'])); ?>
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
			<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add'));?> </li>
		</ul>
	</article>
    </article> -->
    </article>
    <div class="spacer"></div>

</section>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle de  Localidad');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($localidad['Provincia']['titulo'], array('controller' => 'provincias', 'action' => 'view', $localidad['Provincia']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $localidad['Localidad']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('d-m-Y H:i',$localidad['Localidad']['created']); ?>
			&nbsp;
		</dd>

            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar esta Localidad', true), array('action' => 'edit', $localidad['Localidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar esta Localidad', true), array('action' => 'delete', $localidad['Localidad']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $localidad['Localidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Localidades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Localidad', true), array('action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
<article class="module width_full" style="clear:both;">
        <header><h3><?php __('Colegios');?></h3></header>
        <div class="related">
	<?php if (!empty($localidad['Colegio'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Web'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($localidad['Colegio'] as $colegio):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $colegio['titulo'];?></td>
			<td><?php echo $colegio['web'];?></td>
			<td><?php echo ($colegio['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'colegios', 'action' => 'view', $colegio['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'colegios', 'action' => 'edit', $colegio['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'colegios', 'action' => 'delete', $colegio['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $colegio['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>

    
    <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Teatros');?></h3></header>
        <div class="related">
	<?php if (!empty($localidad['Teatro'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Titulo'); ?></th>
		<th><?php __('Es destacado'); ?></th>
		<th><?php __('Es activo'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($localidad['Teatro'] as $teatro):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $teatro['titulo'];?></td>
			<td><?php echo ($teatro['esdestacado']==0)?'NO':'SI';?></td>
			<td><?php echo ($teatro['esactivo']==0)?'NO':'SI';?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'teatros', 'action' => 'view', $teatro['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'teatros', 'action' => 'edit', $teatro['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'teatros', 'action' => 'delete', $teatro['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $teatro['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
        
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Programaciones');?></h3></header>
        <div class="related">
	<?php if (!empty($localidad['Programacion'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Evento'); ?></th>
		<th><?php __('Teatro'); ?></th>
		<th><?php __('Fechainicio'); ?></th>
		<th><?php __('Fechafin'); ?></th>
                <th><?php __('Pases'); ?></th>
		<th><?php __('Es activo'); ?></th>

		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($localidad['Programacion'] as $programacion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $eventos[$programacion['evento_id']];?></td>
			<td><?php echo $teatros[$programacion['teatro_id']];?></td>
			<td><?php echo $time->format('d-m-Y',$programacion['fechainicio']);?></td>
			<td><?php echo $time->format('d-m-Y',$programacion['fechafin']);?></td>
                        <td><?php echo $programacion['pases'];?></td>
			<td><?php echo ($programacion['esactivo']==0)?'NO':'SI';?></td>

			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'programaciones', 'action' => 'view', $programacion['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'programaciones', 'action' => 'edit', $programacion['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'programaciones', 'action' => 'delete', $programacion['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $programacion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    
</section>

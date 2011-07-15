<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle del Usuario');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($usuario['Users']['id'], array('controller' => 'users', 'action' => 'view', $usuario['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Recordatorio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['recordatorio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Teléfono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['telefono']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Localidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['localidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dirección'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['direccion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['provincia']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pais'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['pais']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Web'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['web']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['esactivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['created']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['modified']; ?>
			&nbsp;
		</dd> -->
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Usuario', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Usuario', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Usuarios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
        <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Opiniones');?></h3></header>
        <div class="related">
	<?php if (!empty($usuario['Opinion'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<!-- <th><?php __('Id'); ?></th>
		<th><?php __('Usuario Id'); ?></th> -->
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Email'); ?></th>
		<!-- <th><?php __('Esactivo'); ?></th> -->
		<th><?php __('Created'); ?></th>
		<!-- <th><?php __('Modified'); ?></th> -->
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($usuario['Opinion'] as $opinion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<!-- <td><?php echo $opinion['id'];?></td>
			<td><?php echo $opinion['usuario_id'];?></td> -->
			<td><?php echo $opinion['nombre'];?></td>
			<td><?php echo $opinion['descripcion'];?></td>
			<td><?php echo $opinion['email'];?></td>
			<!-- <td><?php echo $opinion['esactivo'];?></td> -->
			<td><?php echo $opinion['created'];?></td>
			<!-- <td><?php echo $opinion['modified'];?></td> -->
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'opiniones', 'action' => 'view', $opinion['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'opiniones', 'action' => 'edit', $opinion['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'opiniones', 'action' => 'delete', $opinion['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $opinion['id'])); ?>
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
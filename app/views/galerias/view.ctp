<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Galeria');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['entradilla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipogaleria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($galeria['Tipogaleria']['tipo'], array('controller' => 'tipogalerias', 'action' => 'view', $galeria['Tipogaleria']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esactivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['esactivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esdestacado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $galeria['Galeria']['esdestacado']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Galeria', true), array('action' => 'edit', $galeria['Galeria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Galeria', true), array('action' => 'delete', $galeria['Galeria']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $galeria['Galeria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Galerias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Tipogalerias', true), array('controller' => 'tipogalerias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Tipogaleria', true), array('controller' => 'tipogalerias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
</section>
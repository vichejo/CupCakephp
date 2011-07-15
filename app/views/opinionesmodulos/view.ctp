<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Opinionesmodulo');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opinionesmodulo['Opinionesmodulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Submodulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($opinionesmodulo['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $opinionesmodulo['Submodulo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Itemid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opinionesmodulo['Opinionesmodulo']['itemid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Opinion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($opinionesmodulo['Opinion']['nombre'], array('controller' => 'opiniones', 'action' => 'view', $opinionesmodulo['Opinion']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opinionesmodulo['Opinionesmodulo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opinionesmodulo['Opinionesmodulo']['modified']; ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Opinionesmodulo', true), array('action' => 'edit', $opinionesmodulo['Opinionesmodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Opinionesmodulo', true), array('action' => 'delete', $opinionesmodulo['Opinionesmodulo']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $opinionesmodulo['Opinionesmodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
</section>
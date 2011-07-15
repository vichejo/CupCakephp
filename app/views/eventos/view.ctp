<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3><?php  __('Detalle del Evento');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipoevento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($evento['Tipoevento']['tipo'], array('controller' => 'tipoeventos', 'action' => 'view', $evento['Tipoevento']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Seccion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($evento['Seccion']['titulo'], array('controller' => 'secciones', 'action' => 'view', $evento['Seccion']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['entradilla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechainicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if ($evento['Evento']['fechainicio']!="0000-00-00 00:00:00") echo $time->format('d-m-Y H:i',$evento['Evento']['fechainicio'])."h"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechafin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if ($evento['Evento']['fechafin']!="0000-00-00 00:00:00") echo $time->format('d-m-Y H:i',$evento['Evento']['fechafin'])."h"; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zoom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['zoom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Longitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['longitud']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Latitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['latitud']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esactivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($evento['Evento']['esactivo']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esdestacado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($evento['Evento']['esdestacado']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de creación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('d-m-Y H:i',$evento['Evento']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de modificación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('d-m-Y H:i',$evento['Evento']['modified']); ?>
			&nbsp;
		</dd>
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones') ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Evento', true), array('action' => 'edit', $evento['Evento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Evento', true), array('action' => 'delete', $evento['Evento']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $evento['Evento']['titulo'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Secciones', true), array('controller' => 'secciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Sección', true), array('controller' => 'secciones', 'action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    

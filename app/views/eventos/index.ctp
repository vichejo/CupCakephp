 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Eventos');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <!-- <th><?php echo $this->Paginator->sort(__('Tipoevento_id',true),'tipoevento_id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Sección',true),'seccion_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Título',true),'titulo');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <th><?php echo $this->Paginator->sort(__('Descripción',true),'descripcion');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Fecha inicio',true),'fechainicio');?></th>
                    <th><?php echo $this->Paginator->sort(__('Fecha fin',true),'fechafin');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Zoom',true),'zoom');?></th>
                    <th><?php echo $this->Paginator->sort(__('Longitud',true),'longitud');?></th>
                    <th><?php echo $this->Paginator->sort(__('Latitud',true),'latitud');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Es activo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es destacado',true),'esdestacado');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                     <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($eventos as $evento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $evento['Evento']['id']; ?>&nbsp;</td> -->
		<!-- <td>
			<?php echo $this->Html->link($evento['Tipoevento']['tipo'], array('controller' => 'tipoeventos', 'action' => 'view', $evento['Tipoevento']['id'])); ?>
		</td> -->
		<td>
			<?php echo $this->Html->link($evento['Seccion']['titulo'], array('controller' => 'secciones', 'action' => 'view', $evento['Seccion']['id'])); ?>
		</td>
		<td><?php echo $evento['Evento']['titulo']; ?>&nbsp;</td>
		<!-- <td><?php echo $evento['Evento']['entradilla']; ?>&nbsp;</td>
		<td><?php echo $evento['Evento']['descripcion']; ?>&nbsp;</td> -->
		<td><?php if ($evento['Evento']['fechainicio']!="0000-00-00 00:00:00") echo $time->format('d-m-Y',$evento['Evento']['fechainicio']).''; ?>&nbsp;</td>
		<td><?php if ($evento['Evento']['fechafin']!="0000-00-00 00:00:00") echo $time->format('d-m-Y',$evento['Evento']['fechafin']).''; ?>&nbsp;</td>
		<!-- <td><?php echo $evento['Evento']['zoom']; ?>&nbsp;</td>
		<td><?php echo $evento['Evento']['longitud']; ?>&nbsp;</td>
		<td><?php echo $evento['Evento']['latitud']; ?>&nbsp;</td> -->
		<td><?php echo ($evento['Evento']['esactivo']==0)?'NO':'SI'; ?>&nbsp;</td>
		<td><?php echo ($evento['Evento']['esdestacado']==0)?'NO':'SI'; ?>&nbsp;</td>
		<!-- <td><?php echo $evento['Evento']['created']; ?>&nbsp;</td>
		 <td><?php echo $evento['Evento']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $evento['Evento']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $evento['Evento']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $evento['Evento']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $evento['Evento']['titulo'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>      
        <footer>
            <?php
            echo $this->Paginator->counter(array(
            'format' => __('Página %page% de %pages%', true)
            ));
            ?>            <div class="paging">
                	<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
             | 	<?php echo $this->Paginator->numbers();?>
 |
                	<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
            </div>
        </footer>
    </article>

    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Tipos de Eventos', true), array('controller' => 'tipoeventos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipo de Evento', true), array('controller' => 'tipoeventos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Secciones', true), array('controller' => 'secciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Sección', true), array('controller' => 'secciones', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
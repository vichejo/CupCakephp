 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Submodulos');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modulo_id',true),'modulo_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Nombre',true),'nombre');?></th>
                    <th><?php echo $this->Paginator->sort(__('Tabla',true),'tabla');?></th>
                    <th><?php echo $this->Paginator->sort(__('Disponiblepara',true),'disponiblepara');?></th>
                    <th><?php echo $this->Paginator->sort(__('Orden',true),'orden');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esactivo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($submodulos as $submodulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $submodulo['Submodulo']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($submodulo['Modulo']['nombre'], array('controller' => 'modulos', 'action' => 'view', $submodulo['Modulo']['id'])); ?>
		</td>
		<td><?php echo $submodulo['Submodulo']['nombre']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['tabla']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['disponiblepara']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['orden']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['esactivo']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['created']; ?>&nbsp;</td>
		<td><?php echo $submodulo['Submodulo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $submodulo['Submodulo']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $submodulo['Submodulo']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $submodulo['Submodulo']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $submodulo['Submodulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Modulos', true), array('controller' => 'modulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Modulo', true), array('controller' => 'modulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Crops', true), array('controller' => 'crops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('controller' => 'crops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Multimedias', true), array('controller' => 'multimedias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('controller' => 'multimedias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('controller' => 'opinionesmodulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Valoraciones', true), array('controller' => 'valoraciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Valoracion', true), array('controller' => 'valoraciones', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
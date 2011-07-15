 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Opiniones');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Usuario_id',true),'usuario_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Nombre',true),'nombre');?></th>
                    <th><?php echo $this->Paginator->sort(__('Descripcion',true),'descripcion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Email',true),'email');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esactivo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($opiniones as $opinion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $opinion['Opinion']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($opinion['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $opinion['Usuario']['id'])); ?>
		</td>
		<td><?php echo $opinion['Opinion']['nombre']; ?>&nbsp;</td>
		<td><?php echo $opinion['Opinion']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $opinion['Opinion']['email']; ?>&nbsp;</td>
		<td><?php echo $opinion['Opinion']['esactivo']; ?>&nbsp;</td>
		<td><?php echo $opinion['Opinion']['created']; ?>&nbsp;</td>
		<td><?php echo $opinion['Opinion']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $opinion['Opinion']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $opinion['Opinion']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $opinion['Opinion']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $opinion['Opinion']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Opinionesmodulos', true), array('controller' => 'opinionesmodulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('controller' => 'opinionesmodulos', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
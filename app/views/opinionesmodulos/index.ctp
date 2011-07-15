 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Opinionesmodulos');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Submodulo_id',true),'submodulo_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Itemid',true),'itemid');?></th>
                    <th><?php echo $this->Paginator->sort(__('Opinion_id',true),'opinion_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($opinionesmodulos as $opinionesmodulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $opinionesmodulo['Opinionesmodulo']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($opinionesmodulo['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $opinionesmodulo['Submodulo']['id'])); ?>
		</td>
		<td><?php echo $opinionesmodulo['Opinionesmodulo']['itemid']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($opinionesmodulo['Opinion']['nombre'], array('controller' => 'opiniones', 'action' => 'view', $opinionesmodulo['Opinion']['id'])); ?>
		</td>
		<td><?php echo $opinionesmodulo['Opinionesmodulo']['created']; ?>&nbsp;</td>
		<td><?php echo $opinionesmodulo['Opinionesmodulo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $opinionesmodulo['Opinionesmodulo']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $opinionesmodulo['Opinionesmodulo']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $opinionesmodulo['Opinionesmodulo']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $opinionesmodulo['Opinionesmodulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Opinionesmodulo', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Opinion', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Valoraciones');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Itemid',true),'itemid');?></th>
                    <th><?php echo $this->Paginator->sort(__('Submodulo_id',true),'submodulo_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Valoracion',true),'valoracion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Votos',true),'votos');?></th>
                    <th><?php echo $this->Paginator->sort(__('Visitas',true),'visitas');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($valoraciones as $valoracion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $valoracion['Valoracion']['id']; ?>&nbsp;</td>
		<td><?php echo $valoracion['Valoracion']['itemid']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($valoracion['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $valoracion['Submodulo']['id'])); ?>
		</td>
		<td><?php echo $valoracion['Valoracion']['valoracion']; ?>&nbsp;</td>
		<td><?php echo $valoracion['Valoracion']['votos']; ?>&nbsp;</td>
		<td><?php echo $valoracion['Valoracion']['visitas']; ?>&nbsp;</td>
		<td><?php echo $valoracion['Valoracion']['created']; ?>&nbsp;</td>
		<td><?php echo $valoracion['Valoracion']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $valoracion['Valoracion']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $valoracion['Valoracion']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $valoracion['Valoracion']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $valoracion['Valoracion']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Valoracion', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
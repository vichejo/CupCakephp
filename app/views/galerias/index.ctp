 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Galerias');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th><?php echo $this->Paginator->sort(__('Titulo',true),'titulo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <th><?php echo $this->Paginator->sort(__('Descripcion',true),'descripcion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Tipogaleria_id',true),'tipogaleria_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esactivo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esdestacado',true),'esdestacado');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($galerias as $galeria):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $galeria['Galeria']['id']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['created']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['modified']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['titulo']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['entradilla']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['descripcion']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($galeria['Tipogaleria']['tipo'], array('controller' => 'tipogalerias', 'action' => 'view', $galeria['Tipogaleria']['id'])); ?>
		</td>
		<td><?php echo $galeria['Galeria']['esactivo']; ?>&nbsp;</td>
		<td><?php echo $galeria['Galeria']['esdestacado']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $galeria['Galeria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $galeria['Galeria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $galeria['Galeria']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $galeria['Galeria']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Tipogalerias', true), array('controller' => 'tipogalerias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipogaleria', true), array('controller' => 'tipogalerias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
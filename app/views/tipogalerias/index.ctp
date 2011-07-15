 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Tipogalerias');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Tipo',true),'tipo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esvisible',true),'esvisible');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esmodificable',true),'esmodificable');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($tipogalerias as $tipogaleria):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tipogaleria['Tipogaleria']['id']; ?>&nbsp;</td>
		<td><?php echo $tipogaleria['Tipogaleria']['tipo']; ?>&nbsp;</td>
		<td><?php echo $tipogaleria['Tipogaleria']['esvisible']; ?>&nbsp;</td>
		<td><?php echo $tipogaleria['Tipogaleria']['esmodificable']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $tipogaleria['Tipogaleria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $tipogaleria['Tipogaleria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $tipogaleria['Tipogaleria']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $tipogaleria['Tipogaleria']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Tipogaleria', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Galerias', true), array('controller' => 'galerias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Galeria', true), array('controller' => 'galerias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
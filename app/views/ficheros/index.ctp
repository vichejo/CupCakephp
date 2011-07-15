 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Ficheros');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Categoria',true),'categoria_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Titulo',true),'titulo');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <th><?php echo $this->Paginator->sort(__('Descripcion',true),'descripcion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Url',true),'url');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Fichero',true),'filename');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es activo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es publico',true),'espublico');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Fecha de creación',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($ficheros as $fichero):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $fichero['Fichero']['id']; ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($fichero['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $fichero['Categoria']['id'])); ?>
		</td>
		<td><?php echo $fichero['Fichero']['titulo']; ?>&nbsp;</td>
		<!-- <td><?php echo $fichero['Fichero']['entradilla']; ?>&nbsp;</td>
		<td><?php echo $fichero['Fichero']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $fichero['Fichero']['url']; ?>&nbsp;</td> -->
		<td><?php echo $fichero['Fichero']['filename']; ?>&nbsp;</td>
		<td><?php echo ($fichero['Fichero']['esactivo']==0)?'NO':'SI'; ?>&nbsp;</td>
		<td><?php echo ($fichero['Fichero']['espublico']==0)?'NO':'SI'; ?>&nbsp;</td>
		<!-- <td><?php echo $fichero['Fichero']['created']; ?>&nbsp;</td>
		<td><?php echo $fichero['Fichero']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $fichero['Fichero']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $fichero['Fichero']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $fichero['Fichero']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $fichero['Fichero']['titulo'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Fichero', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
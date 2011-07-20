 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Audios');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Categoría',true),'categoria_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Título',true),'titulo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Descripcion',true),'descripcion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Url',true),'url');?></th>
                    <th><?php echo $this->Paginator->sort(__('Filename',true),'filename');?></th>
                    <th><?php echo $this->Paginator->sort(__('Zoom',true),'zoom');?></th>
                    <th><?php echo $this->Paginator->sort(__('Latitud',true),'latitud');?></th>
                    <th><?php echo $this->Paginator->sort(__('Longitud',true),'longitud');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es público',true),'espublico');?></th> -->
                    <!--<th><?php echo $this->Paginator->sort(__('Es activo',true),'esactivo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($audios as $audio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
                <td>
                </td>
                
                
		<!-- <td><?php echo $audio['Audio']['id']; ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($audio['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $audio['Categoria']['id'])); ?>
		</td>
		<td><?php echo $audio['Audio']['titulo']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['entradilla']; ?>&nbsp;</td>
		<!-- <td><?php echo $audio['Audio']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['url']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['filename']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['zoom']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['latitud']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['longitud']; ?>&nbsp;</td>
		<td><?php echo ($audio['Audio']['espublico']==0)?'NO':'SI'; ?>&nbsp;</td>
		<td><?php echo ($audio['Audio']['esactivo']==0)?'NO':'SI'; ?>&nbsp;</td> -->
		<!-- <td><?php echo $audio['Audio']['created']; ?>&nbsp;</td>
		<td><?php echo $audio['Audio']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $audio['Audio']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $audio['Audio']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $audio['Audio']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $audio['Audio']['titulo'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Audio', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
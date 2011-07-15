 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Multimedias');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Submodulo_id',true),'submodulo_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Itemid',true),'itemid');?></th>
                    <th><?php echo $this->Paginator->sort(__('Imagen_id',true),'imagen_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Video_id',true),'video_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Audio_id',true),'audio_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Link_id',true),'link_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Fichero_id',true),'fichero_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esdestacado',true),'esdestacado');?></th>
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th>
                    <th><?php echo $this->Paginator->sort(__('Tipomedia_id',true),'tipomedia_id');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($multimedias as $multimedia):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $multimedia['Multimedia']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($multimedia['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $multimedia['Submodulo']['id'])); ?>
		</td>
		<td><?php echo $multimedia['Multimedia']['itemid']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($multimedia['Imagen']['titulo'], array('controller' => 'imagenes', 'action' => 'view', $multimedia['Imagen']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($multimedia['Video']['id'], array('controller' => 'videos', 'action' => 'view', $multimedia['Video']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($multimedia['Audio']['titulo'], array('controller' => 'audios', 'action' => 'view', $multimedia['Audio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($multimedia['Link']['titulo'], array('controller' => 'links', 'action' => 'view', $multimedia['Link']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($multimedia['Fichero']['titulo'], array('controller' => 'ficheros', 'action' => 'view', $multimedia['Fichero']['id'])); ?>
		</td>
		<td><?php echo $multimedia['Multimedia']['esdestacado']; ?>&nbsp;</td>
		<td><?php echo $multimedia['Multimedia']['created']; ?>&nbsp;</td>
		<td><?php echo $multimedia['Multimedia']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($multimedia['Tipomedia']['nombre'], array('controller' => 'tipomedias', 'action' => 'view', $multimedia['Tipomedia']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $multimedia['Multimedia']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $multimedia['Multimedia']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $multimedia['Multimedia']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $multimedia['Multimedia']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Multimedia', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Imagenes', true), array('controller' => 'imagenes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Imagen', true), array('controller' => 'imagenes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Audios', true), array('controller' => 'audios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Audio', true), array('controller' => 'audios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Links', true), array('controller' => 'links', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Link', true), array('controller' => 'links', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Ficheros', true), array('controller' => 'ficheros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Fichero', true), array('controller' => 'ficheros', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Tipomedias', true), array('controller' => 'tipomedias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipomedia', true), array('controller' => 'tipomedias', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
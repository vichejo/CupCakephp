 <section id="main" class="column"> 
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Crops');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Título',true),'titulo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Dimensión',true),'ancho');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Alto',true),'alto');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Submodulo',true),'submodulo_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Para',true),'para');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($crops as $crop):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $crop['Crop']['id']; ?>&nbsp;</td> -->
		<td><?php echo $crop['Crop']['titulo']; ?>&nbsp;</td>
		<td><?php echo $crop['Crop']['ancho']."x".$crop['Crop']['alto']."px"; ?>&nbsp;</td>
		<!-- <td><?php echo $crop['Crop']['alto']; ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($crop['Submodulo']['nombre'], array('controller' => 'submodulos', 'action' => 'view', $crop['Submodulo']['id'])); ?>
		</td>
		<td><?php echo $crop['Crop']['para']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $crop['Crop']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $crop['Crop']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $crop['Crop']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $crop['Crop']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Crop', true), array('action' => 'add')); ?></li>
		<!-- <li><?php //echo $this->Html->link(__('Listado de Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li> -->
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
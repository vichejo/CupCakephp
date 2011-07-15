 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Tipoeventos');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Tipo',true),'tipo');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es visible',true),'esvisible');?></th>
                    <th><?php echo $this->Paginator->sort(__('Es modificable',true),'esmodificable');?></th>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($tipoeventos as $tipoevento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $tipoevento['Tipoevento']['id']; ?>&nbsp;</td> -->
		<td><?php echo $tipoevento['Tipoevento']['tipo']; ?>&nbsp;</td>
		<td><?php echo $tipoevento['Tipoevento']['esvisible']; ?>&nbsp;</td>
		<td><?php echo $tipoevento['Tipoevento']['esmodificable']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $tipoevento['Tipoevento']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $tipoevento['Tipoevento']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $tipoevento['Tipoevento']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $tipoevento['Tipoevento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Tipoevento', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
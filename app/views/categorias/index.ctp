<?php
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Categorias');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Nombre',true),'nombre');?></th>
                    <th><?php echo $this->Paginator->sort(__('Entradilla',true),'entradilla');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <?php if ($grupoAuth==1){ echo "<th>".$this->Paginator->sort(__('Activo',true),'esvisible').'</th>'; }?>
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($categorias as $categoria):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $categoria['Categoria']['id']; ?>&nbsp;</td> -->
		<td><?php echo $categoria['Categoria']['nombre']; ?>&nbsp;</td>
		<td><?php echo $categoria['Categoria']['entradilla']; ?>&nbsp;</td>
		<!-- <td><?php echo $categoria['Categoria']['created']; ?>&nbsp;</td>
		<td><?php echo $categoria['Categoria']['modified']; ?>&nbsp;</td> -->
		<?php if ($grupoAuth==1){ echo "<td>"; echo ($categoria['Categoria']['esactivo']==0)?'NO':'SI'; echo "</td>";} ?>&nbsp;
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $categoria['Categoria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $categoria['Categoria']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $categoria['Categoria']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $categoria['Categoria']['nombre'])); ?>
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
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('action' => 'add')); ?></li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Usuarios');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> 
                    <th><?php echo $this->Paginator->sort(__('User id',true),'userid');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Nombre',true),'nombre');?></th>
                    <th><?php echo $this->Paginator->sort(__('Email',true),'email');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Recordatorio',true),'recordatorio');?></th>
                    <th><?php echo $this->Paginator->sort(__('Telefono',true),'telefono');?></th>
                    <th><?php echo $this->Paginator->sort(__('Localidad',true),'localidad');?></th>
                    <th><?php echo $this->Paginator->sort(__('Direccion',true),'direccion');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Provincia',true),'provincia');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Pais',true),'pais');?></th>
                    <th><?php echo $this->Paginator->sort(__('Web',true),'web');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Esactivo',true),'esactivo');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuario['Users']['id'], array('controller' => 'users', 'action' => 'view', $usuario['Users']['id'])); ?>
		</td> -->
		<td><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
		<!-- <td><?php echo $usuario['Usuario']['recordatorio']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['telefono']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['localidad']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['direccion']; ?>&nbsp;</td> -->
		<td><?php echo $usuario['Usuario']['provincia']; ?>&nbsp;</td>
		<!-- <td><?php echo $usuario['Usuario']['pais']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['web']; ?>&nbsp;</td> -->
		<td><?php echo $usuario['Usuario']['esactivo']; ?>&nbsp;</td>
		<!-- <td><?php echo $usuario['Usuario']['created']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $usuario['Usuario']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $usuario['Usuario']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $usuario['Usuario']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('controller' => 'opiniones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Opinión', true), array('controller' => 'opiniones', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
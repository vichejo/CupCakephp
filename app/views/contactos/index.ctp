 <section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php __('Listado de Consultas');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Nombre',true),'nombre');?></th>
                    <th><?php echo $this->Paginator->sort(__('Email',true),'email');?></th>
                    <th><?php echo $this->Paginator->sort(__('Telefono',true),'telefono');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Direccion',true),'direccion');?></th>
                    <th><?php echo $this->Paginator->sort(__('Localidad',true),'localidad');?></th>
                    <th><?php echo $this->Paginator->sort(__('Provincia',true),'provincia');?></th>
                    <th><?php echo $this->Paginator->sort(__('Pais',true),'pais');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Asunto',true),'asunto');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Consulta',true),'consulta');?></th>
                    <th><?php echo $this->Paginator->sort(__('Filename',true),'filename');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($contactos as $contacto):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $contacto['Contacto']['id']; ?>&nbsp;</td> -->
		<td><?php echo $contacto['Contacto']['nombre']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['email']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['telefono']; ?>&nbsp;</td>
		<!-- <td><?php echo $contacto['Contacto']['direccion']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['localidad']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['provincia']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['pais']; ?>&nbsp;</td> -->
		<td><?php echo $contacto['Contacto']['asunto']; ?>&nbsp;</td>
		<!-- <td><?php echo $contacto['Contacto']['consulta']; ?>&nbsp;</td>
		<td><?php echo $contacto['Contacto']['filename']; ?>&nbsp;</td> -->
		<td><?php echo $time->format('d-m-Y H:i',$contacto['Contacto']['created']); ?>&nbsp;</td>
		<!--<td><?php echo $contacto['Contacto']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $contacto['Contacto']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $contacto['Contacto']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $contacto['Contacto']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $contacto['Contacto']['id'])); ?>
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

    <div class="spacer"></div>
</section>
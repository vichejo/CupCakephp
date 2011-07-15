<?php
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?> 
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>
    <article class="module width_3_quarter"> 
        <header>
            <h3>Listado de <?php __('Users');?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <!-- <th><?php echo $this->Paginator->sort(__('Id',true),'id');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Username',true),'username');?></th>
                    <!-- <th><?php echo $this->Paginator->sort(__('Password',true),'password');?></th> -->
                    <th><?php echo $this->Paginator->sort(__('Grupo',true),'group_id');?></th>
                    <th><?php echo $this->Paginator->sort(__('Esactivo',true),'esactivo');?></th>
                    <?php if ($grupoAuth==1){ echo "<th>".$this->Paginator->sort(__('Esvisible',true),'esvisible').'</th>';}?>
                    <?php if ($grupoAuth==1){ echo "<th>".$this->Paginator->sort(__('Esmodificable',true),'esmodificable').'</th>';}?>
                    <!-- <th><?php echo $this->Paginator->sort(__('Created',true),'created');?></th>
                    <th><?php echo $this->Paginator->sort(__('Modified',true),'modified');?></th> -->
                    <th class="actions"><?php __('Acciones');?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $user['User']['id']; ?>&nbsp;</td> -->
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<!-- <td><?php echo $user['User']['password']; ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
		</td>
		<td><?php echo ($user['User']['esactivo']==0)?'NO':'SI'; ?>&nbsp;</td>
		<?php if ($grupoAuth==1){ echo "<td>";echo ($user['User']['esvisible']==0)?'NO':'SI'; echo "</td>";} ?>&nbsp;
		<?php if ($grupoAuth==1){ echo "<td>";echo ($user['User']['esmodificable']==0)?'NO':'SI'; echo "</td>";} ?>&nbsp;
		<!-- <td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td><?php echo $user['User']['modified']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('action' => 'view', $user['User']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('action' => 'delete', $user['User']['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Nuevo User', true), array('action' => 'add')); ?></li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
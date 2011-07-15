<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?> 
    <article class="module width_3_quarter" style="margin-bottom: 20px">
        <header><h3>Detalle de <?php  __('Detalle del Audio');?></h3></header>
        <div class="module_content">
            <dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['id']; ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoría'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($audio['Categoria']['nombre'], array('controller' => 'categorias', 'action' => 'view', $audio['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Título'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Entradilla'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['entradilla']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['descripcion']; ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $audio['Audio']['url']; 
                        echo "<input type='text' value='' >";
                        ?>
			&nbsp;
		</dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Archivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $audio['Audio']['filename']; ?>
			&nbsp;
                        
                        <div id="jquery_jplayer_audio_detail" rel="http://cupcakephp.dev/app/webroot/upcontent/audios/<?=$audio['Audio']['filename']?>" class="jp-jplayer"></div>

		<div class="jp-audio">
			<div class="jp-type-single">
				<div id="jp_interface_1" class="jp-interface">

					<ul class="jp-controls">
						<li><a href="#" class="jp-play" tabindex="1">play</a></li>
						<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
                                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
						<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>

					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>

					<div class="jp-current-time"></div>
					<div class="jp-duration"></div>
				</div>
                                <div id="jp_playlist_1" class="jp-playlist">
				<!--	<ul>
						<li>Bubble</li>
					</ul> -->
				</div>

			</div>
		</div>
                        
                        
                        
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zoom'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['zoom']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Latitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['latitud']; ?>==0)?'NO':'SI';
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Longitud'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['longitud']; ?>
			&nbsp;
		</dd>-->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es público'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($audio['Audio']['espublico']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Es activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($audio['Audio']['esactivo']==0)?'NO':'SI'; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha de creación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $time->format('d-m-Y H:i',$audio['Audio']['created']); ?>
			&nbsp;
		</dd>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $audio['Audio']['modified']; ?>
			&nbsp;
		</dd> -->
            </dl>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
	<ul>
		<li><?php echo $this->Html->link(__('Editar este Audio', true), array('action' => 'edit', $audio['Audio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Eliminar este Audio', true), array('action' => 'delete', $audio['Audio']['id']), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $audio['Audio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Audios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Audio', true), array('action' => 'add')); ?> </li>
<!-- 		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li> -->
<!-- 		<li><?php echo $this->Html->link(__('Nuevo Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li> -->
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
    
    <!--    <article class="module width_full" style="clear:both;">
        <header><h3><?php __('Elemento Relacionado: Multimedias');?></h3></header>
        <div class="related">
	<?php if (!empty($audio['Multimedia'])):?>
	<table class="tablesorter" cellspacing = "0">
            <thead>
            <tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Submodulo Id'); ?></th>
		<th><?php __('Itemid'); ?></th>
		<th><?php __('Imagen Id'); ?></th>
		<th><?php __('Video Id'); ?></th>
		<th><?php __('Audio Id'); ?></th>
		<th><?php __('Link Id'); ?></th>
		<th><?php __('Fichero Id'); ?></th>
		<th><?php __('Esdestacado'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Tipomedia Id'); ?></th>
		<th class="actions"><?php __('Acciones');?></th>
            </tr>
            </thead>
            <tbody>
	<?php
		$i = 0;
		foreach ($audio['Multimedia'] as $multimedia):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $multimedia['id'];?></td>
			<td><?php echo $multimedia['submodulo_id'];?></td>
			<td><?php echo $multimedia['itemid'];?></td>
			<td><?php echo $multimedia['imagen_id'];?></td>
			<td><?php echo $multimedia['video_id'];?></td>
			<td><?php echo $multimedia['audio_id'];?></td>
			<td><?php echo $multimedia['link_id'];?></td>
			<td><?php echo $multimedia['fichero_id'];?></td>
			<td><?php echo $multimedia['esdestacado'];?></td>
			<td><?php echo $multimedia['created'];?></td>
			<td><?php echo $multimedia['modified'];?></td>
			<td><?php echo $multimedia['tipomedia_id'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image("admin/icn_detail.png", array("alt" => __('Detalle', true), "title"=>__('Detalle', true))),  array('controller' => 'multimedias', 'action' => 'view', $multimedia['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("admin/icn_edit_article.png", array("alt" => __('Editar', true), "title"=>__('Editar', true))),  array('controller' => 'multimedias', 'action' => 'edit', $multimedia['id']), array('escape' => false)); ?>
			<?php //echo $this->Html->link($this->Html->image("admin/icn_trash.png", array("alt" => __('Eliminar', true), "title"=>__('Eliminar', true))), array('controller' => 'multimedias', 'action' => 'delete', $multimedia['id']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $multimedia['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
            </tbody>
	</table>
<?php endif; ?>

        </div>
    </article>
    <div class="spacer"></div> -->

</section>
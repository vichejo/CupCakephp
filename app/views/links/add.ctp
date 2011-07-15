<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nuevo Link'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Link');?>
	<?php
		echo "<fieldset>".$this->Form->input('categoria_id', array('label'=>__('Categoría',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array('label'=>__('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('url', array('label'=>__('Url',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true), 'checked'=>true))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Actions'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Links', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Categoría', true), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
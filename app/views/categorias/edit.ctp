<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Modificar Categoría'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Categoria');?>
	<?php
		echo "".$this->Form->input('id')."";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esvisible', array('label'=>__('Es Visible',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esmodificable', array('label'=>__('Es Modificable',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar esta Categoría', true), array('action' => 'delete', $this->Form->value('Categoria.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Categoria.nombre'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('action' => 'index'));?></li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
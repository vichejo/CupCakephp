<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Editar Opinión'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Opinion');?>
	<?php
		echo "".$this->Form->input('id', array('label'=>__('Id',true)))."";
		echo "".$this->Form->input('usuario_id', array('label'=>__('Usuario_id',true),'type'=>'hidden'))."";
		echo "<fieldset>".$this->Form->input('en', array('label'=>__('Escrito en',true), 'disabled'=>'disabled'))."</fieldset>";
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true), 'disabled'=>'disabled'))."</fieldset>";
		echo "<fieldset>".$this->Form->input('descripcion', array('label'=>__('Descripcion',true), 'disabled'=>'disabled'))."</fieldset>";
		echo "<fieldset>".$this->Form->input('email', array('label'=>__('Email',true), 'disabled'=>'disabled'))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar?',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Guardar', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Eliminar esta Opinión', true), array('action' => 'delete', $this->Form->value('Opinion.id')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), $this->Form->value('Opinion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listado de Opiniones', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
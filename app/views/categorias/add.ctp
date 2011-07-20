<?php
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nueva Categoría'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Categoria');?>
	<?php
		echo "<fieldset>".$this->Form->input('nombre', array('label'=>__('Nombre',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array('label'=>__('Entradilla',true)))."</fieldset>";
		if ($grupoAuth==1){ echo "<fieldset>".$this->Form->input('esvisible', array('label'=>__('Es Visible',true), 'checked'=>true))."</fieldset>";}
		if ($grupoAuth==1){ echo "<fieldset>".$this->Form->input('esmodificable', array('label'=>__('Es Modificable',true), 'checked'=>true))."</fieldset>";}
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Categorías', true), array('action' => 'index'));?></li>
            </ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
<?php
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?>
<section id="main" class="column">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>   
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir User'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('User');?>
	<?php
		echo "<fieldset>".$this->Form->input('username', array('label'=>__('Username',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('password', array('label'=>__('Password',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('group_id', array('label'=>__('Grupo',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('esactivo', array('label'=>__('Activar',true)))."</fieldset>";
		if ($grupoAuth==1){ echo "<fieldset>".$this->Form->input('esvisible', array('label'=>__('Es visible',true)))."</fieldset>";}
		if ($grupoAuth==1){ echo "<fieldset>".$this->Form->input('esmodificable', array('label'=>__('Es modificable',true)))."</fieldset>";}
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Users', true), array('action' => 'index'));?></li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
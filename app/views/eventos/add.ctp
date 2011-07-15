<section id="main" class="column">
    <?php echo $this->Session->flash();?>
    <?php echo $this->Session->flash('auth');?>
    <article class="module width_3_quarter">
        <header><h3><?php __('Añadir nuevo Evento'); ?></h3></header>
        <div class="module_content">
<?php echo $this->Form->create('Evento');?>
	<?php
                echo "<fieldset>".$this->Form->input('tipoevento_id', array( 'label' => __('Tipo',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('seccion_id', array( 'label' => __('Sección',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('titulo', array( 'label' => __('Título',true)))."</fieldset>";
		echo "<fieldset>".$this->Form->input('entradilla', array( 'label' => __('Entradilla',true)))."</fieldset>";
                echo "<fieldset>".$this->Form->input('descripcion', array( 'label' => __('Descripción',true), 'class'=>'textarea_extended'))."</fieldset>";
                echo "<fieldset class='half_width'>".$this->Form->hidden('fechainicio')."<div class='input text'><label for='CalendarioFechainicio'>Fecha Inicio</label><input name='data[Calendario][fechainicio]' id='CalendarioFechainicio' rel='EventoFechainicio' type='text' placeholder='dd/mm/yyyy'></div>"."</fieldset>";
		echo "<fieldset class='half'>".$this->Form->hidden('fechafin')."<div class='input text'><label for='CalendarioFechafin'>Fecha Fin</label><input name='data[Calendario][fechafin]' id='CalendarioFechafin' rel='EventoFechafin' type='text' placeholder='dd/mm/yyyy'></div>"."</fieldset>";
		echo "<fieldset class='half_width'>"."<div class='input text'><label for='CalendarioHorainicio'>Hora Inicio</label><input name='data[Calendario][horainicio]' id='CalendarioHorainicio' type='text' placeholder='hh:mm (24h)'></div>"."</fieldset>";
		echo "<fieldset class='half'>"."<div class='input text'><label for='CalendarioHorafin'>Hora Fin</label><input name='data[Calendario][horafin]' id='CalendarioHorafin' type='text' placeholder='hh:mm (24h)'></div>"."</fieldset>";
		//echo "<fieldset>".$this->Form->input('zoom', array( 'label' => __('Zoom',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('latitud', array( 'label' => __('Latitud',true)))."</fieldset>";
		//echo "<fieldset>".$this->Form->input('longitud', array( 'label' => __('Longitud',true)))."</fieldset>";
		echo "<fieldset class='half'>".$this->Form->input('esdestacado', array( 'label' => __('Marcar como destacado',true)))."</fieldset>";
		echo "<fieldset class='half_width'>".$this->Form->input('esactivo', array( 'label' => __('Activar',true)))."</fieldset>";
	?>
<?php echo $this->Form->end(__('Crear', true));?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php __('Acciones'); ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo $this->Html->link(__('Listado de Eventos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listado de Tipos de Eventos', true), array('controller' => 'tipoeventos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipo de Evento', true), array('controller' => 'tipoeventos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado de Secciones', true), array('controller' => 'secciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Sección', true), array('controller' => 'secciones', 'action' => 'add')); ?> </li>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
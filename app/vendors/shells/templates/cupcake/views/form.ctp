<?php
/**
 * CupCakephp: Un fork de Cakephp y... algunas cosillas mas
 * ----------- by Coberture.com
 * 
 * Basado en : Cakephp 1.3.8
 * 
 * @link        http://www.cupcakephp.com CupCakephp Project
 * @copyright   Copyright 2011, Coberture.com (http://www.coberture.com)
 */

/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<section id="main" class="column">
    <?php echo "<?php echo \$this->Session->flash(); ?>\n";?>
    <?php echo "<?php echo \$this->Session->flash('auth'); ?>";?>   
    <article class="module width_3_quarter">
        <header><h3><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3></header>
        <div class="module_content">
<?php
    echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";
    echo "\t<?php\n";
    foreach ($fields as $field) {
            $ufield=ucwords($field);
            if (strpos($action, 'add') !== false && $field == $primaryKey) {
                    continue;
            } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                    echo "\t\techo \"<fieldset>\".\$this->Form->input('{$field}', array('label'=>__('{$ufield}',true))).\"</fieldset>\";\n";
            }
    }
    if (!empty($associations['hasAndBelongsToMany'])) {
            foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                    echo "\t\techo \"<fieldset>\".\$this->Form->input('{$assocName}').\"</fieldset>\";\n";
            }
    }
    echo "\t?>\n";
    echo "<?php echo \$this->Form->end(__('Crear/Guardar', true));?>\n";
?>
        </div>
    </article>
    <article class="module width_quarter">
        <header><h3><?php echo "<?php __('Acciones'); ?>"; ?></h3></header>
        <div class="module_content">
            <ul>
<?php if (strpos($action, 'add') === false): ?>
		<li><?php echo "<?php echo \$this->Html->link(__('Eliminar este " . $singularHumanName ."', true), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>";?></li>
<?php endif;?>
		<li><?php echo "<?php echo \$this->Html->link(__('Listado de " . $pluralHumanName . "', true), array('action' => 'index'));?>";?></li>
<?php
		$done = array();
		foreach ($associations as $type => $data) {
			foreach ($data as $alias => $details) {
				if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
					echo "<!-- \t\t<li><?php //echo \$this->Html->link(__('Listado de " . Inflector::humanize($details['controller']) . "', true), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li> -->\n";
					echo "<!-- \t\t<li><?php //echo \$this->Html->link(__('Nuevo " . Inflector::humanize(Inflector::underscore($alias)) . "', true), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li> -->\n";
					$done[] = $details['controller'];
				}
			}
		}
?>
	</ul>
        </div>
    </article> 
    <div class="spacer"></div>
</section>
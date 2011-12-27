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
    <?php echo "<?php echo \$this->Session->flash('auth'); ?>\n";?>
    <article class="module width_3_quarter"> 
        <header>
            <h3><?php echo "<?php __('Listado de {$pluralHumanName}');?>";?></h3>
        </header>   
        <div class="tab_container">
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                    <?php  foreach ($fields as $field): $ufield=ucwords($field);?>
<th><?php echo "<?php echo \$this->Paginator->sort(__('{$ufield}',true),'{$field}');?>";?></th>
                    <?php endforeach;?>
<th class="actions"><?php echo "<?php __('Acciones');?>";?></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	echo "<?php
	\$i = 0;
	foreach (\${$pluralVar} as \${$singularVar}):
		\$class = null;
		if (\$i++ % 2 == 0) {
			\$class = ' class=\"altrow\"';
		}
	?>\n";
	echo "\t<tr<?php echo \$class;?>>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td><?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$this->Html->link(\$this->Html->image(\"admin/icn_detail.png\", array(\"alt\" => __('Detalle', true), \"title\"=>__('Detalle', true))),  array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(\$this->Html->image(\"admin/icn_edit_article.png\", array(\"alt\" => __('Editar', true), \"title\"=>__('Editar', true))),  array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(\$this->Html->image(\"admin/icn_trash.png\", array(\"alt\" => __('Eliminar', true), \"title\"=>__('Eliminar', true))), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false), sprintf(__('¿Está seguro que desea eliminar \'%s\'?', true), \${$singularVar}['{$modelClass}']['titulo'])); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
                </tbody>
            </table>
        </div>      
        <footer>
            <?php echo "<?php
            echo \$this->Paginator->counter(array(
            'format' => __('Página %page% de %pages%', true)
            ));
            ?>";?>
            <div class="paging">
                <?php echo "\t<?php echo \$this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>\n";?>
             | <?php echo "\t<?php echo \$this->Paginator->numbers();?>\n"?> |
                <?php echo "\t<?php echo \$this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>\n";?>
            </div>
        </footer>
    </article>

    <article class="module width_quarter">
        <header><h3><?php echo "<?php __('Acciones'); ?>"; ?></h3></header>
        <div class="module_content">
            <ul>
		<li><?php echo "<?php echo \$this->Html->link(__('Nuevo " . $singularHumanName . "', true), array('action' => 'add')); ?>";?></li>
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
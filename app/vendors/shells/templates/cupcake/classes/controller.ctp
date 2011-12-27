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
 * Controller bake template file
 *
 * Allows templating of Controllers generated from bake.
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
 * @subpackage    cake.
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

echo "<?php\n";
?>
class <?php echo $controllerName; ?>Controller extends <?php echo $plugin; ?>AppController {

	var $name = '<?php echo $controllerName; ?>';
        var $paginate = array('limit' => 20, 'order'=>'titulo ASC');
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';
        
        //Multimedia: elementos disponibles: (imagenes, videos, audios, ficheros);
        var $cupc_related_multimedia = array('imagenes', 'videos', 'audios', 'ficheros');
        //Comentarios: el modulo puede tener o no comentarios
        var $cupc_has_comments=true;
        
        var $cupc_tipo_crop=1; //1-1sola imagen con crop, 2-todas con crop
        var $cupc_crop_id=1;//crop para el submodulo: eventos (10)
        var $cupc_submodulo_id=10; //este submodulo (eventos #10)
        
        var $path_imagenes_publicas="../../app/webroot/upcontent/images";
        var $path_ficheros_publicos="../../app/webroot/upcontent/files";
        
<?php if ($isScaffold): ?>
	var $scaffold;
<?php else: ?>
<?php
if (count($helpers)):
	echo "\tvar \$helpers = array(";
	for ($i = 0, $len = count($helpers); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($helpers[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($helpers[$i]) . "'";
		endif;
	endfor;
	echo ");\n";
endif;

if (count($components)):
	echo "\tvar \$components = array(";
	for ($i = 0, $len = count($components); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($components[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($components[$i]) . "'";
		endif;
	endfor;
	echo ");\n";
endif;

echo $actions;

endif; ?>

}
<?php echo "?>"; ?>
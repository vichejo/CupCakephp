<?php
/**
 * CupCakePHP: Rapid Development Framework (http://cupcakephp.org)
 * Una solución basada en Cakephp (http://cakephp.org)
 * Copyright 2011, Coberture Diseño y Soluciones Web (http://coberture.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011, Coberture Diseño y Soluciones Web, Inc. (http://coberture.com)
 * @link          http://cupcakephp.org  una solución basada en CakePHP(tm) Project
 */

$cupc_datos=Configure::read('cupc');                      

?>
<!doctype html>
<html lang="es">

<head>
	<!-- <meta charset="utf-8"/> -->
        <?php echo $this->Html->charset(); ?>
	<title>
            <?php __($cupc_datos['app']['name'].' - '.$cupc_datos['app']['description']); ?>
            <?php echo $title_for_layout; ?>
        </title>
	    
       <?php
            //css al principio del documento
            //javascripts al final
		echo $this->Html->meta('icon');
                echo $this->Html->css('admin/layout.css');
                echo $this->Html->css('jquery-ui-1.8.13.custom.css');
                echo $this->Html->css('admin/jquery.cleditor.css');
                echo $this->Html->css('admin/jquery.plupload.queue.css');
                //echo $this->Html->css('admin/jquery.ui.plupload.css');
                echo $this->Html->css('admin/jquery.fileupload-ui.css');
                echo $this->Html->css('cloud-zoom.css');
                echo $this->Html->css('admin/jquery.Jcrop.css');
                echo $this->Html->css('jplayer.blue.monday.css');
	?>
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 	

</head>


<body>

        <?php echo $this->element('cabecera_privada',array('cache'=>'+0 hour'));?>
        <?php echo $this->element('subcabecera_privada',array('cache'=>'+0 hour'));?>
        
        <?php echo $this->element('menu_privado',array('cache'=>'+0 hour'));?>
        <?php echo $content_for_layout; ?>
        
        
        <?php
            //javascript al final del documento para optimización
            echo $this->Html->script('jquery-1.6.1.min.js');
            echo $this->Html->script('jquery-ui-1.8.13.custom.min.js');
            
            //datepicker
            echo $this->Html->script('i18n/jquery.ui.datepicker-es.js');
            
            //html5 schema
            echo $this->Html->script('admin/hideshow.js');
            echo $this->Html->script('admin/jquery.tablesorter.min.js');
            echo $this->Html->script('admin/jquery.equalHeight.js');
            echo $this->Html->script('html5_schema.js');
            //--------------
            
            //CLEditor para los textarea
            echo $this->Html->script('admin/cleditor/jquery.cleditor.min.js');

            
            //Plugload
            // Thirdparty intialization scripts, needed for the Google Gears and BrowserPlus runtimes
            //echo $this->Html->script('admin/plupload/js/plugload.gears.js');
            //echo $this->Html->script('admin/plugload/js/plugload.browserplus.js');
            // Load plupload and all it's runtimes and finally... the jQuery queue widget
            echo $this->Html->script('admin/plupload/js/plupload.full.js');
            //elegir los adecuados (queue o jquery.ui)
            echo $this->Html->script('admin/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js');
            //echo $this->Html->script('admin/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js');
            echo $this->Html->script('admin/plupload.queue.1.4.3.2.js');
            //echo $this->Html->script('admin/plupload.ui.1.4.3.2.js');
            //---------------
            
            //Blueimp jquery file uploader         
            echo $this->Html->script('admin/blueimpfup/jquery.tmpl.min.js');
            echo $this->Html->script('admin/blueimpfup/jquery.iframe-transport.js');
            echo $this->Html->script('admin/blueimpfup/jquery.fileupload.js');
            echo $this->Html->script('admin/blueimpfup/jquery.fileupload-ui.js');
            echo $this->Html->script('admin/blueimpfup/application.js');

            //cloud zoom
            echo $this->Html->script('cloud-zoom.1.0.2.min.js');
            
            //Jcrop
            echo $this->Html->script('admin/jquery.Jcrop.min.js');
            
            //JPlayer
            echo $this->Html->script('jQuery.jPlayer.2.0.0/jquery.jplayer.min.js');
            
            echo $this->Html->script('admin/coberture.js');
           
            
            echo $scripts_for_layout;
        ?>

        <?php echo $this->element('sql_dump'); ?>
</body>

</html>
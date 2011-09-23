<?php
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
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cupc_datos=Configure::read('cupc');                      
?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
            <?php __($cupc_datos['app']['name']); ?>
            <?php echo $title_for_layout; ?>
    </title>
    <meta name="description" content="<?=$cupc_datos['app']['description']?>">
    <meta name="keywords" content="<?=$cupc_datos['app']['keywords']?>">
    <meta name="author" content="<?=$cupc_datos['creator']['name']?>">	
    <meta name="viewport" content="width=880, initial-scale=1.0">

    
    <?php echo $html->meta('icon');?>
    <?php echo $this->Html->css('style.css');?>
    <?php echo $this->Html->css('jplayer/jplayer.audio.css');?>
    <?php echo $this->Html->css('jplayer/jplayer.blue.monday.css');?>
    <?php echo $this->Html->css('facebox.css');?>
    <?php echo $this->Html->css('shadowbox.css');?>   

    <?php echo $this->Html->script('jquery-1.6.2.min.js'); ?>
    
    
    <?php
        echo $scripts_for_layout;
        

        $sitio='inicio';
        if ($this->name=='Pages'){
            $sitio= $this->params['pass'][0];
        }else{
            $sitio=$this->name;
        }
        $txtaction=$this->params['action'];
        //print $sitio;
        //print_r($this->params);
        //print $txtaction;
    ?>
    
    <script>var numero_audios=0;</script>
	
</head>

<body>
	<div id="header-container"><header class="wrapper"></header></div>
	<div id="main" class="wrapper">
			<?php //echo $this->Session->flash(); ?>
                        <?php //echo $this->Session->flash('email'); ?>
			<?php echo $content_for_layout; ?>
 
        </div>
        <div id="footer-container">
            <footer class="wrapper">
                <h3>Cupcakephp</h3>
            </footer>
        </div>


        <?php echo $this->Html->script('modernizr-2.0.6.min.js'); ?>
        <?php echo $this->Html->script('facebox.js'); ?>
        <?php echo $this->Html->script('shadowbox.js'); ?>
        <?php echo $this->Html->script('jQuery.jPlayer.2.0.0/jquery.jplayer.min.js');?>
        <?php echo $this->Html->script('jquery.pajinate.js');?>
        <?php echo $this->Html->script('jQueryTitle.js');?>
	
        <?php echo $this->Html->script('cupcakephp.js');?>
       
        
        <!--[if lt IE 7 ]>
        <?php echo $this->Html->script('dd_belatedpng.js');?>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
	<script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>

 
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
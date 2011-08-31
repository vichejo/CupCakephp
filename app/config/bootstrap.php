<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

//-----------------
//reglas en español
//-----------------
Inflector::rules('singular', array(
        'rules' => array('/([r|d|j|n|l|m|y|z])es$/i' => '\1', '/([aeiou])s$/i' => '\1', '/([ti])a$/i' => '\1a', '/as$/i' => 'a'),
        'irregular' => array('users'=>'user', 'groups'=>'group','instant_payment_notifications'=>'instant_payment_notification', 'paypal_items'=>'paypal_item'),
        'uninflected' => array()
    )
);
//'/as$/i' => 'a'

Inflector::rules('plural', array(
        'rules' => array('/([r|d|j|n|l|m|y|z])$/i' => '\1es', '/([aeiou])$/i'=>'\1s', '/a$/i' => '\1as'),
        'irregular' => array('user'=>'users', 'group'=>'groups','instant_payment_notification'=>'instant_payment_notifications', 'paypal_item'=>'paypal_items'),
        'uninflected' => array()
    )
);
//'/a$/i' => '\1as',



//Configuraciones propias de CupCakephp
//Genereales
Configure::write('cupc.version', '1.6');
Configure::write('cupc.name','CupCakephp');
Configure::write('cupc.url','http://www.cupcakephp.com');
Configure::write('cupc.year','2011');
Configure::write('cupc.creator.name', 'Coberture.com');
Configure::write('cupc.creator.url','http://www.coberture.com');
Configure::write('cupc.creator.email','info@coberture.com');
//----------------------------------------------------------
//Aplicación generada a partir de CupCakephp
Configure::write('cupc.app.name','Cupcakephp');
Configure::write('cupc.app.description','web en construcción...');
Configure::write('cupc.app.keywords','');
Configure::write('cupc.app.date','Junio 2011');
Configure::write('cupc.app.url','http://devel2.coberture.com');
Configure::write('cupc.app.email','info@coberture.com');
//----------------------------------------------------------
//Idioma por defecto
Configure::write('Config.language','spa');
//----------------------------------------------------------
//Datos del administrador
Configure::write('cupc.app.administrator.name','Luismi');
Configure::write('cupc.app.administrator.email','luismi.aguilera@gmail.com');
Configure::write('cupc.app.administrator.telef','660000000');
//----------------------------------------------------------

//Multimedia
Configure::write('cupc.multimedias', array(
    'imagenes'=>array(
                'plural'=>'Imágenes',
                'singular'=>'Imagen',
                'tabla'=>'imagenes',
                'modelo'=>'Imagen',
                'campo_id'=>'imagen_id',
                'tipo_id'=>1
                ),
    'videos'=>array(
                'plural'=>'Vídeos',
                'singular'=>'Vídeo',
                'tabla'=>'videos',
                'modelo'=>'Video',
                'campo_id'=>'video_id',
                'tipo_id'=>2
                ),
    'audios'=>array(
                'plural'=>'Audios',
                'singular'=>'Audio',
                'tabla'=>'audios',
                'modelo'=>'Audio',
                'campo_id'=>'audio_id',
                'tipo_id'=>3
                ),
    'links'=>array(
                'plural'=>'Links',
                'singular'=>'Link',
                'tabla'=>'links',
                'modelo'=>'Link',
                'campo_id'=>'link_id',
                'tipo_id'=>4
                ),
    'ficheros'=>array(
                'plural'=>'Ficheros',
                'singular'=>'Fichero',
                'tabla'=>'ficheros',
                'modelo'=>'Fichero',
                'campo_id'=>'fichero_id',
                'tipo_id'=>5
                ),
));
Configure::write('cupc.multimedias.html',array(
    'imagenes'=>array(
        'html_del'=>"<div class='imagenes_relacionadas' id='imagenes##elemento_id##' style='display:none'>
                        <img src=\"../../upcontent/images/thumbnails/##filename##\" alt=\"##alt##\">
                        <p>##alt##</p>
                        <a href=\"/imagenes/add_crop/##elemento_id##\" target=\"_blank\">> crop!</a>
                        <a href=\"javascript:;\" class=\"elimina_multimedia\" rel='{\"tipo\":\"imagenes\",\"bloque_id\":\"imagenes##elemento_id##\", \"elemento_id\":##elemento_id##,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##}'>[-]</a>
                    </div>",
        'html_add'=>"<div class='imagenes_relacionadas' id='imagenesadd##elemento_id##'>
                            <img src='../../upcontent/images/thumbnails/##filename##' alt='##alt##'>
                            <p>##alt##</p>
                            <a href='javascript:;' class='adjunta_multimedia' rel='{\"tipo\":\"imagenes\",\"bloque_id\":\"imagenesadd##elemento_id##\" ,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##, \"elemento_id\":##elemento_id##}'>[+]</a>
                     </div>"
    ),
    'videos'=>array(
        'html_del'=>"<div class='videos_relacionados' id='videos##elemento_id##' style='display:none'>
                        <div>##iframe##</div> ##alt##
                        <a href=\"javascript:;\" class=\"elimina_multimedia\" rel='{\"tipo\":\"videos\",\"bloque_id\":\"videos##elemento_id##\", \"elemento_id\":##elemento_id##,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##}'>[-]</a>
                    </div>",
        'html_add'=>"<div class='videos_relacionados' id='videosadd##elemento_id##'>
                        <div>##iframe##</div> ##alt##
                        <a href='javascript:;' class='adjunta_multimedia' rel='{\"tipo\":\"videos\",\"bloque_id\":\"videosadd##elemento_id##\" ,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##, \"elemento_id\":##elemento_id##}'>[+]</a>
                     </div>"
    ),
    'audios'=>array(
        'html_del'=>"<div class='audios_relacionados' id='audios##elemento_id##' style='display:none'>
                        ##alt## - ##filename##
                        <a href=\"javascript:;\" class=\"elimina_multimedia\" rel='{\"tipo\":\"audios\",\"bloque_id\":\"audios##elemento_id##\", \"elemento_id\":##elemento_id##,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##}'>[-]</a>
                    </div>",
        'html_add'=>"<div class='audios_relacionados' id='audiosadd##elemento_id##'>
                        ##alt## - ##filename##
                        <a href='javascript:;' class='adjunta_multimedia' rel='{\"tipo\":\"audios\",\"bloque_id\":\"audiosadd##elemento_id##\" ,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##, \"elemento_id\":##elemento_id##}'>[+]</a>
                     </div>"
    ),
    'links'=>array(
        'html_del'=>"<div class='links_relacionados' id='links##elemento_id##' style='display:none'>
                        ##alt## - ##url##
                        <a href=\"javascript:;\" class=\"elimina_multimedia\" rel='{\"tipo\":\"links\",\"bloque_id\":\"links##elemento_id##\", \"elemento_id\":##elemento_id##,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##}'>[-]</a>
                    </div>",
        'html_add'=>"<div class='links_relacionados' id='linksadd##elemento_id##'>
                        ##alt## - ##url##
                        <a href='javascript:;' class='adjunta_multimedia' rel='{\"tipo\":\"links\",\"bloque_id\":\"linksadd##elemento_id##\" ,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##, \"elemento_id\":##elemento_id##}'>[+]</a>
                     </div>"
    ),
    'ficheros'=>array(
        'html_del'=>"<div class='ficheros_relacionados' id='ficheros##elemento_id##' style='display:none'>
                        ##alt## - ##entradilla##
                        <a href=\"javascript:;\" class=\"elimina_multimedia\" rel='{\"tipo\":\"ficheros\",\"bloque_id\":\"ficheros##elemento_id##\", \"elemento_id\":##elemento_id##,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##}'>[-]</a>
                    </div>",
        'html_add'=>"<div class='ficheros_relacionados' id='ficherosadd##elemento_id##'>
                        ##alt## - ##entradilla##
                        <a href='javascript:;' class='adjunta_multimedia' rel='{\"tipo\":\"ficheros\",\"bloque_id\":\"ficherosadd##elemento_id##\" ,\"item_id\":##item_id##, \"modulo_id\":##submodulo_id##, \"elemento_id\":##elemento_id##}'>[+]</a>
                     </div>"
    ),
));
//----------------------------------------------------------

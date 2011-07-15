<?php
/* SVN FILE: $Id: app_model.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {
	
	
      function find_xx($type, $options = array()) {
       switch ($type) {
         case 'superlist':
         	//$options['fields'] = array_merge(array($this->alias.'.'.$this->primaryKey),$options['fields']);
         	
           $total_fields = count($options['fields']);
           
           if(!isset($options['fields']) || $total_fields < 3){
             return parent::find('list', $options);
           }
           if(!isset($options['separator'])){
             $options['separator'] = ' ';
           }
           
           if(!isset($options['format'])){
             $options['format'] = '%s';
             for($i = 2; $i<$total_fields;$i++){
               $options['format'] .= "{$options['separator']}%s";
             }
           }
       
           $options['recursive'] = -1;              
           $list = parent::find('all', $options);
           
           $formatVals = array();
           $formatVals[0] = $options['format'];
           for($i = 1; $i < $total_fields; $i++){
             $formatVals[$i] = "{n}.{$this->alias}.".str_replace("{$this->alias}.", '', $options['fields'][$i]);
           }
           
           return Set::combine( $list, "{n}.{$this->alias}.{$this->primaryKey}", $formatVals );
         break;              

         default:              
         	return parent::find($type, $options);
         	break;
       }
      }
      
      
      function find($type, $options = array()) {
        switch ($type) {
            case 'superlist':
                if(!isset($options['fields']) || count($options['fields']) < 3) {
                    return parent::find('list', $options);
                }

                if(!isset($options['separator'])) {
                    $options['separator'] = ' ';
                }

                $options['recursive'] = -1;              
                $list = parent::find('all', $options);

                for($i = 1; $i <= 2; $i++) {
                    $field[$i] = str_replace($this->alias.'.', '', $options['fields'][$i]);               
                }            

                return Set::combine($list, '{n}.'.$this->alias.'.'.$this->primaryKey,
                                 array('%s'.$options['separator'].'%s',
                                       '{n}.'.$this->alias.'.'.$field[1],
                                       '{n}.'.$this->alias.'.'.$field[2]));
            break;                       

            default:              
                return parent::find($type, $options);
            break;
        }
    }
    
    // Reescribimos esta funcion para tener Internacionalización de mensajes en el modelo
    // eso si, las cadenas hay que añadirlas manualmente o hacer alguna chapucilla como
    // sustituir en la carpeta de modelo todas las cadenas de la forma “‘message’ =>” por “__(”
    // a la hora de crear todas las etiquetas
    function invalidate($field, $value = true) {
        if (!is_array($this->validationErrors)) {
         $this->validationErrors = array();
        }
        $this->validationErrors[$field] = __($value, true);
    }
      
	
    
}
?>
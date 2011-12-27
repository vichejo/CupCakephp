<?php
/**
 * Bake Template for Controller action generation.
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
 * @subpackage    cake.console.libs.template.objects
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

	function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->paginate());
	}

	function <?php echo $admin ?>view($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid <?php echo strtolower($singularHumanName) ?>', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
<?php else: ?>
			$this->flash(__('Invalid <?php echo strtolower($singularHumanName); ?>', true), 'alert_warning', array('action' => 'index'));
<?php endif; ?>
		}
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->read(null, $id));
	}

<?php $compact = array(); ?>
	function <?php echo $admin ?>add() {
		if (!empty($this->data)) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('<?php echo ucfirst(strtolower($currentModelName)); ?> saved.', true), 'alert_success' , array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.', true), 'message_error');
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
	function <?php echo $admin; ?>edit($id = null) {
		if (!$id && empty($this->data)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid <?php echo strtolower($singularHumanName); ?>', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), 'alert_warning' , array('action' => 'index'));
<?php endif; ?>
		}
		if (!empty($this->data)) {
			if ($this-><?php echo $currentModelName; ?>->save($this->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
<?php else: ?>
				$this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.', true), 'alert_success' , array('action' => 'index'));
<?php endif; ?>
			} else {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.', true), 'message_error');
<?php endif; ?>
			}
		}
		if (empty($this->data)) {
			$this->data = $this-><?php echo $currentModelName; ?>->read(null, $id);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
                
                ?>
                //-------------------------------------------------------
                // Multimedias relacionados - Listo para copiar y pegar
                // entrega a la vista varios datos informando de que contenido multimedia
                // hay disponible y varios arrays (de html) segun este.
                //-------------------------------------------------------
                if (!empty($this->cupc_related_multimedia)){
                    $this->loadModel('Submodulo');
                    $this->loadModel('Multimedia');
                    $this->loadModel('Categoria');

                    $cupc_submodulo_id=$this->cupc_submodulo_id;
                    
                    $datos_media=Configure::read('cupc.multimedias');                      
                    foreach($this->cupc_related_multimedia as $etiqueta){
                        $tipomedia=$datos_media[$etiqueta]['tipo_id'];
                        $modelo=$datos_media[$etiqueta]['modelo'];
                        $this->loadModel($modelo);
                        $relatedelement=$datos_media[$etiqueta]['campo_id'];
                        $html_media=$datos_media['html'][$etiqueta]['html_del'];
                        
                        
                        //buscamos los id's de los elementos asociados en multimedia
                        $conditions=array('submodulo_id'=>$cupc_submodulo_id, 'itemid'=>$id, 'tipomedia_id'=>$tipomedia);
                        $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($relatedelement), 'order'=>'Multimedia.id ASC'));
                        $ids=array();
                        foreach($multim as $mmid=>$mm){
                            array_push($ids,$mm['Multimedia'][$relatedelement]);
                        }
                        
                        $elementos=array();
                        $this->$modelo->recursive=0;
                        //sacamos los elementos en orden
                        if (!empty($ids)){
                            foreach ($ids as $nada=>$idimagen){
                                $conditions2=$modelo.".id = $idimagen";
                                $resultado=$this->$modelo->read(null,$idimagen);
                                if (!empty($resultado)){
                                    array_push($elementos, $resultado);
                                }
                            }
                        }

                        //si son imagenes tendran crop
                        if ($etiqueta == 'imagenes') {
                            //esta galeria es del tipo:
                            $cropid=$this->cupc_crop_id;  //varia si hay crops distintos segun tipo de evento****
                            $this->loadModel('Crop');
                            $imagenesconcrop=$this->Crop->find('first', array('conditions'=>array('Crop.id'=>$cropid)));
                            $arrayimgconcrop=array();
                            if(!empty($imagenesconcrop)){
                                foreach($imagenesconcrop['Imagen'] as $imgcrop){
                                    array_push($arrayimgconcrop, $imgcrop['id']);
                                }
                            }
                            $arrayimgconcrop=array_intersect($ids, $arrayimgconcrop);
                            $contimagenesconcrop=count($arrayimgconcrop);
                        }
                        
                        
                        $array_html=array();                        
                        foreach($elementos as $ind=>$element){
                            $elemento_id=$element[$modelo]['id'];
                            $nuevo_html=$html_media;
                            //estos elementos siempre van a existir
                            $nuevo_html=str_replace('##elemento_id##',$elemento_id,$nuevo_html);
                            $nuevo_html=str_replace('##item_id##',$id,$nuevo_html);
                            $nuevo_html=str_replace('##submodulo_id##',$cupc_submodulo_id,$nuevo_html);
                            //estos pueden o no existir
                            
                            //si son imagenes tendran crop
                            if ($etiqueta == 'imagenes') {
                                $tipogaleriacrop=$this->cupc_tipo_crop;
                                if ($tipogaleriacrop==1){ //solo necesario 1 crop
                                    if ($contimagenesconcrop==0){
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> crop!</a>";                                   
                                    }else{
                                        if (in_array($elemento_id, $arrayimgconcrop)){
                                            $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> modificar crop</a>";
                                        }else{
                                            $cadenacrop="";                   
                                        }
                                    }
                                }else{//necesarios todos los crops
                                    if (in_array($elemento_id, $arrayimgconcrop)){
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> modificar crop</a>";
                                    }else{
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> crop!</a>";                                                   
                                    }                                                                    
                                }
                                
                                $nuevo_html=str_replace('##crop##',$cadenacrop,$nuevo_html);
                            }
                            
                            if (isset($element[$modelo]['filename'])) $nuevo_html=str_replace('##filename##',$element[$modelo]['filename'],$nuevo_html);
                            if (isset($element[$modelo]['url'])) $nuevo_html=str_replace('##url##',$element[$modelo]['url'],$nuevo_html);
                            if (isset($element[$modelo]['titulo'])) $nuevo_html=str_replace('##alt##',$element[$modelo]['titulo'],$nuevo_html);
                            if (isset($element[$modelo]['entradilla'])) $nuevo_html=str_replace('##entradilla##',$element[$modelo]['entradilla'],$nuevo_html);
                            if (isset($element[$modelo]['contenido'])){
                                $iframe=$element[$modelo]['contenido'];
                                $nuevo_html=str_replace('##iframe##',$iframe,$nuevo_html);
                            }
                            array_push($array_html,$nuevo_html);
                        }
                        $this->set($etiqueta,$elementos);
                        $this->set($etiqueta."_html",$array_html);
                    }
                    //si hay coordinadores, solo ven sus categorias
                    if ($idgrupo>2){
                        $this->set('cupc_categorias_multimedia',$this->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) )))));
                    }else{
                        $this->set('cupc_categorias_multimedia',$this->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ))));                        
                    }
                    $this->set('cupc_submodulo_id',$this->cupc_submodulo_id);
                    $this->set('cupc_item_id',$id);
                }
                $this->set('cupc_related_multimedia',$this->cupc_related_multimedia);
                //--------------------------------------------------------------------------
                <?php 
                
	?>
	}

	function <?php echo $admin; ?>delete($id = null) {
		if (!$id) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('Invalid id for <?php echo strtolower($singularHumanName); ?>', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(sprintf(__('Invalid <?php echo strtolower($singularHumanName); ?>', true)), 'alert_warning', array('action' => 'index'));
<?php endif; ?>
		}
		if ($this-><?php echo $currentModelName; ?>->delete($id)) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
<?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted', true), 'alert_success', array('action' => 'index'));
<?php endif; ?>
		}
<?php if ($wannaUseSession): ?>
		$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted', true), 'message_error');
<?php else: ?>
		$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted', true), 'message_error', array('action' => 'index'));
<?php endif; ?>
		$this->redirect(array('action' => 'index'));
	}
<?php
class GaleriasController extends AppController {

	var $name = 'Galerias';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';

        //Multimedia: elementos disponibles: (imagenes, videos, audios, links, ficheros);
        var $cupc_related_multimedia = array('imagenes');
        //Comentarios: el modulo puede tener o no comentarios
        var $cupc_has_comments=false;
        
	function index() {
		$this->Galeria->recursive = 0;
		$this->set('galerias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('galeria', $this->Galeria->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Galeria->create();
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list');
		$this->set(compact('tipogalerias'));
	}

	function edit($id = null) {
            $this->Session->setFlash(__('Para crear una Galería de imágenes, hay que añadir mínimo 2 imágenes relacionadas.', true), 'alert_warning');

            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Galeria->read(null, $id);
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list');
		$this->set(compact('tipogalerias'));
                
                //-------------------------------------------------------
                // Multimedias relacionados - Listo para copiar y pegar
                // entrega a la vista varios datos informando de que contenido multimedia
                // hay disponible y varios arrays (de html) segun este.
                //-------------------------------------------------------
                if (!empty($this->cupc_related_multimedia)){
                    $this->loadModel('Submodulo');
                    $this->loadModel('Multimedia');
                    $this->loadModel('Categoria');
                    $cupc_submodulo=$this->Submodulo->find('first',array('conditions'=>array('Submodulo.nombre'=>$this->name)));
                    $cupc_submodulo_id=$cupc_submodulo['Submodulo']['id'];
                    
                    $datos_media=Configure::read('cupc.multimedias');                      
                    foreach($this->cupc_related_multimedia as $etiqueta){
                        $tipomedia=$datos_media[$etiqueta]['tipo_id'];
                        $modelo=$datos_media[$etiqueta]['modelo'];
                        $this->loadModel($modelo);
                        $relatedelement=$datos_media[$etiqueta]['campo_id'];
                        $html_media=$datos_media['html'][$etiqueta]['html_del'];
                        
                        $conditions=array('submodulo_id'=>$cupc_submodulo_id, 'itemid'=>$id, 'tipomedia_id'=>$tipomedia);
                        $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($relatedelement)));
                        $ids="(";
                        foreach($multim as $mmid=>$mm){
                            $ids.=$mm['Multimedia'][$relatedelement].",";
                        }
                        $ids=substr($ids,0,-1);$ids.=')';
                        if ($ids==")") $ids='(0)';
                        
                        $conditions2=$modelo.".id IN $ids";
                        $this->$modelo->recursive=0;
                        $elementos=$this->$modelo->find('all',array('conditions'=>$conditions2));

                        //si son imagenes tendran crop
                        if ($etiqueta == 'imagenes') {
                            //esta galeria es del tipo:
                            $cropid=$this->data['Tipogaleria']['crop_id'];                                
                            $this->loadModel('Crop');
                            $imagenesconcrop=$this->Crop->find('first', array('conditions'=>array('Crop.id'=>$cropid)));
                            $contimagenesconcrop=count($imagenesconcrop['Imagen']);
                            $arrayimgconcrop=array();
                            foreach($imagenesconcrop['Imagen'] as $imgcrop){
                                array_push($arrayimgconcrop, $imgcrop['id']);
                            }
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
                                $tipogaleriacrop=$this->data['Tipogaleria']['tipocrop'];
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
                                    $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> crop!</a>";                                
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
                    
                    $this->set('cupc_categorias_multimedia',$this->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array('Categoria.userid'=>$iduser, 'Categoria.userid'=>1)))));
                    $this->set('cupc_submodulo_id',$cupc_submodulo_id);
                    $this->set('cupc_item_id',$id);
                }
                $this->set('cupc_related_multimedia',$this->cupc_related_multimedia);
                //--------------------------------------------------------------------------
                
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for galeria', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Galeria->delete($id)) {
			$this->Session->setFlash(__('Galeria deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Galeria was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
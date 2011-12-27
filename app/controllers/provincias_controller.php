<?php
class ProvinciasController extends AppController {

	var $name = 'Provincias';
        var $paginate = array('limit' => 20, 'order'=>'titulo ASC');
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';
        
        //Multimedia: elementos disponibles: (imagenes, videos, audios, ficheros);
        var $cupc_related_multimedia = array('imagenes', 'videos', 'audios', 'ficheros');
        //Comentarios: el modulo puede tener o no comentarios
        var $cupc_has_comments=true;
        

        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('lista'));
        }
        
	function index() {
		$this->Provincia->recursive = 0;
		$this->set('provincias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid provincia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $this->loadModel('Evento');
                $this->loadModel('Localidad');
                $this->loadModel('Teatro');
		$eventos = $this->Evento->find('list');
		$localidades = $this->Localidad->find('list');
		$teatros = $this->Teatro->find('list');
                $this->set('eventos',$eventos);
                $this->set('localidades',$localidades);
                $this->set('teatros',$teatros);
		$this->set('provincia', $this->Provincia->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Provincia->create();
			if ($this->Provincia->save($this->data)) {
				$this->Session->setFlash(__('The provincia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The provincia could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid provincia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Provincia->save($this->data)) {
				$this->Session->setFlash(__('The provincia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The provincia could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Provincia->read(null, $id);
		}
                //-------------------------------------------------------
                // Multimedias relacionados
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

                        $array_html=array();
                        foreach($elementos as $ind=>$element){
                            $elemento_id=$element[$modelo]['id'];
                            $nuevo_html=$html_media;
                            //estos elementos siempre van a existir
                            $nuevo_html=str_replace('##elemento_id##',$elemento_id,$nuevo_html);
                            $nuevo_html=str_replace('##item_id##',$id,$nuevo_html);
                            $nuevo_html=str_replace('##submodulo_id##',$cupc_submodulo_id,$nuevo_html);
                            //estos pueden o no existir
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
                    $this->set('cupc_categorias_multimedia',$this->Categoria->find('list'));
                    $this->set('cupc_submodulo_id',$cupc_submodulo_id);
                }
                $this->set('cupc_related_multimedia',$this->cupc_related_multimedia);
                //--------------------------------------------------------------------------
                	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for provincia', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Provincia->delete($id)) {
			$this->Session->setFlash(__('Provincia deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Provincia was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        function lista() {
            $this->Provincia->recursive=0;
            $secciones = $this->Provincia->find('all', array('order'=>'titulo ASC'));
            if(isset($this->params['requested'])) {
                return $secciones;
            }
            $this->set('lista',$secciones);
	}
}
?>
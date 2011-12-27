<?php
class LocalidadesController extends AppController {

	var $name = 'Localidades';
        var $paginate = array('limit' => 20, 'order'=>'Provincia.titulo ASC, Localidad.titulo ASC');
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';
        
        //Multimedia: elementos disponibles: (imagenes, videos, audios, links, ficheros);
        var $cupc_related_multimedia = array('imagenes', 'videos', 'audios', 'ficheros');
        //Comentarios: el modulo puede tener o no comentarios
        var $cupc_has_comments=true;
        

        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('options'));
        }
        
	function index() {
		$this->Localidad->recursive = 0;
		$this->set('localidades', $this->paginate());
	}

        function options() {
            $this->layout="ajax";
            $info=array("status"=>"ko");
            if (isset($_POST['id'])){
                $id=$_POST['id'];
                
                $this->Localidad->recursive = 0;
                $conditions="";
                if ($id!=null AND $id!=0) $conditions="provincia_id = $id";
                $localidades= $this->Localidad->find('list', array("conditions"=>$conditions, 'order'=>'titulo ASC'));

                if (!empty($localidades)){
                    
                    $html="";
                    foreach($localidades as $id=>$nombre){
                        $html.= '<option value="'.$id.'">'.$nombre.'</option>';
                    }
                    $info=array("status"=>"ok", "datos"=>$html);
                }else{
                    $info=array("status"=>"ko", "datos"=>"No Data");
                }                
            }            
            echo json_encode($info);die();                
	}
        
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid localidad', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $this->loadModel('Evento');
                $this->loadModel('Teatro');
		$eventos = $this->Evento->find('list');
		$teatros = $this->Teatro->find('list');
                $this->set('eventos',$eventos);
                $this->set('teatros',$teatros);
		$this->set('localidad', $this->Localidad->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Localidad->create();
			if ($this->Localidad->save($this->data)) {
				$this->Session->setFlash(__('The localidad has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The localidad could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$provincias = $this->Localidad->Provincia->find('list', array('order'=>'Provincia.titulo ASC'));
		$this->set(compact('provincias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid localidad', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Localidad->save($this->data)) {
				$this->Session->setFlash(__('The localidad has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The localidad could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Localidad->read(null, $id);
		}
		$provincias = $this->Localidad->Provincia->find('list', array('order'=>'Provincia.titulo ASC'));
		$this->set(compact('provincias'));
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
			$this->Session->setFlash(__('Invalid id for localidad', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Localidad->delete($id)) {
			$this->Session->setFlash(__('Localidad deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Localidad was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
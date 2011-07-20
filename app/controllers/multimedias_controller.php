<?php
class MultimediasController extends AppController {

	var $name = 'Multimedias';
        var $paginate = array('limit' => 20);
        var $layout='private';
        
        var $path_ficheros_privados="../../app/webroot/upcontent/restricted/";
        var $path_ficheros_publicos="../../app/webroot/upcontent/";
        
	function index() {
		$this->Multimedia->recursive = 0;
		$this->set('multimedias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid multimedia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('multimedia', $this->Multimedia->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Multimedia->create();
			if ($this->Multimedia->save($this->data)) {
				$this->Session->setFlash(__('The multimedia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multimedia could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$submodulos = $this->Multimedia->Submodulo->find('list');
		$imagenes = $this->Multimedia->Imagen->find('list');
		$videos = $this->Multimedia->Video->find('list');
		$audios = $this->Multimedia->Audio->find('list');
		$links = $this->Multimedia->Link->find('list');
		$ficheros = $this->Multimedia->Fichero->find('list');
		$tipomedias = $this->Multimedia->Tipomedia->find('list');
		$this->set(compact('submodulos', 'imagenes', 'videos', 'audios', 'links', 'ficheros', 'tipomedias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid multimedia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Multimedia->save($this->data)) {
				$this->Session->setFlash(__('The multimedia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The multimedia could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Multimedia->read(null, $id);
		}
		$submodulos = $this->Multimedia->Submodulo->find('list');
		$imagenes = $this->Multimedia->Imagen->find('list');
		$videos = $this->Multimedia->Video->find('list');
		$audios = $this->Multimedia->Audio->find('list');
		$links = $this->Multimedia->Link->find('list');
		$ficheros = $this->Multimedia->Fichero->find('list');
		$tipomedias = $this->Multimedia->Tipomedia->find('list');
		$this->set(compact('submodulos', 'imagenes', 'videos', 'audios', 'links', 'ficheros', 'tipomedias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for multimedia', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Multimedia->delete($id)) {
			$this->Session->setFlash(__('Multimedia deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Multimedia was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        
        
        //------------------
        // Funciones de utilidad para añadir medios a los modulos
        
        function carga_medios(){
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
            if (isset($_POST['modulo_id']) AND isset($_POST['tipo']) AND isset($_POST['item_id']) AND isset($_POST['filtro_usados']) AND isset($_POST['filtro_categorias']) ){ // AND isset($_POST['filtro_publicos'])
                $modulo_id=$_POST['modulo_id'];
                $item_id=$_POST['item_id'];
                $tipo=$_POST['tipo'];
                //$publicos=$_POST['filtro_publicos'];
                $usados=$_POST['filtro_usados'];
                $categoria_id=$_POST['filtro_categorias'];
                
                $datos_media=Configure::read('cupc.multimedias');  
                $tipomedia=$datos_media[$tipo]['tipo_id'];
                $modelo=$datos_media[$tipo]['modelo'];
                $campo=$datos_media[$tipo]['campo_id'];
                $html_media=$datos_media['html'][$tipo]['html_add'];
                
                
                $conditions=array('submodulo_id'=>$modulo_id, 'itemid'=>$item_id, 'tipomedia_id'=>$tipomedia);
                $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($campo)));
                $ids="(";
                foreach($multim as $mmid=>$mm){
                    $ids.=$mm['Multimedia'][$campo].",";
                }
                $ids=substr($ids,0,-1);$ids.=')';
                if ($ids==")") $ids='(0)';
                
                $this->Multimedia->$modelo->recursive=0;
                $conditions2=$modelo.".id IN $ids";
                $datos= $this->Multimedia->$modelo->find('all',array('conditions'=>array("$modelo.userid"=>$iduser, "$modelo.esactivo"=>true, "$modelo.categoria_id"=>$categoria_id, "NOT"=>array($conditions2)) , 'order'=>array("$modelo.created"=>'desc')));

                $html="";
                foreach($datos as $ind=>$element){
                    $elemento_id=$element[$modelo]['id'];
                    $nuevo_html=$html_media;
                    //estos elementos siempre van a existir
                    $nuevo_html=str_replace('##elemento_id##',$elemento_id,$nuevo_html);
                    $nuevo_html=str_replace('##item_id##',$item_id,$nuevo_html);
                    $nuevo_html=str_replace('##submodulo_id##',$modulo_id,$nuevo_html);
                    //estos pueden o no existir
                    if (isset($element[$modelo]['filename'])) $nuevo_html=str_replace('##filename##',$element[$modelo]['filename'],$nuevo_html);
                    if (isset($element[$modelo]['url'])) $nuevo_html=str_replace('##url##',$element[$modelo]['url'],$nuevo_html);
                    if (isset($element[$modelo]['titulo'])) $nuevo_html=str_replace('##alt##',$element[$modelo]['titulo'],$nuevo_html);
                    if (isset($element[$modelo]['entradilla'])) $nuevo_html=str_replace('##entradilla##',$element[$modelo]['entradilla'],$nuevo_html);
                    if (isset($element[$modelo]['contenido'])){
                        $iframe=$element[$modelo]['contenido'];
                        $nuevo_html=str_replace('##iframe##',$iframe,$nuevo_html);
                    }

                    $html.=$nuevo_html;
                }
                $info=array("status"=>"ok","datos"=>$html,"paginacion"=>"(pagina 1 de 1) < ... >");
            }else{
                $info=array("status"=>"ko");
            }            
            echo json_encode($info);die();
        }
        
        
        function add_medio(){
            if (isset($_POST['modulo_id']) AND isset($_POST['item_id']) AND isset($_POST['tipo']) AND isset($_POST['elemento_id']) ){
                $modulo_id=$_POST['modulo_id'];
                $item_id=$_POST['item_id'];
                $tipo=$_POST['tipo'];
                $elemento_id=$_POST['elemento_id'];
                
                $datos_media=Configure::read('cupc.multimedias');  
                $tipomedia=$datos_media[$tipo]['tipo_id'];
                $modelo=$datos_media[$tipo]['modelo'];
                $campo=$datos_media[$tipo]['campo_id'];
                $html_media=$datos_media['html'][$tipo]['html_del'];
                               

                $data['Multimedia']['tipomedia_id']=$tipomedia;
                $data['Multimedia']['submodulo_id']=$modulo_id;
                $data['Multimedia']['itemid']=$item_id;
                $data['Multimedia']['imagen_id']=0;
                $data['Multimedia']['video_id']=0;
                $data['Multimedia']['audio_id']=0;
                $data['Multimedia']['link_id']=0;
                $data['Multimedia']['fichero_id']=0;
                $data['Multimedia'][$campo]=$elemento_id;

                $this->Multimedia->create();
                if ($this->Multimedia->save($data)) {
                    $this->Multimedia->$modelo->recursive=0;
                    $element=$this->Multimedia->$modelo->read(null,$elemento_id);

                    $nuevo_html=$html_media;
                    //estos elementos siempre van a existir
                    $nuevo_html=str_replace('##elemento_id##',$elemento_id,$nuevo_html);
                    $nuevo_html=str_replace('##item_id##',$item_id,$nuevo_html);
                    $nuevo_html=str_replace('##submodulo_id##',$modulo_id,$nuevo_html);
                    //estos pueden o no existir
                    if (isset($element[$modelo]['filename'])) $nuevo_html=str_replace('##filename##',$element[$modelo]['filename'],$nuevo_html);
                    if (isset($element[$modelo]['url'])) $nuevo_html=str_replace('##url##',$element[$modelo]['url'],$nuevo_html);
                    if (isset($element[$modelo]['titulo'])) $nuevo_html=str_replace('##alt##',$element[$modelo]['titulo'],$nuevo_html);
                    if (isset($element[$modelo]['entradilla'])) $nuevo_html=str_replace('##entradilla##',$element[$modelo]['entradilla'],$nuevo_html);
                    if (isset($element[$modelo]['contenido'])){
                        $iframe=$element[$modelo]['contenido'];
                        $nuevo_html=str_replace('##iframe##',$iframe,$nuevo_html);
                    }
                            
                    $info=array("status"=>"ok","html"=>$nuevo_html);
                } else {
                    $info=array("status"=>"ko 2");
                }
                    
            }else{
                $info=array("status"=>"ko");
            }            
            echo json_encode($info);die();                
        }
        function del_medio(){
            if (isset($_POST['modulo_id']) AND isset($_POST['item_id']) AND isset($_POST['tipo']) AND isset($_POST['elemento_id']) ){
                $modulo_id=$_POST['modulo_id'];
                $item_id=$_POST['item_id'];
                $tipo=$_POST['tipo'];
                $elemento_id=$_POST['elemento_id'];
                
                $datos_media=Configure::read('cupc.multimedias');  
                $tipomedia=$datos_media[$tipo]['tipo_id'];
                $modelo=$datos_media[$tipo]['modelo'];
                $campo=$datos_media[$tipo]['campo_id'];
                
                $cond=$campo."=".$elemento_id;

                $this->Multimedia->recursive=0;
                $data=$this->Multimedia->find('first',array('conditions'=>array('submodulo_id'=>$modulo_id, 'tipomedia_id'=>$tipomedia, 'itemid'=>$item_id, $cond)));
                $id=$data['Multimedia']['id'];
                if ($this->Multimedia->delete($id)) {
                    $info=array("status"=>"ok");
                } else {
                    $info=array("status"=>"ko 2");
                }
            }else{
                $info=array("status"=>"ko");
            }            
            echo json_encode($info);die();                
        }
}
?>
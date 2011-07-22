<?php
class OpinionesController extends AppController {

	var $name = 'Opiniones';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');     
        var $components = array('Email');
        var $layout='private';

        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('opinar','opiniones_de','send_email'));
        }
        
	function index() {
		$this->Opinion->recursive = 0;
		$this->set('opiniones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid opinion', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('opinion', $this->Opinion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Opinion->create();
			if ($this->Opinion->save($this->data)) {
				$this->Session->setFlash(__('The opinion has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opinion could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$usuarios = $this->Opinion->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid opinion', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Opinion->save($this->data)) {
				$this->Session->setFlash(__('The opinion has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opinion could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Opinion->read(null, $id);
		}
		$usuarios = $this->Opinion->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for opinion', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Opinion->delete($id)) {
			$this->Session->setFlash(__('Opinion deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Opinion was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        
        
        function opinar(){
            $info=array("status"=>"ko","mess"=>"Error al enviar el comentario");

            if (!empty($_POST)){
                if (isset($_POST['modulo'])){
                    $modulo=$_POST['modulo'];
                    $item=$_POST['item'];
                    $nombre=$_POST['nombre'];
                    $email=$_POST['email'];
                    $comentario=$_POST['comentario'];
                    $en=$_POST['modulo'].": ".$_POST['titulo'];
                    
                    //if ($modulo=='editorial' OR $modulo=='piezas' OR $modulo=='palabras') $subm=10;
                    //else if ($modulo=='pasos') $subm=19;
                    //else $subm=18;
                    
                    $subm=10; //eventos
                                        
                    $data['Opinion']['usuario_id']=1; //unregistered
                    $data['Opinion']['submodulo_id']=$subm;
                    $data['Opinion']['itemid']=$item;
                    $data['Opinion']['nombre']=$nombre;
                    $data['Opinion']['email']=$email;
                    $data['Opinion']['descripcion']=$comentario;
                    $data['Opinion']['esactivo']=0;
                    $data['Opinion']['en']=$en;
                    
                    $this->Opinion->create();
                    if ($this->Opinion->save($data)) {
                        $info=array("status"=>"ok", "idform"=>$item);
                    } else {
                        $info=array("status"=>"ko", "idform"=>$item, "mess"=>"Error al enviar el comentario");                                            
                    }
                }
            }
            echo json_encode($info);die();
        }
        
        function opiniones_de($modulo="", $id=null){
            $this->layout = 'default';
            $this->Opinion->recursive = 0;
            
            //if ($modulo=='editorial' OR $modulo=='piezas' OR $modulo=='palabras') $subm=10;
            //else if ($modulo=='pasos') $subm=19;
            //else $subm=18;
            
            $subm=10; //eventos
            
            $comentarios=array();
            if ($id!=null AND $modulo!=""){
                $comentarios = $this->Opinion->find('all', array('conditions'=>array('submodulo_id'=>$subm, 'itemid'=>$id, 'Opinion.esactivo'=>true)));
            }
            if(isset($this->params['requested'])) {
                return $comentarios;
            }
            $this->set('comentarios',$comentarios);
        }
        
        function send_email(){
            $this->layout='default';
            
            $info=array("status"=>"ko","mess"=>"Error al enviar el email");
            if (!empty($_POST)){
                if (isset($_POST['email'])){
                    $emailapp=Configure::read('cupc.app.email'); 
                    $nombreapp=Configure::read('cupc.app.name'); 
                    
                    $this->Email->from = "$nombreapp <$emailapp>";
                    $this->Email->to = $_POST['email'];
                    $this->Email->subject = $_POST['nombre'].' te recomienda este articulo en Olvidos.es';
                    $this->Email->sendAs = 'text';
                    $this->Email->delivery = 'mail';
                    $this->Email->template = 'default';
                    
                    $this->set('parametros', $_POST);
                    
                    $ok=$this->Email->send(); 
                    
                    $info=array("status"=>"ok", "idform"=>$_POST['item'], "ok"=>$ok);
                }
            }
            echo json_encode($info);die();
        }
        
        
}
?>
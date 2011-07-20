<?php
class LinksController extends AppController {

	var $name = 'Links';
        var $paginate = array('limit' => 20);        
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';

	function index() {
		$this->Link->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $this->paginate = array('conditions'=>array("userid=$iduser"));
                
		$this->set('links', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid link', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Link->read(null, $id);
                if ($datos['Link']['userid']!=$iduser){
                    $this->Session->setFlash(__('Invalid link', true), 'alert_warning');
                    $this->redirect(array('action' => 'index'));
                }
		$this->set('link', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!empty($this->data)) {
			$this->Link->create();
                        
                        $this->data['Link']['userid']=$iduser;
			if ($this->Link->save($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$categorias = $this->Link->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
                
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid link', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Link->save($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Link->read(null, $id);
                        if ($this->data['Link']['userid']!=$iduser){
                            $this->Session->setFlash(__('The link could not be saved. Please, try again.', true), 'message_error');
                            $this->redirect(array('action' => 'index'));
                        }
		}
		$categorias = $this->Link->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for link', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                
                $this->Link->id=$id;
		$datos=$this->Link->read();
                if ($datos['Link']['userid']!=$iduser){
                    $this->Session->setFlash(__('The link could not be deleted. Please, try again.', true), 'message_error');
                    $this->redirect(array('action' => 'index'));
                }
                
		if ($this->Link->delete($id)) {
			$this->Session->setFlash(__('Link deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Link was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
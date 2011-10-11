<?php
class CategoriasController extends AppController {

	var $name = 'Categorias';
        var $paginate = array('limit' => 20);
        var $layout='private';
        

	function index() {
		$this->Categoria->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $this->paginate = array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser),array('Categoria.userid'=>1) )));
                
		$this->set('categorias', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid categoria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Categoria->read(null, $id);
                if ($datos['Categoria']['userid']!=$iduser){
                    $this->Session->setFlash(__('Invalid categoria', true), 'alert_warning');
                    $this->redirect(array('action' => 'index'));
                }
		$this->set('categoria', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $grupo=$this->Session->read('Auth.User.group_id');
		if (!empty($this->data)) {
			$this->Categoria->create();
                        if ($grupo!=1) {
                            $this->data['Categoria']['esvisible']=1;
                            $this->data['Categoria']['esmodificable']=1;
                        }
                        $this->data['Categoria']['userid']=$iduser;
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('The categoria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid categoria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        $this->data['Categoria']['userid']=$iduser;
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('The categoria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoria->read(null, $id);
                        if ($this->data['Categoria']['userid']!=$iduser){
                            $this->Session->setFlash(__('The categoria could not be saved. Please, try again.', true), 'message_error');
                            $this->redirect(array('action' => 'index'));
                        }
		}
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for categoria', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Categoria->id=$id;
		$datos=$this->Categoria->read();
                if ($datos['Categoria']['userid']!=$iduser){
                    $this->Session->setFlash(__('The categoria could not be deleted. Please, try again.', true), 'message_error');
                    $this->redirect(array('action' => 'index'));
                }
                
		if ($this->Categoria->delete($id)) {
                    $this->Session->setFlash(__('Categoria deleted', true), 'alert_success');
                    $this->redirect(array('action'=>'index'));
                }
                $this->Session->setFlash(__('Categoria was not deleted', true), 'message_error');
                $this->redirect(array('action' => 'index'));
                
	}
        
        
        
}
?>
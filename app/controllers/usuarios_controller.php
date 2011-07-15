<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
        var $paginate = array('limit' => 20);

	function index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usuario', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('The usuario has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$users = $this->Usuario->Users->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usuario', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('The usuario has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		$users = $this->Usuario->Users->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Usuario deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
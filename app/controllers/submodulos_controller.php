<?php
class SubmodulosController extends AppController {

	var $name = 'Submodulos';
        var $paginate = array('limit' => 20);

	function index() {
		$this->Submodulo->recursive = 0;
		$this->set('submodulos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid submodulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('submodulo', $this->Submodulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Submodulo->create();
			if ($this->Submodulo->save($this->data)) {
				$this->Session->setFlash(__('The submodulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The submodulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$modulos = $this->Submodulo->Modulo->find('list');
		$this->set(compact('modulos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid submodulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Submodulo->save($this->data)) {
				$this->Session->setFlash(__('The submodulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The submodulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Submodulo->read(null, $id);
		}
		$modulos = $this->Submodulo->Modulo->find('list');
		$this->set(compact('modulos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for submodulo', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Submodulo->delete($id)) {
			$this->Session->setFlash(__('Submodulo deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Submodulo was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
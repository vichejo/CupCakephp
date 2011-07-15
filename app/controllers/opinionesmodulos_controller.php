<?php
class OpinionesmodulosController extends AppController {

	var $name = 'Opinionesmodulos';
        var $paginate = array('limit' => 20);

	function index() {
		$this->Opinionesmodulo->recursive = 0;
		$this->set('opinionesmodulos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid opinionesmodulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('opinionesmodulo', $this->Opinionesmodulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Opinionesmodulo->create();
			if ($this->Opinionesmodulo->save($this->data)) {
				$this->Session->setFlash(__('The opinionesmodulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opinionesmodulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$submodulos = $this->Opinionesmodulo->Submodulo->find('list');
		$opiniones = $this->Opinionesmodulo->Opinion->find('list');
		$this->set(compact('submodulos', 'opiniones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid opinionesmodulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Opinionesmodulo->save($this->data)) {
				$this->Session->setFlash(__('The opinionesmodulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The opinionesmodulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Opinionesmodulo->read(null, $id);
		}
		$submodulos = $this->Opinionesmodulo->Submodulo->find('list');
		$opiniones = $this->Opinionesmodulo->Opinion->find('list');
		$this->set(compact('submodulos', 'opiniones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for opinionesmodulo', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Opinionesmodulo->delete($id)) {
			$this->Session->setFlash(__('Opinionesmodulo deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Opinionesmodulo was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
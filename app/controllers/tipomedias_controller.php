<?php
class TipomediasController extends AppController {

	var $name = 'Tipomedias';
        var $paginate = array('limit' => 20);

	function index() {
		$this->Tipomedia->recursive = 0;
		$this->set('tipomedias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipomedia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipomedia', $this->Tipomedia->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipomedia->create();
			if ($this->Tipomedia->save($this->data)) {
				$this->Session->setFlash(__('The tipomedia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipomedia could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipomedia', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipomedia->save($this->data)) {
				$this->Session->setFlash(__('The tipomedia has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipomedia could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipomedia->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipomedia', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipomedia->delete($id)) {
			$this->Session->setFlash(__('Tipomedia deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipomedia was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
<?php
class TipoeventosController extends AppController {

	var $name = 'Tipoeventos';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Tipoevento->recursive = 0;
		$this->set('tipoeventos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipoevento', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoevento', $this->Tipoevento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipoevento->create();
			if ($this->Tipoevento->save($this->data)) {
				$this->Session->setFlash(__('The tipoevento has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipoevento could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipoevento', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipoevento->save($this->data)) {
				$this->Session->setFlash(__('The tipoevento has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipoevento could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipoevento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipoevento', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipoevento->delete($id)) {
			$this->Session->setFlash(__('Tipoevento deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipoevento was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
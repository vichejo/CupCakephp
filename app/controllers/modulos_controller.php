<?php
class ModulosController extends AppController {

	var $name = 'Modulos';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Modulo->recursive = 0;
		$this->set('modulos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid modulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('modulo', $this->Modulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Modulo->create();
			if ($this->Modulo->save($this->data)) {
				$this->Session->setFlash(__('The modulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The modulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid modulo', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Modulo->save($this->data)) {
				$this->Session->setFlash(__('The modulo has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The modulo could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Modulo->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for modulo', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Modulo->delete($id)) {
			$this->Session->setFlash(__('Modulo deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Modulo was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
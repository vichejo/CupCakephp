<?php
class ContactosController extends AppController {

	var $name = 'Contactos';
        var $paginate = array('limit' => 20);

	function index() {
		$this->Contacto->recursive = 0;
		$this->set('contactos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contacto', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('contacto', $this->Contacto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Contacto->create();
			if ($this->Contacto->save($this->data)) {
				$this->Session->setFlash(__('The contacto has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contacto could not be saved. Please, try again.', true), 'message_error');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid contacto', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Contacto->save($this->data)) {
				$this->Session->setFlash(__('The contacto has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contacto could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Contacto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contacto', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Contacto->delete($id)) {
			$this->Session->setFlash(__('Contacto deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contacto was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
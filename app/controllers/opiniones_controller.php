<?php
class OpinionesController extends AppController {

	var $name = 'Opiniones';
        var $paginate = array('limit' => 20);

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
}
?>
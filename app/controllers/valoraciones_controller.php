<?php
class ValoracionesController extends AppController {

	var $name = 'Valoraciones';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Valoracion->recursive = 0;
		$this->set('valoraciones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid valoracion', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('valoracion', $this->Valoracion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Valoracion->create();
			if ($this->Valoracion->save($this->data)) {
				$this->Session->setFlash(__('The valoracion has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The valoracion could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$submodulos = $this->Valoracion->Submodulo->find('list');
		$this->set(compact('submodulos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid valoracion', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Valoracion->save($this->data)) {
				$this->Session->setFlash(__('The valoracion has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The valoracion could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Valoracion->read(null, $id);
		}
		$submodulos = $this->Valoracion->Submodulo->find('list');
		$this->set(compact('submodulos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for valoracion', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Valoracion->delete($id)) {
			$this->Session->setFlash(__('Valoracion deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Valoracion was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
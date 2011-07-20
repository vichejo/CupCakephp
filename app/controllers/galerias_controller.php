<?php
class GaleriasController extends AppController {

	var $name = 'Galerias';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Galeria->recursive = 0;
		$this->set('galerias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('galeria', $this->Galeria->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Galeria->create();
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list');
		$this->set(compact('tipogalerias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Galeria->read(null, $id);
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list');
		$this->set(compact('tipogalerias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for galeria', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Galeria->delete($id)) {
			$this->Session->setFlash(__('Galeria deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Galeria was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
<?php
class CropsController extends AppController {

	var $name = 'Crops';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Crop->recursive = 0;
		$this->set('crops', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crop', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('crop', $this->Crop->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Crop->create();
			if ($this->Crop->save($this->data)) {
				$this->Session->setFlash(__('The crop has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crop could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$submodulos = $this->Crop->Submodulo->find('list');
		$imagenes = $this->Crop->Imagen->find('list');
		$this->set(compact('submodulos', 'imagenes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid crop', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Crop->save($this->data)) {
				$this->Session->setFlash(__('The crop has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crop could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Crop->read(null, $id);
		}
		$submodulos = $this->Crop->Submodulo->find('list');
		$imagenes = $this->Crop->Imagen->find('list');
		$this->set(compact('submodulos', 'imagenes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for crop', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Crop->delete($id)) {
			$this->Session->setFlash(__('Crop deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Crop was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>

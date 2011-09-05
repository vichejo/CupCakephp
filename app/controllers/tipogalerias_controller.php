<?php
class TipogaleriasController extends AppController {

	var $name = 'Tipogalerias';
        var $paginate = array('limit' => 20);
        var $layout='private';

	function index() {
		$this->Tipogaleria->recursive = 0;
		$this->set('tipogalerias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipogaleria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipogaleria', $this->Tipogaleria->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipogaleria->create();
			if ($this->Tipogaleria->save($this->data)) {
				$this->Session->setFlash(__('The tipogaleria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipogaleria could not be saved. Please, try again.', true), 'message_error');
			}
		}
                $crops = $this->Tipogaleria->Crop->find('list', array('conditions'=>array('Crop.submodulo_id'=>12)));
                $this->set('crops',$crops);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipogaleria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipogaleria->save($this->data)) {
				$this->Session->setFlash(__('The tipogaleria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipogaleria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipogaleria->read(null, $id);
		}
                $crops = $this->Tipogaleria->Crop->find('list', array('conditions'=>array('Crop.submodulo_id'=>12)));
                $this->set('crops',$crops);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipogaleria', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipogaleria->delete($id)) {
			$this->Session->setFlash(__('Tipogaleria deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipogaleria was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
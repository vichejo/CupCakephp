<?php
class ContactosController extends AppController {

	var $name = 'Contactos';
        var $paginate = array('limit' => 20);
        var $components = array('Email');
        var $layout='private';

        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allowedActions = array('consultar');
	}
        
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
        
        function consultar() {
            $this->pageTitle = 'Contactar...';
            $this->layout = 'default';
            $emailapp=Configure::read('cupc.app.email'); 
            $nombreapp=Configure::read('cupc.app.name'); 
            $urlapp=Configure::read('cupc.app.url');
            $emailadmin=Configure::read('cupc.app.administrator.email');
            $nombreadmin=Configure::read('cupc.app.administrator.name');
            
            if (isset($_POST['email']) AND $nombreapp!="" AND $emailadmin!="") {
                $this->data['Contacto']['leida']=0;
                if ($this->Contacto->save($this->data)) {
                //$this->Session->setFlash('Su información ha sido enviada.');
                //enviamos el email
                $datos_email=$nombreapp." \n\nFormulario de contacto relleno en la web:\n\n";
                $datos_email.="Nombre: ".$_POST['nombre']."\n";
                $datos_email.="Telefono: ".$_POST['telefono']."\n";
                $datos_email.="Email: ".$_POST['email']."\n";
                //$datos_email.="Subject: ".$this->data['Contacto']['subject']."\n";
                $datos_email.="Description: ".$_POST['comentario'];

                //Multimedia Research
                $this->Email->from =  $_POST['email'];
                $this->Email->to = "$nombreadmin <$emailadmin>";
                $this->Email->subject = 'Formulario relleno en la Web';
                $this->Email->sendAs = 'text';
                $this->Email->delivery = 'mail';
                //$this->Email->send($datos_email);

                //redireccionamos
                if (!$this->Email->send($datos_email)){
                        $this->redirect(array('controller' => 'pages', 'action' => 'envio_ko'));
                }

                $this->Email->reset();

                //enviamos el email al cliente
                $this->Email->from = "$nombreapp <$emailapp>";
                $this->Email->to = $_POST['email'];
                $this->Email->subject = "$nombreapp : Formulario de contacto recibido";
                $this->Email->sendAs = 'text';
                $this->Email->delivery = 'mail';
                $mensaje= "Estimado ".$_POST['nombre'].", \n
Hemos recibido su formulario de contacto.

En breve nos pondremos en contacto con usted.

Un Saludo

".$nombreapp."
".$urlapp."
    ";
                //if ($this->data['Contacto']['copy']) $mensaje.="\n\n".$datos_email;

                //redireccionamos
                if ($this->Email->send($mensaje)){
                        $this->redirect(array('controller' => 'pages', 'action' => 'envio_ok'));
                }else{
                        $this->redirect(array('controller' => 'pages', 'action' => 'envio_ko'));
                }
            }
            }
	}
}
?>
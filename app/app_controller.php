<?php
class AppController extends Controller {
    var $components = array('Acl', 'Auth', 'Session');
    var $helpers = array('Html', 'Form', 'Session');

    //beforeFilter será completamente necesario descomentar para habilitar
    //el sistema de autenticación.
    
    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'admin');

        $this->Auth->actionPath = 'controllers/';

        //si queremos deshabilitar la cache
        $this->disableCache();
        
        //todas las acciones 'display' de todos los métodos serán publicas
        //ademas podemos habilitar los metodos para paypal si se desean usar en el proyecto
        $this->Auth->allowedActions = array('display','afterPaypalNotification','process','actualizaEstado');

        $this->Auth->flashElement    = "message_error";
        $this->Auth->userScope = array('User.esactivo' => true);

        //con esto habilitamos todo (temporalmente)
        //$this->Auth->allowedActions = array ('*');
    }
    
}
?>

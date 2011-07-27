<?php
class UsersController extends AppController {

	var $name = 'Users';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');     
        var $layout='private';
	
        //permitir acciones independientemente de la autenticación
        //usar en cada controlador cuando la autenticación esté habilitada
        //y queramos permitir el acceso en algún controlador concreto
       /* function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('admin'));
        }*/
        
        
        function index() {
		$this->User->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $grupo=$this->Session->read('Auth.User.group_id');
                if ($grupo!=1) {$this->paginate = array('limit' => 20,'conditions'=>array("User.esvisible=1"));}
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
                        //comprobamos los permisos
                        $iduser=$this->Session->read('Auth.User.id');
                        $grupo=$this->Session->read('Auth.User.group_id');
                        if ($grupo!=1) {
                            if ($this->data['User']['group_id']==0 OR $this->data['User']['group_id']==1){
                                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                            $this->data['User']['esvisible']=1;
                            $this->data['User']['esmodificable']=1;
                        }
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true), 'message_error');
			}
		}
		//comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $grupo=$this->Session->read('Auth.User.group_id');
                $conditions="";
                if ($grupo!=1) { $conditions="esvisible=1";}
                
                $groups = $this->User->Group->find('list',array('conditions'=>$conditions));
		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                    //comprobamos los permisos
                    $iduser=$this->Session->read('Auth.User.id');
                    $grupo=$this->Session->read('Auth.User.group_id');
                    if ($grupo!=1) {
                        if ($this->data['User']['group_id']==0 OR $this->data['User']['group_id']==1){
                            $this->Session->setFlash(__('The user could not be saved. Please, try again.', true), 'message_error');
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                    
                        // Verificar si sus permisos de grupo han cambiado ----
                        // 
                        // Nota: este código se usaba en la versión 1.2 de cake pero 
                        // habrá que estudiar si aun sigue siendo necesario!!!
			$oldgroupid = $this->User->field('group_id');
			
			if ($oldgroupid !== $this->data['User']['group_id']) {
			    $aro =& $this->Acl->Aro;
			    $user = $aro->findByForeignKeyAndModel($this->data['User']['id'], 'User');
			    $group = $aro->findByForeignKeyAndModel($this->data['User']['group_id'], 'Group');
			                
			    // Guardar en la tabla ARO
			    $aro->id = $user['Aro']['id'];
			    $aro->save(array('parent_id' => $group['Aro']['id']));
			}
			//--------------------------------------------------------
                        
                        if ($this->data['User']['password']=="") $this->data['User']['password']=$this->data['User']['oldpassword'];
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
                        $this->data['User']['oldpassword']=$this->data['User']['password'];
                        $this->data['User']['password']="";
		}
                $iduser=$this->Session->read('Auth.User.id');
                $grupo=$this->Session->read('Auth.User.group_id');
                $conditions="";
                if ($grupo!=1) { $conditions="esvisible=1";}
                
		$groups = $this->User->Group->find('list',array('conditions'=>$conditions));
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                //comprobamos los permisos
                $this->data=$this->User->read(null,$id);
                $grupo=$this->Session->read('Auth.User.group_id');
                if ($grupo!=1) {
                    if ($this->data['User']['group_id']==0 OR $this->data['User']['group_id']==1){
                        $this->Session->setFlash(__('The user could not be deleted.', true), 'message_error');
                        $this->redirect(array('action' => 'index'));
                    }
                }
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}



        //Métodos de autenticación
        //------------------------

        function login() {
            if ($this->Session->read('Auth.User')) {
		$this->Session->setFlash('You are logged in!');
		$this->redirect('/', null, false);
            }
        }


        function logout() {
            $this->Session->setFlash('Good-Bye');
            $this->redirect($this->Auth->logout());
        }


        function admin(){
            //inicialmente contenido estático
            //opciones disponibles en la administracion...
        }



        
        //-------------------------------------------
        //Funciones para actualizar el arbol de ACOs
        //-------------------------------------------
        function build_acl() {
		if (!Configure::read('debug')) {
			return $this->_stop();
		}
		$log = array();

		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id;
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}

		App::import('Core', 'File');
		$Controllers = App::objects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'build_acl';

		$Plugins = $this->_getPluginControllerNames();
		$Controllers = array_merge($Controllers, $Plugins);

		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			$methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

			// Do all Plugins First
			if ($this->_isPlugin($ctrlName)){
				$pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
				if (!$pluginNode) {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
					$pluginNode = $aco->save();
					$pluginNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
				}
			}
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				if ($this->_isPlugin($ctrlName)){
					$pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
					$aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
				} else {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $ctrlName;
				}
			} else {
				$controllerNode = $controllerNode[0];
			}

			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		if(count($log)>0) {
			debug($log);
		}
	}

	function _getClassMethods($ctrlName = null) {
		App::import('Controller', $ctrlName);
		if (strlen(strstr($ctrlName, '.')) > 0) {
			// plugin's controller
			$num = strpos($ctrlName, '.');
			$ctrlName = substr($ctrlName, $num+1);
		}
		$ctrlclass = $ctrlName . 'Controller';
		$methods = get_class_methods($ctrlclass);

		// Add scaffold defaults if scaffolds are being used
		$properties = get_class_vars($ctrlclass);
		if (array_key_exists('scaffold',$properties)) {
			if($properties['scaffold'] == 'admin') {
				$methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
			} else {
				$methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
			}
		}
		return $methods;
	}

	function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	function _getPluginControllerName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[1];
		} else {
			return false;
		}
	}

        //
        // Get the names of the plugin controllers ...
        //
        // This function will get an array of the plugin controller names, and
        // also makes sure the controllers are available for us to get the
        // method names by doing an App::import for each plugin controller.
        //
        // @return array of plugin names.
        //
        //
	function _getPluginControllerNames() {
		App::import('Core', 'File', 'Folder');
		$paths = Configure::getInstance();
		$folder =& new Folder();
		$folder->cd(APP . 'plugins');

		// Get the list of plugins
		$Plugins = $folder->read();
		$Plugins = $Plugins[0];
		$arr = array();

		// Loop through the plugins
		foreach($Plugins as $pluginName) {
			// Change directory to the plugin
			$didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
			// Get a list of the files that have a file name that ends
			// with controller.php
			$files = $folder->findRecursive('.*_controller\.php');

			// Loop through the controllers we found in the plugins directory
			foreach($files as $fileName) {
				// Get the base file name
				$file = basename($fileName);

				// Get the controller name
				$file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
				if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
					if (!App::import('Controller', $pluginName.'.'.$file)) {
						debug('Error importing '.$file.' for plugin '.$pluginName);
					} else {
						/// Now prepend the Plugin name ...
						// This is required to allow us to fetch the method names.
						$arr[] = Inflector::humanize($pluginName) . "/" . $file;
					}
				}
			}
		}
		return $arr;
	}
        //--------------------------------------------

        //Inicializar los permisos de los distintos grupos
        //------------------------------------------------
        function initDB() {
            $group =& $this->User->Group;

            //Permitimos a los Administradores (nosotros) todo
            $group->id = 1;
            $this->Acl->allow($group, 'controllers');

            //Permitimos al Subadministrador (cliente) algunas acciones
            //pero no crear, editar grupos
            $group->id = 2;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->deny($group, 'controllers/Groups');
            $this->Acl->deny($group, 'controllers/Modulos');
            $this->Acl->deny($group, 'controllers/Submodulos');
            $this->Acl->deny($group, 'controllers/Configuraciones');
            $this->Acl->deny($group, 'controllers/Tipogalerias');
            $this->Acl->deny($group, 'controllers/Tipoeventos');
            $this->Acl->deny($group, 'controllers/Tipomedias');
            $this->Acl->deny($group, 'controllers/Crops');
            $this->Acl->deny($group, 'controllers/Valoraciones');
        
            //Permitimos a los Coordinadores algunas acciones pero no
            //crear, editar grupos o  usuarios
            $group->id = 3;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->deny($group, 'controllers/Users/add');
            $this->Acl->deny($group, 'controllers/Users/edit');
            $this->Acl->deny($group, 'controllers/Users/delete');
            $this->Acl->deny($group, 'controllers/Groups');
            $this->Acl->deny($group, 'controllers/Modulos');
            $this->Acl->deny($group, 'controllers/Submodulos');
            $this->Acl->deny($group, 'controllers/Configuraciones');
            $this->Acl->deny($group, 'controllers/Tipogalerias');
            $this->Acl->deny($group, 'controllers/Tipoeventos');
            $this->Acl->deny($group, 'controllers/Tipomedias');
            $this->Acl->deny($group, 'controllers/Crops');
            $this->Acl->deny($group, 'controllers/Valoraciones');
                    
            //acciones para los usuarios
            $group->id = 4;
            $this->Acl->deny($group, 'controllers');
            $this->Acl->allow($group, 'controllers/Users/login');
            $this->Acl->allow($group, 'controllers/Users/logout');

            //we add an exit to avoid an ugly "missing views" error message
            echo "all done";
            exit;
        }
}
?>

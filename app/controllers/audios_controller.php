<?php
class AudiosController extends AppController {

	var $name = 'Audios';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');
	var $components = array('Upload');
        var $layout='private';
        
	var $path_ficheros_privados="../../app/webroot/upcontent/restricted/audios";
	var $path_ficheros_publicos="../../app/webroot/upcontent/audios";
        var $path_ficheros_tmp="../../app/webroot/upcontent/tmp";
        
	function index() {
		$this->Audio->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $idgrupo=$this->Session->read('Auth.User.group_id');
                
                if ($idgrupo>2){
                    $this->paginate = array('limit'=>12, 'order'=>'Audio.created DESC','conditions'=>array("Audio.userid=$iduser"));
                }else{
                    $this->paginate = array('limit'=>12, 'order'=>'Audio.created DESC');
                }
		$this->set('audios', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
                    $this->Session->setFlash(__('Invalid audio', true), 'alert_warning');
                    $this->redirect(array('action' => 'index'));
		}
                $datos=$this->Audio->read(null, $id);
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                    if ($datos['Audio']['userid']!=$iduser){
                        $this->Session->setFlash(__('Invalid audio', true), 'alert_warning');
                        $this->redirect(array('action' => 'index'));
                    }
                }
		$this->set('audio', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!empty($this->data)) {
			$this->Audio->create();
                        
                        // Grabamos el fichero--------------------
			//$this->cleanUpFields();
                        
                        
			// contenido publico o privado
                        $destination = realpath($this->path_ficheros_publicos).'/';
                        // si alguna vez se necesita se puede distinguir entre publicos y privados
                        //if ($this->data['Audio']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        
                        //-------------------
                        $this->data['Audio']['espublico']=1; //contenido publico por defecto
                        $this->data['Audio']['esactivo']=1; //activo por defecto
                        $this->data['Audio']['userid']=$iduser; //pertenece al que lo ha subido
                        //-----
                        
			// grab the file
			$file = $this->data['Audio']['filename'];
			
			if ($file['name']!=""){
				$result = $this->Upload->upload_audio($file, $destination);
				if ($result!=false){
					$this->data['Audio']['filename'] = $result;
				} else {
					// display error
					$errors = $this->Upload->errors;
					// piece together errors
					if(is_array($errors)){ $errors = implode("<br />",$errors); }
					$this->Session->setFlash($errors,'message_error');
					$this->redirect($this->referer());
					exit();
				}
			}else{
				$this->data['Audio']['filename'] ="";
			}			
			//----
                        
                        
			if ($this->Audio->save($this->data)) {
				$this->Session->setFlash(__('The audio has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The audio could not be saved. Please, try again.', true), 'message_error');
			}
		}
                $categorias=$this->Audio->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid audio', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                    //Tratamiento del fichero-------------------------------
			//Si el fichero no se modifica el campo estará vacio y para que no se borre al guardar lo
			//ponemos con el contenido antiguo. otra cosa será que haya marcado la opción de eliminar
			//con lo que tendremos que tratarlo y eliminar el fichero físico.
			$data_old = $this->Audio->read(null, $id);
                        
                        if ($data_old['Audio']['espublico']==0) $destination_old = realpath($this->path_ficheros_privados).'/';
                        else $destination_old = realpath($this->path_ficheros_publicos).'/';
                        
                        if ($this->data['Audio']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        else $destination = realpath($this->path_ficheros_publicos).'/';
			
			if ($this->data['Audio']['filename']['name']==""){                           
				if ($this->data['Audio']['sinfichero']=="1"){
                                    //eliminamos todos los ficheros que hayan
                                    $nombre_pdf= $data_old['Audio']['filename'];
                                    if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                                    if (file_exists($destination_old.$nombre_pdf)){
                                       	$this->Session->setFlash(__('The audio could not be deleted. Please, try again.', true), 'message_error');
                                    }else{
                                        $this->data['Audio']['filename']= "";
                                    }
				}else{
                                    $this->data['Audio']['filename']= $data_old['Audio']['filename'];  
                                }
			}else{ 
                            $nombre_pdf= $data_old['Audio']['filename'];
                            if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                            //luego guardamos de nuevo
                            //$this->cleanUpFields();
                            $file = $this->data['Audio']['filename'];
                            // upload the file using the upload component
                            $result = $this->Upload->upload_audio($file, $destination);
                            if ($result!=false){
                                $this->data['Audio']['filename'] = $result;
                            } else {
                                // display error
                                $errors = $this->Upload->errors;
                                if(is_array($errors)){ $errors = implode("<br />",$errors); }
                                $this->Session->setFlash($errors,'message_error');
                                $this->redirect($this->referer());
                                exit();
                            }
			}//------------------
                    
			if ($this->Audio->save($this->data)) {
				$this->Session->setFlash(__('The audio has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The audio could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Audio->read(null, $id);
                        
                        if ($idgrupo>2){
                            if ($this->data['Audio']['userid']!=$iduser){
                                $this->Session->setFlash(__('The audio could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                        }
		}
                $categorias=$this->Audio->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for audio', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Audio->id=$id;
		$datos=$this->Audio->read();
                
                if ($idgrupo>2){
                    if ($datos['Audio']['userid']!=$iduser){
                        $this->Session->setFlash(__('The audio could not be deleted. Please, try again.', true), 'message_error');
                        $this->redirect(array('action' => 'index'));
                    }
                }
                
		if ($this->Audio->delete($id)) {
                    $nombre_fichero= $datos['Audio']['filename'];
                    $destination = realpath("$this->path_ficheros_privados") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    
                    $this->Session->setFlash(__('Audio deleted', true), 'alert_success');
                    $this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Audio was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
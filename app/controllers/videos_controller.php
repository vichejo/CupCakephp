<?php
class VideosController extends AppController {

	var $name = 'Videos';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');     
        var $components = array('Upload');
        var $layout='private';
 
	var $path_ficheros_privados="../../app/webroot/upcontent/restricted/videos";
	var $path_ficheros_publicos="../../app/webroot/upcontent/videos";
        var $path_ficheros_tmp="../../app/webroot/upcontent/tmp";
        
	function index() {
		$this->Video->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                        $this->paginate = array('limit'=>12, 'order'=>'Video.created DESC','conditions'=>array("Video.userid=$iduser"));
                }else{
                    $this->paginate = array('limit'=>12, 'order'=>'Video.created DESC');
                }
		$this->set('videos', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid video', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Video->read(null, $id);
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                    if ($datos['Video']['userid']!=$iduser){
                        $this->Session->setFlash(__('Invalid video', true), 'alert_warning');
                        $this->redirect(array('action' => 'index'));
                    }
                }
		$this->set('video', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!empty($this->data)) {
			$this->Video->create();
                        
                        // Grabamos el fichero--------------------
			//$this->cleanUpFields();
                        
			// set the upload destination folder
                        if ($this->data['Video']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        else $destination = realpath($this->path_ficheros_publicos).'/';

			// grab the file
			$file = $this->data['Video']['filename'];
			
			if ($file['name']!=""){
				$result = $this->Upload->upload_video($file, $destination);
				if ($result!=false){
					$this->data['Video']['filename'] = $result;
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
				$this->data['Video']['filename'] ="";
			}			
			//-------------------
                        $this->data['Video']['espublico']=1;
                        $this->data['Video']['esactivo']=1;
                        $this->data['Video']['userid']=$iduser;
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash(__('The video has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.', true), 'message_error');
			}
		}
                $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
                    
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid video', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                    
                    //Tratamiento del fichero-------------------------------
			//Si el fichero no se modifica el campo estará vacio y para que no se borre al guardar lo
			//ponemos con el contenido antiguo. otra cosa será que haya marcado la opción de eliminar
			//con lo que tendremos que tratarlo y eliminar el fichero físico.
			$data_old = $this->Video->read(null, $id);
                        
                        if ($data_old['Video']['espublico']==0) $destination_old = realpath($this->path_ficheros_privados).'/';
                        else $destination_old = realpath($this->path_ficheros_publicos).'/';
                        
                        if ($this->data['Video']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        else $destination = realpath($this->path_ficheros_publicos).'/';
			
		/*	if ($this->data['Video']['filename']['name']==""){                           
				if ($this->data['Video']['sinfichero']=="1"){
                                    //eliminamos todos los ficheros que hayan
                                    $nombre_pdf= $data_old['Video']['filename'];
                                    if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                                    if (file_exists($destination_old.$nombre_pdf)){
                                       	$this->Session->setFlash(__('The video could not be deleted. Please, try again.', true), 'message_error');
                                    }else{
                                        $this->data['Video']['filename']= "";
                                    }
				}else{
                                    $this->data['Video']['filename']= $data_old['Video']['filename'];  
                                }
			}else{ 
                            $nombre_pdf= $data_old['Video']['filename'];
                            if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                            //luego guardamos de nuevo
                            //$this->cleanUpFields();
                            $file = $this->data['Video']['filename'];
                            // upload the file using the upload component
                            $result = $this->Upload->upload_video($file, $destination);
                            if ($result!=false){
                                $this->data['Video']['filename'] = $result;
                            } else {
                                // display error
                                $errors = $this->Upload->errors;
                                if(is_array($errors)){ $errors = implode("<br />",$errors); }
                                $this->Session->setFlash($errors,'message_error');
                                $this->redirect($this->referer());
                                exit();
                            }
			}//------------------
                    */
                        //$this->data['Video']['userid']=$iduser;
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash(__('The video has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Video->read(null, $id);
                        $idgrupo=$this->Session->read('Auth.User.group_id');
                        if ($idgrupo>2){
                            if ($this->data['Video']['userid']!=$iduser){
                                $this->Session->setFlash(__('The video could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                        }
		}
                $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for video', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Video->id=$id;
		$datos=$this->Video->read();
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                    if ($datos['Video']['userid']!=$iduser){
                        $this->Session->setFlash(__('The video could not be deleted. Please, try again.', true), 'message_error');
                        $this->redirect(array('action' => 'index'));
                    }
                }
                
		if ($this->Video->delete($id)) {
                    $nombre_fichero= $datos['Video']['filename'];
                    if ($nombre_fichero!=""){
                        $destination = realpath("$this->path_ficheros_privados") . '/';
                        if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                        $destination = realpath("$this->path_ficheros_publicos") . '/';
                        if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    }
                    
			$this->Session->setFlash(__('Video deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Video was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
}
?>
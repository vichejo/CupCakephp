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
        
	function index($filtro=null) {
		$this->Video->recursive = 0;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $idgrupo=$this->Session->read('Auth.User.group_id');
                
                $condicion2=""; 
                $this->Video->Categoria->recursive=1;
                if ($idgrupo>2){
                    $categorias=$this->Video->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Video->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 )));
                }
                //eliminamos las que no tengan imagenes asociadas 
                $categoriaslistado=array();
                foreach($categorias as $indice=>$catego){
                    if (!empty($catego['Video'])) $categoriaslistado[$catego['Categoria']['id']]=$catego['Categoria']['nombre'];
                }
                $this->set('categorias',$categoriaslistado);
                if ($filtro!=null) $condicion2="Video.categoria_id=$filtro";
                else {
                    if (!empty($categoriaslistado)){
                        foreach($categoriaslistado as $idc=>$cat){
                            $condicion2="Video.categoria_id=$idc";
                            $filtro=$idc;
                            break;
                        }
                    }
                } 
                $this->set('selectedcat',$filtro);
                
                if ($idgrupo>2){
                    $this->paginate = array('limit'=>12, 'order'=>'Video.created DESC','conditions'=>array("Video.userid=$iduser",$condicion2));
                }else{
                    $this->paginate = array('limit'=>12, 'order'=>'Video.created DESC','conditions'=>array($condicion2));
                }
		$this->set('videos', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid video', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Video->read(null, $id);
                
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
            $idgrupo=$this->Session->read('Auth.User.group_id');

		if (!empty($this->data)) {
			$this->Video->create();
                        
                        // Grabamos el fichero--------------------
			//$this->cleanUpFields();
                        
                        // contenido publico o privado
                        $destination = realpath($this->path_ficheros_publicos).'/';
                        // si alguna vez se necesita se puede distinguir entre publicos y privados
                        //if ($this->data['Video']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';

                        //-------------------
                        $this->data['Video']['espublico']=1;
                        $this->data['Video']['esactivo']=1;
                        $this->data['Video']['userid']=$iduser;
                        
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
			
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash(__('The video has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.', true), 'message_error');
			}
		}
                if ($idgrupo>2){
                    $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 )));
                } 
                $this->set(compact('categorias'));
	}

	function edit($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
       
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
                        
                   /*     if ($data_old['Video']['espublico']==0) $destination_old = realpath($this->path_ficheros_privados).'/';
                        else $destination_old = realpath($this->path_ficheros_publicos).'/';
                        
                        if ($this->data['Video']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        else $destination = realpath($this->path_ficheros_publicos).'/';
			
			if ($this->data['Video']['filename']['name']==""){                           
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
                        if ($idgrupo>2){
                            if ($this->data['Video']['userid']!=$iduser){
                                $this->Session->setFlash(__('The video could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                        }
		}
                if ($idgrupo>2){
                    $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Video->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 )));
                } 
                $this->set(compact('categorias'));
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for video', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Video->id=$id;
		$datos=$this->Video->read();
                
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
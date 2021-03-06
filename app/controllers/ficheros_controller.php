<?php
class FicherosController extends AppController {

	var $name = 'Ficheros';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');
	var $components = array('Upload');
        var $layout='private';
        
	var $path_ficheros_privados="../../app/webroot/upcontent/restricted/files";
	var $path_ficheros_publicos="../../app/webroot/upcontent/files";
        var $path_ficheros_tmp="../../app/webroot/upcontent/tmp";
        
        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('uploadfiles','uploadmultiplefiles','descargar'));
        }
        
	function index($filtro=null) {
		$this->Fichero->recursive = 0;
                $iduser=$this->Session->read('Auth.User.id');
                $idgrupo=$this->Session->read('Auth.User.group_id');
                
                $condicion2=""; 
                $this->Fichero->Categoria->recursive=1;
                if ($idgrupo>2){
                    $categorias=$this->Fichero->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Fichero->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 )));
                }
                //eliminamos las que no tengan imagenes asociadas 
                $categoriaslistado=array();
                foreach($categorias as $indice=>$catego){
                    if (!empty($catego['Fichero'])) $categoriaslistado[$catego['Categoria']['id']]=$catego['Categoria']['nombre'];
                }
                $this->set('categorias',$categoriaslistado);
                if ($filtro!=null) $condicion2="Fichero.categoria_id=$filtro";
                else {
                    if (!empty($categoriaslistado)){
                        foreach($categoriaslistado as $idc=>$cat){
                            $condicion2="Fichero.categoria_id=$idc";
                            $filtro=$idc;
                            break;
                        }
                    }
                } 
                $this->set('selectedcat',$filtro);
                
                if ($idgrupo>2){
                    $this->paginate = array('limit'=>12, 'order'=>'Fichero.created DESC','conditions'=>array("Fichero.userid=$iduser",$condicion2));
                }else{
                    $this->paginate = array('limit'=>12, 'order'=>'Fichero.created DESC', 'conditions'=>array($condicion2));
                }
		$this->set('ficheros', $this->paginate());
	}

	function view($id = null) {
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid fichero', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Fichero->read(null, $id);
                
                if ($idgrupo>2){
                    if ($datos['Fichero']['userid']!=$iduser){
                        $this->Session->setFlash(__('Invalid imagen', true), 'alert_warning');
                        $this->redirect(array('action' => 'index'));
                    }
                }
		$this->set('fichero', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
                            
		if (!empty($this->data)) {
			$this->Fichero->create();
                                       
                        // Grabamos el fichero--------------------
			//$this->cleanUpFields();
                        
                        // contenido publico o privado
                        $destination = realpath($this->path_ficheros_publicos).'/';
                        // si alguna vez se necesita se puede distinguir entre publicos y privados
                        //if ($this->data['Fichero']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        
                        //-------------------
                        $this->data['Fichero']['espublico']=1;
                        $this->data['Fichero']['esactivo']=1;
                        $this->data['Fichero']['userid']=$iduser;
                        
			// grab the file
			$file = $this->data['Fichero']['filename'];
			
			if ($file['name']!=""){
				$result = $this->Upload->upload_file($file, $destination);
				if ($result!=false){
					$this->data['Fichero']['filename'] = $result;
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
				$this->data['Fichero']['filename'] ="";
			}			
			
			if ($this->Fichero->save($this->data)) {
				$this->Session->setFlash(__('The fichero has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fichero could not be saved. Please, try again.', true), 'message_error');
			}
		}
                if ($idgrupo>2){
                    $categorias=$this->Fichero->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Fichero->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 )));
                } 
                $this->set(compact('categorias'));
	}

	function edit($id = null) {
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fichero', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        //Tratamiento del fichero-------------------------------
			//Si el fichero no se modifica el campo estará vacio y para que no se borre al guardar lo
			//ponemos con el contenido antiguo. otra cosa será que haya marcado la opción de eliminar
			//con lo que tendremos que tratarlo y eliminar el fichero físico.
			$data_old = $this->Fichero->read(null, $id);
                        
                        if ($data_old['Fichero']['espublico']==0) $destination_old = realpath($this->path_ficheros_privados).'/';
                        else $destination_old = realpath($this->path_ficheros_publicos).'/';
                        
                        if ($this->data['Fichero']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';
                        else $destination = realpath($this->path_ficheros_publicos).'/';
			
			if ($this->data['Fichero']['filename']['name']==""){                           
				if ($this->data['Fichero']['sinfichero']=="1"){
                                    //eliminamos todos los ficheros que hayan
                                    $nombre_pdf= $data_old['Fichero']['filename'];
                                    if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                                    if (file_exists($destination_old.$nombre_pdf)){
                                       	$this->Session->setFlash(__('The fichero could not be deleted. Please, try again.', true), 'message_error');
                                    }else{
                                        $this->data['Fichero']['filename']= "";
                                    }
				}else{
                                    $this->data['Fichero']['filename']= $data_old['Fichero']['filename'];  
                                }
			}else{ 
                            
                            $nombre_pdf= $data_old['Fichero']['filename'];
                            if (file_exists($destination_old.$nombre_pdf)) unlink($destination_old.$nombre_pdf);
                            //luego guardamos de nuevo
                            //$this->cleanUpFields();
                            $file = $this->data['Fichero']['filename'];
                            // upload the file using the upload component
                            $result = $this->Upload->upload_file($file, $destination);
                            if ($result!=false){
                                $this->data['Fichero']['filename'] = $result;
                            } else {
                                // display error
                                $errors = $this->Upload->errors;
                                if(is_array($errors)){ $errors = implode("<br />",$errors); }
                                $this->Session->setFlash($errors,'message_error');
                                $this->redirect($this->referer());
                                exit();
                            }
			}//------------------
                        //$this->data['Fichero']['userid']=$iduser;           
			if ($this->Fichero->save($this->data)) {
				$this->Session->setFlash(__('The fichero has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fichero could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fichero->read(null, $id);
                        
                        if ($idgrupo>2){
                            if ($this->data['Fichero']['userid']!=$iduser){
                                $this->Session->setFlash(__('The fichero could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                        }
		}
                if ($idgrupo>2){
                    $categorias=$this->Fichero->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                }else{
                    $categorias=$this->Fichero->Categoria->find('list',array('conditions'=>array('Categoria.esactivo'=>1 )));
                } 
                $this->set(compact('categorias'));
	}

	function delete($id = null) {
            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');
            
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fichero', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Fichero->id=$id;
		$datos=$this->Fichero->read();
                
                if ($idgrupo>2){
                    if ($datos['Fichero']['userid']!=$iduser){
                        $this->Session->setFlash(__('The fichero could not be deleted. Please, try again.', true), 'message_error');
                        $this->redirect(array('action' => 'index'));
                    }
                }
                
		if ($this->Fichero->delete($id)) {
                    $nombre_fichero= $datos['Fichero']['filename'];
                    $destination = realpath("$this->path_ficheros_privados") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    
			$this->Session->setFlash(__('Fichero deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fichero was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        function uploadfiles(){
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
            
            //print_r($_POST);     
            if (!empty($this->data)) {
                $categoria_id=$this->data['Fichero']['categoria_id'];
                $espublico=$this->data['Fichero']['espublico'];
                
                // contenido publico o privado
                $destination = realpath($this->path_ficheros_publicos).'/';
                // si alguna vez se necesita se puede distinguir entre publicos y privados
                //if ($this->data['Fichero']['espublico']==0) $destination = realpath($this->path_ficheros_privados).'/';

                $origentmp=realpath($this->path_ficheros_tmp);

                $num_files=$_POST['uploader_count'];
                for ($i=0;$i<$num_files;$i++){
                    $fileTmp=$origentmp.DIRECTORY_SEPARATOR.$_POST['uploader_'.$i.'_tmpname'];
                    $fileName=$_POST['uploader_'.$i.'_name'];
                    $uploadstatus=$_POST['uploader_'.$i.'_status'];

                    if ($uploadstatus=='done'){
                        $this->Fichero->create();
                        $this->data['Fichero']['titulo']=$fileName;
                        $this->data['Fichero']['filename']=$fileName;
                        $this->data['Fichero']['esactivo']=1;
                        $this->data['Fichero']['espublico']=1;
                        $this->data['Fichero']['userid']=$iduser;
                        
                        // Make sure the fileName is unique but only if chunking is disabled
                        if (file_exists($destination . DIRECTORY_SEPARATOR . $fileName)) {
                                $ext = strrpos($fileName, '.');
                                $fileName_a = substr($fileName, 0, $ext);
                                $fileName_b = substr($fileName, $ext);

                                $count = 1;
                                while (file_exists($destination . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                                        $count++;

                                $fileName = $fileName_a . '_' . $count . $fileName_b;
                        }

                        $fileName = $destination.DIRECTORY_SEPARATOR.$fileName;
                    
                        // Read binary input stream and append it to temp file
                        $out = fopen($fileName, "wb");
                        if ($out) {
                            $in = fopen($fileTmp, "rb");

                            if ($in) {
                                    while ($buff = fread($in, 4096))
                                            fwrite($out, $buff);
                            } else
                                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                            fclose($in);
                            fclose($out);
                            @unlink($fileTmp);
                       }else{
                            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                       }
                        
                       
                       if ($this->Fichero->save($this->data)) {
				//$this->Session->setFlash(__('The fichero has been saved', true), 'alert_success');
				//$this->redirect(array('action' => 'index'));
                        } else {
				$this->Session->setFlash(__('The fichero could not be saved. Please, try again.', true), 'message_error');
			}
                       
                    }
                }

                $this->Session->setFlash(__('Los Ficheros han sido subidos', true), 'alert_success');
                $this->redirect(array('action' => 'add'));
            }else{
                $this->Session->setFlash(__('Ha ocurrido algun error y los ficheros no se han subido. Intentelo de nuevo.', true), 'message_error');
                $this->redirect(array('action' => 'add'));
            }
        }
        

        function uploadmultiplefiles(){
            
            // Settings
            $targetDir = realpath($this->path_ficheros_tmp);
            
            // Get parameters
            $chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
            $chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
            $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

            // Clean the fileName for security reasons
            $fileName = preg_replace('/[^\w\._]+/', '', $fileName);

            // Look for the content type header
            if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
                $contentType = $_SERVER["HTTP_CONTENT_TYPE"];
            if (isset($_SERVER["CONTENT_TYPE"]))
                $contentType = $_SERVER["CONTENT_TYPE"];
            
            // Make sure the fileName is unique but only if chunking is disabled
            if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
                    $ext = strrpos($fileName, '.');
                    $fileName_a = substr($fileName, 0, $ext);
                    $fileName_b = substr($fileName, $ext);

                    $count = 1;
                    while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                            $count++;

                    $fileName = $fileName_a . '_' . $count . $fileName_b;
            }
            
            // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
            if (strpos($contentType, "multipart") !== false) {
                    if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                            // Open temp file
                        /*    $out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
                            if ($out) {
                                    // Read binary input stream and append it to temp file
                                    $in = fopen($_FILES['file']['tmp_name'], "rb");

                                    if ($in) {
                                            while ($buff = fread($in, 4096))
                                                    fwrite($out, $buff);
                                    } else
                                            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                                    fclose($in);
                                    fclose($out);
                                    @unlink($_FILES['file']['tmp_name']);
                            } else
                                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                                 */       
                        //----------------------
                        $output = $targetDir . DIRECTORY_SEPARATOR . $fileName;
                        // -- just upload it
                        if (move_uploaded_file($_FILES['file']['tmp_name'],$output)) {
                                chmod($output, 0644);
                                @unlink($_FILES['file']['tmp_name']);
                        } else {
                                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                        }
                        //------------------
                        
                    } else
                            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            } else {
                    // Open temp file
                    $out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
                    if ($out) {
                            // Read binary input stream and append it to temp file
                            $in = fopen("php://input", "rb");

                            if ($in) {
                                    while ($buff = fread($in, 4096))
                                            fwrite($out, $buff);
                            } else
                                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                            fclose($in);
                            fclose($out);
                    } else
                            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            // Return JSON-RPC response
            die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
                        
        }
        
        
        //función para descargar contenidos privados
        //----- terminar ------
        function descargar($id_file){
            $this->autoRender = false;
            $this->Fichero->id=$id_file;
            $datos_documento=$this->Fichero->read(null,$id_file);
            
            if (!empty($datos_documento)){
                $name_file= $datos_documento['Fichero']['filename'];
                $name_file2=str_replace(' ', '_', $name_file);
                
                $iduser=$this->Session->read('Auth.User.id');
                $grupo=$this->Session->read('Auth.User.group_id');
                
                //usuarios:
                //1-admin general
                //2-subadmin
                //3-coordinadores
                //4-usuarios
                $valid=false;
                if ($grupo==1){
                    $valid=true;
                }else if ($grupo==2){
                    $valid=true;
                }else if ($grupo==3){
                    if ($datos_documento['Fichero']['userid']==$iduser) $valid=true;
                    else $valid=false;
                }else{
                    $valid=false;
                }
            }else{
                $valid=false;
            }
            $valid=true; //<-- ficheros publicos, se pueden descargar todos
            if ($valid){
                $path = realpath("$this->path_ficheros_publicos").'/'.$name_file;
                header ("Content-Disposition: attachment;
                filename=".$name_file2."\n\n");
                header ("Content-Type: application/octet-stream");
                header ("Content-Length: ".filesize($path));
                readfile($path);
            }else{
                $this->Session->setFlash(__('El Archivo es de uso restringido', true));
                $this->redirect(array('controller'=>'/', 'action'=>'home'));
            }
        }
}
?>
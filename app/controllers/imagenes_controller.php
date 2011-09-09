<?php
class ImagenesController extends AppController {
	var $name = 'Imagenes';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';

        var $path_ficheros_privados="../../app/webroot/upcontent/restricted/images";
	var $path_ficheros_originales="../../app/webroot/upcontent/images/originals";
        var $path_ficheros_publicos="../../app/webroot/upcontent/images";
        var $path_ficheros_tmp="../../app/webroot/upcontent/tmp";
        private $crop_max_x="1024";
        private $crop_max_y="768";
        private $crop_miniatura_x="75"; //thumbnail
        private $crop_miniatura_y="65";
        private $compresion=85;
        private $options;

        
        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('show'));
        }
        
	function index($filtro=null) {
		$this->Imagen->recursive = 1;
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                $idgrupo=$this->Session->read('Auth.User.group_id');

                $condicion2="";
                $categorias=$this->Imagen->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array('Categoria.userid'=>$iduser, 'Categoria.userid'=>1))));
                $this->set('categorias',$categorias);
                if ($filtro!=null) $condicion2="Imagen.categoria_id=$filtro";
                else {
                    if (!empty($categorias)){
                        foreach($categorias as $idc=>$cat){
                            $condicion2="Imagen.categoria_id=$idc";
                            $filtro=$idc;
                            break;
                        }
                    }
                } 
                $this->set('selectedcat',$filtro);
                if ($idgrupo>2){
                    $this->paginate = array('limit'=>12, 'order'=>'Imagen.created DESC', 'conditions'=>array("Imagen.userid=$iduser",$condicion2));
                }else{
                    $this->paginate = array('limit'=>12, 'order'=>'Imagen.created DESC','conditions'=>array($condicion2) );
                }
		$this->set('imagenes', $this->paginate());
	}

	function view($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
                
		if (!$id) {
			$this->Session->setFlash(__('Invalid imagen', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
                $datos=$this->Imagen->read(null, $id);
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                    if ($datos['Imagen']['userid']!=$iduser){
                        $this->Session->setFlash(__('Invalid imagen', true), 'alert_warning');
                        $this->redirect(array('action' => 'index'));
                    }
                }
		$this->set('imagen', $datos);
	}

	function add() {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
                
		if (!empty($this->data)) {
			$this->Imagen->create();
                        
                        // Grabamos la imagen --------------------
			$this->options = array(
                            'guardar_original' => $this->data['Imagen']['guardaroriginal'],
                            'categoria_id' => $this->data['Imagen']['categoria_id'],
                            'path_originales' => $this->path_ficheros_originales."/",

                            'script_url' => "/imagenes/uploadimages",
                            'upload_dir' => $this->path_ficheros_tmp."/",
                            'upload_url' => $this->path_ficheros_tmp."/",
                            'param_name' => 'files',
                            // The php.ini settings upload_max_filesize and post_max_size
                            // take precedence over the following max_file_size setting:
                            'max_file_size' => null,
                            'min_file_size' => 1,
                            'accept_file_types' => '/.+$/i',
                            'max_number_of_files' => null,
                            'discard_aborted_uploads' => true,
                            'image_versions' => array(
                                // Uncomment the following version to restrict the size of
                                // uploaded images. You can also add additional versions with
                                // their own upload directories:

                                'large' => array(
                                    'upload_dir' => $this->path_ficheros_publicos.'/bases/',
                                    'upload_url' => $this->path_ficheros_publicos.'/bases/',
                                    'max_width' => $this->crop_max_x,
                                    'max_height' => $this->crop_max_y
                                ),

                                'thumbnail' => array(
                                    'upload_dir' => $this->path_ficheros_publicos.'/thumbnails/',
                                    'upload_url' => $this->path_ficheros_publicos.'/thumbnails/',
                                    'max_width' => $this->crop_miniatura_x,
                                    'max_height' => $this->crop_miniatura_y
                                )
                            )
                        );
                        // grab the file
			$file = $this->data['Imagen']['filename'];
			
			if ($file['name']!=""){
				//$result = $this->Upload->upload_file($file, $destination);
                                $tmp_name=$file['tmp_name'];
                                $name=$file['name'];
                                $size=$file['size'];
                                $type=$file['type'];
                                $error=$file['error'];
                                
                                $info[] = $this->handle_file_upload($tmp_name,$name,$size,$type,$error);
                                
                                if (is_array($error)) $hayerror=$error['0'];
                                else $hayerror=$error;
                                
				if (!$hayerror){
					$this->data['Imagen']['filename'] = $name;
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
				$this->data['Imagen']['filename'] ="";
			}
                        
                        $this->data['Imagen']['userid']=$iduser;
                        $this->data['Imagen']['esactivo']=1;
			if ($this->Imagen->save($this->data)) {
				$this->Session->setFlash(__('The imagen has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imagen could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$categorias = $this->Imagen->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser),array('Categoria.userid'=>1)) )));
		$crops = $this->Imagen->Crop->find('list');
		$this->set(compact('categorias', 'crops'));
	}

	function edit($id = null) {
                //comprobamos los permisos
                $iduser=$this->Session->read('Auth.User.id');
                        
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid imagen', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        
                        //$this->data['Imagen']['userid']=$iduser;
			
                        if ($this->Imagen->save($this->data)) {
				$this->Session->setFlash(__('The imagen has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imagen could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Imagen->read(null, $id);
                        $idgrupo=$this->Session->read('Auth.User.group_id');
                        if ($idgrupo>2){
                            if ($this->data['Imagen']['userid']!=$iduser){
                                $this->Session->setFlash(__('The imagen could not be saved. Please, try again.', true), 'message_error');
                                $this->redirect(array('action' => 'index'));
                            }
                        }
		}
		$categorias = $this->Imagen->Categoria->find('list',array('conditions'=>array('Categoria.esvisible'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser),array('Categoria.userid'=>1)) )));
		$crops = $this->Imagen->Crop->find('list');
		$this->set(compact('categorias', 'crops'));
	}

	function delete($id = null) {
            //comprobamos los permisos
            $iduser=$this->Session->read('Auth.User.id');
                
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for imagen', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
                $this->Imagen->id=$id;
		$datos=$this->Imagen->read();
                $idgrupo=$this->Session->read('Auth.User.group_id');
                if ($idgrupo>2){
                    if ($datos['Imagen']['userid']!=$iduser){
                        $this->Session->setFlash(__('The imagen could not be deleted. Please, try again.', true), 'message_error');
                        $this->redirect(array('action' => 'index'));
                    }
                }
                        
		if ($this->Imagen->delete($id)) {
                    $nombre_fichero= $datos['Imagen']['filename'];
                    $destination = realpath("$this->path_ficheros_privados") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/originals/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/bases/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    $destination = realpath("$this->path_ficheros_publicos") . '/thumbnails/';
                    if (file_exists($destination.$nombre_fichero)) unlink($destination.$nombre_fichero);
                    
                    //Borramos los crops
                    $destination = realpath("$this->path_ficheros_publicos") . '/crops/'.$id."/";
                    foreach (glob($destination."*.jpg") as $filename){
                           unlink($filename);
                    }
                    rmdir($destination);
                    
			$this->Session->setFlash(__('Imagen deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Imagen was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        
        function add_crop($id = null, $cropid=null){
            //$cropid= $this->params['crop_id'];
            
            if ($id!='undefined' AND $id!=null){                            
                $this->Session->setFlash(__('Si su imágen es más pequeña que el crop que se desea realizar dará como resultado una imágen con bandas negras alrededor! <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviselo y vuelva a subir la imágen a la herramienta con un tamaño mayor en caso necesario. ', true), 'alert_warning');

                
                $datos_imagen= $this->Imagen->read(null, $id);
                $this->set('imagen', $datos_imagen);

                $arraycrops=array();
                if (!empty($datos_imagen['Crop'])){
                    foreach($datos_imagen['Crop'] as $ind=>$crop){
                        array_push($arraycrops,$crop['id']);
                    }
                }
                $this->set('arraycrops',$arraycrops);

                $conditions="Submodulo.esactivo=1";
                if ($cropid!=null AND $cropid!='undefined'){
                    $this->loadModel('Crop');
                    $this->Crop->recursive=0;
                    $submodulo_id=$this->Crop->read(null,$cropid);
                    $submodulo_id=$submodulo_id['Crop']['submodulo_id'];
                    $conditions="Submodulo.esactivo=1 AND Submodulo.id=$submodulo_id";
                }
                $this->loadModel('Submodulo');
                $this->Submodulo->recursive=1;
                $submodulos=$this->Submodulo->find('all', array('conditions'=>$conditions, 'order'=>array('Modulo.orden', 'Submodulo.orden')));
                $this->set('submodulos', $submodulos);
            
            }
        }
        function create_crop(){
            if (isset($_POST['image']) AND isset($_POST['id']) AND isset($_POST['x']) AND isset($_POST['y']) AND isset($_POST['w']) AND isset($_POST['h']) ){
                $imagen=$_POST['image'];
                $id=$_POST['id'];
                $x=$_POST['x'];
                $y=$_POST['y'];
                $w=$_POST['w'];
                $h=$_POST['h'];
            
                $datos['Imagen']['id']=$imagen;
                $datos['Crop']['imagen_id']=$imagen;
                $datos['Crop']['crop_id']=$id;
                
                $datos_imagen= $this->Imagen->read(null, $imagen);
                $this->loadModel('Crop');
                $datos_crop = $this->Crop->read(null,$id);
                   
                //medidas del crop; la imagen tiene que medir esto finalmente
                $crop_w=$datos_crop['Crop']['ancho'];
                $crop_h=$datos_crop['Crop']['alto'];
                //print $x."-".$y."-".$w."-".$h."---".$crop_w."-".$crop_h;
                if (!empty($datos_imagen)){
                    $urlimagen= $this->path_ficheros_publicos."/bases/";
                    $urldestino= $this->path_ficheros_publicos."/crops/";
                    $nombreimagen= $datos_imagen['Imagen']['filename'];
                    $laimagenorig=$urlimagen.$nombreimagen;
                    
                    if (!file_exists($urldestino.$imagen)) @mkdir($urldestino.$imagen);
                    chmod($urldestino.$imagen, 0777);
                    
                    $ext = trim(substr($nombreimagen,strrpos($nombreimagen,".")+1,strlen($nombreimagen)));                    
                    $type = 'resize';
                    $output = 'jpg';
                    $quality = $this->compresion;

                    // -- get some information about the file
                    $uploadSize = getimagesize($laimagenorig);
                    $uploadWidth  = $uploadSize[0];
                    $uploadHeight = $uploadSize[1];
                    $uploadType = $uploadSize[2];

                    if ($uploadType != 1 && $uploadType != 2 && $uploadType != 3) {
                        $info=array("status"=>"ko","mess"=>"File type must be GIF, PNG, or JPG to resize");
                    }

                    switch ($uploadType) {
                        case 1: $srcImg = imagecreatefromgif($laimagenorig); break; //gif
                        case 2: $srcImg = imagecreatefromjpeg($laimagenorig); break; //jpeg
                        case 3: $srcImg = imagecreatefrompng($laimagenorig); break; //png
                        //case 4: $srcImg = imagecreatefrompng($laimagenorig); break; //swf
                        //case 5: $srcImg = imagecreatefrompng($laimagenorig); break; //psd
                        //case 6: $srcImg = imagecreatefrompng($laimagenorig); break; //bmp
                        //case 7: $srcImg = imagecreatefrompng($laimagenorig); break; //tiff intel
                        //case 8: $srcImg = imagecreatefrompng($laimagenorig); break; //tiff motorola
                        //case 9: $srcImg = imagecreatefrompng($laimagenorig); break; //jpc
                        //case : $srcImg = imagecreatefrompng($laimagenorig); break; //... hay mas...
                        default: $srcImg = imagecreatefromjpeg($laimagenorig); break; //error posiblemente
                    }
                    $dstImg = imagecreatetruecolor($crop_w,$crop_h);
                    imagecopyresampled($dstImg, $srcImg, 0, 0, $x, $y, $crop_w, $crop_h, $w, $h);
                    // -- try to write
                    switch ($output) {
                        case 'jpg':
                                $write = imagejpeg($dstImg, $urldestino.$imagen."/".$id.".jpg", $quality);
                                break;
                        case 'png':
                                $write = imagepng($dstImg, $urldestino.$imagen."/".$id . ".png", $quality);
                                break;
                        case 'gif':
                                $write = imagegif($dstImg, $urldestino.$imagen."/".$id . ".gif", $quality);
                                break;
                    }
                    // -- clean up
                    imagedestroy($dstImg);
                    if ($write){
                        //$this->Imagen->Crop->create();
                        if ($this->Imagen->Crop->save($datos)) {
                            $info=array("status"=>"ok");	
			} else {
                            $info=array("status"=>"ko");                              
                        }                          
                    }else{
                        $info=array("status"=>"ko","mess"=>"Error al escribir el fichero");    
                    }                                            
                }else{
                    $info=array("status"=>"ko");
                }                
            }else{
                $info=array("status"=>"ko");
            }
            
            echo json_encode($info);die();
        }
        function delete_crop(){
            if (isset($_POST['image']) AND isset($_POST['id'])){
                $imagen=$_POST['image'];
                $id=$_POST['id'];
                $datos_imagen= $this->Imagen->read(null, $imagen);
                if (!empty($datos_imagen)){
                    $urlimagen= $this->path_ficheros_publicos."/crops/";
                    $laimagencrop=$urlimagen.$imagen."/".$id;

                    if (file_exists($laimagencrop)) unlink($laimagencrop);
                                 
                    $nuevoscrops=array();
                    foreach($datos_imagen['Crop'] as $ind=>$crops){
                        if ($crops['id']!=$id) array_push($nuevoscrops,$crops['id']);
                    } 
                    
                    //if ($this->Imagen->habtmDelete('Crop', $imagen, $id)) {
                    $data['Imagen']['id']=$imagen;
                    $data['Crop']['Crop']=$nuevoscrops;
                    if ($this->Imagen->save($data)) {
                        $datos_imagen= $this->Imagen->read(null, $imagen);
                        $info=array("status"=>"ok");	
                    } else {
                        $info=array("status"=>"ko");                              
                    }
                }else{
                    $info=array("status"=>"ko 2");    
                }
            }else{
                $info=array("status"=>"ko 1");
            }            
            echo json_encode($info);die();
        }
        
        //función para descargar contenidos privados
        //----- terminar ------
        function descargar($id_file){
            $this->autoRender = false;
            $this->Imagen->id=$id_file;
            $datos_documento=$this->Imagen->read(null,$id_file);
            if (!empty($datos_documento)){
                $name_file= $datos_documento['Imagen']['filename'];

                //comprobamos los permisos
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
                    if ($datos_documento['Imagen']['userid']==$iduser) $valid=true;
                    else $valid=false;
                }else{
                    $valid=false;
                }
            }else{
                $valid=false;
            }
            
            if ($valid){
                $path = realpath("$this->path_ficheros_privados").'/bases/'.$name_file;
                header ("Content-Disposition: attachment;
                filename=".$name_file."\n\n");
                header ("Content-Type: application/octet-stream");
                header ("Content-Length: ".filesize($path));
                readfile($path);
            }else{
                $this->Session->setFlash(__('El Archivo es de uso restringido', true));
                $this->redirect(array('controller'=>'productos', 'action'=>'listado'));
            }
        }
        
        
        //se muestra una imagen
        //se intenta mostrar siempre un crop (el indicado en crop)
        //sino, se muestra la imagen thumbnail
        //una modificación es si se le pasa mini o big, que muestra la thumbnail o la base
        //independientemente de que tenga o no crop.
        //otra modificación: si se indica crop, antes se mira si se ha guardado la original
        //para mostrarla en lugar del crop.
        function show($id = null,$tipo="crop", $crop=""){
            $this->autoRender = false;
            $this->Imagen->id=$id;
            $datos_documento=$this->Imagen->read(null,$id);
            
            //print_r($datos_documento);
            if (!empty($datos_documento)){
                $name_file= $datos_documento['Imagen']['filename'];
                if ($tipo=='mini'){
                    $path = realpath("$this->path_ficheros_publicos").'/thumbnails/'.$name_file;                
                }else if ($tipo=='big'){
                    $path = realpath("$this->path_ficheros_publicos").'/bases/'.$name_file;                                    
                }else{
                    if ($datos_documento['Imagen']['guardaroriginal']==1){
                            $path = realpath("$this->path_ficheros_publicos").'/originals/'.$name_file;                                        
                    }else{
                        if (empty($datos_documento['Crop'])){
                            $path = realpath("$this->path_ficheros_publicos").'/thumbnails/'.$name_file;                
                        }else{
                            $path = realpath("$this->path_ficheros_publicos").'/crops/'.$id."/".$crop.".jpg"; 
                        }
                    }
                }
                
                header("Pragma: public");
                header ("Content-Disposition: attachment; filename=".$name_file."\n\n");
                header ("Content-Type: image/jpg");
                header('Last-Modified: '.date('r'));
                header ("Content-Transfer-Encoding: binary");
                header ("Content-Length: ".filesize($path));
                ob_clean();
                flush(); 
                readfile($path);                
            }else{
                return "javascript:;";
            }
        }
        
        
        //subir multiples ficheros
        //-------------------------
        private function get_file_object($file_name) {
                $file_path = $this->options['upload_dir'].$file_name;
                if (is_file($file_path) && $file_name[0] !== '.') {
                    $file = new stdClass();
                    $file->name = $file_name;
                    $file->size = filesize($file_path);
                    $file->url = $this->options['upload_url'].rawurlencode($file->name);
                    foreach($this->options['image_versions'] as $version => $options) {
                        if (is_file($options['upload_dir'].$file_name)) {
                            $file->{$version.'_url'} = $options['upload_url']
                                .rawurlencode($file->name);
                        }
                    }
                    $file->delete_url = $this->options['script_url']
                        .'?file='.rawurlencode($file->name);
                    $file->delete_type = 'DELETE';
                    return $file;
                }
                return null;
            }

            private function get_file_objects() {
                return array_values(array_filter(array_map(
                    array($this, 'get_file_object'),
                    scandir($this->options['upload_dir'])
                )));
            }

            private function create_scaled_image($file_name, $option) {
                $file_path = $this->options['upload_dir'].$file_name;
                $new_file_path = $option['upload_dir'].$file_name;
                list($img_width, $img_height) = @getimagesize($file_path);
                if (!$img_width || !$img_height) {
                    return false;
                }
                $scale = min(
                    $option['max_width'] / $img_width,
                    $option['max_height'] / $img_height
                );
                if ($scale > 1) {
                    $scale = 1;
                }
                $new_width = $img_width * $scale;
                $new_height = $img_height * $scale;
                $new_img = @imagecreatetruecolor($new_width, $new_height);
                switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
                    case 'jpg':
                    case 'jpeg':
                        $src_img = @imagecreatefromjpeg($file_path);
                        $write_image = 'imagejpeg';
                        break;
                    case 'gif':
                        $src_img = @imagecreatefromgif($file_path);
                        $write_image = 'imagegif';
                        break;
                    case 'png':
                        $src_img = @imagecreatefrompng($file_path);
                        $write_image = 'imagepng';
                        break;
                    default:
                        $src_img = $image_method = null;
                }
                $success = $src_img && @imagecopyresampled(
                    $new_img,
                    $src_img,
                    0, 0, 0, 0,
                    $new_width,
                    $new_height,
                    $img_width,
                    $img_height
                ) && $write_image($new_img, $new_file_path);
                // Free up memory (imagedestroy does not delete files):
                @imagedestroy($src_img);
                @imagedestroy($new_img);
                return $success;
            }

            private function has_error($uploaded_file, $file, $error) {
                if ($error) {
                    return $error;
                }
                if (!preg_match($this->options['accept_file_types'], $file->name)) {
                    return 'acceptFileTypes';
                }
                if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                    $file_size = filesize($uploaded_file);
                } else {
                    $file_size = $_SERVER['CONTENT_LENGTH'];
                }
                if ($this->options['max_file_size'] && (
                        $file_size > $this->options['max_file_size'] ||
                        $file->size > $this->options['max_file_size'])
                    ) {
                    return 'maxFileSize';
                }
                if ($this->options['min_file_size'] &&
                    $file_size < $this->options['min_file_size']) {
                    return 'minFileSize';
                }
                if (is_int($this->options['max_number_of_files']) && (
                        count($this->get_file_objects()) >= $this->options['max_number_of_files'])
                    ) {
                    return 'maxNumberOfFiles';
                }
                return $error;
            }

            private function handle_file_upload($uploaded_file, $name, $size, $type, $error) {
                $file = new stdClass();
                $file->name = basename(stripslashes($name));
                $file->size = intval($size);
                $file->type = $type;
                $error = $this->has_error($uploaded_file, $file, $error);
                if (!$error && $file->name) {
                    if ($file->name[0] === '.') {
                        $file->name = substr($file->name, 1);
                    }
                    $file_path = $this->options['upload_dir'].$file->name;
                    
                    
                    $append_file = is_file($file_path) && $file->size > filesize($file_path);
                    clearstatcache();
                    if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                        // multipart/formdata uploads (POST method uploads)
                        if ($append_file) {
                            file_put_contents(
                                $file_path,
                                fopen($uploaded_file, 'r'),
                                FILE_APPEND
                            );
                        } else {
                            move_uploaded_file($uploaded_file, $file_path);
                        }
                    } else {
                        // Non-multipart uploads (PUT method support)
                        file_put_contents(
                            $file_path,
                            fopen('php://input', 'r'),
                            $append_file ? FILE_APPEND : 0
                        );
                    }
                    $file_size = filesize($file_path);
                    if ($file_size === $file->size) {
                        $file->url = $this->options['upload_url'].rawurlencode($file->name);
                        
                        //Nombres no repetidos
                        //$fileName=rawurlencode($file->name);
                        $fileNameInicial=$this->options['upload_url'].$file->name;
                        $fileName=$file->name;
                        $destination=$this->path_ficheros_publicos.'/bases/';
                        if (file_exists($destination . $fileName)) {
                                    $ext = strrpos($fileName, '.');
                                    $fileName_a = substr($fileName, 0, $ext);
                                    $fileName_b = substr($fileName, $ext);

                                    $count = 1;
                                    while (file_exists($destination . $fileName_a . '_' . $count . $fileName_b))
                                            $count++;

                                    $fileName = $fileName_a . '_' . $count . $fileName_b;
                        }
                        
                        if ($file->name!=$fileName){
                            $file->name = $fileName;
                            if (!rename($fileNameInicial,$this->path_ficheros_tmp.'/'.$fileName)){
                                $file->error='abort';
                            }else{
                                //$file->url=$this->options['upload_url'].rawurlencode($fileName);
                                $file->url=$this->options['upload_url'].$fileName;
                                $file_path = $this->options['upload_dir'].$fileName;
                            }                        
                        }
                        $file->url=$this->options['upload_url'].$fileName;
                        $file_path = $this->options['upload_dir'].$fileName;
                        //--------
                        
                        //si tenemos que guardar el original lo hacemos aqui
                        if ($this->options['guardar_original']){
                            if (!copy($file->url, $this->options['path_originales'].rawurlencode($fileName))) {
                                unlink($file_path);
                                $file->error = 'abort';
                            }
                        }
                        
                        //se hacen la imagen thumbnail y la base para crops
                        foreach($this->options['image_versions'] as $version => $option) {
                            if ($this->create_scaled_image($fileName, $option)) {
                                $file->{$version.'_url'} = $option['upload_url']
                                    .rawurlencode($fileName);
                            }
                        }
                        
                        //borramos el temporal
                        unlink($file_path);
                        
                    } else if ($this->options['discard_aborted_uploads']) {
                        unlink($file_path);
                        $file->error = 'abort';
                    }
                    $file->size = $file_size;
                    $file->delete_url = $this->options['script_url']
                        .'?file='.rawurlencode($file->name);
                    $file->delete_type = 'DELETE';
                } else {
                    $file->error = $error;
                }
                return $file;
            }

            public function get() {
                $file_name = isset($_REQUEST['file']) ?
                    basename(stripslashes($_REQUEST['file'])) : null; 
                if ($file_name) {
                    $info = $this->get_file_object($file_name);
                } else {
                    $info = $this->get_file_objects();
                }
                header('Content-type: application/json');
                echo json_encode($info);die();
            }

            public function post() {
                $upload = isset($_FILES[$this->options['param_name']]) ?
                    $_FILES[$this->options['param_name']] : array(
                        'tmp_name' => null,
                        'name' => null,
                        'size' => null,
                        'type' => null,
                        'error' => null
                    );

                $info = array();
                if (is_array($upload['tmp_name'])) { 
                    foreach ($upload['tmp_name'] as $index => $value) {
                        $info[] = $this->handle_file_upload(
                            $upload['tmp_name'][$index],
                            isset($_SERVER['HTTP_X_FILE_NAME']) ?
                                $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                            isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                                $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                            isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                                $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index],
                            $upload['error'][$index]
                        );
                    }
                } else {
                    $info[] = $this->handle_file_upload(
                        $upload['tmp_name'],
                        isset($_SERVER['HTTP_X_FILE_NAME']) ?
                            $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'],
                        isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                            $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'],
                        isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                            $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'],
                        $upload['error']
                    );
                }

                if (is_array($upload['error'])) $error=$upload['error']['0'];
                else $error=$upload['error'];
                if (!$error){
                    $this->Imagen->create();
                    $this->data['Imagen']['titulo']=$info['0']->name;
                    $this->data['Imagen']['filename']=$info['0']->name;
                    $this->data['Imagen']['filesize']=$info['0']->size;
                    $this->data['Imagen']['esactivo']=1;
                    $this->data['Imagen']['userid']=$this->Session->read('Auth.User.id');
                    
                    if ($this->Imagen->save($this->data)) {
                            $this->Session->setFlash(__('The imagen has been saved', true), 'alert_success');
                            //$this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The imagen could not be saved. Please, try again.', true), 'message_error');
                    }                    
                }
                
                header('Vary: Accept');
                if (isset($_SERVER['HTTP_ACCEPT']) &&
                    (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
                    header('Content-type: application/json');
                } else {
                    header('Content-type: text/plain');
                }
                echo json_encode($info);die();
            }

            public function delete2() {
                $file_name = isset($_REQUEST['file']) ?
                    basename(stripslashes($_REQUEST['file'])) : null;
                $file_path = $this->options['upload_dir'].$file_name;
                $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
                if ($success) {
                    foreach($this->options['image_versions'] as $version => $options) {
                        $file = $options['upload_dir'].$file_name;
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                }
                header('Content-type: application/json');
                echo json_encode($success);die();
            }
            
        function uploadimages($options=null){
            
                $this->options = array(
                    'guardar_original' => $this->data['Imagen']['guardaroriginal'],
                    'categoria_id' => $this->data['Imagen']['categoria_id'],
                    'path_originales' => $this->path_ficheros_originales."/",
                    
                    'script_url' => "/imagenes/uploadimages",
                    'upload_dir' => $this->path_ficheros_tmp."/",
                    'upload_url' => $this->path_ficheros_tmp."/",
                    'param_name' => 'files',
                    // The php.ini settings upload_max_filesize and post_max_size
                    // take precedence over the following max_file_size setting:
                    'max_file_size' => null,
                    'min_file_size' => 1,
                    'accept_file_types' => '/.+$/i',
                    'max_number_of_files' => null,
                    'discard_aborted_uploads' => true,
                    'image_versions' => array(
                        // Uncomment the following version to restrict the size of
                        // uploaded images. You can also add additional versions with
                        // their own upload directories:
                        
                        'large' => array(
                            'upload_dir' => $this->path_ficheros_publicos.'/bases/',
                            'upload_url' => $this->path_ficheros_publicos.'/bases/',
                            'max_width' => $this->crop_max_x,
                            'max_height' => $this->crop_max_y
                        ),
                        
                        'thumbnail' => array(
                            'upload_dir' => $this->path_ficheros_publicos.'/thumbnails/',
                            'upload_url' => $this->path_ficheros_publicos.'/thumbnails/',
                            'max_width' => $this->crop_miniatura_x,
                            'max_height' => $this->crop_miniatura_y
                        )
                    )
                );
                if ($options) {
                    $this->options = array_merge_recursive($this->options, $options);
                }
     
                switch ($_SERVER['REQUEST_METHOD']) {
                case 'HEAD':
                case 'GET':
                    $this->get();
                    break;
                case 'POST':
                    $this->post();
                    break;
                case 'DELETE':
                    $this->delete2();
                    break;
                default:
                    $this->Session->setFlash(__('Operación inválida.', true), 'alert_warning');
                    $this->redirect(array('action'=>'index'));
                    
            }  
        }
        
}
?>

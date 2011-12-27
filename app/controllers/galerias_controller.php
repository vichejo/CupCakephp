<?php
class GaleriasController extends AppController {

	var $name = 'Galerias';
        var $paginate = array('limit' => 20);
        var $helpers = array('Html', 'Form', 'Time');
        var $layout='private';
        
        var $path_imagenes_publicas="../../app/webroot/upcontent/images";
        var $path_ficheros_publicos="../../app/webroot/upcontent/files";
        
        //Multimedia: elementos disponibles: (imagenes, videos, audios, links, ficheros);
        var $cupc_related_multimedia = array('imagenes');
        //Comentarios: el modulo puede tener o no comentarios
        var $cupc_has_comments=false;
        
        // las dos siguientes variables no se usan en Galerias... se utiliza el tipo de galeria
        var $cupc_tipo_crop=2; //1-1sola imagen con crop, 2-todas con crop - En Galerias no se usa
        var $cupc_crop_id=1;//#crop dentro del submodulo - En Galerias no es necesario
        var $crop_submoduloid=4; //este submodulo
        
        
        function beforeFilter() {
            parent::beforeFilter(); 
            $this->Auth->allow(array('fotos','lista'));
        }
        
	function index() {
		$this->Galeria->recursive = 0;
		$this->set('galerias', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('galeria', $this->Galeria->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Galeria->create();
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list', array('conditions'=>array('esactivo'=>true)));
		$this->set(compact('tipogalerias'));
	}

	function edit($id = null) {
            $this->Session->setFlash(__('Para crear una Galería de imágenes, hay que añadir mínimo 2 imágenes relacionadas.', true), 'alert_warning');

            $iduser=$this->Session->read('Auth.User.id');
            $idgrupo=$this->Session->read('Auth.User.group_id');

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid galeria', true), 'alert_warning');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Galeria->save($this->data)) {
				$this->Session->setFlash(__('The galeria has been saved', true), 'alert_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.', true), 'message_error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Galeria->read(null, $id);
		}
		$tipogalerias = $this->Galeria->Tipogaleria->find('list', array('conditions'=>array('esactivo'=>true)));
		$this->set(compact('tipogalerias'));
                
                //-------------------------------------------------------
                // Multimedias relacionados - Listo para copiar y pegar
                // entrega a la vista varios datos informando de que contenido multimedia
                // hay disponible y varios arrays (de html) segun este.
                //-------------------------------------------------------
                if (!empty($this->cupc_related_multimedia)){
                    $this->loadModel('Submodulo');
                    $this->loadModel('Multimedia');
                    $this->loadModel('Categoria');
                    $cupc_submodulo=$this->Submodulo->find('first',array('conditions'=>array('Submodulo.nombre'=>$this->name)));
                    $cupc_submodulo_id=$cupc_submodulo['Submodulo']['id'];
                    
                    $datos_media=Configure::read('cupc.multimedias');                      
                    foreach($this->cupc_related_multimedia as $etiqueta){
                        $tipomedia=$datos_media[$etiqueta]['tipo_id'];
                        $modelo=$datos_media[$etiqueta]['modelo'];
                        $this->loadModel($modelo);
                        $relatedelement=$datos_media[$etiqueta]['campo_id'];
                        $html_media=$datos_media['html'][$etiqueta]['html_del'];
                        
                        //buscamos los id's de los elementos asociados en multimedia
                        $conditions=array('submodulo_id'=>$cupc_submodulo_id, 'itemid'=>$id, 'tipomedia_id'=>$tipomedia);
                        $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($relatedelement), 'order'=>'Multimedia.id ASC'));
                        $ids=array();
                        foreach($multim as $mmid=>$mm){
                            array_push($ids,$mm['Multimedia'][$relatedelement]);
                        }
                        
                        $elementos=array();
                        $this->$modelo->recursive=0;
                        //sacamos los elementos en orden
                        if (!empty($ids)){
                            foreach ($ids as $nada=>$idimagen){
                                $conditions2=$modelo.".id = $idimagen";
                                $resultado=$this->$modelo->read(null,$idimagen);
                                if (!empty($resultado)){
                                    array_push($elementos, $resultado);
                                }
                            }
                        }
                        //print_r($elementos);

                        //si son imagenes tendran crop
                        if ($etiqueta == 'imagenes') {
                            //esta galeria es del tipo:
                            $cropid=$this->data['Tipogaleria']['crop_id'];                                
                            $this->loadModel('Crop');
                            $imagenesconcrop=$this->Crop->find('first', array('conditions'=>array('Crop.id'=>$cropid)));
                            $contimagenesconcrop=count($imagenesconcrop['Imagen']);
                            $arrayimgconcrop=array();
                            if(!empty($imagenesconcrop)){
                                foreach($imagenesconcrop['Imagen'] as $imgcrop){
                                    array_push($arrayimgconcrop, $imgcrop['id']);
                                }
                            }
                            $arrayimgconcrop=array_intersect($ids, $arrayimgconcrop);
                            $contimagenesconcrop=count($arrayimgconcrop);
                        }
                        $array_html=array();
                        //se sustituyen los tokens! por su contenido
                        foreach($elementos as $ind=>$element){
                            $elemento_id=$element[$modelo]['id'];
                            $nuevo_html=$html_media;
                            //estos elementos siempre van a existir
                            $nuevo_html=str_replace('##elemento_id##',$elemento_id,$nuevo_html);
                            $nuevo_html=str_replace('##item_id##',$id,$nuevo_html);
                            $nuevo_html=str_replace('##submodulo_id##',$cupc_submodulo_id,$nuevo_html);
                            //estos pueden o no existir
                            
                            //si son imagenes tendran crop
                            if ($etiqueta == 'imagenes') {
                                $tipogaleriacrop=$this->data['Tipogaleria']['tipocrop'];
                                if ($tipogaleriacrop==1){ //solo necesario 1 crop
                                    if ($contimagenesconcrop==0){
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> crop</a>";                                   
                                    }else{
                                        if (in_array($elemento_id, $arrayimgconcrop)){
                                            $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> modificar crop</a>";
                                        }else{
                                            $cadenacrop="";                   
                                        }
                                    }
                                }else{//necesarios todos los crops
                                    if (in_array($elemento_id, $arrayimgconcrop)){
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> modificar crop</a>";
                                    }else{
                                        $cadenacrop="<a href=\"/imagenes/add_crop/$elemento_id/$cropid\" >> crop</a>";                                                   
                                    }                                                                    
                                }
                                
                                $nuevo_html=str_replace('##crop##',$cadenacrop,$nuevo_html);
                            }
                            
                            if (isset($element[$modelo]['filename'])) $nuevo_html=str_replace('##filename##',$element[$modelo]['filename'],$nuevo_html);
                            if (isset($element[$modelo]['url'])) $nuevo_html=str_replace('##url##',$element[$modelo]['url'],$nuevo_html);
                            if (isset($element[$modelo]['titulo'])) $nuevo_html=str_replace('##alt##',$element[$modelo]['titulo'],$nuevo_html);
                            if (isset($element[$modelo]['entradilla'])) $nuevo_html=str_replace('##entradilla##',$element[$modelo]['entradilla'],$nuevo_html);
                            if (isset($element[$modelo]['contenido'])){
                                $iframe=$element[$modelo]['contenido'];
                                $nuevo_html=str_replace('##iframe##',$iframe,$nuevo_html);
                            }
                            array_push($array_html,$nuevo_html);
                        }
                        $this->set($etiqueta,$elementos);
                        $this->set($etiqueta."_html",$array_html);
                    }                    
                    //si hay coordinadores, solo ven sus categorias
                    if ($idgrupo>2){
                        $categorias= $this->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 ,'OR'=>array(array('Categoria.userid'=>$iduser), array('Categoria.userid'=>1) ))));
                    }else{
                        $categorias=$this->Categoria->find('all',array('conditions'=>array('Categoria.esactivo'=>1 )));                        
                    }
                    //eliminamos las que no tengan imagenes asociadas 
                    $categoriaslistado=array();
                    foreach($categorias as $indice=>$catego){
                        if (!empty($catego['Imagen'])) $categoriaslistado[$catego['Categoria']['id']]=$catego['Categoria']['nombre'];
                    }
                    $this->set('cupc_categorias_multimedia',$categoriaslistado);
                
                    $this->set('cupc_submodulo_id',$cupc_submodulo_id);
                    $this->set('cupc_crop_id',$cropid);
                    $this->set('cupc_item_id',$id);
                }
                $this->set('cupc_related_multimedia',$this->cupc_related_multimedia);
                //--------------------------------------------------------------------------
                
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for galeria', true), 'alert_warning');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Galeria->delete($id)) {
			$this->Session->setFlash(__('Galeria deleted', true), 'alert_success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Galeria was not deleted', true), 'message_error');
		$this->redirect(array('action' => 'index'));
	}
        
        
        function _urlimage($id = null,$tipo="crop", $crop=null){
            $this->Imagen->id=$id;
            $datos_documento=$this->Imagen->read(null,$id);
            
            //print_r($datos_documento);
            if (!empty($datos_documento)){
                $name_file= $datos_documento['Imagen']['filename'];
                if ($tipo=='mini'){
                    $path = $this->path_imagenes_publicas.'/thumbnails/'.$name_file;                
                }else if ($tipo=='big'){
                    if ($datos_documento['Imagen']['guardaroriginal']==1){
                        $path = $this->path_imagenes_publicas.'/originals/'.$name_file;                                        
                    }else{
                        $path = $this->path_imagenes_publicas.'/bases/'.$name_file;                                    
                    }
                }else{
                    if ($datos_documento['Imagen']['guardaroriginal']==1 AND $crop==null){
                        $path = $this->path_imagenes_publicas.'/originals/'.$name_file;                                        
                    }else{
                        if (empty($datos_documento['Crop'])){
                            $path = $this->path_imagenes_publicas.'/thumbnails/'.$name_file;                
                        }elseif ($crop==0){
                            $path = $this->path_imagenes_publicas.'/bases/'.$name_file;
                        }else{    
                            $path = $this->path_imagenes_publicas.'/crops/'.$id."/".$crop.".jpg"; 
                        }
                    }
                }
                return $path;
            }else{
                return "javascript:;";
            }
        }
        function _getMultimedias($id=null, $idcrop=null){
            //para sacar la url de la imagen hay que ver si tiene crops, si se
            //desea mostrar la original, la big, la thumbnail...
                        
            $multimedia=array();
            if ($id!=null){

                //-------------------------------------------------------
                // Multimedias relacionados - Listo para copiar y pegar
                // entrega a la vista varios datos informando de que contenido multimedia hay
                //-------------------------------------------------------
                if (!empty($this->cupc_related_multimedia)){
                    $this->loadModel('Submodulo');
                    $this->loadModel('Multimedia');
                    $cupc_submodulo=$this->Submodulo->find('first',array('conditions'=>array('Submodulo.nombre'=>$this->name)));
                    $cupc_submodulo_id=$cupc_submodulo['Submodulo']['id'];
                    
                    $datos_media=Configure::read('cupc.multimedias');                      
                    foreach($this->cupc_related_multimedia as $etiqueta){
                        $tipomedia=$datos_media[$etiqueta]['tipo_id'];
                        $modelo=$datos_media[$etiqueta]['modelo'];
                        $this->loadModel($modelo);
                        $relatedelement=$datos_media[$etiqueta]['campo_id'];
                        $html_media=$datos_media['html'][$etiqueta]['html_del'];
                        
                        //buscamos los id's de los elementos asociados en multimedia
                        $conditions=array('submodulo_id'=>$cupc_submodulo_id, 'itemid'=>$id, 'tipomedia_id'=>$tipomedia);
                        $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($relatedelement), 'order'=>'Multimedia.id ASC'));
                        $ids=array();
                        foreach($multim as $mmid=>$mm){
                            array_push($ids,$mm['Multimedia'][$relatedelement]);
                        }
                        
                        $elementos=array();
                        $this->$modelo->recursive=1;
                        //sacamos los elementos en orden
                        if (!empty($ids)){
                            foreach ($ids as $nada=>$idimagen){
                                $conditions2=$modelo.".id = $idimagen";
                                $resultado=$this->$modelo->read(null,$idimagen);
                                if (!empty($resultado)){
                                    array_push($elementos, $resultado);
                                }
                            }
                        }
                        
                        $multimedia[$etiqueta]=$elementos;
                    }
                    
                    //imagenes
                    if (!empty($multimedia['imagenes'])){
                        foreach($multimedia['imagenes'] as $ind=>$imag){
                            if (!empty($imag['Crop'])){ 
                                $idadecuado=0;
                                foreach($imag['Crop'] as $uncrop){
                                    if ($idcrop==null){ //se supone que solo habrá uno por modulo -> indicamos modulo
                                        if ($uncrop['submodulo_id']==$this->crop_submoduloid) $idadecuado=$uncrop['id'];
                                    }else{//si se indica es que hay mas crops por modulo -> indicamos crop
                                        if ($uncrop['id']==$idcrop) $idadecuado=$uncrop['id'];                                        
                                    }
                                }
                                $urlimagen=$this->_urlimage($imag['Imagen']['id'], 'crop', $idadecuado);
                            }else{
                                $urlimagen=$this->_urlimage($imag['Imagen']['id'], 'big');
                            }
                            $multimedia['imagenes'][$ind]['Imagen']['url']=$urlimagen;
                            $multimedia['imagenes'][$ind]['Imagen']['urlthumb']=$urlimagen=$this->_urlimage($imag['Imagen']['id'], 'mini');
                            $multimedia['imagenes'][$ind]['Imagen']['urlbig']=$urlimagen=$this->_urlimage($imag['Imagen']['id'], 'big');
                        }
                    }
                    //ficheros
                    if (!empty($multimedia['ficheros'])){
                        foreach($multimedia['ficheros'] as $ind=>$fich){
                            $urlfich=$this->path_ficheros_publicos.'/'.$fich['Fichero']['filename'];
                            $multimedia['ficheros'][$ind]['Fichero']['url']=$urlfich;
                        }
                    }
                    
                }
                //--------------------------------------------------------------------------
            }
            return $multimedia;
        }
        
        
        //Devuelve la url del crop indicado de una imágen indicada
        //si dicho crop no existe se devolveran una ruta de imagen vacía js
        function _getUrlImagenCrop($id=null, $idcrop=null){
                        
            $multimedia=array();$urlimagen="javascript:;";
            if ($id!=null AND $idcrop!=null){

                //if (!empty($this->cupc_related_multimedia)){
                    $this->loadModel('Submodulo');
                    $this->loadModel('Multimedia');
                    $cupc_submodulo=$this->Submodulo->find('first',array('conditions'=>array('Submodulo.nombre'=>$this->name)));
                    $cupc_submodulo_id=$cupc_submodulo['Submodulo']['id'];
                    
                    $datos_media=Configure::read('cupc.multimedias');                      
                    //foreach($this->cupc_related_multimedia as $etiqueta){
                        
                    $etiqueta='imagenes';
                    
                        $tipomedia=$datos_media[$etiqueta]['tipo_id'];
                        $modelo=$datos_media[$etiqueta]['modelo'];
                        $this->loadModel($modelo);
                        $relatedelement=$datos_media[$etiqueta]['campo_id'];
                        $html_media=$datos_media['html'][$etiqueta]['html_del'];
                        
                        $conditions=array('submodulo_id'=>$cupc_submodulo_id, 'itemid'=>$id, 'tipomedia_id'=>$tipomedia);
                        $multim=$this->Multimedia->find('all',array('conditions'=>$conditions,'fields' => array($relatedelement)));
                        $ids="(";
                        foreach($multim as $mmid=>$mm){
                            $ids.=$mm['Multimedia'][$relatedelement].",";
                        }
                        $ids=substr($ids,0,-1);$ids.=')';
                        if ($ids==")") $ids='(0)';
                        
                        $conditions2=$modelo.".id IN $ids";
                        $this->$modelo->recursive=1;
                        $elementos=$this->$modelo->find('all',array('conditions'=>$conditions2));
                        
                        $multimedia[$etiqueta]=$elementos;
                    //}
                    
                    if (!empty($multimedia['imagenes'])){
                        foreach($multimedia['imagenes'] as $ind=>$imag){
                            if (!empty($imag['Crop'])){ 
                                $idadecuado=0;
                                foreach($imag['Crop'] as $uncrop){
                                    if ($uncrop['id']==$idcrop){
                                        $idadecuado=$uncrop['id'];
                                        $urlimagen=$this->_urlimage($imag['Imagen']['id'], 'crop', $idadecuado);
                                    }
                                }
                            }
                        }
                    }
                //}
                //--------------------------------------------------------------------------
            }
            return $urlimagen;
        }
        
        
        
        
        
        
        function fotos($idg=null, $idtipog=null) {
            $this->layout='default';
            
            if ($idg!=null AND $idg!=0) $conditions=array('Galeria.esactivo'=>1, 'Galeria.id'=>$idg);
            else{
                if ($idtipog!=null AND $idtipog!=0){
                    $conditions=array('esactivo'=>1, 'Galeria.tipogaleria_id'=>$idtipog);
                }else $conditions=array('esactivo'=>1);
            }
            
            $this->Galeria->recursive=0;
            $galeria= $this->Galeria->find('first', array('conditions'=>$conditions, 'order'=>'Galeria.modified DESC'));
            
            //si se indica el tipo de galeria, hay que indicar el id del crop
            $idcrop=null;
            if ($idtipog!=null AND $idtipog!=0){
                $idcrop=$galeria['Tipogaleria']['crop_id'];
            }
            $galeria['Multimedia']=$this->_getMultimedias($galeria['Galeria']['id'],$idcrop);
            if(isset($this->params['requested'])) {
                return $galeria;
            }
            $this->set('galeria',$galeria);         
	}
        
        function lista() {
            $this->Galeria->recursive=0;
            $galeria = $this->Galeria->find('all', array('conditions'=>array('esactivo'=>1), 'order'=>'titulo ASC'));
            if(isset($this->params['requested'])) {
                return $galeria;
            }
            $this->set('listagalerias',$galeria);
	}
        
        function obras($idsubcategoria=null) {
            $this->layout='default';            
            $idtipog=2; //todas son galerías de imágenes 
            
            
            //si llega el id de la subcategoria, hemos elegido una galeria del menu... la sacamos
            $this->Galeria->Categoriagaleria->recursive=1;
            if ($idsubcategoria!=null AND $idsubcategoria!=0){
                $conditions=array('Galeria.esactivo'=>1, 'Galeria.tipogaleria_id'=>$idtipog,'Galeria.subcategoriagaleria_id'=>$idsubcategoria);
                $this->set('subcategoriaactual',$idsubcategoria);                
                $subcategoriagal=$this->Galeria->Subcategoriagaleria->find('first', array('conditions'=>array('Subcategoriagaleria.id'=>$idsubcategoria)));
                $this->set('categoriaactual',$subcategoriagal['Subcategoriagaleria']['categoriagaleria_id']);
            }else{ //sino... hay que buscar una
                $categoriagal=$this->Galeria->Categoriagaleria->find('all', array('order'=>'Categoriagaleria.titulo ASC'));
                if (!empty($categoriagal)){
                    $this->set('categoriaactual',$categoriagal[0]['Categoriagaleria']['id']);
                                    
                    $this->Galeria->Subcategoriagaleria->recursive=0;
                    $subcategoriagal= $this->Galeria->Subcategoriagaleria->find('first', array('conditions'=>array('Subcategoriagaleria.categoriagaleria_id'=>$categoriagal[0]['Categoriagaleria']['id']), 'order'=>'Subcategoriagaleria.titulo ASC' ));
                    
                    if (!empty($subcategoriagal)){                                       
                        $idsubcategoria=$subcategoriagal['Subcategoriagaleria']['id'];
                        $this->set('subcategoriaactual',$idsubcategoria); 
                        
                        $conditions=array('Galeria.esactivo'=>1, 'Galeria.tipogaleria_id'=>$idtipog,'Galeria.subcategoriagaleria_id'=>$idsubcategoria);                
                    }else{
                        $this->set('subcategoriaactual',0);                
                        $conditions=array('esactivo'=>1, 'Galeria.tipogaleria_id'=>$idtipog);
                    }
                }else{           
                    $this->set('subcategoriaactual',0);                
                    $this->set('categoriaactual',0); 
                    $conditions=array('esactivo'=>1, 'Galeria.tipogaleria_id'=>$idtipog);                    
                }
            }
            
            $this->Galeria->recursive=1;
            $galeria= $this->Galeria->find('first', array('conditions'=>$conditions, 'order'=>'Galeria.modified DESC'));

            
            //si se indica el tipo de galeria, hay que indicar el id del crop
            if (!empty($galeria)){
                $idcrop=null;
                $idcrop=$galeria['Tipogaleria']['crop_id'];
                $galeria['Multimedia']=$this->_getMultimedias($galeria['Galeria']['id'],$idcrop);
            }
            
            //if(isset($this->params['requested'])) {
            //    return $galeria;
            //}
            $this->set('galeria',$galeria);         
	}
        
}
?>
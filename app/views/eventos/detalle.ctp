<article id="actividad">

<header>
      <h2><?=$evento['Evento']['titulo'];?></h2>
</header>

<div class="actividad">

    <?php echo $this->element('slide_galeria',array('imagenes'=>$evento['Multimedia']['imagenes'])); ?>
    
        
    <div id="content">
      <div class="tipo">
            <a href="/actividades/seccion/<?=$evento['Seccion']['titulo'];?>"><?=$evento['Seccion']['titulo'];?></a> 
            <? foreach($evento['Curso'] as $curso){ echo '<a href="/actividades/cursos/'.$curso['titulo'].'">'.$curso['titulo'].'</a>'." ";}?> 
            <a href="/actividades/provincia/<?=$evento['Provincia']['titulo']?>"><?=$evento['Provincia']['titulo']?></a> 
        </div>
      <div class="container">
            <ul class="tabs">
                <li><a href="#tab1">Informacion general</a></li>
                <li><a href="#tab2">Mapa y acceso</a></li>
                <li><a href="#tab3">Tarifas</a></li>
                <li><a href="#tab4">Descargas</a></li>
            </ul> 
          
            <div class="tab_container">
                                
                <div id="tab1" class="tab_content">
                    <h2>Informaci&oacute;n general</h2>
                    <img src="<?=$evento['Evento']['urlImagenDetalle']?>" alt="<?=$evento['Evento']['titulo']?>" />
                    
                    <h3><a href="<?=$evento['Evento']['web'];?>">Ir al sitio web de esta actividad</a></h3>
                    <p><?=$evento['Evento']['descripcion'];?></p>
                    <!-- Videos -->
                    <?php if (!empty($evento['Multimedia']['videos'])){ 
                    foreach ($evento['Multimedia']['videos'] as $video){   ?>
                                <h4><?=$video['Video']['titulo']?></h4>
                                <?=$video['Video']['contenido']?>
                    <?php }} ?>
                </div>
                <div id="tab2" class="tab_content">
                    <h2>Mapa y acceso</h2>
                    <?=$evento['Evento']['mapa'];?>
                    <p><?=$evento['Evento']['acceso'];?></p>
                </div>
                <div id="tab3" class="tab_content">
                    <h2>Tarifas</h2>
                    <img src="<?=$evento['Evento']['urlImagenDetalle']?>" alt="<?=$evento['Evento']['titulo']?>" />
                    <p><?=$evento['Evento']['tarifas'];?></p>
                </div>
                <div id="tab4" class="tab_content">
                    <h2>Descargas</h2>
                    <img src="<?=$evento['Evento']['urlImagenDetalle']?>" alt="<?=$evento['Evento']['titulo']?>" />
                    <ul id="descargas">
                    <!-- Ficheros -->
                    <?php if (!empty($evento['Multimedia']['ficheros'])){ 
                    foreach ($evento['Multimedia']['ficheros'] as $fichero){ ?>
                                <li><a href="/ficheros/descargar/<?=$fichero['Fichero']['id']?>"><?=$fichero['Fichero']['titulo']?></a></li>
                    <?php }} ?>
                    </ul>
                </div>
                
        </div>
    </div>

    
    <?php echo $this->element('social_icons',array('iditem'=>$evento['Evento']['id'], 'titulo'=>$evento['Evento']['titulo'])); ?>
    <?php echo $this->element('comment_write',array('idcomment'=>$evento['Evento']['id'], 'titulo'=>$evento['Evento']['titulo']));?>
    <?php echo $this->element('send_email',array('idcomment'=>$evento['Evento']['id']));?>
    

        
        

    <h2 id="title_comment">Comentarios a "<?=$evento['Evento']['titulo'];?>"</h2>
    <?php echo $this->element('comentarios_de',array('itemid'=>$evento['Evento']['id'])); ?>

       
    </div>
</div>

</article>
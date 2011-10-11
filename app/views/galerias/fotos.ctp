<?php
    $idioma=$this->Session->read('Config.language');
    
    $titulogal=($idioma=="eng")?$galeria['Galeria']['titulo_uk']:$galeria['Galeria']['titulo'];
    $descripciongal=($idioma=="eng")?$galeria['Galeria']['descripcion_uk']:$galeria['Galeria']['descripcion'];

?>

<article id="galeria">
		
<header> <h1><?=$titulogal;?></h1>
        <p><?=$descripciongal;?></p>
</header>

            <div class="content"> 

<?php           
        $num_imagenes=count($galeria['Multimedia']['imagenes']);
        if ($num_imagenes>0){ ?>
           
            <!-- Adding gallery images. We use resized thumbnails here for better performance, but it’s not necessary -->
            <div id="galleria">
            
        <?php    foreach($galeria['Multimedia']['imagenes'] as $imag){ ?>
                <a href="<?=$imag['Imagen']['url']?>">
                    <?
                        $tituloimg=($idioma=="eng")?$imag['Imagen']['titulo_uk']:$imag['Imagen']['titulo'];
                        $descripcionimg=($idioma=="eng")?$imag['Imagen']['descripcion_uk']:$imag['Imagen']['descripcion'];
                    ?>
                    <img title="<?=$tituloimg;?>" alt="<?=$descripcionimg;?>" src="<?=$imag['Imagen']['urlthumb']?>">
                </a>
        <?php
            }    ?>   
                
            </div>                
            
        <?php  }
        ?>   
    </div>
    
    
    
               
        <?php if (!empty($galeria['Multimedia']['videos'])){  ?>
            <div class="content_videos"> 
            <?php foreach ($galeria['Multimedia']['videos'] as $video){   
                    $titulovid=($idioma=="eng")?$video['Video']['titulo_uk']:$video['Video']['titulo'];
                    $descripcionvid=($idioma=="eng")?$video['Video']['descripcion_uk']:$video['Video']['descripcion'];
                    ?>
                    <h2><?=$titulovid;?></h2>
                    <?=$video['Video']['contenido'];?>
                    <p><?=$descripcionvid;?></p>                    
        <?php } ?>
            </div>
        <?php } ?> 

                    
</article>
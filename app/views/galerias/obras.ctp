<?php
    $idioma=$this->Session->read('Config.language');

    $listagalerias=$this->requestAction('categoriagalerias/lista');
    
    $imagenesp=array();
    if (!empty($galeria)){
        $imagenesp=$galeria['Multimedia']['imagenes'];
    }
?>
<article id="galeria">

    <div class="container">
         <header class="otroheader">
            <!--<ul class="tabs">
                <li id="active"><a href="#tab1">Pintura</a></li>
                <li><a href="#tab2">Escultura</a></li>
                <li><a href="#tab3">Grabado</a></li>
                <li><a href="#tab4">Dibujo</a></li>
            </ul>--> 
            
       
        <ul class="sf-menu sf-navbar">
            <?php if (!empty($listagalerias)){
                    foreach($listagalerias as $categoria){ 
                        
                        $titulogal=($idioma=="eng")?$categoria['Categoriagaleria']['titulo_uk']:$categoria['Categoriagaleria']['titulo'];
                                
                        ?>
            
            <li <? if ($categoria['Categoriagaleria']['id']==$categoriaactual) echo "class='current'";?>>
                <a class="sf-with-ul" href="#"><?=$titulogal;?><span class="sf-sub-indicator"> &#187;</span></a>
                <ul>
                <?php if (!empty($categoria['Subcategoriagaleria'])){
                        foreach($categoria['Subcategoriagaleria'] as $subcategoria){  
                               $titulosubgal=($idioma=="eng")?$subcategoria['titulo_uk']:$subcategoria['titulo'];

                            ?>
                            <li <? if ($subcategoria['id']==$subcategoriaactual) echo "class='current'";?>>
                                <a href="/galerias/obras/<?=$subcategoria['id'];?>"><?=$titulosubgal;?></a>
                            </li>
                        <? }
                        }else{ ?>
                            <li><a href="#">Sin galeria!</a></li>
                    <? } ?>
                        
                </ul>
            </li>
            <? }
            } ?>
        </ul>

        </header>
        
        
       
        <div class="tab_container">
            <div id="galeria">
                <div class="content">
            <?php           
                    $num_imagenes=count($imagenesp);
                    if ($num_imagenes>0){ ?>


                            <!-- Adding gallery images. We use resized thumbnails here for better performance, but it’s not necessary -->
                            <div id="galleria">

                    <?php   foreach($imagenesp as $imag){ ?>
                            <a href="<?=$imag['Imagen']['url']?>" rel="<?=$imag['Imagen']['urlbig']?>">
                                <?
                                    $tituloimg=($idioma=="eng")?$imag['Imagen']['titulo_uk']:$imag['Imagen']['titulo'];
                                    $descripcionimg=($idioma=="eng")?$imag['Imagen']['descripcion_uk']:$imag['Imagen']['descripcion'];
                                ?>
                                <img title="<?=$tituloimg;?>" alt="<?=$descripcionimg;?>" src="<?=$imag['Imagen']['urlthumb']?>">
                            </a>
                    <?php    }    ?>


                            </div>
            <?php  }   ?> 


                </div>
            </div>
        </div>
    </div>

</article>
<?php
    //$datos=$this->requestAction('');
    //print_r($datos);
?> 
<div id="dialog-multimedia" title="Añadir multimedia...">
    <div class="mm_filtros">
        Filtre el contenido según estas opciones...
       <!-- <li>Publicos: <input type="checkbox" id="mm_publicos" checked = "checked" /></li> -->
        <li>No usado aun: <input type="checkbox" id="mm_nousados" checked = "checked" /></li>
        <li>Categoría: 
            <select name="categorias" id="mm_categorias">
            <?php foreach($cupc_categorias_multimedia as $catid=>$categoria){ ?>
            <option value="<?=$catid?>"><?=$categoria?></option>
            <?php } ?>
            </select>
        </li>  
    </div>
    <div class="mm_contenido" id="mm_contenido"></div>
    <div class="mm_paginacion" id="mm_paginacion"></div>                
</div>

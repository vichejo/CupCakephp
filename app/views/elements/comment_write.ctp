<?php  
//$modulo
//$idcomment;
//$titulo;
?>
<div class="comment_write" id="comment_write_<?=$idcomment;?>">
    <h3> Añadir comentario</h3>
    <form id="comment_write_form<?=$idcomment;?>" class="comment_write_forms" action="javascript:;" method="post">
        <input type="hidden" name="modulo" value="<?=$modulo;?>" />
        <input type="hidden" name="item" value="<?=$idcomment;?>" />        
        <input type="hidden" name="titulo" value="<?=$titulo;?>" />
        <div>
            <label for="nombre">Nombre</label><input type="text" name="nombre" required placeholder="Nombre"/>
        </div>
        <div>
            <label for="email">email</label><input type="email" required name="email" id="email" placeholder="email"/>
        </div>
        <div>
            <label for="comentario">Comentario</label><textarea placeholder="Comentario" required maxlength="1000" name="comentario" id="comentario"/></textarea>
        </div>
        <div>
            <input class="submit" type="submit" value="Enviar">
        </div>
    </form>
</div>
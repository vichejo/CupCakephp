<?php
//$modulo
//$idcomment;
$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<div class="send_email" id="send_email_<?=$idcomment;?>">
    <h3> Enviar este artículo</h3>
    <form id="send_email_form<?=$idcomment;?>" class="send_email_forms" action="javascript:;" method="post">
        <input type="hidden" name="item" value="<?=$idcomment;?>" /> 
        <input type="hidden" name="url" value="<?=$url?>" />
        <div>
            <label for="nombre">Tu Nombre</label><input type="text" name="nombre" required placeholder="Tu nombre"/>
        </div>
        <div>
            <label for="nombre2">Tu amgio</label><input type="text" name="nombre2" required placeholder="Nombre de tu amigo"/>
        </div>
        <div>
            <label for="email">Email de tu amigo</label><input type="email" required name="email" id="email" placeholder="Email de tu amigo"/>
        </div>
        <div>
            <label for="comentario">Comentario</label><textarea placeholder="Comentario" required maxlength="1000" name="comentario" id="comentario"/></textarea>
        </div>
        <div>
            <input class="submit" type="submit" value="Enviar">
        </div>
    </form>
</div>
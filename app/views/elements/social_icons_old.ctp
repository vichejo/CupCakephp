<?php  
//$iditem;
//$modulo;
//$titulo;
$cupc_datos=Configure::read('cupc'); 

if (!isset($iditem)) $iditem=1;
?>
<div id="social_icon"> 
    <a href="http://www.facebook.com/share.php?u=<?=$cupc_datos['app']['url']."/".$modulo."/".$iditem."&t=".urlencode("Leyendo '".$titulo."' en Olvidos.es");?>"><img src="/img/Facebook.png"></a>
    <a href="http://twitter.com/share?url=<?=$cupc_datos['app']['url']."/".$modulo."/".$iditem;?>&text=<?=urlencode("Leyendo '".$titulo."' en Olvidos.es")?>"><img src="/img/twitter.png"></a>
    <img class="comment_write_buttom" rel="<?=$iditem?>" src="/img/Comments.png" >
    <img class="send_email_buttom" rel="<?=$iditem?>" src="/img/mail.png" >
</div>
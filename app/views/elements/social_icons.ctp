<?php  
//$iditem;
//$modulo;
//$titulo;
$cupc_datos=Configure::read('cupc'); 

if (!isset($iditem)) $iditem=1;
?>
<div id="social_icon"> 
    <a href="http://www.facebook.com/share.php?u=<?=$cupc_datos['app']['url']."/".$urlmodulo."/".$iditem."&t=".urlencode("Leyendo '".$titulo."' en www.fbonilla.com");?>"><img src="/img/facebook.png"></a>
    <a href="http://twitter.com/share?url=<?=$cupc_datos['app']['url']."/".$urlmodulo."/".$iditem;?>&text=<?=urlencode("Leyendo '".$titulo."' en www.fbonilla.com")?>"><img src="/img/twitter.png"></a>
    <img class="comment_write_buttom" rel="<?=$iditem?>" src="/img/comments.png" >
    <img class="send_email_buttom" rel="<?=$iditem?>" src="/img/mail.png" >
</div>
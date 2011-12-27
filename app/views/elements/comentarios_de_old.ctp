<?php
//modulo
//itemid 
	$datos=$this->requestAction('opiniones/opiniones_de/'.$modulo."/".$itemid);
	//print_r($datos);

if (!empty($datos)){
    foreach($datos as $comm){
?> 
<div id="comment">
    <div>
        <h3><?=$comm['Opinion']['nombre'];?></h3> 
        <span><?=$time->format('d-m-Y H:i',$comm['Opinion']['created'])."h";?></span>
        <p><?=$comm['Opinion']['descripcion'];?></p>
    </div>
</div>

<? }}else{
    echo "Se tu el primero en escribir uno!";
} ?>
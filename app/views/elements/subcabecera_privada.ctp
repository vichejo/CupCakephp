<?php
        //Migas de pan
        $sitio='inicio';
        if ($this->name=='Pages') $sitio= $this->params['pass'][0];
        else $sitio=$this->name;

        $txtaction=$this->params['action'];
        //print $sitio."<br>".$txtaction;
        //print_r($this->params);
        
        if ($sitio=="Users" AND $txtaction=="admin") $estamosen="principal";
        else $estamosen=$sitio;

        //Usuario logueado
        if ($session->read('Auth.User.username')==null) $usuarioAuth="Anonimo";
        else $usuarioAuth=$session->read('Auth.User.username');
        //Grupo al que pertenecemos -> para habilitar/deshabilitar opciones
        if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
        else $grupoAuth=$session->read('Auth.User.group_id');
        
        if ($grupoAuth!="-"){
?>
<section id="secondary_bar">
        <div class="user">
                <p><?=$usuarioAuth;?> (<a href="#">0 Messages</a>)</p>
                <a class="logout_user" href="/logout" title="Logout">Logout</a>
        </div>
        <div class="breadcrumbs_container">
                <article class="breadcrumbs">
                    <a href="/admin">Panel de Administracion</a>
                    <? if ($txtaction=="admin" OR $txtaction=="index"){?>                    
                        <div class="breadcrumb_divider"></div><a class="current"><?=$estamosen;?></a>
                    <?}else{?>
                        <div class="breadcrumb_divider"></div><a href="/<?=$this->params['controller'];?>"><?=$estamosen;?></a>
                        <div class="breadcrumb_divider"></div><a class="current"><?=$txtaction;?></a>
                    <?}?>
                </article>
        </div>
</section>
<?php }else{ ?>
<section id="secondary_bar">
        <div class="user"></div>
        <div class="breadcrumbs_container"></div>
</section>
<?php } ?>

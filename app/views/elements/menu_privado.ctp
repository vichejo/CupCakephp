<?php $cupc_datos=Configure::read('cupc');
if ($session->read('Auth.User.group_id')==null) $grupoAuth="-";
else $grupoAuth=$session->read('Auth.User.group_id');
?>
<aside id="sidebar" class="column">
    <?php if ($grupoAuth!="-"){ ?>
        <form class="quick_search">
                <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
        </form>
        <hr/>
        <?php if ($grupoAuth==1){ ?>
        <h3>Sistema</h3>
        <ul class="toggle">
                <li class="icn_settings"><a href="/modulos">Modulos</a></li>
                <li class="icn_settings"><a href="/submodulos">Submodulos</a></li>
        </ul>
        <?php } ?>
        <?php if ($grupoAuth<3){ ?>
        <h3>Acceso</h3>
        <ul class="toggle">
                <li class="icn_profile"><a href="/users">Users</a></li>
                <?php if ($grupoAuth==1){ ?><li class="icn_view_users"><a href="/groups">Groups</a></li><?php } ?>
        </ul>
        <?php }?>
        <h3>Usuarios</h3>
        <ul class="toggle">
                <li class="icn_add_user"><a href="/usuarios/add">Añadir Usuarios</a></li>
                <li class="icn_view_users"><a href="/usuarios">Listado de Usuarios</a></li>
                <li class="icn_emails"><a href="/contactos">Listado de Consultas</a></li>
        </ul>
        <h3>Multimedia</h3>
        <ul class="toggle">                
                <li class="icn_photo"><a href="/imagenes">Imagenes</a></li>
                <?php if ($grupoAuth==1){ ?><li class="icn_photo_crop"><a href="/crops">Recortes</a></li><?php } ?>
                <li class="icn_audio"><a href="/audios">Audio</a></li>
                <li class="icn_video"><a href="/videos">Video</a></li>
                <li class="icn_jump_back"><a href="/links">Enlaces (a extinguir)</a></li>
                <li class="icn_filetype"><a href="/ficheros">Ficheros</a></li>
                <li class="icn_tags"><a href="/categorias">Categorias</a></li>
        </ul>
        <h3>Galerias</h3>
        <ul class="toggle">
                <li class="icn_new_article"><a href="/galerias/add">Nueva Galería</a></li>
                <li class="icn_folder"><a href="/galerias">Galerías</a></li>                
                <?php if ($grupoAuth==1){ ?><li class="icn_tags"><a href="/tipogalerias">Tipos</a></li><? } ?>
        </ul>        
        <h3>Eventos</h3>
        <ul class="toggle">
                <li class="icn_new_article"><a href="/eventos/add">Nuevo Evento</a></li>
                <li class="icn_categories"><a href="/eventos">Eventos</a></li>
                <li class="icn_tags"><a href="/secciones">Secciones</a></li>
                <?php if ($grupoAuth==1){ ?><li class="icn_tags"><a href="/tipoeventos">Tipos</a></li><? } ?>
                <li class="icn_edit_article"><a href="/opiniones">Opiniones</a></li>
        </ul>
        <h3>Otros</h3>
        <ul class="toggle">
                <li class="icn_security"><a href="/logout">Logout</a></li>
        </ul>
    <?php }else{ ?>
        <h3>Zona restringida</h3>
    <?php } ?>
        <footer>
                <hr />
                <p><strong>Copyright &copy; <?=$cupc_datos['year']?> <a href="<?=$cupc_datos['creator']['url']?>"><?=$cupc_datos['creator']['name']?></a></strong></p>
                <p> </p>
        </footer>
</aside>

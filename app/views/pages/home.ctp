<?php 
$datos=Configure::read('cupc');   
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>

<b>Application:</b>
<h1><?php echo $datos['app']['name']; ?></h1>
<p><?php echo $datos['app']['description']; ?></p>
<h4><?php echo $datos['app']['date']; ?></h4>
<h4><?php echo $datos['app']['url']; ?></h4>
<h4><?php echo $datos['app']['email']; ?></h4>
<br><br>
<b>This is an application based in:</b>
<h3><?php echo $datos['name']." ".$datos['version']; ?></h3>
<h4><?php echo $datos['url']; ?></h4>
<br>
<b>Created by:</b>
<h4><?php echo $datos['creator']['name']; ?></h4>
<h4><?php echo $datos['creator']['url']; ?></h4>
<h4><?php echo $datos['creator']['email']; ?></h4>

<br></br>
Zona de administración: <a href="/admin">aqui</a><br />
Formulario de contacto: <a href="/contactos/registrar">aqui</a><br />
<br></br>
Registro de usuarios, olvide mi contraseña: <a href="#">X</a><br />
Un Evento completo con multimedia: <a href="#">X</a><br />
Galerias de imagenes: <a href="#">X</a><br />
Iconos redes sociales, comentar y enviar email: <a href="#">X</a><br />
Enlace RSS eventos: <a href="#">X</a><br />

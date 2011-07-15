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

Admin area: <a href="/admin">here</a>
<?php $cupc_datos=Configure::read('cupc');?>
<section id="main" class="column">

    <article class="module width_full">
            <header><h3>Panel de administración</h3></header>
            <div class="module_content">
                    <h1><?=$cupc_datos['app']['name'];?></h1>
                    <h2><?=$cupc_datos['app']['description'];?></h2>
                    <br><br>
                    <b>This is an application based in:</b>
                    <h3><?php echo $cupc_datos['name']." ".$cupc_datos['version']; ?></h3>
                    <h4><?php echo $cupc_datos['url']; ?></h4>
                    <br>
                    <b>Created by:</b>
                    <h3><?php echo $cupc_datos['creator']['name']; ?></h3>
                    <h4><?php echo $cupc_datos['creator']['url']; ?></h4>
                    <h4><?php echo $cupc_datos['creator']['email']; ?></h4>
                    <p></p>
            </div>
    </article>

    <div class="spacer"></div>
</section>		
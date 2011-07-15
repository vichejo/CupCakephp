<?php $cupc_datos=Configure::read('cupc');?>
<header id="header">
        <hgroup>
                <h1 class="site_title"><a href="/admin"><?php echo $this->Html->link(__($cupc_datos['app']['name'], true), $cupc_datos['app']['url']); ?></a></h1>
                <h2 class="section_title">Panel de Administración</h2><div class="btn_view_site"><a href="<?=$cupc_datos['app']['url']?>">View Site</a></div>
        </hgroup>
</header>

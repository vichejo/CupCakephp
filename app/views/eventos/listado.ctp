<article>


<header>
    <h2>Actividades</h2>
</header>


<?php 	
    if (!empty($eventos)){;
    foreach($eventos as $proxima){ ?>

   <div class="actividad_listado">
        <img src="/img/fotografias/listado.jpg" width="130" height="105">
        <h1><?=$proxima['Evento']['titulo'];?></h1>
        <div class="leer_mas"><a href="/actividades/detalle/<?=$proxima['Evento']['id'];?>"><img src="/img/ico_leer_mas.png" width="20" height="20" alt="Leer más"></a></div>
        <div class="tipo">
            <a href="/actividades/seccion/<?=$proxima['Seccion']['titulo'];?>"><?=$proxima['Seccion']['titulo'];?></a> 
            <? foreach($proxima['Curso'] as $curso){ echo '<a href="/actividades/cursos/'.$curso['titulo'].'">'.$curso['titulo'].'</a>'." ";}?> 
            <a href="/actividades/provincia/<?=$proxima['Provincia']['titulo']?>"><?=$proxima['Provincia']['titulo']?></a> 
        </div>
   </div>

<?php 	}   
    }else{ ?>
        <p>Actualmente no existe ninguna actividad.</p>
<?php }?>

<div id="paginacion_act">
    <?php echo $this->Paginator->prev('<< ', array(), null, array('class'=>'disabled'));?>
    <?php echo $this->Paginator->numbers(array('separator'=>""));?>
    <?php echo $this->Paginator->next(' >>', array(), null, array('class' => 'disabled'));?>
</div>

</article>
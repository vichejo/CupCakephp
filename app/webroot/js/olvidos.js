// JavaScript Document
// fadeto de contenidos

$(document).ready(function () {
    if (home == 0){
            $("#menu").animate({left:'733px'}, 500);
            $("#menu").queue(function () {
                    $("#principal").fadeTo("slow", 1);
                    $("#second").fadeTo("slow", 1);
                    //$("#editorial").show("slow");
                    $("#editorial").fadeTo("slow", 1);
                    //$("#menu_editorial").show("slow");
                    $("#social_icon_menu").show("slow");
                    $("#menu_editorial").fadeTo("slow", 1);
                    $("#footer-container").fadeTo("slow",1);
                    $(this).dequeue();
            });
    }
}); 
	   
	   
//mover el menu
$("#boton_inicio").click(function(){
    $("#video_inicio").fadeOut("slow");
    $("#video_inicio").remove();
    $("#menu").animate({left:'733px'}, 2000);

    $("#menu").queue(function () {
        $("#principal").fadeTo("slow", 1);
        $("#second").fadeTo("slow", 1);
        //$("#editorial").show("slow");
        $("#editorial").fadeTo("slow", 1);
        //$("#menu_editorial").show("slow");
        $("#social_icon_menu").show("slow");
        $("#menu_editorial").fadeTo("slow", 1);
        $("#footer-container").fadeTo("slow",1);
        $(this).dequeue();
    });
});

// Video jplaye
//<![CDATA[
$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				m4v: "../uvideos/Touch_of_Evil_Opening_Shot.m4v",
				ogv: "../uvideos/Touch_of_Evil_Opening_Shot.ogv",
				mp4: "../uvideos/Touch_of_Evil_Opening_Shot.mp4",
				poster: "../uvideos/Touch_of_Evil_Opening_Shot.png"
			}).jPlayer("play");
		},
		ended: function (event) {
			$("#jquery_jplayer_2").jPlayer("play", 0);
		},
		swfPath: "/app/webroot/js/jQuery.jPlayer.2.0.0/",
		supplied: "ogv, mp4, m4v"
	})
	.bind($.jPlayer.event.play, function() { // Using a jPlayer event to avoid both jPlayers playing together.
			$(this).jPlayer("pauseOthers");
	});
});
//]]>

/*
//audio player
//<![CDATA[
$(document).ready(function(){

	$("#audio").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				mp3: "http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3"
			}).jPlayer("pause");
		},
		ended: function (event) {
			$(this).jPlayer("pause");
		},
		swfPath: "js",
		supplied: "mp3"
		
	});
});
//]]>
*/


 // botones de abrir/cerrar formularios
$(document).ready(function(){ 

    $(".comment_write_buttom").click(function(){
        var visible=$("#comment_write_"+$(this).attr("rel")).css('display');
        if (visible=='none') $("#comment_write_"+$(this).attr("rel")).show("slow");
        else $("#comment_write_"+$(this).attr("rel")).hide("slow");

        $("#send_email_"+$(this).attr("rel")).hide("slow");
    });
    $(".send_email_buttom").click(function(){
        var visible=$("#send_email_"+$(this).attr("rel")).css('display');
        if (visible=='none') $("#send_email_"+$(this).attr("rel")).show("slow");
        else $("#send_email_"+$(this).attr("rel")).hide("slow");

        $("#comment_write_"+$(this).attr("rel")).hide("slow");	
    });
});


//menu acordeon
//hide message_body after the first one
$(".message_body ").hide();

//toggle message_body
$(".message_head").click(function(){
        $(this).next(".message_body ").slideToggle(500)
        return false;
});

//show all messages
$(".show_all_message").click(function(){
        $(this).hide()
        $(".collpase_all_message").show()
        $(".message_body").slideDown()
        return false;
});

//show recent messages only
$(".collpase_all_message").click(function(){
        $(this).hide()
        $(".show_all_message").show()
        $(".message_body").slideUp()
        return false;
});



// facebox buscador
jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
        loadingImage : '../img/facebox/loading.gif',
        closeImage   : '../img/facebox/closelabel.png'
    })
})
 
//imagenes shadowbox
$(document).ready(function(){
    Shadowbox.init({
         handleOversize: "resize",
         handleUnsupported:  "remove",
         continuous: true,
         modal: true
     });
});
 
 
//JPlayer
//-------
//audio
//<![CDATA[
$(document).ready(function(){
    for (var iii=1; iii<=numero_audios; iii++){
        var objetojpa="#jquery_jplayer_audio"+iii;
        $(objetojpa).jPlayer({
                ready: function () {
                    var atributos= $(this).attr('rel');
                    var audio= atributos;

                        $(this).jPlayer("setMedia", {
                                mp3: audio
                        }).jPlayer("pause");
                },
                ended: function (event) {
                        $(this).jPlayer("pause");
                },
                swfPath: "/app/webroot/js/jQuery.jPlayer.2.0.0/",
                solution: "flash, html",
                cssSelectorAncestor: "#jp_interface_"+iii,
                supplied: "mp3"
        }).bind($.jPlayer.event.play, function() { // Using a jPlayer event to avoid both jPlayers playing together.
			$(this).jPlayer("pauseOthers");
	});
    }
});
//]]>


//modificar title del menu
jQuery(document).ready(function(){
    //Title personalizado a un elemento
    //jQuery('div:first').jQueryTitle({title:'Este es el primer div de la p�gina'});

    //Ocultar title al hacer click en una imagen
    //jQuery('img:[title]').jQueryTitle({click:true});

    //Modificar title de enlaces con todas las propiedades modificadas
    jQuery('aside#menu > nav a[title]').jQueryTitle({clase:'jQueryTitle',click:false,move:true});
	
    //jQuery(selector).jQueryTitle({title:'Posición del cursor:<br />5px: jQueryTitle.x<br />Y: jQueryTitle.y'});
});



//formularios de añadir comentario y enviar por email
$('.comment_write_forms').submit(function() {
    $.ajax({
        type: "POST",
        url: '/opiniones/opinar', //$(this).attr('action'),
        data: $(this).serialize(),
        success: function(datos){
            var resultado = $.parseJSON(datos);
            if (resultado.status=="ok"){
                $("#comment_write_"+resultado.idform).hide("slow");
                $("#comment_write_form"+resultado.idform)[0].reset();
                alert("Tu comentario ha sido enviado. Aparecerá en el listado próximamente. Gracias!");
            }else{
                alert('Ocurrió algun error!'+resultado.status);
            }
        }
    });
});
$('.send_email_forms').submit(function() {
    $.ajax({
        type: "POST",
        url: '/opiniones/send_email', //$(this).attr('action'),
        data: $(this).serialize(),
        success: function(datos){
            var resultado = $.parseJSON(datos);
            if (resultado.status=="ok"){
                $("#send_email_"+resultado.idform).hide("slow");
                $("#send_email_form"+resultado.idform)[0].reset();
                //alert("Tu comentario ha sido enviado. Gracias!");
            }else{
                alert('Ocurrió algun error!'+resultado.status);
            }
        }
    });
});


// menu lateral fijo
$(function() {
    var offset = $("#menu").offset();
    var topPadding = 15;
    $(window).scroll(function() {
        if ($("#menu").height() < $(window).height() && $(window).scrollTop() > offset.top) { /* LINEA MODIFICADA POR ALEX PARA NO ANIMAR SI EL SIDEBAR ES MAYOR AL TAMAÑO DE PANTALLA */
            $("#menu").stop().animate({
                marginTop: $(window).scrollTop() - offset.top + topPadding
            });
        } else {
            $("#menu").stop().animate({
                marginTop: 0
            });
        };
    });
});





//paginacion submenus
$(document).ready(function(){
        $('#menu_editorial').pajinate({
                items_per_page : 6,
				start_page : 0,
                num_page_links_to_display : 3,
                nav_label_first : '<<',
                nav_label_last : '>>',
                nav_label_prev : '<',
                nav_label_next : '>'
        });
});	


//volver arriba
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
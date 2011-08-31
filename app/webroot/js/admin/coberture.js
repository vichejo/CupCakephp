//Habilitamos los calendarios
//---------------------------
//para cualquier modelo
$(function() {
    var altfi="#"+$("#CalendarioFechainicio").attr('rel');
    var altff="#"+$("#CalendarioFechafin").attr('rel');
    
        $("#CalendarioFechainicio" ).datepicker({
                changeMonth: true,
                changeYear: true,
                //altField: "#EventoFechainicio",
                altField: altfi,
		altFormat: "yy-mm-dd",
                dateFormat: 'dd/mm/yy',
                minDate: '-0d',
                //showOtherMonths: true,
		//selectOtherMonths: true,
                onSelect: function( selectedDate ) {
				var option = this.id == "CalendarioFechainicio" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				$("#CalendarioFechafin").datepicker( "option", option, date );
			}
        });
        $("#CalendarioFechafin" ).datepicker({
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 2,
                //altField: "#EventoFechafin",
                altField: altff,
		altFormat: "yy-mm-dd",
                dateFormat: 'dd/mm/yy',
                minDate: '-0d',
                onSelect: function( selectedDate ) {
				var option = this.id == "CalendarioFechainicio" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				$("#CalendarioFechainicio").datepicker( "option", option, date );
			}
        });
        
        //$("#Calendariosfechafin").datepicker($.datepicker.regional['es']);
});

//habilitamos el CLEditor para los textarea
//simple
$(document).ready(function() {
        $("textarea.textarea_extended").cleditor({
            width: 585,
            controls:     // controls to add to the toolbar
                    "bold italic underline strikethrough  | font " +
                    "style | color highlight removeformat | bullets numbering | outdent " +
                    "indent | alignleft center alignright justify | " +
                    "rule image link unlink | pastetext | print source"
        });
});
//completo con opciones
/*$(document).ready(function() {
    $("#input").cleditor({
      width:        500, // width not including margins, borders or padding
      height:       250, // height not including margins, borders or padding
      controls:     // controls to add to the toolbar
                    "bold italic underline strikethrough subscript superscript | font size " +
                    "style | color highlight removeformat | bullets numbering | outdent " +
                    "indent | alignleft center alignright justify | undo redo | " +
                    "rule image link unlink | cut copy paste pastetext | print source",
      colors:       // colors in the color popup
                    "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
                    "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
                    "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
                    "999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
                    "666 900 C60 C93 990 090 399 33F 60C 939 " +
                    "333 600 930 963 660 060 366 009 339 636 " +
                    "000 300 630 633 330 030 033 006 309 303",    
      fonts:        // font names in the font popup
                    "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond," +
                    "Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
      sizes:        // sizes in the font size popup
                    "1,2,3,4,5,6,7",
      styles:       // styles in the style popup
                    [["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
                    ["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
                    ["Header 6","<h6>"]],
      useCSS:       false, // use CSS to style HTML when possible (not supported in ie)
      docType:      // Document type contained within the editor
                    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
      docCSSFile:   // CSS file used to style the document contained within the editor
                    "", 
      bodyStyle:    // style to assign to document body contained within the editor
                    "margin:4px; font:10pt Arial,Verdana; cursor:text"
    });
});*/


//acordeones
$(function() {
        var icons = {
                header: "ui-icon-circle-arrow-e",
                headerSelected: "ui-icon-circle-arrow-s"
        };
        $( "#accordion" ).accordion({
                collapsible: true,
                icons: icons,
                active: false
        });
        $( "#toggle" ).button().toggle(function() {
                $( "#accordion" ).accordion( "option", "icons", false );
        }, function() {
                $( "#accordion" ).accordion( "option", "icons", icons );
        });
        
        
});



//Dialogos y jcrop para realizar cropss
//-------------------------------------
var jcropimage;
var jcropimageid;
var jcropid;
var jcropsubmoduloid;

//dialogos modales para el crop (crear y eliminar)
$(function() {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        $( "#dialog:ui-dialog" ).dialog( "destroy" );

        $( "#dialog-modal" ).dialog({
                autoOpen: false,
                show: "blind",
		maxHeight: 800,
		maxWidth: 1060,
                width:1060,
                modal: true,
                beforeClose: function(){
                            jcropimage.destroy();
                        },
                buttons: {
                        "Realizar crop": function() {
                            if (checkCoords()){
                                $.ajax({
                                        type: "POST",
                                        url: "/imagenes/create_crop",
                                        data: "image="+jcropimageid+"&id="+jcropid+"&x="+$('#jix').val()+"&y="+$('#jiy').val()+"&w="+$('#jiw').val()+"&h="+$('#jih').val(),
                                        success: function(datos){
                                            var resultado = $.parseJSON(datos);
                                            if (resultado.status=="ok"){
                                                var gen="#gen"+jcropid;
                                                var can="#can"+jcropid;
                                                $(gen).css('display','none');
                                                $(can).css('display','block');

                                                var div="#crealizados"+jcropsubmoduloid;
                                                var total=$(div).text();
                                                total = parseFloat(total) + 1;
                                                $(div).text(total);
                                                
                                                var imag="#img"+jcropid;
                                                var cadena="../../upcontent/images/crops/"+jcropimageid+"/"+jcropid+".jpg";
                                                $(imag).attr('src',cadena);
                                                
                                                var inputurl="#inputurl"+jcropid;
                                                $(inputurl).show();
                                                
                                                
                                                $("#dialog-modal").dialog( "close" ); 
                                                
                                                $('html, body').animate({scrollTop:0}, 'fast');
                                            }else{
                                                alert('Ocurrió algun error!'+resultado.status);
                                            }
                                        }
                                });
                                //$( this ).dialog( "close" );    
                            };                            
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                        }
                }
        });
        
        
        $( "#dialog-modal2" ).dialog({
                autoOpen: false,
                show: "blind",
                modal: true,
                buttons: {
                        "Eliminar crop": function() {
                                $.ajax({
                                        type: "POST",
                                        url: "/imagenes/delete_crop",
                                        data: "image="+jcropimageid+"&id="+jcropid,
                                        success: function(datos){
                                            var resultado = $.parseJSON(datos);
                                            if (resultado.status=="ok"){
                                                var gen="#gen"+jcropid;
                                                var can="#can"+jcropid;
                                                $(gen).css('display','block');
                                                $(can).css('display','none');
                                                
                                                var div="#crealizados"+jcropsubmoduloid;
                                                var total=$(div).text();
                                                total = parseFloat(total) - 1;
                                                $(div).text(total);
                                                
                                                var imag="#img"+jcropid;
                                                $(imag).attr('src','javascript:;');
                                                
                                                $("#dialog-modal2").dialog( "close" ); 
                                            }else{
                                                alert('Ocurrió algun error!'+resultado.status);
                                            }
                                        }
                                });
                                //$( this ).dialog( "close" );    
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                        }
                }
        });
});


//jcrop functions
function updateCoords(c)
{
	$('#jix').val(c.x);
	$('#jiy').val(c.y);
	$('#jiw').val(c.w);
	$('#jih').val(c.h);
};
function checkCoords()
{
	if (parseInt($('#jiw').val())>0) return true;
	alert('Please select a crop region then press submit.');
	return false;
};

$(".generar" ).button().click(function() {
    $( "#dialog-modal" ).dialog( "open" );
    
    //adquiriendo parametros para jcrop
    var atributos= $(this).attr('rel');
    var obj_attr = $.parseJSON(atributos);
    jcropimageid=obj_attr.imagen;
    jcropid=obj_attr.id;
    jcropsubmoduloid=obj_attr.submodulo;
    
    //var titulo = $("#dialog-modal").dialog( "option" , 'title' );
    var titulo='Realizando el crop para la imagen seleccionada... '+' ('+obj_attr.ancho+'x'+obj_attr.alto+'px)';
    $("#dialog-modal").dialog( "option" , 'title' , titulo );
    
    //id, imagen, ancho, alto
    var pancho="";
    var palto="";
      
    var aspectr=eval(obj_attr.ancho / obj_attr.alto);
    //jcrop
    /*var jcropimage = $('#jcrop_target').Jcrop({
        allowSelect: false,
        setSelect: [0,0,obj_attr.ancho,obj_attr.alto],
        aspectRatio: pancho/palto,
        bgOpacity:   .4
    });*/
    
    jcropimage=$.Jcrop($('#jcrop_target'),{
        allowSelect: false,
        setSelect: [0,0,obj_attr.ancho,obj_attr.alto],
        minSize: [obj_attr.ancho,obj_attr.alto],
        aspectRatio: aspectr,
        onSelect: updateCoords
        //bgOpacity:   .4
    });
    jcropimage.setOptions({bgOpacity: .4});
    jcropimage.focus();

});

$(".eliminar" ).button().click(function() {
    
    //adquiriendo parametros para jcrop
    var atributos2= $(this).attr('rel');
    var obj_attr2 = $.parseJSON(atributos2);    
    jcropimageid=obj_attr2.imagen;
    jcropid=obj_attr2.id;
    jcropsubmoduloid=obj_attr2.submodulo;

    $("#dialog-modal2").text("¿Seguro que desea eliminar el crop seleccionado?"+
" "+obj_attr2.titulo+" --> "+obj_attr2.ancho+"x"+obj_attr2.alto+"px ("+obj_attr2.aplicable+")");
    $("#dialog-modal2" ).dialog( "open" );
    
    //var titulo = $("#dialog-modal").dialog( "option" , 'title' );
    var titulo2='Eliminando crop... ';
    $("#dialog-modal2").dialog( "option" , 'title' , titulo2 );
    
});




//----------------------------------
//dialogos de Multimedia

var multimedia_modulo_id;
var multimedia_item_id;
var multimedia_tipo;
var multimedia_filtro_publicos;
var multimedia_filtro_usados;
var multimedia_filtro_categorias;



function click_adjunta_multimedia(){
    $(".adjunta_multimedia" ).click(function() {
        //adquiriendo parametros
        var atributos2= $(this).attr('rel');
        var obj_attr2 = $.parseJSON(atributos2);
        add_multimedia(obj_attr2.modulo_id,obj_attr2.item_id,obj_attr2.tipo,obj_attr2.elemento_id,obj_attr2.bloque_id);    
    });
}

function click_elimina_multimedia(){
    $(".elimina_multimedia" ).unbind('click');
    $(".elimina_multimedia" ).click(function() {    
        //adquiriendo parametros
        var atributos2= $(this).attr('rel');
        var obj_attr2 = $.parseJSON(atributos2);
        del_multimedia(obj_attr2.modulo_id,obj_attr2.item_id,obj_attr2.tipo,obj_attr2.elemento_id,obj_attr2.bloque_id);    
    });   
    
}

function add_multimedia(modulo_id,item_id,tipo,elemento_id,bloque_id){
    $.ajax({
            type: "POST",
            url: "/multimedias/add_medio",
            data: "tipo="+tipo+"&modulo_id="+modulo_id+"&item_id="+item_id+"&elemento_id="+elemento_id,
            success: function(datos){
                var resultado = $.parseJSON(datos);
                if (resultado.status=="ok"){
                    var nuevocontenido=resultado.html;
                    var objeto="#contenidos_mm_"+tipo;
                    $(objeto).append(nuevocontenido);
                    // añadimos clicks a los enlaces nuevos
                    click_elimina_multimedia();
                    $("div:has(a.elimina_multimedia)").show('slow');
                    
                    $("#"+bloque_id).hide('slow',function () { $(this).remove();});
                }else{
                    alert('Ocurrió algun error!'+resultado.status);
                }
            }
    });
}
function del_multimedia(modulo_id,item_id,tipo,elemento_id,bloque_id){
    $.ajax({
            type: "POST",
            url: "/multimedias/del_medio",
            data: "tipo="+tipo+"&modulo_id="+modulo_id+"&item_id="+item_id+"&elemento_id="+elemento_id,
            success: function(datos){
                var resultado = $.parseJSON(datos);
                if (resultado.status=="ok"){
                    $("#"+bloque_id).hide('slow',function () { $(this).remove();});
                }else{
                    alert('Ocurrió algun error!'+resultado.status);
                }
            }
    });
}

$( "#dialog-multimedia" ).dialog({
                autoOpen: false,
                show: "blind",
		maxHeight: 600,
		maxWidth: 800,
                width:800,
                modal: true,
                open: function() {
                    multimedia_filtro_publicos=$("#mm_publicos").is(':checked');
                    multimedia_filtro_usados=$("#mm_nousados").is(':checked');
                    multimedia_filtro_categorias=$("#mm_categorias option:selected").val();
                    $.ajax({
                            type: "POST",
                            url: "/multimedias/carga_medios",
                            data: "tipo="+multimedia_tipo+"&modulo_id="+multimedia_modulo_id+
                                "&item_id="+multimedia_item_id+"&filtro_usados="+multimedia_filtro_usados+
                                "&filtro_categorias="+multimedia_filtro_categorias+
                                "&pagina_actual=1",
                            success: function(datos){
                                var resultado = $.parseJSON(datos);
                                if (resultado.status=="ok"){
                                    $("#mm_contenido").html(resultado.datos);
                                    $("#mm_paginacion").html(resultado.paginacion);
                                    // añadimos clicks a los enlaces nuevos
                                    click_adjunta_multimedia();
                                }else{
                                    alert('Ocurrió algun error!'+resultado.status);
                                }
                            }
                    });
                },
                buttons: {
                        Cerrar: function() {
                            $( this ).dialog( "close" );
                        }
                }
        });
        
$(".anadir_multimedia" ).button().click(function() { 
    //adquiriendo parametros
    var atributos= $(this).attr('rel');
    var obj_attr = $.parseJSON(atributos);
    multimedia_modulo_id=obj_attr.modulo_id;
    multimedia_item_id=obj_attr.item_id;
    multimedia_tipo=obj_attr.tipo;
    
    $( "#dialog-multimedia" ).dialog( "open" );
    
    var titulo='Multimedia: añadir '+multimedia_tipo+'... ';
    $("#dialog-multimedia").dialog( "option" , 'title' , titulo );
});

click_elimina_multimedia();
$("div:has(a.elimina_multimedia)").show('slow');

//para los filtros
$("#mm_nousados, #mm_categorias").bind('change',function(event){
    multimedia_filtro_publicos=$("#mm_publicos").is(':checked');
    multimedia_filtro_usados=$("#mm_nousados").is(':checked');
    multimedia_filtro_categorias=$("#mm_categorias option:selected").val();
    $.ajax({
            type: "POST",
            url: "/multimedias/carga_medios",
            data: "tipo="+multimedia_tipo+"&modulo_id="+multimedia_modulo_id+
                "&item_id="+multimedia_item_id+"&filtro_usados="+multimedia_filtro_usados+
                        "&filtro_categorias="+multimedia_filtro_categorias+
                        "&pagina_actual=1",
            success: function(datos){
                var resultado = $.parseJSON(datos);
                if (resultado.status=="ok"){
                    $("#mm_contenido").html(resultado.datos);
                    $("#mm_paginacion").html(resultado.paginacion);
                    // añadimos clicks a los enlaces nuevos
                    click_adjunta_multimedia();
                }else{
                    alert('Ocurrió algun error!'+resultado.status);
                }
            }
    });
});
$(".mm_paginacion" ).unbind('click');
$(".mm_paginacion").click(function(event){
    multimedia_filtro_publicos=$("#mm_publicos").is(':checked');
    multimedia_filtro_usados=$("#mm_nousados").is(':checked');
    multimedia_filtro_categorias=$("#mm_categorias option:selected").val();
    var current = event.target.id;
    var pagina = $('#'+current).attr('rel');
    $.ajax({
            type: "POST",
            url: "/multimedias/carga_medios",
            data: "tipo="+multimedia_tipo+"&modulo_id="+multimedia_modulo_id+
                "&item_id="+multimedia_item_id+"&filtro_usados="+multimedia_filtro_usados+
                        "&filtro_categorias="+multimedia_filtro_categorias+
                        "&pagina_actual="+pagina,
            success: function(datos){
                var resultado = $.parseJSON(datos);
                if (resultado.status=="ok"){
                    $("#mm_contenido").html(resultado.datos);
                    $("#mm_paginacion").html(resultado.paginacion);
                    // añadimos clicks a los enlaces nuevos
                    click_adjunta_multimedia();
                }else{
                    alert('Ocurrió algun error!'+resultado.status);
                }
            }
    });
});
//---------------------------------


//JPlayer
//-------
//Video
//<![CDATA[
$(document).ready(function(){
	$("#jquery_jplayer_video_detail").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				m4v: "http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer_480x270_h264aac.m4v",
				ogv: "http://cupcakephp.dev/app/webroot/upcontent/videos/TombRaiderTurningPointDebutTrailerSpanishVersion.ogg",
                                webmv: "http://cupcakephp.dev/app/webroot/upcontent/videos/TombRaiderTurningPointDebutTrailerSpanishVersion.webm",
				poster: "http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"
			});
		},
		ended: function (event) {
			$(this).jPlayer("play");
		},
		swfPath: "/app/webroot/js/jQuery.jPlayer.2.0.0/",
                solution: "html, flash",
		supplied: "ogv" //m4v, ogv
	});
});
//]]>
//-----
//audio
$("#jquery_jplayer_audio_detail").jPlayer({
        ready: function () {
            var atributos= $(this).attr('rel');
            var audio= atributos;
    
                $(this).jPlayer("setMedia", {
                        //m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
                        //oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg",
                        mp3: audio
                }).jPlayer("play");
        },
        ended: function (event) {
                $(this).jPlayer("play");
        },
        swfPath: "/app/webroot/js/jQuery.jPlayer.2.0.0/",
        solution: "flash,html",
        supplied: "mp3" //m4a,oga
});


//filtro del listado de imagenes
function filtrar_imagenes() {
      var value = $("#imagenes_categorias").val();
      window.location = "/imagenes/index/"+value;
}
$("#imagenes_categorias").change(filtrar_imagenes);

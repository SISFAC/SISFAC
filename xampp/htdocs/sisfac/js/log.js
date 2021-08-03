/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/

jQuery(document).ready(function(){
    
    jQuery("#usu").val('').keydown(function(e){
        if(e.keyCode == 13){
            jQuery("#pass").focus();
        }
    });
    jQuery("#pass").val('').keydown(function(e){
        if(e.keyCode==13) jQuery("#aceptar").click();
    });
    
    jQuery("#aceptar").click(function(){
        if(jQuery('#cbVista').val()==''){
            alert('Debe seleccionar un m\xf3dulo para acceder al sistema');
            return;
        }
        jQuery("#imgIndicador").show();
        jQuery.post("/sisfac/funcionesphp/log.php",{
            usu:jQuery("#usu").val(),
            pass:jQuery("#pass").val(),
            idvista:jQuery("#cbVista").val()
        },function(data){
            //alert(data)
            jQuery("#imgIndicador").hide();
            if(data=="Error"){
                jQuery("#alerta").show();
            }
            else document.location = data;
        });
    });
    
    jQuery("#cancelar").click(function(){
        jQuery("#usu").val('');
        jQuery("#pass").val('');
        jQuery("#alerta").hide();
    });
    
    
    
    //IMPORTA BD
    jQuery('#btnImportarBackupCompleta').button()
    
    
    f = new AjaxUpload(jQuery('form#formArchivos #btnImportarBackupCompleta'), {
        action: '/sisfac/funcionesphp/adminImportarBDCompleta.php',
        autoSubmit: true,
        name: 'userfile',
        onChange: function(file, extension){
            //jQuery('#rutarchivo').attr('src','/sigurmun/licconst/archivosLicencia/' + numeroExpediente + '/' +file);
        },
        onSubmit : function(file, ext){
            //ta='jpg|jpeg|png|pdf|dwg|dxf|avi|mp4|doc|docx|xls'
            if(ext && /^(txt|sql)$/.test(ext)){
                this.disable();
                jQuery('#aceptar,#cancelar,#btnImportarBackupCompleta').attr('disabled','disabled')
                interval = window.setInterval(function(){
                    var text = jQuery('#divFoto').text();
                    if (text.length < 13){
                        jQuery('#divFoto').text(text + '.');
                    } else {
                        jQuery('#divFoto').text('Cargando');
                    }
                }, 200);
                
            }
            else{
                alert('S\xf3lo se aceptan archivos de texto o sql');
                return false
            }
        },
        onComplete: function(file, response){
            this.enable();
            jQuery('#aceptar,#cancelar,#btnImportarBackupCompleta').removeAttr('disabled')
            if(response.indexOf('ERROR')>0){
                alert('Estamos terminando de cargar la base de datos. Espere unos segundos más')
            }else{
                alert('Estamos terminando de cargar la base de datos. Espere unos segundos más')
            }
            location.reload()
            //alert('La importacion se realizo con exito')

        }
    });
    
    
    
    
    
});

jQuery(window).load(function(){
    jQuery(".se-pre-con").fadeOut("slow");;    
})
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
/**
 * @author Gisela Muñoz
 * @description Funciones para los objetos de busqueda
 */

/**
 * Funcion de busqueda de persona natural y/o juridica y muestra el domicilio
 * fiscal de la persona
 * @param {jQuery} c Contenedor del grid
 * @param {Boolean} b Implementar barra de busquedas
 * @param {Boolean} e Implementar mantenimiento de los datos
 * @param {Function} osr Funcion para el evento onSelectRow
 */
var BuscarPersona = function(c,b,e,osr){
    m = 'BuscarPersona';
    var n = jQuery('body table[id^="lista' + m + '"]').length, oper='agregar';
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    crearDialogo(n);
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminPersona.php?f=1',
        datetype:'xml',
        colNames:['codPersona','Apellidos y nombres / Raz\xf3n social','Tipo Doc.','Nro Documento','RUC Persona Nat.','Domicilio Fiscal','Numero','Tipo'],
        colModel:[
            {name:'codper',index:'codper',width:50,hidden:true},
            {name:'desper',index:'desper',width:450},
            {name:'codtipdocide',index:'codtipdocide',width:120,align:'center',stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminTipDocIde.php?f=1'}
            },
            {name:'dniruc',index:'dniruc',width:130,align:'center'},
            {name:'rucpernatural',index:'rucpernatural',width:130,align:'center',hidden:true},
            {name:'direccion',index:'direccion',width:300},
            {name:'numero',index:'numero',width:80,hidden:true},
            {name:'tipo',index:'tipo',width:50,hidden:true}
        ],
        height:'auto',
        rowNum:5,
        rowList:[5,10,20,30],
        rownumbers:true,
        viewrecords:true,
        sortname:'codper',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Buscar personas',
        onSelectRow:function(rowid,status){
            if(rowid != null && osr != undefined) osr(rowid,status);
        },
        editurl:'/sigurmun/funcionesphp/adminPersona.php'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false},{},{},{
        modal:true,
        onclickSubmit : function(params, posdata) { 
            return {f:8,oper:''};
        },
        afterSubmit:function(response,postdata){
            alert(response.responseText);
            return [true,''];
        }
    });
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    if(e){
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Nuevo registro',buttonicon:'ui-icon-plus',
            onClickButton:function(){
                oper = 'agregar';
                limpiar();
                jQuery('#dialogPersona' + n).dialog('open');
            }
        });
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Editar registro',buttonicon:'ui-icon-pencil',
            onClickButton:function(){
                id = jQuery('#' + idlista).jqGrid('getGridParam','selrow');
                if(id == null){
                    alert('Seleccione un registro');
                    return;
                }
                limpiar();
                llenarDatos(id);
                oper = 'editar';
                jQuery('#dialogPersona' + n).dialog('open');
            }
        });
    }
    
    function crearDialogo(n){
        jQuery(c).append('<div id="dialogPersona' + n + '" title="Mantenimiento">\n\
            <input type="hidden" id="codper"/>\n\
            <table>\n\
                <tr>\n\
                    <td width="130" align="right">Tipo de persona</td><td width="130"><select id="tipo"><option value="PN">Persona natural</option><option value="PJ">Persona jur&iacute;dica</option></select></td>\n\
                    <td align="right">Tipo de documento</td><td><select id="codtipdocide"></select></td>\n\
                    <td align="right">N&ordm; de documento</td><td><input type="text" id="dniruc" maxlength="11"/></td>\n\
                </tr>\n\
            </table>\n\
            <table id="tablaPersonaNatural" border="0">\n\
                <tr>\n\
                    <td width="130" align="right">Nombre</td><td width="130"><input type="text" id="nomper"/></td>\n\
                    <td width="130" align="right">Apellido paterno</td><td width="130"><input type="text" id="apepat"/></td>\n\
                    <td width="130" align="right">Apellido materno</td><td width="130"><input type="text" id="apemat"/></td>\n\
                </tr>\n\
                <tr>\n\
                    <td align="right">Estado civil</td><td><select id="codestciv"></select></td>\n\
                    <td align="right">Sexo</td><td><select id="codsex"><option value="1">Maculino</option><option value="2">Femenino</option></select></td>\n\
                    <td align="right">RUC</td><td><input type="" id="rucpernatural"/></td>\n\
                </tr>\n\
                <!--tr>\n\
                    <td align="right">Fecha de nacimiento</td><td><input type="text" id="fecnac"/></td>\n\
                    <td align="right">Distrito</td><td colspan="3" style="width:390"><input type="text" id="distrito" style="width:100%"/><input type="hidden" id="giddis"/></td>\n\
                </tr-->\n\
            </table>\n\
            <table id="tablaPersonaJuridica" style="display: none;" border="0">\n\
                <tr>\n\
                    <td width="130" align="right">Tipo jur&iacute;dica</td><td width="130"><select id="codtipperjuridica"></select></td>\n\
                    <td width="130" align="right">SIGLAS</td><td width="390" colspan="3"><input type="text" id="sigla" style="width:100%"/></td>\n\
                </tr>\n\
                <tr style="display:none;">\n\
                    <td width="130" align="right">Descripci&oacute;n</td><td width="390" colspan="3"><input type="text" id="desotrtipperjur" style="width:100%"/></td>\n\
                </tr>\n\
                <tr>\n\
                    <td width="130" align="right">Raz&oacute;n social</td><td width="390" colspan="5"><input type="text" id="razsocial" style="width:100%;"/></td>\n\
                </tr>\n\
            </table>\n\
            <table id="tablaPersona">\n\
                <tr>\n\
                    <td align="right">Ciudad</td><td style="width:390"><input type="text" id="ciudad" style="width:95%"/></td>\n\
                    <td align="right">Calle</td><td><input type="text" id="calle" style="width:95%"/></td>\n\
                    <td align="right">N&uacute;mero</td><td><input type="text" id="numero" style="width:95%"/></td>\n\
                </tr>\n\
                <tr>\n\
                    <td width="130" align="right">Telefono</td><td width="130"><input type="text" id="telefono"/></td>\n\
                    <td width="130" align="right">Celular</td><td width="130"><input type="text" id="celular"/></td>\n\
                    <td align="right">RPM / RPC</td><td><input type="text" id="rpm_rpc"/></td>\n\
                </tr>\n\
                <tr>\n\
                    <!--td align="right">RENIEC</td><td><input type="text" id="codreniec" /></td-->\n\
                    <td align="right">Email</td><td colspan="3"><input type="text" id="email" style="width:100%"/></td>\n\
                </tr>\n\
                <tr>\n\
                </tr>\n\
            </table>\n\
            </div>');
        
        jQuery.post('/sigurmun/funcionesphp/adminDistrito.php', {f:3}, function(data){
            eval(data);
            jQuery('#dialogPersona'+n+' #ciudad').autocomplete({
                minLength: 1,
                source: distrito,
                focus: function(event,ui){
                    jQuery('#dialogPersona'+n+' #ciudad').val(ui.item.label);
                    return false;
                },
                select: function(event,ui) {
                    jQuery('#dialogPersona'+n+' #ciudad').val( ui.item.label );
                    return false;
                }
            }).data( "autocomplete" )._renderItem = function( ul, item ) {
                return jQuery( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
                .appendTo(ul);
            };
        });
        
        jQuery.post('/sigurmun/funcionesphp/adminVias.php', {f:4}, function(data){
            eval(data);
            jQuery('#dialogPersona'+n+' #calle').autocomplete({
                minLength: 1,
                source: via,
                focus: function(event,ui){
                    jQuery('#dialogPersona'+n+' #calle').val(ui.item.label);
                    return false;
                },
                select: function(event,ui) {
                    jQuery('#dialogPersona'+n+' #calle').val( ui.item.label );
                    return false;
                }
            });
        });
        
        jQuery('#dialogPersona'+n+' #fecnac').datepicker({dateFormat:'dd/mm/yy',changeYear:true,changeMonth:true});
        jQuery('#dialogPersona' + n + ' #codestciv').load('/sigurmun/funcionesphp/adminEstCivil.php', {f:1});
        jQuery('#dialogPersona' + n + ' #codtipdocide').load('/sigurmun/funcionesphp/adminTipDocIde.php',{f:2});
        jQuery('#dialogPersona' + n + ' #codtipperjuridica').load('/sigurmun/funcionesphp/adminTipPerJuridica.php',{f:1});
        
        jQuery('#dialogPersona' + n).dialog({
            modal:true,
            autoOpen:false,
            width:'auto',
            height:'auto',
            buttons:{
                'Guardar':function(){
                    if(esVacio(jQuery('#dialogPersona'+n+' #nomper'), 'NOMBRE') && jQuery('#dialogPersona' + n + ' #tipo').val() =='PN'){
                        alert('El campo NOMBRE no puede quedar vacio');
                        return;
                    }
                    else if(esVacio(jQuery('#dialogPersona'+n+' #apepat'), 'APELLIDO PATERNO') && jQuery('#dialogPersona' + n + ' #tipo').val() =='PN'){
                        alert('El campo APELLIDO PATERNO no puede quedar vacio');
                        return;
                    }
                    else if(esVacio(jQuery('#dialogPersona'+n+' #apemat'), 'APELLIDO MATERNO') && jQuery('#dialogPersona' + n + ' #tipo').val() =='PN'){
                        alert('El campo APELLIDO MATERNO no puede quedar vacio');return;
                    }
                    
                    jQuery.post('/sigurmun/funcionesphp/adminPersona.php',{
                        f:oper=='agregar'?3:4,
                        codper:jQuery('#dialogPersona' + n + ' #codper').val(),
                        tipo:jQuery('#dialogPersona' + n + ' #tipo').val(),
                        telefono:jQuery('#dialogPersona' + n + ' #telefono').val(),
                        celular:jQuery('#dialogPersona' + n + ' #celular').val(),
                        rpm_rpc:jQuery('#dialogPersona' + n + ' #rpm_rpc').val(),
                        codreniec:jQuery('#dialogPersona' + n + ' #codreniec').val(),
                        email:jQuery('#dialogPersona' + n + ' #email').val(),
                        codtipdocide:jQuery('#dialogPersona' + n + ' #codtipdocide').val(),
                        dniruc:jQuery('#dialogPersona' + n + ' #dniruc').val(),
                        rucpernatural:jQuery('#dialogPersona' + n + ' #rucpernatural').val(),
                        nomper:jQuery.trim(jQuery('#dialogPersona' + n + ' #nomper').val()),
                        apepat:jQuery.trim(jQuery('#dialogPersona' + n + ' #apepat').val()),
                        apemat:jQuery.trim(jQuery('#dialogPersona' + n + ' #apemat').val()),
                        codestciv:jQuery('#dialogPersona' + n + ' #codestciv').val(),
                        codsex:jQuery('#dialogPersona' + n + ' #codsex').val(),
                        fecnac:jQuery('#dialogPersona' + n + ' #fecnac').val(),
                        //giddis:jQuery('#dialogPersona' + n + ' #giddis').val(),
                        ciudad:jQuery('#dialogPersona' + n + ' #ciudad').val(),
                        calle:jQuery('#dialogPersona' + n + ' #calle').val(),
                        numero:jQuery('#dialogPersona' + n + ' #numero').val(),
                        codtipperjuridica:jQuery('#dialogPersona' + n + ' #codtipperjuridica').val(),
                        razsocial:jQuery.trim(jQuery('#dialogPersona' + n + ' #razsocial').val()),
                        desotrtipperjur:jQuery.trim(jQuery('#dialogPersona' + n + ' #desotrtipperjur').val()),
                        sigla:jQuery.trim(jQuery('#dialogPersona' + n + ' #sigla').val())
                    }, function(data){
                        alert(data);
                        if(data.indexOf('Error') == -1){
                            jQuery('#' + idlista).trigger('reloadGrid');
                            jQuery('#dialogPersona'+n).dialog('close');
                        } 
                    });
                },
                'Cancelar':function(){
                    jQuery('#dialogPersona'+n).dialog('close');
                }
            },
            open:function(){
                jQuery('#dialogPersona'+n).dialog('option','zIndex',jQuery(c).css('z-index')+1);
            }
        });
        
        jQuery('#dialogPersona'+n+' #tipo').change(function(){
            if(jQuery('#dialogPersona'+n+' #tipo').val()=='PN'){
                jQuery('#dialogPersona'+n+' #tablaPersonaNatural').show();
                jQuery('#dialogPersona'+n+' #tablaPersonaJuridica').hide();
                conteclaenter();
            }
            else{
                jQuery('#dialogPersona'+n+' #tablaPersonaNatural').hide();
                jQuery('#dialogPersona'+n+' #tablaPersonaJuridica').show();
            }
        });
        jQuery('#dialogPersona'+n+' #codtipperjuridica').change(function(){
            if( jQuery('#dialogPersona'+n+' #codtipperjuridica option:last').attr('value') == jQuery('#dialogPersona'+n+' #codtipperjuridica').val() ){
                jQuery('#dialogPersona'+n+' #desotrtipperjur').parent().parent().show();
            }
            else jQuery('#dialogPersona'+n+' #desotrtipperjur').parent().parent().hide();
        });
    }
    
    function llenarDatos(id){
        jQuery.post('/sigurmun/funcionesphp/adminPersona.php', {f:2,codPersona:id}, function(data){
            eval(data);
            jQuery('#dialogPersona' + n + ' #codper').val(codper);
            jQuery('#dialogPersona' + n + ' #tipo').val(tipo).trigger('change');
            jQuery('#dialogPersona' + n + ' #telefono').val(telefono);
            jQuery('#dialogPersona' + n + ' #celular').val(celular);
            jQuery('#dialogPersona' + n + ' #rpm_rpc').val(rpm_rpc);
            jQuery('#dialogPersona' + n + ' #codreniec').val(codreniec);
            jQuery('#dialogPersona' + n + ' #email').val(email);
            jQuery('#dialogPersona' + n + ' #codtipdocide').val(codtipdocide).change();
            jQuery('#dialogPersona' + n + ' #dniruc').val(dniruc);
            jQuery('#dialogPersona' + n + ' #rucpernatural').val(rucpernatural);
            jQuery('#dialogPersona' + n + ' #nomper').val(nomper);
            jQuery('#dialogPersona' + n + ' #apepat').val(apepat);
            jQuery('#dialogPersona' + n + ' #apemat').val(apemat);
            jQuery('#dialogPersona' + n + ' #codestciv').val(codestciv);
            jQuery('#dialogPersona' + n + ' #codsex').val(codsex);
            jQuery('#dialogPersona' + n + ' #ciudad').val(ciudad);
            jQuery('#dialogPersona' + n + ' #calle').val(calle);
            jQuery('#dialogPersona' + n + ' #numero').val(numero);
            try {
                if(fecnac != '')jQuery('#dialogPersona' + n + ' #fecnac').val(fecnac.split('-')[2] + '/' + fecnac.split('-')[1] + '/' + fecnac.split('-')[0]);
                //jQuery('#dialogPersona' + n + ' #distrito').val(nomdis);
                //jQuery('#dialogPersona' + n + ' #giddis').val(giddis);
            }catch (exception) {}
            if(tipo == 'PJ'){
                jQuery('#dialogPersona' + n + ' #codtipperjuridica').val(codtipperjuridica).trigger('change');
                jQuery('#dialogPersona' + n + ' #sigla').val(sigla);
                jQuery('#dialogPersona' + n + ' #razsocial').val(razsocial);
                jQuery('#dialogPersona' + n + ' #desotrtipperjur').val(desotrtipperjur);
            }
        });
    }
    
    function limpiar(){
        jQuery('#codtipdocide,#dniruc,#nomper,#apepat,#apemat,#codestciv,#codsex,#rucpernatural,#ciudad,#calle,#numero').val('');
        jQuery('#telefono,#celular,#rpm_rpc,#email,#codtipperjuridica,#sigla,#razsocial').val('')
        jQuery('#tipo').val('PN').change();
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.mostrarColumna = function(cols){
        return jQuery('#' + idlista).jqGrid('showCol',cols);
    }
    
    this.obtenerGrid = function(){
        return jQuery('#' + idlista)[0];
    }
}

var BuscarPersonaNatural = function(c,d){
    m = 'BuscarPersonaNatural';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    if(d) dfpn = new DomicilioFiscal(c, 'pn');
    jQuery("#" + idlista).jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminPerNatural.php?f=1',
        datatype: "xml",
        colNames:['Codigo','Apellidos y nombres','Tip. Doc.','N&ordm Doc.'],
        colModel:[
            {name:'codper',index:'codper', width:55,hidden:true},
            {name:'nombreCompleto',index:'nombreCompleto', width:250},
            {name:'codtipdocid',index:'codtipdocid', width:70},
            {name:'nrodocide',index:'nrodocide', width:120}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'codper',
        sortorder: "asc",
        caption:"Personas naturales",
        pager:'#' + idpager,
        pginput:false,
        onSelectRow:function(rowid,status){
            if(rowid!=null){
                fila = jQuery("#" + idlista).jqGrid('getRowData',rowid);
                if(d) dfpn.actualizar(fila.codper);
            }
        }
    });
    jQuery("#" + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    jQuery("#" + idlista).jqGrid('filterToolbar');
    jQuery('#gs_codper,#gs_nombreCompleto,#gs_codtipdocid,#gs_nrodocide').keyup(function(e){
        jQuery('#' + idlista)[0].triggerToolbar();
    });
    jQuery("#" + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Nueva persona',buttonicon:'ui-icon-person',
        onClickButton:function(){
            window.open('/sigurmun/catastro/admPersona.php','','toolbar=false');
        }
    });

    this.obtenerId = function(){
        fila = jQuery("#" + idlista).jqGrid('getRowData',jQuery("#" + idlista).jqGrid('getGridParam','selrow'));
        return fila.codper;
    }

    this.limpiarSeleccion = function(){
        jQuery('#' + idlista).jqGrid('resetSelection');
    }
    
    this.obtenerFilaSeleccinada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
}

var BuscarPersonaJuridica = function(c,d){
    m = 'BuscarPersonaJuridica';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    //dfpj = new DomicilioFiscal(c, 'pj');
    jQuery("#" + idlista).jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminPerJuridica.php?f=1',
        datatype: "xml",
        colNames:['Codigo','Raz&oacute;n Social','N&ordm RUC'],
        colModel:[
            {name:'persona_id',index:'persona_id', width:55,hidden:true},
            {name:'razsocial',index:'razsocial', width:300},
            {name:'nroruc',index:'nroruc', width:180}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'razonsocial',
        sortorder: "asc",
        pager:'#' + idpager,
        pginput:false,
        caption:"Personas jur&iacute;dicas",
        onSelectRow:function(rowid,status){
            if(rowid!=null){
                fila = jQuery("#" + idlista).jqGrid('getRowData',rowid);
                //if(d) dfpj.actualizar(fila.persona_id);
            }
        }
    });
    jQuery("#" + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    jQuery("#" + idlista).jqGrid('filterToolbar');
    jQuery('#gs_persona_id,#gs_razsocial,#gs_nroruc').keyup(function(e){
        jQuery('#listaBuscarPersonaJuridica' + idlista)[0].triggerToolbar();
    });
    jQuery("#" + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Nueva persona',buttonicon:'ui-icon-person',
        onClickButton:function(){
            window.open('/sigurmun/catastro/admPersona.php','','toolbar=false');
        }
    });

    //if(d) dfpj.init();

    this.obtenerId = function(){
        fila = jQuery("#" + idlista).jqGrid('getRowData',jQuery("#" + idlista).jqGrid('getGridParam','selrow'));
        return fila.persona_id;
    }

    this.limpiarSeleccion = function(){
        jQuery('#' + idlista).jqGrid('resetSelection');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
}

var DomicilioFiscal = function(c,s){
    m = 'DomicilioFiscal' + s;
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).append('<table id="' + idlista + '"></table><div id="' + idpager + '"><div>');
    jQuery("#" + idlista).jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminDomFiscal.php?f=1&codPersona=0',
        datatype: "xml",
        colNames:['id','Ubigeo','Via','N&uacute;mero','Edificio','N&ordm; Interior','Fecha registro','Actual','idPersona'],
        colModel:[
            {name:'id',index:'id', width:150, hidden:true},
            {name:'ubigeo',index:'ubigeo', width:150,hidden:true},
            {name:'calle',index:'calle', width:300},
            {name:'num_mun',index:'num_mun', width:60},
            {name:'nom_edi',index:'nom_edi', width:120},
            {name:'nro_int',index:'nro_int', width:80},
            {name:'fecregistro',index:'fecregistro',width:120,hidden:true,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'}
            },
            {name:'codest',index:'codest', width:60},
            {name:'ide_per',index:'ideper', width:120,hidden:true}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'id',
        sortorder: "asc",
        pager:'#' + idpager,
        pginput:false,
        caption:"Domicilio fiscal"
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    
    this.actualizar = function(cp){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminDomFiscal.php?f=1&codPersona=' + cp}).trigger('reloadGrid');
    }
}

var BuscarContribuyente = function(c,b,a,osr){
    m = 'Contribuyente';
    var n = jQuery('body table[id^="lista' + m + '"]').length, oper='agregar';
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    if(a) crearDialogo(n);
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminContribuyente.php?f=2',
        datetype:'xml',
        colNames:['C\xf3digo','codPersona','Apellidos y nombres / Razon Social','Apellidos y nombres / Razon Social','Tipo Doc.','Nro Documento','Domicilio fiscal','Estado'],
        colModel:[
            {name:'codigo',index:'codigo',width:50},
            {name:'codper',index:'codper',width:250,hidden:true},
            {name:'contrib',index:'contrib',width:400},
            {name:'desper',index:'desper',width:400,hidden:true},
            {name:'codtipdocide',index:'codtipdocide',width:70,align:'center',stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminTipDocIde.php?f=1'}
            },
            {name:'dniruc',index:'dniruc',width:120},
            {name:'direccion',index:'direccion',width:300},
            {name:'codest',index:'codest',width:70,align:'center',stype:'select',
                editoptions:{value:'AC:Activo;IN:Inactivo;:Todos'}
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[10,15,20,30],
        rownumbers:true,
        viewrecords:true,
        sortname:'codigo',
        pager:'#' + idpager,
        sortorder:'asc',
        caption:'Contribuyentes',
        onSelectRow:function(rowid,status){
            if(osr != undefined) osr();
        },
        afterInsertRow:function(rowid,rowdata,rowelem){
            if(rowdata.codest=='AC') jQuery('#' + idlista).jqGrid('setCell',rowid,'codest','<input type="checkbox" checked disabled/>',{});
            else jQuery('#' + idlista).jqGrid('setCell',rowid,'codest','<input type="checkbox" disabled/>',{});
        }
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    /*jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Habilitar',buttonicon:'ui-icon-check',
        onClickButton:function(){
            id = jQuery('#' + idlista).jqGrid('getGridParam','selrow');
            if(id==null){
                alert('Seleccione un registro');
                return;
            }
            jQuery.post('/sigurmun/funcionesphp/adminContribuyente.php', {f:3,codContribuyente:id}, function(data){
                jQuery('#' + idlista).trigger('reloadGrid');
            });
        }
    });*/
    if(a){
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Agregar',buttonicon:'ui-icon-plus',
            onClickButton:function(){
                limpiarDatos();
                oper='agregar';
                jQuery('dialogNuevoContribuyente' + n).dialog(n);
            }
        });
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Editar',buttonicon:'ui-icon-pencil',
            onClickButton:function(){
                llenarDatos();
                oper:'editar';
                jQuery('dialogNuevoContribuyente' + n).dialog(n);
            }
        });
    }
    
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    function crearDialogo(n){
        jQuery(c).append('<div id="dialogNuevoContribuyente'+n+'">\n\
            \n\
        </div>');
        jQuery('#dialogNuevoContribuyente' + n).dialog({
            modal:true,
            autoOpen:false,
            width:'auto',
            height:'auto',
            buttons:{
                'Cerrar':function(){
                    jQuery('#dialogNuevoContribuyente' + n).dialog('close');
                }
            }
        });
    }

    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }

    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.obtenerGrid = function(){
        return jQuery('#' + idlista);
    }
}

var BuscarCalle = function(c,gilu,cfc){
    jQuery(c).html('\n\
        <table width="100%" border="0">\n\
            <tr>\n\
                <td colspan="2">\n\
                    Distancia:&nbsp;&nbsp;\n\
                    <input type="text" id="tbDistancia" size="2" value="5"/>metros&nbsp;&nbsp;\n\
                    <button id="btnBuscarCalle">Buscar</button>\n\
                </td>\n\
                <td rowspan="2" id="tdImagenReducida">\n\
                </td>\n\
            </tr>\n\
            <tr>\n\
                <td valign="top">\n\
                    <table id="listaPuerta"></table>\n\
                    <div id="pagerPuerta"></div>\n\
                </td>\n\
                <td valign="top" style="padding-left: 20px">\n\
                    <table id="listaBuscarCalle"></table>\n\
                    <div id="pagerBuscarCalle"></div>\n\
                </td>\n\
            </tr>\n\
            <tr>\n\
                <td colspan="3" style="padding-right: 30px">\n\
                    <table id="listaCalle"></table>\n\
                    <div id="pagerCalle"></div>\n\
                </td>\n\
            </tr>\n\
        </table>\n\
        <div id="dialogPuerta" title="Ubicaci&oacute;n del predio" style="display: none;">\n\
        <table border="0">\n\
            <tr>\n\
                <td>Lado</td>\n\
                <td>\n\
                    <select id="cbLadoPuerta">\n\
                        <option value="IM">Izquierdo</option>\n\
                        <option value="PA">Dereho</option>\n\
                    </select>\n\
                </td>\n\
            </tr>\n\
            <tr>\n\
                <td>N&ordm; Certificado Numeraci&oacute;n</td>\n\
                <td><input type="text" id="tbNroCertificadoNumeracion"/></td>\n\
            </tr>\n\
        </table>\n\
    </div>\n\
    ');

    ir = new ImagenReducida(jQuery('#tdImagenReducida', jQuery(c)));

    jQuery("#listaPuerta").jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminPuerta.php?f=1&gIdLoteUrb=' + gilu,
        datatype: "xml",
        colNames:['Codigo Puerta','Tipo','N&uacute;mero','CodConNum','Cond. Numeraci&oacute;n','Estado'],
        colModel:[
            {name:'gidpue',index:'gidpue', width:55, hidden:true},
            {name:'destippue',index:'destippue', width:100},
            {name:'num_mun',index:'num_mun', width:80},
            {name:'codconnum',index:'codconnum', width:50,hidden:true},
            {name:'desconnum',index:'desconnum', width:250,hidden:true},
            {name:'estpue',index:'estpue', width:60,align:'center',hidden:true}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'codvia',
        viewrecords: false,
        sortorder: "asc",
        pager:'#pagerPuerta',
        pginput:false,
        caption:"Puertas del lote",
        onSelectRow:function(rowid,status){
            fila = jQuery("#listaPuerta").jqGrid('getRowData',rowid);
            jQuery("#listaBuscarCalle").jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminVias.php?f=1&distancia=' + jQuery('#tbDistancia').val() + '&gIdPuerta=' + fila.gidpue}).trigger('reloadGrid');
        }
    });
    jQuery("#listaPuerta").jqGrid('navGrid','#pagerPuerta',{edit:false,add:false,del:false,search:false,view:false});

    jQuery("#listaBuscarCalle").jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminVias.php?f=1&gIdPuerta=0&distancia=' + jQuery('#tbDistancia').val(),
        datatype: "xml",
        colNames:['idDetVia','Codigo V&iacute;a','V&iacute;a','gIdDis'],
        colModel:[
            {name:'giddetvia',index:'giddetvia',width:50,hidden:true},
            {name:'codvia',index:'codvia', width:55,hidden:true},
            {name:'calles',index:'calles', width:250},
            {name:'giddis',index:'giddis', width:120,hidden:true}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'codvia',
        viewrecords: false,
        pager:'#pagerBuscarCalle',
        pginput:false,
        sortorder: "asc",
        caption:"Calles"
    });
    jQuery('#listaBuscarCalle').jqGrid('navGrid','#pagerBuscarCalle',{edit:false,add:false,del:false,search:false,view:false});
    jQuery('#listaBuscarCalle').jqGrid('navButtonAdd','#pagerBuscarCalle',{caption:'',title:'Asignar calle',buttonicon:'ui-icon-check',
        onClickButton:function(){
            if(jQuery('#listaBuscarCalle').jqGrid('getGridParam','selrow')==null){
                alert('Seleccione un registro');
            }
            else{
                jQuery('#dialogPuerta').dialog('open');
            }
        }
    });
    
    jQuery('#btnBuscarCalle').button({icons:{primary:'ui-icon-search'}}).click(function(){
        jQuery("#listaBuscarCalle").jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminVias.php?f=2&distancia=' + jQuery('#tbDistancia').val() + '&gIdLoteUrb=' + gilu});
        jQuery("#listaBuscarCalle").jqGrid('setCaption','Calles a ' + jQuery('#tbDistancia').val() + ' metros').trigger('reloadGrid');
        jQuery('#listaPuerta').jqGrid('resetSelection');
    });

    jQuery("#listaCalle").jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminUbiPreUrbano.php?f=1&codFichaCatastral=' + cfc,
        datatype: "xml",
        colNames:['id','idVia','Via','Lado','Tipo Puerta','Nro municipal','Condici&oacute;n numeraci&oacute;n','Nro certificado numeraci&oacute;n','Estado','CodFicCat'],
        colModel:[
            {name:'idcor',index:'idcor', width:55, hidden:true},
            {name:'giddetvia',index:'giddetvia', width:210,hidden:true},
            {name:'calle',index:'calle', width:220},
            {name:'codlado',index:'codlado', width:120},
            {name:'destippue',index:'destippue', width:120},
            {name:'num_mun',index:'num_mun', width:100,align:'center'},
            {name:'desconnum',index:'desconnum', width:280},
            {name:'nro_cer_num',index:'nro_cer_num', width:130,hidden:true},
            {name:'codest',index:'codest', width:85,align:'center'},
            {name:'codficcat',index:'codficcat', width:120,hidden:true}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'idcor',
        sortorder: "asc",
        pager:'#pagerCalle',
        pginput:false,
        caption:"Ubicaci&oacute;n del predio catastral",
        afterInsertRow:function(rowid,rowdata,rowelem){
            if(rowdata.codlado=='IM') jQuery("#listaCalle").jqGrid('setCell',rowid,'codlado','IZQUIERDA',{});
            else jQuery("#listaCalle").jqGrid('setCell',rowid,'codlado','DERECHA',{});
            if(rowdata.codest=='AC') jQuery("#listaCalle").jqGrid('setCell',rowid,'codest','<input type="checkbox" checked disabled/>',{});
            else jQuery("#listaCalle").jqGrid('setCell',rowid,'codest','<input type="checkbox" disabled/>',{});
        },
        editurl:'/sigurmun/funcionesphp/adminUbiPreUrbano.php'
    });
    jQuery("#listaCalle").jqGrid('navGrid','#pagerCalle',{edit:false,add:false,del:true,search:false,view:false});
    jQuery('#listaCalle').jqGrid('navButtonAdd','#pagerCalle',{caption:'',buttonicon:'ui-icon-cancel',
        onClickButton:function(){
            rowid = jQuery('#listaCalle').jqGrid('getGridParam','selrow');
            if(rowid==null){
                alert('Seleccione un registro');
            }
            else{
                fila = jQuery('#listaCalle').jqGrid('getRowData',rowid);
                if(fila.codest.toString().indexOf('checked')==-1){
                    alert('El registro ya se encuentra inactivo');
                }
                else{
                    jQuery.post('/sigurmun/funcionesphp/adminUbiPreUrbano.php', {f:3,id:rowid}, function(data){
                        jQuery('#listaCalle').trigger('reloadGrid');
                    });
                }
            }
        }
    });

    jQuery('#dialogPuerta').dialog({
        autoOpen:false,
        modal:true,
        width:350,
        height:150,
        buttons:{
            'Aceptar':function(){
                continuar = true;
                if(continuar){
                    filaPuerta = jQuery('#listaPuerta').jqGrid('getRowData',jQuery('#listaPuerta').jqGrid('getGridParam','selrow'));
                    filaBuscarCalle = jQuery('#listaBuscarCalle').jqGrid('getRowData',jQuery('#listaBuscarCalle').jqGrid('getGridParam','selrow'));
                    jQuery.post('/sigurmun/funcionesphp/adminUbiPreUrbano.php', {
                        f:2,
                        codFicCat:jQuery('#tbCodFichaCatastral').val(),
                        gIdDetVia:filaBuscarCalle.giddetvia,
                        gIdPue:(jQuery('#listaPuerta').jqGrid('getGridParam','selrow')==null)?'':filaPuerta.gidpue,
                        nroCerNum:jQuery('#tbNroCertificadoNumeracion').val(),
                        codLado:jQuery('#cbLadoPuerta').val()
                    }, function(data){
                        alert(data);
                        jQuery('#dialogPuerta').dialog('close');
                        jQuery("#listaCalle").trigger('reloadGrid');
                    });
                }
            },
            'Cancelar':function(){
                jQuery(this).dialog('close');
            }
        }
    });
}

var BuscarUsos = function(c,cfc){
    m = 'BuscarUsos';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery("#" + idlista).jqGrid({
        height: 'auto',
        url:'/sigurmun/funcionesphp/adminActividadesEconomicas.php?f=1&codActividadEconomica='+jQuery('#cbActividadEconomica').val(),
        datatype: "xml",
        colNames:['Usos espec&iacute;ficos','COD. USO ESP.','COD. USO DET.','COD. USO GEN.'],
        colModel:[
            {name:'desusoespecificos',index:'desusoespecificos', width:400},
            {name:'codusoespecificos',index:'codusoespecificos', width:100},
            {name:'codusodetallados',index:'codusodetallados', width:100},
            {name:'codusogenerales',index:'codusogenerales', width:100}
        ],
        autowidth:false,
        rowNum:5,
        sortname: 'codusogenerales',
        sortorder: "asc",
        pager:'#' + idpager,
        pginput:false,
        caption:"Usos y actividades econ&oacute;micas",
        toolbar:[true,"top"],
        onSelectRow:function(rowid,status){
            if(rowid!=null){
                selrow = jQuery('#listaBuscarUsos' + idlista).jqGrid('getRowData',rowid);
            }
        }
    });
    jQuery("#" + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    jQuery("#" + idlista).jqGrid('filterToolbar');
    jQuery('#gs_desusoespecificos,#gs_codusoespecificos,#gs_codusodetallados,#gs_codusogenerales').keyup(function(e){
        jQuery('#' + idlista)[0].triggerToolbar();
    });
    jQuery("#t_" + idlista).append('<center>Buscar por Actividades Econ&oacute;micas  <select id=\'cbActividadEconomica\'></select></center>');
    jQuery('#cbActividadEconomica').load('/sigurmun/funcionesphp/adminActividadesEconomicas.php', {f:2}).change(function(){
        jQuery("#" + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminActividadesEconomicas.php?f=1&codActividadEconomica='+jQuery('#cbActividadEconomica').val()}).trigger('reloadGrid');
    });
    jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Asignar uso',buttonicon:'ui-icon-check',
        onClickButton:function(){
            if( jQuery("#" + idlista).jqGrid('getGridParam','selrow')==null ){
                alert('No ha seleccionado ning\xfan registro');
            }
            else{
                ids = jQuery("#listaUsoPredio").jqGrid('getDataIDs');
                for (i in ids){
                    if (jQuery("#listaUsoPredio").jqGrid('getRowData',ids[i]).codest.toString().indexOf('checked')!=-1){
                        alert('No puede realizar esta acci\xf3n. Actualmente hay un uso predominante activo en el lote');
                        return;
                    }
                }
                id = jQuery("#" + idlista).jqGrid('getGridParam','selrow');
                for (i in ids){
                    if (ids[i].split('-')[3] == id){
                        alert('El registro ya esta ingresado');
                        return;
                    }
                }
                fila = jQuery("#" + idlista).jqGrid('getRowData',jQuery("#" + idlista).jqGrid('getGridParam','selrow'));
                jQuery.post('/sigurmun/funcionesphp/adminUsoPreUrbano.php', {
                    f:2,
                    codficcat:cfc,
                    codusogenerales:fila.codusogenerales,
                    codusodetallados:fila.codusodetallados,
                    codusoespecificos:fila.codusoespecificos
                }, function(data){
                    alert(data);
                    jQuery("#listaUsoPredio").trigger('reloadGrid');
                });
            }
        }
    });
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
}

var BuscarLicenciaFuncionamiento = function(c,cfc){
    m = 'BuscarLicenciaFuncionamiento';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminLicFuncionamiento.php?f=1',
        datetype:'xml',
        colNames:['idLicenciaFuncionamiento','N&ordm; Licencia','Raz&oacute;n Social','RUC','Nombre Comercial'],
        colModel:[
            {name:'licfuncionamiento_id',index:'licfuncionamiento_id',width:50,hidden:true},
            {name:'cod_lic_fun_mpc',index:'cod_lic_fun_mpc',width:120},
            {name:'razsocial',index:'razsocial',width:200},
            {name:'nroruc',index:'nroruc',width:100},
            {name:'nomcomercial',index:'nomcomercial',width:200,hidden:true}
        ],
        height:'auto',
        rowNum:5,
        sortname:'licfuncionamiento_id',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'B&uacute;squeda de licencias',
        onSelectRow:function(rowid,status){
            if(rowid!=null){
                selrow = jQuery('#' + idlista).jqGrid('getRowData',rowid);
            }
        }
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',buttonicon:'ui-icon-check',
        onClickButton:function(){
            id = jQuery('#' + idlista).jqGrid('getGridParam','selrow');
            if(id==null){
                alert('Debe seleccionar un registro primero');
                return;
            }
            else{
                fila = jQuery('#' + idlista).jqGrid('getRowData',id);
                jQuery.post('/sigurmun/funcionesphp/adminLicFuncionamiento.php', {
                    oper:'add',
                    licfuncionamiento:fila.licfuncionamiento_id,
                    codFichaCatastral:cfc
                }, function(data){
                    alert(data);
                    //jQuery('#' + idlista).trigger('reloadGrid');
                });
            }
        }
    });
}

var BuscarTipoTramite = function(c,b,func){
    m = 'BuscarTipoTramite';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminTipTramite.php?f=2',//1=SLE
        datetype:'xml',
	colNames:['codtiptra','Descripcion'],
	colModel:[
            {name:'codtiptra',index:'codtiptra',width:50,hidden:true,editable:true},
            {name:'destiptra',index:'destiptra',width:600},
	],
        autowidth:true,
        height:'auto',
        rowNum:10,
        sortname:'',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        caption:'Tipo Tramite',
        onSelectRow:function(rowid,status){
            if(rowid != null){
                func();
            }
        }
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false},{
        modal:true,
        width:500
    },{
        modal:true,
        width:500		
    });
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarDetalleDeTramite = function(c,b){
    m = 'BuscarDetalleDeTramite';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminTipHue.php?f=2&codtiptra=0&codmodapr=0',
        datetype:'xml',
        colNames:['codtiphue','Tipo de Obra','codmodapr','Modalidad de Aprobacion','Calificacion','Plazo Resolver'],
        colModel:[
            {name:'codtiphue',index:'codtiphue',width:50,hidden:true},
            {name:'destiphue',index:'destiphue',widht:270},
            {name:'codmodapr',index:'codmodapr',width:750,hidden:true},
            {name:'desmodapr',index:'desmodapr',width:450},
            {name:'tipcalific',index:'tipcalific',width:100,formatter:'select',stype:'select',
                editoptions:{value:'A:AUTOMATICO;P:POSITIVO;N:NEGATIVO'}
            },
            {name:'plazoresolv',index:'plazoresolv',width:100,align:'right'},
        ],
        height:'auto',
        rowNum:5,
        sortname:'codtiphue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        caption:'Tipo de Obra',
        editurl:'/sigurmun/funcionesphp/adminTipHue.php'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(ctt){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminTipHue.php?f=2&codtiptra=' + ctt}).trigger('reloadGrid');
    }
}

var BuscarViaCuadra = function(c,b){
    m = 'BuscarViaCuadra';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    
    jQuery('#'+ idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminVias.php?f=6',
        datetype:'xml',
        colNames:['codvia','detvia','Calle','Nro Cuadra'],
        colModel:[
            {name:'codvia',index:'codvia',width:50,hidden:true},
            {name:'giddetvia',index:'giddetvia',width:80,hidden:true},
            {name:'calle',index:'calle',width:500},
            {name:'nrocuadra',index:'nrocuadra',width:100},
        ],
        height:'auto',
        rowNum:5,
        sortname:'gidloturb',
        pager:'#' + idpager,
        pginput:false,
        viewrecords:true,
        sortorder:'asc',
        caption:'Calles'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
}

var BuscarContribuyenteMas = function(c,b,a,osr){
    m = 'Contribuyente';
    var n = jQuery('body table[id^="lista' + m + '"]').length, oper='agregar';
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    if(a) crearDialogo(n);
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminContribuyente.php?f=2',
        datetype:'xml',
        colNames:['C\xf3digo','codPersona','Apellidos y nombres / Razon Social','Apellidos y nombres / Razon Social','Tipo Doc.','Nro Documento','Domicilio fiscal','Estado'],
        colModel:[
            {name:'codigo',index:'codigo',width:50},
            {name:'codper',index:'codper',width:250,hidden:true},
            {name:'contrib',index:'contrib',width:400},
            {name:'desper',index:'desper',width:400,hidden:true},
            {name:'codtipdocide',index:'codtipdocide',width:70,align:'center',stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminTipDocIde.php?f=1'}
            },
            {name:'nrodocide',index:'nrodocide',width:120},
            {name:'direccion',index:'direccion',width:300},
            {name:'codest',index:'codest',width:70,align:'center',stype:'select',
                editoptions:{value:'AC:Activo;IN:Inactivo;:Todos'}
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        viewrecords:true,
        sortname:'codigo',
        pager:'#' + idpager,
        sortorder:'asc',
        caption:'Contribuyentes',
        onSelectRow:function(rowid,status){
            if(osr != undefined) osr();
        },
        afterInsertRow:function(rowid,rowdata,rowelem){
            if(rowdata.codest=='AC') jQuery('#' + idlista).jqGrid('setCell',rowid,'codest','<input type="checkbox" checked disabled/>',{});
            else jQuery('#' + idlista).jqGrid('setCell',rowid,'codest','<input type="checkbox" disabled/>',{});
        }
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    /*jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Habilitar',buttonicon:'ui-icon-check',
        onClickButton:function(){
            id = jQuery('#' + idlista).jqGrid('getGridParam','selrow');
            if(id==null){
                alert('Seleccione un registro');
                return;
            }
            jQuery.post('/sigurmun/funcionesphp/adminContribuyente.php', {f:3,codContribuyente:id}, function(data){
                jQuery('#' + idlista).trigger('reloadGrid');
            });
        }
    });*/
    if(a){
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Agregar',buttonicon:'ui-icon-plus',
            onClickButton:function(){
                limpiarDatos();
                oper='agregar';
                jQuery('dialogNuevoContribuyente' + n).dialog(n);
            }
        });
        jQuery('#' + idlista).jqGrid('navButtonAdd','#' + idpager,{caption:'',title:'Editar',buttonicon:'ui-icon-pencil',
            onClickButton:function(){
                llenarDatos();
                oper:'editar';
                jQuery('dialogNuevoContribuyente' + n).dialog(n);
            }
        });
    }
    
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    function crearDialogo(n){
        jQuery(c).append('<div id="dialogNuevoContribuyente'+n+'">\n\
            \n\
        </div>');
        jQuery('#dialogNuevoContribuyente' + n).dialog({
            modal:true,
            autoOpen:false,
            width:'auto',
            height:'auto',
            buttons:{
                'Cerrar':function(){
                    jQuery('#dialogNuevoContribuyente' + n).dialog('close');
                }
            }
        });
    }

    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }

    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarLicencias = function(c,b,opc,anio,q){
    m = 'BuscarSolicitudLicencia';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=4&opc='+opc+'&aniofiscal='+anio+'&codtipsol='+q,
        datetype:'xml',
        colNames:['codlichue','Nro Res. Lic. Edificaci&oacute;n','Fec. Reso.','Nro. Exp.','Fec. Exp.','Fec. Ini.','Tip. Tra.','Tip. Tra.','Modalidad','Modalidad'],
        colModel:[
            {name:'codlichue',index:'codlichue',width:50,hidden:true,editable:true},
            {name:'nombasleg',index:'nombasleg',width:150},
            {name:'fecexpbasleg',index:'fecexpbasleg',width:80},
            {name:'nroexp',index:'nroexp',width:50,editable:true},
            {name:'fecexp',index:'fecexp',width:60,formatter:'date'},
            {name:'fecinicio',index:'fecinicio',width:60,editable:true,formatter:'date'},
            {name:'coddetts',index:'coddetts',width:350,editable:true,hidden:true},
            {name:'desdetts',index:'desdetts',width:300},
            {name:'codmodapr',index:'codmodapr',width:350,hidden:true},
            {name:'desmodapr',index:'desmodapr',width:200,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminModAprob.php?f=1',
                    dataInit:function(el){
                        jQuery(el).width(200)
                    }
                }
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codlichue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Expedientes',
        toolbar:[true,'top']
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    jQuery("#t_" + idlista).append('<center>B&uacute;squeda por A&ntilde;o Fiscal: <select id=\'cbAnioFiscal' + n + '\'></select></center>');
    jQuery('#cbAnioFiscal' + n).load('/sigurmun/funcionesphp/adminAnioFiscal.php', {f:2}).change(function(){
        jQuery("#" + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=4&aniofiscal='+jQuery('#cbAnioFiscal' + n).val()+'&opc='+opc + '&codtipsol=' + q}).trigger('reloadGrid');
    });
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarProfesional = function(c,b){
    m = 'BuscarProfesional';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    var codigoPersona=0,codigoTipoProfesion=0
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminProfesional.php?f=2',
        datetype:'xml',
        colNames:['Ape. y Nom. del Profesional','Ape. y Nom. del Profesional','codprof','Profesional','Profesional','Nro CIP/CAP Nacional','Nro CIP/CAP Regional','Telefono','Celular','RPM\RPC','codtippro'],
        colModel:[
            {name:'codper',index:'codper',hidden:true,editable:true},
            {name:'desper',index:'desper',width:250,editable:true,
                editrules:{edithidden:true},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).width(200),
                        jQuery(el).autocomplete({
                            source: "/sigurmun/funcionesphp/adminPersona.php?f=6&limit=11",
                            minLength: 3,
                            focus:function(event,ui){
                                jQuery(el).val(ui.item.label);
                                codigoPersona = ui.item.value
                                return false;
                            },
                            select: function( event, ui ) {
                                jQuery(el).val(ui.item.label);
                                codigoPersona = ui.item.value
                                return false;
                            }
                        })
                    }
                }
            },
            {name:'codprof',index:'codprof',width:80,hidden:true,editable:true},
            {name:'codtippro',index:'codtippro',width:80,hidden:true,editable:true},
            {name:'destippro',index:'destippro',width:250,editable:true,
                editrules:{edithidden:true},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).width(200)
                        jQuery.post('/sigurmun/funcionesphp/adminTipProfesiones.php', {f:3}, function(data){
                            eval(data);
                            jQuery(el).autocomplete({
                                source:f,
                                minLength:1,
                                select:function(event,ui){
                                    codigoTipoProfesion=ui.item.value
                                    jQuery(el).val(ui.item.label);
                                    return false;
                                },
                                focus:function(event,ui){
                                    codigoTipoProfesion=ui.item.value
                                    jQuery(el).val(ui.item.label);
                                    return false;
                                }
                            });
                        })
                    }
                }
            },
            {name:'nrocipcapnac',index:'nrocipcapnac',width:80,editable:true},
            {name:'nrocipcapreg',index:'nrocipcapreg',width:80,editable:true},
            {name:'telefono',index:'telefono',width:80},
            {name:'celular',index:'celular',width:80},
            {name:'rpm_rpc',index:'rpm_rpc',width:80},
            {name:'codtippro',index:'codtippro',width:80,hidden:true}
        ],
        height:'auto',
        rowNum:10,
        rowList:[10,20,30,50],
        rownumbers:true,
        viewrecords:true,
        sortname:'codper',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squeda de Profesionales',
        editurl:'/sigurmun/funcionesphp/adminProfesional.php'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:true,add:true,del:true,search:false,view:false},{
        zIndex:1500,
        width:400,
        closeAfterEdit:true,
        reloadAfterEdit:true,
        onclickSubmit:function(params){
            lista = jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'))
            if(codPersona!=lista.codper){
                return {codper:codPersona};
            }else{
                return {codper:lista.codper};
            }
            
        }
    },{
        zIndex:1500,
        width:400,
        closeAfterAdd:true,
        reloadAfterAdd:true,
        onclickSubmit:function(params){
           return {codper:codigoPersona,codtippro:codigoTipoProfesion};
        }
    },{
        zIndex:1500
    });
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarPropiedadExclusivaComun = function(c,b){
    m = 'BuscarPropiedadExclusivaComun';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminProExcDet.php?f=1',
        datetype:'xml',
        colNames:['codped','Del R&eacute;gimen','Detalle del R&eacute;gimen','codpeg'],
        colModel:[
            {name:'codped',index:'codped',hidden:true},
            {name:'despeg',index:'despeg',width:200},
            {name:'desped',index:'desped',width:410},
            {name:'codpeg',index:'codpeg',width:80,hidden:true},
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codper',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squeda de Profesionales'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarLicenciasAnteproyecto = function(c,b,cet){
    m = 'BuscarSolicitudLicencia';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=8&aniofiscal='+ANIOFISCAL + '&cet=' + cet,
        datetype:'xml',
        colNames:['codlichue','Nro. Expediente','Fec. Expediente','Fec. Inicio','coddetts','codtipsol','Tipo de Tr&aacute;mite','codmodapr','Modalidad','coddes','Estado'],
        colModel:[
            {name:'codlichue',index:'codlichue',hidden:true},
            {name:'nroexp',index:'nroexp',width:60},
            {name:'fecexp',index:'fecexp',width:60,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'fecinicio',index:'fecinicio',width:60,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'coddetts',index:'coddetts',width:80,hidden:true},
            {name:'codtipsol',index:'codtipsol',width:80,hidden:true},
            {name:'desdetts',index:'desdetts',width:300},
            {name:'codmodapr',index:'codmodapr',width:80,hidden:true},
            {name:'desmodapr',index:'desmodapr',width:300,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminModAprob.php?f=1'}
            },
            {name:'codesttra',index:'codesttra',width:80,hidden:true},
            {name:'desesttra',index:'desesttra',width:100,stype:''},
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codlichue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Expedientes',
        toolbar:[true,'top']
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    jQuery("#t_" + idlista).append('<center>B&uacute;squeda por A&ntilde;o Fiscal: <select id=\'cbAnioFiscal' + n + '\'></select></center>');
    jQuery('#cbAnioFiscal' + n).load('/sigurmun/funcionesphp/adminAnioFiscal.php', {f:2}).change(function(){
        jQuery("#" + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=8&aniofiscal='+jQuery('#cbAnioFiscal'+ n).val()}).trigger('reloadGrid');
    });
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarInformesVerificacionesAdministrativas = function(c,b,estveradm,opc,q){
    m = 'BuscarInformesVerificacionesAdministrativas';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=9&aniofiscal=' + ANIOFISCAL +'&estveradm='+estveradm+ '&opc=' + opc + '&q='+q,//opc esta declarado al inicio de actaverdicobra.php
        datetype:'xml',
        colNames:['codlichue','Nro. Expediente','Fec. Expediente','Fec. Inicio','coddetts','codtipsol','Tipo de Tr&aacute;mite','codmodapr','Modalidad','coddes','Estado','codinfveradm','Nro. Informe'],
        colModel:[
            {name:'codlichue',index:'codlichue',hidden:true},
            {name:'nroexp',index:'nroexp',width:60},
            {name:'fecexp',index:'fecexp',width:60,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'fecinicio',index:'fecinicio',width:60,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'coddetts',index:'coddetts',width:80,hidden:true},
            {name:'codtipsol',index:'codtipsol',width:80,hidden:true},
            {name:'desdetts',index:'desdetts',width:300},
            {name:'codmodapr',index:'codmodapr',width:80,hidden:true},
            {name:'desmodapr',index:'desmodapr',width:300,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminModAprob.php?f=1'}
            },
            {name:'codesttra',index:'codesttra',width:80,hidden:true},
            {name:'desesttra',index:'desesttra',width:100,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminEstTramite.php?f=1'}
            },
            {name:'codinfveradm',index:'codinfveradm',width:80,hidden:true},
            {name:'nroinfveradm',index:'nroinfveradm',width:80},
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codlichue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Expedientes'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    jQuery("#t_" + idlista).append('<select id=\'cbAnioFiscal1\'></select>');
    jQuery('#cbAnioFiscal1' + idlista).load('/sigurmun/funcionesphp/adminAnioFiscal.php', {f:2}).change(function(){
        jQuery("#" + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminAnioFiscal.php?f=3&aniofiscal='+jQuery('#cbAnioFiscal1').val()}).trigger('reloadGrid');
    });
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarLicenciasSupervisorObra = function(c,b){
    m = 'BuscarSolicitudLicencia';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminLicenciaHue.php?f=6&aniofiscal='+ANIOFISCAL+'&q=SLE',
        datetype:'xml',
        colNames:['codlichue','Nro. Expediente','Fec. Exped.','Fec. Inicio','coddetts','codtipsol','Tipo de Tr&aacute;mite','codmodapr','Modalidad','coddes','Estado','Solicitante'],
        colModel:[
            {name:'codlichue',index:'codlichue',width:50,hidden:true,editable:true},
            {name:'nroexp',index:'nroexp',width:100},
            {name:'fecexp',index:'fecexp',width:70,formatter:'date'},
            {name:'fecinicio',index:'fecinicio',width:70,formatter:'date',hidden:true},
            {name:'coddetts',index:'coddetts',width:80,hidden:true},
            {name:'codtipsol',index:'codtipsol',width:80,hidden:true},
            {name:'desdetts',index:'desdetts',width:400},
            {name:'codmodapr',index:'codmodapr',width:350,hidden:true},
            {name:'desmodapr',index:'desmodapr',width:300,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminModAprob.php?f=1'}
            },
            {name:'codesttra',index:'codesttra',width:300,hidden:true},
            {name:'desesttra',index:'desesttra',width:100,stype:'select',
                searchoptions:{dataUrl:'/sigurmun/funcionesphp/adminEstTramite.php?f=1'}
            },
            {name:'desper',index:'desper',width:300},
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codlichue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Expedientes'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    jQuery("#t_" + idlista).append('<select id=\'cbAnioFiscal1\'></select>');
    jQuery('#cbAnioFiscal1' + idlista).load('/sigurmun/funcionesphp/adminAnioFiscal.php', {f:2}).change(function(){
        jQuery("#" + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminAnioFiscal.php?f=3&aniofiscal='+jQuery('#cbAnioFiscal1').val()}).trigger('reloadGrid');
    });
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
}

var BuscarPropietario = function(c,b){
    m = 'BuscarPropietario';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminPersona.php?f=7&codlichue=0',
        datetype:'xml',
        colNames:['codlichue','Apellidos y Nombres o Raz&oacute;n Social','Solicitante'],
        colModel:[
            {name:'codper',index:'codper',width:50,hidden:true,editable:true},
            {name:'desper',index:'desper',width:450},
            {name:'pronopro',index:'pronopro',width:80,formatter:'select',stype:'',
                editoptions:{value:'EP:EN PROPIETARIO;NP:NO PROPIETARIO'}
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codlichue',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Expedientes'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarPropietario= function(codlichue){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminPersona.php?f=7&codlichue=' + codlichue}).trigger('reloadGrid');
    }
}

var BuscarNotificador = function(c,b){
    m = 'BuscarNotificador';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminNotificador.php?f=1',
        datetype:'xml',
        colNames:['codnotificador','codper','codarea','Area','Fecha Inicio','Fecha Termino','Notificador(a)','Estado'],
        colModel:[
            {name:'codnotificador',index:'codnotificador',width:80,hidden:true},
            {name:'codper',index:'codper',width:500,editable:true,hidden:true},
            {name:'codarea',index:'codarea',width:500,editable:true,hidden:true},
            {name:'nomarea',index:'nomarea',width:300},
            {name:'fecins',index:'fecins',width:80,editable:true,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'fecter',index:'fecter',width:80,editable:true,formatter:'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).datepicker({dateFormat:'dd/mm/yy'});
                    }
                }
            },
            {name:'desper',index:'desper',width:300,editable:true,
                editoptions:{
                    dataInit:function(el){
                        jQuery(el).autocomplete({
                        source: "/sigurmun/funcionesphp/adminPersona.php?f=6&limit=11",
                        minLength: 3,
                        focus:function(event,ui){
                            jQuery(el).val(ui.item.label);
                            codigoPersona=ui.item.value;
                            return false;
                        },
                        select: function(event,ui){
                            jQuery(el).val(ui.item.label);
                            codigoPersona=ui.item.value;
                            return false;
                        }
                    });
                    }
                }
            },
            {name:'codest',index:'codest',width:80,editable:true,edittype:'select',stype:'select',formatter:'select',
                editoptions:{value:'AC:ACTIVO;IN:INACTIVO'}
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codnotificador',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Notificadores'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:true,add:true,del:true,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarPropietario= function(codlichue){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminPersona.php?f=7&codlichue=' + codlichue}).trigger('reloadGrid');
    }
}

var BuscarZonificacion = function(c,b){
    m = 'BuscarZonificacion';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminZonLotUrb.php?f=1',
        datetype:'xml',
        colNames:['codzon','gidloturb','idcor','codigocatastral','codest'],
        colModel:[
            {name:'codzon',index:'codzon',width:80,hidden:true},
            {name:'gidloturb',index:'gidloturb',width:80},
            {name:'idcor',index:'idcor',width:80},
            {name:'codigocatastral',index:'codigocatastral',width:80},
            {name:'codest',index:'codest',width:80,editable:true,edittype:'select',stype:'select',formatter:'select',
                searchoptions:{value:'AC:ACTIVO;IN:INACTIVO'},
                editoptions:{value:'AC:ACTIVO;IN:INACTIVO'}
            }
        ],
        height:'auto',
        rowNum:10,
        rowList:[5,15,30,50],
        rownumbers:true,
        sortname:'codzon',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Resultado de B&uacute;squedas de Notificadores'
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:true,add:true,del:true,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarPropietario= function(codlichue){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminPersona.php?f=7&codlichue=' + codlichue}).trigger('reloadGrid');
    }
}

var BuscarCumpleVerificacionAdministrativa = function(c,b){
    m = 'BuscarCumpleVerificacionAdministrativa';
    n = jQuery('body table[id^="lista' + m + '"]').length;
    var idlista ='lista' + m + n ,idpager = 'pager' + m + n;
    var lastsel;
    jQuery(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/adminCumpleVerAdm.php?f=1',
        datetype:'xml',
        colNames:['codveradm','codinfveradm','Verificaci&oacute;n Administrativa','Si/No','Observaciones'],
        colModel:[
            {name:'codveradm',index:'codveradm',width:80,hidden:true},
            {name:'codinfveradm',index:'codinfveradm',width:80,hidden:true},
            {name:'desveradm',index:'desveradm',width:500},
            {name:'sino',index:'sino',width:80,editable:true,edittype:'select',stype:'select',formatter:'select',
                searchoptions:{value:':TODOS;SI:SI;NO:NO'},
                editoptions:{value:'SI:SI;NO:NO'}
            },
            {name:'obs',index:'obs',width:300,editable:true},
        ],
        height:'auto',
        rowNum:10,
        rowList:[20,30,50],
        rownumbers:true,
        viewrecords:true,
        sortname:'codveradm',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:'Verificaciones Administrativas',
        editurl:'/sigurmun/funcionesphp/adminCumpleVerAdm.php',
        onSelectRow:function(rowid,status){
            jQuery('#' + idlista).jqGrid('restoreRow',lastsel)
            jQuery('#' + idlista).jqGrid('editRow',rowid,true,null,function(){
                jQuery('#' + idlista).trigger('reloadGrid')
            },null,{})
            lastsel=rowid
        }
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});
    if(b) jQuery('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return jQuery('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerIds = function(){
        return jQuery('#' + idlista).jqGrid('getDataIDs');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return jQuery('#' + idlista).jqGrid('getRowData',jQuery('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.actualizar = function(){
        jQuery('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato= function(codtipsol,codinfveradm){
        jQuery('#' + idlista).jqGrid('setGridParam',{url:'/sigurmun/funcionesphp/adminCumpleVerAdm.php?f=1&codtipsol=' + codtipsol + '&codinfveradm=' + codinfveradm}).trigger('reloadGrid');
    }
}

    /*jQuery('#' + idlista).jqGrid({
        url:'/sigurmun/funcionesphp/admin.php?f=',
        datetype:'xml',
        colNames:['','','',''],
        colModel:[
            {name:'',index:'',width:50,hidden:true},
            {name:'',index:'',width:50},
            {name:'',index:'',width:50},
            {name:'',index:'',width:50}
        ],
        height:'auto',
        rowNum:5,
        sortname:'',
        pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        caption:''
    });
    jQuery('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});*/

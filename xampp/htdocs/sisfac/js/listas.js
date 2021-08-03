/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/

/**
 * @author Gisela Muñoz - Modificado MBF 2019
 **/

/**
 * Funcion que crea un grid conteniendo el nombre del lote
 * @param {$} c Contendor de la lista
 */

function fDNI(value, campo){
    if (value.length != 8) return [false,campo + ": Debe tener 8 d&iacute;gitos "];
    else return [true,""];
}

function fRUC(value, campo){
    if (value.length != 11) return [false,campo + ": Debe tener 11 d&iacute;gitos "];
    else return [true,""];
}
        
var ListaTrabajadores = function(c,iddiresa){
    temp=''
    
    n = $('body table[id^="listaPersona"]').length;
    var idlista = 'listaPersona' + n ,idpager = 'pagerPersona' + n,lastsel='';
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminTrabajador.php?f=4',
        datatype: "xml",
        colNames:['idtrabajador', 'Diresa', 'Red', 'Microred', 'Nucleo', 'Establecimiento', 'Diresa', 'Red', 'Microred', 'Nucleo', 'Establecimiento','Trabajador', 'Grupo profesional', '', '','Colegio profesional','Colegio profesional', 'Profesi&oacute;n', 'Profesi&oacute;n', 'Condici&oacute;n', 'Condici&oacute;n', 'Tipo Documeto','Nro. Documento','Nro. Colegiatura', 'C&oacute;digo'],
            colModel:[
                {name:'idtrabajador', index:'idtrabajador', width:200, editable:true, hidden:true},
                {name:'iddiresa', index:'iddiresa', width:200, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        dataUrl:'/sisfac/funcionesphp/adminDiresa.php?f=2&iddiresa='+iddiresa,
                        dataInit:function(el){
                            
                            $.post('/sisfac/funcionesphp/adminRed.php', {f:3,iddiresa:iddiresa}, function(data){
                                $('#tr_idred select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            })
                            
                            $(el).change(function(){
                                //alert('ss')
                                $.post('/sisfac/funcionesphp/adminRed.php', {f:3,iddiresa:$(el).val()}, function(data){
                                    $('#tr_idred select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            }).width(220).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }
                    }
                },
                {name:'idred', index:'idred', width:200, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        //dataUrl:'/sisfac/funcionesphp/adminRed.php?f=2&iddiresa=0',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                $.post('/sisfac/funcionesphp/adminMicrored.php', {f:3,idred:$(el).val()}, function(data){
                                    $('#tr_idmicrored select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            }).width(220)
                        }
                    }
                },
                {name:'idmicrored', index:'idmicrored', width:200, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        //dataUrl:'/sisfac/funcionesphp/adminMicrored.php?f=2&idred=0',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                $.post('/sisfac/funcionesphp/adminNucleo.php', {f:3,idmicrored:$(el).val()}, function(data){
                                    $('#tr_idnucleo select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            }).width(220)
                        }
                    }
                },
                {name:'idnucleo', index:'idnucleo', width:200, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        //dataUrl:'/sisfac/funcionesphp/adminNucleo.php?f=2&idmicrored=0',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                $.post('/sisfac/funcionesphp/adminEstablecimiento.php', {f:3,idnucleo:$(el).val()}, function(data){
                                    $('#tr_idestablecimiento select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            }).width(220)
                        }
                    }
                },
                {name:'idestablecimiento', index:'idestablecimiento', width:200, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        //dataUrl:'/sisfac/funcionesphp/adminEstablecimiento.php?f=2&idnucleo=0',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).width(220)
                        }
                    }
                },
                {name:'nombreDiresa', index:'nombreDiresa', width:100,
                    editoptions:{size:40}
                },
                {name:'nombreRed', index:'nombreRed', width:100,
                    editoptions:{size:40}
                },
                {name:'nombreMicrored', index:'nombreMicrored', width:100,
                    editoptions:{size:40}
                },
                {name:'nombreNucleo', index:'nombreNucleo', width:100,
                    editoptions:{size:40}
                },
                {name:'nombreEstablecimiento', index:'nombreEstablecimiento', width:100,
                    editoptions:{size:40}
                },
                {name:'nombreCompleto', index:'nombreCompleto', width:120, editable:true,
                    editoptions:{size:40}
                },
                {name:'grupoProfesional', index:'grupoProfesional', width:100, editable:true, edittype:'select',hidden:true,
                    editoptions:{value:'CIRUJANO DENTISTA:CIRUJANO DENTISTA;EDUCADOR:EDUCADOR;LIC. BIOLOGIA Y QUIMICA:LIC. BIOLOGIA Y QUIMICA;LIC. EN ENFERMERIA:LIC. EN ENFERMERIA;MEDICINA HUMANA:MEDICINA HUMANA;OBSTETRA:OBSTETRA;QUIMICO FARMACEUTICO:QUIMICO FARMACEUTICO;TECNICO/A DE ENFERMERIA:TECNICO/A DE ENFERMERIA;TECNICO/A EN LABORATORIO:TECNICO/A EN LABORATORIO'}
                },
                {name:'op', index:'op', width:80, hidden:true},
                {name:'op1', index:'op1', width:80, hidden:true},
                {name:'idcatalogoColegio', index:'idcatalogoColegio', width:80, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        dataUrl:'/sisfac/funcionesphp/adminCatalogoColegio.php?f=2',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                $('#idprofesion').load('/sisfac/funcionesphp/adminProfesion.php', {f:3,codigoColegio:$(el).val()})
                                generaCodigo()
                            }).width(220)
                        }
                    }
                },
                {name:'colegio', index:'colegio', width:100},
                {name:'idprofesion', index:'idprofesion', width:80, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{value:'',
                        dataUrl:'/sisfac/funcionesphp/adminProfesion.php?f=2',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                generaCodigo()
                            }).width(220)
                        }
                    }
                },
                {name:'profesion', index:'profesion', width:100},
                {name:'idcondicionTrabajador', index:'idcondicionTrabajador', width:80, editable:true, hidden:true, edittype:'select',
                    editrules:{edithidden:true},
                    editoptions:{
                        dataUrl:'/sisfac/funcionesphp/adminCondicionTrabajador.php?f=2',
                        dataInit:function(el){
                            $(el).prepend("<option value=''>SELECCIONE UNA OPCION</option>")
                            $(el).change(function(){
                                generaCodigo()
                            }).width(220)
                        }
                    }
                },
                {name:'condicion', index:'condicion', width:100},
                {name:'opcionDocumento', index:'opcionDocumento', width:100, editable:true, edittype:'select',
                    editoptions:{
                        value:'DNI:DNI;CARNET DE EXTRANJERIA:CARNET DE EXTRANJERIA;PASAPORTE:PASAPORTE;DOCUMENTO DE IDENTIDAD EXTRANJERO:DOCUMENTO DE IDENTIDAD EXTRANJERO',
                        dataInit:function(el){
                            $(el).change(function(){
                                if($(el).val() == 'DNI'){
                                    $('#nroDocumento').mask('99999999')
                                }else{
                                    $('#nroDocumento').unmask()
                                }
                                generaCodigo()
                            }).width(220)
                        }
                    }
                },
                {name:'nroDocumento', index:'nroDocumento', width:80, editable:true,
                    editoptions:{
                        dataInit:function(el){
                            $(el).keyup(function(key){
                                generaCodigo()
                            })
                        }
                    }
                },
                {name:'nroColegiatura', index:'nroColegiatura', width:80, editable:true},
                {name:'codigo', index:'codigo', width:100,editable:true,hidden:true,
                    editrules:{edithidden:true}
                },
            ],
        height:200,
        width:'auto',
        rowNum:100,
        rowList:[100,200,500],
        rownumbers:true,
        sortname:'idtrabajador',
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        //caption: "Mantenimiento de Personas",
        editurl:'/sisfac/funcionesphp/adminTrabajador.php',
        pager:'#' + idpager
    });
    function generaCodigo(){
        //$('#codigo').clear()
        if($('#opcionDocumento').val()=='DNI') temp = 1
        else if($('#opcionDocumento').val()=='CARNET DE EXTRANJERIA') temp = 2
        else if($('#opcionDocumento').val()=='PASAPORTE') temp = 3
        else if($('#opcionDocumento').val()=='DOCUMENTO DE IDENTIDAD EXTRANJERO') temp = 4
        $('#codigo').val(temp + '' +$('#nroDocumento').val() + $('#idcatalogoColegio').val())
    }
    
    $('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:true,add:true,del:true,search:false,view:false},{
        zIndex:1050,
        width:500,
        closeAfterEdit:true,
        afterShowForm : function (formid) {
            
            if($('#opcionDocumento').val() == 'DNI'){
                $('#nroDocumento').mask('99999999')
            }else{
                $('#nroDocumento').unmask()
            }
            
            lista = $('#' + idlista).jqGrid('getRowData', $('#' + idlista).jqGrid('getGridParam','selrow'))
            
            $.post('/sisfac/funcionesphp/adminRed.php', {f:3,iddiresa:lista.iddiresa}, function(data){
                $('#tr_idred select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>").val(lista.idred)
            })
            
            $.post('/sisfac/funcionesphp/adminMicrored.php', {f:3,idred:lista.idred}, function(data){
                $('#tr_idmicrored select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>").val(lista.idmicrored)
            })
            
            $.post('/sisfac/funcionesphp/adminNucleo.php', {f:3,idmicrored:lista.idmicrored}, function(data){
                $('#tr_idnucleo select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>").val(lista.idnucleo)
            })
            
            $.post('/sisfac/funcionesphp/adminEstablecimiento.php', {f:3,idnucleo:lista.idnucleo}, function(data){
                $('#tr_idestablecimiento select').html(data).prepend("<option selected>SELECCIONE UNA OPCION</option>").val(lista.idestablecimiento)
            })
            //alert($('#codigo').val())

            if(lista.opcionDocumento=='DNI') temp = 1
            else if(lista.opcionDocumento=='CARNET DE EXTRANJERIA') temp = 2
            else if(lista.opcionDocumento=='PASAPORTE') temp = 3
            else if(lista.opcionDocumento=='DOCUMENTO DE IDENTIDAD EXTRANJERO') temp = 4
            

            $('#codigo').val(temp + lista.nroDocumento + lista.idcatalogoColegio)
            //generaCodigo()
        },onclickSubmit : function(params, posdata) {
            //return{idinstitucion:1,tipo:'TRA'}
            return{idCatalogoColegio:$('#idcatalogoColegio option:selected').attr('idcatalogoColegio')}
        }
    },{
        zIndex:1050,
        width:500,
        closeAfterAdd:true,
        afterShowForm : function (formid) {
            //alert(iddiresa)
            $('#iddiresa').val(iddiresa)
            if($('#opcionDocumento').val() == 'DNI'){
                $('#nroDocumento').mask('99999999')
            }else{
                $('#nroDocumento').unmask()
            }
        },
        onclickSubmit : function(params, posdata) {
            //return{idinstitucion:1,tipo:'TRA'}
            return{tipo:'TRA',idCatalogoColegio:$('#idcatalogoColegio option:selected').attr('idcatalogoColegio'),idestablecimiento:$('#tr_idestablecimiento select').val()}
        },
        onClose:function(){
            /*$('#iddiresa').load('/sisfac/funcionesphp/adminDiresa.php', {f:3},function(){
                $('#iddiresa').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idred').load('/sisfac/funcionesphp/adminRed.php', {f:3},function(){
                $('#idred').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idmicrored').load('/sisfac/funcionesphp/adminMicrored.php', {f:3},function(){
                $('#idmicrored').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idnucleo').load('/sisfac/funcionesphp/adminNucleo.php', {f:3},function(){
                $('#idnucleo').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idestablecimiento').load('/sisfac/funcionesphp/adminEstablecimiento.php', {f:3},function(){
                $('#idestablecimiento').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idcatalogoColegio').load('/sisfac/funcionesphp/adminCatalogoColegio.php', {f:3},function(){
                $('#idcatalogoColegio').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })
            $('#idprofesion').load('/sisfac/funcionesphp/adminProfesion.php', {f:3},function(){
                $('#idprofesion').prepend("<option selected>SELECCIONE UNA OPCION</option>")
            })*/
        }
    },{
        afterSubmit : function(response, postdata) {
            mensaje = ''
            if(response.responseText == 'N') {
                s =false
                mensaje = 'NO SE PUEDE ELIMINAR. HAY SECTORES Y FICHAS REGISTRADAS'
            }
            else s = true
            return [s,mensaje]
        }
    });
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerIds = function(){
        return $('#' + idlista).jqGrid('getDataIDs')
    }
    
    this.obtenerIdsSeleccionados = function(){
        return $('#' + idlista).jqGrid('getGridParam','selarrrow')
    }
    
    this.obtenerFila = function(id){
        return $('#' + idlista).jqGrid('getRowData',id);
    }

    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaPatologia = function(c, tipo, idpersona){
    n = $('body table[id^="listaPatologia"]').length;
    var idlista = 'listaPatologia' + n ,idpager = 'pagerPatologia' + n,lastsel='';
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminAntecedentePatologico.php?f=1&idpersona='+ idpersona +'&tipo=' + tipo,
        datatype: "xml",
        colNames:['idantecedentePatologico' ,'Tipo', 'Fecha', 'CIE 10', 'CIE 10', 'Fuente', 'Observaciones'],
        colModel:[
            {name:'idantecedentePatologico', index:'idantecedentePatologico', width:200, editable:true, hidden:true},
            {name:'tipo', index:'tipo', width:250, hidden:true},
            {name:'fecha', index:'fecha', width:80, editable:true, hidden:((tipo == 'HOSPITALIZACION' || tipo == 'TRANSFUSION')?false:true),
                editrules:{date:((tipo == 'HOSPITALIZACION' || tipo == 'TRANSFUSION')?true:false)},
                formatter: 'date',
                formatoptions:{srcformat:'Y-m-d',newformat:'d/m/Y'},
                editoptions:{
                    dataInit:function(el){
                        $(el).mask('99/99/9999')
                    }
                }
            },
            {name:'idcatalogoCIE10', index:'idcatalogoCIE10', width:250, editable:true, hidden:true},
            {name:'nombreCatalogo', index:'nombreCatalogo', width:400, editable:true,
                editoptions:{
                    dataInit:function(el){
                        $(el).autocomplete({
                            source: "/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11",
                            minLength: 1,
                            focus:function(event,ui){
                                $(el).val(ui.item.label)
                                $('#idcatalogoCIE10').val(ui.item.value)
                                return false
                            },
                            select: function( event, ui ) {
                                $(el).val(ui.item.label)
                                $('#idcatalogoCIE10').val(ui.item.value)
                                return false
                            }
                        }).width(400)
                    }
                }
            },
            {name:'fuente', index:'fuente', width:150, editable:true, edittype:'select',
                editoptions:{value:'(R) PACIENTE REFERIDO:(R) PACIENTE REFERIDO;(D) PACIENTE DIAGNOSTICADO:(D) PACIENTE DIAGNOSTICADO'}
            },
            {name:'observacion', index:'observacion', width:300, editable:true, edittype:'textarea',
                editoptions:{rows:5,cols:60}
            }
        ],
        height:50,
        width:'auto',
        rowNum:10,
        rowList:[10,20,30,50],
        rownumbers:true,
        sortname:'idantecedentePatologico',
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        editurl:'/sisfac/funcionesphp/adminAntecedentePatologico.php',
        pager:'#' + idpager
    });
    
    $('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:true,add:true,del:true,search:false,view:false},{
        width:500,
        closeAfterEdit:true,
        afterShowForm : function (formid) {
            
        }
    },{
        width:500,
        closeAfterAdd:true,
        onclickSubmit:function(params,postdata){
            id=$('#listaBusqueda').jqGrid('getGridParam','selrow')
            return {idpersona:id,tipo:tipo}
        },
        afterShowForm  : function(formid) {
            $('#idcatalogoCIE10').val('')
            if(!$('#listaBusqueda').jqGrid('getGridParam','selrow')){
                alert('Debe seleccionar un registro de persona')
            }
        },
        beforeSubmit : function(postdata, formid) {  
            id = $('#idcatalogoCIE10').val()
            return [id!='','Debe seleccionar un catalogo CIE10'];
        },
        onClose:function(){
            
        }
    });
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerIds = function(){
        return $('#' + idlista).jqGrid('getDataIDs')
    }
    
    this.obtenerIdsSeleccionados = function(){
        return $('#' + idlista).jqGrid('getGridParam','selarrrow')
    }
    
    this.obtenerFila = function(id){
        return $('#' + idlista).jqGrid('getRowData',id);
    }

    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
    
    this.actualizarConDato = function(idpersona,tipo){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminAntecedentePatologico.php?f=1&idpersona=' + idpersona + '&tipo=' + tipo}).trigger('reloadGrid');
    }
    
}

var ListaBusquedaDiresa = function(c,osr){
    n = $('body table[id^="listaBusquedaDiresa"]').length;
    var idlista = 'listaBusquedaDiresa' + n ,idpager = 'pagerBusquedaDiresa' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminDiresa.php?f=1',
        datatype: "xml",
        colNames:['iddiresa', 'Diresa', 'Regi&oacute;n', 'Region'],
        colModel:[
            {name:'iddiresa', index:'iddiresa', width:200, editable:true, hidden:true},
            {name:'nombreDiresa', index:'nombreDiresa', width:150, editable:true},
            {name:'idregion', index:'idregion', width:200, editable:true, hidden:true, edittype:'select',
                editoptions:{dataUrl:'/sisfac/funcionesphp/adminRegion.php?f=2'}
            },
            {name:'idregionn', index:'idregionn', width:200,hidden:true}
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        //sortname:'nombreDiresa',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Diresa',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminDiresa.php?f=1&iddiresa=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaRed = function(c,iddiresa,idregion,osr){
    n = $('body table[id^="listaBusquedaRed"]').length;
    var idlista = 'listaBusquedaRed' + n ,idpager = 'pagerBusquedaRed' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminRed.php?f=1&iddiresa=' + iddiresa,
        datatype: "xml",
        colNames:['idred', 'Red', 'Provincia', 'Provincia'],
        colModel:[
            {name:'idred', index:'idred', width:200, editable:true, hidden:true},
            {name:'nombreRed', index:'nombreRed', width:150, editable:true},
            {name:'idprovincia', index:'idprovincia', width:200, editable:true, edittype:'select' ,hidden:true,
                editoptions:{dataUrl:'/sisfac/funcionesphp/adminProvincia.php?f=2&idregion=' + idregion}
            },
            {name:'idprovincian', index:'idprovincian', width:200,hidden:true}
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreRed',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Red',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminRed.php?f=1&iddiresa=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaMicrored = function(c,idred,osr){
    n = $('body table[id^="listaBusquedaMicrored"]').length;
    var idlista = 'listaBusquedaMicrored' + n ,idpager = 'pagerBusquedaMicrored' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminMicrored.php?f=1&idred=' + idred,
        datatype: "xml",
        colNames:['idmicrored', 'Microred'],
        colModel:[
            {name:'idmicrored', index:'idmicrored', width:200, editable:true, hidden:true},
            {name:'nombreMicrored', index:'nombreMicrored', width:150, editable:true}
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreMicrored',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Microred',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminMicrored.php?f=1&idred=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaNucleo = function(c, idmicrored, osr){
    n = $('body table[id^="listaBusquedaNucleo"]').length;
    var idlista = 'listaBusquedaNucleo' + n ,idpager = 'pagerBusquedaNucleo' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=' + idmicrored,
        datatype: "xml",
        colNames:['idnucleo', 'N&uacute;cleo'],
        colModel:[
            {name:'idnucleo', index:'idnucleo', width:200, editable:true, hidden:true},
            {name:'nombreNucleo', index:'nombreNucleo', width:200, editable:true}
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreNucleo',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Nucleo',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaEstablecimiento = function(c, idnucleo, osr){

    n = $('body table[id^="listaBusquedaEstablecimiento"]').length;
    var idlista = 'listaBusquedaEstablecimiento' + n ,idpager = 'pagerBusquedaEstablecimiento' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idnucleo=' + (idnucleo==undefined?'':idnucleo),
        datatype: "xml",
        colNames:['idestablecimiento', 'Distrito', 'Distrito', 'Nucleo', 'Nucleo', 'Establecimiento' ,'Tipo','claveGeneral','Establecimiento'],
        colModel:[
            {name:'idestablecimiento', index:'idestablecimiento', width:200, editable:true, hidden:true},
            {name:'iddistrito', index:'iddistrito', width:200, editable:true, hidden:true, edittype:'select'},
            {name:'nombre', index:'nombre', width:200, hidden:true},
            {name:'idnucleo', index:'idnucleo', width:200, editable:true, hidden:true, edittype:'select'},
            {name:'nombreNucleo', index:'nombreNucleo', width:150,hidden:true},
            {name:'nombreEstablecimiento', index:'nombreEstablecimiento', width:200, hidden:true},
            {name:'tipo', index:'tipo', width:80, hidden:true},
            {name:'claveGeneral', index:'claveGeneral', width:80, hidden:true},
            {name:'est', index:'est', width:300}
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreEstablecimiento',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Nucleo',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idnucleo=' + (id==undefined?'':id)}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaComunidad = function(c, idestablecimiento, osr){
    n = $('body table[id^="listaBusquedaComunidad"]').length;
    var idlista = 'listaBusquedaComunidad' + n ,idpager = 'pagerBusquedaComunidad' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + idestablecimiento,
        datatype: "xml",
        colNames:['idcomunidad', 'Comunidad', 'descripcion'],
        colModel:[
            {name:'idcomunidad', index:'idcomunidad', width:200, editable:true, hidden:true},
            {name:'nombreComunidad', index:'nombreComunidad', width:150, editable:true, edittype:'select'},
            {name:'descripcion', index:'descripcion', width:200, hidden:true},
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreComunidad',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Nucleo',
        onSelectRow:function(rowid,status){
            if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaBusquedaSector = function(c, idcomunidad){
    n = $('body table[id^="listaBusquedaSector"]').length;
    var idlista = 'listaBusquedaSector' + n ,idpager = 'pagerBusquedaSector' + n;
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminSector.php?f=1&idcomunidad=' + idcomunidad,
        datatype: "xml",
        colNames:['idsector', 'com.idcomunidad', 'com.nombreComunidad', 'Sector', 'sec.descripcion'],
        colModel:[
            {name:'idsector', index:'idsector', width:200, editable:true, hidden:true},
            {name:'idcomunidad', index:'idcomunidad', width:200, hidden:true, edittype:'select'},
            {name:'nombreComunidad', index:'nombreComunidad', width:200, hidden:true},
            {name:'nombreSector', index:'nombreSector', width:150},
            {name:'descripcion', index:'descripcion', width:200, hidden:true},
        ],
        height:200,
        rowNum:1000,
        viewrecords:true,
        sortname:'nombreComunidad',
        //pager:'#' + idpager,
        pginput:false,
        sortorder:'asc',
        //caption:'Nucleo',
        onSelectRow:function(rowid,status){
            //if(osr) osr();
        }
    });
    //$('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:true,search:false,view:false});
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false});
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.actualizar = function(){
        $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(id){
        $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminSector.php?f=1&idcomunidad=' + id}).trigger('reloadGrid');
    }
    
    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
}

var ListaEstablecimientoMultiselect = function(c,idprovincia){
    n = $('body table[id^="listaEstablecimiento"]').length;
    var idlista = 'listaEstablecimiento' + n ,idpager = 'pagerEstablecimiento' + n,lastsel='';
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idprovincia=' + idprovincia,
        datatype: "xml",
        colNames:['idestablecimiento', 'dis.iddistrito', 'dis.nombre ','nuc.idnucleo', 'nuc.nombreNucleo', 'Establecimiento'],
        colModel:[
            {name:'idestablecimiento', index:'idestablecimiento', width:200, editable:true, hidden:true},
            {name:'iddistrito', index:'iddistrito', width:200, hidden:true},
            {name:'dis.nombre', index:'dis.nombre', width:200, hidden:true},
            {name:'idnucleo', index:'idnucleo', width:200,  hidden:true},
            {name:'nucleo', index:'nucleo', width:200,  hidden:true},
            {name:'nombreEstablecimiento', index:'nombreEstablecimiento', width:400, editable:true}
        ],
        height:300,
        width:'auto',
        rowNum:5000,
        rowList:[5000,10000],
        rownumbers:true,
        sortname:'nombreEstablecimiento',
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        multiselect:true,
        //caption: "Lista de establecimientos",
        pager:'#' + idpager
    });
    
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false})
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerIds = function(){
        return $('#' + idlista).jqGrid('getDataIDs')
    }
    
    this.obtenerIdsSeleccionados = function(){
        return $('#' + idlista).jqGrid('getGridParam','selarrrow')
    }
    
    this.obtenerFila = function(id){
        return $('#' + idlista).jqGrid('getRowData',id);
    }

    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
    
    this.actualizar = function(){
        return $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(idprovincia){
        return $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idprovincia=' + idprovincia}).trigger('reloadGrid');
    }
}


//MBF
var ListaSectorComunidadMultiselect = function(c,idestablecimiento){

    var temp = $('#listaTrabajador').jqGrid('getRowData',$('#listaTrabajador').jqGrid('getGridParam','selrow'));

    var html = '';

    $.ajax({
        url: '/sisfac/funcionesphp/adminSector.php?f=4&idestablecimiento=' + idestablecimiento + "&idtrabajador=" + temp.idtrabajador,
        type: 'get',
        dataType: 'JSON',
        success: function(respuesta) {

            html = '<table>';

            var checked="";
            $.each(respuesta, function(i, elm) {
                    checked = "";
                    if(elm.idtrabajadorSector!=null)  checked = ' checked="true" ';
                    html += '<tr><td style="padding:5px 5px"><input type="checkbox" value="' + elm.idsector + '"'+checked+'  /></td><td style="padding:5px 5px">' + elm.nombreSector + '</td></tr>';
                
            });

            html += '</table>';
            $(c).html(html);
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });




 
}

var ListaCatalogoPrestacionPerfilMultiselect = function(c,idestablecimiento){
    n = $('body table[id^="listaCatalogoPrestacionPerfil"]').length;
    var idlista = 'listaCatalogoPrestacionPerfil' + n ,idpager = 'pagerCatalogoPrestacionPerfil' + n,lastsel='';
    $(c).html('<table id="' + idlista + '"></table><div id="' + idpager + '"></div>');
    $('#' + idlista).jqGrid({
        url:'/sisfac/funcionesphp/adminCatalogoPrestacionPerfil.php?f=4&idestablecimiento=' + idestablecimiento,
        datatype: "xml",
        colNames:['idcatalogoPrestacionPerfil','idcatalogoPrestacion','Prestacion','idcatalogoPerfil', 'nombrePerfil'],
        colModel:[
            {name:'idcatalogoPrestacionPerfil', index:'idcatalogoPrestacionPerfil', width:200, editable:true, hidden:true},
            {name:'idcatalogoPrestacion', index:'idcatalogoPrestacion', width:200, editable:true, hidden:true},
            {name:'prestacion', index:'prestacion', width:300},
            {name:'idcatalogoPerfil', index:'idcatalogoPerfil', width:300, hidden:true},
            {name:'nombrePerfil', index:'nombrePerfil', width:300}
        ],
        height:400,
        width:'auto',
        rowNum:5000,
        rowList:[5000,10000],
        rownumbers:true,
        sortname:'idcatalogoPrestacionPerfil',
        pginput:false,
        sortorder:'asc',
        viewrecords:true,
        multiselect:true,
        //caption: "Lista de sectores",
        pager:'#' + idpager
    });
    
    $('#' + idlista).jqGrid('filterToolbar',{searchOnEnter:false})
    
    this.obtenerId = function(){
        return $('#' + idlista).jqGrid('getGridParam','selrow');
    }
    
    this.obtenerIds = function(){
        return $('#' + idlista).jqGrid('getDataIDs')
    }
    
    this.obtenerIdsSeleccionados = function(){
        return $('#' + idlista).jqGrid('getGridParam','selarrrow')
    }
    
    this.obtenerFila = function(id){
        return $('#' + idlista).jqGrid('getRowData',id);
    }

    this.obtenerFilaSeleccionada = function(){
        return $('#' + idlista).jqGrid('getRowData',$('#' + idlista).jqGrid('getGridParam','selrow'));
    }
    
    this.obtenerGrid = function(){
        return $('#' + idlista)[0];
    }
    
    this.actualizar = function(){
        return $('#' + idlista).trigger('reloadGrid');
    }
    
    this.actualizarConDato = function(idestablecimiento,idtrabajador){
        return $('#' + idlista).jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminSector.php?f=4&idestablecimiento=' + idestablecimiento + '&idtrabajador=' + idtrabajador}).trigger('reloadGrid');
    }
}

    /*$('#' + idlista).jqGrid({
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
    $('#' + idlista).jqGrid('navGrid','#' + idpager,{edit:false,add:false,del:false,search:false,view:false});*/


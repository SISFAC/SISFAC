
/*Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/

jQuery(document).ready(function(){
    
    
    var lbe = new ListaBusquedaEstablecimiento(jQuery('#divBusquedaEstablecimiento'))
    var lbn = new ListaBusquedaNucleo(jQuery('#divBusquedaNucleo'),0,function(){
        lbe.actualizarConDato(lbn.obtenerId())
    })
    var lbm = new ListaBusquedaMicrored(jQuery('#divBusquedaMicrored'),0,function(){
        lbn.actualizarConDato(lbm.obtenerId())
    })
    var lbr = new ListaBusquedaRed(jQuery('#divBusquedaRed'),0,0,function(){
        lbm.actualizarConDato(lbr.obtenerId())
    })
    var lbd = new ListaBusquedaDiresa(jQuery('#divBusquedaDiresa'),function(){
        lbr.actualizarConDato(lbd.obtenerId())
    })
    
    jQuery('#dialogDatoGeneral').dialog({
        modal:true,
        autoOpen:false,
        show:'blind',
        hide:'drop',
        width:'auto',
        height:'auto',
        buttons:{
            Aceptar:function(){
                
                if(!lbe.obtenerId()){
                    alert('Debe seleccionar un establecimiento')
                    return
                }
                cg = lbe.obtenerFilaSeleccionada()
                
                jQuery.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                    f:1,
                    claves:lbd.obtenerId() + '-' + lbr.obtenerId() + '-' + lbm.obtenerId() + '-' + lbn.obtenerId() + '-' + lbe.obtenerId(),
                    claveGeneral:cg.claveGeneral//jQuery('#tbNombreEstablecimiento').val(),
                    //lugarCentral:jQuery('#cbEstablecimientoCentral').val()
                }, function(data){
                   jQuery('#dialogDatoGeneral').dialog('close')
                })
                
                
                /*
                if(jQuery('#tbNombreEstablecimiento').val()=='' || jQuery('#cbEstablecimientoCentral').val()==''){
                    alert('Debe seleccionar un valor')
                    return
                }
                jQuery.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                    f:1,
                    claveGeneral:jQuery('#tbNombreEstablecimiento').val(),
                    lugarCentral:jQuery('#cbEstablecimientoCentral').val()
                }, function(data){
                    jQuery('#dialogDatoGeneral').dialog('close')
                })*/
            }
        },
        close:function(){
            window.location = '/sisfac/adm/'
        }
    })
    
    jQuery('#cbTipoUsuario').change(function(){
        if(jQuery('#cbTipoUsuario').val()=='VIS'){
            jQuery('#btnBuscarPersona').hide()
            jQuery('#tbTrabajador').val('')
            jQuery('#hTrabajador').val('')
        }else{
            jQuery('#btnBuscarPersona').show()
        }
    })
    
    if(!CLAV) {
        jQuery('#dialogDatoGeneral').dialog('open')
    }else{
        var OPERACION = ''
        t = CLAVES.split('-')
        le = new ListaTrabajadores(jQuery('#dialogPersona'), t[0])

        jQuery('#dialogUsuario').dialog({
            zIndex:700,
            autoOpen:false,
            modal:true,
            width:700,
            height:'auto',
            buttons:{
                'Aceptar':function(){
                    if(jQuery('#cbTipoUsuario').val()=='NOR' || jQuery('#cbTipoUsuario').val()=='ADM'){
                        if(esVacio(jQuery('#hTrabajador'))){
                            jQuery('#tbTrabajador').addClass('ui-state-error');
                            alert('El campo TRABAJADOR no contiene un dato v\xe1lido');
                            return;
                        }
                        else if(esVacio(jQuery('#tbUsuario'))){
                            jQuery('#tbUsuario').addClass('ui-state-error');
                            alert('El campo USUARIO no puede estar vac\xedo');
                            return;
                        }
                        else if(esVacio(jQuery('#tbClave'))){
                            jQuery('#tbClave').addClass('ui-state-error');
                            alert('El campo CLAVE no puede estar vac\xedo');
                            return;
                        }
                        else if( jQuery('#tbClave').val() != jQuery('#tbRepetirClave').val() ){
                            jQuery('#tbClave, #tbRepetirClave').addClass('ui-state-error');
                            alert('Los claves no coinciden. Por favor ingreselas de nuevo');
                            return;
                        }
                    }
                    
                    
                    jQuery.post('/sisfac/funcionesphp/adminUsuario.php', {
                        f:OPERACION=='agregar'?2:3,
                        idusuario:jQuery('#listaUsuarios').jqGrid('getGridParam','selrow'),
                        idtrabajador:jQuery('#hTrabajador').val(),
                        usuario:jQuery('#tbUsuario').val(),
                        clave:jQuery('#tbClave').val(),
                        //estado:jQuery('#chbEstado').is(':checked')?1:0,
                        estado:1,
                        tipo:jQuery('#cbTipoUsuario').val()
                    }, function(data){
                        //alert(data);
                        if(data.indexOf('Error')==-1) jQuery('#dialogUsuario').dialog('close');
                        jQuery('#listaUsuarios').trigger('reloadGrid');
                    });
                },
                'Cancelar':function(){
                    jQuery('#dialogUsuario').dialog('close');
                }
            },
            close:function(){
                jQuery('#tbTrabajador, #hTrabajador, #tbUsuario, #tbClave, #tbRepetirClave').val('');
                jQuery('#chbEstado').attr('checked',true);
                //jQuery('#dialogUsuario fieldset input:checkbox').attr('checked',false);
                jQuery('#dialogUsuario .ui-state-error').removeClass('ui-state-error');
                jQuery('#cbTipoUsuario').val('NOR')
                jQuery('#btnBuscarPersona').show()
            }
        });

        jQuery('#dialogPrivilegios').dialog({
            autoOpen:false,
            modal:true,
            width:'auto',
            height:'auto',
            buttons:{
                'Aceptar':function(){
                    jQuery.post('/sisfac/funcionesphp/adminVistaUsuario.php', {
                        f:OPERACION=='agregar'?2:3,
                        id:jQuery('#listaPrivilegios').jqGrid('getGridParam','selrow'),
                        idusuario:jQuery('#listaUsuarios').jqGrid('getGridParam','selrow'),
                        idvista:jQuery('#cbModulo').val(),//jQuery('#tablaModulos label.ui-state-active').attr('idmodulo'),
                        'privilegios':privilegios()
                    }, function(data){
                        if(data.indexOf('Error')==-1) jQuery('#dialogPrivilegios').dialog('close');
                        jQuery('#listaPrivilegios').trigger('reloadGrid');
                    });
                },
                'Cancelar':function(){
                    jQuery('dialogPrivilegios').dialog('close');
                }
            },
            close:function(){
                jQuery('#dialogPrivilegios fieldset input:checkbox').attr('checked',false);
                jQuery('#cbModulo').val('').change();
            }
        });



        jQuery('#dialogPrivilegios #tablaModulos label').click(function(){
            jQuery('#dialogPrivilegios #tablaModulos label').removeClass('ui-state-active');
            jQuery(this).addClass('ui-state-active');

            jQuery('#dialogPrivilegios fieldset table').hide();
            jQuery('#' + jQuery(this).attr('tabla')).show();
        });

        jQuery('#dialogPrivilegios fieldset table').hide();

        jQuery('#listaUsuarios').jqGrid({
            url:'/sisfac/funcionesphp/adminUsuario.php?f=1',
            datetype:'xml',
            colNames:['idusuario','idpersona','Nombre','Usuario','Tipo','Estado'],
            colModel:[
                {name:'idusuario',index:'idusuario',width:50,hidden:true},
                {name:'idempleado',index:'idempleado',width:50,hidden:true},
                {name:'nombreCompleto',index:'nombreCompleto',width:300},
                {name:'usuario',index:'usuario',width:120},
                {name:'tipo',index:'tipo',width:100,edittype:'select',formatter:'select',stype:'select',
                    editoptions:{value:'NOR:NORMAL;ADM:ADMINISTRADOR;VIS:VISITANTE'}
                },
                {name:'estado',index:'estado',width:50,formatter:'checkbox',align:'center'}
            ],
            height:250,
            rowNum:100,
            rownumbers:true,
            sortname:'idusuario',
            pager:'#pagerUsuarios',
            pginput:false,
            pgbuttons:false,
            sortorder:'asc',
            caption:'Usuarios',
            onSelectRow:function(rowid,status){
                fila = jQuery('#listaUsuarios').jqGrid('getRowData',rowid);
                jQuery('#listaPrivilegios').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminVistaUsuario.php?f=1&idusuario=' + fila.idusuario}).trigger('reloadGrid');
            }
        });
        jQuery('#listaUsuarios').jqGrid('navGrid','#pagerUsuarios',{edit:false,add:false,del:false,search:false,view:false});
        
        jQuery('#listaUsuarios').jqGrid('navButtonAdd','#pagerUsuarios',{caption:'',title:'Nuevo',buttonicon:'ui-icon-plus',
            onClickButton:function(){
                OPERACION = 'agregar';
                jQuery('#dialogUsuario').dialog('open');
            }
        }).jqGrid('navButtonAdd','#pagerUsuarios',{caption:'',title:'Editar',buttonicon:'ui-icon-pencil',
            onClickButton:function(){
                id = jQuery('#listaUsuarios').jqGrid('getGridParam','selrow');
                if(id == null){
                    alert('Seleccione un registro');
                }
                else{
                    fila = jQuery('#listaUsuarios').jqGrid('getRowData',id);
                    llenarDatosUsuario(fila);
                    OPERACION = 'editar',
                    jQuery('#dialogUsuario').dialog('open');
                }
            }
        }).jqGrid('navButtonAdd','#pagerUsuarios',{caption:'',title:'Activo/Inactivo',buttonicon:'ui-icon-cancel',
            onClickButton:function(){
                id = jQuery('#listaUsuarios').jqGrid('getGridParam','selrow');
                if(id == null){
                    alert('Seleccione un registro');
                }
                else{
                    fila = jQuery('#listaUsuarios').jqGrid('getRowData',id);
                    //alert(fila.estado)
                    if(fila.estado=='Yes') {
                        if(confirm('\xbfEsta seguro que desea inhabilitar al usuario seleccionado')){
                            jQuery.post('/sisfac/funcionesphp/adminUsuario.php', {f:4,idusuario:id,activo:0}, function(data){
                                alert('El usuario esta inhabilitado para acceder al sistema')
                                jQuery('#listaUsuarios').trigger('reloadGrid')
                            });
                        }
                    }else{
                        if(confirm('\xbfEsta seguro que desea habilitar al usuario seleccionado')){
                            jQuery.post('/sisfac/funcionesphp/adminUsuario.php', {f:4,idusuario:id,activo:1}, function(data){
                                alert('El usuario esta habilitado para acceder al sistema')
                                jQuery('#listaUsuarios').trigger('reloadGrid')
                            });
                        }
                    }
                    
                }
            }
        });

        jQuery('#listaPrivilegios').jqGrid({
            url:'/sisfac/funcionesphp/adminVistaUsuario.php?f=1&idusuario=0',
            datetype:'xml',
            colNames:['idvistausuario','idusuario','idvista','Vista','Privilegios'],
            colModel:[
                {name:'idvistausuario',index:'idvistausuario',width:50,hidden:true},
                {name:'idusuario',index:'idusuario',width:90,hidden:true},
                {name:'idvista',index:'idvista',width:90,hidden:true},
                {name:'vista',index:'vista',width:90},
                {name:'privilegios',index:'privilegios',width:400}
            ],
            height:100,
            rowNum:100,
            rownumbers:true,
            sortname:'idusuario',
            pager:'#pagerPrivilegios',
            pginput:false,
            pgbuttons:false,
            sortorder:'asc',
            caption:'Privilegios del usuario'
        });
        //jQuery('#listaPrivilegios').jqGrid('navGrid','#pagerPrivilegios',{edit:false,add:false,del:false,search:false,view:false});
        /*jQuery('#listaPrivilegios').jqGrid('navButtonAdd','#pagerPrivilegios',{caption:'',title:'Nuevo',buttonicon:'ui-icon-plus',
            onClickButton:function(){
                if(jQuery('#listaUsuarios').jqGrid('getGridParam','selrow')==null){
                    alert('Debe seleccionar un usuario')
                    return
                }
                OPERACION = 'agregar';
                jQuery('#dialogPrivilegios').dialog('open');
            }
        }).jqGrid('navButtonAdd','#pagerPrivilegios',{caption:'',title:'Editar',buttonicon:'ui-icon-pencil',
            onClickButton:function(){
                id = jQuery('#listaPrivilegios').jqGrid('getGridParam','selrow');
                if(id==null){
                    alert('Seleccione un registro');
                    return;
                }
                llenarDatosPrivilegios(jQuery('#listaPrivilegios').jqGrid('getRowData',id));
                OPERACION = 'editar',
                jQuery('#dialogPrivilegios').dialog('open');
            }
        });*/

        jQuery('#btnBuscarPersona').click(function(){
            jQuery('#dialogPersona').dialog('open');
        });

        jQuery('#dialogPersona').dialog({
            zIndex:900,
            autoOpen:false,
            modal:true,
            width:'auto',
            height:'auto',
            buttons:{
                'Aceptar':function(){
                    fila = le.obtenerFilaSeleccionada();
                    if(!fila.idtrabajador){
                        alert('Seleccione un registro')
                    }
                    else{
                        jQuery('#hTrabajador').val(fila.idtrabajador);
                        jQuery('#tbTrabajador').val(fila.nombreCompleto);
                        jQuery('#dialogPersona').dialog('close');
                    }
                },
                'Cancelar':function(){
                    jQuery('#dialogPersona').dialog('close');
                }
            }
        });

        function privilegios(){
            p = 'index.php;';
            jQuery('input:checkbox:checked',jQuery('#dialogPrivilegios fieldset table:visible')).each(function(idx,el){
                p += jQuery(el).val() + ';';
            });
            return p;
        }

        function llenarDatosUsuario(fila){
            jQuery('#hTrabajador').val(fila.idempleado);
            jQuery('#tbTrabajador').val(fila.nombreCompleto);
            jQuery('#tbUsuario').val(fila.usuario);
            jQuery('#cbSucursal').val(fila.idsucursal);
            jQuery('#tbClave').val('--SINCLAVE.SINCLAVE.SINCLAVE--');
            jQuery('#tbRepetirClave').val('--SINCLAVE.SINCLAVE.SINCLAVE--');
            jQuery('#tbDireccionIP').val(fila.direccionip);
            jQuery('#cbTipoUsuario').val(fila.tipo);
            if(fila.tipo=='NOR') jQuery('#cbSucursal').removeAttr('disabled')
            else jQuery('#cbSucursal').attr('disabled', 'disabled')
            jQuery('#chbEstado').attr('checked',fila.estado==1||fila.estado=='Yes');
        }

        function llenarDatosPrivilegios(fila){
            jQuery('#cbModulo').val(fila.idvista).change();
            //jQuery('#tablaModulos label[idmodulo="' + fila.idmodulo + '"]').addClass('ui-state-active').click();
            jQuery('#cbArea').val(fila.idarea).change();
            jQuery('#chbEstado').attr('checked',fila.estusu==1||fila.estusu=='Yes');
            jQuery('#dialogPrivilegios fieldset table[modulo="'+fila.vista+'"] input:checkbox').each(function(idx,el){

                if( fila.privilegios.indexOf(jQuery(el).val()) != -1 ) jQuery(el).attr('checked',true);
                else jQuery(el).attr('checked',false);
            });
        }


        jQuery('#cbModulo').change(function(){
            //alert(jQuery('#cbModulo option[value="' + jQuery('#cbModulo').val() + '"]').attr('tabla'))
            jQuery('#dialogPrivilegios #tablaPrivilegios table').hide();
            jQuery('#' + jQuery('#cbModulo option[value="' + jQuery('#cbModulo').val() + '"]').attr('tabla')).show();
        });
    }
    validarCaracteres()
});
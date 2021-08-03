/* 
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.



*/

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
    listaEtapaNino
    listaEtapaAdolescente
    listaEtapaJoven
    listaEtapaAdulto
    listaRiesgoFamilialistaInmunizaciones
    listaMiembroTiene
    listaRiesgoGestante
 */
//resetSelection limpiar multiselect $('#lista').jqGrid(resetSelection)
function ejecutarFuncion(obj, idtabla) {
    var valorSeleccionado = obj.options[obj.selectedIndex].value;
    lista = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
    if (valorSeleccionado == 'AUTOMATICA') {
        $.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                f: 2,
                fecha: lista.fechaNacimiento,
                dias: $('#' + idtabla + ' input[name=tbFactorProgramacion]').attr('val')
            },
            function(data) {
                $('#' + idtabla + ' input[name=tbFechaProgramana]').val(data)
            })
    } else {
        $('#' + idtabla + ' input[name=tbFechaProgramana]').val('')
    }
}
$(document).ready(function() {
    var posicionAlerta = {
        "dir1": "up",
        "dir2": "left",
        "firstpos1": 15,
        "firstpos2": 15
    };

    /*$.pnotify({
        pnotify_title: 'Visitas programadas',
        pnotify_text: 'Bienvenido ' + USU,
        pnotify_animation: 'show',
        pnotify_notice_icon: 'ui-icon ui-icon-mail-closed',
        pnotify_addclass: 'stack-bottomright',
        pnotify_stack: posicionAlerta
    });*/

    //MBF
    $('#opMigrarComunidad').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }

        $('#btnImportarComunidad').button()

        f = new AjaxUpload($('form#formComunidad #btnImportarComunidad'), {
            action: '/sisfac/funcionesphp/adminImportaComunidad.php',
            autoSubmit: true,
            name: 'userfile',
            onChange: function(file, extension) {
                //jQu<ery('#rutarchivo').attr('src','/sigurmun/licconst/archivosLicencia/' + numeroExpediente + '/' +file);
            },
            onSubmit: function(file, ext) {
                //ta='jpg|jpeg|png|pdf|dwg|dxf|avi|mp4|doc|docx|xls'
                if (ext && /^(txt|sql)$/.test(ext)) {
                    this.disable();
                } else {
                    alert('S\xf3lo se aceptan archivos de texto o sql');
                    return false
                }
            },
            onComplete: function(file, response) {
                alert('La importacion se realizo con exito')
              
            }
        });

        mostrarContenido('contenidoMigraComunidad')

    });

    //MBF
    $('#opReporteAcopio').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }

        $.ajax({
            url: '/sisfac/funcionesphp/adminAcopio.php',
            type: 'post',
            data: {
                tipo: 'diresa'
            },
            dataType: 'html',
            success: function(respuesta) {
                $('#tablaReporteAcopio tbody').html(respuesta);
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });

        mostrarContenido('contenidoReporteAcopio')

    });



    function getDiresa() {

        $.ajax({
            url: '/sisfac/funcionesphp/adminUbigeo.php',
            type: 'post',
            data: {
                tipo: 'diresa'
            },
            dataType: 'html',
            success: function(respuesta) {
                $('#ubigeo_diresa').html(respuesta);
                $('#ubigeo_diresa_origen').html(respuesta);
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });

    }
    getDiresa();


    //MBF
    $('#ubigeo_diresa_origen').change(function() {

        $('#ubigeo_red_origen').html("");
        $('#ubigeo_microred_origen').html("");
        $('#ubigeo_establecimiento_origen').html("");
        $('#ubigeo_comunidad_origen').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'red',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_red_origen').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }


    });


    //MBF
    $('#ubigeo_red_origen').change(function() {

        $('#ubigeo_microred_origen').html("");
        $('#ubigeo_establecimiento_origen').html("");
        $('#ubigeo_comunidad_origen').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'microred',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_microred_origen').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }


    });

    //MBF
    $('#ubigeo_microred_origen').change(function() {

        $('#ubigeo_establecimiento_origen').html("");
        $('#ubigeo_comunidad_origen').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'establecimiento',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_establecimiento_origen').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }

    });
    //MBF
    $('#ubigeo_establecimiento_origen').change(function() {

        $('#ubigeo_comunidad_origen').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'comunidad',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_comunidad_origen').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }

    });

    //MBF
    $('#ubigeo_diresa').change(function() {

        $('#ubigeo_red').html("");
        $('#ubigeo_microred').html("");
        $('#ubigeo_establecimiento').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'red',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_red').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }


    });


    //MBF
    $('#ubigeo_red').change(function() {

        $('#ubigeo_microred').html("");
        $('#ubigeo_establecimiento').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'microred',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_microred').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }


    });

    //MBF
    $('#ubigeo_microred').change(function() {

        $('#ubigeo_establecimiento').html("");

        if ($(this).val() > 0) {

            $.ajax({
                url: '/sisfac/funcionesphp/adminUbigeo.php',
                type: 'post',
                data: {
                    tipo: 'establecimiento',
                    id: $(this).val()
                },
                dataType: 'html',
                success: function(respuesta) {
                    $('#ubigeo_establecimiento').html(respuesta);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        }


    });
    //MBF
    $('#migrar_comunidad').click(function(e) {

        e.preventDefault();

        if ($("#ubigeo_comunidad_origen").val() == 0) {
            alert("Selecciona la comunidad que desea migrar.")
            return;
        }


        if ($("#ubigeo_establecimiento option").length == 0 || $("#ubigeo_establecimiento").val() == 0) {
            alert("Selecciona un establecimiento.")
            return;
        }

        var r = confirm("Haga un respaldo de la base de datos antes de continuar.");
        if (r == true) {
            window.open("/sisfac/funcionesphp/adminMigraComunidad.php?establecimiento_destino="+$("#ubigeo_establecimiento").val()+"&establecimiento_origen="+$("#ubigeo_establecimiento_origen").val()+"&comunidad_origen="+$("#ubigeo_comunidad_origen").val()); 

        } 

        

    });

    function validarHistorial() {

        return true
        if (TIPOUSU != 'VIS') {
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
            if (lista.opcion == 'SI') return false
            else return true
        } else {
            return true
        }
    }

    $('#opInicio').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        mostrarContenido('contenidoInicio')
    })

    var CUENTA = CUENTA1 = CUENTA2 = CUENTA3 = CUENTA4 = CUENTA5 = CUENTA6 = CUENTA7 = CUENTA8 = CUENTA9 = CUENTA10 = CUENTA11 = CUENTA12 = CUENTA13 = CUENTA14 = CUENTA15 = CUENTA16 = CUENTA17 = CUENTA18 = CUENTA19 = CUENTA20 = CUENTA21 = CUENTA22 = CUENTA23 = CUENTA24 = CUENTA25 = CUENTA26 = CUENTA27 = CUENTA28 = CUENTA29 = CUENTA30 = CUENTA31 = CUENTA32 = CUENTA33 = CUENTA34 = CUENTA35 = CUENTA36 = CUENTA37 = CUENTA38 = CUENTA39 = CUENTA40 = CUENTA41 = ''
    $('#opFicha,#opFicha1').click(function() {
        $('#cbTipoEntorno,#cbComunidad,#cbMedioTransporte').width(110)
        $('#cbReligion,#cbTipoFamilia,#cbTipoEntorno,#cbTiempoDomicilio,#cbMedioTransporte').width(160)
        $('#cbRegion,#cbProvincia,#cbDistrito,#cbEstablecimiento,#cbComunidad,#cbSector,#cbVivienda,#cbFamilia').width(160)
        $('#tbNombreFamilia').width(455)
        $('#cbComunidad').change(function() {
            $('#cbSector').load('/sisfac/funcionesphp/adminSector.php', {
                f: 3,
                idcomunidad: $('#cbComunidad').val()
            }, function() {
                $('#cbSector').prepend("<option value='' selected>Seleccione una opci&oacute;n</option>")
            })
        })

        for (i = 10; i >= 0; i--) {
            $('#cbTiempoHoraDemora').prepend("<option value=" + (i < 10 ? '0' + i : i) + ">" + (i < 10 ? '0' + i : i) + "</option>")
        }
        for (i = 24; i >= 0; i--) {
            $('#cbHoraVisita').prepend("<option value=" + (i < 10 ? '0' + i : i) + ">" + (i < 10 ? '0' + i : i) + "</option>")
        }
        for (i = 59; i >= 0; i--) {
            $('#cbMinutoVisita').prepend("<option value=" + (i < 10 ? '0' + i : i) + ">" + (i < 10 ? '0' + i : i) + "</option>")
            $('#cbTiempoMinutoDemora').prepend("<option value=" + (i < 10 ? '0' + i : i) + ">" + (i < 10 ? '0' + i : i) + "</option>")
        }

        for (i = 999; i > 0; i--) {
            //$('#cbVivienda').prepend("<option value=" + (i<10?'000' + i:(i<100?'00' + i:(i<1000?'0' + i:i))) + ">" + (i<10?'000' + i:(i<100?'00' + i:(i<1000?'0' + i:i))) + "</option>")
            $('#cbVivienda').prepend("<option value=" + (i < 10 ? '00' + i : (i < 100 ? '0' + i : (i < 1000 ? '' + i : i))) + ">" + (i < 10 ? '00' + i : (i < 100 ? '0' + i : (i < 1000 ? '' + i : i))) + "</option>")
        }
        $('#cbVivienda').prepend("<option value=''>Seleccione una opci&oacute;n</option>")

        var letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $("#cbFamilia").html('')
        for (i = 0; i < letras.length; i++) {
            $("#cbFamilia").append("<option value'" + letras[i] + "'>" + letras[i] + "</option>");
        }

        $('#cbFamilia').prepend("<option value=''>Seleccione una opci&oacute;n</option>")

        if (!CUENTA) contenidoFicha()
        mostrarContenido('contenidoFicha')
        CUENTA = 1
    })


    $('#opFichaClinica,#opFichaClinica1').click(function() {
        if (!CUENTA29) contenidoFichaClinica()
        mostrarContenido('contenidoFichaClinica')
        CUENTA29 = 1
    })

    $('#opConsultaFicha').click(function() {
        if (!CUENTA30) contenidoConsultaFicha()
        mostrarContenido('contenidoConsultaFicha')
        CUENTA30 = 1
    })

    $('#opProvincia,#opProvincia1').click(function() {
        if (!CUENTA1) contenidoProvincia()
        mostrarContenido('contenidoProvincia')
        CUENTA1 = 1
    })
    $('#opTrabajadores,#opTrabajadores1').click(function() {
        if (!CUENTA2) contenidoTrabajadores()
        mostrarContenido('contenidoTrabajadores')
        CUENTA2 = 1
    })
    $('#opSector').click(function() {
        if (!CUENTA3) contenidoSector()
        mostrarContenido('contenidoSector')
        CUENTA3 = 1
    })
    $('#opEstablecimiento').click(function() {
        if (!CUENTA4) contenidoEstablecimiento()
        mostrarContenido('contenidoEstablecimiento')
        CUENTA4 = 1
    })
    $('#opComunidad').click(function() {
        if (!CUENTA5) contenidoComunidad()
        mostrarContenido('contenidoComunidad')
        CUENTA5 = 1
    })

    $('#opReporteEstadistico,#opReporte1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA6) contenidoReporteEstadistico()
        mostrarContenido('contenidoReporteEstadistico')
        CUENTA6 = 1
    })
    $('#opReporteEtapa,#opReporteEtapa1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA7) contenidoReporteEtapa()
        mostrarContenido('contenidoReporteEtapa')
        CUENTA7 = 1
    })
    $('#opReporteSocioeconomico').click(function() {
        if (!CUENTA8) contenidoReporteSocioeconomico()
        mostrarContenido('contenidoReporteSocioeconomico')
        CUENTA8 = 1
    })
    $('#opReportePaifam,#opReportePaifam1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA9) contenidoReportePaifam()
        mostrarContenido('contenidoReportePaifam')
        CUENTA9 = 1
    })
    $('#opReporteProgramacion').click(function() {
        if (!CUENTA10) contenidoReporteProgramacion()
        mostrarContenido('contenidoReporteProgramacion')
        CUENTA10 = 1
    })
    $('#opReporteVisita').click(function() {
        if (!CUENTA11) contenidoReporteVisita()
        mostrarContenido('contenidoReporteVisita')
        CUENTA11 = 1
    })
    $('#opCopiaBase,#opCopiaBase1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (TIPOUSU == 'VIS') {
            alert('Usted no tiene permiso para esta opcion')
        } else {
            if (!CUENTA12) contenidoCopiaBase()
            mostrarContenido('contenidoCopiaBase')
            CUENTA12 = 1
        }

    })
    $('#opCopiaBaseGeneral,#opCopiaBaseGeneral1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (TIPOUSU == 'VIS') {
            alert('Usted no tiene permiso para esta opcion')
        } else {
            if (!CUENTA27) contenidoCopiaBaseGeneral()
            mostrarContenido('contenidoCopiaBaseGeneral')
            CUENTA27 = 1
        }
    })
    $('#opRertaurarBase').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA40) contenidoRestaurarBase()
        mostrarContenido('contenidoRestaurarBase')
        CUENTA40 = 1
    })
    $('#opRegion').click(function() {

        if (validarHistorial() == false) {
            alert('Debe guardar el historial')
            return false
        }

        if (!CUENTA13) contenidoRegion()
        mostrarContenido('contenidoRegion')
        CUENTA13 = 1
    })
    $('#opDiresa').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA25) contenidoDiresa()
        mostrarContenido('contenidoDiresa')
        CUENTA25 = 1
    })
    $('#opRed').click(function() {
        if (!CUENTA14) contenidoRed()
        mostrarContenido('contenidoRed')
        CUENTA14 = 1
    })
    $('#opReportes').click(function() {
        if (!CUENTA15) contenidoReportes()
        mostrarContenido('contenidoReportes')
        CUENTA15 = 1
    })
    $('#opAyuda,#opAyuda1').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        window.open('/sisfac/manual/manual.pdf', '', 'toolbar=false')
    })
    $('#opConsultaHistorico,#opHistorial').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        if (!CUENTA16) contenidoConsultaHistorico()
        mostrarContenido('contenidoConsultaHistorico')
        CUENTA16 = 1
    })
    $('#opReporteFichaIndividual').click(function() {
        if (!CUENTA31) contenidoReporteFichaIndividual()
        mostrarContenido('contenidoReporteFichaIndividual')
        CUENTA31 = 1
    })

    $('#opCatalogoCIE10').click(function() {
        if (!CUENTA32) contenidoCatalogoCIE10()
        mostrarContenido('contenidoCatalogoCIE10')
        CUENTA32 = 1
    })

    $('#opCatalogoMedicamento').click(function() {
        if (!CUENTA33) contenidoCatalogoMedicamento()
        mostrarContenido('contenidoCatalogoMedicamento')
        CUENTA33 = 1
    })

    $('#opCatalogoPrestaciones').click(function() {
        if (!CUENTA34) contenidoCatalogoPrestaciones()
        mostrarContenido('contenidoCatalogoPrestaciones')
        CUENTA34 = 1
    })

    $('#opCatalogoHIS').click(function() {
        if (!CUENTA35) contenidoCatalogoHIS()
        mostrarContenido('contenidoCatalogoHIS')
        CUENTA35 = 1
    })

    $('#opCatalogoEpisodio').click(function() {
        if (!CUENTA36) contenidoCatalogoEpisodio()
        mostrarContenido('contenidoCatalogoEpisodio')
        CUENTA36 = 1
    })

    $('#opCatalogoFinanciadores').click(function() {
        if (!CUENTA37) contenidoCatalogoFinanciadores()
        mostrarContenido('contenidoCatalogoFinanciadores')
        CUENTA37 = 1
    })

    $('#opCatalogoLaboratorio').click(function() {
        if (!CUENTA38) contenidoCatalogoLaboratorio()
        mostrarContenido('contenidoCatalogoLaboratorio')
        CUENTA38 = 1
    })

    $('#opMaestra').click(function() {
        if (!CUENTA39) contenidoMaestra()
        mostrarContenido('contenidoMaestra')
        CUENTA39 = 1
    })

    $('#opCargarCsv').click(function() {
        if (!CUENTA41) contenidoCargarCsv()
        mostrarContenido('contenidoCargarCsv')
        CUENTA41 = 1
    })

    $('#opAcerdade').click(function() {
        if (validarHistorial() == false) {
            alert('Debe guardar el historial para salir de esta secci\xf3n')
            return false
        }
        mostrarContenido('contenidoAcercade')
    })

    function llenarGridMultiselect() {
        //PARA EL SEGUNDO TAB
        $("#listaEtapaNino").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Etapa nino (0-11 anos)"
        });
        var mydata = [{
            id: '1',
            riesgo: "Incompleto/NO tiene PAIS de acuerdo a su edad",
            puntaje: 1
        }, {
            id: '2',
            riesgo: "Recien nacido de parto domiciliario",
            puntaje: 1
        }, {
            id: '3',
            riesgo: "Recien nacido (<28 dias)",
            puntaje: 5
        }, {
            id: '4',
            riesgo: "Nino < 6 meses sin LME adecuada",
            puntaje: 5
        }, {
            id: '5',
            riesgo: "Nino < de 5 anos con vacunas incompletas",
            puntaje: 5
        }, {
            id: '6',
            riesgo: "Nino < de 3 anos sin CRED",
            puntaje: 5
        }, {
            id: '7',
            riesgo: "Nino < de 3 anos sin suplemento de Hierro/ Vit A",
            puntaje: 5
        }, {
            id: '8',
            riesgo: "Sin descarte de parasitos",
            puntaje: 5
        }, {
            id: '9',
            riesgo: "Problemas visuales",
            puntaje: 1
        }, {
            id: '10',
            riesgo: "Desercion Escolar",
            puntaje: 1
        }, {
            id: '11',
            riesgo: "Sin evaluacion Odontologica",
            puntaje: 5
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaEtapaNino").jqGrid('addRowData', i + 1, mydata[i]);

        $("#listaEtapaAdolescente").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Etapa adolescente (12-17 anos)"
        });
        var mydata = [{
            id: '12',
            riesgo: "Incompleto / NO tiene  PAIS",
            puntaje: 1
        }, {
            id: '13',
            riesgo: "Vacunas incompletas ",
            puntaje: 1
        }, {
            id: '14',
            riesgo: "Problemas visuales",
            puntaje: 1
        }, {
            id: '15',
            riesgo: "Sin evaluacion dental",
            puntaje: 1
        }, {
            id: '16',
            riesgo: "Madre/Padre adolescente",
            puntaje: 5
        }, {
            id: '17',
            riesgo: "Problemas de conducta y/o alimentacion",
            puntaje: 1
        }, {
            id: '18',
            riesgo: "Mal control de impulsos",
            puntaje: 5
        }, {
            id: '19',
            riesgo: "Desercion escolar",
            puntaje: 1
        }, {
            id: '20',
            riesgo: "Sedentarismo",
            puntaje: 1
        }, {
            id: '21',
            riesgo: "Consumo de alcohol/tabaco",
            puntaje: 5
        }, {
            id: '22',
            riesgo: "Consumo de otras sustancias ilicitas",
            puntaje: 5
        }, {
            id: '23',
            riesgo: "Conductas sexual de riesgo",
            puntaje: 5
        }, {
            id: '24',
            riesgo: "Participacion en pandillas/delincuencia",
            puntaje: 1
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaEtapaAdolescente").jqGrid('addRowData', i + 12, mydata[i]);

        $("#listaEtapaJoven").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Etapa joven/adulto(18-59 anos)"
        });
        var mydata = [{
            id: '25',
            riesgo: "Incompleto/NO tiene PAIS",
            puntaje: 1
        }, {
            id: '26',
            riesgo: "Vacunas incompletas",
            puntaje: 1
        }, {
            id: '27',
            riesgo: "Sin evaluacion Odontologica",
            puntaje: 1
        }, {
            id: '28',
            riesgo: "Problemas visuales",
            puntaje: 1
        }, {
            id: '29',
            riesgo: "Mujer(MSA) sin Papanicolaou anual",
            puntaje: 1
        }, {
            id: '30',
            riesgo: "Mujer >50 anos sin mamografia",
            puntaje: 1
        }, {
            id: '31',
            riesgo: "Mujer >35 /Hombre >35 sin Examen de colesterol",
            puntaje: 1
        }, {
            id: '32',
            riesgo: "Hombre >50 sin evaluacion de prostata",
            puntaje: 1
        }, {
            id: '33',
            riesgo: "MEF/HEF sin planificacion familiar",
            puntaje: 5
        }, {
            id: '34',
            riesgo: "Consumo de alcohol/tabaco",
            puntaje: 5
        }, {
            id: '35',
            riesgo: "Consumo de otras sustancias ilicitas",
            puntaje: 5
        }, {
            id: '36',
            riesgo: "Sedentarismo",
            puntaje: 1
        }, {
            id: '37',
            riesgo: "Mal control de impulsos/violento",
            puntaje: 1
        }, {
            id: '38',
            riesgo: "Conducta sexual de riesgo",
            puntaje: 1
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaEtapaJoven").jqGrid('addRowData', i + 25, mydata[i]);

        $("#listaEtapaAdulto").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Etapa adulto mayor(60 anos a mas)"
        });

        var mydata = [{
            id: '39',
            riesgo: "Incompleto/ NO tiene  PAIS",
            puntaje: 1
        }, {
            id: '40',
            riesgo: "Vacuna incompletas",
            puntaje: 1
        }, {
            id: '41',
            riesgo: "Sin evaluacion dental",
            puntaje: 5
        }, {
            id: '42',
            riesgo: "Problemas visuales",
            puntaje: 1
        }, {
            id: '43',
            riesgo: "Apetito disminuido",
            puntaje: 1
        }, {
            id: '44',
            riesgo: "Dependiente parcial o total",
            puntaje: 5
        }, {
            id: '45',
            riesgo: "Mujer(MSA) sin papanicolaou anual",
            puntaje: 1
        }, {
            id: '46',
            riesgo: "Mujer sin mamografia",
            puntaje: 1
        }, {
            id: '47',
            riesgo: "Mujer sin examen de colesterol",
            puntaje: 1
        }, {
            id: '48',
            riesgo: "Hombre sin evaluacion de prostata",
            puntaje: 1
        }, {
            id: '49',
            riesgo: "Sin actividad fisica",
            puntaje: 1
        }, {
            id: '50',
            riesgo: "Conducta sexual de riesgo",
            puntaje: 1
        }, {
            id: '51',
            riesgo: "Abandono familiar/social",
            puntaje: 5
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaEtapaAdulto").jqGrid('addRowData', i + 39, mydata[i]);

        $("#listaRiesgoFamilia").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Riesgo familiar"
        });



        var mydata = [{
            id: '52',
            riesgo: "Familia monoparental",
            puntaje: 7
        }, {
            id: '53',
            riesgo: "Mala comunicacion intrafamiliar",
            puntaje: 1
        }, {
            id: '54',
            riesgo: "Conflictos/violencia familiar",
            puntaje: 10
        }, {
            id: '55',
            riesgo: "Con malas pautas de crianza o convivencia",
            puntaje: 1
        }, {
            id: '56',
            riesgo: "Presencia de un miembro de la familia con discapacidad",
            puntaje: 1
        }, {
            id: '57',
            riesgo: "Presencia de un miembro con enfermedad cronica",
            puntaje: 14
        }, {
            id: '67',
            riesgo: "Familia con integrante menor de 36 meses con anemia",
            puntaje: 18
        }, {
            id: '68',
            riesgo: "Familia con integrante menor de 36 meses con desnutricion",
            puntaje: 17
        }, {
            id: '69',
            riesgo: "Familia en ciclo vital en expansion con ninos con menores de 36 meses",
            puntaje: 16
        }, {
            id: '70',
            riesgo: "Familia con integrante gestante",
            puntaje: 15
        }, {
            id: '72',
            riesgo: "Familia con uno o mas integrantes con tuberculosis y/o VIH/SIDA",
            puntaje: 13
        }, {
            id: '73',
            riesgo: "Familia con miembro en curso de vida adolescente",
            puntaje: 12
        } , {
            id: '73',
            riesgo: "Familia con uno o mas integrantes con autoestima baja",
            puntaje: 11
        } , {
            id: '75',
            riesgo: "Uniones consensuales (dos o mas parejas en paralelo)",
            puntaje: 9
        } , {
            id: '76',
            riesgo: "Familia reconstituida",
            puntaje: 8
        } , {
            id: '78',
            riesgo: "Familia en alto riesgo por vivienda y entorno",
            puntaje: 6
        } , {
            id: '79',
            riesgo: "Familia sin redes de apoyo",
            puntaje: 5
        } , {
            id: '80',
            riesgo: "Familia en situación de pobreza (ingreso menor a 750 NS)",
            puntaje: 4
        } , {
            id: '81',
            riesgo: "Familia con integrante alcoholico",
            puntaje: 3
        } , {
            id: '82',
            riesgo: "Familia sin acceso a servicios de salud",
            puntaje: 2
        } , {
            id: '83',
            riesgo: "Familia con integrantes sin seguro de salud",
            puntaje: 1
        } 

        ];


        mydata.forEach(function(item, index){

            $("#listaRiesgoFamilia").jqGrid('addRowData', item.id, item);

        });

        $("#listaMiembroTiene").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Riesgo de algun miembro de la familia"
        });
        var mydata = [{
            id: '58',
            riesgo: "Tos mas de 14 dias /fiebre/perdida de peso",
            puntaje: 5
        }, {
            id: '59',
            riesgo: "HTA, DM. TBC, HIV u otra Enfermedad",
            puntaje: 5
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaMiembroTiene").jqGrid('addRowData', i + 58, mydata[i]);

        $("#listaRiesgoGestante").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Riesgos', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 250,
                hidden: true
            }, {
                name: 'riesgo',
                index: 'riesgo',
                width: 250
            }, {
                name: 'puntaje',
                index: 'puntaje',
                width: 250,
                hidden: true
            }, ],
            multiselect: true,
            caption: "Riesgo de gestante"
        });
        var mydata = [{
            id: '60',
            riesgo: "Sin/incompleto APNR (paquete minimo)",
            puntaje: 5
        }, {
            id: '61',
            riesgo: "Gestante adolescente",
            puntaje: 5
        }, {
            id: '62',
            riesgo: "Gestante anosa",
            puntaje: 5
        }, {
            id: '63',
            riesgo: "Gestante gran multipara",
            puntaje: 5
        }, {
            id: '64',
            riesgo: "Vacunas incompletas",
            puntaje: 1
        }, {
            id: '65',
            riesgo: "Sin/Irregular APN",
            puntaje: 1
        }, {
            id: '66',
            riesgo: "Sin psicoprofilaxis",
            puntaje: 1
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaRiesgoGestante").jqGrid('addRowData', i + 60, mydata[i]);

        //PARA EL CUARTO TAB
        $("#listaVivienda").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            //multiselect:true,
            caption: "Tipo de vivienda"
        });
        var mydata = [{
            id: '1',
            entorno: "Casa unifamiliar"
        }, {
            id: '2',
            entorno: "Vivienda multifamiliar"
        }, {
            id: '3',
            entorno: "Pasaje"
        }, {
            id: '4',
            entorno: "Quinta"
        }, {
            id: '5',
            entorno: "Callejon"
        }, ];
        for (var i = 0; i <= mydata.length; i++) $("#listaVivienda").jqGrid('addRowData', i + 1, mydata[i]);

        $("#listaParedes").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Material de paredes"
        });
        var mydata = [{
            id: '6',
            entorno: "Madera, estera"
        }, {
            id: '7',
            entorno: "Adobe"
        }, {
            id: '8',
            entorno: "Estera y adobe"
        }, {
            id: '9',
            entorno: "Noble (Ladrillo y cemento)"
        }, {
            id: '10',
            entorno: "Otros"
        }, ];
        for (var i = 0; i <= mydata.length; i++) $("#listaParedes").jqGrid('addRowData', i + 6, mydata[i]);

        $("#listaPiso").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Material del piso"
        });
        var mydata = [{
            id: '11',
            entorno: "Tierra"
        }, {
            id: '12',
            entorno: "Entablado"
        }, {
            id: '13',
            entorno: "Piso pulido"
        }, {
            id: '14',
            entorno: "Losetas, vinilitos o similares"
        }, {
            id: '15',
            entorno: "Parquet"
        }, {
            id: '16',
            entorno: "Otros"
        }, ];
        for (var i = 0; i <= mydata.length; i++) $("#listaPiso").jqGrid('addRowData', i + 11, mydata[i]);

        $("#listaTecho").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Material del techo"
        });

        var mydata = [{
            id: '17',
            entorno: "Estera"
        }, {
            id: '18',
            entorno: "Paja u hojas"
        }, {
            id: '19',
            entorno: "Madera y barro"
        }, {
            id: '20',
            entorno: "Calamina"
        }, {
            id: '21',
            entorno: "Noble (Ladrillo y cemento)"
        }, {
            id: '22',
            entorno: "Otros"
        }, ];
        for (var i = 0; i <= mydata.length; i++) $("#listaTecho").jqGrid('addRowData', i + 17, mydata[i]);

        $("#listaOrganizacionVivienda").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            width: 270,
            //hiddengrid: true,
            caption: "Organizacion de la vivienda(no cuenta con...)"
        });
        var mydata = [{
            id: '23',
            entorno: "Alacena"
        }, {
            id: '24',
            entorno: "Refrigeradora ecologica"
        }, {
            id: '25',
            entorno: "Cocina mejorada"
        }, {
            id: '26',
            entorno: "Organizador de ropa"
        }, {
            id: '27',
            entorno: "Camas"
        }, {
            id: '28',
            entorno: "Rincon de aseo (lavadero)"
        }, {
            id: '29',
            entorno: "Ducha"
        }, {
            id: '30',
            entorno: "Otros:"
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaOrganizacionVivienda").jqGrid('addRowData', i + 23, mydata[i]);

        $("#listaArtefactos").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Artefactos del hogar"
        });

        var mydata = [{
            id: '31',
            entorno: "Radio"
        }, {
            id: '32',
            entorno: "Television"
        }, {
            id: '33',
            entorno: "Telefono"
        }, {
            id: '34',
            entorno: "DVD o VHS"
        }, {
            id: '35',
            entorno: "Refrigeradora"
        }, {
            id: '36',
            entorno: "Lavadora"
        }, {
            id: '37',
            entorno: "Automovil"
        }, {
            id: '38',
            entorno: "Motocicleta"
        }, {
            id: '39',
            entorno: "Cocina y horno electrico"
        }, {
            id: '40',
            entorno: "Horno microonda"
        }, {
            id: '41',
            entorno: "Computadora"
        }, {
            id: '42',
            entorno: "Otros"
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaArtefactos").jqGrid('addRowData', i + 31, mydata[i]);

        $("#listaCombustible").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Combustible para cocinar"
        });
        var mydata = [{
            id: '43',
            entorno: "Lena carbon"
        }, {
            id: '44',
            entorno: "Bosta"
        }, {
            id: '45',
            entorno: "Kerosene"
        }, {
            id: '46',
            entorno: "Gas"
        }, {
            id: '47',
            entorno: "Electricidad"
        }];
        for (var i = 0; i <= mydata.length; i++) $("#listaCombustible").jqGrid('addRowData', i + 43, mydata[i]);

        $("#listaBasura").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Disposicion de basura"
        });
        var mydata = [{
            id: '48',
            entorno: "A campo abierto"
        }, {
            id: '49',
            entorno: "Al rio"
        }, {
            id: '50',
            entorno: "En un pozo"
        }, {
            id: '51',
            entorno: "Se entierra, quema"
        }, {
            id: '52',
            entorno: "Carro recolector"
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaBasura").jqGrid('addRowData', i + 48, mydata[i]);

        $("#listaAnimales").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Tenencia de animales"
        });
        var mydata = [{
            id: '53',
            entorno: "Zona de peste"
        }, {
            id: '54',
            entorno: "Perro"
        }, {
            id: '55',
            entorno: "Gato"
        }, {
            id: '56',
            entorno: "Aves de corral"
        }, {
            id: '57',
            entorno: "Cabras"
        }, {
            id: '58',
            entorno: "Carneros"
        }, {
            id: '59',
            entorno: "Cerdos"
        }, {
            id: '60',
            entorno: "Vacas"
        }, {
            id: '61',
            entorno: "Cuy intradomiciliario"
        }, {
            id: '62',
            entorno: "Cuy en galpon"
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaAnimales").jqGrid('addRowData', i + 53, mydata[i]);

        $("#listaVacunas").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Vacunas"
        });
        var mydata = [{
            id: '63',
            entorno: "Perro"
        }, {
            id: '64',
            entorno: "Gato"
        }, {
            id: '65',
            entorno: "Aves de corral"
        }, {
            id: '66',
            entorno: "Cabras"
        }, {
            id: '67',
            entorno: "Carneros"
        }, {
            id: '68',
            entorno: "Cerdos"
        }, {
            id: '69',
            entorno: "Vacas"
        }, {
            id: '70',
            entorno: "Cuy intradomiciliario"
        }, {
            id: '71',
            entorno: "Cuy en galpon"
        }, ];

        for (var i = 0; i <= mydata.length; i++) $("#listaVacunas").jqGrid('addRowData', i + 63, mydata[i]);

        $("#listaEntorno").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Riesgo por entorno"
        });

        var mydata = [{
            id: '72',
            entorno: "Deposito de agua no tapada"
        }, {
            id: '73',
            entorno: "Sin alcantarillado"
        }, {
            id: '74',
            entorno: "Vectores (mosquitos, roedores, etc.)"
        }, {
            id: '75',
            entorno: "Ruidos"
        }, {
            id: '76',
            entorno: "Humos o vapores"
        }, {
            id: '77',
            entorno: "Derrumbes"
        }, {
            id: '78',
            entorno: "Inundaciones"
        }, {
            id: '79',
            entorno: "Basural junto a la  vivienda"
        }, {
            id: '80',
            entorno: "Agua no clorada"
        }, {
            id: '81',
            entorno: "Murcielago en vivienda"
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaEntorno").jqGrid('addRowData', i + 72, mydata[i]);

        $("#listaBiohuerto").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', '¿Quien lo financia?'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'entorno',
                index: 'entorno',
                width: 150,
                editable: true
            }, ],
            multiselect: true
                //caption: "Biohuerto"

        });
        var mydata = [{
            id: '82',
            entorno: "Autofinanciado"
        }, {
            id: '83',
            entorno: "Municipio"
        }, {
            id: '84',
            entorno: "ONG"
        }, {
            id: '85',
            entorno: "OTROS"
        }];

        for (var i = 0; i <= mydata.length; i++) $("#listaBiohuerto").jqGrid('addRowData', i + 82, mydata[i]);
    }

    function obtenerValores(data) {
        var temp = Array(),
            i = 0,
            nombre = Array('ESTADO CIVIL DEL JEFE DE FAMILIA', 'GRUPO FAMILIAR', 'TENENCIA DE LA VIVIENDA', 'AGUA DE CONSUMO', 'ELIMINACION DE EXCRETAS', 'CUANTAS HABITACIONES HAY EN HOGAR', 'ENERGIA ELECTRICA(EE)', 'NIVEL DE INSTRUCCION DE LA MADRE', 'OCUPACION JEFE DE LA FAMILIA', 'INGRESOS FAMILIARES', 'NRO DE PERSONAS X DORMITORIO')
        $(data).each(function(index) {
            temp[i] = nombre[i] + '-' + $(this).attr('value') + '-' + ($(this).attr('puntaje') == undefined ? '' : $(this).attr('puntaje'))
            i++
        })

        ids = $('#listaSaludHogar').jqGrid('getGridParam', 'selarrrow')
        temp[i] = 'SALUD EN EL HOGAR' + '--' + 0
        for (j in ids) {
            lista = $('#listaSaludHogar').jqGrid('getRowData', ids[j])
            temp[i] = 'SALUD EN EL HOGAR' + '-' + lista.tipo + '-' + 0
            i++
        }
        return temp.join('+')
    }

    function obtenerCiclo(lista) {
        var data = Array()
        ids = $('#' + lista).jqGrid('getGridParam', 'selarrrow')
        for (i in ids) {
            temp = $('#' + lista).jqGrid('getRowData', ids[i])
            data[i] = temp.id + '+' + temp.ciclo
        }
        return data.join('*')
    }

    function obtenerCondicion(lista) {
        var data = Array()
        ids = $('#' + lista).jqGrid('getGridParam', 'selarrrow')
        ids = ids.filter(Boolean);
        for (i in ids) {
            temp = $('#' + lista).jqGrid('getRowData', ids[i])
            data[i] = temp.id + '+' + temp.nombre
        }
        return data.join('-')
    }

    function obtenerRiesgo(lista) {
        var data = Array()
        ids = $('#' + lista).jqGrid('getGridParam', 'selarrrow')
            //alert(ids)

        for (i in ids) {
            temp = $('#' + lista).jqGrid('getRowData', ids[i])
            data[i] = temp.riesgo + '+' + temp.id + '+' + temp.puntaje
        }
        return data.join('-')
    }

    function obtenerEntorno(lista, tipo) {
        var data = Array()
        ids = $('#' + lista).jqGrid('getGridParam', 'selarrrow')

        if (lista == 'listaVivienda') ids = $('#' + lista).jqGrid('getGridParam', 'selrow')
        for (i in ids) {
            temp = $('#' + lista).jqGrid('getRowData', ids[i])
            data[i] = tipo + '+' + temp.entorno + '+' + temp.id
        }
        return data.join('-')
    }

    function contenidoFicha() {
        var CODIGOFICHA = 0,
            CLAVEGENERAL = 0,
            FECHAHISTORIAL, OPER = 'add',
            OPC = '',
            OPERA
        var tabSeleccionados = Array(),
            funciones = ['', 'segundoTab();', 'tercerTab();', 'cuartoTab();', 'quintoTab();', 'sextoTab();'];

        $('#cbPersonaInformacion,#cbPersonaRegistro').load('/sisfac/funcionesphp/adminTrabajador.php', {
            f: 3
        }, function(data) {
            $('#cbPersonaInformacion,#cbPersonaRegistro').val()
        }).width(160)

        $('#dialogHistorial').dialog({
            modal: true,
            autoOpen: false,
            show: 'blind',
            hide: 'drop',
            width: 'auto',
            height: 'auto',
            buttons: {
                Aceptar: function() {

                    if ($('#tbNombreFamilia').val() == '') {
                        alert('Debe escribir un nombre para la familia')
                        return
                    }
                    if ($('#tbLote').val() == '') {
                        alert('Debe escribir una direcci\xf3n para la familia')
                        return
                    }
                    if ($('#tbReferencia').val() == '') {
                        alert('Debe escribir una direccion de referencia para la familia')
                        return
                    }
                    if ($('#cbTipoEntorno').val() == '') {
                        alert('Debe escribir una ubicaci\xf3n para la familia')
                        return
                    }
                    if ($('#cbTiempoDomicilio').val() == '') {
                        alert('Debe escribir un tiempo de residencia al domicilio para la familia')
                        return
                    }
                    if ($('#cbTiempoDomicilio').val() != 'MAS DE 2 ANOS') {
                        if ($('#tbViviendaAnterior').val() == '') {
                            alert('Debe escribir donde vivieron antes la familia')
                            return
                        }
                    }
                    if ($('#cbMedioTransporte').val() == '') {
                        alert('Debe escribir el medio de transporte para la familia')
                        return
                    }
                    if ($('#cbReligion').val() == '') {
                        alert('Debe escoger una religi\xf3n para la familia')
                        return
                    }
                    if ($('#cbTipoFamilia').val() == '') {
                        alert('Debe seleccionar un tipo de familia')
                        return
                    }
                    if ($('#cbCicloVital').val() == '') {
                        alert('Debe seleccionar un ciclo vital')
                        return
                    }
                    /*if($('#cbIdioma1').val()==''){
                        alert('Debe seleccion por lo menos un idioma')
                        return
                    }*/

                    if ($('#cbEstadoCivil').val() == '' || $('#cbGrupoFamiliar').val() == '' || $('#cbTenenciaVivienda').val() == '' || $('#cbAguaConsumo').val() == '' || $('#cbEliminacionExcretas').val() == '' || $('#cbNroHabitacionesHogar').val() == '' || $('#cbEnergiaElectrica').val() == '' || $('#cbInstruccionMadre').val() == '' || $('#cbOcupacionJefe').val() == '' || $('#cbIngresoFamiliar').val() == '' || $('#cbPersonaDormitorio').val() == '' || $('#listaSaludHogar').jqGrid('getGridParam', 'selrow') == null) {
                        alert('Los datos socioeconomicos no deben estar vacios')
                        return

                    }


                    if ($('#listaVivienda').jqGrid('getGridParam', 'selrow') == null || $('#listaParedes').jqGrid('getGridParam', 'selrow') == null || $('#listaPiso').jqGrid('getGridParam', 'selrow') == null || $('#listaTecho').jqGrid('getGridParam', 'selrow') == null || $('#listaCombustible').jqGrid('getGridParam', 'selrow') == null || $('#listaBasura').jqGrid('getGridParam', 'selrow') == null) {
                        alert('Los datos de vivienda y entorno no deben estar vacios')
                        return
                    }


                    if ($('#cbBiohuerto').val() == 'SI') {
                        if ($('#listaBiohuerto').jqGrid('getGridParam', 'selrow') == null) {
                            alert('Los datos de vivienda y entorno no deben estar vacios 2')
                            return
                        }
                    }

                    /*if($('#').val()==''){
                        alert('')
                        return
                    }*/

                    ta = tv = 0
                    ids = $('#listaAnimales').jqGrid('getGridParam', 'selarrrow')
                    for (j in ids) {
                        //alert(ids[j])
                        lista = $('#listaAnimales').jqGrid('getRowData', ids[j])
                        if (lista.id == 54) {
                            if ($('#tbNroCanes').val() == '') {
                                alert('Debe digitar una cantidad de canes')
                                return
                            }
                        }
                        ta++
                    }

                    ids = $('#listaVacunas').jqGrid('getGridParam', 'selarrrow')
                    for (j in ids) {
                        tv++
                    }

                    if (ta == 0) {
                        if (tv > 0) {
                            alert('Si ha seleccionado alguna opción indicando vacunas en animales, debe seleccionar la opción que corresponde en TENENCIA DE ANIMALES')
                            return
                        }
                    }


                    valores = obtenerValores($('#tab4 option:selected').toArray())
                    entorno = obtenerEntorno('listaVivienda', 'Tipo de vivienda') + '*' + obtenerEntorno('listaParedes', 'Material de paredes') + '*' + obtenerEntorno('listaPiso', 'Material del piso') + '*' + obtenerEntorno('listaTecho', 'Material de techo') + '*' + obtenerEntorno('listaOrganizacionVivienda', 'Organizacion de la vivienda') + '*' + obtenerEntorno('listaArtefactos', 'Artefactos del hogar') + '*' + obtenerEntorno('listaCombustible', 'Combustible para cocinar') + '*' + obtenerEntorno('listaBasura', 'Disposicion de basura') + '*' + obtenerEntorno('listaAnimales', 'Tenencia de animales') + '*' + obtenerEntorno('listaVacunas', 'Vacunas') + '*' + obtenerEntorno('listaEntorno', 'Riesgo X Entorno') + '*' + ($('#cbBiohuerto').val() == 'SI' ? obtenerEntorno('listaBiohuerto', 'Biohuerto') : ('BIOHUERTO+NO+0')) + '*NUMERO DE CANES+' + $('#tbNroCanes').val() + '+0'

                    idi = $('#listaIdioma').jqGrid('getGridParam', 'selarrrow')
                    idioma1 = idioma2 = idioma3 = ''
                    for (k in idi) {
                        lista = $('#listaIdioma').jqGrid('getRowData', idi[k])
                        if (idi[k] == 1) idioma1 = lista.idioma;
                        else if (idi[k] == 2) idioma2 = lista.idioma
                        else if (idi[k] == 3) idioma3 = lista.idioma
                    }

                    $.post('/sisfac/funcionesphp/adminHistorial.php', {
                        f: OPC,
                        idfamilia: CODIGOFICHA,
                        claveGeneral: $('#claveGeneral').val(),
                        idtrabajadorinformacion: $('#cbPersonaInformacion').val(),
                        idtrabajadorregistro: $('#cbPersonaRegistro').val(), //PERSONA QUE DIGITA LA INFORMACION
                        trabajador: $('#cbPersonaInformacion option:selected[value]').html(),
                        registrador: $('#cbPersonaRegistro option:selected[value]').html(),
                        clave: $('#tbClave').val(),
                        //GUARDA DATOS DE LA FICHA SEGUNDO TAB
                        idtrabajador: $('#cbTrabajador').val(),
                        codigoFicha: $('#tbNumeroFicha').val(),
                        nombreFamilia: $('#tbNombreFamilia').val(),
                        lote: $('#tbLote').val(),
                        telefono: $('#tbTelefono').val(),
                        correo: $('#tbCorreo').val(),
                        referencia: $('#tbReferencia').val(),
                        tipoEntorno: $('#cbTipoEntorno').val(),
                        idioma1: idioma1,
                        idioma2: idioma2,
                        idioma3: idioma3,
                        tiempoDemora: $('#cbTiempoHoraDemora').val() + ':' + $('#cbTiempoMinutoDemora').val(),
                        tiempoDomicilio: $('#cbTiempoDomicilio').val(),
                        viviendaAnterior: $('#tbViviendaAnterior').val(),
                        medioTransporte: $('#cbMedioTransporte').val(),
                        religion: $('#cbReligion').val(),
                        diaVisita: $('#cbDiaVisita').val(),
                        horaVisita: $('#cbHoraVisita').val() + ':' + $('#cbMinutoVisita').val(),
                        tipoFamilia: $('#cbTipoFamilia').val(),
                        idsciclo: ($('#cbCicloVital').val().indexOf('EXPANSION') > 0 ? obtenerCiclo('listaCicloVital') : ('0+' + $('#cbCicloVital').val())), //temp.id + '+' + temp.ciclo
                        //GUARDA DATOS SOCIOECONOMICOS CUARTO TAB
                        valores: valores,
                        //GUARDA DATOS SOCIOECONOMICOS CUARTO TAB
                        entorno: entorno
                    }, function(data) {
                        if (data == 'Error') {
                            alert('Los datos no son correctos. Intentelo nuevamente')
                            return
                        } else {
                            alert('Se modifico la ficha correctamente');
                            $('#btnModificarFicha').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')
                            $('#btnGuardarHistorial,#btnEditarFicha').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')
                            $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6').find('input, textarea, button, select').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')


                        }
                        $('#listaFamilia').trigger('reloadGrid')
                        $('#dialogHistorial').dialog('close')
                    })
                },
                Cancelar: function() {
                    $('#dialogHistorial').dialog('close')
                }
            },
            close: function() {
                $('#tbClave').val('')
            }
        })

        $('#dialogInactivarFicha').dialog({
            modal: true,
            autoOpen: false,
            show: 'blind',
            hide: 'drop',
            width: 'auto',
            height: 'auto',
            buttons: {
                Aceptar: function() {
                    lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
                    $.post('/sisfac/funcionesphp/adminFamilia.php', {
                        f: 2,
                        idfamilia: CODIGOFICHA,
                        claveGeneral: CLAVEGENERAL,
                        codigoFicha: lista.codigoFicha,
                        motivo: $('#cbMotivo').val(),
                        activo: 'IN'
                    }, function(data) {
                        alert('Se inactivo la ficha seleccionada')
                        $('#listaFamilia').trigger('reloadGrid')
                        $('#dialogInactivarFicha').dialog('close')
                    })
                },
                Cancelar: function() {
                    $('#dialogInactivarFicha').dialog('close')
                }
            }
        })

        $('#tbBuscarFicha').keyup(function() {
            $('#listaFamilia').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminFamilia.php?f=1&claveGeneral=' + CLAVEGENERAL + '&codigoFicha=' + $('#tbBuscarFicha').val()
            }).trigger('reloadGrid')
        })
        $('#tbBuscarFichaDNI').keyup(function() {
            $('#listaFamilia').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminFamilia.php?f=1&claveGeneral=' + CLAVEGENERAL + '&dni=' + $('#tbBuscarFichaDNI').val()
            }).trigger('reloadGrid')
        })
        $("#accordion").accordion({
            collapsible: true,
            heightStyle: "content"

        })
        var rSeleccionado = 1

        $('#listaFamilia').jqGrid({
            url: '/sisfac/funcionesphp/adminFamilia.php?f=1',
            datetype: 'xml',
            colNames: ['id', 'idfamilia', 'idcomunidad', 'sec.idsector', 'idtrabajador', 'idestablecimiento', 'C&oacute;digo ficha', 'Nombre de la familia', 'Comunidad', 'Sector', 'nombreEstablecimiento', 'dis.nombre', 'nompro', 'nombreRegion', 'numeroVivienda', 'codigoFamilia', 'Fecha apertura', 'lote', 'telefono', 'correo', 'referencia', 'tipoEntorno', 'idioma', 'idioma', 'idioma', 'tiempoDemora', 'tiempoDomicilio', 'viviendaAnterior', 'medioTransporte', 'religion', 'diaVisita', 'horaVisita', 'tipoFamilia', 'Act./Ina.', 'Motivo', 'registrador', '', ''],
            colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idfamilia',
                    index: 'idfamilia',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idcomunidad',
                    index: 'idcomunidad',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idsector',
                    index: 'idsector',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idtrabajador',
                    index: 'idtrabajador',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idestablecimiento',
                    index: 'idestablecimiento',
                    width: 80,
                    hidden: true
                }, {
                    name: 'codigoFicha',
                    index: 'codigoFicha',
                    width: 80
                }, {
                    name: 'nombreFamilia',
                    index: 'nombreFamilia',
                    width: 280
                }, {
                    name: 'nombreComunidad',
                    index: 'nombreComunidad',
                    width: 100
                }, {
                    name: 'nombreSector',
                    index: 'nombreSector',
                    width: 100
                }, {
                    name: 'nombreEstablecimiento',
                    index: 'nombreEstablecimiento',
                    width: 80,
                    hidden: true
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 80,
                    hidden: true
                }, //distrito
                {
                    name: 'nompro',
                    index: 'nompro',
                    width: 80,
                    hidden: true
                }, {
                    name: 'nombreRegion',
                    index: 'nombreRegion',
                    width: 80,
                    hidden: true
                }, {
                    name: 'numeroVivienda',
                    index: 'numeroVivienda',
                    width: 80,
                    hidden: true
                }, {
                    name: 'codigoFamilia',
                    index: 'codigoFamilia',
                    width: 80,
                    hidden: true
                }, {
                    name: 'fechaapertura',
                    index: 'fechaapertura',
                    width: 80,
                    stype: '',
                    formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeYear: true,
                                changeMonth: true
                            });
                        }
                    }
                },

                {
                    name: 'lote',
                    index: 'lote',
                    width: 70,
                    hidden: true
                }, {
                    name: 'telefono',
                    index: 'telefono',
                    width: 70,
                    hidden: true
                }, {
                    name: 'correo',
                    index: 'correo',
                    width: 70,
                    hidden: true
                }, {
                    name: 'referencia',
                    index: 'referencia',
                    width: 70,
                    hidden: true
                }, {
                    name: 'tipoEntorno',
                    index: 'tipoEntorno',
                    width: 70,
                    hidden: true
                }, {
                    name: 'idioma1',
                    index: 'idioma1',
                    width: 70,
                    hidden: true
                }, {
                    name: 'idioma2',
                    index: 'idioma2',
                    width: 70,
                    hidden: true
                }, {
                    name: 'idioma3',
                    index: 'idioma3',
                    width: 70,
                    hidden: true
                }, {
                    name: 'tiempoDemora',
                    index: 'tiempoDemora',
                    width: 70,
                    hidden: true
                }, {
                    name: 'tiempoDomicilio',
                    index: 'tiempoDomicilio',
                    width: 70,
                    hidden: true
                }, {
                    name: 'viviendaAnterior',
                    index: 'viviendaAnterior',
                    width: 70,
                    hidden: true
                }, {
                    name: 'medioTransporte',
                    index: 'medioTransporte',
                    width: 70,
                    hidden: true
                }, {
                    name: 'religion',
                    index: 'religion',
                    width: 70,
                    hidden: true
                }, {
                    name: 'diaVisita',
                    index: 'diaVisita',
                    width: 70,
                    hidden: true
                }, {
                    name: 'horaVisita',
                    index: 'horaVisita',
                    width: 70,
                    hidden: true
                }, {
                    name: 'tipoFamilia',
                    index: 'tipoFamilia',
                    width: 70,
                    hidden: true
                }, {
                    name: 'activo',
                    index: 'activo',
                    width: 70,
                    formatter: 'select',
                    edittype: 'select',
                    stype: 'select',
                    editoptions: {
                        value: 'AC:ACTIVO;IN:INACTIVO'
                    },
                    searchoptions: {
                        value: ':TODOS;AC:ACTIVO;IN:INACTIVO'
                    }
                }, {
                    name: 'motivo',
                    index: 'motivo',
                    width: 70,
                    stype: ''
                }, {
                    name: 'registrador',
                    index: 'registrador',
                    width: 70,
                    hidden: true
                }, {
                    name: 'opcion',
                    index: 'opcion',
                    width: 70,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 70,
                    hidden: true
                }
            ],
            height: 230,
            sortname: 'fam.claveGeneral ASC, idfamilia',
            sortorder: 'desc',
            viewrecords: true,
            rowNum: 100,
            rowList: [100, 1000, 10000],
            pager: '#pagerFamilia',
            pginput: false,
            rownumbers: true,
            caption: 'Registro de fichas familiares',
            scrollrows: true,
            onSelectRow: function(rowid, status) {
                lista = $('#listaFamilia').jqGrid('getRowData', rowid)
                CODIGOFICHA = lista.idfamilia
                CLAVEGENERAL = lista.claveGeneral
                OPER = 'edit'
                rSeleccionado = rowid
                llenarDatos($('#listaFamilia').jqGrid('getRowData', rowid))
            },
            loadComplete: function(data) {
                temp = $('#listaFamilia').jqGrid('getDataIDs')
                t = $('#listaFamilia').jqGrid('getGridParam', 'selrow')
                if (!t) t = temp[0]
                    //alert(temp + 'ss' + t)
                    //$('#listaFamilia').jqGrid('setSelection',temp[0])
                $('#listaFamilia').jqGrid('setSelection', rSeleccionado)
                OPER = 'edit'
                if (temp.length == 0) {
                    CODIGOFICHA = 0
                    OPER = 'add'
                        //llenarDatos('')
                }
                //$('#tabs #ui-id-14').attr('style','background:yellow')
            },
            beforeSelectRow: function(rowid, e) {
                if (TIPOUSU != 'VIS') {
                    lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
                    if ($("#lRegion").text() != "" && !$("#tbNombreFamilia").is(":disabled")) {
                        //if(confirm('\xbfDesea guardar el historial de la ficha seleccionada?')){
                        alert('Usted debe guardar este historial para poder revisar otra familia')
                            //$('#dialogHistorial').dialog('open')
                        return false
                            /*if(alert('\xbfDesea guardar el historial de la ficha seleccionada?')){
                                
                            }else{
                                return true
                            }*/
                    } else return true
                } else {
                    return true
                }
            }
        })

        $('#listaFamilia').jqGrid('filterToolbar', {
            searchOnEnter: false
        })

        hoy = new Date();
        dia = hoy.getDate()
        mes = hoy.getMonth()
        anio = hoy.getFullYear()
            //alert(dia + '-' + mes + '-' + anio)
        $('#tbFechaFicha').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true,
            maxDate: new Date(anio, mes, dia)
        })

        $('#btnAgregarFicha').button({
            icons: {
                primary: "ui-icon-plus"
            }
        }).click(function() {
            CODIGOFICHA = ''
            OPERA = 'add'
            llenarDatos('')
            $('#listaFamilia').jqGrid('resetSelection')
            $('#tbNumeroFicha').focus()
            $('#dialogFicha').dialog('open')
                //alert('Se va a crear una nueva ficha familiar')
        }).width(150).height(15)

        $('#btnCodigoFicha').button({
            icons: {
                primary: "ui-icon-pencil"
            }
        }).click(function() {
            if (!CODIGOFICHA) {
                alert('Tiene que seleccionar una ficha familiar')
                return
            }
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            $('#cbComunidad').val(lista.idcomunidad)
            $('#cbSector').val(lista.idsector)
            $('#cbVivienda').val(lista.numeroVivienda)
            $('#cbFamilia').val(lista.codigoFamilia)
            $('#tbFechaFicha').val(lista.fechaapertura)
                //alert(lista.numeroVivienda)
            OPERA = '3'
            $('#tbNumeroFicha').focus()
            $('#dialogFicha').dialog('open')
        }).width(150).height(15)

        $('#btnModificarFicha').button({
            icons: {
                primary: "ui-icon-pencil"
            }
        }).click(function() {
            if (!CODIGOFICHA) {
                alert('Tiene que seleccionar una ficha familiar')
                return
            }
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            /*
                        if(CLAV != lista.claveGeneral){
                            alert('La ficha seleccionada ha sido creada en otro establecimiento')
                            return
                        }
                        
              */
            if (confirm('\xbfEsta seguro que desea modificar el registro seleccionado?')) {
                $.post('/sisfac/funcionesphp/adminFamilia.php', {
                    f: 2,
                    idfamilia: CODIGOFICHA,
                    claveGeneral: CLAVEGENERAL,
                    opcion: 'SI'
                }, function(data) {
                    // $('#listaFamilia').trigger('reloadGrid');

                    $('#btnModificarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                    $('#btnGuardarHistorial,#btnEditarFicha').removeAttr('disabled', 'disabled').removeClass('ui-button-disabled ui-state-disabled')
                    $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6').find('input, textarea, button, select').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')

                })

            }
        }).width(150).height(15)

        $('#btnGuardarHistorial').button({
            icons: {
                primary: "ui-icon-disk"
            }
        }).click(function() {
            OPC = 1
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))



            //   if(CLAV != lista.claveGeneral){
            //      alert('La ficha seleccionada ha sido creada en otro establecimiento')
            //      return
            //   }

            $('#tbClave').val()
            $('#dialogHistorial').dialog('open')
        }).width(100).height(50)

        $('#btnEditarFicha').button({
            icons: {
                primary: "ui-icon-disk"
            }
        }).click(function() {
            OPC = 3
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            $('#tbClave').val()
            $('#dialogHistorial').dialog('open')
        }).width(100).height(50)

        $('#btnEliminarFicha').button({
            icons: {
                primary: "ui-icon-close"
            }
        }).click(function() {
            if (!CODIGOFICHA) {
                alert('Tiene que seleccionar una ficha familiar')
                return
            }
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            if (confirm('\xbfEsta seguro que desea eliminar el registro seleccionado?. Esta acci\xf3n es irreversible')) {
                lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
                $.post('/sisfac/funcionesphp/adminFamilia.php', {
                    oper: 'del',
                    idfamilia: CODIGOFICHA,
                    codigoFicha: lista.codigoFicha,
                    claveGeneral: lista.claveGeneral
                }, function(data) {
                    alert('Se elimino la ficha')
                    $('#listaFamilia').trigger('reloadGrid')
                })
            }
        }).width(150).height(15)

        $('#btnActivarFicha').button({
            icons: {
                primary: "ui-icon-cancel"
            }
        }).click(function() {
            if (!CODIGOFICHA) {
                alert('Tiene que seleccionar una ficha familiar')
                return
            }
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            if (confirm('\xbfEsta seguro que desea activar el registro seleccionado?')) {
                $.post('/sisfac/funcionesphp/adminFamilia.php', {
                    f: 2,
                    idfamilia: CODIGOFICHA,
                    claveGeneral: CLAVEGENERAL,
                    activo: 'AC'
                }, function(data) {
                    alert('Se activo la ficha seleccionada')
                    $('#listaFamilia').trigger('reloadGrid')
                })
            }
        }).width(150).height(15)

        $('#btnInactivarFicha').button({
            icons: {
                primary: "ui-icon-cancel"
            }
        }).click(function() {
            if (!CODIGOFICHA) {
                alert('Tiene que seleccionar una ficha familiar')
                return
            }
            lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            if (confirm('\xbfEsta seguro que desea inactivar el registro seleccionado?')) {
                $('#cbMotivo').val('')
                $('#dialogInactivarFicha').dialog('open')
            }
        }).width(150).height(15)

        function llenarDatos(lista) {
            //'sec.idsector', 'idtrabajador', 'nombreSector', 'nombreComunidad', 'nombreEstablecimiento', 'dis.nombre', 'nompro', 'nombreRegion', 'numeroVivienda', 'codigoFamilia', 'codigoFicha', 
            //'fechaApertura', 'nombreFamilia', 'lote', 'telefono', 'correo', 'referencia', 'tipoEntorno', 'idioma', 'tiempoDemora', 'tiempoDomicilio', 
            //'viviendaAnterior', 'medioTransporte', 'religion', 'diaVisita', 'horaVisita', 'tipoFamilia', 'activo', 'motivo', 'registrador
            $('#cbTrabajador').val(lista.idtrabajador),
                $('#lbComunidad').text(lista.nombreComunidad),
                $('#lbSector').text(lista.nombreSector),
                $('#lRegion').text((!lista.nombreRegion ? "" : lista.nombreRegion)),
                $('#claveGeneral').val(lista.claveGeneral),
                $('#lProvincia').text((!lista.nompro ? "" : lista.nompro)),
                $('#lDistrito').text((!lista.nombre ? "" : lista.nombre)),
                $('#lEstSalud').text((!lista.nombreEstablecimiento ? "" : lista.nombreEstablecimiento)),
                $('#lCodigoGenerado').text((!lista.codigoFicha ? "" : lista.codigoFicha)),
                $('#lbVivienda').text(lista.numeroVivienda),
                $('#lbFamilia').text(lista.codigoFamilia),
                $('#tbNombreFamilia').val(lista.nombreFamilia),
                $('#tbLote').val(lista.lote),
                $('#tbTelefono').val(lista.telefono),
                $('#tbCorreo').val(lista.correo),
                $('#tbReferencia').val(lista.referencia),
                $('#cbTipoEntorno').val(lista.tipoEntorno),

                $('#listaIdioma').jqGrid('resetSelection')
            if (lista.idioma1 == 'ESPANOL') $('#listaIdioma').jqGrid('setSelection', 1)
            else if (lista.idioma2 == 'QUECHUA') $('#listaIdioma').jqGrid('setSelection', 2)
            else if (lista.idioma3 == 'AYMARA') $('#listaIdioma').jqGrid('setSelection', 3)

            /*$('#cbIdioma1').val(lista.idioma1)
            $('#cbIdioma2').val(lista.idioma2)
            $('#cbIdioma3').val(lista.idioma3)*/

            if (lista.tiempoDemora) {
                tem = (lista.tiempoDemora).split(':')
                $('#cbTiempoHoraDemora').val(tem[0])
                $('#cbTiempoMinutoDemora').val(tem[1])
            } else {
                $('#cbTiempoHoraDemora').val('')
                $('#cbTiempoMinutoDemora').val('')
            }

            $('#cbTiempoDomicilio').val(lista.tiempoDomicilio),
                $('#tbViviendaAnterior').val(lista.viviendaAnterior),
                $('#cbMedioTransporte').val(lista.medioTransporte),
                $('#cbReligion').val(lista.religion),
                $('#cbDiaVisita').val(lista.diaVisita)
            if (lista.tiempoDomicilio == 'MAS DE 2 ANOS') $('#tbViviendaAnterior').hide().val('')
            else $('#tbViviendaAnterior').show()
            if (lista.horaVisita) {
                tem = (lista.horaVisita).split(':')
                $('#cbHoraVisita').val(tem[0])
                $('#cbMinutoVisita').val(tem[1])
            } else {
                $('#cbHoraVisita').val('')
                $('#cbMinutoVisita').val('')
            }
            $('#cbTipoFamilia').val(lista.tipoFamilia)

            $('#cbTrabajador').load('/sisfac/funcionesphp/adminTrabajador.php', {
                f: 3,
                idestablecimiento: lista.idestablecimiento
            }, function(data) {
                $('#cbTrabajador').val(lista.idtrabajador)
            }).width(160)

            $('#listaMiembrosFamilia').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminPersona.php?f=1&idfamilia=' + lista.idfamilia + '&claveGeneral=' + lista.claveGeneral
            }).trigger('reloadGrid')

            $.post('/sisfac/funcionesphp/adminComunidad.php', {
                f: 3,
                claveGeneral: lista.claveGeneral
            }, function(data) {
                $('#cbComunidad').html(data).prepend("<option value='' >Seleccione una opci&oacute;n</option>")
                $('#cbComunidad').val(lista.idcomunidad)
            })

            $.post('/sisfac/funcionesphp/adminSector.php', {
                f: 3,
                idcomunidad: lista.idcomunidad,
                claveGeneral: lista.claveGeneral
            }, function(data) {
                $('#cbSector').html(data).prepend("<option value='' >Seleccione una opci&oacute;n</option>")
                $('#cbSector').val(lista.idsector)
            })

            $('#listaVisita').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminVisita.php?f=1&idfamilia=' + CODIGOFICHA + '&claveGeneral=' + lista.claveGeneral
            }).trigger('reloadGrid')

            $.post('/sisfac/funcionesphp/adminCiclo.php', {
                f: 1,
                idfamilia: CODIGOFICHA,
                claveGeneral: lista.claveGeneral
            }, function(data) {
                $('#listaCicloVital').jqGrid('resetSelection')
                lista = data.split('-')
                for (i in lista) {
                    data = lista[i].split('+')
                    for (j in data) {
                        //alert(data[j])
                        if (data[j].indexOf('FORMACION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN FORMACION')
                            $('#gview_listaCicloVital').hide()
                        } else if (data[j].indexOf('EXPANSION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN EXPANSION')
                            $('#gview_listaCicloVital').show()
                        } else if (data[j].indexOf('DISPERSION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN DISPERSION')
                            $('#gview_listaCicloVital').hide()
                        } else if (data[j].indexOf('CONTRACCION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN CONTRACCION')
                            $('#gview_listaCicloVital').hide()
                        } else {
                            $('#cbCicloVital').val('')
                            $('#gview_listaCicloVital').hide()
                        }
                        $('#listaCicloVital').jqGrid('setSelection', data[j])
                    }
                }
            })


            $.post('/sisfac/funcionesphp/adminSocioEconomico.php', {
                f: 2,
                idfamilia: CODIGOFICHA,
                claveGeneral: lista.claveGeneral
            }, function(data) {
                data = data.split('-')
                $('#cbEstadoCivil').val(data[0])
                $('#cbGrupoFamiliar').val(data[1])
                $('#cbTenenciaVivienda').val(data[2])
                $('#cbAguaConsumo').val(data[3])
                $('#cbEliminacionExcretas').val(data[4])
                $('#cbNroHabitacionesHogar').val(data[5])
                $('#cbEnergiaElectrica').val(data[6])
                $('#cbInstruccionMadre').val(data[7])
                $('#cbOcupacionJefe').val(data[8])
                $('#cbIngresoFamiliar').val(data[9])
                $('#cbPersonaDormitorio').val(data[10])
                $('#listaSaludHogar').jqGrid('resetSelection')
                for (i = 1; i < 7; i++) {
                    $('#listaSaludHogar').jqGrid('setSelection', $.inArray(data[10 + i], ['CLINICA', 'HOSPITAL', 'P.S', 'C.S', 'CASA', 'BOTICA O FARMACIA', 'TERAPEUTA TRADICIONAL']) + 1)
                }
            })





            $.post('/sisfac/funcionesphp/adminEntorno.php', {
                    f: 1,
                    idfamilia: CODIGOFICHA,
                    claveGeneral: lista.claveGeneral
                }, function(data) {
                    $('#listaVivienda,#listaParedes,#listaPiso,#listaTecho,#listaOrganizacionVivienda,#listaArtefactos,#listaCombustible,#listaBasura,#listaAnimales,#listaVacunas,#listaEntorno,#listaBiohuerto').jqGrid('resetSelection')
                    lista = data.split('-')

                    for (i in lista) {
                        if (lista[i] != '') {
                            $('#listaVivienda').jqGrid('setSelection', lista[i])
                            $('#listaParedes').jqGrid('setSelection', lista[i])
                            $('#listaPiso').jqGrid('setSelection', lista[i])
                            $('#listaTecho').jqGrid('setSelection', lista[i])
                            $('#listaOrganizacionVivienda').jqGrid('setSelection', lista[i])
                            $('#listaArtefactos').jqGrid('setSelection', lista[i])
                            $('#listaCombustible').jqGrid('setSelection', lista[i])
                            $('#listaBasura').jqGrid('setSelection', lista[i])
                            $('#listaAnimales').jqGrid('setSelection', lista[i])
                            $('#listaVacunas').jqGrid('setSelection', lista[i])
                            $('#listaEntorno').jqGrid('setSelection', lista[i])
                            $('#listaBiohuerto').jqGrid('setSelection', lista[i])
                        }
                        if (lista[i].indexOf('C') >= 0) {
                            tem = lista[i].split('.')
                            $('#tbNroCanes').val(tem[1])
                        }
                        if (lista[i] >= 82) {
                            $('#cbBiohuerto').val('SI')
                            $('#gview_listaBiohuerto').show()
                        } else {
                            $('#cbBiohuerto').val('NO')
                            $('#gview_listaBiohuerto').hide()
                        }
                    }
                })
                /*$.post('/sisfac/funcionesphp/adminEntorno.php', {f:2,idfamilia:CODIGOFICHA}, function(data){
                    $("#tbBiohuerto").val(data)
                })*/
                // console.info(lista.opcion);
            if (TIPOUSU == 'ADM' || TIPOUSU == 'NOR') {

                //  if(lista.opcion=='NO') {
                $('#btnModificarFicha').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')
                $('#btnGuardarHistorial,#btnEditarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6').find('input, textarea, button, select').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                    // }
                    // else {
                    //     $('#btnGuardarHistorial,#btnEditarFicha').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')
                    //     $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6,div').find('input, textarea, button, select').removeAttr('disabled').removeClass('ui-button-disabled ui-state-disabled')
                    //     $('#btnModificarFicha').attr('disabled','disabled').addClass('ui-button-disabled ui-state-disabled')
                    //  }
            } else if (TIPOUSU == 'VIS') {
                $('#btnModificarFicha,#btnGuardarHistorial,#btnEditarFicha,#btnAgregarFicha,#btnEliminarFicha,#btnActivarFicha,#btnInactivarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#btnGuardarHistorial,#btnEditarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6').find('input, textarea, button, select').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
            }

            if (USU == 'SUPERUSUARIO') {
                $('#btnEliminarHistorial').removeAttr('disabled')
                $('#btnCodigoFicha').removeAttr('disabled')
            } else {
                $('#btnEliminarHistorial').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#btnCodigoFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
            }
        }

        function primerTab() {
            mostrarContenido('contenidoFicha')
            $('#dialogFicha').dialog({
                modal: true,
                autoOpen: false,
                show: 'blind',
                hide: 'drop',
                width: 'auto',
                height: 'auto',
                buttons: {
                    Aceptar: function() {
                        if ($('#cbComunidad').val() == '' || $('#cbSector').val() == '' || $('#cbVivienda').val() == '' || $('#cbFamilia').val() == '' || $('#tbFechaFicha').val() == '') {
                            alert('Debe seleccionar un valor')
                            return
                        }

                        /*if($('#cbSector').val()==''){
                            alert('Debe seleccionar un valor')
                            return
                        }
                        if($('#cbVivienda').val()==''){
                            alert('Debe seleccionar un valor')
                            return
                        }
                        if($('#cbFamilia').val()==''){
                            alert('Debe seleccionar un valor')
                            return
                        }
                        if($('#tbFechaFicha').val()==''){
                            alert('Debe seleccionar un valor')
                            return
                        }*/

                        temp = $('#cbComunidad option:selected[value]').html().substr(0, 3).toUpperCase() + $('#cbSector option:selected[value]').html().substr(0, 3).toLowerCase() + $('#cbVivienda').val() + $('#cbFamilia').val()

                        $.post('/sisfac/funcionesphp/adminFamilia.php', {
                            oper: OPERA,
                            numeroVivienda: $('#cbVivienda').val(),
                            codigoFamilia: $('#cbFamilia').val(),
                            codigoFicha: temp,
                            idsector: $('#cbSector').val(),
                            fechaApertura: $('#tbFechaFicha').val(),
                            id: $('#listaFamilia').jqGrid('getGridParam', 'selrow'),
                            codigoFichaAnterior: $('#lCodigoGenerado').text()
                        }, function(data) {
                            if (data == 'Existe')
                                alert('El c\xf3digo de ficha ingresada ya existe')
                            else {
                                if (OPERA == 'add') alert('Se creo la ficha con c\xf3digo ' + temp)
                                else alert('Se modifico la ficha al c\xf3digo ' + temp)
                                $('#listaFamilia').trigger('reloadGrid')
                                $('#dialogFicha').dialog('close')
                            }
                        })
                    }
                },
                close: function(event, ui) {
                    $('#cbComunidad,#cbSector,#cbVivienda,#cbFamilia,#tbFechaFicha').val('')
                }
            })

            $('#btnGenerarCodigo').button({
                icons: {
                    primary: "ui-icon-search"
                }
            }).click(function() {
                if ($('#cbComunidad').val() == '' || $('#cbSector').val() == '' || $('#cbVivienda').val() == '' || $('#cbFamilia').val() == '') {
                    alert('Debe seleccionar un valor')
                    $('#lCodigoGenerado').text("")
                    return
                }
                temp = $('#cbComunidad option:selected[value]').html().substr(0, 3).toUpperCase() + $('#cbSector option:selected[value]').html().substr(0, 3).toLowerCase() + $('#cbVivienda').val() + $('#cbFamilia').val()
                $.post('/sisfac/funcionesphp/adminComunidad.php', {
                    f: 4,
                    idcomunidad: $('#cbComunidad').val()
                }, function(data) {
                    data = data.split('-')
                    $('#lRegion').text(data[0])
                    $('#lProvincia').text(data[1])
                    $('#lDistrito').text(data[2])
                    $('#lEstSalud').text(data[3])
                    $('#lCodigoGenerado').text(temp)
                })
            }).width(100).height(50)

            $('#btnGuardarFicha').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
                if (lista.codigoFicha) {
                    alert('La ficha ya tiene asignado un c\xf3digo')
                    return
                }
                if (!$('#lCodigoGenerado').text()) {
                    alert('Primero debe generar el c\xf3digo de la ficha')
                    return
                }
                $('#dialogFicha').dialog('open')
            }).width(100).height(50)


            $('#btnCancelarFicha').button({
                icons: {
                    primary: "ui-icon-close"
                }
            }).click(function() {
                $('#listaFamilia').trigger('reloadGrid')
            }).width(100).height(50)
        }

        function segundoTab() {
            $('#cbDiaVisita,#cbIdioma1,#cbIdioma2,#cbIdioma3,#cbHoraVisita,#cbMinutoVisita,#cbTiempoHoraDemora,#cbTiempoMinutoDemora').width(65)
            $('#cbDiaVisita').width(160)

            $("#listaIdioma").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Seleccione un idioma'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'idioma',
                    index: 'idioma',
                    width: 150
                }, ],
                multiselect: true
                    //hiddengrid: true,
                    //caption: "Seleccione un idioma"
            });

            var mydata = [{
                id: 'ESPANOL',
                idioma: "ESPANOL"
            }, {
                id: 'QUECHUA',
                idioma: "QUECHUA"
            }, {
                id: 'AYMARA',
                idioma: "AYMARA"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaIdioma").jqGrid('addRowData', i + 1, mydata[i]);

            $('#cbTiempoDomicilio').change(function() {
                    if ($('#cbTiempoDomicilio').val() == 'MAS DE 2 ANOS') $('#tbViviendaAnterior').hide().val('')
                    else $('#tbViviendaAnterior').show()
                })
                //$('#listaCicloVital').hide()
            $('#cbCicloVital').change(function() {
                if ($('#cbCicloVital').val() == 'FAMILIA EN EXPANSION') {
                    $('#gview_listaCicloVital').show()
                } else {
                    $('#listaCicloVital').jqGrid('resetSelection')
                    $('#gview_listaCicloVital').hide()
                }
            })
            $("#listaCicloVital").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Ciclo vital'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 100,
                    hidden: true
                }, {
                    name: 'ciclo',
                    index: 'ciclo',
                    width: 320
                }, ],
                multiselect: true
                    //hiddengrid: true,
                    //caption: "Ciclo vital"
            });

            var mydata = [{
                id: '1',
                ciclo: "FAMILIA EXPANSION: PAREJA CON NACIMIENTO DEL 1ER HIJO"
            }, {
                id: '2',
                ciclo: "FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD PRE ESCOLAR"
            }, {
                id: '3',
                ciclo: "FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD ESCOLAR"
            }, {
                id: '4',
                ciclo: "FAMILIA EXPANSION: PAREJA CON HIJO ADOLESCENTE"
            }, {
                id: '5',
                ciclo: "FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD ADULTA"
            }, ];

            for (var i = 0; i <= mydata.length; i++) $("#listaCicloVital").jqGrid('addRowData', i + 1, mydata[i]);

            $('#btnGuardarDatosFicha').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminFamilia.php', {
                    oper: OPER,
                    idfamilia: CODIGOFICHA,
                    idtrabajador: $('#cbTrabajador').val(),
                    codigoFicha: $('#tbNumeroFicha').val(),
                    nombreFamilia: $('#tbNombreFamilia').val(),
                    lote: $('#tbLote').val(),
                    telefono: $('#tbTelefono').val(),
                    correo: $('#tbCorreo').val(),
                    referencia: $('#tbReferencia').val(),
                    claveGeneral: $('#claveGeneral').val(),
                    tipoEntorno: $('#cbTipoEntorno').val(),
                    idioma1: $('#cbIdioma1').val(),
                    idioma2: $('#cbIdioma2').val(),
                    idioma3: $('#cbIdioma3').val(),
                    tiempoDemora: $('#cbTiempoHoraDemora').val() + ':' + $('#cbTiempoMinutoDemora').val(),
                    tiempoDomicilio: $('#cbTiempoDomicilio').val(),
                    viviendaAnterior: $('#tbViviendaAnterior').val(),
                    medioTransporte: $('#cbMedioTransporte').val(),
                    religion: $('#cbReligion').val(),
                    diaVisita: $('#cbDiaVisita').val(),
                    horaVisita: $('#cbHoraVisita').val() + ':' + $('#cbMinutoVisita').val(),
                    tipoFamilia: $('#cbTipoFamilia').val(),
                    ids: ($('#cbCicloVital').val().indexOf('EXPANSION') > 0 ? obtenerCiclo('listaCicloVital') : ('0+' + $('#cbCicloVital').val()))
                }, function(data) {
                    OPER: 'edit'
                    $('#listaFamilia').trigger('reloadGrid')
                })
            }).width(100).height(50)
            temp = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
            $.post('/sisfac/funcionesphp/adminCiclo.php', {
                f: 1,
                idfamilia: CODIGOFICHA,
                claveGeneral: temp.claveGeneral
            }, function(data) {
                $('#listaCicloVital').jqGrid('resetSelection')
                lista = data.split('-')
                for (i in lista) {
                    data = lista[i].split('+')
                    for (j in data) {
                        if (data[j].indexOf('FORMACION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN FORMACION')
                            $('#gview_listaCicloVital').hide()
                        } else if (data[j].indexOf('EXPANSION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN EXPANSION')
                            $('#gview_listaCicloVital').show()
                        } else if (data[j].indexOf('DISPERSION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN DISPERSION')
                            $('#gview_listaCicloVital').hide()
                        } else if (data[j].indexOf('CONTRACCION') > 0) {
                            $('#cbCicloVital').val('FAMILIA EN CONTRACCION')
                            $('#gview_listaCicloVital').hide()
                        } else {
                            $('#cbCicloVital').val('')
                            $('#gview_listaCicloVital').hide()
                        }
                        $('#listaCicloVital').jqGrid('setSelection', data[j])
                    }
                }
            })
        }

        function tercerTab() {
            var ETAPA, RIESGO, GESTANTE, MIEMBROTIENE, OPCION
            $('#dialogMiembros input,select').width(160)
            $('#cbDiaVisita,#cbIdioma1,#cbIdioma2,#cbIdioma3,#cbHoraVisita,#cbMinutoVisita,#cbTiempoHoraDemora,#cbTiempoMinutoDemora').width(65)
            $('#dialogEtapas').dialog({
                modal: true,
                autoOpen: false,
                show: 'blind',
                hide: 'drop',
                width: 'auto',
                height: 'auto',
                beforeClose: function(event, ui) {
                    ban = 0
                    lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                    RIESGO = ''
                    if (lista.edad < 12) RIESGO = obtenerRiesgo('listaEtapaNino')
                    else if (lista.edad < 18) {
                        //alert('')
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaAdolescente')
                    } else if (lista.edad < 59) {
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaJoven')
                    } else {
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaAdulto')
                    }
                    //alert(RIESGO)
                    /*
                    temp = RIESGO.split('-'), 
                    lista = $('#listaMiembrosFamilia').jqGrid('getRowData',$('#listaMiembrosFamilia').jqGrid('getGridParam','selrow'))
                    if(lista.sexo == 'M'){
                        $.each(temp, function(indice,elemento){
                            if(elemento.indexOf('Mujer')>-1 && elemento.indexOf('Hombre')>-1){
                            }
                            else if(elemento.indexOf('Mujer')>-1){
                                alert('Debe escoger riesgos solo para personas de sexo masculino')
                                ban = 1
                            }
                        })
                    }
                    if(lista.sexo == 'F'){
                        $.each(temp, function(indice,elemento){
                            if(elemento.indexOf('Mujer')>-1 && elemento.indexOf('Hombre')>-1){
                            }
                            else if(elemento.indexOf('Hombre')>-1){
                                alert('Debe escoger riesgos solo para personas de sexo femenino')
                                ban = 1
                            }
                        })
                    }
                    if(ban == 1) return false*/
                },
                close: function(event, ui) {
                    lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                    if (lista.edad < 12) RIESGO = obtenerRiesgo('listaEtapaNino')
                    else if (lista.edad < 18) {
                        //alert('')
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaAdolescente')
                    } else if (lista.edad < 59) {
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaJoven')
                    } else {
                        if (RIESGO == '') RIESGO = obtenerRiesgo('listaEtapaAdulto')
                    }

                    FAMILIA = obtenerRiesgo('listaRiesgoFamilia')
                    GESTANTE = obtenerRiesgo('listaRiesgoGestante')
                    MIEMBROTIENE = obtenerRiesgo('listaMiembroTiene')
                        //alert(RIESGO)

                    $.post('/sisfac/funcionesphp/adminRiesgo.php', {
                        oper: 'add',
                        opcion: OPCION,
                        claveGeneral: CLAVEGENERAL,
                        idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                        idfamilia: CODIGOFICHA,
                        fechaHistorial: FECHAHISTORIAL,
                        etapa: ETAPA,
                        nombreRiesgo: RIESGO,
                        riesgoFamilia: FAMILIA,
                        gestante: GESTANTE,
                        otroriesgo: MIEMBROTIENE,
                        padeceotroriesgo: (MIEMBROTIENE == '' ? 'NO' : 'SI')
                    }, function(data) {
                        //$('#dialogEtapas').dialog('close')
                    })
                }
            })
            $('#dialogInactivarPersona').dialog({
                modal: true,
                autoOpen: false,
                show: 'blind',
                hide: 'drop',
                width: 'auto',
                height: 'auto',
                buttons: {
                    Aceptar: function() {
                        $.post('/sisfac/funcionesphp/adminPersona.php', {
                            f: 2,
                            idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                            motivo: $('#cbMotivoPersona').val(),
                            claveGeneral: CLAVEGENERAL,
                            activo: 'IN'
                        }, function(data) {
                            alert('Se inactivo el miembro de la familia')
                            $('#listaMiembrosFamilia').trigger('reloadGrid')
                            $('#dialogInactivarPersona').dialog('close')
                        })
                    },
                    Cancelar: function() {
                        $('#dialogInactivarPersona').dialog('close')
                    }
                }
            })

            $('#tbDNI').keyup(function(tecla) {
                $('#tbNumeroSeguro').val($('#tbDNI').val())
            });

            $('#tbDNI').change(function() {
                //alert('s')

                lista = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
                t = ''
                if ($('#cbOpcionDNI').val() != 'NO TIENE DNI/DNI EN TRAMITE') {
                    if ($('#cbOpcionDNI').val() == 'DNI') t = 1
                    else if ($('#cbOpcionDNI').val() == 'CARNET DE EXTRANJERIA') t = 2
                    else if ($('#cbOpcionDNI').val() == 'PASAPORTE') t = 3
                    else if ($('#cbOpcionDNI').val() == 'DOCUMENTO DE IDENTIDAD EXTRANJERO') t = 4
                    $('#lCodigoPaciente').text(t + $('#tbDNI').val() + '00')
                } else {
                    if (calcular_edad('#tbFechaNacimiento').val() < 18) {
                        //alert('ss')
                        /*$.post('/sisfac/funcionesphp/adminPersona.php', {f:3, codigoFicha:lista.codigoFicha}, function(data){
                            data = data.split('-')
                            if(data[0] == 'DNI') t = 1
                            else if(data[0] == 'CARNET DE EXTRANJERIA') t = 2
                            else if(data[0] == 'PASAPORTE') t = 3
                            else if(data[0] == 'DOCUMENTO DE IDENTIDAD EXTRANJERO') t = 4
                            if($('#listaMiembrosFamilia').jqGrid('getGridParam','selrow')) $('#lcodigoPaciente').text(t+data[1]+'0'+data[2])
                            else $('#lcodigoPaciente').text(t+data[1]+ '0'+(data[2]+1))
                        })*/
                    }
                }

            })

            $('#tbNumeroSeguro').mask('99999999')
            $('#tbFechaNacimiento').mask('99/99/9999') //.datepicker({dateFormat:'dd/mm/yy',changeYear:true,changeMonth:true,yearRange:"1900:2020"})

            $('#tbNombres,#tbApellidoPaterno,#tbApellidoMaterno').keypress(function(tecla) {
                //if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45)) return false;
                if ((tecla.charCode < 47 || tecla.charCode > 58) && ((tecla.charCode > 97 || tecla.charCode < 122) && (tecla.charCode > 65 || tecla.charCode < 90))) return true;
                else return false
            });


            $('#cbOpcionDNI').change(function() {
                if ($('#cbOpcionDNI').val() != 'NO TIENE DNI/DNI EN TRAMITE') {
                    $('#tbDNI').show().val('')
                } else {
                    //alert($('#cbOpcionDNI').val())
                    $('#tbDNI').hide().val('')
                        //if(calcular_edad('#tbFechaNacimiento').val()<18){
                        /*t=tem=op=0
                        ids = $('#listaMiembrosFamilia').jqGrid('getDataIDs')
                        for (i in ids){
                            lista = $("#listaMiembrosFamilia").jqGrid('getRowData',ids[i])
                            if(lista.parentesco == 'M'){
                                tem = lista.dni
                                op=1
                            }
                            if(lista.parentesco == 'P' && op==0){
                                tem = lista.dni
                            }
                            
                            if(lista.parentesco == 'H'){
                                t++
                            }
                        }
                        
                        */
                        //alert($('#cbOpcionDNI').val())
                    ids = $('#listaMiembrosFamilia').jqGrid('getDataIDs')
                    j = 0
                    for (i in ids) {
                        lista = $("#listaMiembrosFamilia").jqGrid('getRowData', ids[i])
                        if (lista.parentesco == 'M') {
                            tdni = lista.dni
                            topc = lista.opcionDNI
                        }
                        if (lista.parentesco == 'H' && lista.fechaNacimiento >= $('#tbFechaNacimiento').val()) j++
                    }

                    if (topc == 'DNI') t = 1
                    else if (topc == 'CARNET DE EXTRANJERIA') t = 2
                    else if (topc == 'PASAPORTE') t = 3
                    else if (topc == 'DOCUMENTO DE IDENTIDAD EXTRANJERO') t = 4
                    $('#lCodigoPaciente').text(t + tdni + '0' + j)

                }

                if ($('#cbOpcionDNI').val() == 'DNI') {
                    $('#tbDNI').mask('99999999')
                } else {
                    $('#tbDNI').unmask()
                }
            })

            $('#cbOcupacion').change(function() {
                if ($('#cbOcupacion').val() == 'E' || $('#cbOcupacion').val() == 'A' || $('#cbOcupacion').val() == 'N') {
                    $('#tbTipoOcupacion').hide().val('')
                } else {
                    $('#tbTipoOcupacion').show().val('')
                }
            })

            $('#cbSeguro').change(function() {
                if ($('#cbSeguro').val() == 'AUS/SIS') {
                    $('#tbNumeroSeguro').show().val($('#tbDNI').val())
                } else {
                    $('#tbNumeroSeguro').hide().val('-')
                }
            })

            $('#tbFechaNacimiento').change(function() {
                //alert(calcular_edad($('#tbFechaNacimiento')))
                validaFechaNacimiento()
            })

            function validaFechaNacimiento() {
                idpersona = $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')
                if (calcularEdad($('#tbFechaNacimiento').val(), '', true) < 6) {
                    $('#cbGradoInstruccion,#cbOcupacion,#tbTipoOcupacion').hide()
                    $('#cbEstudia').show()
                } else {
                    $('#cbEstudia').hide()
                    $('#cbGradoInstruccion,#cbOcupacion,#tbTipoOcupacion').show()
                }

                if (calcularEdad($('#tbFechaNacimiento').val(), '', true) < 18) $('#cbEstado').hide()
                else $('#cbEstado').show()

                if (idpersona == '') $('#cbGradoInstruccion,#cbOcupacion,#tbTipoOcupacion,#cbEstudia,#cbEstado').val('')


                $('#lEdad').text(calcularEdad($('#tbFechaNacimiento').val()))
            }

            $('#cbDepartamento').load('/sisfac/funcionesphp/adminRegion.php', {
                f: 3
            }, function(data) {
                $('#cbDepartamento').prepend("<option value='0' selected>Seleccione una opcion</option>")
            }).change(function() {
                $('#cbProvincia').load('/sisfac/funcionesphp/adminProvincia.php', {
                    f: 3,
                    idregion: $('#cbDepartamento').val()
                }, function() {
                    $('#cbProvincia').prepend("<option value='0' selected>Seleccione una opcion</option>")
                })
            })
            $('#cbProvincia').change(function() {
                $('#cbDistrito').load('/sisfac/funcionesphp/adminDistrito.php', {
                    f: 3,
                    idprovincia: $('#cbProvincia').val()
                }, function() {
                    $('#cbDistrito').prepend("<option value='0' selected>Seleccione una opcion</option>")
                })
            })

            $("#listaCondicion").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Seleccione'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 150
                }, ],
                multiselect: true,
                //hiddengrid: true,
                caption: "Condicion de la salud"
            });
            var mydata = [{
                id: '1',
                nombre: "Aparentemente sano"
            }, {
                id: '2',
                nombre: "Gestante"
            }, {
                id: '3',
                nombre: "Enfermo"
            }, {
                id: '4',
                nombre: "Con discapacidad"
            }];

            for (var i = 0; i <= mydata.length; i++) $("#listaCondicion").jqGrid('addRowData', i + 1, mydata[i]);
            
  

            $("#listaCulturales").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Seleccione'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 150
                }, ],
                multiselect: true,
                //hiddengrid: true,
                caption: "S&iacute;ndromes Culturales"
            });
            var mydata = [{
                id: '1',
                nombre: "Ojeada"
            }, {
                id: '2',
                nombre: "Luxacion (Anku Cheqe)"
            }, {
                id: '3',
                nombre: "Wayra"
            }, {
                id: '4',
                nombre: "Lomo Nati (recalco)"
            }, {
                id: '5',
                nombre: "Puquio"
            }, {
                id: '6',
                nombre: "Madre susto"
            }, {
                id: '7',
                nombre: "Muna (Antojo)"
            }, {
                id: '8',
                nombre: "Qayqa"
            }, {
                id: '9',
                nombre: "Mal hecho"
            }, {
                id: '10',
                nombre: "Chacho"
            }, {
                id: '11',
                nombre: "Susto"
            }];

            for (var i = 0; i <= mydata.length; i++) $("#listaCulturales").jqGrid('addRowData', i + 1, mydata[i]);

                /*
          
            $("#listaCulturales tr").click(function() {
                if (!$(this).find("input:checkbox").is(':checked')) {
                    if (confirm('Esta acci\xf3n quita el registro seleccionado.\xbfDesea continuar?')) {
                        $.post('/sisfac/funcionesphp/adminSindromeCultural.php', {
                            oper: 'del',
                            idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                            claveGeneral: CLAVEGENERAL,
                            idfamilia: CODIGOFICHA,
                            codigo: $(this).closest("tr").attr("id"),
                        }, function(data) {})
                    } else {
                        $("#" + $(this).parent().parent().parent().parent().attr('id')).jqGrid('setSelection', $(this).parent().parent().attr('id'))
                    }
                }
            })
*/

            function calcular_edad(fecha) {
                //alert(fecha)
                //fecha = fecha.split('/')
                //fecha = fecha[2]+'-'
                //fecha = '2000-12-12';
                var today = new Date();
                var birthDate = new Date(fecha.datepicker("getDate"));
                //alert(birthDate)
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            $('#dialogMiembros').dialog({
                modal: true,
                autoOpen: false,
                show: 'blind',
                hide: 'drop',
                width: 'auto',
                height: 'auto',
                buttons: {
                    Aceptar: function() {
                        t = 0
                        ids = $('#listaMiembrosFamilia').jqGrid('getDataIDs')
                        for (i in ids) {
                            lista = $("#listaMiembrosFamilia").jqGrid('getRowData', ids[i])
                            if (lista.parentesco == 'P' || lista.parentesco == 'M' || lista.parentesco == 'M') {
                                t++
                            }
                        }

                        if ($('#tbNumeroHC').val() == '') {
                            alert('Debe ingresar el numero de historia clinica')
                            return
                        }
                        if ($('#tbNombres').val() == '') {
                            alert('Debe ingresar los nombres del miembro')
                            return
                        }
                        if ($('#tbApellidoPaterno').val() == '') {
                            alert('Debe ingresar el apellido paterno del miembro')
                            return
                        }
                        if ($('#tbApellidoMaterno').val() == '') {
                            alert('Debe ingresar el apellido materno del miembro')
                            return
                        }
                        if ($('#cbSexo').val() == '') {
                            alert('Debe seleccionar el sexo de la persona')
                            return
                        }
                        /*if($('#cbGrupoSanguineo').val()==''){
                            alert('Debe seleccionar el grupo sanguineo')
                            return
                        }*/
                        if ($('#cbParentesco').val() == '') {
                            alert('Debe seleccionar el parentesco')
                            return
                        }

                        if ($('#tbFechaNacimiento').val() == '') {
                            alert('Debe ingresar una fecha de nacimiento')
                            return
                        }
                        //alert(calcularEdad($('#tbFechaNacimiento').val(),'',true))
                        if (calcularEdad($('#tbFechaNacimiento').val(), '', true) < 0) {
                            alert('Debe seleccionar una fecha de nacimiento valida')
                            return
                        }
                        if ($('#cbOpcionDNI').val() == '') {
                            alert('Debe seleccionar la un tipo de documento')
                            return
                        }
                        if ($('#cbOpcionDNI').val() != 'NO TIENE DNI/DNI EN TRAMITE') {
                            if ($('#tbDNI').val() == '') {
                                alert('Debe escribir un numero de DNI')
                                return
                            }
                        }
                        if ($('#cbSeguro').val() == '') {
                            alert('Debe seleccionar un seguro medico')
                            return
                        }


                        if ($('#cbDepartamento').val() == 0) {
                            alert('Debe seleccionar el departamento donde nacio el miembro')
                            return
                        }
                        if ($('#cbProvincia').val() == 0) {
                            alert('Debe seleccionar la provincia donde nacio el miembro')
                            return
                        }
                        if ($('#cbDistrito').val() == 0) {
                            alert('Debe seleccionar el distrito donde nacio el miembro')
                            return
                        }


                        if (calcularEdad($('#tbFechaNacimiento').val(), '', true) > 18) {
                            if ($('#cbEstado').val() == '') {
                                alert('Debe seleccionar el estado civil')
                                return
                            }
                        }
                        if (calcularEdad($('#tbFechaNacimiento').val(), '', true) > 6) {
                            if ($('#cbGradoInstruccion').val() == '') {
                                alert('Debe seleccionar el grado de instrucci\xf3n')
                                return
                            }
                            if ($('#cbOcupacion').val() == '') {
                                alert('Debe seleccionar la ocupaci\xf3n del miembro')
                                return
                            } else {
                                if ($('#cbOcupacion').val() != 'E') {
                                    if ($('#cbOcupacion').val() != 'A') {
                                        if ($('#cbOcupacion').val() != 'N') {
                                            if ($('#tbTipoOcupacion').val() == '') {
                                                alert('Debe seleccionar el tipo de ocupaci\xf3n del miembro')
                                                return
                                            }
                                        }
                                    }
                                }
                            }

                        }

                        if ($('#cbPertenenciaEtnica').val() == '') {
                            alert('Debe seleccionar una pertenencia etnica')
                            return
                        }
                        if ($('#cbDesendenciaEtnica').val() == '') {
                            alert('Debe seleccionar una desendencia etnica')
                            return
                        }

                        if (obtenerCondicion('listaCondicion') == '') {
                            alert('Debe seleccionar una condicion')
                            return
                        }

                        if (obtenerCondicion('listaCondicion').indexOf('Gestante') > 0) {
                            if ($('#cbSexo').val() == 'M') {
                                alert('Para ingresar una gestante tiene que seleccionar una persona de sexo femenino')
                                return
                            }
                        }
                        if (obtenerCondicion('listaCondicion').indexOf('Aparentemente sano') > 0) {
                            if (obtenerCondicion('listaCondicion').indexOf('Con discapacidad') > 0) {
                                alert('El miembro seleccionado no puede estar en estado APARENTEMENTE SANO y CON DISCAPACIDAD')
                                return
                            }
                            if (obtenerCondicion('listaCondicion').indexOf('Enfermo') > 0) {
                                alert('El miembro seleccionado no puede estar en estado APARENTEMENTE SANO y ENFERMO')
                                return
                            }
                        }
                        $.post('/sisfac/funcionesphp/adminPersona.php', {
                            oper: OPCIONM,
                            idfamilia: CODIGOFICHA,
                            claveGeneral: CLAVEGENERAL,
                            idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                            numeroHC: $('#tbNumeroHC').val(),
                            opcionDNI: $('#cbOpcionDNI').val(),
                            dni: $('#tbDNI').val(),
                            nombre: $('#tbNombres').val(),
                            apellidoPaterno: $('#tbApellidoPaterno').val(),
                            apellidoMaterno: $('#tbApellidoMaterno').val(),
                            sexo: $('#cbSexo').val(),
                            fechaNacimiento: $('#tbFechaNacimiento').val(),
                            iddistrito: $('#cbDistrito').val(),
                            gradoInstruccion: $('#cbGradoInstruccion').val(),
                            seguroMedico: $('#cbSeguro').val(),
                            numeroSeguro: $('#tbNumeroSeguro').val(),
                            ocupacion: $('#cbOcupacion').val(),
                            tipoOcupacion: $('#tbTipoOcupacion').val(),
                            parentesco: $('#cbParentesco').val(),
                            estadoCivil: $('#cbEstado').val(),
                            jefeFamilia: $('#cbJefe').val(),
                            estudia: $('#cbEstudia').val(),
                            pertenenciaEtnica: $('#cbPertenenciaEtnica').val(),
                            desendenciaEtnica: $('#cbDesendenciaEtnica').val(),
                            ids: obtenerCondicion('listaCondicion'),
                            sids: obtenerCondicion('listaCulturales')

                            /*grupoSanguineo: $('#cbGrupoSanguineo').val(),
                            grupoRiesgo: $('#cbGrupoRiesgo').val(),
                            opcionLugarResidencia: $('#cbLugarResidencia').val(),
                            lugarResidencia: $('#tbLugarResidencia').val(),
                            contacto: $('#tbNombreContacto').val(),
                            telefonoContacto: $('#tbTelefonoContacto').val(),
                            parentescoContacto: $('#cbParentescoContacto').val()
                            */
                        }, function(data) {
                            alert('Por favor no olvide ingresar los riesgos PERSONALES y FAMILIARES')
                            $('#listaMiembrosFamilia').trigger('reloadGrid')
                            $('#dialogMiembros').dialog('close')
                        })
                    },
                    Cerrar: function() {
                        $('#listaMiembrosFamilia').trigger('reloadGrid')
                        $('#dialogMiembros').dialog('close')
                        alert('Por favor no olvide ingresar los riesgos PERSONALES y FAMILIARES')
                    }
                },
                open: function() {
                    temp = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                    if (temp.jefeFamilia == 'SI') {
                        $('#cbJefe').removeAttr('disabled')
                    } else {
                        //$('#cbJefe').attr('disabled','disabled')
                        lista = $('#listaMiembrosFamilia').jqGrid('getCol', 'jefeFamilia')
                        if (lista.indexOf('SI') > -1) $('#cbJefe').attr('disabled', 'disabled').val('NO')
                        else $('#cbJefe').removeAttr('disabled')
                    }
                    // validaFechaNacimiento()

                    if (temp.ocupacion == 'E' || temp.ocupacion == 'A' || temp.ocupacion == 'N') {
                        $('#tbTipoOcupacion').hide()
                    } else {
                        $('#tbTipoOcupacion').show()
                    }
                }
            })


            temp = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))

            $('#listaMiembrosFamilia').jqGrid({
                url: '/sisfac/funcionesphp/adminPersona.php?f=1&idfamilia=' + CODIGOFICHA + '&claveGeneral=' + (temp.claveGeneral == undefined ? 0 : temp.claveGeneral),
                datetype: 'xml',
                colNames: ['idpersona', 'iddistrito', '', '', 'idfamilia', 'Numero HC', 'Tipo documento', 'Nro. documento', 'Nombres', 'Apellido Paterno', 'Apellido Materno', 'Sexo', 'Fec. Nac.', 'Grado Inst.', 'Seguro', 'Num. seguro', 'Ocupaci&oacute;n', 'Tipo Ocup.', 'Parentesco', 'Estado Civil', 'Jefe Familia', 'Pert. &Eacute;tnica', 'Desen. &Eacute;tnica', 'Activo', 'Motivo', 'Edad', 'Grupo sanguineo', 'Grupo riesgo', 'Otro lugar residencia', 'Lugar residencia', 'Contacto', 'Tel&eacute;fono contacto', 'Parentesco contacto', 'Edad'],
                colModel: [{
                    name: 'idpersona',
                    index: 'idpersona',
                    width: 80,
                    hidden: true,
                    sorttype: 'int',
                    editable: true,
                    frozen: true
                }, {
                    name: 'iddistrito',
                    index: 'iddistrito',
                    width: 80,
                    hidden: true,
                    sorttype: 'int',
                    frozen: true
                }, {
                    name: 'idprovincia',
                    index: 'idprovincia',
                    width: 80,
                    hidden: true,
                    sorttype: 'int',
                    frozen: true
                }, {
                    name: 'idregion',
                    index: 'idregion',
                    width: 80,
                    hidden: true,
                    sorttype: 'int',
                    editable: true,
                    frozen: true
                }, {
                    name: 'idfamilia',
                    index: 'idfamilia',
                    width: 80,
                    hidden: true,
                    frozen: true
                }, {
                    name: 'numeroHC',
                    index: 'numeroHC',
                    width: 80,
                    frozen: true
                }, {
                    name: 'opcionDNI',
                    index: 'opcionDNI',
                    width: 80
                }, {
                    name: 'dni',
                    index: 'dni',
                    width: 80,
                    editable: true,
                    frozen: true,
                    editoptions: {
                        size: 30
                    }
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 100,
                    editable: true,
                    editoptions: {
                        size: 30
                    }
                }, {
                    name: 'apellidoPaterno',
                    index: 'apellidoPaterno',
                    width: 100,
                    editable: true,
                    editoptions: {
                        size: 30
                    }
                }, {
                    name: 'apellidoMaterno',
                    index: 'apellidoMaterno',
                    width: 100,
                    editable: true,
                    editoptions: {
                        size: 30
                    }
                }, {
                    name: 'sexo',
                    index: 'sexo',
                    width: 70,
                    edittype: 'select',
                    formatter: 'select',
                    editable: true,
                    editoptions: {
                        value: 'M:MASCULINO;F:FEMENINO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'fechaNacimiento',
                    index: 'fechaNacimiento',
                    width: 70,
                    editable: true,
                    stype: '',
                    formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        size: 30,
                        dataInit: function(el) {
                            $(el).datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeYear: true,
                                changeMonth: true,
                                yearRange: "1900:2020"
                            });
                        }
                    }
                }, {
                    name: 'gradoInstruccion',
                    index: 'gradoInstruccion',
                    width: 80
                }, {
                    name: 'seguroMedico',
                    index: 'seguroMedico',
                    width: 100,
                    edittype: 'select',
                    formatter: 'select',
                    editable: true,
                    editoptions: {
                        value: 'USUARIO:USUARIO;AUS/SIS:AUS/SIS;ESSALUD:ESSALUD;S.O.A.T:S.O.A.T;SANIDAD F.A.P:SANIDAD F.A.P;SANIDAD NAVAL:SANIDAD NAVAL;SANIDAD EP:SANIDAD EP;SANIDAD PNP:SANIDAD PNP;PRIVADOS:PRIVADOS;OTROS:OTROS;EXONERADO:EXONERADO;SIN SEGURO:SIN SEGURO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'numeroSeguro',
                    index: 'numeroSeguro',
                    width: 100
                }, {
                    name: 'ocupacion',
                    index: 'ocupacion',
                    width: 80,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'S:TRABAJADOR ESTABLE;V:EVENTUAL;D:DESOCUPADO;J:JUBILADO;E:ESTUDIANTE;A:AMA DE CASA;N:NO APLICA',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'tipoOcupacion',
                    index: 'tipoOcupacion',
                    width: 100,
                    editable: true,
                    editoptions: {
                        size: 30
                    }
                }, {
                    name: 'parentesco',
                    index: 'parentesco',
                    width: 80,
                    edittype: 'select',
                    formatter: 'select',
                    editable: true,
                    editoptions: {
                        value: 'P:PADRE;M:MADRE;H:HIJO;A:ABUELO/ABUELA;T:TIO/TIA;N:NIETO/NIETA;PA:PADRE ADOPTIVO;MA:MADRE ADOPTIVA;PD:PADASTRO;MD:MADASTRA;NU:NUERA;YE:YERNO;OT:OTRO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'estadoCivil',
                    index: 'estadoCivil',
                    width: 80,
                    edittype: 'select',
                    formatter: 'select',
                    editable: true,
                    editoptions: {
                        value: 'S:SOLTERO;CV:CONVIVIENTE;C:CASADO;SE:SEPARADO;D:DIVORCIADO;V:VIUDO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'jefeFamilia',
                    index: 'jefeFamilia',
                    width: 70,
                    edittype: 'select',
                    formatter: 'select',
                    editable: true,
                    editoptions: {
                        value: 'NO:NO;SI:SI',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'pertenenciaEtnica',
                    index: 'pertenenciaEtnica',
                    width: 70
                }, {
                    name: 'desendenciaEtnica',
                    index: 'desendenciaEtnica',
                    width: 70
                }, {
                    name: 'activo',
                    index: 'activo',
                    formatter: 'select',
                    editoptions: {
                        value: 'AC:ACTIVO;IN:INACTIVO'
                    }
                }, {
                    name: 'motivo',
                    index: 'motivo'
                }, {
                    name: 'edad',
                    index: 'edad',
                    hidden: true
                }, {
                    name: 'grupoSanguineo',
                    index: 'grupoSanguineo',
                    hidden: true
                }, {
                    name: 'grupoRiesgo',
                    index: 'grupoRiesgo',
                    hidden: true
                }, {
                    name: 'opcionLugarResidencia',
                    index: 'opcionLugarResidencia',
                    hidden: true
                }, {
                    name: 'lugarResidencia',
                    index: 'lugarResidencia',
                    hidden: true
                }, {
                    name: 'contacto',
                    index: 'contacto',
                    hidden: true
                }, {
                    name: 'telefonoContacto',
                    index: 'telefonoContacto',
                    hidden: true
                }, {
                    name: 'parentescoContacto',
                    index: 'parentescoContacto',
                    hidden: true
                }, {
                    name: 'edad1',
                    index: 'edad1'
                }],
                height: 100,
                width: 950,
                sortname: 'idpersona',
                sortorder: 'asc',
                viewrecords: true,
                rowNum: 1000,
                pager: '#pagerMiembrosFamilia',
                pginput: false,
                rownumbers: true,
                shrinkToFit: false,
                caption: 'Registro de miembros familiares',
                editurl: "/sisfac/funcionesphp/adminPersona.php",
                loadComplete: function() {
                    ids = $('#listaMiembrosFamilia').jqGrid('getDataIDs')
                    for (i in ids) {
                        lista = $('#listaMiembrosFamilia').jqGrid('getRowData', ids[i])
                        $("#listaMiembrosFamilia").jqGrid('setRowData', ids[i], {
                            edad1: calcularEdad(lista.edad1)
                        })
                    }
                },
                onSelectRow: function(rowid, status) {
                    lista = $('#listaMiembrosFamilia').jqGrid('getRowData', rowid)
                    llenarDatosMiembro(lista)
                }
            })
            $('#listaMiembrosFamilia').jqGrid('navGrid', '#pagerMiembrosFamilia', {
                edit: false,
                add: false,
                del: false,
                search: false,
                view: false
            }, {
                width: 350,
                closeAfterEdit: true
            }, {
                width: 350,
                closeAfterAdd: true
            })

            function llenarDatosMiembro(lista) {

                $('#claveGeneralPersona').val(CLAVEGENERAL)
                $('#tbNumeroHC').val(lista.numeroHC)
                $('#cbOpcionDNI').val(lista.opcionDNI)
                $('#tbDNI').val(lista.dni)
                $('#tbNombres').val(lista.nombre)
                $('#tbApellidoPaterno').val(lista.apellidoPaterno)
                $('#tbApellidoMaterno').val(lista.apellidoMaterno)
                $('#cbSexo').val(lista.sexo)
                $('#cbGradoInstruccion').val(lista.gradoInstruccion)
                $('#tbFechaNacimiento').val(lista.fechaNacimiento)
                $('#cbDepartamento').val(lista.idregion)
                $('#cbProvincia').val(lista.idprovincia)
                $('#cbDistrito').val(lista.iddistrito)
                $('#cbSeguro').val(lista.seguroMedico)
                $('#tbNumeroSeguro').val(lista.numeroSeguro)
                $('#cbOcupacion').val(lista.ocupacion)
                $('#tbTipoOcupacion').val(lista.tipoOcupacion)
                $('#cbParentesco').val(lista.parentesco)
                    //alert(lista.estadoCivil)
                $('#cbEstado').val(lista.estadoCivil)
                $('#cbPertenenciaEtnica').val(lista.pertenenciaEtnica)
                $('#cbJefe').val(lista.jefeFamilia)
                    /*$('#cbGrupoSanguineo').val(lista.grupoSanguineo)
                    $('#cbGrupoRiesgo').val(lista.grupoRiesgo)
                    $('#cbLugarResidencia').val(lista.opcionLugarResidencia)
                    $('#tbLugarResidencia').val(lista.lugarResidencia)
                    $('#tbNombreContacto').val(lista.contacto)
                    $('#tbTelefonoContacto').val(lista.telefonoContacto)
                    $('#cbParentescoContacto').val(lista.parentescoContacto)
                    */
                    /*
                     if(lista.opcionLugarResidencia=='SI'){
                         $('#tbLugarResidencia').show()
                     }else{
                         $('#tbLugarResidencia').hide()
                     }
                     */

                if ($('#tbFechaNacimiento').val() != '') {
                    $('#lEdad').text(calcularEdad($('#tbFechaNacimiento').val()))
                } else {

                    $('#lEdad').text('')
                }
                if (lista.dni) {
                    if ($('#cbOpcionDNI').val() == 'DNI') t = 1
                    else if ($('#cbOpcionDNI').val() == 'CARNET DE EXTRANJERIA') t = 2
                    else if ($('#cbOpcionDNI').val() == 'PASAPORTE') t = 3
                    else if ($('#cbOpcionDNI').val() == 'DOCUMENTO DE IDENTIDAD EXTRANJERO') t = 4
                    $('#lCodigoPaciente').text(t + lista.dni + '00')
                } else {
                    $('#lCodigoPaciente').text('')
                }

                if (lista.opcionDNI != 'NO TIENE DNI/DNI EN TRAMITE' || lista.opcionDNI == '') {
                    $('#tbDNI').show()
                } else {
                    $('#tbDNI').hide()
                }
                if (lista.seguroMedico == 'AUS/SIS' || lista.seguroMedico == '') $('#tbNumeroSeguro').show()
                else $('#tbNumeroSeguro').hide()

                if (calcularEdad($('#tbFechaNacimiento').val(), '', true) < 6) $('#cbGradoInstruccion,#cbOcupacion,#tbTipoOcupacion').hide()
                else $('#cbGradoInstruccion,#cbOcupacion,#tbTipoOcupacion').show()

                if (calcularEdad($('#tbFechaNacimiento').val(), '', true) < 18) $('#cbEstado').hide()
                else $('#cbEstado').show()

                if (lista.pertenenciaEtnica == '01. MESTIZO') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='58.MESTIZO'>58.MESTIZO</option>")
                } else if (lista.pertenenciaEtnica == '02. AFRODESCENDIENTE') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='56.AFROPERUANO'>56.AFROPERUANO</option>")
                } else if (lista.pertenenciaEtnica == '03. ANDINO') {
                    var ops = '<option value=""></option>';
                    ops += '<option value="02.AIMARA">02.AIMARA</option>';
                    ops += '<option value="19.JAQARU">19.JAQARU</option>';
                    ops += '<option value="40.QUECHUAS">40.QUECHUAS</option>';
                    ops += '<option value="49.URO">49.URO</option>';
                    $('#cbDesendenciaEtnica').html(ops)
                } else if (lista.pertenenciaEtnica == '04. INDIGENA AMAZONICO') {
                    var ops = '<option value=""></option>';
                    ops += '<option value="01.ACHUAR">01.ACHUAR</option>';
                    ops += '<option value="03.AMAHUACA">03.AMAHUACA</option>';
                    ops += '<option value="04.ARABELA">04.ARABELA</option>';
                    ops += '<option value="05.ASHANINKA">05.ASHANINKA</option>';
                    ops += '<option value="06.ASHENINKA">06.ASHENINKA</option>';
                    ops += '<option value="07.AWAJUN">07.AWAJUN</option>';
                    ops += '<option value="08.BORA">08.BORA</option>';
                    ops += '<option value="09.CAPANAHUA">09.CAPANAHUA</option>';
                    ops += '<option value="10.CASHINAHUA">10.CASHINAHUA</option>';
                    ops += '<option value="11.CHAMICURO">11.CHAMICURO</option>';
                    ops += '<option value="12.CHAPRA">12.CHAPRA</option>';
                    ops += '<option value="13.CHITONAHUA">13.CHITONAHUA</option>';
                    ops += '<option value="14.ESE EJA">14.ESE EJA</option>';
                    ops += '<option value="15.HARAKBUT">15.HARAKBUT</option>';
                    ops += '<option value="16.IKITU">16.IKITU</option>';
                    ops += '<option value="18.ISCONAHUA">18.ISCONAHUA</option>';
                    ops += '<option value="20.JIBARO">20.JIBARO</option>';
                    ops += '<option value="21.KAKATAIBO">21.KAKATAIBO</option>';
                    ops += '<option value="22.KAKINTE">22.KAKINTE</option>';
                    ops += '<option value="23.KANDOZI">23.KANDOZI</option>';
                    ops += '<option value="24.KICHWA">24.KICHWA</option>';
                    ops += '<option value="25.KUKAMA KUKAMIRIA">25.KUKAMA KUKAMIRIA</option>';
                    ops += '<option value="26.MADIJA">26.MADIJA</option>';
                    ops += '<option value="27.MAIJUNA">27.MAIJUNA</option>';
                    ops += '<option value="29.MASHCO PIRO">29.MASHCO PIRO</option>';
                    ops += '<option value="30.MASTANAHUA">30.MASTANAHUA</option>';
                    ops += '<option value="31.MATSES">31.MATSES</option>';
                    ops += '<option value="32.MATSIGENKA">32.MATSIGENKA</option>';
                    ops += '<option value="34.MURUI-MUINANI">34.MURUI-MUINANI</option>';
                    ops += '<option value="35.NAHUA">35.NAHUA</option>';
                    ops += '<option value="36.NANTI">36.NANTI</option>';
                    ops += '<option value="37.NOMATSIGENGA">37.NOMATSIGENGA</option>';
                    ops += '<option value="38.OCAINA">38.OCAINA</option>';
                    ops += '<option value="39.OMAGUA">39.OMAGUA</option>';
                    ops += '<option value="41.RESIGARO">41.RESIGARO</option>';
                    ops += '<option value="42.SECOYA">42.SECOYA</option>';
                    ops += '<option value="43.SHARANAHUA">43.SHARANAHUA</option>';
                    ops += '<option value="44.SHAWI">44.SHAWI</option>';
                    ops += '<option value="45.SHIPIBO-KONIBO">45.SHIPIBO-KONIBO</option>';
                    ops += '<option value="46.SHIWILU">46.SHIWILU</option>';
                    ops += '<option value="47.TIKUNA">47.TIKUNA</option>';
                    ops += '<option value="48.URARINA">48.URARINA</option>';
                    ops += '<option value="51.WAMPIS">51.WAMPIS</option>';
                    ops += '<option value="52.YAGUA">52.YAGUA</option>';
                    ops += '<option value="53.YAMINAHUA">53.YAMINAHUA</option>';
                    ops += '<option value="54.YANESHA">54.YANESHA</option>';
                    ops += '<option value="55.YINE">55.YINE</option>';
                    $('#cbDesendenciaEtnica').html(ops)
                } else if (lista.pertenenciaEtnica == '05. DESCENDIENTE') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='59.ASIATICODESCENDIENTE'>59.ASIATICODESCENDIENTE</option>")
                } else if (lista.pertenenciaEtnica == '06. OTROS') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='60.OTRO'>60.OTRO</option>")
                }

                $('#cbDesendenciaEtnica').val(lista.desendenciaEtnica)

                $('#cbProvincia').load('/sisfac/funcionesphp/adminProvincia.php', {
                    f: 3,
                    idregion: lista.idregion
                }, function(data) {
                    $('#cbProvincia').val(lista.idprovincia)
                    $('#cbDistrito').load('/sisfac/funcionesphp/adminDistrito.php', {
                        f: 3,
                        idprovincia: lista.idprovincia
                    }, function(data) {
                        $('#cbDistrito').val(lista.iddistrito)
                    })
                })

                $('#listaCondicion').jqGrid('resetSelection')
                $.post('/sisfac/funcionesphp/adminCondicion.php', {
                    f: 1,
                    idpersona: lista.idpersona,
                    idfamilia: lista.idfamilia,
                    claveGeneral: CLAVEGENERAL
                }, function(data) {
                    data = data.split('-')
                    for (i in data) {
                        $('#listaCondicion').jqGrid('setSelection', data[i])
                    }
                })

                $('#listaCulturales').jqGrid('resetSelection')
                $.post('/sisfac/funcionesphp/adminSindromeCultural.php', {
                    f: 1,
                    idpersona: lista.idpersona,
                    claveGeneral: CLAVEGENERAL
                }, function(data) {
                    data = data.split('-')
                    for (i in data) {
                        $('#listaCulturales').jqGrid('setSelection', data[i])
                    }
                })

                if ($('#tbFechaNacimiento').val() != '') {
                    validaFechaNacimiento();

                }
            }

            $('#btnAgregarMiembro').button({
                icons: {
                    primary: "ui-icon-plus"
                }
            }).click(function() {
                if (!$('#listaFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar una ficha familiar')
                    return
                }
                llenarDatosMiembro('')
                OPCIONM = 'add'
                $('#dialogMiembros').dialog('open')
            }).width(100).height(50)

            $('#btnActualizarMiembro').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                if (!$("#listaMiembrosFamilia").jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un registro de miembros de familia')
                    return
                }
                OPCIONM = 'edit'
                lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))

                if (lista.ocupacion == 'E' || lista.ocupacion == 'A' || lista.ocupacion == 'N') {
                    $('#tbTipoOcupacion').hide()
                } else {
                    $('#tbTipoOcupacion').show()
                }
                $('#dialogMiembros').dialog('open')
            }).width(100).height(50)


            $('#btnEliminarMiembro').button({
                icons: {
                    primary: "ui-icon-close"
                }
            }).click(function() {
                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un registro de miembros familiares')
                    return
                }
                if (confirm('\xbfEsta seguro que desea eliminar el registro seleccionado?')) {
                    $.post('/sisfac/funcionesphp/adminPersona.php', {
                        claveGeneral: CLAVEGENERAL,
                        oper: 'del',
                        'id': $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')
                    }, function(data) {
                        $('#listaMiembrosFamilia').trigger('reloadGrid');
                    });
                }
            }).width(100).height(50)

            $('#btnInactivarMiembro').button({
                icons: {
                    primary: "ui-icon-cancel"
                }
            }).click(function() {
                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un registro de miembros familiares')
                    return
                }
                if (confirm('\xbfEsta seguro que desea inactivar el registro seleccionado?')) {
                    $('#cbMotivoPersona').val('')
                    $('#dialogInactivarPersona').dialog('open')
                }
            }).width(100).height(50)

            $('#btnActivarMiembro').button({
                icons: {
                    primary: "ui-icon-check"
                }
            }).click(function() {
                if (confirm('\xbfEsta seguro que desea activar el registro seleccionado?')) {
                    $.post('/sisfac/funcionesphp/adminPersona.php', {
                        f: 2,
                        idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                        activo: 'AC',
                        claveGeneral: CLAVEGENERAL,
                        motivo: ''
                    }, function(data) {
                        alert('Se activo el miembro seleccionado')
                        $('#listaMiembrosFamilia').trigger('reloadGrid')
                    })
                }
            }).width(100).height(50)

            $('#btnRiesgoPersonal').button({
                icons: {
                    primary: "ui-icon-pencil"
                }
            }).click(function() {

                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un miembro de la famila')
                    return
                }

                lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))

                if (lista.activo == 'IN') {
                    alert('El miembro seleccionado esta inactivo')
                    return
                }

                if (lista.edad < 12) {
                    ETAPA = "Etapa nino(0-11 anos)"
                    mostrarEtapa('listaEtapaNino')
                } else if (lista.edad < 18) {
                    ETAPA = "Etapa adolescente (12-17 anos)"
                    mostrarEtapa('listaEtapaAdolescente')
                } else if (lista.edad < 60) {
                    ETAPA = "Etapa joven/adulto(18-59 anos)"
                    mostrarEtapa('listaEtapaJoven')
                } else {
                    ETAPA = "Etapa adulto mayor(60 anos a mas)"
                    mostrarEtapa('listaEtapaAdulto')
                }

                llenaRiesgo('', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))

                OPCION = 'PERSONAL'
                $('#dialogEtapas').dialog('open')
            }).width(100).height(50)

            $('#btnRiesgoFamiliar').button({
                icons: {
                    primary: "ui-icon-pencil"
                }
            }).click(function() {
                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar al jefe de la famila')
                    return
                }

                lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))

                if (lista.activo == 'IN') {
                    alert('El miembro seleccionado esta inactivo')
                    return
                }

                if (lista.jefeFamilia == 'NO') {
                    alert('Debe seleccionar al jefe de la famila')
                    return
                }
                llenaRiesgo(CODIGOFICHA, '')
                ETAPA = 'FAMILIA'
                OPCION = 'FAMILIAR'
                mostrarEtapa('listaRiesgoFamilia')
                $('#dialogEtapas').dialog('open')
            }).width(100).height(50)

            $('#btnMiembroFamilia').button({
                icons: {
                    primary: "ui-icon-pencil"
                }
            }).click(function() {
                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un miembro de la famila')
                    return
                }
                lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))

                if (lista.activo == 'IN') {
                    alert('El miembro seleccionado esta inactivo')
                    return
                }

                llenaRiesgo('', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                ETAPA = 'SI ALGUN MIEMBRO DE LA FAMILIA TIENE'
                OPCION = 'MIEMBROTIENE'
                mostrarEtapa('listaMiembroTiene')
                $('#dialogEtapas').dialog('open')
            }).width(100).height(50)

            $('#btnGestante').button({
                icons: {
                    primary: "ui-icon-pencil"
                }
            }).click(function() {
                if (!$('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un miembro de la famila')
                    return
                }
                lista = $('#listaMiembrosFamilia').jqGrid('getRowData', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                if (lista.activo == 'IN') {
                    alert('El miembro seleccionado esta inactivo')
                    return
                }
                if (lista.sexo == 'M') {
                    alert('Debe seleccionar un miembro de sexo femenino')
                    return
                }


                $.post('/sisfac/funcionesphp/adminRiesgo.php', {
                    f: 3,
                    idpersona: lista.idpersona,
                    idfamilia: CODIGOFICHA,
                    claveGeneral: CLAVEGENERAL
                }, function(data) {
                    if (data > 0) {
                        llenaRiesgo('', $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'))
                        ETAPA = 'GESTANTE'
                        OPCION = 'GESTANTE'
                        mostrarEtapa('listaRiesgoGestante')
                        $('#dialogEtapas').dialog('open')
                    } else {
                        alert('El miembro seleccionado no es una gestante')
                    }
                })


            }).width(100).height(50)

            function mostrarEtapa(etapa) {
                $('#gview_listaEtapaNino').hide()
                $('#gview_listaEtapaAdolescente').hide()
                $('#gview_listaEtapaJoven').hide()
                $('#gview_listaEtapaAdulto').hide()
                $('#gview_listaRiesgoFamilia').hide()
                $('#gview_listaMiembroTiene').hide()
                $('#gview_listaRiesgoGestante').hide()
                $('#gview_' + etapa).show()
            }

            function llenaRiesgo(idfamilia, idpersona) {
                $('#listaEtapaNino,#listaEtapaAdolescente,#listaEtapaJoven,#listaEtapaAdulto,#listaRiesgoFamilia,#listaMiembroTiene,#listaRiesgoGestante').jqGrid('resetSelection')
                $.post('/sisfac/funcionesphp/adminRiesgo.php', {
                    f: 2,
                    idfamilia: idfamilia,
                    idpersona: idpersona,
                    claveGeneral: CLAVEGENERAL
                }, function(data) {
                    data = data.split('-')
                    for (i in data) {
                        $('#listaEtapaNino').jqGrid('setSelection', data[i])
                        $('#listaEtapaAdolescente').jqGrid('setSelection', data[i])
                        $('#listaEtapaJoven').jqGrid('setSelection', data[i])
                        $('#listaEtapaAdulto').jqGrid('setSelection', data[i])
                        $('#listaRiesgoFamilia').jqGrid('setSelection', data[i])
                        $('#listaMiembroTiene').jqGrid('setSelection', data[i])
                        $('#listaRiesgoGestante').jqGrid('setSelection', data[i])
                    }
                })

            }
            tem = ""
            for (i = 66; i >= 1; i--) {
                if (i > 59) tem += "#listaRiesgoGestante tr#" + i + ' input:checkbox, ';
                else if (i > 57) tem += "#listaMiembroTiene tr#" + i + ' input:checkbox,';
                else if (i > 51) tem += "#listaRiesgoFamilia tr#" + i + ' input:checkbox,';
                else if (i > 38) tem += "#listaEtapaAdulto tr#" + i + ' input:checkbox,';
                else if (i > 24) tem += "#listaEtapaJoven tr#" + i + ' input:checkbox,';
                else if (i > 11) tem += "#listaEtapaAdolescente tr#" + i + ' input:checkbox,';
                else if (i > 1) tem += "#listaEtapaNino tr#" + i + ' input:checkbox,';
                else tem += "#listaEtapaNino tr#" + i + ' input:checkbox';
            }

            $(tem).click(function() {
                if (!$(this).is(':checked')) {
                    if (confirm('Esta acci\xf3n quita el registro seleccionado.\xbfDesea continuar?')) {
                        $.post('/sisfac/funcionesphp/adminRiesgo.php', {
                            oper: 'del',
                            claveGeneral: CLAVEGENERAL,
                            codriesgo: $(this).parent().parent().attr('id'),
                            idpersona: $('#listaMiembrosFamilia').jqGrid('getGridParam', 'selrow'),
                            idfamilia: CODIGOFICHA,
                            opcion: OPCION
                        }, function(data) {})
                    } else {
                        $("#" + $(this).parent().parent().parent().parent().attr('id')).jqGrid('setSelection', $(this).parent().parent().attr('id'))
                    }
                }
            })

            /*
            $('#cbLugarResidencia').change(function(){
                if($('#cbLugarResidencia').val()=='SI') $('#tbLugarResidencia').show()
                else $('#tbLugarResidencia').hide().val('')
            })*/


            $('#cbPertenenciaEtnica').change(function() {
                if ($('#cbPertenenciaEtnica').val() == '01. MESTIZO') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='58.MESTIZO'>58.MESTIZO</option>")
                } else if ($('#cbPertenenciaEtnica').val() == '02. AFRODESCENDIENTE') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='56.AFROPERUANO'>56.AFROPERUANO</option>")
                } else if ($('#cbPertenenciaEtnica').val() == '03. ANDINO') {
                    var ops = '<option value=""></option>';
                    ops += '<option value="02.AIMARA">02.AIMARA</option>';
                    ops += '<option value="19.JAQARU">19.JAQARU</option>';
                    ops += '<option value="40.QUECHUAS">40.QUECHUAS</option>';
                    ops += '<option value="49.URO">49.URO</option>';
                    $('#cbDesendenciaEtnica').html(ops);
                } else if ($('#cbPertenenciaEtnica').val() == '04. INDIGENA AMAZONICO') {
                    var ops = '<option value=""></option>';
                    ops += '<option value="01.ACHUAR">01.ACHUAR</option>';
                    ops += '<option value="03.AMAHUACA">03.AMAHUACA</option>';
                    ops += '<option value="04.ARABELA">04.ARABELA</option>';
                    ops += '<option value="05.ASHANINKA">05.ASHANINKA</option>';
                    ops += '<option value="06.ASHENINKA">06.ASHENINKA</option>';
                    ops += '<option value="07.AWAJUN">07.AWAJUN</option>';
                    ops += '<option value="08.BORA">08.BORA</option>';
                    ops += '<option value="09.CAPANAHUA">09.CAPANAHUA</option>';
                    ops += '<option value="10.CASHINAHUA">10.CASHINAHUA</option>';
                    ops += '<option value="11.CHAMICURO">11.CHAMICURO</option>';
                    ops += '<option value="12.CHAPRA">12.CHAPRA</option>';
                    ops += '<option value="13.CHITONAHUA">13.CHITONAHUA</option>';
                    ops += '<option value="14.ESE EJA">14.ESE EJA</option>';
                    ops += '<option value="15.HARAKBUT">15.HARAKBUT</option>';
                    ops += '<option value="16.IKITU">16.IKITU</option>';
                    ops += '<option value="18.ISCONAHUA">18.ISCONAHUA</option>';
                    ops += '<option value="20.JIBARO">20.JIBARO</option>';
                    ops += '<option value="21.KAKATAIBO">21.KAKATAIBO</option>';
                    ops += '<option value="22.KAKINTE">22.KAKINTE</option>';
                    ops += '<option value="23.KANDOZI">23.KANDOZI</option>';
                    ops += '<option value="24.KICHWA">24.KICHWA</option>';
                    ops += '<option value="25.KUKAMA KUKAMIRIA">25.KUKAMA KUKAMIRIA</option>';
                    ops += '<option value="26.MADIJA">26.MADIJA</option>';
                    ops += '<option value="27.MAIJUNA">27.MAIJUNA</option>';
                    ops += '<option value="29.MASHCO PIRO">29.MASHCO PIRO</option>';
                    ops += '<option value="30.MASTANAHUA">30.MASTANAHUA</option>';
                    ops += '<option value="31.MATSES">31.MATSES</option>';
                    ops += '<option value="32.MATSIGENKA">32.MATSIGENKA</option>';
                    ops += '<option value="34.MURUI-MUINANI">34.MURUI-MUINANI</option>';
                    ops += '<option value="35.NAHUA">35.NAHUA</option>';
                    ops += '<option value="36.NANTI">36.NANTI</option>';
                    ops += '<option value="37.NOMATSIGENGA">37.NOMATSIGENGA</option>';
                    ops += '<option value="38.OCAINA">38.OCAINA</option>';
                    ops += '<option value="39.OMAGUA">39.OMAGUA</option>';
                    ops += '<option value="41.RESIGARO">41.RESIGARO</option>';
                    ops += '<option value="42.SECOYA">42.SECOYA</option>';
                    ops += '<option value="43.SHARANAHUA">43.SHARANAHUA</option>';
                    ops += '<option value="44.SHAWI">44.SHAWI</option>';
                    ops += '<option value="45.SHIPIBO-KONIBO">45.SHIPIBO-KONIBO</option>';
                    ops += '<option value="46.SHIWILU">46.SHIWILU</option>';
                    ops += '<option value="47.TIKUNA">47.TIKUNA</option>';
                    ops += '<option value="48.URARINA">48.URARINA</option>';
                    ops += '<option value="51.WAMPIS">51.WAMPIS</option>';
                    ops += '<option value="52.YAGUA">52.YAGUA</option>';
                    ops += '<option value="53.YAMINAHUA">53.YAMINAHUA</option>';
                    ops += '<option value="54.YANESHA">54.YANESHA</option>';
                    ops += '<option value="55.YINE">55.YINE</option>';
                    $('#cbDesendenciaEtnica').html(ops)
                } else if ($('#cbPertenenciaEtnica').val() == '05. DESCENDIENTE') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='59.ASIATICODESCENDIENTE'>59.ASIATICODESCENDIENTE</option>")
                } else if ($('#cbPertenenciaEtnica').val() == '06. OTROS') {
                    $('#cbDesendenciaEtnica').html("<option value=''></option><option value='60.OTRO'>60.OTRO</option>")
                }




            })
        }

        function cuartoTab() {
            $("#listaSaludHogar").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Salud en el hogar'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'tipo',
                    index: 'tipo',
                    width: 150
                }, ],
                multiselect: true
            });
            var mydata = [{
                id: '1',
                tipo: "Clinica"
            }, {
                id: '2',
                tipo: "Hospital"
            }, {
                id: '3',
                tipo: "P.S"
            }, {
                id: '4',
                tipo: "C.S"
            }, {
                id: '5',
                tipo: "Casa"
            }, {
                id: '6',
                tipo: "Botica O farmacia"
            }, {
                id: '7',
                tipo: "Terapeuta Tradicional"
            }, ];
            for (var i = 0; i <= mydata.length; i++) $("#listaSaludHogar").jqGrid('addRowData', i + 1, mydata[i]);

            $('#tab4 select').width(200)
            $('#cbSaludHogar,#cbSaludHogar1').width(100)
            $('#btnGuardarSocioEconomico').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                if (CODIGOFICHA == '') {
                    alert('Debe seleccionar un registro de ficha')
                    return
                }
                valores = obtenerValores($('#tab4 option:selected[value]').toArray())
                $.post('/sisfac/funcionesphp/adminSocioEconomico.php', {
                    oper: 'add',
                    idfamilia: CODIGOFICHA,
                    claveGeneral: CLAVEGENERAL,
                    valores: valores
                }, function(data) {
                    alert('Se guardaron los datos')
                })
            }).width(100).height(50)
            $('#btnCancelarSocioEconomico').button({
                icons: {
                    primary: "ui-icon-close"
                }
            }).click(function() {}).width(100).height(50)
            temp = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
            $.post('/sisfac/funcionesphp/adminSocioEconomico.php', {
                f: 2,
                idfamilia: CODIGOFICHA,
                claveGeneral: temp.claveGeneral
            }, function(data) {
                data = data.split('-')
                $('#cbEstadoCivil').val(data[0])
                $('#cbGrupoFamiliar').val(data[1])
                $('#cbTenenciaVivienda').val(data[2])
                $('#cbAguaConsumo').val(data[3])
                $('#cbEliminacionExcretas').val(data[4])
                $('#cbNroHabitacionesHogar').val(data[5])
                $('#cbEnergiaElectrica').val(data[6])
                $('#cbOcupacionJefe').val(data[7])
                $('#cbInstruccionMadre').val(data[8])
                $('#cbIngresoFamiliar').val(data[9])
                $('#cbPersonaDormitorio').val(data[10])
                $('#listaSaludHogar').jqGrid('resetSelection')
                for (i = 1; i < 6; i++) {
                    $('#listaSaludHogar').jqGrid('setSelection', $.inArray(data[10 + i], ['CLINICA', 'HOSPITAL', 'P.S', 'C.S', 'CASA', 'BOTICA O FARMACIA']) + 1)
                }

            })
        }

        function quintoTab() {

            $('#cbBiohuerto').change(function() {
                if ($('#cbBiohuerto').val() == 'SI') $('#gview_listaBiohuerto').show()
                else $('#gview_listaBiohuerto').hide()
            }).width(180)

            $('#btnExpandir').button({
                icons: {
                    primary: "ui-icon-carat-1-n"
                }
            }).click(function() {
                $("#listaVivienda,#listaParedes,#listaPiso,#listaTecho,#listaOrganizacionVivienda,#listaArtefactos,#listaCombustible,#listaBasura,#listaAnimales,#listaVacunas,#listaEntorno,#listaBiohuerto").jqGrid('setGridState', 'visible')
            }).width(100).height(50)
            $('#btnContraer').button({
                icons: {
                    primary: "ui-icon-carat-1-s"
                }
            }).click(function() {
                $("#listaVivienda,#listaParedes,#listaPiso,#listaTecho,#listaOrganizacionVivienda,#listaArtefactos,#listaCombustible,#listaBasura,#listaAnimales,#listaVacunas,#listaEntorno,#listaBiohuerto").jqGrid('setGridState', 'hidden')
            }).width(100).height(50)


            $('#btnGuardarVivienda').button({
                icons: {
                    primary: "ui-icon-plus"
                }
            }).click(function() {
                if (!$('#listaFamilia').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar un registro de ficha')
                    return
                }
                //alert($('#cbBiohuerto').val())
                entorno = obtenerEntorno('listaVivienda', 'Tipo de vivienda') + '*' + obtenerEntorno('listaParedes', 'Material de paredes') + '*' + obtenerEntorno('listaPiso', 'Material del piso') + '*' + obtenerEntorno('listaTecho', 'Material de techo') + '*' + obtenerEntorno('listaOrganizacionVivienda', 'Organizacion de la vivienda') + '*' + obtenerEntorno('listaArtefactos', 'Artefactos del hogar') + '*' + obtenerEntorno('listaCombustible', 'Combustible para cocinar') + '*' + obtenerEntorno('listaBasura', 'Disposicion de basura') + '*' + obtenerEntorno('listaAnimales', 'Tenencia de animales') + '*' + obtenerEntorno('listaVacunas', 'Vacunas') + '*' + obtenerEntorno('listaEntorno', 'Riesgo X Entorno') + '*' + ($('#cbBiohuerto').val() == 'SI' ? obtenerEntorno('listaBiohuerto', 'Biohuerto') : ('BIOHUERTO+NO+0')) + ('*NUMERO DE CANES+' + $('#tbNroCanes').val() + '+0')
                    //listaVivienda,listaParedes,listaPiso,listaTecho,listaOrganizacionVivienda,listaArtefactos,listaCombustible,listaBasura,listaAnimales,listaVacunas,listaEntorno
                    //#listaVivienda,#listaParedes,#listaPiso,#listaTecho,#listaOrganizacionVivienda,#listaArtefactos,#listaCombustible,#listaBasura,#listaAnimales,#listaVacunas,#listaEntorno
                $.post('/sisfac/funcionesphp/adminEntorno.php', {
                    oper: 'add',
                    idfamilia: CODIGOFICHA,
                    claveGeneral: CLAVEGENERAL,
                    entorno: entorno
                }, function(data) {
                    alert('Los datos se guardaron correctamente')
                })
            }).width(100).height(50)

            $('#btnCancelarVivienda').button({
                icons: {
                    primary: "ui-icon-close"
                }
            }).click(function() {
                $('#istaVivienda,#listaParedes,#listaPiso,#listaTecho,#listaOrganizacionVivienda,#listaArtefactos,#listaCombustible,#listaBasura,#listaAnimales,#listaVacunas,#listaEntorno,#listaBiohuerto').jqGrid('resetSelection')
                $('#tbBiohuerto').val('')
            }).width(100).height(50)

            tem = ""
            for (i = 85; i >= 1; i--) {

                if (i > 81) tem += "#listaBiohuerto tr#" + i + ' input:checkbox, ';
                if (i > 71) tem += "#listaEntorno tr#" + i + ' input:checkbox, ';
                else if (i > 62) tem += "#listaVacunas tr#" + i + ' input:checkbox,';
                else if (i > 52) tem += "#listaAnimales tr#" + i + ' input:checkbox,';
                else if (i > 47) tem += "#listaBasura tr#" + i + ' input:checkbox,';
                else if (i > 42) tem += "#listaCombustible tr#" + i + ' input:checkbox,';
                else if (i > 30) tem += "#listaArtefactos tr#" + i + ' input:checkbox,';
                else if (i > 22) tem += "#listaOrganizacionVivienda tr#" + i + ' input:checkbox,';
                else if (i > 16) tem += "#listaTecho tr#" + i + ' input:checkbox,';
                else if (i > 10) tem += "#listaPiso tr#" + i + ' input:checkbox,';
                else if (i > 5) tem += "#listaParedes tr#" + i + ' input:checkbox,';
                else if (i > 1) tem += "#listaVivienda tr#" + i + ' input:checkbox,';
                else tem += "#listaVivienda tr#" + i + ' input:checkbox';
            }

            $(tem).click(function() {
                if (!$(this).is(':checked')) {
                    if (confirm('Esta acci\xf3n quita el registro seleccionado.\xbfDesea continuar?')) {
                        $.post('/sisfac/funcionesphp/adminEntorno.php', {
                            oper: 'del',
                            codentorno: $(this).parent().parent().attr('id'),
                            idfamilia: CODIGOFICHA
                        }, function(data) {})
                    } else {
                        $("#" + $(this).parent().parent().parent().parent().attr('id')).jqGrid('setSelection', $(this).parent().parent().attr('id'))
                    }
                }
            })
        }

        function sextoTab() {
            temp = $('#listaFamilia').jqGrid('getRowData', $('#listaFamilia').jqGrid('getGridParam', 'selrow'))
            $('#listaVisita').jqGrid({
                url: '/sisfac/funcionesphp/adminVisita.php?f=1&idfamilia=' + CODIGOFICHA + '&claveGeneral=' + temp.claveGeneral,
                datetype: 'xml',
                colNames: ['idvisita', 'idfamilia', 'Fecha visita', 'Trabajador', 'Trabajador', 'Resultado', 'Fecha cita', 'Estado de cita', 'Motivo de cambio'],
                colModel: [{
                    name: 'idvisita',
                    index: 'idvisita',
                    width: 80,
                    hidden: true,
                    editable: true
                }, {
                    name: 'idfamilia',
                    index: 'idfamilia',
                    width: 80,
                    hidden: true
                }, {
                    name: 'fechavisita',
                    index: 'fechavisita',
                    width: 80,
                    editable: true,
                    formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeYear: true,
                                changeMonth: true
                            });
                        }
                    }
                }, {
                    name: 'idtrabajador',
                    index: 'idtrabajador',
                    width: 250,
                    hidden: true,
                    editable: true,
                    edittype: 'select',
                    editrules: {
                        edithidden: true
                    },
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminTrabajador.php?f=2',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'nombreCompleto',
                    index: 'nombreCompleto',
                    width: 250
                }, {
                    name: 'resultado',
                    index: 'resultado',
                    width: 80,
                    formatter: 'select',
                    edittype: 'select',
                    editable: true,
                    editoptions: {
                        value: 'ATENDIDO:ATENDIDO;AUSENTE:AUSENTE;RECHAZO:RECHAZO;ABANDONO:ABANDONO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'fechacita',
                    index: 'fechacita',
                    width: 80,
                    editable: true,
                    formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeYear: true,
                                changeMonth: true
                            });
                        }
                    }
                }, {
                    name: 'estadoCita',
                    index: 'estadoCita',
                    width: 120,
                    formatter: 'select',
                    edittype: 'select',
                    editable: true,
                    editoptions: {
                        value: ':;PENDIENTE:PENDIENTE;CUMPLIO:CUMPLIO;NO CUMPLIO:NO CUMPLIO',
                        dataInit: function(el) {
                            $(el).width(160)
                        }
                    }
                }, {
                    name: 'motivo',
                    index: 'motivo',
                    width: 140,
                    editable: true
                }],
                height: 150,
                sortname: 'vi.idvisita',
                sortorder: 'asc',
                viewrecords: true,
                rowNum: 1000,
                pager: '#pagerVisita',
                pginput: false,
                rownumbers: true,
                caption: 'Visita domiciliaria',
                editurl: "/sisfac/funcionesphp/adminVisita.php"
            })
            $('#listaVisita').jqGrid('navGrid', '#pagerVisita', {
                edit: false,
                add: false,
                del: false,
                search: false,
                view: false
            })

            $('#btnGuardarVisita').button({
                icons: {
                    primary: "ui-icon-plus"
                }
            }).click(function() {
                if (!CODIGOFICHA) {
                    alert('Debe seleccionar un registro de ficha familiar')
                    return
                }
                $("#listaVisita").jqGrid('editGridRow', "new", {
                    reloadAfterSubmit: true,
                    closeAfterAdd: true,
                    beforeShowForm: function(formid) {
                        $('#tr_fechavisita').show()
                        $('#tr_resultado').show()
                        $('#tr_motivo').hide()
                    },
                    onclickSubmit: function(params) {
                        return {
                            idfamilia: CODIGOFICHA
                        };
                    },
                    afterComplete: function(response, postdata, formid) {
                        if (confirm('\xbfDesea guardar el historial de la ficha seleccionada?')) {
                            $('#dialogHistorial').dialog('open')
                        }
                    }
                })
            }).width(100).height(50)

            $('#btnModificarVisita').button({
                icons: {
                    primary: "ui-icon-pencil"
                }
            }).click(function() {
                if (!CODIGOFICHA) {
                    alert('Debe seleccionar un registro de ficha familiar')
                    return
                }
                rowid = $('#listaVisita').jqGrid('getGridParam', 'selrow')
                if (!rowid) {
                    alert('Debe seleccionar un registro de visitas')
                    return
                }
                $("#listaVisita").jqGrid('editGridRow', rowid, {
                    reloadAfterSubmit: true,
                    closeAfterEdit: true,
                    beforeShowForm: function(formid) {
                        $('#tr_fechavisita').hide()
                        $('#tr_resultado').hide()
                        $('#tr_motivo').show()
                    },
                    onclickSubmit: function(params) {
                        return {
                            idfamilia: CODIGOFICHA
                        };
                    },
                    afterComplete: function(response, postdata, formid) {
                        if (confirm('\xbfDesea guardar el historial de la ficha seleccionada?')) {
                            $('#dialogHistorial').dialog('open')
                        }
                    }
                })
            }).width(100).height(50)

            $('#btnEliminarVisita').button({
                icons: {
                    primary: "ui-icon-close"
                }
            }).click(function() {
                if (!CODIGOFICHA) {
                    alert('Debe seleccionar un registro de ficha familiar')
                    return
                }
                rowid = $('#listaVisita').jqGrid('getGridParam', 'selrow')
                if (!rowid) {
                    alert('Debe seleccionar un registro de visitas')
                    return
                }
                if (confirm('\xbfEsta seguro que desea eliminar el registro seleccionado?')) {
                    $.post('/sisfac/funcionesphp/adminVisita.php', {
                        oper: 'del',
                        'id': $('#listaVisita').jqGrid('getGridParam', 'selrow')
                    }, function(data) {
                        $('#listaVisita').trigger('reloadGrid');
                    });
                }
            }).width(100).height(50)
        }

        function iniciarTabs() {
            $('#tabs').show();
            $('#tabs').tabs({
                selected: 0,
                select: function(event, ui) {
                    if (tabSeleccionados.indexOf(ui.index) == -1) {
                        tabSeleccionados.push(ui.index);
                        eval(funciones[ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 4) - 1]);
                    }
                }
            });
            /*if(TIPOUSU == 'NOR'){
                $('#contenidoFicha,#contenidoRegion,#contenidoProvincia,#contenidoRed,#contenidoTrabajadores,#contenidoEstablecimiento,#contenidoSector').find('input, textarea, button, select').attr('disabled','disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6,dialog').find('input, textarea, button, select').attr('disabled','disabled').addClass('ui-button-disabled ui-state-disabled')
            }*/
            if (TIPOUSU == 'VIS') {
                $('#btnModificarFicha,#btnGuardarHistorial,#btnEditarFicha,#btnAgregarFicha,#btnEliminarFicha,#btnActivarFicha,#btnInactivarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#btnGuardarHistorial,#btnEditarFicha').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
                $('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6').find('input, textarea, button, select').attr('disabled', 'disabled').addClass('ui-button-disabled ui-state-disabled')
            }
        }

        iniciarTabs();
        llenarGridMultiselect()
        primerTab();
        segundoTab();
        tercerTab();
        cuartoTab();
        quintoTab();
        sextoTab();
    }

    $('#dialogBusqueda').dialog({
        modal: true,
        autoOpen: false,
        show: 'blind',
        hide: 'drop',
        width: 'auto',
        height: 'auto',
        buttons: {
            Aceptar: function() {
                if ($('#tbBuscarDNI').val() != '' || $('#tbBuscaCodigoFicha').val() != '' || $('#tbBuscarHistoria').val() != '' || $('#tbBuscarNombre').val() != '' || $('#tbBuscaRegion').val() != '' || $('#tbBuscarProvincia').val() != '') {
                    $('#listaBusqueda').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminPersona.php?f=4&dni=' + $('#tbBuscarDNI').val() + '&codigoFicha=' + $('#tbBuscaCodigoFicha').val() + '&numeroHC=' + $('#tbBuscarHistoria').val() + '&nombresApellidos=' + $('#tbBuscarNombre').val() + '&nombreRegion=' + $('#tbBuscaRegion').val() + '&nompro=' + $('#tbBuscarProvincia').val()
                    }).trigger('reloadGrid')
                    $('#dialogBusqueda').dialog('close')
                }
            },
            Cancelar: function() {
                $('#dialogBusqueda').dialog('close')
            }
        }
    })

    function contenidoFichaClinica() {
        var tabSeleccionadosClinica = Array(),
            funcionesClinica = ['primerTabClinica();', 'segundoTabClinica();', 'tercerTabClinica();', 'cuartoTabClinica();', 'quintoTabClinica();', 'sextoTabClinica();', 'septimoTabClinica();', 'octavoTabClinica();', 'novenoTabClinica();'];


        $('#btnBuscarMiembro').button({
            icons: {
                primary: "ui-icon-search"
            }
        }).click(function() {
            //alert($('#tbBuscarDNI,#tbBuscaCodigo,#tbBuscarHistoria,#tbBuscarNombre,#tbBuscaRegion,#tbBuscarProvincia').val())
            $('#dialogBusqueda').dialog('open')
        }).width(100).height(80)

        $('#cbTipoEpisodio').change(function() {
            if ($('#cbTipoEpisodio').val() == 'PREVENTIVO') {
                $('#taMotivoConsulta,#taSintomas,#taRegistroSindrome,#tbTiempoEnfermedad,#cbTiempoEnfermedad').attr('disabled', 'disabled')
            } else {
                $('#taMotivoConsulta,#taSintomas,#taRegistroSindrome,#tbTiempoEnfermedad,#cbTiempoEnfermedad').removeAttr('disabled')
            }
        })

        $('#taVidaSocial,#taViolencia,#taEducativo,#taHabitos,#taLabores,#taOtros').attr('style', "border-spacing: 10px ; font-size: 12px; font-weight: bold")

        $('#listaBusqueda').jqGrid({
            url: '/sisfac/funcionesphp/adminPersona.php?f=4&dni=0',
            datatype: "xml",
            colNames: ['id', 'Ficha familiar', 'Nro. HC', 'Tipo de documento', 'Nro. de documento', 'Nombres y apellidos', 'Sexo', 'Fec. Nac.', 'Edad', 'Tipo de seguro', 'Nro. de seguro', 'Parentesco', 'ETAPA', 'Dias', 'Desen etnica'],
            colModel: [{
                name: 'idpersona',
                index: 'idpersona',
                width: 200,
                hidden: true
            }, {
                name: 'codigoFamilia',
                index: 'codigoFamilia',
                width: 100
            }, {
                name: 'numeroHC',
                index: 'numeroHC',
                width: 60
            }, {
                name: 'opcionDNI',
                index: 'opcionDNI',
                width: 100
            }, {
                name: 'dni',
                index: 'dni',
                width: 100
            }, {
                name: 'nombresApellidos',
                index: 'nombresApellidos',
                width: 250
            }, {
                name: 'sexo',
                index: 'sexo',
                width: 80,
                formatter: 'select',
                editoptions: {
                    value: 'M:MASCULINO;F:FEMENINO'
                }
            }, {
                name: 'fechaNacimiento',
                index: 'fechaNacimiento',
                width: 90,
                formatter: 'date',
                formatoptions: {
                    srcformat: 'Y-m-d',
                    newformat: 'd/m/Y'
                }
            }, {
                name: 'edad',
                index: 'edad',
                width: 200
            }, {
                name: 'seguroMedico',
                index: 'seguroMedico',
                width: 80
            }, {
                name: 'numeroSeguro',
                index: 'numeroSeguro',
                width: 80
            }, {
                name: 'parentesco',
                index: 'parentesco',
                width: 100,
                formatter: 'select',
                editoptions: {
                    value: 'P:PADRE;M:MADRE;H:HIJO/HIJA;A:ABUELO/ABUELA;T:TIO/TIA;N:NIETO/NIETA;PA:PADRE ADOPTIVO;MA:MADRE ADOPTIVA;PD:PADASTRO;MD:MADASTRA;NU:NUERA;YE:YERNO;OT:OTRO'
                }
            }, {
                name: 'etapa',
                index: 'etapa',
                width: 80,
                hidden: true
            }, {
                name: 'dias',
                index: 'dias',
                width: 80,
                hidden: true
            }, {
                name: 'desendenciaEtnica',
                index: 'desendenciaEtnica',
                width: 80,
                hidden: true
            }],
            height: 100,
            width: 1000,
            rowNum: 10,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idpersona',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            pager: '#pagerBusqueda',
            onSelectRow: function(rowid, status) {
                $('#listaEpisodio').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminEpisodio.php?f=1&idpersona=' + rowid
                }).trigger('reloadGrid')
                lista = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                if (lista.etapa == 'GESTANTE') $('#trSemanaGestacional').show()
                else $('#trSemanaGestacional').hide()
                llenaLista($('#listaBusqueda').jqGrid('getRowData', rowid))
            },
            afterInsertRow: function(rowid, rowdata, rowelem) {
                if (rowdata.edad != '') {
                    $('#listaBusqueda').jqGrid('setCell', rowid, 'edad', calcularEdad(rowdata.edad), {});
                    $('#listaBusqueda').jqGrid('setCell', rowid, 'etapa', obtenerEtapaMiembro(rowdata.edad, rowdata.sexo, 'rowdata.gestante'), {});
                    //alert(obtenerEtapaMiembro(rowdata.edad, rowdata.sexo, 'rowdata.gestante'))
                }
            }
        });

        var lp = new ListaPatologia($('#divPatologico'), 'PATOLOGIA')
        var lh = new ListaPatologia($('#divHospitalizacion'), 'HOSPITALIZACION')
        var lt = new ListaPatologia($('#divTransfusion'), 'TRANSFUSION')
        var lin = new ListaPatologia($('#divIntervencion'), 'INTERVENCION')




        function llenaLista(lista) {
            $('#tbConsultaHC').val(lista.numeroHC)

            if (lista.parentesco == 'M' || lista.parentesco == 'H') $('#divTabClinica1 div:first').show()
            else $('#divTabClinica1 div:first').hide()

            if (lista.parentesco == 'H') {
                $('#pagerGinecobstetricos,#btnGuardarGinecobstetrico').hide()
                $('div[nombre=Prenatal]').show()
            } else if (lista.parentesco == 'M') {
                $('#pagerGinecobstetricos,#btnGuardarGinecobstetrico').show()
                    //$('div[nombre=Prenatal]').hide()
            }

            $('#listaNacimiento').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminAntecedenteNacimiento.php?f=1&iddetalleGinecobstetrico=0'
            }).trigger('reloadGrid')

            $('#listaAntecedenteVacuna').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminVacuna.php?f=1&idpersona=' + lista.idpersona
            }).trigger('reloadGrid')
            $('#listaAntecedenteDetalleVacuna').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminDetalleVacuna.php?f=1&idvacuna=-1'
            }).trigger('reloadGrid')

            $('#tbFechaExamenProstatico,#tbCIE10Prostatico,#tbCIE10TactoRectal,#tbTiempoUso,#cbDetallePAP,#tbCIE10IVAA,#tbCIE10Mamas,#tbCantidadAlcohol,#cbFrecuenciaAlcohol,#tbNroVecesAlcohol,#tbCantidadCigarrillos,#tbCantidadCajetillas,#cbFrecuenciaTabaco,#tbNroVecesTabaco,#cbFrecuenciaDrogas,#tbNroVecesDroga,#cbFrecuenciaHojaCoca,#tbNroVecesHojaCoca,#tbEdadInicio,#cbRiesgoOcupacional,input:radio[name="chTipoTrabajo"],#cbFrecuenciaActividad,#tbNroVecesActividad,#tbEdadPareja,#tbHorasDiaPornografia,#tbHorasDiaVideo,#tbFechaUltimoPAP,#tbFechaUltimoIVAA,#tbFechaExamenMamas,input:radio[name="chResultadoExamenProstatico"],input:radio[name="chTacto"],#cbTipoMamas,input:radio[name="chResultadoPAP"],input:radio[name="chResultadoIVAA"],input:radio[name="chResultadoExamen"]').attr('disabled', 'disabled');

            $('input:radio[name="chResultadoExamenProstatico"][value=NORMAL],input:radio[name="chTacto"][value=NORMAL],input:radio[name="rbTactoRectal"][value=NO],input:radio[name="rbExamenProstatico"][value=NO],input:radio[name="chResultadoExamen"][value=NORMAL],input:radio[name="chResultadoIVAA"][value=NORMAL],input:radio[name="chPornografia"][value=NO],input:radio[name="chVideoJuegos"][value=NO],input:radio[name="rbUltimoPAP"][value=NO],input:radio[name="rbUltimoIVAA"][value=NO],input:radio[name="rbExamenMamas"][value=NO],input:radio[name="chEdadRelacion"][value=NO],input:radio[name="chMetodo"][value=NO],input:radio[name="chActividad"][value=NO],input:radio[name="rbAlchocol"][value=NO],input:radio[name="rbTabaco"][value=NO],input:radio[name="rbDrogas"][value=NO],input:radio[name="rbHojaCoca"][value=NO],input:radio[name="chTrabaja"][value=NO]').attr('checked', true)
            $('#listaMetodo').attr('style', 'display:none;')


            $('input:radio[name="rbUltimoPAP"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaUltimoPAP').attr('disabled', 'disabled');
                else $('#tbFechaUltimoPAP').removeAttr('disabled');
            })

            $('input:radio[name="rbUltimoIVAA"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaUltimoIVAA').attr('disabled', 'disabled');
                else $('#tbFechaUltimoIVAA').removeAttr('disabled');
            })

            $('input:radio[name="rbExamenMamas"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaExamenMamas,#cbTipoMamas').attr('disabled', 'disabled');
                else $('#tbFechaExamenMamas,#cbTipoMamas').removeAttr('disabled');
            })

            $('input:radio[name="chEdadRelacion"]').change(function() {
                if ($(this).val() == 'NO') $('#tbEdadPareja').attr('disabled', 'disabled');
                else $('#tbEdadPareja').removeAttr('disabled');
            })

            $('input:radio[name="chMetodo"]').change(function() {
                if ($(this).val() == 'NO') {
                    $('#listaMetodo').attr('style', 'display:none;')
                    $('#tbTiempoUso').attr('disabled', 'disabled');
                } else {
                    $('#listaMetodo').removeAttr('style')
                    $('#tbTiempoUso').removeAttr('disabled');
                }
            })

            $('input:radio[name="chActividad"]').change(function() {
                if ($(this).val() == 'NO') $('#cbFrecuenciaActividad,#tbNroVecesActividad').attr('disabled', 'disabled');
                else $('#cbFrecuenciaActividad,#tbNroVecesActividad').removeAttr('disabled');
            })

            $('input:radio[name="rbAlchocol"]').change(function() {
                if ($(this).val() == 'NO') $('#tbCantidadAlcohol,#cbFrecuenciaAlcohol,#tbNroVecesAlcohol').attr('disabled', 'disabled');
                else $('#tbCantidadAlcohol,#cbFrecuenciaAlcohol,#tbNroVecesAlcohol').removeAttr('disabled');
            })

            $('input:radio[name="rbTabaco"]').change(function() {
                if ($(this).val() == 'NO') $('#tbCantidadCigarrillos,#tbCantidadCajetillas,#cbFrecuenciaTabaco,#tbNroVecesTabaco').attr('disabled', 'disabled');
                else $('#tbCantidadCigarrillos,#tbCantidadCajetillas,#cbFrecuenciaTabaco,#tbNroVecesTabaco').removeAttr('disabled');
            })

            $('input:radio[name="rbDrogas"]').change(function() {
                if ($(this).val() == 'NO') $('#cbFrecuenciaDrogas,#tbNroVecesDroga').attr('disabled', 'disabled');
                else $('#cbFrecuenciaDrogas,#tbNroVecesDroga').removeAttr('disabled');
            })

            $('input:radio[name="rbHojaCoca"]').change(function() {
                if ($(this).val() == 'NO') $('#cbFrecuenciaHojaCoca,#tbNroVecesHojaCoca').attr('disabled', 'disabled');
                else $('#cbFrecuenciaHojaCoca,#tbNroVecesHojaCoca').removeAttr('disabled');
            })

            $('input:radio[name="chTrabaja"]').change(function() {
                if ($(this).val() == 'NO') $('#tbEdadInicio,#cbRiesgoOcupacional,input:radio[name="chTipoTrabajo"]').attr('disabled', 'disabled');
                else $('#tbEdadInicio,#cbRiesgoOcupacional,input:radio[name="chTipoTrabajo"]').removeAttr('disabled');
            })

            $('input:radio[name="chPornografia"]').change(function() {
                if ($(this).val() == 'NO') $('#tbHorasDiaPornografia').attr('disabled', 'disabled');
                else $('#tbHorasDiaPornografia').removeAttr('disabled');
            })

            $('input:radio[name="chVideoJuegos"]').change(function() {
                if ($(this).val() == 'NO') $('#tbHorasDiaVideo').attr('disabled', 'disabled');
                else $('#tbHorasDiaVideo').removeAttr('disabled');
            })

            $('input:radio[name="rbUltimoPAP"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaUltimoPAP,input:radio[name="chResultadoPAP"],#cbDetallePAP').attr('disabled', 'disabled');
                else $('#tbFechaUltimoPAP,input:radio[name="chResultadoPAP"]').removeAttr('disabled');
            })

            $('input:radio[name="chResultadoPAP"]').change(function() {
                if ($(this).val() == 'NORMAL') $('#cbDetallePAP').attr('disabled', 'disabled');
                else $('#cbDetallePAP').removeAttr('disabled');
            })

            $('input:radio[name="rbUltimoIVAA"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaUltimoIVAA,input:radio[name="chResultadoIVAA"],#tbCIE10IVAA').attr('disabled', 'disabled');
                else $('#tbFechaUltimoIVAA,input:radio[name="chResultadoIVAA"]').removeAttr('disabled');
            })

            $('input:radio[name="rbExamenMamas"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaExamenMamas,#cbTipoMamas,input:radio[name="chResultadoExamen"],#tbCIE10Mamas').attr('disabled', 'disabled');
                else $('#tbFechaExamenMamas,input:radio[name="chResultadoExamen"]').removeAttr('disabled');
            })

            $('input:radio[name="chResultadoIVAA"]').change(function() {
                if ($(this).val() == 'NORMAL') $('#tbCIE10IVAA,#tbIdCIE10IVAA').attr('disabled', 'disabled').val('');
                else $('#tbCIE10IVAA,#tbIdCIE10IVAA').removeAttr('disabled').val('');
            })

            $('input:radio[name="chResultadoExamen"]').change(function() {
                if ($(this).val() == 'NORMAL') $('#tbCIE10Mamas,#tbIdCIE10Mamas').attr('disabled', 'disabled').val('');
                else $('#tbCIE10Mamas,#tbIdCIE10Mamas').removeAttr('disabled').val('');
            })

            $('input:radio[name="rbExamenProstatico"]').change(function() {
                if ($(this).val() == 'NO') $('#tbFechaExamenProstatico,#tbCIE10Prostatico,input:radio[name="chResultadoExamenProstatico"]').attr('disabled', 'disabled');
                else $('#tbFechaExamenProstatico,input:radio[name="chResultadoExamenProstatico"]').removeAttr('disabled');
            })

            $('input:radio[name="rbTactoRectal"]').change(function() {
                if ($(this).val() == 'NO') $('#tbCIE10TactoRectal,input:radio[name="chTacto"]').attr('disabled', 'disabled');
                else $('input:radio[name="chTacto"]').removeAttr('disabled');
            })

            $('input:radio[name="chResultadoExamenProstatico"]').change(function() {
                if ($(this).val() == 'NORMAL') $('#tbCIE10Prostatico,#tbIdCIE10Prostatico').attr('disabled', 'disabled').val('');
                else $('#tbCIE10Prostatico,#tbIdCIE10Prostatico').removeAttr('disabled').val('');
            })

            $('input:radio[name="chTacto"]').change(function() {
                if ($(this).val() == 'NORMAL') $('#tbCIE10TactoRectal,#tbIdCIE10TactoRectal').attr('disabled', 'disabled').val('');
                else $('#tbCIE10TactoRectal,#tbIdCIE10TactoRectal').removeAttr('disabled').val('');
            })






            if (lista.sexo == 'M' && lista.dias > (40 * 12 * 30)) {
                $('#trMujeres').hide()
                $('#trVarones').show()
            } else if (lista.sexo == 'M' && lista.dias < (40 * 12 * 30)) {
                $('#trMujeres').hide()
                $('#trVarones').hide()
            } else if (lista.sexo == 'F') {
                $('#trMujeres').show()
                $('#trVarones').hide()
            }

            if (lista.etapa == 'NINO') {
                $('div[name=divSaludSexual]').hide()
                    //$('div[name=divPsicosociales]').hide()
            } else {
                $('div[name=divSaludSexual]').show()
            }

            $('div[name=divPsicosociales]').show()

            if (lista.etapa == 'GESTANTE') {
                $('#trTos').show()
            } else {
                $('#trTos').hide()
            }

            ochoAnio = 8 * 12 * 30
            cincoAnio = 5 * 12 * 30
            treintaAnio = 30 * 12 * 30
            dieciochoAnio = 30 * 12 * 30

            $('#taVidaSocial,#taViolencia,#taEducativo,#taHabitos,#taLabores,#taOtros').show()

            if (lista.dias > cincoAnio && lista.dias < treintaAnio) {
                $('#taVidaSocial').show()
            } else {
                $('#taVidaSocial').hide()
            }

            if (lista.dias > cincoAnio && lista.dias < dieciochoAnio) {
                $('#taEducativo').show()
            } else {
                $('#taEducativo').hide()
            }

            if (lista.dias > ochoAnio) {
                $('#taHabitos,#taOtros').show()
            } else {
                $('#taHabitos,#taOtros').hide()
            }
            if (lista.dias > cincoAnio) {
                $('#taLabores').show()
            } else {
                $('#taLabores').hide()
            }

            if (lista.etapa == 'NINO' || lista.etapa == 'ADOLESCENTE') {
                $('input:radio[name=chBullyng]').parent().parent().removeAttr('style')
            } else {
                $('input:radio[name=chBullyng]').parent().parent().attr('style', 'display:none')
            }


            if (lista.parentesco == 'H') {
                $.post('/sisfac/funcionesphp/adminPersona.php', {
                    f: 5,
                    codigoFicha: lista.codigoFamilia
                }, function(datos) {
                    $.post('/sisfac/funcionesphp/adminAntecedenteGinecobstetrico.php', {
                        f: 1,
                        idpersona: datos
                    }, function(data) {
                        data = data.split('-')
                        $('#tbIdGinecobstetrico').val(data[0])
                        $('#tbGestaciones').val(data[1])
                        $('#tbParidad').val(data[2])
                        $('#tbIntergenesico').val(data[3])

                        $('#listaGinecobstetricos').jqGrid('setGridParam', {
                            url: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php?f=1&idantecedenteGinecobstetrico=' + data[0] + '&idpersonaref=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow') + '&parentesco=' + lista.parentesco
                        }).trigger('reloadGrid')
                    })
                })
            } else {
                $.post('/sisfac/funcionesphp/adminAntecedenteGinecobstetrico.php', {
                    f: 1,
                    idpersona: lista.idpersona,
                    parentesco: lista.parentesco
                }, function(data) {
                    data = data.split('-')
                    $('#tbIdGinecobstetrico').val(data[0])
                    $('#tbGestaciones').val(data[1])
                    $('#tbParidad').val(data[2])
                    $('#tbIntergenesico').val(data[3])
                    $('#listaGinecobstetricos').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php?f=1&idantecedenteGinecobstetrico=' + data[0] + '&idpersonaref=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow') + '&parentesco=' + lista.parentesco
                    }).trigger('reloadGrid')
                })
            }

            $.post('/sisfac/funcionesphp/adminAntecedenteNacimiento.php', {
                f: 2,
                iddetalleGinecobstetrico: -1
            }, function(data) {
                llenaNacimiento(data)
            })


            lp.actualizarConDato(lista.idpersona, 'PATOLOGIA')
            lh.actualizarConDato(lista.idpersona, 'HOSPITALIZACION')
            lt.actualizarConDato(lista.idpersona, 'TRANSFUSION')
            lin.actualizarConDato(lista.idpersona, 'INTERVENCION')

            $.post('/sisfac/funcionesphp/adminAntecedenteSexual.php', {
                f: 1,
                idpersona: lista.idpersona
            }, function(data) {

                //0 idantecedenteSexual, 1 claveGeneral, 2 idpersona, 3 menarquia, 4 regimenCatamenial, 5 opcionPAP, 6 mesAnioPAP, 7 resultadoPAP, 8 detallePAP, 
                //9 opcionIVAA,10 mesAnioIVAA,11 resultadoIVAA,12 idcatalogoCIE10IVAA,13 nombreCIE10IVAA,14 opcionMamas,15 mesAnioMamas,16 tipoMamas,
                //17 resultadoMamas,18 idcatalogoCIE10Mamas,19 nombreCIE10Mamas,20 opcionProstatico,21 mesAnioProstatico,22 resultadoProstatico, 
                //23 idcatalogoCIE10Prostatico,24 nombreCIE10Prostatico,25 opcionTactoRectal,26 resultadoTactoRectal,27 idcatalogoCIE10Tacto, 
                //28 nombreCIE10Tacto,29 edadInicioRelacion,30 opcionParejaSexual,31 nroParejaSexual,32 edadParejaSexual,33 opcionActividadSexual, 
                //34 opcionMetodoAnticonceptivo,35 tiempoMetodo,36 metodoAnticonceptivo,37 tipo,38 fechaRegistro 
                data = data.split('+')
                i = 3
                $('#tbIdAntecedenteSexual').val(data[0])
                $('#tbMenarquia').val(data[i++])
                $('#tbRegimenCatamenial').val(data[i++])
                $('input:radio[name=rbUltimoPAP][value=' + data[i++] + ']').attr('checked', true);
                $('#tbFechaUltimoPAP').val(data[i++])
                $('input:radio[name=chResultadoPAP][value=' + data[i++] + ']').attr('checked', true);
                $('#cbDetallePAP').val(data[i++])
                $('input:radio[name=rbUltimoIVAA][value=' + data[i++] + ']').attr('checked', true);
                $('#tbFechaUltimoIVAA').val(data[i++])
                $('input:radio[name=chResultadoIVAA][value=' + data[i++] + ']').attr('checked', true);
                $('#tbIdCIE10IVAA').val(data[i++])
                $('#tbCIE10IVAA').val(data[i++])
                $('input:radio[name=rbExamenMamas][value=' + data[i++] + ']').attr('checked', true);
                $('#tbFechaExamenMamas').val(data[i++])
                $('#cbTipoMamas').val(data[i++])
                $('input:radio[name=chResultadoExamen][value=' + data[i++] + ']').attr('checked', true);
                $('#tbIdCIE10Mamas').val(data[i++])
                $('#tbCIE10Mamas').val(data[i++])

                $('input:radio[name=rbExamenProstatico][value=' + data[i++] + ']').attr('checked', true);
                $('#tbFechaExamenProstatico').val(data[i++])
                $('input:radio[name=chResultadoExamenProstatico][value=' + data[i++] + ']').attr('checked', true);
                $('#tbIdCIE10Prostatico').val(data[i++])
                $('#tbCIE10Prostatico').val(data[i++])
                $('input:radio[name=rbTactoRectal][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chTacto][value=' + data[i++] + ']').attr('checked', true);
                $('#tbIdCIE10TactoRectal').val(data[i++])
                $('#tbCIE10TactoRectal').val(data[i++])
                $('#tbEdadRelacion').val(data[i++])
                $('input:radio[name=chEdadRelacion][value=' + data[i++] + ']').attr('checked', true);
                $('#tbNroPareja').val(data[i++])
                $('#tbEdadPareja').val(data[i++])

                $('input:radio[name=chActividadProtecion][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chMetodo][value=' + data[i++] + ']').attr('checked', true);
                $('#tbTiempoUso').val(data[i++])

                $('#listaMetodo').jqGrid('resetSelection')

                li = data[i++].split('-')
                for (j in li) $('#listaMetodo').jqGrid('setSelection', li[j])
            })



            $.post('/sisfac/funcionesphp/adminAntecedenteFisiologico.php', {
                f: 1,
                idpersona: lista.idpersona
            }, function(data) {
                data = data.split('+')
                    //idantecedenteFisiologico, claveGeneral, idpersona, alimentacionMes, alimentacion, higieneDental, revisionDental, fechaVisitaDental, opcionActividadFisica, frecuenciaActividadFisica, nroVecesActividadFisica
                i = 3

                $('#listaAlimentacionp,#listaAlimentacion,#listaHigiene,#listaRevision').jqGrid('resetSelection')

                $('#tbIdAntecedenteFisiologico').val(data[0])
                $('#listaAlimentacionp').jqGrid('setSelection', data[i++])
                $('#listaAlimentacion').jqGrid('setSelection', data[i++])
                $('#listaHigiene').jqGrid('setSelection', data[i++])
                $('#listaRevision').jqGrid('setSelection', data[i++])
                $('#tbFechaUltimaVisita').val(data[i++])
                $('input:radio[name=chActividad][value=' + data[i++] + ']').attr('checked', true);
                $('#cbFrecuenciaActividad').val(data[i++]);
                $('#tbNroVecesActividad').val(data[i++]);
            })

            $.post('/sisfac/funcionesphp/adminAntecedentePsicosocial.php', {
                f: 1,
                idpersona: lista.idpersona
            }, function(data) {
                data = data.split('+')
                    //idantecedentePsicosocial, claveGeneral, idpersona, opcionAlcohol, cantidadAlcohol, frecuenciaAlcohol, nroVecesAlcohol, opcionTabaco, 
                    //nroCigarros, nroCajetillas, frecuenciaTabaco, nroVecesTabaco, opcionDroga, frecuenciaDroga, nroVecesDroga, opcionHojaCoca, 
                    //frecuenciaHojaCoca, nroVecesHojaCoca, opcionPornografia, horasPornografia, opcionPandilla, opcionVideoJuego, horaVideoJuego, 
                    //opcionDelincuencia, opcionViolenciaFisica, opcionViolenciaPsicologica, opcionViolenciaSexual, opcionBullyng, opcionTrabaja, 
                    //edadInicioTrabajo, tipoTrabajo, riesgoOcupacional, opcionAnorexia, opcionSuicidio, opcionDesercion, opcionRepitencia, 
                    //opcionViolenciaNegligencia, opcionViolenciaPolitica
                i = 3
                $('#tbIdAntecedentePsicosocial').val(data[0])
                $('input:radio[name=rbAlchocol][value=' + data[i++] + ']').attr('checked', true);
                $('#tbCantidadAlcohol').val(data[i++])
                $('#cbFrecuenciaAlcohol').val(data[i++])
                $('#tbNroVecesAlcohol').val(data[i++])
                $('input:radio[name=rbTabaco][value=' + data[i++] + ']').attr('checked', true);
                $('#tbCantidadCigarrillos').val(data[i++])
                $('#tbCantidadCajetillas').val(data[i++])
                $('#cbFrecuenciaTabaco').val(data[i++])
                $('#tbNroVecesTabaco').val(data[i++])
                $('input:radio[name=rbDrogas][value=' + data[i++] + ']').attr('checked', true);
                $('#cbFrecuenciaDrogas').val(data[i++])
                $('#tbNroVecesDroga').val(data[i++])
                $('input:radio[name=rbHojaCoca][value=' + data[i++] + ']').attr('checked', true);
                $('#cbFrecuenciaHojaCoca').val(data[i++])
                $('#tbNroVecesHojaCoca').val(data[i++])
                $('input:radio[name=chPornografia][value=' + data[i++] + ']').attr('checked', true);
                $('#tbHorasDiaPornografia').val(data[i++])
                $('input:radio[name=chPandilla][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chVideoJuegos][value=' + data[i++] + ']').attr('checked', true);
                $('#tbHorasDiaVideo').val(data[i++])

                $('input:radio[name=chDelincuencia][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chViolencia][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chViolenciaPsicologica][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chViolenciaSexual][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chBullyng][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chTrabaja][value=' + data[i++] + ']').attr('checked', true);
                $('#tbEdadInicio').val(data[i++])
                $('input:radio[name=chTipoTrabajo][value=' + data[i++] + ']').attr('checked', true);
                $('#cbRiesgoOcupacional').val(data[i++])
                $('input:radio[name=chProblemas][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chSuicidio][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chDesercion][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chRepitencia][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chViolenciaNegligencia][value=' + data[i++] + ']').attr('checked', true);
                $('input:radio[name=chViolenciaPolitica][value=' + data[i++] + ']').attr('checked', true);

            })

            //$('#listaInmunizaciones').jqGrid('setGridParam', {url:'/sisfac/funcionesphp/adminAntecedenteInmunizacion.php?f=1&idpersona=' + lista.idpersona}).trigger('reloadGrid')
            $('#listaMedicamentos').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminAntecedenteMedicamento.php?f=1&idpersona=' + lista.idpersona
            }).trigger('reloadGrid')
            $('#listaAntecedentesFamiliares').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php?f=1&opc=1&idpersona=' + lista.idpersona
            }).trigger('reloadGrid')
            $('#listaAntecedentesAlergias').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php?f=1&opc=0&idpersona=' + lista.idpersona
            }).trigger('reloadGrid')


            $('#cbNombreEpisodio').load('/sisfac/funcionesphp/adminCatalogoEpisodio.php', {
                f: 4,
                nombreEtapa: lista.etapa,
                dias: lista.dias
            }, function(data) {})

            $.post('/sisfac/funcionesphp/adminPAIS.php', {
                f: 2,
                idpersona: lista.idpersona,
                nombreEtapa: lista.etapa
            }, function(valor) {
                //idPAIS, claveGeneral, idpersona, idetapaVida, estadoPlan, anio
                valor = valor.split('+')
                $('#tbIdPAIS').val(valor[0])
                $('#cbEstadoPAIS').val(valor[4])
                $('#tbAnioPAIS').val(valor[5])

                $.post('/sisfac/funcionesphp/adminCatalogoPrestacionPerfil.php', {
                    f: 5,
                    nombreEtapa: lista.etapa,
                    dias: lista.dias,
                    idPAIS: valor[0],
                    idpersona: lista.idpersona
                }, function(data) {
                    $('#divPAIS').html(data)
                    $('#divPais div table input[name=tbFechaProgramana]').mask('99/99/9999')
                        //ejecutarFuncion()
                })
            })
        }

        $('#listaEpisodio').jqGrid({
            url: '/sisfac/funcionesphp/adminEpisodio.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
            datatype: "xml",
            colNames: ['idepisodio', 'claveGeneral', 'idpersona', 'Case atencion', 'tipo', 'idcatalogoUPS', 'UPS', 'situacion', 'Fecha inicio', 'fechaFin', 'hora', 'Nombre episodio', 'Nombre episodio', 'Diagn&oacute;stico CIE 10 - Observaci&oacute;n', 'Estado', 'medioAcceso', 'procedencia', 'acompanante', 'parentesco', 'motivoConsulta', 'sintomas', 'sindromeCultura', 'tiempoEnfermedad', 'detalleTiempo', 'semanaEpidemiologica', 'opcionSemanaGestacional', 'semanaGestacional', 'sueno', 'sed', 'animo', 'apetito', 'orina', 'deposiciones', 'frecuenciaDeposiciones', 'horaDiaDeposiciones', 'perdidaPeso', 'detallePesoKilos', 'opcionPesoTiempo', 'detallePesoTiempo', 'tos', 'limiteInicial', 'limiteFinal'],
            colModel: [{
                name: 'idepisodio',
                index: 'idepisodio',
                width: 200,
                hidden: true
            }, {
                name: 'claveGeneral',
                index: 'claveGeneral',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'idpersona',
                index: 'idpersona',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'claseAtencion',
                index: 'claseAtencion',
                width: 100,
                hidden: true
            }, {
                name: 'tipo',
                index: 'tipo',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'idcatalogoUPS',
                index: 'idcatalogoUPS',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'nombreCatalogo',
                index: 'nombreCatalogo',
                width: 200,
                hidden: true
            }, {
                name: 'situacion',
                index: 'situacion',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'fechaInicio',
                index: 'fechaInicio',
                width: 100,
                editable: true,
                formatter: 'date',
                formatoptions: {
                    srcformat: 'Y-m-d',
                    newformat: 'd/m/Y'
                }
            }, {
                name: 'fechaFin',
                index: 'fechaFin',
                width: 100,
                editable: true,
                hidden: true,
                formatter: 'date',
                formatoptions: {
                    srcformat: 'Y-m-d',
                    newformat: 'd/m/Y'
                }
            }, {
                name: 'hora',
                index: 'hora',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'idcatalogoEpisodio',
                index: 'idcatalogoEpisodio',
                width: 100,
                hidden: true
            }, {
                name: 'nombreEpisodio',
                index: 'nombreEpisodio',
                width: 100,
                editable: true
            }, {
                name: 'dia.nombreCatalogo',
                index: 'dia.nombreCatalogo',
                width: 500,
                editable: true
            }, {
                name: 'estadoEpisodio',
                index: 'estadoEpisodio',
                width: 100,
                editable: true
            }, {
                name: 'medioAcceso',
                index: 'medioAcceso',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'procedencia',
                index: 'procedencia',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'acompanante',
                index: 'acompanante',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'parentesco',
                index: 'parentesco',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'motivoConsulta',
                index: 'motivoConsulta',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'sintomas',
                index: 'sintomas',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'sindromeCultura',
                index: 'sindromeCultura',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'tiempoEnfermedad',
                index: 'tiempoEnfermedad',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'detalleTiempo',
                index: 'detalleTiempo',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'semanaEpidemiologica',
                index: 'semanaEpidemiologica',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'opcionSemanaGestacional',
                index: 'opcionSemanaGestacional',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'semanaGestacional',
                index: 'semanaGestacional',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'sueno',
                index: 'sueno',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'sed',
                index: 'sed',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'animo',
                index: 'animo',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'apetito',
                index: 'apetito',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'orina',
                index: 'orina',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'deposiciones',
                index: 'deposiciones',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'frecuenciaDeposiciones',
                index: 'frecuenciaDeposiciones',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'horaDiaDeposiciones',
                index: 'horaDiaDeposiciones',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'perdidaPeso',
                index: 'perdidaPeso',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'detallePesoKilos',
                index: 'detallePesoKilos',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'opcionPesoTiempo',
                index: 'opcionPesoTiempo',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'detallePesoTiempo',
                index: 'detallePesoTiempo',
                width: 100,
                hidden: true,
                editable: true
            }, {
                name: 'tos',
                index: 'tos',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'limiteInicial',
                index: 'limiteInicial',
                width: 100,
                editable: true,
                hidden: true
            }, {
                name: 'limiteFinal',
                index: 'limiteFinal',
                width: 100,
                editable: true,
                hidden: true
            }, ],
            height: 100,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'epi.idepisodio',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Listado de personas",
            editurl: '/sisfac/funcionesphp/adminEpisodio.php',
            pager: '#pager',
            onSelectRow: function(rowid, status) {
                lista = $('#listaEpisodio').jqGrid('getRowData', rowid)
                $('#listaDiagnostico').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminDiagnostico.php?f=1&idepisodio=' + rowid
                }).trigger('reloadGrid')
                llenarEpisodio(lista)
                llenarPrestacion(lista)
                llenaMedida(lista)
                llenaHIS(lista)
                llenaDiagnostico(lista)
                llenaReferencia(lista)
            },
            loadComplete: function(data) {

            }
        });

        function llenarEpisodio(lista) {
            $('#cbMedioAcceso').val(lista.medioAcceso)
            $('#cbClaseAtencion').val(lista.claseAtencion)
            $('#cbProcedencia').val(lista.procedencia)
            $('#cbTipoEpisodio').val(lista.tipo)
            $('#tbIdConsultaUPS').val(lista.idcatalogoUPS)
            $('#tbConsultaUPS').val(lista.nombreCatalogo)
            $('#cbSituacionConsulta').val(lista.situacion)
            $('#tbAcompanante').val(lista.acompanante)
            $('#tbFechaInicioEpisodio').val(lista.fechaInicio)
            $('#cbParentescoAcompanante').val(lista.parentesco)
            tem = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
            $('#cbNombreEpisodio').load('/sisfac/funcionesphp/adminCatalogoEpisodio.php', {
                f: 4,
                nombreEtapa: tem.etapa,
                dias: tem.dias
            }, function(data) {
                $('#cbNombreEpisodio').val(lista.idcatalogoEpisodio)
            })
            $('#cbEstadoEpisodio').val(lista.estadoEpisodio)
            $('#tbFechaFinEpisodio').val(lista.fechaFin)
            $('#taMotivoConsulta').val(lista.motivoConsulta)
            $('#taSintomas').val(lista.sintomas)
            $('#taRegistroSindrome').val(lista.sindromeCultura)
            $('#tbTiempoEnfermedad').val(lista.tiempoEnfermedad)
            $('#cbTiempoEnfermedad').val(lista.detalleTiempo)
            $('#tbSemanaEpidemiologica').val(lista.semanaEpidemiologica)
            $('input:radio[name=rbSemanaGestacional][value=' + lista.opcionSemanaGestacional + ']').attr('checked', true)
            $('#tbSemanaGestacional').val(lista.semanaGestacional)
            $('#cbSuenoEpisodio').val(lista.sueno)
            $('#cbSedEpisodio').val(lista.sed)
            $('#cbApetitoEpisodio').val(lista.apetito)
            $('#cbEstadoAnimoEpisodio').val(lista.animo)
            $('#cbOrinaEpisodio').val(lista.orina)
            $('#cbDeposicionEpisodio').val(lista.deposiciones)
            $('#tbDeposicionHoraDia').val(lista.frecuenciaDeposiciones)
            $('#lbHoraDiaDeposicion').text(lista.horaDiaDeposiciones)
            $('input:radio[name=rbPerdidaPeso][value=' + lista.perdidaPeso + ']').attr('checked', true)
            $('#tbPesoEpisodio').val(lista.detallePesoKilos)
            $('#tbTiempoEpisodio').val(lista.detallePesoTiempo)
            $('#cbTiempoEpisodio').val(lista.opcionPesoTiempo)
            $('input:radio[name=rbTosEpisodio][value=' + lista.tos + ']').attr('checked', true)


            if ($('#cbTipoEpisodio').val() == 'PREVENTIVO') {
                $('#taMotivoConsulta,#taSintomas,#taRegistroSindrome,#tbTiempoEnfermedad,#cbTiempoEnfermedad').attr('disabled', 'disabled')
            } else {
                $('#taMotivoConsulta,#taSintomas,#taRegistroSindrome,#tbTiempoEnfermedad,#cbTiempoEnfermedad').removeAttr('disabled')
            }

            if ($('#cbEstadoEpisodio').val() == '') {
                hoy = new Date();
                dia = hoy.getDate()
                mes = hoy.getMonth() + 1
                anio = hoy.getFullYear()

                $('#tbFechaInicioEpisodio').val((dia < 10 ? '0' + dia : dia) + '/' + mes + '/' + anio)
            }
        }

        function llenarPrestacion(lista) {
            temp = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
            $('#listaPrestacion').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminCatalogoEpisodioPrestacion.php?f=1&idcatalogoEpisodio=' + lista.idcatalogoEpisodio + '&nombreEtapa=' + temp.etapa + '&opActivo=SI'
            }).trigger('reloadGrid')
        }

        $('#lbFechaRegistro,#lbNHC,#lbCodigoFicha,#lbDNI,#lbNombreFinanciador,#lbDesendenciaEtnica,#lbEdad,#lbSexo').attr('style', 'color: #0074C7; font-weight: bolder;')

        function llenaHIS(lista) {

            $('#lbFechaRegistro').text(lista.fechaInicio)
            tem = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
            $('#lbNHC').text(tem.numeroHC)
            $('#lbCodigoFicha').text(tem.codigoFamilia)
            $('#lbDNI').text(tem.dni)
            $('#lbNombreFinanciador').text(tem.seguroMedico)
            $('#lbDesendenciaEtnica').text(tem.desendenciaEtnica)
            $('#lbEdad').text(tem.edad)
            $('#lbSexo').text(tem.sexo)

            $('#listaHIS').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminHIS.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')
        }

        function llenaMedida(lista) {
            $('#listaVariableAntropometrica').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminVariableAntropometrica.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
            }).trigger('reloadGrid')
        }

        function llenaDiagnostico() {
            $('#listaTratamientoMedicamentos').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminTratamientoResolutivo.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')

            $.post('/sisfac/funcionesphp/adminPlantaMedicinal.php', {
                f: 1,
                idepisodio: lista.idepisodio
            }, function(data) {
                data = data.split('+')
                $('#taIdPlanta').val(data[0])
                $('#taPlanta').val(data[1])
            })
            $('#listaTratamientoProcedimientos').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminProcedimiento.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')
            $('#listaTratamientoPreventivo').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminTratamientoPreventivo.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')
            $('#listaTratamientoInsumos').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminInsumos.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')
        }

        function llenaReferencia(lista) {
            $('#listaInterconsulta').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminInterconsulta.php?f=1&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')
            $('#listaReferencia').jqGrid('setGridParam', {
                url: '/sisfac/funcionesphp/adminDiagnostico.php?f=1&opReferencia=SI&idepisodio=' + lista.idepisodio
            }).trigger('reloadGrid')

            $.post('/sisfac/funcionesphp/adminReferencia.php', {
                f: 2,
                idepisodio: lista.idepisodio
            }, function(data) {
                //idreferencia, claveGeneral, idepisodio, idcatalogoReferencia, nombreReferencia, idcatalogoUPS, nombreCatalogo, fechaIngreso, idtrabajadorReferencia, 
                //idtrabajadorResponsable, idtrabajadorCompania, condicionRecepcion, fechaRecepcion, responsableRecepcion, colegiaturaRecepcion, idprofesionRecepcion, 
                //condicionPaciente, estadoReferencia, fechaReingreso, iddiagnostico1, diagnostico1, iddiagnostico2, diagnostico2, iddiagnostico3, diagnostico3
                data = data.split('+')
                i = 3
                $('#tbIdReferencia').val(data[0])
                $('#tbIdReferenciaEstablecimiento').val(data[i++])
                $('#tbReferenciaEstablecimiento').val(data[i++])
                $('#tbIdEstablecimientoUPS').val(data[i++])
                $('#tbEstablecimientoUPS').val(data[i++])
                $('#tbFechaReferencia').val(data[i++])
                $('#cbResponsableReferencia').val(data[i++])
                $('#cbResponsableEstablecimiento').val(data[i++])
                $('#cbPersonalAcompanante').val(data[i++])
                $('#cbCondicionPaciente').val(data[i++])
                $('#tbFechaRecepcion').val(data[i++])
                $('#tbPersonalRecepcion').val(data[i++])
                $('#tbColegiaturaRecepcion').val(data[i++])
                $('#cbProfesionRecepcion').val(data[i++])
                $('#cbCondicionPacienteRecepcion').val(data[i++])
                $('#cbEstadoReferencia').val(data[i++])
                $('#tbFechaReingreso').val(data[i++])
                $('#tbIdDiagnosticoReingreso1').val(data[i++])
                $('#tbDiagnosticoReingreso1').val(data[i++])
                $('#tbIdDiagnosticoReingreso2').val(data[i++])
                $('#tbDiagnosticoReingreso2').val(data[i++])
                $('#tbIdDiagnosticoReingreso3').val(data[i++])
                $('#tbDiagnosticoReingreso3').val(data[i++])
            })
        }

        function llenaNacimiento(lista) {
            lista = lista.split('+')
                //idantecedenteNacimiento,claveGeneral,iddetalleGinecobstetrico,peso,tallaNacer,perimetroCefalico,perimetroToracico,perimetroAbdominal,
                //apgar,edadGestacional,testCapurro,complicacion,malformacion,idcatalogoCIE10,nombreCatalogo 
            i = 3
            $('#hIdAntecedenteNacimiento').val(lista[1]),
                $('#tbPeso').val(lista[i++]),
                $('#tbTalla').val(lista[i++]),
                $('#tbPerimetroCefalico').val(lista[i++]),
                $('#tbPerimetroToracico').val(lista[i++]),
                $('#tbPerimetroAbdominal').val(lista[i++]),
                $('#cbApgar').val(lista[i++]),
                $('#tbEdadGestacional').val(lista[i++]),
                $('#tbTest').val(lista[i++]),
                $('#tbComplicaciones').val(lista[i++]),
                $('#cbMalformaciones').val(lista[i++]),
                $('#hIdCIE10Nacimiento').val(lista[i++]),
                $('#tbCIE10Nacimiento').val(lista[i++])
        }

        $('#btnNuevaConsulta').button({
            icons: {
                primary: "ui-icon-plus"
            }
        }).click(function() {
            if (!$('#listaBusqueda').jqGrid('getGridParam', 'selrow')) {
                alert('Debe seleccionar un registro de una persona')
            }
            alert('Por favor ingrese los datos en episodio')
            $('#tabsClinica').tabs({
                    selected: 1
                })
                //segundoTabClinica()
            $('#listaEpisodio').jqGrid('resetSelection')
            llenarEpisodio('')

            hoy = new Date();
            dia = hoy.getDate()
            mes = hoy.getMonth() + 1
            anio = hoy.getFullYear()

            $('#tbFechaInicioEpisodio').val((dia < 10 ? '0' + dia : dia) + '/' + mes + '/' + anio)

        }).width(100).height(50)
        $('#btnContinuarConsulta').button({
            icons: {
                primary: "ui-icon-pencil"
            }
        }).click(function() {}).width(100).height(30)

        function hacerAutocompletar(label, valor, s) {
            $('#' + label).autocomplete({
                source: "/sisfac/funcionesphp/" + s + "&limit=11",
                minLength: 1,
                focus: function(event, ui) {
                    $('#' + label).val(ui.item.label)
                    $('#' + valor).val(ui.item.value)
                    return false
                },
                select: function(event, ui) {
                    $('#' + label).val(ui.item.label)
                    $('#' + valor).val(ui.item.value)
                    return false
                }
            })
        }

        function primerTabClinica() {
            $('#btnGuardarGinecobstetrico').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {

                if (!$('#listaBusqueda').jqGrid('getGridParam', 'selrow')) {
                    alert('Debe seleccionar una persona')
                    return
                }


                if ($('#tbGestaciones').val() == '' || $('#tbParidad').val() == '' || $('#tbIntergenesico').val() == '') {
                    alert('Los campos no pueden estar vacios')
                    return
                }

                $.post('/sisfac/funcionesphp/adminAntecedenteGinecobstetrico.php', {
                    oper: 'add',
                    idantecedenteGinecobstetrico: $('#tbIdGinecobstetrico').val(),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    nroGestacion: $('#tbGestaciones').val(),
                    paridad: $('#tbParidad').val(),
                    periodoIntergenesico: $('#tbIntergenesico').val()
                }, function(data) {
                    $('#tbIdGinecobstetrico').val(data)
                    alert('Los datos de gestaciones, paridad y periodo intergenesico se guardaron correctamente. Por favor agregue su detalle.')
                    $('#listaGinecobstetricos').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php?f=1&idantecedenteGinecobstetrico=' + $('#tbIdGinecobstetrico').val()
                    }).trigger('reloadGrid')
                })
            }).width(100).height(30)


            $('#listaGinecobstetricos').jqGrid({
                url: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php?f=1&idantecedenteGinecobstetrico=' + $('#tbIdGinecobstetrico').val(),
                datatype: "xml",
                colNames: ['id', 'Fecha culminaci&oacute;n parto', 'N. APN', 'Complicaci&oacute;n', 'Fuente', 'Tomo suplemento de Hierro', 'Aborto', 'Lugar de parto', 'Tipo de parto', 'Horizontal/Vertical', 'CIE 10', 'CIE 10', 'Peso RN(en gramos)', 'Responsable de atenci&oacute;n del parto', 'Responsable de atenci&oacute;n del parto'],
                colModel: [{
                    name: 'iddetalleGinecobstetrico',
                    index: 'iddetalleGinecobstetrico',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'fechaCulminacion',
                    index: 'fechaCulminacion',
                    width: 60,
                    editable: true,
                    editrules: {
                        date: true
                    },
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'nroAtencionPrenatal',
                    index: 'nroAtencionPrenatal',
                    width: 80,
                    editable: true
                }, {
                    name: 'complicacion',
                    index: 'complicacion',
                    width: 80,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'SI:SI;NO:NO',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'fuente',
                    index: 'fuente',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: '(R) PACIENTE REFERIDO:(R) PACIENTE REFERIDO;(D) PACIENTE DIAGNOSTICADO:(D) PACIENTE DIAGNOSTICADO',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'opcionSuplemento',
                    index: 'opcionSuplemento',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'SI:SI;NO:NO',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'aborto',
                    index: 'aborto',
                    width: 50,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'NO:NO;SI:SI',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($('#aborto').val() == 'SI') {
                                    $('#tr_lugarParto,#tr_tipoParto,#tr_nombreTipoParto,#tr_pesoRN,#tr_idprofesion,#tr_opHorVer').hide()
                                } else {
                                    $('#tr_lugarParto,#tr_tipoParto,#tr_pesoRN,#tr_idprofesion').show()
                                    if ($('#tipoParto').val() == 'DISTOCICO') {
                                        $('#tr_opHorVer').hide()
                                        $('#tr_nombreTipoParto').show()
                                    } else {
                                        $('#tr_opHorVer').show()
                                        $('#tr_nombreTipoParto').hide()
                                    }
                                }
                            }).width(150)
                        }
                    }
                }, {
                    name: 'lugarParto',
                    index: 'lugarParto',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: ':Seleccione una opcion;INSTITUCIONAL:INSTITUCIONAL;DOMICILIARIO:DOMICILIARIO',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'tipoParto',
                    index: 'tipoParto',
                    width: 70,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: ':Seleccione una opcion;EUTOCICO:EUTOCICO;DISTOCICO:DISTOCICO',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($(el).val() == 'EUTOCICO' || $(el).val() == '') {
                                    $('#tr_nombreTipoParto').hide()
                                    $('#tr_opHorVer').show()
                                } else {
                                    $('#tr_nombreTipoParto').show()
                                    $('#tr_opHorVer').hide()
                                }
                            }).width(150)
                        }
                    }
                }, {
                    name: 'opHorVer',
                    index: 'opHorVer',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: ':Seleccione una opcion;HORIZONTAL:HORIZONTAL;VERTICAL:VERTICAL'
                    }
                }, {
                    name: 'idcatalogoCIE10',
                    index: 'idcatalogoCIE10',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreTipoParto',
                    index: 'nombreTipoParto',
                    width: 100,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'pesoRN',
                    index: 'pesoRN',
                    width: 70,
                    hidden: true
                }, {
                    name: 'idprofesion',
                    index: 'idprofesion',
                    width: 100,
                    hidden: true,
                    editable: true,
                    edittype: 'select',
                    editrules: {
                        edithidden: true
                    },
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminProfesion.php?f=2',
                        dataInit: function(el) {
                            $(el).width(200)
                            $(el).prepend("<option value=''>Seleccione una opcion</option>")
                        }
                    }
                }, {
                    name: 'profesion',
                    index: 'profesion',
                    width: 70
                }, ],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'iddetalleGinecobstetrico',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php',
                pager: '#pagerGinecobstetricos',
                onSelectRow: function(rowid, status) {
                    $.post('/sisfac/funcionesphp/adminAntecedenteNacimiento.php', {
                            f: 2,
                            iddetalleGinecobstetrico: rowid
                        }, function(data) {
                            llenaNacimiento(data)
                        })
                        //llenaNacimiento($('#listaGinecobstetricos').jqGrid('getRowData',rowid))

                    //$('#listaNacimiento').jqGrid('setGridParam', {url:'/sisfac/funcionesphp/adminAntecedenteNacimiento.php?f=1&iddetalleGinecobstetrico=' + rowid}).trigger('reloadGrid')
                }
            });

            $("#listaGinecobstetricos").jqGrid('navGrid', "#pagerGinecobstetricos", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 700,
                modal: true,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                afterShowForm: function(formid) {
                    if ($('#aborto').val() == 'SI') {
                        $('#tr_lugarParto,#tr_tipoParto,#tr_opHorVer,#tr_nombreTipoParto,#tr_pesoRN,#tr_idprofesion').hide()
                        $('#tr_nombreTipoParto').hide()
                    } else {
                        $('#tr_lugarParto,#tr_tipoParto,#tr_opHorVer,#tr_nombreTipoParto,#tr_pesoRN,#tr_idprofesion').show()
                        if ($('#tipoParto').val() == 'EUTOCICO' || $('#tipoParto').val() == '') {
                            $('#tr_nombreTipoParto').hide()
                            $('#tr_opHorVer').show()
                        } else {
                            $('#tr_nombreTipoParto').show()
                            $('#tr_hide').show()
                        }
                    }

                }
            }, {
                width: 700,
                modal: true,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#tbIdGinecobstetrico').val()
                    return {
                        idantecedenteGinecobstetrico: id,
                        idpersonaref: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    }
                },
                afterShowForm: function(formid) {
                    $('#idcatalogoCIE10').val('')
                    $('#tr_lugarParto,#tr_tipoParto,#tr_pesoRN,#tr_idprofesion,#tr_opHorVer').show()
                    $('#tr_nombreTipoParto').hide()
                    if (!$('#listaBusqueda').jqGrid('getGridParam', 'selrow')) {
                        alert('Debe seleccionar un registro de persona')
                    }
                },
                beforeSubmit: function(postdata, formid) {
                    id = $('#tbIdGinecobstetrico').val()
                    return [id != '', 'Debe guardar primero el antecedente ginecobstetrico'];
                }
            });
            //$("#listaGinecobstetricos").jqGrid('inlineNav',"#pagerGinecobstetricos");




            $('#listaNacimiento').jqGrid({
                url: '/sisfac/funcionesphp/adminAntecedenteNacimiento.php?f=1&iddetalleGinecobstetrico=' + $('#listaGinecobstetricos').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['id', 'Peso', 'Talla al nacer(cm.)', 'Per&iacute;metro cef&aacute;lico(gr.)', 'Per&iacute;metro toracico(cm.)', 'Per&iacute;metro abdominal(cm.)', 'Apgar', 'Edad gestacional(sem.)', 'Test capurro', 'Complicaciones', 'Malformaciones cong&eacute;nitas', 'CIE10', 'CIE10'],
                colModel: [{
                    name: 'idantecedenteNacimiento',
                    index: 'idantecedenteNacimiento',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'peso',
                    index: 'peso',
                    width: 60,
                    editable: true,
                    editrules: {
                        required: true,
                        numeric: true
                    }
                }, {
                    name: 'tallaNacer',
                    index: 'tallaNacer',
                    width: 70,
                    editable: true,
                    editrules: {
                        required: true,
                        numeric: true
                    }
                }, {
                    name: 'perimetroCefalico',
                    index: 'perimetroCefalico',
                    width: 80,
                    editable: true,
                    editrules: {
                        required: true,
                        numeric: true
                    }
                }, {
                    name: 'perimetroToracico',
                    index: 'perimetroToracico',
                    width: 80,
                    editable: true,
                    editrules: {
                        required: true,
                        numeric: true
                    }
                }, {
                    name: 'perimetroAbdominal',
                    index: 'perimetroAbdominal',
                    width: 80,
                    editable: true,
                    editrules: {
                        required: true,
                        numeric: true
                    }
                }, {
                    name: 'apgar',
                    index: 'apgar',
                    width: 50,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: '1 MIN:1 MIN;5 MIN:5 MIN',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'edadGestacional',
                    index: 'edadGestacional',
                    width: 80,
                    editable: true
                }, {
                    name: 'testCapurro',
                    index: 'testCapurro',
                    width: 80,
                    editable: true
                }, {
                    name: 'complicacion',
                    index: 'complicacion',
                    width: 80,
                    editable: true
                }, {
                    name: 'malformacion',
                    index: 'malformacion',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'SI:SI;NO:NO',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($(el).val() == 'SI') $('#tr_nombreCatalogo').show()
                                else $('#tr_nombreCatalogo').hide()
                            }).width(150)
                        }
                    }
                }, {
                    name: 'idcatalogoCIE10',
                    index: 'idcatalogoCIE10',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 100,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idantecedenteNacimiento',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Nacimiento",
                editurl: '/sisfac/funcionesphp/adminAntecedenteNacimiento.php',
                pager: '#pagerNacimiento'
            });

            $("#listaNacimiento").jqGrid('navGrid', "#pagerNacimiento", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 700,
                modal: true,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                afterShowForm: function(formid) {
                    if ($('#malformacion').val() == 'SI') $('#tr_nombreCatalogo').show()
                    else $('#tr_nombreCatalogo').hide()
                }
            }, {
                width: 700,
                modal: true,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaGinecobstetricos').jqGrid('getGridParam', 'selrow')
                    return {
                        iddetalleGinecobstetrico: id
                    }
                },
                afterShowForm: function(formid) {
                    $('#idcatalogoCIE10').val('')
                    if (!$('#listaBusqueda').jqGrid('getGridParam', 'selrow')) {
                        alert('Debe seleccionar un registro de persona')
                    }
                    if ($('#malformacion').val() == 'SI') $('#tr_nombreCatalogo').show()
                    else $('#tr_nombreCatalogo').hide()
                },
                beforeSubmit: function(postdata, formid) {
                    if ($('#malformacion').val() == 'SI') {
                        id = $('#idcatalogoCIE10').val()
                        return [id != '', 'Debe seleccionar un catalogo CIE10'];
                    } else {
                        return [true]
                    }
                }
            });

            hacerAutocompletar('tbCIE10Nacimiento', 'hIdCIE10Nacimiento', 'adminCatalogoCIE10.php?f=1')
            $('#tbCIE10Nacimiento').width(350)

            $('#cbMalformaciones').change(function() {
                if ($('#cbMalformaciones').val() == 'SI') $('#tbCIE10Nacimiento').show()
                else $('#tbCIE10Nacimiento').hide()
            })


            $('#btnGuardarNacimiento').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminAntecedenteNacimiento.php', {
                    oper: ($('#hIdAntecedenteNacimiento').val() == '' ? 'add' : 'edit'),
                    idantecedenteNacimiento: $('#hIdAntecedenteNacimiento').val(),
                    iddetalleGinecobstetrico: $('#listaGinecobstetricos').jqGrid('getGridParam', 'selrow'),
                    peso: $('#tbPeso').val(),
                    tallaNacer: $('#tbTalla').val(),
                    perimetroCefalico: $('#tbPerimetroCefalico').val(),
                    perimetroToracico: $('#tbPerimetroToracico').val(),
                    perimetroAbdominal: $('#tbPerimetroAbdominal').val(),
                    apgar: $('#cbApgar').val(),
                    edadGestacional: $('#tbEdadGestacional').val(),
                    testCapurro: $('#tbTest').val(),
                    complicacion: $('#tbComplicaciones').val(),
                    malformacion: $('#cbMalformaciones').val(),
                    idcatalogoCIE10: $('#hIdCIE10Nacimiento').val(),
                    nombreCatalogo: $('#tbCIE10Nacimiento').val(),
                    idantecedenteGinecobstetrico: $('#tbIdGinecobstetrico').val(),
                    idpersonaref: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')


                }, function(data) {
                    alert('Se guardaron correctamente los datos')
                    $('#hIdAntecedenteNacimiento').val(data)
                    $('#listaGinecobstetricos').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDetalleGinecobstetrico.php?f=1&idantecedenteGinecobstetrico=' + $('#tbIdGinecobstetrico').val() + '&idpersonaref=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    }).trigger('reloadGrid')
                })
            })





            $("#listaMetodo").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'M&eacute;todo anticonceptivo actual'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'anticonceptivo',
                    index: 'anticonceptivo',
                    width: 250
                }, ],
                multiselect: true
                    //hiddengrid: true,
                    //caption: "M&eacute;todo anticonceptivo actual"
            });

            var mydata = [{
                id: '1',
                anticonceptivo: "Coitos interrumpidos"
            }, {
                id: '2',
                anticonceptivo: "Metodo de lactancia materna"
            }, {
                id: '3',
                anticonceptivo: "Implantes"
            }, {
                id: '4',
                anticonceptivo: "Exclusa(MELA)"
            }, {
                id: '5',
                anticonceptivo: "Metodo de ritmo"
            }, {
                id: '6',
                anticonceptivo: "Inyectable mensual"
            }, {
                id: '7',
                anticonceptivo: "T de cobre/DIU"
            }, {
                id: '8',
                anticonceptivo: "Esterilizacion"
            }, {
                id: '9',
                anticonceptivo: "Preservativo"
            }, {
                id: '10',
                anticonceptivo: "Inyectable trimestral"
            }, {
                id: '11',
                anticonceptivo: "Pildoras"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaMetodo").jqGrid('addRowData', i + 1, mydata[i]);

            hacerAutocompletar('tbCIE10IVAA', 'tbIdCIE10IVAA', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbCIE10Mamas', 'tbIdCIE10Mamas', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbCIE10Prostatico', 'tbIdCIE10Prostatico', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbCIE10TactoRectal', 'tbIdCIE10TactoRectal', 'adminCatalogoCIE10.php?f=1')





            $('#btnGuardarAntecedenteSexual').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {

                if ($('input:radio[name="rbUltimoPAP"]:checked').val() == 'SI' && $('#tbFechaUltimoPAP').val() == '') {
                    alert('La fecha del ultimo PAP no puede estar vacia')
                    return
                }
                if ($('input:radio[name="rbUltimoIVAA"]:checked').val() == 'SI' && $('#tbFechaUltimoIVAA').val() == '') {
                    alert('La fecha del ultimo IVAA no puede estar vacia')
                    return
                }
                if ($('input:radio[name="rbExamenMamas"]:checked').val() == 'SI' && $('#tbFechaExamenMamas').val() == '') {
                    alert('La fecha del ultimo examen mamas no puede estar vacia')
                    return
                }

                if ($('input:radio[name="chResultadoPAP"]:checked').val() == 'PATOLOGICO' && $('#cbDetallePAP').val() == '') {
                    alert('Debe seleccionar un tipo de PAP')
                    return
                }
                if ($('input:radio[name="chResultadoIVAA"]:checked').val() == 'PATOLOGICO' && $('#tbIdCIE10IVAA').val() == '') {
                    alert('Debe seleccionar CIE10 de IVAA')
                    return
                }
                if ($('input:radio[name="chResultadoExamen"]:checked').val() == 'PATOLOGICO' && $('#tbIdCIE10Mamas').val() == '') {
                    alert('Debe seleccionar CIE10 de Examen de mamas')
                    return
                }

                if ($('input:radio[name="rbExamenProstatico"]:checked').val() == 'SI' && $('#tbFechaExamenProstatico').val() == '') {
                    alert('Debe ingresar fecha ultimo examen prostatico')
                    return
                }
                if ($('input:radio[name="chResultadoExamenProstatico"]:checked').val() == 'PATOLOGICO' && $('#tbIdCIE10Prostatico').val() == '') {
                    alert('Debe seleccionar CIE10 de examen prostatico')
                    return
                }
                if ($('input:radio[name="chTacto"]:checked').val() == 'PATOLOGICO' && $('#tbCIE10TactoRectal').val() == '') {
                    alert('Debe seleccionar CIE10 de tacto rectal')
                    return
                }

                if ($('input:radio[name="chEdadRelacion"]:checked').val() == 'SI' && $('#tbEdadPareja').val() == '') {
                    alert('Debe ingresar la edad de la pareja')
                    return
                }

                if ($('input:radio[name="chMetodo"]:checked').val() == 'SI' && $('#tbTiempoUso').val() == '') {
                    alert('Debe ingresar el tiempo de uso')
                    return
                }




                $.post('/sisfac/funcionesphp/adminAntecedenteSexual.php', {
                    oper: 'add',
                    idantecedenteSexual: $('#tbIdAntecedenteSexual').val(),
                    //claveGeneral:$('#').val(), 
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    menarquia: $('#tbMenarquia').val(),
                    regimenCatamenial: $('#tbRegimenCatamenial').val(),
                    opcionPAP: $('input:radio[name="rbUltimoPAP"]:checked').val(),
                    mesAnioPAP: $('#tbFechaUltimoPAP').val(),
                    resultadoPAP: $('input:radio[name="chResultadoPAP"]:checked').val(),
                    detallePAP: $('#cbDetallePAP').val(),
                    opcionIVAA: $('input:radio[name="rbUltimoIVAA"]:checked').val(),
                    mesAnioIVAA: $('#tbFechaUltimoIVAA').val(),
                    resultadoIVAA: $('input:radio[name="chResultadoIVAA"]:checked').val(),
                    idcatalogoCIE10IVAA: $('#tbIdCIE10IVAA').val(),
                    nombreCIE10IVAA: $('#tbCIE10IVAA').val(),
                    opcionMamas: $('input:radio[name="rbExamenMamas"]:checked').val(),
                    mesAnioMamas: $('#tbFechaExamenMamas').val(),
                    tipoMamas: $('#cbTipoMamas').val(),
                    resultadoMamas: $('input:radio[name="chResultadoExamen"]:checked').val(),
                    idcatalogoCIE10Mamas: $('#tbIdCIE10Mamas').val(),
                    nombreCIE10Mamas: $('#tbCIE10Mamas').val(),
                    opcionProstatico: $('input:radio[name="rbExamenProstatico"]:checked').val(),
                    mesAnioProstatico: $('#tbFechaExamenProstatico').val(),
                    resultadoProstatico: $('input:radio[name="chResultadoExamenProstatico"]:checked').val(),
                    idcatalogoCIE10Prostatico: $('#tbIdCIE10Prostatico').val(),
                    nombreCIE10Prostatico: $('#tbCIE10Prostatico').val(),
                    opcionTactoRectal: $('input:radio[name="rbTactoRectal"]:checked').val(),
                    resultadoTactoRectal: $('input:radio[name="chTacto"]:checked').val(),
                    idcatalogoCIE10Tacto: $('#tbIdCIE10TactoRectal').val(),
                    nombreCIE10Tacto: $('#tbCIE10TactoRectal').val(),
                    edadInicioRelacion: $('#tbEdadRelacion').val(),
                    opcionParejaSexual: $('input:radio[name="chEdadRelacion"]:checked').val(),
                    nroParejaSexual: $('#tbNroPareja').val(),
                    edadParejaSexual: $('#tbEdadPareja').val(),
                    opcionActividadSexual: $('input:radio[name="chActividadProtecion"]:checked').val(),
                    opcionMetodoAnticonceptivo: $('input:radio[name="chMetodo"]:checked').val(),
                    tiempoMetodo: $('#tbTiempoUso').val(),
                    metodoAnticonceptivo: ($('#listaMetodo').jqGrid('getGridParam', 'selarrrow')).join('-'),
                    tipo: 'ANTECEDENTE'
                }, function(data) {
                    $('#tbIdAntecedenteSexual').val(data)
                    alert('Los datos se guardaron correctamente')
                })
            }).width(250).height(50)

            $('#tbFechaUltimoPAP,#tbFechaUltimoIVAA,#tbFechaExamenMamas,#tbFechaExamenProstatico').mask('99/9999')
            $('#tbTiempoUso').mask('99/99')

            $("#listaAlimentacionp").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Alimentaci&oacute;n primero 6 meses'],
                colModel: [{
                        name: 'id',
                        index: 'id',
                        width: 150,
                        hidden: true
                    }, {
                        name: 'alimentacionp',
                        index: 'alimentacionp',
                        width: 150
                    }, ]
                    //multiselect: true
                    //caption: "Alimentaci&oacute;n primero 6 meses"
            });

            var mydata = [{
                id: '12',
                alimentacionp: "LME"
            }, {
                id: '13',
                alimentacionp: "Mixta"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaAlimentacionp").jqGrid('addRowData', i + 12, mydata[i]);

            $("#listaAlimentacion").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Alimentaci&oacute;n'],
                colModel: [{
                        name: 'id',
                        index: 'id',
                        width: 150,
                        hidden: true
                    }, {
                        name: 'alimentacion',
                        index: 'alimentacion',
                        width: 150
                    }, ]
                    //multiselect: true
                    //caption: "Alimentaci&oacute;n"
            });

            var mydata = [{
                id: '14',
                alimentacion: "Dieta hipercalorica"
            }, {
                id: '15',
                alimentacion: "Hipocalorica"
            }, {
                id: '16',
                alimentacion: "Baja en grasas"
            }, {
                id: '17',
                alimentacion: "Baja en azucares"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaAlimentacion").jqGrid('addRowData', i + 14, mydata[i]);


            $("#listaHigiene").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Higiene dental'],
                colModel: [{
                        name: 'id',
                        index: 'id',
                        width: 150,
                        hidden: true
                    }, {
                        name: 'higiene',
                        index: 'higiene',
                        width: 150
                    }, ]
                    //multiselect: true
                    //caption: "Higiene dental"
            });

            var mydata = [{
                id: '18',
                higiene: "Esporadicamente"
            }, {
                id: '19',
                higiene: "Una vez al dia"
            }, {
                id: '20',
                higiene: "Mas de una vez al dia"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaHigiene").jqGrid('addRowData', i + 18, mydata[i]);

            $('#tbFechaUltimaVisita').attr('disabled', 'disabled')
            $("#listaRevision").jqGrid({
                datatype: "local",
                height: 'auto',
                colNames: ['', 'Revisi&oacute;n dental'],
                colModel: [{
                    name: 'id',
                    index: 'id',
                    width: 150,
                    hidden: true
                }, {
                    name: 'revision',
                    index: 'revision',
                    width: 150
                }, ],
                onSelectRow: function(rowid, status) {
                        $('#tbFechaUltimaVisita').removeAttr('disabled')
                    }
                    //multiselect: true
                    //caption: "Revisi&oacute;n dental"
            });

            var mydata = [{
                id: '21',
                revision: "Nunca visto por el odontologo"
            }, {
                id: '22',
                revision: "Anual"
            }, {
                id: '23',
                revision: "Ocasional"
            }];
            for (var i = 0; i <= mydata.length; i++) $("#listaRevision").jqGrid('addRowData', i + 21, mydata[i]);

            $('#tbFechaUltimaVisita').mask('99/9999')

            $('#btnGuardarFisiologico').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminAntecedenteFisiologico.php', {
                    oper: 'add',
                    idantecedenteFisiologico: $('#tbIdAntecedenteFisiologico').val(),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    alimentacionMes: $('#listaAlimentacionp').jqGrid('getGridParam', 'selrow'),
                    alimentacion: $('#listaAlimentacion').jqGrid('getGridParam', 'selrow'),
                    higieneDental: $('#listaHigiene').jqGrid('getGridParam', 'selrow'),
                    revisionDental: $('#listaRevision').jqGrid('getGridParam', 'selrow'),
                    fechaVisitaDental: $('#tbFechaUltimaVisita').val(),
                    opcionActividadFisica: $('input:radio[name="chActividad"]:checked').val(),
                    frecuenciaActividadFisica: $('#cbFrecuenciaActividad').val(),
                    nroVecesActividadFisica: $('#tbNroVecesActividad').val()
                }, function(data) {
                    $('#tbIdAntecedenteFisiologico').val(data)
                    alert('Los datos se guardaron correctamente')
                })
            }).width(200).height(50)

            lista = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))

            $('#listaAntecedenteVacuna').jqGrid({
                url: '/sisfac/funcionesphp/adminVacuna.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idvacuna', 'claveGeneral', 'idpersona', 'Vacuna', 'Vacuna', 'Dosis', 'Estado'],
                colModel: [{
                    name: 'idvacuna',
                    index: 'idvacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idpersona',
                    index: 'idpersona',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoVacuna',
                    index: 'idcatalogoVacuna',
                    width: 100,
                    editable: true,
                    hidden: true,
                    edittype: 'select',
                    editrules: {
                        edithidden: true
                    },
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminCatalogoVacuna.php?f=3&dias=' + lista.dias
                    }
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 300
                }, {
                    name: 'dosis',
                    index: 'dosis',
                    width: 50
                }, {
                    name: 'estadoVacuna',
                    index: 'estadoVacuna',
                    width: 100,
                    hidden: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'INCOMPLETA:INCOMPLETA;COMPLETA:COMPLETA'
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idvacuna',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminVacuna.php',
                pager: '#pagerAntecedenteVacuna',
                onSelectRow: function(rowid, status) {
                    $('#listaAntecedenteDetalleVacuna').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDetalleVacuna.php?f=1&idvacuna=' + rowid
                    }).trigger('reloadGrid')
                }
            });

            $("#listaAntecedenteVacuna").jqGrid('navGrid', "#pagerAntecedenteVacuna", {
                edit: false,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                beforeShowForm: function(formid) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    $('#tr_idcatalogoVacuna select').load('/sisfac/funcionesphp/adminCatalogoVacuna.php', {
                        f: 4,
                        dias: lista.dias
                    }, function() {
                        temp = $('#listaAntecedenteVacuna').jqGrid('getRowData', $('#listaAntecedenteVacuna').jqGrid('getGridParam', 'selrow'))
                            //alert(temp.idcatalogoVacuna)
                        $('#tr_idcatalogoVacuna select').val(temp.idcatalogoVacuna)
                    })
                },
                onclickSubmit: function(params, postdata) {
                    return {
                        idcatalogoVacuna: $('#tr_idcatalogoVacuna select').val(),
                        nombreCatalogo: $("#tr_idcatalogoVacuna select option:selected").html(),
                        estadoVacuna: 'COMPLETA'
                    }
                }
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                beforeShowForm: function(formid) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    $('#tr_idcatalogoVacuna select').load('/sisfac/funcionesphp/adminCatalogoVacuna.php', {
                        f: 4,
                        dias: lista.dias,
                        idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    }, function() {})
                },
                onclickSubmit: function(params, postdata) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    return {
                        idpersona: id,
                        dias: lista.dias,
                        estadoVacuna: 'COMPLETA',
                        fechaNacimiento: lista.fechaNacimiento,
                        idcatalogoVacuna: $('#tr_idcatalogoVacuna select').val(),
                        nombreCatalogo: $("#tr_idcatalogoVacuna select option:selected").html()
                    }
                },
                beforeSubmit: function(postdata, formid) {
                    id = $('#idcatalogoVacuna').val()
                    return [id != '', 'Debe seleccionar un catalogo'];
                },
                afterSubmit: function(response, postdata) {
                    alert('Los datos se guardaron correctamente')
                    $('#listaAntecedenteVacuna').jqGrid('setSelection', response.responseText)
                    return [true]
                }
            });

            $('#listaAntecedenteDetalleVacuna').jqGrid({
                url: '/sisfac/funcionesphp/adminDetalleVacuna.php?f=1&idvacuna=0',
                datatype: "xml",
                colNames: ['iddetalleVacuna', 'claveGeneral', 'idvacuna', 'Nro. dosis', '', 'Tipo Programaci&oacute;n', 'Fecha programada', 'Fecha aplicaci&oacute;n', 'Estado dosis', 'Lugar de aplicaci&oacute;n', 'Observaciones'],
                colModel: [{
                    name: 'iddetalleVacuna',
                    index: 'iddetalleVacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idvacuna',
                    index: 'idvacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nroDosis',
                    index: 'nroDosis',
                    width: 50,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).attr('disabled', 'disabled')
                        }
                    }
                }, {
                    name: 'opProgramacion',
                    index: 'opProgramacion',
                    width: 200,
                    hidden: true
                }, {
                    name: 'tipoProgramacion',
                    index: 'tipoProgramacion',
                    width: 150,
                    hidden: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'MANUAL:MANUAL;AUTOMATICA:AUTOMATICA',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($(el).val() == 'MANUAL') $('#fechaProgramada').val('')
                                else {
                                    lista = $('#listaAntecedenteVacuna').jqGrid('getRowData', $('#listaAntecedenteVacuna').jqGrid('getGridParam', 'selrow'))
                                    lista1 = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
                                    $.post('/sisfac/funcionesphp/adminVacuna.php', {
                                        f: 5,
                                        idvacuna: $('#listaVacunaPersona').jqGrid('getGridParam', 'selrow'),
                                        nroDosis: $('#nroDosis').val(),
                                        idcatalogoVacuna: lista.idcatalogoVacuna,
                                        fechaNacimiento: lista1.fechaNacimiento
                                    }, function(data) {
                                        $('#fechaProgramada').val(data)
                                    })
                                }
                            })
                        }
                    }
                }, {
                    name: 'fechaProgramada',
                    index: 'fechaProgramada',
                    width: 80,
                    hidden: true,
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'fechaAplicacion',
                    index: 'fechaAplicacion',
                    width: 150,
                    editable: true,
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'estadoDosis',
                    index: 'estadoDosis',
                    width: 100,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'SIN PLANIFICAR:SIN PLANIFICAR;PLANIFICADA:PLANIFICADA;EJECUTADA:EJECUTADA'
                    }
                }, {
                    name: 'lugarAplicacion',
                    index: 'lugarAplicacion',
                    editable: true,
                    width: 100,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'DOMICILIO:DOMICILO;ESTABLECIMIENTO DE SALUD:ESTABLECIMIENTO DE SALUD;FUERA:FUERA'
                    }
                }, {
                    name: 'observaciones',
                    index: 'observaciones',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 4,
                        cols: 20
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'dva.iddetalleVacuna',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminDetalleVacuna.php',
                pager: '#pagerAntecedenteDetalleVacuna'
            });

            $("#listaAntecedenteDetalleVacuna").jqGrid('navGrid', "#pagerAntecedenteDetalleVacuna", {
                edit: true,
                add: false,
                del: false
            }, {
                //width:500,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                beforeShowForm: function(formid) {
                    lista = $('#listaAntecedenteDetalleVacuna').jqGrid('getRowData', $('#listaAntecedenteDetalleVacuna').jqGrid('getGridParam', 'selrow'))
                    if (lista.opProgramacion == 'NO') $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option>")
                    else {
                        if (lista.tipoProgramacion == 'AUTOMATICA') $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option><option value='AUTOMATICA' selected>AUTOMATICA</option>")
                        else $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option><option value='AUTOMATICA'>AUTOMATICA</option>")
                    }
                },
                onclickSubmit: function(params, postdata) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    return {
                        estadoDosis: 'EJECUTADA'
                    }
                }
            }, {
                //width:500,
                reloadAfterAdd: true,
                closeAfterAdd: true
            });




            //$("#listaInmunizaciones").jqGrid('inlineNav',"#pagerInmunizaciones");


            $('#listaMedicamentos').jqGrid({
                url: '/sisfac/funcionesphp/adminAntecedenteMedicamento.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idantecedenteMedicamento', 'Tipo de medicamento', 'Medicaci&oacute;n', 'Tiempo de uso(mm/yyyy)'],
                colModel: [{
                        name: 'idantecedenteMedicamento',
                        index: 'idantecedenteMedicamento',
                        width: 200,
                        editable: true,
                        hidden: true
                    }, {
                        name: 'tipoMedicamento',
                        index: 'tipoMedicamento',
                        width: 200,
                        editable: true
                    }, {
                        name: 'medicacion',
                        index: 'medicacion',
                        width: 200,
                        editable: true
                    }, {
                        name: 'tiempoUso',
                        index: 'tiempoUso',
                        width: 100,
                        editable: true,
                        editoptions: {
                            dataInit: function(el) {
                                $(el).mask('99/9999')
                            }
                        }
                    } //guardar numero de meses y numero de anios --|--
                ],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idantecedenteMedicamento',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminAntecedenteMedicamento.php',
                pager: '#pagerMedicamentos'
            });
            $("#listaMedicamentos").jqGrid('navGrid', "#pagerMedicamentos", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 400,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 400,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    return {
                        idpersona: id
                    }
                }
            });



            $('#listaAntecedentesFamiliares').jqGrid({
                url: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php?f=1&opc=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idantecedenteFamiliar', 'Tipo', 'Parentesco', 'Patolog&iacute;a', 'CIE10', 'CIE10', 'Fuente', 'Observaci&oacute;n', 'Descripci&oacute;n'],
                colModel: [{
                    name: 'idantecedenteFamiliar',
                    index: 'idantecedenteFamiliar',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'tipo',
                    index: 'tipo',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'parentesco',
                    index: 'parentesco',
                    width: 150,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'PADRE:PADRE;MADRE:MADRE;HIJO/HIJA:HIJO/HIJA;ABUELO/ABUELA:ABUELO/ABUELA;TIO/TIA:TIO/TIA'
                    }
                }, {
                    name: 'opcionPatologia',
                    index: 'opcionPatologia',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'SI:SI;NO:NO',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($('#opcionPatologia').val() == 'SI') {
                                    $('#tr_nombreCIE10').show()
                                } else {
                                    $('#tr_nombreCIE10').hide()
                                }
                            })
                        }
                    }
                }, {
                    name: 'idcatalogoCIE10',
                    index: 'idcatalogoCIE10',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCIE10',
                    index: 'nombreCIE10',
                    width: 400,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCIE10').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'fuente',
                    index: 'fuente',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: '(R) PACIENTE REFERIDO:(R) PACIENTE REFERIDO;(D) PACIENTE DIAGNOSTICADO:(D) PACIENTE DIAGNOSTICADO',
                        dataInit: function(el) {
                            $(el).width(150)
                        }
                    }
                }, {
                    name: 'observacion',
                    index: 'observacion',
                    width: 150,
                    hidden: true
                }, {
                    name: 'descripcion',
                    index: 'descripcion',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 2,
                        cols: 50
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idantecedenteFamiliar',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php',
                pager: '#pagerAntecedentesFamiliares'
            });
            $("#listaAntecedentesFamiliares").jqGrid('navGrid', "#pagerAntecedentesFamiliares", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 600,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                afterShowForm: function(formid) {
                    if ($('#opcionPatologia').val() == 'SI') {
                        $('#tr_nombreCIE10').show()
                    } else {
                        $('#tr_nombreCIE10').hide()
                    }
                }
            }, {
                width: 600,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                afterShowForm: function(formid) {
                    $('#tr_nombreCIE10').show()
                },
                onclickSubmit: function(params, postdata) {
                        id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        return {
                            idpersona: id,
                            tipo: 'FAMILIAR'
                        }
                    }
                    /*,
                                    beforeSubmit : function(postdata, formid) {  
                                        id = $('#idcatalogoCIE10').val()
                                        return [id!='','Debe seleccionar un catalogo CIE10'];
                                    }*/
            });


            $('#listaAntecedentesAlergias').jqGrid({
                url: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php?f=1&opc=0&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idantecedenteFamiliar', 'Tipo', 'Parentesco', 'Patolog&iacute;a', 'CIE10', 'CIE10', 'Fuente', 'Observaci&oacute;n', 'Descripci&oacute;n'],
                colModel: [{
                    name: 'idantecedenteFamiliar',
                    index: 'idantecedenteFamiliar',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'tipo',
                    index: 'tipo',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'ALERGIA:ALERGIA;ALERGIA MEDICAMENTO:ALERGIA MEDICAMENTO'
                    }
                }, {
                    name: 'parentesco',
                    index: 'parentesco',
                    width: 150,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'PADRE:PADRE;MADRE:MADRE;HIJO/HIJA:HIJO/HIJA;ABUELO/ABUELA:ABUELO/ABUELA;TIO/TIA:TIO/TIA'
                    }
                }, {
                    name: 'opcionPatologia',
                    index: 'opcionPatologia',
                    width: 100,
                    hidden: true
                }, {
                    name: 'idcatalogoCIE10',
                    index: 'idcatalogoCIE10',
                    width: 100,
                    hidden: true
                }, {
                    name: 'nombreCIE10',
                    index: 'nombreCIE10',
                    width: 300,
                    hidden: true
                }, {
                    name: 'fuente',
                    index: 'fuente',
                    width: 100,
                    hidden: true
                }, {
                    name: 'observacion',
                    index: 'observacion',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 2,
                        cols: 40
                    }
                }, {
                    name: 'descripcion',
                    index: 'descripcion',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 2,
                        cols: 40
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idantecedenteFamiliar',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminAntecedenteFamiliar.php',
                pager: '#pagerAntecedentesAlergias'
            });
            $("#listaAntecedentesAlergias").jqGrid('navGrid', "#pagerAntecedentesAlergias", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 400,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 400,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    return {
                        idpersona: id
                    }
                }
            });


            $('#btnGuardarPsicosociales').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminAntecedentePsicosocial.php', {
                    oper: 'add',
                    idantecedentePsicosocial: $('#tbIdAntecedentePsicosocial').val(),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    opcionAlcohol: $('input:radio[name="rbAlchocol"]:checked').val(),
                    cantidadAlcohol: $('#tbCantidadAlcohol').val(),
                    frecuenciaAlcohol: $('#cbFrecuenciaAlcohol').val(),
                    nroVecesAlcohol: $('#tbNroVecesAlcohol').val(),
                    opcionTabaco: $('input:radio[name="rbTabaco"]:checked').val(),
                    nroCigarros: $('#tbCantidadCigarrillos').val(),
                    nroCajetillas: $('#tbCantidadCajetillas').val(),
                    frecuenciaTabaco: $('#cbFrecuenciaTabaco').val(),
                    nroVecesTabaco: $('#tbNroVecesTabaco').val(),
                    opcionDroga: $('input:radio[name="rbDrogas"]:checked').val(),
                    frecuenciaDroga: $('#cbFrecuenciaDrogas').val(),
                    nroVecesDroga: $('#tbNroVecesDroga').val(),
                    opcionHojaCoca: $('input:radio[name="rbHojaCoca"]:checked').val(),
                    frecuenciaHojaCoca: $('#cbFrecuenciaHojaCoca').val(),
                    nroVecesHojaCoca: $('#tbNroVecesHojaCoca').val(),
                    opcionPornografia: $('input:radio[name="chPornografia"]:checked').val(),
                    horasPornografia: $('#tbHorasDiaPornografia').val(),
                    opcionPandilla: $('input:radio[name="chPandilla"]:checked').val(),
                    opcionVideoJuego: $('input:radio[name="chVideoJuegos"]:checked').val(),
                    horaVideoJuego: $('#tbHorasDiaVideo').val(),
                    opcionDelincuencia: $('input:radio[name="chDelincuencia"]:checked').val(),
                    opcionViolenciaFisica: $('input:radio[name="chViolencia"]:checked').val(),
                    opcionViolenciaPsicologica: $('input:radio[name="chViolenciaPsicologica"]:checked').val(),
                    opcionViolenciaSexual: $('input:radio[name="chViolenciaSexual"]:checked').val(),
                    opcionBullyng: $('input:radio[name="chBullyng"]:checked').val(),
                    opcionTrabaja: $('input:radio[name="chTrabaja"]:checked').val(),
                    edadInicioTrabajo: $('#tbEdadInicio').val(),
                    tipoTrabajo: $('input:radio[name="chTipoTrabajo"]:checked').val(),
                    riesgoOcupacional: $('#cbRiesgoOcupacional').val(),
                    opcionAnorexia: $('input:radio[name="chProblemas"]:checked').val(),
                    opcionSuicidio: $('input:radio[name="chSuicidio"]:checked').val(),
                    opcionDesercion: $('input:radio[name="chDesercion"]:checked').val(),
                    opcionRepitencia: $('input:radio[name="chRepitencia"]:checked').val(),
                    opcionViolenciaNegligencia: $('input:radio[name="chViolenciaNegligencia"]:checked').val(),
                    opcionViolenciaPolitica: $('input:radio[name="chViolenciaPolitica"]:checked').val()
                }, function(data) {
                    alert('Los datos se guardaron correctamente')
                    $('#tbIdAntecedentePsicosocial').val(data)
                })
            }).width(200).height(50)

        }

        function segundoTabClinica() {
            $('#tbConsultaHC').attr('disabled', 'disabled')
            hacerAutocompletar('tbConsultaUPS', 'tbIdConsultaUPS', 'adminCatalogoUPS.php?f=2')


            $('#tbFechaInicioEpisodio').mask('99/99/9999')
            $('#tbDeposicionHoraDia,#tbPesoEpisodio,#tbTiempoEpisodio,#tbSemanaGestacional').width(25)
            $('#tbConsultaUPS').width(500)
            $('#btnGuardarEpisodio').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminEpisodio.php', {
                    oper: 'add',
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoUPS: $('#tbIdConsultaUPS').val(),
                    nombreCatalogo: $('#tbConsultaUPS').val(),
                    claseAtencion: $('#cbClaseAtencion').val(),
                    tipo: $('#cbTipoEpisodio').val(),
                    situacion: $('#cbSituacionConsulta').val(),
                    fechaInicio: $('#tbFechaInicioEpisodio').val(),
                    fechaFin: $('#tbFechaFinEpisodio').val(),
                    nombreEpisodio: $('#cbNombreEpisodio').val(),
                    estadoEpisodio: $('#cbEstadoEpisodio').val(),
                    medioAcceso: $('#cbMedioAcceso').val(),
                    procedencia: $('#cbProcedencia').val(),
                    acompanante: $('#tbAcompanante').val(),
                    parentesco: $('#cbParentescoAcompanante').val(),
                    motivoConsulta: $('#taMotivoConsulta').val(),
                    sintomas: $('#taSintomas').val(),
                    sindromeCultura: $('#taRegistroSindrome').val(),
                    tiempoEnfermedad: $('#tbTiempoEnfermedad').val(),
                    detalleTiempo: $('#cbTiempoEnfermedad').val(),
                    semanaEpidemiologica: $('#tbSemanaEpidemiologica').val(),
                    opcionSemanaGestacional: $('input:radio[name="rbSemanaGestacional"]:checked').val(),
                    semanaGestacional: $('#tbSemanaGestacional').val(),
                    sueno: $('#cbSuenoEpisodio').val(),
                    sed: $('#cbSedEpisodio').val(),
                    animo: $('#cbApetitoEpisodio').val(),
                    apetito: $('#cbEstadoAnimoEpisodio').val(),
                    orina: $('#cbOrinaEpisodio').val(),
                    deposiciones: $('#cbDeposicionEpisodio').val(),
                    frecuenciaDeposiciones: $('#tbDeposicionHoraDia').val(),
                    horaDiaDeposiciones: $('#lbHoraDiaDeposicion').text(),
                    perdidaPeso: $('input:radio[name="rbPerdidaPeso"]:checked').val(),
                    detallePesoKilos: $('#tbPesoEpisodio').val(),
                    opcionPesoTiempo: $('#cbTiempoEpisodio').val(),
                    detallePesoTiempo: $('#tbTiempoEpisodio').val(),
                    tos: $('input:radio[name="rbTosEpisodio"]:checked').val()
                }, function(data) {
                    $('#listaEpisodio').trigger('reloadGrid')
                    $('#listaEpisodio').jqGrid('resetSelection')
                    alert('Se guardaron correctamente los datos')
                    $('#listaEpisodio').jqGrid('setSelection', data)
                })
            }).width(150).height(50)
        }

        function tercerTabClinica() {
            lista = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
            lista1 = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                //&idcatalogoEpisodio=' + lista.idcatalogoEpisodio + '&nombreEtapa=' + lista.etapa
            rSel = 1
            $('#listaPrestacion').jqGrid({
                url: '/sisfac/funcionesphp/adminCatalogoEpisodioPrestacion.php?f=1&idcatalogoEpisodio=' + lista1.idcatalogoEpisodio + '&nombreEtapa=' + lista.etapa + '&opActivo=SI',
                datatype: "xml",
                colNames: ['idcatalogoEpisodioPrestacion', 'Cod. Prestacion', 'Prestacion', 'Episodio', 'Episodio', 'Cod. Perfil', 'Perfil', 'formulario'],
                colModel: [{
                    name: 'idcatalogoEpisodioPrestacion',
                    index: 'idcatalogoEpisodioPrestacion',
                    width: 100,
                    hidden: true
                }, {
                    name: 'idcatalogoPrestacion',
                    index: 'idcatalogoPrestacion',
                    width: 50,
                    hidden: true
                }, {
                    name: 'nombrePrestacion',
                    index: 'nombrePrestacion',
                    width: 400
                }, {
                    name: 'idcatalogoEpisodio',
                    index: 'idcatalogoEpisodio',
                    width: 100,
                    hidden: true
                }, {
                    name: 'nombreEpisodio',
                    index: 'nombreEpisodio',
                    width: 200,
                    hidden: true
                }, {
                    name: 'idcatalogoPerfil',
                    index: 'idcatalogoPerfil',
                    width: 100,
                    hidden: true
                }, {
                    name: 'nombrePerfil',
                    index: 'nombrePerfil',
                    width: 300
                }, {
                    name: 'formulario',
                    index: 'formulario',
                    width: 100,
                    hidden: true
                }, ],
                height: 150,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idcatalogoEpisodioPrestacion',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminCatalogoEpisodioPrestacion.php',
                //pager:'#pagerPrestacion',
                onSelectRow: function(rowid, status) {
                    lista = $('#listaPrestacion').jqGrid('getRowData', rowid)
                    rSel = rowid
                    muestraFormularios(lista)
                        //llenarFormularios(lista)
                },
                loadComplete: function(data) {
                    //alert(rSel)
                    $('#listaPrestacion').jqGrid('setSelection', rSel)
                }
            });

            $("#listaPrestacion").jqGrid('navGrid', "#pagerPrestacion", {
                edit: true,
                add: true,
                del: true
            }, {
                //width:500,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                //width:500,
                reloadAfterAdd: true,
                closeAfterAdd: true
                    /*onclickSubmit:function(params,postdata){
                        id=$('#lista').jqGrid('getGridParam','selrow')
                        return {id:id}
                    },
                    afterShowForm  : function(formid) {

                    },
                    beforeSubmit : function(postdata, formid) {  
                        id = $('#id').val()
                        return [id!='','Debe seleccionar '];
                    }*/
            });

            $('#tbUPSPrestacion').width(400)
            hacerAutocompletar('tbUPSPrestacion', 'tbIdUPSPrestacion', 'adminCatalogoUPS.php?f=2')

            $('#tbFechaInicioPrestacion,#tbFechaFinPrestacion').mask('99/99/9999').width(80)
            $('#tbFechaInicioPrestacion').change(function() {
                $.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                    f: 2,
                    fecha: $('#tbFechaInicioPrestacion').val(),
                    dias: 7
                }, function(data) {
                    $('#tbFechaVisita1').val(data)
                })
                $.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                    f: 2,
                    fecha: $('#tbFechaInicioPrestacion').val(),
                    dias: 60
                }, function(data) {
                    $('#tbFechaVisita2').val(data)
                })
                $.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                    f: 2,
                    fecha: $('#tbFechaInicioPrestacion').val(),
                    dias: 273
                }, function(data) {
                    $('#tbFechaVisita3').val(data)
                })
            })
            $('#tbTiempoDiarrea').width(80)
            $('#tbApoyoSocial').attr('disabled', 'disabled').val('');
            $('input:radio[name="rbApoyoSocial"]').change(function() {
                if ($(this).val() == 'NO') {
                    $('#tbApoyoSocial').attr('disabled', 'disabled').val('');
                } else {
                    $('#tbApoyoSocial').removeAttr('disabled');
                }
            });

            function muestraFormularios(lista) {
                for (i = 0; i < 50; i++) {
                    $('#formulario' + i).hide()
                }
                $('#hTituloPrestacion').text(lista.nombrePrestacion)
                    //$('#formulario141').show()
                $('#' + lista.formulario).show()
                llenaFormulario(lista)
                    //eval(lista.formulario + '(lista)')
            }
            muestraFormularios('vacio')

            function llenaFechaPrestacion() {
                if ($('#tbFechaInicioPrestacion').val() == '') {
                    hoy = new Date();
                    dia = hoy.getDate()
                    mes = hoy.getMonth() + 1
                    anio = hoy.getFullYear()
                    $('#tbFechaInicioPrestacion').val((dia < 10 ? '0' + dia : dia) + '/' + mes + '/' + anio)
                }
            }

            function llenaFormulario(lista) {
                switch (lista.formulario) {
                    case 'formulario38':
                        $.post('/sisfac/funcionesphp/adminPrestacionAiepi.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            //idprestacionAiepi,claveGeneral,idcatalogoPrestacion,idpersona,idepisodio,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,infeccionBacteriana,respiracionesPorMinuto,
                            //respiracionRapida,tirajeSubcostal,aleteoNasal,quejido,estadoFontanela,supuracionOido,estadoOmbligo,temperatura,pielPustulas,letargio,movimientoAnormal,
                            //secrecionOjos,diarrea,tiempoDiarrea,sangreHeces,estadoGeneral,ojosHundidos,signoCutaneo 
                            data = data.split('+')
                            i = 5
                            $('#tbIdPrestacionAiepi').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('input:radio[name=rbInfeccion][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbRespiracionMinuto').val(data[i++])
                            $('input:radio[name=rbRespiracionRapida][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbTirajeSubcostal][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAleteoNasal][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbQuejido][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbEstadoFontanela').val(data[i++])
                            $('input:radio[name=rbSupuracion][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbOmbligo][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbTemperatura][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbPielPustulas][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbInconsciente][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbMueveMenos][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSecrecion][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbDiarrea][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbTiempoDiarrea').val(data[i++])
                            $('input:radio[name=rbSangreHeces][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbEstadoGeneral][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbOjosHundidos][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSignoCutaneo][value=' + data[i++] + ']').attr('checked', true);

                            llenaFechaPrestacion()
                        })
                        break;
                    case 'formulario39':
                        $.post('/sisfac/funcionesphp/adminPrestacionEvaluacionNino.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                                //idprestacionEvaluacionNino,claveGeneral,idcatalogoPrestacion,idpersona,idepisodio,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,
                                //signosPeligro,remedioRecibidos,opTos,diasTiempoTos,supuracionOido,diasSupuracion,tumefaccionOreja,dolorGarganta,exudado,gangliosDolorosos,
                                //diarrea,tiempoDiarrea,estadoGeneral,sangreHeces,ojosHundidos,signosPliegue,fiebre,riesgoMalaria,observaciones 
                            $('#tbIdPrestacionAiepi').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('input:radio[name=rbSignoPeligro][value=' + data[i++] + ']').attr('checked', true);
                            $('#taAutodiagnostico').val(data[i++])
                            $('input:radio[name=rbTieneTos][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbTiempoTos').val(data[i++])
                            $('input:radio[name=rbDolorOido][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbTiempoOido').val(data[i++])
                            $('input:radio[name=rbTumefacion][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbGarganta][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbEnrojecimiento][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbGanglios][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbDiarreaNino][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbTiempoDiarreaNino').val(data[i++])
                            $('#taEstadoGeneral').val(data[i++])
                            $('input:radio[name=rbSangreHecesNino][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbOjosHundidosNino][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSignoPliegue][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbFiebre][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbMalaria][value=' + data[i++] + ']').attr('checked', true);
                            $('#taObservacion').val(data[i++])
                            llenaFechaPrestacion()
                        })
                        break;

                    case 'formulario13':
                        $.post('/sisfac/funcionesphp/adminPrestacionEvaluacionLME.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                                //idprestacionEvaluacionLME, claveGeneral, idcatalogoPrestacion, idepisodio, idpersona, idcatalogoUPS, fechaInicio, fechaFin, estado, 
                                //lactanciaLM, tecnicaLM, frecuenciaLM, lecheNoMaterna, recibeAguitas, otroAlimento, consistenciaAdecuada, cantidadAdecuada, frecuenciaAdecuada, 
                                //consumoAlimentosAnimal, consumoFrutasVerduras, consumoMantequilla, alimentosEnPlato, usaSalYodada, tomaSuplementoHierro, tomaSuplementoVitamina, 
                                //recibeMicronutrientes, opcionBeneficiarioPrograma, descripcionPrograma
                            $('#tbIdPrestacionEvaluacionLME').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('input:radio[name=rbNinoLactancia][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbTecnicaLM][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbFrecuenciaLM][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbNinoLeche][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbNinoAguitas][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbNinoAlimento][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbPreparacion][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbCantidadAlimento][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbFrecuenciaAlimentacion][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAlimentoAnimal][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbFruta][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAceite][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAlimentoPropio][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSal][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSuplementoHierro][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbSuplementoVitamina][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbMultimicronutiente][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbApoyoSocial][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbApoyoSocial').val(data[i++])
                            llenaFechaPrestacion()
                        })

                        lista = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                        for (i = 7; i < 18; i++) {
                            if (lista.limiteFinal < 212) $('#trAlimentacion' + i).hide() //hasta 6 meses
                            else $('#trAlimentacion' + i).show()
                        }

                        break;

                    case 'formulario14':
                        $.post('/sisfac/funcionesphp/adminPrestacionAlimentacionRN.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                                //idprestacionAlimentacionRN,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,tomaPecho,nroVecesPecho,opcomidas,cualesComidas,cambioDuranteEnfermedad,cualesEnfermedades,ulcerasBocaBajoPeso,alimentacionUltimaHora,opAmarre,mamaCorrecto,ulcerasBoca,buenaPosicion,observaciones 
                                //idprestacionAlimentacionRN, claveGeneral, idcatalogoPrestacion, idepisodio, idpersona, idcatalogoUPS, nombreCatalogo, fechaInicio, fechaFin, estado, 
                                //tomaPecho, nroVecesPecho, opcomidas, cualesComidas, cambioDuranteEnfermedad, cualesEnfermedades, ulcerasBocaBajoPeso, alimentacionUltimaHora, opAmarre, 
                                //mamaCorrecto, ulcerasBoca, buenaPosicion, observaciones
                            $('#tbIdPrestacionAlimentacionRN').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('input:radio[name=rbTomaPecho][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbTiempoPecho').val(data[i++])
                            $('input:radio[name=rbComida][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbComida').val(data[i++])
                            $('input:radio[name=rbCambioEnfermedad][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbCambioEnfermedad').val(data[i++])
                            $('input:radio[name=rbUlceras][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAlimentoPecho][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbAmarre][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbMamaBien][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbUlcerasPlaca][value=' + data[i++] + ']').attr('checked', true);
                            $('input:radio[name=rbLactancia][value=' + data[i++] + ']').attr('checked', true);
                            $('#taObservacionAlimentacion').val(data[i++])
                            llenaFechaPrestacion()
                        })
                        break;
                    case 'formulario20':
                        $.post('/sisfac/funcionesphp/adminPrestacionExamenIntegral.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                                //idprestacionExamenIntegral, claveGeneral, idcatalogoPrestacion, idpersona, idepisodio, idcatalogoUPS, nombreCatalogo, fechaInicio, fechaFin, estado, 
                                //opcionPiel, descripcionPiel, opcionCabeza, descripcionCabeza, opcionCabello, descripcionCabello, opcionOjos, descripcionOjoD, descripcionOjoI, opcionOidos, 
                                //descripcionOidoD, descripcionOidoI, opcionNariz, descripcionNariz, opcionBoca, descripcionBoca, opcionOrofaringe, descripcionOrofaringe, opcionCuello, 
                            $('#tbIdPrestacionExamenIntegral').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('#cbAlteracionPiel').val(data[i++])
                            $('#tbDescripcionPiel').val(data[i++])
                            $('#cbAlteracionCabeza').val(data[i++])
                            $('#tbDescripcionCabeza').val(data[i++])
                            $('#cbAlteracionCabello').val(data[i++])
                            $('#tbDescripcionCabello').val(data[i++])
                            $('#cbAlteracionOjos').val(data[i++])
                            $('#tbDescripcionOjoD').val(data[i++])
                            $('#tbDescripcionOjoI').val(data[i++])
                            $('#cbAlteracionOidos').val(data[i++])
                            $('#tbDescripcionOidoD').val(data[i++])
                            $('#tbDescripcionOidoI').val(data[i++])
                            $('#cbAlteracionNariz').val(data[i++])
                            $('#tbDescripcionNariz').val(data[i++])
                            $('#cbAlteracionBoca').val(data[i++])
                            $('#tbDescripcionBoca').val(data[i++])
                            $('#cbAlteracionOrofaringe').val(data[i++])
                            $('#tbDescripcionOrofaringe').val(data[i++])
                            $('#cbAlteracionCuello').val(data[i++])
                                //descripcionCuello, opcionRespiratorio, descripcionRespiratorio, opcionCardiovascular, descripcionCardiovascular, opcionDigestivo, descripcionDigestivo, 
                                //opcionGenitourinario, descripcionGenitourinario, opcionLocomotor, descripcionLocomotor, opcionMarcha, descripcionMarcha, opcionColumna, descripcionColumna, 
                                //opcionSuperior, descripcionSuperior, opcionInferior, descripcionInferior, opcionLinfatico, descripcionLinfatico
                            $('#tbDescripcionCuello').val(data[i++])
                            $('#cbAlteracionRespiratorio').val(data[i++])
                            $('#tbDescripcionRespiratorio').val(data[i++])
                            $('#cbAlteracionCardiovascular').val(data[i++])
                            $('#tbDescripcionCardiovascular').val(data[i++])
                            $('#cbAlteracionDigestivo').val(data[i++])
                            $('#tbDescripcionDigestivo').val(data[i++])
                            $('#cbAlteracionGenitourinario').val(data[i++])
                            $('#tbDescripcionGenitourinario').val(data[i++])
                            $('#cbAlteracionLocomotor').val(data[i++])
                            $('#tbDescripcionLocomotor').val(data[i++])
                            $('#cbAlteracionMarcha').val(data[i++])
                            $('#tbDescripcionMarcha').val(data[i++])
                            $('#cbAlteracionColumna').val(data[i++])
                            $('#tbDescripcionColumna').val(data[i++])
                            $('#cbAlteracionSuperior').val(data[i++])
                            $('#tbDescripcionSuperior').val(data[i++])
                            $('#cbAlteracionInferior').val(data[i++])
                            $('#tbDescripcionInferior').val(data[i++])
                            $('#cbAlteracionLinfatico').val(data[i++])
                            $('#tbDescripcionLinfatico').val(data[i++])
                            llenaFechaPrestacion()
                        })
                        break;
                    case 'formulario17':

                        $.post('/sisfac/funcionesphp/adminEvaluacionDesarrollo.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                            $('#tbIdEvaluacionDesarrollo').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('#cbResultadoEvaluacion').val(data[i++])
                            $('#taObservacionEvaluacion').val(data[i++])
                            llenaFechaPrestacion()
                        })
                        break;
                    case 'formulario40':
                        $.post('/sisfac/funcionesphp/adminPrestacionConsejeria.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                            $('#tbIdPrestacionConsejeria').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            llenaFechaPrestacion()
                            $('#listaTipoConsejeria').jqGrid('setGridParam', {
                                url: '/sisfac/funcionesphp/adminDetalleConsejeria.php?f=1&idprestacionConsejeria=' + data[0]
                            }).trigger('reloadGrid')
                        })
                        break;
                    case 'formulario1':
                        $.post('/sisfac/funcionesphp/adminAdministracionMicronutrientesNino.php', {
                            f: 2,
                            idcatalogoPrestacion: lista.idcatalogoPrestacion,
                            idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                            idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                        }, function(data) {
                            data = data.split('+')
                            i = 5
                                //idadministracionMicronutrientesNino, claveGeneral, idcatalogoPrestacion, idepisodio, idpersona, idcatalogoUPS, nombreCatalogo, 
                                //fechaInicio, fechaFin, estado, hierro, esquemaHierro, vitamina, esquemaVitamina, multimicronutrientes, esquemaMultimicronutrientes, 
                                //fechaMicronutriente, estadoMicronutiente, segimientoDomicilio1, estadoSeguimiento1, segimientoDomicilio2, estadoSeguimiento2, segimientoDomicilio3, estadoSeguimiento3
                            $('#tbIdAdministracionMicronutrientesNino').val(data[0])
                            $('#tbIdUPSPrestacion').val(data[i++])
                            $('#tbUPSPrestacion').val(data[i++])
                            $('#tbFechaInicioPrestacion').val(data[i++])
                            $('#tbFechaFinPrestacion').val(data[i++])
                            $('#cbEstadoPrestacion').val(data[i++])
                            $('input:radio[name=rbHierro][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbEsquemaHierro').val(data[i++])
                            $('input:radio[name=rbVitaminaA][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbEsquemaVitaminaA').val(data[i++])
                            $('input:radio[name=rbMicronutrientes][value=' + data[i++] + ']').attr('checked', true);
                            $('#tbEsquemaMicronutrientes').val(data[i++])
                            $('#tbFechaMicronutriente').val(data[i++])
                            $('#cbMicronutriente').val(data[i++])
                            $('#tbFechaVisita1').val(data[i++])
                            $('#cbFechaVisita1').val(data[i++])
                            $('#tbFechaVisita2').val(data[i++])
                            $('#cbFechaVisita2').val(data[i++])
                            $('#tbFechaVisita3').val(data[i++])
                            $('#cbFechaVisita3').val(data[i++])

                            if ($('input:radio[name="rbHierro"]:checked').val() == 'NO') $('#tbEsquemaHierro').attr('disabled', 'disabled').val('');
                            else $('#tbEsquemaHierro').removeAttr('disabled');

                            if ($('input:radio[name="rbVitaminaA"]:checked').val() == 'NO') $('#tbEsquemaVitaminaA').attr('disabled', 'disabled').val('');
                            else $('#tbEsquemaVitaminaA').removeAttr('disabled');

                            if ($('input:radio[name="rbMicronutrientes"]:checked').val() == 'NO') $('#tbEsquemaMicronutrientes').attr('disabled', 'disabled').val('');
                            else $('#tbEsquemaMicronutrientes').removeAttr('disabled');
                            llenaFechaPrestacion()
                        })
                        break;
                    case 'formulario':

                        break;
                }
            }

            function obtenerIdsPrestacion() {
                var data = Array(),
                    j = 0
                ids = $('#listaPrestacion').jqGrid('getDataIDs')
                for (i in ids) {
                    lista = $('#listaPrestacion').jqGrid('getRowData', ids[i])
                    temp = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))
                    if (temp.formulario == lista.formulario) {
                        data[j] = lista.idcatalogoPrestacion
                        j++
                    }
                }
                return data.join('*')
            }
            $('#tbFechaMicronutriente,#tbFechaVisita1,#tbFechaVisita2,#tbFechaVisita3').mask('99/99/9999').width(80)
            $('#tbEsquemaHierro,#tbEsquemaVitaminaA,#tbEsquemaMicronutrientes').width(400)
            $('#tbEsquemaHierro,#tbEsquemaVitaminaA,#tbEsquemaMicronutrientes').attr('disabled', 'disabled').val('');

            $('input:radio[name="rbHierro"]').change(function() {
                if ($(this).val() == 'NO') {
                    $('#tbEsquemaHierro').attr('disabled', 'disabled').val('');
                } else {
                    $('#tbEsquemaHierro').removeAttr('disabled');
                }
            });
            $('input:radio[name="rbVitaminaA"]').change(function() {
                if ($(this).val() == 'NO') {
                    $('#tbEsquemaVitaminaA').attr('disabled', 'disabled').val('');
                } else {
                    $('#tbEsquemaVitaminaA').removeAttr('disabled');
                }
            });
            $('input:radio[name="rbMicronutrientes"]').change(function() {
                if ($(this).val() == 'NO') {
                    $('#tbEsquemaMicronutrientes').attr('disabled', 'disabled').val('');
                } else {
                    $('#tbEsquemaMicronutrientes').removeAttr('disabled');
                }
            });

            $('#btnGuardarFormulario1').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                $.post('/sisfac/funcionesphp/adminAdministracionMicronutrientesNino.php', {
                    oper: 'add',
                    idadministracionMicronutrientesNino: $('#tbIdAdministracionMicronutrientesNino').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio,
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    hierro: $('input:radio[name="rbHierro"]:checked').val(),
                    esquemaHierro: $('#tbEsquemaHierro').val(),
                    vitamina: $('input:radio[name="rbVitaminaA"]:checked').val(),
                    esquemaVitamina: $('#tbEsquemaVitaminaA').val(),
                    multimicronutrientes: $('input:radio[name="rbMicronutrientes"]:checked').val(),
                    esquemaMultimicronutrientes: $('#tbEsquemaMicronutrientes').val(),
                    fechaMicronutriente: $('#tbFechaMicronutriente').val(),
                    estadoMicronutriente: $('#cbMicronutriente').val(),
                    segimientoDomicilio1: $('#tbFechaVisita1').val(),
                    estadoSeguimiento1: $('#cbFechaVisita1').val(),
                    segimientoDomicilio2: $('#tbFechaVisita2').val(),
                    estadoSeguimiento2: $('#cbFechaVisita2').val(),
                    segimientoDomicilio3: $('#tbFechaVisita3').val(),
                    estadoSeguimiento3: $('#cbFechaVisita3').val()
                }, function(data) {
                    $('#tbIdAdministracionMicronutrientesNino').val(data)
                    alert('Los datos se guardaron correctamente')
                    lista = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                    $('#listaHIS').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminHIS.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                    }).trigger('reloadGrid')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdAdministracionMicronutrientesNino').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            })
            $('#btnGuardarFormulario40').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))
                $.post('/sisfac/funcionesphp/adminPrestacionConsejeria.php', {
                    oper: 'add',
                    idprestacionConsejeria: $('#tbIdPrestacionConsejeria').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val()
                }, function(data) {
                    $('#tbIdPrestacionConsejeria').val(data)
                    alert('Los datos se guardaron correctamente')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdPrestacionConsejeria').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            })

            $('#listaTipoConsejeria').jqGrid({
                url: '/sisfac/funcionesphp/adminDetalleConsejeria.php?f=1&idprestacionConsejeria' + $('#tbIdPrestacionConsejeria').val(),
                datatype: "xml",
                colNames: ['iddetalleConsejeria', 'claveGeneral', 'idprestacionConsejeria', 'idcatalogoConsejeria', 'Tipo consejeria', 'Session', 'Tema'],
                colModel: [{
                    name: 'iddetalleConsejeria',
                    index: 'iddetalleConsejeria',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idprestacionConsejeria',
                    index: 'idprestacionConsejeria',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoConsejeria',
                    index: 'idcatalogoConsejeria',
                    width: 250,
                    editable: true,
                    hidden: true,
                    edittype: 'select',
                    editrules: {
                        edithidden: true
                    },
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminCatalogoConsejeria.php?f=3'
                    }
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 400
                }, {
                    name: 'nroSesion',
                    index: 'nroSesion',
                    width: 100,
                    editable: true
                }, {
                    name: 'tema',
                    index: 'tema',
                    width: 200,
                    editable: true
                }, ],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'iddetalleConsejeria',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminDetalleConsejeria.php',
                pager: '#pagerTipoConsejeria'
            });

            $("#listaTipoConsejeria").jqGrid('navGrid', "#pagerTipoConsejeria", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                onclickSubmit: function(params, postdata) {
                    return {
                        idprestacionConsejeria: $('#tbIdPrestacionConsejeria').val(),
                        idcatalogoConsejeria: $('#tr_idcatalogoConsejeria select').val(),
                        nombreCatalogo: $("#tr_idcatalogoConsejeria select option:selected").html()
                    }
                }
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                beforeSubmit: function(postdata, formid) {
                    id = $('#tbIdPrestacionConsejeria').val()
                    return [id != '', 'Primero debe agregar la consejeria'];
                },
                onclickSubmit: function(params, postdata) {
                    lista = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                    temp = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                    return {
                        idepisodio: lista.idepisodio,
                        idcatalogoPrestacion: temp.idcatalogoPrestacion,
                        idcatalogoEpisodio: lista.idcatalogoEpisodio,
                        codigoCPT: $('#tr_idcatalogoConsejeria select option:selected').attr('cpt'),
                        idprestacionConsejeria: $('#tbIdPrestacionConsejeria').val(),
                        idcatalogoConsejeria: $('#tr_idcatalogoConsejeria select').val(),
                        nombreCatalogo: $("#tr_idcatalogoConsejeria select option:selected").html()
                    }
                },
                afterSubmit: function(response, postdata) {
                        $('#listaHIS').jqGrid('setGridParam', {
                            url: '/sisfac/funcionesphp/adminHIS.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                        }).trigger('reloadGrid')
                        return [true]
                    }
                    //afterSubmit : function(response, postdata) {

                //}
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
            });


            $('#btnGuardarFormulario17').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))
                $.post('/sisfac/funcionesphp/adminEvaluacionDesarrollo.php', {
                    oper: 'add',
                    idevaluacionDesarrollo: $('#tbIdEvaluacionDesarrollo').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    resultado: $('#cbResultadoEvaluacion').val(),
                    observaciones: $('#taObservacionEvaluacion').val()
                }, function(data) {
                    $('#tbIdEvaluacionDesarrollo').val(data)
                    alert('Los datos se guardaron correctamente')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdEvaluacionDesarrollo').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            })
            $('#btnGuardarFormulario20').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminPrestacionExamenIntegral.php', {
                    oper: 'add',
                    idprestacionExamenIntegral: $('#tbIdPrestacionExamenIntegral').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    opcionPiel: $('#cbAlteracionPiel').val(),
                    descripcionPiel: $('#tbDescripcionPiel').val(),
                    opcionCabeza: $('#cbAlteracionCabeza').val(),
                    descripcionCabeza: $('#tbDescripcionCabeza').val(),
                    opcionCabello: $('#cbAlteracionCabello').val(),
                    descripcionCabello: $('#tbDescripcionCabello').val(),
                    opcionOjos: $('#cbAlteracionOjos').val(),
                    descripcionOjoD: $('#tbDescripcionOjoD').val(),
                    descripcionOjoI: $('#tbDescripcionOjoI').val(),
                    opcionOidos: $('#cbAlteracionOidos').val(),
                    descripcionOidoD: $('#tbDescripcionOidoD').val(),
                    descripcionOidoI: $('#tbDescripcionOidoI').val(),
                    opcionNariz: $('#cbAlteracionNariz').val(),
                    descripcionNariz: $('#tbDescripcionNariz').val(),
                    opcionBoca: $('#cbAlteracionBoca').val(),
                    descripcionBoca: $('#tbDescripcionBoca').val(),
                    opcionOrofaringe: $('#cbAlteracionOrofaringe').val(),
                    descripcionOrofaringe: $('#tbDescripcionOrofaringe').val(),
                    opcionCuello: $('#cbAlteracionCuello').val(),
                    descripcionCuello: $('#tbDescripcionCuello').val(),
                    opcionRespiratorio: $('#cbAlteracionRespiratorio').val(),
                    descripcionRespiratorio: $('#tbDescripcionRespiratorio').val(),
                    opcionCardiovascular: $('#cbAlteracionCardiovascular').val(),
                    descripcionCardiovascular: $('#tbDescripcionCardiovascular').val(),
                    opcionDigestivo: $('#cbAlteracionDigestivo').val(),
                    descripcionDigestivo: $('#tbDescripcionDigestivo').val(),
                    opcionGenitourinario: $('#cbAlteracionGenitourinario').val(),
                    descripcionGenitourinario: $('#tbDescripcionGenitourinario').val(),
                    opcionLocomotor: $('#cbAlteracionLocomotor').val(),
                    descripcionLocomotor: $('#tbDescripcionLocomotor').val(),
                    opcionMarcha: $('#cbAlteracionMarcha').val(),
                    descripcionMarcha: $('#tbDescripcionMarcha').val(),
                    opcionColumna: $('#cbAlteracionColumna').val(),
                    descripcionColumna: $('#tbDescripcionColumna').val(),
                    opcionSuperior: $('#cbAlteracionSuperior').val(),
                    descripcionSuperior: $('#tbDescripcionSuperior').val(),
                    opcionInferior: $('#cbAlteracionInferior').val(),
                    descripcionInferior: $('#tbDescripcionInferior').val(),
                    opcionLinfatico: $('#cbAlteracionLinfatico').val(),
                    descripcionLinfatico: $('#tbDescripcionLinfatico').val()
                }, function(data) {
                    $('#tbIdPrestacionExamenIntegral').val(data)
                    alert('Los datos se guardaron correctamente')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdPrestacionExamenIntegral').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            })

            $('#btnGuardarFormulario38').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminPrestacionAiepi.php', {
                    oper: 'add',
                    idprestacionAiepi: $('#tbIdPrestacionAiepi').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    infeccionBacteriana: $('input:radio[name="rbInfeccion"]:checked').val(),
                    respiracionesPorMinuto: $('#tbRespiracionMinuto').val(),
                    respiracionRapida: $('input:radio[name="rbRespiracionRapida"]:checked').val(),
                    tirajeSubcostal: $('input:radio[name="rbTirajeSubcostal"]:checked').val(),
                    aleteoNasal: $('input:radio[name="rbAleteoNasal"]:checked').val(),
                    quejido: $('input:radio[name="rbQuejido"]:checked').val(),
                    estadoFontanela: $('#tbEstadoFontanela').val(),
                    supuracionOido: $('input:radio[name="rbSupuracion"]:checked').val(),
                    estadoOmbligo: $('input:radio[name="rbOmbligo"]:checked').val(),
                    temperatura: $('input:radio[name="rbTemperatura"]:checked').val(),
                    pielPustulas: $('input:radio[name="rbPielPustulas"]:checked').val(),
                    letargio: $('input:radio[name="rbInconsciente"]:checked').val(),
                    movimientoAnormal: $('input:radio[name="rbMueveMenos"]:checked').val(),
                    secrecionOjos: $('input:radio[name="rbSecrecion"]:checked').val(),
                    diarrea: $('input:radio[name="rbDiarrea"]:checked').val(),
                    tiempoDiarrea: $('#tbTiempoDiarrea').val(),
                    sangreHeces: $('input:radio[name="rbSangreHeces"]:checked').val(),
                    estadoGeneral: $('input:radio[name="rbEstadoGeneral"]:checked').val(),
                    ojosHundidos: $('input:radio[name="rbOjosHundidos"]:checked').val(),
                    signoCutaneo: $('input:radio[name="rbSignoCutaneo"]:checked').val()
                }, function(data) {
                    $('#tbIdPrestacionAiepi').val(data)
                    alert('Los datos se guardaron correctamente')
                })
            }).width(100).height(50)

            $('#btnGuardarFormulario39').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminPrestacionEvaluacionNino.php', {
                    oper: 'add',
                    idprestacionEvaluacionNino: $('#tbIdPrestacionEvaluacionNino').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    signosPeligro: $('input:radio[name="rbSignoPeligro"]:checked').val(),
                    remedioRecibidos: $('#taAutodiagnostico').val(),
                    opTos: $('input:radio[name="rbTieneTos"]:checked').val(),
                    diasTiempoTos: $('#tbTiempoTos').val(),
                    supuracionOido: $('input:radio[name="rbDolorOido"]:checked').val(),
                    diasSupuracion: $('#tbTiempoOido').val(),
                    tumefaccionOreja: $('input:radio[name="rbTumefacion"]:checked').val(),
                    dolorGarganta: $('input:radio[name="rbGarganta"]:checked').val(),
                    exudado: $('input:radio[name="rbEnrojecimiento"]:checked').val(),
                    gangliosDolorosos: $('input:radio[name="rbGanglios"]:checked').val(),
                    diarrea: $('input:radio[name="rbDiarreaNino"]:checked').val(),
                    tiempoDiarrea: $('#tbTiempoDiarreaNino').val(),
                    estadoGeneral: $('#taEstadoGeneral').val(),
                    sangreHeces: $('input:radio[name="rbSangreHecesNino"]:checked').val(),
                    ojosHundidos: $('input:radio[name="rbOjosHundidosNino"]:checked').val(),
                    signosPliegue: $('input:radio[name="rbSignoPliegue"]:checked').val(),
                    fiebre: $('input:radio[name="rbFiebre"]:checked').val(),
                    riesgoMalaria: $('input:radio[name="rbMalaria"]:checked').val(),
                    observaciones: $('#taObservacion').val()
                }, function(data) {
                    $('#tbIdPrestacionEvaluacionNino').val(data)
                    alert('Los datos se guardaron correctamente')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdPrestacionEvaluacionNino').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            }).width(100).height(50)



            $('#btnGuardarFormulario13').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminPrestacionEvaluacionLME.php', {
                    oper: 'add',
                    idprestacionEvaluacionLME: $('#tbIdPrestacionEvaluacionLME').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    lactanciaLM: $('input:radio[name="rbNinoLactancia"]:checked').val(),
                    tecnicaLM: $('input:radio[name="rbTecnicaLM"]:checked').val(),
                    frecuenciaLM: $('input:radio[name="rbFrecuenciaLM"]:checked').val(),
                    lecheNoMaterna: $('input:radio[name="rbNinoLeche"]:checked').val(),
                    recibeAguitas: $('input:radio[name="rbNinoAguitas"]:checked').val(),
                    otroAlimento: $('input:radio[name="rbNinoAlimento"]:checked').val(),
                    consistenciaAdecuada: $('input:radio[name="rbPreparacion"]:checked').val(),
                    cantidadAdecuada: $('input:radio[name="rbCantidadAlimento"]:checked').val(),
                    frecuenciaAdecuada: $('input:radio[name="rbFrecuenciaAlimentacion"]:checked').val(),
                    consumoAlimentosAnimal: $('input:radio[name="rbAlimentoAnimal"]:checked').val(),
                    consumoFrutasVerduras: $('input:radio[name="rbFruta"]:checked').val(),
                    consumoMantequilla: $('input:radio[name="rbAceite"]:checked').val(),
                    alimentosEnPlato: $('input:radio[name="rbAlimentoPropio"]:checked').val(),
                    usaSalYodada: $('input:radio[name="rbSal"]:checked').val(),
                    tomaSuplementoHierro: $('input:radio[name="rbSuplementoHierro"]:checked').val(),
                    tomaSuplementoVitamina: $('input:radio[name="rbSuplementoVitamina"]:checked').val(),
                    recibeMicronutrientes: $('input:radio[name="rbMultimicronutiente"]:checked').val(),
                    opcionBeneficiarioPrograma: $('input:radio[name="rbApoyoSocial"]:checked').val(),
                    descripcionPrograma: $('#tbApoyoSocial').val()
                }, function(data) {
                    $('#tbIdPrestacionEvaluacionLME').val(data)
                    alert('Los datos se guardaron correctamente')
                })
                temp = $('#listaEpisodio').jqGrid('getRowData', $('#listaEpisodio').jqGrid('getGridParam', 'selrow'))
                if ($('#tbIdPrestacionEvaluacionLME').val() == '') $.post('/sisfac/funcionesphp/adminProcedimiento.php', {
                    f: 2,
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoEpisodio: temp.idcatalogoEpisodio
                }, function(data) {})
            }).width(100).height(50)


            $('#btnGuardarFormulario14').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                lista = $('#listaPrestacion').jqGrid('getRowData', $('#listaPrestacion').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminPrestacionAlimentacionRN.php', {
                    oper: 'add',
                    idprestacionAlimentacionRN: $('#tbIdPrestacionAlimentacionRN').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                    idcatalogoPrestacion: obtenerIdsPrestacion(),
                    idcatalogoUPS: $('#tbIdUPSPrestacion').val(),
                    nombreCatalogo: $('#tbUPSPrestacion').val(),
                    fechaInicio: $('#tbFechaInicioPrestacion').val(),
                    fechaFin: $('#tbFechaFinPrestacion').val(),
                    estado: $('#cbEstadoPrestacion').val(),
                    tomaPecho: $('input:radio[name="rbTomaPecho"]:checked').val(),
                    nroVecesPecho: $('#tbTiempoPecho').val(),
                    opcomidas: $('input:radio[name="rbComida"]:checked').val(),
                    cualesComidas: $('#tbComida').val(),
                    cambioDuranteEnfermedad: $('input:radio[name="rbCambioEnfermedad"]:checked').val(),
                    cualesEnfermedades: $('#tbCambioEnfermedad').val(),
                    ulcerasBocaBajoPeso: $('input:radio[name="rbUlceras"]:checked').val(),
                    alimentacionUltimaHora: $('input:radio[name="rbAlimentoPecho"]:checked').val(),
                    opAmarre: $('input:radio[name="rbAmarre"]:checked').val(),
                    mamaCorrecto: $('input:radio[name="rbMamaBien"]:checked').val(),
                    ulcerasBoca: $('input:radio[name="rbUlcerasPlaca"]:checked').val(),
                    buenaPosicion: $('input:radio[name="rbLactancia"]:checked').val(),
                    observaciones: $('#taObservacionAlimentacion').val()
                }, function(data) {
                    $('#tbIdPrestacionAlimentacionRN').val(data)
                    alert('Los datos se guardaron correctamente')
                })
            }).width(100).height(50)



            /*$('#btnGuardarFormulario39').button({icons: {primary: "ui-icon-disk"}}).click(function(){
                lista = $('#listaPrestacion').jqGrid('getRowData',$('#listaPrestacion').jqGrid('getGridParam','selrow'))
                
                $.post('/sisfac/funcionesphp/.php', {
                    oper:'add',
                    id:$('#').val(),
                    idepisodio:$('#listaEpisodio').jqGrid('getGridParam','selrow'),
                    idpersona:$('#listaBusqueda').jqGrid('getGridParam','selrow'),
                    idcatalogoPrestacion:obtenerIdsPrestacion(), 
                    idcatalogoUPS:$('#tbIdUPSPrestacion').val(), 
                    nombreCatalogo:$('#tbUPSPrestacion').val(), 
                    fechaInicio:$('#tbFechaInicioPrestacion').val(), 
                    fechaFin:$('#tbFechaFinPrestacion').val(), 
                    estado:$('#cbEstadoPrestacion').val()
                }, function(data){
                    $('#').val(data)
                    alert('Los datos se guardaron correctamente')
                })
            }).width(100).height(50)*/


        }

        function cuartoTabClinica() {

            $('#listaVariableAntropometrica').jqGrid({
                url: '/sisfac/funcionesphp/adminVariableAntropometrica.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml", //idvariableAntropometrica, peso, talla, IMC, perimetroCefalico, perimetroToracico, frecuenciaCardiaca, frecuenciaRespiratoria, temperatura, presionArterialNum, presionArterialDenom, presionArterialMediaNum, presionArterialMediaDenom, perimetroAbdominal, pesoPregestacional, FUR, FPP, presionArterialBasalNum, presionArterialBasalDenom, factorRiesgo
                colNames: ['idvariableAntropometrica', 'Fecha', 'Peso(gr.)', 'Talla(cm.)', 'IMC', 'Per&iacute;metro cef&aacute;lico(cm.)', 'Per&iacute;metro tor&aacute;cico(cm.)', 'Frecuencia cardiaca(lt/min.)', 'Frecuencia respiratoria(R/min)', 'Temperatura(°C)', 'Presion arterial num.', 'Presion arterial den.', 'Presion arterial media num.', 'Presion arterial media den.', 'Per&iacute;metro abdominal', 'Peso pregestacional', 'FUR', 'FPP', 'Presion arterial basal num.', 'Presion arterial den.', 'Factor riesgo'],
                colModel: [{
                    name: 'idvariableAntropometrica',
                    index: 'idvariableAntropometrica',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'fechaInicio',
                    index: 'fechaInicio',
                    width: 100,
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    }
                }, {
                    name: 'peso',
                    index: 'peso',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'talla',
                    index: 'talla',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'IMC',
                    index: 'IMC',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'perimetroCefalico',
                    index: 'perimetroCefalico',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'perimetroToracico',
                    index: 'perimetroToracico',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'frecuenciaCardiaca',
                    index: 'frecuenciaCardiaca',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'frecuenciaRespiratoria',
                    index: 'frecuenciaRespiratoria',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'temperatura',
                    index: 'temperatura',
                    width: 100,
                    editable: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'presionArterialNum',
                    index: 'presionArterialNum',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'presionArterialDenom',
                    index: 'presionArterialDenom',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'presionArterialMediaNum',
                    index: 'presionArterialMediaNum',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'presionArterialMediaDenom',
                    index: 'presionArterialMediaDenom',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'perimetroAbdominal',
                    index: 'perimetroAbdominal',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'pesoPregestacional',
                    index: 'pesoPregestacional',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'FUR',
                    index: 'FUR',
                    width: 100,
                    editable: true,
                    hidden: true,
                    //editrules:{date:true},
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'FPP',
                    index: 'FPP',
                    width: 100,
                    editable: true,
                    hidden: true,
                    //editrules:{date:true},
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    hidden: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'presionArterialBasalNum',
                    index: 'presionArterialBasalNum',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'presionArterialBasalDenom',
                    index: 'presionArterialBasalDenom',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }, {
                    name: 'factorRiesgo',
                    index: 'factorRiesgo',
                    width: 100,
                    editable: true,
                    hidden: true,
                    editrules: {
                        number: true
                    }
                }],
                height: 200,
                width: 1000,
                rowNum: 100,
                rownumbers: true,
                sortname: 'idvariableAntropometrica',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                shrinkToFit: false,
                //caption: "Diagn&oacute;stico",
                editurl: '/sisfac/funcionesphp/adminVariableAntropometrica.php',
                pager: '#pagerVariableAntropometrica'
            });
            $("#listaVariableAntropometrica").jqGrid('navGrid', "#pagerVariableAntropometrica", {
                edit: true,
                add: true,
                del: true
            }, {
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                    return {
                        idepisodio: id
                    }
                }
            });


        }

        function quintoTabClinica() {
            $('#listaVacunaPersona').jqGrid({
                url: '/sisfac/funcionesphp/adminVacuna.php?f=1&idpersona=' + $('#listaBusqueda').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idvacuna', 'claveGeneral', 'idpersona', 'Vacuna', 'Vacuna', 'Dosis', 'Estado'],
                colModel: [{
                    name: 'idvacuna',
                    index: 'idvacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idpersona',
                    index: 'idpersona',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoVacuna',
                    index: 'idcatalogoVacuna',
                    width: 100,
                    editable: true,
                    hidden: true,
                    edittype: 'select',
                    editrules: {
                        edithidden: true
                    },
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminCatalogoVacuna.php?f=3'
                    }
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 500
                }, {
                    name: 'dosis',
                    index: 'dosis',
                    width: 100
                }, {
                    name: 'estadoVacuna',
                    index: 'estadoVacuna',
                    width: 100,
                    hidden: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'INCOMPLETA:INCOMPLETA;COMPLETA:COMPLETA'
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idvacuna',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminVacuna.php',
                pager: '#pagerVacunaPersona',
                onSelectRow: function(rowid, status) {
                    $('#listaDetalleVacuna').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDetalleVacuna.php?f=1&idvacuna=' + rowid
                    }).trigger('reloadGrid')
                }
            });

            $("#listaVacunaPersona").jqGrid('navGrid', "#pagerVacunaPersona", {
                edit: false,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                beforeShowForm: function(formid) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    $('#tr_idcatalogoVacuna select').load('/sisfac/funcionesphp/adminCatalogoVacuna.php', {
                        f: 4,
                        dias: lista.dias
                    }, function() {
                        temp = $('#listaVacunaPersona').jqGrid('getRowData', $('#listaVacunaPersona').jqGrid('getGridParam', 'selrow'))
                            //alert(temp.idcatalogoVacuna)
                        $('#tr_idcatalogoVacuna select').val(temp.idcatalogoVacuna)
                    })
                },
                onclickSubmit: function(params, postdata) {
                    return {
                        idcatalogoVacuna: $('#tr_idcatalogoVacuna select').val(),
                        nombreCatalogo: $("#tr_idcatalogoVacuna select option:selected").html()
                    }
                }
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                beforeShowForm: function(formid) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    $('#tr_idcatalogoVacuna select').load('/sisfac/funcionesphp/adminCatalogoVacuna.php', {
                        f: 4,
                        dias: lista.dias,
                        idpersona: $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    }, function() {})
                },
                onclickSubmit: function(params, postdata) {
                    id = $('#listaBusqueda').jqGrid('getGridParam', 'selrow')
                    lista = $('#listaBusqueda').jqGrid('getRowData', id)
                    return {
                        idpersona: id,
                        dias: lista.dias,
                        estadoVacuna: 'INCOMPLETA',
                        fechaNacimiento: lista.fechaNacimiento,
                        idcatalogoVacuna: $('#tr_idcatalogoVacuna select').val(),
                        nombreCatalogo: $("#tr_idcatalogoVacuna select option:selected").html()
                    }
                },
                beforeSubmit: function(postdata, formid) {
                    id = $('#idcatalogoVacuna').val()
                    return [id != '', 'Debe seleccionar un catalogo'];
                },
                afterSubmit: function(response, postdata) {
                    alert('Los datos se guardaron correctamente')
                    $('#listaVacunaPersona').jqGrid('setSelection', response.responseText)
                    return [true]
                }



            });

            $('#listaDetalleVacuna').jqGrid({
                url: '/sisfac/funcionesphp/adminDetalleVacuna.php?f=1&idvacuna=0',
                datatype: "xml",
                colNames: ['iddetalleVacuna', 'claveGeneral', 'idvacuna', 'Nro. dosis', '', 'Tipo Programaci&oacute;n', 'Fecha programada', 'Fecha aplicaci&oacute;n', 'Estado dosis', 'Lugar de aplicaci&oacute;n', 'Observaciones'],
                colModel: [{
                    name: 'iddetalleVacuna',
                    index: 'iddetalleVacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idvacuna',
                    index: 'idvacuna',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nroDosis',
                    index: 'nroDosis',
                    width: 100,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).attr('disabled', 'disabled')
                        }
                    }
                }, {
                    name: 'opProgramacion',
                    index: 'opProgramacion',
                    width: 200,
                    hidden: true
                }, {
                    name: 'tipoProgramacion',
                    index: 'tipoProgramacion',
                    width: 150,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'MANUAL:MANUAL;AUTOMATICA:AUTOMATICA',
                        dataInit: function(el) {
                            $(el).change(function() {
                                if ($(el).val() == 'MANUAL') $('#fechaProgramada').val('')
                                else {
                                    lista = $('#listaVacunaPersona').jqGrid('getRowData', $('#listaVacunaPersona').jqGrid('getGridParam', 'selrow'))
                                    lista1 = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
                                    $.post('/sisfac/funcionesphp/adminVacuna.php', {
                                        f: 5,
                                        idvacuna: $('#listaVacunaPersona').jqGrid('getGridParam', 'selrow'),
                                        nroDosis: $('#nroDosis').val(),
                                        idcatalogoVacuna: lista.idcatalogoVacuna,
                                        fechaNacimiento: lista1.fechaNacimiento
                                    }, function(data) {
                                        $('#fechaProgramada').val(data)
                                    })
                                }
                            })
                        }
                    }
                }, {
                    name: 'fechaProgramada',
                    index: 'fechaProgramada',
                    width: 150,
                    editable: true,
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'fechaAplicacion',
                    index: 'fechaAplicacion',
                    width: 150,
                    editable: true,
                    formatter: 'date',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).mask('99/99/9999')
                        }
                    }
                }, {
                    name: 'estadoDosis',
                    index: 'estadoDosis',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'SIN PLANIFICAR:SIN PLANIFICAR;PLANIFICADA:PLANIFICADA;EJECUTADA:EJECUTADA'
                    }
                }, {
                    name: 'lugarAplicacion',
                    index: 'lugarAplicacion',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'DOMICILIO:DOMICILO;ESTABLECIMIENTO DE SALUD:ESTABLECIMIENTO DE SALUD;FUERA:FUERA'
                    }
                }, {
                    name: 'observaciones',
                    index: 'observaciones',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 4,
                        cols: 20
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'dva.iddetalleVacuna',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminDetalleVacuna.php',
                pager: '#pagerDetalleVacuna'
            });

            $("#listaDetalleVacuna").jqGrid('navGrid', "#pagerDetalleVacuna", {
                edit: true,
                add: false,
                del: false
            }, {
                //width:500,
                reloadAfterEdit: true,
                closeAfterEdit: true,
                beforeShowForm: function(formid) {
                    lista = $('#listaDetalleVacuna').jqGrid('getRowData', $('#listaDetalleVacuna').jqGrid('getGridParam', 'selrow'))
                    if (lista.opProgramacion == 'NO') $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option>")
                    else {
                        if (lista.tipoProgramacion == 'AUTOMATICA') $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option><option value='AUTOMATICA' selected>AUTOMATICA</option>")
                        else $('#tipoProgramacion').html("<option value='MANUAL'>MANUAL</option><option value='AUTOMATICA'>AUTOMATICA</option>")
                    }
                }
            }, {
                //width:500,
                reloadAfterAdd: true,
                closeAfterAdd: true
            });


        }

        function sextoTabClinica() {

            $('#listaDiagnostico').jqGrid({
                url: '/sisfac/funcionesphp/adminDiagnostico.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['iddiagnostico', 'CIE 10', 'CIE 10', 'Variable lab.', 'Observaci&oacute;n', 'Establecimiento', 'Servicio', 'Tipo diagn&oacute;stico', 'Referencia'],
                colModel: [ // iddiagnostico, idcatalogoCIE10, nombreCatalogo, variableLab, observacion, opcionPacienteEst, opcionPacienteServ, tipo, opReferencia
                    {
                        name: 'iddiagnostico',
                        index: 'iddiagnostico',
                        width: 200,
                        editable: true,
                        hidden: true
                    }, {
                        name: 'idcatalogoCIE10',
                        index: 'idcatalogoCIE10',
                        width: 200,
                        editable: true,
                        hidden: true
                    }, {
                        name: 'nombreCatalogo',
                        index: 'nombreCatalogo',
                        width: 350,
                        editable: true,
                        editoptions: {
                            dataInit: function(el) {
                                $(el).autocomplete({
                                    source: "/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11",
                                    minLength: 1,
                                    focus: function(event, ui) {
                                        $(el).val(ui.item.label)
                                        $('#idcatalogoCIE10').val(ui.item.value)
                                        return false
                                    },
                                    select: function(event, ui) {
                                        $(el).val(ui.item.label)
                                        $('#idcatalogoCIE10').val(ui.item.value)
                                        return false
                                    }
                                }).width(400)
                            }
                        }
                    }, {
                        name: 'variableLab',
                        index: 'variableLab',
                        width: 100,
                        hidden: true
                    }, {
                        name: 'observacion',
                        index: 'observacion',
                        width: 200,
                        editable: true,
                        edittype: 'textarea',
                        editoptions: {
                            rows: 3,
                            cols: 60
                        }
                    }, {
                        name: 'opcionPacienteEst',
                        index: 'opcionPacienteEst',
                        width: 100,
                        editable: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                        }
                    }, {
                        name: 'opcionPacienteServ',
                        index: 'opcionPacienteServ',
                        width: 100,
                        editable: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                        }
                    }, {
                        name: 'tipo',
                        index: 'tipo',
                        width: 80,
                        editable: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'PRESUNTIVO:PRESUNTIVO;DEFINITIVO:DEFINITIVO;REPETITIVO:REPETITIVO'
                        }
                    }, {
                        name: 'opReferencia',
                        index: 'opReferencia',
                        width: 70,
                        editable: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'SI:SI;NO:NO'
                        }
                    }
                ],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'iddiagnostico',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminDiagnostico.php',
                pager: '#pagerDiagnostico'
            });

            $("#listaDiagnostico").jqGrid('navGrid', "#pagerDiagnostico", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 600,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 600,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                    return {
                        idepisodio: id
                    }
                },
                beforeSubmit: function(postdata, formid) {
                    id = $('#idcatalogoCIE10').val()
                    return [id != '', 'Debe seleccionar un catalogo CIE10'];
                }
            });

            $('#listaTratamientoMedicamentos').jqGrid({
                url: '/sisfac/funcionesphp/adminTratamientoResolutivo.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idtratamientoResolutivo', 'SISMED', 'SISMED', 'Nombre', 'Dosis', 'Via', 'Frecuencia', 'Nro. d&iacute;as'],
                colModel: [{
                    name: 'idtratamientoResolutivo',
                    index: 'idtratamientoResolutivo',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoMedicamento',
                    index: 'idcatalogoMedicamento',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 200,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).attr('placeholder', 'Cod. - Med-Cod. - ATC-Descripcion. / Concentracion')
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoMedicamento.php?f=2&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoMedicamento').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoMedicamento').val(ui.item.value)
                                    return false
                                }
                            }).width(300)
                        }
                    }
                }, {
                    name: 'medicamento',
                    index: 'medicamento',
                    width: 100,
                    hidden: true
                }, {
                    name: 'dosis',
                    index: 'dosis',
                    width: 100,
                    editable: true
                }, {
                    name: 'via',
                    index: 'via',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'ENDOVENOSO:ENDOVENOSO;INTRAMUSCULAR:INTRAMUSCULAR;VIA ORAL:VIA ORAL;SUBLINGUAL:SUBLINGUAL'
                    }
                }, {
                    name: 'frecuencia',
                    index: 'frecuencia',
                    width: 100,
                    editable: true
                }, {
                    name: 'nroDias',
                    index: 'nroDias',
                    width: 100,
                    editable: true
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idtratamientoResolutivo',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Medicamentos",
                editurl: '/sisfac/funcionesphp/adminTratamientoResolutivo.php',
                pager: '#pagerTratamientoMedicamentos'
            });

            $("#listaTratamientoMedicamentos").jqGrid('navGrid', "#pagerTratamientoMedicamentos", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 400,
                modal: true,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 400,
                modal: true,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                        id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                        return {
                            idepisodio: id
                        }
                    }
                    /*,
                                    beforeSubmit : function(postdata, formid) {  
                                        id = $('#idcatalogoCIE10').val()
                                        return [id!='','Debe seleccionar un catalogo CIE10'];
                                    }*/
            });

            $('#btnGuardarPlanta').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminPlantaMedicinal.php', {
                    oper: 'add',
                    idplantaMedicinal: $('#taIdPlanta').val(),
                    planta: $('#taPlanta').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    $('#taIdPlanta').val(data)
                    alert('Se guardaron correctamente los datos')
                })
            })


            $('#listaTratamientoProcedimientos').jqGrid({
                url: '/sisfac/funcionesphp/adminProcedimiento.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['id', 'C&oacute;digo CPT', 'C&oacute;digo CPT', 'Nombre', 'Frecuencia', 'Observaciones'],
                colModel: [{
                    name: 'idprocedimiento',
                    index: 'idprocedimiento',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoCPT',
                    index: 'idcatalogoCPT',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 400,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoCPT.php?f=2&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCPT').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoCPT').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 200,
                    hidden: true
                }, {
                    name: 'frecuencia',
                    index: 'frecuencia',
                    width: 100,
                    editable: true
                }, {
                    name: 'observacion',
                    index: 'observacion',
                    width: 200,
                    editable: true,
                    edittype: 'textarea',
                    editoptions: {
                        rows: 4,
                        cols: 60
                    }
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idprocedimiento',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Procedimientos",
                editurl: '/sisfac/funcionesphp/adminProcedimiento.php',
                pager: '#pagerTratamientoProcedimientos'
            });

            $("#listaTratamientoProcedimientos").jqGrid('navGrid', "#pagerTratamientoProcedimientos", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                        id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                        return {
                            idepisodio: id
                        }
                    }
                    /*,
                                    beforeSubmit : function(postdata, formid) {  
                                        id = $('#idcatalogoCPT').val()
                                        return [id!='','Debe seleccionar un catalogo CPT'];
                                    }*/
            });

            $('#listaTratamientoPreventivo').jqGrid({
                url: '/sisfac/funcionesphp/adminTratamientoPreventivo.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idtratamientoPreventivo', 'Tratamiento', 'Nombre', 'Dosis', 'V&iacute;a', 'Frecuencia', 'Nro. d&iacute;as'],
                colModel: [{
                    name: 'idtratamientoPreventivo',
                    index: 'idtratamientoPreventivo',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'tratamiento',
                    index: 'tratamiento',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'MICRONUTRIENTES:MICRONUTRIENTES;SALUD BUCAL:SALUD BUCAL;ANTIPARASITARIO:ANTIPARASITARIO'
                    }
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 200,
                    editable: true
                }, {
                    name: 'dosis',
                    index: 'dosis',
                    width: 200,
                    editable: true
                }, {
                    name: 'via',
                    index: 'via',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'ENDOVENOSO:ENDOVENOSO;INTRAMUSCULAR:INTRAMUSCULAR;VIA ORAL:VIA ORAL;SUBLINGUAL:SUBLINGUAL'
                    }
                }, {
                    name: 'frecuencia',
                    index: 'frecuencia',
                    width: 100,
                    editable: true
                }, {
                    name: 'nroDias',
                    index: 'nroDias',
                    width: 100,
                    editable: true
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idtratamientoPreventivo',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminTratamientoPreventivo.php',
                pager: '#pagerTratamientoPreventivo'
            });

            $("#listaTratamientoPreventivo").jqGrid('navGrid', "#pagerTratamientoPreventivo", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 300,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 300,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                    return {
                        idepisodio: id
                    }
                }
            });




            $('#listaTratamientoInsumos').jqGrid({
                url: '/sisfac/funcionesphp/adminInsumos.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['id', 'Insumo', 'Insumos', 'Cantidad'],
                colModel: [{
                    name: 'idinsumos',
                    index: 'idinsumos',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoInsumo',
                    index: 'idcatalogoInsumo',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 500,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoInsumo.php?f=2&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoInsumo').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoInsumo').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'cantidad',
                    index: 'cantidad',
                    width: 200,
                    editable: true
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idinsumos',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Insumos",
                editurl: '/sisfac/funcionesphp/adminInsumos.php',
                pager: '#pagerTratamientoInsumos'
            });

            $("#listaTratamientoInsumos").jqGrid('navGrid', "#pagerTratamientoInsumos", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                        id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                        return {
                            idepisodio: id
                        }
                    }
                    /*,
                                    beforeSubmit : function(postdata, formid) {  
                                        id = $('#idcatalogoMedicamento').val()
                                        return [id!='','Debe seleccionar un catalogo medicamento'];
                                    }*/
            });



        }

        function septimoTabClinica() {
            $('#listaConsejeria').jqGrid({
                url: '/sisfac/funcionesphp/adminConsejeria.php?f=1',
                datatype: "xml",
                colNames: ['id', 'Tipo consejer&iacute;a', 'Nro. sesi&oacute;n', 'Tema'],
                colModel: [{
                    name: 'idconsejeria',
                    index: 'idconsejeria',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'consejeria',
                    index: 'consejeria',
                    width: 300,
                    editable: true,
                    edittype: 'select',
                    editoptions: {
                        value: 'SALUD SEXUAL Y REPRODUCTIVA:SALUD SEXUAL Y REPRODUCTIVA;CONSEJERIA INTEGRAL:CONSEJERIA INTEGRAL;CONSEJERIA NUTRICIONAL:CONSEJERIA NUTRICIONAL;OTROS:OTROS'
                    }
                }, {
                    name: 'nroSesion',
                    index: 'nroSesion',
                    width: 200,
                    editable: true
                }, {
                    name: 'tema',
                    index: 'tema',
                    width: 200,
                    editable: true
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idconsejeria',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Consejer&iacute;a",
                editurl: '/sisfac/funcionesphp/adminConsejeria.php',
                pager: '#pagerConsejeria'
            });

            $("#listaConsejeria").jqGrid('navGrid', "#pagerConsejeria", {
                edit: true,
                add: true,
                del: true
            }, {

                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {

                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                    return {
                        idepisodio: id
                    }
                }
            });


            $('#listaInterconsulta').jqGrid({
                url: '/sisfac/funcionesphp/adminInterconsulta.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idinterconsulta', 'Cat&aacute;logo UPS', 'Cat&aacute;logo UPS', 'Motivo'],
                colModel: [{
                    name: 'idinterconsulta',
                    index: 'idinterconsulta',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'idcatalogoUPS',
                    index: 'idcatalogoUPS',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 500,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoUPS.php?f=2&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoUPS').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogoUPS').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'motivoInterconsulta',
                    index: 'motivoInterconsulta',
                    width: 200,
                    editable: true
                }],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idinterconsulta',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Consejer&iacute;a",
                editurl: '/sisfac/funcionesphp/adminInterconsulta.php',
                pager: '#pagerInterconsulta'
            });

            $("#listaInterconsulta").jqGrid('navGrid', "#pagerInterconsulta", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 500,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 500,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                        id = $('#listaEpisodio').jqGrid('getGridParam', 'selrow')
                        return {
                            idepisodio: id
                        }
                    }
                    /*,
                                    beforeSubmit : function(postdata, formid) {  
                                        id = $('#idcatalogoUPS').val()
                                        return [id!='','Debe seleccionar un catalogo UPS'];
                                    }*/
            });

            $('#tbReferenciaEstablecimiento,#tbEstablecimientoUPS,#tbPersonalRecepcion,#tbDiagnosticoReingreso1,#tbDiagnosticoReingreso2,#tbDiagnosticoReingreso3').width(300)
            $('#cbResponsableReferencia,#cbResponsableEstablecimiento,#cbPersonalAcompanante,#cbProfesionRecepcion,#cbCondicionPacienteRecepcion').width(200)
            hacerAutocompletar('tbReferenciaEstablecimiento', 'tbIdReferenciaEstablecimiento', 'adminEstablecimiento.php?f=6')
            hacerAutocompletar('tbEstablecimientoUPS', 'tbIdEstablecimientoUPS', 'adminCatalogoUPS.php?f=2')
                //hacerAutocompletar('tbEstablecimientoReferencia', 'tbIdEstablecimientoReferencia', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbDiagnosticoReingreso1', 'tbIdDiagnosticoReingreso1', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbDiagnosticoReingreso2', 'tbIdDiagnosticoReingreso2', 'adminCatalogoCIE10.php?f=1')
            hacerAutocompletar('tbDiagnosticoReingreso3', 'tbIdDiagnosticoReingreso3', 'adminCatalogoCIE10.php?f=1')

            $('#tbFechaReferencia,#tbFechaRecepcion,#tbFechaReingreso').mask('99/99/9999').width(70)
            $('#cbResponsableReferencia').load('/sisfac/funcionesphp/adminTrabajador.php', {
                f: 3
            }, function(data) {})
            $('#cbResponsableEstablecimiento').load('/sisfac/funcionesphp/adminTrabajador.php', {
                f: 3
            }, function(data) {})
            $('#cbPersonalAcompanante').load('/sisfac/funcionesphp/adminTrabajador.php', {
                f: 3
            }, function(data) {})
            $('#cbProfesionRecepcion').load('/sisfac/funcionesphp/adminProfesion.php', {
                f: 3
            }, function(data) {})


            $('#listaReferencia').jqGrid({
                url: '/sisfac/funcionesphp/adminDiagnostico.php?f=1&opReferencia=SI&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['iddiagnostico', 'CIE 10', 'Diagn&oacute;stico', 'Variable lab.', 'Observaci&oacute;n', 'Establecimiento', 'Servicio', 'Tipo diagn&oacute;stico', 'Referencia'],
                colModel: [ // iddiagnostico, idcatalogoCIE10, nombreCatalogo, variableLab, observacion, opcionPacienteEst, opcionPacienteServ, tipo, opReferencia
                    {
                        name: 'iddiagnostico',
                        index: 'iddiagnostico',
                        width: 200,
                        editable: true,
                        hidden: true
                    }, {
                        name: 'idcatalogoCIE10',
                        index: 'idcatalogoCIE10',
                        width: 200,
                        editable: true,
                        hidden: true
                    }, {
                        name: 'nombreCatalogo',
                        index: 'nombreCatalogo',
                        width: 450
                    }, {
                        name: 'variableLab',
                        index: 'variableLab',
                        width: 100,
                        hidden: true
                    }, {
                        name: 'observacion',
                        index: 'observacion',
                        width: 300,
                        hidden: true,
                        edittype: 'textarea'
                    }, {
                        name: 'opcionPacienteEst',
                        index: 'opcionPacienteEst',
                        width: 100,
                        hidden: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                        }
                    }, {
                        name: 'opcionPacienteServ',
                        index: 'opcionPacienteServ',
                        width: 100,
                        hidden: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                        }
                    }, {
                        name: 'tipo',
                        index: 'tipo',
                        width: 80,
                        hidden: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'PRESUNTIVO:PRESUNTIVO;DEFINITIVO:DEFINITIVO;REPETITIVO:REPETITIVO'
                        }
                    }, {
                        name: 'opReferencia',
                        index: 'opReferencia',
                        width: 70,
                        hidden: true,
                        edittype: 'select',
                        editoptions: {
                            value: 'SI:SI;NO:NO'
                        }
                    }
                ],
                height: 80,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'iddiagnostico',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                editurl: '/sisfac/funcionesphp/adminDiagnostico.php',
                pager: '#pagerReferencia'
            });



            $('#btnGuardarReferencia').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                //idreferencia, claveGeneral, idepisodio, idcatalogoReferencia, nombreReferencia, idcatalogoUPS, nombreCatalogo, fechaIngreso, idtrabajadorReferencia, idtrabajadorResponsable, idtrabajadorCompania, condicionRecepcion, fechaRecepcion, responsableRecepcion, colegiaturaRecepcion, idprofesionRecepcion, condicionPaciente, estadoReferencia, fechaReingreso, iddiagnostico1, diagnostico1, iddiagnostico2, diagnostico2, iddiagnostico3, diagnostico3
                $.post('/sisfac/funcionesphp/adminReferencia.php', {
                    oper: 'add',
                    idreferencia: $('#tbIdReferencia').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    idcatalogoReferencia: $('#tbIdReferenciaEstablecimiento').val(),
                    nombreReferencia: $('#tbReferenciaEstablecimiento').val(),
                    idcatalogoUPS: $('#tbIdEstablecimientoUPS').val(),
                    nombreCatalogo: $('#tbEstablecimientoUPS').val(),
                    fechaIngreso: $('#tbFechaReferencia').val(),
                    idtrabajadorReferencia: $('#cbResponsableReferencia').val(),
                    idtrabajadorResponsable: $('#cbResponsableEstablecimiento').val(),
                    idtrabajadorCompania: $('#cbPersonalAcompanante').val(),
                    condicionRecepcion: $('#cbCondicionPaciente').val()
                }, function(data) {
                    $('#tbIdReferencia').val(data)
                    alert('Se guardaron correctamente los datos')
                })
            }).width(150).height(50)


            $('#btnGuardarRecepcion').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminReferencia.php', {
                    oper: 'edit',
                    idreferencia: $('#tbIdReferencia').val(),
                    idepisodio: $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                    fechaRecepcion: $('#tbFechaRecepcion').val(),
                    responsableRecepcion: $('#tbPersonalRecepcion').val(),
                    colegiaturaRecepcion: $('#tbColegiaturaRecepcion').val(),
                    idprofesionRecepcion: $('#cbProfesionRecepcion').val(),
                    condicionPaciente: $('#cbCondicionPacienteRecepcion').val(),
                    estadoReferencia: $('#cbEstadoReferencia').val(),
                    fechaReingreso: $('#tbFechaReingreso').val(),
                    iddiagnostico1: $('#tbIdDiagnosticoReingreso1').val(),
                    diagnostico1: $('#tbDiagnosticoReingreso1').val(),
                    iddiagnostico2: $('#tbIdDiagnosticoReingreso2').val(),
                    diagnostico2: $('#tbDiagnosticoReingreso2').val(),
                    iddiagnostico3: $('#tbIdDiagnosticoReingreso3').val(),
                    diagnostico3: $('#tbDiagnosticoReingreso3').val()
                }, function(data) {
                    $('#tbIdReferencia').val(data)
                    alert('Se guardaron correctamente los datos')
                })
            }).width(150).height(50)
        }

        function octavoTabClinica() {
            $('#listaHIS').jqGrid({
                url: '/sisfac/funcionesphp/adminHIS.php?f=1&idepisodio=' + $('#listaEpisodio').jqGrid('getGridParam', 'selrow'),
                datatype: "xml",
                colNames: ['idHIS', 'claveGeneral', 'Tipo catalogo', 'idcatalogo', 'Codigo HIS/CPT/CIE10', 'LAB', 'Tipo diagn&oacute;stico', 'Establecimiento', 'Servicio'],
                colModel: [{
                    name: 'idHIS',
                    index: 'idHIS',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: 'claveGeneral',
                    index: 'claveGeneral',
                    width: 100,
                    editable: true,
                    hidden: true
                }, {
                    name: 'tipoCatalogo',
                    index: 'tipoCatalogo',
                    width: 80,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'CPT:CPT;CIE10:CIE10',
                        dataInit: function(el) {
                            $(el).change(function() {
                                $('#nombreCatalogo').autocomplete({
                                    source: ($(el).val() == 'CPT' ? "/sisfac/funcionesphp/adminCatalogoCPT.php?f=2&limit=11" : '/sisfac/funcionesphp/adminCatalogoCIE10.php?f=1&limit=11'),
                                    minLength: 1,
                                    focus: function(event, ui) {
                                        $('#nombreCatalogo').val(ui.item.label)
                                        $('#idcatalogo').val(ui.item.value)
                                        return false
                                    },
                                    select: function(event, ui) {
                                        $('#nombreCatalogo').val(ui.item.label)
                                        $('#idcatalogo').val(ui.item.value)
                                        return false
                                    }
                                })
                            })
                        }
                    }
                }, {
                    name: 'idcatalogo',
                    index: 'idcatalogo',
                    width: 150,
                    editable: true,
                    hidden: true
                }, {
                    name: 'nombreCatalogo',
                    index: 'nombreCatalogo',
                    width: 500,
                    editable: true,
                    editoptions: {
                        dataInit: function(el) {
                            $(el).autocomplete({
                                source: "/sisfac/funcionesphp/adminCatalogoCPT.php?f=2&limit=11",
                                minLength: 1,
                                focus: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogo').val(ui.item.value)
                                    return false
                                },
                                select: function(event, ui) {
                                    $(el).val(ui.item.label)
                                    $('#idcatalogo').val(ui.item.value)
                                    return false
                                }
                            }).width(400)
                        }
                    }
                }, {
                    name: 'variableLAB',
                    index: 'variableLAB',
                    width: 80,
                    editable: true
                }, {
                    name: 'tipoDiagnostico',
                    index: 'tipoDiagnostico',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'PRESUNTIVO:PRESUNTIVO;DEFINITIVO:DEFINITIVO;REPETITIVO:REPETITIVO'
                    }
                }, {
                    name: 'opPacienteEst',
                    index: 'opPacienteEst',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                    }
                }, {
                    name: 'opPacienteServ',
                    index: 'opPacienteServ',
                    width: 100,
                    editable: true,
                    edittype: 'select',
                    formatter: 'select',
                    editoptions: {
                        value: 'NUEVO:NUEVO;CONTINUADOR:CONTINUADOR;REINGRESO:REINGRESO'
                    }
                }],
                height: 150,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'idHIS',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                caption: "HIS",
                editurl: '/sisfac/funcionesphp/adminHIS.php',
                pager: '#pagerHIS'
            });

            $("#listaHIS").jqGrid('navGrid', "#pagerHIS", {
                edit: true,
                add: true,
                del: true
            }, {
                width: 600,
                reloadAfterEdit: true,
                closeAfterEdit: true
            }, {
                width: 600,
                reloadAfterAdd: true,
                closeAfterAdd: true,
                onclickSubmit: function(params, postdata) {
                    id = '' //$('#listaBusqueda').jqGrid('getGridParam','selrow')
                    return {
                        idHis: id
                    }
                },
                beforeSubmit: function(postdata, formid) {
                    id = $('#idcatalogo').val()
                    return [id != '', 'Debe seleccionar un catalogo'];
                }
            });

            //$('#').button({icons: {primary: "ui-icon-plus"}}).click(function(){}).width(100).height(50)
        }

        function novenoTabClinica() {
            $('#tbAnioPAIS').mask('9999').width(50)
            lista = $('#listaBusqueda').jqGrid('getRowData', $('#listaBusqueda').jqGrid('getGridParam', 'selrow'))
            $('#btnGuardarPAIS').button({
                icons: {
                    primary: "ui-icon-disk"
                }
            }).click(function() {
                $.post('/sisfac/funcionesphp/adminPAIS.php', {
                    oper: 'add',
                    idPAIS: $('#tbIdPAIS').val(),
                    idpersona: lista.idpersona,
                    codigo: obtenerCodigoPAIS(),
                    estadoPlan: $('#cbEstadoPAIS').val(),
                    etapaVida: lista.etapa,
                    anio: $('#tbAnioPAIS').val()
                }, function(data) {
                    $('#tbIdPAIS').val(data)
                })
            })

        }

        function obtenerCodigoPAIS() {
            var temp = Array(),
                i = 0,
                data = $('#divPAIS table:[id]')
            $(data).each(function(index) {
                te = $(this).attr('id')
                a = $('#divPAIS table #' + te + ' select').val()
                b = $('#divPAIS table #' + te + ' input[name=tbFechaProgramana]').val()
                temp[i] = te + '-' + a + '-' + b
                i++
            })
            alert(temp.join('+'))
            return temp.join('+')

        }




        function iniciarTabsClinica(i) {
            $('#tabsClinica').show();
            $('#tabsClinica').tabs({
                collapsible: true,
                selected: i,
                select: function(event, ui) {
                    if ($('#listaBusqueda').jqGrid('getGridParam', 'selrow')) {
                        if (tabSeleccionadosClinica.indexOf(ui.index) == -1) {
                            val = ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 11) - 1
                            if (val == 2 || val == 3 || val == 5 || val == 6 || val == 7) {
                                if (!$('#listaEpisodio').jqGrid('getGridParam', 'selrow')) {
                                    alert('Debe seleccionar un registro de episodio')
                                    return false
                                } else {
                                    tabSeleccionadosClinica.push(ui.index);
                                    eval(funcionesClinica[ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 11) - 1]);
                                }
                            } else {
                                tabSeleccionadosClinica.push(ui.index);
                                eval(funcionesClinica[ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 11) - 1]);
                                return true
                            }
                        }

                    } else {
                        alert('Debe seleccionar un registro de una persona')
                        return false
                    }
                }
            })
        }

        iniciarTabsClinica(-1);
        //primerTabClinica();
    }

    function contenidoMaestra() {
        $("#listaMaestra").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'tabla',
                index: 'tabla',
                width: 150
            }, ],
            multiselect: true,
            //hiddengrid: true,
            caption: "Tablas maestras"
        });

        var mydata = [{
            id: '1',
            tabla: "Region"
        }, {
            id: '2',
            tabla: "Provincia"
        }, {
            id: '3',
            tabla: "Distrito"
        }, {
            id: '4',
            tabla: "Diresa"
        }, {
            id: '5',
            tabla: "Red"
        }, {
            id: '6',
            tabla: "Microred"
        }, {
            id: '7',
            tabla: "Nucleo"
        }, {
            id: '8',
            tabla: "Establecimiento"
        }];
        for (var i = 0; i <= mydata.length; i++) $("#listaMaestra").jqGrid('addRowData', i + 1, mydata[i]);
        $('#btnGenerarParche').button({
            icons: {
                primary: "ui-icon-search"
            }
        }).click(function() {
            var temp = Array(),
                i = 0
            ids = $('#listaMaestra').jqGrid('getGridParam', 'selarrrow')
            for (j in ids) {
                lista = $('#listaMaestra').jqGrid('getRowData', ids[j])
                temp[i] = lista.tabla
                i++
            }

            $.post('/sisfac/funcionesphp/adminGenerarParche.php', {
                f: 1,
                tabla: temp.join('+')
            }, function(data) {
                alert('Se ha generado un archivo en /SISFAC/FUNCIONESPHP/PARCHE/')
            })

        }).width(150).height(50)
    }


    function contenidoCargarCsv() {
        var lista = ''
        $("#listaMaestraCsv").jqGrid({
            datatype: "local",
            height: 'auto',
            colNames: ['', 'Seleccione'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 150,
                hidden: true
            }, {
                name: 'tabla',
                index: 'tabla',
                width: 150
            }, ],
            //multiselect: true, 
            //hiddengrid: true,
            caption: "Tablas maestras",
            onSelectRow: function(rowid, status) {
                lista = $('#listaMaestraCsv').jqGrid('getRowData', rowid)
            }
        });

        var mydata = [{
            id: '1',
            tabla: "Region"
        }, {
            id: '2',
            tabla: "Provincia"
        }, {
            id: '3',
            tabla: "Distrito"
        }, {
            id: '4',
            tabla: "Diresa"
        }, {
            id: '5',
            tabla: "Red"
        }, {
            id: '6',
            tabla: "Microred"
        }, {
            id: '7',
            tabla: "Nucleo"
        }, {
            id: '8',
            tabla: "Establecimiento"
        }];
        for (var i = 0; i <= mydata.length; i++) $("#listaMaestraCsv").jqGrid('addRowData', i + 1, mydata[i]);

        $('#btnActualizarCsv').button({
            icons: {
                primary: "ui-icon-search"
            }
        }).width(150).height(50)


        f = new AjaxUpload($('form#formArchivosCsv #btnActualizarCsv'), {
            action: '/sisfac/funcionesphp/cargadorCsv.php?tabla=' + $('#listaMaestraCsv').jqGrid('getGridParam', 'selrow'),
            autoSubmit: true,
            name: 'userfile',
            onChange: function(file, extension) {

            },
            onSubmit: function(file, ext) {
                //ta='jpg|jpeg|png|pdf|dwg|dxf|avi|mp4|doc|docx|xls'
                if (ext && /^(csv)$/.test(ext)) {
                    this.disable();
                } else {
                    alert('S\xf3lo se aceptan archivos CSV');
                    return false
                }
            },
            onComplete: function(file, response) {
                //alert(response)
                alert('La importacion se realizo con exito')

                lista = $('#listaMaestraCsv').jqGrid('getRowData', $('#listaMaestraCsv').jqGrid('getGridParam', 'selrow'))

                $.post('/sisfac/funcionesphp/adminImportarCsv.php', {
                    f: 1,
                    tabla: lista.tabla,
                    archivo: response
                }, function(data) {})

                if (response == 'correcto') {

                }

                this.enable();
            }
        });


    }

    function contenidoCatalogoCIE10() {
        $('#listaCatalogoCIE10').jqGrid({
            url: '/sisfac/funcionesphp/adminCatalogoCIE10.php?f=2',
            datatype: "xml",
            colNames: ['idcatalogoCIE10', 'codigoCategoriaCIE10', 'codigoEnfermedad', 'Codigo', 'CIE10'],
            colModel: [{
                name: 'idcatalogoCIE10',
                index: 'idcatalogoCIE10',
                width: 100,
                hidden: true
            }, {
                name: 'codigoCategoriaCIE10',
                index: 'codigoCategoriaCIE10',
                width: 100,
                hidden: true
            }, {
                name: 'codigoEnfermedad',
                index: 'codigoEnfermedad',
                width: 100,
                hidden: true
            }, {
                name: 'codigoCIE10',
                index: 'codigoCIE10',
                width: 100,
                editable: true
            }, {
                name: 'nombreEnfermedad',
                index: 'nombreEnfermedad',
                width: 600,
                editable: true
            }, ],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [1000, 2000, 3000],
            rownumbers: true,
            sortname: 'idcatalogoCIE10',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Insumos",
            editurl: '/sisfac/funcionesphp/adminCatalogoCIE10.php',
            pager: '#pagerCatalogoCIE10'
        });

        $("#listaCatalogoCIE10").jqGrid('navGrid', "#pagerCatalogoCIE10", {
            edit: false,
            add: false,
            del: false
        }, {
            //width:500,
            reloadAfterEdit: true,
            closeAfterEdit: true
        }, {
            //width:500,
            reloadAfterAdd: true,
            closeAfterAdd: true
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
        });
    }

    function contenidoCatalogoMedicamento() {
        $('#listaCatalogoMedicamento').jqGrid({
            url: '/sisfac/funcionesphp/adminCatalogoMedicamento.php?f=1',
            datatype: "xml",
            colNames: ['idcatalogoMedicamento', 'Catalogo(Codigo medicamento -  Codigo ATC  - Medicamento)'],
            colModel: [{
                name: 'idcatalogoMedicamento',
                index: 'idcatalogoMedicamento',
                width: 100,
                hidden: true
            }, {
                name: 'nombre',
                index: 'nombre',
                width: 700,
                editable: true
            }, ],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idcatalogoMedicamento',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Insumos",
            editurl: '/sisfac/funcionesphp/adminCatalogoMedicamento.php',
            pager: '#pagerCatalogoMedicamento'
        });

        $("#listaCatalogoMedicamento").jqGrid('navGrid', "#pagerCatalogoMedicamento", {
            edit: false,
            add: false,
            del: false
        }, {
            //width:500,
            reloadAfterEdit: true,
            closeAfterEdit: true
        }, {
            //width:500,
            reloadAfterAdd: true,
            closeAfterAdd: true
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
        });

    }

    function contenidoCatalogoPrestaciones() {
        $('#listaCatalogoPrestacion').jqGrid({
            url: '/sisfac/funcionesphp/adminCatalogoPrestacion.php?f=1',
            datatype: "xml",
            colNames: ['idcatalogoPrestacion', 'Nombre prestacion', 'formulario', 'Planificador', 'nombreTabla', 'descripcion'],
            colModel: [{
                name: 'idcatalogoPrestacion',
                index: 'idcatalogoPrestacion',
                width: 100,
                hidden: true
            }, {
                name: 'nombrePrestacion',
                index: 'nombrePrestacion',
                width: 600
            }, {
                name: 'formulario',
                index: 'formulario',
                width: 80,
                hidden: true
            }, {
                name: 'planificador',
                index: 'planificador',
                width: 100,
                editable: true
            }, {
                name: 'nombreTabla',
                index: 'nombreTabla',
                width: 100,
                hidden: true
            }, {
                name: 'descripcion',
                index: 'descripcion',
                width: 200
            }, ],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idcatalogoPrestacion',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Insumos",
            editurl: '/sisfac/funcionesphp/adminCatalogoPrestacion.php',
            pager: '#pagerCatalogoPrestacion'
        });

        $("#listaCatalogoPrestacion").jqGrid('navGrid', "#pagerCatalogoPrestacion", {
            edit: false,
            add: false,
            del: false
        }, {
            //width:500,
            reloadAfterEdit: true,
            closeAfterEdit: true
        }, {
            //width:500,
            reloadAfterAdd: true,
            closeAfterAdd: true
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
        });

    }

    function contenidoCatalogoHIS() {


    }

    function contenidoCatalogoEpisodio() {
        $('#listaCatalogoEpisodio').jqGrid({
            url: '/sisfac/funcionesphp/adminCatalogoEpisodio.php?f=1',
            datatype: "xml",
            colNames: ['idcatalogoEpisodio', 'idetapaVida', 'Etapa vida', 'Episodio', 'limiteInicial', 'limiteFinal'],
            colModel: [{
                name: 'idcatalogoEpisodio',
                index: 'idcatalogoEpisodio',
                width: 100,
                hidden: true
            }, {
                name: 'idetapaVida',
                index: 'idetapaVida',
                width: 100,
                hidden: true
            }, {
                name: 'etapa',
                index: 'etapa',
                width: 200,
                editable: true
            }, {
                name: 'nombreEpisodio',
                index: 'nombreEpisodio',
                width: 400,
                editable: true
            }, {
                name: 'limiteInicial',
                index: 'limiteInicial',
                width: 100,
                hidden: true
            }, {
                name: 'limiteFinal',
                index: 'limiteFinal',
                width: 100,
                hidden: true
            }, ],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idcatalogoEpisodio',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Insumos",
            editurl: '/sisfac/funcionesphp/adminCatalogoEpisodio.php',
            pager: '#pagerCatalogoEpisodio'
        });

        $("#listaCatalogoEpisodio").jqGrid('navGrid', "#pagerCatalogoEpisodio", {
            edit: false,
            add: false,
            del: false
        }, {
            //width:500,
            reloadAfterEdit: true,
            closeAfterEdit: true
        }, {
            //width:500,
            reloadAfterAdd: true,
            closeAfterAdd: true
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
        });
    }

    function contenidoCatalogoFinanciadores() {

    }

    function contenidoCatalogoLaboratorio() {
        $('#listaCatalogoLaboratorio').jqGrid({
            url: '/sisfac/funcionesphp/adminCatalogoExamenLaboratorio.php?f=1',
            datatype: "xml",
            colNames: ['idcatalogoExamenLaboratorio', 'idcatalogoPerfilLaboratorio', 'Tipo Examen', 'Nombre Examen Laboratorio', 'Unidades', 'Rangos Normales', 'Opcion Examen'],
            colModel: [{
                name: 'idcatalogoExamenLaboratorio',
                index: 'idcatalogoExamenLaboratorio',
                width: 100,
                hidden: true
            }, {
                name: 'idcatalogoPerfilLaboratorio',
                index: 'idcatalogoPerfilLaboratorio',
                width: 100,
                hidden: true
            }, {
                name: 'tipoExamen',
                index: 'tipoExamen',
                width: 100,
                editable: true
            }, {
                name: 'nombreExamenLaboratorio',
                index: 'nombreExamenLaboratorio',
                width: 300,
                editable: true
            }, {
                name: 'unidades',
                index: 'unidades',
                width: 100,
                editable: true
            }, {
                name: 'rangosNormales',
                index: 'rangosNormales',
                width: 100,
                editable: true
            }, {
                name: 'opExamen',
                index: 'opExamen',
                width: 100,
                editable: true
            }, ],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idcatalogoExamenLaboratorio',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            //caption: "Insumos",
            editurl: '/sisfac/funcionesphp/adminCatalogoExamenLaboratorio.php',
            pager: '#pagerCatalogoLaboratorio'
        });

        $("#listaCatalogoLaboratorio").jqGrid('navGrid', "#pagerCatalogoLaboratorio", {
            edit: false,
            add: false,
            del: false
        }, {
            //width:500,
            reloadAfterEdit: true,
            closeAfterEdit: true
        }, {
            //width:500,
            reloadAfterAdd: true,
            closeAfterAdd: true
                /*onclickSubmit:function(params,postdata){
                    id=$('#lista').jqGrid('getGridParam','selrow')
                    return {id:id}
                },
                afterShowForm  : function(formid) {

                },
                beforeSubmit : function(postdata, formid) {  
                    id = $('#id').val()
                    return [id!='','Debe seleccionar '];
                }*/
        });
    }

    function contenidoConsultaFicha() {
        var tabSeleccionados = Array(),
            funciones = ['', 'segundoTabConsulta();', 'tercerTabConsulta();', 'cuartoTabConsulta();', 'quintoTabConsulta();', 'sextoTabConsulta();'];
        $('#listaConsultaFicha').jqGrid({
            url: '/sisfac/funcionesphp/admin.php?f=1',
            datatype: "xml",
            colNames: ['id', 'C&oacute;digo de ficha', 'Nombre de la familia', 'Jefe de la familia', 'Regi&oacute;n', 'Provincia', 'Comunidad', 'Fecha de apertura'],
            colModel: [{
                name: '',
                index: '',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: '',
                index: '',
                width: 100,
                editable: true
            }, {
                name: '',
                index: '',
                width: 250,
                editable: true
            }, {
                name: '',
                index: '',
                width: 150,
                editable: true
            }, {
                name: '',
                index: '',
                width: 150,
                editable: true
            }, {
                name: '',
                index: '',
                width: 150,
                editable: true
            }, {
                name: '',
                index: '',
                width: 150,
                editable: true
            }, {
                name: '',
                index: '',
                width: 100,
                editable: true
            }],
            height: 80,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'id',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Listado de familias",
            editurl: '/sisfac/funcionesphp/admin.php',
            pager: '#pagerConsultaFicha'
        });



        //$("#listaConsultaFicha").jqGrid('navGrid',"#pagerConsultaFicha",{edit:false,add:false,del:false});

        function primerTab() {

        }

        function segundoTabConsulta() {

        }

        function tercerTabConsulta() {
            $('#listaConsultaIntegrantes').jqGrid({
                url: '/sisfac/funcionesphp/admin.php?f=1',
                datatype: "xml",
                colNames: ['id', 'Ficha cl&iacute;nica', 'Nro.', 'Nombre y apellidos', 'DNI', 'Sexo', 'Edad', 'Parentesco', 'Grado de instrucci&oacute;n', 'Estado civil', 'Jefe de la familia'],
                colModel: [{
                    name: '',
                    index: '',
                    width: 200,
                    editable: true,
                    hidden: true
                }, {
                    name: '',
                    index: '',
                    width: 100,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 50,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 200,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 80,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 80,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 80,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 100,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 100,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 100,
                    editable: true
                }, {
                    name: '',
                    index: '',
                    width: 100,
                    editable: true
                }],
                height: 150,
                width: 'auto',
                rowNum: 100,
                rowList: [100, 200, 300],
                rownumbers: true,
                sortname: 'id',
                pginput: false,
                sortorder: 'asc',
                viewrecords: true,
                //caption: "Listado de familias",
                editurl: '/sisfac/funcionesphp/admin.php'
            });

            //$("#listaConsultaFicha").jqGrid('navGrid',"#pagerConsultaFicha",{edit:false,add:false,del:false});
        }

        function cuartoTabConsulta() {

        }

        function quintoTabConsulta() {

        }

        function sextoTabConsulta() {

        }



        function iniciarTabs() {
            $('#tabsConsulta').show();
            $('#tabsConsulta').tabs({
                selected: 0,
                select: function(event, ui) {
                    if (tabSeleccionados.indexOf(ui.index) == -1) {
                        tabSeleccionados.push(ui.index);
                        eval(funciones[ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 12) - 1]);
                    }
                }
            });
        }

        iniciarTabs();
        llenarGridMultiselect()
        primerTab();
    }

    function contenidoReportes() {


    }

    function agregarFila(idLista, fil, col) {
        $('#' + idLista).jqGrid('addRowData', 'nuevo', {})
        $("#" + idLista).jqGrid("editCell", fil, col, true).select().focus()
    }

    function contenidoRegion() {
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 3

        $('#listaRegion').jqGrid({
            url: '/sisfac/funcionesphp/adminRegion.php?f=1',
            datatype: "xml",
            colNames: ['C&oacute;digo', 'Regi&oacute;n', 'Ubigeo'],
            colModel: [{
                name: 'idregion',
                index: 'idregion',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreRegion',
                index: 'nombreRegion',
                width: 400,
                editable: true
            }, {
                name: 'codigoRegion',
                index: 'codigoRegion',
                width: 80,
                editable: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idregion',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de regiones",
            editurl: '/sisfac/funcionesphp/adminRegion.php',
            pager: '#pagerRegion',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaRegion', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminRegion.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaRegion').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaRegion").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaRegion").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaRegion', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                if (!CUENTA1) contenidoProvincia(rowid)
                mostrarContenido('contenidoProvincia')
                CUENTA1 = 1
                $('#listaProvincia').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminProvincia.php?f=1&idregion=' + rowid
                }).trigger('reloadGrid')
            }
        });
        $('#listaRegion').jqGrid('navGrid', '#pagerRegion', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
    }

    function contenidoProvincia(idregion) {
        var selIRow, selICol = 4,
            colini = 4,
            colfin = 5
        $('#listaProvincia').jqGrid({
            url: '/sisfac/funcionesphp/adminProvincia.php?f=1&idregion=' + idregion,
            datatype: "xml",
            colNames: ['idprovincia', 'Regi&oacute;n', 'Regi&oacute;n', 'Provincia', 'Ubigeo'],
            colModel: [{
                name: 'idprovincia',
                index: 'idprovincia',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idregion',
                index: 'idregion',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminRegion.php?f=2'
                }
            }, {
                name: 'region',
                index: 'region',
                width: 200,
                hidden: true
            }, {
                name: 'nompro',
                index: 'nompro',
                width: 400,
                editable: true
            }, {
                name: 'codigoProvincia',
                index: 'codigoProvincia',
                width: 80,
                editable: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'idprovincia',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de provincias",
            editurl: '/sisfac/funcionesphp/adminProvincia.php',
            pager: '#pagerProvincia',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaProvincia', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminProvincia.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idregion: $('#listaRegion').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaProvincia').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaProvincia").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaProvincia").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaProvincia', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                    if (rowid == 'nuevo') {
                        alert('Tiene que seleccionar un registro con datos')
                        return
                    }
                    if (!CUENTA17) contenidoDistrito(rowid)
                    mostrarContenido('contenidoDistrito')
                    CUENTA17 = 1
                    $('#listaDistrito').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminDistrito.php?f=1&idprovincia=' + rowid
                    }).trigger('reloadGrid')
                }
                /*,
                            onSelectRow:function(rowid,status){
                                $('#listaDistrito').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminDistrito.php?f=1&idprovincia=' + rowid}).trigger('reloadGrid')
                            }*/
        });
        $('#listaProvincia').jqGrid('navGrid', '#pagerProvincia', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarRegion').click(function() {
            mostrarContenido('contenidoRegion')
        })
    }

    function contenidoDistrito(idprovincia) {
        var selIRow, selICol = 3,
            colini = 3,
            colfin = 4
        $('#listaDistrito').jqGrid({
            url: '/sisfac/funcionesphp/adminDistrito.php?f=1&idprovincia=' + idprovincia,
            datatype: "xml",
            colNames: ['iddistrito', 'idprovincia', 'Distrito', 'Ubigeo'],
            colModel: [{
                name: 'iddistrito',
                index: 'iddistrito',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idprovincia',
                index: 'idprovincia',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombre',
                index: 'nombre',
                width: 400,
                editable: true
            }, {
                name: 'codigoDistrito',
                index: 'codigoDistrito',
                width: 80,
                editable: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'iddistrito',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de Distritos",
            editurl: '/sisfac/funcionesphp/adminDistrito.php',
            pager: '#pagerDistrito',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaDistrito', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminDistrito.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idprovincia: $('#listaProvincia').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaDistrito').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaDistrito").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaDistrito").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaDistrito', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                if (!CUENTA4) contenidoEstablecimiento(rowid)
                mostrarContenido('contenidoEstablecimiento')
                CUENTA4 = 1
                $('#listaEstablecimiento').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idnucleo=&iddistrito=' + rowid
                }).trigger('reloadGrid')
            }
        });
        $('#listaDistrito').jqGrid('navGrid', '#pagerDistrito', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarProvincia').click(function() {
            mostrarContenido('contenidoProvincia')
        })
    }

    function contenidoEstablecimiento(iddistrito) {
        var selIRow, selICol = 6,
            colini = 6,
            colfin = 8
        $('#listaEstablecimiento').jqGrid({
            url: '/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idnucleo=&iddistrito=' + iddistrito,
            datatype: "xml",
            colNames: ['idestablecimiento', 'Distrito', 'Distrito', 'Nucleo', 'Nucleo', 'Establecimiento', 'Tipo', 'RENAES'],
            colModel: [{
                name: 'idestablecimiento',
                index: 'idestablecimiento',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'iddistrito',
                index: 'iddistrito',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminDistrito.php?f=2',
                    dataInit: function(el) {
                        $(el).width(200)
                    }
                }
            }, {
                name: 'nombre',
                index: 'nombre',
                width: 150,
                hidden: true
            }, {
                name: 'idnucleo',
                index: 'idnucleo',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminNucleo.php?f=2',
                    dataInit: function(el) {
                        $(el).width(200)
                    }
                }
            }, {
                name: 'nombreNucleo',
                index: 'nombreNucleo',
                width: 150,
                hidden: true
            }, {
                name: 'nombreEstablecimiento',
                index: 'nombreEstablecimiento',
                width: 400,
                editable: true
            }, {
                name: 'tipo',
                index: 'tipo',
                width: 80,
                editable: true,
                edittype: 'select',
                editoptions: {
                    value: 'I-1:I-1;I-2:I-2;I-3:I-3;I-4:I-4'
                }
            }, {
                name: 'claveGeneral',
                index: 'claveGeneral',
                width: 100,
                editable: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreEstablecimiento',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de establecimientos",
            editurl: '/sisfac/funcionesphp/adminEstablecimiento.php',
            pager: '#pagerEstablecimiento',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaEstablecimiento', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                lista = $('#listaEstablecimiento').jqGrid('getRowData', rowid)
                    //alert(lista.nombreEstablecimiento)
                if (!lista.nombreEstablecimiento) {
                    alert('Debe ingresar el nombre del establecimiento')
                    return
                }
                $.post('/sisfac/funcionesphp/adminEstablecimiento.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    iddistrito: $('#listaDistrito').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaEstablecimiento').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaEstablecimiento").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaEstablecimiento").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaEstablecimiento', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                    if (rowid == 'nuevo') {
                        alert('Tiene que seleccionar un registro con datos')
                        return
                    }
                    if (!CUENTA18) contenidoComunidad(rowid)
                    mostrarContenido('contenidoComunidad')
                    CUENTA18 = 1
                    $('#listaEstablecimiento').setSelection(rowid, false);
                    $('#listaComunidad').jqGrid('clearGridData');
                    $('#listaComunidad').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + rowid
                    }).trigger('reloadGrid')
                }
                /*
                            
                            onSelectRow:function(rowid,status){
                                $('#listaComunidad').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + rowid}).trigger('reloadGrid')
                            },
                            loadComplete:function(data){
                                temp = $('#listaEstablecimiento').jqGrid('getDataIDs')
                                $('#listaEstablecimiento').jqGrid('setSelection',temp[0])
                                //$('#listaSector').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminSector.php?f=1&idestablecimiento=' + temp[0]}).trigger('reloadGrid')
                            }*/
        });
        $('#listaEstablecimiento').jqGrid('navGrid', '#pagerEstablecimiento', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        }, {
            width: 350,
            closeAfterEdit: true
        }, {
            width: 350,
            closeAfterAdd: true
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarDistrito').click(function() {
            mostrarContenido('contenidoDistrito')
        })
    }

    function contenidoComunidad(idestablecimiento) {
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 2
        $('#listaComunidad').jqGrid({
            url: '/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + idestablecimiento,
            datatype: "xml",
            colNames: ['idcomunidad', 'Comunidad', 'Descripci&oacute;n'],
            colModel: [{
                name: 'idcomunidad',
                index: 'idcomunidad',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreComunidad',
                index: 'nombreComunidad',
                width: 400,
                editable: true
            }, {
                name: 'descripcion',
                index: 'descripcion',
                width: 150,
                editable: true,
                hidden: true,
                editoptions: {
                    size: 40
                }
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreComunidad',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de comunidades",
            editurl: '/sisfac/funcionesphp/adminComunidad.php',
            pager: '#pagerComunidad',
            cellEdit: true,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaComunidad', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminComunidad.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idestablecimiento: $('#listaEstablecimiento').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaComunidad').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaComunidad").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaComunidad").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaComunidad', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                if (!CUENTA19) contenidoSector(rowid)
                mostrarContenido('contenidoSector')
                CUENTA19 = 1
                $('#listaComunidad').setSelection(rowid, false);
                $('#listaSector').jqGrid('clearGridData');
                $('#listaSector').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminSector.php?f=1&idcomunidad=' + rowid
                }).trigger('reloadGrid')
            }
        });
        $('#listaComunidad').jqGrid('navGrid', '#pagerComunidad', {
            edit: false,
            add: false,
            del: true,
            search: false,
            view: false
        }, {
            width: 350,
            closeAfterEdit: true
        }, {
            width: 350,
            closeAfterAdd: true
                /*,
                            beforeSubmit : function(postdata, formid) {
                                id = $('#listaEstablecimiento').jqGrid('getGridParam','selrow');
                                return [id!=null,'Debe seleccionar una red'];
                            },
                            onclickSubmit:function(){
                                return {idestablecimiento:$('#listaEstablecimiento').jqGrid('getGridParam','selrow')};
                            }*/
        }, {
            afterSubmit: function(response, postdata) {
                mensaje = ''
                if (response.responseText == 'N') {
                    s = false
                    mensaje = 'NO SE PUEDE ELIMINAR. HAY FICHAS REGISTRADAS'
                } else s = true
                return [s, mensaje]
            }
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarEstablecimiento').click(function() {
            $('#listaEstablecimiento').jqGrid('resetSelection');
            mostrarContenido('contenidoEstablecimiento')
        })
    }

    function contenidoSector(idcomunidad) {
        var selIRow, selICol = 4,
            colini = 4,
            colfin = 4
        $('#listaSector').jqGrid({
            url: '/sisfac/funcionesphp/adminSector.php?f=1&idcomunidad=' + idcomunidad,
            datatype: "xml",
            colNames: ['idsector', 'Comunidad', 'Comunidad', 'Sector', 'Descripcion'],
            colModel: [{
                name: 'idsector',
                index: 'idsector',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idcomunidad',
                index: 'idcomunidad',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminComunidad.php?f=2'
                }
            }, {
                name: 'nombreComunidad',
                index: 'nombreComunidad',
                width: 300,
                hidden: true
            }, {
                name: 'nombreSector',
                index: 'nombreSector',
                width: 400,
                editable: true
            }, {
                name: 'descripcion',
                index: 'descripcion',
                width: 250,
                hidden: true,
                editoptions: {
                    size: 40
                }
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreSector',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de sectores",
            editurl: '/sisfac/funcionesphp/adminSector.php',
            pager: '#pagerSector',
            cellEdit: true,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaSector', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminSector.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idcomunidad: $('#listaComunidad').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaSector').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaSector").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaSector").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaSector', selIRow, selICol)
            }
        });
        $('#listaSector').jqGrid('navGrid', '#pagerSector', {
            edit: false,
            add: false,
            del: true,
            search: false,
            view: false
        }, {
            width: 350,
            closeAfterEdit: true
        }, {
            width: 350
                /*,
                            closeAfterAdd:true,
                            onclickSubmit : function(params, posdata) {
                                return {idestablecimiento:$('#listaEstablecimiento').jqGrid('getGridParam','selrow')}
                            }*/
        }, {
            afterSubmit: function(response, postdata) {
                mensaje = ''
                if (response.responseText == 'N') {
                    s = false
                    mensaje = 'NO SE PUEDE ELIMINAR. HAY FICHAS REGISTRADAS'
                } else s = true
                return [s, mensaje]
            }
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarComunidad').click(function() {
            $('#listaComunidad').jqGrid('resetSelection');
            mostrarContenido('contenidoComunidad')
        })
    }

    function contenidoDiresa() {
        //alert(USU)
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 3
        $('#listaDiresa').jqGrid({
            url: '/sisfac/funcionesphp/adminDiresa.php?f=1',
            datatype: "xml",
            colNames: ['iddiresa', 'Diresa', 'Regi&oacute;n', 'Region'],
            colModel: [{
                name: 'iddiresa',
                index: 'iddiresa',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreDiresa',
                index: 'nombreDiresa',
                width: 400,
                editable: true
            }, {
                name: 'idregion',
                index: 'idregion',
                width: 200,
                editable: true,
                edittype: 'select',
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminRegion.php?f=2'
                }
            }, {
                name: 'idregionn',
                index: 'idregionn',
                width: 200,
                hidden: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreDiresa',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de DIRESA",
            editurl: '/sisfac/funcionesphp/adminDiresa.php',
            pager: '#pagerDiresa',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaDiresa', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                lista = $('#listaDiresa').jqGrid('getRowData', rowid)
                if (!lista.nombreDiresa) {
                    alert('Debe ingresar el nombre de la diresa')
                    return
                }
                $.post('/sisfac/funcionesphp/adminDiresa.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid
                }, function(data) {
                    //if(rowid=='nuevo') $('#listaDiresa').trigger('reloadGrid')
                    $('#listaDiresa').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaDiresa").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaDiresa").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaDiresa', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                lista = $('#listaDiresa').jqGrid('getRowData', rowid)
                if (!CUENTA26) contenidoRed(rowid, lista.idregionn)
                mostrarContenido('contenidoRed')
                CUENTA26 = 1
                $('#listaRed').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminRed.php?f=1&iddiresa=' + rowid
                            //editoptions:{dataUrl:'/sisfac/funcionesphp/adminProvincia.php?f=2&idregion=' + $('#' + rowid + '_idregion').val()}
                    }).trigger('reloadGrid')
                    //alert($('#' + rowid + '_idregion').val())
                $('#listaRed').setColProp('idprovincia', {
                    editoptions: {
                        dataUrl: '/sisfac/funcionesphp/adminProvincia.php?f=2&idregion=' + lista.idregionn
                    }
                })
            }
        });
        $('#listaDiresa').jqGrid('navGrid', '#pagerDiresa', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        }, {
            closeAfterEdit: true
        }, {
            closeAfterAdd: true
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
    }

    function contenidoRed(iddiresa, idregion) {
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 3
        $('#listaRed').jqGrid({
            url: '/sisfac/funcionesphp/adminRed.php?f=1&iddiresa=' + iddiresa,
            datatype: "xml",
            colNames: ['idred', 'Red', 'Provincia', 'Provincia'],
            colModel: [{
                name: 'idred',
                index: 'idred',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreRed',
                index: 'nombreRed',
                width: 400,
                editable: true
            }, {
                name: 'idprovincia',
                index: 'idprovincia',
                width: 200,
                editable: true,
                edittype: 'select',
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminProvincia.php?f=2&idregion=' + idregion
                }
            }, {
                name: 'idprovincian',
                index: 'idprovincian',
                width: 200,
                hidden: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreRed',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de redes",
            editurl: '/sisfac/funcionesphp/adminRed.php',
            pager: '#pagerRed',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaRed', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                lista = $('#listaRed').jqGrid('getRowData', rowid)
                if (!lista.nombreRed) {
                    alert('Debe ingresar el nombre de la red')
                    return
                }
                $.post('/sisfac/funcionesphp/adminRed.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    iddiresa: $('#listaDiresa').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    //if(rowid=='nuevo') $('#listaRed').trigger('reloadGrid')
                    $('#listaRed').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaRed").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaRed").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaRed', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                if (!CUENTA20) contenidoMicrored(rowid)
                mostrarContenido('contenidoMicrored')
                CUENTA20 = 1
                $('#listaMicrored').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminMicrored.php?f=1&idred=' + rowid
                }).trigger('reloadGrid')
            }
        });
        $('#listaRed').jqGrid('navGrid', '#pagerRed', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarDiresa').click(function() {
            mostrarContenido('contenidoDiresa')
        })
    }

    function contenidoMicrored(idred) {
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 2
        $('#listaMicrored').jqGrid({
            url: '/sisfac/funcionesphp/adminMicrored.php?f=1&idred=' + idred,
            datatype: "xml",
            colNames: ['idmicrored', 'Microred'],
            colModel: [{
                name: 'idmicrored',
                index: 'idmicrored',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreMicrored',
                index: 'nombreMicrored',
                width: 400,
                editable: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreMicrored',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de microredes",
            editurl: '/sisfac/funcionesphp/adminMicrored.php',
            pager: '#pagerMicrored',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaMicrored', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                $.post('/sisfac/funcionesphp/adminMicrored.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idred: $('#listaRed').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaMicrored').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaMicrored").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaMicrored").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaMicrored', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                    if (rowid == 'nuevo') {
                        alert('Tiene que seleccionar un registro con datos')
                        return
                    }


                    if (!CUENTA22) contenidoNucleo(rowid)
                    mostrarContenido('contenidoNucleo')
                    CUENTA22 = 1


                    $('#listaNucleo').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=' + rowid
                    }).trigger('reloadGrid')
                }
                /*
                onSelectRow:function(rowid,status){
                    $('#listaNucleo').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=' + rowid}).trigger('reloadGrid')
                },
                loadComplete:function(data){
                    temp = $('#listaMicrored').jqGrid('getDataIDs')
                    $('#listaMicrored').jqGrid('setSelection',temp[0])
                    $('#listaNucleo').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=0'}).trigger('reloadGrid')
                }*/
        });
        $('#listaMicrored').jqGrid('navGrid', '#pagerMicrored', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        }, {
            closeAfterEdit: true
        }, {
            closeAfterAdd: true
                /*,
                            beforeSubmit : function(postdata, formid) {
                                id = $('#listaRed').jqGrid('getGridParam','selrow');
                                return [id!=null,'Debe seleccionar una red'];
                            },
                            onclickSubmit:function(){
                                return {idred:$('#listaRed').jqGrid('getGridParam','selrow')};
                            }*/
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }

        $('#aRegresarRed').click(function() {
            mostrarContenido('contenidoRed')
        })
    }

    function contenidoNucleo(idmicrored) {
        var selIRow, selICol = 2,
            colini = 2,
            colfin = 2

        //        var le = new ListaEstablecimientoMultiselect($('#dialogEstablecimiento'), 0)


        $('#listaNucleo').jqGrid({
            url: '/sisfac/funcionesphp/adminNucleo.php?f=1&idmicrored=' + idmicrored,
            datatype: "xml",
            colNames: ['idnucleo', 'N&uacute;cleo'],
            colModel: [{
                name: 'idnucleo',
                index: 'idnucleo',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreNucleo',
                index: 'nombreNucleo',
                width: 400,
                editable: true
            }],
            height: 300,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreNucleo',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de nucleos",
            editurl: '/sisfac/funcionesphp/adminNucleo.php',
            pager: '#pagerNucleo',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',

            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                lista = $('#listaNucleo').jqGrid('getRowData', $('#listaNucleo').jqGrid('getGridParam', 'selrow'))
                    //if(USU=='ADMINSUPERUSUARIO') le.actualizarConDato(lista.idprovincian)
                    // else le.actualizarConDato(-1)

                // $('#dialogEstablecimiento').dialog('open');

                /* MBF 2019 */
                if (!CUENTA23) contenidoEstablecimientoNucleo(rowid);
                mostrarContenido('contenidoEstablecimientoNucleo');
                CUENTA23 = 1;

                $('#listaEstablecimientoNucleo').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminEstablecimiento.php?f=1&iddistrito=&idprovincia=&idnucleo=' + rowid
                }).trigger('reloadGrid')

            }
        });
        $('#listaNucleo').jqGrid('navGrid', '#pagerNucleo', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }

        $('#aRegresarMicrored').click(function() {
            mostrarContenido('contenidoMicrored')
        })
    }

    function contenidoEstablecimientoNucleo(idnucleo) {


        var selIRow, selICol = 6,
            colini = 6,
            colfin = 7
        $('#listaEstablecimientoNucleo').jqGrid({
            url: '/sisfac/funcionesphp/adminEstablecimiento.php?f=1&idnucleo=' + idnucleo + "&idprovincia=&iddistrito=",
            datatype: "xml",
            colNames: ['idestablecimiento', 'Distrito', 'Distrito', 'Nucleo', 'Nucleo', 'Establecimiento', 'Tipo'],
            colModel: [{
                name: 'idestablecimiento',
                index: 'idestablecimiento',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'iddistrito',
                index: 'iddistrito',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminDistrito.php?f=2',
                    dataInit: function(el) {
                        $(el).width(200)
                    }
                }
            }, {
                name: 'nombre',
                index: 'nombre',
                width: 150
            }, {
                name: 'idnucleo',
                index: 'idnucleo',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminNucleo.php?f=2',
                    dataInit: function(el) {
                        $(el).width(200)
                    }
                }
            }, {
                name: 'nombreNucleo',
                index: 'nombreNucleo',
                width: 150
            }, {
                name: 'nombreEstablecimiento',
                index: 'nombreEstablecimiento',
                width: 400,
                editable: true
            }, {
                name: 'tipo',
                index: 'tipo',
                width: 80,
                editable: true,
                edittype: 'select',
                editoptions: {
                    value: 'I-1:I-1;I-2:I-2;I-3:I-3;I-4:I-4'
                }
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreEstablecimiento',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de establecimientos",
            editurl: '/sisfac/funcionesphp/adminEstablecimiento.php',
            pager: '#pagerEstablecimientoNucleo',
            cellEdit: USU == 'ADMINSUPERUSUARIO' ? true : false,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaEstablecimientoNucleo', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                lista = $('#listaEstablecimientoNucleo').jqGrid('getRowData', rowid)
                    //alert(lista.nombreEstablecimiento)
                if (!lista.nombreEstablecimiento) {
                    alert('Debe ingresar el nombre del establecimiento')
                    return
                }
                $.post('/sisfac/funcionesphp/adminEstablecimiento.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idnucleo: $('#listaNucleo').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaEstablecimientoNucleo').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaEstablecimientoNucleo").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaEstablecimientoNucleo").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaEstablecimientoNucleo', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                    if (rowid == 'nuevo') {
                        alert('Tiene que seleccionar un registro con datos')
                        return
                    }
                    if (!CUENTA24) contenidoTrabajadores(rowid)
                    mostrarContenido('contenidoTrabajadores')
                    CUENTA24 = 1
                    $('#listaTrabajador').jqGrid('setGridParam', {
                        url: '/sisfac/funcionesphp/adminTrabajador.php?f=1&idestablecimiento=' + rowid
                    }).trigger('reloadGrid')
                }
                /*
                            onSelectRow:function(rowid,status){
                                $('#listaComunidad').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminComunidad.php?f=1&idestablecimiento=' + rowid}).trigger('reloadGrid')
                            },
                            loadComplete:function(data){
                                temp = $('#listaEstablecimiento').jqGrid('getDataIDs')
                                $('#listaEstablecimiento').jqGrid('setSelection',temp[0])
                                //$('#listaSector').jqGrid('setGridParam',{url:'/sisfac/funcionesphp/adminSector.php?f=1&idestablecimiento=' + temp[0]}).trigger('reloadGrid')
                            }*/
        });
        $('#listaEstablecimientoNucleo').jqGrid('navGrid', '#pagerEstablecimientoNucleo', {
            edit: false,
            add: false,
            del: USU == 'ADMINSUPERUSUARIO' ? true : false,
            search: false,
            view: false
        }, {
            width: 350,
            closeAfterEdit: true
        }, {
            width: 350,
            closeAfterAdd: true
        })

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarNucleo').click(function() {
            mostrarContenido('contenidoNucleo')
        })
    }

    function contenidoTrabajadores(idestablecimiento) {
        /* MBF */
        var selIRow, selICol = 4,
            colini = 4,
            colfin = 4


        $('#listaTrabajador').jqGrid({
            url: '/sisfac/funcionesphp/adminTrabajador.php?f=1&idestablecimiento=' + idestablecimiento,
            datatype: "xml",
            colNames: ['id', 'idtrabajador', 'idtrabajadorSector', '', 'Establecimiento', 'Establecimiento', 'Trabajador', 'Grupo profesional', 'Sector', 'Opcion'],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idtrabajador',
                index: 'idtrabajador',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idtrabajadorSector',
                index: 'idtrabajadorSector',
                width: 200,
                hidden: true
            }, {
                name: 'idsector',
                index: 'idsector',
                width: 200,
                hidden: true
            }, {
                name: 'idestablecimiento',
                index: 'idestablecimiento',
                width: 200,
                editable: true,
                hidden: true,
                edittype: 'select',
                editrules: {
                    edithidden: true
                },
                editoptions: {
                    dataUrl: '/sisfac/funcionesphp/adminEstablecimiento.php?f=2'
                }
            }, {
                name: 'nombreEstablecimiento',
                index: 'nombreEstablecimiento',
                width: 150
            }, {
                name: 'nombreCompleto',
                index: 'nombreCompleto',
                width: 200,
                editable: true
            }, {
                name: 'grupoProfesional',
                index: 'grupoProfesional',
                width: 180,
                editable: true,
                edittype: 'select',
                editoptions: {
                    value: 'MEDICO CIRUJANO:MEDICO CIRUJANO;LIC. EN ENFERMERIA:LIC. EN ENFERMERIA;OBSTETRA:OBSTETRA;TEC. EN ENFERMERIA:TEC. EN ENFERMERIA;CIRUJANO DENTISTA:CIRUJANO DENTISTA;BIOLOGO(A):BIOLOGO(A);PSICOLOGO(A):PSICOLOGO(A);TEC. INFORMATICO:TEC. INFORMATICO;TEC. EN FARMACIA:TEC. EN FARMACIA;ASISTENTE(A) SOCIAL:ASISTENTE(A) SOCIAL'
                }

            }, {
                name: 'sector',
                index: 'sector',
                width: 150,
                hidden: true
            }, {
                name: '',
                index: '',
                width: 200,
                hidden: true
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'tra.idtrabajador',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de trabajadores",
            editurl: '/sisfac/funcionesphp/adminTrabajador.php',
            pager: '#pagerTrabajador',
            //cellEdit: true,
            cellsubmit: 'clientArray',
            beforeEditCell: function(rowid, cellname, value, iRow, iCol) {
                selICol = iCol, selIRow = iRow
            },
            afterEditCell: function(rowid, cellname, value, iRow, iCol) {
                editarEnLinea('listaTrabajador', iRow, iCol, cellname)
            },
            afterSaveCell: function(rowid, cellname, value, iRow, iCol) {
                lista = $('#listaTrabajador').jqGrid('getRowData', rowid)
                    //alert(lista.nombreEstablecimiento)
                if (!lista.nombreCompleto) {
                    alert('Debe ingresar el nombre del trabajador')
                    return
                }

                $.post('/sisfac/funcionesphp/adminTrabajador.php?' + cellname + '=' + value, {
                    oper: 'edit',
                    id: rowid,
                    idtrabajador: lista.idtrabajador,
                    idestablecimiento: $('#listaEstablecimientoNucleo').jqGrid('getGridParam', 'selrow')
                }, function(data) {
                    if (rowid == 'nuevo') $('#listaTrabajador').trigger('reloadGrid')
                })
            },
            loadComplete: function(data) {
                if (selIRow == undefined || selIRow == '') selIRow = $("#listaTrabajador").jqGrid("getGridParam", "reccount") + 1
                if (selIRow > $("#listaTrabajador").jqGrid("getGridParam", "reccount") + 1) selIRow = 1
                agregarFila('listaTrabajador', selIRow, selICol)
            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                if (rowid == 'nuevo') {
                    alert('Tiene que seleccionar un registro con datos')
                    return
                }
                //temp = $('#listaTrabajador').jqGrid('getRowData',$('#listaTrabajador').jqGrid('getGridParam','selrow'))

                // MBF 
                //lsc.actualizarConDato($('#listaEstablecimientoNucleo').jqGrid('getGridParam','selrow'),temp.idtrabajador)
                $('#listaTrabajador').setSelection(rowid, false);
                listaTrabajadorSectores(idestablecimiento);
                $('#dialogSectores').dialog('open')
            }
        });
        $('#listaTrabajador').jqGrid('navGrid', '#pagerTrabajador', {
            edit: false,
            add: false,
            del: false,
            search: false,
            view: false
        }, {}, {}, {
            onclickSubmit: function(params) {
                lista = $('#listaTrabajador').jqGrid('getRowData', $('#listaTrabajador').jqGrid('getGridParam', 'selrow'))
                    //alert(lista.idtrabajadorSector)
                return {
                    idtrabajadorSector: lista.idtrabajadorSector,
                    idsector: lista.idsector
                };
            }
        });

        // MBF
        function listaTrabajadorSectores(idestablecimiento) {


            $('#dialogSectores').dialog({
                modal: true,
                autoOpen: false,
                show: 'blind',
                hide: 'drop',
                width: 'auto',
                height: 'auto',
                buttons: {
                    Aceptar: function() {
                        temp = $('#listaTrabajador').jqGrid('getRowData', $('#listaTrabajador').jqGrid('getGridParam', 'selrow'))
                        $('#listaTrabajador').jqGrid('resetSelection');

                        var ids = [];
                        $("#dialogSectores input:checkbox:checked").each(function() {
                            ids.push($(this).val());
                        });

                        $.ajax({
                            url: '/sisfac/funcionesphp/adminTrabajadorSector.php',
                            type: 'post',
                            data: {
                                oper: 'add',
                                idtrabajador: temp.idtrabajador,
                                "ids[]": ids
                            },
                            dataType: 'JSON',
                            success: function(respuesta) {

                                $('#dialogSectores').dialog('close');
                            },
                            error: function() {
                                $('#dialogSectores').dialog('close');
                            }
                        });

                    },
                    Cancelar: function() {
                        $('#dialogSectores').dialog('close')
                    }
                }
            });

            var lsc = new ListaSectorComunidadMultiselect($('#dialogSectores'), idestablecimiento);


            $('#dialogSectores').dialog('open');
        }

        function editarEnLinea(idLista, iRow, iCol, cellname) {
            var inputControl = $('#' + (iRow) + '_' + cellname);
            inputControl.bind("keydown", function(e) {
                if (e.keyCode === 13) {
                    var lastRowInd = $("#" + idLista).jqGrid("getGridParam", "reccount")
                    if (iCol == colfin) {
                        selIRow++
                        selICol = colini
                    } else selICol++
                        if (lastRowInd >= selIRow) $("#" + idLista).jqGrid("editCell", selIRow, selICol, true).select().focus();
                }
            })
            validarCaracteres()
        }
        $('#aRegresarEstablecimientoNucleo').click(function() {
            mostrarContenido('contenidoEstablecimientoNucleo')
        })


    }

    function contenidoTrabajadorSector(idtrabajador) {
        var selIRow, selICol = 4,
            colini = 4,
            colfin = 5

        $('#listaTrabajadorSector').jqGrid({
            url: '/sisfac/funcionesphp/adminTrabajadorSector.php?f=1&idtrabajador=' + idtrabajador,
            datatype: "xml",
            colNames: ['tse.idtrabajadorSector', 'sec.idsector', 'Trabajador', 'Comunidad', 'Sector'],
            colModel: [{
                name: 'idtrabajadorSector',
                index: 'idtrabajadorSector',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idsector',
                index: 'idsector',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'nombreCompleto',
                index: 'nombreCompleto',
                width: 250
            }, {
                name: 'nombreComunidad',
                index: 'nombreComunidad',
                width: 250
            }, {
                name: 'nombreSector',
                index: 'nombreSector',
                width: 250
            }],
            height: 400,
            width: 'auto',
            rowNum: 100,
            rowList: [100, 200, 300],
            rownumbers: true,
            sortname: 'nombreSector',
            pginput: false,
            sortorder: 'asc',
            viewrecords: true,
            caption: "Registro de sectores",
            editurl: '/sisfac/funcionesphp/adminTrabajadorSector.php',
            pager: '#pagerTrabajadorSector'
        });
        $('#listaTrabajadorSector').jqGrid('navGrid', '#pagerTrabajadorSector', {
            edit: false,
            add: false,
            del: true,
            search: false,
            view: false
        }, {}, {}, {})

        $('#aRegresarTrabajadores').click(function() {
            mostrarContenido('contenidoTrabajadores')
        })

    }


    function eliminarFuncion() {
        $('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbOpcion5,#cbSeleccionar').html("<option value=''>SELECCIONE UNA OPCION</option>")
        $('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbOpcionR5,#cbSeleccionarR').html("<option value=''>SELECCIONE UNA OPCION</option>")
        $('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbOpcionE5,#cbSeleccionarEstadistico').html("<option value=''>SELECCIONE UNA OPCION</option>")
        $('cbOpcionEt1,#cbOpcionEt2,#cbOpcionEt3,#cbOpcionEt4,#cbOpcionEt5,#cbSeleccionarEtapa').html("<option value=''>SELECCIONE UNA OPCION</option>")
        $('#cbOpcionS1,#cbOpcionS2,#cbOpcionS3,#cbOpcionS4,#cbOpcionS5,#cbSeleccionSocioeconomico').html("<option value=''>SELECCIONE UNA OPCION</option>")
        $('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbOpcion5,#cbSeleccionar').unbind('load').unbind('change');
        $('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbOpcionR5,#cbSeleccionarR').unbind('load').unbind('change');
        $('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbOpcionE5,#cbSeleccionarEstadistico').unbind('load').unbind('change');
        $('#cbOpcionEt1,#cbOpcionEt2,#cbOpcionEt3,#cbOpcionEt4,#cbOpcionEt5,#cbSeleccionarEtapa').unbind('load').unbind('change');
        $('#cbOpcionS1,#cbOpcionS2,#cbOpcionS3,#cbOpcionS4,#cbOpcionS5,#cbSeleccionSocioeconomico').unbind('load').unbind('change');
    }

    function contenidoReporteEstadistico() {
        var tabsReportes = Array(),
            funcionesR = ['', 'segundoTabReporte();', 'tercerTabReporte();', 'cuartoTabReporte();', 'quintoTabReporte();', 'sextoTabReporte();'];

        function primerTabReporte() {

        }

        function segundoTabReporte() {

        }

        function iniciarTabsR() {
            $('#tabsReportes').show();
            $('#tabsReportes').tabs({
                selected: 0,
                select: function(event, ui) {
                    if (tabsReportes.indexOf(ui.index) == -1) {
                        tabsReportes.push(ui.index);
                        eval(funcionesR[ui.tab.toString().substr(ui.tab.toString().indexOf('#') + 4) - 1]);
                    }
                }
            })
        }
        iniciarTabsR()
        primerTabReporte()

        $('#cbAtributoEstadistico,#cbAtributoEstadistico1,#cbSeleccionarEstadistico,#cbSeleccionarEstadistico1').width(200)
        $('#cbAtributoEstadistico').change(function() {
            eliminarFuncion()
            if ($('#cbAtributoEstadistico').val() == 'DISA/DIRESA') {
                eliminarFuncion()
                mostrarSelectE('#cbSeleccionarEstadistico')
                $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminDiresa.php', {
                    f: 3
                }, function(data) {})
            } else if ($('#cbAtributoEstadistico').val() == 'REGION') {
                eliminarFuncion()
                mostrarSelectE('#cbSeleccionarEstadistico')
                $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {})
            } else if ($('#cbAtributoEstadistico').val() == 'PROVINCIA') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcionE1').prepend("<option>SELECCIONE UNA REGION</option>")
                }).change(function() {
                    $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcionE1').val()
                    }, function(data) {})
                })
            } else if ($('#cbAtributoEstadistico').val() == 'DISTRITO') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcionE1').prepend("<option>SELECCIONE UNA REGION</option>")
                }).change(function() {
                    $('#cbOpcionE2').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcionE1').val()
                    }, function(data) {
                        $('#cbOpcionE2').prepend("<option>SELECCIONE UNA PROVINCIA</option>")
                    }).change(function() {
                        $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminDistrito.php', {
                            f: 3,
                            idprovincia: $('#cbOpcionE2').val()
                        }, function(data) {})
                    })
                })
            } else if ($('#cbAtributoEstadistico').val() == 'SECTOR') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbOpcionE5,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcionE1').prepend("<option>SELECCIONE UNA REGION</option>")
                }).change(function() {
                    $('#cbOpcionE2').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcionE1').val()
                    }, function(data) {
                        $('#cbOpcionE2').prepend("<option>SELECCIONE UNA PROVINCIA</option>")
                    }).change(function() {
                        $('#cbOpcionE3').load('/sisfac/funcionesphp/adminDistrito.php', {
                            f: 3,
                            idprovincia: $('#cbOpcionE2').val()
                        }, function(data) {
                            $('#cbOpcionE3').prepend("<option>SELECCIONE UN DISTRITO</option>")
                        }).change(function() {
                            $('#cbOpcionE4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                f: 3,
                                iddistrito: $('#cbOpcionE3').val()
                            }, function(data) {
                                $('#cbOpcionE4').prepend("<option>SELECCIONE UN ESTABLECIMIENTO</option>")
                            }).change(function() {
                                $('#cbOpcionE5').load('/sisfac/funcionesphp/adminComunidad.php', {
                                    f: 3,
                                    idestablecimiento: $('#cbOpcionE4').val()
                                }, function(data) {
                                    $('#cbOpcionE5').prepend("<option>SELECCIONE UNA COMUNIDAD</option>")
                                }).change(function() {
                                    $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminSector.php', {
                                        f: 3,
                                        nombreComunidad: $('#cbOpcionE5 option:selected').text()
                                    }, function(data) {
                                        $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UN SECTOR</option>")
                                    })
                                })
                            })
                        })
                    })
                })
            } else if ($('#cbAtributoEstadistico').val() == 'COMUNIDAD') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminRegion.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionE1').prepend("<option>SELECCIONE UNA REGION</option>")
                    }).change(function() {
                        $('#cbOpcionE2').load('/sisfac/funcionesphp/adminProvincia.php', {
                            f: 3,
                            idregion: $('#cbOpcionE1').val()
                        }, function(data) {
                            $('#cbOpcionE2').prepend("<option>SELECCIONE UNA PROVINCIA</option>")
                        }).change(function() {
                            $('#cbOpcionE3').load('/sisfac/funcionesphp/adminDistrito.php', {
                                f: 3,
                                idprovincia: $('#cbOpcionE2').val()
                            }, function(data) {
                                $('#cbOpcionE3').prepend("<option>SELECCIONE UN DISTRITO</option>")
                            }).change(function() {
                                $('#cbOpcionE4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                    f: 3,
                                    iddistrito: $('#cbOpcionE3').val()
                                }, function(data) {
                                    $('#cbOpcionE4').prepend("<option>SELECCIONE UN ESTABLECIMIENTO</option>")
                                }).change(function() {
                                    $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminComunidad.php', {
                                        f: 3,
                                        idestablecimiento: $('#cbOpcionE4').val()
                                    }, function(data) {
                                        $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UNA COMUNIDAD</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminComunidad.php', {f:5}, function(data){})
            } else if ($('#cbAtributoEstadistico').val() == 'RED') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionE1').prepend("<option>SELECCIONE UNA DIRESA</option>")
                    }).change(function() {
                        $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionE1').val()
                        }, function(data) {
                            $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UNA RED</option>")
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminRed.php', {f:4}, function(data){})
            } else if ($('#cbAtributoEstadistico').val() == 'MICRORED') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionE1').prepend("<option>SELECCIONE UNA DIRESA</option>")
                    }).change(function() {
                        $('#cbOpcionE2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionE1').val()
                        }, function(data) {
                            $('#cbOpcionE2').prepend("<option>SELECCIONE UNA RED</option>")
                        }).change(function() {
                            $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionE2').val()
                            }, function(data) {
                                $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UNA MICRORED</option>")
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminMicrored.php', {f:4}, function(data){})
            } else if ($('#cbAtributoEstadistico').val() == 'NUCLEO') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionE1').prepend("<option>SELECCIONE UNA DIRESA</option>")
                    }).change(function() {
                        $('#cbOpcionE2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionE1').val()
                        }, function(data) {
                            $('#cbOpcionE2').prepend("<option>SELECCIONE UNA RED</option>")
                        }).change(function() {
                            $('#cbOpcionE3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionE2').val()
                            }, function(data) {
                                $('#cbOpcionE3').prepend("<option>SELECCIONE UNA MICRORED</option>")
                            }).change(function() {
                                $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcionE3').val()
                                }, function(data) {
                                    $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UN NUCLEO</option>")
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminNucleo.php', {f:4}, function(data){})
            } else if ($('#cbAtributoEstadistico').val() == 'ESTABLECIMIENTO') {
                eliminarFuncion()
                mostrarSelectE('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbSeleccionarEstadistico')
                $('#cbOpcionE1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionE1').prepend("<option>SELECCIONE UNA DIRESA</option>")
                    }).change(function() {
                        $('#cbOpcionE2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionE1').val()
                        }, function(data) {
                            $('#cbOpcionE2').prepend("<option>SELECCIONE UNA RED</option>")
                        }).change(function() {
                            $('#cbOpcionE3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionE2').val()
                            }, function(data) {
                                $('#cbOpcionE3').prepend("<option>SELECCIONE UNA MICRORED</option>")
                            }).change(function() {
                                $('#cbOpcionE4').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcionE3').val()
                                }, function(data) {
                                    $('#cbOpcionE4').prepend("<option>SELECCIONE UNA NUCLEO</option>")
                                }).change(function() {
                                    $('#cbSeleccionarEstadistico').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                        f: 3,
                                        idnucleo: $('#cbOpcionE4').val()
                                    }, function(data) {
                                        $('#cbSeleccionarEstadistico').prepend("<option>SELECCIONE UN ESTABLECIMIENTO</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminEstablecimiento.php', {f:5}, function(data){})
            } else {
                eliminarFuncion()
                $('#cbSeleccionarEstadistico').html("<option  value=''>SELECCIONE UNA OPCION</option>")
            }


        })

        function validarFechaMayor(fechaInicial, fechaFinal) {
            valuesStart = fechaInicial.split("/");
            valuesEnd = fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual
            var dateStart = new Date(valuesStart[2], (valuesStart[1] - 1), valuesStart[0]);
            var dateEnd = new Date(valuesEnd[2], (valuesEnd[1] - 1), valuesEnd[0]);
            if (dateStart >= dateEnd) return true;
            else return false;
        }

        $('#tbFechaEstadistico,#tbFechaIncioEstadistico,#tbFechaFinEstadistico').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true
        })

        $('#cbAtributoEstadistico1').change(function() {
            if ($('#cbAtributoEstadistico1').val() == 'SOCIOECONOMICO') $('#cbSeleccionarEstadistico1').html("<option value='ESTADO CIVIL DEL JEFE DE FAMILIA'>ESTADO CIVIL DEL JEFE DE FAMILIA</option><option value='GRUPO FAMILIAR'>GRUPO FAMILIAR</option><option value='TENENCIA DE LA VIVIENDA'>TENENCIA DE LA VIVIENDA</option><option value='AGUA DE CONSUMO'>AGUA DE CONSUMO</option><option value='ELIMINACION DE EXCRETAS'>ELIMINACION DE EXCRETAS</option><option value='CUANTAS HABITACIONES HAY EN HOGAR'>CUANTAS HABITACIONES HAY EN HOGAR</option><option value='ENERGIA ELECTRICA(EE)'>ENERGIA ELECTRICA(EE)</option><option value='NIVEL DE INSTRUCCION DE LA MADRE'>NIVEL DE INSTRUCCION DE LA MADRE</option><option value='OCUPACION JEFE DE LA FAMILIA'>OCUPACION JEFE DE LA FAMILIA</option><option value='INGRESOS FAMILIARES'>INGRESOS FAMILIARES</option><option value='NRO DE PERSONAS X DORMITORIO'>NRO DE PERSONAS X DORMITORIO</option><option value='SALUD EN EL HOGAR'>SALUD EN EL HOGAR</option>")
            else if ($('#cbAtributoEstadistico1').val() == 'VIVIENDA Y ENTORNO') $('#cbSeleccionarEstadistico1').html("<option value='TIPO DE VIVIENDA'>TIPO DE VIVIENDA</option><option value='MATERIAL DE PAREDES'>MATERIAL DE PAREDES</option><option value='MATERIAL DEL PISO'>MATERIAL DEL PISO</option><option value='MATERIAL DE TECHO'>MATERIAL DE TECHO</option><option value='ORGANIZACION DE LA VIVIENDA'>ORGANIZACION DE LA VIVIENDA</option><option value='ARTEFACTOS DEL HOGAR'>ARTEFACTOS DEL HOGAR</option><option value='COMBUSTIBLE PARA COCINAR'>COMBUSTIBLE PARA COCINAR</option><option value='DISPOSICION DE BASURA'>DISPOSICION DE BASURA</option><option value='TENENCIA DE ANIMALES'>TENENCIA DE ANIMALES</option><option value='VACUNAS'>VACUNAS</option><option value='RIESGO X ENTORNO'>RIESGO X ENTORNO</option><option value='BIOHUERTO'>BIOHUERTO</option>")
        })

        $('#btnVerExcelEstadistico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributoEstadistico').val() == '' || $('#cbSeleccionar').val() == '' || $('#cbAtributoEstadistico1').val() == '' || $('#cbSeleccionarEstadistico1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            //temp = "&fechaInicio=" + $('#tbFechaIncioEstadistico').val() + "&fechaFin=" + $('#tbFechaFinEstadistico').val()
            //temp = "&fechaFin=" + $('#tbFechaEstadistico').val()
            window.open('/sisfac/app/reportes/reporte_estadistico_socioeconomico_excel.php?f=1&atributo=' + $('#cbAtributo').val() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=' + $('#cbSeleccionarEstadistico1').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnVerReporteEstadistico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#cbAtributoEstadistico1').val() == '' || $('#cbSeleccionarEstadistico1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            // temp = "&fechaFin=" + $('#tbFechaEstadistico').val()

            if ($('#cbAtributoEstadistico1').val() == 'SOCIOECONOMICO') window.open('/sisfac/app/reportes/grafico_familia_socioeconomico.php?f=1&atributo=' + $('#cbAtributo').val() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&tipo=' + $('#cbSeleccionarEstadistico1').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
            else if ($('#cbAtributoEstadistico1').val() == 'VIVIENDA Y ENTORNO') window.open('/sisfac/app/reportes/grafico_familia_entorno.php?f=1&atributo=' + $('#cbAtributo').val() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&tipo=' + $('#cbSeleccionarEstadistico1').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnVerReporteTendencia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#cbAtributoEstadistico1').val() == '' || $('#cbSeleccionarEstadistico1').val() == '' || $('#tbFechaIncioEstadistico').val() == '' || $('#tbFechaFinEstadistico').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaIncioEstadistico').val(), $('#tbFechaFinEstadistico').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }

            temp = "&fechaInicio=" + $('#tbFechaIncioEstadistico').val() + "&fechaFin=" + $('#tbFechaFinEstadistico').val()
                //window.open('/sisfac/app/reportes/reportes.php?f=13&atributo=' + $('#cbAtributo').val()  + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionarEstadistico1').attr('value') + temp + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
            if ($('#cbAtributoEstadistico1').val() == 'SOCIOECONOMICO') window.open('/sisfac/app/reportes/grafico_familia_socio_tendencia.php?f=1&atributo=' + $('#cbAtributo').val() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&tipo=' + $('#cbSeleccionarEstadistico1').val() + temp + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
            else if ($('#cbAtributoEstadistico1').val() == 'VIVIENDA Y ENTORNO') window.open('/sisfac/app/reportes/grafico_familia_entorno_tendencia.php?f=1&atributo=' + $('#cbAtributo').val() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributoEstadistico1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&tipo=' + $('#cbSeleccionarEstadistico1').val() + temp + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })



        // $('#tbFechaReporte').datepicker({dateFormat:'dd/mm/yy',changeYear:true,changeMonth:true})

        $('#tbFechaInicio').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true
        })
        $('#tbFechaFin').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true
        })



        $('#btnReporteEdadSexo').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_poblacion_edad_sexo.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaEdadSexo').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {

        })

        $('#btnGraficoEdadSexo').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaReporte').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/grafico_poblacion_edad_sexo_M.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
            window.open('/sisfac/app/reportes/grafico_poblacion_edad_sexo_F.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteFicha').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_ficha.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaFicha').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {

        })

        $('#btnReportePersonasEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_personas_etapa.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoPersonasEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/grafico_etapa_vida.php?atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaPersonasEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }

            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_etapa_tendencia.php?f=14&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaPersonasEtapaExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_etapa_tendencia_excel.php?f=14&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })


        $('#btnReporteIndocumentadas').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_indocumentadas.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoIndocumentadas').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/grafico_identidad_persona.php?atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaIndocumentadas').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_dni_tendencia.php?f=15&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaIndocumentadasExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_persona_dni_tendencia_excel.php?f=15&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteGestantes').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_gestantes.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoGestantes').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaReporte').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reportes.php?f=9&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaGestantes').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {

        })

        $('#btnReporteVisita').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_personas_visita.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaVisita').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {

        })

        $('#btnReporteVisitaFecha').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_personas_visita_fechas.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaVisitaFecha').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {

        })

        $('#btnGraficoVisita').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/grafico_personas_visita.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteModificacionesFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/reporte_numero_historiales.php?f=1&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoModificacionesFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            temp = "&fechaFin=" + $('#tbFechaReporte').val()
            window.open('/sisfac/app/reportes/grafico_modificaciones_familia.php?f=10&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaModificacionesFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reportes.php?f=16&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteInstruccion').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_personas_instruccion.php?f=1&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=gradoInstruccion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoInstruccion').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/grafico_persona_instruccion.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=gradoInstruccion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaInstruccion').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_grado_tendencia.php?f=17&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })
        $('#btnReporteTendenciaInstruccionExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_grado_tendencia_excel.php?f=17&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteSeguro').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_personas_seguro_sexo.php?f=12&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&opc=' + $('#cbSeleccionar').val() + '&seleccion1=seguroMedico&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoSeguro').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_personas_seguro_sexo_grafico.php?f=12&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&opc=' + $('#cbSeleccionar').val() + '&seleccion1=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaSeguro').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_seguro_tendencia.php?f=18&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTendenciaSeguroExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_seguro_tendencia_excel.php?f=18&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteCicloVital').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_estadistico_familia_ciclo_tipo_excel.php?f=19&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=CICLO VITAL' + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=seguroMedico&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoCicloVital').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/grafico_familia_ciclo.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTipoFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_estadistico_familia_ciclo_tipo_excel.php?f=20&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=TIPO FAMILIA' + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=seguroMedico&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoTipoFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/grafico_familia_tipo.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteCanesFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_familia_canes_excel.php?f=20&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=CANES POR FAMILIA' + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=seguroMedico&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaCanesFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_tendencia_canes.php?f=25&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaCanesFamiliaExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_canes_tendencia_excel.php?f=25&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteFamiliaEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_familia_riesgo_etapa_excel.php?f=20&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=CANES POR FAMILIA' + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=seguroMedico&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoFamiliaEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/grafico_familia_riesgo.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaFamiliaEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_riesgo_etapa_tendencia.php?f=22&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaFamiliaEtapaExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_riesgo_tendencia_excel.php?f=22&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteFamiliaSocioEconomico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_excel.php?f=23&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=SOCIOECONOMICOS' + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnGraficoFamiliaSocioEconomico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/grafico_familia_riesgo_socioeconomico.php?f=23&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaFamiliaSocioEconomico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/grafico_persona_riesgo_socioeconomico_tendencia.php?f=24&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnTendenciaFamiliaSocioEconomicoExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '' || $('#tbFechaInicio').val() == '' || $('#tbFechaFin').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            if (validarFechaMayor($('#tbFechaInicio').val(), $('#tbFechaFin').val())) {
                alert('La fecha fin debe ser mayor a la fecha inicio')
                return
            }
            temp = "&fechaInicio=" + $('#tbFechaInicio').val() + "&fechaFin=" + $('#tbFechaFin').val()
            window.open('/sisfac/app/reportes/reporte_riesgo_socio_tendencia_excel.php?f=24&atributo=' + $('#cbAtributo').val() + temp + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReportePersonaSinLugarNacimiento').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_personas_sin_lugarNacimiento_excel.php?f=24&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteTrabajadorSector').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_trabajador_sector_excel.php?f=24&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&atributo1=' + $('#cbAtributo1').val() + '&seleccion1=' + $('#cbSeleccionar').val() + '&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteDivisionTablas').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_division_tablas_excel.php?f=24&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val() + '&atributo1=GEOPOLITICO&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteDivisionTablasSocioeconomico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_division_tablas_excel.php?f=24&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val() + '&atributo1=SOCIOSANITARIAA&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteRiesgoFamilia').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_riesgo_familia_excel.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val() + '&atributo1=SOCIOSANITARIAA&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        $('#btnReporteSindromesCulturales').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbAtributo').val() == '' || $('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_sindrome_cultural_excel.php?atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigo1=' + $('#cbOpcion5 option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val() + '&atributo1=SOCIOSANITARIAA&opc=ocupacion&titulo=' + $('#cbAtributo option:selected').html() + ' : ' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
        })

        function hacerAutocompletar(label, valor, s) {
            $('#' + label).autocomplete({
                source: "/sisfac/funcionesphp/" + s + "&limit=11",
                minLength: 1,
                focus: function(event, ui) {
                    $('#' + label).val(ui.item.label)
                    $('#' + valor).val(ui.item.value)
                    return false
                },
                select: function(event, ui) {
                    $('#' + label).val(ui.item.label)
                    $('#' + valor).val(ui.item.value)
                    return false
                }
            })
        }
        hacerAutocompletar('tbBuscarCodigoFicha', 'hIdCodigoFicha', 'adminFamilia.php?f=4')


        $('#btnVerReportePoblacion').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=7&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&codigoFicha=' + $('#tbBuscarCodigoFicha').val() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteGestantes').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=1&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteCicloVital').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=2&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteTipo').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=3&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteSeguro').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=4&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteVisita1').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=5&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerReporteVisitaF').button({
                icons: {
                    primary: "ui-icon-print"
                }
            }).click(function() {
                if ($('#cbSeleccionar').val() == '') {
                    alert('Debe seleccionar un valor')
                    return
                }
                window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=6&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
            })
            /*
                    $('#btnVerReporteVisitaF').button({icons: {primary: "ui-icon-print"}}).click(function(){
                        
                        window.open('/sisfac/app/reportes/reporte_poblacion_excel.php?f=1&opc=6&atributo=' + $('#cbAtributo').val() +  '&seleccion=' + $('#cbSeleccionar option:selected').html(), '', 'toolbar=false')
                    })*/
        $('#btnVerReportePiramide').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/reporte_piramide.php?f=1&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerGraficoPiramide').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/grafico_piramide_poblacional.php?f=1&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })
        $('#btnVerGraficoPiramidePorcentual').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionar').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            window.open('/sisfac/app/reportes/grafico_piramide_poblacional_porcentual.php?f=1&atributo=' + $('#cbAtributo').val() + '&seleccion=' + $('#cbSeleccionar option:selected').html() + '&seleccion1=' + $('#cbSeleccionar').val(), '', 'toolbar=false')
        })


        function mostrarSelect(cb) {
            $('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbOpcion5,#cbSeleccionar').hide()
            $(cb).show()
            $('#tdOpcion1,#tdOpcion2,#tdOpcion3,#tdOpcion4,#tdOpcion5,#tdSeleccionar').text(' ')
            if ($('#cbAtributo').val() == 'SECTOR') {
                $('#tdOpcion1').text('REGION')
                $('#tdOpcion2').text('PROVINCIA')
                $('#tdOpcion3').text('DISTRITO')
                $('#tdOpcion4').text('ESTABLECIMIENTO')
                $('#tdOpcion5').text('COMUNIDAD')
                $('#tdSeleccionar').text('SECTOR')
            } else if ($('#cbAtributo').val() == 'COMUNIDAD') {
                $('#tdOpcion1').text('REGION')
                $('#tdOpcion2').text('PROVINCIA')
                $('#tdOpcion3').text('DISTRITO')
                $('#tdOpcion4').text('ESTABLECIMIENTO')
                $('#tdSeleccionar').text('COMUNIDAD')
            } else if ($('#cbAtributo').val() == 'DISTRITO') {
                $('#tdOpcion1').text('REGION')
                $('#tdOpcion2').text('PROVINCIA')
                $('#tdSeleccionar').text('DISTRITO')
            } else if ($('#cbAtributo').val() == 'PROVINCIA') {
                $('#tdOpcion1').text('REGION')
                $('#tdSeleccionar').text('PROVINCIA')
            } else if ($('#cbAtributo').val() == 'REGION') {
                $('#tdSeleccionar').text('REGION')
            } else if ($('#cbAtributo').val() == 'DISA/DIRESA') {
                $('#tdSeleccionar').text('DISA/DIRESA')
            } else if ($('#cbAtributo').val() == 'ESTABLECIMIENTO') {
                $('#tdOpcion1').text('DISA/DIRESA')
                $('#tdOpcion2').text('RED')
                $('#tdOpcion3').text('MICRORED')
                $('#tdOpcion4').text('NUCLEO')
                $('#tdSeleccionar').text('ESTABLECIMIENTO')
            } else if ($('#cbAtributo').val() == 'NUCLEO') {
                $('#tdOpcion1').text('DISA/DIRESA')
                $('#tdOpcion2').text('RED')
                $('#tdOpcion3').text('MICRORED')
                $('#tdSeleccionar').text('NUCLEO')
            } else if ($('#cbAtributo').val() == 'MICRORED') {
                $('#tdOpcion1').text('DISA/DIRESA')
                $('#tdOpcion2').text('RED')
                $('#tdSeleccionar').text('MICRORED')
            } else if ($('#cbAtributo').val() == 'RED') {
                $('#tdOpcion1').text('DISA/DIRESA')
                $('#tdSeleccionar').text('RED')
            }
        }

        function mostrarSelectE(cb) {
            $('#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbOpcionE5,#cbSeleccionarEstadistico').hide()
            $(cb).show()
        }

        mostrarSelect('')
        mostrarSelectE('')

        $('#cbAtributo1,#cbSeleccionar,#cbSeleccionar1,#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbOpcion5,#cbSeleccionarEstadistico,#cbOpcionE1,#cbOpcionE2,#cbOpcionE3,#cbOpcionE4,#cbOpcionE5').width(300)
        $('#cbAtributo').width(300).height(190)

        seleccion = ['DISA/DIRESA', 'REGION', 'PROVINCIA', 'DISTRITO', 'COMUNIDAD', 'SECTOR', 'RED', 'MICRORED', 'NUCLEO', 'ESTABLECIMIENTO'];

        $("#selectable").selectable({
            stop: function() {
                var result = $("#select-result").empty();
                $(".ui-selected", this).each(function() {
                    var index = $("#selectable li").index(this);
                    $('#cbAtributo').val(seleccion[index]).trigger('change')
                        //$( "#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbSeleccionar" ).selectmenu();
                });
            }
        })



        $('#cbAtributo').change(function() {
            eliminarFuncion()
            if ($('#cbAtributo').val() == 'DISA/DIRESA') {
                eliminarFuncion()
                mostrarSelect('#cbSeleccionar')
                $('#cbSeleccionar').load('/sisfac/funcionesphp/adminDiresa.php', {
                    f: 3
                }, function(data) {
                    $('#cbSeleccionar').prepend("<option value='' selected>SELECCIONE UNA OPCION</option>")
                })
            } else if ($('#cbAtributo').val() == 'REGION') {
                eliminarFuncion()
                mostrarSelect('#cbSeleccionar')
                $('#cbSeleccionar').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbSeleccionar').prepend("<option value='' selected>SELECCIONE UNA OPCION</option>")
                })
            } else if ($('#cbAtributo').val() == 'PROVINCIA') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                }).change(function() {
                    $('#cbSeleccionar').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcion1').val()
                    }, function(data) {})
                })
            } else if ($('#cbAtributo').val() == 'DISTRITO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                }).change(function() {
                    $('#cbOpcion2').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcion1').val()
                    }, function(data) {
                        $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbSeleccionar').load('/sisfac/funcionesphp/adminDistrito.php', {
                            f: 3,
                            idprovincia: $('#cbOpcion2').val()
                        }, function(data) {})
                    })
                })
            } else if ($('#cbAtributo').val() == 'SECTOR') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbOpcion5,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminRegion.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcion2').load('/sisfac/funcionesphp/adminProvincia.php', {
                            f: 3,
                            idregion: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcion3').load('/sisfac/funcionesphp/adminDistrito.php', {
                                f: 3,
                                idprovincia: $('#cbOpcion2').val()
                            }, function(data) {
                                $('#cbOpcion3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcion4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                    f: 3,
                                    iddistrito: $('#cbOpcion3').val()
                                }, function(data) {
                                    $('#cbOpcion4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbOpcion5').load('/sisfac/funcionesphp/adminComunidad.php', {
                                        f: 3,
                                        idestablecimiento: $('#cbOpcion4').val()
                                    }, function(data) {
                                        $('#cbOpcion5').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    }).change(function() {
                                        $('#cbSeleccionar').load('/sisfac/funcionesphp/adminSector.php', {
                                            f: 3,
                                            nombreComunidad: $('#cbOpcion5 option:selected').text()
                                        }, function(data) {
                                            $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                        })
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminSector.php', {f:5}, function(data){})
            } else if ($('#cbAtributo').val() == 'COMUNIDAD') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminRegion.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcion2').load('/sisfac/funcionesphp/adminProvincia.php', {
                            f: 3,
                            idregion: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcion3').load('/sisfac/funcionesphp/adminDistrito.php', {
                                f: 3,
                                idprovincia: $('#cbOpcion2').val()
                            }, function(data) {
                                $('#cbOpcion3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcion4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                    f: 3,
                                    iddistrito: $('#cbOpcion3').val()
                                }, function(data) {
                                    $('#cbOpcion4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbSeleccionar').load('/sisfac/funcionesphp/adminComunidad.php', {
                                        f: 3,
                                        idestablecimiento: $('#cbOpcion4').val()
                                    }, function(data) {
                                        $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminComunidad.php', {f:5}, function(data){})
            } else if ($('#cbAtributo').val() == 'RED') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbSeleccionar').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminRed.php', {f:4}, function(data){})
            } else if ($('#cbAtributo').val() == 'MICRORED') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcion2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbSeleccionar').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcion2').val()
                            }, function(data) {
                                $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminMicrored.php', {f:4}, function(data){})
            } else if ($('#cbAtributo').val() == 'NUCLEO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcion2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcion3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcion2').val()
                            }, function(data) {
                                $('#cbOpcion3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbSeleccionar').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcion3').val()
                                }, function(data) {
                                    $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminNucleo.php', {f:4}, function(data){})
            } else if ($('#cbAtributo').val() == 'ESTABLECIMIENTO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbSeleccionar')
                $('#cbOpcion1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcion1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcion2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcion1').val()
                        }, function(data) {
                            $('#cbOpcion2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcion3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcion2').val()
                            }, function(data) {
                                $('#cbOpcion3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcion4').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcion3').val()
                                }, function(data) {
                                    $('#cbOpcion4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbSeleccionar').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                        f: 3,
                                        idnucleo: $('#cbOpcion4').val()
                                    }, function(data) {
                                        $('#cbSeleccionar').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminEstablecimiento.php', {f:5}, function(data){})
            } else {
                eliminarFuncion()
                $('#cbSeleccionar').html("<option  value=''>SELECCIONE UNA OPCION</option>")
            }
        })

        $('#cbAtributo1').change(function() {
            if ($('#cbAtributo1').val() == 'SOCIOECONOMICO') $('#cbSeleccionar1').html("<option value='ESTADO CIVIL DEL JEFE DE FAMILIA'>ESTADO CIVIL DEL JEFE DE FAMILIA</option><option value='GRUPO FAMILIAR'>GRUPO FAMILIAR</option><option value='TENENCIA DE LA VIVIENDA'>TENENCIA DE LA VIVIENDA</option><option value='AGUA DE CONSUMO'>AGUA DE CONSUMO</option><option value='ELIMINACION DE EXCRETAS'>ELIMINACION DE EXCRETAS</option><option value='CUANTAS HABITACIONES HAY EN HOGAR'>CUANTAS HABITACIONES HAY EN HOGAR</option><option value='TIPO DE HABITACIONES'>TIPO DE HABITACIONES</option><option value='ENERGIA ELECTRICA(EE)'>ENERGIA ELECTRICA(EE)</option><option value='NIVEL DE INSTRUCCION DE LA MADRE'>NIVEL DE INSTRUCCION DE LA MADRE</option><option value='OCUPACION JEFE DE LA FAMILIA'>OCUPACION JEFE DE LA FAMILIA</option><option value='INGRESOS FAMILIARES'>INGRESOS FAMILIARES</option><option value='NRO DE PERSONAS X DORMITORIO'>NRO DE PERSONAS X DORMITORIO</option><option value='SALUD EN EL HOGAR'>SALUD EN EL HOGAR</option>")
            else if ($('#cbAtributo1').val() == 'VIVIENDA Y ENTORNO') $('#cbSeleccionar1').html("<option value='TIPO DE VIVIENDA'>TIPO DE VIVIENDA</option><option value='MATERIAL DE PAREDES'>MATERIAL DE PAREDES</option><option value='MATERIAL DEL PISO'>MATERIAL DEL PISO</option><option value='MATERIAL DE TECHO'>MATERIAL DE TECHO</option><option value='ORGANIZACION DE LA VIVIENDA'>ORGANIZACION DE LA VIVIENDA</option><option value='ARTEFACTOS DEL HOGAR'>ARTEFACTOS DEL HOGAR</option><option value='COMBUSTIBLE PARA COCINAR'>COMBUSTIBLE PARA COCINAR</option><option value='DISPOSICION DE BASURA'>DISPOSICION DE BASURA</option><option value='TENENCIA DE ANIMALES'>TENENCIA DE ANIMALES</option><option value='VACUNAS'>VACUNAS</option><option value='RIESGO X ENTORNO'>RIESGO X ENTORNO</option><option value='BIOHUERTO'>BIOHUERTO</option>")
        })

    }

    function contenidoReporteEtapa() {
        $('#tbFechaIncioEtapa,#tbFechaFinEtapa').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            changeMonth: true
        })
        $('#cbOpcionEt1,#cbOpcionEt2,#cbOpcionEt3,#cbOpcionEt4,#cbOpcionEt5,#cbSeleccionarEtapa,#cbAtributoEtapa').width(200)

        $('#cbSeleccionarR,#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbOpcionR5').width(300)
        $('#cbAtributoRiesgo').width(300).height(190)

        seleccion = ['DISA/DIRESA', 'REGION', 'PROVINCIA', 'DISTRITO', 'COMUNIDAD', 'SECTOR', 'RED', 'MICRORED', 'NUCLEO', 'ESTABLECIMIENTO'];

        $("#selectableRiesgo").selectable({
            stop: function() {
                var result = $("#select-result").empty();
                $(".ui-selected", this).each(function() {
                    var index = $("#selectableRiesgo li").index(this);
                    $('#cbAtributoRiesgo').val(seleccion[index]).trigger('change')
                        //$( "#cbOpcion1,#cbOpcion2,#cbOpcion3,#cbOpcion4,#cbSeleccionar" ).selectmenu();
                });
            }
        })



        $('#cbAtributoRiesgo').change(function() {
            eliminarFuncion()
            if ($('#cbAtributoRiesgo').val() == 'DISA/DIRESA') {
                eliminarFuncion()
                mostrarSelect('#cbSeleccionarR')
                $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminDiresa.php', {
                    f: 3
                }, function(data) {
                    $('#cbSeleccionarR').prepend("<option value = '' selected>SELECCIONE UNA OPCION</option>")
                })
            } else if ($('#cbAtributoRiesgo').val() == 'REGION') {
                eliminarFuncion()
                mostrarSelect('#cbSeleccionarR')
                $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbSeleccionarR').prepend("<option value = '' selected>SELECCIONE UNA OPCION</option>")
                })
            } else if ($('#cbAtributoRiesgo').val() == 'PROVINCIA') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                }).change(function() {
                    $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcionR1').val()
                    }, function(data) {})
                })
            } else if ($('#cbAtributoRiesgo').val() == 'DISTRITO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminRegion.php', {
                    f: 3
                }, function(data) {
                    $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                }).change(function() {
                    $('#cbOpcionR2').load('/sisfac/funcionesphp/adminProvincia.php', {
                        f: 3,
                        idregion: $('#cbOpcionR1').val()
                    }, function(data) {
                        $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminDistrito.php', {
                            f: 3,
                            idprovincia: $('#cbOpcionR2').val()
                        }, function(data) {})
                    })
                })
            } else if ($('#cbAtributoRiesgo').val() == 'SECTOR') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbOpcionR5,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminRegion.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcionR2').load('/sisfac/funcionesphp/adminProvincia.php', {
                            f: 3,
                            idregion: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcionR3').load('/sisfac/funcionesphp/adminDistrito.php', {
                                f: 3,
                                idprovincia: $('#cbOpcionR2').val()
                            }, function(data) {
                                $('#cbOpcionR3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcionR4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                    f: 3,
                                    iddistrito: $('#cbOpcionR3').val()
                                }, function(data) {
                                    $('#cbOpcionR4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbOpcionR5').load('/sisfac/funcionesphp/adminComunidad.php', {
                                        f: 3,
                                        idestablecimiento: $('#cbOpcionR4').val()
                                    }, function(data) {
                                        $('#cbOpcionR5').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    }).change(function() {
                                        $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminSector.php', {
                                            f: 3,
                                            nombreComunidad: $('#cbOpcionR5 option:selected').text()
                                        }, function(data) {
                                            $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                        })
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminSector.php', {f:5}, function(data){})
            } else if ($('#cbAtributoRiesgo').val() == 'COMUNIDAD') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminRegion.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcionR2').load('/sisfac/funcionesphp/adminProvincia.php', {
                            f: 3,
                            idregion: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcionR3').load('/sisfac/funcionesphp/adminDistrito.php', {
                                f: 3,
                                idprovincia: $('#cbOpcionR2').val()
                            }, function(data) {
                                $('#cbOpcionR3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcionR4').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                    f: 3,
                                    iddistrito: $('#cbOpcionR3').val()
                                }, function(data) {
                                    $('#cbOpcionR4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminComunidad.php', {
                                        f: 3,
                                        idestablecimiento: $('#cbOpcionR4').val()
                                    }, function(data) {
                                        $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminComunidad.php', {f:5}, function(data){})
            } else if ($('#cbAtributoRiesgo').val() == 'RED') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminRed.php', {f:4}, function(data){})
            } else if ($('#cbAtributoRiesgo').val() == 'MICRORED') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcionR2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionR2').val()
                            }, function(data) {
                                $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminMicrored.php', {f:4}, function(data){})
            } else if ($('#cbAtributoRiesgo').val() == 'NUCLEO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcionR2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcionR3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionR2').val()
                            }, function(data) {
                                $('#cbOpcionR3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcionR3').val()
                                }, function(data) {
                                    $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminNucleo.php', {f:4}, function(data){})
            } else if ($('#cbAtributoRiesgo').val() == 'ESTABLECIMIENTO') {
                eliminarFuncion()
                mostrarSelect('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbSeleccionarR')
                $('#cbOpcionR1').load('/sisfac/funcionesphp/adminDiresa.php', {
                        f: 3
                    }, function(data) {
                        $('#cbOpcionR1').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                    }).change(function() {
                        $('#cbOpcionR2').load('/sisfac/funcionesphp/adminRed.php', {
                            f: 3,
                            iddiresa: $('#cbOpcionR1').val()
                        }, function(data) {
                            $('#cbOpcionR2').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                        }).change(function() {
                            $('#cbOpcionR3').load('/sisfac/funcionesphp/adminMicrored.php', {
                                f: 3,
                                idred: $('#cbOpcionR2').val()
                            }, function(data) {
                                $('#cbOpcionR3').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                            }).change(function() {
                                $('#cbOpcionR4').load('/sisfac/funcionesphp/adminNucleo.php', {
                                    f: 3,
                                    idmicrored: $('#cbOpcionR3').val()
                                }, function(data) {
                                    $('#cbOpcionR4').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                }).change(function() {
                                    $('#cbSeleccionarR').load('/sisfac/funcionesphp/adminEstablecimiento.php', {
                                        f: 3,
                                        idnucleo: $('#cbOpcionR4').val()
                                    }, function(data) {
                                        $('#cbSeleccionarR').prepend("<option selected>SELECCIONE UNA OPCION</option>")
                                    })
                                })
                            })
                        })
                    })
                    //$('#cbSeleccionar').load('/sisfac/funcionesphp/adminEstablecimiento.php', {f:5}, function(data){})
            } else {
                eliminarFuncion()
                $('#cbSeleccionarR').html("<option  value=''>SELECCIONE UNA OPCION</option>")
            }
        })

        function mostrarSelect(cb) {
            $('#cbOpcionR1,#cbOpcionR2,#cbOpcionR3,#cbOpcionR4,#cbOpcionR5,#cbSeleccionarR').hide()
            $(cb).show()
            $('#tdOpcionR1,#tdOpcionR2,#tdOpcionR3,#tdOpcionR4,#tdOpcionR5,#tdSeleccionarR').text(' ')
            if ($('#cbAtributoRiesgo').val() == 'SECTOR') {
                $('#tdOpcionR1').text('REGION')
                $('#tdOpcionR2').text('PROVINCIA')
                $('#tdOpcionR3').text('DISTRITO')
                $('#tdOpcionR4').text('ESTABLECIMIENTO')
                $('#tdOpcionR5').text('COMUNIDAD')
                $('#tdSeleccionarR').text('SECTOR')
            } else if ($('#cbAtributoRiesgo').val() == 'COMUNIDAD') {
                $('#tdOpcionR1').text('REGION')
                $('#tdOpcionR2').text('PROVINCIA')
                $('#tdOpcionR3').text('DISTRITO')
                $('#tdOpcionR4').text('ESTABLECIMIENTO')
                $('#tdSeleccionarR').text('COMUNIDAD')
            } else if ($('#cbAtributoRiesgo').val() == 'DISTRITO') {
                $('#tdOpcionR1').text('REGION')
                $('#tdOpcionR2').text('PROVINCIA')
                $('#tdSeleccionarR').text('DISTRITO')
            } else if ($('#cbAtributoRiesgo').val() == 'PROVINCIA') {
                $('#tdOpcionR1').text('REGION')
                $('#tdSeleccionarR').text('PROVINCIA')
            } else if ($('#cbAtributoRiesgo').val() == 'REGION') {
                $('#tdSeleccionarR').text('REGION')
            } else if ($('#cbAtributoRiesgo').val() == 'DISA/DIRESA') {
                $('#tdSeleccionarR').text('DISA/DIRESA')
            } else if ($('#cbAtributoRiesgo').val() == 'ESTABLECIMIENTO') {
                $('#tdOpcionR1').text('DISA/DIRESA')
                $('#tdOpcionR2').text('RED')
                $('#tdOpcionR3').text('MICRORED')
                $('#tdOpcionR4').text('NUCLEO')
                $('#tdSeleccionarR').text('ESTABLECIMIENTO')
            } else if ($('#cbAtributoRiesgo').val() == 'NUCLEO') {
                $('#tdOpcionR1').text('DISA/DIRESA')
                $('#tdOpcionR2').text('RED')
                $('#tdOpcionR3').text('MICRORED')
                $('#tdSeleccionarR').text('NUCLEO')
            } else if ($('#cbAtributoRiesgo').val() == 'MICRORED') {
                $('#tdOpcionR1').text('DISA/DIRESA')
                $('#tdOpcionR2').text('RED')
                $('#tdSeleccionarR').text('MICRORED')
            } else if ($('#cbAtributoRiesgo').val() == 'RED') {
                $('#tdOpcionR1').text('DISA/DIRESA')
                $('#tdSeleccionarR').text('RED')
            }
        }

        mostrarSelect('')

        /*
        $('#btnVerReporteEtapa').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionarR').val() == '' || $('#cbAtributoEtapa1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_riesgo_etapa.php?&atributo=' + $('#cbAtributoRiesgo').val() + '&codigo1=' + $('#cbOpcionEt5 option:selected').html() + '&seleccion=' + $('#cbSeleccionarR option:selected').html() + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&opc=' + $('#cbSeleccionarR').val() + '&titulo=' + $('#cbAtributoEtapa1 option:selected').html(), '', 'toolbar=false');
        })*/

        $('#btnVerReporteEtapaExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionarR').val() == '' || $('#cbAtributoEtapa1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_riesgo_etapa_excel.php?f=1&atributo=' + $('#cbAtributoRiesgo').val() + '&codigo1=' + $('#cbOpcionEt5 option:selected').html() + '&seleccion=' + $('#cbSeleccionarR option:selected').html() + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&seleccion1=' + $('#cbSeleccionarEtapa1').val() + '&opc=' + $('#cbSeleccionarR').val() + '&titulo=' + $('#cbAtributoEtapa option:selected').html() + ' : ' + $('#cbSeleccionarEtapa option:selected').html(), '', 'toolbar=false')
        })


        /*
        $('#btnVerReporteSocioeconomico').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionarR').val() == '' || $('#cbAtributoEtapa1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            //            window.open('/sisfac/app/reportes/reporte_riesgo_socioeconomico.php?&atributo=' + $('#cbAtributoRiesgo').val() +  '&codigo1=' + $('#cbOpcionS5 option:selected').html() + '&seleccion=' + $('#cbSeleccionarR option:selected').html() + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&opc=' + $('#cbSeleccionarR').val() + '&titulo=' + $('#cbAtributoSocioeconomico1 option:selected').html() + temp, '', 'toolbar=false');
            window.open('/sisfac/app/reportes/reporte_riesgo_socioeconomico_excel--.php?&atributo=' + $('#cbAtributoRiesgo').val() + '&codigo1=' + $('#cbOpcionS5 option:selected').html() + '&seleccion=' + $('#cbSeleccionarR option:selected').html() + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&opc=' + $('#cbSeleccionarR').val() + '&titulo=' + $('#cbAtributoSocioeconomico1 option:selected').html(), '', 'toolbar=false');
        })*/

        $('#btnVerReporteSocioeconomicoExcel').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#cbSeleccionarR').val() == '' || $('#cbAtributoEtapa1').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }

            window.open('/sisfac/app/reportes/reporte_riesgo_socioeconomico_excel.php?&atributo=' + $('#cbAtributoRiesgo').val() + '&codigo1=' + $('#cbOpcionS5 option:selected').html() + '&seleccion=' + $('#cbSeleccionarR option:selected').html() + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&opc=' + $('#cbSeleccionarR').val() + '&titulo=' + $('#cbAtributoSocioeconomico1 option:selected').html(), '', 'toolbar=false');
        })
    }

    function contenidoReporteSocioeconomico() {

    }

    function contenidoReportePaifam() {
        $('#listaFamiliaPaifam').jqGrid({
            url: '/sisfac/funcionesphp/adminPaifam.php?f=2&activo=AC',
            datetype: 'xml',
            colNames: ['id', 'idfamilia', 'Fecha modificación', 'idsector', 'nombreSector', 'C&oacute;digo Ficha', 'Fecha apertura', 'Nombre familia', 'Responsable modificaci&oacute;n', 'Responsabel ejecuci&oacute;n', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idfamilia',
                index: 'idfamiliaH',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'fechaModificacion',
                index: 'fechaModificacion',
                width: 110,
                formatter: 'date',
                stype: '',
                formatoptions: {
                    srcformat: 'Y-m-d H:i:s',
                    newformat: 'd/m/Y H:i:s'
                }
            }, {
                name: 'idsector',
                index: 'idsector',
                width: 200,
                hidden: true
            }, {
                name: 'nombreSector',
                index: 'nombreSector',
                width: 200,
                hidden: true
            }, {
                name: 'codigoFicha',
                index: 'codigoFicha',
                width: 80
            }, {
                name: 'fechaApertura',
                index: 'fechaApertura',
                width: 80,
                formatter: 'date',
                stype: '',
                formatoptions: {
                    srcformat: 'Y-m-d H:i:s',
                    newformat: 'd/m/Y'
                }
            }, {
                name: 'nombreFamilia',
                index: 'nombreFamilia',
                width: 250
            }, {
                name: 'registrador',
                index: 'registrador',
                width: 200,
                hidden: true
            }, {
                name: 'trabajador',
                index: 'trabajador',
                width: 200,
                hidden: true
            }, {
                name: 'claveGeneral',
                index: 'claveGeneral',
                width: 200,
                hidden: true
            }],
            height: 200,
            sortname: 'nombreFamilia',
            sortorder: 'asc',
            viewrecords: true,
            rowNum: 500,
            rowList: [500, 2000, 10000],
            pager: '#pagerFamiliaPaifam',
            pginput: false,
            rownumbers: true,
            caption: 'Registro de fichas familiares'
        })

        $('#listaFamiliaPaifam').jqGrid('filterToolbar', {
            searchOnEnter: false
        })

        $('#btnVerReportePaifam').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if (!$('#listaFamiliaPaifam').jqGrid('getGridParam', 'selrow')) {
                alert('Debe seleccionar una ficha')
                return
            }
            lista = $('#listaFamiliaPaifam').jqGrid('getRowData', $('#listaFamiliaPaifam').jqGrid('getGridParam', 'selrow'))
            window.open('/sisfac/app/reportes/reporte_paifam_excel.php?f=4&idfamilia=' + lista.idfamilia + '&claveGeneral=' + lista.claveGeneral, '', 'toolbar=false');
            //window.open('/sisfac/app/reportes/reportes.php?f=4&idfamilia=' + lista.idfamiliaH + '&clave=' + lista.claveGeneral, '', 'toolbar=false');
        }).width(100).height(50)
    }

    function contenidoReporteProgramacion() {
        $('#listaFamiliaProgramacion').jqGrid({
            url: '/sisfac/funcionesphp/adminFamilia.php?f=1',
            datetype: 'xml',
            colNames: ['', '', '', '', '', '', '', '', '', '', '', '', '', 'C&oacute;digo ficha', 'Fecha apertura', 'Familia'],
            colModel: [{
                    name: 'idfamilia',
                    index: 'idfamilia',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idcomunidad',
                    index: 'idcomunidad',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idsector',
                    index: 'idsector',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idtrabajador',
                    index: 'idtrabajador',
                    width: 80,
                    hidden: true
                }, {
                    name: 'idestablecimiento',
                    index: 'idestablecimiento',
                    width: 80,
                    hidden: true
                }, {
                    name: 'nombrSector',
                    index: 'nombreSector',
                    width: 100
                }, {
                    name: 'nombreComunidad',
                    index: 'nombreComunidad',
                    width: 100
                }, {
                    name: 'nombreEstablecimiento',
                    index: 'nombreEstablecimiento',
                    width: 80,
                    hidden: true
                }, {
                    name: 'nombre',
                    index: 'nombre',
                    width: 80,
                    hidden: true
                }, //distrito
                {
                    name: 'nompro',
                    index: 'nompro',
                    width: 80,
                    hidden: true
                }, {
                    name: 'nombreRegion',
                    index: 'nombreRegion',
                    width: 80,
                    hidden: true
                }, {
                    name: 'numeroVivienda',
                    index: 'numeroVivienda',
                    width: 80,
                    hidden: true
                }, {
                    name: 'codigoFamilia',
                    index: 'codigoFamilia',
                    width: 80,
                    hidden: true
                }, {
                    name: 'codigoFicha',
                    index: 'codigoFicha',
                    width: 120
                }, {
                    name: 'fechaapertura',
                    index: 'fechaapertura',
                    width: 90,
                    formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                    formatoptions: {
                        srcformat: 'Y-m-d',
                        newformat: 'd/m/Y'
                    },
                    editoptions: {
                        dataInit: function(el) {
                            $(el).datepicker({
                                dateFormat: 'dd/mm/yy',
                                changeYear: true,
                                changeMonth: true
                            });
                        }
                    }
                }, {
                    name: 'nombreFamilia',
                    index: 'nombreFamilia',
                    width: 280
                }
            ],
            height: 200,
            sortname: 'idfamilia',
            sortorder: 'asc',
            viewrecords: true,
            rowNum: 500,
            rowList: [500, 2000, 10000],
            pager: '#pagerFamiliaProgramacion',
            pginput: false,
            rownumbers: true,
            caption: 'Registro de fichas familiares'
        })

        $('#listaFamiliaProgramacion').jqGrid('filterToolbar', {
            searchOnEnter: false
        })

        $('#btnVerReporteProgramacion').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            window.open('/sisfac/app/reportes/reportes.php?f=5&idfamilia=' + $('#listaFamiliaProgramacion').jqGrid('getGridParam', 'selrow'), '', 'toolbar=false');
        }).width(100).height(50)
    }

    function contenidoReporteVisita() {
        $('#listaFamiliaVisita').jqGrid({
            url: '/sisfac/funcionesphp/adminFamilia.php?f=1',
            datetype: 'xml',
            colNames: ['idfamilia', 'fechaHistorial', 'idtrabajador', 'iddistrito', 'N&uacute;mero ficha', 'Fecha apertura', 'Familia'],
            colModel: [{
                name: 'idfamilia',
                index: 'idfamilia',
                width: 80,
                hidden: true
            }, {
                name: 'fechaHistorial',
                index: 'fechaHistorial',
                width: 80,
                hidden: true
            }, {
                name: 'idtrabajador',
                index: 'idtrabajador',
                width: 80,
                hidden: true
            }, {
                name: 'iddistrito',
                index: 'iddistrito',
                width: 250,
                hidden: true
            }, {
                name: 'codigoFicha',
                index: 'codigoFicha',
                width: 120
            }, {
                name: 'fechaapertura',
                index: 'fechaapertura',
                width: 90,
                formatter: 'date', //formatoptions: {newformat: 'd-M-Y'}, datefmt: 'd-m-Y',
                formatoptions: {
                    srcformat: 'Y-m-d',
                    newformat: 'd/m/Y'
                },
                editoptions: {
                    dataInit: function(el) {
                        $(el).datepicker({
                            dateFormat: 'dd/mm/yy',
                            changeYear: true,
                            changeMonth: true
                        });
                    }
                }
            }, {
                name: 'nombreFamilia',
                index: 'nombreFamilia',
                width: 280
            }],
            height: 200,
            sortname: 'idfamilia',
            sortorder: 'asc',
            viewrecords: true,
            rowNum: 500,
            rowList: [500, 2000, 10000],
            pager: '#pagerFamiliaVisita',
            pginput: false,
            rownumbers: true,
            caption: 'Registro de fichas familiares'
        })

        $('#listaFamiliaVisita').jqGrid('filterToolbar', {
            searchOnEnter: false
        })

        $('#btnVerReporteVisita').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            window.open('/sisfac/app/reportes/reportes.php?f=6&idfamilia=' + $('#listaFamiliaVisita').jqGrid('getGridParam', 'selrow'), '', 'toolbar=false');
        }).width(100).height(50)
    }

    function contenidoConsultaHistorico() {
        hoy = new Date();
        dia = hoy.getDate()
        mes = hoy.getMonth() + 1
        anio = hoy.getFullYear()
        $('#tbFechaInicioHistorico,#tbFechaFinHistorico').mask('99/99/9999').val((dia < 10 ? '0' + dia : dia) + '/' + (mes < 10 ? '0' + mes : mes) + '/' + anio)
        $('#btnBuscarHistorico').button({
                icons: {
                    primary: "ui-icon-search"
                }
            }).click(function() {
                $('#listaHistorico').jqGrid('setGridParam', {
                    url: '/sisfac/funcionesphp/adminHistorial.php?f=2&fechaInicio=' + $('#tbFechaInicioHistorico').val() + '&fechaFin=' + $('#tbFechaFinHistorico').val()
                }).trigger('reloadGrid')
            }) //.width(150).height(50)


        $('#listaHistorico').jqGrid({
            url: '/sisfac/funcionesphp/adminHistorial.php?f=2',
            datatype: "xml",
            colNames: ['id', 'idfamiliaH', 'Fecha historial', 'idsector', 'nombreSector', 'C&oacute;digo Ficha', 'Fecha apertura', 'Nombre familia', 'Responsable modificaci&oacute;n', 'Responsabel ejecuci&oacute;n', ''],
            colModel: [{
                name: 'id',
                index: 'id',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'idfamiliaH',
                index: 'idfamiliaH',
                width: 200,
                editable: true,
                hidden: true
            }, {
                name: 'fechaHistorial',
                index: 'fechaHistorial',
                width: 110,
                formatter: 'date',
                stype: '',
                formatoptions: {
                    srcformat: 'Y-m-d H:i:s',
                    newformat: 'd/m/Y H:i:s'
                }
            }, {
                name: 'idsector',
                index: 'idsector',
                width: 200,
                hidden: true
            }, {
                name: 'nombreSector',
                index: 'nombreSector',
                width: 200,
                hidden: true
            }, {
                name: 'codigoFicha',
                index: 'codigoFicha',
                width: 80
            }, {
                name: 'fechaApertura',
                index: 'fechaApertura',
                width: 80,
                formatter: 'date',
                stype: '',
                formatoptions: {
                    srcformat: 'Y-m-d H:i:s',
                    newformat: 'd/m/Y'
                }
            }, {
                name: 'nombreFamilia',
                index: 'nombreFamilia',
                width: 250
            }, {
                name: 'registrador',
                index: 'registrador',
                width: 200
            }, {
                name: 'trabajador',
                index: 'trabajador',
                width: 200
            }, {
                name: 'claveGeneral',
                index: 'claveGeneral',
                width: 200,
                hidden: true
            }, ],
            height: 350,
            width: 'auto',
            rowNum: 1000,
            rowList: [1000, 5000, 10000, 100000],
            rownumbers: true,
            sortname: 'fechaHistorial',
            pginput: false,
            sortorder: 'desc',
            viewrecords: true,
            caption: "Consulta fichas historicas",
            pager: '#pagerHistorico'
        })
        $('#listaHistorico').jqGrid('navGrid', '#pagerHistorico', {
            edit: false,
            add: false,
            del: false,
            search: false,
            view: false
        })

        $('#listaHistorico').jqGrid('filterToolbar', {
            searchOnEnter: false
        })

        $('#btnDatosFamiliaH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha
            window.open('/sisfac/app/reportes/reporte_familiaH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
        }).width(150).height(50)

        $('#btnVerMiembrosH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha + '&claveGeneral=' + lista.claveGeneral + '&nombreFamilia=' + lista.nombreFamilia
            window.open('/sisfac/app/reportes/reporte_miembroH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
        }).width(150).height(50)

        $('#btnVerSocioeconomicosH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha + '&claveGeneral=' + lista.claveGeneral + '&nombreFamilia=' + lista.nombreFamilia
            window.open('/sisfac/app/reportes/reporte_socioeconomicoH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
        }).width(150).height(50)

        $('#btnVerEntornoH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha + '&claveGeneral=' + lista.claveGeneral + '&nombreFamilia=' + lista.nombreFamilia
            window.open('/sisfac/app/reportes/reporte_entornoH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
        }).width(150).height(50)

        $('#btnVerVisitaH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha + '&claveGeneral=' + lista.claveGeneral + '&nombreFamilia=' + lista.nombreFamilia
            window.open('/sisfac/app/reportes/reporte_visitaH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
        }).width(150).height(50)

        $('#btnVerRiesgoH').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            tem = '&fechaHistorial=' + lista.fechaHistorial + '&codigoFicha=' + lista.codigoFicha + '&claveGeneral=' + lista.claveGeneral + '&nombreFamilia=' + lista.nombreFamilia
            window.open('/sisfac/app/reportes/reporte_riesgoH_excel.php?f=1&idfamiliaH=' + lista.idfamiliaH + tem, '', 'toolbar=false')
                //window.open('/sisfac/app/reportes/reporte_riesgo_etapa.php?&atributo=' + $('#cbAtributoEtapa').attr('value') + '&seleccion=' + $('#cbSeleccionarEtapa').attr('value') + '&atributo1=' + $('#cbAtributoEtapa1').val() + '&titulo=' + $('#cbAtributoEtapa1 option:selected').html() + temp, '', 'toolbar=false');
        }).width(150).height(50)



        $('#btnEliminarHistorial').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            lista = $('#listaHistorico').jqGrid('getRowData', $('#listaHistorico').jqGrid('getGridParam', 'selrow'))
            if (!lista.id) {
                alert('Debe seleccionar un registro')
                return
            }
            if (confirm('\xbfEsta seguro que desea eliminar el historial seleccionado. Esta acci\xf3n es irreversible?')) {
                $.post('/sisfac/funcionesphp/adminHistorial.php', {
                    f: 4,
                    id: lista.id
                }, function(data) {
                    $('#listaHistorico').trigger('reloadGrid')
                })
            }
        }).width(150).height(50)
    }

    function contenidoReporteFichaIndividual() {

        var lbs = new ListaBusquedaSector($('#divReporteSector'), 0, '')

        var lbc = new ListaBusquedaComunidad($('#divReporteComunidad'), 0, function() {
            lbs.actualizarConDato(lbc.obtenerId())
        })

        var lbe = new ListaBusquedaEstablecimiento($('#divReporteEstablecimiento'), 0, function() {
            lbc.actualizarConDato(lbe.obtenerId())
        })

        var lbn = new ListaBusquedaNucleo($('#divReporteNucleo'), 0, function() {
            lbe.actualizarConDato(lbn.obtenerId())
        })
        var lbm = new ListaBusquedaMicrored($('#divReporteMicrored'), 0, function() {
            lbn.actualizarConDato(lbm.obtenerId())
        })
        var lbr = new ListaBusquedaRed($('#divReporteRed'), 0, 0, function() {
            lbm.actualizarConDato(lbr.obtenerId())
        })
        var lbd = new ListaBusquedaDiresa($('#divReporteDiresa'), function() {
            lbr.actualizarConDato(lbd.obtenerId())
        })





        $('#dialogReporte').dialog({
            modal: true,
            autoOpen: false,
            show: 'blind',
            hide: 'drop',
            width: 'auto',
            height: 'auto',
            buttons: {
                Aceptar: function() {
                    if (lbs.obtenerId()) temp = '&idsector=' + lbs.obtenerId()
                    else if (lbc.obtenerId()) temp = '&idcomunidad=' + lbc.obtenerId()
                    else if (lbe.obtenerId()) temp = '&idestablecimiento=' + lbe.obtenerId()
                    else if (lbn.obtenerId()) temp = '&idnucleo=' + lbn.obtenerId()
                    else if (lbm.obtenerId()) temp = '&idmicrored=' + lbm.obtenerId()
                    else if (lbr.obtenerId()) temp = '&idred=' + lbr.obtenerId()
                    else if (lbd.obtenerId()) temp = '&iddiresa=' + lbd.obtenerId()

                    temp = temp + "&fechaInicio=" + $('#tbFechaInicioReporte').val() + "&fechaFin=" + $('#tbFechaFinReporte').val()
                    window.open('/sisfac/app/plantillas/reporteNino.php?f=1' + temp, '', 'toolbar=false')
                }
            },
            close: function() {
                //window.location = '/sisfac/app/'
            }
        })

        $('#tbFechaInicioReporte,#tbFechaFinReporte').mask('99/99/9999').width(90)
        $('#btnReporteMicronutienteNino').button({
            icons: {
                primary: "ui-icon-print"
            }
        }).click(function() {
            if ($('#tbFechaInicioReporte').val() == '' || $('#tbFechaFinReporte').val() == '') {
                alert('Debe seleccionar un valor')
                return
            }
            $('#dialogReporte').dialog('open')
        })
    }

    function contenidoCopiaBase() {
        $('#btnHacerBackup').button().click(function() {
            $.post('/sisfac/funcionesphp/adminCopiaBD.php', {
                f: 1
            }, function(data) {
                //alert(data);
                window.open("/sisfac/funcionesphp/" + data, "", "toolbar='false' width=900 height=600");
            })
        })
        $('#btnImportarBackup').button()

        f = new AjaxUpload($('form#formArchivos #btnImportarBackup'), {
            action: '/sisfac/funcionesphp/cargadorArchivos.php',
            autoSubmit: true,
            name: 'userfile',
            onChange: function(file, extension) {
                //jQu<ery('#rutarchivo').attr('src','/sigurmun/licconst/archivosLicencia/' + numeroExpediente + '/' +file);
            },
            onSubmit: function(file, ext) {
                //ta='jpg|jpeg|png|pdf|dwg|dxf|avi|mp4|doc|docx|xls'
                if (ext && /^(txt|sql)$/.test(ext)) {
                    this.disable();
                } else {
                    alert('S\xf3lo se aceptan archivos de texto o sql');
                    return false
                }
            },
            onComplete: function(file, response) {
                alert('La importacion se realizo con exito')
                if (response == 'correcto') {
                    $('form#formArchivosLicencia #rutarchivo').attr('src', '/sigurmun/licconst/archivosLicencia/' + numeroExpediente + '/' + file);
                }
                this.enable();
            }
        });


    }

    function contenidoCopiaBaseGeneral() {
        $('#btnBackupGeneral').button().click(function() {
            $.post('/sisfac/funcionesphp/genera_backup.php', {
                action_backup: 'backup'
            }, function(data) {
                alert('Se genero el archivo');
                window.open("/sisfac/funcionesphp/" + data, "", "toolbar='false' width=900 height=600");
                //window.open("http://siskallpa.xtrweb.com/siskallpa/funcionesphp/" + data,"","toolbar='false' width=900 height=600");
            })
        }).height(100)
    }

    function contenidoRestaurarBase() {
        $('#btnRestaurarBD').button().click(function() {
            $.post('/sisfac/funcionesphp/adminRestaurarBD.php', {
                f: 1
            }, function(data) {
                alert('Se restauro la BD del establecimiento');
            })
        }).height(100)
    }

    function contenidoAcercade() {

    }

    function mostrarContenido(co) {
        $('#contenidoInicio').hide()
        $('#contenidoFicha').hide()
        $('#contenidoFichaClinica').hide()
        $('#contenidoConsultaFicha').hide()
        $('#contenidoRegion').hide()
        $('#contenidoProvincia').hide()
        $('#contenidoDistrito').hide()
        $('#contenidoComunidad').hide()
        $('#contenidoDiresa').hide()
        $('#contenidoRed').hide()
        $('#contenidoMicrored').hide()
        $('#contenidoNucleo').hide()
        $('#contenidoEstablecimientoNucleo').hide()
        $('#contenidoTrabajadores').hide()
        $('#contenidoTrabajadorSector').hide()
        $('#contenidoSector').hide()
        $('#contenidoEstablecimiento').hide()
            //$('#contenidoComunidad').hide()
        $('#contenidoReporteEstadistico').hide()
        $('#contenidoReporteEtapa').hide()
        $('#contenidoReporteSocioeconomico').hide()
        $('#contenidoReportePaifam').hide()
        $('#contenidoReporteProgramacion').hide()
        $('#contenidoReporteVisita').hide()
        $('#contenidoReportes').hide()
        $('#contenidoConsultaHistorico').hide()
        $('#contenidoCopiaBase').hide()
        $('#contenidoCopiaBaseGeneral').hide()
        $('#contenidoRestaurarBase').hide()
        $('#contenidoAcercade').hide()
        $('#contenidoMaestra').hide()
        $('#contenidoCargarCsv').hide()
        $('#contenidoReporteFichaIndividual').hide()
        $('#contenidoCatalogoCIE10').hide()
        $('#contenidoCatalogoMedicamento').hide()
        $('#contenidoCatalogoPrestaciones').hide()
        $('#contenidoCatalogoHIS').hide()
        $('#contenidoCatalogoEpisodio').hide()
        $('#contenidoCatalogoFinanciadores').hide()
        $('#contenidoCatalogoLaboratorio').hide()
        $('#contenidoMigraComunidad').hide()
        $('#contenidoReporteAcopio').hide()
        $('#' + co).show()
    }

    var lbe = new ListaBusquedaEstablecimiento($('#divBusquedaEstablecimiento'))
    var lbn = new ListaBusquedaNucleo($('#divBusquedaNucleo'), 0, function() {
        lbe.actualizarConDato(lbn.obtenerId())
    })
    var lbm = new ListaBusquedaMicrored($('#divBusquedaMicrored'), 0, function() {
        lbn.actualizarConDato(lbm.obtenerId())
    })
    var lbr = new ListaBusquedaRed($('#divBusquedaRed'), 0, 0, function() {
        lbm.actualizarConDato(lbr.obtenerId())
    })
    var lbd = new ListaBusquedaDiresa($('#divBusquedaDiresa'), function() {
        lbr.actualizarConDato(lbd.obtenerId())
    })



    $('#dialogDatoGeneral').dialog({
            modal: true,
            autoOpen: false,
            show: 'blind',
            hide: 'drop',
            width: 'auto',
            height: 'auto',
            buttons: {
                Aceptar: function() {
                    if (!lbe.obtenerId()) {
                        alert('Debe seleccionar un establecimiento')
                        return
                    }
                    cg = lbe.obtenerFilaSeleccionada()

                    $.post('/sisfac/funcionesphp/adminDatoGeneral.php', {
                        f: 1,
                        claves: lbd.obtenerId() + '-' + lbr.obtenerId() + '-' + lbm.obtenerId() + '-' + lbn.obtenerId() + '-' + lbe.obtenerId(),
                        claveGeneral: cg.claveGeneral //$('#tbNombreEstablecimiento').val(),
                            //lugarCentral:$('#cbEstablecimientoCentral').val()
                    }, function(data) {
                        $('#dialogDatoGeneral').dialog('close')
                    })
                }
            },
            close: function() {
                window.location = '/sisfac/app/'
            }
        })
        //alert(CLAVES)
    if (!CLAV || !CLAVES) {
        $('#dialogDatoGeneral').dialog('open')
    } else {
        /*
                window.setInterval(function(){
                $.post('/sisfac/funcionesphp/adminAlertas.php', {f:1}, function(data){
                    eval(data)
                })
                }, 900000);//MILISEGUNGOS  1 800 000 segundos son 30 minuto
                $.post('/sisfac/funcionesphp/adminAlertas.php', {f:1}, function(data){
                    eval(data)
                })
        */
        mostrarContenido('contenidoInicio')
    }

    //alert(USU)
    if (USU == 'SUPERUSUARIO') {
        $('#btnEliminarHistorial').removeAttr('disabled')
        $('#btnCodigoFicha').removeAttr('disabled')
    } else {
        $('#btnEliminarHistorial').attr('disabled', 'disabled')
        $('#btnCodigoFicha').attr('disabled', 'disabled')
    }
    validarCaracteres()
})
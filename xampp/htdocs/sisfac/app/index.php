<?PHP
/*Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
    session_start();
    if(!isset($_SESSION['idusu'])) header("location:/sisfac/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>sisfac</title>
        <?PHP
            //echo $_SESSION['script_permisos'];
            //echo $_SESSION['script_navegador'];
            echo $_SESSION['script_cerrar_sesion'];
        ?>
        <link rel="shortcut icon" href="/sisfac/images/favicon.ico" type="image/x-icon" />
        <link href="/sisfac/css/sigurmun.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/sisfac/css/ui-lightness/jquery-ui-1.8.14.custom.css" />
        <link rel="stylesheet" type="text/css" href="/sisfac/css/ui.jqgrid.css"  />
        <link rel="stylesheet" type="text/css" href="/sisfac/css/fullcalendar.css"  />
        <link rel="stylesheet" type="text/css" href="/sisfac/css/jquery.pnotify.default.css"  />
        <link rel="stylesheet" type="text/css" href="/sisfac/css/cssmenu.css"  />
        
        <script type="text/javascript"><?php echo "const USU ='" . $_SESSION['nomusu']."'";?></script>
        <script type="text/javascript"><?php echo "const TIPOUSU ='" . $_SESSION['tipo']."'";?></script>
        <script type="text/javascript"><?php echo "const CLAV ='" . $_SESSION['claveGeneral']."'";?></script>
        <script type="text/javascript"><?php echo "const CLAVES ='" . $_SESSION['claves']."'";?></script>
        
        <script type="text/javascript" src="/sisfac/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery.ui.datepicker-es.js"></script>
        <script type="text/javascript" src="/sisfac/js/grid.locale-es.js" ></script>
        <script type="text/javascript" src="/sisfac/js/jquery.jqGrid.min.js" ></script>
        <script type="text/javascript" src="/sisfac/js/ajaxupload.js"></script>
        <script type="text/javascript" src="/sisfac/js/util.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery.maskedinput-1.3.js"></script>
        <!--script type="text/javascript" src="/sisfac/js/jqueryslidemenu.js"></script-->
        <!--link rel="stylesheet" type="text/css" href="/sisfac/css/jqueryslidemenu.css" /-->
        <script type="text/javascript" src="/sisfac/js/jquery.pnotify.min.js" ></script>
        <script type="text/javascript" src="/sisfac/js/listas.js?v=5"></script>
        <script type="text/javascript" src="/sisfac/app/js/inicio.js?v=5"></script>
        
        <style type="text/css">
            #tabs,#tabsClinica,#tabsConsulta,#tabsReportes,#dialogFicha {font-size: 90%}
            #dialogReporte {font-size: 80%}
            #feedback { font-size: 1.4em; }
            #selectable .ui-selecting { background: #FECA40; }
            #selectable .ui-selected { background: #F39814; color: white; }
            #selectable { list-style-type: none; margin: 0; padding: 0; }
            #selectable li { margin: 3px; padding: 1px; float: left; width: 120px; height: 20px; font-size: 1em; text-align: center; }
            
            #selectableRiesgo .ui-selecting { background: #FECA40; }
            #selectableRiesgo .ui-selected { background: #F39814; color: white; }
            #selectableRiesgo { list-style-type: none; margin: 0; padding: 0; }
            #selectableRiesgo li { margin: 3px; padding: 1px; float: left; width: 120px; height: 20px; font-size: 1em; text-align: center; }
            
            #resizable { padding: 0.5em; }
            #resizable h3 { text-align: center; margin: 0; }
            
            
            .ui-pnotify.custom {
                    font-family: Arial, Helvetica, sans-serif;
                    text-shadow: 2px 2px 3px black;
                    font-size: 10pt;
            }
            .ui-pnotify.custom .ui-pnotify-container {
                    background-color: #404040;
                    background-image: none;
                    border: none;
                    -moz-border-radius: 10px;
                    -webkit-border-radius: 10px;
                    border-radius: 10px;
            }
            .ui-pnotify.custom .ui-pnotify-title {
                    font-weight: bold;
                    padding-left: 50px;
                    color: #FFF;
            }
            .ui-pnotify.custom .ui-pnotify-text {
                    padding-left: 50px;
                    color: #FFF;
            }
            .ui-pnotify.custom .ui-pnotify-closer {
                    position: absolute;
                    bottom: 5px;
                    right: 5px;
            }
            .ui-pnotify.custom .ui-pnotify-icon {
                    float: left;
            }
            .ui-pnotify.custom .picon {
                    margin: 3px;
                    width: 33px;
                    height: 33px;
            }

            /* Alternate stack initial positioning. */
            .ui-pnotify.stack-topleft {
                    top: 15px;
                    left: 15px;
                    right: auto;
            }
            .ui-pnotify.stack-bottomleft {
                    bottom: 15px;
                    left: 15px;
                    top: auto;
                    right: auto;
            }
            /* This one is done through code, to show how it is done. Look down
                at the stack_bottomright variable in the JavaScript below. */
            .ui-pnotify.stack-bottomright {
                    /* These are just CSS default values to reset the pnotify CSS. */
                    right: auto;
                    top: auto;
                    font-size: 10px
            }
            .ui-pnotify.stack-custom {
                    /* Custom values have to be in pixels, because the code parses them. */
                    top: 200px;
                    left: 200px;
                    right: auto;
            }
            .ui-pnotify.stack-custom2 {
                    top: auto;
                    left: auto;
                    bottom: 200px;
                    right: 200px;
            }
            #selectable li {
                cursor: pointer
            }
            #selectableRiesgo li {
                cursor: pointer
            }
            .scroll{
                width:1050px;
                height: 500px;
                overflow: auto;
                border:1px solid #000000; /* Solo lo puse para que se vea el cuadro*/
            }
            #gbox_listaCulturales{
                margin-top: 10px;
            }
	</style>
    </head>
    
    <body>
        
        <div id="cabecera">
            <div id="cabecera"><?php echo $_SESSION['cabecera'];?></div>
        </div>
        <div id="cuerpo">
            <div id="contenido">
                <div class="capaborde" >
                    <!--div id='cssmenu' align="left">
                        <?php //include 'menu.php';?>
                        <br style="clear: left"/>
                    </div-->
                    <table width="100%" border="0">
                        <tr>
                            <td  class="menulat"  valign="top">
                                <div id='cssmenu' align="left">
                                    <?php include 'menu.php';?>
                                    <br style="clear: left"/>
                                </div>
                            <td class="llenareporte" valign="top">
                                <div id="contenidoInicio" class="contenidoborde">
                                    <!--br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                    <p align="center" class="textoplomo">Seleccione una opci&oacute;n</p>
                                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/-->
                                    <table align="center" width="100%">
                                        <tr>
                                            <td colspan="6" align="center"><img src="/sisfac/imagenes/Bienvenidos_1.jpg" width="746" height="150"></img></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><hr></hr></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><a href="#" id="opFicha1"><img src="/sisfac/imagenes/iconos/ficha_familiar.png" width="135"></img></a></td>
                                            <td align="center"><a href="#" id="opReportePaifam1"><img src="/sisfac/imagenes/iconos/paifam.png" width="135"></img></a></td>
                                            <!--td align="center"><a href="#" id="opFichaClinica1"><img src="/sisfac/imagenes/ficha_unica.jpg" width="135" height="90" ></img></a></td-->
                                            <td align="center"><a href="#" id="opHistorial"><img src="/sisfac/imagenes/iconos/historiales.png" width="135"></img></a></td>
                                        </tr>
                                        <tr>
                                            <td><br></br></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><a href="#" id="opReporteEtapa1"><img src="/sisfac/imagenes/iconos/familiasEnRiesgo.png" width="135"></img></a></td>
                                            <td align="center"><a href="#" id="opReporte1"><img src="/sisfac/imagenes/iconos/ReportesEstadisticos.png" width="135"></img></a></td>
                                            <td align="center"><a href="#" id="opCopiaBaseGeneral1"><img src="/sisfac/imagenes/iconos/respaldobd.png" width="135"></img></a></td>
                                        </tr>
                                        <tr>
                                                <td align="center"><a href="#" id="opAyuda1"><img src="/sisfac/imagenes/iconos/ayuda.png" width="135"></img></a></td>
                                            
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoFicha" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">FICHA FAMILIAR</h1></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <table id="listaFamilia"></table>
                                                            <div id="pagerFamilia"></div>
                                                        </td>
                                                        <td valign="top">
                                                            <!--h4 style="color: #0074C7; font-weight: bolder;">Buscar por c&oacute;digo de ficha:</h4-->
                                                                <div id="accordion">
                                                                    <h3>Buscar por c&oacute;digo de ficha</h3>
                                                                    <div>
                                                                        <input id="tbBuscarFicha" placeholder="Ingrese numero ficha"></input><br/>
                                                                    </div>
                                                                    <h3>Buscar por DNI</h3>
                                                                    <div>
                                                                        <input id="tbBuscarFichaDNI" placeholder="Ingrese numero de su DNI"></input><br/>
                                                                    </div>
                                                                </div>
                                                            <br/>
                                                            <button id="btnAgregarFicha">Nueva ficha</button><br/><br/>
                                                            <button id="btnCodigoFicha">Modificar C&oacute;digo </button><br/><br/>
                                                            <button id="btnModificarFicha">Modificar Ficha</button><br/><br/>
                                                            
                                                            <button id="btnEliminarFicha">Eliminar ficha</button><br/><br/>
                                                            <button id="btnActivarFicha">Activar ficha</button><br/><br/>
                                                            <button id="btnInactivarFicha">Inactivar ficha</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div id="dialogInactivarFicha" title="Motivo">
                                                    <table>
                                                        <tr>
                                                            <td>Por:</td>
                                                            <td>
                                                                <select id="cbMotivo">
                                                                    <option value=""></option>
                                                                    <option value="MIGRACION">MIGRACI&Oacute;N</option>
                                                                    <option value="DEFUNCION">DEFUNCI&Oacute;N</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div id="dialogHistorial" title="Confirmar registro de historial">
                                                    <table>
                                                        <tr>
                                                            <td>Responsable de recoger informaci&oacute;n:</td>
                                                            <td>
                                                                <select id="cbPersonaInformacion"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Responsable de registrar informaci&oacute;n</td>
                                                            <td>
                                                                <select id="cbPersonaRegistro"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Confirmar contrase&ntilde;a</td>
                                                            <td>
                                                                <input type="password" name="clave" id="tbClave" size="25" class="cajastextologin" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <div id="tabs">
                                                    <ul>
                                                        <li><a href="#tab1">C&oacutedigo ficha</a></li>
                                                        <li><a href="#tab2">Datos de la familia</a></li>
                                                        <li><a href="#tab3">Datos del miembro de la familia</a></li>
                                                        <li><a href="#tab4">Datos socioecon&oacute;micos</a></li>
                                                        <li><a href="#tab5">Vivienda y entorno</a></li>
                                                        <li><a href="#tab6">Visita domiciliaria</a></li>
                                                    </ul>
                                                    <div id="tab1">
                                                        <input type="hidden" id="claveGeneral" />
                                                        <table width="100%">
                                                            <tr>
                                                                <td>Regi&oacute;n: </td>
                                                                <td><h3><label id="lRegion"></label></h3></td>
                                                                <td>Provincia: </td>
                                                                <td><h3><label id="lProvincia"></label></h3></td>
                                                                <td>Distrito: </td>
                                                                <td><h3><label id="lDistrito"></label></h3></td>
                                                                <td>EE.SS: </td>
                                                                <td><h3><label id="lEstSalud"></label></h3></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Comunidad: </td>
                                                                <td><h3><label id="lbComunidad"></label></h3></td>
                                                                <td>Sector: </td>
                                                                <td><h3><label id="lbSector"></label></h3></td>
                                                                <td>Vivienda: </td>
                                                                <td><h3><label id="lbVivienda"></label></h3></td>
                                                                <td>Familia: </td>
                                                                <td><h3><label id="lbFamilia"></label></h3></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="8" align="center"><h2>C&oacute;digo generado: <label id="lCodigoGenerado"></label></h2></td>
                                                            </tr>
                                                            <!--tr>
                                                                <td colspan="8" align="center">
                                                                    <br></br>
                                                                    <button id="btnGenerarCodigo">Generar c&oacute;digo</button>
                                                                    <button id="btnGuardarFicha">Guardar c&oacute;digo</button>
                                                                </td>
                                                            </tr-->
                                                        </table>
                                                        <div id="dialogFicha" title="Generar c&oacute;digo de ficha familiar" style="display: none">
                                                            <table>
                                                                <tr>
                                                                    <td>Comunidad: </td>
                                                                    <td><select id="cbComunidad"></select></td>
                                                                    <td>Sector: </td>
                                                                    <td><select id="cbSector"></select></td>
                                                                    <td>Vivienda: </td>
                                                                    <td><select id="cbVivienda"></select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Familia: </td>
                                                                    <td><select id="cbFamilia"></select></td>
                                                                    <td>Fecha ficha</td>
                                                                    <td><input id="tbFechaFicha"></input></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div id="tab2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td>Familia: </td>
                                                                            <td colspan="3"><input id="tbNombreFamilia"></input></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Calle,Jr.Av.Pas./N.Lote</td>
                                                                            <td><input id="tbLote" size="30"></input></td>
                                                                            <td>Telefono</td>
                                                                            <td><input id="tbTelefono" size="38"></input></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Correo</td>
                                                                            <td><input id="tbCorreo" size="30"></input></td>
                                                                            <td>Referencia</td>
                                                                            <td><input id="tbReferencia" size="38"></input></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Ubicaci&oacute;n vivienda</td>
                                                                            <td>
                                                                                <select id="cbTipoEntorno">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="RURAL">RURAL</option>
                                                                                    <option value="URBANA">URBANA</option>
                                                                                    <option value="URBANO MARGINAL">URBANO MARGINAL</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Tiempo que demora en llegar al EE.SS</td>
                                                                            <td>
                                                                                <!--input id="tbTiempoDemora" size="35"></input-->
                                                                                <select id="cbTiempoHoraDemora"></select>
                                                                                <select id="cbTiempoMinutoDemora">
                                                                                    <!--option value="00">00</option>
                                                                                    <option value="15">15</option>
                                                                                    <option value="30">30</option>
                                                                                    <option value="45">45</option-->
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tiempo de residencia en el domicilio actual</td>
                                                                            <!--td><input id="tbTiempoDomicilio" size="30"></input></td-->
                                                                            <td>
                                                                                <select id="cbTiempoDomicilio">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="MENOS DE 6 MESES">MENOS DE 6 MESES</option>
                                                                                    <option value="DE 7 MESES A 2 ANOS">DE 7 MESES A 2 A&Ntilde;OS</option>
                                                                                    <option value="MAS DE 2 ANOS">MAS DE 2 A&Ntilde;OS</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Donde vivieron antes</td>
                                                                            <td><input id="tbViviendaAnterior" size="38"></input></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Medio de transporte</td>
                                                                            <td>
                                                                                <select id="cbMedioTransporte">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="A PIE">A PIE</option>
                                                                                    <option value="ACEMILA">AC&Eacute;MILA</option>
                                                                                    <option value="VEHICULO">VEH&Iacute;CULO</option>
                                                                                    <option value="OTRO">OTRO</option>
                                                                                </select>
                                                                            </td>
                                                                            
                                                                            
                                                                            <td>Religi&oacute;n</td>
                                                                            <td>
                                                                                <select id="cbReligion">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="ADVENTISTA (CRISTIANO EVANGELICO)">ADVENTISTA (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="AGNOSTICO/ATEO">AGNOSTICO/ATEO</option>
                                                                                    <option value="ANGLICANO (CRISTIANO PROTESTANTE O REFORMADO">ANGLICANO (CRISTIANO PROTESTANTE O REFORMADO)</option>
                                                                                    <option value="ASAMBLEA DE DIOS (CRISTIANO EVANGELICO)">ASAMBLEA DE DIOS (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="BAUTISTA (CRISTIANO EVANGELICO)">BAUTISTA (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="CRISTIANO CATOLICO">CRISTIANO CATOLICO</option>
                                                                                    <option value="CRISTIANO ORTODOXO">CRISTIANO ORTODOXO</option>
                                                                                    <option value="EVANGELICO/ADVENTISTA">EVANGELICO/ADVENTISTA</option>
                                                                                    <option value="IGLESIA DE JESUCRISTO DE LOS SANTOS DE LOS ULTIMOS DIAS (MORMONES)">IGLESIA DE JESUCRISTO DE LOS SANTOS DE LOS ULTIMOS DIAS (MORMONES)</option>
                                                                                    <option value="ISLAMICO">ISLAMICO</option>
                                                                                    <option value="ISRAELITAS DEL NUEVO PACTO UNIVERSAL">ISRAELITAS DEL NUEVO PACTO UNIVERSAL</option>
                                                                                    <option value="JUDIO">JUDIO</option>
                                                                                    <option value="LUTERANO (CRISTIANO PROTESTANTE O REFORMADO)">LUTERANO (CRISTIANO PROTESTANTE O REFORMADO)</option>
                                                                                    <option value="METODISTA (CRISTIANO EVANGELICO)">METODISTA (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="PENTECOSTAL (CRISTIANO EVANGELICO)">PENTECOSTAL (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="PRESBITERIANO (CRISTIANO EVANGELICO)">PRESBITERIANO (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="TESTIGO DE JEHOVA (CRISTIANO EVANGELICO)">TESTIGO DE JEHOVA (CRISTIANO EVANGELICO)</option>
                                                                                    <option value="CRISTIANO/EVANGELICO">CRISTIANO/EVANGELICO</option>
                                                                                    <option value="OTROS">OTROS</option>
                                                                                    <option value="NINGUNA RELIGION">NINGUNA RELIGION</option>
                                                                                    <option value="NO SABE/NO RESPONDE">NO SABE/NO RESPONDE</option>

                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Dias de visita</td>
                                                                            <td><select id="cbDiaVisita">
                                                                                    <option value="DOMINGO">DOMINGO</option>
                                                                                    <option value="LUNES">LUNES</option>
                                                                                    <option value="MARTES">MARTES</option>
                                                                                    <option value="MIERCOLES">MI&Eacute;RCOLES</option>
                                                                                    <option value="JUEVES">JUEVES</option>
                                                                                    <option value="VIERNES">VIERNES</option>
                                                                                    <option value="SABADO">S&Aacute;BADO</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Horario de visita</td>
                                                                            <td>
                                                                                <select id="cbHoraVisita"></select>
                                                                                <select id="cbMinutoVisita"></select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tipo familia</td>
                                                                            <td>
                                                                                <select id="cbTipoFamilia">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="NUCLEAR">NUCLEAR</option>
                                                                                    <option value="EXTENDIDA">EXTENDIDA</option>
                                                                                    <option value="AMPLIADA">AMPLIADA</option>
                                                                                    <option value="MONOPARENTAL">MONOPARENTAL</option>
                                                                                    <option value="RECONSTITUIDA">RECONSTITUIDA</option>
                                                                                    <option value="EQUIVALENTE FAMILIAR">EQUIVALENTE FAMILIAR</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td valign="top">
                                                                    <table>
                                                                        <tr>    
                                                                            <td>Ciclo vital: </td>
                                                                            <td>
                                                                                <select id="cbCicloVital">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="FAMILIA EN FORMACION">FAMILIA EN FORMACI&Oacute;N</option>
                                                                                    <option value="FAMILIA EN EXPANSION">FAMILIA EN EXPANSI&Oacute;N</option>
                                                                                    <option value="FAMILIA EN DISPERSION">FAMILIA EN DISPERSI&Oacute;N</option>
                                                                                    <option value="FAMILIA EN CONTRACCION">FAMILIA EN CONTRACCI&Oacute;N</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td colspan="2"><table id="listaCicloVital"></table></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Idioma</td>
                                                                            <td>
                                                                                <table id="listaIdioma"></table>
                                                                            </td>
                                                                            <!--td>
                                                                                <select id="cbIdioma1">
                                                                                    <option value=""></option>
                                                                                    <option value="ESPANOL">ESPA&Ntilde;OL</option>
                                                                                    <option value="QUECHUA">QUECHUA</option>
                                                                                    <option value="AYMARA">AYMARA</option>
                                                                                </select>
                                                                                <select id="cbIdioma2">
                                                                                    <option value=""></option>
                                                                                    <option value="ESPANOL">ESPA&Ntilde;OL</option>
                                                                                    <option value="QUECHUA">QUECHUA</option>
                                                                                    <option value="AYMARA">AYMARA</option>
                                                                                </select>
                                                                                <select id="cbIdioma3">
                                                                                    <option value=""></option>
                                                                                    <option value="ESPANOL">ESPA&Ntilde;OL</option>
                                                                                    <option value="QUECHUA">QUECHUA</option>
                                                                                    <option value="AYMARA">AYMARA</option>
                                                                                </select>
                                                                            </td-->
                                                                        </tr>
                                                                    </table>
                                                                    
                                                                </td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </div>
                                                    <div id="tab3">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <table id="listaMiembrosFamilia"></table>
                                                                    <div id="pagerMiembrosFamilia"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button id="btnAgregarMiembro">Agregar miembro</button>
                                                                    <button id="btnActualizarMiembro">Actualizar miembro</button>
                                                                    <button id="btnEliminarMiembro">Eliminar miembro</button>
                                                                    <button id="btnActivarMiembro">Activar miembro</button>
                                                                    <button id="btnInactivarMiembro">Inactivar miembro</button>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button id="btnRiesgoPersonal">Ver riesgo personal</button>
                                                                    <button id="btnRiesgoFamiliar">Ver riesgo familiar</button>
                                                                    <button id="btnMiembroFamilia">Alguno tiene</button>
                                                                    <button id="btnGestante">Ver riesgo Gestante</button>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <div id="dialogInactivarPersona" title="Motivo">
                                                            <table>
                                                                <tr>
                                                                    <td>Por:</td>
                                                                    <td>
                                                                        <select id="cbMotivoPersona">
                                                                            <option value=""></option>
                                                                            <option value="FORMACION DE FAMILIA">FORMACI&Oacute;N DE FAMILIA</option>
                                                                            <option value="CAMBIO DE DOMICILIO">CAMBIO DE DOMICILIO</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="dialogMiembros" title="DATOS DE PERSONA" align="center">
                                                            <input type="hidden" id="claveGeneralPersona" />
                                                            <table style="border-spacing: 10px">
                                                                <tr>
                                                                    <td valign="top">
                                                                        <fieldset class="ui-widget-content ui-corner-all"><h3 class="ui-widget-header">Filiaci&oacute;n</h3>
                                                                        <table style="border-spacing: 10px">
                                                                            
                                                                            <tr>
                                                                                <td>N&uacute;mero de HCL:</td>
                                                                                <td><input id="tbNumeroHC"></input></td>
                                                                                <td>Nombres:</td>
                                                                                <td><input id="tbNombres"></input></td>
                                                                                <td>Apellido Paterno:</td>
                                                                                <td><input id="tbApellidoPaterno"></input></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Apellido Materno:</td>
                                                                                <td><input id="tbApellidoMaterno"></input></td>
                                                                                <td>Sexo:</td>
                                                                                <td>
                                                                                    <select id="cbSexo">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="M">MASCULINO</option>
                                                                                        <option value="F">FEMENINO</option>
                                                                                    </select>
                                                                                </td>
                                                                                <!--td>Grupo sanguineo y factor</td>
                                                                                <td>
                                                                                    <select id="cbGrupoSanguineo">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="A+">A+</option>
                                                                                        <option value="A-">A-</option>
                                                                                        <option value="B+">B+</option>
                                                                                        <option value="B-">B-</option>
                                                                                        <option value="AB+">AB+</option>
                                                                                        <option value="AB-">AB-</option>
                                                                                        <option value="O+">O+</option>
                                                                                        <option value="O-">O-</option>
                                                                                        <option value="NR">No registra</option>
                                                                                    </select>
                                                                                </td-->
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Parentesco:</td>
                                                                                <td>
                                                                                    <select id="cbParentesco">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="P">PADRE</option>
                                                                                        <option value="M">MADRE</option>
                                                                                        <option value="H">HIJO/HIJA</option>
                                                                                        <option value="A">ABUELO/ABUELA</option>
                                                                                        <option value="T">TIO/TIA</option>
                                                                                        <option value="N">NIETO/NIETA</option>
                                                                                        <option value="PA">PADRE ADOPTIVO</option>
                                                                                        <option value="MA">MADRE ADOPTIVA</option>
                                                                                        <option value="PD">PADRASTRO</option>
                                                                                        <option value="MD">MADRASTRA</option>
                                                                                        <option value="NU">NUERA</option>
                                                                                        <option value="YE">YERNO</option>
                                                                                        <option value="OT">OTRO</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>Fecha Nacimiento:</td>
                                                                                <td><input id="tbFechaNacimiento"></input></td>
                                                                                <td>Edad</td>
                                                                                <td><label id="lEdad" style="color: #0074C7; font-weight: bolder;"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tipo de documento:</td>
                                                                                <td>
                                                                                    <select id="cbOpcionDNI">
                                                                                        <!--option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="TIENE DNI">TIENE DNI</option>
                                                                                        <option value="NO TIENE DNI">NO TIENE DNI</option>
                                                                                        <option value="DNI EN TRAMITE">DNI EN TR&Aacute;MITE</option-->
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="DNI">DNI</option>
                                                                                        <option value="CARNET DE EXTRANJERIA">CARNET DE EXTRANJERIA</option>
                                                                                        <option value="PASAPORTE">PASAPORTE</option>
                                                                                        <option value="DOCUMENTO DE IDENTIDAD EXTRANJERO">DOCUMENTO DE IDENTIDAD EXTRANJERO</option>
                                                                                        <option value="NO TIENE DNI/DNI EN TRAMITE">NO TIENE DNI/DNI EN TRAMITE</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>Nro. Documento:</td>
                                                                                <td><input id="tbDNI"></input></td>
                                                                                <td>C&oacute;digo de paciente</td>
                                                                                <td><label id="lCodigoPaciente"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tipo de Seguro:</td>
                                                                                <td>
                                                                                    <select id="cbSeguro">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="USUARIO">1. USUARIO</option>
                                                                                        <option value="AUS/SIS">2. AUS/SIS</option>
                                                                                        <option value="ESSALUD">3. ESSALUD</option>
                                                                                        <option value="S.O.A.T">4. S.O.A.T</option>
                                                                                        <option value="SANIDAD F.A.P">5. SANIDAD F.A.P</option>
                                                                                        <option value="SANIDAD NAVAL">6. SANIDAD NAVAL</option>
                                                                                        <option value="SANIDAD EP">7. SANIDAD EP</option>
                                                                                        <option value="SANIDAD PNP">8. SANIDAD PNP</option>
                                                                                        <option value="PRIVADOS">9. PRIVADOS</option>
                                                                                        <option value="OTROS">10. OTROS</option>
                                                                                        <option value="EXONERADO">11. EXONERADO</option>
                                                                                        <option value="SIN SEGURO">12. SIN SEGURO</option>
                                                                                        <!--1,USUARIO 2,S.I.S  3,ESSALUD 4,S.O.A.T 5,SANIDAD F.A.P 6,SANIDAD NAVAL 7,SANIDAD EP 8,SANIDAD PNP 9,PRIVADOS 10,OTROS 11,EXONERADO-->
                                                                                    </select>
                                                                                </td>
                                                                                <td>N&uacute;mero seguro:</td>
                                                                                <td><input id="tbNumeroSeguro"></input></td>
                                                                                <td>Jefe de familia:</td>
                                                                                <td>
                                                                                    <select id="cbJefe">
                                                                                        <option value="NO">NO</option>
                                                                                        <option value="SI">SI</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                        </table>
                                                                            </fieldset><br/>
                                                                        <fieldset class="ui-widget-content ui-corner-all"><h3 class="ui-widget-header">Nacimiento</h3>
                                                                        <table style="border-spacing: 10px">
                                                                            
                                                                            <tr>
                                                                                <td>Departamento:</td>
                                                                                <td><select id="cbDepartamento"></select></td>
                                                                                <td>Provincia:</td>
                                                                                <td><select id="cbProvincia">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                    </select></td>
                                                                                <td>Distrito:</td>
                                                                                <td><select id="cbDistrito"><option value="">Seleccione una opci&oacute;n</option></select></td>
                                                                            </tr>
                                                                            
                                                                        </table>
                                                                            </fieldset><br/>
                                                                        <fieldset class="ui-widget-content ui-corner-all"><h3 class="ui-widget-header">Social</h3>
                                                                        <table style="border-spacing: 10px">
                                                                            
                                                                            <tr>
                                                                                <td>Estado civil:</td>
                                                                                <td>
                                                                                    <select id="cbEstado">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="S">SOLTERO</option>
                                                                                        <option value="CV">CONVIVIENTE</option>
                                                                                        <option value="C">CASADO</option>
                                                                                        <option value="SE">SEPARADO</option>
                                                                                        <option value="D">DIVORCIADO</option>
                                                                                        <option value="V">VIUDO</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>Grado instrucci&oacute;n:</td>
                                                                                <td>
                                                                                    <select id="cbGradoInstruccion">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="ANALFABETO">ANALFABETO</option>
                                                                                        <option value="PRIMARIA">PRIMARIA</option>
                                                                                        <option value="SECUNDARIA">SECUNDARIA</option>
                                                                                        <option value="SUPERIOR">SUPERIOR</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>Ocupaci&oacute;n:</td>
                                                                                <td>
                                                                                    <select id="cbOcupacion">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="S">TRABAJADOR ESTABLE</option>
                                                                                        <option value="V">EVENTUAL</option>
                                                                                        <option value="D">DESOCUPADO</option>
                                                                                        <option value="J">JUBILADO</option>
                                                                                        <option value="E">ESTUDIANTE</option>
                                                                                        <option value="A">AMA DE CASA</option>
                                                                                        <option value="N">NO APLICA</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tipo ocupaci&oacute;n:</td>
                                                                                <td><input id="tbTipoOcupacion"></input></td>
                                                                                <!--td>Grupo de riesgo</td>
                                                                                <td>
                                                                                    <select id="cbGrupoRiesgo">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="TRABAJADOR DE SALUD">TRABAJADOR DE SALUD</option>
                                                                                        <option value="TRABAJADORES SEXUALES">TRABAJADORES SEXUALES</option>
                                                                                        <option value="HSH">HSH</option>
                                                                                        <option value="PRIVADO LIBERTAD">PRIVADO LIBERTAD</option>
                                                                                        <option value="FF. AA.">FF. AA.</option>
                                                                                        <option value="POLICIA NACIONAL">POLICIA NACIONAL</option>
                                                                                        <option value="ESTUDIANTES DE SALUD">ESTUDIANTES DE SALUD</option>
                                                                                        <option value="POLITRANSFUNDIDOS">POLITRANSFUNDIDOS</option>
                                                                                        <option value="DROGO DEPENDIENTES">DROGO DEPENDIENTES</option>
                                                                                        <option value="NO APLICA">NO APLICA</option>
                                                                                    </select>
                                                                                </td-->
                                                                                <td>Pertenencia &eacute;tnica:</td>
                                                                                <td>
                                                                                    <select id="cbPertenenciaEtnica">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="01. MESTIZO">01. MESTIZO</option>
                                                                                        <option value="02. AFRODESCENDIENTE">02. AFRODESCENDIENTE</option>
                                                                                        <option value="03. ANDINO">03. ANDINO</option>
                                                                                        <option value="04. INDIGENA AMAZONICO">04. IND&Iacute;GENA AMAZ&Oacute;NICO</option>
                                                                                        <option value="05. DESCENDIENTE">05. DESCENDIENTE</option>
                                                                                        <option value="06. OTROS">06. OTROS</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Descendencia &eacute;tnica:</td>
                                                                                <td>
                                                                                    <select id="cbDesendenciaEtnica">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                    </select>
                                                                                </td>
                                                                                <!--td>Otros lugares de residencia</td>
                                                                                <td>
                                                                                    <select id="cbLugarResidencia">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="SI">SI</option>
                                                                                        <option value="NO">NO</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input id="tbLugarResidencia"></input>
                                                                                </td-->
                                                                            </tr>
                                                                            <tr>
                                                                                <td>¿Actualmente estudia?</td>
                                                                                <td>
                                                                                    <select id="cbEstudia">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="SI">SI</option>
                                                                                        <option value="NO">NO</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        </fieldset><br/>
                                                                        <!--fieldset class="ui-widget-content ui-corner-all"><h3 class="ui-widget-header">En casos de emergencia</h3>
                                                                            <table style="border-spacing: 10px">
                                                                                <tr>
                                                                                    <td>Nombre de contacto</td>
                                                                                    <td><input id="tbNombreContacto"></input></td>
                                                                                    <td>Tel&eacute;fono</td>
                                                                                    <td><input id="tbTelefonoContacto"></input></td>
                                                                                    <td>Parentesco de contacto</td>
                                                                                    <td>
                                                                                        <select id="cbParentescoContacto">
                                                                                            <option value="">Seleccione una opci&oacute;n</option>
                                                                                            <option value="PADRE">PADRE</option>
                                                                                            <option value="MADRE">MADRE</option>
                                                                                            <option value="HERMAMO/HERMANA">HERMAMO/HERMANA</option>
                                                                                            <option value="HIJO/HIJA">HIJO/HIJA</option>
                                                                                            <option value="ABUELO/ABUELA">ABUELO/ABUELA</option>
                                                                                            <option value="TIO/TIA">TIO/TIA</option>
                                                                                            <option value="NIETO/NIETA">NIETO/NIETA</option>
                                                                                            <option value="PADRE ADOPTIVO">PADRE ADOPTIVO</option>
                                                                                            <option value="MADRE ADOPTIVA">MADRE ADOPTIVA</option>
                                                                                            <option value="PADRASTRO">PADRASTRO</option>
                                                                                            <option value="MADRASTRA">MADRASTRA</option>
                                                                                            <option value="NUERA">NUERA</option>
                                                                                            <option value="YERNO">YERNO</option>
                                                                                            <option value="OTRO">OTRO</option>
                                                                                        </select>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </fieldset-->
                                                                    </td>
                                                                    <td valign="top">
                                                                        <table id="listaCondicion"></table>
                                                                        <table id="listaCulturales"></table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="dialogEtapas" title="RIESGOS A IDENTIFICAR DE ACUERDO A LA ETAPA DE VIDA Y COMO FAMILIA" align="center">
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <table id="listaEtapaNino"></table>
                                                                        <table id="listaEtapaAdolescente"></table>
                                                                        <table id="listaEtapaJoven"></table>
                                                                        <table id="listaEtapaAdulto"></table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table id="listaRiesgoFamilia"></table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table id="listaMiembroTiene"></table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table id="listaRiesgoGestante"></table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div id="tab4">
                                                        <table>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table>
                                                                        <tr>
                                                                            <td>Estado civil jefe familia</td>
                                                                            <td>
                                                                                <select id="cbEstadoCivil">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="VIUDO(A)" puntaje = "5">Viudo(a)</option>
                                                                                    <option value="SOLTERO C/FAMILIA" puntaje = "4">Soltero c/familia</option>
                                                                                    <option value="DIVORCIADO" puntaje = "3">Divorciado</option>
                                                                                    <option value="UNION ESTABLE" puntaje = "2">Uni&oacute;n Estable</option>
                                                                                    <option value="SOLTERO S/FAMILIA" puntaje = "1">Soltero s/familia</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Grupo familiar</td>
                                                                            <td>
                                                                                <select id="cbGrupoFamiliar">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="MAS DE 9 MIEMBROS" puntaje = "5">mas de 9 miembros</option>
                                                                                    <option value="7 A 8 MIEMBROS" puntaje = "4">7 a 8 miembros</option>
                                                                                    <option value="5 A 6 MIEMBROS" puntaje = "3">5 a 6 miembros</option>
                                                                                    <option value="3 A 4 MIEMBROS" puntaje = "2">3 a 4 miembros</option>
                                                                                    <option value="1 A 2 MIEMBROS" puntaje = "1">1 a 2 miembros</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Vivienda</td>
                                                                            <td>
                                                                                <select id="cbTenenciaVivienda">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="ALQUILER" puntaje = "5">Alquiler</option>
                                                                                    <option value="CUIDADOR/ALOJADO" puntaje = "4">Cuidador/alojado</option>
                                                                                    <option value="PLAN SOCIAL" puntaje = "3">Plan social</option>
                                                                                    <option value="ALQUILER VENTA" puntaje = "2">Alquiler venta</option>
                                                                                    <option value="PROPIA" puntaje = "1">Propia</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Consumo de agua</td>
                                                                            <td>
                                                                                <select id="cbAguaConsumo">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="ACEQUIA,RIO,PUQUIAL" puntaje = "5">Acequia,rio,puquial</option>
                                                                                    <option value="POZO" puntaje = "4">Pozo</option>
                                                                                    <option value="CISTERNA" puntaje = "3">Cisterna</option>
                                                                                    <option value="RED PUBLICA" puntaje = "2">Red p&uacute;blica</option>
                                                                                    <option value="CONEXION DOMICILIARIA" puntaje = "1">Conexi&oacute;n domiciliaria</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Eliminacion de excretas</td>
                                                                            <td>
                                                                                <select id="cbEliminacionExcretas">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="AIRE LIBRE,CAMPO ABIERTO" puntaje = "5">Aire libre,campo abierto</option>
                                                                                    <option value="ACEQUIA,CANAL" puntaje = "4">Acequia,canal</option>
                                                                                    <option value="LETRINA" puntaje = "3">Letrina</option>
                                                                                    <option value="BANO PUBLICO(RED)" puntaje = "2">Ba&ntilde;o p&uacute;blico(red)</option>
                                                                                    <option value="BANO PROPIO(RED)" puntaje = "1">Ba&ntilde;o propio(red)</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Nro. habitaciones</td>
                                                                            <td>
                                                                                <select id="cbNroHabitacionesHogar">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="1 HABITACION" puntaje = "5">1 Habitacion</option>
                                                                                    <option value="2 HABITACIONES" puntaje = "4">2 Habitaciones</option>
                                                                                    <option value="3 HABITACIONES" puntaje = "3">3 Habitaciones</option>
                                                                                    <option value="4 HABITACIONES" puntaje = "2">4 Habitaciones</option>
                                                                                    <option value="5 HABITACIONES" puntaje = "1">5 Habitaciones</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Energ&iacute;a el&eacute;ctrica</td>
                                                                            <td>
                                                                                <select id="cbEnergiaElectrica">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="SIN ENERGIA" puntaje = "5">Sin energia</option>
                                                                                    <option value="VELA, OTROS" puntaje = "4">Vela, otros</option>
                                                                                    <option value="LAMPARA(NO ELECTRICA)" puntaje = "3">L&aacute;mpara(no el&eacute;ctrica)</option>
                                                                                    <option value="EE TEMPORAL" puntaje = "2">EE Temporal</option>
                                                                                    <option value="EE PERMANENTE" puntaje = "1">EE permanente</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Instrucci&oacute;n madre</td>
                                                                            <td>
                                                                                <select id="cbInstruccionMadre">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="NINGUNA" puntaje = "5">Ninguna</option>
                                                                                    <option value="PRIMARIA" puntaje = "4">Primaria</option>
                                                                                    <option value="SECUNDARIA" puntaje = "3">Secundaria</option>
                                                                                    <option value="TECNICA" puntaje = "2">T&eacute;cnica</option>
                                                                                    <option value="PROFESIONAL" puntaje = "1">Profesional</option>
                                                                                    <option value="NO APLICA" puntaje = "0">No aplica</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Ocupaci&oacute;n jefe de fam.</td>
                                                                            <td>
                                                                                <select id="cbOcupacionJefe">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="DESOCUPADO" puntaje = "5">Desocupado</option>
                                                                                    <option value="TRABAJO EVENTUAL" puntaje = "4">Trabajo eventual</option>
                                                                                    <option value="EMPLEADO SIN SEGURO" puntaje = "3">Empleado sin seguro</option>
                                                                                    <option value="CONTRATADO SIN SEGURO" puntaje = "2">Contratado sin seguro</option>
                                                                                    <option value="PROFESIONAL O PRODUCTOR" puntaje = "1">Profesional o productor</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>Ingresos familiares</td>
                                                                            <td>
                                                                                <select id="cbIngresoFamiliar">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="MENOS DE 750 NS" puntaje = "5">menos de 750 NS</option>
                                                                                    <option value="DE 751 A 1000 NS" puntaje = "4">de 751 a 1000 NS</option>
                                                                                    <option value="DE 1001 A 1650NS" puntaje = "3">de 1001 a 1650NS</option>
                                                                                    <option value="DE 1651 A 2200 NS" puntaje = "2">de 1651 a 2200 NS</option>
                                                                                    <option value="DE 2201 A MAS NS" puntaje = "1">de 2201 a mas NS</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nro. personas. x dorm.</td>
                                                                            <td>
                                                                                <select id="cbPersonaDormitorio">
                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                    <option value="6 Y MAS MIEMBROS" puntaje = "5">6 y m&aacute;s miembros</option>
                                                                                    <option value="5 MIEMBROS" puntaje = "4">5 miembros</option>
                                                                                    <option value="4 MIEMBROS" puntaje = "3">4 miembros</option>
                                                                                    <option value="3 MIEMBROS" puntaje = "2">3 miembros</option>
                                                                                    <option value="1 O 2 MIEMBROS" puntaje = "1">1 &oacute; 2 miembros</option>
                                                                                </select>
                                                                            </td>
                                                                            <!--td>Salud en hogar</td>
                                                                            <td>
                                                                                <select id="cbSaludHogar">
                                                                                    <option value=""></option>
                                                                                    <option value="CLINICA">Cl&iacute;nica</option>
                                                                                    <option value="HOSPITAL">Hospital</option>
                                                                                    <option value="P.S">P.S</option>
                                                                                    <option value="C.S">C.S</option>
                                                                                    <option value="CASA">Casa</option>
                                                                                    <option value="BOTICA O FARMACIA">Botica - farmacia</option>
                                                                                </select>
                                                                                <select id="cbSaludHogar1">
                                                                                    <option value=""></option>
                                                                                    <option value="CLINICA">Cl&iacute;nica</option>
                                                                                    <option value="HOSPITAL">Hospital</option>
                                                                                    <option value="P.S">P.S</option>
                                                                                    <option value="C.S">C.S</option>
                                                                                    <option value="CASA">Casa</option>
                                                                                    <option value="BOTICA O FARMACIA">Botica - farmacia</option>
                                                                                </select>
                                                                            </td-->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td valign="top">
                                                                    <table id="listaSaludHogar"></table>
                                                                </td>
                                                                <!--td valign="middle">
                                                                    <button id="btnGuardarSocioEconomico">Guardar</button><br/><br/>
                                                                    <button id="btnCancelarSocioEconomico">Cancelar</button>
                                                                </td-->
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div id="tab5">
                                                        <table>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table align="center">
                                                                        <tr>
                                                                            <td valign="top">
                                                                                <table id="listaVivienda"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaParedes"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaPiso"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaTecho"></table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top">
                                                                                <table id="listaOrganizacionVivienda"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaArtefactos"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaCombustible"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaBasura"></table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top">
                                                                                <table id="listaAnimales"></table>
                                                                                Nro. de canes: <input type="text" id="tbNroCanes" size="10"></input>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaVacunas"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <table id="listaEntorno"></table>
                                                                            </td>
                                                                            <td valign="top">
                                                                                <div class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix">
                                                                                    <span class="ui-jqgrid-title">¿Ha implementado su biohuerto?</span></br>
                                                                                </div>
                                                                                <select id="cbBiohuerto">
                                                                                    <option value="NO">NO</option>
                                                                                    <option value="SI">SI</option>
                                                                                </select>
                                                                                <table id="listaBiohuerto"></table>
                                                                                <!--input id="tbBiohuerto" size="34"></input-->
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <!--td valign="top">
                                                                    <button id="btnExpandir">Expandir todo</button><br/><br/>
                                                                    <button id="btnContraer">Contraer todo</button><br/><br/>
                                                                    <button id="btnGuardarVivienda">Guardar datos</button><br/><br/>
                                                                    <button id="btnCancelarVivienda">Cancelar datos</button>
                                                                </td-->
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div id="tab6">
                                                        <table align="center">
                                                            <tr>
                                                                <td>
                                                                    <table id="listaVisita"></table>
                                                                    <div id="pagerVisita"></div>
                                                                </td>
                                                                <td>
                                                                    <button id="btnGuardarVisita">Agregar visita</button><br/>
                                                                    <button id="btnModificarVisita">Modificar cita</button><br/>
                                                                    <button id="btnEliminarVisita">Eliminar visita</button>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="top">
                                                <button id="btnGuardarHistorial">Guardar historial</button><br/><br/>
                                                <!--
                                                <button id="btnEditarFicha">Corregir Ficha</button><br/><br/>-->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoConsultaFicha" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">CONSULTA INTEGRAL SISFAC</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaConsultaFicha"></table>
                                                <div id="pagerConsultaFicha"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="tabsConsulta">
                                                    <ul>
                                                        <li><a href="#tabConsulta1">C&oacute;digo de ficha</a></li>
                                                        <li><a href="#tabConsulta2">Datos de la familia</a></li>
                                                        <li><a href="#tabConsulta3">integrantes de la familia</a></li>
                                                        <li><a href="#tabConsulta4">Datos socioecon&oacute;micos</a></li>
                                                        <li><a href="#tabConsulta5">Vivienda y entorno</a></li>
                                                        <li><a href="#tabConsulta6">Visitas domiciliarias</a></li>
                                                    </ul>
                                                    <div id="tabConsulta1"></div>
                                                    <div id="tabConsulta2"></div>
                                                    <div id="tabConsulta3">
                                                        <table id="listaConsultaIntegrantes"></table>
                                                    </div>
                                                    <div id="tabConsulta4"></div>
                                                    <div id="tabConsulta5"></div>
                                                    <div id="tabConsulta6"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="dialogBusqueda" title="Indique a la persona a la cual realizar&aacute; la atenci&oacute;n">
                                    <table>
                                        <tr>
                                            <td>DNI</td>
                                            <td><input id="tbBuscarDNI"></input></td>
                                            <td>C&oacute;digo de ficha</td>
                                            <td><input id="tbBuscaCodigoFicha"></input></td>
                                            <td>Nro. Historia Cl&iacute;nica</td>
                                            <td><input id="tbBuscarHistoria"></input></td>
                                        </tr>
                                        <tr>
                                            <td>Nombres y apellidos</td>
                                            <td><input id="tbBuscarNombre"></input></td>
                                            <td>Regi&oacute;n</td>
                                            <td><input id="tbBuscaRegion"></input></td>
                                            <td>Provincia</td>
                                            <td><input id="tbBuscarProvincia"></input></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoFichaClinica" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">INGRESO DE INFORMACI&Oacute;N EN LA FICHA CL&Iacute;NICA</h1></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>
                                                            <fieldset class="ui-widget-content ui-corner-all"><legend>Indique a la persona a la cual le realizar&aacute; la atenci&oacute;n</legend>
                                                                <table style="border-spacing: 10px; font-weight: bold">
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <strong style="font-size: 16px">Personas</strong><br/>
                                                                            <table id="listaBusqueda"></table>
                                                                            <!--div id="pagerBusqueda"></div-->
                                                                        </td>
                                                                        <td><button id="btnBuscarMiembro">Buscar personas</button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <strong style="font-size: 16px">Episodios</strong><br/>
                                                                                        <table id="listaEpisodio"></table>
                                                                                    </td>
                                                                                    <td>
                                                                                        <button id="btnNuevaConsulta">Nueva atenci&oacute;n</button>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            
                                                                        </td>
                                                                        <td>
                                                                            
                                                                            <!--button id="btnContinuarConsulta">Continuar</button-->
                                                                        </td>
                                                                </tr>
                                                                </table>
                                                            </fieldset>
                                                        </td>
                                                    </tr>
                                                    <br/>
                                                    <tr>
                                                        <td>
                                                            <div id="tabsClinica">
                                                                <ul>
                                                                    <li><a href="#tabClinica1">Antecedentes</a></li>
                                                                    <li><a href="#tabClinica2">Episodio</a></li>
                                                                    <li><a href="#tabClinica3">Prestaciones</a></li>
                                                                    <li><a href="#tabClinica4">Medidas antropom&eacute;tricas y constantes</a></li>
                                                                    <li><a href="#tabClinica5">Vacunas</a></li>
                                                                    <li><a href="#tabClinica6">Diagn&oacute;stico y tratamiento</a></li>
                                                                    <li><a href="#tabClinica7">Interconsultas y referencia</a></li>
                                                                    <li><a href="#tabClinica8">HIS</a></li>
                                                                    <li><a href="#tabClinica9">PAIS</a></li>
                                                                </ul>
                                                                <div id="tabClinica1">
                                                                    <div id="divTabClinica1">
                                                                        <div id="resizable" class="ui-widget-content">
                                                                        <h3 class="ui-widget-header">Antecedentes ginecobs&eacute;tricos</h3>
                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                            <tr><input type="hidden" id="tbIdGinecobstetrico"></input>
                                                                                <td>F&oacute;rmula obst&eacute;trica</td>
                                                                                <td>Gestaciones<input id="tbGestaciones"></input></td>
                                                                                <td>Paridad<input id="tbParidad"></input></td>
                                                                                <td>Periodo intergen&eacute;sico<input id="tbIntergenesico"></input></td>
                                                                                <td><button id="btnGuardarGinecobstetrico">Guardar</button></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="5">
                                                                                    <table id="listaGinecobstetricos"></table>
                                                                                    <div id="pagerGinecobstetricos"></div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content" nombre="Prenatal">
                                                                            <h3 class="ui-widget-header">Antecedentes prenatales</h3>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <br/><strong style="font-size: 16px">Nacimiento</strong><br/>
                                                                                        <!--table id="listaNacimiento"></table>
                                                                                        <div id="pagerNacimiento"></div-->
                                                                                        <table style="border-spacing: 10px; font-weight: bold">
                                                                                            <tr><input type="hidden" id="hIdAntecedenteNacimiento"></input>
                                                                                                <td>Peso</td>
                                                                                                <td><input id="tbPeso"></input></td>
                                                                                                <td>Talla al nacer(cm.)</td>
                                                                                                <td><input id="tbTalla"></input></td>
                                                                                                <td>Per&iacute;metro cef&aacute;lico(gr.)</td>
                                                                                                <td><input id="tbPerimetroCefalico"></input></td>
                                                                                                <td>Per&iacute;metro toracico(cm.)</td>
                                                                                                <td><input id="tbPerimetroToracico"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Perimetro abdominal(cm.)</td>
                                                                                                <td><input id="tbPerimetroAbdominal"></input></td>
                                                                                                <td>Apgar</td>
                                                                                                <td><select id="cbApgar">
                                                                                                        <option value="1 MIN">1 MIN</option>
                                                                                                        <option value="5 MIN">5 MIN</option>
                                                                                                    </select></td>
                                                                                                <td>Edad gestacional(sem.)</td>
                                                                                                <td><input id="tbEdadGestacional"></input></td>
                                                                                                <td>Test capurro</td>
                                                                                                <td><input id="tbTest"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Complicaciones</td>
                                                                                                <td><input id="tbComplicaciones"></input></td>
                                                                                                <td>Malformaciones cong&eacute;nitas</td>
                                                                                                <td><select id="cbMalformaciones">
                                                                                                        <option value="SI">SI</option>
                                                                                                        <option value="NO">NO</option>
                                                                                                    </select></td>
                                                                                                <td>CIE10</td><input type="hidden" id="hIdCIE10Nacimiento"></input>
                                                                                                <td colspan="3"><input id="tbCIE10Nacimiento"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="8" align="right">
                                                                                                    <button id="btnGuardarNacimiento">Guardar</button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content">
                                                                            <h3 class="ui-widget-header">Antecedentes patol&oacute;gicos</h3>
                                                                            <table style="border-spacing: 10px ; font-size: 14px; font-weight: bold">
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Patolog&iacute;a &nbsp;&nbsp;&nbsp; </b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div id="divPatologico"></div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Hospitalizaci&oacute;n &nbsp;&nbsp;&nbsp; </b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div id="divHospitalizacion"></div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Transfusi&oacute;n sangu&iacute;nea &nbsp;&nbsp;&nbsp; </b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div id="divTransfusion"></div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Intervenci&oacute;n quir&uacute;rgica &nbsp;&nbsp;&nbsp; </b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div id="divIntervencion"></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content" name="divSaludSexual">
                                                                            <h3 class="ui-widget-header">Antecedentes de salud sexual y reproductiva</h3>
                                                                            <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                                <tr id="trMujeres">
                                                                                    <td>
                                                                                        <fieldset class="ui-widget-content ui-corner-all"><legend>Mujeres</legend>
                                                                                            <table style="border-spacing: 10px">
                                                                                                <tr>
                                                                                                    <td>Menarquia:</td>
                                                                                                    <td colspan="4"><input type="hidden" id="tbIdAntecedenteSexual"></input>
                                                                                                        <input id="tbMenarquia"></input>a&ntilde;os
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Regimen catamenial</td>
                                                                                                    <td colspan="4">
                                                                                                        <input id="tbRegimenCatamenial"></input>
                                                                                                    </td
                                                                                                ></tr>
                                                                                                <tr>
                                                                                                    <td>PAP</td>
                                                                                                    <td>
                                                                                                        <input type="radio" name="rbUltimoPAP" value="SI" checked> SI <input type="radio" name="rbUltimoPAP" value="NO" > NO
                                                                                                    </td>
                                                                                                    <td>Fecha &uacute;ltimo PAP<input id="tbFechaUltimoPAP" placeholder="mm/yyyy"></input></td>
                                                                                                    <td>
                                                                                                        Resultado <input type="radio" name="chResultadoPAP" value="NORMAL" checked> Normal <input type="radio" name="chResultadoPAP" value="PATOLOGICO"> Patol&oacute;gico
                                                                                                        <select id="cbDetallePAP">
                                                                                                            <option value="">Seleccione una opci&oacute;n</option>
                                                                                                            <option value="COLPOSCOPIA">COLPOSCOPIA</option>
                                                                                                            <option value="CRIOTERAPIA">CRIOTERAPIA</option>
                                                                                                            <option value="BIOPSIA">BIOPSIA</option>
                                                                                                        </select>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>IVAA</td>
                                                                                                    <td>
                                                                                                        <input type="radio" name="rbUltimoIVAA" value="SI" > SI <input type="radio" name="rbUltimoIVAA" value="NO" checked> NO
                                                                                                    </td>
                                                                                                    <td>Fecha &uacute;ltimo IVAA<input id="tbFechaUltimoIVAA" placeholder="mm/yyyy"></input></td>
                                                                                                    <td>
                                                                                                        Resultado
                                                                                                        <input type="radio" name="chResultadoIVAA" value="NORMAL" checked> Normal <input type="radio" name="chResultadoIVAA" value="PATOLOGICO"> Patol&oacute;gico
                                                                                                                <input id="tbCIE10IVAA" placeholder="Ingrese CIE10"></input>
                                                                                                                <input type="hidden" id="tbIdCIE10IVAA"/>
                                                                                                                </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Ex&aacute;men mamas</td>
                                                                                                    <td>
                                                                                                        <input type="radio" name="rbExamenMamas" value="SI"> SI <input type="radio" name="rbExamenMamas" value="NO" checked> NO
                                                                                                    </td>
                                                                                                    <td>Fecha &uacute;ltimo ex&aacute;men<input id="tbFechaExamenMamas" placeholder="mm/yyyy"></input>Tipo de ex&aacute;men<select id="cbTipoMamas"><option value="MAMOGRAFIA">MAMOGRAF&Iacute;A</option><option value="ECOGRAFIA">ECOGRAF&Iacute;A</option></select></td>
                                                                                                    <td>Resultado
                                                                                                        <input type="radio" name="chResultadoExamen" value="NORMAL" checked> Normal <input type="radio" name="chResultadoExamen" value="PATOLOGICO"> Patol&oacute;gico
                                                                                                        <input id="tbCIE10Mamas" placeholder="Ingrese CIE10"></input>
                                                                                                        <input type="hidden" id="tbIdCIE10Mamas"/>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </fieldset>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr  id="trVarones">
                                                                                    <td valign="top">
                                                                                        <fieldset class="ui-widget-content ui-corner-all"><legend>Varones</legend>
                                                                                            <table style="border-spacing: 10px">
                                                                                                <tr>
                                                                                                    <td>Ex&aacute;men prost&aacute;tico</td>
                                                                                                    <td>
                                                                                                        <input type="radio" name="rbExamenProstatico" value="SI"> SI <input type="radio" name="rbExamenProstatico" value="NO" checked> NO
                                                                                                    </td>
                                                                                                    <td>Fecha &uacute;ltimo ex&aacute;men<input id="tbFechaExamenProstatico" placeholder="mm/yyyy"></input></td>
                                                                                                    <td>Resultado
                                                                                                        <input type="radio" name="chResultadoExamenProstatico" value="NORMAL" checked> Normal <input type="radio" name="chResultadoExamenProstatico" value="PATOLOGICO"> Patol&oacute;gico
                                                                                                        <input id="tbCIE10Prostatico" placeholder="Ingrese CIE10"></input>
                                                                                                        <input type="hidden" id="tbIdCIE10Prostatico"/>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Tacto rectal</td>
                                                                                                    <td>
                                                                                                        <input type="radio" name="rbTactoRectal" value="SI"> SI <input type="radio" name="rbTactoRectal" value="NO" checked> NO
                                                                                                    </td>
                                                                                                    <td>Resultado<input type="radio" name="chTacto" value="NORMAL" checked> Normal <input type="radio" name="chTacto" value="PATOLOGICO"> Patol&oacute;gico
                                                                                                                <input id="tbCIE10TactoRectal" placeholder="Ingrese CIE10"></input>
                                                                                                                <input type="hidden" id="tbIdCIE10TactoRectal"/>
                                                                                                                </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </fieldset>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <fieldset class="ui-widget-content ui-corner-all"><legend>Ambos</legend>
                                                                                            <table style="border-spacing: 10px">
                                                                                                <tr>
                                                                                                    <td>Edad inicio de relaci&oacute;n sexual</td>
                                                                                                    <td><input id="tbEdadRelacion" style="width: 70px"></input></td>
                                                                                                    <td>Nro. de parejas sexuales en el ultimo a&ntilde;o</td>
                                                                                                    <td><input id="tbNroPareja" style="width: 70px"></input></td>
                                                                                                    <td>¿Pareja sexual?<input type="radio" name="chEdadRelacion" value="SI" checked> SI <input type="radio" name="chEdadRelacion" value="NO" > NO</td>
                                                                                                    <td>Edad de la pareja</td>
                                                                                                    <td><input id="tbEdadPareja" style="width: 70px"></input></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Actividad sexual con protecci&oacute;n</td>
                                                                                                    <td><input type="radio" name="chActividadProtecion" value="SI"> SI <input type="radio" name="chActividadProtecion" value="NO" checked> NO</td>
                                                                                                    <td>¿Utiliza m&eacute;todo anticonceptivo?</td>
                                                                                                    <td><input type="radio" name="chMetodo" value="SI" checked> SI <input type="radio" name="chMetodo" value="NO"> NO</td>
                                                                                                    <td></td>
                                                                                                    <td>Tiempo de uso</td>
                                                                                                    <td><input id="tbTiempoUso" style="width: 70px" placeholder="mm/yy"></input></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="3">
                                                                                                        <table id="listaMetodo"></table>
                                                                                                    </td>
                                                                                                    <td colspan="3" valign="bottom">
                                                                                                        <button id="btnGuardarAntecedenteSexual">Guardar antecedente de salud sexual y reproductiva</button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </fieldset>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>

                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content">
                                                                            <h3 class="ui-widget-header">Antecedentes fisiol&oacute;gicos</h3>
                                                                            <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                                <tr><input type="hidden" id="tbIdAntecedenteFisiologico"></input>
                                                                                    <td valign="top"><table id="listaAlimentacionp"></table></td>
                                                                                    <td valign="top"><table id="listaAlimentacion"></table></td>
                                                                                    <td valign="top">
                                                                                        Actividad Fisica
                                                                                        <input type="radio" name="chActividad" value="SI" checked> SI <input type="radio" name="chActividad" value="NO" > NO
                                                                                                    <br/>Frecuencia
                                                                                                    <select id="cbFrecuenciaActividad">
                                                                                                    <option value="">Seleccione una opci&oacute;n</option>
                                                                                                    <option value="DIARIO">DIARIO</option>
                                                                                                    <option value="SEMANAL">SEMANAL</option>
                                                                                                    <option value="MENSUAL">MENSUAL</option>
                                                                                                </select>
                                                                                                Nro. de veces
                                                                                                <input id="tbNroVecesActividad" style="width: 70px"></input>
                                                                                    </td>
                                                                                    <td valign="top">

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td valign="top"><table id="listaHigiene"></table></td>
                                                                                    <td>
                                                                                        <table id="listaRevision"></table>
                                                                                        &Uacute;ltima visita<br/>
                                                                                        <input id="tbFechaUltimaVisita" placeholder="mm/yyyy" ></input>
                                                                                    </td>
                                                                                    <td valign="">
                                                                                        <button id="btnGuardarFisiologico">Guardar antecedentes fisiol&oacute;gicos</button>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content">
                                                                            <h3 class="ui-widget-header">Antecedentes de inmunizaciones</h3>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table id="listaAntecedenteVacuna"></table>
                                                                                        <div id="pagerAntecedenteVacuna"></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <table id="listaAntecedenteDetalleVacuna"></table>
                                                                                        <div id="pagerAntecedenteDetalleVacuna"></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content">
                                                                            <h3 class="ui-widget-header">Antecedentes de medicamentos</h3>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table id="listaMedicamentos"></table>
                                                                                        <div id="pagerMedicamentos"></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content">
                                                                            <h3 class="ui-widget-header">Antecedentes familiares</h3>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Antecedente familiar</b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table id="listaAntecedentesFamiliares"></table>
                                                                                        <div id="pagerAntecedentesFamiliares"></div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>Alergias/Medicamentos</b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table id="listaAntecedentesAlergias"></table>
                                                                                        <div id="pagerAntecedentesAlergias"></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div id="resizable" class="ui-widget-content" name ="divPsicosociales">
                                                                            <h3 class="ui-widget-header">Antecedentes psicosociales</h3>
                                                                            <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                                <input type="hidden" id="tbIdAntecedentePsicosocial"></input>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table id="taHabitos">
                                                                                            <tr>
                                                                                                <td><h3>H&aacute;bitos nocivos</h3></td>
                                                                                                <td>Tipo</td>
                                                                                                <td>Cantidad</td>
                                                                                                <td>Frecuencia</td>
                                                                                                <td>Nro. de...</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Alcohol</td>
                                                                                                <td><input type="radio" name="rbAlchocol" value="SI" > SI <input type="radio" name="rbAlchocol" value="NO" checked> NO</td>
                                                                                                <td><input id="tbCantidadAlcohol" size="5"></input> Litros </td>
                                                                                                <td><select id="cbFrecuenciaAlcohol">
                                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                                        <option value="DIARIA">Diaria</option>
                                                                                                        <option value="SEMANAL">Semanal</option>
                                                                                                        <option value="MENSUAL">Mensual</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbNroVecesAlcohol" size="5"></input> veces</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Tabaco</td>
                                                                                                <td><input type="radio" name="rbTabaco" value="SI" > SI <input type="radio" name="rbTabaco" value="NO" checked> NO</td>
                                                                                                <td><input id="tbCantidadCigarrillos" size="5"> cigarrillos</input> <input id="tbCantidadCajetillas" size="5"> cajetillas</input></td>
                                                                                                <td><select id="cbFrecuenciaTabaco">
                                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                                        <option value="DIARIA">Diaria</option>
                                                                                                        <option value="SEMANAL">Semanal</option>
                                                                                                        <option value="MENSUAL">Mensual</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbNroVecesTabaco" size="5"></input> veces</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Drogas</td>
                                                                                                <td><input type="radio" name="rbDrogas" value="SI"> SI <input type="radio" name="rbDrogas" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td><select id="cbFrecuenciaDrogas">
                                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                                        <option value="DIARIA">Diaria</option>
                                                                                                        <option value="SEMANAL">Semanal</option>
                                                                                                        <option value="MENSUAL">Mensual</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbNroVecesDroga" size="5"></input> veces</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Hoja de coca</td>
                                                                                                <td><input type="radio" name="rbHojaCoca" value="SI" > SI <input type="radio" name="rbHojaCoca" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td><select id="cbFrecuenciaHojaCoca">
                                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                                        <option value="DIARIA">Diaria</option>
                                                                                                        <option value="SEMANAL">Semanal</option>
                                                                                                        <option value="MENSUAL">Mensual</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbNroVecesHojaCoca" size="5"></input> veces</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table id="taVidaSocial">
                                                                                            <tr>
                                                                                                <td><h3>Vida Social</h3></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Pornograf&iacute;a</td>
                                                                                                <td><input type="radio" name="chPornografia" value="SI"> SI <input type="radio" name="chPornografia" value="NO" checked> NO</td>
                                                                                                <td>Horas al d&iacute;a <input id="tbHorasDiaPornografia" size="5"></input></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Pertenece a pandillas</td>
                                                                                                <td><input type="radio" name="chPandilla" value="SI"> SI <input type="radio" name="chPandilla" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Video juegos</td>
                                                                                                <td><input type="radio" name="chVideoJuegos" value="SI"> SI <input type="radio" name="chVideoJuegos" value="NO" checked> NO</td>
                                                                                                            <td>Horas al d&iacute;a <input id="tbHorasDiaVideo" size="5"></input></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Delincuencia</td>
                                                                                                <td><input type="radio" name="chDelincuencia" value="SI"> SI <input type="radio" name="chDelincuencia" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table id="taViolencia">
                                                                                            <tr>
                                                                                                <td><h3>Violencia</h3></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Violencia familiar fisica</td>
                                                                                                <td><input type="radio" name="chViolencia" value="SI"> SI <input type="radio" name="chViolencia" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Violencia familiar psicol&oacute;gica</td>
                                                                                                <td><input type="radio" name="chViolenciaPsicologica" value="SI"> SI <input type="radio" name="chViolenciaPsicologica" value="NO" checked> NO</td>

                                                                                                            <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Violencia sexual</td>
                                                                                                <td><input type="radio" name="chViolenciaSexual" value="SI"> SI <input type="radio" name="chViolenciaSexual" value="NO" checked> NO</td>

                                                                                                            <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Bullyng</td>
                                                                                                <td><input type="radio" name="chBullyng" value="SI"> SI <input type="radio" name="chBullyng" value="NO" checked> NO</td>

                                                                                                            <td></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table id="taEducativo">
                                                                                            <tr>
                                                                                                <td><h3>Educativo</h3></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Deserci&oacute;n</td>
                                                                                                <td><input type="radio" name="chDesercion" value="SI"> SI <input type="radio" name="chDesercion" value="NO" checked> NO</td>
                                                                                                            <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Repitencia</td>
                                                                                                <td><input type="radio" name="chRepitencia" value="SI"> SI <input type="radio" name="chRepitencia" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Violencia por negligencia</td>
                                                                                                <td><input type="radio" name="chViolenciaNegligencia" value="SI"> SI <input type="radio" name="chViolenciaNegligencia" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Violencia pol&iacute;tica</td>
                                                                                                <td><input type="radio" name="chViolenciaPolitica" value="SI"> SI <input type="radio" name="chViolenciaPolitica" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table id="taLabores">
                                                                                            <tr>
                                                                                                <td><h3>Laborales</h3></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Trabaja</td>
                                                                                                <td><input type="radio" name="chTrabaja" value="SI"> SI <input type="radio" name="chTrabaja" value="NO" checked> NO</td>
                                                                                                <td>Edad inicio de trabajo <input id="tbEdadInicio" size="5"></input></td>
                                                                                                <td>Tipo de trabajo <input type="radio" name="chTipoTrabajo" value="ESTABLE"  checked> ESTABLE <input type="radio" name="chTipoTrabajo" value="TEMPORAL" > TEMPORAL</td>
                                                                                                            <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Riesgo ocupacional</td>
                                                                                                <td>
                                                                                                    <select id="cbRiesgoOcupacional">
                                                                                                        <option value="FISICO">FISICO</option>
                                                                                                        <option value="QUIMICO">QUIMICO</option>
                                                                                                        <option value="ERGONOMICOS">ERGONOMICOS</option>
                                                                                                    </select>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table id="taOtros">
                                                                                            <tr>
                                                                                                <td><h3>Otros</h3></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">Problemas de desorden en la alimentaci&oacute;n(Anorexia, Bulimia)</td>
                                                                                                <td><input type="radio" name="chProblemas" value="SI"> SI <input type="radio" name="chProblemas" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td>Intento de suicidio</td>
                                                                                                <td><input type="radio" name="chSuicidio" value="SI"> SI <input type="radio" name="chSuicidio" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td><button id="btnGuardarPsicosociales">Guardar antecedenes psicosociales</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica2" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <h3 class="ui-widget-header">Datos generales de la consulta</h3>
                                                                        <table style="border-spacing: 10px">
                                                                            <tr>
                                                                                <td>Nro. HC</td>
                                                                                <td><input id="tbConsultaHC"></input></td>
                                                                                <td>Medio de acceso</td>
                                                                                <td><select id="cbMedioAcceso">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="MEDIOS PROPIOS">Medios propios</option>
                                                                                        <option value="MOVILIDAD">Movilidad</option>
                                                                                        <option value="OTROS">Otros</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <!--td>Clase de atenci&oacute;n</td>
                                                                                <td><select id="cbClaseAtencion">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="PAIS">PAIS</option>
                                                                                    </select></td-->
                                                                                <td>Procedencia</td>
                                                                                <td><select id="cbProcedencia">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="DOMICILIO">Domicilio</option>
                                                                                        <option value="EE.SS">EE.SS</option>
                                                                                        <option value="OTROS">Otros</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tipo episodio</td>
                                                                                <td><select id="cbTipoEpisodio">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="PREVENTIVO">Preventivo</option>
                                                                                        <option value="RECUPERATIVO">Recuperativo</option>
                                                                                        <option value="PREVENTIVO-RECUPERATIVO">Preventivo-Recuperativo</option>
                                                                                    </select></td>
                                                                                <td>UPS</td>
                                                                                <td>
                                                                                    <input type="hidden" id="tbIdConsultaUPS"></input>
                                                                                    <input id="tbConsultaUPS"></input>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Situaci&oacute;n</td>
                                                                                <td><select id="cbSituacionConsulta">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="AMBULATORIO">Ambulatorio</option>
                                                                                    </select></td>
                                                                                <td>Acompa&ntilde;ante del paciente</td>
                                                                                <td><input id="tbAcompanante"></input></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Fecha inicio de episodio</td>
                                                                                <td><input id="tbFechaInicioEpisodio" placeholder="dd/mm/yyyy"></input></td>
                                                                                <td>Parentesco</td>
                                                                                <td>
                                                                                    <select id="cbParentescoAcompanante">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="PADRE">PADRE</option>
                                                                                        <option value="MADRE">MADRE</option>
                                                                                        <option value="HIJO/HIJA">HIJO/HIJA</option>
                                                                                        <option value="ABUELO/ABUELA">ABUELO/ABUELA</option>
                                                                                        <option value="TIO/TIA">TIO/TIA</option>
                                                                                        <option value="NIETO/NIETA">NIETO/NIETA</option>
                                                                                        <option value="PADRE ADOPTIVO">PADRE ADOPTIVO</option>
                                                                                        <option value="MADRE ADOPTIVA">MADRE ADOPTIVA</option>
                                                                                        <option value="PADRASTRO">PADRASTRO</option>
                                                                                        <option value="MADRASTRA">MADRASTRA</option>
                                                                                        <option value="NUERA">NUERA</option>
                                                                                        <option value="YERNO">YERNO</option>
                                                                                        <option value="OTRO">OTRO</option>
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nombre de episodio</td>
                                                                                <td colspan="3"><select id="cbNombreEpisodio">
                                                                                        <option value="">Seleccione una opci&oacute;n</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Estado episodio</td>
                                                                                <td><select id="cbEstadoEpisodio">
                                                                                        <option value="PENDIENTE">Pendiente</option>
                                                                                        <option value="CULMINADO">Culminado</option>
                                                                                    </select></td>
                                                                                <td>Fecha finalizaci&oacute;n episodio</td>
                                                                                <td><input id="tbFechaFinEpisodio" placeholder="dd/mm/yyyy"></input></td>
                                                                            </tr>
                                                                            <tr id="trConsulta">
                                                                                <td colspan="2">Motivo de consulta y relato cronol&oacute;gico</td>
                                                                                <td colspan="2"><textarea cols="50" rows="5" id="taMotivoConsulta"></textarea></td>
                                                                            </tr>
                                                                            <tr id="trSintomas">
                                                                                <td  colspan="2">Sintomas importantes</td>
                                                                                <td colspan="2"><textarea cols="50" rows="5" id="taSintomas"></textarea></td>
                                                                            </tr>
                                                                            <tr id="trSindrome">
                                                                                <td colspan="2">Registro del sindrome cultural identificados por el paciente</td>
                                                                                <td colspan="2"><textarea cols="50" rows="5" id="taRegistroSindrome"></textarea></td>
                                                                            </tr>
                                                                            <tr id="trEnfermedad">
                                                                                <td>Tiempo enfermedad</td>
                                                                                <td colspan="3"><input id="tbTiempoEnfermedad"></input><select id="cbTiempoEnfermedad">
                                                                                        <option value="HORA(S)">HORA(S)</option>
                                                                                        <option value="DIA(S)">DIA(S)</option>
                                                                                        <option value="MESE(S)">MESE(S)</option>
                                                                                        <option value="ANIO(S)">ANIO(S)</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Semana epidemiol&oacute;gica</td>
                                                                                <td><input id="tbSemanaEpidemiologica"></input></td>
                                                                            </tr>
                                                                            <tr id="trSemanaGestacional">
                                                                                <td>Semana gestacional</td>
                                                                                <td><input type="radio" name="rbSemanaGestacional" value="FUR"> FUR <input type="radio" name="rbSemanaGestacional" value="ECOGRAFIA" checked> Ecograf&iacute;a<input id="tbSemanaGestacional"></input></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><h3 style="color: #EA4335; text-align: center">Funciones biol&oacute;gicos</h3></td>
                                                                            </tr>
                                                                        </table>
                                                                        <table style="border-spacing: 10px">
                                                                            <tr>
                                                                                <td>Sue&ntilde;o</td>
                                                                                <td><select id="cbSuenoEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="AUMENTADO">Aumentado</option>
                                                                                        <option value="DISMINUIDO">Disminuido</option>
                                                                                    </select></td>
                                                                                <td>Sed</td>
                                                                                <td><select id="cbSedEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="AUMENTADO">Aumentado</option>
                                                                                        <option value="DISMINUIDO">Disminuido</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Apetito</td>
                                                                                <td><select id="cbApetitoEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="AUMENTADO">Aumentado</option>
                                                                                        <option value="DISMINUIDO">Disminuido</option>
                                                                                    </select></td>
                                                                                <td>Estado &aacute;nimo</td>
                                                                                <td><select id="cbEstadoAnimoEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="AUMENTADO">Aumentado</option>
                                                                                        <option value="DISMINUIDO">Disminuido</option>
                                                                                    </select></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Orina</td>
                                                                                <td><select id="cbOrinaEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="AUMENTADO">Aumentado</option>
                                                                                        <option value="DISMINUIDO">Disminuido</option>
                                                                                    </select></td>
                                                                                <td>Deposiciones</td>
                                                                                <td><select id="cbDeposicionEpisodio">
                                                                                        <option value="NORMAL">Normal</option>
                                                                                        <option value="LIQUIDAS">Liquidas</option>
                                                                                        <option value="DURAS">Duras</option>
                                                                                    </select></td>
                                                                                <td><input id="tbDeposicionHoraDia"></input><label id="lbHoraDiaDeposicion">horas/d&iacute;a</label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>P&eacute;rdida peso</td>
                                                                                <td colspan="3"><input type="radio" name="rbPerdidaPeso" value="SI"> SI <input type="radio" name="rbPerdidaPeso" value="NO" checked> NO<input id="tbPesoEpisodio"></input>Kg en <input id="tbTiempoEpisodio"></input><select id="cbTiempoEpisodio"><option value="SEMANA">SEMANA</option><option value="MESES">MESES</option><option value="ANOS">A&Ntilde;OS</option></select></td>
                                                                            </tr>
                                                                            <tr id="trTos">
                                                                                <td colspan="2">Tos y expectoraci&oacute;n por m&aacute;s de 2 semanas</td>
                                                                                <td><input type="radio" name="rbTosEpisodio" value="SI"> SI <input type="radio" name="rbTosEpisodio" value="NO" > NO</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><button id="btnGuardarEpisodio">Guardar episodio</button></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <div id="tabClinica3" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <table>
                                                                            <tr>
                                                                                <td>
                                                                                    <div>
                                                                                        <table id="listaPrestacion"></table>
                                                                                        <div id="pagerPrestacion"></div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><br/>
                                                                                    <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                                        <tr>
                                                                                            <td colspan="8">
                                                                                                <h3 class="ui-widget-header" id="hTituloPrestacion">SELECCIONE UNA PRESTACI&Oacute;N</h3>
                                                                                                <br/>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr><input type="hidden" id="tbIdUPSPrestacion"></input>
                                                                                            <td>UPS</td>
                                                                                            <td><input id="tbUPSPrestacion"></input></td>
                                                                                            <td>Fecha inicio</td>
                                                                                            <td><input id="tbFechaInicioPrestacion"></input></td>
                                                                                            <td>Estado</td>
                                                                                            <td><select id="cbEstadoPrestacion">
                                                                                                    <option value="PENDIENTE">Pendiente</option>
                                                                                                    <option value="CONCLUIDO">Concluido</option>
                                                                                                </select></td>
                                                                                            <td>Fecha fin</td>
                                                                                            <td><input id="tbFechaFinPrestacion"></input></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario38" title="Evaluaci&oacute;n del reci&e&eacute;n nacido (AIEPI 1 semana a menor de 2 meses)">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                                            <tr><input type="hidden" id="tbIdPrestacionAiepi"></input>
                                                                                                <td colspan="2">Determinar si es posible que se trate de INFECCI&Oacute;N BACTERIANA</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbInfeccion" value="SI"> SI <input type="radio" name="rbInfeccion" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Respiraciones por minuto</td>
                                                                                                <td><input id="tbRespiracionMinuto"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Respiraci&oacute;n r&aacute;pida?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbRespiracionRapida" value="SI"> SI <input type="radio" name="rbRespiracionRapida" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Hay tiraje subcostal grave?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbTirajeSubcostal" value="SI"> SI <input type="radio" name="rbTirajeSubcostal" value="NO" checked> NO
                                                                                                </td>
                                                                                                <td>¿Aleteo nasal?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbAleteoNasal" value="SI"> SI <input type="radio" name="rbAleteoNasal" value="NO" checked> NO
                                                                                                </td>
                                                                                                <td>¿Quejido?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbQuejido" value="SI"> SI <input type="radio" name="rbQuejido" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Estado de la fontanela?</td>
                                                                                                <td><input id="tbEstadoFontanela"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Supuraci&oacute;n de o&iacute;do?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbSupuracion" value="SI"> SI <input type="radio" name="rbSupuracion" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Ombligo?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbOmbligo" value="SUPURANDO"> SUPURANDO <input type="radio" name="rbOmbligo" value="ENROJECIDO" checked> ENROJECIDO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Temperatura?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbTemperatura" value="SI"> SI <input type="radio" name="rbTemperatura" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Piel de p&uacute;stulas?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbPielPustulas" value="SI"> SI <input type="radio" name="rbPielPustulas" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Inconsciente, let&aacute;rgio?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbInconsciente" value="SI"> SI <input type="radio" name="rbInconsciente" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Se mueve menos de lo normal?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbMueveMenos" value="SI"> SI <input type="radio" name="rbMueveMenos" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Secreci&oacute;n purulenta de ojos?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbSecrecion" value="SI"> SI <input type="radio" name="rbSecrecion" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Tiene DIARREA?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbDiarrea" value="SI"> SI <input type="radio" name="rbDiarrea" value="NO" checked> NO
                                                                                                </td>
                                                                                                <td>¿Cu&aacute;nto tiempo hace?</td>
                                                                                                <td><input id="tbTiempoDiarrea"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Hay sangre en las heces?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbSangreHeces" value="SI"> SI <input type="radio" name="rbSangreHeces" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Estado general</td>
                                                                                                <td colspan="2">
                                                                                                    <input type="radio" name="rbEstadoGeneral" value="LETARGIA, INCONSCIENCIA"> LETARGIA, INCONSCIENCIA<input type="radio" name="rbEstadoGeneral" value="IRRITABLE E INTRANQUILO" checked> IRRITABLE E INTRANQUILO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Tiene los ojos hundidos?</td>
                                                                                                <td><input type="radio" name="rbOjosHundidos" value="SI"> SI <input type="radio" name="rbOjosHundidos" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Signo de pliegue cut&aacute;neo</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbSignoCutaneo" value="MUY LENTA"> MUY LENTA<input type="radio" name="rbSignoCutaneo" value="LENTA" checked> LENTA
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                                <td><button id="btnGuardarFormulario38">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario39" title="Evaluaci&oacute;n del ni&nabla;o (AIEPI 2 meses a menores de 5 a&ntilde;sos)">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdPrestacionEvaluacionNino"></input>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    1.- ¿Hay signos de peligro?<br/>
                                                                                                        -No se puede beber o tomar pecho<br/>
                                                                                                        -Letargia o Inconsciencia<br/>
                                                                                                        -Vomita todo<br/>
                                                                                                        -Convulsiones<br/>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbSignoPeligro" value="SI"> SI <input type="radio" name="rbSignoPeligro" value="NO" checked> NO
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2.- Autodiagnostico familiar y remedio recibidos</td>
                                                                                                <td colspan="4"><textarea id="taAutodiagnostico" cols="30" rows="3"></textarea></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>3.- ¿Tiene TOS o dificultad para respirar?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbTieneTos" value="SI"> SI <input type="radio" name="rbTieneTos" value="NO" checked> NO
                                                                                                </td>
                                                                                                <td>¿Cu&aacute;nto tiempo hace?</td>
                                                                                                <td><input id="tbTiempoTos"></input> d&iacute;as</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>4.- ¿Tiene dolor de o&iacute;do?</td>
                                                                                                <td>
                                                                                                    <input type="radio" name="rbDolorOido" value="SI"> SI <input type="radio" name="rbDolorOido" value="NO" checked> NO
                                                                                                </td>
                                                                                                <td>d&iacute;as de supuraci&oacute;n del o&iacute;do</td>
                                                                                                <td><input id="tbTiempoOido"></input> d&iacute;as</td>
                                                                                                <td>Tumefacci&oacute;n detras de la oreja<input type="radio" name="rbTumefacion" value="SI"> SI <input type="radio" name="rbTumefacion" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>5.- ¿Tiene dolor de la garganta?</td>
                                                                                                <td><input type="radio" name="rbGarganta" value="SI"> SI <input type="radio" name="rbGarganta" value="NO" checked> NO</td>
                                                                                                <td>Exuado/pus o enrojecimiento</td>
                                                                                                <td><input type="radio" name="rbEnrojecimiento" value="SI"> SI <input type="radio" name="rbEnrojecimiento" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>6.- ¿Tiene ganglios dolorosos?</td>
                                                                                                <td><input type="radio" name="rbGanglios" value="SI"> SI <input type="radio" name="rbGanglios" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>7.- ¿Tiene DIARREA?</td>
                                                                                                <td><input type="radio" name="rbDiarreaNino" value="SI"> SI <input type="radio" name="rbDiarreaNino" value="NO" checked> NO</td>
                                                                                                            <td>¿Cu&aacute;nto tiempo hace?</td>
                                                                                                            <td><input id="tbTiempoDiarreaNino"></input>d&iacute;as</td>
                                                                                                            <td>Estado general <textarea id="taEstadoGeneral" cols="30" rows="2"></textarea></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>8.- ¿Hay sangre en las heces?</td>
                                                                                                <td colspan="3"><input type="radio" name="rbSangreHecesNino" value="NO" checked> NO <input type="radio" name="rbSangreHecesNino" value="LETARGIA O INCONSCIENCIA"> LETARGIA O INCONSCIENCIA<input type="radio" name="rbSangreHecesNino" value="INTRANQUILO O IRRITABLE"> INTRANQUILO O IRRITABLE</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>9.- Tiene  ojos hundidos(Ofrecer liquidos)</td>
                                                                                                <td colspan="4"><input type="radio" name="rbOjosHundidosNino" value="NO" checked> NO <input type="radio" name="rbOjosHundidosNino" value="BEBE MUY MAL O NO PUEDE BEBER"> BEBE MUY MAL O NO PUEDE BEBER<input type="radio" name="rbOjosHundidosNino" value="BEBE AVIDAMENTE, CON SED"> BEBE AVIDAMENTE, CON SED</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">10.- Signos de pliegue cut&aacute;neo. La piel vuelve al estado anterior.</td>
                                                                                                <td colspan="3"><input type="radio" name="rbSignoPliegue" value="MUY LENTAMENTE(MAS DE 2 SEGUNDOS)" checked> MUY LENTAMENTE(MAS DE 2 SEGUNDOS) <input type="radio" name="rbSignoPliegue" value="LENTAMENTE(MENOS DE 2 SEGUNDOS)"> LENTAMENTE(MENOS DE 2 SEGUNDOS)</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>11.- ¿Tiene FIEBRE?</td>
                                                                                                <td><input type="radio" name="rbFiebre" value="NO" checked> NO <input type="radio" name="rbFiebre" value="SI"> SI</td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3">12.- ¿En los &uacute;ltimos 14 d&iacute;as estuvo en zona de alto riesgo de malaria o dengue?</td>
                                                                                                <td><input type="radio" name="rbMalaria" value="NO" checked> NO <input type="radio" name="rbMalaria" value="SI"> SI</td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>13.- Observaciones</td>
                                                                                                <td colspan="3"><textarea id="taObservacion" cols="50" rows="3"></textarea></td>
                                                                                                <td>
                                                                                                    <button id="btnGuardarFormulario39">Guardar prestaci&oacute;n</button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario14" title="Evaluaci&o&oacute;n alimentaci&oacute;n y estado nutricional del reci&eacute;n nacido">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdPrestacionAlimentacionRN"></input>
                                                                                            <tr>
                                                                                                <td><b>Problema de ALIMENTACI&Oacute;N O DE BAJO PESO</b></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Toma de el pecho?</td>
                                                                                                <td><input type="radio" name="rbTomaPecho" value="SI" > SI <input type="radio" name="rbTomaPecho" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Cu&aacute;ntas veces durante d&iacute;a y la noche?</td>
                                                                                                <td><input id="tbTiempoPecho"></input></td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Come otras comidas o l&iacute;quidos adem&aacute;s de la leche materna?</td>
                                                                                                <td><input type="radio" name="rbComida" value="SI" > SI <input type="radio" name="rbComida" value="NO" checked> NO
                                                                                                ¿Cuales?<input id="tbComida"></input>
                                                                                                <td/>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Ha tenido alg&uacute;n cambio durante la enfermedad? </td>
                                                                                                <td><input type="radio" name="rbCambioEnfermedad" value="SI" > SI <input type="radio" name="rbCambioEnfermedad" value="NO" checked> NO
                                                                                                ¿Cual fue? <input id="tbCambioEnfermedad"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿&Uacute;lceras o placas blancas en la boca (moniliasis oral)?</td>
                                                                                                <td><input type="radio" name="rbUlceras" value="SI" > SI <input type="radio" name="rbUlceras" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><b>Evaluaci&oacute;n de la alimentaci&oacute;n del pecho</b></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1. ¿Se alimento del pecho durante la ultima hora?</td>
                                                                                                <td><input type="radio" name="rbAlimentoPecho" value="SI" > SI <input type="radio" name="rbAlimentoPecho" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="4">Si no se alimento pedir a la mam&aacute; que de mamar y observar la toma durante 4 minutos</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>¿Logra hacer todo el amarre? </td>
                                                                                                <td><input type="radio" name="rbAmarre" value="SI" > SI <input type="radio" name="rbAmarre" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2. ¿Mama bien?</td>
                                                                                                <td><input type="radio" name="rbMamaBien" value="NO MAMA NADA" >NO MAMA NADA <input type="radio" name="rbMamaBien" value="NO MAMA BIEN"> NO MAMA BIEN<input type="radio" name="rbMamaBien" value="MAMA BIEN" checked> MAMA BIEN</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>3. Tiene &uacute;lceras o placas blancas en la boca</td>
                                                                                                <td><input type="radio" name="rbUlcerasPlaca" value="SI" > SI <input type="radio" name="rbUlcerasPlaca" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>4. ¿Hay una buena posici&oacute;n al momento de la lactancia?</td>
                                                                                                <td><input type="radio" name="rbLactancia" value="SI" > SI <input type="radio" name="rbLactancia" value="NO" checked> NO</td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Observaciones</td>
                                                                                                <td colspan="4"><textarea id="taObservacionAlimentacion"></textarea></td>
                                                                                                <td><button id="btnGuardarFormulario14">Guardar prestaci&oacute;n</button></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario13" title="Evaluaci&oacute;n alimentaci&oacute;n y estado nutricional del ni&ntilde;o">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdPrestacionEvaluacionLME"></input>
                                                                                            <tr>
                                                                                                <td>1. ¿El ni&ntilde;o esta recibiendo Lactancia Materna? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbNinoLactancia" value="SI" > SI <input type="radio" name="rbNinoLactancia" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2. ¿La t&eacute;cnica de LM es adecuada? (Explorar y observar)</td>
                                                                                                <td><input type="radio" name="rbTecnicaLM" value="SI" > SI <input type="radio" name="rbTecnicaLM" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>3. ¿La frecuencia de LM es adecuada? (Explorar y evaluar)</td>
                                                                                                <td><input type="radio" name="rbFrecuenciaLM" value="SI" > SI <input type="radio" name="rbFrecuenciaLM" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>4. ¿El ni&ntilde;o recibe leche no materna?  (Explorar)</td>
                                                                                                <td><input type="radio" name="rbNinoLeche" value="SI" > SI <input type="radio" name="rbNinoLeche" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>5. ¿El ni&ntilde;o recibe aguitas? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbNinoAguitas" value="SI" > SI <input type="radio" name="rbNinoAguitas" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>6. ¿El ni&ntilde;o  recibe alg&uacute;n otro alimento? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbNinoAlimento" value="SI" > SI <input type="radio" name="rbNinoAlimento" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion7">
                                                                                                <td>7. ¿La consistencia de la preparaci&oacute;n es adecuada seg&uacute;n la edad? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbPreparacion" value="SI" > SI <input type="radio" name="rbPreparacion" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion8">
                                                                                                <td>8. ¿La cantidad de alimento es adecuada seg&uacute;n la edad? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbCantidadAlimento" value="SI" > SI <input type="radio" name="rbCantidadAlimento" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion9">
                                                                                                <td>9. ¿La frecuencia de la alimentaci&oacute;n es adecuada seg&uacute;n la edad? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbFrecuenciaAlimentacion" value="SI" > SI <input type="radio" name="rbFrecuenciaAlimentacion" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion10">
                                                                                                <td>10. ¿Consume alimentos de origen animal? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbAlimentoAnimal" value="SI" > SI <input type="radio" name="rbAlimentoAnimal" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion11">
                                                                                                <td>11. ¿Consume frutas y verduras? (Explorar)</td>
                                                                                                <td><input type="radio" name="rbFruta" value="SI" > SI <input type="radio" name="rbFruta" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion12">
                                                                                                <td>12. ¿A&ntilde;ade aceite,mantequilla o margarina a la comida del ni&ntilde;o ?</td>
                                                                                                <td><input type="radio" name="rbAceite" value="SI" > SI <input type="radio" name="rbAceite" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion13">
                                                                                                <td>13. ¿El ni&ntilde;o  recibe los alimentos en su propio plato?</td>
                                                                                                <td><input type="radio" name="rbAlimentoPropio" value="SI" > SI <input type="radio" name="rbAlimentoPropio" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion14">
                                                                                                <td>14. ¿A&ntilde;ade sal yodada a la comida familiar?</td>
                                                                                                <td><input type="radio" name="rbSal" value="SI" > SI <input type="radio" name="rbSal" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion15">
                                                                                                <td>15.  ¿Su ni&ntilde;a o ni&ntilde;o  est&aacute; tomando suplemento de hierro?</td>
                                                                                                <td><input type="radio" name="rbSuplementoHierro" value="SI" > SI <input type="radio" name="rbSuplementoHierro" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion16">
                                                                                                <td>16.¿Su ni&ntilde;a o ni&ntilde;o  ha recibido suplemento de vitamina "A"?</td>
                                                                                                <td><input type="radio" name="rbSuplementoVitamina" value="SI" > SI <input type="radio" name="rbSuplementoVitamina" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr id="trAlimentacion17">
                                                                                                <td>17¿Su ni&ntilde;a o ni&ntilde;o  est&aacute; recibiendo  multimicronutrientes?</td>
                                                                                                <td><input type="radio" name="rbMultimicronutiente" value="SI" > SI <input type="radio" name="rbMultimicronutiente" value="NO" checked> NO</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>18. ¿Es el ni&ntilde;o  beneficiario de alg&uacute;n Programa de ApoyoSocial?            </td>
                                                                                                <td><input type="radio" name="rbApoyoSocial" value="SI" > SI <input type="radio" name="rbApoyoSocial" value="NO" checked> NO</td>
                                                                                                            <td>Especificar <input id="tbApoyoSocial"></input></td>
                                                                                                            <td><button id="btnGuardarFormulario13">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario20" title="Evaluaci&o&oacute;n general integral">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdPrestacionExamenIntegral"></input>
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td>¿Alteraci&oacute;n?</td>
                                                                                                <td>Descripci&oacute;n</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Piel</td>
                                                                                                <td><select id="cbAlteracionPiel">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionPiel"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Cabeza</td>
                                                                                                <td><select id="cbAlteracionCabeza">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionCabeza"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Cabello</td>
                                                                                                <td><select id="cbAlteracionCabello">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionCabello"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Ojos y anexos</td>
                                                                                                <td><select id="cbAlteracionOjos">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td>Ojo derecho<input id="tbDescripcionOjoD"></input><br></br>
                                                                                                Ojo izquierdo<input id="tbDescripcionOjoI"></input><br></br></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>O&iacute;dos</td>
                                                                                                <td><select id="cbAlteracionOidos">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td>O&iacute;do derecho<input id="tbDescripcionOidoD"></input><br></br>
                                                                                                O&iacute;do izquierdo<input id="tbDescripcionOidoI"></input><br></br></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Nariz</td>
                                                                                                <td><select id="cbAlteracionNariz">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionNariz"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Boca</td>
                                                                                                <td><select id="cbAlteracionBoca">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionBoca"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Orofaringe</td>
                                                                                                <td><select id="cbAlteracionOrofaringe">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionOrofaringe"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Cuello</td>
                                                                                                <td><select id="cbAlteracionCuello">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionCuello"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Aparato respiratorio</td>
                                                                                                <td><select id="cbAlteracionRespiratorio">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionRespiratorio"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Aparato cardiovascular</td>
                                                                                                <td><select id="cbAlteracionCardiovascular">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionCardiovascular"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Aparato digestivo</td>
                                                                                                <td><select id="cbAlteracionDigestivo">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionDigestivo"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Aparato genitourinario</td>
                                                                                                <td><select id="cbAlteracionGenitourinario">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionGenitourinario"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Aparato locomotor</td>
                                                                                                <td><select id="cbAlteracionLocomotor">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionLocomotor"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Marcha</td>
                                                                                                <td><select id="cbAlteracionMarcha">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionMarcha"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Columna</td>
                                                                                                <td><select id="cbAlteracionColumna">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionColumna"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Miembros superiores</td>
                                                                                                <td><select id="cbAlteracionSuperior">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionSuperior"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Miembros inferiores</td>
                                                                                                <td><select id="cbAlteracionInferior">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionInferior"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Sistema linf&aacute;tico</td>
                                                                                                <td><select id="cbAlteracionLinfatico">
                                                                                                        <option value="SIN ALTERACION">SIN ALTERACION</option>
                                                                                                        <option value="CON ALTERACION">CON ALTERACION</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbDescripcionLinfatico"></input></td>
                                                                                                <td><button id="btnGuardarFormulario20">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario40" title="Consejer&iacute;a">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdPrestacionConsejeria"></input>
                                                                                            <tr>
                                                                                                <td><button id="btnGuardarFormulario40">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table id="listaTipoConsejeria"></table>
                                                                                                    <div id="pagerTipoConsejeria"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario17" title="Evaluaci&o&oacute;n del desarrollo">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdEvaluacionDesarrollo"></input>
                                                                                            <tr>
                                                                                                <td>Resultado de la evaluaci&oacute;n</td>
                                                                                                <td><select id="cbResultadoEvaluacion">
                                                                                                        <option value="DESARROLLO NORMAL">DESARROLLO NORMAL</option>
                                                                                                        <option value="RIESGO PARA TRANSTORNO DEL DESARROLLO">RIESGO PARA TRANSTORNO DEL DESARROLLO</option>
                                                                                                        <option value="DEFICIT DEL DESARROLLO SEGUN PB">DEFICIT DEL DESARROLLO SEGUN PB</option>
                                                                                                        <option value="TRANSTORNO DEL DESARROLLO">TRANSTORNO DEL DESARROLLO</option>
                                                                                                    </select></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Observaciones</td>
                                                                                                <td><textarea id="taObservacionEvaluacion" cols="50" rows="5"></textarea></td>
                                                                                                <td><button id="btnGuardarFormulario17">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario1" title="Administraci&oacute;n de micronutientes">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbIdAdministracionMicronutrientesNino"></input>
                                                                                            <tr>
                                                                                                <td>Hierro</td>
                                                                                                <td><input type="radio" name="rbHierro" value="NO" checked> NO <input type="radio" name="rbHierro" value="SI"> SI</td>
                                                                                                <td>Esquema</td>
                                                                                                <td><input id="tbEsquemaHierro"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Vitamina A</td>
                                                                                                <td><input type="radio" name="rbVitaminaA" value="NO" checked> NO <input type="radio" name="rbVitaminaA" value="SI"> SI</td>
                                                                                                <td>Esquema</td>
                                                                                                <td><input id="tbEsquemaVitaminaA"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Multimicronutientes</td>
                                                                                                <td><input type="radio" name="rbMicronutrientes" value="NO" checked> NO <input type="radio" name="rbMicronutrientes" value="SI"> SI</td>
                                                                                                <td>Esquema</td>
                                                                                                <td><input id="tbEsquemaMicronutrientes"></input></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3">Seguimiento de la administracion de micronutrientes en Establecimiento de Salud</td>
                                                                                                <td><input id="tbFechaMicronutriente"></input>
                                                                                                    <select id="cbMicronutriente">
                                                                                                        <option value="PENDIENTE">PENDIENTE</option>
                                                                                                        <option value="CUMPLIO">CUMPLIO</option>
                                                                                                        <option value="NO CUMPLIO">NO CUMPLIO</option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table>
                                                                                            <tr>
                                                                                                <td colspan="2">Seguimiento de la administracion de micronutrientes en el domicilio:</td>
                                                                                                <td align="center">Visita 1</td>
                                                                                                <td align="center">Visita 2</td>
                                                                                                <td align="center">Visita 3</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2"></td>
                                                                                                <td><input id="tbFechaVisita1"></input><select id="cbFechaVisita1">
                                                                                                        <option value="PENDIENTE">PENDIENTE</option>
                                                                                                        <option value="CUMPLIO">CUMPLIO</option>
                                                                                                        <option value="NO CUMPLIO">NO CUMPLIO</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbFechaVisita2"></input><select id="cbFechaVisita2">
                                                                                                        <option value="PENDIENTE">PENDIENTE</option>
                                                                                                        <option value="CUMPLIO">CUMPLIO</option>
                                                                                                        <option value="NO CUMPLIO">NO CUMPLIO</option>
                                                                                                    </select></td>
                                                                                                <td><input id="tbFechaVisita3"></input><select id="cbFechaVisita3">
                                                                                                        <option value="PENDIENTE">PENDIENTE</option>
                                                                                                        <option value="CUMPLIO">CUMPLIO</option>
                                                                                                        <option value="NO CUMPLIO">NO CUMPLIO</option>
                                                                                                    </select></td>
                                                                                                <td><button id="btnGuardarFormulario1">Guardar prestaci&oacute;n</button></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div id="formulario" title="">
                                                                                        <table style="border-spacing: 10px ; font-size: 12px; font-weight: bold; text-align: left"><input type="hidden" id="tbId"></input>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica4" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <!--Fecha: <input id="tbFechaEpisodio"></input>-->
                                                                        <table id="listaVariableAntropometrica"></table>
                                                                        <div id="pagerVariableAntropometrica"></div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                                <div id="tabClinica5" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <h3 class="ui-widget-header">Vacunas</h3>
                                                                        <table>
                                                                            <tr>
                                                                                <td>
                                                                                    <table id="listaVacunaPersona"></table>
                                                                                    <div id="pagerVacunaPersona"></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table id="listaDetalleVacuna"></table>
                                                                                    <div id="pagerDetalleVacuna"></div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica6" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <table>
                                                                            <tr>
                                                                                <td>
                                                                                    <h3 class="ui-widget-header">Diagn&oacute;stico</h3>
                                                                                    <table id="listaDiagnostico"></table>
                                                                                    <div id="pagerDiagnostico"></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <h2 style="color: #EA4335; text-align: center">Tratamiento resolutivo</h2>
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td><strong style="font-size: 14px">Medicamentos</strong></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table id="listaTratamientoMedicamentos"></table>
                                                                                                <div id="pagerTratamientoMedicamentos"></div><br></br>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <strong style="font-size: 14px">Descripci&oacute;n plantas medicinales</strong>
                                                                                                <button id="btnGuardarPlanta">Guardar</button>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td valign="top"><input type="hidden" id="taIdPlanta"></input>
                                                                                                <textarea cols="100" rows="4" id="taPlanta"></textarea>
                                                                                                <br/>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong style="font-size: 14px">Procedimientos</strong></td>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table id="listaTratamientoProcedimientos"></table>
                                                                                                    <div id="pagerTratamientoProcedimientos"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong style="font-size: 14px">Insumos</strong></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table id="listaTratamientoInsumos"></table>
                                                                                                <div id="pagerTratamientoInsumos"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><strong style="font-size: 14px">Tratamiento preventivo</strong></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table id="listaTratamientoPreventivo"></table>
                                                                                                <div id="pagerTratamientoPreventivo"></div>
                                                                                            </td>
                                                                                        </tr>   
                                                                                        
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica7" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <table>
                                                                            <!--tr>
                                                                                <td><strong style="font-size: 14px">Consejeria</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table id="listaConsejeria"></table>
                                                                                    <div id="pagerConsejeria"></div>
                                                                                </td>
                                                                            </tr-->   
                                                                            <tr>
                                                                                <td><h3 style="color: #EA4335; text-align: center">Interconsulta</h3></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table id="listaInterconsulta"></table>
                                                                                    <div id="pagerInterconsulta"></div>
                                                                                </td>
                                                                            </tr>   
                                                                        </table>
                                                                        
                                                                        
                                                                        <table>
                                                                            <tr>
                                                                                <td valign="top">
                                                                                    <table style="border-spacing: 5px">
                                                                                        <input type="hidden" id="tbIdReferencia"></input>
                                                                                        <tr>
                                                                                            <td colspan="2"><h3 style="color: #EA4335; text-align: center">Referencia</h3></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <table id="listaReferencia"></table>
                                                                                                <div id="pagerReferencia"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Establecimiento de origen de la referencia:</td>
                                                                                            <td><input id="tbEstablecimientoReferencia" value="<?php echo $_SESSION[claveGeneral];?>"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Establecimiento de destino de la referencia</td>
                                                                                            <input type="hidden" id="tbIdReferenciaEstablecimiento"></input>
                                                                                            <td><input id="tbReferenciaEstablecimiento"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>UPS de destino</td>
                                                                                            <input type="hidden" id="tbIdEstablecimientoUPS"></input>
                                                                                            <td><input id="tbEstablecimientoUPS"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Fecha de la referencia</td>
                                                                                            <td><input id="tbFechaReferencia" placeholder="dd/mm/yyyy"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Responsable de la referencia</td>
                                                                                            <td><select id="cbResponsableReferencia"></select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Responsable del establecimiento</td>
                                                                                            <td><select id="cbResponsableEstablecimiento"></select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Pesonal que acompa&ntilde;a</td>
                                                                                            <td><select id="cbPersonalAcompanante"></select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Condiciones del paciente antes del traslado</td>
                                                                                            <td><select id="cbCondicionPaciente">
                                                                                                    <option value="ESTABLE">ESTABLE</option>
                                                                                                    <option value="MAL ESTADO">MAL ESTADO</option>
                                                                                                </select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td><button id="btnGuardarReferencia">Guardar referencia</button></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td valign="top">
                                                                                    <table style="border-spacing: 5px">
                                                                                        <tr>
                                                                                            <td colspan="2"><h3 style="color: #EA4335; text-align: center">Recepci&oacute;n</h3></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Fecha de recepci&oacute;n</td>
                                                                                            <td><input id="tbFechaRecepcion" placeholder="dd/mm/yyyy"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Personal que recibe</td>
                                                                                            <td><input id="tbPersonalRecepcion"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Colegiatura</td>
                                                                                            <td><input id="tbColegiaturaRecepcion"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Profesi&oacute;n</td>
                                                                                            <td><select id="cbProfesionRecepcion"></select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Condiciones del paciente a la llegada</td>
                                                                                            <td><select id="cbCondicionPacienteRecepcion">
                                                                                                    <option value="ESTABLE">ESTABLE</option>
                                                                                                    <option value="MAL ESTADO">MAL ESTADO</option>
                                                                                                    <option value="FALLECIDO">FALLECIDO</option>
                                                                                                </select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Estado de la referencia</td>
                                                                                            <td><select id="cbEstadoReferencia">
                                                                                                    <option value="PENDIENTE">PENDIENTE</option>
                                                                                                    <option value="FINALIZADA">FINALIZADA</option>
                                                                                                </select></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Fecha de reingreso</td>
                                                                                            <td><input id="tbFechaReingreso" placeholder="dd/mm/yyyy"></input></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Diagnostico reingreso 1</td>
                                                                                            <td>
                                                                                                <input type="hidden" id="tbIdDiagnosticoReingreso1"></input>
                                                                                                <input id="tbDiagnosticoReingreso1"></input>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Diagnostico reingreso 2</td>
                                                                                            <td>
                                                                                                <input type="hidden" id="tbIdDiagnosticoReingreso2"></input>
                                                                                                <input id="tbDiagnosticoReingreso2"></input>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Diagnostico reingreso 3</td>
                                                                                            <td>
                                                                                                <input type="hidden" id="tbIdDiagnosticoReingreso3"></input>
                                                                                                <input id="tbDiagnosticoReingreso3"></input>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td><button id="btnGuardarRecepcion">Guardar recepci&oacute;n</button></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                            
                                                                        </table>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica8" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <table>
                                                                            <tr>
                                                                                <td><strong style="font-size: 14px">Datos hoja HIS</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Fecha registro</td>
                                                                                <td><label id="lbFechaRegistro"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nro. HC:</td>
                                                                                <td><label id="lbNHC"></label></td>
                                                                                <td>C&oacute;digo ficha familiar:</td>
                                                                                <td><label id="lbCodigoFicha"></label></td>
                                                                                <td>DNI</td>
                                                                                <td><label id="lbDNI"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nombre financiador</td>
                                                                                <td><label id="lbNombreFinanciador"></label></td>
                                                                                <td>Desendencia &eacute;tnica</td>
                                                                                <td><label id="lbDesendenciaEtnica"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Edad</td>
                                                                                <td><label id="lbEdad"></label></td>
                                                                                <td>Sexo</td>
                                                                                <td><label id="lbSexo"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="7">
                                                                                    <table id="listaHIS"></table>
                                                                                    <div id="pagerHIS"></div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div id="tabClinica9" style="border-spacing: 10px ; font-size: 12px; font-weight: bold">
                                                                    <div id="resizable" class="ui-widget-content">
                                                                        <h2 style="color: #EA4335; text-align: center"></h2>
                                                                        <table>
                                                                            <tr>
                                                                                <td colspan="6"><h2 style="color: #EA4335; text-align: center">PLAN DE ATENCI&Oacute;N INTEGRAL</h2></td>
                                                                            </tr>
                                                                            <tr><input type="hidden" id="tbIdPAIS"></input>
                                                                                <td>A&ntilde;o</td>
                                                                                <td><input id="tbAnioPAIS"></input></td>
                                                                                <td>Estado plan atenci&oacute;n</td>
                                                                                <td>
                                                                                    <select id="cbEstadoPAIS">
                                                                                        Sin elaborar Elaborado Ejecutado
                                                                                        <option id="SIN ELABORAR">SIN ELABORAR</option>
                                                                                        <option id="ELABORADO">ELABORADO</option>
                                                                                        <option id="EJECUTADO">EJECUTADO</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td><button id="btnGuardarPAIS">Guardar PAIS</button></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Fecha nacimiento</td>
                                                                                <td><label id="lbFechaNacimiento"></label></td>
                                                                                <td>Edad del paciente</td>
                                                                                <td><label id="lbEdadPaciente"></label></td>
                                                                            </tr>
                                                                        </table>
                                                                        <table>
                                                                            <tr>
                                                                                <td colspan="6"><br/>
                                                                                    <div id="divPAIS" class="scroll"></div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                </div>
                                <div id="contenidoRegion" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="1"><h1 style="color: #0074C7; font-weight: bolder;">Registro de regiones</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaRegion"></table>
                                                <div id="pagerRegion"></div>
                                            </td>
                                            <td align="left" width="358" valign="middle"><p><span style="color: #0074C7; font-weight: bolder;"><img src="../imagenes/advertenciatablasmaestras.jpg" width="248" height="116" /></span></p></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoProvincia" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="3"><h1 style="color: #0074C7; font-weight: bolder;">Registro de provincias</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaProvincia"></table>
                                                <div id="pagerProvincia"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarRegion" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoDistrito" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="3"><h1 style="color: #0074C7; font-weight: bolder;">Registro de distritos</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaDistrito"></table>
                                                <div id="pagerDistrito"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarProvincia" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoDiresa" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="1"><h1 style="color: #0074C7; font-weight: bolder;">Registro de DISAS</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaDiresa"></table>
                                                <div id="pagerDiresa"></div>
                                            </td>
                                            <td align="left" width="358" valign="middle"><p><span style="color: #0074C7; font-weight: bolder;"><img src="../imagenes/advertenciatablasmaestras.jpg" width="248" height="116" /></span></p></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoRed" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Registro de redes</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaRed"></table>
                                                <div id="pagerRed"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarDiresa" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoMicrored" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Registro de microredes</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaMicrored"></table>
                                                <div id="pagerMicrored"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarRed" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoNucleo" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Registro de nucleos</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaNucleo"></table>
                                                <div id="pagerNucleo"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarMicrored" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoEstablecimientoNucleo" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Registro de establecimientos</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaEstablecimientoNucleo"></table>
                                                <div id="pagerEstablecimientoNucleo"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarNucleo" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoMaestra" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Generar backups (archivos csv) de tablas maestras</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaMaestra"></table>
                                            </td>
                                            <td valign="middle">
                                                <button id="btnGenerarParche">Exportar backup de tablas maestras</button>
                                            </td>
                                            
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCargarCsv" class="contenidoborde" align="center">
                                    <table>
                                         <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Actualizaci&oacute;n de tablas maestras</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaMaestraCsv"></table>
                                            </td>
                                            <td valign="middle">
                                                
                                                <form id="formArchivosCsv" name="formArchivosCsv" method="post">
                                                    <button type="button" id="btnActualizarCsv">Cargar archivo CSV</button>
                                                  </form>
                                                <img src="../imagenes/actualizarTablas.jpg" width="205" height="115" />
                                                <!--button id="btnActualizarCsv">Actualizar CSV</button>
                                                <img src="../imagenes/actualizarTablas.jpg" width="248" height="116" /-->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="dialogEstablecimiento" title="Lista de establecimientos"></div>
                                <div id="contenidoTrabajadores" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="3"><h1 style="color: #0074C7; font-weight: bolder;">Lista de trabajadores</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaTrabajador"></table>
                                                <div id="pagerTrabajador"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarEstablecimientoNucleo" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoTrabajadorSector" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="3"><h1 style="color: #0074C7; font-weight: bolder;">Registro sectores por trabajador</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaTrabajadorSector"></table>
                                                <div id="pagerTrabajadorSector"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarTrabajadores" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="dialogSectores" title="Lista de sectores y comunidades"></div>
                                <div id="contenidoEstablecimiento" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="3"><h1 style="color: #0074C7; font-weight: bolder;">Registro de establecimientos</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaEstablecimiento"></table>
                                                <div id="pagerEstablecimiento"></div>
                                            </td>
                                            <td valign="top"><a id="aRegresarDistrito" href="#">Regresar</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoComunidad" class="contenidoborde" align="center">
                                    <table width="717">
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Registro de comunidades</h1></td>
                                        </tr>
                                        <tr>
                                            <td width="156">
                                                <table id="listaComunidad"></table>
                                                <div id="pagerComunidad"></div>
                                            </td>
                                            <td width="187" valign="top"><a id="aRegresarEstablecimiento" href="#">Regresar</a></td>
               <td align="left" width="358" valign="middle"><p><span style="color: #0074C7; font-weight: bolder;"><img src="../imagenes/AdvertenciaComunidades.jpg" width="248" height="116" /></span></p>
                                              </td>                           </tr>
                                    </table>
                              </div>
                                <div id="contenidoSector" class="contenidoborde" align="center">
                                    <table width="694">
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Registro de sectores </h1></td>
                                        </tr>
                                        <tr>
                                            <td width="153">
                                                <table id="listaSector"></table>
                                                <div id="pagerSector"></div>
                                            </td>
                                            <td align="left" width="153" valign="top"><p><a id="aRegresarComunidad" href="#">Regresar</a></p>
                                              </td>
                                            <td align="left" width="408" valign="middle"><p><span style="color: #0074C7; font-weight: bolder;"><img  src="../imagenes/AdvertenciaSectores.jpg.png" width="241" height="116" /></span></p>
                                              </td> 
                                      </tr>
                                    </table>
                              </div>
                                
                                <div id="contenidoCatalogoCIE10" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo CIE10</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoCIE10"></table>
                                                <div id="pagerCatalogoCIE10"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div id="contenidoCatalogoMedicamento" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo SISMED</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoMedicamento"></table>
                                                <div id="pagerCatalogoMedicamento"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCatalogoPrestaciones" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo prestaciones</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoPrestacion"></table>
                                                <div id="pagerCatalogoPrestacion"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCatalogoHIS" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo HIS</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoHIS"></table>
                                                <div id="pagerCatalogoHIS"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCatalogoEpisodio" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo episodio</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoEpisodio"></table>
                                                <div id="pagerCatalogoEpisodio"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCatalogoFinanciadores" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo financiadores</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="lista"></table>
                                                <div id="pager"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCatalogoLaboratorio" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="5"><h1 style="color: #0074C7; font-weight: bolder;">Cat&aacute;logo labortorio</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="listaCatalogoLaboratorio"></table>
                                                <div id="pagerCatalogoLaboratorio"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div id="contenidoReporteAcopio" class="contenidoborde" align="center" style="margin-bottom:50px">
                                   <h1 style="margin-bottom:10px 0px">Bases de Datos Acopiadas</h1>
                                   <div class="ui-jqgrid-titlebar ui-jqgrid-caption ui-widget-header ui-corner-top ui-helper-clearfix"><a role="link" class="ui-jqgrid-titlebar-close HeaderButton ui-corner-all" title="" style="right: 0px"><span class="ui-jqgrid-headlink ui-icon ui-icon-circle-triangle-n"></span></a><span class="ui-jqgrid-title">Registro de fichas familiares</span></div>
                                   <table id="tablaReporteAcopio"  width="100%" align="center" style="margin-bottom: 50px">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left;padding:10px">id</th>
                                                <th style="text-align: left;padding:10px">clavegeneral</th>
                                                <th style="text-align: left;padding:10px">fecha</th>
                                                <th style="text-align: left;padding:10px">nombreestablecimiento</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                   </table>

                                </div>


                                <div id="contenidoMigraComunidad" class="contenidoborde" align="center" style="margin-bottom:50px">
                                   <h1>Migrar comunidad</h1>
                                   <p style="margin:10px 0px">Migra una comunidad y sus familias de un establecimiento a otro.</p>

                                   <form style="margin-top:10px">
                                       <table>
                                           <tr>
                                               <td>
                                                <label style="font-size:18px;margin-bottom:10px;display:block;font-weight: bold" for="ubigeo_comunidad">Selecciona la comunidad a migrar</label>
                                               </td>
                                            </tr>


                                            <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_diresa_origen">Diresa</label>
                                                <select id="ubigeo_diresa_origen" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_red_origen">Red</label>
                                                <select id="ubigeo_red_origen" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_microred_origen">Microred</label>
                                                <select id="ubigeo_microred_origen" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_establecimiento_origen">Establecimiento</label>
                                                <select id="ubigeo_establecimiento_origen" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_comunidad_origen">Comunidad</label>
                                                <select id="ubigeo_comunidad_origen" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>


                                           <tr>
                                               <td>
                                                <p style="font-size:18px;display:block;font-weight: bold;margin-top:10px">Selecciona el establecimiento de destino.</p>
                                                <label style="display:block;margin-top:10px" for="ubigeo_diresa">Diresa</label>
                                                <select id="ubigeo_diresa" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_red">Red</label>
                                                <select id="ubigeo_red" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_microred">Microred</label>
                                                <select id="ubigeo_microred" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                           <tr>
                                               <td>
                                                <label style="display:block;margin-top:10px" for="ubigeo_establecimiento">Establecimiento</label>
                                                <select id="ubigeo_establecimiento" style="width:300px">
                                                    <option value=""></option>
                                                </select>
                                               </td>
                                            </tr>
                                       </table>
                                       <div style="text-align: center;margin-top:20px;margin-bottom:60px"><button id="migrar_comunidad" class="ui-button ui-corner-all ui-widget">Migrar la comunidad</button></div>
                                   </form>
                                       <br />

                                   <hr />
                                       <br />
<p style="font-size:18px;display:block;font-weight: bold;margin-top:10px">Selecciona el archivo a importar.</p>
                                       <br />
                                       <table>
                                            <tr>
                                                <td width="250">Importar comunidad</td>
                                                    <td>
                                                     <form id="formComunidad" name="formComunidad" method="post">
                                                        <button type="button" id="btnImportarComunidad">Importar</button>
                                                    </form>

                                                </td>
                                           </tr>
                                       </table>
                                       <br />
                                       <br />
                                </div>
                                
                                <div id="contenidoReportes" class="contenidoborde" align="center">
                                    
                                </div>
                                <div id="contenidoReporteEstadistico" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center"><h1 style="color: #0074C7; font-weight: bolder;">Reportes</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <fieldset class="ui-widget-content ui-corner-all" style="height:150px ;width:400px;"><legend class="ui-state-default">Filtrar por:</legend>
                                                                <ol id="selectable">
                                                                    <li class="ui-state-default">DISA/DIRESA</li>
                                                                    <li class="ui-state-default">REGION</li>
                                                                    <li class="ui-state-default">PROVINCIA</li>
                                                                    <li class="ui-state-default">DISTRITO</li>
                                                                    <li class="ui-state-default">COMUNIDAD</li>
                                                                    <li class="ui-state-default">SECTOR</li><br/>
                                                                    <li class="ui-state-default">RED</li>
                                                                    <li class="ui-state-default">MICRORED</li>
                                                                    <li class="ui-state-default">NUCLEO</li>
                                                                    <li class="ui-state-default">ESTABLECIMIENTO</li>
                                                                </ol>
                                                            </fieldset>
                                                            <select id="cbAtributo" multiple style="display: none">
                                                                <option value="" class="ui-widget-content">Seleccione una opci&oacute;n:</option>
                                                                <option value="DISA/DIRESA">DISA/DIRESA</option>
                                                                <option value="REGION">REGION</option>
                                                                <option value="PROVINCIA">PROVINCIA</option>
                                                                <option value="DISTRITO">DISTRITO</option>
                                                                <option value="COMUNIDAD">COMUNIDAD</option>
                                                                <option value="SECTOR">SECTOR</option>
                                                                <option value="RED">RED</option>
                                                                <option value="MICRORED">MICRORED</option>
                                                                <option value="NUCLEO">NUCLEO</option>
                                                                <option value="ESTABLECIMIENTO">ESTABLECIMIENTO</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <fieldset class="ui-widget-content ui-corner-all" style="height:150px ;width:400px;"><legend class="ui-state-default">Seleccione:</legend>
                                                                <table>
                                                                    <tr>
                                                                        <td id="tdOpcion1"></td>
                                                                        <td>
                                                                            <select id="cbOpcion1"></select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td id="tdOpcion2"></td>
                                                                        <td>
                                                                            <select id="cbOpcion2"></select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td id="tdOpcion3"></td>
                                                                        <td>
                                                                            <select id="cbOpcion3"></select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td id="tdOpcion4"></td>
                                                                        <td>
                                                                            <select id="cbOpcion4"></select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td id="tdOpcion5"></td>
                                                                        <td>
                                                                            <select id="cbOpcion5"></select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td id="tdSeleccionar"></td>
                                                                        <td>
                                                                            <select id="cbSeleccionar">
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </fieldset>
                                                        </td>   
                                                    </tr>
                                                </table>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="tabsReportes">
                                                    <ul>
                                                        <li><a href="#tabReporte1">Estad&iacute;sticos</a></li>
                                                        <li><a href="#tabReporte2">Tendencia</a></li>
                                                        <li><a href="#tabReporte3">Varios</a></li>
                                                        <li><a href="#tabReporte4">Sociecon&oacute;micos y de vivienda y entorno</a></li>
                                                    </ul>
                                                    <div id="tabReporte1">
                                                        <table>
                                                            <tr class="ui-widget-header" align="center">
                                                                <td >Tipo de reporte</td>
                                                                <td>Fecha Reporte</td>
                                                            </tr>
                                                       
                                                            <tr>
                                                                <td>N&uacute;mero de personas por edad y sexo</td>
                                                                <td><button id="btnReporteEdadSexo">Ver excel</button></td>
                                                                <!--td><button id="btnGraficoEdadSexo">Ver gr&aacute;fico</button></td-->
                                                            </tr>
                                                            <tr>
                                                                <td>Datos de familia</td>
                                                                <td><button id="btnReporteFicha">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas por etapa de vida</td>
                                                                <td><button id="btnReportePersonasEtapa">Ver excel</button></td>
                                                                <td><button id="btnGraficoPersonasEtapa">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Identidad de personas(por tipo de documento y sexo)</td>
                                                                <td><button id="btnReporteIndocumentadas">Ver excel</button></td>
                                                                <td><button id="btnGraficoIndocumentadas">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas gestantes</td>
                                                                <td><button id="btnReporteGestantes">Ver excel</button></td>
                                                                <!--td><button id="btnGraficoGestantes">Ver gr&aacute;fico</button></td-->
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de visitas por familia</td>
                                                                <td><button id="btnReporteVisita">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Visitas por familia</td>
                                                                <td><button id="btnReporteVisitaFecha">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de modificaciones por familia</td>
                                                                <td><button id="btnReporteModificacionesFamilia">Ver excel</button></td>
                                                                <td><button id="btnGraficoModificacionesFamilia">Ver gr&aacute;fico</button></td>
                                                                <td width="100"></td>
                                                                <!--td><button id="btnReporteTendenciaModificacionesFamilia">Tendencia</button></td-->
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas por grado de instrucción</td>
                                                                <td><button id="btnReporteInstruccion">Ver excel</button></td>
                                                                <td><button id="btnGraficoInstruccion">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;merode personas por tipo de seguro</td>
                                                                <td><button id="btnReporteSeguro">Ver excel</button></td>
                                                                <td><button id="btnGraficoSeguro">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias por ciclo vital</td>
                                                                <td><button id="btnReporteCicloVital">Ver excel</button></td>
                                                                <td><button id="btnGraficoCicloVital">Ver gr&aacute;fico</button></td>
                                                                <td width="100"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias por tipo de familia</td>
                                                                <td><button id="btnReporteTipoFamilia">Ver excel</button></td>
                                                                <td><button id="btnGraficoTipoFamilia">Ver gr&aacute;fico</button></td>
                                                                <td width="100"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias en riesgo por etapas de vida</td>
                                                                <td><button id="btnReporteFamiliaEtapa">Ver excel</button></td>
                                                                <td><button id="btnGraficoFamiliaEtapa">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias en riesgo segun datos socioecon&oacute;micos</td>
                                                                <td><button id="btnReporteFamiliaSocioEconomico">Ver excel</button></td>
                                                                <td><button id="btnGraficoFamiliaSocioEconomico">Ver gr&aacute;fico</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de canes por familia</td>
                                                                <td><button id="btnReporteCanesFamilia">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lista de trabajadores y sectores a cargo</td>
                                                                <td><button id="btnReporteTrabajadorSector">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estructura de tablas maestras - divisi&oacute;n geopol&iacute;tica</td>
                                                                <td><button id="btnReporteDivisionTablas">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estructura de tablas maestras - divisi&oacute;n sociosanitaria</td>
                                                                <td><button id="btnReporteDivisionTablasSocioeconomico">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Reporte de riesgos familiares</td>
                                                                <td><button id="btnReporteRiesgoFamilia">Ver excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Reporte de síndromes culturales</td>
                                                                <td><button id="btnReporteSindromesCulturales">Ver excel</button></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div id="tabReporte2">
                                                        <table>
                                                            <tr class="ui-widget-header" align="center">
                                                                <td></td>
                                                                <td>Fecha inicio (tendencia): </td>
                                                                <td>Fecha fin (tendencia): </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input id="tbFechaInicio"></input>
                                                                </td>
                                                                <td>
                                                                    <input id="tbFechaFin"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas por etapa de vida</td>
                                                                <td>
                                                                    <button id="btnReporteTendenciaPersonasEtapa">Tendencia</button>
                                                                </td>
                                                                <td>
                                                                    <button id="btnReporteTendenciaPersonasEtapaExcel">Excel (porcentaje)</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Identidad de personas</td>
                                                                <td><button id="btnReporteTendenciaIndocumentadas">Tendencia</button></td>
                                                                <td><button id="btnReporteTendenciaIndocumentadasExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas por grado de instrucción</td>
                                                                <td><button id="btnReporteTendenciaInstruccion">Tendencia</button></td>
                                                                <td><button id="btnReporteTendenciaInstruccionExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de personas por tipo de seguro</td>
                                                                <td><button id="btnReporteTendenciaSeguro">Tendencia</button></td>
                                                                <td><button id="btnReporteTendenciaSeguroExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias en riesgo por etapas de vida</td>
                                                                <td><button id="btnTendenciaFamiliaEtapa">Tendencia</button></td>
                                                                <td><button id="btnTendenciaFamiliaEtapaExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de familias en riesgo segun datos socioecon&oacute;micos</td>
                                                                <td><button id="btnTendenciaFamiliaSocioEconomico">Tendencia</button></td>
                                                                <td><button id="btnTendenciaFamiliaSocioEconomicoExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>N&uacute;mero de canes por familia</td>
                                                                <td><button id="btnTendenciaCanesFamilia">Tendencia</button></td>
                                                                <td><button id="btnTendenciaCanesFamiliaExcel">Excel (porcentaje)</button></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </div>
                                                    <div id="tabReporte3">
                                                        <table class="ui-widget ui-widget-content" align="center">
                                                            <thead>
                                                            </thead>
                                                            <tbody>
                                                                <tr align="left">
                                                                    <td>Informaci&oacute;n general individual de la poblaci&oacute;n </td>
                                                                    <td><input type="hidden" id="hIdCodigoFicha"></input><input id="tbBuscarCodigoFicha" placeholder="Buscar c&oacute;digo ficha"></input></td>
                                                                    <td><button id="btnVerReportePoblacion">Ver reporte</button></td>
                                                                    <td colspan="3" align="right" valign="top">                                                                        
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Informaci&oacute;n de gestantes</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteGestantes">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Familias seg&uacute;n ciclo vital</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteCicloVital">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Familias seg&uacute;n tipo</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteTipo">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Personas que no cuentan con seguro de salud</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteSeguro">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Visitas de salud familiar integral</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteVisita1">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Visitas de salud familiar integral II</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReporteVisitaF">Ver reporte</button></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Pir&aacute;mide poblacional</td>
                                                                    <td></input></td>
                                                                    <td><button id="btnVerReportePiramide">Ver reporte</button>
                                                                    <button id="btnVerGraficoPiramide">Ver gr&aacute;fico</button>
                                                                    <button id="btnVerGraficoPiramidePorcentual">Ver gr&aacute;fico %</button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="tabReporte4">
                                                        <table class="ui-widget ui-widget-content" align="center">
                                                            <thead>
                                                                <tr class="ui-widget-header" align="center">
                                                                    
                                                                    <td width="200">Socioecon&oacute;mico / Vivienda y entorno: </td>
                                                                    <td>Seleccione un valor:</td>
                                                                    <td> </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr align="center">
                                                                    <td>
                                                                        <select id="cbAtributoEstadistico1">
                                                                            <option value="">SELECCIONE UNA OPCION</option>
                                                                            <option value="SOCIOECONOMICO">SOCIOECONOMICO</option>
                                                                            <option value="VIVIENDA Y ENTORNO">VIVIENDA Y ENTORNO</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select id="cbSeleccionarEstadistico1">
                                                                            <option value="">SELECCIONE UNA OPCION</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                      
                                                                        <button id="btnVerExcelEstadistico">Ver excel</button>    
                                                                        <button id="btnVerReporteEstadistico">Ver gr&aacute;fico</button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        Fecha inicio: <input id="tbFechaIncioEstadistico"></input>
                                                                        Fecha fin: <input id="tbFechaFinEstadistico"></input>
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <button id="btnVerReporteTendencia">Tendencia</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                </div>
                                <div id="contenidoReporteEtapa" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Reporte de familias en riesgo</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <fieldset class="ui-widget-content ui-corner-all" style="height:150px ;width:400px;"><legend class="ui-state-default">Filtrar por:</legend>
                                                    <ol id="selectableRiesgo">
                                                        <li class="ui-state-default">DISA/DIRESA</li>
                                                        <li class="ui-state-default">REGION</li>
                                                        <li class="ui-state-default">PROVINCIA</li>
                                                        <li class="ui-state-default">DISTRITO</li>
                                                        <li class="ui-state-default">COMUNIDAD</li>
                                                        <li class="ui-state-default">SECTOR</li><br/>
                                                        <li class="ui-state-default">RED</li>
                                                        <li class="ui-state-default">MICRORED</li>
                                                        <li class="ui-state-default">NUCLEO</li>
                                                        <li class="ui-state-default">ESTABLECIMIENTO</li>
                                                    </ol>
                                                </fieldset>
                                                <select id="cbAtributoRiesgo" multiple style="display: none">
                                                    <option value="" class="ui-widget-content">Seleccione una opci&oacute;n:</option>
                                                    <option value="DISA/DIRESA">DISA/DIRESA</option>
                                                    <option value="REGION">REGION</option>
                                                    <option value="PROVINCIA">PROVINCIA</option>
                                                    <option value="DISTRITO">DISTRITO</option>
                                                    <option value="COMUNIDAD">COMUNIDAD</option>
                                                    <option value="SECTOR">SECTOR</option>
                                                    <option value="RED">RED</option>
                                                    <option value="MICRORED">MICRORED</option>
                                                    <option value="NUCLEO">NUCLEO</option>
                                                    <option value="ESTABLECIMIENTO">ESTABLECIMIENTO</option>
                                                </select>
                                            </td>
                                            <td>
                                                <fieldset class="ui-widget-content ui-corner-all" style="height:150px ;width:400px;"><legend class="ui-state-default">Seleccione:</legend>
                                                    <table>
                                                        <tr>
                                                            <td id="tdOpcionR1"></td>
                                                            <td>
                                                                <select id="cbOpcionR1"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="tdOpcionR2"></td>
                                                            <td>
                                                                <select id="cbOpcionR2"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="tdOpcionR3"></td>
                                                            <td>
                                                                <select id="cbOpcionR3"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="tdOpcionR4"></td>
                                                            <td>
                                                                <select id="cbOpcionR4"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="tdOpcionR5"></td>
                                                            <td>
                                                                <select id="cbOpcionR5"></select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td id="tdSeleccionarR"></td>
                                                            <td>
                                                                <select id="cbSeleccionarR">
                                                                    <option value=""></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </fieldset>
                                            </td>   
                                        </tr>
                                    </table>
                                    
                                    <table>
                                        <tr>
                                            <td>
                                                <table class="ui-widget ui-widget-content" align="center" nobr="true">
                                                        <thead>
                                                            <tr class="ui-widget-header" align="center">
                                                                <td></td>
                                                                <td>Riesgo: </td>
                                                                <td> </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr align="center">
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <select id="cbAtributoEtapa1">
                                                                        <option value="">SELECCIONE UNA OPCION</option>
                                                                        <option value="ALTO RIESGO">ALTO RIESGO</option>
                                                                        <option value="MEDIANO RIESGO">MEDIANO RIESGO</option>
                                                                        <option value="BAJO RIESGO">BAJO RIESGO</option>
                                                                    </select>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Seg&uacute;n etapas de vida</td>
                                                                <!-- <td><button id="btnVerReporteEtapa">Ver reporte PDF</button></td> -->
                                                                <td><button id="btnVerReporteEtapaExcel">Ver reporte Excel</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Seg&uacute;n datos sociecon&oacute;micos</td>
                                                                <!-- <td><button id="btnVerReporteSocioeconomico">Ver reporte PDF</button></td> -->
                                                                <td><button id="btnVerReporteSocioeconomicoExcel">Ver reporte Excel</button></td>
                                                            </tr>
                                                        </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoReporteSocioeconomico" class="contenidoborde" align="center">
                                    
                                </div>
                                <div id="contenidoReportePaifam" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center"><h1 style="color: #0074C7; font-weight: bolder;">Reporte PAIFAM</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <table id="listaFamiliaPaifam"></table>
                                                            <div id="pagerFamiliaPaifam"></div>
                                                        </td>
                                                        <td valign="top"><button id="btnVerReportePaifam">Ver reporte</button></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoReporteProgramacion" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center"><h1 style="color: #0074C7; font-weight: bolder;">Reporte programaci&oacute;n</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <table id="listaFamiliaProgramacion"></table>
                                                        </td>
                                                        <td valign="top"><button id="btnVerReporteProgramacion">Ver reporte</button></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoReporteVisita" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center"><h1 style="color: #0074C7; font-weight: bolder;">Reporte visitas domiciliarias</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><table id="listaFamiliaVisita"></table></td>
                                                        <td valign="top"><button id="btnVerReporteVisita">Ver reporte</button></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoConsultaHistorico" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Consulta datos hist&oacute;ricos</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Filtrar por fechas - Inicio: <input id="tbFechaInicioHistorico" placeholder="Ejemplo: 01/01/2017"></input> Fin: <input id="tbFechaFinHistorico"  placeholder="Ejemplo: 01/01/2017"></input><button id="btnBuscarHistorico">Buscar</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table id="listaHistorico"></table>
                                                            <div id="pagerHistorico"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" align="center">
                                                            <button id="btnDatosFamiliaH">Ver datos de la familia</button>
                                                            <button id="btnVerMiembrosH">Ver miembros de la familia</button>
                                                            <button id="btnVerSocioeconomicosH">Ver datos sociecon&oacute;micos</button>
                                                            <button id="btnVerEntornoH">Ver entornos de la familia</button>
                                                            <button id="btnVerVisitaH">Ver visitas domiciliarias</button>
                                                            <button id="btnVerRiesgoH">Ver riesgos por etapa de vida</button>
                                                            <button id="btnEliminarHistorial">Eliminar historial</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoReporteFichaIndividual" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Reportes ficha individual</h1></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="ui-widget ui-widget-content" align="center">
                                                    <thead>
                                                        <tr class="ui-widget-header" align="center">
                                                            <td width="400">Tipo de reporte</td>
                                                            <td>Fecha inicio: </td>
                                                            <td>Fecha fin: </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr align="center">
                                                            <td>Reporte administraci&oacute;n de micronutrientes del ni&ntilde;o</td>
                                                            <td>
                                                                <input id="tbFechaInicioReporte"></input>
                                                            </td>
                                                            <td>
                                                                <input id="tbFechaFinReporte"></input>
                                                            </td>
                                                            <td><button id="btnReporteMicronutienteNino">Ver reporte</button></td>
                                                        </tr>
                                                        <tr>
                                                            
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCopiaBase" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td>
                                                <table width="481">
                                                    <tr>
                                                        <td align="center"><h1 style="color: #0074C7; font-weight: bolder;">Copia de base de datos para importar o exportar a otro establecimiento de salud</h1></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                              <div align="center"><img src="../imagenes/iconos/backup.png" width="135"></img>
                                                              </div>
                                                              <p align="center" style="font-weight: bold; font-size: 18px; color: #900;"><span class="g"><strong>Importante</strong></span></p>
                                                              <p align="justify">Este medio de exportaci&oacute;n e importaci&oacute;n de base de datos, ser&aacute; utilizado &uacute;nicamente para el acopio de base de datos:</p>
                                                              <p align="justify">1. Si deseamos <strong>exportar</strong> nuestra base de datos y llevarlo hacia otro establecimiento de salud.</p>
                                                              <p align="justify">2. Si deseamos <strong>importar o acopiar</strong> una base de datos que proviene de otro establecimiento de salud.</p>
                                                              <p align="justify"><strong>Pulse el botón &quot;Importar&quot; o &quot;Exportar&quot; según sea el caso.</strong></p>
                                                              <p align="center" style="font-weight: bold; font-size: 18px; color: #900;">&nbsp;</p>
                                                          </div>
                                                            <div align="center">
                                                              <table style="color: #0074C7; font-weight: bolder;" align="center">
                                                                <tr>
                                                                  <td>
                                                                    <table align="center">
                                                                      <tr>
                                                                        <td width="250">Exportar datos de establecimiento para acopiar</td>
                                                                        <td>
                                                                          <button type="button" id="btnHacerBackup">Exportar</button><br></br>
                                                                        </td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td width="250">Importar/Acopiar base de datos</td>
                                                                        <td>
                                                                          <form id="formArchivos" name="formArchivos" method="post">
                                                                            <input type="hidden" id="idarchivo"/>
                                                                            <input type="hidden" id="operUnidadCatastral" value="add"/>
                                                                            <button type="button" id="btnImportarBackup">Importar</button>
                                                                          </form>

                                                                        </td>
                                                                      </tr>
                                                                    </table>
                                                                  </td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>  
                                </div>
                                <div id="contenidoRestaurarBase" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td>
                                                <table width="571" height="443">
                                                    <tr>
                                                        <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Restaurar base de datos solo del establecimiento</h1></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="399" valign="top">
                                                          <div>
                                                            <p align="center" style="font-weight: bold; font-size: 18px; color: #900;"><span class="g"><strong><img src="../imagenes/iconos/backup.png" width="135" /></strong></span></p>
                                                            <p align="center" style="font-weight: bold; font-size: 18px; color: #900;"><span class="g"><strong>Importante</strong></span></p>
                                                            <p align="justify"><strong>Si usted pulsa este boton eliminar&aacute; todos los datos que se han acopiado en su base de datos principal. La base de datos volver&aacute; a su estado anterior al acopio, eliminando toda informaci&oacute;n que no pertenezca a la BD original.</strong></p><br></br>
                                                            <p align="justify"><strong>Pulse el bot&oacute;n: Eliminar BD acopiadas</strong></p>
                                                          </div>
                                                        </td>
                                                        <td width="160">
                                                            <button id="btnRestaurarBD">Restaurar base de datos</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoCopiaBaseGeneral" class="contenidoborde" align="center">
                                    <table>
                                        <tr>
                                            <td>
                                                <table width="571" height="443">
                                                    <tr>
                                                        <td align="center" colspan="2"><h1 style="color: #0074C7; font-weight: bolder;">Copia de base de datos  para respaldo</h1></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="399" valign="top">
                                                          <div>
                                                            <p align="center" style="font-weight: bold; font-size: 18px; color: #900;"><span class="g"><strong><img src="../imagenes/iconos/backup.png" width="135"/></strong></span></p>
                                                            <p align="center" style="font-weight: bold; font-size: 18px; color: #900;"><span class="g"><strong>Importante</strong></span></p>
                                                            <p align="justify"><strong>Se utilizará este medio de exportación, si deseamos generar una copia de respaldo de nuestros datos. </strong></p>
                                                            <p align="justify"><strong>Esta copia de base de datos no deberá ser llevada a otro establecimiento, pues contiene datos propios de nuestro establecimmiento de salud en caso de dañarse o formatearse nuestro computador.</strong> </p>
                                                            <p align="justify">Pulse el botón:<strong> &quot;Generar backup de respaldo&quot;</strong></p>
                                                          </div>
                                                        </td>
                                                        <td width="160">
                                                            <button id="btnBackupGeneral">Generar backup de respaldo</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="contenidoAcercade" class="contenidoborde" align="center">
                                  <p><img src="/sisfac/imagenes/candado.jpg" width="66" height="50" /><span style="font-size: 18px; color: #C60">Sistema de Salud Familiar Comunitaria - SISFAC</span></p>
                                  <p><span style="font-weight: bold; font-size: 18px; color: #900;">Version 5.1</span></p>
                                    <img src="/sisfac/imagenes/MINSA22.png"/>
									<br><span style="font-weight: bold; font-size: 16px; color: #970;">  CERTIFICADO DE REGISTRO DE SOFTWARE EN INDECOPI N°00385-2016 </span></br>
                                    <br/><br/><br/>
                                    <img src="/sisfac/imagenes/licencia.jpg" />
                                    <br />Este obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">licencia de Creative Commons Reconocimiento-NoComercial-CompartirIgual 4.0 Internacional</a></span></br>

                                    <!--p style="font-weight: bold; font-size: 18px; color: #900;">&nbsp;</p>
                                        <blockquote>
                                        <blockquote>
                                            <blockquote>
                                            <blockquote>
                                                <table width="459" border="0">
                                                <tr>
                                                    <td width="393" align="center"><div align="justify"><span style="font-style: italic; text-align: justify;">El sistema ha sido desarrollado por Soluciones Prácticas en el marco del <strong><em>Proyecto  &ldquo;</em>Implementación de una experiencia  piloto en Churcampa en materia de Salud Integral e Incluyente&rdquo;. </strong></span></div></td>
                                                </tr>
                                                </table>
                                                <p style="font-style: italic; text-align: justify;">&nbsp;</p>
                                            </blockquote>
                                            </blockquote>
                                        </blockquote>
                                        </blockquote>
                                        <hr />
                                        <p style="font-weight: bold">Para mayor información:</p>
                                        <p style="font-weight: bold">&nbsp;</p>
                                        <p><img src="/sisfac/imagenes/logo soluciones practicas.png" width="253" height="81" /></p>
                                        <p style="font-weight: bold">&nbsp;</p>
                                        <p style="font-weight: bold">Página web:</p>
                                        <p style="font-weight: bold">&nbsp;</p>
                                        <p style="color: #00C"><a href="http://www.solucionespracticas.org.pe" target="_blank">http://www.solucionespracticas.org.pe</a></p>
                                        <p style="color: #00C">&nbsp;</p>
                                        <p style="color: #00C">&nbsp;</p>
                                        <p style="font-weight: bold">Contactos:</p>
                                        <p style="color: #00C">rpacheco@solucionespracticas.org.pe</p>
                                        <p style="color: #00C">omunoz@solucionespracticas.org.pe</p>
                                        <p>&nbsp;</p-->
                              </div>
                                <div id="dialogGrafico">
                                    
                                </div>
                                <div title="Datos para el reporte" id="dialogReporte">
                                    <table>
                                        <tr>
                                            <td><div id="divReporteDiresa"></div></td>
                                            <td><div id="divReporteRed"></div></td>
                                            <td><div id="divReporteMicrored"></div></td>
                                            <td><div id="divReporteNucleo"></div></td>
                                            <td><div id="divReporteEstablecimiento"></div></td>
                                            <td><div id="divReporteComunidad"></div></td>
                                            <td><div id="divReporteSector"></div></td>
                                        </tr>
                                    </table>
                                </div>
                                <div title="Datos generales" id="dialogDatoGeneral">
                                    <table>
                                        <tr>
                                            <td><div id="divBusquedaDiresa"></div></td>
                                            <td><div id="divBusquedaRed"></div></td>
                                            <td><div id="divBusquedaMicrored"></div></td>
                                            <td><div id="divBusquedaNucleo"></div></td>
                                            <td><div id="divBusquedaEstablecimiento"></div></td>
                                        </tr>
                                    </table>
                                    <!--table>
                                        <tr>
                                            <td>C&oacute;digo RENAES</td>
                                            <td><input id="tbNombreEstablecimiento"></input></td>
                                        </tr>
                                        <tr>
                                            <td>Establecimiento central</td>
                                            <td><select id="cbEstablecimientoCentral">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select></td>
                                        </tr>
                                    </table-->
                                </div>
                          </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
        <div id="altauto"></div>
        <div id="pie" align="center">
            <?PHP echo $_SESSION['piePagina'];?>
        </div>
    </body>
</html>
<?php
/*
    echo "<ul>";
    if(strripos($_SESSION['privilegios'],"index.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="index.php">Inicio</a></li>';
    if(strripos($_SESSION['privilegios'],"mantenimiento.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="javascript:void(0)">Mantenimiento</a>
        <ul>
            <li style="text-align: left"><a href="mantenimiento.php?q=1">Programas</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=2">Instituciones</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=3">Beneficiarios</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=4">Modulos</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=5">Asistencia por Modulo</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=6">Notas por Modulo</a></li>
            <li style="text-align: left"><a href="mantenimiento.php?q=7">Provincias y distritos</a></li>
        </ul>
    </li>';
if(strripos($_SESSION['privilegios'],"reporte.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="javascript:void(0)">Reportes</a>
        <ul>
            <li style="text-align: left"><a href="reporte.php?q=1">Beneficiarios</a>
                <ul>
                    <li style="text-align: left"><a href="reporte.php?q=1">Por m&oacute;dulo y sexo</a></li>
                    <li style="text-align: left"><a href="reporte.php?q=2">Por distrito e instituci&oacute;n</a></li>
                    </ul>
            </li>
            <li style="text-align: left"><a href="reporte.php?q=3">Aprendizaje</a></li>
            <li style="text-align: left"><a href="reporte.php?q=4">Asistencia</a></li>
        </ul>
    </li>';
//if(strripos($_SESSION['privilegios'],"reportes.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="reportes.php">Reportes</a></li>';
if(strripos($_SESSION['privilegios'],"backup.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="backup.php">Backup</a></li>';
if(strripos($_SESSION['privilegios'],"acercade.php") !== false) echo '<li style="margin:0px 5px 0px 10px;"><a href="acercade.php">Acerda de</a></li>';
echo "</ul>";*/
?>
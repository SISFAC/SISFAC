<?PHP
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

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
        <title>ADMINISTRACI&Oacute;N DE USUARIOS</title>
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
        <script type="text/javascript"><?php echo "const CLAV ='" . $_SESSION['claveGeneral']."'";?></script>
        <script type="text/javascript"><?php echo "const CLAVES ='" . $_SESSION['claves']."'";?></script>
        <script type="text/javascript" src="/sisfac/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery.ui.datepicker-es.js"></script>
        <script type="text/javascript" src="/sisfac/js/grid.locale-es.js" ></script>
        <script type="text/javascript" src="/sisfac/js/jquery.jqGrid.min.js" ></script>
        <script type="text/javascript" src="/sisfac/js/jquery.maskedinput-1.3.js" ></script>
        <script type="text/javascript" src="/sisfac/js/util.js"></script>
        <script type="text/javascript" src="/sisfac/js/listas.js"></script>
        <script type="text/javascript" src="/sisfac/adm/js/index.js"></script>
        <style type="text/css">
            #dialogUsuario td{
                padding: 5px;
            }
            
            #dialogPrivilegios #tablaModulos label{
                cursor: pointer;
            }
            #dialogPersona {font-size: 85%}
	</style>
    </head>

    <body>
        <div id="cabecera">
            <div id="cabecera"><?php echo $_SESSION['cabecera'];?></div>
        </div>
        <div id="cuerpo">
            <div id="contenido">
                <div class="capaborde" align="center">
                    <img src="../imagenes/admin_usuarios.jpg" alt="Usuarios"/>
                    <br/>
                    <table id="listaUsuarios"></table>
                    <div id="pagerUsuarios"></div>
                    <br/>
                    <!--table id="listaPrivilegios"></table>
                    <div id="pagerPrivilegios"></div-->
                    <div id="dialogPersona" title="Personas"></div>
                    <div id="dialogUsuario" title="Registro de usuarios">
                        <table border="0" width="100%">
                            <tr>
                                <td>Tipo</td>
                                <td><select id="cbTipoUsuario">
                                        <option value="ADM">ADMINISTRADOR</option>
                                        <option value="NOR">NORMAL</option>
                                        <option value="VIS">VISITANTE</option>
                                    </select></td>
                                <!--td>Activo</td>
                                <td><input type="checkbox" id="chbEstado" checked="checked"/></td-->
                            </tr>
                            <tr>
                                <td>Trabajador</td>
                                <td colspan="3">
                                    <input type="text" id="tbTrabajador" size="70" disabled="disabled" />
                                    <input type="hidden" id="hTrabajador"/>
                                    <span id="btnBuscarPersona" class="iconoBuscar"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Usuario</td>
                                <td><input type="text" id="tbUsuario" size="25"/></td>
                            </tr>
                            <tr>
                                <td>Clave</td>
                                <td><input type="password" id="tbClave" size="25"/></td>
                                <td>Repetir clave</td>
                                <td><input type="password" id="tbRepetirClave" size="25"/></td>
                            </tr>
                        </table>
                    </div>
                    <div id="dialogPrivilegios" title="Privilegios del usuario">
                        <table cellspacing="3" cellpadding="3">
                            <tr>
                                <td align="left">M&oacute;dulos</td>
                                <td>
                                    <select id="cbModulo">
                                        <option value="">Seleccione un m&oacute;dulo</option>
                                        <?PHP
                                        include '../conexion/Conexion.php';
                                        $cnn = new Conexion();
                                        $cnn->abrirConexion();
                                        $result = mysql_query("SELECT idvista,vista,descripcion FROM vista");
                                        while ($row = mysql_fetch_row($result)){
                                            echo "<option value='$row[0]' vista='$row[1]' tabla='tabla".strtoupper($row[1])."'>$row[2]</option>";
                                        }
                                        $cnn->cerrarConexion();
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table width="100%" id="tablaPrivilegios">
                                        <tr>
                                            <td>
                                                <!--fieldset class="ui-widget-content ui-corner-all" style="padding: 10px;">
                                                    <legend>Privilegios</legend>
                                                    <table id="tablaADM" modulo="adm"></table>
                                                    <table id="tablaAPP" modulo="app"-->
                                                        <!--tr>
                                                            <td><input type="checkbox" id="" value="index.php"/> Inicio </td>
                                                            <td><input type="checkbox" id="" value="mantenimiento.php"/> Mantenimiento </td>
                                                            <td><input type="checkbox" id="" value="reporte.php"/> Reportes </td>
                                                            <td><input type="checkbox" id="" value="backup.php"/> Backup </td>
                                                            <td><input type="checkbox" id="" value="acercade.php"/> Acerca de </td>
                                                        </tr-->
                                                    <!--/table>
                                                </fieldset-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
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
                </div>
            </div>
        </div>
        <div id="altauto"></div>
        <div id="pie">
            <?PHP echo $_SESSION['pie'];?>
        </div>
    </body>
</html>
<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
    include 'conexion/Conexion.php';
    include 'upgrade.php';
    if(needToUpgrade()){

        header('Location: bd_upgrade.php');
        exit();
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--DOCTYPE html-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>sisfac</title>
        <link rel="shortcut icon" href="/sisfac/images/favicon.ico" type="image/x-icon" />
        <link href="/sisfac/css/sigurmun.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/sisfac/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="/sisfac/js/ajaxupload.js"></script>
        <script type="text/javascript" src="/sisfac/js/util.js"></script>
        <script type="text/javascript" src="/sisfac/js/log.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <style>
            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                    background: url(imagenes/Preloader_2.gif) center no-repeat #fff;
            }
            
        </style>
    </head>
    
    <body>
        <div class="se-pre-con"></div>
        <div id="cabecera"><img src="imagenes/MINSA.png" height="40"/></div>
        <div id="cuerpo">
            <div id="contenido">
                <div class="capaborde">
                    <br/>
                    <center>
                        <p>&nbsp;</p>
                        <p><img src="imagenes/login.jpg" width="410" height="130" /></p>
                        
                      <table width="388" height="342" cellpadding="5" cellspacing="5" background="imagenes/fondito2.jpg" class="login" style="font-size: 14px; color: #000; border-bottom-color: #096;">
                       <hr color="#999999">
                            <tr>
                                <td align="center" colspan="2">
                                    <img src="imagenes/indicator.gif" id="imgIndicador" width="20" style="display: none;"/>
                                </td>
                        </tr>
                            <tr>
                                <td width="71" height="23" align="right" valign="middle"><strong>M&oacute;dulo</strong></td>
                                <td width="350">
                                    <select id="cbVista" style="height: 30px; width: 270px;">
                                        <option value="">Seleccione un m&oacute;dulo</option>
                                        <?php
                                            
                                            include 'app/actualizacion.php';
                                            
                                            //IMPORTAMOS CSV

                                            include 'app/catalogos/catalogosTablaMaestras.php';

                                            
                                            //include 'app/catalogos/catalogos.php';
                                            
                                            $query = "SELECT idmodulo,modulo FROM usuario us INNER JOIN usuariomodulo um ON us.idusuario=um.idusuariomodulo
                                                INNER JOIN modulo mo ON um.idmodulo=mo.idmodulo ";
                                            
                                            $rowModulo = mysql_fetch_array(mysql_query($query));
                                            
                                            $result = mysql_query("SELECT idvista,vista,descripcion FROM vista");
                                            while ($row = mysql_fetch_row($result)){
                                                if($rowModulo['idvista']==$row[0]) $selected="selected=\"selected\"";
                                                else $selected = "";
                                                echo "<option value='$row[0]' $selected>$row[2]</option>";
                                            }
                                            
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td height="23" align="right" valign="middle"><strong>Usuario</strong></td>
                                <td>
                                    <input type="text" name="usuario" id="usu" size="25"  class="cajastextologin" autofocus="true"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" align="right" valign="middle"><strong>Contrase&ntilde;a</strong></td>
                                <td>
                                    <input type="password" name="clave" id="pass" size="25" class="cajastextologin" />
                                </td>
                            </tr>
                            <tr>
                                <td height="18" colspan="2">
                                    <span id="alerta" style="display: none;">
                                        <br/>
                                        <p class='textorojo'>
                                          <strong> No ha podido iniciar sesi&oacute;n debido a alguna de las siguientes razones:</strong>
                                    <ul>
                                                <li>El usuario y/o clave es(son) incorrecto(s)</li>
                                                <li>No tiene los permisos necesarios para ingresar al m&oacute;dulo seleccionado</li>
                                                <li>El usuario esta inhabilitado</li>
                                                <li>Esta m&aacute;quina no ha sido registrada para el usuario que intenta acceder</li>
                                    </ul>
                                        </p>
                                        <br/>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                              <td  colspan="2" height="10" valign="middle" align="center">
                                    <p>
                                      <input type="button" id="aceptar" value="Ingresar" name="enviar" class="botones"/>
                                    <input type="button" id="cancelar" value="Cancelar" name="cancelar"  class="botones" /> 
                                         <p>&nbsp;</p>                             
                                    <hr color="#333333">             
                              </td>
                        </tr>
                         
                          <tr>
                          
                              <td colspan="2" style="padding: 0px 5px 0px 5px; text-align: right;" align="justify"><p style="font-size: 10px; text-align: justify;">Usar la opción <strong>&quot;Importar BD de respaldo&quot;</strong> cuando 
                            se necesite importar un backup de respaldo del SISFAC. TENGA EN CUENTA QUE SI HAY ALGUN TIPO DE INFORMACION EN LA BASE DE DATOS, AL USAR ESTE BOTON EL SISTEMA BORRARA DICHA INFORMACION Y LA REEMPLAZARA POR LOS DATOS DEL BACKUP QUE USTED IMPORTARA. Solicite apoyo técnico o consulte su guía de generación de backups dentro de su grupo de manuales para evitar errores</p>
                                <p style="font-size: 10px;">
  <input type="hidden" id="idarchivo"/>
                                  <input type="hidden" id="operUnidadCatastral" value="add"/>
                                </p>
                                  <p id="divFoto" align="center"> </p>
                                <form  id="formArchivos" name="formArchivos" method="post">
                                <button  style="font-size: 11px; color: #009; background-image: url(imagenes/fondoBotonImportar.jpg); border-color: #009; text-align: center;"  type="button" id="btnImportarBackupCompleta"><strong>Importar BD de respaldo</strong></button>
                                    <p>&nbsp;</p>
                            </form>
                              </td>
                              
                          
                            
                          </tr>
                      </table>
                    </center>
                    <br/><br/>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
        <div id="altauto"></div>
        <div id="pie" align="center">
            <?PHP echo $_SESSION['pie'];?>
        </div>
    </body>
</html>
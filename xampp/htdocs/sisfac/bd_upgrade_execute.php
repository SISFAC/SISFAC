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
upgrade();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--DOCTYPE html-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>sisfac</title>
        <link rel="shortcut icon" href="/sisfac/images/favicon.ico" type="image/x-icon" />
        <link href="/sisfac/css/sigurmun.css" rel="stylesheet" type="text/css" />
        
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
                        
                        <tr>
                            <td  colspan="2" height="10" valign="middle" align="center">
                                <p>Actualización exitosa.</p>
                                <p>&nbsp;</p>
                                <hr color="#333333">
                            </td>
                        </tr>
                        
                        <tr>
                            <td  colspan="2" height="10" valign="middle" align="center">
                                <p>
                                    <a href="/sisfac/" />REGRESAR</a></p>
                                    <p>&nbsp;</p>
                                    <hr color="#333333">
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
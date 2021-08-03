<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
session_start();
include '../conexion/Conexion.php';
$cnn = new Conexion();
$cnn->abrirConexion();
$sql = "SELECT u.idusuario,u.usuario,v.vista,vu.privilegios,tr.idtrabajador,tr.nombreCompleto,u.tipo,dge.claveGeneral,lugarCentral,dge.claves
        FROM usuario u INNER JOIN vistausuario vu ON u.idusuario=vu.idusuario INNER JOIN vista v ON vu.idvista=v.idvista
        LEFT JOIN datoGeneral dge ON u.claveGeneral=dge.claveGeneral LEFT JOIN trabajador tr ON tr.idtrabajador=u.idtrabajador 
        WHERE usuario='" . $_REQUEST['usu'] . "' AND clave='" . md5($_REQUEST['pass']) ."' AND u.estado=1 AND v.idvista=". $_REQUEST['idvista'] ;
$rs=mysql_query($sql);
//echo $sql;
if(mysql_num_rows($rs) > 0){
    $fila=mysql_fetch_array($rs);
    
    //Crear variables de sesion
    $_SESSION['idusu'] = $fila['idusuario'];
    $_SESSION['idempleado'] = $fila['idpersona'];
    $_SESSION['nombreempleado'] = $fila['nombreCompleto'];
    $_SESSION['nomusu'] = $fila['usuario'];
    $_SESSION['modulo'] = $fila['vista'];
    $_SESSION['privilegios'] = $fila['privilegios'];
    $_SESSION['tipo'] = $fila['tipo'];
    $_SESSION['claveGeneral'] = $fila['claveGeneral'];
    $_SESSION['claves'] = $fila['claves'];
    $_SESSION['lugarCentral'] = $fila['lugarCentral'];
    
    $_SESSION['script_permisos'] = "<script type=\"text/javascript\">
            q = document.location.toString();
            if(q.indexOf('/".$_SESSION['modulo']."/')==-1){
                alert('Usted no deber\\xeda estar aqu\\xed pues no tiene los permisos necesarios para ingresar a este m\\xf3dulo');
                document.location='/sisfac/';
            }
        </script>";
    
    $_SESSION['script_navegador'] = "<script type=\"text/javascript\">
            if(navigator.userAgent.toLowerCase().indexOf('chrome') == -1){
                alert('El navegador que est\xe1 usando no es compatible con sisfac. Por favor utilice Google Chrome');
                document.location='/sisfac/';
                //window.stop();
            }
        </script>";
    
    $_SESSION['script_cerrar_sesion'] = "<script type=\"text/javascript\">
            window.onload = function(){
                document.getElementById('lCerrarSesion').onclick = function(){
                    if( confirm('Esta a punto de salir del sistema. \\xbf Esta seguro que desea continuar?') ){
                        document.location = '/sisfac/cerrarSesion.php';
                    }
                }
            }
        </script>";
    
    /*$_SESSION['script_chat'] = "
        <!--Chat inicio-->
        <script type=\"text/javascript\" src=\"/sigurmun/chat/js/chat.js\"></script>
        <link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"/sigurmun/chat/css/chat.css\" />
        <!--link type=\"text/css\" rel=\"stylesheet\" media=\"all\" href=\"/sigurmun/chat/css/screen.css\" /-->
        <!--Chat fin-->
        ";*/
    $_SESSION['tema'] = "custom-theme/jquery-ui-1.8.14.custom.css";
    
    $_SESSION['cabecera'] = "
        <table cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">
            <tr>
                <td width='500' valign='top'><img src=\"/sisfac/imagenes/MINSA.png\" height=\"40\" /></td>
                <!--td><img src=\"/sisfac/imagenes/logo.jpg\" alt=\"\"/></td-->
                <!--td><img src=\"/sisfac/imagenes/sisfac.jpg\" width=\"200\" height=\"40\" alt=\"\" /></td-->
                <td valign='top' style=\"text-align:right\" ><label style=\"color: #FDDC6B; float: right; font-weight: bolder; margin-top: 25px;\">Bienvenido: <b>$_SESSION[nomusu] - $_SESSION[claveGeneral] </b></label></td>
                <td valign='top'><label id=\"lCerrarSesion\">Cerrar sesi&oacute;n</label></td>
            </tr>
        </table>
        <script type='text/javascript'>
            jQuery(document).ready(function(){
                jQuery('#cbSucursalGeneral').load('/sisfac/funcionesphp/adminSucursal.php',{f:3},function(data){
                    //jQuery('#cbSucursalGeneral').prepend(\"<option value=''>TODOS</option>\")
                }).change(function(){
                    if('$_SESSION[tipo]'=='ADM') {
                        jQuery.post('/sisfac/funcionesphp/adminSucursal.php',{f:4,idsucursal:jQuery('#cbSucursalGeneral').val()},function(data){
                            window.location.reload()
                        })
                    }
                })
                if('$_SESSION[tipo]'=='NOR') jQuery('#cbSucursalGeneral').attr('disabled','disabled')
    
                jQuery('#btnGuardarDatosGenerales').button().click(function(){
                    jQuery.post('/sisfac/funcionesphp/adminTablaGeneral.php',{f:1,igv:jQuery('#tbIGVGeneral').val(),tipocambio:jQuery('#tbTipoCambioGeneral').val(),duracionreserva:jQuery('#tbTiempoReservaGeneral').val()},function(data){
                        alert('Se guardaron los datos')
                    })
                })
            })
        </script>
        ";
    $_SESSION['pie'] = "
                        <p align=\"center\" style=\"margin-top:5px;\">
                            <table width=\"100%\">
                                <tr>
                                    <td align=\"left\" valign=\"top\"  width=\"50%\">
                                        <img src=\"/sisfac/imagenes/pieizquierdop.png\" height=\"130\" />
                                    </td>
                                    <td align=\"center\"  valign=\"top\">Medicus Mundi Navarra Aragón-Madrid</td>
                                    <!--td align=\"right\"  valign=\"top\">
                                        <img src=\"/sisfac/imagenes/piederecho.png\" height=\"120\" />
                                    </td-->
                                </tr>
                            </table>
                        
                        </p> 
        ";
    $_SESSION['piePagina'] = "
                        <p align=\"center\" style=\"margin-top:5px;\">
                            <table width=\"100%\">
                                <tr>
                                    <td align=\"left\" valign=\"top\"  width=\"50%\">
                                        <img src=\"/sisfac/imagenes/pieizquierdop.png\" height=\"130px\" />
                                    </td>
                                    <td align=\"center\"  valign=\"top\">Medicus Mundi Navarra Aragón-Madrid</td>
                                    <td align=\"right\"  valign=\"top\">
                                        <img src=\"/sisfac/imagenes/piederecho.png\" height=\"120px\" />
                                    </td>
                                </tr>
                            </table>
                        
                        </p> 
        ";
    /*
    $sqlcuentabita="select max(idbita) from municipal.bitacorasistema";
	$rscuentabita=mysql_query($sqlcuentabita);
	$fcuentabita=mysql_fetch_array($rscuentabita);
	$nuevocod=$fcuentabita[0]+1;
	$ip=$_SERVER['REMOTE_ADDR'];
	$pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$sqlbitacora="INSERT INTO municipal.bitacorasistema(idbita, idusu, ipusu, fechaingreso, horaingreso, modulo, nompc) 
        VALUES('$nuevocod', '".$_SESSION['idusu']."', '$ip', '".date("Y-m-d")."', '".date("h:i:s")."', '".$_SESSION['modulo']."', '$pc')";
	$rsbitacora=mysql_query($sqlbitacora);
    */
    echo "/sisfac/".$fila['vista'];
    //echo $fila['sucursal'];
}
else
    echo "Error";
?>

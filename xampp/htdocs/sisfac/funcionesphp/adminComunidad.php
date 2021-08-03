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
if(!isset($_SESSION['idusu'])) header("location:/sisfac/");

require_once '../clases/claseComunidad.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseFamilia.php';
$comunidad = new Comunidad();
$datoGeneral = new DatoGeneral();
$familia = new Familia();

if($_REQUEST['f'] == 1) $comunidad->mostrarComunidadDatagrid($_REQUEST[idestablecimiento]);
elseif($_REQUEST['f'] == 2) $comunidad->mostrarComunidadCombobox ($_REQUEST[idestablecimiento], true, $_REQUEST['claveGeneral']);
elseif($_REQUEST['f'] == 3) $comunidad->mostrarComunidadCombobox ($_REQUEST[idestablecimiento], false, $_REQUEST['claveGeneral']);
elseif($_REQUEST['f'] == 4) echo $comunidad->obtenerDatosPorComunidad($_REQUEST[idcomunidad]);
elseif($_REQUEST['f'] == 5) $comunidad->mostrarComunidadTotalCombobox (false);
elseif($_REQUEST['oper'] == 'add') $comunidad->agregarComunidad ($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idcomunidad', 'comunidad'), $_REQUEST[idestablecimiento], $_REQUEST[nombreComunidad], $_REQUEST[descripcion]);
elseif($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $comunidad->agregarComunidad ($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idcomunidad', 'comunidad'), $_REQUEST[idestablecimiento], $_REQUEST[nombreComunidad], $_REQUEST[descripcion]);
    else $comunidad->actualizarComunidad ($_SESSION[claveGeneral], $_REQUEST[id], $_REQUEST[idestablecimiento], $_REQUEST[nombreComunidad], $_REQUEST[descripcion]);
}
elseif($_REQUEST['oper'] == 'del') {
    if($familia->obtenerCantidadFicha($_REQUEST[id], '', $_SESSION[claveGeneral])==0){
        $comunidad->eliminarComunidad($_REQUEST[id], $_SESSION[claveGeneral]);
        echo 'S';//SE ELIMINO EL REGISTRO
    }else{
        echo 'N';//NO SE ELIMINO
    }
    //
}
elseif($_REQUEST['oper'] == 'migrate') {


}


?>
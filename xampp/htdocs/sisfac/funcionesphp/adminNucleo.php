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

require_once '../clases/claseNucleo.php';
require_once '../clases/claseDatoGeneral.php';
$nucleo = new Nucleo();
$datoGeneral = new DatoGeneral();

if ($_REQUEST['f'] == 1) $nucleo->mostrarNucleoDatagrid($_REQUEST[idmicrored]);
elseif ($_REQUEST['f'] == 2) $nucleo->mostrarNucleoCombobox ($_REQUEST['idmicrored'], true);
elseif ($_REQUEST['f'] == 3) $nucleo->mostrarNucleoCombobox ($_REQUEST['idmicrored'], false);
elseif ($_REQUEST['f'] == 4) $nucleo->mostrarNucleoTotalCombobox (false);
elseif ($_REQUEST['oper'] == 'add') $nucleo->agregarNucleo($datoGeneral->obtenerMaximoID('idnucleo', 'nucleo'), $_REQUEST['idmicrored'], $_REQUEST['nombreNucleo']);
elseif ($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $nucleo->agregarNucleo($datoGeneral->obtenerMaximoID('idnucleo', 'nucleo'), $_REQUEST['idmicrored'], $_REQUEST['nombreNucleo']);
    else $nucleo->actualizarNucleo($_REQUEST['id'], $_REQUEST['nombreNucleo']);
}
elseif ($_REQUEST['oper'] == 'del') $nucleo->eliminarNucleo($_REQUEST['id']);

?>
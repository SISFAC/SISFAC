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

require_once '../clases/claseMicrored.php';
require_once '../clases/claseDatoGeneral.php';
$red = new Microred();
$datoGeneral = new DatoGeneral();

if ($_REQUEST['f'] == 1) $red->mostrarMicroredDatagrid($_REQUEST[idred]);
elseif ($_REQUEST['f'] == 2) $red->mostrarMicroredCombobox ($_REQUEST[idred], true);
elseif ($_REQUEST['f'] == 3) $red->mostrarMicroredCombobox ($_REQUEST[idred], false);
elseif ($_REQUEST['f'] == 4) $red->mostrarMicroredTotalCombobox (false);
elseif ($_REQUEST['oper'] == 'add') $red->agregarMicrored($datoGeneral->obtenerMaximoID('idmicrored', 'microred'), $_REQUEST['idred'], $_REQUEST['nombreMicrored']);
elseif ($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $red->agregarMicrored($datoGeneral->obtenerMaximoID('idmicrored', 'microred'), $_REQUEST['idred'], $_REQUEST['nombreMicrored']);
    else $red->actualizarMicrored($_REQUEST['id'], $_REQUEST['nombreMicrored']);
}
elseif ($_REQUEST['oper'] == 'del') $red->eliminarMicrored($_REQUEST['id']);

?>
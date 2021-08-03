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

require_once '../clases/claseRed.php';
require_once '../clases/claseDatoGeneral.php';
$red = new Red();
$datoGeneral = new DatoGeneral();

if ($_REQUEST['f'] == 1) $red->mostrarRedDatagrid($_REQUEST[iddiresa]);
elseif ($_REQUEST['f'] == 2) $red->mostrarRedCombobox ($_REQUEST['idregion'], $_REQUEST['iddiresa'], true);
elseif ($_REQUEST['f'] == 3) $red->mostrarRedCombobox ($_REQUEST['idregion'], $_REQUEST['iddiresa'], false);
elseif ($_REQUEST['f'] == 4) $red->mostrarRedTotalCombobox (false);
elseif ($_REQUEST['oper'] == 'add') $red->agregarRed($datoGeneral->obtenerMaximoID('idred', 'red'), $_REQUEST['iddiresa'], $_REQUEST['idprovincia'], $_REQUEST['nombreRed']);
elseif ($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $red->agregarRed($datoGeneral->obtenerMaximoID('idred', 'red'), $_REQUEST['iddiresa'], $_REQUEST['idprovincia'], $_REQUEST['nombreRed']);
    else $red->actualizarRed($_REQUEST['id'], $_REQUEST['iddiresa'], $_REQUEST['idprovincia'], $_REQUEST['nombreRed']);
}
elseif ($_REQUEST['oper'] == 'del') $red->eliminarRed($_REQUEST['id']);

?>
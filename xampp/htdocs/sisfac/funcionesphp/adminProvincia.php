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

require_once '../clases/claseProvincia.php';
require_once '../clases/claseDatoGeneral.php';
$provincia = new Provincia();
$datoGeneral = new DatoGeneral();

if($_REQUEST['f'] == 1) $provincia->mostrarProvinciaDatagrid ($_REQUEST[idregion]);
elseif($_REQUEST['f'] == 2) $provincia->mostrarProvinciaCombobox ($_REQUEST['idregion'], true);
elseif($_REQUEST['f'] == 3) $provincia->mostrarProvinciaCombobox ($_REQUEST['idregion'], false);
elseif($_REQUEST['f'] == 4) echo $provincia->obtenerProvinciaNucleo($_REQUEST[idnucleo]);
elseif($_REQUEST['f'] == 5) $provincia->mostrarProvinciaTotalCombobox (false);
elseif ($_REQUEST['oper']=='add') $provincia->agregarProvincia ($datoGeneral->obtenerMaximoID('idprovincia', 'provincia'),$_REQUEST['idregion'], $_REQUEST['nompro']);
elseif ($_REQUEST['oper']=='edit') {
    if($_REQUEST['id'] == 'nuevo') $provincia->agregarProvincia ($datoGeneral->obtenerMaximoID('idprovincia', 'provincia'),$_REQUEST['idregion'], $_REQUEST['nompro']);
    else $provincia->actualizarProvincia ($_REQUEST['id'], $_REQUEST['idregion'], $_REQUEST['nompro']);
}
elseif ($_REQUEST['oper']=='del') $provincia->eliminarProvincia($_REQUEST['id']);

?>
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

require_once '../clases/claseTratamientoPreventivo.php';
require_once '../clases/claseDatoGeneral.php';
$tratamientoPreventivo = new TratamientoPreventivo();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $tratamientoPreventivo->mostrarTratamientoPreventivoDatagrid ($_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') $tratamientoPreventivo->agregarTratamientoPreventivo ($datoGeneral->obtenerMaximoIDHistorial('idtratamientoPreventivo', 'tratamientoPreventivo'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[tratamiento], $_REQUEST[nombre], $_REQUEST[dosis], $_REQUEST[via], $_REQUEST[frecuencia], $_REQUEST[nroDias]);
elseif($_REQUEST['oper'] == 'edit') $tratamientoPreventivo->actualizarTratamientoPreventivo ($_REQUEST[idtratamientoPreventivo], $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[tratamiento], $_REQUEST[nombre], $_REQUEST[dosis], $_REQUEST[via], $_REQUEST[frecuencia], $_REQUEST[nroDias]);
elseif($_REQUEST['oper'] == 'del') $tratamientoPreventivo->eliminarTratamientoPreventivo($_REQUEST[id], $_SESSION[claveGeneral]);


?>
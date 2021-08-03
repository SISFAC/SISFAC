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

require_once '../clases/claseDetallePAIS.php';
require_once '../clases/claseDatoGeneral.php';
$detallePAIS = new DetallePAIS();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $detallePAIS->mostrarDetallePAISDatagrid ();
elseif($_REQUEST[f] == 2) echo $detallePAIS->mostrarDetallePAISVector ($_REQUEST[idpersona], $datoGeneral->obtenerIdEtapaVida($_REQUEST[nombreEtapa]), $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $detallePAIS->mostrarDetallePAISCombobox(true);
elseif($_REQUEST[f] == 4) $detallePAIS->mostrarDetallePAISCombobox(false);
elseif($_REQUEST['oper'] == 'add') $detallePAIS->agregarDetallePAIS($_REQUEST[iddetallePAIS],$_REQUEST[claveGeneral],$_REQUEST[idcatalogoEpisodioPrestacion],$_REQUEST[idPAIS],$_REQUEST[tipoProgramacion],formatoFecha($_REQUEST[fechaPlanificada]),formatoFecha($_REQUEST[fechaEjecucion]),$_REQUEST[estado]);
elseif($_REQUEST['oper'] == 'edit') $detallePAIS->actualizarDetallePAIS($_REQUEST[iddetallePAIS],$_REQUEST[claveGeneral],$_REQUEST[idcatalogoEpisodioPrestacion],$_REQUEST[idPAIS],$_REQUEST[tipoProgramacion],formatoFecha($_REQUEST[fechaPlanificada]),formatoFecha($_REQUEST[fechaEjecucion]),$_REQUEST[estado]);
elseif($_REQUEST['oper'] == 'del') $detallePAIS->eliminarDetallePAIS($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
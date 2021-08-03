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

require_once '../clases/claseHis.php';
require_once '../clases/claseDatoGeneral.php';
$his = new His();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $his->mostrarHisDatagrid ($_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 2) echo $his->mostrarHisVector($_REQUEST[idHIS], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $his->mostrarHisCombobox(true);
elseif($_REQUEST[f] == 4) $his->mostrarHisCombobox(false);
elseif($_REQUEST['oper'] == 'add') $his->agregarHis($_REQUEST[idHIS],$_REQUEST[claveGeneral],$_REQUEST[idepisodio],$_REQUEST[tipoCatalogo],$_REQUEST[idcatalogo],$_REQUEST[nombreCatalogo],$_REQUEST[variableLAB],$_REQUEST[tipoDiagnostico],$_REQUEST[opPacienteEst],$_REQUEST[opPacienteServ]);
elseif($_REQUEST['oper'] == 'edit') $his->actualizarHis($_REQUEST[idHIS],$_REQUEST[claveGeneral],$_REQUEST[idepisodio],$_REQUEST[tipoCatalogo],$_REQUEST[idcatalogo],$_REQUEST[nombreCatalogo],$_REQUEST[variableLAB],$_REQUEST[tipoDiagnostico],$_REQUEST[opPacienteEst],$_REQUEST[opPacienteServ]);
elseif($_REQUEST['oper'] == 'del') $his->eliminarHis($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
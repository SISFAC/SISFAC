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

require_once '../clases/claseDiagnosticoReferencia.php';
require_once '../clases/claseDatoGeneral.php';
$diagnosticoReferencia = new DiagnosticoReferencia();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $diagnosticoReferencia->mostrarDiagnosticoReferenciaDatagrid ($_REQUEST[idreferencia], $_REQUEST[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') $diagnosticoReferencia->agregarDiagnosticoReferencia ($datoGeneral->obtenerMaximoIDHistorial('iddiagnosticoReferencia', 'diagnosticoReferencia'), $_SESSION[claveGeneral], $_REQUEST[idreferencia], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo], $_REQUEST[tipoDiagnostico], $_REQUEST[observacion]);
elseif($_REQUEST['oper'] == 'edit') $diagnosticoReferencia->actualizarDiagnosticoReferencia ($_REQUEST[iddiagnosticoReferencia], $_SESSION[claveGeneral], $_REQUEST[idreferencia], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo], $_REQUEST[tipoDiagnostico], $_REQUEST[observacion]);
elseif($_REQUEST['oper'] == 'del') $diagnosticoReferencia->eliminarDiagnosticoReferencia($_REQUEST[id], $_SESSION[claveGeneral]);


?>
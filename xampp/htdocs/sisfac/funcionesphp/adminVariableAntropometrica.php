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

require_once '../clases/claseVariableAntropometrica.php';
require_once '../clases/claseDatoGeneral.php';
$antecedenteVariableAntropometrica = new VariableAntropometrica();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $antecedenteVariableAntropometrica->mostrarVariablesAntropometricasDatagrid ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') $antecedenteVariableAntropometrica->agregarVariableAntropometrica($datoGeneral->obtenerMaximoIDHistorial('idvariableAntropometrica', 'variableAntropometrica'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[peso], $_REQUEST[talla], $_REQUEST[IMC], $_REQUEST[perimetroCefalico], $_REQUEST[perimetroToracico], $_REQUEST[frecuenciaCardiaca], $_REQUEST[frecuenciaRespiratoria], $_REQUEST[temperatura], $_REQUEST[presionArterialNum], $_REQUEST[presionArterialDenom], $_REQUEST[presionArterialMediaNum], $_REQUEST[presionArterialMediaDenom], $_REQUEST[perimetroAbdominal], $_REQUEST[pesoPregestacional], formatoFecha ($_REQUEST[FUR]), formatoFecha ($_REQUEST[FPP]), $_REQUEST[presionArterialBasalNum], $_REQUEST[presionArterialBasalDenom], $_REQUEST[factorRiesgo]);
elseif($_REQUEST['oper'] == 'edit') $antecedenteVariableAntropometrica->actualizarVariableAntropometrica($_REQUEST[idvariableAntropometrica], $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[peso], $_REQUEST[talla], $_REQUEST[IMC], $_REQUEST[perimetroCefalico], $_REQUEST[perimetroToracico], $_REQUEST[frecuenciaCardiaca], $_REQUEST[frecuenciaRespiratoria], $_REQUEST[temperatura], $_REQUEST[presionArterialNum], $_REQUEST[presionArterialDenom], $_REQUEST[presionArterialMediaNum], $_REQUEST[presionArterialMediaDenom], $_REQUEST[perimetroAbdominal], $_REQUEST[pesoPregestacional], formatoFecha ($_REQUEST[FUR]), formatoFecha ($_REQUEST[FPP]), $_REQUEST[presionArterialBasalNum], $_REQUEST[presionArterialBasalDenom], $_REQUEST[factorRiesgo]);
elseif($_REQUEST['oper'] == 'del') $antecedenteVariableAntropometrica->eliminarVariableAntropometrica($_REQUEST[id], $_SESSION[claveGeneral]);


?>
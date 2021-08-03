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

require_once '../clases/claseAntecedentePatologico.php';
require_once '../clases/claseDatoGeneral.php';

$datoGeneral = new DatoGeneral();
$antecedentePatologico = new AntecedentePatologico();

if($_REQUEST[f] == 1) $antecedentePatologico->mostrarAntecedentePatologicoDatagrid ($_REQUEST[tipo], $_REQUEST[idpersona]);
elseif($_REQUEST[oper] == 'add') $antecedentePatologico->agregarAntecedentePatologico ($datoGeneral->obtenerMaximoIDHistorial('idantecedentePatologico', 'antecedentePatologico'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[tipo], formatoFecha ($_REQUEST[fecha]), $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo], $_REQUEST[fuente], $_REQUEST[observacion]);
elseif($_REQUEST[oper] == 'edit') $antecedentePatologico->actualizarAntecedentePatologico ($_REQUEST[idantecedentePatologico], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[tipo], formatoFecha ($_REQUEST[fecha]), $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo], $_REQUEST[fuente], $_REQUEST[observacion]);
elseif($_REQUEST[oper] == 'del') $antecedentePatologico->eliminarAntecedentePatologico($_REQUEST[id], $_SESSION[claveGeneral]);


?>
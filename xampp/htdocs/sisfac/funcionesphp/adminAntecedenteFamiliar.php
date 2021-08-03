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

require_once '../clases/claseAntecedenteFamiliar.php';
require_once '../clases/claseDatoGeneral.php';
$antecedenteFamiliar = new AntecedenteFamiliar();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $antecedenteFamiliar->mostrarAntecedenteFamiliarDatagrid ($_REQUEST[idpersona], $_SESSION[claveGeneral], $_REQUEST[opc], $_REQUEST);
elseif($_REQUEST['oper'] == 'add') $antecedenteFamiliar->agregarAntecedenteFamiliar($datoGeneral->obtenerMaximoIDHistorial ('idantecedenteFamiliar', 'antecedenteFamiliar'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[tipo], $_REQUEST[parentesco], $_REQUEST[opcionPatologia], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCIE10], $_REQUEST[fuente], $_REQUEST[descripcion], $_REQUEST[observacion]);
elseif($_REQUEST['oper'] == 'edit') $antecedenteFamiliar->actualizarAntecedenteFamiliar ($_REQUEST[idantecedenteFamiliar], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[tipo], $_REQUEST[parentesco], $_REQUEST[opcionPatologia], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCIE10], $_REQUEST[fuente], $_REQUEST[descripcion], $_REQUEST[observacion]);
elseif($_REQUEST['oper'] == 'del') $antecedenteFamiliar->eliminarAntecedenteFamiliar($_REQUEST[id], $_SESSION[claveGeneral]);



?>
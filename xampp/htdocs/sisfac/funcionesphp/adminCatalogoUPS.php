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

require_once '../clases/claseCatalogoUPS.php';
require_once '../clases/claseDatoGeneral.php';
$catalogoUPS = new CatalogoUPS();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $catalogoUPS->mostrarCatalogoUPSDatagrid ();
elseif($_REQUEST[f] == 2) echo $catalogoUPS->mostrarCatalogoUPSVector ($_REQUEST[term], $_REQUEST[limit]);
elseif($_REQUEST['oper'] == 'add') $catalogoUPS->agregarAntecedenteFamiliar($_REQUEST[idcatalogoUPS],$_REQUEST[codigoUPS],$_REQUEST[nombreUPS],$_REQUEST[sexoUPS],$_REQUEST[edadMinima],$_REQUEST[tipoMinimo],$_REQUEST[edadMaxima],$_REQUEST[tipoMaximo],$_REQUEST[clasificacion],$_REQUEST[opcionHospital],$_REQUEST[opcionCentro],$_REQUEST[opcionPuesto],$_REQUEST[descipcion]);
elseif($_REQUEST['oper'] == 'edit') $catalogoUPS->actualizarAntecedenteFamiliar ($_REQUEST[idcatalogoUPS],$_REQUEST[codigoUPS],$_REQUEST[nombreUPS],$_REQUEST[sexoUPS],$_REQUEST[edadMinima],$_REQUEST[tipoMinimo],$_REQUEST[edadMaxima],$_REQUEST[tipoMaximo],$_REQUEST[clasificacion],$_REQUEST[opcionHospital],$_REQUEST[opcionCentro],$_REQUEST[opcionPuesto],$_REQUEST[descipcion]);
elseif($_REQUEST['oper'] == 'del') $catalogoUPS->eliminarAntecedenteFamiliar($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
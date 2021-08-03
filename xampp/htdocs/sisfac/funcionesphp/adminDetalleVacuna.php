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

require_once '../clases/claseDetalleVacuna.php';
require_once '../clases/claseDatoGeneral.php';
$detalleVacuna = new DetalleVacuna();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $detalleVacuna->mostrarDetalleVacunaDatagrid ($_REQUEST[idvacuna], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 2) echo $detalleVacuna->mostrarDetalleVacunaVector($_REQUEST[iddetalleVacuna], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $detalleVacuna->mostrarDetalleVacunaCombobox(true);
elseif($_REQUEST[f] == 4) $detalleVacuna->mostrarDetalleVacunaCombobox(false);
elseif($_REQUEST['oper'] == 'add') $detalleVacuna->agregarDetalleVacuna($_REQUEST[iddetalleVacuna],$_REQUEST[claveGeneral],$_REQUEST[idvacuna],$_REQUEST[nroDosis],$_REQUEST[opProgramacion],$_REQUEST[tipoProgramacion],formatoFecha($_REQUEST[fechaProgramada]),formatoFecha($_REQUEST[fechaAplicacion]),$_REQUEST[estadoDosis],$_REQUEST[lugarAplicacion],$_REQUEST[observaciones]);
elseif($_REQUEST['oper'] == 'edit') $detalleVacuna->actualizarDetalleVacuna($_REQUEST[iddetalleVacuna],$_REQUEST[claveGeneral],$_REQUEST[idvacuna],$_REQUEST[nroDosis],$_REQUEST[tipoProgramacion],formatoFecha(trim($_REQUEST[fechaProgramada])),formatoFecha($_REQUEST[fechaAplicacion]),$_REQUEST[estadoDosis],$_REQUEST[lugarAplicacion],$_REQUEST[observaciones]);
elseif($_REQUEST['oper'] == 'del') $detalleVacuna->eliminarDetalleVacuna($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
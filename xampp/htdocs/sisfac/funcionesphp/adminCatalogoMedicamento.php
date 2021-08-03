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

require_once '../clases/claseCatalogoMedicamento.php';
require_once '../clases/claseDatoGeneral.php';
$catalogoMedicamento = new CatalogoMedicamento();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $catalogoMedicamento->mostrarCatalogoMedicamentoDatagrid ();
elseif($_REQUEST[f] == 2) echo $catalogoMedicamento->mostrarCatalogoMedicamentoVector($_REQUEST[term], $_REQUEST[limit]);
elseif($_REQUEST[f] == 3) $catalogoMedicamento->mostrarCatalogoMedicamentoCombobox(true);
elseif($_REQUEST[f] == 4) $catalogoMedicamento->mostrarCatalogoMedicamentoCombobox(false);
elseif($_REQUEST['oper'] == 'add') $catalogoMedicamento->agregarCatalogoMedicamento($_REQUEST[idcatalogoMedicamento],$_REQUEST[codigoMedicamento],$_REQUEST[nombreMedicamento],$_REQUEST[concentracion],$_REQUEST[formulaF],$_REQUEST[titular],formatoFecha($_REQUEST[fechaAutorizacion]),formatoFecha($_REQUEST[fechaVencimiento]),$_REQUEST[fabricante],$_REQUEST[pais],$_REQUEST[condicionVenta],$_REQUEST[grupoProd],$_REQUEST[situacion],$_REQUEST[codigoATC],$_REQUEST[descripcionATC],$_REQUEST[sustancia]);
elseif($_REQUEST['oper'] == 'edit') $catalogoMedicamento->actualizarCatalogoMedicamento($_REQUEST[idcatalogoMedicamento],$_REQUEST[codigoMedicamento],$_REQUEST[nombreMedicamento],$_REQUEST[concentracion],$_REQUEST[formulaF],$_REQUEST[titular],formatoFecha($_REQUEST[fechaAutorizacion]),formatoFecha($_REQUEST[fechaVencimiento]),$_REQUEST[fabricante],$_REQUEST[pais],$_REQUEST[condicionVenta],$_REQUEST[grupoProd],$_REQUEST[situacion],$_REQUEST[codigoATC],$_REQUEST[descripcionATC],$_REQUEST[sustancia]);
elseif($_REQUEST['oper'] == 'del') $catalogoMedicamento->eliminarCatalogoMedicamento($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
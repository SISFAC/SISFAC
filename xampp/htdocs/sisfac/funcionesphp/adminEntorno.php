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

require_once '../clases/claseEntorno.php';
require_once '../clases/claseDatoGeneral.php';
$entorno = new Entorno();
$datoGeneral = new DatoGeneral();

if($_REQUEST['f'] == 1) echo $entorno->obtenerEntornoVector ($_REQUEST[idfamilia], $_REQUEST[claveGeneral]).'-C.'.$entorno->obtenerEntornoCanes($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    $entorno->eliminarEntorno($_REQUEST[idfamilia], $_SESSION[claveGeneral]);
    $array = explode('*', $_REQUEST[entorno]);
    foreach ($array as $value) {
        $data = explode('-', $value);
        foreach ($data as $lista) {
            $temp = explode('+', $lista);
            if($entorno->buscarEntornoIdfamiliaCodEntrono($_REQUEST[idfamilia], $temp[2]) == '0' && $temp[2]!=''){
                $entorno->agregarEntorno($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('identorno', 'entorno'), $_REQUEST[idfamilia], $temp[0], $temp[1], $temp[2]);
            }
        }
    }
}
?>

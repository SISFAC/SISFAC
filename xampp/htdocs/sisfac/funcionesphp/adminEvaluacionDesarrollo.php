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

require_once '../clases/claseEvaluacionDesarrollo.php';
require_once '../clases/claseDatoGeneral.php';
$evaluacionDesarrollo = new EvaluacionDesarrollo();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $evaluacionDesarrollo->mostrarEvaluacionDesarrolloDatagrid ();
elseif($_REQUEST[f] == 2) echo $evaluacionDesarrollo->mostrarEvaluacionDesarrolloVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $evaluacionDesarrollo->mostrarEvaluacionDesarrolloCombobox(true);
elseif($_REQUEST[f] == 4) $evaluacionDesarrollo->mostrarEvaluacionDesarrolloCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idevaluacionDesarrollo])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $evaluacionDesarrollo->agregarEvaluacionDesarrollo($datoGeneral->obtenerMaximoIDHistorial ('idevaluacionDesarrollo', 'evaluacionDesarrollo'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[resultado],$_REQUEST[observaciones]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idevaluacionDesarrollo', 'evaluacionDesarrollo') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $evaluacionDesarrollo->actualizarEvaluacionDesarrollo('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[resultado],$_REQUEST[observaciones]);
        }
        echo trim($_REQUEST[idevaluacionDesarrollo]);
    }
}
?>
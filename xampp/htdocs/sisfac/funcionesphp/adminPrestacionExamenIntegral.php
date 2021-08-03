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

require_once '../clases/clasePrestacionExamenIntegral.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionExamenIntegral = new PrestacionExamenIntegral();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionExamenIntegral->mostrarPrestacionExamenIntegralDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionExamenIntegral->mostrarPrestacionExamenIntegralVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionExamenIntegral->mostrarPrestacionExamenIntegralCombobox(true);
elseif($_REQUEST[f] == 4) $prestacionExamenIntegral->mostrarPrestacionExamenIntegralCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionExamenIntegral])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionExamenIntegral->agregarPrestacionExamenIntegral($datoGeneral->obtenerMaximoIDHistorial ('idprestacionExamenIntegral', 'prestacionExamenIntegral'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[opcionPiel],$_REQUEST[descripcionPiel],$_REQUEST[opcionCabeza],$_REQUEST[descripcionCabeza],$_REQUEST[opcionCabello],$_REQUEST[descripcionCabello],$_REQUEST[opcionOjos],$_REQUEST[descripcionOjoD],$_REQUEST[descripcionOjoI],$_REQUEST[opcionOidos],$_REQUEST[descripcionOidoD],$_REQUEST[descripcionOidoI],$_REQUEST[opcionNariz],$_REQUEST[descripcionNariz],$_REQUEST[opcionBoca],$_REQUEST[descripcionBoca],$_REQUEST[opcionOrofaringe],$_REQUEST[descripcionOrofaringe],$_REQUEST[opcionCuello],$_REQUEST[descripcionCuello],$_REQUEST[opcionRespiratorio],$_REQUEST[descripcionRespiratorio],$_REQUEST[opcionCardiovascular],$_REQUEST[descripcionCardiovascular],$_REQUEST[opcionDigestivo],$_REQUEST[descripcionDigestivo],$_REQUEST[opcionGenitourinario],$_REQUEST[descripcionGenitourinario],$_REQUEST[opcionLocomotor],$_REQUEST[descripcionLocomotor],$_REQUEST[opcionMarcha],$_REQUEST[descripcionMarcha],$_REQUEST[opcionColumna],$_REQUEST[descripcionColumna],$_REQUEST[opcionSuperior],$_REQUEST[descripcionSuperior],$_REQUEST[opcionInferior],$_REQUEST[descripcionInferior],$_REQUEST[opcionLinfatico],$_REQUEST[descripcionLinfatico]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionExamenIntegral', 'prestacionExamenIntegral') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionExamenIntegral->actualizarPrestacionExamenIntegral('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[opcionPiel],$_REQUEST[descripcionPiel],$_REQUEST[opcionCabeza],$_REQUEST[descripcionCabeza],$_REQUEST[opcionCabello],$_REQUEST[descripcionCabello],$_REQUEST[opcionOjos],$_REQUEST[descripcionOjoD],$_REQUEST[descripcionOjoI],$_REQUEST[opcionOidos],$_REQUEST[descripcionOidoD],$_REQUEST[descripcionOidoI],$_REQUEST[opcionNariz],$_REQUEST[descripcionNariz],$_REQUEST[opcionBoca],$_REQUEST[descripcionBoca],$_REQUEST[opcionOrofaringe],$_REQUEST[descripcionOrofaringe],$_REQUEST[opcionCuello],$_REQUEST[descripcionCuello],$_REQUEST[opcionRespiratorio],$_REQUEST[descripcionRespiratorio],$_REQUEST[opcionCardiovascular],$_REQUEST[descripcionCardiovascular],$_REQUEST[opcionDigestivo],$_REQUEST[descripcionDigestivo],$_REQUEST[opcionGenitourinario],$_REQUEST[descripcionGenitourinario],$_REQUEST[opcionLocomotor],$_REQUEST[descripcionLocomotor],$_REQUEST[opcionMarcha],$_REQUEST[descripcionMarcha],$_REQUEST[opcionColumna],$_REQUEST[descripcionColumna],$_REQUEST[opcionSuperior],$_REQUEST[descripcionSuperior],$_REQUEST[opcionInferior],$_REQUEST[descripcionInferior],$_REQUEST[opcionLinfatico],$_REQUEST[descripcionLinfatico]);
        }
        echo trim($_REQUEST[idprestacionExamenIntegral]);
    }
}


?>    
    
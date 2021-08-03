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

require_once '../clases/clasePrestacionEvaluacionNino.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionEvaluacionNino = new PrestacionEvaluacionNino();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionEvaluacionNino->mostrarPrestacionEvaluacionNinoDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionEvaluacionNino->mostrarPrestacionEvaluacionNinoVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionEvaluacionNino->mostrarPrestacionEvaluacionNinoCombobox(true);
elseif($_REQUEST[f] == 4) $prestacionEvaluacionNino->mostrarPrestacionEvaluacionNinoCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionEvaluacionNino])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionEvaluacionNino->agregarPrestacionEvaluacionNino($datoGeneral->obtenerMaximoIDHistorial ('idprestacionEvaluacionNino', 'prestacionEvaluacionNino'),$_SESSION[claveGeneral],$value,$_REQUEST[idpersona],$_REQUEST[idepisodio],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[signosPeligro],$_REQUEST[remedioRecibidos],$_REQUEST[opTos],$_REQUEST[diasTiempoTos],$_REQUEST[supuracionOido],$_REQUEST[diasSupuracion],$_REQUEST[tumefaccionOreja],$_REQUEST[dolorGarganta],$_REQUEST[exudado],$_REQUEST[gangliosDolorosos],$_REQUEST[diarrea],$_REQUEST[tiempoDiarrea],$_REQUEST[estadoGeneral],$_REQUEST[sangreHeces],$_REQUEST[ojosHundidos],$_REQUEST[signosPliegue],$_REQUEST[fiebre],$_REQUEST[riesgoMalaria],$_REQUEST[observaciones]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionEvaluacionNino', 'prestacionEvaluacionNino') - 1).'*';
        }
        echo substr($temp, 0, -1) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionEvaluacionNino->actualizarPrestacionEvaluacionNino('',$_SESSION[claveGeneral],$value,$_REQUEST[idpersona],$_REQUEST[idepisodio],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[signosPeligro],$_REQUEST[remedioRecibidos],$_REQUEST[opTos],$_REQUEST[diasTiempoTos],$_REQUEST[supuracionOido],$_REQUEST[diasSupuracion],$_REQUEST[tumefaccionOreja],$_REQUEST[dolorGarganta],$_REQUEST[exudado],$_REQUEST[gangliosDolorosos],$_REQUEST[diarrea],$_REQUEST[tiempoDiarrea],$_REQUEST[estadoGeneral],$_REQUEST[sangreHeces],$_REQUEST[ojosHundidos],$_REQUEST[signosPliegue],$_REQUEST[fiebre],$_REQUEST[riesgoMalaria],$_REQUEST[observaciones]);
        }
        echo $_REQUEST[idprestacionEvaluacionNino];
    }
}


?>    
    
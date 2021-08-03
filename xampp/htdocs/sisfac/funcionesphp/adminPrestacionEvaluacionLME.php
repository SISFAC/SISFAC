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

require_once '../clases/clasePrestacionEvaluacionLME.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionEvaluacionLME = new PrestacionEvaluacionLME();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionEvaluacionLME->mostrarPrestacionEvaluacionLMEDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionEvaluacionLME->mostrarPrestacionEvaluacionLMEVector($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionEvaluacionLME->mostrarPrestacionEvaluacionLMECombobox(true);
elseif($_REQUEST[f] == 4) $prestacionEvaluacionLME->mostrarPrestacionEvaluacionLMECombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionEvaluacionLME])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionEvaluacionLME->agregarPrestacionEvaluacionLME($datoGeneral->obtenerMaximoIDHistorial ('idprestacionEvaluacionLME', 'prestacionEvaluacionLME'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[lactanciaLM],$_REQUEST[tecnicaLM],$_REQUEST[frecuenciaLM],$_REQUEST[lecheNoMaterna],$_REQUEST[recibeAguitas],$_REQUEST[otroAlimento],$_REQUEST[consistenciaAdecuada],$_REQUEST[cantidadAdecuada],$_REQUEST[frecuenciaAdecuada],$_REQUEST[consumoAlimentosAnimal],$_REQUEST[consumoFrutasVerduras],$_REQUEST[consumoMantequilla],$_REQUEST[alimentosEnPlato],$_REQUEST[usaSalYodada],$_REQUEST[tomaSuplementoHierro],$_REQUEST[tomaSuplementoVitamina],$_REQUEST[recibeMicronutrientes],$_REQUEST[opcionBeneficiarioPrograma],$_REQUEST[descripcionPrograma]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionEvaluacionLME', 'prestacionEvaluacionLME') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionEvaluacionLME->actualizarPrestacionEvaluacionLME('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[lactanciaLM],$_REQUEST[tecnicaLM],$_REQUEST[frecuenciaLM],$_REQUEST[lecheNoMaterna],$_REQUEST[recibeAguitas],$_REQUEST[otroAlimento],$_REQUEST[consistenciaAdecuada],$_REQUEST[cantidadAdecuada],$_REQUEST[frecuenciaAdecuada],$_REQUEST[consumoAlimentosAnimal],$_REQUEST[consumoFrutasVerduras],$_REQUEST[consumoMantequilla],$_REQUEST[alimentosEnPlato],$_REQUEST[usaSalYodada],$_REQUEST[tomaSuplementoHierro],$_REQUEST[tomaSuplementoVitamina],$_REQUEST[recibeMicronutrientes],$_REQUEST[opcionBeneficiarioPrograma],$_REQUEST[descripcionPrograma]);
        }
        echo trim($_REQUEST[idprestacionEvaluacionLME]);
    }
}


?>    
    
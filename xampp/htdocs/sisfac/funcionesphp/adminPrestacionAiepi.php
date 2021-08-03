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

require_once '../clases/clasePrestacionAiepi.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionAiepi = new PrestacionAiepi();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionAiepi->mostrarPrestacionAiepiDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionAiepi->mostrarPrestacionAiepiVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionAiepi->mostrarPrestacionAiepiCombobox(true);
elseif($_REQUEST[f] == 4) $prestacionAiepi->mostrarPrestacionAiepiCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionAiepi])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionAiepi->agregarPrestacionAiepi($datoGeneral->obtenerMaximoIDHistorial ('idprestacionAiepi', 'prestacionAiepi'), $_SESSION[claveGeneral],$value,$_REQUEST[idpersona],$_REQUEST[idepisodio],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[infeccionBacteriana],$_REQUEST[respiracionesPorMinuto],$_REQUEST[respiracionRapida],$_REQUEST[tirajeSubcostal],$_REQUEST[aleteoNasal],$_REQUEST[quejido],$_REQUEST[estadoFontanela],$_REQUEST[supuracionOido],$_REQUEST[estadoOmbligo],$_REQUEST[temperatura],$_REQUEST[pielPustulas],$_REQUEST[letargio],$_REQUEST[movimientoAnormal],$_REQUEST[secrecionOjos],$_REQUEST[diarrea],$_REQUEST[tiempoDiarrea],$_REQUEST[sangreHeces],$_REQUEST[estadoGeneral],$_REQUEST[ojosHundidos],$_REQUEST[signoCutaneo]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionAiepi', 'prestacionAiepi') - 1).'*';
        }
        echo substr($temp, 0, -1) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionAiepi->actualizarPrestacionAiepi ('',$_SESSION[claveGeneral],$value,$_REQUEST[idpersona],$_REQUEST[idepisodio],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[infeccionBacteriana],$_REQUEST[respiracionesPorMinuto],$_REQUEST[respiracionRapida],$_REQUEST[tirajeSubcostal],$_REQUEST[aleteoNasal],$_REQUEST[quejido],$_REQUEST[estadoFontanela],$_REQUEST[supuracionOido],$_REQUEST[estadoOmbligo],$_REQUEST[temperatura],$_REQUEST[pielPustulas],$_REQUEST[letargio],$_REQUEST[movimientoAnormal],$_REQUEST[secrecionOjos],$_REQUEST[diarrea],$_REQUEST[tiempoDiarrea],$_REQUEST[sangreHeces],$_REQUEST[estadoGeneral],$_REQUEST[ojosHundidos],$_REQUEST[signoCutaneo]);
        }
        echo $_REQUEST[idprestacionAiepi];
    }
}
elseif($_REQUEST['oper'] == 'edit') $prestacionAiepi->actualizarPrestacionAiepi ($_REQUEST[idprestacionAiepi],$_SESSION[claveGeneral],$_REQUEST[idcatalogoPrestacion],$_REQUEST[idpersona],$_REQUEST[idepisodio],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[infeccionBacteriana],$_REQUEST[respiracionesPorMinuto],$_REQUEST[respiracionRapida],$_REQUEST[tirajeSubcostal],$_REQUEST[aleteoNasal],$_REQUEST[quejido],$_REQUEST[estadoFontanela],$_REQUEST[supuracionOido],$_REQUEST[estadoOmbligo],$_REQUEST[temperatura],$_REQUEST[pielPustulas],$_REQUEST[letargio],$_REQUEST[movimientoAnormal],$_REQUEST[secrecionOjos],$_REQUEST[diarrea],$_REQUEST[tiempoDiarrea],$_REQUEST[sangreHeces],$_REQUEST[estadoGeneral],$_REQUEST[ojosHundidos],$_REQUEST[signoCutaneo]);
elseif($_REQUEST['oper'] == 'del') $prestacionAiepi->eliminarPrestacionAiepi($_REQUEST[id], $_SESSION[claveGeneral]);


/*
 * 
 if(trim($_REQUEST[idtabla])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            funcion agregar de la tabla
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idtabla', 'tabla') - 1).'*';
        }
        echo substr($temp, 0, -1) ;
    }else{
        $array = explode('*', $_REQUEST[idtabla]);
        foreach ($array as $value) {
            function actualizar tabla
        }
    }
 * 
 * 
 */


?>    
    
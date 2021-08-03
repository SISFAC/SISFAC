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

require_once '../clases/clasePrestacionAlimentacionRN.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionAlimentacionRN = new PrestacionAlimentacionRN();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionAlimentacionRN->mostrarPrestacionAlimentacionRNDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionAlimentacionRN->mostrarPrestacionAlimentacionRNVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionAlimentacionRN->mostrarPrestacionAlimentacionRNCombobox(true);
elseif($_REQUEST[f] == 4) $prestacionAlimentacionRN->mostrarPrestacionAlimentacionRNCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionAlimentacionRN])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionAlimentacionRN->agregarPrestacionAlimentacionRN($datoGeneral->obtenerMaximoIDHistorial ('idprestacionAlimentacionRN', 'prestacionAlimentacionRN'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[tomaPecho],$_REQUEST[nroVecesPecho],$_REQUEST[opcomidas],$_REQUEST[cualesComidas],$_REQUEST[cambioDuranteEnfermedad],$_REQUEST[cualesEnfermedades],$_REQUEST[ulcerasBocaBajoPeso],$_REQUEST[alimentacionUltimaHora],$_REQUEST[opAmarre],$_REQUEST[mamaCorrecto],$_REQUEST[ulcerasBoca],$_REQUEST[buenaPosicion],$_REQUEST[observaciones]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionAlimentacionRN', 'prestacionAlimentacionRN') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionAlimentacionRN->actualizarPrestacionAlimentacionRN('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[tomaPecho],$_REQUEST[nroVecesPecho],$_REQUEST[opcomidas],$_REQUEST[cualesComidas],$_REQUEST[cambioDuranteEnfermedad],$_REQUEST[cualesEnfermedades],$_REQUEST[ulcerasBocaBajoPeso],$_REQUEST[alimentacionUltimaHora],$_REQUEST[opAmarre],$_REQUEST[mamaCorrecto],$_REQUEST[ulcerasBoca],$_REQUEST[buenaPosicion],$_REQUEST[observaciones]);
        }
        echo trim($_REQUEST[idprestacionAlimentacionRN]);
    }
}
elseif($_REQUEST['oper'] == 'edit') $prestacionAlimentacionRN->actualizarPrestacionAlimentacionRN($_REQUEST[idprestacionAlimentacionRN],$_REQUEST[claveGeneral],$_REQUEST[idcatalogoPrestacion],$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[tomaPecho],$_REQUEST[nroVecesPecho],$_REQUEST[opcomidas],$_REQUEST[cualesComidas],$_REQUEST[cambioDuranteEnfermedad],$_REQUEST[cualesEnfermedades],$_REQUEST[ulcerasBocaBajoPeso],$_REQUEST[alimentacionUltimaHora],$_REQUEST[opAmarre],$_REQUEST[mamaCorrecto],$_REQUEST[ulcerasBoca],$_REQUEST[buenaPosicion],$_REQUEST[observaciones]);
elseif($_REQUEST['oper'] == 'del') $prestacionAlimentacionRN->eliminarPrestacionAlimentacionRN($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
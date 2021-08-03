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

require_once '../clases/clasePrestacionConsejeria.php';
require_once '../clases/claseDatoGeneral.php';
$prestacionConsejeria = new PrestacionConsejeria();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $prestacionConsejeria->mostrarPrestacionConsejeriaDatagrid ();
elseif($_REQUEST[f] == 2) echo $prestacionConsejeria->mostrarPrestacionConsejeriaVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $prestacionConsejeria->mostrarPrestacionConsejeriaCombobox(true);
elseif($_REQUEST[f] == 4) $prestacionConsejeria->mostrarPrestacionConsejeriaCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idprestacionConsejeria])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionConsejeria->agregarPrestacionConsejeria($datoGeneral->obtenerMaximoIDHistorial ('idprestacionConsejeria', 'prestacionConsejeria'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idprestacionConsejeria', 'prestacionConsejeria') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $prestacionConsejeria->actualizarPrestacionConsejeria('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado]);
        }
        echo trim($_REQUEST[idprestacionConsejeria]);
    }
}


?>    
    
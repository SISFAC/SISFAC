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

require_once '../clases/claseSector.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseFamilia.php';
$sector = new Sector();
$datoGeneral = new DatoGeneral();
$familia = new Familia();

if($_REQUEST['f'] == 1) $sector->mostrarSectorDatagrid($_REQUEST['idcomunidad']);
elseif($_REQUEST['f'] == 2) $sector->mostrarSectorCombobox($_REQUEST[idcomunidad], true, $_REQUEST['claveGeneral'], $_REQUEST['nombreComunidad']);
elseif($_REQUEST['f'] == 3) $sector->mostrarSectorCombobox($_REQUEST[idcomunidad], false, $_REQUEST['claveGeneral'], $_REQUEST['nombreComunidad']);
elseif($_REQUEST['f'] == 4) $sector->getSectoresEstablecimiento($_REQUEST[idestablecimiento], $_REQUEST[idtrabajador]);
elseif($_REQUEST['f'] == 5) $sector->mostrarSectorTotalCombobox(false);
elseif($_REQUEST['oper'] == 'add') $sector->agregarSector($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idsector', 'sector'), $_REQUEST[idcomunidad], $_REQUEST[nombreSector], $_REQUEST[descripcion]);
elseif($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $sector->agregarSector($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idsector', 'sector'), $_REQUEST[idcomunidad], $_REQUEST[nombreSector], $_REQUEST[descripcion]);
    else $sector->actualizarSector($_SESSION[claveGeneral], $_REQUEST[id], $_REQUEST[idcomunidad], $_REQUEST[nombreSector], $_REQUEST[descripcion]);
}
elseif($_REQUEST['oper'] == 'del') {
    if($familia->obtenerCantidadFicha('', $_REQUEST[id], $_SESSION[claveGeneral])==0){
        $sector->eliminarSector($_REQUEST[id], $_SESSION[claveGeneral]);
        echo 'S';//SE ELIMINO EL REGISTRO
    }else{
        echo 'N';//NO SE ELIMINO
    }
}


?>
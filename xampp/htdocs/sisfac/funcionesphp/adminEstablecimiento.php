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

require_once '../clases/claseEstablecimiento.php';
require_once '../clases/claseDatoGeneral.php';
$establecimiento = new Establecimiento();
$datoGeneral = new DatoGeneral();

if($_REQUEST['f'] == 1) $establecimiento->mostrarEstablecimientoDatagrid ($_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[idprovincia]);
elseif($_REQUEST['f'] == 2) $establecimiento->mostrarEstablecimientoCombobox ($_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[claveGeneral], true);
elseif($_REQUEST['f'] == 3) $establecimiento->mostrarEstablecimientoCombobox ($_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[claveGeneral], false);
elseif($_REQUEST['oper'] == 'add') $establecimiento->agregarEstablecimiento ($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idestablecimiento', 'establecimiento'), $_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[nombreEstablecimiento], $_REQUEST[tipo]);
elseif($_REQUEST['oper'] == 'edit') {
    if($_REQUEST['id'] == 'nuevo') $establecimiento->agregarEstablecimiento ($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idestablecimiento', 'establecimiento'), $_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[nombreEstablecimiento], $_REQUEST[tipo]);
    else $establecimiento->actualizarEstablecimiento($_REQUEST[claveGeneral], $_REQUEST[id], $_REQUEST[iddistrito], $_REQUEST[idnucleo], $_REQUEST[nombreEstablecimiento], $_REQUEST[tipo]);
}
elseif($_REQUEST['oper'] == 'del') $establecimiento->eliminarEstablecimiento($_REQUEST[id], $_SESSION[claveGeneral]);
elseif($_REQUEST['f'] == 4){
    $array = explode('-', $_REQUEST[ids]);
    foreach ($array as $value) {
        //echo $value;
        $establecimiento->actualizarEstablecimiento($_SESSION[claveGeneral], $value, '', $_REQUEST[idnucleo], '', '');
        
    }
    
}
elseif($_REQUEST['f'] == 5) $establecimiento->mostrarEstablecimientoTotalCombobox (false);
elseif($_REQUEST['f'] == 6) {
    $iddiresa = explode('-', $_SESSION['claves']);
    echo $establecimiento->mostrarEstablecimientoTrabajadorVector($_REQUEST[term], $_REQUEST[limit], $iddiresa[0]);
}

?>
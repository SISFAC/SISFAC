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

require_once '../clases/claseProcedimiento.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseEquivalenciasCodigo.php';
$procedimiento = new Procedimiento();
$datoGeneral = new DatoGeneral();
$equivalenciasCodigo = new EquivalenciasCodigo();

if($_REQUEST[f] == 1) $procedimiento->mostrarProcedimientoDatagrid ($_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    $procedimiento->agregarProcedimiento($datoGeneral->obtenerMaximoIDHistorial('idprocedimiento', 'procedimiento'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[idcatalogoCPT], $_REQUEST[nombreCatalogo], $_REQUEST[nombre], $_REQUEST[frecuencia], $_REQUEST[observacion]);
}
elseif($_REQUEST['oper'] == 'edit') {
    $procedimiento->actualizarProcedimiento ($_REQUEST[idprocedimiento], $_SESSION[claveGeneral], $_REQUEST[idepisodio], $_REQUEST[idcatalogoCPT], $_REQUEST[nombreCatalogo], $_REQUEST[nombre], $_REQUEST[frecuencia], $_REQUEST[observacion]);
}
elseif($_REQUEST['oper'] == 'del') $procedimiento->eliminarProcedimiento($_REQUEST[id], $_SESSION[claveGeneral]);
else if($_REQUEST[f] == 2){
    
    $result = $equivalenciasCodigo->buscarEquivalencia($_REQUEST[idcatalogoEpisodio], $_REQUEST[idcatalogoPrestacion], '', '', '');
    while ($row = mysql_fetch_array($result)) {
        $procedimiento->agregarProcedimiento($datoGeneral->obtenerMaximoIDHistorial('idprocedimiento', 'procedimiento'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], $row[0], $row[1], $_REQUEST[nombre], $_REQUEST[frecuencia], $_REQUEST[observacion]);
    }
    
}

?>
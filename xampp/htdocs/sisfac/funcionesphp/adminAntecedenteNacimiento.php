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

require_once '../clases/claseAntecedenteNacimiento.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseDetalleGinecobstetrico.php';

$datoGeneral = new DatoGeneral();
$antecedenteNacimiento = new AntecedenteNacimiento();
$detalleGinecobstetrico = new DetalleGinecobstetrico();

if($_REQUEST[f] == 1) $antecedenteNacimiento->mostrarAntecedenteNacimientoDatagrid ($_REQUEST[iddetalleGinecobstetrico], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 2) echo $antecedenteNacimiento->mostrarAntecedenteNacimientoVector ($_REQUEST[iddetalleGinecobstetrico], $_SESSION[claveGeneral]);
elseif($_REQUEST[oper] == 'add') {
    
    $detalleGinecobstetrico->actualizarDetalleGinecobstetrico($_REQUEST[iddetalleGinecobstetrico], $_SESSION[claveGeneral], $_REQUEST[idantecedenteGinecobstetrico], '', '', '', '', '', '', '', '', '', '', '', '', '', $_REQUEST[idpersonaref], 'SI');
    
    $antecedenteNacimiento->agregarAntecedenteNacimiento ($datoGeneral->obtenerMaximoIDHistorial('idantecedenteNacimiento', 'antecedenteNacimiento'), $_SESSION[claveGeneral], $_REQUEST[iddetalleGinecobstetrico], $_REQUEST[peso], $_REQUEST[tallaNacer], $_REQUEST[perimetroCefalico], $_REQUEST[perimetroToracico], $_REQUEST[perimetroAbdominal], $_REQUEST[apgar], $_REQUEST[edadGestacional], $_REQUEST[testCapurro], $_REQUEST[complicacion], $_REQUEST[malformacion], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo]);
    echo trim($datoGeneral->obtenerMaximoIDHistorial('idantecedenteNacimiento', 'antecedenteNacimiento')) - 1;
}
elseif($_REQUEST[oper] == 'edit') {
    $antecedenteNacimiento->actualizarAntecedenteNacimiento ($_REQUEST[idantecedenteNacimiento], $_SESSION[claveGeneral], $_REQUEST[iddetalleGinecobstetrico], $_REQUEST[peso], $_REQUEST[tallaNacer], $_REQUEST[perimetroCefalico], $_REQUEST[perimetroToracico], $_REQUEST[perimetroAbdominal], $_REQUEST[apgar], $_REQUEST[edadGestacional], $_REQUEST[testCapurro], $_REQUEST[complicacion], $_REQUEST[malformacion], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreCatalogo]);
    echo trim($_REQUEST[idantecedenteNacimiento]);
}
elseif($_REQUEST[oper] == 'del') $antecedenteNacimiento->eliminarAntecedenteNacimmiento($_REQUEST[id], $_SESSION[claveGeneral]);


?>
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

require_once '../clases/claseAntecedenteGinecobstetrico.php';
require_once '../clases/claseDatoGeneral.php';

$datoGeneral = new DatoGeneral();
$antecedenteGinecobstetrico = new AntecedenteGinecobstetrico();

if($_REQUEST[f] == 1) echo $antecedenteGinecobstetrico->obtenerAntecedenteGinecobstetricoVector ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST[oper] == 'add') {
    if($antecedenteGinecobstetrico->obtenerAntecedenteGinecobstetrico($_REQUEST[idpersona], $_SESSION[claveGeneral]) == 0){
        $antecedenteGinecobstetrico->agregarAntecedenteGinecobstetrico ($datoGeneral->obtenerMaximoIDHistorial('idantecedenteGinecobstetrico', 'antecedenteGinecobstetrico'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[nroGestacion], $_REQUEST[paridad], $_REQUEST[periodoIntergenesico]);
        echo $datoGeneral->obtenerMaximoIDHistorial('idantecedenteGinecobstetrico', 'antecedenteGinecobstetrico') - 1;
    }else{
        $antecedenteGinecobstetrico->actualizarAntecedenteGinecobstetrico ($_REQUEST[idantecedenteGinecobstetrico], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[nroGestacion], $_REQUEST[paridad], $_REQUEST[periodoIntergenesico]);
        echo $_REQUEST[idantecedenteGinecobstetrico];
    }
    
}
elseif($_REQUEST[oper] == 'edit') $antecedenteGinecobstetrico->actualizarAntecedenteGinecobstetrico ($_REQUEST[idantecedenteGinecobstetrico], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[nroGestacion], $_REQUEST[paridad], $_REQUEST[periodoIntergenesico]);
elseif($_REQUEST[oper] == 'del') $antecedenteGinecobstetrico->eliminarAntecedenteGinecobstetrico($_REQUEST[id], $_SESSION[claveGeneral]);


?>
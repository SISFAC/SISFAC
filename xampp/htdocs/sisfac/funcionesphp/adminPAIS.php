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

require_once '../clases/clasePAIS.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseDetallePAIS.php';
$PAIS = new PAIS();
$datoGeneral = new DatoGeneral();
$detallePAIS = new DetallePAIS();

if($_REQUEST[f] == 1) $PAIS->mostrarPAISDatagrid ();
elseif($_REQUEST[f] == 2) echo $PAIS->mostrarPAISVector ($_REQUEST[idpersona], $datoGeneral->obtenerIdEtapaVida($_REQUEST[nombreEtapa]), $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $PAIS->mostrarPAISCombobox(true);
elseif($_REQUEST[f] == 4) $PAIS->mostrarPAISCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    
    if(trim($_REQUEST[idPAIS])==''){
        
        $PAIS->agregarPAIS($datoGeneral->obtenerMaximoIDHistorial ('idPAIS', 'PAIS'),$_SESSION[claveGeneral],$_REQUEST[idpersona],$datoGeneral->obtenerIdEtapaVida($_REQUEST[etapaVida]),$_REQUEST[estadoPlan],$_REQUEST[anio]);
        $idPAIS = $datoGeneral->obtenerMaximoIDHistorial ('idPAIS', 'PAIS') - 1;
        echo trim($idPAIS);
        
        $array = explode('+', $_REQUEST[codigo]);
        foreach ($array as $value) {
            $data = explode('-', $value);
            $detallePAIS->agregarDetallePAIS($datoGeneral->obtenerMaximoIDHistorial ('iddetallePAIS', 'detallePAIS'), $_SESSION[claveGeneral], $data[0], $idPAIS, $data[1], formatoFecha($data[2]));
        }
    }else{
        $PAIS->actualizarPAIS($_REQUEST[idPAIS],$_SESSION[claveGeneral],$_REQUEST[idpersona],$_REQUEST[idetapaVida],$_REQUEST[estadoPlan],$_REQUEST[anio]);
        $array = explode('+', $_REQUEST[codigo]);
        foreach ($array as $value) {
            $data = explode('-', $value);
            $detallePAIS->actualizarDetallePAISEpisodio($_SESSION[claveGeneral], $data[0], $_REQUEST[idPAIS], $data[1], formatoFecha($data[2]));
        }
        echo trim($_REQUEST[idPAIS]);
    }
}
elseif($_REQUEST['oper'] == 'edit') $PAIS->actualizarPAIS($_REQUEST[idPAIS],$_SESSION[claveGeneral],$_REQUEST[idpersona],$_REQUEST[idetapaVida],$_REQUEST[estadoPlan],$_REQUEST[anio]);
elseif($_REQUEST['oper'] == 'del') $PAIS->eliminarPAIS($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
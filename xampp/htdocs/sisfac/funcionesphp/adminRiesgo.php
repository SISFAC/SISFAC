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

require_once '../clases/claseRiesgo.php';
require_once '../clases/clasePersona.php';
require_once '../clases/claseDatoGeneral.php';
$riesgo = new Riesgo();
$datoGeneral = new DatoGeneral();
$persona = new Persona();

if($_REQUEST['f'] == 1) $riesgo->mostrarFamiliaDatagrid();
elseif($_REQUEST['f'] == 2) $riesgo->obtenerRiesgoVector($_REQUEST[claveGeneral], $_REQUEST[idfamilia], $_REQUEST[idpersona]);
elseif($_REQUEST['f'] == 3) $riesgo->obtenerRiesgoGestante($_REQUEST[claveGeneral], $_REQUEST[idfamilia], $_REQUEST[idpersona]);
elseif($_REQUEST['oper'] == 'add') {
    if($_REQUEST['opcion'] == 'PERSONAL'){
        $array = explode('-', $_REQUEST['nombreRiesgo']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($riesgo->obtenerRiesgo($data[1], $_REQUEST[idpersona], $_REQUEST[idfamilia])=='0')
                    $riesgo->agregarRiesgo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idriesgo', 'riesgo'), $_REQUEST[idpersona], $_REQUEST[idfamilia], $_REQUEST[etapa], $data[0],$data[1], $data[2]);
        }
    }
    if($_REQUEST['opcion'] == 'FAMILIAR'){
        $array = explode('-', $_REQUEST['riesgoFamilia']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($riesgo->obtenerRiesgo($data[1], '', $_REQUEST[idfamilia])=='0')
                $riesgo->agregarRiesgo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idriesgo', 'riesgo'),$_REQUEST[idpersona], $_REQUEST[idfamilia], $_REQUEST[etapa], $data[0], $data[1], $data[2]);
        }
    }
    if($_REQUEST['opcion'] == 'MIEMBROTIENE'){
        $array = explode('-', $_REQUEST['otroriesgo']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($riesgo->obtenerRiesgo($data[1], $_REQUEST[idpersona], $_REQUEST[idfamilia])=='0')
                $riesgo->agregarRiesgo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idriesgo', 'riesgo'),$_REQUEST[idpersona], $_REQUEST[idfamilia], $_REQUEST[etapa], $data[0], $data[1], $data[2]);
        }
    }
    if($_REQUEST['opcion'] == 'GESTANTE'){
        $array = explode('-', $_REQUEST['gestante']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($riesgo->obtenerRiesgo($data[1], $_REQUEST[idpersona], $_REQUEST[idfamilia])=='0')
                $riesgo->agregarRiesgo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idriesgo', 'riesgo'),$_REQUEST[idpersona], $_REQUEST[idfamilia], $_REQUEST[etapa], $data[0], $data[1], $data[2]);
        }
    }
    
}elseif($_REQUEST['oper'] == 'del') {
    if($_REQUEST['opcion'] == 'FAMILIAR'){
        $riesgo->eliminarRiesgo($_REQUEST[codriesgo], '', $_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
    }else{
        $riesgo->eliminarRiesgo($_REQUEST[codriesgo], $_REQUEST[idpersona], $_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
    }
}elseif($_REQUEST['f'] == 4){
    $riesgo->agregarRiesgo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idriesgo', 'riesgo'), $persona->obtenerMaximaPersona(), $_REQUEST[idfamilia], $_REQUEST[etapa], '', '', '');
}

?>

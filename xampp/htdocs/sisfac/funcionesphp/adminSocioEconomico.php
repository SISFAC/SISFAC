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

require_once '../clases/claseSocioEconomico.php';
require_once '../clases/claseDatoGeneral.php';
$socioeconomico = new SocioEconomico();
$datoGeneral = new DatoGeneral();


if($_REQUEST['f'] == 2) echo $socioeconomico->obtenerSocioEconomicoVector ($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    $socioeconomico->elimiarSocioEconomico($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
    $array = explode('+', $_REQUEST['valores']);


    $labels = array('ESTADO CIVIL DEL JEFE DE FAMILIA',
                    'GRUPO FAMILIAR',
                    'TENENCIA DE LA VIVIENDA',
                    'AGUA DE CONSUMO',
                    'ELIMINACION DE EXCRETAS',
                    'CUANTAS HABITACIONES HAY EN HOGAR',
                    'ENERGIA ELECTRICA(EE)',
                    'NIVEL DE INSTRUCCION DE LA MADRE',
                    'OCUPACION JEFE DE LA FAMILIA',
                    'INGRESOS FAMILIARES',
                    'NRO DE PERSONAS X DORMITORIO');

    foreach ($array as $value) {
        $data = explode('-', $value);
        $socioeconomico->agregarSocioEconomico($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsocioeconomico', 'socioeconomico'), $_REQUEST[idfamilia], $data[0], $data[1], $data[2]);
    }
}

?>

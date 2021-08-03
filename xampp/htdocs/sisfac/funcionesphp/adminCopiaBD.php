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

require_once '../clases/claseCopiaBD.php';
$copia = new ClaseCopiaBD();

if($_REQUEST['f'] == 1) {
    $nombrearchivo = "backup/COPIABD_".date("Y_M_d_H_i_s").".txt";
    $contenido = $copia->exportarBD();
    $fp = fopen($nombrearchivo,"x");
    fwrite($fp,$contenido);
    fclose($fp);
    echo $nombrearchivo;
}
?>
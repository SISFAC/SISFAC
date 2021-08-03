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

include_once("../clases/mysql.class.inc.php");
include_once("../clases/config.php");

require_once '../clases/claseHistorial.php';

$historial = new Historial();
$historial->limpiarHistorialCompleto();


if(isset($_POST['action_backup'])){
    $backup = new MyBackUp(); //creating an object of MyBackUp
    //FILENAME GENERATION
    //UNIQUE FILE NAME GENERATION TO SET ONE BACKUP A DAY. Change the date function to time if you need more than on file per day. 
    $backup->filename = $backUpFolder."/".$server['database']."_".date("Y_M_d").".sql";
    $nombrearchivo = $backup->filename;
    //Calling generator Function
    if(!$backup->BackUp()) $error='true';
    else $error='false';
}
//recuperar el nombre de la base de datos
echo $nombrearchivo;

?>
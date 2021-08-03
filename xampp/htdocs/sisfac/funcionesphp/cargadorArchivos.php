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

include '../conexion/Conexion.php';
include '../upgrade.php';
$cnn = new Conexion();
$cnn->abrirConexion();

require_once '../clases/claseCopiaBD.php';
$copia = new ClaseCopiaBD();

$uploaddir = '../funcionesphp/importacion/';
$uploadfile = $uploaddir .basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    $contenido = file_get_contents($uploadfile);
    $array = explode('**',$contenido);
    $notin = $copia->obtenerClavesGenerales();

    foreach ($array as $value) {
        $copia->importarBD($value, $notin);
    }

    $copia->insertarAcopio($notin);
 
    if(needToUpgrade()){

        upgrade();
    }      

}
else {
    echo "error";
}


?>
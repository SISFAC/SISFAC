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

require_once '../clases/claseImportarCSV.php';
$csv = new CSV();

if($_REQUEST['f'] == 1) {
    
    $array = array($_REQUEST[tabla]=>$_REQUEST[archivo]);
    foreach ($array as $tabla => $archivo) {
		mysql_query("TRUNCATE $tabla");
        $result = mysql_query("SELECT * FROM $tabla");
        $nroCampos = mysql_num_fields($result);
        $values = "";
        for ($i = 0; $i < $nroCampos; $i++) {
            $values .= "'$"."data[$i]',";
        }
        $values = substr($values, 0, -1);
        $handle = fopen("../app/catalogos/$archivo", "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            //Insertamos los datos con los valores...
            eval("\$valores = \"$values\";");
            $sql = "INSERT IGNORE INTO $tabla VALUES(".$valores.")";
            mysql_query($sql);// or die(mysql_error());
        }
        //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
        fclose($handle);
    }
}
?>

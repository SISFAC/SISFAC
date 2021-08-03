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

require_once '../clases/claseGenerarParche.php';
$generarParche = new GenerarParche();

if($_REQUEST['f'] == 1) {
    
    //$db_record = $_REQUEST[tabla];
    
    $array = explode('+', $_REQUEST[tabla]);
    foreach ($array as $tabla) {
        $where = 'WHERE 1 ORDER BY 1';

        $csv_export = '';

        $query = mysql_query("SELECT * FROM $tabla $where");
        $field = mysql_num_fields($query);
        // crea los nombres de los campos
        /*for($i = 0; $i < $field; $i++) {
          $csv_export.= mysql_field_name($query,$i).';';
        }*/
        // newline (seems to work both on Linux & Windows servers)
        $csv_export.= '';

        while($row = mysql_fetch_array($query)) {
          for($i = 0; $i < $field; $i++) {
            $csv_export.= '"'.$row[mysql_field_name($query,$i)].'"';
            if($i!=$field-1) $csv_export.= ',';
          }	
          $csv_export.= '
';	
        }

        $nombrearchivo = "parche/".strtoupper($tabla).".csv";
        if (!file_exists($nombrearchivo)) $fp = fopen($nombrearchivo,"x");
        else $fp = fopen($nombrearchivo,"w+");

        fwrite($fp,$csv_export);
        fclose($fp);
    }    
}
/*
if($_REQUEST['f'] == 1) {
    $contenido = "
    <?php
        include '../../conexion/Conexion.php';
        \$cnn = new Conexion();
        \$cnn->abrirConexion();
        echo 'Se importo correctamente';
        ";
    $array = explode('+', $_REQUEST[tabla]);
    foreach ($array as $tabla) {
        $temp .="mysql_query(\"TRUNCATE TABLE $tabla\");";
        $consulta = $generarParche->obtenerTablaMaestra($tabla);
        $temp .="mysql_query(\"$consulta\");";
    }
    
    $contenido .= "
        $temp;
        \$cnn->cerrarConexion();
        ?>";
    $nombrearchivo = "parche/parche.php";
    if (!file_exists($nombrearchivo)) $fp = fopen($nombrearchivo,"x");
    else $fp = fopen($nombrearchivo,"w+");
    
    fwrite($fp,$contenido);
    fclose($fp);
    
}*/

?>
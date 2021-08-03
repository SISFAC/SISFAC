<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


Importante: En caso se hubiese copiado código desde otros programas cubiertos por la misma licencia, será necesario también copiar sus avisos de copyright. En caso se presente dicho supuesto, se debe poner juntos todos los avisos de copyright de un archivo (propio y de terceros), en la parte inicial de éste.

*/
session_start();
include '../conexion/conexion.php';
//if(!isset($_SESSION['idusu'])) header("location:/sisfac/");
$cnn = new Conexion(); 
global $cnn;
$cnn->abrirConexion();


mysql_query("CREATE DATABASE IF NOT EXISTS bdsicfic");
echo mysql_error();

$result = mysql_query("SHOW FULL TABLES FROM bdsicfic") ;
while ($row = mysql_fetch_array($result)) {
    mysql_query("DROP TABLE IF EXISTS $row[0]");
    echo mysql_error();
}
/*
mysql_query("DROP TABLE IF EXISTS   ciclo");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS cicloh ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS comunidad ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS condicion ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS condicionh ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS datogeneral ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS diresa ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS distrito ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS entorno ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS entornoh ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS establecimiento ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS familia ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS familiah ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS microred ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS nucleo ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS persona ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS personah ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS provincia ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS red ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS region ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS riesgo ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS riesgoh ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS sector ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS socioeconomico ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS socioeconomicoh ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS trabajador ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS trabajadorsector ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS usuario ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS visita ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS visitah ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS vista ");
echo mysql_error();
mysql_query("DROP TABLE IF EXISTS vistausuario ");
echo mysql_error();
*/
function SplitSQL($file, $delimiter = ';'){
    set_time_limit(0);
    if(is_file($file) === true){
        $file = fopen($file, 'r');
        if (is_resource($file) === true){
            $query = array();
            while (feof($file) === false){
                $query[] = fgets($file);
                if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1){
                    $query = trim(implode('', $query));
                    if (mysql_query($query) === false){
                        echo '<h3>ERROR: ' . $query . '</h3>' . "\n";
                    }
                    else{
                        echo '<h3>SUCCESS: ' . $query . '</h3>' . "\n";
                    }
                    while (ob_get_level() > 0){
                        ob_end_flush();
                    }
                    flush();
                }
                if (is_string($query) === true){
                    $query = array();
                }
            }
            return fclose($file);
        }
    }
    return false;
}

$uploaddir = '../funcionesphp/importacion/';
$uploadfile = $uploaddir .basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

    $str = file_get_contents($uploadfile);

    $str = str_replace("InnoDB", "MyISAM", $str);

    file_put_contents($uploadfile, $str);
   
    SplitSQL($uploadfile);
}
else {
    //echo "error";
}

$cnn->cerrarConexion();
?>

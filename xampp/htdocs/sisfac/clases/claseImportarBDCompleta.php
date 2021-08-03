<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once '../conexion/Conexion.php';
class ImportarBDCompleta {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function SplitSQL($file, $delimiter = ';'){
        set_time_limit(0);
        if (is_file($file) === true){
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
    
}

/*
 * 
 * $result = mysql_query("SELECT campoA, campoB, campoC FROM tablaA")
while($row = fetc)
$sql .= "INSERT INTO TABLAUNIDA_A(codigociudad, id, campoA, campoB, campoC) VALUES ('C005','$row[id]', '$row[campoA]', '$row[campoB]', '$row[campoC]');"
 */
?>
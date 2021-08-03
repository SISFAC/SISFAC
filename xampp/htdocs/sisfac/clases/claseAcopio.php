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
class Acopio {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function get(){

      
        $query = "select idacopio, clavegeneral, fecha, nombreestablecimiento from acopio order by fecha desc";
        $result = mysql_query($query);
        
        $content = '';
         
        while ($row = mysql_fetch_row($result)) {
                $content .= '<tr><td style="border-bottom:1px solid #ccc;padding:10px">'.$row[0].'</td><td style="border-bottom:1px solid #ccc;padding:10px">'.$row[1].'</td><td style="border-bottom:1px solid #ccc;padding:10px">'.$row[2].'</td><td style="border-bottom:1px solid #ccc;padding:10px">'.$row[3].'</td></tr>';
        }
            
        return $content;

    }
    
}
?>
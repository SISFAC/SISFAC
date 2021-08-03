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
class Profesion {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    
    public function mostrarProfesionCombobox($codigoColegio, $select){
        
        $query = "SELECT nivel FROM establecimiento WHERE claveGeneral = '$_SESSION[claveGeneral]'";
        $nivel = mysql_fetch_array(mysql_query($query));
        //echo $query;
        if($nivel==1) $wh .= " AND primer_nivel = 1";
        else if($nivel==2) $wh .= " AND segundo_nivel = 1";
        else if($nivel==3) $wh .= " AND tercer_nivel = 1";
        else $wh .= " AND primer_nivel = 1";
        
        if($codigoColegio!='') $wh .= " AND codigoColegio = '$codigoColegio'";
        $query = "SELECT idprofesion , codigoColegio, codigoProfesion, nombre FROM profesion WHERE 1 = 1 $wh ORDER BY codigoProfesion";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]' codigoProfesion = '$row[2]'>$row[3]</option>";
        }
        if($select) echo "</select>";
    }
    
    
}
?>
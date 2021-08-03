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
class GenerarParche {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function obtenerTablaMaestra($tabla) {
        $querycampos = "DESCRIBE $tabla";
        $resultcampos = mysql_query($querycampos);
        while ($rowcampos = mysql_fetch_array($resultcampos)) {
            $campos .= "$coma $rowcampos[0]";
            $arraycampos[] = "$rowcampos[0]";
            $nrocampos++;
            $coma=",";
        }
        $coma = "";

        $querydatos = "SELECT $campos FROM $tabla ORDER BY id$tabla asc";
        $resultdatos = mysql_query($querydatos);
        $tregistros = mysql_num_rows($resultdatos);
        //mysql_query("TRUNCATE TABLE $tabla");
        if($tregistros) $contenido .= "INSERT INTO $tabla($campos) VALUES ";
        $j=0;
        while ($rowdatos = mysql_fetch_array($resultdatos)) {
            $datos=$coma=$coma1="";
            for ($i = 0; $i < $nrocampos; $i++) {
                $datos.=$coma."'".$rowdatos[$arraycampos[$i]]."'";
                $coma=",";
            }
            if($j==$tregistros-1) $coma1=";";
            else $coma1=",";
            $contenido .= " ($datos)$coma1 ";
            $j++;
        }

        $nrocampos=0;
        $campos=$coma="";
        unset($arraycampos);
        $campos=$coma="";
        
        return $contenido;
    }
    
}
?>
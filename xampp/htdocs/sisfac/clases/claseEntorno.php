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
class Entorno {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function obtenerMaximoEntorno(){
        $query = "SELECT MAX(identorno) FROM entorno";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    
    public function agregarEntorno($claveGeneral, $identorno, $idfamilia, $tipo, $descripcion, $codentorno){
        $data = verificarDatos( 'add', array('claveGeneral' => $claveGeneral, 'identorno' => $identorno, 'idfamilia'=>$idfamilia, 'tipo'=>$tipo, 'descripcion'=>$descripcion, 'codentorno'=>$codentorno));
        if($data[0]!=''){
            $query = "INSERT INTO entorno($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function eliminarEntorno($idfamilia, $claveGeneral){
        $query = "DELETE FROM entorno WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function obtenerEntornoVector($idfamilia,$claveGeneral){
        $temp = array(0);
        $query = "SELECT codentorno,tipo,descripcion FROM entorno WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        //echo $query;
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $temp[] = $row[0];
        }
        return implode('-', $temp);
    }
    
    public function obtenerEntornoCanes($idfamilia,$claveGeneral){
        $query = "SELECT descripcion FROM entorno WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral' AND tipo = 'NUMERO DE CANES'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function buscarEntornoIdfamiliaCodEntrono($idfamilia,$codentorno){
        $query = "SELECT COUNT(*) FROM entorno WHERE idfamilia = '$idfamilia' AND codentorno= '$codentorno' AND claveGeneral = '$_SESSION[claveGeneral]'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }

}
?>
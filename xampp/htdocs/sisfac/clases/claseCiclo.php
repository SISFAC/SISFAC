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
class Ciclo {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function agregarCiclo($claveGeneral, $idciclo, $idfamilia, $codigoCiclo, $nombreCiclo){
        $data = verificarDatos( 'add', array('claveGeneral'=>$claveGeneral, 'idciclo'=>$idciclo,'idfamilia'=>$idfamilia, 'codigoCiclo'=>$codigoCiclo, 'nombreCiclo'=>$nombreCiclo));
        if($data[0]!=''){
            $query = "INSERT INTO ciclo($data[0]) VALUES($data[1])";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function obtenerCicloVector($idfamilia,$claveGeneral){
        $temp = array(0);
        $query = "SELECT codigoCiclo,nombreCiclo FROM ciclo WHERE idfamilia = '$idfamilia' AND claveGeneral = '$claveGeneral'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $temp[] = $row[0].'+'.$row[1];
        }
        return implode('-', $temp);
    }
    
    public function buscarCicloIdfamiliaCodEntrono($idfamilia,$codciclo,$claveGeneral){
        $query = "SELECT COUNT(*) FROM ciclo WHERE idfamilia = '$idfamilia' AND codigoCiclo= '$codciclo' AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function buscarIdCicloFamilia($idfamilia,$codciclo){
        $query = "SELECT idciclo FROM ciclo WHERE idfamilia = '$idfamilia' AND codigoCiclo= '$codciclo'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function eliminarCicloFamilia($idfamilia, $claveGeneral){
        mysql_query("DELETE FROM ciclo WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'");
    }
    
}
?>
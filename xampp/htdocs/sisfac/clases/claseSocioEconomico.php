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

class SocioEconomico {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function agregarSocioEconomico($claveGeneral, $idsocioeconomico, $idfamilia, $tipo, $descripcion, $puntaje){
        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral, 'idsocioeconomico'=>$idsocioeconomico,'idfamilia'=>$idfamilia, 'tipo'=>$tipo, 'descripcion'=>$descripcion, 'puntaje'=>$puntaje));
        if($data[0]!=''){
            $query = "INSERT INTO socioeconomico($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function elimiarSocioEconomico($idfamilia, $claveGeneral){
        $query = "DELETE FROM socioeconomico WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function obtenerMaximoSocioeconomico() {
        $query = "SELECT MAX(idsocioeconomico) FROM socioeconomico";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function obtenerSocioEconomicoVector($idfamilia,$claveGeneral){
        $query = "SELECT descripcion FROM socioeconomico WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral' order by idsocioeconomico asc";

        $temp = [];

        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $temp[] = $row[0];
        }
        return implode('-',$temp);
    }
    
    public function buscarSocioEconomico($idfamilia, $descripcion){
        $query = "SELECT COUNT(*) FROM socioeconomico WHERE idfamilia = $idfamilia AND descripcion = '$descripcion' AND claveGeneral = '$_SESSION[claveGeneral]'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
}
    

?>

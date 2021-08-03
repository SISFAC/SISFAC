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
class PlantaMedicinal {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarPlantaMedicinalVector($idepisodio, $claveGeneral){
        $row = mysql_fetch_array(mysql_query("SELECT idplantaMedicinal, planta FROM plantaMedicinal WHERE idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'"));
        return $row[0].'+'.$row[1];
    }
    public function agregarPlantaMedicinal($idplantaMedicinal, $claveGeneral, $idepisodio, $planta){
        $data = verificarDatos('add', array('idplantaMedicinal'=>$idplantaMedicinal,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio, 'planta'=>$planta));
        if($data[0]!=''){
            $query = "INSERT INTO plantaMedicinal($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarPlantaMedicinal($idplantaMedicinal, $claveGeneral, $idepisodio, $planta){
        $data = verificarDatos('edit', array('idplantaMedicinal'=>$idplantaMedicinal,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio, 'planta'=>$planta));
        if($data[0]!=''){
            $query = "UPDATE plantaMedicinal SET $data[0] WHERE idplantaMedicinal = $idplantaMedicinal AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarPlantaMedicinal($id, $claveGeneral){
        $query = "DELETE FROM plantaMedicinal WHERE idplantaMedicinal = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
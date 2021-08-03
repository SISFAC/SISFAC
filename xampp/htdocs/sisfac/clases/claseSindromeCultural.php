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
class SindromeCultural {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function agregar($claveGeneral, $idsindromecultural, $idfamilia, $idpersona, $codigo, $nombre){


        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral, 'idsindromecultural'=>$idsindromecultural, 'idfamilia'=>$idfamilia,'idpersona'=>$idpersona,'codigo'=>$codigo,'nombre'=>$nombre));
        if($data[0]!=''){
            $query = "INSERT INTO sindromecultural($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function buscarCodigo($claveGeneral, $idpersona, $codigo){
        $query = "SELECT COUNT(*) FROM sindromecultural WHERE idpersona = $idpersona AND codigo = $codigo AND claveGeneral = '$claveGeneral'";

        $r = mysql_query($query);
        if($r){
            $row = mysql_fetch_array($r);
            return $row[0];
        }
        return "0";
    }
    
    public function obtenerVector($claveGeneral, $idpersona){
        $query = "SELECT codigo FROM sindromecultural WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'";
        $result = mysql_query($query);
        $temp = [];
        while ($row = mysql_fetch_array($result)) {
            $temp[] = $row[0];
        }

        return implode('-',$temp);
    }
    
    public function eliminar($claveGeneral, $codigo, $idpersona, $idfamilia){
        $query = "DELETE FROM sindromecultural WHERE codigo = $codigo AND claveGeneral = '$claveGeneral' AND idpersona = $idpersona AND idfamilia = $idfamilia";
        mysql_query($query);
        echo $query;
    }
}
?>
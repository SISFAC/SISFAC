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
class Condicion {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function agregarCondicion($claveGeneral, $idcondicion, $idfamilia, $idpersona, $codigoCondicion, $nombreCondicion){


        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral, 'idcondicion'=>$idcondicion, 'idfamilia'=>$idfamilia,'idpersona'=>$idpersona,'codigoCondicion'=>$codigoCondicion,'nombreCondicion'=>$nombreCondicion));
        echo "agregarCondicion<br>";
        if($data[0]!=''){
            $query = "INSERT INTO condicion($data[0]) VALUES($data[1])";
            echo "$query<br>";
            mysql_query($query);
        }
    }
    
    public function buscarCodigoCondicion($claveGeneral, $idpersona, $codigoCondicion){

        $query = "SELECT COUNT(*) FROM condicion WHERE idpersona = $idpersona AND codigoCondicion = $codigoCondicion AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function obtenerCondicionVector($claveGeneral, $idpersona, $idfamilia){
        $query = "SELECT codigoCondicion FROM condicion WHERE idpersona = $idpersona AND idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        $result = mysql_query($query);
        
        while ($row = mysql_fetch_array($result)) {
            $temp[] = $row[0];
        }

        return implode('-',$temp);
    }
    
    public function eliminarCondicion($claveGeneral, $codigoCondicion, $idpersona, $idfamilia){
        $query = "DELETE FROM condicion WHERE codigoCondicion = $codigoCondicion AND claveGeneral = '$claveGeneral' AND idpersona = $idpersona AND idfamilia = $idfamilia";
        mysql_query($query);
    }
}
?>
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
class AntecedenteGinecobstetrico {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function obtenerAntecedenteGinecobstetricoVector($idpersona, $claveGeneral) {
        $row = mysql_fetch_array(mysql_query("SELECT idantecedenteGinecobstetrico, nroGestacion, paridad, periodoIntergenesico FROM antecedenteGinecobstetrico WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'"));
        return $row[0].'-'.$row[1].'-'.$row[2].'-'.$row[3];
    }
    
    public function obtenerAntecedenteGinecobstetrico($idpersona, $claveGeneral){
        $row = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM antecedenteGinecobstetrico WHERE idpersona = '$idpersona' AND claveGeneral = '$claveGeneral'"));
        return $row[0];
    }
    
    public function mostrarAntecedenteGinecobstetricoCombobox($select){
        $query = "SELECT idantecedenteGinecobstetrico, claveGeneral, idpersona, nroGestacion, paridad, periodoIntergenesico FROM tabla WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarAntecedenteGinecobstetrico($idantecedenteGinecobstetrico, $claveGeneral, $idpersona, $nroGestacion, $paridad, $periodoIntergenesico){
        $data = verificarDatos('add', array('idantecedenteGinecobstetrico'=>$idantecedenteGinecobstetrico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'nroGestacion'=>$nroGestacion, 'paridad'=>$paridad, 'periodoIntergenesico'=>$periodoIntergenesico));
        if($data[0]!=''){
            $query = "INSERT INTO antecedenteGinecobstetrico($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarAntecedenteGinecobstetrico($idantecedenteGinecobstetrico, $claveGeneral, $idpersona, $nroGestacion, $paridad, $periodoIntergenesico){
        $data = verificarDatos('edit', array('idantecedenteGinecobstetrico'=>$idantecedenteGinecobstetrico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'nroGestacion'=>$nroGestacion, 'paridad'=>$paridad, 'periodoIntergenesico'=>$periodoIntergenesico));
        if($data[0]!=''){
            $query = "UPDATE antecedenteGinecobstetrico SET $data[0] WHERE idantecedenteGinecobstetrico = $idantecedenteGinecobstetrico AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarAntecedenteGinecobstetrico($idantecedenteGinecobstetrico, $claveGeneral){
        $query = "DELETE FROM antecedenteGinecobstetrico WHERE id = $idantecedenteGinecobstetrico AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
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
class AntecedenteFisiologico{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarAntecedenteFisiologico($idpersona, $claveGeneral) {
        $query = "SELECT idantecedenteFisiologico, claveGeneral, idpersona, alimentacionMes, alimentacion, higieneDental, revisionDental, fechaVisitaDental, opcionActividadFisica, frecuenciaActividadFisica, nroVecesActividadFisica
                FROM antecedenteFisiologico WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'+'.$row[1].'+'.$row[2].'+'.$row[3].'+'.$row[4].'+'.$row[5].'+'.$row[6].'+'.$row[7].'+'.$row[8].'+'.$row[9].'+'.$row[10].'+'.$row[11].'+'.$row[12];
    }
    
    public function agregarAntecedenteFisiologico($idantecedenteFisiologico, $claveGeneral, $idpersona, $alimentacionMes, $alimentacion, $higieneDental, $revisionDental, $fechaVisitaDental, $opcionActividadFisica, $frecuenciaActividadFisica, $nroVecesActividadFisica){
        $data = verificarDatos('add', array('idantecedenteFisiologico'=>$idantecedenteFisiologico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'alimentacionMes'=>$alimentacionMes, 'alimentacion'=>$alimentacion, 'higieneDental'=>$higieneDental, 'revisionDental'=>$revisionDental, 'fechaVisitaDental'=>$fechaVisitaDental, 'opcionActividadFisica'=>$opcionActividadFisica, 'frecuenciaActividadFisica'=>$frecuenciaActividadFisica, 'nroVecesActividadFisica'=>$nroVecesActividadFisica));
        if($data[0]!=''){
            $query = "INSERT INTO antecedenteFisiologico($data[0]) VALUES($data[1])";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function actualizarAntecedenteFisiologico($idantecedenteFisiologico, $claveGeneral, $idpersona, $alimentacionMes, $alimentacion, $higieneDental, $revisionDental, $fechaVisitaDental, $opcionActividadFisica, $frecuenciaActividadFisica, $nroVecesActividadFisica){
        $data = verificarDatos('edit', array('idantecedenteFisiologico'=>$idantecedenteFisiologico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'alimentacionMes'=>$alimentacionMes, 'alimentacion'=>$alimentacion, 'higieneDental'=>$higieneDental, 'revisionDental'=>$revisionDental, 'fechaVisitaDental'=>$fechaVisitaDental, 'opcionActividadFisica'=>$opcionActividadFisica, 'frecuenciaActividadFisica'=>$frecuenciaActividadFisica, 'nroVecesActividadFisica'=>$nroVecesActividadFisica));
        if($data[0]!=''){
            $query = "UPDATE antecedenteFisiologico SET $data[0] WHERE idantecedenteFisiologico = $idantecedenteFisiologico AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function eliminarAntecedenteFisiologico($id,$claveGeneral){
        $query = "DELETE FROM antecedenteFisiologico WHERE idAntecedenteFisiologico = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
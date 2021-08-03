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
class VariableAntropometrica {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarVariablesAntropometricasDatagrid($idpersona, $claveGeneral){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = "";
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'campo':
                        $wh .= " AND $k iLIKE '%$v%'";
                        break;
                }
            }
        }
        $query="SELECT COUNT(*) FROM variableAntropometrica van INNER JOIN episodio epi ON van.idepisodio=epi.idepisodio AND van.claveGeneral=epi.claveGeneral 
                WHERE epi.idpersona = $idpersona AND epi.claveGeneral = '$claveGeneral' $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idvariableAntropometrica, epi.fechaInicio,peso, talla, IMC, perimetroCefalico, perimetroToracico, frecuenciaCardiaca, frecuenciaRespiratoria, temperatura, presionArterialNum, presionArterialDenom, presionArterialMediaNum, presionArterialMediaDenom, perimetroAbdominal, pesoPregestacional, FUR, FPP, presionArterialBasalNum, presionArterialBasalDenom, factorRiesgo
                FROM variableAntropometrica van INNER JOIN episodio epi ON van.idepisodio=epi.idepisodio AND van.claveGeneral=epi.claveGeneral 
                WHERE epi.idpersona = $idpersona AND epi.claveGeneral = '$claveGeneral' $wh ORDER BY $sidx $sord LIMIT $start,$limit";
       //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function agregarVariableAntropometrica($idvariableAntropometrica, $claveGeneral, $idepisodio, $peso, $talla, $IMC, $perimetroCefalico, $perimetroToracico, $frecuenciaCardiaca, $frecuenciaRespiratoria, $temperatura, $presionArterialNum, $presionArterialDenom, $presionArterialMediaNum, $presionArterialMediaDenom, $perimetroAbdominal, $pesoPregestacional, $FUR, $FPP, $presionArterialBasalNum, $presionArterialBasalDenom, $factorRiesgo){
        $data = verificarDatos('add', array(
            'idvariableAntropometrica'=>$idvariableAntropometrica, 
            'claveGeneral'=>$claveGeneral, 
            'idepisodio'=>$idepisodio, 
            'peso'=>$peso, 
            'talla'=>$talla, 
            'IMC'=>$IMC, 
            'perimetroCefalico'=>$perimetroCefalico, 
            'perimetroToracico'=>$perimetroToracico, 
            'frecuenciaCardiaca'=>$frecuenciaCardiaca, 
            'frecuenciaRespiratoria'=>$frecuenciaRespiratoria, 
            'temperatura'=>$temperatura, 
            'presionArterialNum'=>$presionArterialNum, 
            'presionArterialDenom'=>$presionArterialDenom, 
            'presionArterialMediaNum'=>$presionArterialMediaNum, 
            'presionArterialMediaDenom'=>$presionArterialMediaDenom, 
            'perimetroAbdominal'=>$perimetroAbdominal, 
            'pesoPregestacional'=>$pesoPregestacional, 
            'FUR'=>$FUR, 
            'FPP'=>$FPP, 
            'presionArterialBasalNum'=>$presionArterialBasalNum, 
            'presionArterialBasalDenom'=>$presionArterialBasalDenom, 
            'factorRiesgo'=>$factorRiesgo
        ));
        if($data[0]!=''){
            $query = "INSERT INTO variableAntropometrica($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarVariableAntropometrica($idvariableAntropometrica, $claveGeneral, $idepisodio, $peso, $talla, $IMC, $perimetroCefalico, $perimetroToracico, $frecuenciaCardiaca, $frecuenciaRespiratoria, $temperatura, $presionArterialNum, $presionArterialDenom, $presionArterialMediaNum, $presionArterialMediaDenom, $perimetroAbdominal, $pesoPregestacional, $FUR, $FPP, $presionArterialBasalNum, $presionArterialBasalDenom, $factorRiesgo){
        $data = verificarDatos('edit', array(
            'idvariableAntropometrica'=>$idvariableAntropometrica, 
            'claveGeneral'=>$claveGeneral, 
            'idepisodio'=>$idepisodio, 
            'peso'=>$idepisodio, 
            'talla'=>$talla, 
            'IMC'=>$IMC, 
            'perimetroCefalico'=>$perimetroCefalico, 
            'perimetroToracico'=>$perimetroToracico, 
            'frecuenciaCardiaca'=>$frecuenciaCardiaca, 
            'frecuenciaRespiratoria'=>$frecuenciaRespiratoria, 
            'temperatura'=>$temperatura, 
            'presionArterialNum'=>$presionArterialNum, 
            'presionArterialDenom'=>$presionArterialDenom, 
            'presionArterialMediaNum'=>$presionArterialMediaNum, 
            'presionArterialMediaDenom'=>$presionArterialMediaDenom, 
            'perimetroAbdominal'=>$perimetroAbdominal, 
            'pesoPregestacional'=>$pesoPregestacional, 
            'FUR'=>$FUR, 
            'FPP'=>$FPP, 
            'presionArterialBasalNum'=>$presionArterialBasalNum, 
            'presionArterialBasalDenom'=>$presionArterialBasalDenom, 
            'factorRiesgo'=>$factorRiesgo
        )); 
        if($data[0]!=''){
            $query = "UPDATE variableAntropometrica SET $data[0] WHERE idvariableAntropometrica = $idvariableAntropometrica AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarVariableAntropometrica($id, $claveGeneral){
        $query = "DELETE FROM variableAntropometrica WHERE idvariableAntropometrica = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
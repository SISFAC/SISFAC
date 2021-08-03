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
class Diagnostico {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarDiagnosticoDatagrid($idepisodio, $opReferencia, $claveGeneral){
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
        
        
        if($idepisodio != '') $wh.=" AND idepisodio = $idepisodio";
        if($claveGeneral != '') $wh.=" AND claveGeneral = '$claveGeneral'";
        if($opReferencia != '') $wh.=" AND opReferencia = '$opReferencia'";
        
        
        $query="SELECT COUNT(*) FROM diagnostico WHERE 1=1 $wh ";
        
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT iddiagnostico, idcatalogoCIE10, nombreCatalogo, variableLab, observacion, opcionPacienteEst, opcionPacienteServ, tipo, opReferencia 
                FROM diagnostico WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    
    public function agregarDiagnostico($iddiagnostico, $claveGeneral, $idepisodio, $idcatalogoCIE10, $nombreCatalogo, $variableLab, $observacion, $opcionPacienteEst, $opcionPacienteServ, $tipo, $opReferencia){
        $data = verificarDatos('add', array(
            'iddiagnostico'=>$iddiagnostico, 
            'claveGeneral'=>$claveGeneral, 
            'idepisodio'=>$idepisodio, 
            'idcatalogoCIE10'=>$idcatalogoCIE10, 
            'nombreCatalogo'=>$nombreCatalogo, 
            'variableLab'=>$variableLab, 
            'observacion'=>$observacion, 
            'opcionPacienteEst'=>$opcionPacienteEst, 
            'opcionPacienteServ'=>$opcionPacienteServ, 
            'tipo'=>$tipo, 
            'opReferencia'=>$opReferencia
        ));
        if($data[0]!=''){
            $query = "INSERT INTO diagnostico($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarDiagnostico($iddiagnostico, $claveGeneral, $idepisodio, $idcatalogoCIE10, $nombreCatalogo, $variableLab, $observacion, $opcionPacienteEst, $opcionPacienteServ, $tipo, $opReferencia){
        $data = verificarDatos('edit', array(
            'iddiagnostico'=>$iddiagnostico, 
            'claveGeneral'=>$claveGeneral, 
            'idepisodio'=>$idepisodio, 
            'idcatalogoCIE10'=>$idcatalogoCIE10, 
            'nombreCatalogo'=>$nombreCatalogo, 
            'variableLab'=>$variableLab, 
            'observacion'=>$observacion, 
            'opcionPacienteEst'=>$opcionPacienteEst, 
            'opcionPacienteServ'=>$opcionPacienteServ, 
            'tipo'=>$tipo, 
            'opReferencia'=>$opReferencia
        )); 
        if($data[0]!=''){
            $query = "UPDATE diagnostico SET $data[0] WHERE iddiagnostico = $iddiagnostico AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarDiagnostico($id, $claveGeneral){
        $query = "DELETE FROM diagnostico WHERE iddiagnostico = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        echo $query;
    }
}
?>
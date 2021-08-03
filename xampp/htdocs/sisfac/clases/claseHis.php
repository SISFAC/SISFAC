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
class His{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarHisDatagrid($idepisodio, $claveGeneral){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = '';
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'campo':
                        
                        break;
                }
            }
        }
        
        if($idepisodio!='') $wh.=" AND idepisodio = $idepisodio";
        if($claveGeneral!='') $wh.=" AND claveGeneral = '$claveGeneral'";
        
        $query="SELECT COUNT(*) FROM his WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idHIS,claveGeneral,tipoCatalogo,idcatalogo,nombreCatalogo,variableLAB,tipoDiagnostico,opPacienteEst,opPacienteServ 
                FROM his WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start, $limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarHisVector($idHIS,$claveGeneral){
        $query = "SELECT idHIS,claveGeneral,idepisodio,tipoCatalogo,idcatalogo,nombreCatalogo,variableLAB,tipoDiagnostico,opPacienteEst,opPacienteServ FROM his WHERE idHIS = '$idHIS' AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idHIS'].'+'.$row['claveGeneral'].'+'.$row['idepisodio'].'+'.$row['tipoCatalogo'].'+'.$row['idcatalogo'].'+'.$row['nombreCatalogo'].'+'.$row['variableLAB'].'+'.$row['tipoDiagnostico'].'+'.$row['opPacienteEst'].'+'.$row['opPacienteServ'];
    }

    public function mostrarHisCombobox($select){
        $query = "SELECT idHIS,claveGeneral,idepisodio,tipoCatalogo,idcatalogo,nombreCatalogo,variableLAB,tipoDiagnostico,opPacienteEst,opPacienteServ FROM his WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarHis($idHIS,$claveGeneral,$idepisodio,$tipoCatalogo,$idcatalogo,$nombreCatalogo,$variableLAB,$tipoDiagnostico,$opPacienteEst,$opPacienteServ){
        $data = verificarDatos('add', array('idHIS'=>$idHIS,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio,'tipoCatalogo'=>$tipoCatalogo,'idcatalogo'=>$idcatalogo,'nombreCatalogo'=>$nombreCatalogo,'variableLAB'=>$variableLAB,'tipoDiagnostico'=>$tipoDiagnostico,'opPacienteEst'=>$opPacienteEst,'opPacienteServ'=>$opPacienteServ));
        if($data[0]!=''){
            $query = "INSERT INTO his($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarHis($idHIS,$claveGeneral,$idepisodio,$tipoCatalogo,$idcatalogo,$nombreCatalogo,$variableLAB,$tipoDiagnostico,$opPacienteEst,$opPacienteServ){
        $data = verificarDatos('edit', array('idHIS'=>$idHIS,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio,'tipoCatalogo'=>$tipoCatalogo,'idcatalogo'=>$idcatalogo,'nombreCatalogo'=>$nombreCatalogo,'variableLAB'=>$variableLAB,'tipoDiagnostico'=>$tipoDiagnostico,'opPacienteEst'=>$opPacienteEst,'opPacienteServ'=>$opPacienteServ)); 
        if($data[0]!=''){
            $query = "UPDATE his SET $data[0] WHERE idHIS = '$idHIS' AND claveGeneral = '$claveGeneral' ";
            mysql_query($query);
        }
    }
    
    public function eliminarHis($idHIS,$claveGeneral){
        $query = "DELETE FROM his WHERE idHIS = '$idHIS' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

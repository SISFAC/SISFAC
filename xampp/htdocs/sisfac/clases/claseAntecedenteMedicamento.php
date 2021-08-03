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
class AntecedenteMedicamento {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarMedicamentoDatagrid($idpersona, $claveGeneral){
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
        $query="SELECT COUNT(*) FROM antecedenteMedicamento WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral' $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idantecedenteMedicamento, tipoMedicamento, medicacion, tiempoUso 
        FROM antecedenteMedicamento WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral' $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //secho $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCombobox($select){
        $query = "SELECT campo FROM tabla WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarAntecedenteMedicamento($idantecedenteMedicamento, $claveGeneral, $idpersona, $tipoMedicamento, $medicacion, $tiempoUso){
        $data = verificarDatos('add', array('idantecedenteMedicamento'=>$idantecedenteMedicamento, 'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipoMedicamento'=>$tipoMedicamento, 'medicacion'=>$medicacion, 'tiempoUso'=>$tiempoUso));
        if($data[0]!=''){
            $query = "INSERT INTO antecedenteMedicamento($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarAntecedenteMedicamento($idantecedenteMedicamento, $claveGeneral, $idpersona, $tipoMedicamento, $medicacion, $tiempoUso){
        $data = verificarDatos('edit', array('idantecedenteMedicamento'=>$idantecedenteMedicamento, 'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipoMedicamento'=>$tipoMedicamento, 'medicacion'=>$medicacion, 'tiempoUso'=>$tiempoUso));
        if($data[0]!=''){
            $query = "UPDATE antecedenteMedicamento SET $data[0] WHERE idantecedenteMedicamento = $idantecedenteMedicamento AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarAntecedenteMedicamento($id, $claveGeneral){
        $query = "DELETE FROM antecedenteMedicamento WHERE idantecedenteMedicamento = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
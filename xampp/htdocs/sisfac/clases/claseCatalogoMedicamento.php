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
class CatalogoMedicamento{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoMedicamentoDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoMedicamento WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoMedicamento,CONCAT(codigoMedicamento,'-',codigoATC,'-',nombreMedicamento) as cod FROM catalogoMedicamento WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoMedicamentoVector($filtro, $limit){
        $query = "SELECT idcatalogoMedicamento,CONCAT(codigoMedicamento,'-',codigoATC,'-',nombreMedicamento,'/',concentracion) as cod
                    FROM catalogoMedicamento WHERE CONCAT(codigoMedicamento,'-',codigoATC,'-',nombreMedicamento,'/',concentracion) LIKE '%$filtro%'";
        //echo $query;
        $result = mysql_query($query);
        $catalogo = array();
        while($row = mysql_fetch_array($result)){
            array_push($catalogo, array("value"=>$row[0],"label"=>$row[1]));
            if(count($catalogo)>$limit) break;
        }
        
        return array_to_json($catalogo);
    }

    public function mostrarCatalogoMedicamentoCombobox($select){
        $query = "SELECT idcatalogoMedicamento,codigoMedicamento,nombreMedicamento,concentracion,formulaF,titular,fechaAutorizacion,fechaVencimiento,fabricante,pais,condicionVenta,grupoProd,situacion,codigoATC,descripcionATC,sustancia FROM catalogoMedicamento WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoMedicamento($idcatalogoMedicamento,$codigoMedicamento,$nombreMedicamento,$concentracion,$formulaF,$titular,$fechaAutorizacion,$fechaVencimiento,$fabricante,$pais,$condicionVenta,$grupoProd,$situacion,$codigoATC,$descripcionATC,$sustancia){
        $data = verificarDatos('add', array('idcatalogoMedicamento'=>$idcatalogoMedicamento,'codigoMedicamento'=>$codigoMedicamento,'nombreMedicamento'=>$nombreMedicamento,'concentracion'=>$concentracion,'formulaF'=>$formulaF,'titular'=>$titular,'fechaAutorizacion'=>$fechaAutorizacion,'fechaVencimiento'=>$fechaVencimiento,'fabricante'=>$fabricante,'pais'=>$pais,'condicionVenta'=>$condicionVenta,'grupoProd'=>$grupoProd,'situacion'=>$situacion,'codigoATC'=>$codigoATC,'descripcionATC'=>$descripcionATC,'sustancia'=>$sustancia));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoMedicamento($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoMedicamento($idcatalogoMedicamento,$codigoMedicamento,$nombreMedicamento,$concentracion,$formulaF,$titular,$fechaAutorizacion,$fechaVencimiento,$fabricante,$pais,$condicionVenta,$grupoProd,$situacion,$codigoATC,$descripcionATC,$sustancia){
        $data = verificarDatos('edit', array('idcatalogoMedicamento'=>$idcatalogoMedicamento,'codigoMedicamento'=>$codigoMedicamento,'nombreMedicamento'=>$nombreMedicamento,'concentracion'=>$concentracion,'formulaF'=>$formulaF,'titular'=>$titular,'fechaAutorizacion'=>$fechaAutorizacion,'fechaVencimiento'=>$fechaVencimiento,'fabricante'=>$fabricante,'pais'=>$pais,'condicionVenta'=>$condicionVenta,'grupoProd'=>$grupoProd,'situacion'=>$situacion,'codigoATC'=>$codigoATC,'descripcionATC'=>$descripcionATC,'sustancia'=>$sustancia)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoMedicamento SET $data[0] WHERE idcatalogoMedicamento = '$idcatalogoMedicamento' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoMedicamento($idcatalogoMedicamento){
        $query = "DELETE FROM catalogoMedicamento WHERE idcatalogoMedicamento = '$idcatalogoMedicamento' ";
        mysql_query($query);
    }

}
?>

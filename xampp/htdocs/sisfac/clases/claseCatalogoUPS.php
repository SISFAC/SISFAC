
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
class CatalogoUPS{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoUPSDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoUPS WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoUPS,codigoUPS,nombreUPS,sexoUPS,edadMinima,tipoMinimo,edadMaxima,tipoMaximo,clasificacion,opcionHospital,opcionCentro,opcionPuesto,descipcion FROM catalogoUPS WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoUPSVector($filtro, $limit){
        $query = "SELECT idcatalogoUPS,CONCAT(codigoUPS,'-',nombreUPS) as ups  FROM catalogoUPS
                        WHERE CONCAT(codigoUPS,'-',nombreUPS) LIKE '%$filtro%'";
        $result = mysql_query($query);
        $catalogo = array();
        while($row = mysql_fetch_array($result)){
            array_push($catalogo, array("value"=>$row[0],"label"=>$row[1]));
            if(count($catalogo)>$limit) break;
        }
        
        return array_to_json($catalogo);
    }

    public function mostrarCatalogoUPSCombobox($select){
        $query = "SELECT idcatalogoUPS,codigoUPS,nombreUPS,sexoUPS,edadMinima,tipoMinimo,edadMaxima,tipoMaximo,clasificacion,opcionHospital,opcionCentro,opcionPuesto,descipcion FROM catalogoUPS WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoUPS($idcatalogoUPS,$codigoUPS,$nombreUPS,$sexoUPS,$edadMinima,$tipoMinimo,$edadMaxima,$tipoMaximo,$clasificacion,$opcionHospital,$opcionCentro,$opcionPuesto,$descipcion){
        $data = verificarDatos('add', array('idcatalogoUPS'=>$idcatalogoUPS,'codigoUPS'=>$codigoUPS,'nombreUPS'=>$nombreUPS,'sexoUPS'=>$sexoUPS,'edadMinima'=>$edadMinima,'tipoMinimo'=>$tipoMinimo,'edadMaxima'=>$edadMaxima,'tipoMaximo'=>$tipoMaximo,'clasificacion'=>$clasificacion,'opcionHospital'=>$opcionHospital,'opcionCentro'=>$opcionCentro,'opcionPuesto'=>$opcionPuesto,'descipcion'=>$descipcion));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoUPS($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoUPS($idcatalogoUPS,$codigoUPS,$nombreUPS,$sexoUPS,$edadMinima,$tipoMinimo,$edadMaxima,$tipoMaximo,$clasificacion,$opcionHospital,$opcionCentro,$opcionPuesto,$descipcion){
        $data = verificarDatos('edit', array('idcatalogoUPS'=>$idcatalogoUPS,'codigoUPS'=>$codigoUPS,'nombreUPS'=>$nombreUPS,'sexoUPS'=>$sexoUPS,'edadMinima'=>$edadMinima,'tipoMinimo'=>$tipoMinimo,'edadMaxima'=>$edadMaxima,'tipoMaximo'=>$tipoMaximo,'clasificacion'=>$clasificacion,'opcionHospital'=>$opcionHospital,'opcionCentro'=>$opcionCentro,'opcionPuesto'=>$opcionPuesto,'descipcion'=>$descipcion)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoUPS SET $data[0] WHERE idcatalogoUPS = '$idcatalogoUPS' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoUPS($idcatalogoUPS){
        $query = "DELETE FROM catalogoUPS WHERE idcatalogoUPS = '$idcatalogoUPS' ";
        mysql_query($query);
    }

}
?>

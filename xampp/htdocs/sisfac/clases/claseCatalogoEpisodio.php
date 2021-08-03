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
class CatalogoEpisodio{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoEpisodioDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoEpisodio cep INNER JOIN etapaVida evi ON cep.idetapaVida=evi.idetapaVida  WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoEpisodio,evi.idetapaVida,nombreEtapa,nombreEpisodio 
                FROM catalogoEpisodio cep INNER JOIN etapaVida evi ON cep.idetapaVida=evi.idetapaVida 
            WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoEpisodioVector($idcatalogoEpisodio){
        $query = "SELECT idcatalogoEpisodio,idetapaVida,nombreEpisodio FROM antecedentePsicosocial WHERE idcatalogoEpisodio = '$idcatalogoEpisodio'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idcatalogoEpisodio'].'+'.$row['idetapaVida'].'+'.$row['nombreEpisodio'];
    }

    public function mostrarCatalogoEpisodioCombobox($select,$nombreEtapa,$limiteFinal){
        $wh .=" AND nombreEtapa = '$nombreEtapa'";
        if($nombreEtapa == 'NINO') {
            if($limiteFinal!='') $wh .=" AND limiteFinal > $limiteFinal";
        }
        $query = "SELECT idcatalogoEpisodio,nombreEpisodio 
                FROM catalogoEpisodio ce INNER JOIN etapaVida ev ON ce.idetapaVida=ev.idetapaVida WHERE 1=1 $wh LIMIT 0,2";
        //echo $query;
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoEpisodio($idcatalogoEpisodio,$idetapaVida,$nombreEpisodio){
        $data = verificarDatos('add', array('idcatalogoEpisodio'=>$idcatalogoEpisodio,'idetapaVida'=>$idetapaVida,'nombreEpisodio'=>$nombreEpisodio));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoEpisodio($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoEpisodio($idcatalogoEpisodio,$idetapaVida,$nombreEpisodio){
        $data = verificarDatos('edit', array('idcatalogoEpisodio'=>$idcatalogoEpisodio,'idetapaVida'=>$idetapaVida,'nombreEpisodio'=>$nombreEpisodio)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoEpisodio SET $data[0] WHERE idcatalogoEpisodio = '$idcatalogoEpisodio' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoEpisodio($idcatalogoEpisodio){
        $query = "DELETE FROM catalogoEpisodio WHERE idcatalogoEpisodio = '$idcatalogoEpisodio' ";
        mysql_query($query);
    }

}
?>

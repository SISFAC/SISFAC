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
class CatalogoEpisodioPrestacion{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoEpisodioPrestacionDatagrid($idcatalogoEpisodio,$nombreEtapa, $opActivo){
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
        
        if($idcatalogoEpisodio!='') $wh.= " AND cep.idcatalogoEpisodio = $idcatalogoEpisodio";
        if($nombreEtapa!='') $wh.= " AND nombreEtapa = '$nombreEtapa'";
        if($opActivo!='') $wh.= " AND opActivo = '$opActivo'";
        
        $query="SELECT COUNT(*) FROM catalogoEpisodioPrestacion cep INNER JOIN catalogoEpisodio cae ON cep.idcatalogoEpisodio=cae.idcatalogoEpisodio
                INNER JOIN catalogoPrestacion cpr ON cpr.idcatalogoPrestacion=cep.idcatalogoPrestacion INNER JOIN catalogoPrestacionPerfil cpp ON cpp.idcatalogoPrestacion = cpr.idcatalogoPrestacion INNER JOIN catalogoPerfil cpe ON cpe.idcatalogoPerfil=cpp.idcatalogoPerfil
                INNER JOIN etapaVida evi ON evi.idetapaVida = cpp.idetapaVida
                WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT DISTINCT idcatalogoEpisodioPrestacion,cep.idcatalogoPrestacion,cpr.nombrePrestacion,cep.idcatalogoEpisodio,cae.nombreEpisodio,cpe.idcatalogoPerfil,cpe.nombrePerfil,formulario
                FROM catalogoEpisodioPrestacion cep INNER JOIN catalogoEpisodio cae ON cep.idcatalogoEpisodio=cae.idcatalogoEpisodio
                INNER JOIN catalogoPrestacion cpr ON cpr.idcatalogoPrestacion=cep.idcatalogoPrestacion INNER JOIN catalogoPrestacionPerfil cpp ON cpp.idcatalogoPrestacion = cpr.idcatalogoPrestacion INNER JOIN catalogoPerfil cpe ON cpe.idcatalogoPerfil=cpp.idcatalogoPerfil
                INNER JOIN etapaVida evi ON evi.idetapaVida = cpp.idetapaVida
                WHERE 1=1 $wh ORDER BY cep.orden asc LIMIT $start,$limit";
//echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoEpisodioPrestacionVector($idcatalogoEpisodioPrestacion){
        $query = "SELECT idcatalogoEpisodioPrestacion,idcatalogoPrestacion,idcatalogoEpisodio,comentario FROM antecedentePsicosocial WHERE idcatalogoEpisodioPrestacion = '$idcatalogoEpisodioPrestacion'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idcatalogoEpisodioPrestacion'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idcatalogoEpisodio'].'+'.$row['comentario'];
    }

    public function mostrarCatalogoEpisodioPrestacionCombobox($select){
        $query = "SELECT idcatalogoEpisodioPrestacion,idcatalogoPrestacion,idcatalogoEpisodio,comentario FROM catalogoEpisodioPrestacion WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoEpisodioPrestacion($idcatalogoEpisodioPrestacion,$idcatalogoPrestacion,$idcatalogoEpisodio,$comentario){
        $data = verificarDatos('add', array('idcatalogoEpisodioPrestacion'=>$idcatalogoEpisodioPrestacion,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idcatalogoEpisodio'=>$idcatalogoEpisodio,'comentario'=>$comentario));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoEpisodioPrestacion($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoEpisodioPrestacion($idcatalogoEpisodioPrestacion,$idcatalogoPrestacion,$idcatalogoEpisodio,$comentario){
        $data = verificarDatos('edit', array('idcatalogoEpisodioPrestacion'=>$idcatalogoEpisodioPrestacion,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idcatalogoEpisodio'=>$idcatalogoEpisodio,'comentario'=>$comentario)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoEpisodioPrestacion SET $data[0] WHERE idcatalogoEpisodioPrestacion = '$idcatalogoEpisodioPrestacion' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoEpisodioPrestacion($idcatalogoEpisodioPrestacion){
        $query = "DELETE FROM catalogoEpisodioPrestacion WHERE idcatalogoEpisodioPrestacion = '$idcatalogoEpisodioPrestacion' ";
        mysql_query($query);
    }

}
?>

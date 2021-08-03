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
class EquivalenciasCodigo{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarEquivalenciasCodigoDatagrid(){
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
        $query="SELECT COUNT(*) FROM equivalenciasCodigo WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idequivalenciasCodigo,idepisodio,idcatalogoPrestacion,codigoCPT,tipoDiag,variableLAB,catalogoCIE10,codigoSIS FROM equivalenciasCodigo WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarEquivalenciasCodigoVector($idequivalenciasCodigo){
        $query = "SELECT idequivalenciasCodigo,idepisodio,idcatalogoPrestacion,codigoCPT,tipoDiag,variableLAB,catalogoCIE10,codigoSIS FROM equivalenciasCodigo WHERE idequivalenciasCodigo = '$idequivalenciasCodigo'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idequivalenciasCodigo'].'+'.$row['idepisodio'].'+'.$row['idcatalogoPrestacion'].'+'.$row['codigoCPT'].'+'.$row['tipoDiag'].'+'.$row['variableLAB'].'+'.$row['catalogoCIE10'].'+'.$row['codigoSIS'];
    }

    public function mostrarEquivalenciasCodigoCombobox($select){
        $query = "SELECT idequivalenciasCodigo,idepisodio,idcatalogoPrestacion,codigoCPT,tipoDiag,variableLAB,catalogoCIE10,codigoSIS FROM equivalenciasCodigo WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarEquivalenciasCodigo($idequivalenciasCodigo,$idepisodio,$idcatalogoPrestacion,$codigoCPT,$tipoDiag,$variableLAB,$catalogoCIE10,$codigoSIS){
        $data = verificarDatos('add', array('idequivalenciasCodigo'=>$idequivalenciasCodigo,'idepisodio'=>$idepisodio,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'codigoCPT'=>$codigoCPT,'tipoDiag'=>$tipoDiag,'variableLAB'=>$variableLAB,'catalogoCIE10'=>$catalogoCIE10,'codigoSIS'=>$codigoSIS));
        if($data[0]!=''){
            $query = "INSERT INTO equivalenciasCodigo($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarEquivalenciasCodigo($idequivalenciasCodigo,$idepisodio,$idcatalogoPrestacion,$codigoCPT,$tipoDiag,$variableLAB,$catalogoCIE10,$codigoSIS){
        $data = verificarDatos('edit', array('idequivalenciasCodigo'=>$idequivalenciasCodigo,'idepisodio'=>$idepisodio,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'codigoCPT'=>$codigoCPT,'tipoDiag'=>$tipoDiag,'variableLAB'=>$variableLAB,'catalogoCIE10'=>$catalogoCIE10,'codigoSIS'=>$codigoSIS)); 
        if($data[0]!=''){
            $query = "UPDATE equivalenciasCodigo SET $data[0] WHERE idequivalenciasCodigo = '$idequivalenciasCodigo' ";
            mysql_query($query);
        }
    }
    
    public function eliminarEquivalenciasCodigo($idequivalenciasCodigo){
        $query = "DELETE FROM equivalenciasCodigo WHERE idequivalenciasCodigo = '$idequivalenciasCodigo' ";
        mysql_query($query);
    }
    
    public function buscarEquivalencia($idcatalogoepisodio, $idcatalogoPrestacion, $hierro, $vitamina, $multimicronutriente) {
        if($hierro!='') $wh.= " AND (ophierro='$hierro' OR opvitamina='$vitamina' OR opmultimicronutriente='$multimicronutriente')";

        $query = "SELECT DISTINCT cpt.idcatalogoCPT, CONCAT(cpt.codigoCPT, '-',cpt.nombre) as cod ,variableLAB,tipoDiag 
                FROM equivalenciasCodigo eco INNER JOIN catalogoCPT cpt ON eco.codigoCPT=cpt.codigoCPT 
                WHERE idepisodio = $idcatalogoepisodio AND idcatalogoPrestacion = $idcatalogoPrestacion $wh";
        echo $query;
        return mysql_query($query);
        //$row = mysql_fetch_array(mysql_query($query));
        
        //return $row[0].'+'.$row[1].'+'.$row[2].'+'.$row[3];
    }

}
?>

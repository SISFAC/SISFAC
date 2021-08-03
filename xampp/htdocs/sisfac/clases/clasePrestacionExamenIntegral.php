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
class PrestacionExamenIntegral{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarPrestacionExamenIntegralDatagrid(){
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
        $query="SELECT COUNT(*) FROM prestacionExamenIntegral WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprestacionExamenIntegral,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,opcionPiel,descripcionPiel,opcionCabeza,descripcionCabeza,opcionCabello,descripcionCabello,opcionOjos,descripcionOjoD,descripcionOjoI,opcionOidos,descripcionOidoD,descripcionOidoI,opcionNariz,descripcionNariz,opcionBoca,descripcionBoca,opcionOrofaringe,descripcionOrofaringe,opcionCuello,descripcionCuello,opcionRespiratorio,descripcionRespiratorio,opcionCardiovascular,descripcionCardiovascular,opcionDigestivo,descripcionDigestivo,opcionGenitourinario,descripcionGenitourinario,opcionLocomotor,descripcionLocomotor,opcionMarcha,descripcionMarcha,opcionColumna,descripcionColumna,opcionSuperior,descripcionSuperior,opcionInferior,descripcionInferior,opcionLinfatico,descripcionLinfatico FROM prestacionExamenIntegral WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarPrestacionExamenIntegralVector($idcatalogoPrestacion,$idpersona,$idepisodio,$claveGeneral){
        $query = "SELECT idprestacionExamenIntegral,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,opcionPiel,descripcionPiel,opcionCabeza,descripcionCabeza,opcionCabello,descripcionCabello,opcionOjos,descripcionOjoD,descripcionOjoI,opcionOidos,descripcionOidoD,descripcionOidoI,opcionNariz,descripcionNariz,opcionBoca,descripcionBoca,opcionOrofaringe,descripcionOrofaringe,opcionCuello,descripcionCuello,opcionRespiratorio,descripcionRespiratorio,opcionCardiovascular,descripcionCardiovascular,opcionDigestivo,descripcionDigestivo,opcionGenitourinario,descripcionGenitourinario,opcionLocomotor,descripcionLocomotor,opcionMarcha,descripcionMarcha,opcionColumna,descripcionColumna,opcionSuperior,descripcionSuperior,opcionInferior,descripcionInferior,opcionLinfatico,descripcionLinfatico FROM prestacionExamenIntegral WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idprestacionExamenIntegral'].'+'.$row['claveGeneral'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idepisodio'].'+'.$row['idpersona'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaInicio'].'+'.$row['fechaFin'].'+'.$row['estado'].'+'.$row['opcionPiel'].'+'.$row['descripcionPiel'].'+'.$row['opcionCabeza'].'+'.$row['descripcionCabeza'].'+'.$row['opcionCabello'].'+'.$row['descripcionCabello'].'+'.$row['opcionOjos'].'+'.$row['descripcionOjoD'].'+'.$row['descripcionOjoI'].'+'.$row['opcionOidos'].'+'.$row['descripcionOidoD'].'+'.$row['descripcionOidoI'].'+'.$row['opcionNariz'].'+'.$row['descripcionNariz'].'+'.$row['opcionBoca'].'+'.$row['descripcionBoca'].'+'.$row['opcionOrofaringe'].'+'.$row['descripcionOrofaringe'].'+'.$row['opcionCuello'].'+'.$row['descripcionCuello'].'+'.$row['opcionRespiratorio'].'+'.$row['descripcionRespiratorio'].'+'.$row['opcionCardiovascular'].'+'.$row['descripcionCardiovascular'].'+'.$row['opcionDigestivo'].'+'.$row['descripcionDigestivo'].'+'.$row['opcionGenitourinario'].'+'.$row['descripcionGenitourinario'].'+'.$row['opcionLocomotor'].'+'.$row['descripcionLocomotor'].'+'.$row['opcionMarcha'].'+'.$row['descripcionMarcha'].'+'.$row['opcionColumna'].'+'.$row['descripcionColumna'].'+'.$row['opcionSuperior'].'+'.$row['descripcionSuperior'].'+'.$row['opcionInferior'].'+'.$row['descripcionInferior'].'+'.$row['opcionLinfatico'].'+'.$row['descripcionLinfatico'];
    }

    public function mostrarPrestacionExamenIntegralCombobox($select){
        $query = "SELECT idprestacionExamenIntegral,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,opcionPiel,descripcionPiel,opcionCabeza,descripcionCabeza,opcionCabello,descripcionCabello,opcionOjos,descripcionOjoD,descripcionOjoI,opcionOidos,descripcionOidoD,descripcionOidoI,opcionNariz,descripcionNariz,opcionBoca,descripcionBoca,opcionOrofaringe,descripcionOrofaringe,opcionCuello,descripcionCuello,opcionRespiratorio,descripcionRespiratorio,opcionCardiovascular,descripcionCardiovascular,opcionDigestivo,descripcionDigestivo,opcionGenitourinario,descripcionGenitourinario,opcionLocomotor,descripcionLocomotor,opcionMarcha,descripcionMarcha,opcionColumna,descripcionColumna,opcionSuperior,descripcionSuperior,opcionInferior,descripcionInferior,opcionLinfatico,descripcionLinfatico FROM prestacionExamenIntegral WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarPrestacionExamenIntegral($idprestacionExamenIntegral,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$opcionPiel,$descripcionPiel,$opcionCabeza,$descripcionCabeza,$opcionCabello,$descripcionCabello,$opcionOjos,$descripcionOjoD,$descripcionOjoI,$opcionOidos,$descripcionOidoD,$descripcionOidoI,$opcionNariz,$descripcionNariz,$opcionBoca,$descripcionBoca,$opcionOrofaringe,$descripcionOrofaringe,$opcionCuello,$descripcionCuello,$opcionRespiratorio,$descripcionRespiratorio,$opcionCardiovascular,$descripcionCardiovascular,$opcionDigestivo,$descripcionDigestivo,$opcionGenitourinario,$descripcionGenitourinario,$opcionLocomotor,$descripcionLocomotor,$opcionMarcha,$descripcionMarcha,$opcionColumna,$descripcionColumna,$opcionSuperior,$descripcionSuperior,$opcionInferior,$descripcionInferior,$opcionLinfatico,$descripcionLinfatico){
        $data = verificarDatos('add', array('idprestacionExamenIntegral'=>$idprestacionExamenIntegral,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'opcionPiel'=>$opcionPiel,'descripcionPiel'=>$descripcionPiel,'opcionCabeza'=>$opcionCabeza,'descripcionCabeza'=>$descripcionCabeza,'opcionCabello'=>$opcionCabello,'descripcionCabello'=>$descripcionCabello,'opcionOjos'=>$opcionOjos,'descripcionOjoD'=>$descripcionOjoD,'descripcionOjoI'=>$descripcionOjoI,'opcionOidos'=>$opcionOidos,'descripcionOidoD'=>$descripcionOidoD,'descripcionOidoI'=>$descripcionOidoI,'opcionNariz'=>$opcionNariz,'descripcionNariz'=>$descripcionNariz,'opcionBoca'=>$opcionBoca,'descripcionBoca'=>$descripcionBoca,'opcionOrofaringe'=>$opcionOrofaringe,'descripcionOrofaringe'=>$descripcionOrofaringe,'opcionCuello'=>$opcionCuello,'descripcionCuello'=>$descripcionCuello,'opcionRespiratorio'=>$opcionRespiratorio,'descripcionRespiratorio'=>$descripcionRespiratorio,'opcionCardiovascular'=>$opcionCardiovascular,'descripcionCardiovascular'=>$descripcionCardiovascular,'opcionDigestivo'=>$opcionDigestivo,'descripcionDigestivo'=>$descripcionDigestivo,'opcionGenitourinario'=>$opcionGenitourinario,'descripcionGenitourinario'=>$descripcionGenitourinario,'opcionLocomotor'=>$opcionLocomotor,'descripcionLocomotor'=>$descripcionLocomotor,'opcionMarcha'=>$opcionMarcha,'descripcionMarcha'=>$descripcionMarcha,'opcionColumna'=>$opcionColumna,'descripcionColumna'=>$descripcionColumna,'opcionSuperior'=>$opcionSuperior,'descripcionSuperior'=>$descripcionSuperior,'opcionInferior'=>$opcionInferior,'descripcionInferior'=>$descripcionInferior,'opcionLinfatico'=>$opcionLinfatico,'descripcionLinfatico'=>$descripcionLinfatico));
        if($data[0]!=''){
            $query = "INSERT INTO prestacionExamenIntegral($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarPrestacionExamenIntegral($idprestacionExamenIntegral,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$opcionPiel,$descripcionPiel,$opcionCabeza,$descripcionCabeza,$opcionCabello,$descripcionCabello,$opcionOjos,$descripcionOjoD,$descripcionOjoI,$opcionOidos,$descripcionOidoD,$descripcionOidoI,$opcionNariz,$descripcionNariz,$opcionBoca,$descripcionBoca,$opcionOrofaringe,$descripcionOrofaringe,$opcionCuello,$descripcionCuello,$opcionRespiratorio,$descripcionRespiratorio,$opcionCardiovascular,$descripcionCardiovascular,$opcionDigestivo,$descripcionDigestivo,$opcionGenitourinario,$descripcionGenitourinario,$opcionLocomotor,$descripcionLocomotor,$opcionMarcha,$descripcionMarcha,$opcionColumna,$descripcionColumna,$opcionSuperior,$descripcionSuperior,$opcionInferior,$descripcionInferior,$opcionLinfatico,$descripcionLinfatico){
        $data = verificarDatos('edit', array('idprestacionExamenIntegral'=>$idprestacionExamenIntegral,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'opcionPiel'=>$opcionPiel,'descripcionPiel'=>$descripcionPiel,'opcionCabeza'=>$opcionCabeza,'descripcionCabeza'=>$descripcionCabeza,'opcionCabello'=>$opcionCabello,'descripcionCabello'=>$descripcionCabello,'opcionOjos'=>$opcionOjos,'descripcionOjoD'=>$descripcionOjoD,'descripcionOjoI'=>$descripcionOjoI,'opcionOidos'=>$opcionOidos,'descripcionOidoD'=>$descripcionOidoD,'descripcionOidoI'=>$descripcionOidoI,'opcionNariz'=>$opcionNariz,'descripcionNariz'=>$descripcionNariz,'opcionBoca'=>$opcionBoca,'descripcionBoca'=>$descripcionBoca,'opcionOrofaringe'=>$opcionOrofaringe,'descripcionOrofaringe'=>$descripcionOrofaringe,'opcionCuello'=>$opcionCuello,'descripcionCuello'=>$descripcionCuello,'opcionRespiratorio'=>$opcionRespiratorio,'descripcionRespiratorio'=>$descripcionRespiratorio,'opcionCardiovascular'=>$opcionCardiovascular,'descripcionCardiovascular'=>$descripcionCardiovascular,'opcionDigestivo'=>$opcionDigestivo,'descripcionDigestivo'=>$descripcionDigestivo,'opcionGenitourinario'=>$opcionGenitourinario,'descripcionGenitourinario'=>$descripcionGenitourinario,'opcionLocomotor'=>$opcionLocomotor,'descripcionLocomotor'=>$descripcionLocomotor,'opcionMarcha'=>$opcionMarcha,'descripcionMarcha'=>$descripcionMarcha,'opcionColumna'=>$opcionColumna,'descripcionColumna'=>$descripcionColumna,'opcionSuperior'=>$opcionSuperior,'descripcionSuperior'=>$descripcionSuperior,'opcionInferior'=>$opcionInferior,'descripcionInferior'=>$descripcionInferior,'opcionLinfatico'=>$opcionLinfatico,'descripcionLinfatico'=>$descripcionLinfatico)); 
        if($data[0]!=''){
            $query = "UPDATE prestacionExamenIntegral SET $data[0] WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarPrestacionExamenIntegral($idprestacionExamenIntegral,$claveGeneral){
        $query = "DELETE FROM prestacionExamenIntegral WHERE idprestacionExamenIntegral = '$idprestacionExamenIntegral' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

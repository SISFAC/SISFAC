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
class AdministracionMicronutrientesNino{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarAdministracionMicronutrientesNinoDatagrid(){
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
        $query="SELECT COUNT(*) FROM administracionMicronutrientesNino WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idadministracionMicronutrientesNino,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,hierro,esquemaHierro,vitamina,esquemaVitamina,multimicronutrientes,esquemaMultimicronutrientes,fechaMicronutriente,estadoMicronutriente,segimientoDomicilio1,estadoSeguimiento1,segimientoDomicilio2,estadoSeguimiento2,segimientoDomicilio3,estadoSeguimiento3 FROM administracionMicronutrientesNino WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarAdministracionMicronutrientesNinoVector($idcatalogoPrestacion, $idpersona, $idepisodio, $claveGeneral){
        $query = "SELECT idadministracionMicronutrientesNino,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,hierro,esquemaHierro,vitamina,esquemaVitamina,multimicronutrientes,esquemaMultimicronutrientes,DATE_FORMAT(fechaMicronutriente,'%d/%m/%Y') fechaMicronutriente,estadoMicronutriente,DATE_FORMAT(segimientoDomicilio1,'%d/%m/%Y') segimientoDomicilio1,estadoSeguimiento1, DATE_FORMAT(segimientoDomicilio2,'%d/%m/%Y') segimientoDomicilio2,estadoSeguimiento2,DATE_FORMAT(segimientoDomicilio3,'%d/%m/%Y') segimientoDomicilio3,estadoSeguimiento3 FROM administracionMicronutrientesNino  WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idadministracionMicronutrientesNino'].'+'.$row['claveGeneral'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idepisodio'].'+'.$row['idpersona'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaInicio'].'+'.$row['fechaFin'].'+'.$row['estado'].'+'.$row['hierro'].'+'.$row['esquemaHierro'].'+'.$row['vitamina'].'+'.$row['esquemaVitamina'].'+'.$row['multimicronutrientes'].'+'.$row['esquemaMultimicronutrientes'].'+'.$row['fechaMicronutriente'].'+'.$row['estadoMicronutriente'].'+'.$row['segimientoDomicilio1'].'+'.$row['estadoSeguimiento1'].'+'.$row['segimientoDomicilio2'].'+'.$row['estadoSeguimiento2'].'+'.$row['segimientoDomicilio3'].'+'.$row['estadoSeguimiento3'];
    }

    public function mostrarAdministracionMicronutrientesNinoCombobox($select){
        $query = "SELECT idadministracionMicronutrientesNino,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,hierro,esquemaHierro,vitamina,esquemaVitamina,multimicronutrientes,esquemaMultimicronutrientes,fechaMicronutriente,estadoMicronutriente,segimientoDomicilio1,estadoSeguimiento1,segimientoDomicilio2,estadoSeguimiento2,segimientoDomicilio3,estadoSeguimiento3 FROM administracionMicronutrientesNino WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarAdministracionMicronutrientesNino($idadministracionMicronutrientesNino,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$hierro,$esquemaHierro,$vitamina,$esquemaVitamina,$multimicronutrientes,$esquemaMultimicronutrientes,$fechaMicronutriente,$estadoMicronutriente,$segimientoDomicilio1,$estadoSeguimiento1,$segimientoDomicilio2,$estadoSeguimiento2,$segimientoDomicilio3,$estadoSeguimiento3){
        $data = verificarDatos('add', array('idadministracionMicronutrientesNino'=>$idadministracionMicronutrientesNino,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'hierro'=>$hierro,'esquemaHierro'=>$esquemaHierro,'vitamina'=>$vitamina,'esquemaVitamina'=>$esquemaVitamina,'multimicronutrientes'=>$multimicronutrientes,'esquemaMultimicronutrientes'=>$esquemaMultimicronutrientes,'fechaMicronutriente'=>$fechaMicronutriente,'estadoMicronutriente'=>$estadoMicronutriente,'segimientoDomicilio1'=>$segimientoDomicilio1,'estadoSeguimiento1'=>$estadoSeguimiento1,'segimientoDomicilio2'=>$segimientoDomicilio2,'estadoSeguimiento2'=>$estadoSeguimiento2,'segimientoDomicilio3'=>$segimientoDomicilio3,'estadoSeguimiento3'=>$estadoSeguimiento3));
        if($data[0]!=''){
            $query = "INSERT INTO administracionMicronutrientesNino($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarAdministracionMicronutrientesNino($idadministracionMicronutrientesNino,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$hierro,$esquemaHierro,$vitamina,$esquemaVitamina,$multimicronutrientes,$esquemaMultimicronutrientes,$fechaMicronutriente,$estadoMicronutriente,$segimientoDomicilio1,$estadoSeguimiento1,$segimientoDomicilio2,$estadoSeguimiento2,$segimientoDomicilio3,$estadoSeguimiento3){
        $data = verificarDatos('edit', array('idadministracionMicronutrientesNino'=>$idadministracionMicronutrientesNino,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'hierro'=>$hierro,'esquemaHierro'=>$esquemaHierro,'vitamina'=>$vitamina,'esquemaVitamina'=>$esquemaVitamina,'multimicronutrientes'=>$multimicronutrientes,'esquemaMultimicronutrientes'=>$esquemaMultimicronutrientes,'fechaMicronutriente'=>$fechaMicronutriente,'estadoMicronutriente'=>$estadoMicronutriente,'segimientoDomicilio1'=>$segimientoDomicilio1,'estadoSeguimiento1'=>$estadoSeguimiento1,'segimientoDomicilio2'=>$segimientoDomicilio2,'estadoSeguimiento2'=>$estadoSeguimiento2,'segimientoDomicilio3'=>$segimientoDomicilio3,'estadoSeguimiento3'=>$estadoSeguimiento3)); 
        if($data[0]!=''){
            $query = "UPDATE administracionMicronutrientesNino SET $data[0]  WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarAdministracionMicronutrientesNino($idadministracionMicronutrientesNino,$claveGeneral){
        $query = "DELETE FROM administracionMicronutrientesNino WHERE idadministracionMicronutrientesNino = '$idadministracionMicronutrientesNino' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

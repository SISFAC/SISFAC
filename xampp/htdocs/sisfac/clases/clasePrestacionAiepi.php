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
class PrestacionAiepi{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarPrestacionAiepiDatagrid(){
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
        $query="SELECT COUNT(*) FROM prestacionAiepi WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprestacionAiepi,claveGeneral,idcatalogoPrestacion,idpersona,idepisodio,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,infeccionBacteriana,respiracionesPorMinuto,respiracionRapida,tirajeSubcostal,aleteoNasal,quejido,estadoFontanela,supuracionOido,estadoOmbligo,temperatura,pielPustulas,letargio,movimientoAnormal,secrecionOjos,diarrea,tiempoDiarrea,sangreHeces,estadoGeneral,ojosHundidos,signoCutaneo FROM prestacionAiepi WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarPrestacionAiepiVector($idcatalogoPrestacion,$idpersona,$idepisodio,$claveGeneral){
        $query = "SELECT idprestacionAiepi,claveGeneral,idcatalogoPrestacion,idpersona,idepisodio,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,infeccionBacteriana,respiracionesPorMinuto,respiracionRapida,tirajeSubcostal,aleteoNasal,quejido,estadoFontanela,supuracionOido,estadoOmbligo,temperatura,pielPustulas,letargio,movimientoAnormal,secrecionOjos,diarrea,tiempoDiarrea,sangreHeces,estadoGeneral,ojosHundidos,signoCutaneo 
                FROM prestacionaiepi WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idprestacionAiepi'].'+'.$row['claveGeneral'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idpersona'].'+'.$row['idepisodio'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaInicio'].'+'.$row['fechaFin'].'+'.$row['estado'].'+'.$row['infeccionBacteriana'].'+'.$row['respiracionesPorMinuto'].'+'.$row['respiracionRapida'].'+'.$row['tirajeSubcostal'].'+'.$row['aleteoNasal'].'+'.$row['quejido'].'+'.$row['estadoFontanela'].'+'.$row['supuracionOido'].'+'.$row['estadoOmbligo'].'+'.$row['temperatura'].'+'.$row['pielPustulas'].'+'.$row['letargio'].'+'.$row['movimientoAnormal'].'+'.$row['secrecionOjos'].'+'.$row['diarrea'].'+'.$row['tiempoDiarrea'].'+'.$row['sangreHeces'].'+'.$row['estadoGeneral'].'+'.$row['ojosHundidos'].'+'.$row['signoCutaneo'];
    }

    public function mostrarPrestacionAiepiCombobox($select){
        $query = "SELECT idprestacionAiepi,claveGeneral,idcatalogoPrestacion,idpersona,idepisodio,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,infeccionBacteriana,respiracionesPorMinuto,respiracionRapida,tirajeSubcostal,aleteoNasal,quejido,estadoFontanela,supuracionOido,estadoOmbligo,temperatura,pielPustulas,letargio,movimientoAnormal,secrecionOjos,diarrea,tiempoDiarrea,sangreHeces,estadoGeneral,ojosHundidos,signoCutaneo FROM prestacionAiepi WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarPrestacionAiepi($idprestacionAiepi,$claveGeneral,$idcatalogoPrestacion,$idpersona,$idepisodio,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$infeccionBacteriana,$respiracionesPorMinuto,$respiracionRapida,$tirajeSubcostal,$aleteoNasal,$quejido,$estadoFontanela,$supuracionOido,$estadoOmbligo,$temperatura,$pielPustulas,$letargio,$movimientoAnormal,$secrecionOjos,$diarrea,$tiempoDiarrea,$sangreHeces,$estadoGeneral,$ojosHundidos,$signoCutaneo){
        $data = verificarDatos('add', array('idprestacionAiepi'=>$idprestacionAiepi,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idpersona'=>$idpersona,'idepisodio'=>$idepisodio,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'infeccionBacteriana'=>$infeccionBacteriana,'respiracionesPorMinuto'=>$respiracionesPorMinuto,'respiracionRapida'=>$respiracionRapida,'tirajeSubcostal'=>$tirajeSubcostal,'aleteoNasal'=>$aleteoNasal,'quejido'=>$quejido,'estadoFontanela'=>$estadoFontanela,'supuracionOido'=>$supuracionOido,'estadoOmbligo'=>$estadoOmbligo,'temperatura'=>$temperatura,'pielPustulas'=>$pielPustulas,'letargio'=>$letargio,'movimientoAnormal'=>$movimientoAnormal,'secrecionOjos'=>$secrecionOjos,'diarrea'=>$diarrea,'tiempoDiarrea'=>$tiempoDiarrea,'sangreHeces'=>$sangreHeces,'estadoGeneral'=>$estadoGeneral,'ojosHundidos'=>$ojosHundidos,'signoCutaneo'=>$signoCutaneo));
        if($data[0]!=''){
            $query = "INSERT INTO prestacionAiepi($data[0]) VALUES($data[1])";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function actualizarPrestacionAiepi($idprestacionAiepi,$claveGeneral,$idcatalogoPrestacion,$idpersona,$idepisodio,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$infeccionBacteriana,$respiracionesPorMinuto,$respiracionRapida,$tirajeSubcostal,$aleteoNasal,$quejido,$estadoFontanela,$supuracionOido,$estadoOmbligo,$temperatura,$pielPustulas,$letargio,$movimientoAnormal,$secrecionOjos,$diarrea,$tiempoDiarrea,$sangreHeces,$estadoGeneral,$ojosHundidos,$signoCutaneo){
        $data = verificarDatos('edit', array('idprestacionAiepi'=>$idprestacionAiepi,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idpersona'=>$idpersona,'idepisodio'=>$idepisodio,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'infeccionBacteriana'=>$infeccionBacteriana,'respiracionesPorMinuto'=>$respiracionesPorMinuto,'respiracionRapida'=>$respiracionRapida,'tirajeSubcostal'=>$tirajeSubcostal,'aleteoNasal'=>$aleteoNasal,'quejido'=>$quejido,'estadoFontanela'=>$estadoFontanela,'supuracionOido'=>$supuracionOido,'estadoOmbligo'=>$estadoOmbligo,'temperatura'=>$temperatura,'pielPustulas'=>$pielPustulas,'letargio'=>$letargio,'movimientoAnormal'=>$movimientoAnormal,'secrecionOjos'=>$secrecionOjos,'diarrea'=>$diarrea,'tiempoDiarrea'=>$tiempoDiarrea,'sangreHeces'=>$sangreHeces,'estadoGeneral'=>$estadoGeneral,'ojosHundidos'=>$ojosHundidos,'signoCutaneo'=>$signoCutaneo)); 
        if($data[0]!=''){
            $query = "UPDATE prestacionAiepi SET $data[0] WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarPrestacionAiepi($idprestacionAiepi,$claveGeneral){
        $query = "DELETE FROM prestacionAiepi WHERE idprestacionAiepi = '$idprestacionAiepi' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

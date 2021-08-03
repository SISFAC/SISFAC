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
class Referencia{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarReferenciaDatagrid(){
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
        $query="SELECT COUNT(*) FROM referencia WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idreferencia,claveGeneral,idepisodio,idcatalogoReferencia,nombreReferencia,idcatalogoUPS,nombreCatalogo,fechaIngreso,idtrabajadorReferencia,idtrabajadorResponsable,idtrabajadorCompania,condicionRecepcion,fechaRecepcion,responsableRecepcion,colegiaturaRecepcion,idprofesionRecepcion,condicionPaciente,estadoReferencia,fechaReingreso,iddiagnostico1,diagnostico1,iddiagnostico2,diagnostico2,iddiagnostico3,diagnostico3 FROM referencia WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarReferenciaVector($idepisodio,$claveGeneral){
        $query = "SELECT idreferencia,claveGeneral,idepisodio,idcatalogoReferencia,nombreReferencia,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaIngreso,'%d/%m/%Y') fechaIngreso,idtrabajadorReferencia,idtrabajadorResponsable,idtrabajadorCompania,condicionRecepcion,DATE_FORMAT(fechaRecepcion,'%d/%m/%Y') fechaRecepcion,responsableRecepcion,colegiaturaRecepcion,idprofesionRecepcion,condicionPaciente,estadoReferencia,DATE_FORMAT(fechaReingreso,'%d/%m/%Y') fechaReingreso,iddiagnostico1,diagnostico1,iddiagnostico2,diagnostico2,iddiagnostico3,diagnostico3 FROM referencia WHERE idreferencia = '$idepisodio' AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idreferencia'].'+'.$row['claveGeneral'].'+'.$row['idepisodio'].'+'.$row['idcatalogoReferencia'].'+'.$row['nombreReferencia'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaIngreso'].'+'.$row['idtrabajadorReferencia'].'+'.$row['idtrabajadorResponsable'].'+'.$row['idtrabajadorCompania'].'+'.$row['condicionRecepcion'].'+'.$row['fechaRecepcion'].'+'.$row['responsableRecepcion'].'+'.$row['colegiaturaRecepcion'].'+'.$row['idprofesionRecepcion'].'+'.$row['condicionPaciente'].'+'.$row['estadoReferencia'].'+'.$row['fechaReingreso'].'+'.$row['iddiagnostico1'].'+'.$row['diagnostico1'].'+'.$row['iddiagnostico2'].'+'.$row['diagnostico2'].'+'.$row['iddiagnostico3'].'+'.$row['diagnostico3'];
    }

    public function mostrarReferenciaCombobox($select){
        $query = "SELECT idreferencia,claveGeneral,idepisodio,idcatalogoReferencia,nombreReferencia,idcatalogoUPS,nombreCatalogo,fechaIngreso,idtrabajadorReferencia,idtrabajadorResponsable,idtrabajadorCompania,condicionRecepcion,fechaRecepcion,responsableRecepcion,colegiaturaRecepcion,idprofesionRecepcion,condicionPaciente,estadoReferencia,fechaReingreso,iddiagnostico1,diagnostico1,iddiagnostico2,diagnostico2,iddiagnostico3,diagnostico3 FROM referencia WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarReferencia($idreferencia,$claveGeneral,$idepisodio,$idcatalogoReferencia,$nombreReferencia,$idcatalogoUPS,$nombreCatalogo,$fechaIngreso,$idtrabajadorReferencia,$idtrabajadorResponsable,$idtrabajadorCompania,$condicionRecepcion,$fechaRecepcion,$responsableRecepcion,$colegiaturaRecepcion,$idprofesionRecepcion,$condicionPaciente,$estadoReferencia,$fechaReingreso,$iddiagnostico1,$diagnostico1,$iddiagnostico2,$diagnostico2,$iddiagnostico3,$diagnostico3){
        $data = verificarDatos('add', array('idreferencia'=>$idreferencia,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio,'idcatalogoReferencia'=>$idcatalogoReferencia,'nombreReferencia'=>$nombreReferencia,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaIngreso'=>$fechaIngreso,'idtrabajadorReferencia'=>$idtrabajadorReferencia,'idtrabajadorResponsable'=>$idtrabajadorResponsable,'idtrabajadorCompania'=>$idtrabajadorCompania,'condicionRecepcion'=>$condicionRecepcion,'fechaRecepcion'=>$fechaRecepcion,'responsableRecepcion'=>$responsableRecepcion,'colegiaturaRecepcion'=>$colegiaturaRecepcion,'idprofesionRecepcion'=>$idprofesionRecepcion,'condicionPaciente'=>$condicionPaciente,'estadoReferencia'=>$estadoReferencia,'fechaReingreso'=>$fechaReingreso,'iddiagnostico1'=>$iddiagnostico1,'diagnostico1'=>$diagnostico1,'iddiagnostico2'=>$iddiagnostico2,'diagnostico2'=>$diagnostico2,'iddiagnostico3'=>$iddiagnostico3,'diagnostico3'=>$diagnostico3));
        if($data[0]!=''){
            $query = "INSERT INTO referencia($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarReferencia($idreferencia,$claveGeneral,$idepisodio,$idcatalogoReferencia,$nombreReferencia,$idcatalogoUPS,$nombreCatalogo,$fechaIngreso,$idtrabajadorReferencia,$idtrabajadorResponsable,$idtrabajadorCompania,$condicionRecepcion,$fechaRecepcion,$responsableRecepcion,$colegiaturaRecepcion,$idprofesionRecepcion,$condicionPaciente,$estadoReferencia,$fechaReingreso,$iddiagnostico1,$diagnostico1,$iddiagnostico2,$diagnostico2,$iddiagnostico3,$diagnostico3){
        $data = verificarDatos('edit', array('idreferencia'=>$idreferencia,'claveGeneral'=>$claveGeneral,'idepisodio'=>$idepisodio,'idcatalogoReferencia'=>$idcatalogoReferencia,'nombreReferencia'=>$nombreReferencia,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaIngreso'=>$fechaIngreso,'idtrabajadorReferencia'=>$idtrabajadorReferencia,'idtrabajadorResponsable'=>$idtrabajadorResponsable,'idtrabajadorCompania'=>$idtrabajadorCompania,'condicionRecepcion'=>$condicionRecepcion,'fechaRecepcion'=>$fechaRecepcion,'responsableRecepcion'=>$responsableRecepcion,'colegiaturaRecepcion'=>$colegiaturaRecepcion,'idprofesionRecepcion'=>$idprofesionRecepcion,'condicionPaciente'=>$condicionPaciente,'estadoReferencia'=>$estadoReferencia,'fechaReingreso'=>$fechaReingreso,'iddiagnostico1'=>$iddiagnostico1,'diagnostico1'=>$diagnostico1,'iddiagnostico2'=>$iddiagnostico2,'diagnostico2'=>$diagnostico2,'iddiagnostico3'=>$iddiagnostico3,'diagnostico3'=>$diagnostico3)); 
        if($data[0]!=''){
            $query = "UPDATE referencia SET $data[0] WHERE idreferencia = '$idreferencia' AND claveGeneral = '$claveGeneral' ";
            mysql_query($query);
        }
    }
    
    public function eliminarReferencia($idreferencia,$claveGeneral){
        $query = "DELETE FROM referencia WHERE idreferencia = '$idreferencia' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

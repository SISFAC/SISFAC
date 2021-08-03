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
class PrestacionEvaluacionLME{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarPrestacionEvaluacionLMEDatagrid(){
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
        $query="SELECT COUNT(*) FROM prestacionEvaluacionLME WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprestacionEvaluacionLME,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,lactanciaLM,tecnicaLM,frecuenciaLM,lecheNoMaterna,recibeAguitas,otroAlimento,consistenciaAdecuada,cantidadAdecuada,frecuenciaAdecuada,consumoAlimentosAnimal,consumoFrutasVerduras,consumoMantequilla,alimentosEnPlato,usaSalYodada,tomaSuplementoHierro,tomaSuplementoVitamina,recibeMicronutrientes,opcionBeneficiarioPrograma,descripcionPrograma FROM prestacionEvaluacionLME WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarPrestacionEvaluacionLMEVector($idcatalogoPrestacion,$idpersona,$idepisodio,$claveGeneral){
        $query = "SELECT idprestacionEvaluacionLME,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado,lactanciaLM,tecnicaLM,frecuenciaLM,lecheNoMaterna,recibeAguitas,otroAlimento,consistenciaAdecuada,cantidadAdecuada,frecuenciaAdecuada,consumoAlimentosAnimal,consumoFrutasVerduras,consumoMantequilla,alimentosEnPlato,usaSalYodada,tomaSuplementoHierro,tomaSuplementoVitamina,recibeMicronutrientes,opcionBeneficiarioPrograma,descripcionPrograma FROM prestacionEvaluacionLME WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idprestacionEvaluacionLME'].'+'.$row['claveGeneral'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idepisodio'].'+'.$row['idpersona'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaInicio'].'+'.$row['fechaFin'].'+'.$row['estado'].'+'.$row['lactanciaLM'].'+'.$row['tecnicaLM'].'+'.$row['frecuenciaLM'].'+'.$row['lecheNoMaterna'].'+'.$row['recibeAguitas'].'+'.$row['otroAlimento'].'+'.$row['consistenciaAdecuada'].'+'.$row['cantidadAdecuada'].'+'.$row['frecuenciaAdecuada'].'+'.$row['consumoAlimentosAnimal'].'+'.$row['consumoFrutasVerduras'].'+'.$row['consumoMantequilla'].'+'.$row['alimentosEnPlato'].'+'.$row['usaSalYodada'].'+'.$row['tomaSuplementoHierro'].'+'.$row['tomaSuplementoVitamina'].'+'.$row['recibeMicronutrientes'].'+'.$row['opcionBeneficiarioPrograma'].'+'.$row['descripcionPrograma'];
    }

    public function mostrarPrestacionEvaluacionLMECombobox($select){
        $query = "SELECT idprestacionEvaluacionLME,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado,lactanciaLM,tecnicaLM,frecuenciaLM,lecheNoMaterna,recibeAguitas,otroAlimento,consistenciaAdecuada,cantidadAdecuada,frecuenciaAdecuada,consumoAlimentosAnimal,consumoFrutasVerduras,consumoMantequilla,alimentosEnPlato,usaSalYodada,tomaSuplementoHierro,tomaSuplementoVitamina,recibeMicronutrientes,opcionBeneficiarioPrograma,descripcionPrograma FROM prestacionEvaluacionLME WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarPrestacionEvaluacionLME($idprestacionEvaluacionLME,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$lactanciaLM,$tecnicaLM,$frecuenciaLM,$lecheNoMaterna,$recibeAguitas,$otroAlimento,$consistenciaAdecuada,$cantidadAdecuada,$frecuenciaAdecuada,$consumoAlimentosAnimal,$consumoFrutasVerduras,$consumoMantequilla,$alimentosEnPlato,$usaSalYodada,$tomaSuplementoHierro,$tomaSuplementoVitamina,$recibeMicronutrientes,$opcionBeneficiarioPrograma,$descripcionPrograma){
        $data = verificarDatos('add', array('idprestacionEvaluacionLME'=>$idprestacionEvaluacionLME,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'lactanciaLM'=>$lactanciaLM,'tecnicaLM'=>$tecnicaLM,'frecuenciaLM'=>$frecuenciaLM,'lecheNoMaterna'=>$lecheNoMaterna,'recibeAguitas'=>$recibeAguitas,'otroAlimento'=>$otroAlimento,'consistenciaAdecuada'=>$consistenciaAdecuada,'cantidadAdecuada'=>$cantidadAdecuada,'frecuenciaAdecuada'=>$frecuenciaAdecuada,'consumoAlimentosAnimal'=>$consumoAlimentosAnimal,'consumoFrutasVerduras'=>$consumoFrutasVerduras,'consumoMantequilla'=>$consumoMantequilla,'alimentosEnPlato'=>$alimentosEnPlato,'usaSalYodada'=>$usaSalYodada,'tomaSuplementoHierro'=>$tomaSuplementoHierro,'tomaSuplementoVitamina'=>$tomaSuplementoVitamina,'recibeMicronutrientes'=>$recibeMicronutrientes,'opcionBeneficiarioPrograma'=>$opcionBeneficiarioPrograma,'descripcionPrograma'=>$descripcionPrograma));
        if($data[0]!=''){
            $query = "INSERT INTO prestacionEvaluacionLME($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarPrestacionEvaluacionLME($idprestacionEvaluacionLME,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado,$lactanciaLM,$tecnicaLM,$frecuenciaLM,$lecheNoMaterna,$recibeAguitas,$otroAlimento,$consistenciaAdecuada,$cantidadAdecuada,$frecuenciaAdecuada,$consumoAlimentosAnimal,$consumoFrutasVerduras,$consumoMantequilla,$alimentosEnPlato,$usaSalYodada,$tomaSuplementoHierro,$tomaSuplementoVitamina,$recibeMicronutrientes,$opcionBeneficiarioPrograma,$descripcionPrograma){
        $data = verificarDatos('edit', array('idprestacionEvaluacionLME'=>$idprestacionEvaluacionLME,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado,'lactanciaLM'=>$lactanciaLM,'tecnicaLM'=>$tecnicaLM,'frecuenciaLM'=>$frecuenciaLM,'lecheNoMaterna'=>$lecheNoMaterna,'recibeAguitas'=>$recibeAguitas,'otroAlimento'=>$otroAlimento,'consistenciaAdecuada'=>$consistenciaAdecuada,'cantidadAdecuada'=>$cantidadAdecuada,'frecuenciaAdecuada'=>$frecuenciaAdecuada,'consumoAlimentosAnimal'=>$consumoAlimentosAnimal,'consumoFrutasVerduras'=>$consumoFrutasVerduras,'consumoMantequilla'=>$consumoMantequilla,'alimentosEnPlato'=>$alimentosEnPlato,'usaSalYodada'=>$usaSalYodada,'tomaSuplementoHierro'=>$tomaSuplementoHierro,'tomaSuplementoVitamina'=>$tomaSuplementoVitamina,'recibeMicronutrientes'=>$recibeMicronutrientes,'opcionBeneficiarioPrograma'=>$opcionBeneficiarioPrograma,'descripcionPrograma'=>$descripcionPrograma)); 
        if($data[0]!=''){
            $query = "UPDATE prestacionEvaluacionLME SET $data[0] WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarPrestacionEvaluacionLME($idprestacionEvaluacionLME,$claveGeneral){
        $query = "DELETE FROM prestacionEvaluacionLME WHERE idprestacionEvaluacionLME = '$idprestacionEvaluacionLME' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>

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
class AntecedentePsicosocial {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarAntecedentePsicosocialVector($idpersona, $claveGeneral){
        $query = "SELECT idantecedentePsicosocial, claveGeneral, idpersona, opcionAlcohol, cantidadAlcohol, frecuenciaAlcohol, nroVecesAlcohol, opcionTabaco, nroCigarros, nroCajetillas, frecuenciaTabaco, nroVecesTabaco, opcionDroga, frecuenciaDroga, nroVecesDroga, opcionHojaCoca, frecuenciaHojaCoca, nroVecesHojaCoca, opcionPornografia, horasPornografia, opcionPandilla, opcionVideoJuego, horaVideoJuego, opcionDelincuencia, opcionViolenciaFisica, opcionViolenciaPsicologica, opcionViolenciaSexual, opcionBullyng, opcionTrabaja, edadInicioTrabajo, tipoTrabajo, riesgoOcupacional, opcionAnorexia, opcionSuicidio, opcionDesercion, opcionRepitencia, opcionViolenciaNegligencia, opcionViolenciaPolitica
                FROM antecedentePsicosocial WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral' ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'+'.$row[1].'+'.$row[2].'+'.$row[3].'+'.$row[4].'+'.$row[5].'+'.$row[6].'+'.$row[7].'+'.$row[8].'+'.$row[9].'+'.$row[10].'+'.$row[11].'+'.$row[12].'+'.$row[13].'+'.$row[14].'+'.$row[15].'+'.$row[16].'+'.$row[17].'+'.$row[18].'+'.$row[19].'+'.$row[20].'+'.$row[21].'+'.$row[22].'+'.$row[23].'+'.$row[24].'+'.$row[25].'+'.$row[26].'+'.$row[27].'+'.$row[28].'+'.$row[29].'+'.$row[30].'+'.$row[31].'+'.$row[32].'+'.$row[33].'+'.$row[34].'+'.$row[35].'+'.$row[36].'+'.$row[37].'+'.$row[38].'+'.$row[39].'+'.$row[40];
    }
    
    public function agregarAntecedentePsicosocial($idantecedentePsicosocial, $claveGeneral, $idpersona, $opcionAlcohol, $cantidadAlcohol, $frecuenciaAlcohol, $nroVecesAlcohol, $opcionTabaco, $nroCigarros, $nroCajetillas, $frecuenciaTabaco, $nroVecesTabaco, $opcionDroga, $frecuenciaDroga, $nroVecesDroga, $opcionHojaCoca, $frecuenciaHojaCoca, $nroVecesHojaCoca, $opcionPornografia, $horasPornografia, $opcionPandilla, $opcionVideoJuego, $horaVideoJuego, $opcionDelincuencia, $opcionViolenciaFisica, $opcionViolenciaPsicologica, $opcionViolenciaSexual, $opcionBullyng, $opcionTrabaja, $edadInicioTrabajo, $tipoTrabajo, $riesgoOcupacional, $opcionAnorexia, $opcionSuicidio, $opcionDesercion, $opcionRepitencia, $opcionViolenciaNegligencia, $opcionViolenciaPolitica){
        $data = verificarDatos('add', array(
            'idantecedentePsicosocial'=>$idantecedentePsicosocial, 
            'claveGeneral'=>$claveGeneral, 
            'idpersona'=>$idpersona, 
            'opcionAlcohol'=>$opcionAlcohol, 
            'cantidadAlcohol'=>$cantidadAlcohol, 
            'frecuenciaAlcohol'=>$frecuenciaAlcohol, 
            'nroVecesAlcohol'=>$nroVecesAlcohol, 
            'opcionTabaco'=>$opcionTabaco, 
            'nroCigarros'=>$nroCigarros, 
            'nroCajetillas'=>$nroCajetillas, 
            'frecuenciaTabaco'=>$frecuenciaTabaco,  
            'nroVecesTabaco'=>$nroVecesTabaco, 
            'opcionDroga'=>$opcionDroga, 
            'frecuenciaDroga'=>$frecuenciaDroga, 
            'nroVecesDroga'=>$nroVecesDroga, 
            'opcionHojaCoca'=>$opcionHojaCoca, 
            'frecuenciaHojaCoca'=>$frecuenciaHojaCoca, 
            'nroVecesHojaCoca'=>$nroVecesHojaCoca, 
            'opcionPornografia'=>$opcionPornografia, 
            'horasPornografia'=>$horasPornografia, 
            'opcionPandilla'=>$opcionPandilla, 
            'opcionVideoJuego'=>$opcionVideoJuego, 
            'horaVideoJuego'=>$horaVideoJuego, 
            'opcionDelincuencia'=>$opcionDelincuencia, 
            'opcionViolenciaFisica'=>$opcionViolenciaFisica,  
            'opcionViolenciaPsicologica'=>$opcionViolenciaPsicologica, 
            'opcionViolenciaSexual'=>$opcionViolenciaSexual, 
            'opcionBullyng'=>$opcionBullyng, 
            'opcionTrabaja'=>$opcionTrabaja, 
            'edadInicioTrabajo'=>$edadInicioTrabajo, 
            'tipoTrabajo'=>$tipoTrabajo, 
            'riesgoOcupacional'=>$riesgoOcupacional, 
            'opcionAnorexia'=>$opcionAnorexia, 
            'opcionSuicidio'=>$opcionSuicidio, 
            'opcionDesercion'=>$opcionDesercion, 
            'opcionRepitencia'=>$opcionRepitencia,  
            'opcionViolenciaNegligencia'=>$opcionViolenciaNegligencia, 
            'opcionViolenciaPolitica'=>$opcionViolenciaPolitica
        ));
        if($data[0]!=''){
            $query = "INSERT INTO antecedentePsicosocial($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarAntecedentePsicosocial($idantecedentePsicosocial, $claveGeneral, $idpersona, $opcionAlcohol, $cantidadAlcohol, $frecuenciaAlcohol, $nroVecesAlcohol, $opcionTabaco, $nroCigarros, $nroCajetillas, $frecuenciaTabaco, $nroVecesTabaco, $opcionDroga, $frecuenciaDroga, $nroVecesDroga, $opcionHojaCoca, $frecuenciaHojaCoca, $nroVecesHojaCoca, $opcionPornografia, $horasPornografia, $opcionPandilla, $opcionVideoJuego, $horaVideoJuego, $opcionDelincuencia, $opcionViolenciaFisica, $opcionViolenciaPsicologica, $opcionViolenciaSexual, $opcionBullyng, $opcionTrabaja, $edadInicioTrabajo, $tipoTrabajo, $riesgoOcupacional, $opcionAnorexia, $opcionSuicidio, $opcionDesercion, $opcionRepitencia, $opcionViolenciaNegligencia, $opcionViolenciaPolitica){
        $data = verificarDatos('edit', array(
            'idantecedentePsicosocial'=>$idantecedentePsicosocial, 
            'claveGeneral'=>$claveGeneral, 
            'idpersona'=>$idpersona, 
            'opcionAlcohol'=>$opcionAlcohol, 
            'cantidadAlcohol'=>$cantidadAlcohol, 
            'frecuenciaAlcohol'=>$frecuenciaAlcohol, 
            'nroVecesAlcohol'=>$nroVecesAlcohol, 
            'opcionTabaco'=>$opcionTabaco, 
            'nroCigarros'=>$nroCigarros, 
            'nroCajetillas'=>$nroCajetillas, 
            'frecuenciaTabaco'=>$frecuenciaTabaco,  
            'nroVecesTabaco'=>$nroVecesTabaco, 
            'opcionDroga'=>$opcionDroga, 
            'frecuenciaDroga'=>$frecuenciaDroga, 
            'nroVecesDroga'=>$nroVecesDroga, 
            'opcionHojaCoca'=>$opcionHojaCoca, 
            'frecuenciaHojaCoca'=>$frecuenciaHojaCoca, 
            'nroVecesHojaCoca'=>$nroVecesHojaCoca, 
            'opcionPornografia'=>$opcionPornografia, 
            'horasPornografia'=>$horasPornografia, 
            'opcionPandilla'=>$opcionPandilla, 
            'opcionVideoJuego'=>$opcionVideoJuego, 
            'horaVideoJuego'=>$horaVideoJuego, 
            'opcionDelincuencia'=>$opcionDelincuencia, 
            'opcionViolenciaFisica'=>$opcionViolenciaFisica,  
            'opcionViolenciaPsicologica'=>$opcionViolenciaPsicologica, 
            'opcionViolenciaSexual'=>$opcionViolenciaSexual, 
            'opcionBullyng'=>$opcionBullyng, 
            'opcionTrabaja'=>$opcionTrabaja, 
            'edadInicioTrabajo'=>$edadInicioTrabajo, 
            'tipoTrabajo'=>$tipoTrabajo, 
            'riesgoOcupacional'=>$riesgoOcupacional, 
            'opcionAnorexia'=>$opcionAnorexia, 
            'opcionSuicidio'=>$opcionSuicidio, 
            'opcionDesercion'=>$opcionDesercion, 
            'opcionRepitencia'=>$opcionRepitencia,  
            'opcionViolenciaNegligencia'=>$opcionViolenciaNegligencia, 
            'opcionViolenciaPolitica'=>$opcionViolenciaPolitica
        ));
        if($data[0]!=''){
            $query = "UPDATE antecedentePsicosocial SET $data[0] WHERE idantecedentePsicosocial = $idantecedentePsicosocial AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminar($id, $claveGeneral){
        $query = "DELETE FROM tabla WHERE id = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>
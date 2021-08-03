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
class AntecedenteSexual {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarAntecedenteSexual( $idpersona, $claveGeneral) {
        $query = "SELECT idantecedenteSexual, claveGeneral, idpersona, menarquia, regimenCatamenial, opcionPAP, mesAnioPAP, resultadoPAP, detallePAP, opcionIVAA, mesAnioIVAA, resultadoIVAA, idcatalogoCIE10IVAA, nombreCIE10IVAA, opcionMamas, mesAnioMamas, tipoMamas, resultadoMamas, idcatalogoCIE10Mamas, nombreCIE10Mamas, opcionProstatico, mesAnioProstatico, resultadoProstatico, idcatalogoCIE10Prostatico, nombreCIE10Prostatico, opcionTactoRectal, resultadoTactoRectal, idcatalogoCIE10Tacto, nombreCIE10Tacto, edadInicioRelacion, opcionParejaSexual, nroParejaSexual, edadParejaSexual, opcionActividadSexual, opcionMetodoAnticonceptivo, tiempoMetodo, metodoAnticonceptivo, tipo, fechaRegistro 
                    FROM antecedenteSexual WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'
        ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'+'.$row[1].'+'.$row[2].'+'.$row[3].'+'.$row[4].'+'.$row[5].'+'.$row[6].'+'.$row[7].'+'.$row[8].'+'.$row[9].'+'.$row[10].'+'.$row[11].'+'.$row[12].'+'.$row[13].'+'.$row[14].'+'.$row[15].'+'.$row[16].'+'.$row[17].'+'.$row[18].'+'.$row[19].'+'.$row[20].'+'.$row[21].'+'.$row[22].'+'.$row[23].'+'.$row[24].'+'.$row[25].'+'.$row[26].'+'.$row[27].'+'.$row[28].'+'.$row[29].'+'.$row[30].'+'.$row[31].'+'.$row[32].'+'.$row[33].'+'.$row[34].'+'.$row[35].'+'.$row[36].'+'.$row[37].'+'.$row[38].'+'.$row[39].'+'.$row[40].'+'.$row[41].'+'.$row[42].'+'.$row[43].'+'.$row[44].'+'.$row[45].'+'.$row[46];
    }
    
    public function agregarAntecedenteSexual($idantecedenteSexual, $claveGeneral, $idpersona, $menarquia, $regimenCatamenial, $opcionPAP, $mesAnioPAP, $resultadoPAP, $detallePAP, $opcionIVAA, $mesAnioIVAA, $resultadoIVAA, $idcatalogoCIE10IVAA, $nombreCIE10IVAA, $opcionMamas, $mesAnioMamas, $tipoMamas, $resultadoMamas, $idcatalogoCIE10Mamas, $nombreCIE10Mamas, $opcionProstatico, $mesAnioProstatico, $resultadoProstatico, $idcatalogoCIE10Prostatico, $nombreCIE10Prostatico, $opcionTactoRectal, $resultadoTactoRectal, $idcatalogoCIE10Tacto, $nombreCIE10Tacto, $edadInicioRelacion, $opcionParejaSexual, $nroParejaSexual, $edadParejaSexual, $opcionActividadSexual, $opcionMetodoAnticonceptivo, $tiempoMetodo, $metodoAnticonceptivo, $tipo, $fechaRegistro){
        $data = verificarDatos('add', array('idantecedenteSexual'=>$idantecedenteSexual,
            'claveGeneral'=>$claveGeneral, 
            'idpersona'=>$idpersona, 
            'menarquia'=>$menarquia, 
            'regimenCatamenial'=>$regimenCatamenial, 
            'opcionPAP'=>$opcionPAP, 
            'mesAnioPAP'=>$mesAnioPAP, 
            'resultadoPAP'=>$resultadoPAP, 
            'detallePAP'=>$detallePAP, 
            'opcionIVAA'=>$opcionIVAA, 
            'mesAnioIVAA'=>$mesAnioIVAA, 
            'resultadoIVAA'=>$resultadoIVAA, 
            'idcatalogoCIE10IVAA'=>$idcatalogoCIE10IVAA, 
            'nombreCIE10IVAA'=>$nombreCIE10IVAA, 
            'opcionMamas'=>$opcionMamas, 
            'mesAnioMamas'=>$mesAnioMamas, 
            'tipoMamas'=>$tipoMamas, 
            'resultadoMamas'=>$resultadoMamas, 
            'idcatalogoCIE10Mamas'=>$idcatalogoCIE10Mamas, 
            'nombreCIE10Mamas'=>$nombreCIE10Mamas, 
            'opcionProstatico'=>$opcionProstatico, 
            'mesAnioProstatico'=>$mesAnioProstatico, 
            'resultadoProstatico'=>$resultadoProstatico, 
            'idcatalogoCIE10Prostatico'=>$idcatalogoCIE10Prostatico, 
            'nombreCIE10Prostatico'=>$nombreCIE10Prostatico, 
            'opcionTactoRectal'=>$opcionTactoRectal, 
            'resultadoTactoRectal'=>$resultadoTactoRectal, 
            'idcatalogoCIE10Tacto'=>$idcatalogoCIE10Tacto,
            'nombreCIE10Tacto'=>$nombreCIE10Tacto,
            'edadInicioRelacion'=>$edadInicioRelacion, 
            'opcionParejaSexual'=>$opcionParejaSexual, 
            'nroParejaSexual'=>$nroParejaSexual, 
            'edadParejaSexual'=>$edadParejaSexual, 
            'opcionActividadSexual'=>$opcionActividadSexual, 
            'opcionMetodoAnticonceptivo'=>$opcionMetodoAnticonceptivo, 
            'tiempoMetodo'=>$tiempoMetodo, 
            'metodoAnticonceptivo'=>$metodoAnticonceptivo, 
            'tipo'=>$tipo, 
            'fechaRegistro'=>$fechaRegistro));
        if($data[0]!=''){
            $query = "INSERT INTO antecedenteSexual($data[0]) VALUES($data[1])";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function actualizarAntecedenteSexual($idantecedenteSexual, $claveGeneral, $idpersona, $menarquia, $regimenCatamenial, $opcionPAP, $mesAnioPAP, $resultadoPAP, $detallePAP, $opcionIVAA, $mesAnioIVAA, $resultadoIVAA, $idcatalogoCIE10IVAA, $nombreCIE10IVAA, $opcionMamas, $mesAnioMamas, $tipoMamas, $resultadoMamas, $idcatalogoCIE10Mamas, $nombreCIE10Mamas, $opcionProstatico, $mesAnioProstatico, $resultadoProstatico, $idcatalogoCIE10Prostatico, $nombreCIE10Prostatico, $opcionTactoRectal, $resultadoTactoRectal, $idcatalogoCIE10Tacto, $nombreCIE10Tacto, $edadInicioRelacion, $opcionParejaSexual, $nroParejaSexual, $edadParejaSexual, $opcionActividadSexual, $opcionMetodoAnticonceptivo, $tiempoMetodo, $metodoAnticonceptivo, $tipo, $fechaRegistro){
        $data = verificarDatos('edit', array('idantecedenteSexual'=>$idantecedenteSexual,
            'claveGeneral'=>$claveGeneral, 
            'idpersona'=>$idpersona, 
            'menarquia'=>$menarquia, 
            'regimenCatamenial'=>$regimenCatamenial, 
            'opcionPAP'=>$opcionPAP, 
            'mesAnioPAP'=>$mesAnioPAP, 
            'resultadoPAP'=>$resultadoPAP, 
            'detallePAP'=>$detallePAP, 
            'opcionIVAA'=>$opcionIVAA, 
            'mesAnioIVAA'=>$mesAnioIVAA, 
            'resultadoIVAA'=>$resultadoIVAA, 
            'idcatalogoCIE10IVAA'=>$idcatalogoCIE10IVAA, 
            'nombreCIE10IVAA'=>$nombreCIE10IVAA, 
            'opcionMamas'=>$opcionMamas, 
            'mesAnioMamas'=>$mesAnioMamas, 
            'tipoMamas'=>$tipoMamas, 
            'resultadoMamas'=>$resultadoMamas, 
            'idcatalogoCIE10Mamas'=>$idcatalogoCIE10Mamas, 
            'nombreCIE10Mamas'=>$nombreCIE10Mamas, 
            'opcionProstatico'=>$opcionProstatico, 
            'mesAnioProstatico'=>$mesAnioProstatico, 
            'resultadoProstatico'=>$resultadoProstatico, 
            'idcatalogoCIE10Prostatico'=>$idcatalogoCIE10Prostatico, 
            'nombreCIE10Prostatico'=>$nombreCIE10Prostatico, 
            'opcionTactoRectal'=>$opcionTactoRectal, 
            'resultadoTactoRectal'=>$resultadoTactoRectal, 
            'idcatalogoCIE10Tacto'=>$idcatalogoCIE10Tacto,
            'nombreCIE10Tacto'=>$nombreCIE10Tacto,
            'edadInicioRelacion'=>$edadInicioRelacion, 
            'opcionParejaSexual'=>$opcionParejaSexual, 
            'nroParejaSexual'=>$nroParejaSexual, 
            'edadParejaSexual'=>$edadParejaSexual, 
            'opcionActividadSexual'=>$opcionActividadSexual, 
            'opcionMetodoAnticonceptivo'=>$opcionMetodoAnticonceptivo, 
            'tiempoMetodo'=>$tiempoMetodo, 
            'metodoAnticonceptivo'=>$metodoAnticonceptivo, 
            'tipo'=>$tipo, 
            'fechaRegistro'=>$fechaRegistro));
        if($data[0]!=''){
            $query = "UPDATE antecedenteSexual SET $data[0] WHERE idAntecedenteSexual = $idantecedenteSexual AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminar($id){
        $query = "DELETE FROM tabla WHERE id = $id";
        mysql_query($query);
    }
}
?>
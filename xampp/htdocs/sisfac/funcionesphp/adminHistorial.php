<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
session_start();
if(!isset($_SESSION['idusu'])) header("location:/sisfac/");

require_once '../clases/claseUsuario.php';
require_once '../clases/claseHistorial.php';
require_once '../clases/claseFamilia.php';
require_once '../clases/claseCiclo.php';
require_once '../clases/claseSocioEconomico.php';
require_once '../clases/claseEntorno.php';
require_once '../clases/claseDatoGeneral.php';
$usuario = new Usuario;
$historial = new Historial();
$familia = new Familia();
$ciclo = new Ciclo();
$socioeconomico = new SocioEconomico();
$entorno = new Entorno();
$datoGeneral = new DatoGeneral();

if ($_REQUEST['f'] == 1) {

 
    if($usuario->buscarUsuario($_REQUEST[idtrabajadorregistro], md5($_REQUEST[clave]))){
    //if(1==1){
        //GUARDAR FICHA
        $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], $_REQUEST[idsector], $_REQUEST[idtrabajadorregistro], $_REQUEST[numeroVivienda], $_REQUEST[codigoFamilia], $_REQUEST[fechaApertura], $_REQUEST[nombreFamilia], $_REQUEST[lote], $_REQUEST[telefono], $_REQUEST[correo], $_REQUEST[referencia], $_REQUEST[tipoEntorno], $_REQUEST[idioma1], $_REQUEST[idioma2], $_REQUEST[idioma3], $_REQUEST[tiempoDemora], $_REQUEST[tiempoDomicilio], $_REQUEST[viviendaAnterior], $_REQUEST[medioTransporte], $_REQUEST[religion], $_REQUEST[diaVisita], $_REQUEST[horaVisita], $_REQUEST[tipoFamilia], $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[registrador], $_REQUEST[opcion]);
        $ciclo->eliminarCicloFamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
        $array = explode('*', $_REQUEST[idsciclo]);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($ciclo->buscarCicloIdfamiliaCodEntrono($_REQUEST[idfamilia], $data[0], $_REQUEST[claveGeneral])=='0'  && $data[0]!='')
                    $ciclo->agregarCiclo($_REQUEST[claveGeneral],$datoGeneral->obtenerMaximoID('idciclo', 'ciclo'),$_REQUEST[idfamilia], $data[0], $data[1]);
        }
        //GUARDA DATOS SOCIOECONOMICOS
        $socioeconomico->elimiarSocioEconomico($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
        $array = explode('+', $_REQUEST['valores']);
        foreach ($array as $value) {
            $data = explode('-', $value);
            $socioeconomico->agregarSocioEconomico($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsocioeconomico', 'socioeconomico'), $_REQUEST[idfamilia], $data[0], $data[1], $data[2]);
        }
        //GUARDA DATOS DE ENTORNO
        $entorno->eliminarEntorno($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        $array = explode('*', $_REQUEST[entorno]);
        foreach ($array as $value) {
            $data = explode('-', $value);
            foreach ($data as $lista) {
                $temp = explode('+', $lista);
                if($entorno->buscarEntornoIdfamiliaCodEntrono($_REQUEST[idfamilia], $temp[2]) == '0' && $temp[2]!=''){
                    $entorno->agregarEntorno($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('identorno', 'entorno'), $_REQUEST[idfamilia], $temp[0], $temp[1], $temp[2]);
                }
            }
        }
        
        //GUARDAR HISTORIAL
        $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NO');//'NO' ES PARA EDITAR EL REGISTRO DE LA FICHA
        $historial->actualizarHistorial($familia->buscarCodigoFichaIdfamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]), $_REQUEST[claveGeneral]);
        $historial->agregarFamiliaHistorial ($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idfamiliaH', 'familiaH'), $_REQUEST[idfamilia], $_REQUEST[registrador], $_REQUEST[trabajador], '');
        
        $result = $historial->obtenerCicloFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarCicloHistorial($row[0], $datoGeneral->obtenerMaximoIDHistorial('idcicloH', 'cicloH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1]);
        }
        
        $result = $historial->obtenerEntornoFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarEntornoHistorial($row[0],$datoGeneral->obtenerMaximoIDHistorial('identornoH', 'entornoH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2]);
        }
        
        
        $result = $historial->obtenerSocioeconomicoFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarSocioEconomicoHistorial($row[0],$datoGeneral->obtenerMaximoIDHistorial('idsocioeconomicoH', 'socioeconomicoH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2], $row[3]);
        }
        
        
        
        $result = $historial->obtenerVisitaFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_row($result)) {
            $historial->agregarVisitaHistorial($row[0], $datoGeneral->obtenerMaximoIDHistorial('idvisitaH', 'visitaH'), $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
        }
        
        
        
        $result = $historial->obtenerPersonaVector($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        
        while ($row = mysql_fetch_array($result)) {
                                                        //$iddistrito, $idfamilia, $numeroHC, $opcionDNI, $dni, $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $fechaNacimiento, $gradoInstruccion, $seguroMedico, $numeroSeguro, $ocupacion, $tipoOcupacion, $parentesco, $estadoCivil, $jefeFamilia, $pertenenciaEtnica, $desendenciaEtnica,$activo, $motivo, grupoSanguineo, grupoRiesgo, opcionLugarResidencia, lugarResidencia, contacto, telefonoContacto, parentescoContacto
            $historial->agregarPersonaHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idpersonaH', 'personaH'), $row[2], $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], $row[19], $row[20], $row[21], $row[22], $row[23], $row[24], $row[25], $row[26], $row[27], $row[28], $row[29]);
            $result1 = $historial->obtenerRiesgo($row[0], $_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
            while ($row1 = mysql_fetch_array($result1)) {
                $historial->agregarRiesgoHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idriesgoH', 'riesgoH'),$historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row1[0], $row1[1], $row1[2]);
            }

            
            $result1 = $historial->obtenerCondicion($row[0], $_REQUEST[claveGeneral]);
            $result2 = $historial->obtenerSindromeCultural($row[0], $_REQUEST[claveGeneral]);

            while ($row1 = mysql_fetch_array($result1)) {

                $historial->agregarCondicionHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idcondicionH', 'condicionH'), $historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $row1[0], $row1[1]);
            }

            while ($row2 = mysql_fetch_array($result2)) {

                $historial->agregarSindromeCulturalHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsindromeculturalH', 'sindromeculturalH'), $historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $row2[0], $row2[1]);
            }
        }
        /*
        $result1 = $historial->obtenerRiesgoFamilia($_REQUEST[idfamilia]);
        while ($row1 = mysql_fetch_array($result1)) {
            $historial->agregarRiesgoHistorial('', $historial->obtenerIDFamiliaHistorial(), $row1[0], $row1[1], $row1[2]);
        }*/

        $codigoFicha = $familia->buscarCodigoFichaIdfamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
        //Algoritmo de limpieza de historial 2019 MB
         $historial->limpiarHistorial($codigoFicha,$_REQUEST[claveGeneral]);  
    }else{
        echo "Error";
    }
}
elseif($_REQUEST['f'] == 2) $historial->mostrarFamiliaHistoricoDatagrid($_REQUEST[activo],  formatoFecha($_REQUEST['fechaInicio']),  formatoFecha($_REQUEST['fechaFin']));
elseif($_REQUEST['f'] == 3){
    if($usuario->buscarUsuario($_REQUEST[idtrabajadorregistro], md5($_REQUEST[clave]))){
        //GUARDAR FICHA
        $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], $_REQUEST[idsector], $_REQUEST[idtrabajadorregistro], $_REQUEST[numeroVivienda], $_REQUEST[codigoFamilia], $_REQUEST[fechaApertura], $_REQUEST[nombreFamilia], $_REQUEST[lote], $_REQUEST[telefono], $_REQUEST[correo], $_REQUEST[referencia], $_REQUEST[tipoEntorno], $_REQUEST[idioma1], $_REQUEST[idioma2], $_REQUEST[idioma3], $_REQUEST[tiempoDemora], $_REQUEST[tiempoDomicilio], $_REQUEST[viviendaAnterior], $_REQUEST[medioTransporte], $_REQUEST[religion], $_REQUEST[diaVisita], $_REQUEST[horaVisita], $_REQUEST[tipoFamilia], $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[registrador], $_REQUEST[opcion]);
        $ciclo->eliminarCicloFamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
        $array = explode('*', $_REQUEST[idsciclo]);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($ciclo->buscarCicloIdfamiliaCodEntrono($_REQUEST[idfamilia], $data[0], $_REQUEST[claveGeneral])=='0'  && $data[0]!='')
                    $ciclo->agregarCiclo($_REQUEST[claveGeneral],$datoGeneral->obtenerMaximoID('idciclo', 'ciclo'),$_REQUEST[idfamilia], $data[0], $data[1]);
        }
        //GUARDA DATOS SOCIOECONOMICOS
        $socioeconomico->elimiarSocioEconomico($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);
        $array = explode('+', $_REQUEST['valores']);
        foreach ($array as $value) {
            $data = explode('-', $value);
            $socioeconomico->agregarSocioEconomico($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsocioeconomico', 'socioeconomico'), $_REQUEST[idfamilia], $data[0], $data[1], $data[2]);
        }
        //GUARDA DATOS DE ENTORNO
        $entorno->eliminarEntorno($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        $array = explode('*', $_REQUEST[entorno]);
        foreach ($array as $value) {
            $data = explode('-', $value);
            foreach ($data as $lista) {
                $temp = explode('+', $lista);
                if($entorno->buscarEntornoIdfamiliaCodEntrono($_REQUEST[idfamilia], $temp[2]) == '0' && $temp[2]!=''){
                    $entorno->agregarEntorno($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('identorno', 'entorno'), $_REQUEST[idfamilia], $temp[0], $temp[1], $temp[2]);
                }
            }
        }
        
        $idHistorial = $historial->buscarIdHistorialMaximo($familia->buscarCodigoFichaIdfamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]), $_REQUEST[claveGeneral]);
        $fechaHistorial = $historial->buscarFechaHistorialMaximo($idHistorial, $_REQUEST[claveGeneral]);
        //echo $fechaHistorial."sss<br>";
        $historial->eliminarCondicionHistorial($idHistorial, $_REQUEST[claveGeneral]);
        $historial->eliminarSindromeCulturalHistorial($idHistorial, $_REQUEST[claveGeneral]);
        $historial->eliminarHistorial($idHistorial, $_REQUEST[claveGeneral]);
        

        //GUARDAR HISTORIAL
        $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NO');//'NO' ES PARA EDITAR EL REGISTRO DE LA FICHA
        $historial->actualizarHistorial($familia->buscarCodigoFichaIdfamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]), $_REQUEST[claveGeneral]);
        
        
        $historial->agregarFamiliaHistorial ($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idfamiliaH', 'familiaH'), $_REQUEST[idfamilia], $_REQUEST[registrador], $_REQUEST[trabajador], $fechaHistorial);
        //echo $historial->buscarFechaHistorialMaximo($idHistorial, $_REQUEST[claveGeneral])."<br>".$idHistorial."<br>";
        $result = $historial->obtenerCicloFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarCicloHistorial($row[0], $datoGeneral->obtenerMaximoIDHistorial('idcicloH', 'cicloH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1]);
        }
        
        $result = $historial->obtenerEntornoFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarEntornoHistorial($row[0],$datoGeneral->obtenerMaximoIDHistorial('identornoH', 'entornoH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2]);
        }
        
        
        $result = $historial->obtenerSocioeconomicoFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_array($result)) {
            $historial->agregarSocioEconomicoHistorial($row[0],$datoGeneral->obtenerMaximoIDHistorial('idsocioeconomicoH', 'socioeconomicoH'),$historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2], $row[3]);
        }
        
        
        
        $result = $historial->obtenerVisitaFamilia($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        while ($row = mysql_fetch_row($result)) {
            $historial->agregarVisitaHistorial($row[0], $datoGeneral->obtenerMaximoIDHistorial('idvisitaH', 'visitaH'), $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
        }
        
        
        
        $result = $historial->obtenerPersonaVector($_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
        
        while ($row = mysql_fetch_array($result)) {
                                                        //$iddistrito, $idfamilia, $numeroHC, $opcionDNI, $dni, $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $fechaNacimiento, $gradoInstruccion, $seguroMedico, $numeroSeguro, $ocupacion, $tipoOcupacion, $parentesco, $estadoCivil, $jefeFamilia, $pertenenciaEtnica, $desendenciaEtnica,$activo, $motivo
            $historial->agregarPersonaHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idpersonaH', 'personaH'), $row[2], $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], $row[19], $row[20], $row[21], $row[22]);
            $result1 = $historial->obtenerRiesgo($row[0], $_REQUEST[idfamilia], $_REQUEST[claveGeneral]);
            while ($row1 = mysql_fetch_array($result1)) {
                $historial->agregarRiesgoHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoIDHistorial('idriesgoH', 'riesgoH'),$historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $historial->obtenerIDFamiliaHistorial($_REQUEST[claveGeneral]), $row1[0], $row1[1], $row1[2]);
            }
            $result1 = $historial->obtenerCondicion($row[0], $_REQUEST[claveGeneral]);
            while ($row1 = mysql_fetch_array($result1)) {
                $historial->agregarCondicionHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idcondicionH', 'condicionH'), $historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $row1[0], $row1[1]);
            }
            $result2 = $historial->obtenerSindromeCultural($row[0], $_REQUEST[claveGeneral]);
            while ($row2 = mysql_fetch_array($result2)) {
                $historial->agregarSindromeCulturalHistorial($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsindromeculturalH', 'sindromeculturalH'), $historial->obtenerIDPersonaHistorial($_REQUEST[claveGeneral]), $row2[0], $row2[1]);
            }
        }

        $codigoFicha = $familia->buscarCodigoFichaIdfamilia($_REQUEST[idfamilia],$_REQUEST[claveGeneral]);

        //Algoritmo de limpieza de historial 2019 MB
         $historial->limpiarHistorial($codigoFicha, $_REQUEST[claveGeneral]);

        
    }else{
        echo "Error";
    }
}
else if($_REQUEST['f']==4){
    //claveGeneral,idfamiliaH
    $id = explode(',', $_REQUEST['id']);
    echo $id[0].'-'.$id[1];
    $historial->eliminarCondicionHistorial($id[1], $id[0]);
    $historial->eliminarSindromeCulturalHistorial($id[1], $id[0]);
    $historial->eliminarHistorial($id[1], $id[0]);
}

?>
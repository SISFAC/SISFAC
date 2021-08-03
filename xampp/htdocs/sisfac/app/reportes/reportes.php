<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/

ini_set('max_execution_time', 30000);
require_once '../../java/Java.inc';
include '../../funcionesphp/jasper.php';
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();
$jreport = new Jasper("root", "","jdbc:mysql://localhost:3306/bdsicfic");
if($_REQUEST['f']==1){
    
    if($_REQUEST['atributo1'] == 'SOCIOECONOMICO') {
        if($_REQUEST['atributo'] == 'DISA/DIRESA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_diresa.jrxml");
        }
        if($_REQUEST['atributo'] == 'REGION') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_region.jrxml");
        }
        if($_REQUEST['atributo'] == 'PROVINCIA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_provincia.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'DISTRITO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_distrito.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'SECTOR') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_sector.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_comunidad.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_establecimiento.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'NUCLEO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_nucleo.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'RED') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_red.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'MICRORED') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_microred.jrxml");
        }
    }else{
        
        if($_REQUEST['atributo'] == 'DISA/DIRESA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_diresa.jrxml");
        }
        if($_REQUEST['atributo'] == 'REGION') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_region.jrxml");
        }
        if($_REQUEST['atributo'] == 'PROVINCIA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_provincia.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'DISTRITO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_distrito.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'SECTOR') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_sector.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_comunidad.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_establecimiento.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'NUCLEO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_nucleo.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'RED') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_red.jrxml");
        }
        elseif($_REQUEST['atributo'] == 'MICRORED') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_microred.jrxml");
        }
    }
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
    
}elseif($_REQUEST['f']==2){
    
    if($_REQUEST[atributo1]=='ALTO RIESGO') {
        $puntini = 6;
        $puntfin = 100;
    }
    elseif($_REQUEST[atributo1]=='MEDIANO RIESGO') {
        $puntini = 3;
        $puntfin = 5;
    }
    elseif($_REQUEST[atributo1]=='BAJO RIESGO') {
        $puntini = 0;
        $puntfin = 2;
    }
    
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_etapavida_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_etapavida_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_etapavida_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_etapavida_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_etapavida_establecimiento.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"titulo"=>$_REQUEST[titulo],"puntini"=>(int)$puntini,"puntfin"=>(int)$puntfin);
    
}elseif($_REQUEST['f']==3){
    if($_REQUEST[atributo1]=='ALTO RIESGO') {
        $puntini = 37;
        $puntfin = 55;
    }
    elseif($_REQUEST[atributo1]=='MEDIANO RIESGO') {
        $puntini = 24;
        $puntfin = 36;
    }
    elseif($_REQUEST[atributo1]=='BAJO RIESGO') {
        $puntini = 11;
        $puntfin = 23;
    }
    
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_socioeconomico_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_socioeconomico_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_socioeconomico_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_socioeconomico_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_socioeconomico_establecimiento.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"titulo"=>$_REQUEST[titulo],"puntini"=>(int)$puntini,"puntfin"=>(int)$puntfin);
    
}elseif($_REQUEST['f']==4){
    
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_riesgo_paifam.jrxml");
    $map = array("codigo"=>(int)$_REQUEST['idfamilia'],"clave"=>$_REQUEST['clave']);
    
}elseif($_REQUEST['f']==5){
    
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_programacion.jrxml");
    $map = array("codigo"=>(int)$_REQUEST['idfamilia']);
    
}elseif($_REQUEST['f']==6){
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_visitadomiciliaria.jrxml");
    $map = array("codigo"=>(int)$_REQUEST['idfamilia']);
}elseif($_REQUEST['f']==7){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==8){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==9){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_gestante_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==10){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==11){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==12){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==13){
    
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    
    if($_REQUEST['atributo1'] == 'SOCIOECONOMICO') {
        if($_REQUEST['seleccion1'] == 'ESTADO CIVIL DEL JEFE DE FAMILIA'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_jefe.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'GRUPO FAMILIAR'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_grupo.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'TENENCIA DE LA VIVIENDA'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_tenencia.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'AGUA DE CONSUMO'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_agua.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'ELIMINACION DE EXCRETAS'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_eliminacion.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'CUANTAS HABITACIONES HAY EN HOGAR'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_habitacion.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'ENERGIA ELECTRICA(EE)'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_energia.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'NIVEL DE INSTRUCCION DE LA MADRE'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_nivel.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'OCUPACION JEFE DE LA FAMILIA'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_ocupacion.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'INGRESOS FAMILIARES'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_ingresos.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'NRO DE PERSONAS X DORMITORIO'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_personas.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'SALUD EN EL HOGAR'){
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_socioeconomico_tendencia_salud.jrxml");
        }
    }else{
        if($_REQUEST['seleccion1'] == 'TIPO DE VIVIENDA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_tipo.jrxml");
        }
        if($_REQUEST['seleccion1'] == 'MATERIAL DE PAREDES') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_paredes.jrxml");
        }
        if($_REQUEST['seleccion1'] == 'MATERIAL DEL PISO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_piso.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'MATERIAL DE TECHO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_techo.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'ORGANIZACION DE LA VIVIENDA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_organizacion.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'ARTEFACTOS DEL HOGAR') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_artefactos.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'COMBUSTIBLE PARA COCINAR') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_combustible.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'DISPOSICION DE BASURA') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_disposicion.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'TENENCIA DE ANIMALES') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_tenencias.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'VACUNAS') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_vacunas.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'RIESGO X ENTORNO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_riesgo.jrxml");
        }
        elseif($_REQUEST['seleccion1'] == 'BIOHUERTO') {
            $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_estadistico_entorno_tendencia_biohuerto.jrxml");
        }
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
    
    
}
elseif($_REQUEST['f']==14){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.idDiresa='$_REQUEST[seleccion1]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    
    /*
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_microred_tendencia.jrxml");
    }
    */
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_etapa_diresa_tendencia.jrxml");
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}
elseif($_REQUEST['f']==15){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    /*
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_microred_tendencia.jrxml");
    }*/
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_indocumentadas_diresa_tendencia.jrxml");
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}
elseif($_REQUEST['f']==16){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_numero_historiales_microred_tendencia.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==17){
    
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    
    
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_diresa_tendencia.jrxml");
    /*if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_instruccion_microred_tendencia.jrxml");
    }
    */
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}elseif($_REQUEST['f']==18){
    /*
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_microred_tendencia.jrxml");
    }*/
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_persona_seguro_diresa_tendencia.jrxml");
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}elseif($_REQUEST['f']==19){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_ciclo_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==20){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_tipo_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==21){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_etapas_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==22){
    
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    /*
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_microred_tendencia.jrxml");
    }*/
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_diresa_tendencia.jrxml");
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}elseif($_REQUEST['f']==23){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_diresa.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_region.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_provincia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_distrito.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_sector.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_comunidad.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_establecimiento.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_nucleo.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_red.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_riesgo_socioeconomico_microred.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}elseif($_REQUEST['f']==24){
    
    
    if($_REQUEST['atributo'] == 'DISA/DIRESA') $campo = "fam.nombreDiresa='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'REGION') $campo = "fam.nombreRegion='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'PROVINCIA') $campo = "fam.nompro='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'DISTRITO') $campo = "fam.nombre='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'SECTOR') $campo = "fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') $campo = "fam.nombreComunidad='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') $campo = "fam.nombreEstablecimiento='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'NUCLEO') $campo = "fam.nombreNucleo='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'RED') $campo = "fam.nombreRed='$_REQUEST[seleccion]'";
    elseif($_REQUEST['atributo'] == 'MICRORED') $campo = "fam.nombreMicrored='$_REQUEST[seleccion]'";
    
    
    /*if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_microred_tendencia.jrxml");
    }*/
    $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_familia_socioeconomico_diresa_tendencia.jrxml");
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59","campo"=>$campo);
}elseif($_REQUEST['f']==25){
    if($_REQUEST['atributo'] == 'DISA/DIRESA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_diresa_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'REGION') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_region_tendencia.jrxml");
    }
    if($_REQUEST['atributo'] == 'PROVINCIA') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_provincia_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'DISTRITO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_distrito_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'SECTOR') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_sector_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_comunidad_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_establecimiento_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'NUCLEO') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_nucleo_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'RED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_red_tendencia.jrxml");
    }
    elseif($_REQUEST['atributo'] == 'MICRORED') {
        $jreport->compileReport("C:/xampp/htdocs/sisfac/app/reportes/reporte_canes_familia_microred_tendencia.jrxml");
    }
    
    $map = array("codigo"=>$_REQUEST['seleccion'],"codigo1"=>$_REQUEST['codigo1'],"tipo"=>$_REQUEST[seleccion1],"titulo"=>$_REQUEST[titulo], "fechaInicio"=>  formatoFecha($_REQUEST[fechaInicio])." 00:00:01", "fechaFin"=>  formatoFecha($_REQUEST[fechaFin])." 23:59:59");
}

$jreport->setParams($map);
$jreport->toPDF();
?>
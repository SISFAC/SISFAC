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

require_once '../clases/claseAdministracionMicronutrientesNino.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseEquivalenciasCodigo.php';
require_once '../clases/claseHis.php';

$administracionMicronutrientesNino = new AdministracionMicronutrientesNino();
$datoGeneral = new DatoGeneral();
$equivalenciasCodigo = new EquivalenciasCodigo();
$his = new His();

if($_REQUEST[f] == 1) $administracionMicronutrientesNino->mostrarAdministracionMicronutrientesNinoDatagrid ();
elseif($_REQUEST[f] == 2) echo $administracionMicronutrientesNino->mostrarAdministracionMicronutrientesNinoVector ($_REQUEST[idcatalogoPrestacion], $_REQUEST[idpersona], $_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $administracionMicronutrientesNino->mostrarAdministracionMicronutrientesNinoCombobox(true);
elseif($_REQUEST[f] == 4) $administracionMicronutrientesNino->mostrarAdministracionMicronutrientesNinoCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idadministracionMicronutrientesNino])==''){
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $administracionMicronutrientesNino->agregarAdministracionMicronutrientesNino($datoGeneral->obtenerMaximoIDHistorial ('idadministracionMicronutrientesNino', 'administracionMicronutrientesNino'),$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[hierro],$_REQUEST[esquemaHierro],$_REQUEST[vitamina],$_REQUEST[esquemaVitamina],$_REQUEST[multimicronutrientes],$_REQUEST[esquemaMultimicronutrientes],formatoFecha($_REQUEST[fechaMicronutriente]),$_REQUEST[estadoMicronutriente],formatoFecha($_REQUEST[segimientoDomicilio1]),$_REQUEST[estadoSeguimiento1],formatoFecha($_REQUEST[segimientoDomicilio2]),$_REQUEST[estadoSeguimiento2],formatoFecha($_REQUEST[segimientoDomicilio3]),$_REQUEST[estadoSeguimiento3]);
            $temp .= ($datoGeneral->obtenerMaximoIDHistorial ('idadministracionMicronutrientesNino', 'administracionMicronutrientesNino') - 1).'*';
        }
        echo trim(substr($temp, 0, -1)) ;
        
        $codigoCPT = "Z298";
        $result = $equivalenciasCodigo->buscarEquivalencia($_REQUEST[idcatalogoEpisodio], $_REQUEST[idcatalogoPrestacion], $_REQUEST[hierro], $_REQUEST[vitamina], $_REQUEST[multimicronutrientes]);
        
        /*$lista = $equivalenciasCodigo->buscarEquivalencia($_REQUEST[idcatalogoEpisodio], $_REQUEST[idcatalogoPrestacion], $codigoCPT);
        $lista = explode('+', $lista);*/
        
        while ($lista = mysql_fetch_array($result)) {
            if($_REQUEST[hierro] == 'SI') $his->agregarHis($datoGeneral->obtenerMaximoIDHistorial ('idHIS', 'HIS'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], 'CPT', $lista[0], $lista[1], $lista[2], $lista[3], 'NUEVO', 'NUEVO');
            else if($_REQUEST[vitamina] == 'SI') $his->agregarHis($datoGeneral->obtenerMaximoIDHistorial ('idHIS', 'HIS'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], 'CPT', $lista[0], $lista[1], $lista[2], $lista[3], 'NUEVO', 'NUEVO');
            else if($_REQUEST[multimicronutrientes] == 'SI') $his->agregarHis($datoGeneral->obtenerMaximoIDHistorial ('idHIS', 'HIS'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], 'CPT', $lista[0], $lista[1], $lista[2], $lista[3], 'NUEVO', 'NUEVO');
        }
        
        
        
    }else{
        $array = explode('*', $_REQUEST[idcatalogoPrestacion]);
        foreach ($array as $value) {
            $administracionMicronutrientesNino->actualizarAdministracionMicronutrientesNino('',$_SESSION[claveGeneral],$value,$_REQUEST[idepisodio],$_REQUEST[idpersona],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaInicio]),formatoFecha($_REQUEST[fechaFin]),$_REQUEST[estado],$_REQUEST[hierro],$_REQUEST[esquemaHierro],$_REQUEST[vitamina],$_REQUEST[esquemaVitamina],$_REQUEST[multimicronutrientes],$_REQUEST[esquemaMultimicronutrientes],formatoFecha($_REQUEST[fechaMicronutriente]),$_REQUEST[estadoMicronutriente],formatoFecha($_REQUEST[segimientoDomicilio1]),$_REQUEST[estadoSeguimiento1],formatoFecha($_REQUEST[segimientoDomicilio2]),$_REQUEST[estadoSeguimiento2],formatoFecha($_REQUEST[segimientoDomicilio3]),$_REQUEST[estadoSeguimiento3]);
        }
        echo trim($_REQUEST[idadministracionMicronutrientesNino]);
    }
}

?>    
    
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

require_once '../clases/claseVacuna.php';
require_once '../clases/claseDetalleVacuna.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseProgramacionVacuna.php';
$vacuna = new Vacuna();
$detalleVacuna = new DetalleVacuna();
$datoGeneral = new DatoGeneral();
$programacionVacuna = new ProgramacionVacuna();


if($_REQUEST[f] == 1) $vacuna->mostrarVacunaDatagrid ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 2) echo $vacuna->mostrarVacunaVector($_REQUEST[idvacuna],$_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $vacuna->mostrarVacunaCombobox(true);
elseif($_REQUEST[f] == 4) $vacuna->mostrarVacunaCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    $vacuna->agregarVacuna($datoGeneral->obtenerMaximoIDHistorial('idvacuna', 'vacuna'),$_SESSION[claveGeneral],$_REQUEST[idpersona],$_REQUEST[idcatalogoVacuna],$_REQUEST[nombreCatalogo],$_REQUEST[estadoVacuna]);
    
    $IDVACUNA = $datoGeneral->obtenerMaximoIDHistorial('idvacuna', 'vacuna') - 1;
    
    $result = $programacionVacuna->mostrarProgramacionVacunaVector($_REQUEST[idcatalogoVacuna], '', true);
    //INGRESAMOS LOS DOSIS EN DETALLEVACUNA
    //idprogramacionVacuna,idcatalogoVacuna,nombreDosis,opProgramacion,limiteInicial,factor,detalleProgramacion 
    while ($row = mysql_fetch_array($result)) {
        $tipoProgramacion = '';
        if($row[3] == 'NO' ) {
            //FN=FECHA NACIMIENTO,SP=SIN PROGRAMACION(FECHA VACIA),FAP1=FECHA APLICACION DOSIS1,FAP2=FECHA APLICACION DOSIS2,FUR=FECHA ULTIMA REGLA
            $tipoProgramacion = 'MANUAL';
        }
        if($_REQUEST[estadoVacuna] == '') $estado = 'SIN PLANIFICAR';
        else $estado = $_REQUEST[estadoVacuna];
        $detalleVacuna->agregarDetalleVacuna($datoGeneral->obtenerMaximoIDHistorial('iddetalleVacuna', 'detalleVacuna'),$_SESSION[claveGeneral],$IDVACUNA,$row[2],$row[3],$tipoProgramacion,formatoFecha($_REQUEST[fechaProgramada]),formatoFecha($_REQUEST[fechaAplicacion]),$estado,$_REQUEST[lugarAplicacion],$_REQUEST[observaciones]);
    }
    echo $IDVACUNA;
}
elseif($_REQUEST['oper'] == 'edit') $vacuna->actualizarVacuna($_REQUEST[idvacuna],$_SESSION[claveGeneral],$_REQUEST[idpersona],$_REQUEST[idcatalogoVacuna],$_REQUEST[nombreCatalogo],$_REQUEST[estadoVacuna]);
elseif($_REQUEST['oper'] == 'del') $vacuna->eliminarVacuna($_REQUEST[id], $_SESSION[claveGeneral]);
elseif($_REQUEST['f'] == 5){
    $row = $programacionVacuna->mostrarProgramacionVacunaVector($_REQUEST[idcatalogoVacuna], $_REQUEST[nroDosis], false);
    //echo $row;
    $row = explode('+', $row);
    //echo $row[4];
    //idprogramacionVacuna,idcatalogoVacuna,nombreDosis,opProgramacion,limiteInicial,factor,detalleProgramacion 
    
    if($row[4] == 'FN') {
        echo trim($datoGeneral->sumarFechas(formatoFecha($_REQUEST[fechaNacimiento]), $row[5])) ;
    }
    else if($row[4] == 'SP') {
        echo "";
    }
    else if($row[4] == 'FAP1') {
        //iddetalleVacuna,claveGeneral,idvacuna,nroDosis,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,observaciones 
        $lista = $detalleVacuna->mostrarDetalleVacunaDosisVector($_REQUEST[idvacuna], 1, $_SESSION[claveGeneral]);
        $lista = explode('+', $lista);
        
        echo trim($datoGeneral->sumarFechas($lista[6], $row[5]));
    }
    else if($row[4] == 'FAP2') {
        //iddetalleVacuna,claveGeneral,idvacuna,nroDosis,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,observaciones 
        $lista = $detalleVacuna->mostrarDetalleVacunaDosisVector($_REQUEST[idvacuna], 2, $_SESSION[claveGeneral]);
        $lista = explode('+', $lista);
        echo trim($datoGeneral->sumarFechas($lista[6], $row[5]));
    }
    else if($row[4] == 'FUR') {

    }
    
}



?>    
    
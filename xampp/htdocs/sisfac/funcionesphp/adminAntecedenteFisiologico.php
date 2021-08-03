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

require_once '../clases/claseAntecedenteFisiologico.php';
require_once '../clases/claseDatoGeneral.php';
$antecedenteFisiologico = new AntecedenteFisiologico();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) echo $antecedenteFisiologico->mostrarAntecedenteFisiologico ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    if($_REQUEST[idantecedenteFisiologico] == '') {
        $antecedenteFisiologico->agregarAntecedenteFisiologico($datoGeneral->obtenerMaximoIDHistorial('idantecedenteFisiologico', 'antecedenteFisiologico'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[alimentacionMes], $_REQUEST[alimentacion], $_REQUEST[higieneDental], $_REQUEST[revisionDental], $_REQUEST[fechaVisitaDental], $_REQUEST[opcionActividadFisica], $_REQUEST[frecuenciaActividadFisica], $_REQUEST[nroVecesActividadFisica]);
        echo $datoGeneral->obtenerMaximoIDHistorial('idantecedenteFisiologico', 'antecedenteFisiologico') - 1;
    }else{
        $antecedenteFisiologico->actualizarAntecedenteFisiologico($_REQUEST[idantecedenteFisiologico], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[alimentacionMes], $_REQUEST[alimentacion], $_REQUEST[higieneDental], $_REQUEST[revisionDental], $_REQUEST[fechaVisitaDental], $_REQUEST[opcionActividadFisica], $_REQUEST[frecuenciaActividadFisica], $_REQUEST[nroVecesActividadFisica]);
        echo $_REQUEST[idantecedenteFisiologico];
    }
}


?>
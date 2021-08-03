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

require_once '../clases/claseAntecedenteSexual.php';
require_once '../clases/claseDatoGeneral.php';
$antecedenteSexual = new AntecedenteSexual();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) echo $antecedenteSexual->mostrarAntecedenteSexual($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    if($_REQUEST[idantecedenteSexual]=='') {
        $antecedenteSexual->agregarAntecedenteSexual($datoGeneral->obtenerMaximoIDHistorial('idantecedenteSexual', 'antecedenteSexual'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[menarquia], $_REQUEST[regimenCatamenial], $_REQUEST[opcionPAP], $_REQUEST[mesAnioPAP], $_REQUEST[resultadoPAP], $_REQUEST[detallePAP], $_REQUEST[opcionIVAA], $_REQUEST[mesAnioIVAA], $_REQUEST[resultadoIVAA], $_REQUEST[idcatalogoCIE10IVAA], $_REQUEST[nombreCIE10IVAA], $_REQUEST[opcionMamas], $_REQUEST[mesAnioMamas], $_REQUEST[tipoMamas], $_REQUEST[resultadoMamas], $_REQUEST[idcatalogoCIE10Mamas], $_REQUEST[nombreCIE10Mamas], $_REQUEST[opcionProstatico], $_REQUEST[mesAnioProstatico], $_REQUEST[resultadoProstatico], $_REQUEST[idcatalogoCIE10Prostatico], $_REQUEST[nombreCIE10Prostatico], $_REQUEST[opcionTactoRectal], $_REQUEST[resultadoTactoRectal], $_REQUEST[idcatalogoCIE10Tacto], $_REQUEST[nombreCIE10Tacto], $_REQUEST[edadInicioRelacion], $_REQUEST[opcionParejaSexual], $_REQUEST[nroParejaSexual], $_REQUEST[edadParejaSexual], $_REQUEST[opcionActividadSexual], $_REQUEST[opcionMetodoAnticonceptivo], $_REQUEST[tiempoMetodo], $_REQUEST[metodoAnticonceptivo], $_REQUEST[tipo], date('c'));
        echo $datoGeneral->obtenerMaximoIDHistorial('idantecedenteSexual', 'antecedenteSexual')-1;
    }else{
        $antecedenteSexual->actualizarAntecedenteSexual($_REQUEST[idantecedenteSexual], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[menarquia], $_REQUEST[regimenCatamenial], $_REQUEST[opcionPAP], $_REQUEST[mesAnioPAP], $_REQUEST[resultadoPAP], $_REQUEST[detallePAP], $_REQUEST[opcionIVAA], $_REQUEST[mesAnioIVAA], $_REQUEST[resultadoIVAA], $_REQUEST[idcatalogoCIE10IVAA], $_REQUEST[nombreCIE10IVAA], $_REQUEST[opcionMamas], $_REQUEST[mesAnioMamas], $_REQUEST[tipoMamas], $_REQUEST[resultadoMamas], $_REQUEST[idcatalogoCIE10Mamas], $_REQUEST[nombreCIE10Mamas], $_REQUEST[opcionProstatico], $_REQUEST[mesAnioProstatico], $_REQUEST[resultadoProstatico], $_REQUEST[idcatalogoCIE10Prostatico], $_REQUEST[nombreCIE10Prostatico], $_REQUEST[opcionTactoRectal], $_REQUEST[resultadoTactoRectal], $_REQUEST[idcatalogoCIE10Tacto], $_REQUEST[nombreCIE10Tacto], $_REQUEST[edadInicioRelacion], $_REQUEST[opcionParejaSexual], $_REQUEST[nroParejaSexual], $_REQUEST[edadParejaSexual], $_REQUEST[opcionActividadSexual], $_REQUEST[opcionMetodoAnticonceptivo], $_REQUEST[tiempoMetodo], $_REQUEST[metodoAnticonceptivo], $_REQUEST[tipo], date('c'));
        echo $_REQUEST[idantecedenteSexual];
    }
    
}


?>
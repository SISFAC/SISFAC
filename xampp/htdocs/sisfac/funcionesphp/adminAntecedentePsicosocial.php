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

require_once '../clases/claseAntecedentePsicosocial.php';
require_once '../clases/claseDatoGeneral.php';
$antecedentePsicosocial = new AntecedentePsicosocial();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) echo $antecedentePsicosocial->mostrarAntecedentePsicosocialVector ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    if($_REQUEST[idantecedentePsicosocial] == ''){
        $antecedentePsicosocial->agregarAntecedentePsicosocial($datoGeneral->obtenerMaximoIDHistorial ('idantecedentePsicosocial', 'antecedentePsicosocial'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[opcionAlcohol], $_REQUEST[cantidadAlcohol], $_REQUEST[frecuenciaAlcohol], $_REQUEST[nroVecesAlcohol], $_REQUEST[opcionTabaco], $_REQUEST[nroCigarros], $_REQUEST[nroCajetillas], $_REQUEST[frecuenciaTabaco], $_REQUEST[nroVecesTabaco], $_REQUEST[opcionDroga], $_REQUEST[frecuenciaDroga], $_REQUEST[nroVecesDroga], $_REQUEST[opcionHojaCoca], $_REQUEST[frecuenciaHojaCoca], $_REQUEST[nroVecesHojaCoca], $_REQUEST[opcionPornografia], $_REQUEST[horasPornografia], $_REQUEST[opcionPandilla], $_REQUEST[opcionVideoJuego], $_REQUEST[horaVideoJuego], $_REQUEST[opcionDelincuencia], $_REQUEST[opcionViolenciaFisica], $_REQUEST[opcionViolenciaPsicologica], $_REQUEST[opcionViolenciaSexual], $_REQUEST[opcionBullyng], $_REQUEST[opcionTrabaja], $_REQUEST[edadInicioTrabajo], $_REQUEST[tipoTrabajo], $_REQUEST[riesgoOcupacional], $_REQUEST[opcionAnorexia], $_REQUEST[opcionSuicidio], $_REQUEST[opcionDesercion], $_REQUEST[opcionRepitencia], $_REQUEST[opcionViolenciaNegligencia], $_REQUEST[opcionViolenciaPolitica]);
        echo $datoGeneral->obtenerMaximoIDHistorial ('idantecedentePsicosocial', 'antecedentePsicosocial') - 1;
    }else{
        $antecedentePsicosocial->actualizarAntecedentePsicosocial($_REQUEST[idantecedentePsicosocial], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[opcionAlcohol], $_REQUEST[cantidadAlcohol], $_REQUEST[frecuenciaAlcohol], $_REQUEST[nroVecesAlcohol], $_REQUEST[opcionTabaco], $_REQUEST[nroCigarros], $_REQUEST[nroCajetillas], $_REQUEST[frecuenciaTabaco], $_REQUEST[nroVecesTabaco], $_REQUEST[opcionDroga], $_REQUEST[frecuenciaDroga], $_REQUEST[nroVecesDroga], $_REQUEST[opcionHojaCoca], $_REQUEST[frecuenciaHojaCoca], $_REQUEST[nroVecesHojaCoca], $_REQUEST[opcionPornografia], $_REQUEST[horasPornografia], $_REQUEST[opcionPandilla], $_REQUEST[opcionVideoJuego], $_REQUEST[horaVideoJuego], $_REQUEST[opcionDelincuencia], $_REQUEST[opcionViolenciaFisica], $_REQUEST[opcionViolenciaPsicologica], $_REQUEST[opcionViolenciaSexual], $_REQUEST[opcionBullyng], $_REQUEST[opcionTrabaja], $_REQUEST[edadInicioTrabajo], $_REQUEST[tipoTrabajo], $_REQUEST[riesgoOcupacional], $_REQUEST[opcionAnorexia], $_REQUEST[opcionSuicidio], $_REQUEST[opcionDesercion], $_REQUEST[opcionRepitencia], $_REQUEST[opcionViolenciaNegligencia], $_REQUEST[opcionViolenciaPolitica]);
        echo $_REQUEST[idantecedentePsicosocial];
    }
    
}
//elseif($_REQUEST['oper'] == 'edit') $antecedentePsicosocial->actualizarAntecedentePsicosocial($_REQUEST[idantecedentePsicosocial], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[opcionAlcohol], $_REQUEST[cantidadAlcohol], $_REQUEST[frecuenciaAlcohol], $_REQUEST[nroVecesAlcohol], $_REQUEST[opcionTabaco], $_REQUEST[nroCigarros], $_REQUEST[nroCajetillas], $_REQUEST[frecuenciaTabaco], $_REQUEST[nroVecesTabaco], $_REQUEST[opcionDroga], $_REQUEST[frecuenciaDroga], $_REQUEST[nroVecesDroga], $_REQUEST[opcionHojaCoca], $_REQUEST[frecuenciaHojaCoca], $_REQUEST[nroVecesHojaCoca], $_REQUEST[opcionPornografia], $_REQUEST[horasPornografia], $_REQUEST[opcionPandilla], $_REQUEST[opcionVideoJuego], $_REQUEST[horaVideoJuego], $_REQUEST[opcionDelincuencia], $_REQUEST[opcionViolenciaFisica], $_REQUEST[opcionViolenciaPsicologica], $_REQUEST[opcionViolenciaSexual], $_REQUEST[opcionBullyng], $_REQUEST[opcionTrabaja], $_REQUEST[edadInicioTrabajo], $_REQUEST[tipoTrabajo], $_REQUEST[riesgoOcupacional], $_REQUEST[opcionAnorexia], $_REQUEST[opcionSuicidio], $_REQUEST[opcionDesercion], $_REQUEST[opcionRepitencia], $_REQUEST[opcionViolenciaNegligencia], $_REQUEST[opcionViolenciaPolitica]);


?>
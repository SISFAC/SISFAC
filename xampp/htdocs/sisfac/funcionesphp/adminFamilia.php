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

require_once '../clases/claseFamilia.php';
require_once '../clases/claseCiclo.php';
require_once '../clases/claseHistorial.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseDiresa.php';
$familia = new Familia();
$ciclo = new Ciclo();
$historial = new Historial();
$datoGeneral = new DatoGeneral();
$diresa = new Diresa();

if($_REQUEST['f'] == 1) $familia->mostrarFamiliaDatagrid($_REQUEST['codigoFicha'], $_REQUEST['dni']);
elseif($_REQUEST['oper'] == 'add') {
    if(!$familia->buscarCodFicha($_REQUEST[codigoFicha])){
        $data = explode('-',$diresa->buscarIDSNombres($_REQUEST[idsector], $_SESSION[claveGeneral]));
        $familia->agregarFamilia($datoGeneral->obtenerMaximoID('idfamilia', 'familia'), $_SESSION[claveGeneral], $_REQUEST[idsector], $_REQUEST[idtrabajador], $_REQUEST[numeroVivienda], $_REQUEST[codigoFamilia], $_REQUEST[codigoFicha], formatoFecha($_REQUEST[fechaApertura]), $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19] );
    }
    else echo "Existe";
}elseif($_REQUEST['oper'] == 'edit') {
    $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], $_REQUEST[idsector], $_REQUEST[idtrabajador], $_REQUEST[numeroVivienda], $_REQUEST[codigoFamilia], $_REQUEST[fechaApertura], $_REQUEST[nombreFamilia], $_REQUEST[lote], $_REQUEST[telefono], $_REQUEST[correo], $_REQUEST[referencia], $_REQUEST[tipoEntorno], $_REQUEST[idioma1], $_REQUEST[idioma2], $_REQUEST[idioma3], $_REQUEST[tiempoDemora], $_REQUEST[tiempoDomicilio], $_REQUEST[viviendaAnterior], $_REQUEST[medioTransporte], $_REQUEST[religion], $_REQUEST[diaVisita], $_REQUEST[horaVisita], $_REQUEST[tipoFamilia], $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[registrador], $_REQUEST[opcion]);
    $ciclo->eliminarCicloFamilia($_REQUEST[idfamilia]);
    $array = explode('*', $_REQUEST[ids]);
    foreach ($array as $value) {
        $data = explode('+', $value);
        if($ciclo->buscarCicloIdfamiliaCodEntrono($_REQUEST[idfamilia], $data[0], $_REQUEST[claveGeneral])=='0'  && $data[0]!='')
                $ciclo->agregarCiclo($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idciclo', 'ciclo'),$_REQUEST[idfamilia], $data[0], $data[1]);
    }
}
elseif($_REQUEST['f'] == 2) {

    $familia->actualizarFamilia($_REQUEST[claveGeneral], $_REQUEST[idfamilia], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[nombreempleado], $_REQUEST[opcion]);
    $historial->actualizarHistorial($_REQUEST[codigoFicha], $_REQUEST[claveGeneral]);
}
elseif($_REQUEST['oper'] == 'del') {
    $familia->eliminarFicha($_REQUEST['idfamilia'], $_REQUEST['claveGeneral']);
    //$historial->actualizarHistorial($_REQUEST['codigoFicha'], $_SESSION[claveGeneral]);
    $result = $historial->obtenerIDFamiliaCodigoFicha($_REQUEST['codigoFicha'], $_REQUEST['claveGeneral']);
    while ($row = mysql_fetch_array($result)) {
        $historial->eliminarHistorial($row[0], $_REQUEST['claveGeneral']);
    }
}
elseif($_REQUEST['oper'] == 3){
    //CONCAT_WS('-',idfamilia,fam.claveGeneral) as id
    $id = explode('-', $_REQUEST['id']);
    $data = explode('-',$diresa->buscarIDSNombres($_REQUEST[idsector], $id[1]));
    $familia->actualizarCodigoFicha($id[1], $id[0], $_REQUEST[codigoFicha], $_REQUEST[idsector], $_REQUEST[numeroVivienda], $_REQUEST[codigoFamilia], formatoFecha($_REQUEST[fechaApertura]), $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19]);
    $historial->actualizarCodigoFichaHistorial($id[1], $_REQUEST[codigoFicha], $_REQUEST[codigoFichaAnterior] , $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19]);
}
elseif($_REQUEST['f'] == 4) echo $familia->mostrarFichaVector($_REQUEST['term'], $_REQUEST['limit']);
?>

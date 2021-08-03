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
if(!isset($_SESSION['idusu'])) header("location:/sicfic/");

require_once '../clases/clasePersona.php';
require_once '../clases/claseCondicion.php';
require_once '../clases/claseSindromeCultural.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseAntecedenteGinecobstetrico.php';
$persona = new Persona();
$condicion = new Condicion();
$sindrome = new SindromeCultural();
$datoGeneral = new DatoGeneral();
$antecedenteGinecobstetrico = new AntecedenteGinecobstetrico();

if($_REQUEST['f'] == 1)    $persona->mostrarPersonaDatagrid($_REQUEST['idfamilia'], $_REQUEST[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    $persona->agregarPersona($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idpersona', 'persona'), $_REQUEST[iddistrito], $_REQUEST[idfamilia], $_REQUEST[numeroHC], $_REQUEST[opcionDNI], $_REQUEST[dni], $_REQUEST[nombre], $_REQUEST[apellidoPaterno], $_REQUEST[apellidoMaterno], $_REQUEST[sexo], formatoFecha($_REQUEST[fechaNacimiento]), $_REQUEST[gradoInstruccion], $_REQUEST[seguroMedico], $_REQUEST[numeroSeguro], $_REQUEST[ocupacion], $_REQUEST[tipoOcupacion], $_REQUEST[parentesco], $_REQUEST[estadoCivil], $_REQUEST[jefeFamilia], $_REQUEST[pertenenciaEtnica], $_REQUEST[desendenciaEtnica], $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[grupoSanguineo], $_REQUEST[grupoRiesgo], $_REQUEST[opcionLugarResidencia], $_REQUEST[lugarResidencia], $_REQUEST[contacto], $_REQUEST[telefonoContacto], $_REQUEST[parentescoContacto], $_REQUEST[estudia]);
    if($_REQUEST['ids']!=''){
        $array = explode('-', $_REQUEST['ids']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            $condicion->agregarCondicion($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idcondicion', 'condicion'), $_REQUEST[idfamilia], $persona->obtenerMaximaPersona(), $data[0], $data[1]);
        }
    }
    if($_REQUEST['sids']!=''){
        $array = explode('-', $_REQUEST['sids']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            $sindrome->agregar($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsindromecultural', 'sindromecultural'), $_REQUEST[idfamilia], $persona->obtenerMaximaPersona(), $data[0], $data[1]);
        }
    }
    
}
elseif($_REQUEST['oper'] == 'edit'){
    $persona->actualizarPersona($_REQUEST[claveGeneral], $_REQUEST[idpersona], $_REQUEST[iddistrito], $_REQUEST[idfamilia], $_REQUEST[numeroHC], $_REQUEST[opcionDNI], $_REQUEST[dni], $_REQUEST[nombre], $_REQUEST[apellidoPaterno], $_REQUEST[apellidoMaterno], $_REQUEST[sexo], formatoFecha($_REQUEST[fechaNacimiento]), $_REQUEST[gradoInstruccion], $_REQUEST[seguroMedico], $_REQUEST[numeroSeguro], $_REQUEST[ocupacion], $_REQUEST[tipoOcupacion], $_REQUEST[parentesco], $_REQUEST[estadoCivil], $_REQUEST[jefeFamilia], $_REQUEST[pertenenciaEtnica], $_REQUEST[desendenciaEtnica], $_REQUEST[activo], $_REQUEST[motivo], $_REQUEST[grupoSanguineo], $_REQUEST[grupoRiesgo], $_REQUEST[opcionLugarResidencia], $_REQUEST[lugarResidencia], $_REQUEST[contacto], $_REQUEST[telefonoContacto], $_REQUEST[parentescoContacto], $_REQUEST[estudia]);

    $query = "DELETE FROM condicion WHERE claveGeneral = '$_REQUEST[claveGeneral]' AND idpersona = $_REQUEST[idpersona] AND idfamilia = $_REQUEST[idfamilia]";
        mysql_query($query); 
        

    if($_REQUEST['ids']!=''){
        $array = explode('-', $_REQUEST['ids']);

        foreach ($array as $value) {
            $data = explode('+', $value);

            if($data[0]!=''){


                $condicion->agregarCondicion($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idcondicion', 'condicion'), $_REQUEST[idfamilia],$_REQUEST['idpersona'], $data[0], $data[1]);
            }
        }
    }

    $query = "DELETE FROM sindromecultural WHERE claveGeneral = '$_REQUEST[claveGeneral]' AND idpersona = $_REQUEST[idpersona] AND idfamilia = $_REQUEST[idfamilia]";
        mysql_query($query); 

    if($_REQUEST['sids']!=''){
        $array = explode('-', $_REQUEST['sids']);
        foreach ($array as $value) {
            $data = explode('+', $value);
            if($sindrome->buscarCodigo($_REQUEST[claveGeneral], $_REQUEST['idpersona'], $data[0])=='0' && $data[0]!=''){
                $sindrome->agregar($_REQUEST[claveGeneral], $datoGeneral->obtenerMaximoID('idsindromecultural', 'sindromecultural'), $_REQUEST[idfamilia],$_REQUEST['idpersona'], $data[0], $data[1]);
            }
        }
    }
}
elseif($_REQUEST['f'] == 2){
    $persona->activarPersona($_REQUEST[claveGeneral], $_REQUEST[idpersona], $_REQUEST[activo], $_REQUEST[motivo]);
}
elseif($_REQUEST['oper'] == 'del'){
    $persona->eliminarPersona($_REQUEST[claveGeneral], $_REQUEST[id]);
}
elseif($_REQUEST['f'] == 3){
    echo $persona->obtenerDNIPersona($_REQUEST[claveGeneral], $_REQUEST[idpersona]).'-'.$persona->obtenerNroHijos($_REQUEST[claveGeneral], $_REQUEST[idpersona]);
}
elseif($_REQUEST['f'] == 4){
    $persona->buscarFichaClinica($_REQUEST[claveGeneral], $_REQUEST[dni], $_REQUEST[codigoFicha], $_REQUEST[numeroHC], $_REQUEST[nombresApellidos], $_REQUEST[nombreRegion], $_REQUEST[nompro]);
}
elseif($_REQUEST['f'] == 5){
    $idpersona = $persona->buscarPersonaParentesco($_REQUEST[codigoFicha], $_REQUEST[claveGeneral]);
    echo $idpersona;
    //$lista = explode('-', $antecedenteGinecobstetrico->obtenerAntecedenteGinecobstetricoVector($idpersona, $_SESSION[claveGeneral]));
    //echo $lista[0];
}
?>

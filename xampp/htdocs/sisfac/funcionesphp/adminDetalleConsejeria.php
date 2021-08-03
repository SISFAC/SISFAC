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

require_once '../clases/claseDetalleConsejeria.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseEquivalenciasCodigo.php';
require_once '../clases/claseHis.php';
require_once '../clases/claseCatalogoCPT.php';

$detalleConsejeria = new DetalleConsejeria();
$datoGeneral = new DatoGeneral();
$equivalenciasCodigo = new EquivalenciasCodigo();
$his = new His();
$catalogoCPT = new CatalogoCPT();

if($_REQUEST[f] == 1) $detalleConsejeria->mostrarDetalleConsejeriaDatagrid ($_REQUEST[idprestacionConsejeria], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 2) echo $detalleConsejeria->mostrarDetalleConsejeriaVector($_REQUEST[iddetalleConsejeria], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $detalleConsejeria->mostrarDetalleConsejeriaCombobox(true);
elseif($_REQUEST[f] == 4) $detalleConsejeria->mostrarDetalleConsejeriaCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    $detalleConsejeria->agregarDetalleConsejeria($datoGeneral->obtenerMaximoID('iddetalleConsejeria', 'detalleConsejeria'),$_SESSION[claveGeneral],$_REQUEST[idprestacionConsejeria],$_REQUEST[idcatalogoConsejeria],$_REQUEST[nombreCatalogo],$_REQUEST[nroSesion],$_REQUEST[tema]);
    
    $lista = $catalogoCPT->buscarCatalogoCPTVector($_REQUEST[codigoCPT]);
    $lista = explode('+', $lista);
    $his->agregarHis($datoGeneral->obtenerMaximoIDHistorial ('idHIS', 'HIS'), $_SESSION[claveGeneral], $_REQUEST[idepisodio], 'CPT', $lista[0], $lista[1], $lista[2], $lista[3], 'NUEVO', 'NUEVO');
        
    
    $his->agregarHis($idHIS, $claveGeneral, $idepisodio, $tipoCatalogo, $idcatalogo, $nombreCatalogo, $variableLAB, $tipoDiagnostico, $opPacienteEst, $opPacienteServ);
}
elseif($_REQUEST['oper'] == 'edit') $detalleConsejeria->actualizarDetalleConsejeria($_REQUEST[iddetalleConsejeria],$_SESSION[claveGeneral],$_REQUEST[idprestacionConsejeria],$_REQUEST[idcatalogoConsejeria],$_REQUEST[nombreCatalogo],$_REQUEST[nroSesion],$_REQUEST[tema]);
elseif($_REQUEST['oper'] == 'del') $detalleConsejeria->eliminarDetalleConsejeria($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
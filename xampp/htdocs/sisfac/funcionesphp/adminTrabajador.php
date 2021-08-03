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

require_once '../clases/claseTrabajador.php';
require_once '../clases/claseTrabajadorSector.php';
require_once '../clases/claseUsuario.php';
require_once '../clases/claseDatoGeneral.php';
$trabajador = new Trabajador();
$trasec= new TrabajadorSector();
$usuario = new Usuario();
$datoGeneral = new DatoGeneral();

if($_REQUEST['f'] == 1)    $trabajador->mostrarTrabajadorDatagrid($_REQUEST[idestablecimiento]);
elseif($_REQUEST['f'] == 2)    $trabajador->mostrarTrabajadorCombobox ($_REQUEST[idestablecimiento], true);
elseif($_REQUEST['f'] == 3)    $trabajador->mostrarTrabajadorCombobox ($_REQUEST[idestablecimiento], false);
elseif($_REQUEST['f'] == 4)    $trabajador->mostrarTrabajadorUsuarioDatagrid($_REQUEST[idestablecimiento]);
elseif($_REQUEST['oper'] == 'add')    $trabajador->agregarTrabajador ($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idtrabajador', 'trabajador'), $_REQUEST[idestablecimiento], $_REQUEST['nombreCompleto'], $_REQUEST['grupoProfesional'], $_REQUEST[opcionDocumento], $_REQUEST[nroDocumento], $_REQUEST[nroColegiatura], $_REQUEST[idCatalogoColegio], $_REQUEST[idcondicionTrabajador], $_REQUEST[idprofesion]);
elseif($_REQUEST['oper'] == 'edit')    {
    if($_REQUEST['id'] == 'nuevo') $trabajador->agregarTrabajador ($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idtrabajador', 'trabajador'), $_REQUEST[idestablecimiento], $_REQUEST['nombreCompleto'], $_REQUEST['grupoProfesional'], $_REQUEST[opcionDocumento], $_REQUEST[nroDocumento], $_REQUEST[nroColegiatura], $_REQUEST[idCatalogoColegio], $_REQUEST[idCondicionTrabajador], $_REQUEST[idprofesion]);
    else {
        $id = explode('-', $_REQUEST['id']);
        //$trabajador->actualizarTrabajador ($_SESSION[claveGeneral], $id[0], $_REQUEST[idestablecimiento], $_REQUEST['nombreCompleto'], $_REQUEST['grupoProfesional'], $_REQUEST[opcionDocumento], $_REQUEST[nroDocumento], $_REQUEST[nroColegiatura], $_REQUEST[idcolegioProfesional], $_REQUEST[idcondicionTrabajador], $_REQUEST[idprofesion]);
        $trabajador->actualizarTrabajador ($_SESSION[claveGeneral], $id[0], $_REQUEST[idestablecimiento], $_REQUEST[nombreCompleto], $_REQUEST[grupoProfesional], $_REQUEST[opcionDocumento], $_REQUEST[nroDocumento], $_REQUEST[nroColegiatura], $_REQUEST[idCatalogoColegio], $_REQUEST[idcondicionTrabajador], $_REQUEST[idprofesion]);
    }
}
elseif($_REQUEST['oper'] == 'del')    {
    $id = explode('-', $_REQUEST['id']);
    if(!$trasec->buscarTrabajadorSector($id[0], $_SESSION['claveGeneral'])){
        $trasec->eliminarTrabajadorSector($_REQUEST['idtrabajadorSector'], $_SESSION['claveGeneral']);
        if($trasec->obtenerTrabajador('', $id[0])==0){
            $trabajador->eliminarTrabajador($id[0], $_SESSION['claveGeneral']);
        }
        $usuario->inactivarUsuarioTrabajador($id[0]);
        echo "S";
    }else{
        echo "N";
    }
    
}
?>

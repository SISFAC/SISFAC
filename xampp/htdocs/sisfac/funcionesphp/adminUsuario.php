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

require_once '../clases/claseUsuario.php';
require_once '../clases/claseDatoGeneral.php';
require_once '../clases/claseVistaUsuario.php';

$usuario = new Usuario();
$datoGeneral = new DatoGeneral();
$vistausuario = new VistaUsuario();

if($_REQUEST['f'] == 1) $usuario->mostrarUsuariosDatagrid();
elseif($_REQUEST['f'] == 2) {
    $usuario->agregarUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idusuario', 'usuario'), $_REQUEST['idtrabajador'], $_REQUEST['usuario'], md5 ($_REQUEST['clave']), $_REQUEST['tipo'], $_REQUEST['estado']);
    if($_REQUEST['tipo'] == 'ADM'){
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'),$datoGeneral->obtenerMaximoID('idusuario', 'usuario') - 1, 1, 'index.php;');
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'),$datoGeneral->obtenerMaximoID('idusuario', 'usuario') - 1, 2, 'index.php;');
    }else if($_REQUEST['tipo'] == 'NOR' || $_REQUEST['tipo'] == 'VIS'){
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'),$datoGeneral->obtenerMaximoID('idusuario', 'usuario') - 1, 1, 'index.php;');
    }
}
elseif($_REQUEST['f'] == 3) {
    if($_REQUEST['clave'] == "--SINCLAVE.SINCLAVE.SINCLAVE--") $clave="";
    else $clave = md5 ($_REQUEST[clave]);

    $usuario->actualizarUsuario($_SESSION[claveGeneral], $_REQUEST['idusuario'], $_REQUEST['idtrabajador'], $_REQUEST['usuario'], $clave, $_REQUEST['tipo'], $_REQUEST['estado']);
    $vistausuario->elimianrVistaUsuario($_SESSION[claveGeneral], $_REQUEST[idusuario]);
    if($_REQUEST['tipo'] == 'ADM'){
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'), $_REQUEST['idusuario'], 1, 'index.php;');
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'), $_REQUEST['idusuario'], 2, 'index.php;');
    }else if($_REQUEST['tipo'] == 'NOR' || $_REQUEST['tipo'] == 'VIS'){
        $vistausuario->agregarVistaUsuario($_SESSION[claveGeneral], $datoGeneral->obtenerMaximoID('idvistausuario', 'vistausuario'), $_REQUEST['idusuario'], 1, 'index.php;');
    }
}
elseif($_REQUEST['f'] == 4) $usuario->inactivarUsuario($_REQUEST['idusuario'],$_REQUEST['activo']);
?>

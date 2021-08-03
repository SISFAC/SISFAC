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

require_once '../clases/claseDetalleGinecobstetrico.php';
require_once '../clases/claseDatoGeneral.php';

$datoGeneral = new DatoGeneral();
$detalleGinecobstetrico = new DetalleGinecobstetrico();

if($_REQUEST[f] == 1) {
    
    if($detalleGinecobstetrico->cuentaDetalleGinecobstetrico($_REQUEST[idantecedenteGinecobstetrico], $_REQUEST[idpersonaref])>0) $op = true;
    else $op = false;
            
    $detalleGinecobstetrico->mostrarDetalleGinecobstetricoDatagrid ($_REQUEST[idantecedenteGinecobstetrico], $_REQUEST[idpersonaref], $op, $_REQUEST[parentesco], $_REQUEST);
    
}
elseif($_REQUEST[oper] == 'add') $detalleGinecobstetrico->agregarDetalleGinecobstetrico($datoGeneral->obtenerMaximoIDHistorial('iddetalleGinecobstetrico', 'detalleGinecobstetrico'), $_SESSION[claveGeneral], $_REQUEST[idantecedenteGinecobstetrico], formatoFecha ($_REQUEST[fechaCulminacion]), $_REQUEST[nroAtencionPrenatal], $_REQUEST[complicacion], $_REQUEST[fuente], $_REQUEST[opcionSuplemento], $_REQUEST[aborto], $_REQUEST[lugarParto], $_REQUEST[tipoParto], $_REQUEST[opHorVer], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreTipoParto], $_REQUEST[pesoRN], $_REQUEST[idprofesion], $_REQUEST[idpersonaref], 'NO');
elseif($_REQUEST[oper] == 'edit') $detalleGinecobstetrico->actualizarDetalleGinecobstetrico ($_REQUEST[iddetalleGinecobstetrico], $_SESSION[claveGeneral], $_REQUEST[idpersona], formatoFecha ($_REQUEST[fechaCulminacion]), $_REQUEST[nroAtencionPrenatal], $_REQUEST[complicacion], $_REQUEST[fuente], $_REQUEST[opcionSuplemento], $_REQUEST[aborto], $_REQUEST[lugarParto], $_REQUEST[tipoParto], $_REQUEST[opHorVer], $_REQUEST[idcatalogoCIE10], $_REQUEST[nombreTipoParto], $_REQUEST[pesoRN], $_REQUEST[idprofesion], $_REQUEST[idpersonaref], 'NO');
elseif($_REQUEST[oper] == 'del') $detalleGinecobstetrico->eliminarDetalleGinecobstetrico($_REQUEST[id], $_SESSION[claveGeneral]);


?>
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

require_once '../clases/claseReferencia.php';
require_once '../clases/claseDatoGeneral.php';
$referencia = new Referencia();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $referencia->mostrarReferenciaDatagrid ();
elseif($_REQUEST[f] == 2) echo $referencia->mostrarReferenciaVector($_REQUEST[idepisodio], $_SESSION[claveGeneral]);
elseif($_REQUEST[f] == 3) $referencia->mostrarReferenciaCombobox(true);
elseif($_REQUEST[f] == 4) $referencia->mostrarReferenciaCombobox(false);
elseif($_REQUEST['oper'] == 'add') {
    if(trim($_REQUEST[idreferencia])==''){
        $referencia->agregarReferencia($datoGeneral->obtenerMaximoIDHistorial ('idreferencia', 'referencia'),$_SESSION[claveGeneral],$_REQUEST[idepisodio],$_REQUEST[idcatalogoReferencia],$_REQUEST[nombreReferencia],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaIngreso]),$_REQUEST[idtrabajadorReferencia],$_REQUEST[idtrabajadorResponsable],$_REQUEST[idtrabajadorCompania],$_REQUEST[condicionRecepcion],formatoFecha($_REQUEST[fechaRecepcion]),$_REQUEST[responsableRecepcion],$_REQUEST[colegiaturaRecepcion],$_REQUEST[idprofesionRecepcion],$_REQUEST[condicionPaciente],$_REQUEST[estadoReferencia],formatoFecha($_REQUEST[fechaReingreso]),$_REQUEST[iddiagnostico1],$_REQUEST[diagnostico1],$_REQUEST[iddiagnostico2],$_REQUEST[diagnostico2],$_REQUEST[iddiagnostico3],$_REQUEST[diagnostico3]);
        echo $datoGeneral->obtenerMaximoIDHistorial ('idreferencia', 'referencia') - 1;
    }else{
        echo trim($_REQUEST[idreferencia]);
    }
    
}
elseif($_REQUEST['oper'] == 'edit') {
    $referencia->actualizarReferencia($_REQUEST[idreferencia],$_SESSION[claveGeneral],$_REQUEST[idepisodio],$_REQUEST[idcatalogoReferencia],$_REQUEST[nombreReferencia],$_REQUEST[idcatalogoUPS],$_REQUEST[nombreCatalogo],formatoFecha($_REQUEST[fechaIngreso]),$_REQUEST[idtrabajadorReferencia],$_REQUEST[idtrabajadorResponsable],$_REQUEST[idtrabajadorCompania],$_REQUEST[condicionRecepcion],formatoFecha($_REQUEST[fechaRecepcion]),$_REQUEST[responsableRecepcion],$_REQUEST[colegiaturaRecepcion],$_REQUEST[idprofesionRecepcion],$_REQUEST[condicionPaciente],$_REQUEST[estadoReferencia],formatoFecha($_REQUEST[fechaReingreso]),$_REQUEST[iddiagnostico1],$_REQUEST[diagnostico1],$_REQUEST[iddiagnostico2],$_REQUEST[diagnostico2],$_REQUEST[iddiagnostico3],$_REQUEST[diagnostico3]);
    echo trim($_REQUEST[idreferencia]);
}
elseif($_REQUEST['oper'] == 'del') $referencia->eliminarReferencia($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
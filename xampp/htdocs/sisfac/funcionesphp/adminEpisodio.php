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

require_once '../clases/claseEpisodio.php';
require_once '../clases/claseDatoGeneral.php';
$episodio = new Episodio();
$datoGeneral = new DatoGeneral();

if($_REQUEST['f'] == 1) $episodio->mostrarEpisodioDatagrid ($_REQUEST[idpersona], $_SESSION[claveGeneral]);
elseif($_REQUEST['oper'] == 'add') {
    if($_REQUEST[idepisodio] == 'null') {
        $episodio->agregarEpisodio($datoGeneral->obtenerMaximoIDHistorial ('idepisodio', 'episodio'), $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[claseAtencion], $_REQUEST[tipo], $_REQUEST[idcatalogoUPS], $_REQUEST[nombreCatalogo], $_REQUEST[situacion], formatoFecha($_REQUEST[fechaInicio]), formatoFecha($_REQUEST[fechaFin]), $_REQUEST[nombreEpisodio], $_REQUEST[estadoEpisodio], $_REQUEST[medioAcceso], $_REQUEST[procedencia], $_REQUEST[acompanante], $_REQUEST[parentesco], $_REQUEST[motivoConsulta], $_REQUEST[sintomas], $_REQUEST[sindromeCultura], $_REQUEST[tiempoEnfermedad], $_REQUEST[detalleTiempo], $_REQUEST[semanaEpidemiologica], $_REQUEST[opcionSemanaGestacional], $_REQUEST[semanaGestacional], $_REQUEST[sueno], $_REQUEST[sed], $_REQUEST[animo], $_REQUEST[apetito], $_REQUEST[orina], $_REQUEST[deposiciones], $_REQUEST[frecuenciaDeposiciones], $_REQUEST[horaDiaDeposiciones], $_REQUEST[perdidaPeso], $_REQUEST[detallePesoKilos], $_REQUEST[opcionPesoTiempo], $_REQUEST[detallePesoTiempo], $_REQUEST[tos]);
        echo $datoGeneral->obtenerMaximoIDHistorial ('idepisodio', 'episodio') - 1;
    }
    else{
        $episodio->actualizarEpisodio($_REQUEST[idepisodio], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[claseAtencion], $_REQUEST[tipo], $_REQUEST[idcatalogoUPS], $_REQUEST[nombreCatalogo], $_REQUEST[situacion], formatoFecha($_REQUEST[fechaInicio]), formatoFecha($_REQUEST[fechaFin]), $_REQUEST[nombreEpisodio], $_REQUEST[estadoEpisodio], $_REQUEST[medioAcceso], $_REQUEST[procedencia], $_REQUEST[acompanante], $_REQUEST[parentesco], $_REQUEST[motivoConsulta], $_REQUEST[sintomas], $_REQUEST[sindromeCultura], $_REQUEST[tiempoEnfermedad], $_REQUEST[detalleTiempo], $_REQUEST[semanaEpidemiologica], $_REQUEST[opcionSemanaGestacional], $_REQUEST[semanaGestacional], $_REQUEST[sueno], $_REQUEST[sed], $_REQUEST[animo], $_REQUEST[apetito], $_REQUEST[orina], $_REQUEST[deposiciones], $_REQUEST[frecuenciaDeposiciones], $_REQUEST[horaDiaDeposiciones], $_REQUEST[perdidaPeso], $_REQUEST[detallePesoKilos], $_REQUEST[opcionPesoTiempo], $_REQUEST[detallePesoTiempo], $_REQUEST[tos]);
        echo $_REQUEST[idepisodio];
    }
}
elseif($_REQUEST['oper'] == 'edt') $episodio->actualizarEpisodio($_REQUEST[idepisodio], $_SESSION[claveGeneral], $_REQUEST[idpersona], $_REQUEST[claseAtencion], $_REQUEST[tipo], $_REQUEST[idcatalogoUPS], $_REQUEST[nombreCatalogo], $_REQUEST[situacion], formatoFecha($_REQUEST[fechaInicio]), formatoFecha($_REQUEST[fechaFin]), $_REQUEST[nombreEpisodio], $_REQUEST[estadoEpisodio], $_REQUEST[medioAcceso], $_REQUEST[procedencia], $_REQUEST[acompanante], $_REQUEST[parentesco], $_REQUEST[motivoConsulta], $_REQUEST[sintomas], $_REQUEST[sindromeCultura], $_REQUEST[tiempoEnfermedad], $_REQUEST[detalleTiempo], $_REQUEST[semanaEpidemiologica], $_REQUEST[opcionSemanaGestacional], $_REQUEST[semanaGestacional], $_REQUEST[sueno], $_REQUEST[sed], $_REQUEST[animo], $_REQUEST[apetito], $_REQUEST[orina], $_REQUEST[deposiciones], $_REQUEST[frecuenciaDeposiciones], $_REQUEST[horaDiaDeposiciones], $_REQUEST[perdidaPeso], $_REQUEST[detallePesoKilos], $_REQUEST[opcionPesoTiempo], $_REQUEST[detallePesoTiempo], $_REQUEST[tos]);
elseif($_REQUEST['oper'] == 'del') $episodio->eliminarEpisodio($_REQUEST[id], $_SESSION[claveGeneral]);


?>
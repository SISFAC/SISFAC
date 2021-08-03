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

require_once '../clases/claseCatalogoVacuna.php';
require_once '../clases/claseDatoGeneral.php';
$catalogoVacuna = new CatalogoVacuna();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $catalogoVacuna->mostrarCatalogoVacunaDatagrid ();
elseif($_REQUEST[f] == 2) echo $catalogoVacuna->mostrarCatalogoVacunaVector ($_REQUEST[term], $_REQUEST[limit]);
elseif($_REQUEST[f] == 3) {
    
    
    $vacunas = $catalogoVacuna->mostrarVacunasPersona($_REQUEST[idpersona], $_SESSION[claveGeneral]);
    
    $catalogoVacuna->mostrarCatalogoVacunaCombobox($vacunas, $_REQUEST[dias], true);
}
elseif($_REQUEST[f] == 4) {
    $vacunas = $catalogoVacuna->mostrarVacunasPersona($_REQUEST[idpersona], $_SESSION[claveGeneral]);
    
    $catalogoVacuna->mostrarCatalogoVacunaCombobox($vacunas, $_REQUEST[dias], false);
}
elseif($_REQUEST['oper'] == 'add') $catalogoVacuna->agregarCatalogoVacuna($_REQUEST[idcatalogoVacuna],$_REQUEST[nombreVacuna],$_REQUEST[dosis],$_REQUEST[descripcionVacuna],$_REQUEST[descripcionIntervalo],$_REQUEST[limiteInferior],$_REQUEST[limiteSuperior]);
elseif($_REQUEST['oper'] == 'edit') $catalogoVacuna->actualizarCatalogoVacuna($_REQUEST[idcatalogoVacuna],$_REQUEST[nombreVacuna],$_REQUEST[dosis],$_REQUEST[descripcionVacuna],$_REQUEST[descripcionIntervalo],$_REQUEST[limiteInferior],$_REQUEST[limiteSuperior]);
elseif($_REQUEST['oper'] == 'del') $catalogoVacuna->eliminarCatalogoVacuna($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
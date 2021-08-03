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

require_once '../clases/claseCatalogoConsejeria.php';
require_once '../clases/claseDatoGeneral.php';
$catalogoConsejeria = new CatalogoConsejeria();
$datoGeneral = new DatoGeneral();

if($_REQUEST[f] == 1) $catalogoConsejeria->mostrarCatalogoConsejeriaDatagrid ();
elseif($_REQUEST[f] == 2) echo $catalogoConsejeria->mostrarCatalogoConsejeriaVector($_REQUEST[idcatalogoConsejeria]);
elseif($_REQUEST[f] == 3) $catalogoConsejeria->mostrarCatalogoConsejeriaCombobox(true);
elseif($_REQUEST[f] == 4) $catalogoConsejeria->mostrarCatalogoConsejeriaCombobox(false);
elseif($_REQUEST['oper'] == 'add') $catalogoConsejeria->agregarCatalogoConsejeria($_REQUEST[idcatalogoConsejeria],$_REQUEST[nombreConsejeria],$_REQUEST[codigoCPT]);
elseif($_REQUEST['oper'] == 'edit') $catalogoConsejeria->actualizarCatalogoConsejeria($_REQUEST[idcatalogoConsejeria],$_REQUEST[nombreConsejeria],$_REQUEST[codigoCPT]);
elseif($_REQUEST['oper'] == 'del') $catalogoConsejeria->eliminarCatalogoConsejeria($_REQUEST[id], $_SESSION[claveGeneral]);



?>    
    
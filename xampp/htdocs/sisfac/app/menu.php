<!--
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


i-->
<ul>

    <li><a href='#' id="opInicio"><span>Inicio</span></a></li>
    <li class='active has-sub'><a href='#' id=""><span>Tablas maestras</span></a>
        <ul>
            <li class='has-sub'><a href='#' id="opRegion"><span>Divisi&oacute;n geopol&iacute;tica</span></a></li>
            <li class='has-sub'><a href='#' id="opDiresa"><span>Divisi&oacute;n sociosanitaria</span></a></li>
            <?php if($_SESSION['nomusu'] == 'ADMINSUPERUSUARIO') echo '<li class="has-sub"><a href="#" id="opMaestra"><span>Mantenimiento de tablas maestras</span></a></li>';?>
            <?php if($_SESSION['nomusu'] == 'ADMINSUPERUSUARIO' || $_SESSION['nomusu'] == 'SUPERUSUARIO') echo '<li class="has-sub"><a href="#" id="opCargarCsv"><span>Actualizar tablas maestras</span></a></li>';?>
        </ul>
    </li>
    <!--li class='active has-sub'><a href='#' id=""><span>Cat&aacute;logos</span></a>
        <ul>
            <li class='has-sub'><a href='#' id="opCatalogoCIE10"><span>Cat&aacute;logo CIE10</span></a></li>
            <li class='has-sub'><a href='#' id="opCatalogoMedicamento"><span>Cat&aacute;logo de productos farmac&eacute;uticos</span></a></li>
            <li class='has-sub'><a href='#' id="opCatalogoPrestaciones"><span>Cat&aacute;logo de prestaciones SIS</span></a></li>
            <li class='has-sub'><a href='#' id="opCatalogoEpisodio"><span>Cat&aacute;logo de episodios de atenci&oacute;n</span></a></li>
            <li class='has-sub'><a href='#' id="opCatalogoLaboratorio"><span>Cat&aacute;logo de pruebas de laboratorio</span></a></li>
        </ul>
    </li-->
    <li class='active has-sub'><a href='#' id=""><span>Comunidad y familia</span></a>
        <ul>
            <li class='has-sub'><a href='#' id="opFicha"><span>Ficha familiar</span></a></li>
            <li class='has-sub'><a href='#' id="opConsultaHistorico"><span>Consulta de historiales</span></a></li>
            <li class='has-sub'><a href='#' id=""><span>Reportes</span></a>
                <ul>
                    <li class='has-sub'><a href='#' id="opReporteEstadistico"><span>Reportes estad&iacute;sticos</span></a></li>
                    <li class='has-sub'><a href='#' id ="opReporteEtapa"><span>Familias en riesgo</span></a>
                        <!--ul>
                            <li><a href='#' id="opReporteEtapa"><span>Seg&uacute;n etapas de vida</span></a></li>
                            <li><a href='#' id="opReporteSocioeconomico"><span>Seg&uacute;n datos socioeconomicos</span></a></li>
                        </ul-->
                    </li>
                    <li class='has-sub'><a href='#' id="opReportePaifam"><span>PAIFAM</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="opMigrarComunidad"><span>Migración de comunidad</span></a></li>
        </ul>
    </li>
    <!--li class='active has-sub'><a href='#' id=""><span>Individuo</span></a>
        <ul>
            <li class='has-sub'><a href='#' id="opFichaClinica"><span>Ficha Cl&iacute;nica</span></a></li>
            <li class='has-sub'><a href='#' id="op"><span>Consultas</span></a></li>
            <li class='has-sub'><a href='#' id="opReporteFichaIndividual"><span>Reportes</span></a></li>
        </ul>
    </li>
    <li class='last'><a href='#' id="opConsultaFicha"><span>Consulta (Comunidad, familia e individuo)</span></a></li-->
    <li class='active has-sub'><a href='#' id=""><span>Base de datos</span></a>
        <ul>
            <li class='has-sub'><a href='#' id="opCopiaBase"><span>Consolidaci&oacute;n/Acopio de base de datos</span></a></li>
            <li class='has-sub'><a href='#' id="opRertaurarBase"><span>Eliminar base de datos acopiadas</span></a></li>
            <li class='has-sub'><a href='#' id="opCopiaBaseGeneral"><span>Respaldo de base de datos</span></a></li>
            <li class='has-sub'><a href='#' id="opReporteAcopio"><span>Reporte de Acopio</span></a></li>
        </ul>
    </li>
    <!--li class='last'><a href='#' id=""><span>Importar/Exportar datos</span></a></li>
    <li class='last'><a href='#' id="opCopiaBaseGeneral"><span>Respaldo de base de datos</span></a></li-->
    <li class='last'><a href='#' id="opAyuda"><span>Ayuda</span></a></li>
    <li><a href='#' id="opAcerdade"><span>Acerca de...</span></a></li>
</ul>

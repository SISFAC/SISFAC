<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.



*/
/**
 * Esta clase permite la generaci&oacute;n de reportes de Java desde PHP.
 * Para la generacion de los reportes se est&aacute; usando JarperReports y 
 * para su implementaci&oacute;n en las aplicaciones PHP se hace uso de JavaBridge
 *
 * @author 
 */
class Jasper {
    private $_objDbConnect;
    private $_objJep;
    private $_objPrint;
    private $_objReport;
    private $_objStream;
    
    /**
     * 
     * @param String $username Usuario de la base de datos
     * @param String $password Password de la base de datos
     * @param String $dataSourceServerUrl Url de la base de datos
     * @param String $ruta Ubicaci&oacute;n del archivo .jrxml del reporte. Esta ruta debe ser indicada tomando
     * como base la carpeta sigurmun
     * 
     * @
     */
    function __construct($username,$password,$dataSourceServerUrl) {
        $this->initReport($username,$password,$dataSourceServerUrl);
    }

    private function initReport($username, $password,$dataSourceServerUrl){
        $this->_objStream = new Java("java.io.ByteArrayOutputStream");
        $this->_objJep = new Java("net.sf.jasperreports.engine.JRExporterParameter");
        $objClass = new Java("java.lang.Class");
        //$objClass->forName("org.postgresql.Driver");
        $objClass->forName("com.mysql.jdbc.Driver");
        $objDbm = new Java("java.sql.DriverManager");
        $this->_objDbConnect = $objDbm->getConnection($dataSourceServerUrl,$username, $password);
        return;
    }

    public function compileReport($jrxmlReport){
        $objJcm = new Java("net.sf.jasperreports.engine.JasperCompileManager");
        $this->_objReport = $objJcm->compileReport($jrxmlReport);
        return;
    }
    
    /**
     * A&ntilde;ade parametros al reporte
     * @param Array $mapArray Array asociativo que contiene los parametros que ser&aacute;n 
     * pasados al reporte
     * @return type 
     */
    public function setParams($mapArray){
        $map =  new Java("java.util.HashMap");
        foreach ($mapArray as $key=>$value){
            $map->put($key,$value);
        }
        $objJfm = new Java("net.sf.jasperreports.engine.JasperFillManager");
        $this->_objPrint = $objJfm->fillReport($this->_objReport, $map, $this->_objDbConnect);
        return;
    }

    public function toPrinter(){
        $objJhe = new Java("net.sf.jasperreports.engine.export.JRPrintServiceExporter");
        $prn = $objJhe->checkAvailablePrinters();
        if ($prn){
            $objJhe->setParameter($this->_objJep->JASPER_PRINT, $this->_objPrint );
            $objJhe->exportReport();
        }
        return;
    }
    
    /**
     * Guarda el reporte en formato pdf en la ruta especificada. Si no se especifica una ruta
     * el reporte ser&aacute; mostrado en el navegador.
     * 
     * @param String $fileName Ubicaci&oacute;n y nombre con el que ser&aacute; guardado el reporte
     * @return type 
     */
    public function toPDF($fileName=""){
        $objJhe = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");
        $objJhe->setParameter($this->_objJep->JASPER_PRINT, $this->_objPrint );
        if ($fileName == ""){
            $objJhe->setParameter($this->_objJep->OUTPUT_STREAM,$this->_objStream);
            $objJhe->exportReport();
            header("Content-type: application/pdf");
            echo java_cast($this->_objStream->toByteArray(),"S");
        }
        else{
            $objJhe->setParameter($this->_objJep->OUTPUT_FILE_NAME,$fileName);
            $objJhe->exportReport();
        }
        return;
    }

    public function toHtml(){
        $objJhe = new Java("net.sf.jasperreports.engine.export.JRHtmlExporter");
        $objJhe->setParameter($this->_objJep->JASPER_PRINT, $this->_objPrint );
        $objJhe->setParameter($this->_objJep->OUTPUT_STREAM,$this->_objStream);
        $objJhe->exportReport();
        echo $this->_objStream->toString();
        return;
    }

    public function hasPrinter(){
        $objJhe = new Java("net.sf.jasperreports.engine.export.JRPrintServiceExporter");
        $prn = $objJhe->checkAvailablePrinters();
        return $prn;
    }
}
?>

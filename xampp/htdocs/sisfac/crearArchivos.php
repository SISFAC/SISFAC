<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
include 'conexion/Conexion.php';
$cnn = new Conexion();
$cnn->abrirConexion();

$tabla = "programacion";
$query = "SHOW COLUMNS FROM $tabla";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
    $campos .= $row[0].',';
    $camposPasar .= "$".$row[0].',';
    $array .="'$row[0]'=>".'$'."$row[0],";
    $devolver .= "$"."row['$row[0]']".".'+'.";
    
    $camposCabeceraJs .= "'".$row[0]."',";
    $camposJs .= "{name:'$row[0]', index:'$row[0]', width:100, editable:true},"."\n";
    
    if($row[1] == 'date' || $row[1] == 'datetime' ) $camposPasarFuncion .= "formatoFecha($"."_REQUEST[".$row[0].']),';
    else $camposPasarFuncion .= "$"."_REQUEST[".$row[0].'],';
    if($row[3] == 'PRI') {
        if($row[1] == 'int(11)' || $row[1] == 'int(10)') $pk.="$row[0] = "."$"."$row[0] AND ";
        else $pk.="$row[0] = "."'$"."$row[0]' AND ";
        $pkPasar .= "$$row[0],";
    }
}
echo $campos = substr($campos, 0, -1);
echo $camposPasar = substr($camposPasar, 0, -1);
echo $camposCabeceraJs = substr($camposCabeceraJs, 0, -1);
echo $camposJs = substr($camposJs, 0, -1);
echo $camposPasarFuncion = substr($camposPasarFuncion, 0, -1);
echo $array = substr($array, 0, -1);
echo $devolver = substr($devolver, 0, -5);
echo $pk = substr($pk, 0, -4);;
echo $pkPasar = substr($pkPasar, 0, -1);


//ucwords — Convierte a mayusculas el primer caracter de cada palabra de una cadena
$archivo = fopen("clase".ucwords($tabla).".php","w");

$tem = "<?php
require_once '../conexion/Conexion.php';
class ".ucwords($tabla)."{
    //put your code here
    private ".'$'.'cnn'.";
    public function __construct() {
        ".'$'."this->cnn = new Conexion();
        ".'$'."this->cnn = ".'$'."this->cnn->abrirConexion();
    }

    public function mostrar".ucwords($tabla)."Datagrid(){
        ".'$'."limit = ".'$'."_REQUEST['rows'];
        ".'$'."page = ".'$'."_REQUEST['page'];
        ".'$'."sidx = ".'$'."_REQUEST['sidx'];
        ".'$'."sord = ".'$'."_REQUEST['sord'];
        if(!".'$'."sidx) ".'$'."sidx =1;
        ".'$'."wh = '';
        ".'$'."searchOn = Strip(".'$'."_REQUEST['_search']);
        if(".'$'."searchOn=='true') {
            ".'$'."sarr = Strip(".'$'."_REQUEST);
            foreach( ".'$'."sarr as ".'$'."k=>".'$'."v) {
                switch (".'$'."k) {
                    case 'campo':
                        
                        break;
                }
            }
        }
        ".'$'."query=\"SELECT COUNT(*) FROM $tabla WHERE 1=1 ".'$'."wh \";
        ".'$'."dato = obtenerPaginacion(".'$'."query, ".'$'."limit, ".'$'."page);
        ".'$'."start = ".'$'."dato[0];".'$'."count = ".'$'."dato[1];".'$'."total_pages=".'$'."dato[2];
        ".'$'."query=\"SELECT $campos FROM $tabla WHERE 1=1 ".'$'."wh ORDER BY ".'$'."sidx ".'$'."sord LIMIT ".'$'."start,".'$'."limit\";

        obtenerXML(".'$'."page, ".'$'."count, ".'$'."total_pages, ".'$'."query);
    }
    
    public function mostrar".ucwords($tabla)."Vector($pkPasar){
        ".'$'."query = \"SELECT $campos FROM $tabla WHERE $pk \";
        ".'$'."row = mysql_fetch_array(mysql_query(".'$'."query));
        return $devolver;
    }

    public function mostrar".ucwords($tabla)."Combobox(".'$'."select){
        ".'$'."query = \"SELECT $campos FROM $tabla WHERE 1=1 ".'$'."wh\";
        ".'$'."result = mysql_query(".'$'."query);
        if(".'$'."select) echo \"<select>\";
        while (".'$'."row = mysql_fetch_row(".'$'."result)) {
            echo \"<option value = '".'$'."row[0]'>".'$'."row[1]</option>\";
        }
        if(".'$'."select) echo \"</select>\";
    }
    
    public function agregar".ucwords($tabla)."($camposPasar){
        ".'$'."data = verificarDatos('add', array($array));
        if(".'$'."data[0]!=''){
            ".'$'."query = \"INSERT INTO $tabla(".'$'."data[0]) VALUES(".'$'."data[1])\";
            mysql_query(".'$'."query);
        }
    }
    
    public function actualizar".ucwords($tabla)."($camposPasar){
        ".'$'."data = verificarDatos('edit', array($array)); 
        if(".'$'."data[0]!=''){
            ".'$'."query = \"UPDATE $tabla SET ".'$'."data[0] WHERE $pk\";
            mysql_query(".'$'."query);
        }
    }
    
    public function eliminar".ucwords($tabla)."($pkPasar){
        ".'$'."query = \"DELETE FROM $tabla WHERE $pk\";
        mysql_query(".'$'."query);
    }

}
?>
";

fputs($archivo, $tem);
fclose($archivo);



$archivo = fopen("admin".ucwords($tabla).".php","w");
$temp ="<?php
session_start();
if(!isset(".'$'."_SESSION['idusu'])) header(\"location:/sisfac/\");

require_once '../clases/clase".ucwords($tabla).".php';
require_once '../clases/claseDatoGeneral.php';
$$tabla = new ".ucwords($tabla)."();
".'$'."datoGeneral = new DatoGeneral();

if(".'$'."_REQUEST[f] == 1) $$tabla"."->mostrar".ucwords($tabla)."Datagrid ();
elseif(".'$'."_REQUEST[f] == 2) echo $$tabla"."->mostrar".ucwords($tabla)."Vector();
elseif(".'$'."_REQUEST[f] == 3) $$tabla"."->mostrar".ucwords($tabla)."Combobox(true);
elseif(".'$'."_REQUEST[f] == 4) $$tabla"."->mostrar".ucwords($tabla)."Combobox(false);
elseif(".'$'."_REQUEST['oper'] == 'add') $$tabla"."->agregar".ucwords($tabla)."($camposPasarFuncion);
elseif(".'$'."_REQUEST['oper'] == 'edit') $$tabla"."->actualizar".ucwords($tabla)."($camposPasarFuncion);
elseif(".'$'."_REQUEST['oper'] == 'del') $$tabla"."->eliminar".ucwords($tabla)."(".'$'."_REQUEST[id], ".'$'."_SESSION[claveGeneral]);



?>    
    ";
fputs($archivo, $temp);
fclose($archivo);


$archivo = fopen("clase".ucwords($tabla
        ).".js","w");

$temp = "
    
jQuery('#lista').jqGrid({
    url:'/sisfac/funcionesphp/admin".  ucwords($tabla).".php?f=1',
    datatype: \"xml\",
    colNames:[$camposCabeceraJs],
    colModel:[
        $camposJs
    ],
    height:80,
    width:'auto',
    rowNum:100,
    rowList:[100,200,300],
    rownumbers:true,
    sortname:'id',
    pginput:false,
    sortorder:'asc',
    viewrecords:true,
    //caption: \"Insumos\",
    editurl:'/sisfac/funcionesphp/admin".  ucwords($tabla).".php',
    pager:'#pager'
});

jQuery(\"#lista\").jqGrid('navGrid',\"#pager\",{edit:true,add:true,del:true},{
    //width:500,
    reloadAfterEdit:true,
    closeAfterEdit:true
},{
    //width:500,
    reloadAfterAdd:true,
    closeAfterAdd:true
    /*onclickSubmit:function(params,postdata){
        id=jQuery('#lista').jqGrid('getGridParam','selrow')
        return {id:id}
    },
    afterShowForm  : function(formid) {
        
    },
    beforeSubmit : function(postdata, formid) {  
        id = jQuery('#id').val()
        return [id!='','Debe seleccionar '];
    }*/
});
";

fputs($archivo, $temp);
fclose($archivo);





$cnn->cerrarConexion();
?>

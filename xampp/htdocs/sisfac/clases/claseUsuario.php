<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once '../conexion/Conexion.php';

class Usuario {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarUsuariosDatagrid(){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;     
        $wh = "";
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'nombre':
                    case 'tipocambio':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'mesas':
                        $wh .= " AND $k = $v";
                        break;
                }
            }
        }
        $wh .= " AND u.claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM usuario u LEFT JOIN trabajador tr ON u.idtrabajador=tr.idtrabajador AND u.claveGeneral = tr.claveGeneral WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages = $dato[2];
        $query="SELECT u.idusuario,tr.idtrabajador,tr.nombreCompleto,u.usuario,u.tipo,u.estado
                FROM usuario u INNER JOIN trabajador tr ON u.idtrabajador=tr.idtrabajador AND u.claveGeneral = tr.claveGeneral
                WHERE u.usuario <> '' AND u.usuario <> ' ' AND u.usuario <> 'soporte' AND  u.usuario <> 'SUPERUSUARIO' AND  u.usuario <> 'ADMINSUPERUSUARIO' $wh ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    function agregarUsuario($claveGeneral, $idusuario, $idtrabajador, $usuario, $clave, $tipo, $estado){
        if($idtrabajador!=''){
            $c = " ,idtrabajador";
            $v = " ,$idtrabajador";
        }
        
        $query = "INSERT INTO usuario(claveGeneral $c, idusuario, usuario, clave, tipo, estado) 
                VALUES('$claveGeneral' $v, $idusuario, '$usuario', '$clave', '$tipo', '$estado')";
        mysql_query($query);
        echo $query;
    }
    
    function actualizarUsuario($claveGeneral, $idusuario, $idtrabajador, $usuario, $clave, $tipo, $estado){
        if($idtrabajador!=''){
            $c = " ,idtrabajador = $idtrabajador";
        }
        if($clave!=''){
            $c .= " ,clave='$clave'";
        }
        $query = "UPDATE usuario SET usuario='$usuario' $c,estado=$estado,tipo='$tipo' WHERE idusuario = $idusuario AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    function inactivarUsuario($idusuario,$activo){
        $query = "UPDATE usuario SET estado=$activo WHERE idusuario=$idusuario AND claveGeneral = '$_SESSION[claveGeneral]'";
        mysql_query($query);
    }
    
    function inactivarUsuarioTrabajador($idtrabajador){
        $query = "UPDATE usuario SET estado=0 WHERE idtrabajador = $idtrabajador AND claveGeneral = '$_SESSION[claveGeneral]'";
        mysql_query($query);
    }
    
    function eliminarUsuario($idusuario){
        $query = "DELETE FROM usuario WHERE idusuario=$idusuario  AND claveGeneral = '$_SESSION[claveGeneral]'";
        mysql_query($query);
    }
    
    function buscarUsuario($idtrabajador, $clave){
        $query = "SELECT COUNT(*) FROM usuario WHERE idtrabajador = $idtrabajador AND clave= '$clave'  AND claveGeneral = '$_SESSION[claveGeneral]'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
}

?>

<?php  
require_once (__ROOT__DB__."modelo.php"); 

class m_service extends Modelo 
{     
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    public function get_clave_nueva() {
        $rst = array();
        $queryClave = "SELECT MAX(Producto) + 1 as Clave From productos WHERE ProductoTipo = 1;";

        $rs = $this->_db->query($queryClave);
        $row = $rs->fetch_row();
        $rst["clave"] = $row[0];

        return $rst;
    }
    
    public function get_services() {
        $Producto = isset($_POST['Producto']) ? mysql_real_escape_string($_POST['Producto']) : '';
        $Nombre = isset($_POST['Nombre']) ? mysql_real_escape_string($_POST['Nombre']) : '';
        $Clasificacion = isset($_POST['ClasificacionFiltro']) ? mysql_real_escape_string($_POST['ClasificacionFiltro']) : '';
        
        $result = Array();
        
        $query =    "SELECT COUNT(*) ".
                    "FROM productos P ".                    
                    "   INNER JOIN clasificaciones C ON C.clasificacion = P.Clasificacion " .
                    "WHERE ProductoTipo = 1 AND P.Estado = 'A' ".
                    "       AND Producto LIKE '".$Producto. "%' AND P.Nombre LIKE '".$Nombre."%' AND C.clasificacion LIKe '".$Clasificacion."%';";
        
        $rs = $this->_db->query($query);
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        
        $query =    "SELECT Producto, Paquete, P.Nombre, P.Descripcion, C.Nombre as NombreCla, P.Estado, P.FechaAlta, C.clasificacion ".
                    "FROM productos P ".
                    "   INNER JOIN clasificaciones C ON C.clasificacion = P.Clasificacion   ".
                    "WHERE ProductoTipo = 1 AND P.Estado = 'A' ".
                    "       AND Producto LIKE '".$Producto. "%' AND P.Nombre LIKE '".$Nombre."%' AND C.clasificacion LIKE '".$Clasificacion."%' ".
                    "ORDER BY P.Nombre;";
    //echo $query;
        $resultSel = $this->_db->query($query);

        $services = Array();

        while ($row = $resultSel->fetch_array(MYSQLI_BOTH))        
            $services[] = $row;
        
        $this->disconectDB();
        
        $result["rows"] = $services;
        return $result;
    }

    public function SaveCategorie()
    {
        //Insert record into database
        $resultIns = $this->_db->query("INSERT INTO tblcategoria(NombreCategoria, ActivoCategoria, FechaAlta) VALUES('" . $_POST["NombreCategoria"] . "', 1 ,now());");

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query("SELECT NPK_Categoria, NombreCategoria, " .
                "CASE WHEN ActivoCategoria = 1 THEN 'ACTIVO' " .
                "ELSE 'INACTIVO' END as ActivoCategoria, FechaAlta " .
                "FROM tblcategoria WHERE NPK_Categoria = LAST_INSERT_ID();");

        //$row = mysql_fetch_array($result);
        $user = Array();
        while ($row = $result->fetch_array(MYSQLI_BOTH))        
            $user[] = $row;

        $this->disconectDB();
        return $user;
    }

    public function DeleteCategorie()
    {
        $result = $this->_db->query("UPDATE tblcategoria SET ActivoCategoria=0 WHERE NPK_Categoria= ". $_POST["NPK_Categoria"] . ";");
        $this->disconectDB();
    }
    
    public function UpdateCategorie()
    {
        $result = $this->_db->query("UPDATE tblcategoria SET NombreCategoria='".$_POST["NombreCategoria"]."', ".
                                    "FechaModificacion=now() WHERE NPK_Categoria= ". $_POST["NPK_Categoria"] . ";");
        $this->disconectDB();
    }
}
  ?> 
<?php
require_once (__ROOT__DB__."modelo.php");

class m_tipoempleado extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 
	
	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(TipoEmpleado) + 1 as Clave From tipoempleados;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
	
	public function get_tipoempleadoscombo() {
        $result = array();
        
        $query =    "SELECT 	TipoEmpleado, Nombre ".                    
                    "FROM tipoempleados WHERE Estado='A';";
      
        $resultSelect = $this->_db->query($query);

        $tipoemp = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $tipoemp[] = $row;
                
        return $tipoemp;
    }
	
    public function get_tipoempleados($activo = '') {
        $result = array();
        
        $query =    "SELECT 	TipoEmpleado, Abreviatura, Nombre, Descripcion, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO'  ".
                    "	ELSE 'INACTIVO'  ".
                    "END as Estado, fechaAlta ".
                    "FROM tipoempleados;";

        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';

        $rs = $this->_db->query("SELECT COUNT(*) from tipoempleados");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        //echo $query;
        
        $resultSelect = $this->_db->query($query);

        $tipoemp = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $tipoemp[] = $row;
        
        $this->disconectDB();
         $result["rows"] = $tipoemp;
        return $result;
    }

    public function SaveTipoEmpleado()
    {
        //Insert record into database
        $resultIns = $this->_db->query("INSERT INTO tipoempleados(Empresa, Sucursal, TipoEmpleado, Abreviatura, Nombre, Descripcion, Estado, FechaAlta) VALUES(1, 1, " . $_POST["txtClave"] . ", '" . $_POST["Abreviatura"] . "', '" . $_POST["Nombre"] . "', '" . $_POST["Descripcion"] . "', 'A' ,now());");

		 $query =    "SELECT 	TipoEmpleado, Abreviatura, Nombre, Descripcion, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO'  ".
                    "	ELSE 'INACTIVO'  ".
                    "END as Estado, fechaAlta ".
                    "FROM tipoempleados ".
					"WHERE TipoEmpleado=" .$_POST["txtClave"] . ";";
					
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $tipoemp = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $tipoemp[] = $row;

        $this->disconectDB();
        return $tipoemp;
    }

    public function DeleteTipoEmpleado()
    {
        $result = $this->_db->query("UPDATE tipoempleados SET Estado='I', FechaBaja=now() WHERE TipoEmpleado= ". $_POST["TipoEmpleado"] . ";");
        $this->disconectDB();
		return true;
    }
    
    public function UpdateTipoEmpleado()
    {
        $result = $this->_db->query("UPDATE tipoempleados SET Nombre='".$_POST["Nombre"]."', ".
                                    "Descripcion='".$_POST["Descripcion"]."' , ".
                                    "Abreviatura='".$_POST["Descripcion"]."' WHERE TipoEmpleado= ". $_POST["txtClave"] . ";");
									
		 $query =    "SELECT 	TipoEmpleado, Abreviatura, Nombre, Descripcion, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO'  ".
                    "	ELSE 'INACTIVO'  ".
                    "END as Estado, fechaAlta ".
                    "FROM tipoempleados ".
					"WHERE TipoEmpleado=" .$_POST["txtClave"] . ";";
					
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $tipoemp = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $tipoemp[] = $row;
			
        $this->disconectDB();
		return $tipoemp;
    }
}

<?php
require_once (__ROOT__DB__."modelo.php");

class m_employee extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(Empleado) + 1 as Clave From empleados;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }

    public function get_empleados_report($activo = '') {        
        
        $query =    "SELECT  Empleado, CONCAT(e.nombre, ' ', ApellidoPaterno, ' ', ApellidoMaterno) as Nombre, ".
                    "CONCAT(Domicilio, ' ', Colonia, ' ', Ciudad) as Direccion, ".
                    "t.Nombre AS TipoEmpleado ".
                    "FROM empleados e ".
                    "   INNER JOIN tipoempleados t on e.TipoEmpleado = t.TipoEmpleado ";

        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= 'ORDER BY Empleado;';

        $resultSelect = $this->_db->query($query);

        $employees = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_BOTH))        
            $employees[] = $row;
        
        $this->disconectDB();
        
        return $employees;
    }
    
    public function get_empleados($activo = '') {
        $result = array();
        
        $query =    "SELECT  Empleado, e.nombre as Nombre, ApellidoPaterno, ApellidoMaterno, ".
                    "CASE WHEN e.Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, e.fechaAlta, t.Nombre AS TipoEmpleado ".
                    "FROM empleados e ".
                    "   INNER JOIN tipoempleados t on e.TipoEmpleado = t.TipoEmpleado ";

        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= 'ORDER BY Empleado;';

        $rs = $this->_db->query("SELECT COUNT(*) from empleados");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        
        $resultSelect = $this->_db->query($query);

        $employees = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_BOTH))        
            $employees[] = $row;
        
        $this->disconectDB();
        $result["rows"] = $employees;
        
        return $result;
    }

    public function SaveEmployee()
    {
		$employee = Array();
		$query = "INSERT INTO empleados (Empresa, Sucursal, Empleado, Nombre, ApellidoPaterno, ApellidoMaterno, Domicilio, Colonia, Ciudad, TipoEmpleado, Rfc, Telefono, Estado, FechaAlta) ".
					"VALUES(1, 1,". $_POST["txtClave"] .", '". $_POST["Nombre"] ."', '". $_POST["ApellidoPaterno"] ."', '". $_POST["ApellidoMaterno"] ."', '". $_POST["Domicilio"] ."', ".
					"'". $_POST["Colonia"] ."', '". $_POST["Ciudad"] ."', ". $_POST["TipoEmpleado"] .", '". $_POST["Rfc"] ."', '". $_POST["Telefono"] ."', 'A', now());";
		
//echo $query;		
        //Insert record into database
        $resultIns = $this->_db->query($query);

        $query =    "SELECT  Empleado, e.Nombre, ApellidoPaterno, ApellidoMaterno, ".
                    "CASE WHEN e.Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, e.fechaAlta, t.Nombre AS TipoEmpleado ".
                    "FROM empleados e ".
                    "   INNER JOIN tipoempleados t on e.TipoEmpleado = t.TipoEmpleado ".
					"WHERE Empleado=". $_POST["txtClave"] . ";";
        
		$resultSelect = $this->_db->query($query);
		        
        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $employee[] = $row;

        $this->disconectDB();
        return $employee;
    }

    public function DeleteEmployee()
    {
        $result = $this->_db->query("UPDATE empleados SET Estado='I', FechaBaja=now() WHERE Empleado= ". $_POST["Empleado"] . ";");
        $this->disconectDB();
		return true;
    }
    
    public function UpdateEmployee()
    {
		$employee = Array();
		$query =    "SELECT  TipoEmpleado ".
                    "FROM tipoempleados  ".
					"WHERE Nombre='". $_POST["TipoEmpleado"] . "';";
		
		$tipoEmpleado = 0;
		$rs = $this->_db->query($query);
		$row = $rs->fetch_row();
		$tipoEmpleado= $row[0];
					
		$query = "UPDATE empleados SET Nombre='".$_POST["Nombre"]."', ".
                                    "ApellidoPaterno='".$_POST["ApellidoPaterno"]."' , ".
                                    "ApellidoMaterno='".$_POST["ApellidoMaterno"]."' , ".
									"Domicilio='".$_POST["Domicilio"]."' , ".
									"Colonia='".$_POST["Colonia"]."' , ".
									"Ciudad='".$_POST["Ciudad"]."' , ".
									"TipoEmpleado=".$tipoEmpleado." , ".
									"Rfc='".$_POST["Rfc"]."' , ".
									"Telefono='".$_POST["Telefono"]."' ".
									"WHERE Empleado= ". $_POST["txtClave"] . ";";
									
        $result = $this->_db->query($query);
									
		$query =    "SELECT  Empleado, e.Nombre, ApellidoPaterno, ApellidoMaterno, ".
                    "CASE WHEN e.Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, e.fechaAlta, t.Nombre AS TipoEmpleado ".
                    "FROM empleados e ".
                    "   INNER JOIN tipoempleados t on e.TipoEmpleado = t.TipoEmpleado ".
					"WHERE Empleado=". $_POST["txtClave"] . ";";
        
		$resultSelect = $this->_db->query($query);
		        
        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $employee[] = $row;
			
        $this->disconectDB();
		return $employee;
    }
}

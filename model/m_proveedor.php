<?php
require_once (__ROOT__DB__."modelo.php");

class m_proveedor extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(Proveedor) + 1 as Clave From proveedores;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
	
    public function get_proveedores($activo = '') {
        $result = array();
        
        $query =    "SELECT  Proveedor, Abreviatura, Nombre, Edo, Ciudad, Telefono, Domicilio, Colonia, Ciudad, CodigoPostal, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, ".
                    "IFNULL(Rfc, '') AS Rfc, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email, IFNULL(Banco, '') AS Banco, IFNULL(NumCuenta, '') AS NumCuenta, IFNULL(NumSucursal, '') AS NumSucursal, IFNULL(Ubicacion, '') AS Ubicacion " .
                    "FROM proveedores;";

        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';

        //echo $query;
        $rs = $this->_db->query("SELECT COUNT(*) from proveedores");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        
        $resultSelect = $this->_db->query($query);

        $provs = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_BOTH))        
            $provs[] = $row;
        
        $this->disconectDB();
        $result["rows"] = $provs;
        return $result;
    }

    public function SaveProveedor()
    {
        $query = "INSERT INTO proveedores (Empresa, Sucursal, Proveedor, Abreviatura, nombre, Domicilio, Colonia, CodigoPostal, Edo, ".
                 "                           Ciudad, Rfc, Fax, Telefono, Email, Banco, NumCuenta, NumSucursal, Ubicacion, Estado, ".
                 "                            FechaAlta) VALUES (1, 1, " .
                 "".$_POST["txtClave"].", '".$_POST["Abreviatura"]."', '".$_POST["Nombre"]."', '".$_POST["Domicilio"]."', '".$_POST["Colonia"]."', ".
                 "'".$_POST["CodigoPostal"]."', '".$_POST["Edo"]."', '".$_POST["Ciudad"]."', '".$_POST["Rfc"]."', '".$_POST["Fax"]."', ".
                 "'".$_POST["Telefono"]."', '".$_POST["Email"]."', '".$_POST["Banco"]."', '".$_POST["NumCuenta"]."', '".$_POST["NumSucursal"]."', ".
                 "'".$_POST["Ubicacion"]."', 'A', now());";
        
        //Insert record into database
        $resultIns = $this->_db->query($query);

        $query =    "SELECT  Proveedor, Abreviatura, Nombre, Edo, Ciudad, Telefono,  Domicilio, Colonia, Ciudad, CodigoPostal, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, ".
                    "IFNULL(Rfc, '') AS Rfc, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email, IFNULL(Banco, '') AS Banco, IFNULL(NumCuenta, '') AS NumCuenta, IFNULL(NumSucursal, '') AS NumSucursal, IFNULL(Ubicacion, '') AS Ubicacion " .
                    "FROM proveedores WHERE Proveedor=".$_POST["txtClave"].";";
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $prov = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $prov[] = $row;

        $this->disconectDB();
        return $prov;
    }

    public function DeleteProveedor()
    {
        $result = $this->_db->query("UPDATE proveedores SET Estado='I', FechaBaja=now() WHERE Proveedor= ". $_POST["Proveedor"] . ";");
        $this->disconectDB();
        return true;
    }
    
    public function UpdateProveedor()
    {
         $query =   "UPDATE proveedores SET Abreviatura ='".$_POST["Abreviatura"]."', ".
                    "                       nombre ='".$_POST["Nombre"]."', Domicilio='".$_POST["Domicilio"]."', ".
                    "                       Colonia='".$_POST["Colonia"]."', CodigoPostal='".$_POST["CodigoPostal"]."', ".
                    "                       Edo ='".$_POST["Edo"]."', Ciudad= '".$_POST["Ciudad"]."', ".
                    "                       Rfc='".$_POST["Rfc"]."', Fax='".$_POST["Fax"]."', Telefono='".$_POST["Telefono"]."', ".
                    "                       Email='".$_POST["Email"]."', Banco='".$_POST["Banco"]."', NumCuenta='".$_POST["NumCuenta"]."', ".
                    "                       NumSucursal='".$_POST["NumSucursal"]."', Ubicacion='".$_POST["Ubicacion"]."' ".
                    "WHERE Proveedor=".$_POST["txtClave"].";";

         
        $resultUpdate = $this->_db->query($query);
        
        $query =    "SELECT  Proveedor, Abreviatura, Nombre, Edo, Ciudad, Telefono,  Domicilio, Colonia, Ciudad, CodigoPostal, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, ".
                    "IFNULL(Rfc, '') AS Rfc, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email, IFNULL(Banco, '') AS Banco, IFNULL(NumCuenta, '') AS NumCuenta, IFNULL(NumSucursal, '') AS NumSucursal, IFNULL(Ubicacion, '') AS Ubicacion " .
                    "FROM proveedores WHERE Proveedor=".$_POST["txtClave"].";";
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $prov = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $prov[] = $row;
        
        $this->disconectDB();
        return $prov;
    }
}

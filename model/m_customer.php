<?php
require_once (__ROOT__DB__."modelo.php");

class m_customer extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(Cliente) + 1 as Clave From clientes;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
    
    public function get_customers_report($activo = '')
    {        
        $query =    "SELECT  Cliente, CONCAT(Nombre, ' ', ApellidoPaterno, ' ', ApellidoMaterno) AS Nombre, CONCAT(Domicilio, ' ', Colonia,  ' ', Ciudad) AS Direccion ".
                   /* "CodigoPostal, Rfc, telefono, TelTrabajo, MontoCredito, MontoPagado, LimiteCredito, ListaPrecio, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email ".*/
                    "FROM clientes ";                    
        
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= 'ORDER BY Cliente;';

        $resultSelect = $this->_db->query($query);

        $cutomers = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $cutomers[] = $row;
        
        $this->disconectDB();
        return $cutomers;        
    }
    
    public function get_customers($activo = '') {
        $result = array();
        
        $query =    "SELECT  Cliente, Nombre, ApellidoPaterno, ApellidoMaterno, Domicilio, Colonia, Ciudad, ".
                    "CodigoPostal, Rfc, telefono, TelTrabajo, MontoCredito, MontoPagado, LimiteCredito, ListaPrecio, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email ".
                    "FROM clientes ";                    
        
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= 'ORDER BY Cliente;';

        $rs = $this->_db->query("SELECT COUNT(*) from clientes;");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        
        $resultSelect = $this->_db->query($query);

        $cutomers = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $cutomers[] = $row;
        
        $this->disconectDB();
        $result["rows"] = $cutomers;
        
        return $result;
    }

    public function SaveCustomer()
    {
	$customer = Array();
        $ListaPrecio = 0;
        
        if(isset($_POST["ListaPrecio"]) || strlen($_POST["ListaPrecio"]) == 0)
            $ListaPrecio = -1;
        else
            $ListaPrecio = $_POST["ListaPrecio"];
        
        $query = "INSERT INTO clientes (Empresa, Sucursal, Cliente, Nombre, ApellidoMaterno, ApellidoPaterno, Domicilio, Colonia, Ciudad, CodigoPostal, ".
                 "   Rfc, telefono, TelTrabajo, Fax, Email, Estado, FechaAlta, MontoCredito, MontoPagado, LimiteCredito, ListaPrecio) " .
                "VALUES(1, 1," . $_POST["txtClave"] . ", '" . $_POST["Nombre"] . "', '" . $_POST["ApellidoPaterno"] . "', '" . $_POST["ApellidoMaterno"] . "', '" . $_POST["Domicilio"] . "', " .
                "'" . $_POST["Colonia"] . "', '" . $_POST["Ciudad"] . "', '" . $_POST["CodigoPostal"] . "', '" . $_POST["Rfc"] . "', '" . $_POST["telefono"] . "', ".
                "'" . $_POST["TelTrabajo"] . "', '" . $_POST["Fax"] . "', '" . $_POST["Email"] . "', 'A', now(), 0, 0, 0, ".$ListaPrecio.");";

    //echo $query;		
        //Insert record into database
        $resultIns = $this->_db->query($query);

        $query =    "SELECT  Cliente, Nombre, ApellidoPaterno, ApellidoMaterno, Domicilio, Colonia, Ciudad, ".
                    "CodigoPostal, Rfc, telefono, TelTrabajo, MontoCredito, MontoPagado, LimiteCredito, ListaPrecio, ".
                    "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                    "	ELSE 'INACTIVO' ".
                    "END as Estado, fechaAlta, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email ".
                    "FROM clientes ";
                    "WHERE Cliente=". $_POST["txtClave"] . ";";
        
		$resultSelect = $this->_db->query($query);
		        
        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $customer[] = $row;

        $this->disconectDB();
        return $customer;
    }

    public function DeleteCustomer()
    {
        $result = $this->_db->query("UPDATE clientes SET Estado='I', FechaBaja=now() WHERE Cliente= ". $_POST["Cliente"] . ";");
        $this->disconectDB();
	return true;
    }
    
    public function UpdateCustomer() {
        $customer = Array();
        $ListaPrecio = 0;

        if (isset($_POST["ListaPrecio"]) || strlen($_POST["ListaPrecio"]) == 0)
            $ListaPrecio = -1;
        else
        {
            $query = "SELECT  ListaPrecio " .
                "FROM listaprecios  " .
                "WHERE Nombre='" . $_POST["ListaPrecio"] . "';";
            
            $rs = $this->_db->query($query);
            $row = $rs->fetch_row();
            $ListaPrecio = $row[0];
        }


        $query = "UPDATE clientes SET Nombre='" . $_POST["Nombre"] . "', " .
                "ApellidoPaterno='" . $_POST["ApellidoPaterno"] . "' , " .
                "ApellidoMaterno='" . $_POST["ApellidoMaterno"] . "' , " .
                "Domicilio='" . $_POST["Domicilio"] . "' , " .
                "Colonia='" . $_POST["Colonia"] . "' , " .
                "Ciudad='" . $_POST["Ciudad"] . "' , " .
                "CodigoPostal='" . $_POST["CodigoPostal"] . "' , " .
                "Rfc='" . $_POST["Rfc"] . "' , " .
                "Telefono='" . $_POST["telefono"] . "', " .
                "TelTrabajo='" . $_POST["TelTrabajo"] . "', " .
                "Fax='" . $_POST["Fax"] . "', " .
                "Email='" . $_POST["Email"] . "', " .
                "ListaPrecio=" . $ListaPrecio . " " .
                "WHERE Cliente= " . $_POST["txtClave"] . ";";
//echo $query;
        $result = $this->_db->query($query);

        $query = "SELECT  Cliente, Nombre, ApellidoPaterno, ApellidoMaterno, Domicilio, Colonia, Ciudad, " .
                "CodigoPostal, Rfc, telefono, TelTrabajo, MontoCredito, MontoPagado, LimiteCredito, ListaPrecio, " .
                "CASE WHEN Estado = 'A' THEN 'ACTIVO' " .
                "	ELSE 'INACTIVO' " .
                "END as Estado, fechaAlta, IFNULL(Fax, '') AS Fax, IFNULL(Email, '') AS Email " .
                "FROM clientes ".
                "WHERE Cliente=" . $_POST["txtClave"] . ";";

        $resultSelect = $this->_db->query($query);

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))
            $customer[] = $row;

        $this->disconectDB();
        return $customer;
    }

}

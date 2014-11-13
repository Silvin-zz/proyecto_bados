<?php
require_once (__ROOT__DB__."modelo.php");

class m_profile extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(Perfil) + 1 as Clave From perfiles;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
	
	 public function get_profilescombo($activo = '') {        
        $query = "SELECT 	Perfil, Nombre, Descripcion,  ".
                 "   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' ". 
				 "		ELSE 'INACTIVO' ".
				"END as Estado, FechaAta, ".
				"Descuentos, Vender, Precios ".
						"FROM perfiles;";
        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';
        
        $resultSelect = $this->_db->query($query);

        $profiles = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $profiles[] = $row;
        
        $this->disconectDB();
        
        return $profiles;
    }
	
    public function get_profiles($activo = '') {
        $result = array();
        
        $query = "SELECT 	Perfil, Nombre, Descripcion,  ".
                 "   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' ". 
		 "		ELSE 'INACTIVO' ".
		"END as Estado, FechaAta, ".
		"Descuentos, Vender, Precios ".
                "FROM perfiles;";
        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';
        $rs = $this->_db->query("SELECT COUNT(*) from perfiles");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];

        //echo $query;
        
        $resultSelect = $this->_db->query($query);

        $profiles = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $profiles[] = $row;
        
        $this->disconectDB();
        $result["rows"] = $profiles;
        return $result;
    }

    public function SaveProfile()
    {
        //Insert record into database
        $resultIns = $this->_db->query("INSERT INTO perfiles(Empresa, Sucursal, Perfil, Nombre, Descripcion, Estado, FechaAta) VALUES(1, 1, " . $_POST["txtClave"] . ", '" . $_POST["Nombre"] . "', '" . $_POST["Descripcion"] . "', 'A' ,now());");

		$query = 	"SELECT 	Perfil, Nombre, Descripcion,  ".
					"   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' ". 
					"		ELSE 'INACTIVO' ".
					"END as Estado, FechaAta, ".
					"Descuentos, Vender, Precios ".
					"FROM perfiles ".
					"WHERE Perfil =" . $_POST["txtClave"] . ";";
				
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        //$row = mysql_fetch_array($result);
        $profile = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $profile[] = $row;

        $this->disconectDB();
        return $profile;
    }

    public function DeleteProfile()
    {
        $result = $this->_db->query("UPDATE perfiles SET Estado='I', FechaBaja=now() WHERE Perfil= ". $_POST["Perfil"] . ";");
        $this->disconectDB();
		return true;
    }
    
    public function UpdateProfile()
    {
        $result = $this->_db->query("UPDATE perfiles SET Nombre='".$_POST["Nombre"]."', ".
                                    "Descripcion='".$_POST["Descripcion"]."' ".
                                    "WHERE Perfil= ". $_POST["txtClave"] . ";");
									
		$query = 	"SELECT 	Perfil, Nombre, Descripcion,  ".
					"   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' ". 
					"		ELSE 'INACTIVO' ".
					"END as Estado, FechaAta, ".
					"Descuentos, Vender, Precios ".
					"FROM perfiles ".
					"WHERE Perfil =" . $_POST["txtClave"] . ";";
				
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $profile = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $profile[] = $row;
			
        $this->disconectDB();
		return $profile;
    }
}

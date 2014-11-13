<?php
require_once (__ROOT__DB__."modelo.php");

require_once(__ROOT__UTILS__ . "function.php");
sec_session_start(); // Nuestra manera personalizada segura de iniciar sesion PHP.

class m_user extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

	public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(usuario) + 1 as Clave From usuarios;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
	
    public function get_users($activo = '') {
        $result = array();
        
        $query = 	"SELECT 	usuario, u.Nombre, Login, p.Nombre AS Perfil,    ".
					"CASE 	WHEN u.Estado = 'A' THEN 'ACTIVO'   ".
					"		ELSE 'INACTIVO'   ".
					"END as Estado, fechaAlta  ".
					"FROM usuarios u ".
					"	INNER JOIN perfiles p ON u.Perfil=p.Perfil ";
        
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= 'ORDER BY usuario;';
        
        $rs = $this->_db->query("SELECT COUNT(*) from usuarios");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];
        
        $resultSelect = $this->_db->query($query);

        $users = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))        
            $users[] = $row;
        
        $this->disconectDB();
        $result["rows"] = $users;
        return $result;
    }

    public function SaveUser()
    {
		$query ="INSERT INTO usuarios(Empresa, Sucursal, usuario, Nombre, Login, Pasword, Perfil, Estado, FechaAlta) VALUES(1, 1, ".$_POST["txtClave"].", '" . $_POST["Nombre"] . "', '" . $_POST["Login"] . "', '" . $_POST["Password"] . "', ".$_POST["Perfil"].", 'A' ,now());";
        //echo $query;
		//Insert record into database
        $resultIns = $this->_db->query($query);

		 $query = 	"SELECT 	usuario, u.Nombre, Login, p.Nombre AS Perfil,    ".
					"CASE 	WHEN u.Estado = 'A' THEN 'ACTIVO'   ".
					"		ELSE 'INACTIVO'   ".
					"END as Estado, fechaAlta  ".
					"FROM usuarios u ".
					"	INNER JOIN perfiles p ON u.Perfil=p.Perfil ".
					"WHERE usuario=".$_POST["txtClave"].";";
							
        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);
        
        $user = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $user[] = $row;

        $this->disconectDB();
        return $user;
    }

    public function DeleteUser()
    {
        $result = $this->_db->query("UPDATE usuarios SET Estado='I' WHERE usuario= ". $_POST["usuario"] . ";");
        $this->disconectDB();
		return true;
    }
    
    public function UpdateUser() {
        $query = "SELECT  Perfil " .
                "FROM perfiles  " .
                "WHERE Nombre='" . $_POST["Perfil"] . "';";


        $Perfil = 0;
        $rs = $this->_db->query($query);
        $row = $rs->fetch_row();
        $Perfil = $row[0];

        $query = "UPDATE usuarios SET Nombre='" . $_POST["Nombre"] . "', " .
                "Login='" . $_POST["Login"] . "' , " .
                "Pasword='" . $_POST["Password"] . "', Perfil=" . $Perfil . " WHERE usuario= " . $_POST["txtClave"] . ";";

        $result = $this->_db->query($query);

        $query = "SELECT 	usuario, u.Nombre, Login, p.Nombre AS Perfil,    " .
                "CASE 	WHEN u.Estado = 'A' THEN 'ACTIVO'   " .
                "		ELSE 'INACTIVO'   " .
                "END as Estado, fechaAlta  " .
                "FROM usuarios u " .
                "	INNER JOIN perfiles p ON u.Perfil=p.Perfil " .
                "WHERE usuario=" . $_POST["txtClave"] . ";";

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $user = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $user[] = $row;
        $this->disconectDB();
        return $user;
    }

	public function LoginUser() {
        /* $result = $this->_db->query("UPDATE usuarios SET Estado='I' WHERE usuario= ". $_POST["usuario"] . ";");
          $this->disconectDB(); */
            
        $_SESSION['username'] = $_POST["Usuario"];
        return true;
    }

}

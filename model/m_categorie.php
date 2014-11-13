<?php  
require_once (__ROOT__DB__."modelo.php"); 

class m_categorie extends Modelo 
{     
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    public function get_categories($activo = '') {
        $query = 'SELECT NPK_Categoria, NombreCategoria, '.
                'CASE WHEN ActivoCategoria = 1 THEN "ACTIVO" '.
                'ELSE "INACTIVO" END as ActivoCategoria, FechaAlta '.
                'FROM tblcategoria';
        if (strlen($activo) > 0)
            $query .= ' WHERE CategoriaActivo= ' . $activo;

        $query .= ';';

        //echo $query;
        
        $result = $this->_db->query($query);

        $users = Array();

        while ($row = $result->fetch_array(MYSQLI_BOTH))        
            $users[] = $row;
        
        $this->disconectDB();
        return $users;
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
<?php
require_once (__ROOT__DB__."modelo.php");
/**
 * Description of m_mark
 *
 * @author steelmoi
 */
class m_mark extends Modelo {
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    public function get_clave_nueva()
    {
		$rst = array();
        $queryClave = "SELECT MAX(Marca) + 1 as Clave From marcas;";
        
        $rs = $this->_db->query($queryClave);
		$row = $rs->fetch_row();
		$rst["clave"] = $row[0];
        
        return $rst;
    }
    
    public function get_marcas($activo = '') {
        $rst = Array();
        $query = "SELECT Marca, Nombre, Descripcion, " .
                "CASE WHEN Estado = 'A' THEN 'ACTIVO' " .
                "ELSE 'INACTIVO' END as Estado, fechaAlta " .
                "FROM marcas";
        if (strlen($activo) > 0)
            $query .= " WHERE Estado= '" . $activo . "'";

        $query .= ';';

        $rs = $this->_db->query("SELECT COUNT(*) from marcas");
        $row = $rs->fetch_row();
        $rst["total"] = $row[0];

        //echo $query;

        $result = $this->_db->query($query);

        $marks = Array();

        while ($row = $result->fetch_array(MYSQLI_BOTH))
        //$marks[] = $row;
            array_push($marks, $row);

        $this->disconectDB();

        $rst["rows"] = $marks;

        return $rst;
    }

    public function SaveMark()
    {
        $query = "INSERT INTO marcas(Empresa, Sucursal, Marca, Nombre, Descripcion, Estado, fechaAlta) VALUES(1, 1, " . $_POST["txtClave"] . ", '" . $_POST["Nombre"] . "', '" . $_POST["Descripcion"] . "', 'A' ,now());";
        
        //Insert record into database
        $resultIns = $this->_db->query($query);

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query("SELECT Marca, Nombre, Descripcion, ".
                "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                "ELSE 'INACTIVO' END as Estado, fechaAlta ".                
                "FROM marcas WHERE Marca = ".$_POST["txtClave"] . ";"); //LAST_INSERT_ID()

        //$row = mysql_fetch_array($result);
        $mark = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
            $mark[] = $row;

        $this->disconectDB();
        return $mark;
    }

    public function DeleteMark()
    {
        $result = $this->_db->query("UPDATE marcas SET Estado='I' WHERE Marca= ". $_POST["Marca"] . ";");
        $this->disconectDB();
		
		return true;
    }
    
    public function UpdateMark()
    {
		$Mark = Array();
		
        $result = $this->_db->query("UPDATE marcas SET Nombre='".$_POST["Nombre"]."', ".
                                    "Descripcion='".$_POST["Descripcion"]."', FechaBaja=now() ".
                                    " WHERE Marca= ". $_POST["Marca"] . ";");
									
		$result = $this->_db->query("SELECT Marca, Nombre, Descripcion, ".
                "CASE WHEN Estado = 'A' THEN 'ACTIVO' ".
                "ELSE 'INACTIVO' END as Estado, fechaAlta ".                
                "FROM marcas WHERE Marca = ".$_POST["txtClave"] . ";");
		if ($result) {                
            while ($row = $result->fetch_array(MYSQLI_ASSOC))
                $Mark[] = $row;
        }
			
        $this->disconectDB();
		return $Mark;
    }
}

<?php
require_once (__ROOT__DB__."modelo.php");

class m_product extends Modelo{
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    public function get_productos($activo = '') {
        $query = 'SELECT NPK_Instrumento, NombreInstrumento, DescripcionInstrumento, '.
                 'ColorInstrumento, SKU, Modelo, PrecioContado, '.
                'CASE WHEN InstrumentoActivo = 1 THEN "ACTIVO" '.
                'ELSE "INACTIVO" END as InstrumentoActivo, tblinstrumento.FechaAlta '.
                'FROM tblinstrumento ' .
                ' INNER JOIN tblmarca on NFK_Marca= NPK_Marca ';
                ' INNER JOIN tblcategoria on NFK_Categoria= NPK_Categoria ';
        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE InstrumentoActivo= ' . $activo;

        $query .= ';';

        //echo $query;
        
        $result = $this->_db->query($query);

        $marks = Array();

        while ($row = $result->fetch_array(MYSQLI_BOTH))        
            $marks[] = $row;
        
        $this->disconectDB();
        return $marks;
    }

    public function SaveMark()
    {
        //Insert record into database
        $resultIns = $this->_db->query("INSERT INTO tblmarca(NombreMarca, DescripcionMarca, MarcaActivo, FechaAlta) VALUES('" . $_POST["NombreMarca"] . "', '" . $_POST["DescripcionMarca"] . "', 1 ,now());");

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query("SELECT NPK_Marca, NombreMarca, DescripcionMarca, " .
                "CASE WHEN MarcaActivo = 1 THEN 'ACTIVO' " .
                "ELSE 'INACTIVO' END as MarcaActivo, FechaAlta " .
                "FROM tblmarca WHERE NPK_Marca = LAST_INSERT_ID();");

        //$row = mysql_fetch_array($result);
        $mark = Array();
        while ($row = $result->fetch_array(MYSQLI_BOTH))        
            $mark[] = $row;

        $this->disconectDB();
        return $mark;
    }

    public function DeleteMark()
    {
        $result = $this->_db->query("UPDATE tblmarca SET MarcaActivo=0 WHERE NPK_Marca= ". $_POST["NPK_Marca"] . ";");
        $this->disconectDB();
    }
    
    public function UpdateMark()
    {
        $result = $this->_db->query("UPDATE tblmarca SET NombreMarca='".$_POST["NombreMarca"]."', ".
                                    "DescripcionMarca='".$_POST["DescripcionMarca"]." , ".
                                    "FechaModificacion=now() WHERE NPK_Marca= ". $_POST["NPK_Marca"] . ";");
        $this->disconectDB();
    }
}

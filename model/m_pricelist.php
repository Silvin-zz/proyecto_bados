<?php
require_once (__ROOT__DB__."modelo.php");

class m_pricelist extends Modelo {

    public function __construct() {
        parent::__construct();
    }

    public function get_clave_nueva() {
        $rst = array();
        $queryClave = "SELECT MAX(ListaPrecio) + 1 as Clave From listaprecios;";

        $rs = $this->_db->query($queryClave);
        $row = $rs->fetch_row();
        $rst["clave"] = $row[0];

        return $rst;
    }

    public function get_pricelistcombo($activo = '') {
        $query = "SELECT ListaPrecio, Nombre  " .
                "FROM listaprecios ";

        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';

        $resultSelect = $this->_db->query($query);

        $price = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))
            $price[] = $row;

        $this->disconectDB();

        return $price;
    }

    public function get_priceslist($activo = '') {
        $result = array();

        $query = "SELECT 	ListaPrecio, Nombre, Descripcion,  " .
                "   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' " .
                "		ELSE 'INACTIVO' " .
                "END as Estado, FechaAlta " .
                "FROM listaprecios ";
        //echo $query;
        if (strlen($activo) > 0)
            $query .= ' WHERE Estado= ' . $activo;

        $query .= ';';
        $rs = $this->_db->query("SELECT COUNT(*) from listaprecios;");
        $row = $rs->fetch_row();
        $result["total"] = $row[0];

        //echo $query;

        $resultSelect = $this->_db->query($query);

        $price = Array();

        while ($row = $resultSelect->fetch_array(MYSQLI_ASSOC))
            $price[] = $row;

        $this->disconectDB();
        $result["rows"] = $price;
        return $result;
    }

    public function SavePriceList() {
        //Insert record into database
        $resultIns = $this->_db->query("INSERT INTO listaprecios(Empresa, Sucursal, ListaPrecio, Nombre, Descripcion, Estado, FechaAlta) VALUES(1, 1, " . $_POST["txtClave"] . ", '" . $_POST["Nombre"] . "', '" . $_POST["Descripcion"] . "', 'A' ,now());");

        $query = "SELECT 	ListaPrecio, Nombre, Descripcion,  " .
                "   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' " .
                "		ELSE 'INACTIVO' " .
                "END as Estado, FechaAlta " .
                "FROM listaprecios " .
                "WHERE ListaPrecio =" . $_POST["txtClave"] . ";";

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $price = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $price[] = $row;

        $this->disconectDB();
        return $price;
    }

    public function DeletePrieList() {
        $result = $this->_db->query("UPDATE listaprecios SET Estado='I', FechaBaja=now() WHERE ListaPrecio= " . $_POST["ListaPrecio"] . ";");
        $this->disconectDB();
        return true;
    }

    public function UpdatePriceList() {
        $result = $this->_db->query("UPDATE listaprecios SET Nombre='" . $_POST["Nombre"] . "', " .
                "Descripcion='" . $_POST["Descripcion"] . "' " .
                "WHERE ListaPrecio= " . $_POST["txtClave"] . ";");

        $query = "SELECT 	ListaPrecio, Nombre, Descripcion,  " .
                "   CASE 	WHEN Estado = 'A' THEN 'ACTIVO' " .
                "		ELSE 'INACTIVO' " .
                "END as Estado, FechaAlta " .
                "FROM listaprecios " .
                "WHERE ListaPrecio =" . $_POST["txtClave"] . ";";

        //Get last inserted record (to return to jTable)
        $result = $this->_db->query($query);

        $price = Array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $price[] = $row;

        $this->disconectDB();
        return $price;
    }

}

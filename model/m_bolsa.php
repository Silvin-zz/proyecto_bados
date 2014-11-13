<?php  
require_once (__ROOT__DB__."modelo.php"); 

require_once(__ROOT__UTILS__ . "function.php");
sec_session_start(); // Nuestra manera personalizada segura de iniciar sesi�n PHP.
class m_bolsa extends Modelo 
{     
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    /*
     * Obtiene los precios de oro, plata y dolar
     */
    public function get_bolsavalores() {
        $query =    "SELECT Distinct b.TipoMoneda, Nombre, PrecioVenta, Fecha FROM tipomonedas t ".
                    "   Inner Join bolsadevalores b on b.TipoMoneda = t.TipoMoneda ".
                    "WHERE t.TipoMoneda in (1,2,3) ".
                    "ORDER BY b.fecha desc LIMIT 3;";
        //echo $query;
        
        $result = $this->_db->query($query);

        $values = Array();

        while ($row = $result->fetch_array(MYSQLI_ASSOC))        
        {
            $values[] = $row;
            
             /*if($row['TipoMoneda'] == '1')
                $values['precioCentenario'] = $row['PrecioVenta'];
             if($row['TipoMoneda'] == '2')
                $values['precioOnza'] = $row['PrecioVenta'];
             if($row['TipoMoneda'] == '3')
                $values['precioDollar'] = $row['PrecioVenta'];*/
        }
        
        $this->disconectDB();
        return $values;
    }

   
    
    public function UpdateBolsa() {
        $bolsa = 0;
        $queryClave = "SELECT MAX(Bolsa) + 1 as Clave From bolsadevalores;";

        $rs = $this->_db->query($queryClave);
        $row = $rs->fetch_row();
        $bolsa = $row[0];

        $query = "INSERT INTO bolsadevalores VALUES (1, 1, " . $bolsa . ", 1, " . $_POST["precioCentenario"] . ", 0, now(), 'A');";
        $result = $this->_db->query($query);

        $bolsa++;
        $query = "INSERT INTO bolsadevalores VALUES (1, 1, " . $bolsa . ", 2, " . $_POST["precioOnza"] . ", 0, now(), 'A');";
        $result = $this->_db->query($query);

        $bolsa++;
        $query = "INSERT INTO bolsadevalores VALUES (1, 1, " . $bolsa . ", 3, " . $_POST["precioDollar"] . ", 0, now(), 'A');";
        $result = $this->_db->query($query);

        $_SESSION['oro'] = $_POST["precioCentenario"];
        $_SESSION['dollar'] = $_POST["precioDollar"];
        $_SESSION['plata'] = $_POST["precioOnza"];

        $this->disconectDB();
        return true;
    }

}
  ?> 
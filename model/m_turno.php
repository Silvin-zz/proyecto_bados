<?php  
require_once (__ROOT__DB__."modelo.php"); 

class m_turno extends Modelo 
{     
    public function __construct() 
    { 
        parent::__construct(); 
    } 
	
    /*
     * Obtiene los precios de oro, plata y dolar
     */
    public function get_turnocombo() {
        $query =    "SELECT Turno, Nombre FROM turnos WHERE Estado = 'A';";
        //echo $query;
        
        $result = $this->_db->query($query);

        $values = Array();

        while ($row = $result->fetch_array(MYSQLI_ASSOC))                
            $values[] = $row;                         
        
        
        $this->disconectDB();
        return $values;
    }

    
}
  ?> 
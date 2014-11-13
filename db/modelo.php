<?php  
require_once ("config.php"); 

class Modelo 
{ 
    protected $_db; 

    public function __construct() 
    { 
        $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 

        if ( $this->_db->connect_errno ) 
        { 
            echo "Fallo al conectar a MySQL: ". $this->_db->connect_error; 
            return;     
        } 

        /* Recomendado: usar la API para cotrolar las configuraciones transaccionales */
        //$this->_db->autocommit(false);

        $this->_db->set_charset(DB_CHARSET); 
    }
    
    public function disconectDB()
    {
        $this->_db->close();
    }
} 
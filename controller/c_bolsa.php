<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_bolsa.php");
try {
    switch ($_GET['action'])
    {
        case 'cotization':
            $oBolsa = new m_bolsa();            

            $rows = Array();
            $rows = $oBolsa->get_bolsavalores();

            echo json_encode($rows);
            break;
			
		case 'update':
            $oBolsa = new m_bolsa();            
            
            $oBolsa->UpdateBolsa();

			echo json_encode(array('id' => '1'));            
            break;
       
    }
} catch (Exception $ex) {
    echo json_encode(array('errorMsg'=>$ex->getMessage()));
}
?>

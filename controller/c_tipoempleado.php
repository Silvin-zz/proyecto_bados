<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_tipoempleado.php");
try {
    switch ($_GET['action'])
    {
		case 'getkey':
            $oTipoEmp = new m_tipoempleado();
            $rows = Array();
            $rows = $oTipoEmp->get_clave_nueva();

            echo json_encode($rows);
            break;
			
		case 'combo':
            $oTipoEmp = new m_tipoempleado();

            $rows = Array();
            $rows = $oTipoEmp->get_tipoempleadoscombo();

            echo json_encode($rows);

            break;
        case 'list':
            $oTipoEmp = new m_tipoempleado();

            $rows = Array();
            $rows = $oTipoEmp->get_tipoempleados();

            echo json_encode($rows);

            break;
        case 'create':
            $oTipoEmpleado = new m_tipoempleado();
			$rows = Array();

            $rows = $oTipoEmpleado->SaveTipoEmpleado();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            
            break;
        case 'delete':
            $oTipoEmpleado = new m_tipoempleado();
            $valid = $oTipoEmpleado->DeleteTipoEmpleado();
            
             if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
			$rows = Array();
            $oTipoEmpleado = new m_tipoempleado();
            $rows = $oTipoEmpleado->UpdateTipoEmpleado();
            
           if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            break;
    }
} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();    
    $jTableResult['errorMsg'] = $ex->getMessage();
    print json_encode($jTableResult);
}
?>

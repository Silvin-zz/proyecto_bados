<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_proveedor.php");
try {
    switch ($_GET['action'])
    {
		case 'getkey':
            $oProveedores = new m_proveedor();
            $rows = Array();
            $rows = $oProveedores->get_clave_nueva();

            echo json_encode($rows);
            break;
			
        case 'list':
            $oProveedores = new m_proveedor();

            $rows = Array();
            $rows = $oProveedores->get_proveedores();

            echo json_encode($rows);
            break;
        case 'create':
            $oProveedores = new m_proveedor();
			$rows = Array();

            $rows = $oProveedores->SaveProveedor();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            
            break;
        case 'delete':
            $oProveedores = new m_proveedor();
            $valid = $oProveedores->DeleteProveedor();
            
             if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
            $rows = Array();
            $oProveedores = new m_proveedor();
            $rows = $oProveedores->UpdateProveedor();
            
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

<?php
require_once("../constant.php");

require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_user.php");

require_once(__ROOT__UTILS__ . "function.php");
sec_session_start(); // Nuestra manera personalizada segura de iniciar sesi�n PHP.
try {
    switch ($_GET['action'])
    {
		case 'getkey':
            $oUsers = new m_user();
            $rows = Array();
            $rows = $oUsers->get_clave_nueva();

            echo json_encode($rows);
            break;
        case 'list':
            $oUsers = new m_user();

            $rows = Array();
            $rows = $oUsers->get_users();

            echo json_encode($rows);

            break;
        case 'create':
            $oUsers = new m_user();
			$rows = Array();

            $rows = $oUsers->SaveUser();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            
            break;
        case 'delete':
            $oUsers = new m_user();
            $valid = $oUsers->DeleteUser();
            
             if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
			$rows = Array();
            $oUsers = new m_user();
            $rows = $oUsers->UpdateUser();
            
           if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            break;
        case 'login':
            $oUsers = new m_user();
            $valid = $oUsers->LoginUser();

            if ($valid) {
                $_SESSION['user_id'] = 1;
                echo json_encode(array('id' => '1'));
            } else
                echo json_encode(array('id' => '0'));
            break;
    }
} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();    
    $jTableResult['errorMsg'] = $ex->getMessage();
    print json_encode($jTableResult);
}
?>

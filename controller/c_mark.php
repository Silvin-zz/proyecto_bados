<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_mark.php");
try {
    switch ($_GET['action'])
    {
        case 'getkey':
            $oMark = new m_mark();
            $rows = Array();
            $rows = $oMark->get_clave_nueva();

            echo json_encode($rows);
            break;
        case 'list':
            $oMark = new m_mark();
            $rows = Array();
            $rows = $oMark->get_marcas();

            echo json_encode($rows);
            break;
        case 'create':
            $oMark = new m_mark();
            $rows = Array();

            $rows = $oMark->SaveMark();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            break;
        case 'delete':
            $oMark = new m_mark();
            $valid = $oMark->DeleteMark();
            
            if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
			$jTableResult = array();
            $oMark = new m_mark();
            $jTableResult = $oMark->UpdateMark();
            
            if ($jTableResult && count($jTableResult) > 0)
                echo json_encode($jTableResult);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            break;
    }
} catch (Exception $ex) {
     echo json_encode(array('errorMsg'=>$ex->getMessage()));
}
?>

<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_service.php");
try {
    switch ($_GET['action'])
    {
        case 'getkey':
            $oService = new m_service();
            $rows = Array();
            $rows = $oService->get_clave_nueva();

            echo json_encode($rows);
            break;
        
        case 'list':
            $oService = new m_service();

            //Return result to jTable
            /*$jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['Records'] = $oService->get_services();*/
            print json_encode($oService->get_services());

            break;
        case 'create':
            $oCategorie = new m_categorie();

            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['Record'] = $oCategorie->SaveCategorie();
            print json_encode($jTableResult);
            break;
        case 'delete':
            $oCategoria = new m_categorie();
            $oCategoria->DeleteCategorie();
            
            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            print json_encode($jTableResult);
            break;
        case 'update':
            $oCategoria = new m_categorie();
            $oCategoria->UpdateCategorie();
            
            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            print json_encode($jTableResult);
            break;
    }
} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}
?>

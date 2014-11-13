<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_categorie.php");
try {
    switch ($_GET['action'])
    {
        case 'list':
            $oCategorie = new m_categorie();

            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['Records'] = $oCategorie->get_categories();
            print json_encode($jTableResult);

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

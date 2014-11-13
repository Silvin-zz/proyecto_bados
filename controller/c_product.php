<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_product.php");
try {
    switch ($_GET['action'])
    {
        case 'list':
            $oProduct = new m_product();

            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['Records'] = $oProduct->get_productos();
            print json_encode($jTableResult);

            break;
        /*case 'create':
            $oProduct = new m_product();

            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['data'] = $oProduct->SaveMark();
            print json_encode($jTableResult);
            break;
        case 'delete':
            $oProduct = new m_product();
            $oProduct->DeleteMark();
            
            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            print json_encode($jTableResult);
            break;
        case 'update':
            $oProduct = new m_product();
            $oProduct->UpdateMark();
            
            //Return result to jTable
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            print json_encode($jTableResult);
            break;*/
    }
} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}
?>

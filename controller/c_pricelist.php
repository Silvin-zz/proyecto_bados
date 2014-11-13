<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_pricelist.php");
try {
    switch ($_GET['action'])
    {
        case 'combo':
            $olistapecios = new m_pricelist();

            $rows = Array();
            $rows = $olistapecios->get_pricelistcombo();

            echo json_encode($rows);

            break;
        case 'getkey':
            $olistapecios = new m_pricelist();
            $rows = Array();
            $rows = $olistapecios->get_clave_nueva();

            echo json_encode($rows);
            break;
        case 'list':
            $olistapecios = new m_pricelist();

            $rows = Array();
            $rows = $olistapecios->get_priceslist();

            echo json_encode($rows);

            break;
        case 'create':
            $olistapecios = new m_pricelist();
            $rows = Array();

            $rows = $olistapecios->SavePriceList();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            
            break;
        case 'delete':
            $olistapecios = new m_pricelist();
            $valid = $olistapecios->DeletePrieList();
            
             if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
            $rows = Array();
            $olistapecios = new m_pricelist();
            $rows = $olistapecios->UpdatePriceList();
            
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

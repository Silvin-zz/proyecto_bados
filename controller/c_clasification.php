<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_clasification.php");
try {
    switch ($_GET['action']) {
        case 'combo':
            $oClasification = new m_clasification();

            $rows = Array();
            $rows = $oClasification->get_clascombo();

            echo json_encode($rows);

            break;
        case 'getkey':
            $oProfiles = new m_profile();
            $rows = Array();
            $rows = $oProfiles->get_clave_nueva();

            echo json_encode($rows);
            break;
        case 'list':
            $oProfiles = new m_profile();

            $rows = Array();
            $rows = $oProfiles->get_profiles();

            echo json_encode($rows);

            break;
        case 'create':
            $oProfiles = new m_profile();
            $rows = Array();

            $rows = $oProfiles->SaveProfile();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));

            break;
        case 'delete':
            $oProfiles = new m_profile();
            $valid = $oProfiles->DeleteProfile();

            if ($valid)
                echo json_encode(array('success' => true));
            else
                echo json_encode(array('errorMsg' => 'Error al Eliminar.'));
            break;
        case 'update':
            $rows = Array();
            $oProfiles = new m_profile();
            $rows = $oProfiles->UpdateProfile();

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

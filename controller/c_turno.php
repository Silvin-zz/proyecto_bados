<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_turno.php");
try {
    switch ($_GET['action'])
    {
        case 'combo':
            $oTurno = new m_turno();

            $rows = Array();
            $rows = $oTurno->get_turnocombo();

            echo json_encode($rows);
            break;
       
    }
} catch (Exception $ex) {
    echo json_encode(array('errorMsg'=>$ex->getMessage()));
}
?>

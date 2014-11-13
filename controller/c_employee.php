<?php

require_once("../constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__DB__ . "modelo.php");
require_once(__ROOT__MODEL__ . "m_employee.php");
try {
    switch ($_GET['action'])
    {
        case 'report':
            $oEmployee = new m_employee();

            $rows = Array();
            $rows = $oEmployee->get_empleados_report();

            //echo json_encode($rows);
            require_once(__ROOT__LIBS__.'class.ezpdf.php');
            $pdf = new Cezpdf('a4');
            $pdf->selectFont(__ROOT__LIBS__.'/fonts/courier.afm');
            $pdf->ezSetCmMargins(1,1,1.5,1.5);
            
            $titles = array(
                'Empleado' => '<b>Clave</b>',
                'Nombre' => '<b>Nombre</b>',
                'Direccion' => '<b>Direccion</b>',
                'TipoEmpleado' => '<b>Tipo Empleado</b>'
            );
            $options = array(
                'shadeCol' => array(0.9, 0.9, 0.9),
                'xOrientation' => 'center',
                'width' => 500
            );
            
            $txttit = "<b>BADOS</b>\n";
            $txttit.= "REPORTE DE EMPLEADOS \n";

            $pdf->ezText($txttit, 12);
            $pdf->ezTable($rows, $titles, '', $options);
            $pdf->ezText("\n\n\n", 10);
            $pdf->ezText("<b>Fecha:</b> " . date("d/m/Y"), 10);
            $pdf->ezText("<b>Hora:</b> " . date("H:i:s") . "\n\n", 10);
            $pdf->ezStream();
            break;
        
	case 'getkey':
            $oEmployee = new m_employee();
            $rows = Array();
            $rows = $oEmployee->get_clave_nueva();

            echo json_encode($rows);
            break;
        case 'list':
            $oEmpleados = new m_employee();

            $rows = Array();
            $rows = $oEmpleados->get_empleados();

            echo json_encode($rows);

            break;
        case 'create':
            $oEmployee = new m_employee();
			$rows = Array();

            $rows = $oEmployee->SaveEmployee();
            if ($rows && count($rows) > 0)
                echo json_encode($rows);
            else
                echo json_encode(array('errorMsg' => 'Some errors occured.'));
            
            break;
        case 'delete':
            $oEmployee = new m_employee();
            $valid = $oEmployee->DeleteEmployee();
            
             if($valid)
                echo json_encode(array('success'=>true));
            else
                echo json_encode(array('errorMsg'=>'Error al Eliminar.'));
            break;
        case 'update':
			$rows = Array();
            $oEmployee = new m_employee();
            $rows = $oEmployee->UpdateEmployee();
            
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

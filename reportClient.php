<?php
require_once("./constant.php");
require_once(__ROOT__UTILS__ . "function.php");

sec_session_start(); // Nuestra manera personalizada segura de iniciar sesi�n PHP.
if (!isset($_SESSION['user_id']))
    header("Location: ./view/login.html");
//header("Location: ./view/login.html?err=Could not initiate a safe session (ini_set)");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/master.css">
		
		<link rel="stylesheet" type="text/css" href="./js/easyui/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="./js/easyui/themes/icon.css">
		<link rel="stylesheet" type="text/css" href="./js/easyui/themes/color.css">
		<link rel="stylesheet" type="text/css" href="./js/easyui/demo/demo.css">
		<script type="text/javascript" src="./js/easyui/jquery.min.js"></script>
		<script type="text/javascript" src="./js/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="./js/easyui/datagrid-scrollview.js"></script>
		
		<script type="text/javascript" src="./js/controller.js"></script>
                
                <script type="text/javascript">
                    $(document).ready(
                        function(){                                                       
                            $('#dlgClientes').dialog('open').dialog('setTitle', "Reporte de Clientes");
                            $('#fm').form('clear');
                        }
                    );
                </script>
    </head>
	<body>            
			<div id="contenedor">
				<?php include_once("./view/menu.html"); ?>
                                <input type="hidden" id="view" name="view" value=""/>
                                <input type="hidden" id="title" name="title" value=""/>
                                <div style="height:600px;">
                                    
                                    <div id="dlgClientes" class="easyui-dialog" style="width:300px;height:180px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
                                        <div class="ftitle"></div><br>
                                        <form id="fm" method="post" novalidate>
                                            <div class="fitem">
                                                <label>Lista de Precios</label>
                                                <input class="easyui-combobox" 
                                                    name="ListaPrecio"
                                                    data-options="
                                                    url:'./controller/c_pricelist.php?action=combo',
                                                    method:'get',
                                                    valueField:'ListaPrecio',
                                                    textField:'Nombre',
                                                    panelHeight:'auto' ">
                                            </div>                                            
                                        </form>
                                    </div>
                                    <div id="dlg-buttons">
                                        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-search" onclick="openReportPDF('./controller/c_customer.php?action=report');" style="width:90px">Consultar</a>
                                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
                                    </div>
				</div>
				<?php include_once("./view/footer.html"); ?>
			</div>
	</body>
</html>
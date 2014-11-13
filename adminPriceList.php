<?php
	require_once("./constant.php");
	require_once(__ROOT__UTILS__."function.php");
	
	sec_session_start(); // Nuestra manera personalizada segura de iniciar sesión PHP.
?>

<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/master.css">
		
        <link rel="stylesheet" type="text/css" href="js/easyui/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="js/easyui/themes/icon.css">
		<link rel="stylesheet" type="text/css" href="js/easyui/themes/color.css">
		<link rel="stylesheet" type="text/css" href="js/easyui/demo/demo.css">
		<script type="text/javascript" src="js/easyui/jquery.min.js"></script>
		<script type="text/javascript" src="js/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="js/easyui/datagrid-scrollview.js"></script>
		
		<script type="text/javascript" src="js/controller.js"></script>	
    </head>
	<body>
		<div id="contenedor">
		<?php include_once("./view/menu.html"); ?>
		<br><br><br><br><br>
		
        <table id="dg" title="Catalogo Proveedores" class="easyui-datagrid" style="width:600px;height:400px"
			url="./controller/c_pricelist.php?action=list"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" view="scrollview">		
		<thead>
			<tr>
				<th field="ListaPrecio" width="50">Clave</th>				
				<th field="Nombre" width="120">Nombre</th>
                                <th field="Descripcion" width="200">Descripcion</th>				
				<th field="Estado" width="50">Status</th>
				<th field="FechaAlta" width="100">Fecha Alta</th>
			</tr>
		</thead>
		</table>
		
		<div id="toolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRecord('Nueva Lista Precio', './controller/c_pricelist.php?action=create', 'pricelist')">Agregar Lista Precio</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updatePriceList('./controller/c_pricelist.php?action=update');">Editar Lista Precio</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deletePriceList();">Eliminar Lista Precio</a>
		</div>
		
		<!-- FORM -->
                <div id="dlg" class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px"
                     closed="true" buttons="#dlg-buttons">
                    <div class="ftitle">Datos de la lista Precio</div>
                    <form id="fm" method="post" novalidate>
                        <div class="fitem">
                            <label>Clave:</label>
                            <input name="txtClave" readonly id="txtClave" class="easyui-textbox">
                        </div>                        
                        <div class="fitem">
                            <label>Nombre:</label>
                            <input name="Nombre" class="easyui-textbox" required="true">
                        </div>
                        
                        <div class="fitem">
                            <label>Descripci&oacute;n:</label>
                            <input name="Descripcion" class="easyui-textbox">
                        </div>                                               
                        <div class="fitem">						
                            <input type="hidden" name="ListaPrecio" value="0">                                            
                            <input type="hidden" name="FechaAlta" value="">
                        </div>                                                
                    </form>
                </div>
		<div id="dlg-buttons">
			<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRecord();" style="width:90px">Guardar</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
		</div>		
		<style type="text/css">
			#fm{
				margin:0;
				padding:10px 30px;
			}
			.ftitle{
				font-size:14px;
				font-weight:bold;
				padding:5px 0;
				margin-bottom:10px;
				border-bottom:1px solid #ccc;
			}
			.fitem{
				margin-bottom:5px;
			}
			.fitem label{
				display:inline-block;
				width:80px;
			}
			.fitem input{
				width:160px;
			}
			
			.datagrid-header-rownumber,.datagrid-cell-rownumber{
				width:40px;
			}
		</style>        
        <br><br><br><br><br>
		<?php include_once("./view/footer.html"); ?>
        </div>     
	</body>
</html>
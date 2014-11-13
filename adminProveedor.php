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
		<script type="text/javascript">
			$(function(){
            $('#dg').datagrid({
                detailFormatter: function(rowIndex, rowData){				
                    return '<table><tr>' +
                            '<td style="border:0;padding-right:10px">' +
                            '<p>Rfc: ' + rowData.Rfc+ '</p>' +
                            '<p>Fax: ' + rowData.Fax + '</p>' +
                            '</td>' +
                            '<td style="border:0">' +
                            '<p>Correo: ' + rowData.Email + '</p>' +
                            '<p>Banco: ' + rowData.Banco + '</p>' +
                            '</td>' +
                            '</tr>' +
			    '<tr>' +
                            '<td style="border:0;padding-right:10px">' +
                            '<p>Num Cuenta: ' + rowData.NumCuenta+ '</p>' +
                            '<p>NumSucursal: ' + rowData.NumSucursal + '</p>' +
                            '</td>' +
                            '<td style="border:0">' +
                            '<p>Ubicacion: ' + rowData.Ubicacion + '</p>' +                     
                            '</td>' +
                            '</tr></table>';
                }
            });
        });
		</script>
    </head>
	<body>
		<div id="contenedor">
		<?php include_once("./view/menu.html"); ?>
		<br><br><br><br><br>
        <!-- table id="dg" title="Catalogo Proveedores" class="easyui-datagrid" style="width:700px;height:450px"
			url="./controller/c_proveedor.php?action=list"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true" view="scrollview" -->
		 <table id="dg" title="Catalogo Proveedores" style="width:820px;height:400px" data-options="
                view:scrollview,rownumbers:true,singleSelect:true,
                url:'./controller/c_proveedor.php?action=list',
                autoRowHeight:false,pageSize:50" toolbar="#toolbar" pagination="true">
		<thead>
			<tr>
				<th field="Proveedor" width="50">Clave</th>
				<th field="Abreviatura" width="80">Abreviatura</th>
				<th field="Nombre" width="180">Nombre</th>				
				<th field="Edo" width="80">Estado</th>				
				<th field="Ciudad" width="100">Ciudad</th>
				<th field="Telefono" width="100">Telefono</th>
                                <th field="CodigoPostal" width="100">Codigo Postal</th>
				<th field="Estado" width="50">Status</th>
				<th field="fechaAlta" width="100">Fecha Alta</th>
			</tr>
		</thead>
		</table>
		
		<div id="toolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRecord('Nuevo Proveedor', './controller/c_proveedor.php?action=create', 'proveedor')">Agregar Proveedor</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updateProveedor('./controller/c_proveedor.php?action=update');">Editar Proveedor</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteProveedor();">Eliminar Proveedor</a>
		</div>
		
		<!-- FORM -->
                <div id="dlg" class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px"
                     closed="true" buttons="#dlg-buttons">
                    <div class="ftitle">Datos del Proveedor</div>
                    <form id="fm" method="post" novalidate>
                        <div class="fitem">
                            <label>Clave:</label>
                            <input name="txtClave" readonly id="txtClave" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Abreviatura:</label>
                            <input name="Abreviatura" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Nombre:</label>
                            <input name="Nombre" class="easyui-textbox" required="true">
                        </div>								

                        <div class="fitem">
                            <label>Domicilio:</label>
                            <input name="Domicilio" class="easyui-textbox">
                        </div>

                        <div class="fitem">
                            <label>Colonia:</label>
                            <input name="Colonia" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Codigo Postal:</label>
                            <input name="CodigoPostal" class="easyui-textbox">
                        </div>
                        <div class="fitem">						
                            <input type="hidden" name="Proveedor" value="0">                                            
                            <input type="hidden" name="fechaAlta" value="">
                        </div>
                        <div class="ftitle">Domicilio</div>
                        <div class="fitem">
                            <label>Estado:</label>
                            <input name="Edo" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Ciudad:</label>
                            <input name="Ciudad" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>RFC:</label>
                            <input name="Rfc" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Telefono:</label>
                            <input name="Telefono" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Fax:</label>
                            <input name="Fax" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Correo:</label>
                            <input name="Email" class="easyui-textbox">
                        </div>

                        <div class="ftitle">Datos de Facturaci&oacute;n</div>
                        <div class="fitem">
                            <label>Banco:</label>
                            <input name="Banco" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Num Cuenta:</label>
                            <input name="NumCuenta" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Num Sucursal:</label>
                            <input name="NumSucursal" class="easyui-textbox">
                        </div>
                        <div class="fitem">
                            <label>Ubicaci&oacute;n:</label>
                            <input name="Ubicacion" class="easyui-textbox">
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
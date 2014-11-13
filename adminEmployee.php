<?php
require_once("./constant.php");
require_once(__ROOT__DB__ . "config.php");
require_once(__ROOT__MODEL__ . "m_mark.php");

require_once(__ROOT__UTILS__ . "function.php");

sec_session_start(); // Nuestra manera personalizada segura de iniciar sesion PHP.
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

        <script type="text/javascript" src="js/controller.js"></script>
    </head>
    <body>
        <div id="contenedor">
            <?php include_once("./view/menu.html"); ?>
            <br><br><br><br><br>

            <table id="dg" title="Catalogo Empleados" class="easyui-datagrid" style="width:700px;height:450px"
                   url="./controller/c_employee.php?action=list"
                   toolbar="#toolbar" pagination="true"
                   rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="Empleado" width="50">Clave</th>
                        <th field="Nombre" width="50">Nombre</th>
                        <th field="ApellidoPaterno" width="80">Apellido Paterno</th>
                        <th field="ApellidoMaterno" width="80">Apellido Materno</th>
                        <th field="TipoEmpleado" width="50">Tipo Empleado</th>
                        <th field="Estado" width="50">Estado</th>
                        <th field="fechaAlta" width="50">Fecha Alta</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRecord('Nuevo Empleado', './controller/c_employee.php?action=create', 'employee')">Agregar Empleado</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updateEmployee('./controller/c_employee.php?action=update');">Editar Empleado</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteEmployee();">Eliminar Empleado</a>
            </div>

            <!-- FORM -->
            <div id="dlg" class="easyui-dialog" style="width:400px;height:440px;padding:10px 20px"
                 closed="true" buttons="#dlg-buttons">
                <div class="ftitle">Datos de Empleado</div>
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
                        <label>Apellido Paterno:</label>
                        <input name="ApellidoPaterno" class="easyui-textbox">
                    </div>
                    <div class="fitem">
                        <label>Apellido Materno:</label>
                        <input name="ApellidoMaterno" class="easyui-textbox">
                    </div>
                    <div class="fitem">
                        <label>Tipo Empleado</label>
                        <input class="easyui-combobox" 
                               name="TipoEmpleado"
                               data-options="
                               url:'./controller/c_tipoempleado.php?action=combo',
                               method:'get',
                               valueField:'TipoEmpleado',
                               textField:'Nombre',
                               panelHeight:'auto' ">
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
                        <label>Ciudad:</label>
                        <input name="Ciudad" class="easyui-textbox">
                    </div>
                    <div class="fitem">
                        <label>Telefono:</label>
                        <input name="Telefono" class="easyui-textbox">
                    </div>
                    <div class="fitem">
                        <label>RFC:</label>
                        <input name="Rfc" class="easyui-textbox">
                    </div>
                    <div class="fitem">						
                        <input type="hidden" name="Empleado" value="0">                                            
                        <input type="hidden" name="fechaAlta" value="">
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
            </style>        
            <br><br><br><br><br>
            <?php include_once("./view/footer.html"); ?>
        </div>     
    </body>
</html>
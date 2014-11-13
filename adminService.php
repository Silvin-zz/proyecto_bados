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
        
        <script type="text/javascript">
                function doSearch(){
                        $('#dg').datagrid('load',{
                                Producto: $('#Producto').val(),
                                Nombre: $('#Nombre').val()
                        });
                }
        </script>
    </head>
    <body>
        <div id="contenedor">
            <?php include_once("./view/menu.html"); ?>
            <br><br><br>

            <table id="dg" title="Catalogo Servicios" class="easyui-datagrid" style="width:90%;height:450px"
                   url="./controller/c_service.php?action=list"
                   toolbar="#toolbar" pagination="true"
                   rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="Producto" width="50">Clave</th>
                        <th field="Nombre" width="220">Nombre</th>
                        <th field="Descripcion" width="280">Descripcion</th>
                        <th field="NombreCla" width="80">Clasificacion</th>                        
                        <th field="Estado" width="50">Estado</th>
                        <th field="FechaAlta" width="50">Fecha Alta</th>
                    </tr>
                </thead>
            </table>

            <div id="toolbar">
                <span>Clave:</span>
		<input id="Producto" style="line-height:26px;border:1px solid #ccc">
		<span>Nombre:</span>
		<input id="Nombre" style="line-height:26px;border:1px solid #ccc">
                <span>Clasificacion:</span>
                <input class="easyui-combobox" 
                                   name="ClasificacionFiltro"
                                   data-options="
                                   url:'./controller/c_clasification.php?action=combo',
                                   method:'get',
                                   valueField:'clasificacion',
                                   textField:'Nombre',
                                   panelHeight:'auto' ">
                
		<a href="#" class="easyui-linkbutton" iconCls="icon-search"  plain="true" onclick="doSearch()">Buscar</a>
                <br>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRecord('Nuevo Servicio', './controller/c_service.php?action=create', 'service')">Agregar Servicio</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="updateService('./controller/c_service.php?action=update');">Editar Servicio</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteService();">Eliminar Servicio</a>
            </div>

            <!-- FORM -->
            <div id="dlg" class="easyui-dialog" style="width:500px;height:410px;padding:10px 20px"
                 closed="true" buttons="#dlg-buttons">
                <div class="ftitle">Datos de Servicio</div>
                <form id="fm" method="post" novalidate>
                    <div class="fitem">
                        <label>Clave:</label>
                        <input name="txtClave" readonly id="txtClave" class="easyui-textbox">
                    </div>
                    <div class="fitem">
                        <label>Clasificaion:</label>
                        <input class="easyui-combobox"  required="true" 
                                   name="Clasificacion"
                                   data-options="
                                   url:'./controller/c_clasification.php?action=combo',
                                   method:'get',
                                   valueField:'clasificacion',
                                   textField:'Nombre',
                                   panelHeight:'auto' ">
                    </div>
                    <div class="fitem">
                        <label>Nombre:</label>
                        <input name="Nombre" class="easyui-textbox" required="true">
                    </div>
                    <div class="fitem">
                        <label>Descripcion:</label>
                        <input name="Descripcion" class="easyui-textbox"  required="true">
                    </div>
                    <div class="fitem">
                        <label>Costo Unitario:</label>
                        <input name="CostoUnit" class="easyui-textbox">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="btnPaquete" class="easyui-linkbutton">Paquete</a>
                    </div>                    

                    <div class="fitem">
                        <label>Precio Unitario:</label>
                        <input name="PrecioUnit" class="easyui-textbox">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" id="btnPrecio" class="easyui-linkbutton">Generar Precio</a>
                    </div>                    
                    <div class="fitem">						
                        <input type="hidden" name="Producto" value="0">                                            
                        <input type="hidden" name="fechaAlta" value="">
                        <input type="hidden" name="Paquete" id="Paquete" value="">
                    </div>
                </form>
            </div>
            <div id="dlg-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRecord();" style="width:90px">Guardar</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="closeService();" style="width:90px">Cancelar</a>
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
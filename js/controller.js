var url;

function newRecord(title, controller, form) {
    $('#dlg').dialog('open').dialog('setTitle', title);
    $('#fm').form('clear');
    url = controller;
        
    if (form === 'marcas')
    {
        $.getJSON("./controller/c_mark.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    } else if ('employee' === form)
    {
        $.getJSON("./controller/c_employee.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    } else if ('profile' === form)
    {
        $.getJSON("./controller/c_profile.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('tipoempleado' === form)
    {
        $.getJSON("./controller/c_tipoempleado.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('user' === form)
    {
        $.getJSON("./controller/c_user.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('proveedor' === form)
    {
        $.getJSON("./controller/c_proveedor.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('customer' === form)
    {
        $.getJSON("./controller/c_customer.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('pricelist' === form)
    {
        $.getJSON("./controller/c_pricelist.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
    else if ('service' === form)
    {
        $.getJSON("./controller/c_service.php?action=getkey", function(data) {
            $('#fm').form('load', {
                txtClave: data.clave
            });
        });
    }
}

function saveRecord()
{
    $('#fm').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {
            var result = eval('(' + result + ')');
            if (result.errorMsg) {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                $('#dlg').dialog('close');		// close the dialog
                $('#dg').datagrid('reload');	// reload the user data
            }
        }
    });
}

/**************/
function updateMark(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Marca');
		$('#fm').form('load',row);
		$('#Marca').val(row.Marca);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.Marca
        });
	}
}

function deleteMark()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar la Marca?', function(r) {
            if (r) {                
                $.post('./controller/c_mark.php?action=delete', {Marca: row.Marca}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/**************/
function updateEmployee(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Empleado');
		$('#fm').form('load',row);
		$('#Empleado').val(row.Empleado);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.Empleado
        });
	}
}

function deleteEmployee()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el empleado?', function(r) {
            if (r) {                
                $.post('./controller/c_employee.php?action=delete', {Empleado: row.Empleado}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/***************************************************/
function updateProfile(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Perfil');
		$('#fm').form('load',row);
		$('#Perfil').val(row.Perfil);
		$('#Estado').val(row.Estado);
		$('#fechaAta').val(row.fechaAta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.Perfil
        });
	}
}

function deleteProfile()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el perfil?', function(r) {
            if (r) {                
                $.post('./controller/c_profile.php?action=delete', {Perfil: row.Perfil}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/***************************************************/
function updateTipoEmpleado(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Tipo Empleado');
		$('#fm').form('load',row);
		$('#TipoEmpleado').val(row.TipoEmpleado);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.TipoEmpleado
        });
	}
}

function deleteTipoEmpleado()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el Tipo de Empleado?', function(r) {
            if (r) {                
                $.post('./controller/c_tipoempleado.php?action=delete', {TipoEmpleado: row.TipoEmpleado}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}
/***********************************************************/
function updateUser(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Tipo Empleado');
		$('#fm').form('load',row);
		$('#usuario').val(row.usuario);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.usuario
        });
	}
}

function deleteUser()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el Usuario?', function(r) {
            if (r) {                
                $.post('./controller/c_user.php?action=delete', {usuario: row.usuario}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/***********************************************************/
function updateProveedor(controller) {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $('#dlg').dialog('open').dialog('setTitle', 'Editar Proveedor');
        $('#fm').form('load', row);
        $('#Proveedor').val(row.Proveedor);
        $('#Estado').val(row.Estado);
        $('#fechaAlta').val(row.fechaAlta);
        url = controller;
        $('#fm').form('load', {
            txtClave: row.Proveedor
        });
	}
}

function deleteProveedor()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el Proveedor?', function(r) {
            if (r) {
                $.post('./controller/c_proveedor.php?action=delete', {Proveedor: row.Proveedor}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/***********************************************************/
function updateCustomer(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Cliente');
		$('#fm').form('load',row);
		$('#Cliente').val(row.Cliente);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
			txtClave: row.Cliente
        });
	}
}

function deleteCustomer()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar el Cliente?', function(r) {
            if (r) {                
                $.post('./controller/c_customer.php?action=delete', {Cliente: row.Cliente}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

/***********************************************************/
function updatePriceList(controller){
	var row = $('#dg').datagrid('getSelected');
	if (row){	
		$('#dlg').dialog('open').dialog('setTitle','Editar Lista Precio');
		$('#fm').form('load',row);
		$('#ListaPrecio').val(row.ListaPrecio);
		$('#Estado').val(row.Estado);
		$('#fechaAlta').val(row.fechaAlta);
		url = controller;
		$('#fm').form('load',{
                    txtClave: row.ListaPrecio
        });
	}
}

function deletePriceList()
{
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirm', 'Desea elminar La lista de Precio?', function(r) {
            if (r) {                
                $.post('./controller/c_pricelist.php?action=delete', {ListaPrecio: row.ListaPrecio}, function(result) {
                    if (result.success) {
                        $('#dg').datagrid('reload');	// reload the user data
                    } else {
                        $.messager.show({// show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                }, 'json');
            }
        });
    }
}

function Login(controller)
{
	url = controller;
	$('#frmLogin').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {		
            var result = eval('(' + result + ')');
            if (result.errorMsg) {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                //$('#dlg').dialog('close');		// close the dialog
                //$('#dg').datagrid('reload');	// reload the user data
            }
			
			if(parseInt(result.id)> 0)
			{
				window.location = "../view/bolsavalores.html"
			}else
				alert("Uusuario no valido");
        }
    });
}

function GotoLogin()
{
	window.location = "../view/login.html"
}

function SaveBolsaValores(controller)
{
	url = controller;
	$('#frmBolsa').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {		
            var result = eval('(' + result + ')');
            if (result.errorMsg) {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                //$('#dlg').dialog('close');		// close the dialog
                //$('#dg').datagrid('reload');	// reload the user data
				window.location = "../index.php"
            }							
			
        }
    });
}

function GotoPage(controler)
{
    window.location = controler;
}
function GotoPageReport(controler, pView, pTitle)
{
    window.location = controler;
    
    view = pView;
    title = pTitle;
}

function openReportPDF(controler)
{
    window.open(controler,'_blank');
    /*url = controler;    
    $('#fm').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(result) {
            var result = eval('(' + result + ')');
            if (result.errorMsg) {
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                $('#dlg').dialog('close');		// close the dialog
                $('#dg').datagrid('reload');	// reload the user data
            }
        }
    });*/
}

function myButtonClick(){
	getFile('phpExcelTest.php',$("#myForm").serialize());
}

function getFile(address,parameters){
	$.messager.progress({text:'Processing. Please wait...'});
	$.post(address,
		parameters,
		function(data){
			$.messager.progress('close');
			if(isNaN(data)==false){
				javascript:window.location='getFile.php?p='+data;
			} else {
				$.messager.alert('ERROR',data);
			}
		}
	);
}


//////////////////////////////////////////
function updateService(controller) {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $('#dlg').dialog('open').dialog('setTitle', 'Editar Servicio');
        $('#fm').form('load', row);
        $('#Producto').val(row.Producto);
        $('#Estado').val(row.Estado);
        $('#FechaAlta').val(row.FechaAlta);
        url = controller;
        $('#fm').form('load', {
            txtClave: row.Producto,
            Paquete: row.Paquete
        });
        if (row.Paquete === '0')
            $("#btnPaquete").linkbutton('disable');
        else
            $("#btnPrecio").linkbutton('disable');
    }
}

function closeService()
{
    try {
        $('#btnPaquete').linkbutton('enabled');
        $('#btnPrecio').linkbutton('enabled');
        $('#dlg').dialog('close');
    } catch (Err) {
        alert(Err);
    }
}

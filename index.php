<?php
	require_once("./constant.php");
	require_once(__ROOT__UTILS__."function.php");
	
	sec_session_start(); // Nuestra manera personalizada segura de iniciar sesi�n PHP.
	if(!isset($_SESSION['user_id'] ))
		header("Location: ./view/login.html");
		//header("Location: ./view/login.html?err=Could not initiate a safe session (ini_set)");
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
				<div style="height:600px;">
					<p>
						<ul>
							<li><h1>Avances:</h1></li>
                                                        <li><h1>Est&aacute;n funcionando 8 cat&aacute;logos, los cuales se muestran en el menu/catalogo</h1></li>
                                                        <li><h1>Est&aacute;n funcionando 2 reportes, que si bien no es el formato final, si es la prueba para que los vaya checando, aqui se genera un pdf, el cual puede descargar en el equipo o bien enviarlo directamente a la impresora</h1></li>
							<li><h1>El login, se pide, pero por el momento es "incorrecto", pues no valida el usuaurio, por los motivos expuestos</h1></li>
                                                        <li><h1>El cambio de precio, funciona correctamente, por lo que veo se pide toda vez que se inicia sesi&oacute;n. As&iacute; que se quede o que s&oacute;lo lo pide si no se ha cambiado en el d&iacute;a y que exista una opci&oacute;n para cambiarlo en caso de requerirlo?</h1></li>
							<br>
							<br>
							<li><h1>La interfaz no es la final, pues falta darle una mejor vista</h1></li>
							<li><h1>Los colores son improvisados, se aceptan sugerencias</h1></li>
                                                        <li><h1>Me estoy aproximando a la interfaz que tienen actualmente, aunque no quedar&aacute; igual har&eacute; lo posible</h1></li>
                                                        <li><h1>En cada catalogo, se encuentra una toolbar donde se pueden hacer todas las operaciones, falta agregar filtros de b&uacute;squeda</h1></li>
							<br>
							<br>
                                                        <li><h1>Hasta el momento es el avance, pareciera que es poco, pero hay cosas que se tienen que estar analizando en el video que pepe me entreg&oacute;, lo cual me reraza al desarrollar</h1></li>
                                                        <li><h1>Estimo que en 8 d&iacute;as tendr&aacute; un mayor avance</h1></li>
							
							<br>
                                                        <li><h1>Se aceptan sugerencias y cr&iacute;ticas de toda clase</h1></li>
						</ul>
					</p>
				</div>
				<?php include_once("./view/footer.html"); ?>
			</div>
	</body>
</html>
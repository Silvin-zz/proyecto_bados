<?php
//include_once("../constant.php");

//http://es.wikihow.com/crear-un-script-de-inicio-de-sesi%C3%B3n-segura-en-php-y-MySQL

function sec_session_start() {
    $session_name = 'sec_session_id_bados';   // Configura un nombre de sesi�n personalizado.
    //$secure = SECURE;
    // Esto detiene que JavaScript sea capaz de acceder a la identificaci�n de la sesi�n.
    $httponly = true;
    // Obliga a las sesiones a solo utilizar cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Obtiene los params de los cookies actuales.
    /*$cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);*/
    // Configura el nombre de sesi�n al configurado arriba.
    session_name($session_name);
    if (!isset($_SESSION)) {
        session_start();            // Inicia la sesion PHP.
    }
    session_regenerate_id();    // Regenera la sesi�n, borra la previa. 
}

function sec_session_stop()
{
	sec_session_start();
 
	// Desconfigura todos los valores de sesi�n.
	$_SESSION = array();
	 
	// Obtiene los par�metros de sesi�n.
	$params = session_get_cookie_params();
	 
	// Borra el cookie actual.
	setcookie(session_name(),
			'', time() - 42000, 
			$params["path"], 
			$params["domain"], 
			$params["secure"], 
			$params["httponly"]);
	 
	// Destruye sesi�n. 
	session_destroy();
	header('Location: ../ index.php');
}

?>
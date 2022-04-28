<?php
// Acceso a la base de datos
if ($_SERVER["SERVER_NAME"]=="localhost")
{

define ("DB_HOST","localhost");
define ("DB_USUARIO", "root");
define ("DB_CLAVE", "");
define ("DB_BASE", "arquitectos2");
$db_llave='dialluvioso';
// Directorio raiz del sitio
$url_sitio = "http://" . $_SERVER["SERVER_NAME"] . "/arquitectos2/";
}

elseif ($_SERVER["SERVER_NAME"]=="127.0.0.1")
{

define ("DB_HOST","127.0.0.1");
define ("DB_USUARIO", "root");
define ("DB_CLAVE", "");
define ("DB_BASE", "arquitectos2");
$db_llave='dialluvioso';
// Directorio raiz del sitio
$url_sitio = "http://" . $_SERVER["SERVER_NAME"] . "/arquitectos2/";
}

else
{
define ("DB_HOST","localhost");
define ("DB_USUARIO", "");
define ("DB_CLAVE", "");
define ("DB_BASE", "arquitectos2");
$db_llave='dialluvioso';
// Directorio raiz del sitio
$url_sitio = "http://" . $_SERVER["SERVER_NAME"] . "/arquitectos2/";
}
// Conexion al servidor
$conexion = mysqli_connect(DB_HOST,DB_USUARIO,DB_CLAVE);
// Seleccion de la base de datos
//mysqli_select_db($conexion,DB_BASE);
//mysqli_query($conexion,"SET NAMES 'utf8'");

	$mysqli = new mysqli("localhost", "root", "", "arquitectos2");
	if ($mysqli->connect_errno)
		echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	$mysqli->set_charset("utf8");

?>
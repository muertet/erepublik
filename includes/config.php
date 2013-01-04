<?
// Arxius que shan de canviar si canvio de host:
//	-css/css.php
//	-js/js.php
//	-css/basic.css



$PATH_ARRAY["logico"] = "/";
$PATH_ARRAY["fisico"] = "/blabla/gfhfgh/"; // echo getcwd();
$PATH_ARRAY["normal"] = "http://erepublik.com/";
$PATH_ARRAY["http_cdn"] = "http://cdn.erepublik.com/";
$PATH_ARRAY["includes"] = $PATH_ARRAY["fisico"]."includes/";
$PATH_ARRAY["fisico_js"] =  $PATH_ARRAY["fisico"]."js/";
$PATH_ARRAY["fisico_css"] =  $PATH_ARRAY["fisico"]."css/";
$PATH_ARRAY["cache"] = $PATH_ARRAY["fisico"]."tmp/";
$PATH_ARRAY["templates"] = $PATH_ARRAY["fisico"]."templates/"; 
$GLOBALS["PATH_ARRAY"]=$PATH_ARRAY;

include_once $PATH_ARRAY["includes"]."templates.lib.php";
include_once $PATH_ARRAY["includes"]."functions.php";
include_once $PATH_ARRAY["includes"]."mysql.php";
include_once $PATH_ARRAY["fisico"]."classes/autoloader.class.php";

$GLOBALS["db"]=$db;
$GLOBALS["db_slave"]=$db_slave;
$GLOBALS["recaptcha_public"]='6Ldvz9YSAAAAAJWTTyvy7AGezQIq1ewSEM-cbR9F';
$GLOBALS["recaptcha_private"]='6Ldvz9YSAAAAAK_1HEssDhnZPI-5kfSp36_YJF_6';

ini_set("log_errors" , "0");

setlocale(LC_ALL,"es_ES");
date_default_timezone_set("Europe/Madrid");
ini_set("session.gc_maxlifetime", "18000");
session_cache_expire("300");
session_start();

//login a traves de la cookie!
if( (!isset($_SESSION["login"]))&&(isset($_COOKIE["chk"]))&&(isset($_COOKIE["chk2"]))&&($_COOKIE["chk"]!='') )
{
	$sql_query="SELECT * FROM users WHERE (nick='".$_COOKIE["chk2"]."' AND pass='".$_COOKIE["chk"]."')";

			$result=mysql_query($sql_query,$db_slave);
			if(mysql_num_rows($result)==1)
			{
				$myArray=mysql_fetch_array($result);
				//Expulsat o no
				if($myArray["status"]=='1' || $myArray["status"]=='2')
				{	
					//Usuari correcte!
					$error_login=false;
					$_SESSION["login"]=$myArray;
				}
			}
}

?>
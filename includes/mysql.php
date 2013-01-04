<?

define ('DB_USER', '');
define ('DB_PASSWORD', '');
define ('DB_HOST', 'localhost');
define ('DB_NAME', '');

$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$db_slave =$db;
mysql_select_db (DB_NAME) OR die('Mantenimiento');
mysql_query("SET NAMES 'utf8'");

?>
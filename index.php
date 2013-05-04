<?
include_once('includes/config.php');

if(isset($_SESSION['login'])){
	include_once('logged.php');
}else{
	include_once('notlogged.php');
}

?>
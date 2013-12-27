<?php
include_once('bootstrap.php');

$_SESSION['underControl']=true;

if(isset($_SESSION['user'])){
	include_once('templates/logged.php');
}else{
	include_once('templates/notlogged.php');
}

?>

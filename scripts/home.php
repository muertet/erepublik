<?php
if(!$toinclude){
	include_once('../includes/config.php');
}


//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['myNick']=$_SESSION["login"]['nick'];
$array_templates['myUID']=$_SESSION["login"]['uid'];

// Volquem les dades
volcar_template('home',$array_templates,$toinclude);
?>
<?php
include_once('../../includes/config.php');

$id=(int)$_GET['id'];
if($id==''){header('Location: /');}


$message=Message::infoMessage($id);
if(!$message){header('Location: /');}

//*********** TEMPLATE **********//
$array_templates=array();
$array_templates=$message;
$array_templates['nick']=$_SESSION["login"]['nick'];


// Volquem les dades
volcar_template('citizen/message',$array_templates,$toinclude);
?>
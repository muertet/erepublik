<?php
include_once('../../includes/config.php');


//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['nick']=$_SESSION["login"]['nick'];

// Volquem les dades
volcar_template('citizen/profile',$array_templates,$toinclude);
?>
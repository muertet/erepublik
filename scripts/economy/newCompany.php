<?php
include_once('../../includes/config.php');


//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['myNick']=$_SESSION["login"]['nick'];

// Volquem les dades
volcar_template('economy/newCompany',$array_templates);
?>
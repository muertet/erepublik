<?php

/*
$query="SELECT name,id FROM countries ORDER BY id";
$result=mysql_query($query,$db);
$i=0;


while($myArray=mysql_fetch_array($result)){
	$cats[$i]=$myArray;
	$i++;
}
*/

//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['categorias']=$cats;
$array_templates['recaptcha_public']=$GLOBALS["recaptcha_public"];


// Volquem les dades
volcar_template('notlogged',$array_templates,false);

?>
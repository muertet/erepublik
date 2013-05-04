<?php

if($subContent==NULL){
	$subContent='<script type="text/javascript">$j.get("/scripts/home.php",function(data){$j("#content").html(data);});</script> ';
}

$calc=$_SESSION["login"]['currenthp']/($_SESSION["login"]['maxhp']/100);


//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['myNick']=$_SESSION["login"]['nick'];
$array_templates['myGold']=$_SESSION["login"]['gold'];
$array_templates['myMoney']=$_SESSION["login"]['money'];
$array_templates['myCurrentHp']=$_SESSION["login"]['currenthp'];
$array_templates['widthHp']=$calc;
$array_templates['myMaxHp']=$_SESSION["login"]['maxhp'];
$array_templates['myExp']=$_SESSION["login"]['xp'];
$array_templates['recaptcha_public']=$GLOBALS["recaptcha_public"];
$array_templates['content']=$subContent;

// Volquem les dades
volcar_template('logged',$array_templates);

?>
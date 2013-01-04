<?php

include_once("../../includes/config.php");

if(isset($_SESSION['login'])){die('3');}

$arr=array();
$expecting=array('name','password','email','countryId','referrer');

foreach($expecting as $row)
{
	$content=trim(mysql_real_escape_string($_POST[$row]));
	if($content=='' && $row!='referrer'){
		die('0');
	}
	if($row=='countryId'){
		$row='country';
	}elseif($row=='name'){
		$row='nick';
	}elseif($row=='password'){
		$row='pass';
	}
	
	$arr[$row]=$content;
}

$_POST["login_pass"]=$pass;

$user=new User();
$result=$user->newUser($arr);
$arr=array();

if(!$result){
	$arr['has_error']=1;
}

	die(json_encode($arr));
?>
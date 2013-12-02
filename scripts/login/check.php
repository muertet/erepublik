<?php
include_once("../../includes/config.php");


$arr=array();

if(isset($_GET['name'])){
	$name=mysql_real_escape_string($_GET['name']);
	$cond='nick';
}else{
	$name=mysql_real_escape_string($_GET['email']);
	$cond='email';
}

$sql_query="SELECT nick FROM users WHERE ".$cond."='".$name."'";
$result=mysql_query($sql_query,$GLOBALS['db_slave']);

if(mysql_num_rows($result)>0){
	$arr['response']=1;
}else{
	$arr['response']=0;
}

die(json_encode($arr));

?>
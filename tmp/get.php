<?
set_time_limit(0);
include_once('../includes/config.php');
$slovenia=false;

$query="SELECT name FROM countries";
$result=mysql_query($query,$db_slave);
while($myArray=mysql_fetch_array($result)){
	/*
	if(!$slovenia){
		if($myArray['name']=='Slovenia'){
			$slovenia=true;
		}
	continue;}*/
	$name=str_replace(' ','-',$myArray['name']);
	$ruta='/images/flags_png/L/'.$name.'.png';
	$content=file_get_contents('http://www.erepublik.com'.$ruta);
	file_put_contents('..'.$ruta, $content);
}

?>
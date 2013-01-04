<?
/*
E1 missing info
E2 missing gold
E3 fake/invalid info

*/
function basura($dada,$buit=false)
{
	$dada=mysql_real_escape_string(strip_tags($dada));
	if(!$buit && $dada==''){
		return '';
	}else{
		return $dada;
	}
}

function texto_aleatorio($long = 10, $letras_min = false, $letras_max = true, $num = true) 
{
	$salt = $letras_min?'abchefghknpqrstuvwxyz':'';
	$salt .= $letras_max?'ACDEFHKNPRSTUVWXYZ':'';
	$salt .= $num?(strlen($salt)?'2345679':'0123456789'):'';

	if (strlen($salt) == 0) { return ''; }

	$i = 0;
	$str = '';
	srand((double)microtime()*1000000);

	while ($i < $long) 
	{
		$num = rand(0, strlen($salt)-1);
		$str .= substr($salt, $num, 1);
		$i++;
	}	 

	return $str;
}

function encripta($pass)
{
	$cadena="45YGKUA9845hY";
	return(md5($pass.$cadena));
}
function parseQuery($obj,$array=false)
{
	$qSet="";
	foreach($obj->qRows as $row)
	{	
		if(!$array){
			$content=mysql_real_escape_string(strip_tags($obj->$row));
		}else{
			$content=mysql_real_escape_string(strip_tags($array[$row]));
		}
		
		if($content=='' && ($array && $row!='id') || !isset($content)){
			return false;
		}
		$qSet.=$row."='".$content."',";
	}
	$qSet=substr($qSet,0,-1);
	return $qSet;	
}



?>
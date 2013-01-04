<?php
echo'<pre>';
/*
	TEMPORAL
	pillar les imatges que fallen de l'erepublik
*/
$src=$_REQUEST['src'];
if($src==''){ die('0');}

$folders=explode('/',$src);
$realfolder='';
foreach($folders as $folder){
	if($folder=='' || strpos($folder,'.')!==false){continue;}
	echo $folder.'<br>';
	$realfolder.='/'.$folder;
	
}
echo $realfolder.'<br>';
if(is_dir($realfolder)){
	echo'true';
}
die();
if (!mkdir($realfolder, 0, true)) {
    die('Failed to create folders...');
}

print_r($folders);
//$content=file_get_contents('http://www.erepublik.com'.$src);
//file_put_contents('..'.$ruta, $content);

?>
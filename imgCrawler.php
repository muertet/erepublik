<?php
echo'<pre>';
/*
	TEMPORAL
	pillar les imatges que fallen de l'erepublik
*/
$src=str_replace('------CENSORED--','',$_REQUEST['src']);
if($src==''){ die('0');}

if(strpos($src,'/js/')!==false){
	$type='js';
}else{
	$type='images';
}

$folders=explode('/',$src);
$file=array_pop($folders);
$realfolder=$type;
foreach($folders as $folder){
	if($folder=='' || $folder==$type || strpos($folder,'.')!==false){continue;}
	$realfolder.='/'.$folder;
}
echo $realfolder.'<br>';
if(!is_dir($realfolder.'/')){
	if (!mkdir($realfolder.'/', 0777, true)) {
    	die('FAIL');
	}
}


$content=file_get_contents('http://www.erepublik.com'.$src);
file_put_contents($realfolder.'/'.$file, $content);

?>
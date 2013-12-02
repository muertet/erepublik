<?php

include_once('../includes/config.php');

/*
header('Pragma: public');
header('Cache-Control: max-age=2592000');
header('Expires: Fri, 1 Jan 2500 01:01:01 GMT');
header('Content-type: text/css; charset=utf-8');
header('Last-Modified:Fri, 27 Jan 2012 16:04:49 GMT');
*/

$final='';
$files = array(
	//$PATH_ARRAY["fisico"]."editor/"."ckeditor.js" => false,								// CKEditor
	$PATH_ARRAY["fisico_js"]."basic.js" => true,									
	$PATH_ARRAY["fisico_js"]."normal.js" => true,							
);

foreach($files AS $file => $min)
{
	$final .= file_get_contents($file);
}

echo $final;
?>
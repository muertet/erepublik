<?php
header('Content-type: application/json');

include_once('../bootstrap.php');

$apiRouter = new AltoRouter();
$apiRouter->setBasePath(substr(Config::get('basedir').'api/',0,-1));

// ROUTER MAPPING


// AUTH TOKEN
$apiRouter->map('POST','/app/create', array('c' => 'App', 'a' => 'create','authtoken'=>false,'usertoken'=>false,'official'=>false));
$apiRouter->map('POST','/authtoken/create', array('c' => 'AuthToken', 'a' => 'create','authtoken'=>false,'usertoken'=>false,'official'=>false));

$apiRouter->map('POST','/usertoken/create', array('c' => 'UserToken', 'a' => 'create','authtoken'=>true,'usertoken'=>false,'official'=>true));

// USER
$apiRouter->map('POST|GET','/user/hastrained', array('c' => 'User', 'a' => 'hasTrained','authtoken'=>true,'usertoken'=>true,'official'=>true));
$apiRouter->map('POST|GET','/user/train', array('c' => 'User', 'a' => 'train','authtoken'=>true,'usertoken'=>true,'official'=>true));
$apiRouter->map('POST','/user/create', array('c' => 'User', 'a' => 'create','authtoken'=>true,'usertoken'=>false,'official'=>true));
$apiRouter->map('GET','/user/get', array('c' => 'User', 'a' => 'get','authtoken'=>true,'usertoken'=>true,'official'=>false));

// JOB
$apiRouter->map('POST|GET','/job/get', array('c' => 'Job', 'a' => 'get','authtoken'=>true,'usertoken'=>true,'official'=>false));
$apiRouter->map('POST|GET','/job/work', array('c' => 'Job', 'a' => 'work','authtoken'=>true,'usertoken'=>true,'official'=>true));

// MARKET
$apiRouter->map('POST','/market/job/apply', array('c' => 'JobMarket', 'a' => 'apply','authtoken'=>true,'usertoken'=>true,'official'=>false));
$apiRouter->map('POST','/market/job/create', array('c' => 'JobMarket', 'a' => 'create','authtoken'=>true,'usertoken'=>true,'official'=>true));
$apiRouter->map('POST','/market/job/offers', array('c' => 'JobMarket', 'a' => 'offers'));

// COMPANY
$apiRouter->map('POST','/company/get', array('c' => 'Company', 'a' => 'get','authtoken'=>true,'usertoken'=>true));
$apiRouter->map('POST','/company/create', array('c' => 'Company', 'a' => 'create','authtoken'=>true,'usertoken'=>true,'official'=>true));
$apiRouter->map('POST|GET','/company/list', array('c' => 'Company', 'a' => 'getList','authtoken'=>true,'usertoken'=>true));


// RESOURCE
$apiRouter->map('GET','/resource/get', array('c' => 'Resource', 'a' => 'get'));
$apiRouter->map('GET','/resource/list', array('c' => 'Resource', 'a' => 'getList'));
$apiRouter->map('POST','/resource/create', array('c' => 'Resource', 'a' => 'create'));


// PRODUCT
$apiRouter->map('GET','/product/get', array('c' => 'Product', 'a' => 'get'));
$apiRouter->map('GET','/product/list', array('c' => 'Product', 'a' => 'getList'));
$apiRouter->map('POST','/product/create', array('c' => 'Product', 'a' => 'create'));

// REGION
$apiRouter->map('GET','/region/get', array('c' => 'Region', 'a' => 'get'));
$apiRouter->map('GET','/region/list', array('c' => 'Region', 'a' => 'getList'));
$apiRouter->map('POST','/region/create', array('c' => 'Region', 'a' => 'create'));

$match = $apiRouter->match();

$api=new Api($_REQUEST['authtoken'],$_REQUEST['usertoken']);

if(!$match){
	echo $api->replyError('Invalid call');
}else{	
	$call=$match['target'];
	
	$isOk=$api->checkSecurity($call['authtoken'],$call['usertoken'],$call['official']);
	
	if($isOk===true){
		echo $api->exec($call['c'],$call['a']);
	}else{
		echo $isOk;
	}
}
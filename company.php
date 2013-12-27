<?php
include_once('bootstrap.php');

switch($_POST['productType']){
	case 'resource':
		$_POST['productType']=1;
	break;
	case 'product':
		$_POST['productType']=2;
	break;
	default:
		die('wtf?');
	break;
}

$data=array(
	'name'=>$_POST['name'],
	'product'=>(int)$_POST['resource'],
	'productType'=>(int)$_POST['productType'],
);

if(empty($data['name']) || empty($data['product']) || empty($data['productType'])){
	header('Location: http://'.Config::get('domain'));
}

$response=ApiCaller::get('company/create',$data,true);

if($response->status){
	
	$_SESSION['user']->gold-=Company::CREATION_COST;
}

header('Location: http://'.Config::get('domain').'/companies.htm');

?>
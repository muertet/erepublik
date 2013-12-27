<?php
include_once('bootstrap.php');

$post=array(
	'email'=>$_POST['login'],
	'password'=>$_POST['password'],
);

if(empty($post['email']) || empty($post['password'])){
	header('Location: http://'.Config::get('domain'));
}

$userToken=ApiCaller::get('usertoken/create',$post);
if($userToken->status==1)
{
	$_SESSION['app']->userToken=$userToken->data;	
	
	$userData=ApiCaller::get('user/get',array(),true);
	
	if($userData->status==1)
	{
		$_SESSION['user']=$userData->data;
		
		setcookie('uid',$_SESSION['user']->id, time()+(60*60*24*7), '/'); // 1 week
		setcookie('__utmf', md5($_SESSION['user']->id), time()+(60*60*24*7), '/'); // 1 week	
	}
}

header('Location: http://'.Config::get('domain'));

?>

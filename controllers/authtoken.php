<?php

class cAuthToken extends Controller
{
	public function create()
	{
		$data=array(
			'id'=>$_POST['app'],
			'secret'=>$_POST['secret']
		);
		
		if(empty($data['id']) || empty($data['secret'])){
			throw new Exception('missing id or secret');
		}
		
		
		$app=new App();
		$appInfo=$app->get($data['id']);
		
		if($appInfo->secret!=$data['secret']){
			throw new Exception('invalid autentication');
		}
		
		if($appInfo->isBanned()){
			throw new Exception("This app can't create tokens");
		}
		
		$token=new AuthToken(array('app'=>$data['id']));
		return $token->save();
    }
	
}
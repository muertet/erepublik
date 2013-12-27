<?php

class cUserToken extends Controller
{
	public function create()
	{
		$data=array(
			'email'=>$_POST['email'],
			'password'=>$_POST['password']
		);
		
		
		if(empty($data['email']) || empty($data['password'])){
			throw new Exception('missing data');
		}
		
		$user=new User();
		$userData=$user->login($data['email'],$data['password']);
		
		if(!$userData){
			throw new Exception('Invalid login');
		}

		
		$tokenData=array(
			'app'=>$this->app->id,
			'uid'=>$userData->id,
		);
		
		$token=new UserToken($tokenData);
		return $token->save();	
    }
	
}
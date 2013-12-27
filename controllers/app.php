<?php

class cApp extends Controller
{
	public function create()
	{
		$data=array(
			'name'=>$_POST['name'],
			'description'=>$_POST['description'],
			'url'=>$_POST['url'],
			'uid'=>(int)$_POST['uid'],	
		);
		
		if(empty($data['name']) || empty($data['description'])){
			throw new Exception('missing name or description');
		}
		
		$user=new User();
		$result=$user->get($data['uid']);
		
		if(!$result){
			throw new Exception("Invalid user");
		}
		
		$app=new App($data);
		$id=$app->saveNew();

		return $id;
    }
	
}
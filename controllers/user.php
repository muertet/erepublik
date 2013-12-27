<?php

class cUser extends Controller
{
	public function hasTrained(){
		return $this->user->hastrained();
	}
	public function train()
	{
		if($this->user->hasTrained()){
			throw new Exception('you have already trained today');
		}
		
		return $this->user->train();
	}
	public function get()
	{
		$uid=(int)$_REQUEST['uid'];
		
		if($uid==0){
			$uid=$this->user->id;
		}
		
		$user=new User();
		$user->get($uid);
		
		$userData=$user->getRaw();
		
		//region data
		$region=new Region();
		$regionData=$region->getRaw($userData['region']);
		
		$userData['region']=array(
			'id'=>$regionData['id'],
			'name'=>$regionData['name'],
		);
		
		//counrry data
		$country=new Country();
		$countryData=$country->getRaw($userData['country']);
		
		$userData['country']=array(
			'id'=>$countryData['id'],
			'name'=>$countryData['name'],
		);
		
		// myself
		if($uid==$this->user->id)
		{
			$currencyQuantity=$user->getCurrency($userData['currency']);
			
			$userData['currencyName']=$userData['currency'];
			$userData['currency']=$currencyQuantity;
		}else{
			unset($userData['gold']);
			unset($userData['currency']);
		}
		
		unset($userData['password']);
		
		return $userData;
	}
	public function validateName()
	{
		$name=$_POST['name'];
		
		$user=new User();
		
		$where=array(
			array('nick','=',$name)
		);
		
		$results=$user->find($where);
		
		if(sizeof($results)>0){
			return false;
		}else{
			return true;
		}
    }
	
	public function login()
	{			
		if(empty($_POST['email']) || empty($_POST['password'])){
			return false;
		}
		
		$user=new User();
		return $user->login($_POST['email'],$_POST['password']);
	}
	
	public function create()
	{
		$data=array(
			'nick'=>$_POST['nick'],
			'email'=>$_POST['email'],
			'password'=>$_POST['password'],
			'citizenship'=>(int)$_POST['citizenship'],
			'referrer'=>(int)$_POST['referrer'],
		);
		
		if(empty($data['nick']) || empty($data['email']) || strlen($data['password'])<6 || empty($data['password'])){
			throw new Exception('missing info or password too short');
		}
		
		//set default citizenship for idiot users
		if($data['citizenship']<1){
			$data['citizenship']=1;	
		}
		
		$user=new User($user);
		$user->saveNew();
	}
}
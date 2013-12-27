<?php

class User extends BasicClass
{
	private $hash='4g4#r.gt';
	private $cookieHash='K4OTGdf';
	public $attributes=array
	(
		array('id','string'),
		array('nick','string'),
		array('email','string'),
		array('date','string'),
		array('status','string'),
		array('password','string'),
		array('maxHp','string'),
		array('currentHp','string'),
		array('country','integer'),
		array('region','integer'),
		array('gold','string'),
		array('currency','string'),
		array('xp','float'),
		array('language','string'),
	);
	const STATUS_PENDING=0;
	const STATUS_OK=1;
	const STATUS_BANNED=2;
	
	public function __construct($array=null)
	{
		parent::__construct();
		
		if(is_numeric($array)){
			$this->id=$array;
		}
		else if(is_array($array))
		{
			foreach($array as $row=>$v){
				$this->$row=$v;
			}
		}		
	}
	
	/**
	* checks if user already trained today
	* 
	* @return boolean
	*/
	public function hasTrained()
	{
		$yesterday=strtotime('-1 day');
	
		$result=$this->db->query("SELECT uid FROM train_historial WHERE uid='".$this->id."' AND date>'".$yesterday."' ");
		
		if(sizeof($result)>0){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	* User goes gym and trains
	* 
	* @return mixed (array/boolean)
	*/
	public function train()
	{
		/*
		Session 1-4	100 strength gain per day
		Session 5-14	50 strength gain per day
		Session 15-34	25 strength gain per day
		Session 35-64	10 strength gain per day
		Session 65-124	5 strength gain per day
		Session 125-199	2 strength gain per day
		Session 200+	1 strength gain per day
		*/
		
		$r=$this->db->query("SELECT uid FROM `train_historial` WHERE uid = '".$this->id."'");
		$trainedDays=sizeof($r);
		
		if($trainedDays<5){
			$strengh=100;
		}elseif($trainedDays<15){
			$strengh=50;
		}elseif($trainedDays<35){
			$strengh=25;
		}elseif($trainedDays<65){
			$strengh=10;
		}elseif($trainedDays<125){
			$strengh=5;
		}elseif($trainedDays<200){
			$strengh=2;
		}else{
			$strengh=1;
		}
		
		$skill=new Skill();
		$skill->get($this->id);
		
		$skill->strengh+=$strengh;
		
		if($skill->save()){
			
			$this->db->insert('train_historial',array(
				'uid'=>$this->id,
				'date'=>$this->now(),
			));
			
			$trainedDays++;
			
			return array(
				'strengh'=>$strengh,
				'trainedDays'=>$trainedDays,
			);
		}else{
			return false;
		}
	}
	
	/**
	* adds/deducts an amount for indicated currency
	* @param string $name currency name
	* @param float $quantity the amount to be added/deducted
	* 
	* @return boolean
	*/
	public function updateCurrency($name,$quantity)
	{
		$currency=$this->getCurrency($name);

		if($currency===false){
			$newAmount=$quantity;	
		}else{
			$newAmount=$currency+$quantity;
		}
		
		$where=array(
			'uid'=>$this->id,
			'name'=>$name,
		);
		
		
		if($currency===false){
			
			$where['quantity']=$newAmount;
			
			return $this->db->insert('user_currency',$where);
		}else{
			$this->db->where($where);
			
			$newAmount=array('quantity'=>$newAmount);
			
			return $this->db->update('user_currency',$newAmount);
		}
	}
	
	/**
	* Gets currency amount
	* @param string $name currency name
	* 
	* @return mixed (boolean/float)
	*/
	public function getCurrency($name)
	{
		$r=$this->db->query("SELECT quantity FROM user_currency WHERE uid='".$this->id."' AND name='".$name."' ");
		
		if(sizeof($r)==0){
			return false;
		}else{
			return $r[0]['quantity'];
		}
	}
	
	/**
	* Adds or deducts xp depending on given reason
	* @param string $reason
	* 
	* @return boolean
	*/
	public function updateXP($reason)
	{
		$r=$this->db->query("SELECT xp FROM xp_reasons WHERE reason='".$reason."' ");
		
		if(sizeof($r)==0){
			return false;
		}
		
		$this->get($this->id);
		
		$this->xp+=$r[0]['xp'];
		
		return $this->save();
	}
	
	public function getCookieHash(){
		return $this->cookieHash;
	}
	
	/**
	* Logins a user
	* @param string $email
	* @param string $password
	* @param boolean $isEncoded if password is encoded or not
	* 
	* @return mixed (user data or false)
	*/
	public function login($email,$password,$isEncoded=false)
	{
		if(empty($email) || empty($password)){
			throw new Exception('missing login info');
		}		
		
		if(!$isEncoded){
			$password=md5($this->hash.$password);
		}		
		
		$where=array(
			array('email','=',$email),
			array('password','=',$password),
			array('status','=',User::STATUS_OK)
			);
		$results=$this->find($where);
		
		if(sizeof($results)>0)
		{
			return $results[0];
		}else{
			return false;
		}
	}
	
	/**
	* creates a new user
	* 
	* @return mixed (uid or false)
	*/
	public function saveNew()
	{
		$this->status=self::STATUS_PENDING;
		$this->gold=0;
		$this->xp=0;
		$this->language='en';
		
		$q = "select `id` from `".$this->table."` where `email`='".$this->email."' OR `nick`='".$this->nick."' LIMIT 1";
		$rows = $this->db->query($q);
		
		if(sizeof($rows)>0){
			return false;
		}
		
		return parent::saveNew();
	}
}
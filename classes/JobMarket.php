<?php

class JobMarket extends BasicClass
{
	public $table="job_market";
	
	public $attributes=array
	(
		array('id','integer'),
		array('company','string'),
		array('skill','integer'),
		array('salary','float'),
		array('quantity','integer'),
		array('country','integer'),
		array('date','datetime'),
	);
	
	public function __construct($array=null)
	{
		parent::__construct();
		
		if($array!=null){
			foreach($array as $row=>$v){
				$this->$row=$v;
			}
		}
	}
	
	public function saveNew()
	{
		$this->id='';
			
		$user=new User();
		$user=$user->get($this->uid);
		
		if(!$user){
			throw new Exception('user not found');
		}
		
		$this->country=$user->country;
		
		$id=parent::saveNew();
		
		return $id;
	}
	
}
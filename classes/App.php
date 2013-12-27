<?php

class App extends BasicClass
{	
	public $attributes=array
	(
		array('id','integer'),
		array('secret','string'),
		array('name','string'),
		array('description','string'),
		array('uid','integer'),
		array('url','string'),
		array('official','integer'),
		array('status','integer'),
		array('date','datetime'),
	);
	
	const STATUS_WAITING_APPROVAL=0;
	const STATUS_OK=1;
	const STATUS_BANNED=2;
	
	public function __construct($array=null)
	{
		parent::__construct();
		
		if($array!=null){
			foreach($array as $row=>$v){
				$this->$row=$v;
			}
		}		
	}
	
	public function isBanned()
	{
		if($this->status==self::STATUS_BANNED){
			return true;
		}else{
			return false;
		}
	}
	
	public function isOfficial(){
		return $this->official;
	}
	
	private function generateSecret($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	
	public function saveNew()
	{
		$this->secret=$this->generateSecret();
		$this->date=date('Y-m-d H:i:s');
		$this->official=0;
		$this->status=0;
		
		if(empty($this->url)){
			$this->url='';
		}
		
		return parent::saveNew();
	}
	
}
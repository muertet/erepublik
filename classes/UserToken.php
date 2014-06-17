<?php

class UserToken extends BasicClass
{
	private $duration=7200;
	public $attributes=array
	(
		array('id','integer'),
		array('token','integer'),
		array('app','integer'),
		array('uid','integer'),
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
	
	public function generateToken(){
		return md5($this->app.'-'.$this->uid.'-'.time());
	}
	
	/**
	* Gets object from database
	* @param integer $token
	* @param boolean $rawResult
	* @return object
	*/
	public function get($token,$rawResult=false)
	{
		$q = "select * from `".$this->table."` where `token`='".$token."' LIMIT 1";
		$list=$this->db->query($q);
		
		if(sizeof($list)==0){
			return false;
		}
		
		$row=$list[0];
		
		if($rawResult){
			return $row;
		}else{
			
			foreach($this->attributes as $attr)
			{
				$k=$attr[0];
				$this->$k=$row[$k];		
			}
			
			return $this;	
		}
	}
	
	public function save()
	{
		$this->token=$this->generateToken();
		$this->date=$this->now();
		
		$dataToSave=array();
	
		$q = "select `id` from `".$this->table."` where `uid`='".$this->uid."' AND `app`='".$this->app."'  LIMIT 1";
		$rows = $this->db->query($q);
		
		foreach($this->attributes as $attr)
		{
			$k=$attr[0];
			$dataToSave[$k]=$this->$k;
		}
		
		if (sizeof($rows)>0)
		{
			unset($dataToSave['id']);
			$this->db->where('id',$rows[0]['id']);
			$insertId=$this->db->update($this->table,$dataToSave);
		}else{
			$insertId=$this->db->insert($this->table,$dataToSave);
		}
		
		if ($this->id == "")
		{
			$this->id = $insertId;
		}
		return $this->token;		
	}
	
}

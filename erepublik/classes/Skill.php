<?php

class Skill extends BasicClass
{
	
	public $attributes=array
	(
		array('id','string'),
		array('strengh','float'),
		array('economic','float'),
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
}
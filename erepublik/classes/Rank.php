<?php

class Rank extends BasicClass
{
	public $attributes=array
	(
		array('id','integer'),
		array('name','string'),
		array('damageRequired','integer'),
		array('damageModifier','float'),
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
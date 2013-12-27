<?php

class Product extends BasicClass
{
	public $attributes=array
	(
		array('id','integer'),
		array('name','string'),
		array('resource','integer'),
		array('resourceUnits','integer'),
		array('productivityBase','integer'),
		array('baseMultiplier','integer'),
		array('maxQuality','integer'),
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
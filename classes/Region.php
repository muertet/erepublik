<?php

class Region extends BasicClass
{
	public $attributes=array
	(
		array('id','integer'),
		array('name','string'),
		array('resourceAmount','integer'),
		array('resourceType','integer'),
		array('country','integer'),
		array('countryConqueror','integer')
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
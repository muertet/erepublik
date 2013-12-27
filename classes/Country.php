<?php

class Country extends BasicClass
{

	public $attributes=array
	(
		array('id','integer'),
		array('name','string'),
		array('shortName','string'),
		array('capitalRegionId','integer'),
		array('currency','string'),
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
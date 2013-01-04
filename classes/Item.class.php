<?php

if (!class_exists("Item")) {
class Item
{
	public $id;
	private $qRows=array('id','name','type','json');
	
	
	function __construct($id=false)
	{
		if($id){
			$this->id=(int)$id;
		}
	}
	
	public static function getItem($id,$rewrite=false)
	{
		$id=(int)$id;
		$key='itemsType'.$id;
		if( (($items=Memcached::get($key))===false) || $rewrite )
		{
			$items=array();
			$query="SELECT * FROM items WHERE type='".$id."' ";
			$result=mysql_query($query,$GLOBALS['db_slave']);
			if(mysql_num_rows($result)<1){ return false;}
			$myArray=mysql_fetch_array($result);
			
			$myArray['json']=json_decode($myArray['json']);
			$items=$myArray;
			Memcached::set($key,$items);
		}
		return $myArray;
	}
}}

?>
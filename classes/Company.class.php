<?php

//delete this and start from scratch
if (!class_exists("Company")) {
class Company
{
	private $qRows=array('id','type','q','uid','date');
	
	function __construct()
	{
		
	}
	public static function getCompany($id)
	{
		$id=(int)$id;
		$query="SELECT * FROM companies WHERE id='".$id."' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)<1){ return false;}
		
		return mysql_fetch_array($result);	
	}
	public static function getByOwner($uid=false)
	{
		if(!$uid){$uid=$_SESSION['login']['uid'];}
		$uid=(int)$uid;
		
		$query="SELECT * FROM companies WHERE uid='".$id."' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)<1){ return false;}
		
		return mysql_fetch_array($result);	
	}
	private function parse($array=false)
	{
		$qSet="";
		foreach($this->qRows as $row)
		{	
			if(!$array){
				$content=mysql_real_escape_string(strip_tags($this->$row));
			}else{
				$content=mysql_real_escape_string(strip_tags($array[$row]));
			}
			
			if($content=='' && ($array && $row!='id') || !isset($content)){
				return false;
			}
			$qSet.=$row."='".$content."',";
		}
		$qSet=substr($qSet,0,-1);
		return $qSet;
	}
	public function newCompany($array)
	{
		if(!isset($array['type']) || $array['type']==''){
			return 'E1';
		}
		$default=SELF::companyTypes($array['type']);
		if($_SESSION['login']['gold']<$default['cost']){
			return 'E2';
		}else if(!$default){
			return 'E3';
		}
		$qSet=$this->parse($array);
		if(!$qSet){return 'E1';}
		
		$query="INSERT INTO companies SET ".$qSet;
		$result=mysql_query($query,$GLOBALS['db']);
		$done=mysql_affected_rows();
		if($done>0){
			return true;	
		}
		return false;
	}
	public static function companyTypes($id=false,$rewrite=false)
	{ 
		$key='companyTypes';
		if( (($company=Memcached::get($key))===false) || $rewrite )
		{
			$company=array();
			$query="SELECT * FROM company ORDER BY id";
			$result=mysql_query($query,$GLOBALS['db_slave']);
			while($myArray=mysql_fetch_array($result)){
				$company[$myArray['id']]=$myArray;
			}
			Memcached::set($key,$company);
		}
		if($id){
			return $company[$id];
		}else{
			return $company;
		}
	}
}
}


?>
<?php 
if (!class_exists("User")) {
class User
{
	public $id;
	private $qRows=array('uid','nick','email','date','status','pass','maxhp','currenthp','country','gold','money','xp');
	
	
	function __construct($id=false)
	{
		if($id){
			$this->id=(int)$id;
		}
	}
	
	public static function infoUser($id)
	{
		$id=(int)$id;
		$query="SELECT * FROM users WHERE uid='".$id."' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)<1){ return false;}
		
		return mysql_fetch_array($result);
	}
	
	public function newUser($array)
	{
		$array['nick']=mysql_real_escape_string($array['nick']);
		$array['email']=mysql_real_escape_string($array['email']);
		//$time=time();
	
		$arr=array(
			'uid'=>'',
			'status'=>2,
			'date'=>time(),
			'maxhp'=>100,
			'currenthp'=>100,
			'gold'=>0,
			'money'=>150,
			'xp'=>0,
		);
		$array=array_merge($array,$arr);
		
		
		$sql_query="SELECT nick FROM users WHERE nick='".$array['nick']."' OR email='".$array['email']."'";
		$result=mysql_query($sql_query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)>0){
			return false;
		}
		
		$array['pass']=encripta($array['pass']);
		$qSet=$this->parseUser($array);
		
		if(!$qSet){return false;}
		
		$query="INSERT INTO users SET ".$qSet;
		$result=mysql_query($query,$GLOBALS['db']);
		$done=mysql_affected_rows();
		if($done>0){
			return true;	
		}
		return false;
	}
	private function parseUser($array=false)
	{
		$qSet="";
		foreach($this->qRows as $row)
		{	
			if(!$array){
				$content=mysql_real_escape_string(strip_tags($this->$row));
			}else{
				$content=mysql_real_escape_string(strip_tags($array[$row]));
			}
			
			if($content=='' && ($array && $row!='uid') || !isset($content)){
				return false;
			}
			$qSet.=$row."='".$content."',";
		}
		$qSet=substr($qSet,0,-1);
		return $qSet;
	}
	
	public function saveUser()
	{
		$qSet=$this->parseUser();
		
		$query="UPDATE users SET ".$qSet." WHERE uid='".$this->uid."'";
		$result=mysql_query($query,$GLOBALS['db']);
	}
}}


?>
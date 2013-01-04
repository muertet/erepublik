<?php 
if (!class_exists("Message")) {
class Message
{
	public $id;
	private $qRows=array('id','title','text','timestamp','sender','reciever','last_sender','status');
	
	
	function __construct($id=false)
	{
		if($id){
			$this->id=(int)$id;
		}
	}
	
	public static function infoMessage($id)
	{
		$id=(int)$id;
		$query="SELECT * FROM messages WHERE id='".$id."' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)<1){ return false;}
		
		return mysql_fetch_array($result);
	}
	
	public function newMessage($array)
	{
		$arr=array(
			'id'=>'',
			'status'=>0,
			'timestamp'=>time(),
			'sender'=>$_SESSION['login']['uid'],
			'last_sender'=>$_SESSION['login']['uid']
		);
		$array=array_merge($array,$arr);
		$qSet=parseQuery($array);
		if(!$qSet){die('E1');return false;}
		
		$query="INSERT INTO messages SET ".$qSet;
		echo $query;
		$result=mysql_query($query,$GLOBALS['db']) or die(mysql_error());
		$done=mysql_affected_rows();
		if($done>0){
			$array['id']=mysql_insert_id($GLOBALS['db']);
			return $array;	
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
	
	public function saveMessage()
	{
		$qSet=$this->parseUser();
		
		$query="UPDATE users SET ".$qSet." WHERE uid='".$this->uid."'";
		$result=mysql_query($query,$GLOBALS['db']);
	}
}}


?>
<?php 
if (!class_exists("Message")) {
class Message
{
	public $id;
	public $title;
	public $text;
	public $timestamp;
	public $sender;
	public $reciever;
	public $last_sender;
	public $status;
	public $qRows=array('id','parent','title','text','timestamp','sender','reciever','last_sender','status');
	
	
	function __construct($id=false)
	{
		if($id){
			$this->id=(int)$id;
		}
	}
	
	public static function infoMessage($id,$parents=true)
	{
		$id=(int)$id;
		$message=array();
		$recievers=array();
		
		$query="SELECT * FROM messages WHERE id='".$id."' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)<1){ return false;}
		$myArray=mysql_fetch_array($result);
		
		$uidRecievers=explode(',',$myArray['reciever']);
		if(sizeof($uidRecievers)>1){
			foreach($uidRecievers as $reciever){
				$user=User::infoUser($reciever);
				$recievers[]=array(
								"uid"=>$reciever,
								"nick"=>$user['nick'],
							);
			}
		}else{
			$user=User::infoUser($reciever);
			$recievers=array(
								"uid"=>$reciever,
								"nick"=>$user['nick'],
							);
		}
		$myArray['reciever']=$recievers;
		$user=User::infoUser($myArray['sender']);
		$myArray['sender']=array(
								"uid"=>$user['uid'],
								"nick"=>$user['nick'],
							);
		
		$message=$myArray;
		if($parents){
			$query="SELECT id FROM messages WHERE parent='".$id."' ";
			$result=mysql_query($query,$GLOBALS['db_slave']);
			if(mysql_num_rows($result)>0){ 
				while($myArray=mysql_fetch_array($result)){
					$message['replies'][]=self::infoMessage($myArray['id'],false);
				}
			}
		}
		
		
		return $message;
	}
	
	public static function myMessages()
	{
		$myMessages=array();
		$query="SELECT id FROM messages WHERE parent IS NULL AND sender='".$_SESSION['login']['uid']."' OR reciever='".$_SESSION['login']['uid']."' OR reciever LIKE '%,".$_SESSION['login']['uid']."%' ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
		if(mysql_num_rows($result)>0){ 
			while($myArray=mysql_fetch_array($result)){
				$myMessages[]=self::infoMessage($myArray['id'],false);
			}
		}
		return $myMessages;
	}
	
	public function replyMessage($text)
	{
	
		$query="INSERT INTO messages SET parent='".$this->id."',text= ";
		$result=mysql_query($query,$GLOBALS['db_slave']);
	}

	
	public function newMessage($array)
	{
		$arr=array(
			'id'=>'',
			'parent'=>null,
			'status'=>0,
			'timestamp'=>time(),
			'sender'=>$_SESSION['login']['uid'],
			'last_sender'=>$_SESSION['login']['uid']
		);
		$array=array_merge($array,$arr);
		$qSet=parseQuery($this,$array);
		if(!$qSet){die('E1');return false;}
		
		$query="INSERT INTO messages SET ".$qSet;
		$result=mysql_query($query,$GLOBALS['db']);
		$done=mysql_affected_rows();
		if($done>0){
			return $this->infoMessage(mysql_insert_id($GLOBALS['db']));	
		}
		return false;
	}
	
}}


?>
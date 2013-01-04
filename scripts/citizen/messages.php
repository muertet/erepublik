<?php
include_once('../../includes/config.php');

// New/Send message
if($_GET['new'])
{
	if($_POST['citizen_message']!='' && $_POST['citizen_name']!='' && $_POST['citizen_subject']!='')
	{
		$arr=array(
			'title'=>$_POST['citizen_subject'],
			'text'=>$_POST['citizen_message'],
			'reciever'=>$_POST['citizen_name'],
			);
		$message=new Message();
		$response=$message->newMessage($arr);
		
		//*********** TEMPLATE **********//
		$array_templates=array();
		$array_templates['nick']=$_SESSION["login"]['nick'];
		$array_templates['title']=$response['title'];
		$array_templates['message']=$response['text'];
		$array_templates['id']=$response['id'];

		// Volquem les dades
		volcar_template('citizen/message_sent',$array_templates,$toinclude);
		die();
	}elseif($_POST['citizen_message']!='' && $_POST['thread_id']!=''){
		$message=new Message($id);
		$response=$message->reply($_POST['citizen_message']);
		die($response);
	}else{
	
	
	
		//*********** TEMPLATE **********//
		$array_templates=array();
		$array_templates['nick']=$_SESSION["login"]['nick'];

		// Volquem les dades
		volcar_template('citizen/message_new',$array_templates,$toinclude);
		die();
	}
}


$message=Message::myMessages();
//*********** TEMPLATE **********//
$array_templates=array();
$array_templates['myMessages']=$message;

// Volquem les dades
volcar_template('citizen/messages',$array_templates,$toinclude);
?>
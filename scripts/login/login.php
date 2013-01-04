<?php
	include_once("../../includes/config.php");

	//Fem el login de l'usuari
	$error_login=true;
	$e='2';

	if( (isset($_POST["citizen_email"])) && (isset($_POST["citizen_password"])) )
	{
		$login = trim(mysql_real_escape_string($_POST["citizen_email"]));
		$pass = trim(mysql_real_escape_string($_POST["citizen_password"]));
		
		if( ($login!='')&&($pass!='') )
		{
			$pass=encripta($pass);
			$sql_query="SELECT * FROM users WHERE (nick='$login' AND pass='$pass') OR (email='$login' AND pass='$pass')";

			$result=mysql_query($sql_query,$GLOBALS['db_slave']);
			if(mysql_num_rows($result)==1)
			{
				$myArray=mysql_fetch_array($result);
				
				//Expulsat o no
				if($myArray["status"]=='1' || $myArray["status"]=='2')
				{	
					//Usuari correcte!
					$error_login=false;
					
					$_SESSION["login"]=$myArray;
					
					$uid=$myArray["uid"];
					

					//Posem la cookie de id_usuari i contrasenya_usuari durant un any
					setcookie("chk", $pass, time()+86400*365,"/");
					setcookie("chk2", $_SESSION['login']['nick'],time()+86400*365,"/");
					setcookie("sess", md5($_SESSION['login']['uid']),time()+86400*365,"/");
				}
				else
				{
					$e='3';
				}
			}else{
				$e='2';
				
			}
		}
		
	}else{
		die('0');
	}
	
	/*if(!$error_login)
	{
		
		//nothing to do here
       
	}*/
	
	if($error_login) die($e);	
	else header('Location: /');

?>
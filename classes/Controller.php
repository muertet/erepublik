<?php
/**
* Basic controller used to start the controllers
*/
class Controller
{
	public $db=null;
	public function __construct()
	{	
		global $mySQLI;
		
		$this->db=$mySQLI;
	}
	
	/**
	* Starts the given controller
	* @param string $cClass class name
	* @param string $method method name
	* @param array $args method arguments
	* 
	* @return
	*/
	public static function start($cClass,$method,$args){
		$class=new $cClass();
		$class->$method($args);
	}
}
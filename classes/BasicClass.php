<?php

class BasicClass
{
	public $db = null;
	private $unsetAttributes = array(
		'db',
		'table',
		'attributes'
	);
	
	public function __construct()
	{
		if (!isset($this->table)) {
			$this->table = strtolower(get_class($this));
		}

	}
	
	/**
	* Gets object from database
	* @param integer $id 
	* @param boolean $rawResult
	* @return object
	*/
	public function get($id, $rawResult = false)
	{
		$id=(int)$id;
		$q = "select * from `".$this->table."` where `id`='".$id."' LIMIT 1";
		$list=Service::getDB()->query($q);
		
		if(sizeof($list)==0){
			return false;
		}
		
		$row=$list[0];
		
		if($rawResult){
			return $row;
		}else{
			
			foreach($this->attributes as $attr)
			{
				$k=$attr[0];
				$this->$k=$row[$k];		
			}
			
			return $this;	
		}
	}
	
	/**
	* Converts class object to array
	* @param integer $id
	* 
	* @return array
	*/
	public function getRaw($id=null){
		
		if($id!=null){
			return $this->get($id,true);
		}else{
			$data=array();
			
			foreach($this->attributes as $attr)
			{
				$k=$attr[0];
				
				$data[$k]=$this->$k;
			}
			
			return $data;
		}
	}
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $resultList
	*/
	public function find($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$thisObjectName = get_class($this);
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$q = "select * from `".$this->table."` ";
		
		$resultList = array();
		if (sizeof($fcv_array) > 0)
		{
			$q .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1){
					$q .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1){
						$q .= " AND ";
					}
					
					$q .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";					
				}
			}
		}
		if ($sortBy != '')
		{			
			$sortBy = "$sortBy ";
			$q .= " order by ".$sortBy." ".($ascending ? "asc" : "desc");
		}
		$q .= $sqlLimit;
		
		$list=Service::getDB()->query($q);
		
		foreach($list as $row)
		{
			$user = new $thisObjectName();
			
			foreach($this->attributes as $attr)
			{
				$k=$attr[0];
				$user->$k=$row[$k];		
			}
			$resultList[] = $user;
		}
		return $resultList;
	}
	
	public function getList(){
		return $this->find();
	}
	
	public function filterAttributes($object)
	{
		foreach($this->unsetAttributes as $attr){
			unset($object->$attr);
		}
		return $object;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id
	* @param boolean $rawResult
	*/
	function save()
	{
		$rows = array();
		$dataToSave=array();
		
		if ($this->id!=''){
			$q = "select `id` from `".$this->table."` where `id`='".$this->id."' LIMIT 1";
			$rows = Service::getDB()->query($q);
		}
		
		foreach($this->attributes as $attr)
		{
			$k=$attr[0];
			$dataToSave[$k]=$this->$k;
		}
		
		if (sizeof($rows)!==0)
		{
			Service::getDB()->where('id',$this->id);
			$insertId=Service::getDB()->update($this->table,$dataToSave);
		}else{
			$insertId=Service::getDB()->insert($this->table,$dataToSave);
		}
		
		if ($this->id == "")
		{
			$this->id = $insertId;
		}
		return $this->id;
	}
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id
	*/
	function saveNew()
	{
		$this->id = '';
		$this->date=$this->now();
		
		return $this->save();
	}
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function delete()
	{
		Service::getDB()->where('id',$this->id);
		return Service::getDB()->delete($this->table,1);
	}
	
	/**
	* Gets current time in mySQL datetime format
	* @return string
	*/
	public function now(){
		return date('Y-m-d H:i:s');
	}
}

<?php

class cProduct extends Controller
{
	public function get()
	{
		$id=(int)$_GET['id'];
		
		if($id<1){
			throw new Exception('Missing/invalid data');
		}
		
		$class=new Product();
		
		$where=array(
			array('id','=',$id)
		);
		
		$result=$class->find($where);
		
		if($result){
			return $result[0];
		}else{
			return false;
		}
    }
	
	public function getList()
	{	
		$class=new Product();
		
		return $class->find();
    }
}
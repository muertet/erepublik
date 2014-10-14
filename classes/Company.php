<?php

class Company extends BasicClass
{	
	public $attributes=array
	(
		array('id','integer'),
		array('uid','integer'),
		array('name','string'),
		array('product','integer'),
		array('productType','integer'),
		array('quality','integer'),
		array('maxEmployees','integer'),
		array('pendingUnits','float'),
		array('money','float'),
		array('region','integer'),
		array('date','datetime'),
	);
	
	const CREATION_COST=20;
	const PRODUCT_TYPE_RESOURCE=1;
	const PRODUCT_TYPE_PRODUCT=2;
	const RECEIVER_TYPE_USER=1;
	const RECEIVER_TYPE_COMPANY=2;
	const MIN_EMPLOYEES=5;
	
	public function __construct($array=null)
	{
		parent::__construct();
		
		if($array!=null){
			foreach($array as $row=>$v){
				$this->$row=$v;
			}
		}		
	}
	
	/**
	* Creates a transaction including history entry registry
	* 
	* @param array $data
	* @return boolean if done
	*/
	public function transaction($data)
	{
		if($data['receiverType']==Company::RECEIVER_TYPE_USER){
			$user=new User();
			$user->get($data['receiver']);
			
			$transactionMade=$user->updateCurrency($user->currency,$data['quantity']);
		}else{
			
		}
		
		if($transactionMade){
			$data['id']='';
			$data['date']=$this->now();
			
			Service::getDB()->insert('company_transaction',$data);
			
			$this->money-=$data['quantity'];
			$this->save();
		}
		
		return $transactionMade;
	}
	
	/**
	* Adds stock items to the company
	* @param integer $quantity amount of stock to be added
	* @param integer $type can be RESOURCE or PRODUCT
	* 
	* @return boolean if added
	*/
	public function addStock($quantity,$type)
	{
        $db = Service::getDB();
		$where=array(
			'company'=>$this->id,
			'product'=>$this->product,
			'productType'=>$type,
		);
		
		if($type==Company::PRODUCT_TYPE_PRODUCT)
		{
			$condition="AND quality='".$this->quality."' ";
			
			$where['quality']=$this->quality;
		}else{
			$condition="";
			
			$where['quality']=0;
		}
		$r = $db->query("SELECT quantity FROM company_stock WHERE company='".$this->id."' AND product='".$this->product."' AND productType='".$type."' ".$condition);
		
		if(sizeof($r)==0){
			$stock=$quantity;
			
			$where['quantity']=$stock;
			
			return $db>insert('company_stock',$where);
		}else{
			$stock=$r[0]['quantity']+$quantity;
			$data=array('quantity'=>$stock);

            $db->where($where);
			
			return $db->update('company_stock',$data);
		}
	}
	
	public function saveNew()
	{
		$this->id='';
		$this->quality=1;
		$this->pendingUnits=0;
		$this->money=0;
		$this->maxEmployees=self::MIN_EMPLOYEES;
			
		$user=new User();
		$user=$user->get($this->uid);
		
		if(!$user){
			throw new Exception('user not found');
		}
		
		if($user->gold<self::CREATION_COST){
			throw new Exception('no gold enough');
		}
		
		$id=parent::saveNew();
		
		if($id){
			$user->gold-=self::CREATION_COST;
			$user->save();
		}
		return $id;
	}
	
}
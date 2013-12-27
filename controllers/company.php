<?php

class cCompany extends Controller
{
	public function get()
	{
		$id=(int)$_REQUEST['id'];
		
		if($id==0){
			throw new Exception('missing data');
		}
		
		$companyClass=new Company();
		
		$company=$companyClass->get($id);
		return $this->parse($company);
	}
	
	/**
	* Extend company object information
	* @param object $company
	* 
	* @return array
	*/
	public function parse($company)
	{
		$raw=$company->getRaw();
		
		// get owner
		$user=new User();
		$user=$user->get($company->uid);
		
		$raw['owner']=array(
			'id'=>$user->id,	
			'nick'=>$user->nick,
		);
		
		//get region
		$region=new Region();
		$region=$region->get($company->region);
		
		$raw['region']=array(
			'id'=>$region->id,	
			'name'=>$region->name,
		);
		
		//get country
		$country=new Country();
		$country=$country->get($region->country);
		
		$raw['country']=array(
			'id'=>$country->id,	
			'name'=>$country->name,
		);
		
		//get product
		if($company->productType==$company::PRODUCT_TYPE_PRODUCT){
			$product=new Product();
		}else{
			$product=new Resource();
		}
		$product=$product->get($company->product);
		
		$raw['product']=array(
			'id'=>$product->id,	
			'name'=>$product->name,
		);
		
		return $raw;
	}
	public function create()
	{
		$data=array(
			'name'=>$_POST['name'],
			'uid'=>$this->user->id,
			'product'=>(int)$_POST['product'],
			'productType'=>(int)$_POST['productType'],
			'region'=>$this->user->region,
		);
		
		if(empty($data['name']) || empty($data['product']) || empty($data['productType'])){
			throw new Exception('missing info');
		}
		
		$company=new Company($data);
		$id=$company->saveNew();
		
		if($id){
			$data['id']=$id;
		
			return $data;	
		}else{
			return false;
		}
    }
	
	public function getList()
	{
		if(!empty($_REQUEST['uid']))
		{
			$uid=(int)$_REQUEST['uid'];
			
			$where=array(
				array('uid','=',$uid)
			);
			
			$companyClass=new Company();
			$companyList=$companyClass->find($where);
			
			foreach($companyList as $k=>$company)
			{
				$companyList[$k]=$this->parse($company);
			}
			
			return $companyList;
		}	
	}
	
}
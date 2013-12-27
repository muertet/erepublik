<?php

class cJobMarket extends Controller
{
	public function offers()
	{
		$country=(int)$_POST['country'];
		$skill=(int)$_POST['skill'];
		$company=(int)$_POST['company'];
		$list=array();
		$where=array();
		
		if($country<1 && $company<1){
			throw new Exception('Missing/invalid info');
		}
		
		$market=new JobMarket();
		
		if($country>0){
			$where[]=array('country','=',$country);
		}else if($company>0){
			$where[]=array('company','=',$company);
		}
		
		if($skill>0){
			$where[]=array('skill','=',$skill);
		}
		
		$results=$market->find($where);
		
		// rich results
		foreach($results as $offer)
		{
			$raw=$offer->getRaw();
			
			
			
			//get company
			$company=new Company();
			$company=$company->get($offer->company);
			
			$raw['company']=array(
				'id'=>$company->id,	
				'name'=>$company->name,
			);
			
			// get owner
			$user=new User();
			$user=$user->get($company->uid);
			
			$raw['owner']=array(
				'id'=>$user->id,	
				'name'=>$user->nick,
			);
			
			//get country
			$country=new Country();
			$country=$country->get($offer->country);
			
			$raw['country']=array(
				'id'=>$country->id,	
				'name'=>$country->name,
				'currency'=>$country->currency,
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
				'quality'=>$company->quality,
			);
			$list[]=$raw;
		}
		
		return $list;
    }
	
	public function apply()
	{
		$id=(int)$_POST['id'];
		
		//find the offer
		$market=new JobMarket();
		$offer=$market->get($id);
		
		if(empty($offer)){
			throw new Exception('offer not found');
		}
		
		//check if matches the requirements
		$skill=new Skill();
		$skill=$skill->get($this->user->id);
		
		if($skill->economic<$offer->skill){
			throw new Exception("you don't meet the requirements");
		}
		
		//give him the job
		$data=array(
			'uid'=>$this->user->id,
			'company'=>$offer->company,
			'salary'=>$offer->salary,
		);
		
		$job=new Job($data);
		$saved=$job->save();
		
		// update the offer
		if(!empty($saved))
		{
			$offer->quantity--;
			
			if($offer->quantity==0){
				$offer->delete();
			}else{
				$offer->save();
			}
			return true;
		}else{
			return false;
		}
	}
	
	public function create()
	{
		$data=array(
			'company'=>(int)$_POST['company'],
			'skill'=>(int)$_POST['skill'],
			'uid'=>$this->user->id,
			'quantity'=>(int)$_POST['quantity'],
			'salary'=>number_format((float)$_POST['salary'], 2, '.', ''),
		);
		
		if($data['company']<1 || $data['skill']<1 || $data['salary']<1 || $data['quantity']<1 ){
			throw new Exception('missing info');
		}
		
		//check if is the company owner
		$company=new Company();
		$company=$company->get($data['company']);
		
		if($company->uid!=$this->user->id){
			throw new Exception("you are not the owner");
		}
		
		$market=new JobMarket($data);
		return $market->saveNew();
	}
}
<?php

class cJob extends Controller
{	
	public function work()
	{
		$job=new Job();
		$job->getByUid($this->user->id);
		
		if($job->hasWorked()){
			throw new Exception('you have already worked');
		}
		
		$company=new Company();
		$company->get($job->company);
		
		//check if is in the same region
		if($this->user->region!=$company->region){
			throw new Exception("You are not in the same region as company");
		}
		
		//check if company has funds enough
		if($company->money<$job->salary){
			throw new Exception("The company doesn't have funds enough");
		}
		
		$worked=$job->work();
		
		//add extra data before return
		if($worked){
			$data=$this->parse($job);
			$data=array_merge($data,$worked);
			return $data;
		}else{
			return false;
		}
	}
	public function get()
	{
		$uid=(int)$_REQUEST['uid'];
		
		if($uid==0){
			$uid=$this->user->id;
		}
		
		$where=array(
			array('uid','=',$uid),
		);
		
		$userClass=new Job();		
		$results=$userClass->find($where);
		
		if(sizeof($results)==0){
			return false;
		}
		
		$data=$this->parse($results[0]);
		
		return $data;
	}
	
	public function parse($obj)
	{
		$raw=$obj->getRaw();
		
		$cCompany=new cCompany();
		$company=new Company();
		$company=$company->get($obj->company);
		
		$raw['company']=$cCompany->parse($company);
		$raw['hasWorked']=$obj->hasWorked();
		
		return $raw;
	}
}
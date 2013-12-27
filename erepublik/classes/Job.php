<?php

class Job extends BasicClass
{
	public $attributes=array
	(
		array('id','integer'),
		array('uid','integer'),
		array('company','integer'),
		array('salary','float'),
		array('date','datetime'),
	);
	
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
	* Generates units from user work and pays his salary
	* 
	* @return mixed (boolean/array)
	*/
	public function work()
	{
		/*
		http://wiki.e-sim.org/index.php/Productivity_formula
		* P = 10 * (4+E) * N * C * R * Q   
		P - Productivity
		E - Economy skill level
		N - Employee multiplier (Number of employees already worked that day in the company.)
			if employeesWorked <=10 Then N = 1.0 + (10-employeesWorked) * 0.05
			elseif employeesWorked <=20 Then N = 1.0 - (employeesWorked-10) * 0.03
			elseif employeesWorked <=30 Then N = 0.7 - (employeesWorked-20) * 0.02
			else N=0.5;
		C
			1 If home country controls capital
			0.75 If not
		R
			for manufacture companies:
				1.25 If region's country owns the appropriate high raw. (eg: Iron for Weapons)
				1 If region's country do not own the appropriate high raw.
			for raw companies:
				1.0 in high regions
				0.75 in medium region.
		Q
			1.0 for manufacture companies
			for raw companies
				1.0 for Q1 companies
				1.2 for Q2 companies
				1.4 for Q3 companies
				1.6 for Q4 companies
				1.8 for Q5 companies
		* 
		*/
		
		$job=new Job();
		$job=$job->getByUid($this->uid);
		
		if(!$job){
			throw new Exception("you don't have a job");
		}
		
		$skills=new Skill();
		$skills->get($this->uid);
		
		$E=$skills->economic;
		
		$employeesWorked=1;//ToDO PENDING
		
		if ($employeesWorked <=10 ){
			$N = 1.0 + (10-$employeesWorked) * 0.05;
		} elseif( $employeesWorked <=20 ){
			$N = 1.0 - ($employeesWorked-10) * 0.03;
		} elseif( $employeesWorked <=30 ){
			$N = 0.7 - ($employeesWorked-20) * 0.02;
		}else{
			$N=0.5;
		}
		
		
		$company=new Company();
		$company->get($job->company);
		
		$region=new Region();
		$companyRegion=$region->get($company->region);
		
		//does the region have the resource that company produces?
		// also determine product quality
		if($company->productType==Company::PRODUCT_TYPE_RESOURCE)
		{
			$R=$companyRegion->resourceAmount/10;
			
			$Q=1;
		}else{
			
			$product=new Product();
			$product->get($company->product);
			
			if($companyRegion->resourceType==$product->resource){
				$R=1.25;
			}else{
				$R=1;
			}
			
			$Q=0.8+(0.2*$company->quality);
		}
		
		$country=new Country();
		$country=$country->get($companyRegion->country);
		
		$capitalRegion=$region->get($country->capitalRegionId);
		
		//is country capital owned by original owners?
		if($capitalRegion->country==$capitalRegion->countryConqueror){
			$C=1;
		}else{
			$C=0.75;
		}
		
		if($companyRegion->resourceAmount>0){
			$productivity=10 * (4+$E) * $N * $C * $R * $Q;
		}else{
			$productivity=10 * (4+$E) * $N * $C * $Q;
		}
		
		$user=new User($this->uid);
		$user->updateXP('WORK');
		
		$skills->economic+=0.125;
		$skills->save();
		
		$company->pendingUnits+=$productivity;
		
		//calculate produced units
		if($company->productType==Company::PRODUCT_TYPE_RESOURCE)
		{
			$createdUnits=floor($company->pendingUnits);
			
			$company->pendingUnits-=$createdUnits;
				
			$added=$company->addStock($createdUnits,Company::PRODUCT_TYPE_PRODUCT);
			
			if($added){
				$company->save();
			}
		
		}else{
			$minProduct=$product->productivityBase*$company->quality;
			$createdUnits=floor($company->pendingUnits/$minProduct);
			
			if($company->pendingUnits>$minProduct);
			{
				$company->pendingUnits-=$createdUnits*$minProduct;
				
				$added=$company->addStock($createdUnits,Company::PRODUCT_TYPE_PRODUCT);
				
				if($added){
					$company->save();
				}
			}
		}
		
		//pay salary
		$transactionData=array(
			'quantity'=>$job->salary,
			'action'=>'PAY_SALARY',
			'receiver'=>$this->uid,
			'receiverType'=>Company::RECEIVER_TYPE_USER,
		);
		
		if($company->transaction($transactionData))
		{
			//save historial
			$this->db->insert('work_historial',array(
				'uid'=>$this->uid,
				'date'=>$this->now(),
			));
			
			return array('productivity'=>$productivity,'createdUnits'=>$createdUnits);
		}else{
			return false;
		}
	}
	
	/**
	* Gets user job
	* @param integer $id user id
	* @param boolean $rawResult if wants array or object return
	* 
	* @return mixed (array/object/boolean)
	*/
	public function getByUid($id,$rawResult=false)
	{
		$id=(int)$id;
		$q = "select * from `".$this->table."` where `uid`='".$id."' LIMIT 1";
		$list=$this->db->query($q);
		
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
	* Checks if user already worked today
	* 
	* @return boolean
	*/
	public function hasWorked()
	{
		$yesterday=strtotime('-1 day');
	
		$result=$this->db->query("SELECT uid FROM work_historial WHERE uid='".$this->uid."' AND date>'".$yesterday."' ");
		
		if(sizeof($result)>0){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	* Saves a new job
	* 
	* @return mixed
	*/
	public function save()
	{
		$this->date=$this->now();
		
		$dataToSave=array();
	
		$q = "select `id` from `".$this->table."` where `uid`='".$this->uid."'  LIMIT 1";
		$rows = $this->db->query($q);
		
		foreach($this->attributes as $attr)
		{
			$k=$attr[0];
			$dataToSave[$k]=$this->$k;
		}
		
		if (sizeof($rows)>0)
		{
			$this->db->where('uid',$this->uid);
			$insertId=$this->db->update($this->table,$dataToSave);
		}else{
			$insertId=$this->db->insert($this->table,$dataToSave);
		}
		
		if ($this->id == "")
		{
			$this->id = $insertId;
		}
		return $this->id;		
	}
}
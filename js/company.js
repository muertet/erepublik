var Company=
{
	products:[],
	resources:[],
	CREATION_COST:20,
	
	work:function()
	{
		Site.api('job/work',function(data)
		{
			if(!data){
				alert('server busy');
				return false;
			}
			
			Site.parseTemplate('company/work.html',{job:data},function(html){
				Site.html({html:html,title:"Work"});
			});	
		});
	},
	myCompanies:function()
	{
		var callback=function()
		{
			Site.parseTemplate('company/myCompanies.html',{products:Company.products,resources:Company.resources,region:User.info.region,companies:User.companies,goldCost:Company.CREATION_COST},function(html){
				Site.html({html:html,title:"My Companies"});
			});
		};
		
		if(User.companies===undefined){
			Site.api('company/list',{uid:User.info.id},function(data){	
				User.companies=data;
				
				callback();
			});	
		}else{
			callback();
		}
	},
	profile:function(id)
	{
		// try to get it from cache
		var company=Company.cache(id),
			callback=function(company){
				
				Site.parseTemplate('company/company.html',{company:company},function(html){
					Site.html({html:html,title:company.name});
				});	
			};
		
		if(!company)
		{
			Site.api('company/get',{id:id},function(company){
				Company.setCache(id,company);
				callback(company);
			})
		}else{
			callback(company);
		}
	},
	setCache:function(id,game)
	{
		//no cache during development
		return true;
	},
	cache:function(id)
	{
		var key='company-'+id,
			content=localStorage.getItem(key);
			
		if(content===undefined || content==null){
			return false;
		}
		
		return jQuery.parseJSON(content);
	}
};
var User={
	info:{},
	
	train:function()
	{
		Site.api('user/train',function(data)
		{
			if(!data){
				alert('server busy');
				return false;
			}
			User.hasTrained=true;
			
			Site.parseTemplate('user/train.html',{hasTrained:User.hasTrained,train:data},function(html){
				Site.html({html:html,title:"Train"});
			});	
		});
	},
	isLogged:function(){
		return User.logged;
	}
}

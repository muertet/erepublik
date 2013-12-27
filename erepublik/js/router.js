crossroads.addRoute('/work.htm', function()
{		
	Site.api('job/get',{uid:User.info.id},function(data)
	{
		Site.parseTemplate('company/work.html',{job:data},function(html){
			Site.html({html:html,title:"Work"});
			
			$('#workForm').on('submit',function(){
				Company.work();
				return false;
			});
		});	
	});
});
crossroads.addRoute('/train.htm', function()
{
	var callback=function(){
		Site.parseTemplate('user/train.html',{hasTrained:User.hasTrained,train:false},function(html){
			Site.html({html:html,title:"Train"});
			
			$('#trainForm').on('submit',function(){
				User.train();
				return false;
			});
		});		
	};
	if(User.hasTrained===undefined)
	{
		Site.api('user/hastrained',function(data)
		{
			User.hasTrained=data;
			callback();
		});
	}else{
		callback();
	}
});
crossroads.addRoute('/jobMarket.htm', function(){
	Market.job();
});
crossroads.addRoute('/companies.htm', function(){
    Company.myCompanies();
});
crossroads.addRoute('/company.htm?id={id}', function(id){
    Company.profile(id);
});
crossroads.addRoute('/user/{id}/{useless}/{status}.htm', function(id,status){
    User.profile(id,status);
});

function loadPage(){
	var currentRoute=window.location.href.replace($('base').attr('href'),'/');
	if(currentRoute!=''){
		crossroads.parse(currentRoute);
	}
}
loadPage();

window.onpopstate = function () {
    loadPage();
};

$(document).ready(function()
{
	$(document).on('click','a',function(event)
	{
		var href=$(this).attr('href');
		
		if(href.indexOf('http')==-1 && href.indexOf('#')==-1)
		{
			event.preventDefault();
		
			history.pushState('test',{},href);
			console.log('parsing',href);
			
			if(href.substring(0, 1) != '/'){
				href='/'+href;
			}
			crossroads.parse(href);
		}
	});
});
var Site=
{
	authToken:'',
	userToken:'',
	baseUrl:'api/',
	title:'',
	api:function(url,obj,callback)
	{
		Site.loading(true);
		var queryUrl=Site.baseUrl+url+'?authtoken='+Site.authToken+'&usertoken='+Site.userToken;
		
		if(typeof obj =='function')
		{
			callback=obj;
			
			$.get(queryUrl,function(data)
			{
				
				if(Site.checkErrors(data))
				{
					try {
				        data.data=JSON.parse(data.data);
						callback(data.data);
				    } catch (e) {
				        callback(data.data);
				    }
				}
				
				Site.loading();							
			});
		}
		else
		{
			if(url=='db/search')
			{
				var results=sessionStorage.getItem('search-'+obj.query);
				
				if(results)
				{
					data=jQuery.parseJSON(results);
				
					if(Site.checkErrors(data))
					{
						try {
					        data.data=JSON.parse(data.data);					
							callback(data.data);
					    } catch (e) {
					        callback(data.data);
					    }
					}
					Site.loading();
					return true;
				}
			}
			$.post(queryUrl,obj,function(data)
			{								
				if(Site.checkErrors(data))
				{
					if(url=='db/search' && data.data!='{}'){
						sessionStorage.setItem('search-'+obj.query,JSON.stringify(data));
					}
				
					try {
				        data.data=JSON.parse(data.data);					
						callback(data.data);
				    } catch (e) {
				        callback(data.data);
				    }
				}
				Site.loading();
			});	
		}
		
	},
	checkErrors:function(data)
	{
		if(data.status==1){
			return true;
		}
		
		switch(data.data)
		{
			case 'Must be logged':
				alert('Please login!');
			break;
		}
		return false;	
	},
	loading:function(status){
		if(typeof status =='undefined'){
			status=false;
		}
		if(status){
			$('#loadingDiv').show();
		}else{
			$('#loadingDiv').hide();
		}
	},
	parseTemplate:function(f,data,callback)
	{
		var html='',
			result;
		
		if(typeof f =='string')
		{
			var templateName=f.replace(/\//,'-').replace('.html','')+'-template';
			
			if(callback===undefined){
				throw "parseTemplate error: No callback set";
				return false;
			}
			
			if($('#'+templateName).length==0)
			{
				$.ajax({
				  url: 'templates/'+f,
				  dataType: "script",
				  error: function(a)
				  {
				  	if(a.status!=200){
						throw 'Template '+f+' not found';
						return false;
					}
				
				  	$('body').append('<script type="text/system-template" id="'+templateName+'">'+a.responseText+'</script>');
					Site.parseTemplate(f,data,callback);
					return true;
				}});
				return false;
			}else{
				html=$('#'+templateName).html().replace(/^[^\/]+\/\*!?/, '').replace(/\*\/[^\/]+$/, '');
			}
			
		}else{
			html=f.toString().replace(/^[^\/]+\/\*!?/, '').replace(/\*\/[^\/]+$/, '');
		}
		
		if(typeof data !='undefined')
		{	
			result=_tmpl(html,data);
			
			if(callback===undefined){
				return result;
			}else{
				callback(result);
			}
		}else{
			if(callback===undefined){
				return html;
			}else{
				callback(html);
			}
		}
	},
	html:function(obj)
	{
		if(typeof obj.title !='undefined'){
			$('title').html(obj.title+' - '+Site.title);
		}		
		
		$('#content').html(obj.html);
		Site.loading();
	},
	T:function(text){
		return text;
	},
	friendlyUrl:function(str,max) 
	{
		if (max === undefined) max = 32;
		var a_chars = new Array(
			new Array("a",/[áàâãªÁÀÂÃ]/g),
			new Array("e",/[éèêÉÈÊ]/g),
			new Array("i",/[íìîÍÌÎ]/g),
			new Array("o",/[òóôõºÓÒÔÕ]/g),
			new Array("u",/[úùûÚÙÛ]/g),
			new Array("c",/[çÇ]/g),
			new Array("n",/[Ññ]/g)
		);
		// Replace vowel with accent without them
		for(var i=0;i<a_chars.length;i++)
		str = str.replace(a_chars[i][1],a_chars[i][0]);
		// first replace whitespace by -, second remove repeated - by just one, third turn in low case the chars,
		// fourth delete all chars which are not between a-z or 0-9, fifth trim the string and
		// the last step truncate the string to 32 chars 
		return str.replace(/\s+/g,'-').toLowerCase().replace(/[^a-z0-9\-]/g, '').replace(/\-{2,}/g,'-').replace(/(^\s*)|(\s*$)/g, '').substr(0,max);
	}
};

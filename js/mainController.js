var _DEBUG=false;

var mainController = 
{
    clickHandler: function (event) 
	{
		var url=$j(event.target).attr('href');
		
		if(url==null || url=='' || url.indexOf('javascript')!=-1){ return false;}//no es pa mi
		if(_DEBUG){console.log('Triggering url: '+url);}
	 	mainController.loadPosition(url);
		return event.preventDefault();
    },
	loadPosition: function(url)
	{
		if(typeof lastUrl=='undefined'){
			lastUrl=url;return false;
		}
		var pushState=true,
			obj={};
	
		if(typeof url =='object'){ 	//Recuperem dhistorial o carreguem?	
			var urlPart=url.urlPart;
			url=urlPart.join('/');
			pushState=false;
		}else{
			url=url.substr(1);
			var urlPart = url.split('/'),
				urlParts= urlPart.length;
		}		
		obj.urlPart=urlPart;//abans de borrar dades

		if(_DEBUG){console.log(urlPart);}
		
		mainController.adsReloaded++; //Anem refrescant els ads cada cert temps
		if(mainController.adsReloaded>5){mainController.adReloader();}
		
		
		
		//si ho es la carreguem
		if(typeof url!='undefined' && url!=''){
			console.log('Loading: '+url);
			mainController.preLoad(true);
			$j.get('/'+url,function(data){
				
				//$j('#content').html($j(data).find("img").attr('onerror','imgCrawler(this)').parent());
				$j('#content').html(data);
				mainController.preLoad(false);
			});
		}
		switch(urlPart[0]){
			case'kill':
				$j('#content').html('kill');
			break;
			case'kill2':
				$j('#content').html('kill2');
			break;
			
		}
		if(pushState && url!=''){
			history.pushState(obj, 'historial','/'+url);
		}
		return true;
	},
	init:function()
	{
		/* HANDLERS*/
		$j("a").live("click",mainController.clickHandler);
		$j('div .controllerUrl').live("click",mainController.clickHandler); //per si de cas
		setInterval(mainController.adReloader,1000*60*5);
		mainController.setFriendlyUrls();
		
	
		window.onpopstate = function(e) {
		    if(e.state !== null) {
				if(_DEBUG){console.log(e);}
		       mainController.loadPosition(e.state);
			   return e.preventDefault();
		    }
		}

		
		/* INIT */
		var url=window.location.href;
		url=url.replace(document.location.hostname+'/','');
		url=url.replace('http://','');
		mainController.loadPosition(url);
	},
	adsReloaded: 0,
	adReloader:function()
	{
		if(mainController.adsReloaded==0){return true;}
		$j('.controllerAd').each(
		function (d){
			var src=$j(this).attr('src');
			if(src!=null){
				$j(this).attr('src',src);
			}
		});
		mainController.adsReloaded=0;
		if(_DEBUG){console.log('Ads refreshed');}
	},
	removeExtension:function(str){
		if(str!=''){
			str=str.replace('.htm','');
			str=str.replace('.html','');
			str=str.replace('.doc','');
			str=str.replace('.php','');
			str=str.replace('.txt','');
		}
		return str;
	},
	preLoad:function(show){
		if($j('#preLoad').html()==null || $j('#preLoad').html()==''){
			var html='<div class="at"id="preLoad"><div  class="ath" style="border:1px solid;">Cargando...</div></div>';
			$j('body').append(html);
		}
		if(show){
			$j('#preLoad').css('display','');
		}else{
			$j('#preLoad').css('display','none');
		}
	},
	setFriendlyUrls:function(){
		if(typeof mainController.friendlyUrls =='undefined')
		{
			var friendlyUrls=new Object();
			friendlyUrls.messages=new Object();
			friendlyUrls.messages.base='scripts/messages/';
			friendlyUrls.messages.simple='init.php';
			friendlyUrls.messages.advanced=new Object();
			friendlyUrls.messages.advanced.privates='init.php?id=4';
			friendlyUrls.messages.advanced.message=new Array('/\/messages\/message\-([0-9])+\.htm/',"'/tmp/messages/?id=$1");

			mainController.friendlyUrls=friendlyUrls;
		}
	}
}

function imgCrawler(obj)
{
	var src=$j(obj).attr('src');
	if(src==''){return false;}
	$j.post('/imgCrawler.php',{src:src},function(data){
		console.log(data);
	});
}


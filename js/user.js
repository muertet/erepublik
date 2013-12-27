var User={
	key:'userGames',
	info:{},
	games:{},
	
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
	init:function(games)
	{
		if(typeof games =='undefined')
		{
			games=localStorage.getItem(User.key);
			
			if(games){
				games=jQuery.parseJSON(games);
				User.games=games;
			}else{
				for(k in Game.status){
					User.games[k]=[];
				}
			}
		}else{
			User.games=games;
		}
	},
	isLogged:function(){
		return User.logged;
	},
	profile:function(uid,tab)
	{
		if(uid===undefined){
			return false;
		}
		if(tab===undefined){
			tab=3;
		}
		
		Site.api('user/profile',{uid:uid,tab:tab},function(data)
		{
			if(!data){
				alert(T('profile not found'));
			}
			
			var html=Site.parseTemplate(function()
			{/*<div class="tabs2" style=" margin-bottom: 10px;"><div class="tabs-container"><div id="tab14" class="tab-content" style="display: block;">
				<div style=" width: 100%;">
					<div class="float-left" style="width: 74%;display: inline-block;">
						<div class="title-caption-large" style="   width: 100%;">
							<h3><%=data.info.nick%></h3>
						</div>
						<p>
							Mind breaker
						</p>
					</div>
					<div class="float-right" style="  display: inline-block; margin-left: 59px;">
						<img src="http://media.steampowered.com/steamcommunity/public/images/avatars/15/15e56bc7eb4fdacfd53275e2f923339e5fcb4d9d_full.jpg">							
					</div>
				</div>
	 		 </div></div></div>
			<div class="tabs3 widget">				
				<ul class="tabs-nav">
					<li><a href="#tab18">Pending</a></li>
					<li><a href="#tab20">Played</a></li>
					<li><a href="#tab21">Favorite</a></li>
				</ul>

				<div class="tabs-container">
					
					<div id="pendingStatus" class="tab-content" style="display: none;">					
					</div><!--/ .tab-content-->
					
					<div id="tab19" class="tab-content" style="display: none;">
						<p>
							Vivamus bibendum purus sit amet lectus pellentesque consequat. Proin lectus est, adipiscing a 
							congue ac, pretium a nisi. In a placerat nibh. In id hendrerit tortor. Ut ut tincidunt nisi. 
							Nulla cursus magna id turpis dignissim et gravida purus dictum. 
						</p>
					</div><!--/ .tab-content-->
					
					<div id="playedStatus" class="tab-content" style="display: block;">						
						<% for(k in data.games){ var game=data.games[k].game;%>
							<div class="gameCover">
								<a href="/game/<%=game.id%>/<%=friendly_url(game.title)%>.htm">
									<img class="gameImage" title="<%=game.title%>" alt="<%=game.title%>" src="http://thegamesdb.net/banners/_gameviewcache/boxart/original/front/<%=game.id%>-1.jpg">
								</a>
							</div>
						<% } %>
					</div><!--/ .tab-content-->
					
					<div id="tab21" class="tab-content" style="display: none;">
						<p>
							Vivamus sed tincidunt ipsum. Praesent blandit enim at nunc volutpat vitae tincidunt arcu mollis. 
							Vivamus luctus eros a est auctor facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing 
							elit. Sed ut lectus at ligula mattis varius dapibus id velit. Ut a lectus nibh, non tempus dolor. 
						</p>
					</div><!--/ .tab-content-->
					
				</div><!--/ .tab-container-->
				<div class="clear"></div>
			</div>*/},{data:data});	
			
			var title='Profile';
			Site.html({html:html,title:title,removeHeader:true,section:'all'});
		});
		
			
	},
	setGame:function(id,status)
	{
		var games=[],
			game={};
		
		for(k in User.games)
		{
			games=User.games[k];
			for(i in games)
			{
				game=games[i];
				
				if(game.id==id)
				{
					User.games[k].splice (i, 1);					
					break;
				}
			}
		}
		$('#statusGame-'+id).text(Game.status[status].name);
		
		Site.api('user/setGame',{id:id,status:status},function(data)
		{
			if(data)
			{
				User.games[status][User.games[status].length]={
					game:{id:id},
					date:new Date().getTime()
				}
			}	
		});		
	},
	getGamesByStatus:function(status)
	{
		if(status===undefined){
			return false;			
		}
		
		if($('#pendingStatus div').length==1){
			$('#pendingStatus').toggle();
			return true;
		}
		
		
		Site.api('user/getGames',{uid:User.info.uid,status:status,fullInfo:true},function(data)
		{			
				var html=Site.parseTemplate(function()
				{/*
				<% for(k in data){ var game=data[k].game;%>
					<div class="gameCover">
						<a href="/game/<%=game.id%>/<%=friendly_url(game.title)%>.htm">
							<img class="gameImage" title="<%=game.title%>" alt="<%=game.title%>" src="http://thegamesdb.net/banners/_gameviewcache/boxart/original/front/<%=game.id%>-1.jpg">
						</a>
					</div>
				<% } %>
				*/},{data:data});
				$('.tab-content').hide();
				$('#pendingStatus').html(html).show();
		});	
	},
	getGame:function(id)
	{
		for(k in User.games)
		{
			games=User.games[k];
			for(i in games)
			{
				game=games[i];
				
				if(game.game.id==id)
				{
					game.status=k;
					return game;
				}
			}
		}
		return false;
	},
	updateCache:function()
	{
		var obj=JSON.stringify(User.games);
		localStorage.setItem(User.key,obj);
		
		if(User.logged && false){
			$.post('api.php?action=saveData',{data:obj},function(){
				
			});
		}
	}
}
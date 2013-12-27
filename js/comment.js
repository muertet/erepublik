var Comment={
	new:function(obj)
	{
		if(!User.isLogged()){
			return false;
		}
		
		if(typeof obj=='undefined' || typeof obj.type =='undefined' || typeof obj.reciever =='undefined' || typeof obj.text =='undefined' ){
			return false;
		}
		if(obj=='' || obj.type =='' ||  obj.reciever =='' ||  obj.text ==''){
			return false;
		}
		
		Site.api('Comment/create',obj,function(data){
			if(!data){
				$('#comment'+obj.game).hide();
			}else{
				$('#commentform textarea').val('');
				$('#comments ol').append(Comment.parseComment(data));
			}			
		});
	},
	init:function(id,type)
	{
		if(typeof id =='undefined' ||typeof type =='undefined' ){
			return false;
		}
		
		var html=Site.parseTemplate(function()
		{/*<div class="comment-list" id="comments">
				<h5> Comments</h5> 
				<ol> 
					<img src="images/loader.gif">
				</ol>
			</div>*/});
		$('#comments').replaceWith(html);
		
		Site.api('Comment/get/',{id:id,type:type},function(data)
		{
			var comments='';
			
			for(k in data){
				comments+=Comment.parseComment(data[k]);
			}
			$('#comments ol').html(comments);
		});
	},
	parseComment:function(comment)
	{
		var html='';
		
		
		html=Site.parseTemplate(function()
		{/*<li class="comment">
				<div class="comment-body clearfix">
					<img class="avatar" src="images/avatar.png" alt="">
					<div class="comment-text">
						<div class="comment-author"><a href="user/<%=comment.sender.uid%>/<%=friendly_url(comment.sender.nick)%>.htm"><%=comment.sender.nick%></a></div>
						<div class="comment-date"><%=comment.date%></div>
						<div class="comment-entry">
							<%=comment.text%>
							<!--a class="comment-reply" href="#">[Reply]</a-->
						</div><!--/ comment-entry-->  
					</div><!--/ comment-text -->
				</div><!--/ comment-body-->
			</li><!--/ comment-->
		*/},{comment:comment});
		return html;	
	}		
};
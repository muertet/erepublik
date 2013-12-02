function valid_email(value) {
	regExp  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$|^$/;
	return regExp.test(value);
}

function goAway(url, name, width, height) {
	var isResizeAble = false;
	var left = Math.round((screen.width - width) / 2);
	var itop = Math.round((screen.height - height) / 2);
	var styleStr = "";
	styleStr += 'height=' + height+','+'width=' + width;
	styleStr += 'toolbar=no,location=no,directories=no,status=no,menuBar=no,scrollbars=yes';
	styleStr += ',resizable=' + (isResizeAble ? 'yes' : 'no');

	styleStr += ',left=' + left + ',top=' + itop;
	//styleStr += ',screenX=' + left + ',screenY=' + itop;
	try {
		var res = window.open(url, name, styleStr);
		res.focus();
		window.childW = res;
	}
	catch(e) {alert(e);}
	return res;
}

function inviteBy(client_name) {
	var url = '/en/main/oauth/'+client_name.toLowerCase()+'/';
	try {
		childW.close();
	}
	catch(e){;}
	try {
			var x = 600;
			var y = 550;
			if(client_name.toLowerCase() == "msn") {
				x += 350;
				y += 50;
			}
			goAway(url, "Oauth_login", x, y);
	}
	catch(e){;}
}

returnToMain = function(type, displayMsg) {
	$j.post("/en/main/import-contacts/", {
			_token: $j('#_token').val(),
			type: type
			},
			function(data){
				try {
					childW.close();
					toggleTopZone(data);
					if(!displayMsg) $j('.success_message').hide();
				}
				catch(e) {;}
			},
			'html');
}

function toggleTopZone(data) {
	try {
		$j('#top_zone').hide().empty().html(data).fadeIn('slow');
		$j(".friend_list label, .user_details label").click(function (event) {
			$j(this).toggleClass("selected");
		});
	}
	catch(e){;}
}

function addAsFriends() {
	var ids = $j('input[name*=friends]:checked');
	if(ids.size() > 0 ) {
	$j.post("/friends/addContactFriends?_token="+$j('#_token').val(),
		jQuery.param(ids),
		function(data) {
			if(data == "1") redirectHome();
			else returnToMain("friends", true);
		});
	} else returnToMain("friends", false);
}

function sendInvitations() {
	try {
	var emails = $j('input[name*=friend_email]:checked, #_token');
		if(emails.size() > 1) {
			$j.post("/en/main/invite-friends/",
					jQuery.param(emails),
					function(data) {
						if(data) {
							$j('.success_message').find('td').html('Invites have been sent to the selected contacts.');
						} else	 {
							alert(data);
						}
						//$j('div.invite_more_friends').hide();
						$j('.friends_holder').fadeOut('slow');
			});
		} else {
			//$j('.success_message').hide();
			redirectHome();
		}
	} catch(e) {alert(e);}
}

function toggleAllFriends(el) {
	$j('.friend_list > input[name*=friend_email]').each(function(){
		$j(this).attr('checked', $j(el).attr('checked'));
		var id = $j(this).attr('id');
		var label  = $j("label[for='"+id+"']");
		if($j(this).attr('checked')) {
			if(!label.hasClass('selected')) label.addClass('selected');
		} else {
			if(label.hasClass('selected')) label.removeClass('selected');
		}
	});
}

redirectHome = function() {
	try {
		window.opener.childW.close();
		window.opener.location = '/';
	}catch(e){
		window.location = '/';
	}
};
$j(window).unload(function(){
		try {
			childW.close();
		}
		catch(e) {;}
		});


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:og="http://ogp.me/ns#"
  xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="keywords" content="e-sim, mmog, browser game, free game, multiplayer game, social game"/>
    <meta name="description" content="Free strategic browser game. Fight, earn money, manage businesses"/>
    <meta property="og:site_name" content="e-Sim"/>
	<base href="http://<?=Config::get('domain');?>/">
    
    <meta http-equiv="Last-Modified" content="2013-12-13 16:19:32" />
    <meta property="og:image" content="images/PrimeraLogo.png"/>
    <meta property="og:description" content="Free strategic browser game. Fight, earn money, manage businesses. Join us, let's have some fun together, help your ecountry to grow."/>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <link href="css/jquery-ui-1.9.2.custom.min.css" type="text/css" rel="stylesheet">

    <script src="js/script-min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    
    <link href="css/foundation-min.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link href='http://fonts.googleapis.com/css?family=Russo+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext,cyrillic,greek' rel='stylesheet' type='text/css'>


    <script src="js/custom.modernizr.js"></script>

    <title>e-sim -  Free MMOG browser game  </title>      
</head>
	<body id="bestBody" style="margin:0 auto;" class="Spain">
		
		<div id="hiddenBackground"></div>
		<div id="container"></div>
	
	<TD valign="top" colspan="2" style="text-align: center">
	
<div id="bestContainer" style="min-width:990px;">
	
			
			<div id="bestTopBar" class="foundationBar">
				<div style="margin: 4px 0px 0px 0px;" class="fb-like" data-href="https://www.facebook.com/eSim" data-send="true" data-width="450" data-show-faces="false" data-colorscheme="dark"></div>
				<form id="bestForm" class="foundation-style" action="login.php" method="POST"> 
						<input type="text" placeholder="login" name="login"/>
						<input type="password" placeholder="password" name="password"/>
						<button class="foundation-style button foundationButton" type="submit" value="Login">Login</button>		
				</form>
			</div><br>
			<div style="width:340px;margin:10px auto;" id="bestEsim">
				<span style="margin-left:120px;" id="bestName">E-Sim</span>
			</div>
			<div class="foundation-center" style="width:600px;font-size:20px;color:#f2f2f2;text-shadow:0 0 5px black;font-weight:bold;padding-bottom:20px;">
				<b class="foundation-text-left">Free strategic browser game.</b><br> 
				<b class="foundation-text-right">Join us and help your ecountry to grow.</b><br>
			</div>
			<div id="bestestContainer">
					

<script type="text/javascript">
	$(document).ready(function() {
		$("#citizenshipSelect").change(function() { 
			$.ajax({
				  url: "countryRegions.html",
				  context: document.body,
				  type: "POST",
				  data: {countryId : $("#citizenshipSelect").val()},
				  success: function(data){
					  var i=0;
					  $('#regionId').find('option').remove();
					  var json = jQuery.parseJSON(data);
					  for (i=0;i<json.length;i++) {	  
						$('#regionId').append('<option value="' + json[i][0] + '">' + json[i][1] + '</option>')
					  }
				  }
			});
		});
	}); 
	function selectAnyCountry(){
		if ($("#citizenshipSelect").val() == ""){
		
				$("#citizenshipSelect").val("1");
			
		}
	}
</script>

<div id="foundationForm" class="foundation-style small-200">
	<form method="POST" action="registration.html" class="validatedForm foundation-style" id="registerForm">
		<div class="small-200 foundation-center" style="margin-top:25px;">
			<input class="hidden-field" type="hidden" value="NEW" name="preview">
			<input type="text" value="" placeholder="Login" maxlength="32" minlength="3" class="required" name="login" id="login"><span id="msgl"></span>
			<input type="text" value="" placeholder="E-Mail" class="required email" name="mail" id="mail">
			<input type="password" value="" placeholder="Password" maxlength="32" minlength="6" class="required" name="password" id="pwdField">
				<select class="required custom dropdown" name="countryId" id="citizenshipSelect">
					<option value="">Select your citizenship</option>
					
				</select>
			<a href="#">
				<div id="moreOptions">
					<b id="show">Show more <img src="images/downArrow.png" /></b>
					<b id="hide">Hide <img src="images/upArrow.png" /></b>
				</div>
			</a>
			<div id="options" style="min-height:60px;color:#f2f2f2;">
				
					Receive bonus after reaching <b>level 7</b><br/>
					<input id="inviter" placeholder="Enter your Inviter's name" type="text" name="inviter" value="">
				
						
			</div>
		</div>
		<div>
			<input class="foundation-style button foundationButton" onfocus="selectAnyCountry()" type="submit" value="Sign-In!"><br>
			<input type="checkbox" value="yes" name="acceptRules" style="position:absolute;left:-99999px">
			<input id="rules" class="required" type="checkbox" value="yes" name="rules"><label id="rulesCheck" style="color:#f2f2f2;" for="rules"><span></span><b>I have read and agree with <br /> <a target="_blank" href="laws.html">the rules</a> and  <a target="_blank" href="privacyPolicy.html"> privacy policy</a>.</b></label><br>
		</div>	
		
			<script type="text/javascript">
				$(document).ready(function() {
					$("#citizenshipSelect").prependTo("#options");
					$('#hiddenCountry').prependTo("#options");
					var $d = $("#citizenshipSelect option[value=5]");
					if($d === null || $d.length == 0) {
						$("#citizenshipSelect").show();
						$('#hiddenCountry').show();
					} else {
						$d.attr('selected','selected');
					}
				});
			</script> 
			
		<script type="text/javascript">
			$(document).ready(function(){
				$("#options").hide();
				$("#moreOptions").show();
				$("#show").show();
				$("#hide").hide();
				$("#moreOptions").click(function(event){
					event.preventDefault();
					$("#options").stop(true, true).animate({
						height: "toggle",
						opacity: "toggle"
					}, "slow", function() {
						$("#moreOptions b").toggle();
					});
				});
					
				$("#login").focusout(function(){
					$("#msgl").html('');
			 
					var username=$("#login").val().toLowerCase();
 
					$.ajax({
						type:"GET",
						url:"apiCitizenByName.html",
						data:"name="+username,
						dataType: 'json',
						success:function(data){
							if(!data.id){
								$("#msgl").html('<i style="padding-left:.4em;font-size:1.8em;vertical-align:middle;color:green;position:absolute;top:0;right:0;text-shadow:none;" title="Nick avaible!" class="smallhelp icon-uniF471"></i>');
								$("input[type=submit]").removeAttr('disabled');
							}
							else{
								$("#msgl").html('<i style="padding-left:.4em;font-size:1.8em;vertical-align:middle;color:red;position:absolute;top:0;right:0;text-shadow:none;" title="This nick s already taken!" class="smallhelp icon-uniF470"></i>');
								$("input[type=submit]").attr('disabled','true');
							}
						}
					});
				});
			});
		</script>	
	</form>
</div>

			</div>
			<div id="bestBottomBar" class="foundationBar">
				<div class="small-300 foundation-center foundationBlock"><i class="icon-earth-2"></i>52 Countries</div>
				<div class="small-300 foundation-center foundationBlock"><i class="icon-accessibility"></i>0 active users</div>
				<div class="small-300 foundation-center foundationBlock"><i class="icon-cuniF006"></i>15 seconds to register</div>
			</div>
		</td>
	</tr>
</div>

                  
		
	</TD>


<script src="js/foundation.min.js"></script>
<script type="text/javascript">
	  $(document).foundation();
</script>

</body>
</html>
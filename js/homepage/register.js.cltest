var inProgress = false;
$j(document).ready(function() {
	$j.tools.validator.localizeFn("[required]", {
		en: REGISTER_TEXTS.email_required_error ? REGISTER_TEXTS.email_required_error : "Please type in your email address"
	});
	$j.tools.validator.localizeFn("[pattern]", {
		en: REGISTER_TEXTS.invalid_email_error ? REGISTER_TEXTS.invalid_email_error : "Please enter a valid email address!"
	});
	$j.tools.validator.fn("[minlength]", function(input, value) {
		var min 		= parseInt(input.attr("minlength"));
		var input_id 	= input.attr("id");
		var error_msg 	= "Please provide at least " +min+ " character" + (min > 1 ? "s" : "");

		if (input_id == "register_password") {
			error = REGISTER_TEXTS.password_min_length_error ? REGISTER_TEXTS.password_min_length_error : "The password must have at least %%1%% characters.";
			error_msg = error.replace('%%1%%', min);
		} else if (input_id == "register_name") {
			error = REGISTER_TEXTS.name_min_length_error ? REGISTER_TEXTS.name_min_length_error : "The name must have at least %%1%% characters.";
			error_msg = error.replace('%%1%%', min);
		}

		return value.length >= min ? true : {
			en: error_msg
		};
	});

	$j.tools.validator.fn("[startend]", function(input, value) {
		var pattern = input.attr("startend");
		var re = new RegExp("^"+pattern+"$");
		return re.test(value) ? true : {
			en: REGISTER_TEXTS.invalid_regex_name_error ? REGISTER_TEXTS.invalid_regex_name_error : "Name must begin and end with a letter or digit"
		};
	});

	$j.tools.validator.fn("[valid]", function(input, value) {
		var pattern = input.attr("valid");
		var re = new RegExp("^"+pattern+"$");
		return re.test(value) ? true : {
			en: REGISTER_TEXTS.invalid_name_error ? REGISTER_TEXTS.invalid_name_error : "Invalid name format"
		};
	});

	$j.tools.validator.fn("[email-extra]", function(input, value) {
		return checkValidEmail(value) ? true : {
			en: REGISTER_TEXTS.invalid_email_error ? REGISTER_TEXTS.invalid_email_error : "Please enter a valid email address!"
		};
	});

	var nameValidator = $j('#register_name').validator({message: '<div><span></span></div>', messageClass: 'error fadeInUp'});
	var countryValidator = $j('#register_country').validator({
		message: '<div><span></span></div>',
		messageClass: 'error fadeInUp',
		onSuccess: function()  {
			$j('.chzn-single').removeClass('invalid');
		}
	});
	var emailValidator = $j('#register_email').validator({message: '<div><span></span></div>', messageClass: 'error fadeInUp'});
	var passwordValidator = $j('#register_password').validator({message: '<div><span></span></div>', messageClass: 'error fadeInUp'});

	facebook.init();

	$j("#register_country").oninvalid(function() {
		$j('.chzn-single').addClass('invalid');
	});
	
	$j("#register_name").bind('click keypress', function(event){
		nameValidator.data('validator').reset();
	});
	
	$j('#optin').click(function() {
		if(this.checked){
			$j('#go_to_step_2').removeClass('disabled');
		} else {
			$j('#go_to_step_2').addClass('disabled');
		}
	});

	$j('#go_to_step_2').click(function(){
		if(!$j(this).hasClass('disabled')) {
			var name 		= nameValidator.data('validator').checkValidity();
			var country 	= countryValidator.data('validator').checkValidity();
			var email 		= emailValidator.data('validator').checkValidity();
			var password 	= passwordValidator.data('validator').checkValidity();
			if (name && country && email && password) {
				if (inProgress) {
					return false;
				}
				inProgress = true;
				$j('#register_name').parent().addClass('loader');
				$j('#reg_loader').css('opacity','1');
				name_exists(true);
			}
		}
	});
    
    $j("#registerkong").click(function () {
        
        if(!$j(this).hasClass('disabled')) {
            
			var name = nameValidator.data('validator').checkValidity();
			var country = countryValidator.data('validator').checkValidity();
			
			if (name && country) {
				if (inProgress) {
					return false;
				}
				inProgress = true;
				$j('#register_name').parent().addClass('loader');
				$j('#reg_loader').css('opacity','1');
				name_exists(false);
					
                var name = $j("#register_name").val();
                var country = $j("#register_country option:selected").val();
                var koptin = $j("#koptin").is(':checked');
                var _tokenval = $j("#_token").val();
                var params = {register_name: name, register_country: country, optin: koptin, _token:_tokenval};

                var currentLocation = window.location.toString().split("#");
                
                var urll = currentLocation[0] +'verify';

                $j.post(urll, params,
                    function(data) {
                        
                        if(data.success) {

                            $j('.error').hide();
                            window.location = data.redir;
                        } else {                
                            for(i in data.errors) {

                                switch(data.errors[i]) {
                                    
                                    case 'register_email':
                                    
                                        alert(data.message);
                                    break;

                                    case 'register_name':
                                        var name 		= nameValidator.data('validator').checkValidity();                                        
                                        break;
                                    case 'register_country':

                                        var country 	= countryValidator.data('validator').checkValidity();
                                        break;
                                    case 'optin':
                                        break;
                                }
                            }
                        }
                    });
            }
        }
        });

	$j('#finish_register').click(function() {
		if (inProgress) {
			return false;
		}
		inProgress = true;
		Register.newCitizen();
	});

	$j('.register_button').click(function(){
		show_register(false);
	});

	$j('.close_registration').click(function(){
		$j('#registration_options').trigger('close');
	});

	var hash = window.location.hash;
	if (hash.indexOf('#') > -1) {
		var registerHash = hash.split('#');
		registerHash = registerHash[1];
		if (registerHash == 'facebook') {
			setTimeout(function(){
				facebook.login();
			}, 10);
		} else if (registerHash == 'register') {
			show_register(false);
		}
	}
});

var Register = {
	newCitizen: function() {
		$j('#captcha_error').hide();
		$j('#reg_loader').css('opacity','1');
		var referrerName = '';
		var hash = window.location.hash.split('#');
		if (hash && hash[1] && hash[1] != 'facebook' && hash[1] != 'register') {
			referrerName = hash[1];
		}
		var params = {
			name             : $j('#register_name').val(),
			countryId        : $j('#register_country').val(),
			email            : $j('#register_email').val(),
			password         : $j('#register_password').val(),
			referrer		 : referrerName,
			_token           : $j("input#register_token").val(),
			recaptcha_challenge_field : $j("input#recaptcha_challenge_field").val(),
			recaptcha_response_field  : $j("input#recaptcha_response_field").val()
		};

		$j.post("/" +culture+ "/main/register", params, function(data){
			if (data['has_error']) {
				if (data['error'] == 'captcha') {
					Recaptcha.reload();
					$j('#captcha_error').show();
					$j('#reg_loader').removeAttr('style');
					inProgress = false;
				}
			} else {
				if(data['isValidated'] == 1) {
					Register.linkFb();
				} else {
					//_gaq.push(['_trackPageview', '/register/confirmation']);
					$j('.email_complete p strong').html(data['email']);
					$j('#resend_email input').val(data['email']);
					$j('input#citizen_id').val(data['citizenId']);
					$j('#captcha').hide();
					$j('#reg_loader').removeAttr('style');
					$j('#email_confirmation').show();
					$j('#resend_email_link').click(function(){
						$j('#email_confirmation').hide();
						$j('#resend_email').show();
						var emailValidator = $j('#resend_email_input').validator({message: '<div><span></span></div>', messageClass: 'error fadeInUp'});
						$j('#resend_email_button').unbind('click');
						$j('#resend_email_button').click(function(){
							var emailCheck = emailValidator.data('validator').checkValidity();
							if (emailCheck) {
								resendEmail();
							}
						});
					});
					inProgress = false;
				}
			}
		}, "json");
	},

	linkFb: function() {
		$j.get('/en/facebook-register', function(data){
			if (data == 1) {
				//_gaq.push(['_trackPageview', '/register/fb/finish']);
				var url = $j('#final_click').attr('href');
				window.location = url;
			} else if (data == 0) {
				window.location = '/en/facebook/login';
			} else {
//				_gaq.push(['_trackPageview', '/register/fb/friends']);
				//_gaq.push(['_trackPageview', '/register/fb/finish']);
				var url = $j('#final_click').attr('href');
				window.location = url;
//				$j('#registration_form').hide();
//				$j('#facebook_friends .content').empty();
//				$j('#facebook_friends .content').append(data);
//				facebook.init();
//				$j('#reg_loader').removeAttr('style');
//				$j('#facebook_friends').show();
//				$j('#registration_options').removeClass('facebook');
//				$j('.close_registration').unbind('click');
//				$j('.close_registration').click(function(){
//					_gaq.push(['_trackPageview', '/register/fb/finish']);
//					var url = $j('#final_click').attr('href');
//					window.location = url;
//				});
//				inProgress = false;
//
//				$j('#registration_options').lightbox_me({
//					centered: true,
//					closeClick: false
//				});
			}
		});
	},

	extraFields: function(data, response) {
		
			$j('#register_email_field').hide();
			$j('#register_password_field').hide();
			$j('#register_name').val(response.name);
			$j('#register_email').val(response.email);
			$j('#register_password').val(response.id);
			$j('#registration_options').addClass('facebook');
			$j('#registration_options').addClass('name');
			$j('#go_to_step_2').unbind('click');
			var nameValidator = $j('#register_name').validator({message: '<div><span></span></div>', messageClass: 'error fadeInUp'});
			var countryValidator = $j('#register_country').validator({
				message: '<div><span></span></div>',
				messageClass: 'error fadeInUp',
				onSuccess: function()  {
					$j('.chzn-single').removeClass('invalid');
				}
			});
			if(data.name_error == 1) {
				invalidateElement('register_name', 'name_invalid');
			} else if(data.name_error) {
				invalidateElement('register_name', 'name_exists');
			}
			$j('#go_to_step_2').click(function(){
				if(!$j(this).hasClass('disabled')) {
					var name = nameValidator.data('validator').checkValidity();
					var country = countryValidator.data('validator').checkValidity();
					if (name && country) {
						if (inProgress) {
							return false;
						}
						inProgress = true;
						name_exists(false)
					}
				}
			});
		
	}
};

if(typeof culture == 'undefined')
	culture = 'en';

var facebook = {
	init: function() {
		facebook.loaded();
	},

	loaded: function() {
		$j('.fb_login,#fb_sign,.facebook_signin').click(function() {
			//_gaq.push(['_trackPageview', '/register/fb/login']);
			facebook.login();
			return false;
		});
	},

	login: function() {
		FB.getLoginStatus(function(response) {
			if(response.status == 'connected') {
				facebook.sync(true);
			}
			else {
				FB.login(function(response) {
					if (response.status == 'connected') {
						facebook.sync(true);
					}
				}, {scope: 'email'});
			}
		});
	},

	sync: function(showRegister) {
		FB.api('/me', function(response) {
			if(response.verified != undefined && response.verified === false) {
				facebook.logout();
			}
			$j('#reg_loader').css('opacity','1');
			$j.post('/'+culture+'/main/facebook-sync',
				{
					_token: $j('input[name="_token"]').val()
				},
				function(data) {
					if (data) {
						if (data['response'] == 0) {
							Register.linkFb();
						} else if (data['response'] == 1) {
							window.location = '/'+culture+'/facebook/login';
						} else if (data['response'] == 3) {
							Register.extraFields(data, response);
							$j('#reg_loader').removeAttr('style');
							if (showRegister) {
								show_register(true);
							}
							
						}
					}
				}, "json"
			);
		});
	},

	logout: function() {
		FB.logout();
	}
};

function show_register(isFb)
{
	//_gaq.push(['_trackPageview', '/register/index']);
	if(isFb) {
		//_gaq.push(['_trackPageview', '/register/fb/location']);
	}
	$j('#registration_options').lightbox_me({
        centered: true,
		closeClick: false,
		onLoad: function() {
            $j('.new_citizen').find('input:first').focus();
		}
	});
}

function name_exists(checkEmail) {
    var name = $j('#register_name').val(),
		url='/scripts/login/check.php?name=';
		//url='/citizen/validate/name/';
    jQuery.getJSON(url+''+name, function(data) {
		if(data['response'] == 2 || data['response'] == 3) {
			invalidateElement('register_name', 'name_invalid');
		} else if (data['response'] == 1) {
			setTimeout(function(){
				invalidateElement('register_name', 'name_exists');
			}, 100)
        } else if (data['response'] == 0) {
        	if (checkEmail) {
        		email_exists();
        	} else {
				Register.newCitizen();
        	}
        } else {
			$j('#reg_loader').removeAttr('style');
			inProgress = false;
		}
		$j('#register_name').parent().removeClass('loader');

    });
}

function email_exists(inputName){
	var email = $j('#register_email').val();
	if (!checkValidEmail(email)) {
		invalidateElement('register_email', 'email_invalid');
	} else {
		var url ='/scripts/login/check.php?email=';
		//var url ='/citizen/validate/email/';
		jQuery.getJSON(url+''+email, function(data) {
			if(data['response'] == 2) {
				invalidateElement('register_email', 'email_invalid');
			} else if(data['response'] == 1) {
				invalidateElement('register_email', 'email_exists');
			} else if (data['response'] == 0) {
				$j('#registration_form').hide();
				$j('#captcha').show();
				//_gaq.push(['_trackPageview', '/register/captcha']);
				$j('#reg_loader').removeAttr('style');
				inProgress = false;
			} else {
				inProgress = false;
			}
		});
	}
}

function invalidateElement(element_name, error_type) {
	var param = {};
	if (error_type == 'email_invalid' && element_name == 'resend_email_input') {
		param = {'resend_email_input' : REGISTER_TEXTS.invalid_email_error ? REGISTER_TEXTS.invalid_email_error : 'Please enter a valid email address'};
	} else if (error_type == 'email_exists' && element_name == 'resend_email_input') {
		param = {'resend_email_input' : REGISTER_TEXTS.email_already_exists_error ? REGISTER_TEXTS.email_already_exists_error : 'Email address already exists'};
	} else if (error_type == 'email_invalid') {
		param = {'register_email' : REGISTER_TEXTS.invalid_email_error ? REGISTER_TEXTS.invalid_email_error : 'Please enter a valid email address'};
	} else if (error_type == 'email_exists') {
		param = {'register_email' : REGISTER_TEXTS.email_already_exists_error ? REGISTER_TEXTS.email_already_exists_error : 'Email address already exists'};
	} else if (error_type == 'name_invalid') {
		param = {'register_name' : REGISTER_TEXTS.invalid_name_error ? REGISTER_TEXTS.invalid_name_error : 'Invalid name format'};
	} else if (error_type == 'name_exists') {
		param = {'register_name' : REGISTER_TEXTS.name_already_exists_error ? REGISTER_TEXTS.name_already_exists_error : 'Citizen name already exists'};
	}
	var elem  = $j('#'+element_name);
	elem.data('validator').invalidate(param);
	elem.unbind('focus');
	elem.focus();
//	elem.focus(function(){
//		elem.data('validator').reset(elem);
//	});
	$j('#reg_loader').removeAttr('style');
	inProgress = false;
}

function resendEmail() {
	var email = $j('#resend_email_input').val();
	if (!checkValidEmail(email)) {
		invalidateElement('resend_email_input', 'email_invalid');
	} else {
		$j.post("/" +culture+ "/main/register-send-email", {
			email  : email,
			citizen_id: $j("input#citizen_id").val(),
			_token : $j("input#register_token").val()
		}, function(data){
			if (data.has_errors) {
				if (data.error == 'redirect') {
					window.location.reload();
				} else if ( data.error =='email_invalid' ) {
					invalidateElement( 'resend_email_input', 'email_invalid' );
				} else {
					invalidateElement('resend_email_input', 'email_exists');
				}
			} else {
				var email = $j('#resend_email_input').val();
				$j('.email_complete p strong').html(email);
				$j('#resend_email input').val(email);
				$j('#resend_email').hide();
				$j('#email_confirmation').show();
			}
		}, "json");
	}
}

function checkValidEmail(email) {
	var at="@"
	var dot="."
	var lat=email.indexOf(at)
	var lstr=email.length
	var ldot=email.indexOf(dot)
	if (email.indexOf(at)==-1)
	   return false

	if (email.indexOf(at)==-1 || email.indexOf(at)==0 || email.indexOf(at)==lstr)
	   return false

	if (email.indexOf(dot)==-1 || email.indexOf(dot)==0 || email.indexOf(dot)==lstr)
		return false

	 if (email.indexOf(at,(lat+1))!=-1)
		return false

	 if (email.substring(lat-1,lat)==dot || email.substring(lat+1,lat+2)==dot)
		return false

	 if (email.indexOf(dot,(lat+2))==-1)
		return false

	 if (email.indexOf(" ")!=-1)
		return false

	 return true
}

var locked = false;
var upgradeLock = false;

function setGroupHeight() {
	var originalHeight = $j('.list_group').data('originalHeight');
	var windowHeight = $j(window).height();
	var groupHeight = windowHeight - 500;

	if(windowHeight < originalHeight) {
		if(groupHeight > 0) {
			$j('.list_group').addClass('scroll');
			if(groupHeight < 100) {
				$j('.list_group').css('height', '122px');
			} else {
				$j('.list_group').css('height', groupHeight+'px');
			}
		}
	}
}

function throwError(obj, msg) {
	$j(obj).append('<div class="error_holder"><strong>'+msg+'</strong><a href="javascript:;"></a></div>');
	$j(obj).bind('click', function(){
		$j('.error_holder', $j(obj)).remove();
	});
	return false;
}

window.onload = function () {
	// Floating production button
	if (companies.length) {
		if($j(window).height() > 550) {
			$j('#companies_bottom').scrollToFixed({
				bottom: 0,
				limit: $j('#companies_bottom').offset().top,
				preFixed: function() {$j('.area').addClass('fixed');},
				postFixed: function() {$j('.area').removeClass('fixed');$j(this).removeAttr('style');}
			});
		}
	}
}

$j(document).ready(function() {

	// Tutorial stuff

	// Tipsy Tooltip

	$j('.required_health.warn strong, .required_health.critical strong, .raw_materials > div.critical, .employees_available.critical strong, tipsers').tipsy({
		gravity: 's',
		live: true
	});


	$j('a.row_two').hover(
		function () {
			$j(this).parent().find('a.no5').addClass('pseudoactive');
		},
		function () {
			$j(this).parent().find('a.no5').removeClass('pseudoactive');
		}
	);

	$j('.list_group .upgrade').click(function(){
		var companyId = $j(this).parent().parent().attr('id').split('_')[1];
		upgradePopUp(companyId);
		setTimeout(function(){
			$j('#upgrade_company').lightbox_me({
				centered: true,
				closeClick: false,
				closeEsc: false,
				overlayCSS: {background: 'black', opacity: .5}
			});
		}, 50);
	})

	$j('.collect').click(function(){
		window.location.reload();
	});
	$j('#remove_close_button').click(function(){
		$j('#remove_mode').click();
	});

	$j('#upgrade_close_button').click(function(){
		$j('#upgrade_mode').click();
	});

	$j('#upgrade_mode').click(function(){
		if ($j(this).hasClass('active')) {
			enableControls();
			$j('.listing_holder').removeClass('upgrade');
			$j(this).removeClass('active');
		} else {
			disableControls();
			$j('.listing_holder').removeClass('remove');
			$j('.listing_holder').addClass('upgrade');
			$j('#remove_mode').removeClass('active');
			$j(this).addClass('active');
		}
	})
	$j('#remove_mode').click(function(){
		if ($j(this).hasClass('active')) {
			enableControls();
			$j('.listing_holder').removeClass('remove');
			$j(this).removeClass('active');
		} else {
			disableControls();
			$j('.listing_holder').removeClass('upgrade');
			$j('.listing_holder').addClass('remove');
			$j('#upgrade_mode').removeClass('active');
			$j(this).addClass('active');
		}
	})
	simple_tooltip("#salary_pop", "#salary_tooltip");

	$j('.more_details').click(function(){
		toggle_details($j(this));
	});
	$j('#eatFoodPopUp').unbind('click');
	$j('#eatFoodPopUp').click(function(){
		energy.eatFood();
		setTimeout(function(){$j('.wresults').trigger('close');}, 400);
	});
	$j('#cancel_captcha').click(function(){
		locked = false;
		$j('.captcha_modal').trigger('close');
	});
	$j('.close_pop_up').click(function(){
		locked = false;
		$j('.wresults').trigger('close');
		$j('#warning_popup').trigger('close');
		$j('#energy_bar_pop').trigger('close');
	});
	$j('.resign').click(function(){
		if (confirm(resign_confirm)) {
			$j.post(resign_url, {action_type: 'resign', _token: $j('#_token').val()}, function(data){
				if (data.status == true) {
					window.location.reload();
				} else if (data.status == false) {
					throwError($j('.work_holder'), data.message);
				}
			}, "json");
		}
	});

	$j('#start_production').click(function(){
		if (locked) {
			return false;
		}
		locked = true;
		var healthUsed = Math.abs(parseInt($j('#health_used').html()));
		if (usesEnergyBar(healthUsed)) {
			setTimeout(function(){
				$j('#energy_bar_pop').lightbox_me({
					centered: true,
					closeClick: false,
					closeEsc: false,
					overlayCSS: {background: 'black', opacity: .5}
				});
			}, 50);
			$j('#consume_energy').click(function(){
				$j('#energy_bar_pop').trigger('close');
				produce();
			})
		} else {
			produce();
		}
	});

	$j('.employee_works').click(function(){
		if ($j('.area').hasClass('disable_controls')) {
			return false;
		}
		var instance = $j(this);
		if (instance.hasClass('worked')) {
			return false;
		}
		var classNo = parseInt(instance.attr('employee'));
		var parentObj = instance.parent().parent().parent();

		if (instance.hasClass('active')) {
			var rowTwoActive = $j('.employee_works.row_two.active', parentObj);
			$j('.employee_works', parentObj).removeClass('active');
			if (rowTwoActive.length && classNo==5) {
				$j('.no5', parentObj).addClass('active');
			}
		} else {
			$j('.employee_works', parentObj).removeClass('active');
			if(classNo > 5) {
				$j('.no5', parentObj).addClass('active');
			}
			instance.addClass('active');
		}
		var sum = 0;
		$j.each($j('.employee_works.active'), function(idx, n){
			var companyId = $j(n).parent().parent().parent().attr('id').split('_')[1];
			company = getCompany(companyId);
			var nr = parseInt($j(n).attr('employee'));
			if (nr>5) {
				nr -= 5;
			} else {
				nr -= company.todays_works;
			}
			sum += nr;
		});
		if (sum > pageDetails.total_works) {
			$j('#preset_works').parent().attr('title', pageDetails.employee_warn);
			$j('#preset_works').parent().parent().addClass('critical');
		} else {
			$j('#preset_works').parent().attr('title', pageDetails.employee_tooltip);
			$j('#preset_works').parent().parent().removeClass('critical');
		}
		$j('#preset_works').html(sum);
		setTimeout(function(){
			calculateProduction(parentObj)
		}, 50);
	});

	$j('.owner_work').click(function(){
		var instance = $j(this);
		var parentObj = instance.parent().parent();
		if ($j('.area').hasClass('disable_controls') || parentObj.hasClass('disabled')) {
			return false;
		}
		if (instance.hasClass('active')) {
			instance.removeClass('active');
		} else {
			instance.addClass('active');
		}
		checkHealth();
		setTimeout(function(){
			calculateProduction(parentObj)

		}, 50);
	});

	$j('#work').click(function(){
		if (locked) {
			return false;
		}
		locked = true;
		$j('#tutorial_step_2').removeClass('showMessage');
		Tutorial.restore($j('#work'));
		if (usesEnergyBar(10)) {
			setTimeout(function(){
				$j('#energy_bar_pop').lightbox_me({
					centered: true,
					closeClick: false,
					closeEsc: false,
					overlayCSS: {background: 'black', opacity: .5}
				});
			}, 50);
			$j('#consume_energy').click(function(){
				$j('#energy_bar_pop').trigger('close');
				work();
			})
		} else {
			work();
		}
		H.restore('#work');
	});

	$j('.upgrade_action').click(function(){
		var companyId = $j(this).attr('companyId');
		var level = $j(this).attr('id').split('_')[2];
		var isDowngrade = $j(this).parent().hasClass('downgrade');
		if (isDowngrade && has_pin) {
			$j('#upgrade_company').trigger('close');

			$j('#pin_confirm').lightbox_me({
				centered: true,
				closeClick: false,
				closeEsc: false,
				overlayCSS: {background: 'black', opacity: .5}
			});
			$j('#finish_enter_pin').click(function(){
				var pin = $j('#pin_field').val();
				upgradeCompany(companyId, level, pin);
			});
			$j('#close_pin').click(function(){
				$j('#pin_confirm').trigger('close');
			});
		} else {
			upgradeCompany(companyId, level, false);
		}
	});

	$j('.fluid_blue_dark_medium').click(function(){
		$j('#pin_confirm').lightbox_me({
			centered: true,
			closeClick: false,
			closeEsc: false,
			overlayCSS: {background: 'black', opacity: .5}
		});
	});
});

function checkHealth()
{
	var sum = 0;
	$j.each($j('.owner_work.active'), function(idx, n){
		sum -= 10;
	});
	$j('#health_used').html(sum);

	var hUsed	= Math.abs(sum);
	var h 		= parseInt($j('#current_health').html());
	var hl 		= parseFloat(pageDetails.recoverable_health.value);
	if (hUsed <= h) {
		$j('#health_used').parent().removeClass('critical');
		$j('#health_used').parent().removeClass('warn');
		$j('#health_used').attr('title', pageDetails.health_tooltip);
	} else if (hUsed > h && hUsed <= hl + h) {
		$j('#health_used').parent().removeClass('critical');
		$j('#health_used').parent().addClass('warn');
		$j('#health_used').attr('title', pageDetails.health_warn);
	} else if (hUsed > h && hUsed > hl + h) {
		$j('#health_used').parent().addClass('critical');
		$j('#health_used').parent().removeClass('warn');
		$j('#health_used').attr('title', pageDetails.health_warn_limit);
	}
	$j('.required_health.warn strong, .required_health.critical strong').tipsy({
		gravity: 's',
		live: true
	});
}

function usesEnergyBar(hUsed)
{
	var h 		= pageDetails.health;
	var hl 		= parseFloat(pageDetails.recoverable_health.value);
	var fl 		= pageDetails.recoverable_health_in_food;
	var e 		= parseInt(pageDetails.energy.amount) * parseInt(pageDetails.energy.effect);
	var c 		= true;
	var r		= 0;
	if (hUsed > h) {
		r = hUsed - h;
		m = Math.min(hl, fl);
		if (m < r && m + e > r) {
			return true;
		}
	}
	return false;
}

function work()
{
	if (has_captcha) {
		showCaptcha('work');
	} else {
		$j.post(work_url, {action_type: 'work', _token: $j('#_token').val()}, function(data){
			if (data.status == false && (data.message == 'redirect' || data.message == 'processing')) {
				window.location.reload();
			} else if (data.status == false && data.message == 'lock') {
				locked = false;
			} else if (data.status == true && data.message == true) {
				checkResponse('work', data);
				locked = false;
			} else if (data.message == 'captcha'){
				showCaptcha('work');
				locked = false;
			} else {
				checkResponse(data.message, data);
				locked = false;
			}
		}, "json");
	}
}

function produce()
{
	var params = generateParams();
	if ($j.isEmptyObject(params.companies)) {
		checkResponse('nothing_selected', null);
		locked = false;
		return false;
	}
	if (has_captcha) {
		showCaptcha('production');
	} else {
		var params = generateParams();
		params['action_type'] = 'production';
		params['_token'] = $j('#_token').val();
		$j.post(work_url, params, function(data){
			if (data.status == false && data.message == 'redirect') {
				window.location.reload();
			} else if (data.status == false && data.message == 'lock') {
				locked = false;
			} else if (data.status == true && data.message == true) {
				checkResponse('production', data);
				locked = false;
			} else if (data.status == false && data.message == 'captcha'){
				showCaptcha('production');
				locked = false;
			} else {
				checkResponse(data.message, data);
				locked = false;
			}
		}, "json");
	}
}

function disableControls()
{
	$j('.area').addClass('disable_controls');
}

function enableControls()
{
	if (!is_organization) {
		$j('.area').removeClass('disable_controls');
	}
}

function generateParams()
{
	var params = {companies: {}};
	var company = new Array();
	var id = 0, employee_work = 0, own_work = 0, i = 0, nr = 0;
	var employeeObj = '';
	var companyObj = '';
	$j.each($j('.manager_dashboard .companies'), function(idx, n){
		id = $j(n).attr('id').split('_');
		id = id[1];
		companyObj 				= getCompany(id);
		employee_work			= 0;
		employeeObj 			= $j('.employee_works.row_two.active', $j(n));
		if (employeeObj.length) {
			employee_work 		= parseInt(employeeObj.attr('employee'));
		} else {
			employeeObj 		= $j('.employee_works.active', $j(n));
			if (employeeObj.length) {
				employee_work 	= parseInt(employeeObj.attr('employee'));
			}
		}
		if (employee_work) {
			employee_work -= companyObj.todays_works;
		}
		own_work 		= 0;
		if ($j('.owner_work', $j(n)).hasClass('active')) {
			own_work 	= 1;
		}
		if (employee_work || own_work) {
			company = {
				'id': id,
				'employee_works': employee_work,
				'own_work': own_work
			};
			params.companies[i] = company;
			i++;
		}
	});
	return params;
}

function checkResponse(msg, data)
{
	var popup = '#work_results';
	var showTutorialPopUp = false;
	if (msg == 'work') {
		if(data.result.first_work) {
			showTutorialPopUp = true;
		} else {
			$j('#result_salary').html('+'+data.result.netSalary + ' ' + data.result.currency);
			$j('#salary_tooltip').find('li').eq(0).find('span').html('+'+data.result.grossSalary+' '+data.result.currency);
			$j('#salary_tooltip').find('li').eq(1).find('span').html('-'+data.result.tax+' '+data.result.currency);
			if (data.result.to_achievment == 1)  $j('#work_days_to_label').html('day');
			$j('#work_result_days').html(data.result.days_in_a_row);
			$j('#work_result_to_achievment').html(data.result.to_achievment);
			$j('#work_result_xp').html('+'+data.result.xp);
			$j('#work_result_health').html('-'+data.result.health);
			$j('q#to_achievment_text').html(data.result.to_achievment_text);
		}
//		if (data.result.to_achievment == 1) {
//			$j('#work_to_achievment').html('one day');
//		} else {
//			$j('#work_to_achievment').html(data.result.to_achievment+' days');
//		}
	} else if (msg == 'production') {
		popup = '#production_results';
		$j('#production_result_days').html(data.result.days_in_a_row);
		$j('#production_result_to_achievment').html(data.result.to_achievment);
		$j('q#to_achievment_text').html(data.result.to_achievment_text);
		if (data.result.xp > 0) {
			$j('#production_result_xp').html('+'+data.result.xp);
		} else {
			$j('#production_result_xp').html(data.result.xp);
		}
		if (data.result.health > 0) {
			$j('#production_result_health').html('-'+data.result.health);
		} else {
			$j('#production_result_health').html(data.result.health);
		}
		if (data.result.works > 0) {
			$j('#production_result_works').html('-'+data.result.works);
		} else {
			$j('#production_result_works').html(data.result.works);
		}

		$j('ul.resource_bonus li').addClass('disabled');
		var production = data.result.production;
		if (production.foodRaw<0) {
			$j('#production_result_food_consumed').html(production.foodRaw);
			$j('#production_result_food_consumed').parent().show();
		} else {
			$j('#production_result_food_consumed').parent().hide();
		}
		if (production.weaponRaw<0) {
			$j('#production_result_weapon_consumed').html(production.weaponRaw);
			$j('#production_result_weapon_consumed').parent().show();
		} else {
			$j('#production_result_weapon_consumed').parent().hide();
		}
		$j('.consumed_summary').hide();
		if (!$j.isEmptyObject(data.result.consumed_summary)) {
			$j.each(data.result.consumed_summary, function(idx, n){
				if (idx == 10) {
					$j('#production_result_energy_consumed').html('-'+n);
					$j('#production_result_energy_consumed').parent().show();
				} else if (n > 0) {
					$j('#food_q'+idx+'_consumed strong').html('-'+n);
					$j('#food_q'+idx+'_consumed').show(n);
				}
			});
		}

		var res = '';
		for (i in data.result.resources) {
			res = data.result.resources[i];
			if (res.bonus>0) {
				$j('#resource_'+i).removeClass('disabled');
				$j('#resource_val_'+i).html('+'+res.bonus+'%');
			}
		}
		$j('ul.products li').hide();
		if (production.foodRaw>0) {
			$j('#food_raw_produced strong').html('+'+production.foodRaw);
			$j('#food_raw_produced').css('display', 'inline-block');
		}
		if (production.weaponRaw>0) {
			$j('#weapon_raw_produced strong').html('+'+production.weaponRaw);
			$j('#weapon_raw_produced').css('display', 'inline-block');
		}
		var tmp = 0;
		if (production.food) {
			for (i in production.food) {
				tmp = production.food[i];
				$j('#food_q'+i+'_produced strong').html('+'+tmp);
				$j('#food_q'+i+'_produced').css('display', 'inline-block');
			}
		}
		if (production.weapon) {
			for (i in production.weapon) {
				tmp = production.weapon[i];
				$j('#weapon_q'+i+'_produced strong').html('+'+tmp);
				$j('#weapon_q'+i+'_produced').css('display', 'inline-block');
			}
		}
	} else if (msg == 'money') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.money_warning').show();
	} else if (msg == 'not_enough_storage') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.storage_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.sum+'/'+data.result.max);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'not_enough_food_raw') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.food_raw_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.stock+'/'+data.result.consume);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'not_enough_weapon_raw') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.weapon_raw_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.stock+'/'+data.result.consume);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'not_enough_raw') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.raw_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.food_stock+'/'+data.result.food_consume+' Food raw material');
		$j(popup).find('strong').eq(1).html(data.result.weapon_stock+'/'+data.result.weapon_consume+' Weapon raw material');
		$j(popup).find('strong').show();
	} else if (msg == 'not_enough_health_food') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.food_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.health_limit+'/'+data.result.health_needed);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'not_enough_health') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.health_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.health_limit+'/'+data.result.health_needed);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'not_enough_works') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.works_warning').show();
		$j(popup).find('strong').eq(0).html(data.result.need+'/'+data.result.limit);
		$j(popup).find('strong').eq(0).show();
	} else if (msg == 'work_limit') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.work_limit_warning').show();
	} else if (msg == 'nothing_selected') {
		popup = '#warning_popup';
		$j(popup).find('img.message_icon').hide();
		$j(popup).find('a.action').hide();
		$j(popup).find('strong').hide();
		$j(popup).find('h4').hide();
		$j(popup).find('.nothing_selected').show();
	} else {
		window.location.reload();
	}
	if (showTutorialPopUp) {
		Tutorial.activate(10);
	} else {
		setTimeout(function(){
			$j(popup).lightbox_me({
				centered: true,
				closeClick: false,
				closeEsc: false,
				overlayCSS: {background: 'black', opacity: .5}
			});
		}, 50);
	}
}

function showCaptcha(action_type)
{
	$j('.captcha_modal').lightbox_me({
		centered: true,
		closeClick: false,
		overlayCSS: {background: 'white', opacity: .5},
		onClose: function(){
			Recaptcha.reload();
		}
	});
	$j('#submit_captcha').unbind('click');
	$j('#submit_captcha').click(function(){
		var params = {};
		if (action_type == 'production') {
			params = generateParams();
			params['action_type'] = 'production';
		} else {
			params['action_type'] = 'work';
		}
		params['recaptcha_response_field'] = $j('#recaptcha_response_field').val();
		params['recaptcha_challenge_field'] = $j('#recaptcha_challenge_field').val();
		params['_token'] = $j('#_token').val();
		$j('#captcha_error').hide();
		$j.post(captcha_url, params, function(data){
			if (data.status == false && data.message == 'redirect') {
				//window.location.reload();
			} else if (data.status == false && data.message == false) {
				$j('#captcha_error').show();
				Recaptcha.reload();
				locked = false;
			} else {
				var msg = data.message;
				if (data.message == true) {
					msg = action_type;
				}
				locked = false;
				$j('.captcha_modal').trigger('close');
				checkResponse(msg, data);
			}
		}, "json");
	});
}

function calculateProduction(parentObj)
{
	var companyId = $j(parentObj).attr('id').split('_')[1];
	company = getCompany(companyId);
	if (!company) {
		return false;
	}
	var works = 0;
	var employeeWorkObj = $j('.employee_works.row_two.active', parentObj);
	if (employeeWorkObj.length) {
		works = parseInt(employeeWorkObj.attr('employee'));
	} else {
		employeeWorkObj = $j('.employee_works.active', parentObj);
		if (employeeWorkObj.length) {
			works = parseInt(employeeWorkObj.attr('employee'));
		}
	}
	if (works) {
		works -= company.todays_works;
	}
	var own = 0;
	if ($j('.owner_work', parentObj).hasClass('active')) {
		own = 1;
	}
	var bp = company.base_production;
	var res = company.resource_bonus;
	var production = (works + own) * (bp + bp * res / 100);
	if (company.is_raw) {
		if (production > 0) {
			$j('.raw_production', parentObj).html('+'+production);
		} else {
			$j('.raw_production', parentObj).html(production);
		}

	} else {
		if (production > 0) {
			$j('.production', parentObj).html('+'+production);
		} else {
			$j('.production', parentObj).html(production);
		}
		var multiplier = 1;
		if (company.industry_token == 'WEAPON') {
			multiplier = 10;
		}
		var qualityMultiplier = parseInt(company.quality);
		if (qualityMultiplier == 7) {
			qualityMultiplier = 20;
		}
		var raw_consumption = production * qualityMultiplier * multiplier;
		if (raw_consumption > 0) {
			$j('.raw_production', parentObj).html('-'+raw_consumption);
		} else {
			$j('.raw_production', parentObj).html(raw_consumption);
		}
	}
	setTimeout(function() {
		calculateTotals();
	}, 50)
	return true;
}

function calculateTotals()
{
	var food_raw = 0;
	var weapon_raw = 0;
	var food_units = 0;
	var weapon_units = 0;
	$j('.manager_dashboard .companies').each(function(){
		var obj = this;
		var companyId = $j(obj).attr('id').split('_')[1];
		var company = getCompany(companyId);
		if (company.industry_token == 'FOOD') {
			if (!company.is_raw) {
				food_units += parseInt($j('.production', obj).html());
			}
			food_raw += parseInt($j('.raw_production', obj).html());
		} else if (company.industry_token == 'WEAPON') {
			if (!company.is_raw) {
				weapon_units += parseInt($j('.production', obj).html());
			}
			weapon_raw += parseInt($j('.raw_production', obj).html());
		}
	});
	if (food_raw>0) {
		$j('#food_raw_consumed').html('+'+food_raw);
	} else if (food_raw == 0) {
		$j('#food_raw_consumed').html(0);
	} else {
		$j('#food_raw_consumed').html(food_raw);
	}
	var raw_tip = pageDetails.raw_tooltip;
	var need = pageDetails.food_raw_stock + food_raw;
	if (pageDetails.food_raw_stock + food_raw < 0) {
		var tmp = pageDetails.raw_warning;
		tmp = tmp.replace('%%1%%', Math.abs(need));
		tmp = tmp.replace('%%2%%', MY_COMPANIES_TEXTS.food_text ? MY_COMPANIES_TEXTS.food_text : 'Food');
		$j('#food_raw_consumed').parent().attr('title', tmp);
		$j('#food_raw_consumed').parent().addClass('critical');
	} else {
		raw_tip = raw_tip.replace('%%1%%', MY_COMPANIES_TEXTS.food_text ? MY_COMPANIES_TEXTS.food_text : 'Food');
		$j('#food_raw_consumed').parent().attr('title', raw_tip);
		$j('#food_raw_consumed').parent().removeClass('critical');
	}
	if (weapon_raw>0) {
		$j('#weapon_raw_consumed').html('+'+weapon_raw);
	} else if (weapon_raw == 0) {
		$j('#weapon_raw_consumed').html(0);
	} else {
		$j('#weapon_raw_consumed').html(weapon_raw);
	}
	need = pageDetails.weapon_raw_stock + weapon_raw;
	if (pageDetails.weapon_raw_stock + weapon_raw < 0) {
		var tmp = pageDetails.raw_warning;
		tmp = tmp.replace('%%1%%', Math.abs(need));
		tmp = tmp.replace('%%2%%', MY_COMPANIES_TEXTS.weapon_text ? MY_COMPANIES_TEXTS.weapon_text : 'Weapon');
		$j('#weapon_raw_consumed').parent().attr('title', tmp);
		$j('#weapon_raw_consumed').parent().addClass('critical');
	} else {
		raw_tip = raw_tip.replace('%%1%%', MY_COMPANIES_TEXTS.weapon_text ? MY_COMPANIES_TEXTS.weapon_text : 'Weapon');
		$j('#weapon_raw_consumed').parent().attr('title', raw_tip);
		$j('#weapon_raw_consumed').parent().removeClass('critical');
	}
	if (food_units>0) {
		$j('#food_units_produced').html('+'+food_units);
	} else if (food_units == 0) {
		$j('#food_units_produced').html(0);
	} else {
		$j('#food_units_produced').html(food_units);
	}
	if (weapon_units>0) {
		$j('#weapon_units_produced').html('+'+weapon_units);
	} else if (weapon_raw == 0) {
		$j('#weapon_units_produced').html(0);
	} else {
		$j('#weapon_units_produced').html(weapon_units);
	}
}

function getCompany(companyId)
{
	var company = false;
	$j.each(companies, function(idx, n){
		if (n.id == companyId) {
			company = n;
		}
	});
	return company;
}

function toggle_details(obj)
{
	if ($j(obj).hasClass('show')) {
		$j(obj).removeClass('show');
		$j(obj).prev().prev().slideUp('fast');
		$j(obj).html('<span>'+$j('#show_details_text').val()+'</span>');

	} else {
		$j(obj).addClass('show');
		$j(obj).prev().prev().slideDown('fast');
		$j(obj).html('<span>'+$j('#hide_details_text').val()+'</span>');
	}
}
function simple_tooltip(trigger, tooltip){
	$j(trigger).mouseover(
		function(e) {
			var mousey = this.offsetTop + 80 ;
			var mousex = this.offsetLeft - 10 ;
			setTimeout(function(){
				$j(tooltip).css({display: "none"});
				$j(tooltip).css({top: mousey});
				$j(tooltip).css({left: mousex});
				$j(tooltip).css({display: "block"});
			}, 200);
	});

	$j(trigger).mouseout(
		function() {
			setTimeout(function(){
				$j(tooltip).css({display: "none"});
			}, 200);
	});
}

function upgradeCompany(companyId, level, pin)
{
	if(upgradeLock) {
		return false;
	}
	upgradeLock = true;
	$j.post(upgarade_url, {
		_token    : $j('#_token').val(),
		type      :'upgrade',
		companyId : companyId,
		level     : level,
		pin		  : pin
	}, function(data){
		if (data.status == false && data.message == 'redirect') {
			//window.location.reload();
		} else if (data.status == true) {
			window.location.reload();
		} else if (data.status == false && data.message == 'not_enough_gold'){
			setTimeout(function(){
				upgradeLock = false;
			}, 150);
			$j('#upgrade_gold_error').show();
		} else if (data.message == 'INVALID_PIN'){
			setTimeout(function(){
				upgradeLock = false;
			}, 150);
			$j('#pin_error').html(MY_COMPANIES_TEXTS.invalid_pin);
			$j('#pin_error').show();
		} else if (data.message == 'PIN_ATTEMPTS') {
			setTimeout(function(){
				upgradeLock = false;
			}, 150);
			$j('#pin_error').html(MY_COMPANIES_TEXTS.pin_attempts);
			$j('#pin_error').show();
		}
	}, "json");
}

function upgradePopUp(companyId)
{
	var company 	= getCompany(companyId);
	var upgrades 	= company.upgrades;
	var upgrade 	= '';
	var elem		= '';
	$j('#upgrade_gold_error').hide();
	$j('#pin_error').hide();
	$j('.list_group ul.upgrades li').hide();
	//if (company.max_quality == 6) {
		$j('.upgrade_pop .upgrades').removeAttr('style');
		$j('#upgrade_company').addClass('q7');
	// } else {
		// $j('#upgrade_company').removeClass('q6');
		// $j('.upgrade_pop .upgrades').attr('style', 'width: 593px;');
	// }
	for (i=1; i<=7; i++) {
		var hasAction = true;
		upgrade = upgrades[i];
		elem = $j('#upgrade_quality_'+i);
		$j('.upgrade_company_icon', elem).attr('src', upgrade.img);
		var cost = parseInt(upgrade.cost);
		$j('.upgrade_promo_cost', elem).parent().hide();
		if (upgrade.type == -1) {
			$j(elem).addClass('downgrade').removeClass('upgrade current');
			$j('.upgrade_cost_type', elem).html($j('#data-refund').val());
			$j('.upgrade_check', elem).hide();
			$j('.upgrade_title', elem).html($j('#data-downgrade').val()).show();
		} else if (upgrade.type == 1) {
			$j(elem).addClass('upgrade').removeClass('downgrade current');
			$j('.upgrade_cost_type', elem).html('');
			$j('.upgrade_check', elem).hide();
			$j('.upgrade_title', elem).html($j('#data-upgrade').val()).show();
			if (promoMultiplier > 0) {
				$j('.upgrade_promo_cost', elem).html(cost);
				$j('.upgrade_promo_cost', elem).parent().show();
			}
			cost = cost - cost * promoMultiplier;
		} else {
			$j(elem).removeClass('downgrade upgrade').addClass('current');
			$j('.upgrade_cost_type', elem).html('');
			$j('.upgrade_title', elem).hide();
			$j('.upgrade_check', elem).show();
			var hasAction = false;
		}
		var raw_consumption_text = raw_consumption.replace('%%1%%', upgrade.raw_usage);
		$j(elem).attr('title', raw_consumption_text);
		$j('.upgrade_employee_limit', elem).html(upgrade.employees);
		$j('.upgrade_cost', elem).html(cost);
		if (hasAction) {
			$j('#upgrade_action_'+i).attr('companyId', companyId);
		}
		$j(elem).css('display', 'inline-block');
	}
}

var H = {
	has_active: false,
	isolate: function(element, message)
	{
		if (H.has_active) {
			return false;
		}
		H.has_active = true;
		var overlay = '<div class="bg_overlay"></div>';

		if (typeof message != 'undefined') {
			var overlayX = $j(element).offset().left;
			var overlayY = $j(element).offset().top - 90;

			var msg = '<div class="overlay_msg">' + message + '</div>';

			$j('body').append(msg);

			var msgX = ($j('.overlay_msg').width() - $j(element).width())/2;

			$j('.overlay_msg').css({
				'display':'none',
				'top':overlayY,
				'left':overlayX - msgX - 30
			})

			setTimeout(function(){
				$j('.overlay_msg').fadeIn();
			}, 300)

		}

		$j('body').append(overlay);
		$j(element).addClass('focused');

		return false;
	},
	restore: function(element)
	{
		if (H.has_active) {
			$j('.bg_overlay').remove();
			$j('.overlay_msg').remove();
			$j(element).removeClass('focused');
			H.has_active = false;
		}
	}
}

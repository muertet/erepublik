var energy = {
	shootLockout: 500,
	showEatTutorial: false,
	init: function() {
		if (typeof show_reset != 'undefined' && show_reset === true) {
			new ERPK.countDown({
				display: $j("#foodResetHours, #pop_timer"),
				startTime: new_date,
				stopTime: "00:00:00",
				onExpire: energy.healthCounterResetCallback
			});
			$j("#foodResetHoursContainer").css('display', 'block');
		}

		$j('#close_limit_health').click(function() {
			$j.unblockUI();
			return false;
		});

		if (typeof food_remaining != 'undefined') {
			$j('.tooltip_health_limit').html(food_remaining);
			$j('#DailyConsumtionTrigger').click(function() {
				Tutorial.restore($j('#DailyConsumtionTrigger'));
				$j('#tutorial_step_5').removeClass('showMessage');
				energy.eatFood();
			});
		}
	},

	healthCounterResetCallback: function(hours, mins, secs) {
		if (hours == 0 && mins == 0 && secs == 0) {
			i = $j('#DailyConsumtionTrigger');
			$j(".resetFoodContainer").hide();
			$j("#foodText").show();
			i.removeClass('reset');
			//military client stuff
			if (typeof(battleFX) != 'undefined') {
				var h = $j('#heal_btn');
				h.removeClass('health_kit_btn');
				h.addClass('food_btn');
			}

			if (globalNS.userInfo.wellness < food_remaining) {
				i.removeClass('disabled');
			}
			if (reset_has_food == 0) {
				i.removeClass('disabled');
				i.addClass('buy');
				$j("#foodText").html(textForBuy);
			}
			var t = food_remaining + 10;
			if (t >= reset_health_to_recover) {
				food_remaining = reset_health_to_recover;
				$j("#foodResetHoursContainer").css('display', 'none');
			} else {
				food_remaining = t;
				var a = new ERPK.countDown({
					display: $j("#foodResetHours"),
					startTime: "00:06:00",
					stopTime: "00:00:00",
					onExpire: energy.healthCounterResetCallback
				});
				$j("#foodResetHoursContainer").css('display', 'block');
			}
			$j('.tooltip_health_limit').html(food_remaining);
			energy.modifyHealth(globalNS.userInfo.wellness);
		}
	},

	eatFood: function() {
		var userHealth = globalNS.userInfo.wellness;

		if ($j('#DailyConsumtionTrigger').hasClass('disabled') && food_remaining == 0 && !$j('#DailyConsumtionTrigger').hasClass('energy')) {
			$j.blockUI({
				message: $j('#limit_health_pop'),
				overlayCSS: {
					backgroundColor: '#000207',
					opacity: 0.5
				},
				css: {
					width: '475px',
					height: '278px',
					top: ($j(window).height() - $j('#limit_health_pop').height()) / 2 + 'px',
					left: ($j(window).width() - 475) / 2 + 'px',
					textAlign: 'left'
				}
			});
		}

		if (!$j('#DailyConsumtionTrigger').hasClass('energy')) {
			if (userHealth > (reset_health_to_recover - 1) || food_remaining < 1) {
				return false;
			}
		}

		if (!$j('#DailyConsumtionTrigger').hasClass('disabled') && !$j('#DailyConsumtionTrigger').hasClass('buy')) {
			var hasConfirmed = true;
			var healthToRecover = reset_health_to_recover - userHealth;
			if ($j('#DailyConsumtionTrigger').hasClass("energy")) {
				if (healthToRecover >= 100) {
					hasConfirmed = true;
				} else {
					hasConfirmed = confirm(energy_confirm);
				}
			} else if (food_remaining < smallestFood.use) {
				hasConfirmed = confirm(eat_food_confirm.replace('%%1%%', smallestFood.q).replace('%%2%%', food_remaining));
			} else if (healthToRecover < smallestFood.use) {
				hasConfirmed = confirm(eat_food_confirm.replace('%%1%%', smallestFood.q).replace('%%2%%', healthToRecover));
			}
			if (hasConfirmed) {
				$j('#DailyConsumtionTrigger').addClass('load');
				var url = "http://" + hostname + "/" + culture;
				url += "/main/eat?format=json&_token=" + $j('#a69925ed4a6ac8d4b191ead1ab58e853').val() + "&jsoncallback=?";
				$j.getJSON(url, {}, function(data) {
					if (data.display_captcha) {
						ERPK.displayCaptcha();
					}
					setTimeout(function() {
						$j('#DailyConsumtionTrigger').removeClass('load');
					}, energy.shootLockout);
					energy.processResponse(data);
				});
			} else if (typeof(battleFX) != 'undefined') {
				ERPK.enableHealButton();
			}
		}
	},

	processResponse: function(data) {
		$j('#DailyConsumtionTrigger').removeClass('buy');
		//  $j('#DailyConsumtionTrigger').removeClass('disabled');
		$j('#DailyConsumtionTrigger').removeClass('warn_on');

		if (data.show_reset == true) {
			if (!$j('#DailyConsumtionTrigger').hasClass('reset')) {
				$j('#DailyConsumtionTrigger').addClass('reset');
				var a = new ERPK.countDown({
					display: $j("#foodResetHours"),
					startTime: data.food_remaining_reset,
					stopTime: "00:00:00",
					onExpire: energy.healthCounterResetCallback
				});
				$j("#foodResetHoursContainer").css('display', 'block');
				//$j(".resetFoodContainer").show();
				//$j("#foodText").hide();
			}
		}
		reset_has_food = data.has_food_in_inventory;
		data.health = parseFloat(data.health);
		smallestFood = data.lowest_quality_food;
		globalNS.userInfo.specialFoodAmount = data.hasSpecialFoodItem;
		//military client stuff
		if (typeof(battleFX) != 'undefined') {
			var t = data.health - SERVER_DATA.health;
			battleFX.updatePlayerStats(t, data.current_energy_ratio, data.remaining_energy_ratio);
			SERVER_DATA.health = data.health;
			if (data.health >= 10) {
				battleFX.healthWarning(false);
				setTimeout(

				function() {
					ERPK.enableAllButtons();
				}, energy.shootLockout);
			}
			if ( /*data.health == food_remaining*/ (reset_has_food < 1 && globalNS.userInfo.specialFoodAmount < 1) || (data.health == reset_health_to_recover)) {
				ERPK.disableHealButton();
			} else {
				setTimeout(

				function() {
					ERPK.enableHealButton();
				}, energy.shootLockout);
			}

			$j('#heal_btn').attr('title', BATTLE_TEXTS.consume_food ? BATTLE_TEXTS.consume_food : 'Consume Food');
			if (data.food_remaining == 0 && !$j('#heal_btn').hasClass('health_kit_btn') && data.specialFoodAmount < 1 && !energy.showEatTutorial) {
				$j('#heal_btn').removeClass('food_btn');
				$j('#heal_btn').addClass('health_kit_btn');
				$j('#heal_btn').attr('title', BATTLE_TEXTS.buy_health_kit ? BATTLE_TEXTS.buy_health_kit : 'Buy First Aid Kit');
				ERPK.disableHealButton();
				battleFX.healthLimit();
			}

		}

		food_remaining = parseFloat(data.food_remaining);
		energy.modifyHealth(data.health);

		$j('.tooltip_health_limit').html(data.food_remaining);

		healthValue = parseFloat($j('#current_health').html());

		if (energy.showEatTutorial) {
			energy.showEatTutorial = false;
			$j.post(giveFoodUrl, {
				_token: tokenValue
			}, function(data) {
				energy.applyFeedingEffects(data.feed);
			}, "json");
			Tutorial.activate(14);
			$j('#heal_btn').removeClass('energy');
			$j('#heal_btn').removeClass('health_kit_btn');
			$j('#heal_btn').addClass('food_btn');
			$j('#heal_btn').attr('title', BATTLE_TEXTS.consume_food);
			battleFX.healthWarning(false);
		} else {
			energy.applyFeedingEffects(data);
		}
	},

	modifyHealth: function(value) {
		if (value != globalNS.userInfo.wellness) {
			var go_num;
			var maxPercent = parseFloat(value / reset_health_to_recover * 100);
			globalNS.userInfo.wellness = value;

			$j('#health_bar_progress').gx({
				'width': maxPercent + '%'
			}, 800, 'Sine', {
				start: function() {
					go_num = setInterval(function() {
						var cur_percent = $j('#health_bar_progress').css('width');
						cur_percent = cur_percent.split("%")[0];
						cur_percent = cur_percent / 100 * reset_health_to_recover;
						$j('#current_health').html(parseInt(cur_percent) + ' / ' + reset_health_to_recover);
					}, 50);
				},
				complete: function() {
					clearInterval(go_num);
					$j('#current_health').html(value + ' / ' + reset_health_to_recover);
					if ($j('#isLandOverview').val() || $j('#isTrain').val()) {
						checkHealth();
					}
				}
			});
		}

		var health_back_progress = (value + food_remaining) / reset_health_to_recover * 100;
		if (health_back_progress > 100) {
			health_back_progress = 100;
		}
		$j('#health_back_progress').css('width', health_back_progress + '%');

		energy.applyFeedingEffects({
			has_food_in_inventory: reset_has_food,
			health: globalNS.userInfo.wellness,
			food_remaining: food_remaining,
			specialFoodAmount: globalNS.userInfo.specialFoodAmount
		});
	},

	applyFeedingEffects: function(data) {
		try {
			reset_has_food = data.has_food_in_inventory;
			var has_max_energy = data.health == reset_health_to_recover;
			var valid_for_energy = (data.food_remaining < 1 || data.has_food_in_inventory == 0) && data.specialFoodAmount > 0;
			var valid_for_food = data.food_remaining > 0 && data.has_food_in_inventory > 0;
			var show_warn = data.food_remaining < 50 && data.has_food_in_inventory >= 0;
			var show_disabled = has_max_energy || (data.food_remaining < 1 && !valid_for_energy);
			var show_buy = !valid_for_energy && !valid_for_food && !show_disabled;

			if (valid_for_energy) {
				hasSpecialItem = true;
				show_warn = false;
				show_buy = false;
			} else {
				hasSpecialItem = false;
				$j('#eatFoodTooltip > p:eq(0)').html($j('#valid_for_food_text').val());
			}
			energy.applyWarnStatus(show_warn);
			energy.applySpecialFoodStatus(hasSpecialItem);
			energy.applyBuyStatus(show_buy);
			energy.applyDisableStatus(show_disabled);
			if (data.health < food_remaining && $j('#heal_btn').hasClass('health_kit_btn')) ERPK.enableHealButton();

		} catch (e) {;
		}
	},

	applyWarnStatus: function(warn_status) {
		try {
			if (warn_status) {
				if (!$j('#DailyConsumtionTrigger').hasClass('warn_on')) {
					$j('#DailyConsumtionTrigger').addClass('warn_on');
				}
			} else if ($j('#DailyConsumtionTrigger').hasClass('warn_on')) {
				$j('#DailyConsumtionTrigger').remove('warn_on');
			}
		} catch (e) {;
		}
	},

	applyBuyStatus: function(buy_status) {
		try {
			if (buy_status) {
				$j('#DailyConsumtionTrigger').attr('href', linkForBuy);
				$j('#DailyConsumtionTrigger strong').html($j('#buy_food_text').val() ? $j('#buy_food_text').val() : 'Buy Food');
				$j('#DailyConsumtionTrigger').addClass('buy');
				energy.removeEnergy();
				$j('#eatFoodTooltip > p:eq(0)').html($j('#valid_for_buy_text').val());
				if ($j('#heal_btn') != 'undefined') {
					if (!$j('#heal_btn').hasClass('health_kit_btn')) {
						$j('#heal_btn').addClass('health_kit_btn');
						$j('#heal_btn').attr('title', $j('#buy_food_text').val() ? $j('#buy_food_text').val() : 'Buy Food');
					}
					if (typeof(battleFX) != 'undefined') {
						$j('#health_warning').fadeOut();
						battleFX.noFoodWarning();
					}
				}
			} else if ($j('#DailyConsumtionTrigger').hasClass('buy')) {
/*$j('#DailyConsumtionTrigger').removeClass('buy');
				$j('#DailyConsumtionTrigger').attr('href', 'javascript:;');
				$j('#DailyConsumtionTrigger strong').html('Eat');*/
			}
		} catch (e) {
			alert(e);
		}
	},

	removeEnergy: function() {
		try {
			$j('#DailyConsumtionTrigger').removeClass('energy');
			$j('#heal_btn').removeClass('energy');
		} catch (e) {;
		}
	},

	applySpecialFoodStatus: function(special_food_status) {
		try {
			if (special_food_status) {
				if (!$j('#DailyConsumtionTrigger').hasClass('energy')) {
					energy.addEnergy();
					$j('#eatFoodTooltip > p:eq(0)').html($j('#valid_for_energy_text').val());
				}
			} else if ($j('#DailyConsumtionTrigger').hasClass('energy') || $j('#heal_btn').hasClass('energy')) {
				energy.removeEnergy();
				$j('#DailyConsumtionTrigger strong').html($j('#eat_food_text').val() ? $j('#eat_food_text').val() : 'Recover Energy');
				$j('#DailyConsumtionTrigger').attr("href", 'javascript:;');
			}
		} catch (e) {;
		}
	},

	addEnergy: function() {
		try {
			var i = $j('#DailyConsumtionTrigger');
			var has_reset = i.hasClass('reset');
			i.removeClass();
			i.addClass('eat_food_wide');
			if (has_reset) {
				$j(".resetFoodContainer").hide();
				$j("#foodText").show();
				i.removeClass('reset');
			}
			i.addClass('energy');

			if (typeof(battleFX) != 'undefined') {
				closeNoFoodWarning();
				$j('#heal_btn').removeClass();
				$j('#heal_btn').addClass('food_btn');
				$j('#heal_btn').addClass('energy');
				$j('#heal_btn').attr('title', BATTLE_TEXTS.cosume_energy_bar_text ? BATTLE_TEXTS.cosume_energy_bar_text : 'Consume Energy Bar');
			}

			$j('#DailyConsumtionTrigger strong').html($j('#eat_energy_text').val() ? $j('#eat_energy_text').val() : 'Energy Bar');
			$j('#DailyConsumtionTrigger').attr("href", 'javascript:;');
		} catch (e) {;
		}
	},

	applyDisableStatus: function(disable_status) {
		try {
			if (disable_status) {
				$j('#DailyConsumtionTrigger').removeClass('load');
				$j('#DailyConsumtionTrigger').addClass('disabled');
				$j('#heal_btn').not('.health_kit_btn').not('.energy').addClass('disabled');
				//$j('#DailyConsumtionTrigger').unbind('click');
				//ERPK.disableHealButton();
			} else if ($j('#DailyConsumtionTrigger').hasClass('disabled')) {
				$j('#DailyConsumtionTrigger').removeClass('disabled');
				$j('#heal_btn').removeClass('disabled');
			}
		} catch (e) {;
		}
	}
};

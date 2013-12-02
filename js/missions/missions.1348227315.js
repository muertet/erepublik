var solveInProgress = 0;
var unlockInProgress = 0;
var checkInProgress = 0;
missionObj = function(divId, isNew, mission)
{
	this.divId				= divId;
	this.isNew				= isNew;
	this.missionId			= mission.id;
	this.title				= mission.title;
	this.description		= mission.description;
	this.rewards			= mission.rewards;
	this.conditions			= mission.conditions;
	this.conditionsUnlock	= mission.conditionsUnlock;
	this.hint				= mission.hint;
	this.img				= mission.img;
	this.partial			= mission.partial;
	this.gold				= 0;
	this.isHighlighted		= false;
	this.isOld				= mission.isOld;
	this.type				= mission.type;
	this.conditionIcons		= mission.conditionIcons;
	this.actionId			= '#maction_'+this.divId+'_'+this.missionId;
	this.contentId			= '#mcontent_'+this.divId+'_'+this.missionId;
	this._token				= csrfToken;
	this.showReward			= mission.show_reward;
	this.rewardsIds			= {
		'military_skill':		'mskill',
		'experience_points':	'xp',
		'military_rank':		'mrank',
		'health':				'health',
		'energy_bar':			'energy',
		'gold':					'gold',
		'money':				'money',
		'land': 				'land',
		'collection_parts': 	'collection_parts',
		'bazooka': 				'bazooka',
		'weapon_q1':			'q1weapon',
		'weapon_q2':			'q2weapon',
		'weapon_q5': 			'q5weapon',
		'weapon_q6': 			'q6weapon',
		'food_q1':				'q1food',
		'food_q2': 				'q2food',
		'food_q5': 				'q5food',
		'food_raw':				'food_raw',
		'weapon_raw':			'weapon_raw',
		'grain_farm':			'grain',
		'iron_mine':			'iron',
		'top_player': 			'elite_ach',
		'damage': 				'damage',
		'toolbox': 				'toolbox',
		'rank_percent': 		'mrank',
		'storage': 				'storage',
		'hit_damage_rank':      'mrank',
		'free_train': 			'free_train',
		'bomb': 				'bomb',
		'rocket': 				'rocket',
		'bazooka_booster': 		'bboster'
	}
	this.hasBeenChecked		= false;
	this.missionData		= null;

	this.updateMoney = function(money)
	{
		if ($j('.citizenship_currency_amount').html()) {
			$j('.citizenship_currency_amount strong').html(money);
		} else {
			$j('.currency_amount strong').html(money);
		}
	}

	this.updateGold = function(gold)
	{
		$j('#side_bar_gold_account_value').html(gold);
	}

	this.hasMoney = function(conditionId)
	{
		var cost = this.conditionsUnlock[conditionId];
		if (cost > 0) {
			if (this.gold < cost) {
				return false;
			}
		}
		return true;
	}

	this.getCulture = function()
	{
		return culture;
	}

	this.getUrl = function(what)
	{
		var url = 'http://' + mainHost + '/' + this.getCulture();
		if (what == 'check') {
			url += '/main/mission-check';
		} else if (what == 'solve') {
			url += '/main/mission-solve';
		} else if (what == 'unlock') {
			url += '/main/mission-unlock';
		}
		if (isJsonP == true) {
			url += "?format=json&jsoncallback=?";
		}
		return url;
	}

	this.rankPopup = function()
	{
		var rankName      = this.rank.name;
		var stars         = this.rank.stars;
		var img			  = this.rank.img;
		var s = '', i;
		for(i = 1; i <= stars; i++){
			s = s + '*';
		}
		$j('#mission_rank_name').html(rankName+' '+s);
		$j('.mission_rank_img').attr('src', img);
		$j.blockUI({
			message: $j('#mission_rank_popup'),
			overlayCSS: {
				backgroundColor: '#FFF',
				opacity: 0.8
			},
			css: {
				width: '396px',
				height: '398px'
			}
		});
	}

	this.closePopup = function()
	{
		$j('#mission_link_'+this.missionId).removeClass('selected');
		$j.unblockUI();
		if (this.missionId == 31 && $j('#blockLand').val()) {
			setTimeout(function(){highlight($j('ul.land_holder li:eq('+SERVER_DATA.foodPosition+')'))}, 100);
		}
		if ($j('#isFightMain').val()) {
			var c_hash = getCHash();
			if (parseInt(this.missionId) == 43 && !$j.cookie('fightMission2' + c_hash)) {
				Set_Cookie('fightMission2' + c_hash, 1, 30, '/', '.erepublik.com', false);
				battleFX.pop('m2complete', 474);
				SERVER_DATA.mission2Completed = false;
			} else if (parseInt(this.missionId) == 42 && !$j.cookie('fightMission1' + c_hash)) {
				Set_Cookie('fightMission1' + c_hash, 1, 30, '/', '.erepublik.com', false);
				battleFX.pop('m1complete', 474);
				SERVER_DATA.mission1Completed = false;
			} else if (parseInt(this.missionId) == 41) {

			}
		}
	}

	this.nextMission = function(data, hasNewMissions)
	{
		var instance = this;
		if (instance.missionId == 30 && $j('#isLandOverview').val()) {
			window.location.reload();
			return;
		}
		$j.unblockUI();
		setTimeout(function(){
			if (instance.highlight) {
				instance.clearHighlight();
			}
			if (data.rankLevelUp) {
				//addEnergy();
				instance.rank = data.rank;
				instance.rankPopup();
				$j('#mission_rank_popup_ok').click(function(){
					$j.unblockUI();
					setTimeout(function(){
						if (hasNewMissions == 0) {
							$j('#sidebar_missions').remove();
                            globalNS.updateSideBar(data.details);
						} else {
							currentMissions.initMissions(data.missions, data.hasAwards);
							currentMissions.render();
						}
                        globalNS.updateSideBar(data.details);
						if (data.hasAwards == true) {
                            if (SERVER_DATA.level < data.details.level) {
                                if ($j('#isFightMain').val()) {
                                    ERPK.enableFightButtons();
                                    battleFX.updatePlayerStats(data.details.wellness - SERVER_DATA.health, data.details.current_energy_ratio, data.details.remaining_energy_ratio);
                                }
                            }
							instance.awardPopup();
						}
					}, 600)
				});
			} else {
				if (hasNewMissions == 0) {
					$j('#sidebar_missions').remove();
					globalNS.updateSideBar(data.details);
				} else {
					currentMissions.initMissions(data.missions, data.hasAwards);
					currentMissions.render();
				}
				globalNS.updateSideBar(data.details);
				if (data.hasAwards == true) {
                    if (SERVER_DATA.level < data.details.level) {
                        if ($j('#isFightMain').val()) {
                            ERPK.enableFightButtons();
                            battleFX.updatePlayerStats(data.details.wellness - SERVER_DATA.health, data.details.current_energy_ratio, data.details.remaining_energy_ratio);
                        }
                    }
					instance.awardPopup();
				}
			}
			var reward = '';
			for (var i in instance.rewards) {
				reward = instance.rewards[i];
				if (reward.category == 'energy_bar') {
					//addEnergy();
				}
			}
			if (instance.missionId == 43 && $j('#isHomepage').val()) {
				//showDailyBonus(true);
			}
			if (instance.missionId == 31 && $j('#isLandOverview').val()) {
				$j('li.free_land:lt(1)').show();
			}
			if (instance.missionId == 43) {
				if ($j('#isFightMain').val()) {
					if (SERVER_DATA.mission3Completed) {
						battleFX.pop('complete_training', 474);
						SERVER_DATA.mission3Completed = false;
						return false;
					}
				} else {
					showCompleteTrainingPopUp();
				}
			}
		}, 600);
	}

	this.solveMission = function()
	{
		var instance = this;
		if (solveInProgress == 1) {
			return false;
		}
		solveInProgress = 1;

		var c_hash = getCHash();
		var url = this.getUrl('solve');
		$j.getJSON(url, {missionId: this.missionId, _token: this._token}, function(data){
            if (data.finished == true) {
				Set_Cookie('new_mission' + c_hash, 0, 30, '/', '.erepublik.com', false);
				if ($j.cookie('progress' + c_hash)) {
					Set_Cookie('progress' + c_hash, 0, 30, '/', '.erepublik.com', false);
				}
				if ($j.cookie('complete' + c_hash)) {
					Set_Cookie('complete' + c_hash, 0, 30, '/', '.erepublik.com', false);
				}
				instance.populate(instance.missionData);
				$j('#mission_status').addClass('reward');
				$j('#mission_status a.hint').hide();
				$j('#mission_status a.get_reward').unbind('click');
				$j('#mission_status a.get_reward').click(function() {
					instance.nextMission(data, 0);
				});
				$j('#mission_status a.close').unbind('click');
				$j('#mission_status a.close').click(function() {
					instance.nextMission(data, 0);
				});
				instance.updateMoney(data.money);
			} else if (data.missions) {
				Set_Cookie('new_mission' + c_hash, 0, 30, '/', '.erepublik.com', false);
				if ($j.cookie('progress' + c_hash)) {
					Set_Cookie('progress' + c_hash, 0, 30, '/', '.erepublik.com', false);
				}
				if ($j.cookie('complete' + c_hash)) {
					Set_Cookie('complete' + c_hash, 0, 30, '/', '.erepublik.com', false);
				}
				instance.populate(instance.missionData);
				$j('#mission_status').addClass('reward');
				$j('#mission_status a.hint').hide();
				$j('#mission_status a.get_reward').unbind('click');
				$j('#mission_status a.get_reward').click(function() {
					instance.nextMission(data, 1);
				});
				$j('#mission_status a.close').unbind('click');
				$j('#mission_status a.close').click(function() {
					instance.nextMission(data, 1);
				});
				instance.updateMoney(data.money);
			} else {
				instance.checkMission(true);
			}

			solveInProgress = 0;
		});
		return true;
	}

	this.awardPopup = function()
	{
		var url = 'http://';
		if (isJsonP == true) {
			url += economyhostname + '/' + this.getCulture() + '/awards-popup';
		} else {
			url += hostname + '/' + this.getCulture() + '/main/awards-popup';
		}
		$j.get(url, function(data){
			$j('#award_pop_up_ajax').empty();
			$j('#award_pop_up_ajax').append(data);
			nextAward();
		});
	}

	this.unlockFeature = function(featureId)
	{
		if (unlockInProgress == 1) {
			return false;
		}
		unlockInProgress = 1;
		var instance = this;
		var url = this.getUrl('unlock');
		$j.getJSON(url, {
			missionId: this.missionId,
			conditionId: featureId,
			_token: this._token},
		function(data){
			if (data.msg == 'success') {
				instance.missionData = data;
				if (data.isFinished == 1) {
					instance.solveMission();
				} else {
					instance.populate(data);
				}
				instance.updateGold(data.gold);
			}
			unlockInProgress = 0;
		});
		return true;
	}

	this.showUnlock = function(conditionId)
	{
		var instance = this;
		var mcontent = $j('#mission_status');
		var li = mcontent.find('li.condition'+conditionId);
		var unlockCost = li.find('.actions a:eq(0)');
		unlockCost.attr('id', 'mission'+instance.missionId+'condition_'+conditionId);
		var unlockCostHtml = instance.conditionsUnlock[conditionId] + ' ' + unlock_cost_text;
		unlockCost.html(unlockCostHtml);
		unlockCost.unbind('click');
		if (!instance.hasMoney(conditionId)) {
			unlockCost.click(function(){
				$j('.mission_error').show();
			});
		} else {
			unlockCost.click(function(){
				var id = $j(this).attr('id').split('_');
				id = id[1];
				var goldConfirm = missions_unlock_confirm;
				var goldCost = instance.conditionsUnlock[conditionId];
				goldConfirm = goldConfirm.replace('%%1%%', goldCost);
				if (confirm(goldConfirm)) {
					instance.unlockFeature(id);
				}
			});
		}
		unlockCost.show();
	}

	this.showRewards = function()
	{
		var instance = this;
		var mcontent = $j('#mission_status');
		mcontent.find('div.reward table div').hide();
		var td = mcontent.find('div.reward table td');
		td.empty();
		for (var i in instance.rewards) {
			var reward = instance.rewards[i];
			var rewardId = instance.rewardsIds[reward.category];
			var val = reward.value;
			var basediv = $j('#rewards_text div.'+rewardId);
			var div = basediv.clone();
			if (rewardId == 'damage' || reward.category == 'rank_percent') {
				val = val + '%';
			}
			if (rewardId != 'free_train') {
				div.find('strong').html('+' + val);
			}
			if (instance.missionId == 31 && rewardId == 'land') {
				div.find('small').html('Free Land');
			}
			div.appendTo(td);
			div.show();
		}
	}

	this.showMission = function(popup) {
		$j.blockUI({
			message: popup,
			css: {
				width: '632px',
				top:  ($j(window).height() - popup.height()) / 2 + 'px',
				left: ($j(window).width() - 632) / 2 + 'px'
			}
		});
	}

	this.populate = function(data)
	{
		var instance = this;
		var c_hash = getCHash();
		$j('body').append($j('#mission_status'));
		var mcontent = $j('#mission_status');
		mcontent.removeClass();
		mcontent.addClass('mission_pop');
		mcontent.addClass(instance.type);
		instance.gold = data.gold;
		mcontent.find('h3 img').attr('src', this.img);
		mcontent.find('h3 b').html(this.title);
		mcontent.find('em').html(this.description);
		mcontent.find('li').hide();
		mcontent.find('.mission_pic').hide();
		$j('.mission_error').hide();
		var isCompleted = 1;
		for (var i in data.conditions) {
			i = parseInt(i);
			var cond = data.conditions[i];
			if (cond) {
				var li = mcontent.find('li').eq(i);
				if (i == data.conditions.length-1) {
					li.addClass('nobg');
				} else {
					li.removeClass('nobg');
				}
				li.find('q').hide();
				li.addClass('condition'+i);
				li.find('strong').html(instance.conditions[i]);
				li.children('.actions').hide();
				li.find('small').html('');
				li.find('small').hide();
				li.find('a.hint').hide();
				li.removeClass('image_full');
				if (cond.condition == 0) {
					if (cond.partial) {
						var partialText = '';
						var partialText2 = '';
						if (instance.partial[i].constructor.toString().indexOf('Array') > -1) {
							partialText = instance.partial[i][0];
							partialText2 = instance.partial[i][1];
						} else {
							partialText = instance.partial[i];
						}
						var partial = cond.partial;
						var html = partial[0] + '/' + partial[1];
						var html_tooltip = partial[0] + '/' + partial[1] + ' ' + partialText;
						if (instance.missionId == 76) {
							html = partial[1];
							html_tooltip = partial[1] + ' ' + partialText;
						}
						if (instance.missionId == 78) {
							html = partial[1];
						}

						if (partial.length > 2) {
							html += '<img src="http://' + mainHost + '/images/modules/myland/qsep.png" alt=""/>' + partial[2] + '/' + partial[3];
							html_tooltip += ' ' + partial[2] + '/' + partial[3] + ' ' + partialText2;
						}
						if (instance.missionId == 84 && partial[0]>0) {
							$j('#mission_84_tooltip ul').empty();
							var li_tip = '';
							$j.each(cond.tooltip, function(idx, n){
								if (n.completed) {
									li_tip = '<li class="completed">';
								} else {
									li_tip = '<li>';
								}
								li_tip += '<img src="http://'+hostname+'/images/flags_png/S/'+n.permalink+'.png" alt=""/>';
								li_tip += '<small>'+n.initials+'</small>';
								if (n.completed) {
									li_tip += '<em>5/5</em>';
								} else {
									li_tip += '<em>'+n.kills+'/5</em>';
								}
								li_tip += '</li>';
								$j('#mission_84_tooltip ul').append(li_tip);
							});
							$j('#mission_84_tooltip p.condition').html(instance.conditions[i]);
							$j('#mission_84_tooltip big strong').html(html);
							$j('#mission_84_tooltip').show();
							$j('ul.achiev li').show();
						}

						li.find('q').attr('title', html_tooltip);
						li.find('q').html(html);
						li.find('q').show();
						if (partial[0] > 0) {
							Set_Cookie('progress' + c_hash, 1, 30, '/', '.erepublik.com', false);
							if(parseInt(this.missionId) == 15) {
								Set_Cookie('progress_15' + c_hash, 0, 30, '/', '.erepublik.com', false);
							}
						}
						li.children('.actions').show();
						li.find('a.req_unlock').hide();
					}
					li.removeClass('complete');
					li.addClass('incomplete');
					if (instance.conditionsUnlock[i]>0 || instance.missionId==85) {
						li.children('.actions').show();
						instance.showUnlock(i);
					}
					isCompleted = 0;
					var link = instance.hint.links[i];
					li.find('a.hint').hide();
					if (link) {
						li.find('a.hint').unbind('click');
						li.find('a.hint').html(link.link);
						li.find('a.hint').unbind('click');
						if (link['is_land'] && $j('#isLandOverview').val()) {
							if (instance.missionId == 31 || instance.missionId == 30) {
								li.find('a.hint').html(MISSIONS_TEXTS.work_text ? MISSIONS_TEXTS.work_text : 'Work');
							}
							li.find('a.hint').click(function(){
								instance.closePopup();
							})
						} else if (link['is_battle'] && ($j('#isFightMain').val() || $j('#isBattleList').val())) {
							li.find('a.hint').html(MISSIONS_TEXTS.fight_text ? MISSIONS_TEXTS.fight_text : 'Fight');
							li.find('a.hint').click(function(){
								instance.closePopup();
							})
						} else if (link['is_train'] && $j('#isTrain').val()) {
							li.find('a.hint').html(MISSIONS_TEXTS.train_text ? MISSIONS_TEXTS.train_text : 'Train');
							li.find('a.hint').click(function(){
								instance.closePopup();
							})
						} else {
							li.find('a.hint').attr('href', link.url);
						}
						li.find('a.hint').show();
					}
				} else if (cond.condition == 1 || cond.condition == 'unlock') {
					li.removeClass('incomplete');
					li.addClass('complete');
					Set_Cookie('progress' + c_hash, 1, 30, '/', '.erepublik.com', false);
				}
				var hint = instance.hint.hints[i];
				var hintTxt = li.find('small').html();
				if (hint) {
					if (hintTxt) {
						hintTxt += '&nbsp;';
					}
					li.find('small').html(hintTxt+hint);
					li.find('small').show();
				}

				if (instance.conditionIcons && instance.conditionIcons[i]) {
					li.addClass('image_full');
					var condNo = i+1;
					li.find('img.mission_pic').attr('src', 'http://' + mainHost + '/images/modules/missions/' + instance.missionId + '_' + condNo + '.png').show();
				}
				li.show();
			}
		}
		if (isCompleted == 1 || instance.showReward == 1) {
			if ($j.cookie('complete' + c_hash)) {
				Set_Cookie('complete' + c_hash, 0, 30, '/', '.erepublik.com', false);
			}
			if ($j.cookie('progress' + c_hash)) {
				Set_Cookie('progress' + c_hash, 0, 30, '/', '.erepublik.com', false);
			}
			mcontent.find('div.reward').show();
			instance.showRewards();
		} else {
			mcontent.find('div.reward').hide();
		}
		$j('#mission_status a.close').unbind('click');
		$j('#mission_status a.close').click(function() {
			instance.closePopup();
		});
		checkInProgress = 0;
		instance.showMission(mcontent);
	}

	this.checkMission = function(forced)
	{
		if (!forced) {
			if (this.missionId == 34) {
				forced = true;
			}
		}
		if (this.hasBeenChecked == true && !forced) {
			this.populate(this.missionData);
		} else {
			var instance = this;
			var url = this.getUrl('check');
			$j.getJSON(url, {missionId: this.missionId, _token: this._token}, function(data){
				instance.hasBeenChecked = true;
				instance.missionData = data;
				if (data.isFinished == 1) {
					instance.solveMission();
				} else {
					instance.populate(data);
				}
			});
		}
		return true;
	}

	this.activateMission = function()
	{
		var instance = this;
		var link = $j('#mission_link_'+this.missionId);

		if (link.hasClass('selected')) {
			link.removeClass('selected');
			$j.unblockUI();
		} else {
			$j('a.mission_link').removeClass('selected');
			link.addClass('selected');
			if (checkInProgress == 1) {
				return false;
			}
			checkInProgress = 1;
			var isFightMain = $j('#isFightMain').val();
			var isLandOverview = $j('#isLandOverview').val();
			var force = false;
			if (isFightMain || isLandOverview || instance.missionId == 92) {
				force = true;
			}
			instance.checkMission(force);
		}
		var c_hash = getCHash();
		if ($j.cookie('new_mission' + c_hash) == 0) {
			Set_Cookie('new_mission' + c_hash, 1, 30, '/', '.erepublik.com', false);
		}
		if ($j.cookie('complete' + c_hash) == 0) {
			Set_Cookie('complete' + c_hash, 1, 30, '/', '.erepublik.com', false);
		}
		$j('.mission_bubble').hide();
		return true;
	}

	this.getLink = function()
	{
		var link = $j('<a href="javascript:;" class="mission_link" id="mission_link_'+this.missionId+'" style="display:none;"><img src="'+this.img+'" /></a>');
		var instance = this;
		link.unbind('click');
		link.click(function(){
			Tutorial.restore($j('.mission_link'));
			if (typeof(SERVER_DATA) != 'undefined'){
				SERVER_DATA.tutorial = false;
			}
			$j('#tutorial_step_6').removeClass('showMessage');
			try {
				if (instance.missionId == 41 || instance.missionId == 42 || instance.missionId == 43) {
					hideCompleteBubble();
				}

				instance.activateMission();
				if(instance.missionId == 31) {
					var c_hash = getCHash
					Set_Cookie('mission_activated' + c_hash, 1, 30, '/', '.erepublik.com', false);
					//$j('#mission_arrow').attr('src', 'http://'+mainHost+'/images/modules/sidebar/arrow_notify.png');
				}
			} catch(e) {;}
		});
		return link;
	}

	this.highlight = function()
	{
		var link = $j('#mission_link_'+this.missionId);
		var highlight = new highlightMission(link);
		highlight.on();
		this.isHighlighted = true;
	}

	this.clearHighlight = function()
	{
		if (this.isHighlighted) {
			var link = $j('#mission_link_'+this.missionId);
			var highlight = new highlightMission(link);
			highlight.off();
		}
	}

	this.warnOn = function(nr)
	{
		var link = $j('#mission_link_'+this.missionId);
		var point = $j('#point');
		if (point.css('display') == "none" && this.isOld == 1) {
			if(!$j.browser.webkit) {
				setInterval(function(){
					if(point.hasClass('xsmall')) {
						point.removeClass('xsmall').addClass('xbig');
					} else {
						point.removeClass('xbig').addClass('xsmall');
					}
				}, 1000);
			}
			link.append(point);
			point.show();
		}
	}

	this.warnOff = function()
	{
		$j('#point').hide();
	}
}
missionList = function(missionsJSON)
{
	this.cnt			= 0;
	this.missionsJSON	= missionsJSON;
	this.missions		= [];
	this._token			= csrfToken;
	this.missionIds		= [];

	this.addMissionId = function(id)
	{
		if (!this.missionIds[id]) {
			this.missionIds.push(id);
		}
	}

	this.isNewMission = function(id)
	{
		for (var i=0; i<this.missionIds.length; i++){
			if (this.missionIds[i] == id) {
				return false;
			}
		}
		return true;
	}

	this.addMission = function(mission)
	{
		this.missions.push(mission);
		this.cnt++;
	}

	this.removeMission = function(nr)
	{
		this.cnt--;
		this.missions.splice(nr, 1);
	}

	this.emptyMissions = function()
	{
		this.cnt = 0;
		this.missions = [];
	}

	this.initMissions = function(missions, hasAwards)
	{
		this.emptyMissions();
		var instance = this;
		var nr = 0;
		var c_hash = getCHash();
		$j.each(missions, function(i, oneMission){
			var isNew = 0;
			if (instance.isNewMission(oneMission.id)) {
				if($j.inArray(parseInt(oneMission.id), [30]) >= 0 && parseInt($j.cookie('new_mission' + c_hash)) == 0) {
					if (hasAwards) {
						if (!$j('#showNewMissionBubble').val()) {
							$j('body').append('<input type="hidden" value="true" id="showNewMissionBubble" />');
						}
					} else {
						popNewMissionBubble();
					}
				}
				isNew = 1;
			}
			instance.addMissionId(oneMission.id);
			var newMission = new missionObj(nr, isNew, oneMission);
			instance.addMission(newMission);
			nr++;
		});
	}

	this.render = function()
	{
		var div = $j('#sidebar_missions');
		var divContent = $j('.mission_holder', div);
		$j('a', divContent).remove();
		var missions = this.missions;
		$j('#sidebar_missions a').hide();
		var nr = 1;
		$j('#point').hide();
		$j.each(missions, function(i, mission){
			divContent.append(mission.getLink());
			if (parseInt(mission.missionId) === 31 && missions.length === 1) {
				mission.highlight()
			} else {
				mission.clearHighlight();
				mission.warnOn(nr);
			}
			nr++;
		});
		$j('#sidebar_missions a').fadeIn();
	}

	this.remove = function()
	{
		$j('.missionDiv').hide();
	}

	this.initMissions(this.missionsJSON, false);
	this.render();
}

highlightMission = function(link){
	this.link = link;
	this.on= function() {
		this.link.addClass('first');
		$j('#sidebar_missions').addClass('highlight');
		//var flares = $j('.flares');
		//var arrow = $j('#mission_arrow');
		//this.link.append(flares);
		//this.link.append(arrow);
		//flares.show();
		//arrow.show();
		setInterval(function(){
			$j('#flare_left').gx({'opacity':'0'}, 800, 'Sine')
							 .gx({'opacity':'1'}, 800, 'Sine');
			$j('#flare_right').gx({'opacity':'1'}, 800, 'Sine')
							  .gx({'opacity':'0'}, 800, 'Sine');
		}, 1600);
		setInterval(function(){
			$j('#mission_arrow').gx({'left':'40px'}, 400, 'Quad')
								.gx({'left':'55px'}, 400, 'Quad');
		}, 800);
	}
	this.off = function() {
		this.link.removeClass('first');
		$j('#sidebar_missions').removeClass('highlight');
		$j('.flares', this.link).hide();
		$j('.mission_arrow', this.link).hide();
	}
};

function popNewMissionBubble() {
	setTimeout(function() {
		$j('.mission_bubble > strong').text('New missions');
		$j('.mission_bubble > p').text('Look constantly for new missions, they are the key in your way to progress.');
		$j('.mission_bubble').show();
	}, 300);
}

function popCompleteBubble() {
	setTimeout(function() {
		$j('.mission_bubble > strong').text('Click to complete');
		$j('.mission_bubble > p').text('Whenever you feel the requirements are met, click to get your reward.');
		$j('.mission_bubble').show();
	}, 300);
}
function hideCompleteBubble() {
	$j('.mission_bubble').hide();
}


function showDailyBonus()
{
	$j.getJSON('http://' + mainHost + '/' + culture + '/main/daily-bonus?format=json&jsoncallback=?', {}, function(data){
		updateDailyBonus(data, false);
	});
}

function getCHash()
{
	var c_hash = ''
	try {
		c_hash = $j('#c_hash').val();
	} catch(e) {;}
	return c_hash;
}

function showCompleteTrainingPopUp()
{
	$j.blockUI({
		message: $j('#complete_training'),
		overlayCSS: {
			backgroundColor: '#000207',
			opacity: 0.5
		},
		css: {
			width: '474px',
			height: '398px'
		}
	});
}

$j(document).ready(function() {
    if(typeof missionsJSON != 'undefined') {
        currentMissions = new missionList(missionsJSON);
    }

	$j('#mission_achiev').hover(
	  function () {
	  	$j(this).css('display', 'block');
	  },
	  function () {
	    $j(this).css('display', 'none');
	  }
	);

	$j('#first_q').hover(
	  function () {
	  	$j(this).css('z-index', '100000');
	    $j('#mission_achiev').css('display', 'block');
	  },
	  function () {
	    $j('#mission_achiev').css('display', 'none');
	    $j(this).css('z-index', '10');
	  }
	);

});

<?php

	$products=ApiCaller::get('product/list');
	$products=$products->data;
	
	$resources=ApiCaller::get('resource/list');
	$resources=$resources->data;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:og="http://ogp.me/ns#"
  xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

    <meta property="fb:admins" content="100001950649351" />
    <meta property="fb:app_id" content="202930519772507" />     
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="keywords" content="e-sim, mmog, browser game, free game, multiplayer game, social game"/>
    <meta name="description" content="Free strategic browser game. Fight, earn money, manage businesses"/>
    <meta property="og:site_name" content="e-Sim"/>
    <base href="http://<?=Config::get('domain');?>/">
    
    
    <meta http-equiv="Last-Modified" content="2013-12-08 12:58:57" />
    <meta property="og:image" content="images/PrimeraLogo.png"/>
    <meta property="og:description" content="Free strategic browser game. Fight, earn money, manage businesses. Join us, let's have some fun together, help your ecountry to grow."/>
    

    <link href="css/jquery-ui-1.9.2.custom.min.css" type="text/css" rel="stylesheet">
    <link href="css/foundation-min.css" type="text/css" rel="stylesheet">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="js/custom.modernizr.js"></script>
	
    <link rel="icon" type="image/png" href="images/favicon.png"/>

    <title>e-sim - Free MMOG browser game </title>      
</head>

	<body style="background: url(images/loggedBackground.jpg) no-repeat fixed;background-size:cover;">
		<div id="container" class="foundation-style row lightback2 foundation-radius">

		<div id="citizenMessage" style="display:none;">
			<div>El shout fue enviado. Aparecerá en un momento</div>
			<span style="font-size: small">(click para cerrar)</span>
		</div>
		
<div class="foundation-on"></div>
		<div class="fixed foundation-style">
			<nav class="top-bar">
				 <ul class="title-area">
				    <!-- Title Area -->
				    <li class="name">
				      <h1><a id="indexShortcut" href="index.html"><img style="width:40px;margin:3px;" src="images/bestEsim.png" ></a></h1>
				    </li>
				    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				 </ul>
				
				 <section class="top-bar-section">
				    <!-- Left Nav Section -->
				    <ul class="foundation-left">
				      <li class="divider"></li>
				      <li class="has-dropdown"><a id="myPlaces" href="#"><i class="icon-home"></i>My places</a>
				        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
						  <li><a href="work.htm"><i class="icon-user-3"></i>Work</a></li>
						  <li><a href="train.htm"><i class="icon-scope"></i>Train</a></li>
						  <li><a href="equipment.html"><i class="icon-dagger"></i>Equipment</a></li>
						  <li><a href="companies.htm"><i class="icon-factory"></i>Companies</a></li>
						  <li><a href="newspaper.html"><i class="icon-insertpictureleft"></i>Newspaper</a></li>
						  <li><a href="myParty.html"><i class="icon-friends"></i>Party</a></li>
						  <li><a href="contracts.html"><i class="icon-sc"></i>Contracts</a></li>
						  <li><a href="myShares.html"><i class="icon-wallet"></i>Shares</a></li>
						  <li><a href="myAuctions.html"><i class="icon-law"></i>Auctions</a></li>
						  <li><a href="inviteFriends.html"><i class="icon-addfriend"></i>Invite friends</a></li>
						  <li><a href="myMilitaryUnit.html"><i class="icon-bookmark"></i>Military unit</a></li>
						  
                          <li class=""><a href="subscription.html"><i class="icon-star"></i>Premium account</a></li>
						  
                            <li class=""><a href="goldPurchase.html"><i class="icon-moneybag"></i>Buy gold</a></li>
						  
						  
							<li class=""><a href="bonusGold.html"><i class="icon-piggybank"></i>Bonus gold</a></li>
						  	
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li id="numero4" class="has-dropdown"><a id="menuMarket" href="#"><i class="icon-value"></i>Market</a>
				        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
							<li><a href="productMarket.html"><i class="icon-diamond"></i>Product market</a></li>
							<li class=""><a href="jobMarket.html"><i class="icon-tie"></i>Job market</a></li>
							<li><a href="monetaryMarket.html"><i class="icon-cash"></i>Monetary market</a></li>
							<li><a href="auctions.html"><i class="icon-law"></i>Auctions</a></li>
							<!-- <a href="stockMarket.html"><i class="icon-stocks"></i>Stock market</a></li> -->
							<li class=""><a href="companiesForSale.html"><i class="icon-factory"></i>Companies for sale</a></li>
							<li><a href="specialItems.html"><i class="icon-lightning2"></i>Special items</a></li>
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a id="statisticsMenu" href="#"><i class="icon-statistics"></i>Statistics</a>
				        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
							<li><a href="countryStatistics.html"><i class="icon-earth"></i>Country statistics</a></li>
							<li><a href="partyStatistics.html"><i class="icon-timeline"></i>Party statistics</a></li>
							<li><a href="newspaperStatistics.html"><i class="icon-barchart"></i>Newspaper statistics</a></li>
							<li><a href="citizenStatistics.html"><i class="icon-podium"></i>Citizen statistics</a></li>
                                                        <li><a href="newCitizenStatistics.html"><i class="icon-cupcake"></i>New Citizen statistics</a></li>
							<li><a href="militaryUnitStatistics.html"><i class="icon-warmedal"></i>Military unit stats</a></li>
							<li><a href="stockCompanyStatistics.html"><i class="icon-stocks"></i>Stock market stats</a></li>
							<li><a href="donations.html"><i class="icon-gift"></i>Donations</a></li>
							
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a href="#"><i class="icon-document"></i>News</a>
				        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
							<li><a href="news.html?newsType=TOP_ARTICLES"><i class="icon-news"></i>Top articles</a></li>
							<li><a href="news.html?newsType=LATEST_ARTICLES"><i class="icon-appointment"></i>Latest articles</a></li>
							<li><a href="news.html?newsType=HYDEPARK"><i class="icon-vendetta"></i>Hydepark</a></li>
							<li><a href="events.html?eventsType=MILITARY_EVENTS"><i class="icon-danger"></i>Military events</a></li>
							<li><a href="events.html?eventsType=POLITICAL_EVENTS"><i class="icon-director"></i>Political events</a></li>
							<li><a href="shouts.html"><i class="icon-bubbles-2"></i>Shouts</a></li>
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a href="#"><i class="icon-flag-2"></i>Country</a>
				        <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">« Back</a></h5></li>
							<li><a href="battles.html"><i class="icon-cannon"></i>Battles</a></li>
                                                        <li><a href="tournamentEvents.html"><i class="icon-trophy"></i>Events</a></li>
							<li><a href="countryPoliticalStatistics.html"><i class="icon-tank"></i>War and politics</a></li>
							<li><a href="countryEconomyStatistics.html"><i class="icon-exchange"></i>Economy</a></li>
							<li><a href="countryLaws.html"><i class="icon-scales"></i>Laws</a></li>
							<li><a href="partyElections.html"><i class="icon-affiliate"></i>Party elections</a></li>
							<li><a href="congressElections.html"><i class="icon-certificate2"></i>Congress elections</a></li>
							<li><a href="presidentalElections.html"><i class="icon-crown"></i>President elections</a></li>
							<li><a href="pendingCitizenshipApplications.html"><i class="icon-contact"></i>Citizenship</a></li>
							<li><a href="newMap.html"><i class="icon-map"></i>Map</a></li>
				        </ul>
				      </li>
                      <li class="divider"></li>
                    </ul>
                
                    <ul class="foundation-right hidden-overflow">
                        <div data-dropdown-content style="width:auto" class="f-dropdown content medium canvaback foundation-text-center foundation-base-font" id="contentDrop">
                                        <b class="time">18:00 8-12-2013</b>
                                        <b>día  825</b>
                                        <a class="button foundation-style" href="profile.html?id=<?=$_SESSION['user']->id;?>"><i class="icon-user"></i><?=$_SESSION['user']->nick;?></a><br>
                                        <a class="button foundation-style" href="logout.php"><i class="icon-error2"></i>Logout</a><br>
                        </div>
                        <li id="userAvatar">
                              <a data-dropdown="contentDrop" href="#">
                                      <img align="absmiddle" class="smallAvatar" style="border: 0px" src="images/blank-avatar.png"> <a class="profileLink"  href="profile.html?id=<?=$_SESSION['user']->id;?>"><?=$_SESSION['user']->nick;?></a>  
                              </a>
                        </li>
                        
                            
                                    <li class="menuNotifications">
                                            <a data-dropdown="contentDrop2" href="#" style="padding:.4em .4em 0 .4em;" id="startMission" class="active-icon animatedShake only-icon">
                                                      <i style="font-size:2.2em !important;cursor:pointer" class="icon-error"></i>
                                            </a>
                                    </li>
                                    <div data-dropdown-content style="width:auto" class="f-dropdown content medium canvaback foundation-text-center foundation-base-font mission-dropdown" id="contentDrop2">
                                            <p>
                                                    <strong>Hay una nueva misión !</strong><br>
                                                    <strong>Misión   #1:</strong> Encontrar un empleo 
                                            </p>
                                            <form action="betaMissions.html" method="POST">
                                                    <input type="hidden" name="action" value="START"/>
                                                    <input type="submit" value="La misión comienza " style="background: #F36625;color: #f2f2f2;" />
                                            </form>
                                    </div>
						
                        <li id="numero2" class="menuNotifications">
                              
                                      <a id="inboxMessagesMission" href="inboxMessages.html" class="blank-icon">
                                              <i class="icon-email2"></i><b>0</b>
                                      </a>
                              
                              
                        </li>
                        <li id="numero1" class="menuNotifications">
                              
                                      <a href="notifications.html" class="blank-icon">
                                              <i class="icon-alert"></i><b>0</b>
                                      </a>
                              
                              
                        </li>
                        <li class="menuNotifications">
                              
                                      <a href="subs.html" class="blank-icon">
                                              <i class="icon-rss"></i><b>0</b>
                                      </a>
                              
                              
                        </li>
                    </ul>
                
            </section>
   </nav>	
</DIV>

<div id="userMenu" class="two-tenths columns column-margin-left column-margin-vertical foundation-text-center foundation-style foundation-base-font">
	<div class="columns column-margin-both column-margin-vertical foundation-style canvaback foundation-shadow foundation-radius">
		<div class="foundation-style panel callout">
			<i class="icon-uptime"></i><b class="time">18:00 8-12-2013</b>
			<b style="display:none;" id="time2">1386525653097</b><br/>
			<b>día  825</b>
		</div>
		<form action="search.html" method="get" style="height:34px;">
			<div class="row collapse foundation-style">
				<div class="small-7 columns">
					<input id="searchForm" class="foundation-style" type="text" name="search" type="text" placeholder="Buscar jugador">
				</div>
				<div class="small-3 columns">
					<button class="postfix only-icon button foundation-style" type="submit"><i class="icon-search"></i></button>
				</div>
			</div>
		</form>
                                        
                <form action="editCitizen.html#changeLanguage">
                    <button class="postfix only-icon button foundation-style help" title='Cambiar el idioma '>
                        
                        <img src="images/flags/small/Spain.png" />
                        Change language
                    </button>
                </form>
                                        		
		
			
			<div id="showTutorialTutorial">
				<h4 style="color:#f2f2f2;" class="smallHeaderSecond">Your tasks today:</h4>
				<ul id="dailyButton" style="position:relative" class="animBreath2 button foundation-center foundation-style-group">
					<i title="Estas son tareas diarias. Recuerdas terminarlas todas cada día para hacer tu cuenta más fuerte y acceder al juego completamente.  " class="smallhelp button-group-notification icon-error2"></i>
					
						<li id="taskButtonTrain"><a class="button foundation-style smallhelp only-icon profileButton" title="Entrenar" href="train.html"><i class="icon-trainIcon"></i></a></li>
					
						<li id="taskButtonWork"><a class="button foundation-style smallhelp only-icon profileButton" title="Trabajar" href="jobMarket.html"><i class="icon-workIcon"></i></a></li>
					
						<li id="taskButtonFight"><a class="button foundation-style smallhelp only-icon profileButton" title="Luchar " href="battles.html?countryId=5"><i class="icon-fightIcon"></i></a></li>
					
						<li id="taskButtonAvatar"><a class="button foundation-style smallhelp only-icon profileButton" title="Subir una imagen personal" href="editCitizen.html?id=375486"><i class="icon-avatarIcon"></i></a></li>
					
				</ul>
			</div>
			
		<hr class="foundation-divider">		
		
		<h4 style="color:#f2f2f2;padding-top:0;" class="smallHeaderSecond">Shortcuts:</h4>
		<ul class="button foundation-center foundation-style-group">
			<li>
				<a id="taskButtonMU" href="myMilitaryUnit.html" title="Unidad militar" class="button foundation-style smallhelp only-icon profileButton">
					<i class="icon-bookmark"></i>
				</a>
			</li>
			<li>
				<a id="taskButtonParty" href="myParty.html" title="Partido" class="button foundation-style smallhelp only-icon profileButton">
					<i class="icon-friends"></i>
				</a>
			</li>
			<li>
				<a id="travelMission" href="travel.html" title="Viajar" class="button foundation-style smallhelp only-icon profileButton">
					<i class="icon-airplane"></i>
				</a>
			</li>
			<li>
				<a id="achievementsMission" href="citizenAchievements.html?id=375486" title="Tus logros" class="button foundation-style smallhelp only-icon profileButton">
					<i class="icon-trophy"></i>
				</a>
			</li>
			<li>
				<a href="editCitizen.html" title="Editar perfil" class="button foundation-style smallhelp only-icon profileButton">
					<i class="icon-tools"></i>
				</a>
			</li>
		</ul>
		
		<hr class="foundation-divider">

		<div>

			<div>
				<a style="color:#f2f2f2;" href="profile.html?id=375486" id="userName"><?=$_SESSION['user']->nick;?></a>
			</div>
			<div>
				<b id="levelMission" style="font-size:.82em;">Lvel: 1</b>
			</div>
			<div>
				<b style="font-size:.82em; position:relative;top:-5px;" id="currRankText">Rank: Newbie</b>
			</div>
			<div id="stats" class="foundation-center foundation-style">
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="1 / 10" id="xpProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Exp:</b> <b style="position:relative;top:-4px;" id="actualXp">1</b>
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="0 / 250" id="rankProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Next rank:</b> <b style="position:relative;top:-4px;" id="actualRank">0</b>
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="100.0 / 100" id="healthProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Health:</b> <b style="position:relative;top:-4px;" id="actualHealth">100.0</b>
				<br>
				<hr class="foundation-divider">
				<h4 id="depLimitsMission" class="smallHeader plateHeader">Consume items</h4>
				<div id="numero5" class="switch foundation-style">
					<input id="x4" name="switch-x2" type="radio">
					<label for="x4" onclick=""><i class="icon-undo"></i>Hide</label>
					<input id="x5" name="switch-x2" type="radio" checked>
					<label for="x5" onclick=""><i class="icon-forward"></i>Show</label>
					<span></span>
				</div>
				<div id="consumable">
                                    <div id="eatError" style="width:400px;text-align: center; display: none" class="testDivblue">
                                        <div style="width:300px;" class="testDivred"><img src="images/delete.png" style="float: left"/>

                                                        <div  id="hiddenError"></div>
                                        <p style="clear: both"></p> <br/> </div>

                                        <br/>
                                        <a class="button unblockButton" href=""><span class="okIcon">OK</span></a>
                                    </div>
                                    <ol id="selectable">
                                            <li class="ui-state-default ui-selected"><i class="icon-bread"></i><span id="foodQ1"><b>Q1</b><br>10</span></li>
                                            <li class="ui-state-default"><i class="icon-bread"></i><span id="foodQ2"><b>Q2</b><br>0</span></li>
                                            <li class="ui-state-default"><i class="icon-bread"></i><span id="foodQ3"><b>Q3</b><br>2</span></li>
                                            <li class="ui-state-default"><i class="icon-bread"></i><span id="foodQ4"><b>Q4</b><br>0</span></li>
                                            <li class="ui-state-default"><i class="icon-bread"></i><span id="foodQ5"><b>Q5</b><br>0</span></li>
                                    </ol>

                                    <form class="foundation-style" id="eatForm" action="eat.html" method="POST">
                                            <select id="foodQuality" name="quality" style="display:none;font-size: 9px" value="1">
                                                    <option id="q1FoodStorage" value="1">Q1 (tienes 10)</option>
                                                    <option id="q2FoodStorage" value="2">Q2 (tienes 0)</option>
                                                    <option id="q3FoodStorage" value="3">Q3 (tienes 2)</option>
                                                    <option id="q4FoodStorage" value="4">Q4 (tienes 0)</option>
                                                    <option id="q5FoodStorage" value="5">Q5 (tienes 0)</option> 
                                            </select>
                                            <b title="Puedes restaurar hasta 10 unidades de panes por día. Cada unidad de pan restaura desde 10 a 50 de salud (depende de la calidad)." class="smallhelp" style="padding:0 .5em">Límite de panes: <b id="foodLimit">10</b></b> 
                                            <input class="small button foundation-style" type="submit" id="eatButton" value="Eat food">
                                    </form>
                                    <ol id="selectable2">
                                            <li class="ui-state-default ui-selected"><i class="icon-gift-2"></i><span id="giftQ1"><b>Q1</b><br>10</span></li>
                                            <li class="ui-state-default"><i class="icon-gift-2"></i><span id="giftQ2"><b>Q2</b><br>0</span></li>
                                            <li class="ui-state-default"><i class="icon-gift-2"></i><span id="giftQ3"><b>Q3</b><br>0</span></li>
                                            <li class="ui-state-default"><i class="icon-gift-2"></i><span id="giftQ4"><b>Q4</b><br>0</span></li>
                                            <li class="ui-state-default"><i class="icon-gift-2"></i><span id="giftQ5"><b>Q5</b><br>0</span></li>
                                    </ol>

                                    <form action="gift.html" method="POST">
                                            <select id="giftQuality" name="quality" style="display:none;font-size: 9px" value="1">
                                                    <option id="q1GiftStorage" value="1">Q1 (tienes 10)</option>
                                                    <option id="q2GiftStorage" value="2">Q2 (tienes 0)</option>
                                                    <option id="q3GiftStorage" value="3">Q3 (tienes 0)</option>
                                                    <option id="q4GiftStorage" value="4">Q4 (tienes 0)</option>
                                                    <option id="q5GiftStorage" value="5">Q5 (tienes 0)</option>
                                            </select>
                                            <b class="smallhelp" title="Puedes restaurar hasta 10 regalos por día. Cada regalo restaura desde 10 a 50 de salud (depende de la calidad)." style="padding:0 .5em">Límite de regalos: <b id="giftLimit">10</b></b>
                                            <input class="small button foundation-style" id="useGiftButton" type="submit" value="Use gifts"/>
                                    </form>
                                    
				</div>
				<hr class="foundation-divider">
				<b>Economic skill: 1.0</b> <br/>
				<b>Strength: <?=$_SESSION['user']->strengh;?></b> <br/>
				<b>Location: <a href="region.html?id=<?=$_SESSION['user']->region->id;?>"><?=$_SESSION['user']->region->name;?></a></b>
				<div class="flags-small <?=$_SESSION['user']->country->name;?>"></div><br>
				<b>Citizenship: </b>
                                <div class="flags-small <?=$_SESSION['user']->country->name;?>"></div>
				<a href="pendingCitizenshipApplications.html">change</a>
				
					<img align="absmiddle" src="images/help.gif" class="help" title="Solo puedes participar en elecciones del país del cual eres ciudadano.  No puedes cambiar de ciudadanía en el primer mes" /> 
				
				<br />
			</div>
		</div>

		<hr class="foundation-divider">

		<h4 class="smallHeader plateHeader">Your money</h4>
		<div class="panelPlate foundation-style">
				
					<div class="flags-small Gold"></div> <b><?=$_SESSION['user']->gold;?></b> Gold <br/>
				
					<div class="flags-small <?=$_SESSION['user']->country->name;?>"></div> <b><?=$_SESSION['user']->currency;?></b> <?=$_SESSION['user']->currencyName;?> <br/>
				
				
			<div id="hiddenMoney" style="display: none">
				
				
			</div>
		</div>
		<div class="panelPlate foundation-style">
			<hr class="foundation-divider">
			<h4 class="smallHeader plateHeader">Your inventory</h4>
			<div class="switch foundation-style">
				<input id="x" name="switch-x" type="radio">
				<label for="x" onclick=""><i class="icon-undo"></i>Hide</label>
				<input id="x1" name="switch-x" type="radio" checked>
				<label for="x1" onclick=""><i class="icon-forward"></i>Show</label>
				<span></span>
			</div>
			<div class="storageMini"> 
<div> 10</div> 
<div> 
<img src="images/productIcons/Gift.png"/>  
<img class="storageMiniStars" src="images/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 10</div> 
<div> 
<img src="images/productIcons/Food.png"/>  
<img class="storageMiniStars" src="images/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 4</div> 
<div> 
<img src="images/productIcons/Ticket.png"/>  
<img class="storageMiniStars" src="images/productIcons/q5.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 3</div> 
<div> 
<img src="images/productIcons/Weapon.png"/>  
<img class="storageMiniStars" src="images/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 2</div> 
<div> 
<img src="images/productIcons/Food.png"/>  
<img class="storageMiniStars" src="images/productIcons/q3.png"/>  
</div> 
</div> 

			<p style="clear: both"></p>
                        <a class="button foundation-style" href="logout.php">
                            <i class="icon-error2"></i>
                            Logout
                        </a>
		</div>
	</div>
</div>
    



<div id="fb-root"></div>
<style>
    .tabs {
        display:none;
    }
    #command {
        display:none;
    }
</style>




    <div id="content" class="foundation-style column-margin-both column-margin-vertical column small-8 foundation-text-center no-style">
            
        Wellcome!
            
    </div>
    <div class="foundation-style foundation-text-center foundation-base-font small-10 columns column-margin-both column-margin-vertical-down">
        <div style="font-size:.8125em;" class="foundation-style columns canvaback column-margin-both column-margin-vertical foundation-radius foundation-shadow">
            <img align="absmiddle" src="images/wiki.png"> <a target="_blank" style="font-weight: bold" href="#">Contact</a> |
            <a href="laws.html">Laws</a> |
            <a href="privacyPolicy.html"> Privacy policy</a> |
            <a target="_blank" href="#">Forum</a> |
            <a href="staff.html">Staff</a> |
            <img align="absmiddle" src="images/wiki.png"> <a target="_blank" style="font-weight: bold" href="#">Wiki</a> |
            <img align="absmiddle" src="images/wiki.png"> <a target="_blank" style="font-weight: bold" href="#">Irc</a> | 
            <a href="#">Tickets</a>
            <br/>
            eRepublik Clone
        </div>
    </div>
    <div class="lightback2" id="smallPopup"></div>

<div class="missionTip" id="missionTip1"><span id="missionArrowText1" style="vertical-align: middle;"></span></div>
<div class="missionTip" id="missionTip2"><span id="missionArrowText2" style="vertical-align: middle;"></span></div>
<div class="missionTip" id="missionTip3"><span id="missionArrowText3" style="vertical-align: middle;"></span></div>
<div class="missionTip" id="missionTip4"><span id="missionArrowText4" style="vertical-align: middle;"></span></div>
<div class="missionTip" id="missionTip5"><span id="missionArrowText5" style="vertical-align: middle;"></span></div>
<div id="arrowMission1"></div>	
<div id="arrowMission2"></div>
<div id="arrowMission3"></div>
<div id="arrowMission4"></div>
<div id="arrowMission5"></div>



<script type="text/javascript" src="js/templates.js"></script>
<script type="text/javascript" src="js/js-signals.min.js"></script>
<script type="text/javascript" src="js/crossroads.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/site.js"></script>
<script type="text/javascript" src="js/company.js"></script>
<script type="text/javascript" src="js/market.js"></script>
<script type="text/javascript">

	Site.title='E-SIM';
	Site.authToken="<?=$_SESSION['app']->authToken;?>";
	Site.userToken="<?=$_SESSION['app']->userToken;?>";
	User.info=<?=json_encode($_SESSION['user']);?>;
	
	Company.products=<?=json_encode($products);?>;
	Company.resources=<?=json_encode($resources);?>;
	
	$(document).ready(function() {
		$(document).foundation();
		
	});

</script>

<script type="text/javascript" src="js/router.js"></script>
</body>
</html>


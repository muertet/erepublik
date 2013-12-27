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
    <meta property="og:site_name" content="e-Sim.org"/>
    <base href="http://<?=Config::get('domain');?>/">
    
    
    <meta http-equiv="Last-Modified" content="2013-12-08 12:58:57" />
    <meta property="og:image" content="http://e-sim.home.pl/testura/img/PrimeraLogo.png"/>
    <meta property="og:description" content="Free strategic browser game. Fight, earn money, manage businesses. Join us, let's have some fun together, help your ecountry to grow."/>
    

    <link href="http://e-sim.home.pl/testura/css/jquery-ui-1.9.2.custom.min.css" type="text/css" rel="stylesheet">
    <link href="http://e-sim.home.pl/testura/css/foundation-min.css" type="text/css" rel="stylesheet">
	
	
    <link rel="icon" type="image/png" href="http://e-sim.home.pl/testura/img/favicon.png"/>

    <title>e-sim -    Free MMOG browser game </title>      
</head>

	<body style="background: url(http://e-sim.home.pl/testura/img/bg6.jpg) no-repeat fixed;background-size:cover;">
		<div id="container" class="foundation-style row lightback2 foundation-radius">

		<div id="citizenMessage" style="display:none;"><div>El shout fue enviado. Aparecerá en un momento</div><span style="font-size: small">(click para cerrar)</span></div>
		
<div class="foundation-on"></div>
		<DIV class="fixed foundation-style">
			<nav class="top-bar">
				 <ul class="title-area">
				    <!-- Title Area -->
				    <li class="name">
				      <h1><a id="indexShortcut" href="index.html"><img style="width:40px;margin:3px;" src="http://e-sim.home.pl/testura/img/bestEsim.png" ></a></h1>
				    </li>
				    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				 </ul>
				
				 <section class="top-bar-section">
				    <!-- Left Nav Section -->
				    <ul class="foundation-left">
				      <li class="divider"></li>
				      <li class="has-dropdown"><a id="myPlaces" href="#"><i class="icon-home"></i>Mis lugares</a>
				        <ul class="dropdown">
						  <li><a href="work.htm"><i class="icon-user-3"></i>Trabajar</a></li>
						  <li><a href="train.htm"><i class="icon-scope"></i>Entrenar</a></li>
						  <li><a href="equipment.htm"><i class="icon-dagger"></i>Equipo</a></li>
						  <li><a href="companies.htm"><i class="icon-factory"></i>Compañías</a></li>
						  <li><a href="newspaper.htm"><i class="icon-insertpictureleft"></i>Periódico</a></li>
						  <li><a href="myParty.htm"><i class="icon-friends"></i>Partido</a></li>
						  <li><a href="contracts.htm"><i class="icon-sc"></i>Contratos</a></li>
						  <li><a href="myShares.htm"><i class="icon-wallet"></i>Acciones</a></li>
						  <li><a href="myAuctions.htm"><i class="icon-law"></i>Subastas</a></li>
						  <li><a href="inviteFriends.htm"><i class="icon-addfriend"></i>Invitar amigos</a></li>
						  <li><a href="myMilitaryUnit.htm"><i class="icon-bookmark"></i>Unidad militar</a></li>
						  
                          <li class=""><a href="subscription.html"><i class="icon-star"></i>Cuenta premium</a></li>
						  
                            <li class=""><a href="goldPurchase.html"><i class="icon-moneybag"></i>Comprar oro</a></li>
						  
						  
							<li class=""><a href="bonusGold.html"><i class="icon-piggybank"></i>Oro adicional</a></li>
						  	
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li id="numero4" class="has-dropdown"><a id="menuMarket" href="#"><i class="icon-value"></i>Mercado</a>
				        <ul class="dropdown">
							<li><a href="productMarket.html"><i class="icon-diamond"></i>Mercado de productos</a></li>
							<li><a href="jobMarket.html"><i class="icon-tie"></i>Mercado laboral</a></li>
							<li><a href="monetaryMarket.html"><i class="icon-cash"></i>Mercado monetario</a></li>
							<li><a href="auctions.html"><i class="icon-law"></i>Subastas</a></li>
							<!-- <a href="stockMarket.html"><i class="icon-stocks"></i>Mercado de Acciones</a></li> -->
							<li><a href="companiesForSale.html"><i class="icon-factory"></i>Compañias en venta</a></li>
							<li><a href="specialItems.html"><i class="icon-lightning2"></i>Objetos especiales</a></li>
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a id="statisticsMenu" href="#"><i class="icon-statistics"></i>Estadísticas</a>
				        <ul class="dropdown">
							<li><a href="countryStatistics.html"><i class="icon-earth"></i>Estadísticas de los países</a></li>
							<li><a href="partyStatistics.html"><i class="icon-timeline"></i>Estadísticas partidos</a></li>
							<li><a href="newspaperStatistics.html"><i class="icon-barchart"></i>Estadísticas periódicos</a></li>
							<li><a href="citizenStatistics.html"><i class="icon-podium"></i>Estadísticas ciudadanos</a></li>
                                                        <li><a href="newCitizenStatistics.html"><i class="icon-cupcake"></i>Estadísticas de ciudadanos nuevos</a></li>
							<li><a href="militaryUnitStatistics.html"><i class="icon-warmedal"></i>Estadísticas unidades militares</a></li>
							<li><a href="stockCompanyStatistics.html"><i class="icon-stocks"></i>Estadísticas mercado de acciones</a></li>
							<li><a href="donations.html"><i class="icon-gift"></i>Donaciones</a></li>
							
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a href="#"><i class="icon-document"></i>Noticias</a>
				        <ul class="dropdown">
							<li><a href="news.html?newsType=TOP_ARTICLES"><i class="icon-news"></i>Artículos más votados</a></li>
							<li><a href="news.html?newsType=LATEST_ARTICLES"><i class="icon-appointment"></i>Últimos artículos</a></li>
							<li><a href="news.html?newsType=HYDEPARK"><i class="icon-vendetta"></i>Hydepark</a></li>
							<li><a href="events.html?eventsType=MILITARY_EVENTS"><i class="icon-danger"></i>Acontecimientos militares</a></li>
							<li><a href="events.html?eventsType=POLITICAL_EVENTS"><i class="icon-director"></i>Acontecimientos políticos</a></li>
							<li><a href="shouts.html"><i class="icon-bubbles-2"></i>Shouts </a></li>
				        </ul>
				      </li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a href="#"><i class="icon-flag-2"></i>País </a>
				        <ul class="dropdown">
							<li><a href="battles.html"><i class="icon-cannon"></i>Batallas</a></li>
                                                        <li><a href="tournamentEvents.html"><i class="icon-trophy"></i>Eventos</a></li>
							<li><a href="countryPoliticalStatistics.html"><i class="icon-tank"></i>Guerra y política</a></li>
							<li><a href="countryEconomyStatistics.html"><i class="icon-exchange"></i>Economía</a></li>
							<li><a href="countryLaws.html"><i class="icon-scales"></i>Leyes</a></li>
							<li><a href="partyElections.html"><i class="icon-affiliate"></i>Elecciones partidarias</a></li>
							<li><a href="congressElections.html"><i class="icon-certificate2"></i>Elecciones de congreso</a></li>
							<li><a href="presidentalElections.html"><i class="icon-crown"></i>Elecciones presidenciales</a></li>
							<li><a href="pendingCitizenshipApplications.html"><i class="icon-contact"></i>Ciudadanía</a></li>
							<li><a href="newMap.html"><i class="icon-map"></i>Mapa</a></li>
				        </ul>
				      </li>
                      <li class="divider"></li>
                    </ul>
                
                    <ul class="foundation-right hidden-overflow">
                        <div data-dropdown-content style="width:auto" class="f-dropdown content medium canvaback foundation-text-center foundation-base-font" id="contentDrop">
                                        <b class="time">18:00 8-12-2013</b>
                                        <b>día  825</b>
                                        <a class="button foundation-style" href="profile.html?id=375486"><i class="icon-user"></i>benq2</a><br>
                                        <a class="button foundation-style" href="logout.html"><i class="icon-error2"></i>Desconectarse</a><br>
                        </div>
                        <li id="userAvatar">
                              <a data-dropdown="contentDrop" href="#">
                                      <img align="absmiddle" class="smallAvatar" style="border: 0px" src="http://e-sim.home.pl/testura/img/blank-avatar.png"> <a class="profileLink"  href="profile.html?id=375486">benq2</a>  
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
                        
                        <img src="http://e-sim.home.pl/testura/img/flags/small/Spain.png" />
                        Change language
                    </button>
                </form>
                                        		
		
			
				
		

		

			
			<div id="showTutorialTutorial">
				<h4 style="color:#f2f2f2;" class="smallHeaderSecond">Tus objetivos hoy:</h4>
				<ul id="dailyButton" style="position:relative" class="animBreath2 button foundation-center foundation-style-group">
					<i title="Estas son tareas diarias. Recuerdas terminarlas todas cada día para hacer tu cuenta más fuerte y acceder al juego completamente.  " class="smallhelp button-group-notification icon-error2"></i>
					
						<li id="taskButtonTrain"><a class="button foundation-style smallhelp only-icon profileButton" title="Entrenar" href="train.html"><i class="icon-trainIcon"></i></a></li>
					
						<li id="taskButtonWork"><a class="button foundation-style smallhelp only-icon profileButton" title="Trabajar" href="jobMarket.html"><i class="icon-workIcon"></i></a></li>
					
						<li id="taskButtonFight"><a class="button foundation-style smallhelp only-icon profileButton" title="Luchar " href="battles.html?countryId=5"><i class="icon-fightIcon"></i></a></li>
					
						<li id="taskButtonAvatar"><a class="button foundation-style smallhelp only-icon profileButton" title="Subir una imagen personal" href="editCitizen.html?id=375486"><i class="icon-avatarIcon"></i></a></li>
					
				</ul>
			</div>
			
		<hr class="foundation-divider">		
		
		<h4 style="color:#f2f2f2;padding-top:0;" class="smallHeaderSecond">Atajos:</h4>
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
				<a style="color:#f2f2f2;" href="profile.html?id=375486" id="userName">benq2</a>
			</div>
			<div>
				<b id="levelMission" style="font-size:.82em;">Nivel: 1</b>
			</div>
			<div>
				<b style="font-size:.82em; position:relative;top:-5px;" id="currRankText">Rango: Novato</b>
			</div>
			<div id="stats" class="foundation-center foundation-style">
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="1 / 10" id="xpProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Exp:</b> <b style="position:relative;top:-4px;" id="actualXp">1</b>
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="0 / 250" id="rankProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Próximo rango:</b> <b style="position:relative;top:-4px;" id="actualRank">0</b>
				<div class="progress foundation-center">
					<div class="smallhelp bar" title="100.0 / 100" id="healthProgress"></div>
				</div>
				<b style="position:relative;top:-4px;">Salud:</b> <b style="position:relative;top:-4px;" id="actualHealth">100.0</b>
				<br>
				<hr class="foundation-divider">
				<h4 id="depLimitsMission" class="smallHeader plateHeader">Consumir objeto</h4>
				<div id="numero5" class="switch foundation-style">
					<input id="x4" name="switch-x2" type="radio">
					<label for="x4" onclick=""><i class="icon-undo"></i>Ocultar</label>
					<input id="x5" name="switch-x2" type="radio" checked>
					<label for="x5" onclick=""><i class="icon-forward"></i>Mostrar</label>
					<span></span>
				</div>
				<div id="consumable">
                                    <div id="eatError" style="width:400px;text-align: center; display: none" class="testDivblue">
                                        <div style="width:300px;" class="testDivred"><img src="http://e-sim.home.pl/testura/img/delete.png" style="float: left"/>

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
                                            <input class="small button foundation-style" type="submit" id="eatButton" value="Comer pan">
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
                                            <input class="small button foundation-style" id="useGiftButton" type="submit" value="Usar regalos"/>
                                    </form>
                                    
				</div>
				<hr class="foundation-divider">
				<b>Habilidad económica: 1.0</b> <br/>
				<b>Fuerza: 100</b> <br/>
				<b>Ubicación: <a href="region.html?id=26">Andalucía</a></b>
				<div class="flags-small Spain"></div><br>
				<b>Ciudadanía: </b>
                                <div class="flags-small Spain"></div>
				<a href="pendingCitizenshipApplications.html">cambiar</a>
				
					<img align="absmiddle" src="http://e-sim.home.pl/testura/img/help.gif" class="help" title="Solo puedes participar en elecciones del país del cual eres ciudadano.  No puedes cambiar de ciudadanía en el primer mes" /> 
				
				<br />
			</div>
		</div>

		<hr class="foundation-divider">

		<h4 class="smallHeader plateHeader">Tu dinero</h4>
		<div class="panelPlate foundation-style">
			
				
					<div class="flags-small Gold"></div> <b>0.00</b> Oro <br/>
				
			
				
					<div class="flags-small Spain"></div> <b>5.00</b> ESP <br/>
				
			
				
			<div id="hiddenMoney" style="display: none">
				
					
				
					
				
			</div>
		</div>
		<div class="panelPlate foundation-style">
			<hr class="foundation-divider">
			<h4 class="smallHeader plateHeader">Tu inventario</h4>
			<div class="switch foundation-style">
				<input id="x" name="switch-x" type="radio">
				<label for="x" onclick=""><i class="icon-undo"></i>Ocultar</label>
				<input id="x1" name="switch-x" type="radio" checked>
				<label for="x1" onclick=""><i class="icon-forward"></i>Mostrar</label>
				<span></span>
			</div>
			<div class="storageMini"> 
<div> 10</div> 
<div> 
<img src="http://e-sim.home.pl/testura/img/productIcons/Gift.png"/>  
<img class="storageMiniStars" src="http://e-sim.home.pl/testura/img/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 10</div> 
<div> 
<img src="http://e-sim.home.pl/testura/img/productIcons/Food.png"/>  
<img class="storageMiniStars" src="http://e-sim.home.pl/testura/img/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 4</div> 
<div> 
<img src="http://e-sim.home.pl/testura/img/productIcons/Ticket.png"/>  
<img class="storageMiniStars" src="http://e-sim.home.pl/testura/img/productIcons/q5.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 3</div> 
<div> 
<img src="http://e-sim.home.pl/testura/img/productIcons/Weapon.png"/>  
<img class="storageMiniStars" src="http://e-sim.home.pl/testura/img/productIcons/q1.png"/>  
</div> 
</div> 
<div class="storageMini"> 
<div> 2</div> 
<div> 
<img src="http://e-sim.home.pl/testura/img/productIcons/Food.png"/>  
<img class="storageMiniStars" src="http://e-sim.home.pl/testura/img/productIcons/q3.png"/>  
</div> 
</div> 

			<p style="clear: both"></p>
                        <a class="button foundation-style" href="logout.html">
                            <i class="icon-error2"></i>
                            Desconectarse
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
            <img align="absmiddle" src="http://e-sim.home.pl/testura/img/wiki.png"> <a target="_blank" style="font-weight: bold" href="http://wiki.e-sim.org/index.php/Contact">Contacto</a> |
            <a href="laws.html">Leyes</a> |
            <a href="privacyPolicy.html">Politica de privacidad</a> |
            <a target="_blank" href="http://forum.e-sim.org">Foro</a> |
            <a href="staff.html">Staff</a> |
            <img align="absmiddle" src="http://e-sim.home.pl/testura/img/wiki.png"> <a target="_blank" style="font-weight: bold" href="http://wiki.e-sim.org/index.php/">Wiki</a> |
            <img align="absmiddle" src="http://e-sim.home.pl/testura/img/wiki.png"> <a target="_blank" style="font-weight: bold" href="http://wiki.e-sim.org/index.php/Irc">Irc</a> | 
            <a href="http://tickets.e-sim.org">Tickets</a>
            <br/>
            Copyright© Amepton Management Ltd.
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



    
        <div id="chatpanel" class="miniChat cloChat">
            <div id="collective-xmpp-chat-data">
                <div id="controlbox" class="chatbox minimizedChat closedChat" style="opacity: 1; display: inline;width:512px;">
                    <div id="chatTabs" style="height:86% !important;overflow:hidden;">
                        <ul>
                            <li><a class="chatT" myId='0' href="#GC">General</a></li>
                            <li><a class="chatT" myId='1' href="#CC">Country</a></li>
                            <li><a class="chatT" myId='2' href="#MU">Military Unit</a></li>
                            <li><a class="chatT" myId='3' href="#PM">Private Msg</a></li>
                            
                            
                                <a id="closeChat" class="icon-uniF472"></a>
                                <a id="minimizeChat" class="icon-uniF474"></a>
                            </ul>
                            <div id="GC" class="chatW"></div>
                            <div id="CC" class="chatW"></div>
                            <div id="MU" class="chatW"></div>
                            <div id="PM" class="chatW">
                                <div class="ui-widget">
                                    <label for="chatPlayerName">Player: </label>
                                    <input id="chatPlayerName" />
                                </div>
                            </div>
                        
                        
                        </div>
                        <div id="chatMessages" style="text-align:left">
                            <textarea type="text" size="100" id="chatText" style="width: 80%; height: 40px;margin-left:3px;"></textarea>
                            <input id="sendChatButton" class="button secondary foundation-style" type="submit" value="send" style="width: 18%; vertical-align: top; margin-top: 3px; height: 40px;" />
                            <input type="hidden" id="chatPlayerName" size="20" name="chatInput"/>
                        </div>
                    </div>	
                </div>
            </div>


</body>
</html>


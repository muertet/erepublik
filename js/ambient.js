//Load ambient graphic

var ambient_img = "bg.jpg";

function setAmbientCookie() {
	try {
		$j.cookie('ambientGraphic', null);
		$j.cookie('ambientGraphics',null);
	}
	catch(e){;}
	var cookie_status = ($j.cookie('ambient_Graphic') == "0")?1:0;
	$j.cookie('ambient_Graphic', cookie_status, {expires:365, path: "/", domain: domainname})
}
function loadAmbient() {
	var cssDef = {
		'background-image': 'url(http://'+domainname+'/images/modules/ambients/external/'+ambient_img+')',
		'background-repeat': 'no-repeat',
		'background-position': 'center top'
	}
	$j("body").css(cssDef);
}

function togglerAmbient() {
	$j(".ambient_toggler").show();
}

function decideAmbientGraphics() {
	if($j.cookie('ambient_Graphic') == "0")	$j('body').css({'background-image': 'url(http://'+domainname+'/images/modules/ambients/external/'+ambient_img+')'});
	else $j('body').css({'background-image': 'none'});
	setAmbientCookie();
}

$j(document).ready(function () {
	try {
		if (tm_ambient) {
			ambient_img = tm_ambient;
		}
	} catch(e){;}
	$j(".ambient_toggler").toggle(
	function () {
		try{
			decideAmbientGraphics()
		}
		catch(e){;}
		$j(this).addClass('on');
	},
	function () {
		try {
			decideAmbientGraphics();
		}
		catch(e) {;}
		$j(this).removeClass('on');
	});
	try {
		$j(".article").find('img').each(function(){processImage(this)});
	} catch(e) {;}
});
$j(window).load(function () {
	if (screen.width > 1024) {
		loadAmbient();
		togglerAmbient();
		try {
			if($j.cookie('ambient_Graphic') == "0") {
					$j('body').css({'background-image':	'none'});
					$j('.ambient_toggler').addClass('on');
				}
		}
		catch(e) {;}
	}
});
function processImage(obj) {
	var height = obj.height;
	var width = obj.width;
	if(height <= 675 && width <= 675) return;
	var ratio = height/width;
	if(ratio > 1) {
		height = 675;
		width = Math.ceil(height/ratio);
	}	else {
		width = 675;
		height = Math.ceil(width*ratio);
	}
	obj.height = (height);
	obj.width = (width);
	/*
	obj.css("width", width);
	obj.css("height", height);
	*/
}

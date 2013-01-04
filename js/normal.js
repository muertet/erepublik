

function loadPosition(){

	if(typeof User_Position!='undefined' && User_Position!='')
	{

		if(User_Position.indexOf(':buscar_')!=-1)
		{
			var info=User_Position.split(':buscar_');
			if(info[1]!='' && info[0]!=''){
				call_buscador(info[1],info[0]);
			}
		}
		else if(User_Position.indexOf('last_')!=-1)
		{
			var cat_id=User_Position.split("_");
			
			if(cat_id[1]!=''){
				call_ultimes(cat_id[1],cat_id[2]);
			}
		}
		else if(User_Position.indexOf('tutorial_')!=-1)
		{
			var tut_id=User_Position.replace('tutorial_','');
			if(tut_id!=''){
				call_tutorial(tut_id);
			}
		}else{
			obre(User_Position);
		}
		
	}else{
		obre('indice');
	}
}

function obre(section)
{
	var url='';
	
	if(section=='lists'){
		url=urlScripts+"lists/lists.php";
	}else if(section=='createList'){
		url=urlTemplates+"lists/new.htm";
	}else{
		return false;
	}
	carregar_bloc(url,section);
}
function searchCategory(id)
{
	var url='/scripts/search/index.php';
	$.post(url,{category:id},function(data){
		if(data==0){
			gritter_alert('Error','No se han encontrado resultados');
		}else{
			
		}
	
	});
}
function checkLogin()
{
	var user=$('#userLogin').val();
	var pass=$('#userPass').val();
	if(user=='' || pass==''){
		return false;
	}
	var url='/scripts/login/login.php';
	$.post(url,{user:user,pass:pass},function(data){
		if(data==1){
			location.reload();
		}else if(data==2){
			gritter_alert('Error','Los datos no coinciden');
		}else if(data==3){
			gritter_alert('Error','Usuario expulsado');
		}
	
	});
}
function registerForm(){
	var htm='Usuario: <input id="userLogin" type="text" /><br>'
	+'Contraseña: <input id="userPass" type="password" /><br>'
	+'Repite contraseña: <input id="userPass2" type="password" /><br>'
	+'Email: <input id="email" type="text" /><br>'
	+'<button onclick="register();">Registrarse</button><br>';
	$('#loginForm').html(htm);
}
function register(){
	var user=$('#userLogin').val();
	var pass=$('#userPass').val();
	var pass2=$('#userPass2').val();
	var email=$('#email').val();
	
	if(user!='' && pass!='' && pass2!='' && email!=''){
	
		if(pass!=pass2){
			gritter_alert('Error','Las contraseñas no encajan!');
			$('#userPass').focus();
			return false;
		}

		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(email)) {
			gritter_alert('Error','Email inválido!');
			$('#email').focus();
			return false;
		}

		url="scripts/login/register.php";
		$.post(url, { user:user,pass:pass,email:email },
		function(data){
			if(data==1){
				savePosition('upload');
				location.reload();
			}else if(data==2){
				gritter_alert('Error','Nick/Email en uso');
			}else if(data==3){
				gritter_alert('Error','Estás logueado... :S');
			}else{
				gritter_alert('Error','Servidores ocupados');
			}
		});

	}else{
		gritter_alert('Error','Has d\'omplir totes les dades!');
	}
}
function menuSelector(option)
{
	$('#menuSelector').hide('slow');
	$('#menuSelector'+option).removeClass('oculto');
}

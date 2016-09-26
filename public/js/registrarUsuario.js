function registrarUsuario() {
	var username = document.getElementById('username').value;
	var apellidoP = document.getElementById('apellidoP').value;
	var apellidoM = document.getElementById('apellidoM').value;
	var password = document.getElementById('password').value;
	//var foto = document.getElementById('foto').value;

	if (username != '' && password != '' && apellidoM != '' && apellidoP != '') {
		if (true) {
			var url = config['url']+"Usuario/registrar/";
		    var datos = "username=" + username + "&password=" + password + "&apellidoP=" + apellidoP + "&apellidoM=" + apellidoM;
			register = new XMLHttpRequest();
			register.open("POST", url ,true);
			register.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			register.send(datos);
			register.onreadystatechange = function (){
				if (register.readyState == 4) {
					switch(register.responseText){
		                case '0':
		                alert("El usuario ya existe");
		                //location.reload();
		                break;
		                case '1':
		                alert("Usuario registrado exitósamente");
		                break;
		                default:
		             	alert(register.responseText);
		                break;
		        	}
				}
			}
		}	   
	} else {
		alert("Completa los campos");
	}
}

function validarUser() {
	var userName = document.getElementById('username').value;

	if (userName.match("[0-9]") || userName.match("[A-Za-z0-9_\.\-]\@[A-Za-z0-9\-]{3,}\.[A-Za-z0-9]{2,}")) {
		return true;
	} else {	
		alert('El formato del usuario es incorrecto');
		return false;
	}
}
function cargarImg(){
	var file = document.getElementById('subir_archivo').files[0];
	var i = new FormData();
	i.append('img',file);
	var ajax = new XMLHttpRequest();
	ajax.open("POST", config['url']+'Usuario/setImg/',true);
	ajax.send(i);
	ajax.onreadystatechange = function (){
		if (ajax.readyState == 4) {
			var reader = new FileReader();
			reader.onload = function(e){
				var img = document.getElementById('img');
				img.setAttribute('src',e.target.result);
			}	
			reader.readAsDataURL(file);
		}
	}
}
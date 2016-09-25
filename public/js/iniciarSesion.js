function iniciarSesion() {
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	if (username != '' && password != '') {
		if (validarUser()) {
			var url = config['url']+"Usuario/iniciarSesion/";
		    var datos = "username=" + username + "&password=" + password;
		    
			logIn = new XMLHttpRequest();
			logIn.open("POST", url ,true);
			logIn.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			logIn.send(datos);

			logIn.onreadystatechange = function (){
				if (logIn.readyState == 4) {
					switch(parseInt(logIn.responseText)){
		                case 1:
		                alert("Sesión iniciada");
		                location.reload();
		                break;
		                case 4:
		                alert("Hay una sesión iniciada en otro dispositivo. Ciérrela primero para continuar.");
		                break;
		                default:
		                alert("Verifica tu usuario y/o Contraseña "+logIn.responseText);
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

function registro() {
	location.href = config['url']+"Usuario/registroAspirante";
}
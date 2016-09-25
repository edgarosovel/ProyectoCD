public function registrarUsuario() {
	var username = document.getElementById('username').value;
	var apellidoP = document.getElementById('apellidoP').value;
	var apellidoM = document.getElementById('apellidoM').value;
	var password = document.getElementById('password').value;
	//var foto = document.getElementById('foto').value;

	if (username != '' && password != '' && apellidoM != '' && apellidoP != '') {
		if (validarUser()) {
			var url = config['url']+"Usuario/registrar/";
		    var datos = "username=" + username + "&password=" + password + "&apellidoP=" + apellidoP + "&apellidoM=" + apellidoM;
		    
			register = new XMLHttpRequest();
			register.open("POST", url ,true);
			register.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			register.send(datos);

			register.onreadystatechange = function (){
				if (register.readyState == 4) {
					switch(parseInt(register.responseText)){
		                case 0:
		                alert("El usuario ya existe");
		                //location.reload();
		                break;
		                default:
		                alert("Usuario registrado exitósamente");
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
function validarCurp () {

	curp = document.getElementById('curp').value;

	if (curp.match("[A-Za-z]{4}[0-9]{6}[A-Za-z]{6}[0-9]{2}")) 
	{
		return true;
	} else 	{
		alert('No es un CURP válido')
		document.getElementById('curp').focus();
	};
}

function validarCorreo () {
	correo = document.getElementById('correo').value;
	if (correo.match("[A-Za-z0-9_\.\-]\@[A-Za-z0-9\-]{3,}\.[A-Za-z0-9]{2,}"))
	{
		return true;
	}else
	{
		alert('No es un correo válido')
		document.getElementById('correo').focus();
	};
}

function validarTelefono ( estrict , campo) {
	if(estrict == false) {
		telefono = document.getElementById('telefono').value;
		campo = "telefono";
	} else {
		telefono = document.getElementById(campo).value;
	}
	
	if( telefono.match("[0-9]{13}") || telefono.match("[0-9]{10}") || telefono.match("[0-9]{7}")) {
		return true;
	} else {
		if( telefono.length != 0 ) {
			alert('No es un Teléfono válido')
			document.getElementById(campo).focus();
		} else {
			alert('Introduce un teléfono.')
			document.getElementById(campo).focus();
		}
	} 
}

function validarUser() {
	var userName = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	if (userName.match("[0-9]{4,6}") || userName.match("[A-Za-z]{1}[0-9]{4}")) {
		return true
	} else {
		alert('Usuario o Contraseña Incorrectos');
	};

}

function agregarAcceso( idModulo ) {
	var form = new FormData(document.forms.namedItem("formAcceso"));
	form.append("idModulo", idModulo);

	var titulo = document.getElementById('titulo').value;
	var controlador = document.getElementById('controlador').value;
	var metodo = document.getElementById('metodo').value;

	if (titulo != '' && controlador != '' && metodo != '') {

		var url = config['url']+"Modulo/crearAcceso/";
   
		var envio = new XMLHttpRequest();
		envio.open("POST", url ,true);
		envio.onload = function(oEvent){
		    if (envio.status == 200) {
		      if(envio.responseText == 1){
		      		alert("Acceso creado");
			    	//location.reload();
			  }	else if(envio.responseText == 2){
			  	alert("Acceso guardado. La imagen no se logró guardar.");
			  	//location.reload();
			  } else {
			  	alert(envio.responseText);
			  }
		    } else {
		      alert("Ha ocurrido un error.");
		    }
		}

  		envio.send(form);

	} else {
		alert("Completa la información.");
	}
}

function modificarEstadoAcceso( idAcceso, estado ){
	password = prompt("Ingresa la contraseña de usuario");

	if(password != null && password != ''){

		var urlPass = config['url']+"Usuario/comprobarPass/";
	    var datos = "password=" + password;
	    
		var logIn = new XMLHttpRequest();
		logIn.open("POST", urlPass);
		logIn.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		logIn.send(datos);

		logIn.onreadystatechange = function (){
			if (logIn.readyState == 4) {
				switch(parseInt(logIn.responseText)){
	                
	                case 1:
	                	if(estado == 1) {
							mensaje = "¿Está seguro de habilitar el acceso?";
						} else {
							mensaje = "¿Está seguro de deshabilitar el acceso?";
						}
		                var confirmacion = confirm(mensaje);
						if(confirmacion == true){
							var urlCambioEstado = config['url']+"Modulo/cambiarEstadoAcceso/";
							var datos = "idAcceso=" + idAcceso+"&estado="+estado;

							logIn.open("POST",urlCambioEstado);
							logIn.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							logIn.send(datos);
							logIn.onreadystatechange = function (){
								if (logIn.readyState == 4) {
									switch(parseInt(logIn.responseText)){
										case 1:
										if(estado == 1) {
											alert("El acceso ha sido habilitado.");
										} else {
											alert("El acceso ha sido deshabilitado.");
										}
										break;

										default:
											alert("No se pudo deshabilitar el acceso");
										break;
									}
								}
							}
						} else {
							location.reload();
						}
	                break;

	                default:
	                	alert("La contraseña no es correcta");
	                	location.reload();
	                break;
	        	}
			}
		}
	} else {
		location.reload();
	}	
}


function editarAcceso( idAcceso ){
	alert("¿Deseas editar el acceso? "+idAcceso);


	//-------------Aqui comienzo mañana-----------------
}
function modificarEstadoFacultad( idFacultad, estado ){
	password = prompt("Ingresa la contraseña de usuario");

	if(password != null && password != ''){

		var urlPass = config['url']+"Usuario/comprobarPass/";
	    var datos = "password=" + password;
	    
		var cambiarEstado = new XMLHttpRequest();
		cambiarEstado.open("POST", urlPass);
		cambiarEstado.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		cambiarEstado.send(datos);

		cambiarEstado.onreadystatechange = function (){
			if (cambiarEstado.readyState == 4) {
				switch(parseInt(cambiarEstado.responseText)){
	                
	                case 1:
	                	if(estado == 1) {
							mensaje = "¿Está seguro de habilitar la facultad?";
						} else {
							mensaje = "¿Está seguro de deshabilitar la facultad?";
						}
		                var confirmacion = confirm(mensaje);
						if(confirmacion == true){
							var urlCambioEstado = config['url']+"UAQ/cambiarEstadoFacultad/";
							var datos = "idFacultad=" + idFacultad+"&estado="+estado;

							cambiarEstado.open("POST",urlCambioEstado);
							cambiarEstado.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							cambiarEstado.send(datos);
							cambiarEstado.onreadystatechange = function (){
								if (cambiarEstado.readyState == 4) {
									switch(parseInt(cambiarEstado.responseText)){
										case 1:
										if(estado == 1) {
											alert("La facultad ha sido habilitada.");
										} else {
											alert("La facultad ha sido deshabilitada.");
										}
										location.reload();
										break;

										default:
											alert("No se pudo deshabilitar la facultad" + cambiarEstado.responseText);
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

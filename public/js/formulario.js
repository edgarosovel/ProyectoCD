function validarCampos() 
{	
	if(validarCurp()){
		if(validarCorreo()){
			if(validarTelefono(false,'')){
				var apellidoPaterno = document.getElementsByName('apellidoPaterno')[0].value;
				var apellidoMaterno = document.getElementsByName('apellidoMaterno')[0].value;
				var nombre = document.getElementsByName('nombre')[0].value;
				var curp = document.getElementsByName('curp')[0].value;
				
				var fecNac = document.getElementsByName('fecNac')[0].value;
				var edoNac = document.getElementsByName('edoNac')[0].value;
				var sexo = document.getElementsByName('sexo');
				var rSexo = "M";
				for (var i = 0; i < sexo.length; i++) 
				{
					if (sexo[i].checked) { rSexo = sexo[i].value };
				};
				var nacOrigen = document.getElementsByName('nacOrigen')[0].value;
				var edo = document.getElementsByName('edo')[0].value;
				var mun = document.getElementsByName('mun')[0].value;
				var loc = document.getElementsByName('loc')[0].value;
				var folio = document.getElementsByName('folio')[0].value;
				var correo = document.getElementsByName('correo')[0].value;
				var telefono = document.getElementsByName('telefono')[0].value;
				var adscripcion = document.getElementsByName('adscripcion')[0].value;

				if (curp != '' && 
					apellidoPaterno != '' && 
					apellidoMaterno != ''&& 
					nombre != '' && 
					fecNac != '' &&
					edoNac != '' &&
					rSexo != '' && 
					nacOrigen != '' && 
					edo != '' && 
					mun != '' && 
					loc != '' && 
					folio != '' && 
					correo != '' && 
					telefono != '' &&
					adscripcion != '') 
				{

					var url = config['url']+"Trabajador/registrarTrabajador/";
				    var datos = "curp=" + curp + "&primerApellido=" + apellidoPaterno+ "&segundoApellido=" + apellidoMaterno+ 
				    	"&nombre=" + nombre+ "&fecNac=" + fecNac+ "&edoNac=" + edoNac+ "&sexo=" + rSexo+ "&nacOrigen=" + 
				    		nacOrigen+ "&edo=" + edo+ "&mun=" + mun+ "&loc=" + loc+ "&folio=" + folio+ "&correo=" + correo+ 
				    			"&telefono=" + telefono+ "&adscripcion=" + adscripcion;

					registrar = new XMLHttpRequest();
					registrar.open("POST", url ,true);
					registrar.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					registrar.setRequestHeader("Content-length", datos.lenght);
					registrar.setRequestHeader("Connection","close");
					registrar.send(datos);

					registrar.onreadystatechange = function (){
						if (registrar.readyState == 4) {
							switch(parseInt(registrar.responseText)){
				                case 0:
				                alert("No se ha podido guardar el registro");
				                break;

				                case 1:
				                alert("Registro guardado exitosamente");
				                location.reload();
				                break;

				                default:
				                alert("Ha ocurrudo un error "+registrar.responseText);
				                break;
				        	}
						}
					}
				} else {
					alert("Complete los campos");
				}
			}
		}
	}
}

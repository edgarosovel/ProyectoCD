function validarContraseña() 
{
  expediente = "246529";
  pass  = document.getElementById('pass').value;
  correo  = document.getElementById('correo').value;
  correo = correo.split("@",1);
  
  //Mínimo 8 caracteres
  if(pass.length > 7) {
    document.getElementById('rgla1').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla1').src = config['img']+"error.png";
  }

  //al menos un número
  re = /[0-9]/;
  if(re.test(pass)) {
    document.getElementById('rgla2').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla2').src = config['img']+"error.png";
  }
  
  //al menos una mayúscula
  re = /[A-Z]/;
  if(re.test(pass)){
    document.getElementById('rgla3').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla3').src = config['img']+"error.png";
  }
  
  //al menos una minúscula
  re = /[a-z]/;
  if(re.test(pass)){
    document.getElementById('rgla4').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla4').src = config['img']+"error.png";
  }

  //Debe de ser difente al correo
  re = new RegExp(expediente);
  if(!re.test(pass) && pass.length > 7 ) {
    document.getElementById('rgla5').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla5').src = config['img']+"error.png";
  }

  //Debe de ser difente al correo
  re = new RegExp(correo);
  if(!re.test(pass) && pass.length > 7 ) {
    document.getElementById('rgla6').src = config['img']+"exito.png";
  } else {
    document.getElementById('rgla6').src = config['img']+"error.png";
  }

}

function verificacion() {

  pass = document.getElementById("pass").value;
  passVerificado= document.getElementById("passVerificado").value;

    if (pass != passVerificado ) {
      document.getElementById("tipoSegPass").value = "Las contraseñas no coinciden.";
      document.getElementById("tipoSegPass").className = "div3 noMatch";
    } else {
      document.getElementById("tipoSegPass").value = "Las contraseñas coinciden.";
      document.getElementById("tipoSegPass").className = "div3 match";
    }
}


function cambiarImagen( imagen ) {

  if(imagen.files && imagen.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#imagenPerfilPrincipal').attr("src",e.target.result);
    };
    reader.readAsDataURL(imagen.files[0]);
  }
}

function validarCampos(){

  var url = config['url']+"Trabajador/actualizarConfigInicial/";

  var form = new FormData(document.forms.namedItem("formImage"));

  var request = new XMLHttpRequest();
  request.open("POST", url, true);
  request.onload = function(oEvent){
    if (request.status == 200) {
      alert(request.responseText);
    } else {
      alert("No se subió");
    }
  }

  request.send(form);

  /*if(validarCorreo()){
    if(validarTelefono(false, '')){
      if(validarTelefono( true, 'telefonoEmergencia')){
        pass = document.getElementById("pass").value;
        passVerificado = document.getElementById("passVerificado").value;
        
        if(pass.length != 0) {
          if (pass == passVerificado) {
            if(verificacionRespSeg()) {
              telefono = document.getElementById('telefono').value;
              telefonoEmergencia = document.getElementById('telefonoEmergencia').value;

              if(telefono != telefonoEmergencia) {
                correo = document.getElementById('correo').value;
                idPregSeguridad = document.getElementById('pregSeguridad').value;
                respSeguridad = document.getElementById('respSeguridad').value;
                
                if(correo != '' &&
                  telefono != '' &&
                  telefonoEmergencia != '' &&
                  idPregSeguridad != '' &&
                  respSeguridad != '' &&
                  pass != ''){ 

                  var url = config['url']+"Trabajador/actualizarConfigInicial/";
                  
                  var datos = "correo=" + correo + "&telefono=" + telefono + "&telefonoEmergencia=" + telefonoEmergencia + 
                    "&idPregSeguridad=" + idPregSeguridad + "&respSeguridad=" + respSeguridad+ "&pass=" + pass;

                  actualizar = new XMLHttpRequest();
                  actualizar.open("POST", url ,true);
                  actualizar.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                  actualizar.setRequestHeader("Content-length", datos.lenght);
                  actualizar.setRequestHeader("Connection","close");
                  actualizar.send(datos);

                  actualizar.onreadystatechange = function (){
                    if (actualizar.readyState == 4) {
                      switch(parseInt(actualizar.responseText)){
                                case 0:
                                alert("No se ha podido actualizar tu información");
                                break;

                                case 1:
                                alert("Se han guardado tus datos exitosamente");
                                //location.reload();
                                break;

                                default:
                                alert("Ha ocurrudo un error "+actualizar.responseText);
                                break;
                          }
                    }
                  }

                } else {
                  alert ("Complete los campos.");
                }
              } else {
                alert ("Los teléfonos deben de ser distintos.");
                document.getElementById('telefonoEmergencia').value = '';
                document.getElementById('telefonoEmergencia').focus();
              }
            } 
          } else {
            alert ("Las contraseñas no coinciden.");
          }
        } else {
          alert ("Escribe una contraseña.");
          document.getElementById('pass').focus();
        }
      }
    }
  }*/
}
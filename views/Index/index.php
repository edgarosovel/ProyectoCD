<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Inicio de sesión</title>

        <link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style-general_.css">
        
        <script type="text/javascript" src="<?php echo JS; ?>config.js"></script>
        <script type="text/javascript" src="<?php echo JS; ?>iniciarSesion.js"></script>
        
    </head>
    <body class="index" onKeyPress="if(event.keyCode==13) iniciarSesion();">
                
        <div class="login-bloque">
            <h1>Inicio de sesión</h1>
    		
            
            <div class="userPass">
                <input id="username" name="usuario" placeholder="Usuario" autocomplete="off" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Usuario'" />
                
                <input id="password" name="contrasena" placeholder="Contraseña" type="password" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contraseña'"/>
                
                <button class="btnIniciarSesion" id="btnRegistro" name="btnRegistro" onclick="registro()">Registro</button>
                
                <button class="btnIniciarSesion" id="btnEntrar" name="btnIniciarSesion" onclick="iniciarSesion()">Entrar</button>
                
            </div>
            
        </div> 
        <div class="pie">
            <p>Centro de Desarrollo - Facultad de Informática
            <br>Universidad Autónoma de Querétaro</p>   
            <div class="logos"></div>                           
        </div>
    </body>
</html>
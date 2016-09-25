<div>

  <?php $this->render('Default','mensajesNotificaciones',true); ?>

<div class="menu-principal--usuario">
  
  <!-- ============================Información del usuario =======================================-->

    <div class="menu-informacion" >

      <div class="imagen-perfil" id="imagen-perfil">
        <img src="<?php echo IMG."perfil/".Session::getValue('imagenPerfil'); ?>" id="imagenPerfilPrincipal"/>
      </div>

      <div>
        <h2><?php echo Session::getValue('nombreUsuario'); ?></h2>
        <p>Correo electrónico: <?php echo Session::getValue('correo'); ?></p>
      </div>

      <div class="contenido">
        <a href="<?php echo URL;?>Usuario/informacionGeneral" id="configuracion" class="btn">
          <i class="icono-configuracion"></i>
        </a>
        <a href="#" class="btn mensajes"><i class="icono-correo"></i>
          <span class="notificacion-label notificacion-label-blue"><?php echo "3" ?></span>
        </a>
      </div>

    </div>

    <!-- =================================== Modulos ===========================================-->

    <ul class="menu-normal" id="estilo-scroll">

    <?php foreach ($this->menu as $acceso) { ?>
      
      <li>
        <a <?php if($acceso['status']==1) { ?> href="<?php echo URL.$acceso['ubicacion'].'"'; }?> >
          <img class="icon" src="<?php echo IMG."/iconos_accesos/".$acceso['icono']; ?>"/>  
          <span class="opciones-menu"> <?php echo $acceso['nombre']; ?> </span>
        </a>
      </li>

    <? } ?>
      
      <!-- =================================== Cerrar Sesión ===========================================-->

      <a class="cerrar" href="<?php echo URL; ?>Usuario/cerrarSesion">
        <img class="icon" src="<?php echo IMG; ?>logout.png"/>  
        <span class="opciones-menu">Cerrar sesión</span>
      </a>

    </ul>

  </div>

</div>
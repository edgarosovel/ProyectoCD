<ul id="notificationMenuNoti" class="notificacionesNoti">

  <!--=============================== Titulo Notificacion =====================================-->
  <li class="titulo">
    <span class="title">Notificaciones</span>
  </li>

  <!--============================== Notificaciones visibles ==================================-->

  <div class="cajaNotif" id="style-1">

     <!--============================== Notificaciones 1 ==================================-->
    <li class="notif noLeido">
      <a style="text-decoration:none" href="">
        <div class="imagenNotif"> 

          <?php echo '<img class="imagenNotif-Principal" src="'.IMG.'results.jpg"/>  '; ?>

        </div> 
        <div class="mensaje-Principal">
          <div class="mensaje"> <b>Tus resultados</b> de la prueba de acondicionamiento físico han sido publicados</div>
          <div class="mensaje-info">Hace 30 minutos</div>
        </div>
      </a>
    </li>

     <!--============================== Notificaciones 2 ==================================-->
    <li class="notif noLeido">
      <a style="text-decoration:none" href="#">
        <div class="imagenNotif"> 

          <?php echo '<img class="imagenNotif-Principal" src="'.IMG.'medical.jpg"/>  '; ?>

        </div> 
        <div class="mensaje-Principal">
          <div class="mensaje"><b>Cita de revisión médica</b> programada.</div>
          <div class="mensaje-info">Hace 2 horas</div>
        </div>
      </a>
    </li>

  </div>
  
  <!--============================== Link restos de los mensajes ================================-->

  <li class="verMas">
    <a>Ver Todas las Notificaciones</a>
  </li>

</ul>
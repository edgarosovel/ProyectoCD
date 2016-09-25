<ul id="notificationMenu" class="notificaciones">

  <!--=============================== Titulo Notificacion =====================================-->
  <li class="titulo">
    <span class="title">Mensajes</span>
  </li>

  <!--============================== Notificaciones visibles ==================================-->

  <div class="cajaNotif" id="estilo-scroll">

    <!--============================== Notificaciones 1 ==================================-->
    <li class="notif noLeido">
      <a style="text-decoration:none" href="">
        <div class="imagenNotif"> 

          <?php echo '<img class="imagenNotif-Principal" src="'.IMG.'grecia.jpg"/>  '; ?>

        </div> 
        <div class="mensaje-Principal">
          <div class="autor">Grecia Zavala</div>
          <div class="mensaje">Juan Pablo, no olvides que mañana es el entrenamiento</div>
          <div class="mensaje-info">Hace 2 horas</div>
        </div>
      </a>
    </li>
    
    <!--============================== Notificaciones 2 ==================================-->
    <li class=" notif noLeido">
      <a style="text-decoration:none" href="#">
        <div class="imagenNotif"> 

          <?php echo '<img class="imagenNotif-Principal" src="'.IMG.'vargas.jpg"/>  '; ?>

        </div> 
        <div class="mensaje-Principal">
          <div class="autor">Alejandro Vargas Díaz</div>
          <div class="mensaje">Juan Pablo, mañana tenemos partido a las 4:00 p.m. </div>
          <div class="mensaje-info">Hace 3 horas</div>
        </div>
      </a>
    </li>

    <!--============================== Notificaciones 3 ==================================-->
    <li class=" notif ">
      <a style="text-decoration:none" href="#">
        <div class="imagenNotif"> 

          <?php echo '<img class="imagenNotif-Principal" src="'.IMG.'carolina.jpg"/>  '; ?>

        </div> 
        <div class="mensaje-Principal">
          <div class="autor">Carolina Camanera</div>
          <div class="mensaje">Mañana tenemos que presentarnos en la Unidad Médica de la UAQ</div>
          <div class="mensaje-info">Ayer</div>
        </div>
      </a>
    </li>

  </div>
  
  <!--============================== Link restos de los mensajes ================================-->

  <li class="verMas">
    <a>Ver Todos los Mensajes</a>
  </li>

</ul>
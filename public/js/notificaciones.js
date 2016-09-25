jQuery(document).ready(function () {
  $(".mensajes").click(function () {

  	$("#notificationMenu").removeClass("close");
   	$("#notificationMenu").toggleClass("open");
   	$("#notificationMenuNoti").removeClass("open").addClass("close");
	return false;
		
   })
})

jQuery(document).ready(function () {
 	jQuery(document).click(function () {
		if($("#notificationMenu").hasClass('open')) { 

			$("#notificationMenu").removeClass("open").addClass("close");	
		}

	})

})

jQuery(document).ready(function () {
  $(".notificaciones-boton").click(function () {
  	$("#notificationMenuNoti").removeClass("close");
   	$("#notificationMenuNoti").toggleClass("open");
   	$("#notificationMenu").removeClass("open").addClass("close");

	return false;
		
   })
})

jQuery(document).ready(function () {
 	jQuery(document).click(function () {
		if($("#notificationMenuNoti").hasClass('open')) { 

			$("#notificationMenuNoti").removeClass("open").addClass("close");	
		}

	})

})


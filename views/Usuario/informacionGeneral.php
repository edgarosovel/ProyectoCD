<!DOCTYPE html>

<html lang="es">
  <head>
  	<title>Inicio</title>
  	<meta charset="utf-8">

  	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style-general.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>style-alumno.css">

  	<script type="text/javascript" src="<?php echo JS; ?>jquery-1.11.0.min.js"></script>
  	<script type="text/javascript" src="<?php echo JS; ?>notificaciones.js"></script>
  </head>
<body>

  <?php $this->render('Default','menuPrincipal',true); ?>

  <div class="contenedor-general">

		<h1>Información general de la cuenta</h1>

		<div class="contenedor-informacion div12">
			<table width="90%">
	   		<?php 
	   		foreach ($this->informacionGeneral as $dato => $valor) {
	   			if($valor[0] != 'NA') {
	   		?>
	   		<tr>
	   			<td width="20%"><?php echo $dato; ?></td>
	   			<td width="70%"><?php echo $valor[0]; ?></td>
	   			<td width="10%"><?php if($valor[1]){echo "<a onclick=\"alert('hola');\">Editar</a>";} ?></td>
	   		</tr>
	   		<?php } } ?>
	   	</table>
		</div>
	</div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Procesar inscripción / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
  </head>
  <body>
	<?php
	
		include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$nombre = $_REQUEST['nombre'];
		$apellido = $_REQUEST['apellido'];
		$email = $_REQUEST['email'];
		$telefono = $_REQUEST['telefono'];
		$empresa = $_REQUEST['empresa'];
		
		mysqli_query($conexion,"insert into inscripcion(nombre,apellido,email,telefono,empresa) values ('$nombre','$apellido','$email','$telefono','$empresa')")
			or die("Problemas con el insert de los servicios");
	
	?>
    <div id="strip"></div>
    <header class="grupo">
      <div class="caja tablet-50 web-50">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--check">
          <div id="royalito-check"><img src="img/royalito.png"></div>
          <div id="base--globo"><img src="img/globo-cyan.png"></div>
          <p class="garabatos">Estamos Listos!</p>
        </div>
      </div>
      <div class="caja tablet-50 web-50">
        <div id="alerta">
          <h1>Tus datos ya han sido procesados</h1>
        </div>
      </div>
    </header>
  </body>
</html>
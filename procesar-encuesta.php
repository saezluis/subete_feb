<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Encuesta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
  </head>
  <body>
    <div id="strip"></div>
    <header class="grupo">
      <div class="caja tablet-50 web-50">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--check">
          <div id="royalito-check"><img src="img/royalito.png"></div>
          <div id="base--globo"><img src="img/globo-cyan.png"></div>
          <div id="check-verde"><img src="img/check_verde.png"></div>
        </div>
      </div>
      <div class="caja tablet-50 web-50">
        <div id="alerta">
          <h1>¡Gracias por tu tiempo! </h1>
          <p class="normal-text">Tu opinión es muy importante para seguir mejorando nuestros servicios.</p>
        </div><a href="encuesta.php" class="ir-encuesta">volver a la encuesta </a>
      </div>
    </header>
	<?php
		
		include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		//$pregunta1_si = @$_REQUEST['radioRockSi'];
		//$pregunta1_no = @$_REQUEST['radioRockNo'];
		
		if(@$_REQUEST['radioRockSi'] != ''){
			$pregunta1 = @$_REQUEST['radioRockSi'];
		}else{
			$pregunta1 = @$_REQUEST['radioRockNo'];
		}
		
		if(@$_REQUEST['radioPopSi'] != ''){
			$pregunta2 = @$_REQUEST['radioPopSi'];
		}else{
			$pregunta2 = @$_REQUEST['radioPopNo'];
		}
		
		if(@$_REQUEST['radioCumbiaSi'] != ''){
			$pregunta3 = @$_REQUEST['radioCumbiaSi'];
		}else{
			$pregunta3 = @$_REQUEST['radioCumbiaNo'];
		}
		
		if(@$_REQUEST['radioBaladaSi'] != ''){
			$pregunta4 = @$_REQUEST['radioBaladaSi'];
		}else{
			$pregunta4 = @$_REQUEST['radioBaladaNo'];
		}
		
		if(@$_REQUEST['radioJazzSi'] != ''){
			$pregunta5 = @$_REQUEST['radioJazzSi'];
		}else{
			$pregunta5 = @$_REQUEST['radioJazzNo'];
		}
		/*
		echo "respuesta 1: ".$pregunta1;
		echo "<br>";
		echo "respuesta 2: ".$pregunta2;
		echo "<br>";
		echo "respuesta 3: ".$pregunta3;
		echo "<br>";
		echo "respuesta 4: ".$pregunta4;
		echo "<br>";
		echo "respuesta 5: ".$pregunta5;
		*/
		
		$escala = $_REQUEST['escala'];
		
		mysqli_query($conexion,"insert into encuesta_lanzamiento(respuesta1,respuesta2,respuesta3,respuesta4,respuesta5,respuesta6) values 
																		('$pregunta1',
																		'$pregunta2',
																		'$pregunta3',
																		'$pregunta4',
																		'$pregunta5',
																		'$escala')")
			or die("Problemas con el insert de los servicios");
			
			
		
	?>
  </body>
</html>
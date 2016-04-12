<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Inscríbete / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="main.js"></script>
    <script src="js/scripts-min.js"></script>
	
	<link rel="stylesheet" href="main.css">
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-70018861-1', 'auto');
	  ga('send', 'pageview');

	</script>
	
	<script type = "text/javascript" >
		history.pushState(null, null, 'procesar-inscribete.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'procesar-inscribete.php');
		});
    </script>
	
  </head>
  <body class="noBack">
	<!--
	<div id="boxes">
		<div style="display: none; background:url(strip.jpg) no-repeat #fff; width:450px !important;" id="dialog" class="window centrado-porcentual"> 
			<h1>Súbete al programa donde todos crecemos, siguiendo estas indicaciones.</h1>
			<div id="lorem">
				<ul class="lista-pop">
					<li>Ingresa tu rut sin puntos ni dígito verificador.</li>
					<li>*ingresa tu clave (tres últimos dígitos de tu rut)</li>
				</ul>
			</div>
			<div id="popupfoot"> <a href="#" class="close agree acept-ok">Aceptar</a></div>
		</div>
		<div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
	</div>
	-->
	<?php
	
		include_once 'config.php';

		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$nombre = $_REQUEST['nombre'];
		$rut = $_REQUEST['rut'];
		$email = $_REQUEST['email'];
		$cargo = $_REQUEST['cargo'];
		
		date_default_timezone_set("America/Santiago");
		$date =  date("Y-m-d h:i:sa");
		$timestamp = date('Y-m-d H:i:s', strtotime($date));
		
		mysqli_query($conexion,"INSERT INTO pre_registro(nombre,rut,email,cargo,fecha) VALUES ('$nombre','$rut','$email','$cargo','$timestamp') ") or die("Problemas en el select de pre_registro:".mysqli_error($conexion));
		
		$user = $email;
		$usersubject = "Nuevo pre-registro en página de subete";
		$userheaders = "From: Servidor Subete";
		$usermessage = "Datos dejados por el usuario. Nombre: ".$nombre." Rut: ".$rut." email: ".$email." cargo: ".$cargo;
	
		mail($user,$usersubject,$usermessage,$userheaders);
	
	?>
    <div id="strip"></div>
    <header class="grupo">
      <div class="caja base-100">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--blue">
          <div id="royalito"><img src="img/royalito.png" class="topR"></div>
          <div id="linea_texto"><img src="img/globo.png">
            <h2>Te invitamos a ser parte del programa de beneficios de Royal Rental.</h2>
          </div>
        </div>
      </div>
      <div class="caja web-100">
        <div id="box--login">
          <h2 class="insc_log">Gracias por regitrar tus datos, te contactaremos a la brevedad para que puedas acceder al programa</h2>          
			<form method="POST" action="login.php">
				<button type="submit">Aceptar</button>
			</form>
            <div class="caja no-padding">
				<!--
              <button class="recuperar">Recuperar contraseña</button>
			  -->
            </div>
          
        </div>
      </div>
    </header>
  </body>
</html>
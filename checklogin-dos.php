<!DOCTYPE html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
  </head>
</html>
<?php

/* start the session */
session_start();

	include_once 'config.php';
	
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	//$acentos = $conexion->query("SET NAMES 'utf8'");
	
	 $host_db = "localhost";
	 $user_db = "root";
	 $pass_db = "123";
	 $db_name = "subete";
	 $tbl_name = "cuenta";

		// Connect to server and select databse.
		$con=mysqli_connect("$host_db", "$user_db", "$pass_db")or die("Cannot Connect to Data Base.");

		mysqli_select_db($con,"$db_name")or die("Cannot Select Data Base");

		// sent from form
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql= "SELECT * FROM $tbl_name WHERE rut = '$username' and password ='$password'";
		$result=mysqli_query($con,$sql);

		// counting table row
		$count = mysqli_num_rows($result);
		// If result matched $username and $password
		
		//$sqlInternos = "SELECT * FROM internos WHERE rut = '$username' and clave ='$password'";
		//$resultInternos = mysqli_query($con,$sqlInternos);
		//$count_internos = mysqli_num_rows($resultInternos);

		if($count == 1){

			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (100 * 100 * 60) ;//ojo quitarle las 3 horas a la sesion
	
			if($reg=mysqli_fetch_array($result)){
				$postRegistro = $reg['postRegistro'];
				$sistema_web = $reg['sistema_web'];
			}
			
			if($postRegistro == 'si'){
				header("Location:index.php");				
			}
			
			if($sistema_web == 'externo'){
				header("Location:index.php");				
			}
			
			if($sistema_web == 'unilever'){
				header("Location:index.php");				
			}
			
			if($postRegistro == 'no'){
				header("Location:login-form.php");
			}
			
			//echo "<br> Bienvenido! " . $_SESSION['username'];
			
		}
		
		/*
		elseif($count_internos == 1){
		
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (100 * 100 * 60) ;//ojo quitarle las 3 horas a la sesion
	
			$registrosInternos = mysqli_query($conexion,"SELECT * FROM internos WHERE rut = $username ") or die("Problemas con el insert de los servicios");
			//Buscar el nombre del usuario con el Rut
			//$contarRegistrosInternos = mysqli_num_rows($registrosInternos);
			
			if($reg=mysqli_fetch_array($registrosInternos)){
				$postRegistro = $reg['postRegistro'];				
			}
			
			if($postRegistro == 'si'){
				header("Location:index.php");				
			}
			
			if($postRegistro == 'no'){
				header("Location:login-form.php");
			}
			
		}*/
		
		else{
			echo "<div id=\"strip\"></div>";
			echo "<header class=\"grupo\">";
				echo "<div class=\"caja tablet-50 web-50\">";
				echo "<div id=\"logo\" class=\"arriba\"><img src=\"img/logo.png\"></div>";
					echo "<div id=\"box--check\">";
						echo "<div id=\"royalito-check\"><img src=\"img/royalito.png\"></div>";
						echo "<div id=\"base--globo\"><img src=\"img/globo-cyan.png\"></div>";
							echo "<p class=\"garabatos\">#!$:@%=#!$:@%=</p>";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"caja tablet-50 web-50\">";
					echo "<div id=\"alerta\">";
						echo "<h1>Algo ocurrió mal :(</h1>";
						echo "<p class=\"alarm\">Tu correo o contraseña está incorrecta, haz click <a href=\"login.php\">aquí </a> para volver a intentarlo.<br>";

					echo "</div>";
				echo "</div>";
			echo "</header>";
		}
?>
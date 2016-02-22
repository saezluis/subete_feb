<!DOCTYPE html>
<html lang="es">
  <head><meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Inicio / Subete</title>
	
  </head>
 <body>
	<?php
		
	include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,'program4_bdcutcl') or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");

		$registrosComuna=mysqli_query($conexion,"select * from comuna") or die("Problemas en el select:".mysqli_error($conexion));
		
	?>
	<form method="post" action="procesarRegistroUsuario.php">
		<li>Nombre: <input type="text" name="nombre"> </li>
		<br>
		<li>Apellido Paterno: <input type="text" name="apellido_paterno"></li>
		<br>
		<li>Apellido Materno: <input type="text" name="apellido_materno"></li>
		<br>
		<li>Sexo: <select name="sexo">
					<option value="masculino">Masculino</option>
					<option value="femenino">Femenino</option>
				  </select></li>
		<br>
		<li>Fecha nacimiento: <input type="text" name="fecha_nacimiento"></li>
		<br>
		<li>Rut: <input type="text" name="rut"></li>
		<br>
		<li>Password: <input type="text" name="pass"></li>
		<br>
		<li>Telefono/Movil: <input type="text" name="telefono"></li>
		<br>
		<li>Comuna residencia: <select name="comuna">
					<?php
					while($reg=mysqli_fetch_array($registrosComuna)){					
						$nombreComuna = $reg['COMUNA_NOMBRE'];	
						echo "<option value=\"$nombreComuna\">$nombreComuna</option>";
					}					
					?>
				  </select>
		
		<!--
		<input type="text" name="comuna_residencia">
		-->
		</li>
		<br>
		<li>Correo electronico: <input type="text" name="email"></li>
		<br>		
		<li><textarea name="temas_interes"> Temas de interes:</textarea></li>
		<br>
		<button type="submit">Enviar</submit>			
	</form>
	<!--
	nombre                    varchar(60)
	apellido_paterno       varchar(60)
	apellido_materno      varchar(60)
	sexo                        varchar(15)
	fecha_nacimiento     date
	rut                           varchar(15)
	telefono                    varchar(25) 
	comuna_residencia   varchar(60) 
	email                        varchar(60) 
	password                  varchar(60)
	temas_interes           text
	-->	
 </body>
 </html>
 
 
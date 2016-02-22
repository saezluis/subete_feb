<?php

	$asunto = $_REQUEST['asunto'];
	$comentario = $_REQUEST['comentario'];
	
	include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
	mysqli_query($conexion,"insert into contacto(asunto,comentario) values ('$asunto','$comentario')")
			or die("Problemas con el insert de los servicios");	
	
	echo "Informacion recibida";
	echo "<br>";
	echo "<a href=\"index.php\">Volver al inicio</a>";
	
?>
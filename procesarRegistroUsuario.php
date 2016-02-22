<?php
	
	//Aqui recibo los datos del formulario anterior
	//$rut = '19447431';
	//RUT correspondería al número, sin puntos, comas ni comas y sin dígito verificador
	
	//genero clave hash a partir del rut entregado		
	//$hash = md5($rut);
	
	//echo "clave hash: ".$hash;
	//Cargo los datos del usuario
	
	$nombre = $_REQUEST['nombre'];
	$apellido_paterno = $_REQUEST['apellido_paterno'];
	$apellido_materno = $_REQUEST['apellido_materno'];
	$sexo = $_REQUEST['sexo'];
	$fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
	$rut = $_REQUEST['rut'];
	$pass = $_REQUEST['pass'];
	$telefono = $_REQUEST['telefono'];
	$comuna_residencia = $_REQUEST['comuna_residencia'];
	$email = $_REQUEST['email'];
	$temas_interes = $_REQUEST['temas_interes'];
	
	$hash = md5("45!$32d".$rut);
	
	echo "rut: ".$rut;
	echo "<br>";
	echo "hash: ".$hash;
	echo "<br>";
	
	
	$ch = curl_init();                   
	
	$url = "http://convenios.programasubete.cl/autoregister/$rut/$hash"; 
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, true);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, "nombre=$nombre&apellidop=$apellido_paterno&apellidom=$apellido_materno&sexo=$sexo&fecha_nacimiento=$fecha_nacimiento&rut=$rut&password=$pass&telefono=$telefono&comuna_residencia=$comuna_residencia&email=$email&temas_interes=$temas_interes"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$output = curl_exec ($ch); 	 
	curl_close ($ch); 	
	//Solo a manera de prueba muestro la salida
	var_dump($output); 
	
	echo "<br>";
	
	include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
	mysqli_query($conexion,"insert into cuenta(nombre,apellido_paterno,apellido_materno,sexo,fecha_nacimiento,rut,hash,telefono,comuna_residencia,email,password,temas_interes) values 
									('$nombre',
									 '$apellido_paterno',
									 '$apellido_materno',
									 '$sexo',
									 '$fecha_nacimiento',
									 '$rut',
									 '$hash',
									 '$telefono',
									 '$comuna_residencia',
									 '$email',
									 '$pass',
									 '$temas_interes'
									 )")
	or die("Problemas con el insert de los servicios");
	
	echo "Usuario Registrado..";
	
	echo "<br>";
	echo "<br>";
	echo "<a href=\"registroUsuario.php\">Volver</a>";
?>











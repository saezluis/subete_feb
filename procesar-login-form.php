<?php

include_once 'config.php';
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

//Datos usuario interno:

//Verificar las claves y si no coinciden enviar el mensaje de error

$rut_usuario = $_REQUEST['rut_usuario'];
$nombre_usuario = $_REQUEST['nombre_usuario'];
$apellido_paterno_usuario = $_REQUEST['apellido_paterno_usuario'];
$fecha_nacimiento_usuario = $_REQUEST['apellido_paterno_usuario'];
$telefono_usuario = $_REQUEST['telefono_usuario'];
$mail_usuario = $_REQUEST['mail_usuario'];
$area_trabajo_usuario = $_REQUEST['area_trabajo_usuario'];
$password = $_REQUEST['password'];
$password_repetir = $_REQUEST['password_repetir'];

//Aqui hago un update del usuario
//Verifico que las claves coincidan
if($password!=$password_repetir){
	echo "Error: Las claves no coinciden";
	echo "<a href=\"new-login.php\">Volver</a>";
}else{
	mysqli_query($conexion, "UPDATE cuenta SET telefono='$telefono_usuario' , email='$mail_usuario' , password = '$password_repetir' , postRegistro = 'si' ,
									sistema_web = 'interno' , foto_perfil = 'user.jpg' WHERE rut='$rut_usuario' ") or
									die("Problemas en el select:".mysqli_error($conexion));
}
	
$opciones = $_REQUEST['opciones'];

if($opciones=='opcion1'){
	header("Location: new-login.php");
}

if($opciones=='opcion2'){
	
		//Datos Conyuge:

	$nombre_conyuge = $_REQUEST['nombre_conyuge'];
	$apellido_paterno_conyuge = $_REQUEST['apellido_paterno_conyuge'];
	$apellido_materno_conyuge = $_REQUEST['apellido_materno_conyuge'];
	$fecha_nacimiento_conyuge = $_REQUEST['fecha_nacimiento_conyuge'];
	$rut_conyuge = $_REQUEST['rut_conyuge'];
	$isapre_conyuge = $_REQUEST['isapre_conyuge'];

	//Datos hijo 01:

	$nombre_hijo_01 = $_REQUEST['nombre_hijo_01'];
	$apellido_paterno_hijo_01 = $_REQUEST['apellido_paterno_hijo_01'];
	$apellido_materno_hijo_01 = $_REQUEST['apellido_materno_hijo_01'];
	$fecha_nacimiento_hijo_01 = $_REQUEST['fecha_nacimiento_hijo_01'];
	$rut_hijo_01 = $_REQUEST['rut_hijo_01'];
	$sexo_hijo_01 = $_REQUEST['sexo_hijo_01'];
	$grado_escolar_hijo_01 = $_REQUEST['grado_escolar_hijo_01'];
	$isapre_hijo_01 = $_REQUEST['isapre_hijo_01'];

	//Datos hijo 02:

	$nombre_hijo_02 = $_REQUEST['nombre_hijo_02'];
	$apellido_paterno_hijo_02 = $_REQUEST['apellido_paterno_hijo_02'];
	$apellido_materno_hijo_02 = $_REQUEST['apellido_materno_hijo_02'];
	$fecha_nacimiento_hijo_02 = $_REQUEST['fecha_nacimiento_hijo_02'];
	$rut_hijo_02 = $_REQUEST['rut_hijo_02'];
	$sexo_hijo_02 = $_REQUEST['sexo_hijo_02'];
	$grado_escolar_hijo_02 = $_REQUEST['grado_escolar_hijo_02'];
	$isapre_hijo_02 = $_REQUEST['isapre_hijo_02'];

	//Datos hijo 03:

	$nombre_hijo_03 = $_REQUEST['nombre_hijo_03'];
	$apellido_paterno_hijo_03 = $_REQUEST['apellido_paterno_hijo_03'];
	$apellido_materno_hijo_03 = $_REQUEST['apellido_materno_hijo_03'];
	$fecha_nacimiento_hijo_03 = $_REQUEST['fecha_nacimiento_hijo_03'];
	$rut_hijo_03 = $_REQUEST['rut_hijo_03'];
	$sexo_hijo_03 = $_REQUEST['sexo_hijo_03'];
	$grado_escolar_hijo_03 = $_REQUEST['grado_escolar_hijo_03'];
	$isapre_hijo_03 = $_REQUEST['isapre_hijo_03'];

	//Datos hijo 04:

	$nombre_hijo_04 = $_REQUEST['nombre_hijo_04'];
	$apellido_paterno_hijo_04 = $_REQUEST['apellido_paterno_hijo_04'];
	$apellido_materno_hijo_04 = $_REQUEST['apellido_materno_hijo_04'];
	$fecha_nacimiento_hijo_04 = $_REQUEST['fecha_nacimiento_hijo_04'];
	$rut_hijo_04 = $_REQUEST['rut_hijo_04'];
	$sexo_hijo_04 = $_REQUEST['sexo_hijo_04'];
	$grado_escolar_hijo_04 = $_REQUEST['grado_escolar_hijo_04'];
	$isapre_hijo_04 = $_REQUEST['isapre_hijo_04'];

	//Datos hijo 05:

	$nombre_hijo_05 = $_REQUEST['nombre_hijo_05'];
	$apellido_paterno_hijo_05 = $_REQUEST['apellido_paterno_hijo_05'];
	$apellido_materno_hijo_05 = $_REQUEST['apellido_materno_hijo_05'];
	$fecha_nacimiento_hijo_05 = $_REQUEST['fecha_nacimiento_hijo_05'];
	$rut_hijo_05 = $_REQUEST['rut_hijo_05'];
	$sexo_hijo_05 = $_REQUEST['sexo_hijo_05'];
	$grado_escolar_hijo_05 = $_REQUEST['grado_escolar_hijo_05'];
	$isapre_hijo_05 = $_REQUEST['isapre_hijo_05'];

	//Aqui comienza el codigo para insertar en BBDD

	$nombre_hijo_01 = $_REQUEST['nombre_hijo_01'];
	$apellido_paterno_hijo_01 = $_REQUEST['apellido_paterno_hijo_01'];
	$apellido_materno_hijo_01 = $_REQUEST['apellido_materno_hijo_01'];
	$fecha_nacimiento_hijo_01 = $_REQUEST['fecha_nacimiento_hijo_01'];
	$rut_hijo_01 = $_REQUEST['rut_hijo_01'];
	$sexo_hijo_01 = $_REQUEST['sexo_hijo_01'];
	$grado_escolar_hijo_01 = $_REQUEST['grado_escolar_hijo_01'];
	$isapre_hijo_01 = $_REQUEST['isapre_hijo_01'];

		if($nombre_hijo_01!=''){
			mysqli_query($conexion,"INSERT INTO hijo(aqui van los campos de la BBDD) values 
																('$nombre_hijo_01',
																'$apellido_paterno_hijo_01',
																'$apellido_materno_hijo_01',
																'$fecha_nacimiento_hijo_01',
																'$rut_hijo_01',
																'$sexo_hijo_01',
																'$grado_escolar_hijo_01',
																'$isapre_hijo_01')")
					or die("Problemas con el insert de los servicios");
			//aqui hago el insert del hijo
		}else{
			//aqui descargo los warning de php
		}
}




?>			
	
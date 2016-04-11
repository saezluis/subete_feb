<?php
	
	//Aqui recibo los datos del formulario anterior
	//$rut = '19447431';
	//RUT correspondería al número, sin puntos, comas ni comas y sin dígito verificador
	
	//genero clave hash a partir del rut entregado		
	//$hash = md5($rut);
	
	//echo "clave hash: ".$hash;
	//Cargo los datos del usuario
	
	//Parte donde se realiza la carga de la foto
	$xd = basename($_FILES["fileToUpload"]["name"]);
	
	if($xd!=''){
		
	
		$target_dir = "img/img-perfil/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "El archivo es una imagen - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				//echo "El archivo no es una imagen.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			//echo "Lo sentimos, el archivo ya existe.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
			//echo "Lo sentimos, el archivo es muy grande.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			//echo "Lo sentimos, solo archivos JPG, JPEG, PNG & GIF son permitidos.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			//echo "Lo sentimos, su archivo no fue cargado.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}
		
	}	
		
		if($xd!=''){
				$nombreFoto = basename($_FILES["fileToUpload"]["name"]);
			}else{
				$nombreFoto = $_REQUEST['fotoPerfil_send'];
		}	
	
	//echo "nombre foto: ".$nombreFoto;
	
	
	$nombre = $_REQUEST['nombre'];
	$apellido_paterno = $_REQUEST['apellido_paterno'];
	$apellido_materno = $_REQUEST['apellido_materno'];
	$sexo = $_REQUEST['sexo'];
	$fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
	$rut = $_REQUEST['rut'];
	$pass = $_REQUEST['pass'];
	$telefono = $_REQUEST['telefono'];
	$comuna = $_REQUEST['comuna'];
	$email = $_REQUEST['email'];
	$temas_interes = $_REQUEST['temas_interes'];
	$area_trabajo = $_REQUEST['seccion'];
	$fotoPerfil = $nombreFoto;
	
	$hash = md5("45!$32d".$rut);
	
	include_once 'config.php';
		
	$newDate = date("Y-m-d", strtotime($fecha_nacimiento));		
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		mysqli_query($conexion, "update cuenta
								set nombre='$nombre',
								    apellido_paterno='$apellido_paterno',
									apellido_materno='$apellido_materno',
									sexo='$sexo',
									fecha_nacimiento='$newDate',
									rut='$rut',
									hash='$hash',
									telefono='$telefono',
									comuna_residencia='$comuna',
									email='$email',
									password='$pass',
									temas_interes='$temas_interes',
									seccion='$area_trabajo',
									foto_perfil='$fotoPerfil'
									where rut='$rut'") or
									die("Problemas en el select:".mysqli_error($conexion));
		
		@$nombre_conyuge = $_REQUEST['nombre_conyuge'];
		@$apellido_paterno_conyuge = $_REQUEST['apellido_paterno_conyuge'];
		@$apellido_materno_conyuge = $_REQUEST['apellido_materno_conyuge'];
		@$fecha_nacimiento_conyuge = $_REQUEST['fecha_nacimiento_conyuge'];
		@$rut_conyuge = $_REQUEST['rut_conyuge'];
		@$carga_conyuge = $_REQUEST['carga_conyuge'];
		
		if(@$nombre_conyuge!=''){
			
			mysqli_query($conexion, "update conyuge
									set nombre='$nombre_conyuge',
										apellido_paterno='$apellido_paterno_conyuge',
										apellido_materno='$apellido_materno_conyuge',
										fecha_nacimiento='$fecha_nacimiento_conyuge',
										rut='$rut_conyuge',										
										carga='$carga_conyuge'
										where id_interno='$rut'") or
										die("Problemas en el select de conyuge".mysqli_error($conexion));
		}
		
		//Trabajar en el actualizar hijos
		$contador_hijos = $_REQUEST['contador_hijos'];
		
		$varX_son = 0;
		
		for ($x = 1; $x <= $contador_hijos; $x++) {
			//echo "Hijo: $x <br>";
			$varX_son = $varX_son + 1;
			
			$id_son = 'id_son'.$x;
			$id_son_put = $_REQUEST[$id_son];
			
			$nameVar_son = "nameson".$varX_son;
			$nombre_hijo = $_REQUEST[$nameVar_son];
			
			$apellidoPa_son = "apellidoPa".$varX_son;
			$apellido_paterno_hijo = $_REQUEST[$apellidoPa_son];
			
			$apellidoMa_son = "apellidoMa".$varX_son;
			$apellido_materno_hijo = $_REQUEST[$apellidoMa_son];
			
			$fechaNA_son = "fechaNA_son".$varX_son;
			$fecha_nacimiento_hijo = $_REQUEST[$fechaNA_son];
			
			$rut_son = "rut_son".$varX_son;
			$rut_hijo = $_REQUEST[$rut_son];
			
			$sexo_son = "sexo_son".$varX_son;
			$sexo_hijo = $_REQUEST[$sexo_son];
			
			$grado_son = "grado_son".$varX_son;
			$grado_hijo = $_REQUEST[$grado_son];
			
			$carga_son = "carga_son".$varX_son;
			$carga_hijo = $_REQUEST[$carga_son];
			
			mysqli_query($conexion, "update hijos
									set nombre='$nombre_hijo',
										apellido_paterno='$apellido_paterno_hijo',
										apellido_materno='$apellido_materno_hijo',
										fecha_nacimiento='$fecha_nacimiento_hijo',
										rut='$rut_hijo',
										sexo='$sexo_hijo',
										grado_escolar='$grado_hijo',
										carga='$carga_hijo'
										where id_hijo='$id_son_put'") or
										die("Problemas en el select de conyuge".mysqli_error($conexion));
		}
		

	echo "Datos Actualizados";

	header('Location: mi-cuenta.php');
	//header('Location: http://www.programasubete.cl/subete/mi-cuenta.php');

	
?>
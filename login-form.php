<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	}else{
		header('Content-Type: text/html; charset=UTF-8'); 
		echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
		exit;
	}

	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
		session_destroy();
		echo "<br/><br />" . "Su sesion a terminado, <a href='login.php'> Necesita Hacer Login</a>";
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Completa tus datos / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <!--
	<script src="js/scripts-min.js"></script>
	-->
	<script src="js/jquery-2.2.0.min.js"></script>
	
	
	<link rel="stylesheet" href="site-demos.css">
	
	
	<script>
	
	//alert('xd');
	
	$(document).ready(function() {
	
		
		$("#div2").hide();
		$("#div3").hide();
		$("#div4").hide();
		$("#div5").hide();
		$("#div6").hide();
		$("#divX").hide();
		
		/*
		$("#removeSon01").click(function() {
			$("#divX").hide();
			$("#botonX").show();
		});
		
		$("#removeSon02").click(function() {
			$("#div3").hide();
			$("#boton3").show();
		});
		
		$("#removeSon03").click(function() {
			$("#div4").hide();
			$("#boton4").show();
		});
		
		$("#removeSon04").click(function() {
			$("#div5").hide();
			$("#boton5").show();
		});
		
		$("#removeSon05").click(function() {
			$("#div6").hide();
			$("#boton6").show();
		});
		*/
		
		$("#cargas").click(function () {
			if ($(this).prop('checked') === true) {
				$('#div2').show();
				//$('#mynumberfield').show();
				//$('input[name="mytextfield"]').prop('required',true);
				//$('input[name="mynumberfield"]').prop('required',true);
			} else {
				$('#div2').hide();
				//$('#mynumberfield').hide();
				//$('input[name="mytextfield"]').prop('required',false);
				//$('input[name="mynumberfield"]').prop('required',false);        
			}
		});
		
		$("#Hijo1").click(function () {
			if ($(this).prop('checked') === true) {
				$('#divX').show();
				//$('#mynumberfield').show();
				//$('input[name="mytextfield"]').prop('required',true);
				//$('input[name="mynumberfield"]').prop('required',true);
			} else {
				$('#divX').hide();
				//$('#mynumberfield').hide();
				//$('input[name="mytextfield"]').prop('required',false);
				//$('input[name="mynumberfield"]').prop('required',false);        
			}
		});
			/*
			$("#opcion1").click(function() {
				$("#div1").show();
				$("#div2").hide();
			});
			*/
			/*
			$("#opcion2").click(function() {
				$("#div1").hide();
				$("#div2").show();
			});
			*/
			/*
			$("#opcion3").click(function() {
				$("#boton3").hide();			
				$("#div3").show();
			});
			
			$("#opcion4").click(function() {
				$("#boton4").hide();			
				$("#div4").show();
			});
			
			$("#opcion5").click(function() {
				$("#boton5").hide();			
				$("#div5").show();
			});
			
			$("#opcion6").click(function() {
				$("#boton6").hide();			
				$("#div6").show();
			});
			*/
			
			/*
			$("#Hijo1").click(function() {
				$("#botonX").hide();			
				$("#divX").show();
			});
			*/
	});
	
	</script>
	
	<script type = "text/javascript" >
	
		function validarClaves() {			
		
			var clave_uno = document.getElementById("clave01").value;
			var clave_dos = document.getElementById("clave02").value;
			
			if(clave_uno==clave_dos){				
				return true;
			}else{				
				alert("Las claves no coinciden");
				return false;
			}			
		}
		
	
	</script>
	
  </head>
  <?php
	
	$rut_sesion = $_SESSION['username'];
	
	include_once 'config.php';
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosInternos=mysqli_query($conexion,"SELECT * FROM internos WHERE rut = '$rut_sesion'") or die("Problemas en el select:".mysqli_error($conexion));
	
	if($reg=mysqli_fetch_array($registrosInternos)){
		
		$nombre = $reg['nombre'];
		$apellido_materno = $reg['apellido_materno'];
		$apellido_paterno = $reg['apellido_paterno'];
		$fecha_nacimiento = $reg['fecha_nacimiento'];
		$seccion = $reg['seccion'];
		
	}
	
  ?>
  <body class="noBack">
    <div id="strip"></div>
    <header class="nono grupo">
      <div class="caja base-100 web-100">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
      </div>
      <div class="TopBox">
        <div class="caja base-50">
          <div class="royalito_mono"><img src="img/royalito.png" alt=""></div>
        </div>
        <div class="caja base-50">
          <p class="noob">Al ingresar al Programa Súbete recibirás beneficios para ti y toda tu familia. </p>
        </div>
      </div>
    </header>
    <form id="myform" method="POST" action="procesar-login-form.php" class="Formulario-registro grupo">
      <fieldset>
        <p>Para comenzar, completa tus datos<span class="numerales circulo">1</span></p>
        <div class="caja base-100 tablet-50">
          <label for="">RUT</label>
          <?php echo "<input type=\"text\" value=\"$rut_sesion\" name=\"rut_usuario\" readonly>"; ?>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Nombre</label>
          <?php echo "<input type=\"text\" value=\"$nombre\" name=\"nombre_usuario\" readonly>"; ?>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Apellido Paterno</label>
          <?php echo "<input type=\"text\" value=\"$apellido_paterno\" name=\"apellido_paterno_usuario\" readonly>"; ?>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Fecha de nacimiento (AAAA-MM-DD)</label>
          <?php echo "<input type=\"text\" value=\"$fecha_nacimiento\" name=\"fecha_nacimiento_usuario\" readonly>"; ?>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Teléfono / móvil</label>
          <input type="text" name="telefono_usuario" required>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Mail</label>
          <input type="text" name="mail_usuario" required>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Área de trabajo</label>
          <?php echo "<input type=\"text\" value=\"$seccion\" name=\"area_trabajo_usuario\" readonly>"; ?>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Ingresa tu nueva contraseña</label>
          <input id="clave01" type="password" name="password" required>
        </div>
        <div class="caja base-100 tablet-50">
          <label>Repite tu nueva contraseña</label>
          <input id="clave02" type="password" name="password_repetir" onfocusout = "return validarClaves(); " required>
        </div>
        <div class="caja base-100 tablet-50"></div>
      </fieldset>
      <fieldset>
        <p>Datos de cargas familiares (opcional)<span class="numerales circulo">2</span></p>
		
        <div class="caja base-100">			
          <input id="cargas" type="checkbox" name="cargas_send" ><span class="Rbutt">Tengo cargas familiares</span>
        </div>

	<div id="div2">
	
        <div class="caja base-100">
          <p>Datos cónyuge</p>
        </div>
        <div class="estosDatos">
          <div class="caja base-100 tablet-50">
            <label for="">Nombre</label>
            <input type="text" id="nombreconyuge" name="nombreconyuge" > 
          </div>
          <div class="caja base-100 tablet-50">
            <label>Apellido paterno</label>
            <input type="text" id="apellido_paterno_conyuge" name="apellido_paterno_conyuge">
          </div>
          <div class="caja base-100 tablet-50">
            <label for="">Apellido materno</label>
            <input type="text" id="apellido_materno_conyuge" name="apellido_materno_conyuge">
          </div>
          <div class="caja base-100 tablet-50">
            <label>Fecha de nacimiento</label>
            <input type="text" id="fecha_nacimiento_conyuge" name="fecha_nacimiento_conyuge" placeholder="Formato: AAAA-MM-DD">
          </div>
          <div class="caja base-100 tablet-50">
            <label for="">RUT</label>
            <input type="text" id="rut_conyuge" name="rut_conyuge">
          </div>
          <div class="caja base-100 tablet-50">
            <label>Carga Isapre / Fonasa</label>
            <select name="isapre_conyuge" id="isapre_conyuge">
              <option value="">Elegir</option>
			  <option value="Isapre">Isapre</option>
			  <option value="Fonasa">Fonasa</option>
            </select>
          </div>
        </div>
		
		<div id="botonX" class="caja base-100">
			  <input id="Hijo1" type="checkbox" name="agregarHijo1">Agregar un hijo
		</div>
		
		<div id="divX">
		
			<div class="caja base-100 tablet-50">
			  <p>Datos Hijo 01</p>
			</div>
			<div class="estosDatos">
			  <div class="caja base-100 tablet-50">
				<label for="">Nombre</label>
				<input type="text" id="nombre_hijo_01" name="nombre_hijo_01">
			  </div>
			  <div class="caja base-100 tablet-50">
				<label>Apellido paterno</label>
				<input type="text" id="apellido_paterno_hijo_01" name="apellido_paterno_hijo_01">
			  </div>
			  <div class="caja base-100 tablet-50">
				<label for="">Apellido materno</label>
				<input type="text" id="apellido_materno_hijo_01" name="apellido_materno_hijo_01">
			  </div>
			  <div class="caja base-100 tablet-50">
				<label>Fecha de nacimiento</label>
				<input type="text" id="fecha_nacimiento_hijo_01" name="fecha_nacimiento_hijo_01" placeholder="Formato: AAAA-MM-DD">
			  </div>
			  <div class="caja base-100 tablet-50">
				<label for="">RUT</label>
				<input type="text" id="rut_hijo_01" name="rut_hijo_01">
			  </div>
			  <div class="caja base-100 tablet-50">
				<label>Sexo</label>
				<select name="sexo_hijo_01" id="sexo_hijo_01">
				  <option value="">Elegir</option>
				  <option value="Femenino">Femenino</option>
				  <option value="Masculino">Masculino</option>
				</select>
			  </div>
			  <div class="caja base-100 tablet-50">
				<label>Grado escolar</label>
				<select name="grado_escolar_hijo_01" id="grado_escolar_hijo_01">
				  <option value="">Elegir</option>
				  <option value="Nivel Parvulario">Nivel Parvulario</option>
				  <option value="Nivel Basico">Nivel Básico</option>
				  <option value="Nivel Medio">Nivel Medio</option>
				  <option value="Nivel Superior">Nivel Superior</option>
				</select>
			  </div>			 
			  <div class="caja base-100 tablet-50">
				<label>Carga Isapre / Fonasa</label>
				<select name="isapre_hijo_01" id="isapre_hijo_01">
				  <option value="">Elegir</option>
				  <option value="Isapre">Isapre</option>
				  <option value="Fonasa">Fonasa</option>
				</select>
			  </div>
			</div>
			
			<!--
			<div id="boton3" class="caja base-100">
			  <button type="button" value="" value="opcion3" id="opcion3" class="addChild">Agregar otro hijo</button>
			</div>
			-->
		
		</div>
		
	</div>
		
        <div class="caja base-100">
          <input type="submit" value="Registrase" class="reg" >
        </div>
      </fieldset>
    </form>	
	<script src="jquery.validate.min.js"></script>
	<script src="additional-methods.min.js"></script>
	<script>
	// just for the demos, avoids form submit
	jQuery.validator.setDefaults({
	  //debug: true,
	  success: "valid"
	});
	$( "#myform" ).validate({
	  rules: {
		nombreconyuge: {
		  required: "#cargas:checked"
		},
		apellido_paterno_conyuge: {
		  required: "#cargas:checked"
		},
		apellido_materno_conyuge: {
		  required: "#cargas:checked"
		},
		fecha_nacimiento_conyuge: {
		  required: "#cargas:checked"
		},
		rut_conyuge: {
		  required: "#cargas:checked"
		},
		isapre_conyuge: {
		  required: "#cargas:checked"
		},
		nombre_hijo_01: {
		  required: "#Hijo1:checked"
		},
		apellido_paterno_hijo_01: {
		  required: "#Hijo1:checked"
		},
		apellido_materno_hijo_01: {
		  required: "#Hijo1:checked"
		},
		fecha_nacimiento_hijo_01: {
		  required: "#Hijo1:checked"
		},
		rut_hijo_01: {
		  required: "#Hijo1:checked"
		},
		sexo_hijo_01: {
		  required: "#Hijo1:checked"
		},
		grado_escolar_hijo_01: {
		  required: "#Hijo1:checked"
		}
	  }
	});
</script>
  </body>
</html>
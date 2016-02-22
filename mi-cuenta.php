<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else
{
echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
echo "<br/>" . "<a href='login.php'>Hacer Login</a>";

exit;
}
$now = time(); // checking the time now when home page starts

if($now > $_SESSION['expire'])
{
session_destroy();
echo "<br/><br />" . "Su sesion a terminado, <a href='login.php'> Necesita Hacer Login</a>";
exit;
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Inicio / Mi cuenta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
    <link rel="stylesheet" href="js/dist/slippry.css">
    <script src="js/dist/slippry.min.js"></script>
    
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-70018861-1', 'auto');
	  ga('send', 'pageview');

	</script>
    
  </head>
  <body>
    <?php
			
		$login_email = $_SESSION['username'];
		
		include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
			
		$registros=mysqli_query($conexion,"select * from cuenta where rut = '$login_email'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		$conexion2=mysqli_connect($host,$username,$password,'bdcutcl') or die("Problemas con la conexión");
		$acentos2 = $conexion2->query("SET NAMES 'utf8'");
		$registrosComuna=mysqli_query($conexion2,"select * from comuna") or die("Problemas en el select:".mysqli_error($conexion2));
		
			
		if($reg=mysqli_fetch_array($registros)){
		
			$nombre = $reg['nombre'];
			$apellido_paterno = $reg['apellido_paterno'];
			$apellido_materno = $reg['apellido_materno'];
			$sexo = $reg['sexo'];
			$fecha_nacimiento = $reg['fecha_nacimiento'];
			$rut = $reg['rut'];
			$telefono = $reg['telefono'];
			$email = $reg['email'];
			$pass = $reg['password'];
			$temas_interes = $reg['temas_interes'];
			$foto_perfil = $reg['foto_perfil'];
			$comunaUser = $reg['comuna_residencia'];
		
		}
			
		$registros_banner_left_01=mysqli_query($conexion,"select * from banner where frame = 'left_01'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		$registros_banner_left_02=mysqli_query($conexion,"select * from banner where frame = 'left_02'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		//Inserta comentarios del footer en la Base de Datos
		if(isset($_POST['comentario'])){
			$sugerencias = $_POST['comentario'];
			
			mysqli_query($conexion,"insert into sugerencia(rut,comentario) values ('$_REQUEST[rut_send]','$_REQUEST[comentario]')")
			or die("Problemas con el insert de los servicios");
			
		}
		
		$registrosSistema=mysqli_query($conexion,"select * from cuenta where rut = '$login_email'") or die("Problemas en el select:".mysqli_error($conexion));
		
		if($reg=mysqli_fetch_array($registrosSistema)){
			
			$sistema_web = $reg['sistema_web'];
		
		}
			
		if($sistema_web=='interno'){
			$status_cata = 'display:none;';		
			$index_subete = "<div id=\"logo\"><a href=\"index.php\"><img src=\"img/logo.png\"></a></div>";
		}else{
			$status_cata = 'display:none;';
			
		}
		
		if($sistema_web=='interno'){
			$status_bene = 'display:zerocool;';
			
		}else{
			$status_bene = 'display:zerocool;';
		}
				
		if($sistema_web=='unilever'){
			$status_cata = 'display:none;';
			$status_bene = 'display:none;';					
		}
		
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$index_logo = "<div id=\"logo\"><a href=\"index.php\"><img src=\"img/logo.png\"></a></div>";
		}else{
			$index_logo = "<div id=\"logo\"><a href=\"index.php\"><img src=\"img/logo-unilever.png\"></a></div>";
		}
		
		if($sistema_web=='interno'){
			$index_logo_left = "<div id=\"logo_royal\"><a href=\"http://www.royalrental.cl\" target=\"_blank\" alt=\"Royal Rental\"><img src=\"img/logo_royal.jpg\"></a></div> <div id=\"logo_multitecnica\"><a href=\"http://www.multitecnica.cl\" target=\"_blank\" alt=\"Multitécnica\"><img src=\"img/logo_multitecnica.jpg\"></a></div>";
		}elseif($sistema_web=='externo'){
			$index_logo_left = "<div id=\"logo_royal\"><a href=\"http://www.royalrental.cl\" target=\"_blank\" alt=\"Royal Rental\"><img src=\"img/logo_royal.jpg\"></a></div>";
		}else{	
			$index_logo_left = "<div id=\"logo-for-unilever\"><img src=\"img/logo-for-lever.png\"  ></div>";
		}
		
		/*
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$index_logo_left = "<div id=\"logo_royal\"><a href=\"http://www.royalrental.cl\" target=\"_blank\" alt=\"Royal Rental\"><img src=\"img/logo_royal.jpg\"></a></div>";
		}else{
			$index_logo_left = "<div id=\"logo-for-unilever\"><img src=\"img/logo-for-lever.png\"  ></div>";
		}
		*/
		
		
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$titulo_convenios = "Subete a los beneficios";
		}else{
			$titulo_convenios = "";
		}
		
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$loader_convenios = $registros_banner_left_02;
		}else{
			$loader_convenios = "";
		}
	
	?>  
    <header class="grupo">
	
      <?php 	
	    $nombre_user = $nombre." ".$apellido_paterno." ".$apellido_materno;
        echo "<div class=\"caja base-100\">";
        echo $index_logo;
        echo $index_logo_left;
        echo "<div id=\"admin-header\">";
          echo "<div id=\"admin--data\"><img src=\"img/img-perfil/$foto_perfil\" class=\"circulo\"><span class=\"nombre_usuario\">$nombre_user</span></div>";
          echo "<div id=\"cuenta\">";
            echo "<ul>";			  
			  echo "<li><a href=\"mi-cuenta.php\" class=\"micuenta\">Mi cuenta</a></li>";			  
              echo "<li><a href=\"logout.php\" class=\"cerrar\">Cerrar</a></li>";
            echo "</ul>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
	  ?>
      <a href="contacto.php" class="btnLateral">Contacto</a>	  
      <div class="caja base-100">
<!--         <div id="menu">
          <ul>
            <li><a href="que-es-subete.php">¿Qué es Súbete?</a></li>
            <li><a href="videos.html">Videos</a></li>
            <li><a href="contacto.html">Contacto</a></li>
          </ul>
        </div> -->
      </div>
    </header>
    <section class="grupo">
      <div class="caja base-100">
        <nav class="navegacion">
          <ul>
            <li><a href="seguridad.php" class="seguridad">Seguridad</a></li>
            <li><a href="productividad.php" class="productividad">Productividad</a></li>
            <li><a href="responsabilidad.php" class="responsabilidad">Responsabilidad</a></li>
            <li><a href="superacion.php" class="superacion">Superación</a></li>
            <li><a href="optimismo.php" class="optimismo">Optimismo</a></li>
            <li><a href="profesionalismo.php" class="profesionalismo">Profesionalismo</a></li>
            <?php echo "<li style=\"$status_cata\"><a href=\"catalogo.php\" class=\"catalogo\">Catálogo</a></li>"; ?>
			<?php echo "<li style=\"$status_bene\"><a href=\"beneficios.php\" class=\"beneficios\">Cupones</a></li>"; ?>
          </ul>
        </nav>
      </div>
    </section>
    <section id="search" class="grupo">
      <div class="caja web-100">
        <form id="busqueda" method="post" action="resultados-busqueda.php">
          <input name="palabraClave" type="text" placeholder="buscar dentro del sitio">
          <button type="submit">Buscar</button>
        </form>
      </div>
    </section>
    <div id="main" class="grupo">
      <div id="sidebar" class="caja web-35 TB">
        <h2>Estas son las noticias y beneficios para ti</h2>
        <div class="widgets">
          <h3>Galería: día del Operador 2015</h3>
          <div class="caja--actividades">
            <ul id="demo2">
              <?php
				while($reg=mysqli_fetch_array($registros_banner_left_01)){					
					$nombre_banner = $reg['nombre_banner'];
					echo "<li><a href=\"galeria-de-imagenes.php\"><img src=\"img/banner/$nombre_banner\" alt=\"\"></a></li>";
				}
			  ?>
            </ul>
          </div>
        </div>
        <div class="widgets">
           <?php  echo "<h3>$titulo_convenios</h3>";?>
          <div class="caja--actividades">
            <ul id="convenios">
              <?php
				while($reg=mysqli_fetch_array($loader_convenios)){					
					$nombre_banner = $reg['nombre_banner'];
					echo "<li><a href=\"seguridad.php\"><img src=\"img/banner/$nombre_banner\" alt=\"\"></a></li>";
				}
				echo "<li><a href=\"profesionalismo.php\"><img src=\"img/banner/convenio_compe.jpg\" alt=\"\"></a></li>";
			  ?>
            </ul>
          </div>
        </div>
      </div>	  	  
	  
      <div id="content" class="caja web-65">
        
		<div class="caja web-100">
          <h4>Mi Cuenta</h4>
		  <?php
			echo "<img src=\"img/img-perfil/$foto_perfil\" class=\"circulo foo limit\">";
		  ?>		
        </div>
		
        <div class="limpiar"> </div>
        
		<form id="perfil" method="post" action="actualizarDatosUsuario.php" enctype="multipart/form-data">
          <fieldset>
            <h1>Datos de cuenta</h1>
            <div class="caja web-30">
              <label>Nombre</label>
              <?php echo "<input name=\"nombre\" value=\"$nombre\" type=\"text\">"; ?>
            </div>
            <div class="caja web-30">
              <label>Apellido paterno</label>
              <?php echo "<input name=\"apellido_paterno\" value=\"$apellido_paterno\" type=\"text\">"; ?>
            </div>
            <div class="caja web-40">
              <label>Apellido materno</label>
              <?php echo "<input name=\"apellido_materno\" value=\"$apellido_materno\" type=\"text\">"; ?>
            </div>
            <div class="caja web-30">
              <label>sexo</label>
              <select name="sexo" class="sel">
			  <?php
			    $mas = '';
				$fem = '';
				if($sexo=='masculino'){
					$mas = 'selected=selected';
				}else{
					$fem = 'selected=selected';
				}
                echo "<option value=\"masculino\" $mas >Masculino</option>";
                echo "<option value=\"femenino\" $fem >Femenino</option>";
				?>
              </select>
            </div>
            <div class="caja web-30">
              <label>Fecha de nacimieto</label>
              <?php 
					$newDate = date("d-m-Y", strtotime($fecha_nacimiento));	
					echo "<input name=\"fecha_nacimiento\" value=\"$newDate\" type=\"text\">";
			  ?>
            </div>
            <div class="caja web-40">
              <label>RUT</label>
              <?php echo "<input name=\"rut\" value=\"$rut\" type=\"text\">"; ?>
            </div>
            <div class="caja web-30">
              <label>Teléfono / móvil</label>
              <?php echo "<input name=\"telefono\" value=\"$telefono\" type=\"text\">"; ?>
            </div>
            <div class="caja web-70">
              <label>Comuna residencia</label>
					<select name="comuna" class="sel">
						<?php
						while($reg=mysqli_fetch_array($registrosComuna)){					
							$nombreComuna = $reg['COMUNA_NOMBRE'];	
							
							if ($nombreComuna === $comunaUser) {
								echo "<option value=\"$nombreComuna\" selected=selected>$nombreComuna</option>";
							} else {
								echo "<option value=\"$nombreComuna\" >$nombreComuna</option>";
							}														
						}					
						?>
					</select>
            </div>
			<div class="caja web-70">
				<label>Seleccione foto para cargar: </label>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<?php echo "<input name=\"fotoPerfil_send\" value=\"$foto_perfil\" type=\"text\" hidden=hidden>"; ?>
			</div>
          </fieldset>
          <fieldset class="Cacceso">
            <h1>Cuenta de acceso</h1>
            <div class="caja web-100">
              <label>Correo electrónico</label>
              <?php echo "<input name=\"email\" value=\"$email\" type=\"text\">"; ?>
            </div>
            <div class="caja web-50">
              <label>Contraseña</label>
              <?php echo "<input name=\"pass\" value=\"$pass\" type=\"text\">"; ?>
            </div>
            <div class="caja web-50">
              <label>Confirmar contraseña</label>              
			  <?php echo "<input name=\"reTypePass\" value=\"$pass\" type=\"text\">"; ?>
            </div>
          </fieldset>
          <fieldset class="Cacceso">
            <h1>Temas de interés</h1>
            <div class="caja web-100">
              <label>Indica las palabras que describen tus intereses. Sepáralas con coma para identificarlas mejor:</label>
              <?php echo "<textarea name=\"temas_interes\">$temas_interes</textarea>"; ?>
            </div>
          </fieldset>
          <button type="submit" onClick="alert('Sus datos fueron actualizados')">Guardar</button>
        </form>
      </div>
    </div>
    <footer class="total">
      <div class="grupo">
        <div class="caja web-25">
          <div id="logo--footer"><a href="http://www.royalrental.cl" target="_blank"><img src="img/logo--footer.png" style="display:none;"></a></div>
        </div>
        <div class="caja web-50">
          <div id="menuComple" class="centrar">
            <ul>
              <li><a href="que-es-subete.php">¿Qué es Súbete?</a></li>
              <li><a href="videos.php">Videos</a></li>
              <li><a href="contacto.php">Contacto</a></li>
              <li><a href="encuesta.php">Encuesta</a></li>
            </ul>
          </div>
        </div>
        <div class="caja web-25">
          <form method="post" id="footer" class="right">
            <p>Escríbenos si tienes  dudas o sugerencias</p>
            <textarea name="comentario" placeholder="Escríbenos si tienes  dudas o sugerencias"></textarea>
            <button type="submit">Enviar</button>
			<?php
				echo "<input type=\"text\" name=\"rut_send\" value=\"$rut\" hidden=hidden>";	
			?>
          </form>
        </div>
      </div>
    </footer>
  </body>
</html>
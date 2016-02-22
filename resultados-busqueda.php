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
    <title>Resultados Búsqueda / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
    <link rel="stylesheet" href="js/dist/slippry.css">
    <script src="js/dist/slippry.min.js"></script>
  </head>
  <body>
	<?php
		if(isset($_GET['id_seguridad'])){
			$id_seguridad = $_GET['id_seguridad'];
			$get_activo = true;
		}
		
		$login_email = $_SESSION['username'];
		
		include_once 'config.php';
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registros=mysqli_query($conexion,"select * from cuenta where rut = '$login_email'")
		or die("Problemas en el select:".mysqli_error($conexion));
			
		if($reg=mysqli_fetch_array($registros)){
		
			$nombre = $reg['nombre'];
			$apellido_paterno = $reg['apellido_paterno'];
			$apellido_materno = $reg['apellido_materno'];			
			$rut = $reg['rut'];			
			$foto_perfil = $reg['foto_perfil'];
				
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
		
		if(@$get_activo==true){
			$registros_seguridad = mysqli_query($conexion,"SELECT * FROM seguridad WHERE id_seguridad = '$id_seguridad'")
			or die("Problemas en el select:".mysqli_error($conexion));
		}else{
			$registros_seguridad = mysqli_query($conexion,"SELECT * FROM seguridad WHERE id_seguridad = (SELECT MAX(id_seguridad) FROM seguridad)")
			or die("Problemas en el select:".mysqli_error($conexion));
		}
		
		
		
		if($reg=mysqli_fetch_array($registros_seguridad)){
		
			$id_seguridad = $reg['id_seguridad'];
			$imagen_seguridad = $reg['imagen_seguridad'];
			$titulo_seguridad = $reg['titulo_seguridad'];
			$contenido_seguridad = $reg['contenido_seguridad'];
			
			
		}
		
		$registrosSistema=mysqli_query($conexion,"select * from cuenta where rut = '$login_email'") or die("Problemas en el select:".mysqli_error($conexion));
		
		if($reg=mysqli_fetch_array($registrosSistema)){
		
			$sistema_web = $reg['sistema_web'];
	
		}
		
		if($sistema_web=='interno'){
			$status_cata = 'display:zerocool;';		
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
		
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$index_logo_left = "<div id=\"logo_royal\"><a href=\"http://www.royalrental.cl\" target=\"_blank\" alt=\"Royal Rental\"><img src=\"img/logo_royal.jpg\"></a></div>";
		}else{
			$index_logo_left = "<div id=\"logo-for-unilever\"><img src=\"img/logo-for-lever.png\"  ></div>";
		}
		
		if($sistema_web=='interno' or $sistema_web=='externo'){
			$titulo_convenios = "Nuevos Convenios";
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
            <?php echo "<li style=\"$status_cata\"><a href=\"#\" class=\"catalogo\">Catálogo</a></li>"; ?>
			<?php echo "<li style=\"$status_bene\"><a href=\"#\" class=\"beneficios\">Beneficios</a></li>"; ?>  
          </ul>
        </nav>
      </div>
    </section>
    <section id="search" class="grupo">
      <div class="caja web-100">
		<!--
        <form id="busqueda">
          <input type="text" placeholder="buscar dentro del sitio">
          <button type="submit">Buscar</button>
        </form>
		-->
      </div>
    </section>
    <div id="main" class="grupo">
      <div id="sidebar" class="caja tablet-35 web-35">
        <h2>Estas son las noticias y beneficios para ti</h2>
        <div class="widgets">
          <h3>Actividades Súbete</h3>
          <div class="caja--actividades">
            <ul id="demo2">
              <?php
				while($reg=mysqli_fetch_array($registros_banner_left_01)){					
					$nombre_banner = $reg['nombre_banner'];
					echo "<li><a href=\"#slide1\"><img src=\"img/banner/$nombre_banner\" alt=\"\"></a></li>";
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
					echo "<li><a href=\"#slide1\"><img src=\"img/banner/$nombre_banner\" alt=\"\"></a></li>";
				}
			  ?>
            </ul>
          </div>
        </div>
      </div>
      <div id="content" class="caja tablet-65 web-65">        
		<h3>Resultados de su búsqueda</h3>
		<?php
		
		$palabraClave = $_REQUEST['palabraClave'];
		
		//voy a buscar en los pilares y en las noticias
		
		//seguridad - seguridad 
		//productividad - produ
		//responsabilidad - respo
		//superacion - superacion
		//optimismo - optimismo
		//profesionalismo - profesionalismo
		//noticias - noticias
		
		$registros_seguridad = mysqli_query($conexion,"SELECT * FROM seguridad WHERE titulo_seguridad like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));
			
		$registros_produ = mysqli_query($conexion,"SELECT * FROM produ WHERE titulo_produ like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));
		
		$registros_respo = mysqli_query($conexion,"SELECT * FROM respo WHERE titulo_respo like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));
			
		$registros_superacion = mysqli_query($conexion,"SELECT * FROM superacion WHERE titulo_superacion like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));
			
		$registros_optimismo = mysqli_query($conexion,"SELECT * FROM optimismo WHERE titulo_opti like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));	
			
		$registros_profe = mysqli_query($conexion,"SELECT * FROM profesionalismo WHERE titulo_profe like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));	
			
		$registros_noticias = mysqli_query($conexion,"SELECT * FROM noticias WHERE nombre_noticia like '%$palabraClave%'")
			or die("Problemas en el select:".mysqli_error($conexion));	
		
        echo "<p class=\"texto-conceptos\">";
			echo "<ul>";
				//resultado por categoria
				while($reg=mysqli_fetch_array($registros_seguridad)){
					$titulo_seguridad = $reg['titulo_seguridad'];	
					$id_seguridad = $reg['id_seguridad'];
					echo "<li><a href=\"seguridad.php?id_seguridad=",urlencode($id_seguridad)," \">$titulo_seguridad</a></li>";															
				}	

				while($reg=mysqli_fetch_array($registros_produ)){
					$titulo_produ = $reg['titulo_produ'];	
					$id_produ = $reg['id_produ'];
					echo "<li><a href=\"productividad.php?id_produ=",urlencode($id_produ)," \">$titulo_produ</a></li>";															
				}	

				while($reg=mysqli_fetch_array($registros_respo)){
					$titulo_respo = $reg['titulo_respo'];	
					$id_respo = $reg['id_respo'];
					echo "<li><a href=\"responsabilidad.php?id_respo=",urlencode($id_respo)," \">$titulo_respo</a></li>";															
				}	

				while($reg=mysqli_fetch_array($registros_superacion)){
					$titulo_superacion = $reg['titulo_superacion'];	
					$id_superacion = $reg['id_superacion'];
					echo "<li><a href=\"superacion.php?id_superacion=",urlencode($id_superacion)," \">$titulo_superacion</a></li>";															
				}

				while($reg=mysqli_fetch_array($registros_optimismo)){
					$titulo_optimismo = $reg['titulo_opti'];	
					$id_optimismo = $reg['id_opti'];
					echo "<li><a href=\"optimismo.php?id_opti=",urlencode($id_optimismo)," \">$titulo_optimismo</a></li>";															
				}
				
				while($reg=mysqli_fetch_array($registros_profe)){
					$titulo_profe = $reg['titulo_profe'];	
					$id_profe = $reg['id_profe'];
					echo "<li><a href=\"profesionalismo.php?id_profe=",urlencode($id_profe)," \">$titulo_profe</a></li>";															
				}
				
				while($reg=mysqli_fetch_array($registros_noticias)){
					$nombre_noticia = $reg['nombre_noticia'];	
					$id_noticias = $reg['id_noticias'];
					echo "<li><a href=\"noticias.php?id_noticia=",urlencode($id_noticias)," \">$nombre_noticia</a></li>";															
				}
				
			echo "</ul>";
		echo "</p>";
		?>
      </div>
    </div>
    <footer class="total">
      <div class="grupo">
        <div class="caja web-25">
          <div id="logo--footer"><a href="http://www.royalrental.cl" target="_blank"><img src="img/logo--footer.png"></a></div>
        </div>
        <div class="caja web-50">
          <div id="menuComple" class="centrar">
            <ul>
              <li><a href="que-es-subete.php">¿Que es Súbete?</a></li>
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
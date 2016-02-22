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
    <title>Profesionalismo / Súbete</title>
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
		if(isset($_GET['id_profe'])){
			$id_profe = $_GET['id_profe'];
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
			$registros_profe = mysqli_query($conexion,"SELECT * FROM profesionalismo WHERE id_profe = '$id_profe'")
			or die("Problemas en el select:".mysqli_error($conexion));
		}else{
			$registros_profe = mysqli_query($conexion,"SELECT * FROM profesionalismo WHERE id_profe = (SELECT MAX(id_profe) FROM profesionalismo)")
			or die("Problemas en el select:".mysqli_error($conexion));
		}
	
		if($reg=mysqli_fetch_array($registros_profe)){
		
			$id_profe = $reg['id_profe'];
			$imagen_profe = $reg['imagen_profe'];
			$titulo_profe = $reg['titulo_profe'];
			$contenido_profe = $reg['contenido_profe'];			
			
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
      <div id="sidebar" class="caja tablet-35 web-35">
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
					echo "<li><a href=\"beneficios.php\"><img src=\"img/banner/$nombre_banner\" alt=\"\"></a></li>";
				}
				echo "<li><a href=\"profesionalismo.php\"><img src=\"img/banner/convenio_compe.jpg\" alt=\"\"></a></li>";
			  ?>
            </ul>
          </div>
        </div>
      </div>
      <div id="content" class="caja tablet-65 web-65">
        <div id="titulo-menu-colores"><img src="img/royalito_mini.png" class="izquierda">
          <h1>Profesionalismo</h1>
        </div>
        <p class="texto-conceptos">Ser profesional te permite adquirir seriedad y ser considerado en proyectos cada vez mayores. En esta sección, encontrarás cursos de perfeccionamiento que harán de ti un trabajador completo.</p>
		
        <?php
			if($sistema_web=='externo'){
				echo "<div id=\"imagen-destacada\"><img src=\"img/profe/banner10mandamienros_profesionales.jpg\">";
				  echo "<h2>Queremos que saques todo tu potencial. Inscríbete en nuestro curso:</h2>";
				  
				  echo "<p>Queremos que saques todo tu potencial. Inscríbete en nuestro curso:</p>";
				  echo "<p>Compuesto por diferentes módulos, el programa tiene como objetivo capacitar a cada operador otorgándoles las herramientas necesarias para lograr el máximo desempeño en sus diferentes labores.</p>";
				  echo "<p>El curso consta de distintos tópicos, entre los que podremos encontrar:</p>";
				  echo "<ol class=\"lista-ordenada\">";
					echo "<li>Manejo del equipo.</li>";
					echo "<li>Mantenimiento de Baterías.</li>";
					echo "<li>Taller de prácticas en terreno de manejo de equipos.</li>";
					echo "<li>onocimiento y manejo de diferentes tipos de máquinas.</li>";
				  echo "</ol>";
				  echo "<p>Además:</p>";
				  echo "<ol class=\"lista-ordenada\">";
					echo "<li>Los cursos son dictados por Ingenieros (que son Profesores Universitarios) en su parte teórica;";
					echo "y, por Ingenieros de nuestra empresa, capacitados en el extranjero por las más importantes";
					echo "fábricas de equipos.</li>";
					echo "<li>Existen cursos de distintas duraciones, dependiendo del nivel de conocimientos específicos de";
					echo "los alumnos y de los objetivos específicos de su empresa</li>";
					echo "<li>El programa considera la opción de apoyar a los alumnos en la tramitación del examen de";
					echo "licencia de conducir Clase \"D\" para quienes aprueben el Programa.</li>";
				  echo "</ol>";
				  echo "<p>Si quieres obtener tu licencia ¡contáctanos!</p>";
			    echo "</div>";
			}  	
			
			if($sistema_web=='unilever'){
				echo "<div id=\"imagen-destacada\"><img src=\"img/profe/banner10mandamienros_profesionales.jpg\">";
				  echo "<h2>Queremos que saques todo tu potencial. Inscríbete en nuestro curso:</h2>";
				  
				  echo "<p>Queremos que saques todo tu potencial. Inscríbete en nuestro curso:</p>";
				  echo "<p>Compuesto por diferentes módulos, el programa tiene como objetivo capacitar a cada operador otorgándoles las herramientas necesarias para lograr el máximo desempeño en sus diferentes labores.</p>";
				  echo "<p>El curso consta de distintos tópicos, entre los que podremos encontrar:</p>";
				  echo "<ol class=\"lista-ordenada\">";
					echo "<li>Manejo del equipo.</li>";
					echo "<li>Mantenimiento de Baterías.</li>";
					echo "<li>Taller de prácticas en terreno de manejo de equipos.</li>";
					echo "<li>onocimiento y manejo de diferentes tipos de máquinas.</li>";
				  echo "</ol>";
				  echo "<p>Además:</p>";
				  echo "<ol class=\"lista-ordenada\">";
					echo "<li>Los cursos son dictados por Ingenieros (que son Profesores Universitarios) en su parte teórica;";
					echo "y, por Ingenieros de nuestra empresa, capacitados en el extranjero por las más importantes";
					echo "fábricas de equipos.</li>";
					echo "<li>Existen cursos de distintas duraciones, dependiendo del nivel de conocimientos específicos de";
					echo "los alumnos y de los objetivos específicos de su empresa</li>";
					echo "<li>El programa considera la opción de apoyar a los alumnos en la tramitación del examen de";
					echo "licencia de conducir Clase \"D\" para quienes aprueben el Programa.</li>";
				  echo "</ol>";
				  echo "<p>Si quieres obtener tu licencia ¡contáctanos!</p>";
			    echo "</div>";
			}  			  
			
			if($sistema_web=='interno'){
				echo "<div id=\"imagen-destacada\"><img src=\"img/profe/profe.jpg\">";
					echo "<h2>Caja de compensación La Araucana</h2>";
					echo "<p>Podrás acceder a las siguientes becas de educación para tus hijos:</p>";
					 echo "<ol class=\"lista-ordenada\">";
						echo "<li>Becas enseñanza básica.</li>";
						echo "<li>Becas enseñanza media.</li>";
						echo "<li>Becas títulos técnicos.</li>";
						echo "<li>Becas universitarias.</li>";
						echo "<li>Becas mejor puntaje PSU</li>";
					 echo "</ol>";
					 echo "<p>Para mas información ingresa a: <a href=\"http://www.laaraucana.cl\" target=\"_blank\">www.laaraucana.cl</a></p>";
				echo "</div>";
			}
			 
			  echo "<form method=\"post\">";
			  //echo "<button type=\"submit\" formaction=\"profesionalismo-anteriores.php\" >Publicaciones anteriores </button>";				
				echo "<input type=\"text\" name=\"profe_send\" value=\"$id_profe\" hidden=hidden>";									  
			  echo "</form>";
			echo "</div>";					
		?>
		
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
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
    <title>Inicio / Qué es Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
    
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
		
			if(isset($_GET['id'])){
				$rut_usuario = $_GET['id'];
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
        <form id="busqueda">
          <input type="text" placeholder="buscar dentro del sitio">
          <button type="submit">Buscar</button>
        </form>
      </div>
    </section>
    <div id="main" class="grupo">
      <article>
        <div class="caja web-50">
          <div class="box--info1">
            <h1>¿QUÉ ES SÚBETE?</h1>
            <p>Súbete es la primera plataforma que busca unir a los operadores de Chile, en un programa lleno de beneficios y actividades en pro del perfeccionamiento de quienes lo integran.</p>
          </div>
        </div>
        <div class="caja web-50">
          <div class="box--info2">
            <h1>¿QUIÉNES PUEDEN SER PARTE DE SÚBETE?</h1>
            <p>Todos aquellos operadores que pertenezcan a empresas donde se realicen labores de carga a través de máquinas Royal Rental, tendrán un espacio en Súbete, pudiendo acceder a todos los beneficios que esta plataforma entrega.</p>
          </div>
        </div>
      </article>
      <article>
        <div class="caja web-50">
          <div class="box--info3">
            <h1>CONOCE LOS PILARES SÚBETE:</h1>
            <p>El programa Súbete se sustenta y estructura bajo 6 pilares, los cuales hemos considerado fundamentales para lograr el desarrollo integral de los profesionales del rubro con el fin de contar con operadores íntegros en el ámbito profesionaly personal. </p>
          </div>
        </div>
        <div class="caja web-50">
          <div class="box--info4">
            <div id="icon--icon" class="derecha"><img src="img/maletin.png"></div>
            <h1>CURSOS DE PERFECCIONAMIENTO</h1>
            <p>Accede a cursos de capacitación, talleres y charlas de diversas áreas relacionadas con el rubro de la carga, bodegaje y logística con el fin de desarrollar  y potenciar tus habilidades.</p>
          </div>
        </div>
      </article>
      <article>
        <div class="caja web-50">
          <div class="box--info5">
            <div id="icon--icon" class="derecha"><img src="img/balon.png"></div>
            <h1>ACTIVIDADES EXTRAPROGRAMÁTICAS</h1>
            <p> Disfruta de actividades para ti y tu familia, para generar momentos de distensión y acercamiento entre quienes se desenvuelven en el rubro</p>
          </div>
        </div>
        <div class="caja web-50">
          <div class="box--info6">
            <div id="icon--icon" class="derecha"><img src="img/bolsa.png"></div>
            <h1>DESCUENTOS EXCLUSIVOS SOCIOS DEL PROGRAMA SÚBETE</h1>
            <p>Canjea descuentos exclusivos en marcas asociadas al programa.</p>
          </div>
        </div>
      </article>
    </div>
  </body>
</html>

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
        <form id="footer" class="right">
          <p>Escríbenos si tienes  dudas o sugerencias</p>
          <textarea name="textarea" placeholder="Escríbenos si tienes  dudas o sugerencias"> </textarea>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </footer>
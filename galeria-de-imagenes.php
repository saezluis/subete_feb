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
    <title>Galería de imágenes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   <!--<script src="js/scripts-min.js"></script>-->
    <link rel="stylesheet" href="js/lightgallery/css/lightgallery.css">
    <script src="js/lightgallery/js/lightgallery.js"></script>
    <script src="js/lightgallery/js/lg-thumbnail.js"></script>
    <script src="js/lightgallery/js/lg-fullscreen.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#anchor-tag').lightGallery();
        //alert("funciona");
      });
    </script>
	
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
	include_once 'config.php';
		
		$evento = $_GET['evento'];
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosFotos=mysqli_query($conexion,"select * from galeria_fotos where evento = '$evento'") or die("Problemas en el select:".mysqli_error($conexion));
		
		if(isset($_POST['comentario'])){
			$sugerencias = $_POST['comentario'];
			
			mysqli_query($conexion,"insert into sugerencia(rut,comentario) values ('$_REQUEST[rut_send]','$_REQUEST[comentario]')")
			or die("Problemas con el insert de los servicios");
			
		}
				
		$login_email = $_SESSION['username'];
				
		$registros=mysqli_query($conexion,"select * from cuenta where rut = '$login_email'") or die("Problemas en el select:".mysqli_error($conexion));
			
		if($reg=mysqli_fetch_array($registros)){
		
			$nombre = $reg['nombre'];
			$rut = $reg['rut'];
			$hash = $reg['hash'];
			$apellido_paterno = $reg['apellido_paterno'];
			$apellido_materno = $reg['apellido_materno'];			
			$foto_perfil = $reg['foto_perfil'];
				
		}
		
		$registros_banner_sup=mysqli_query($conexion,"select * from banner where frame = 'sup'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		$registros_banner_left_01=mysqli_query($conexion,"select * from banner where frame = 'left_01'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		$registros_banner_left_02=mysqli_query($conexion,"select * from banner where frame = 'left_02'")
		or die("Problemas en el select:".mysqli_error($conexion));
			
		$registros_banner_right_01=mysqli_query($conexion,"select * from banner where frame = 'right_01'")
		or die("Problemas en el select:".mysqli_error($conexion));
		
		$registrosNoticias = mysqli_query($conexion,"SELECT * FROM noticias ORDER BY id_noticias DESC LIMIT 3")
		or die("Problemas en el select:".mysqli_error($conexion));
		
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
        <div class="caja web-100">
        <form id="busqueda" method="post" action="resultados-busqueda.php">
          <input name="palabraClave" type="text" placeholder="buscar dentro del sitio">
          <button type="submit">Buscar</button>
        </form>
      </div>
      </div>
    </section>
    <div id="main" class="grupo">
      <article>
        <div class="caja web-100">
       <?php
			if($evento=='lanzamiento'){
				echo "<h1 class=\"tit-gal\">SÚBETE A LOS MEJORES MOMENTOS DE EL DÍA DEL OPERARIO 2015 DE ROYAL RENTAL.</h1>";
			}
			
		    if($evento=='navidad'){
				echo "<h1 class=\"tit-gal\"><div align=\"center\"> DURANTE LA CELEBRACIÓN PREMIAMOS A LOS DESTACADOS DEL AÑO Y ELEGIMOS A LOS MEJORES COMPAÑEROS DEL 2015.</div></h1>";
			}
		  ?>
        </div>
        <div class="caja web-100">
        <div id="anchor-tag">
		<?php	
			while($reg=mysqli_fetch_array($registrosFotos)){	
				$foto = $reg['nombre_foto'];
				$thumb = $reg['mini_foto'];				
				echo "<a href=\"img/galeria/$foto\" class=\"item--galeria\"><img src=\"img/galeria/$thumb\"></a>";
			}
		?>  		  
        </div>
        </div>
      </article>
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
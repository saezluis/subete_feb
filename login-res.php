<!DOCTYPE html>
<html lang="es">
  <head>	
    <title>Login / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">	
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>	
	<script src="http://code.jquery.com/jquery-1.7.2.js" type="text/javascript"></script>		
	<script src="iealert.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="iealert/style.css" />    
	
	
	<link rel="stylesheet" href="main.css">
	
	
	<script>	
		/*
		$(document).ready(function() {			
			$("body").iealert({
				support: "ie9",
				title: "Actualiza tu navegador.",
				text: " ",
				upgradeTitle: "Actualizar",
				upgradeLink: "http://windows.microsoft.com/es-cl/internet-explorer/download-ie"
			});													
		});				
		*/
	</script>
	
	
	<script> 
		/*
		var $buoop = {c:2,reminder:0,text:"Su navegador (Internet Explorer) no está actualizado y podría no mostrar todas las características de este sitio web. Actualiza aquí tu navegador.",url:"http://windows.microsoft.com/es-cl/internet-explorer/download-ie"}; 
		function $buo_f(){ 
		var e = document.createElement("script"); 
		e.src = "//browser-update.org/update.min.js"; 
		document.body.appendChild(e);
		};
		try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
		catch(e){window.attachEvent("onload", $buo_f)}
		*/
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
  
  
  <div id="boxes">
  <div style="display: none; background:url(strip.jpg) no-repeat #fff; width:450px !important;" id="dialog" class="window centrado-porcentual">
	<h1>Súbete al programa donde todos crecemos, siguiendo estas indicaciones.</h1>
    <div id="lorem">

		<ul class="lista-pop">
			<li>Ingresa tu rut sin puntos ni dígito verificador.</li>
			<li>*ingresa tu clave (tres últimos dígitos de tu rut)</li>
		</ul>

    </div>
    <div id="popupfoot"> <a href="#" class="close agree acept-ok">Aceptar</a>  </div>
  </div>
  <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
</div>
  

    <div id="strip"></div>
    <header class="grupo">
      <div class="caja web-50">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--login">
          <h1>Te invitamos a ser parte del programa de beneficios de Royal Rental.</h1>
          <form method="post" action="checklogin.php" id="login">
            <label>Rut</label>
            <input name="username" type="text">
            <label>Contraseña</label>
            <input name="password" type="password">
            <button type="submit">Ingresar</button>
            <div class="caja no-padding">
			<!--
              <button class="recuperar">Recuperar contraseña</button>
			  -->
            </div>
          </form>
        </div>
      </div>
      <div class="caja web-50">
        <div id="box--blue">
          <div id="royalito"><img src="img/royalito.png" class="topR"></div>
          <div id="linea_texto"><img src="img/globo.png">
            <h2>Si aún no tienes una cuenta con nosotros, te invitamos a registrarte</h2>
          </div>
        </div>
        <div id="box--naranja">
          <form id="registrate" style="height: 70px;">		
			
            <button type="submit" formaction="inscripcion.php">Registrate Aquí</button>			
			
          </form>
        </div>
      </div>
    </header>	


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
<script src="main.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	
  </body>
</html>
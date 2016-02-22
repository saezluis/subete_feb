<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Login / Súbete</title>
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
    <div id="strip"></div>
    <header class="grupo">
      <div class="caja tablet-50 web-50">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--check">
          <div id="royalito-check"><img src="img/royalito.png"></div>
        </div>
      </div>
      <div class="caja tablet-50 web-50">
        <div id="alerta">
          <h1>Tu opinión es muy importante para nosotros.</h1>
          <p style="color:#fff; background:#01adef !important;" class="alarm">
            Muy pronto tendremos una nueva encuesta para saber en qué podemos mejorar. 
            <br><a href="" onclick="goBack()" style="padding: 0.5em 1em; margin-top: 1em; display: block; background:#040452; color:#fff; width:100%; text-align: center; text-decoration:none;">VOLVER  </a>
          </p>
        </div>
      </div>
    </header>
	<script>
			function goBack() {
				window.history.back();
			}
		  </script>
  </body>
</html>
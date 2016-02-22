<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Login / Súbete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/scripts-min.js"></script>
	
	<script type="text/javascript">

		function validarDatos(){

			if( document.datos.nombre.value == "" ){
				alert( "Por favor ingrese su Nombre" );
				document.datos.nombre.focus() ;
				return false;
			}
			
			if( document.datos.apellido.value == "" ){
				alert( "Por favor ingrese su Apellido" );
				document.datos.apellido.focus() ;
				return false;
			}
			
			if( document.datos.email.value == "" ){
				alert( "Por favor ingrese su email" );
				document.datos.email.focus() ;
				return false;
			}
			
			if( document.datos.telefono.value == "" ){
				alert( "Por favor ingrese su telefono" );
				document.datos.telefono.focus() ;
				return false;
			}
			
			if( document.datos.empresa.value == "" ){
				alert( "Por favor ingrese su empresa" );
				document.datos.empresa.focus() ;
				return false;
			}

			return( true );

		}	
		
	</script>	
	
  </head>
  <body>
    <div id="strip"></div>
    <header class="grupo">
      <div class="caja web-50">
        <div id="logo" class="arriba"><img src="img/logo.png"></div>
        <div id="box--login">
          <h1>Completa este formulario y muy pronto te contactaremos</h1>
          <form id="login" name="datos" method="post" action="procesar-inscripcion.php">
            <label>Nombre</label>
            <input type="text" name="nombre">
            <label>Apellido</label>
            <input type="text" name="apellido">
            <label>Correo electrónico</label>
            <input type="text" name="email">
            <label>Teléfono</label>
            <input type="text" name="telefono">
            <label>Empresa</label>
            <input type="text" name="empresa">
            <button type="submit" onclick="return(validarDatos())">Enviar</button>
          </form>
        </div>
      </div>
      <div class="caja web-50">
        <div id="box--blue">
          <div id="royalito"><img src="img/royalito.png" class="topR"></div>
          <div id="linea_texto"><img src="img/globo.png">
            <h2>Si aún no tienes una cuenta con nosotros te invitamos a registrarte</h2>
          </div>
        </div>
        <div id="box--naranja">
        </div>
      </div>
    </header>
  </body>
</html>
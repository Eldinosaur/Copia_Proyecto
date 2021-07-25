<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
	<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
	<style>   
		* {
		  box-sizing: border-box;
		}
		.column {
		  float: left;
		  width: 45%;
		  padding: 100px;
		  height: 500px;
		}
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
	</style>
  	<title>Optica Sudamericana - Login</title>
  	<script src="libraries/jquery-3.5.0.js"></script>
	<script type="text/javascript">
		history.forward();
		$(document).ready(function(){
			$("#log").click(function(){
				var usuario = $("#user").val();
				var clave = $("#psw").val();
				if(usuario!=""&&clave!=""){
					var envio = 'action=Login&usuario='+usuario+'&clave='+clave;
					$.ajax({
						type: 'POST',
						data: envio,
						url: 'sql.php',
						success: function(request){
							if(request=="1"){
								window.location.href="principal.php";
							}else{
								$("#mensajes").empty();
								$("#mensajes").append("El usuario no existe o hay datos incorrectos");
							
							}
						}
					});
				}
				else{
					$("#mensajes").empty();
					$("#mensajes").append("Ingrese sus datos por favor")
				}
			});

		});
	</script>
</head>
<body style="font-family: Arial; text-align: center">
		<img src="images/logo.jpg" height="150" width="150">
	<div class="row">
  		<div class="column">
  			<table>
  				<tr>
  					<td rowspan="3">
	  						<img src="images/logofb.png" height="50" width="50">
	  				</td>
	  			</tr>
	  			<tr>
	  				<td>Síguenos en Facebook</td>
	  			</tr>
	  			<tr>
	  				<td>
	  					<a href="https://www.facebook.com/opticasudamericana">Optica Sudamericana</a>
	  				</td>
	  			</tr>
	  		</table>
  		</div>
	  	<div class="column">
	  		<div>
	  			<h3>Ingreso al Sistema</h3>
	  		</div>
	  		<br>
	  		<div id="mensajes"></div>
	  		<br>
	  		<div>
	    		<input type="text" placeholder="Usuario" name="user" id="user">
	  		</div>
	  		<br>
	  		<div>
	    		<input type="password" placeholder="Contraseña" name="psw" id="psw">
	    	</div>
	    	<br>
	    	<div>
	    		<button type="button" name="log" id="log" class="btn btn-primary">Entrar</button>
	    	</div>
	    	<br>
	    	<div>
	    		<p>Si tiene problemas para ingresar, contacte con nuestro 
	    		<a href="#">soporte.</a></p>
	    	</div>
		</div>
 	</div>
</body>
</html>

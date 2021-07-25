<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Optica Sudamericana</title>
	
	<style>   
		* {
		  box-sizing: border-box;
		}
		.column {
		  float: left;
		  width: 33%;
		}
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
	</style>
	<script src="libraries/jquery-3.5.0.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
	<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		history.forward();
		$(document).ready(function(){

			$("#buscar").click(function(){
				$("#contenido").empty();
				$("#contenido").append('<iframe src="buscar.php" frameborder="0" width="100%" height="500px"></iframe>');
				$("#fondo").empty();
			});
			$("#new").click(function(){
				$("#contenido").empty();
				$("#contenido").append('<iframe src="ingreso.php" frameborder="0" width="100%" height="500px"></iframe>');
				$("#fondo").empty();
			});
			$("#buscar").click(function(){
				$("#contenido").empty();
				$("#contenido").append('<iframe src="buscar.php" frameborder="0" width="100%" height="500px"></iframe>');
				$("#fondo").empty();
			});
			$("#inventario").click(function(){
				location.href="inventario.php";
			});
			$("#logout").click(function(){
				location.href="logout.php";
			});
		});
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <p class="navbar-brand">Optica Sudamericana</p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="principal.php">Inicio</a>
      </li>
      <li class="nav-item active">
      	<a class="nav-link" id="new">Nuevo Paciente</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" id="buscar">Buscar Paciente</a>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
    		<?php echo "<b>Usuario Conectado:  </b><br>".$_SESSION['nombre']; ?>
    </ul>
    <button name="logout" id="logout" class="btn btn-primary" style="width:200px">Cerrar Sesion</button>
  </div>
</nav>
	<br>
	<div id="contenido" align="center">
		
	</div>
	<div id="fondo" align="center">
		<img src="images/logo.jpg" width="30%">
	</div>
</body>
</html>

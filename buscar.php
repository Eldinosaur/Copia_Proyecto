<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="libraries/jquery-3.5.0.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
	<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#buscar").click(function(){
				var paciente = $("#paciente").val();
				if(paciente!=""){
					$("#grid").attr("src","pacientes.php?codigo="+paciente);
					$("#busqueda").empty();
				}
				else{
					$("#grid").attr("src","pacientes.php?codigo=");
				}
			});

		});
	</script>
</head>
<body style="text-align:center">
	<div id="busqueda">
		<input type="text" name="paciente" id="paciente" placeholder="Cedula del paciente" style="height:30px">
		<button name="buscar" id="buscar" class="btn btn-primary">Buscar</button>
	</div>
	<br>
	<div id="contenido">
	<iframe src="pacientes.php?codigo=" frameborder="0" width="100%" id="grid" height="500px"></iframe>
	</div>
</body>
</html>
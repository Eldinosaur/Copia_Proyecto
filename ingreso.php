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
			$("#ingresar").click(function(){
				var cedula=$("#cedula").val();
				var nombre=$("#nombre").val();
				var direccion=$("#direccion").val();
				var telefono=$("#telefono").val();
				if(cedula!=""&&nombre!=""&&direccion!=""&&telefono!=""){
					var datos='action=Nuevo&cedula='+cedula
								+'&nombre='+nombre
								+'&direccion='
								+direccion+'&telefono='
								+telefono;
					$.ajax({
						type: 'POST',
						data: datos,
						url: 'sql.php',
						success:function(request){
							if(request!="existe"){
								if(request=="1"){
									$("#mensajes").empty();
									$("#botones").empty();
									$("#botones").append('<button name="atencion" id="atencion" class="btn btn-success" style="width:200px">Ir a Consulta</button>');
									$("#aviso").empty();
									$("#aviso").append("Paciente ingresado con exito");
									$("#atencion").click(function(){
										location.href="consulta.php?cedula="+cedula;
									});
								}
								else{
									$("#mensajes").empty();
									$("#aviso").empty();
									$("#aviso").append("Algo salio mal. Intentelo de nuevo más tarde.");
									$("#botones").empty();
								}
							}
							else{
								$("#mensajes").empty();
								$("#aviso").empty();
								$("#aviso").append("El paciente ya se encuentra registrado en el sistema");
								$("#botones").empty();
							}
						}
					});					
				}
				else{
					$("#mensajes").empty();
					$("#mensajes").append("Faltan datos por llenar");
				}
			});
		});
	</script>
</head>
<body style="text-align:center">
	<div>
		<h3>Ingreso de paciente</h3>
	</div>
	<br>
	<div id="mensajes"></div>
	<br>
	<table align="center">
		<tr>
			<td width="150"><label for="cedula">Cedula: </label></td>
			<td><input type="text" name="cedula" id="cedula" placeholder="Cedula" minlength="10" maxlength="10"></td>
		</tr>
		<tr>
			<td><label for ="nombre">Nombre: </label></td>
			<td><input type="text" name="nombre" id="nombre" placeholder="Nombre"></td>
		</tr>
		<tr>
			<td><label for="direccion">Direccion:</label></td>
			<td><input type="text" name="direccion" id="direccion" placeholder="Direccion"></td>
		</tr>
		<tr>
			<td><label for="telefono">Telefono:</label></td>
			<td><input type="text" name="telefono" id="telefono" placeholder="Telefono" minlength="7" maxlength="10"></td>
		</tr>
	</table>
	<br>
	<div id="aviso"></div>
	<br>
	<div id="botones">
		<button name="ingresar" id="ingresar" class="btn btn-primary" style="width:200px">Ingresar datos</button>
	</div>
</body>
</html>
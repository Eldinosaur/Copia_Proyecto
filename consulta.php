<?php
	include_once("sql.php");
?>
<!DOCTYPE html>
<html>
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<script src="libraries/jquery-3.5.0.js"></script>
	<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
	<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var cedula_paciente="<?php echo $_GET['cedula'];  ?>";
		var fecha = "<?php  echo date('Y-m-d'); ?>";
		$(document).ready(function(){
			$("#ingresar").click(function(){
				var ojoDer=$("#oDer").val();
				var ejeDer=$("#eDer").val();
				var ojoIzq=$("#oIzq").val();
				var ejeIzq=$("#eIzq").val();
				var obs=$("#obs").val();
				if(ojoDer!=""&&ejeDer!=""&&ojoIzq!=""&&ejeIzq!=""){
					var datos='action=Consulta&cedula='+cedula_paciente
								+'&fecha='+fecha
								+'&ojoDer='+ojoDer
								+'&ejeDer='+ejeDer
								+'&ojoIzq='+ojoIzq
								+'&ejeIzq='+ejeIzq
								+'&obs='+obs;
					$.ajax({
						type: 'POST',
						data: datos,
						url:'sql.php',
						success:function(request){							
								if(request=="1"){
									location.href="medidas.php?cedula="+cedula_paciente;
								}else{
									$("#aviso").empty();
									$("#aviso").append("Algo salio mal. Intentelo de nuevo más tarde.");
									$("#botones").empty();
								}	
							}
					});
				}
				else{
					$("#aviso").empty();
					$("#aviso").append("Faltan datos por llenar");
				}
			});
		});
	</script>
</head>
<body>
	<div align="center">
	<h4>Datos del Paciente</h4>
	</div>
	<br>
	<div>
		<table align="center">
			<?php echo datos_paciente($_GET['cedula']);  ?>
		</table>
	</div>
	<br>
	<div align="center">
		<h4>Historial de medidas</h4>
	</div>
	<br>
	<div>
		<table align="center">
			<tr>
				<td width="200px"><b>Fecha</b></td>
				<td width="100px"><b>OD</b></td>
				<td width="100px"><b>Eje OD</b></td>
				<td width="100px"><b>OI</b></td>
				<td width="100px"><b>Eje OI</b></td>
				<td width="250px"><b>Observacion</b></td>
			</tr>
			<?php echo medidas_paciente($_GET['cedula']);  ?>
		</table>
	</div>
	<br>
	<div>
		<table align="center">
			<tr>
				<td><label for="oDer"><b>Ojo Derecho:</b></label></td>
				<td><input type="text" name="oDer" id="oDer"></td>
			</tr>
			<tr>
				<td><label for="eDer"><b>Eje Derecho:</b></label></td>
				<td><input type="text" name="eDer" id="eDer"></td>
			</tr>
			<tr>
				<td><label for="oIzq"><b>Ojo Izquierdo:</b></label></td>
				<td><input type="text" name="oIzq" id="oIzq"></td>
			</tr>
			<tr>
				<td><label for="eIzq"><b>Eje Izquierdo:</b></label></td>
				<td><input type="text" name="eIzq" id="eIzq"></td>
			</tr>
			<tr>
				<td><label for="obs"><b>Observacion:</b></label></td>
				<td><input type="text" name="obs" id="obs"></td>
			</tr>
		</table>
	</div>
	<div id="aviso" align="center"></div>
	<br>
	<div id="botones" align="center">
		<button name="ingresar" id="ingresar" class="btn btn-primary" style="width:200px">Ingresar datos</button>
	</div>
</body>
</html>
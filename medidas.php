<?php
	include_once("sql.php");
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
<script src="libraries/jquery-3.5.0.js"></script>
<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var certificado;
	function imprimir(id){
		certificado(id);
	}
	$(document).ready(function(){
		certificado=function(id){
			location.href="reporte.php?cedula="+id;
		}
	});
</script>
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
	<h4>Historial de Medidas</h4>
</div>
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
		<?php echo medidas_paciente_historia($_GET['cedula']);  ?>
	</table>
</div>
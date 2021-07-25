<?php include_once("sql.php"); ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
<link rel="stylesheet" type="text/css" href="libraries/css/bootstrap.min.css">
<script type="text/javascript" src="libraries/js/bootstrap.min.js"></script>
<script type="text/javascript" src="libraries/jquery-3.5.0.js"></script>
<script type="text/javascript">
	var actualizar;
	var consulta;
	var historia;
	   function actualizar_id(identify){
	        actualizar(identify);
	   }
	   function consulta_id(identify){
	        consulta(identify);
	   }
	   function historia_id(identify){
	   		historia(identify);
	   }
	$(document).ready(function(){
		actualizar=function(id){
			location.href="actualizar.php?cedula="+id;
		}
		consulta=function(id){
			location.href="consulta.php?cedula="+id;
		}
		historia=function(id){
			location.href="medidas.php?cedula="+id;
		}
	});
</script>
<table align="center">
	<tr>
		<td width="150px"><b>Historia N°</b></td>
		<td width="200px"><b>Cedula</b></td>
		<td width="250px"><b>Nombres del paciente</b></td>
		<td width="150px"><b>Teléfono</b></td>
		
	</tr>
	<?php
	if($_GET['codigo']==""){
		echo "<tr><td colspan='4' align='center'>Ingrese la cedula del paciente</td></tr>";
	}else{
		echo paciente($_GET['codigo']);
	}
	
	?>
</table>
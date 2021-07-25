<?php
	function DB_connect(){
		$nombre_server="localhost";
		$parametros_conexion=array('Database' => 'proyecto','UID'=>'sa','PWD'=>'batmancito');
		$conexion = sqlsrv_connect($nombre_server,$parametros_conexion);
		if($conexion){
		}
		else{
			echo "Error de conexion";
			die(print_r(sqlsrv_errors(),true));
		}
		return $conexion;
	}
?>
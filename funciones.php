<?php
	include_once("conexion.php");
	function validar_usuario($usuario,$clave){
		$con=DB_connect();
		$sql = "Select * from usuarios where usuario= ? and clave= ?";
		$params=array($usuario,$clave);
		$opcion=array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$result=sqlsrv_query($con,$sql,$params,$opcion);
		$filas = sqlsrv_num_rows($result);
		return $filas;
	}
	function user_name($usuario){
		$con=DB_connect();
		$sql="select * from usuarios where usuario = ?";
		$param=array($usuario);
		$result=sqlsrv_query($con,$sql,$param);
		$fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		return $fila['nombre'];
	}
	function verificar_paciente($cedula){
		$con=DB_connect();
		$sql = "Select * from pacientes where cedula = ?";
		$params=array($cedula);
		$opcion=array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$result=sqlsrv_query($con,$sql,$params,$opcion);
		$filas = sqlsrv_num_rows($result);
		return $filas;
	}
	function ingreso_paciente($cedula,$nombre,$direccion,$telefono){
		$con=DB_connect();
		$sql="insert into pacientes (cedula,nombre,direccion,telefono)
				values(?,?,?,?)";
		$params=array($cedula,$nombre,$direccion,$telefono);
		$resultado=sqlsrv_query($con,$sql,$params);
		$op=0;
		if($resultado){
			$op=1;
		}
		return $op;
	}
	function historia($cedula){
		$con=DB_connect();
		$sql="insert into historias (cedula)
				values(?)";
		$param=array($cedula);
		$resultado=sqlsrv_query($con,$sql,$param);
	}
	function patient($paciente){
		$con=DB_connect();
		$sql="select *, (select numero from historias where cedula=p.cedula )historia
			 from pacientes p 
			 where cedula = ?";
		$param=array($paciente);
		$result=sqlsrv_query($con,$sql,$param);
		$fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		if($fila!=null){
			$cadena="<tr><td>".$fila['historia']."</td>
							<td>".$fila['cedula']."</td>
							<td>".$fila['nombre']."</td>
							<td>".$fila['telefono']."</td>
							<td><button id='".$fila['cedula']."' onClick='actualizar_id(this.id)'
					  		  class='btn btn-warning'>Actualizar Datos</button></td>
					  		  <td><button id='".$fila["cedula"].
					"' onClick='historia_id(this.id)' class='btn btn-secondary'>Ver Historial</button></td>
					<td><button id='".$fila["cedula"].
					"' onClick='consulta_id(this.id)' class='btn btn-success'>Ir a Consulta</button></td></tr>";
			return $cadena;
		}else{
			return "<tr><td colspan='4' align='center'>Paciente no registrado</td></tr>";
		}
	}
function actualizar_paciente($cedula,$nombre,$direccion,$telefono){
		$con=DB_connect();
		$sql="update pacientes 
			set nombre = ?,  direccion = ?,telefono = ?  
			where cedula = ?";
		$params=array($nombre,$direccion,$telefono,$cedula);
		$resultado=sqlsrv_query($con,$sql,$params);
		$op=0;
		if($resultado){
			$op=1;
		}
		return $op;
	}
	function history_paciente($paciente){
		$con=DB_connect();
		$sql="select *, (select numero from historias where cedula=p.cedula )historia
			 from pacientes p 
			 where cedula = ?";
		$param=array($paciente);
		$result=sqlsrv_query($con,$sql,$param);
		$fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		$cadena="<tr><td width='150px'><b>Historia N°</b></td><td>".$fila['historia']."</td></tr>
				<tr><td><b>Cedula:</b></td><td>".$fila['cedula']."</td></tr>
				<tr><td><b>Nombre:</b></td><td>".$fila['nombre']."</td></tr>";
		return $cadena;
	}
	function medidas_patient($cedula){
		$con=DB_connect();
		$sql="select * from medidas where cedula =? order by fecha asc";
		$param=array($cedula);
		$result=sqlsrv_query($con,$sql,$param);
		$cadena="";
		
			while($fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$cadena.="<tr><td>".$fila['fecha']->format('Y-m-d')."</td>
							<td>".$fila['ojoDer']."</td>
							<td>".$fila['ejeDer']."</td>
							<td>".$fila['ojoIzq']."</td>
							<td>".$fila['ejeIzq']."</td>
							<td>".$fila['observacion']."</td>
							</tr>";
			}
		if($cadena==""){
			$cadena.="<tr><td colspan='6'>No tiene registros por mostrar</td></tr>";
		}
		
		return $cadena;
	}
	function medidas_patient_historial($cedula){
		$con=DB_connect();
		$sql="select * from medidas where cedula =? order by fecha asc";
		$param=array($cedula);
		$result=sqlsrv_query($con,$sql,$param);
		$cadena="";
		while($fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
			$cadena.="<tr><td>".$fila['fecha']->format('Y-m-d')."</td>
						<td>".$fila['ojoDer']."</td>
						<td>".$fila['ejeDer']."</td>
						<td>".$fila['ojoIzq']."</td>
						<td>".$fila['ejeIzq']."</td>
						<td>".$fila['observacion']."</td>
						</tr>";
		}
		if($cadena!=""){
			$cadena.="<tr><td colspan='6'align='center'><button id='".$cedula.
					"' onClick='imprimir(this.id)' class='btn btn-success'>Imprimir Certificado</button></td></tr>";
		}
		return $cadena;
	}
	function consulta($cedula,$fecha,$ojoDer,$ejeDer,$ojoIzq,$ejeIzq,$obs){
		$con=DB_connect();
		$sql="insert into medidas (cedula,fecha,ojoDer,ejeDer,ojoIzq,ejeIzq,observacion)
		values (?,?,?,?,?,?,?)";
		$params=array($cedula,$fecha,$ojoDer,$ejeDer,$ojoIzq,$ejeIzq,$obs);
		$resultado=sqlsrv_query($con,$sql,$params);
		$op=0;
		if($resultado){
			$op=1;
		}
		return $op;
	}
	function paciente_certificado($paciente){
		$con=DB_connect();
		$sql="select *
			 from pacientes p 
			 where cedula = ?";
		$param=array($paciente);
		$result=sqlsrv_query($con,$sql,$param);
		$fila=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		$cadena="<tr><td><b>Cedula:</b></td><td>".$fila['cedula']."</td></tr>
				<tr><td><b>Nombre:</b></td><td>".$fila['nombre']."</td></tr>
				<tr><td><b>Direccion:</b></td><td>".$fila['direccion']."</td></tr>
				<tr><td><b>Telefono:</b></td><td>".$fila['telefono']."</td></tr>";
		return $cadena;
	}
?>
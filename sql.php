<?php
include_once("funciones.php");
if(!isset($_SESSION)){
	session_start();
}
if(isset($_POST['action'])&&$_POST['action']=='Login'){
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$response = validar_usuario($usuario,$clave);
	if($response=="1"){
		$_SESSION['usuario']=$usuario;
		$res=user_name($usuario);
		$_SESSION['nombre']=$res;
	}
	echo $response;
}
if(isset($_POST['action'])&&$_POST['action']=='Nuevo'){
	$cedula=$_POST['cedula'];
	$nombre=$_POST['nombre'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$existe=verificar_paciente($cedula);
	if($existe=="0"){
		$res=ingreso_paciente($cedula,$nombre,$direccion,$telefono);
		if($res=="1"){
			historia($cedula);
			echo $res;
		}
		else{
			echo $res;
		}
	}
	else{
		echo "existe";
	}
}
if(isset($_POST['action'])&&$_POST['action']=='Actualizar'){
	$cedula=$_POST['cedula'];
	$nombre=$_POST['nombre'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$res=actualizar_paciente($cedula,$nombre,$direccion,$telefono);
	echo $res;

}
if(isset($_POST['action'])&&$_POST['action']=='Consulta'){
	$cedula=$_POST['cedula'];
	$fecha=$_POST['fecha'];
	$ojoDer=$_POST['ojoDer'];
	$ejeDer=$_POST['ejeDer'];
	$ojoIzq=$_POST['ojoIzq'];
	$ejeIzq=$_POST['ejeIzq'];
	$obs=$_POST['obs'];
	$res=consulta($cedula,$fecha,$ojoDer,$ejeDer,$ojoIzq,$ejeIzq,$obs);
	echo $res;
}
function paciente($cedula){
	return patient($cedula);
}
function datos_paciente($cedula){
	return history_paciente($cedula);
}
function medidas_paciente($cedula){
	return medidas_patient($cedula);
}
function medidas_paciente_historia($cedula){
	return medidas_patient_historial($cedula);
}
function datos_certificado($cedula){
	return paciente_certificado($cedula);
}
?>
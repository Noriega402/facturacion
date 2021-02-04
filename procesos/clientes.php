<?php 

	require_once "../config/conexion.php";

	$_REQUEST['nit'];
	$_REQUEST['nombre'];
	$_REQUEST['telefono'];

	$nit=$_REQUEST['nit'];
	$nombre=$_REQUEST['nombre'];
	$telefono=$_REQUEST['telefono'];

	$sql = "INSERT INTO clientes VALUES ('$nit','$nombre','$telefono');";

	$guardar = $conexion->query($sql);
	header("Location: ../frm/ingresaCliente.php");

?>
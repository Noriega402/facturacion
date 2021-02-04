<?php 

	require_once "../config/conexion.php";

	$_REQUEST['descripcion'];
	$_REQUEST['precio'];

	$descripcion=$_REQUEST['descripcion'];
	$precio=$_REQUEST['precio'];

	$sql = "INSERT INTO articulos (descripcion,precio) VALUES ('$descripcion','$precio');";

	$guardar = $conexion->query($sql);
	header("Location: ../frm/ingresaArticulo.php");

?>
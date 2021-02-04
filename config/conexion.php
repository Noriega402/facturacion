<?php 
	// el archivo (sql) de base de datos se encuentra en carpeta config.
	$host='localhost';
	$usuario='root';
	$pass='';
	$db='facturacion';

	$conexion = new PDO ("mysql:host=$host; dbname=$db;", $usuario, $pass);
?>
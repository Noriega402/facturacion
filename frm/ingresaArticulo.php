<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="" content="">
	<title>Registro de Clientes</title>
</head>
<body>
	<form action="../procesos/articulos.php">
		<label for="nombre">Descripcion:
			<input type="textarea" name="descripcion" id="nombre" required="requerido">
		</label><br>
		<label for="telefono">Precio:
			<input type="text" name="precio" id="telefono" required="requerido">
		</label>
		<input type="submit" name="enviar" value="Agregar">
	</form>
</body>
</html>
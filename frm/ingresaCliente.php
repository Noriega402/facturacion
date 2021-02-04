<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="" content="">
	<title>Registro de Clientes</title>
</head>
<body>
	<form action="../procesos/clientes.php">
		<label for="nit">Nit:
			<input type="text" name="nit" id="nit" required="requerido" maxlength="8" minlength="8">
		</label><br>
		<label for="nombre">Nombre:
			<input type="text" name="nombre" id="nombre" required="requerido">
		</label><br>
		<label for="telefono">Telefono:
			<input type="text" name="telefono" id="telefono" required="requerido" maxlength="8" minlength="8">
		</label>
		<input type="submit" name="enviar" value="Agregar">
	</form>
</body>
</html>
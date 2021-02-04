<?php 
	// para ingresar clientes y/o productos en la carpeta frm estan los formularios aparte

	require_once "config/conexion.php";
	session_start();

	$nit = "";
	$nombre = "";
	$telefono = "";

	$cantidad = 0;
	$codigo = 0;
	$descripcion = "";
	$precio = 0;
	$total = 0;

	if (isset($_SESSION['cliente'])){
		$nit = $_SESSION['cliente']->nit;
		$nombre = $_SESSION['cliente']->nombre;
		$telefono = $_SESSION['cliente']->telefono;
	}/*else{
		echo "No hay datos en la sesion";
	}*/

	if (isset($_SESSION['articulos'])){
		$articulos = $_SESSION['articulos'];
	}else{
		$articulos = array();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="lib/fontawesome/css/all.css">
	<title>Facturacion</title>
</head>
<body>
<br>
	<div class="container">
		<!-- Formaulario para ingresar nit -->
		<form action="modelo.php" method="post">
			<div class="form-group">
				<table class="table table-bordered">
					<thead class="text-center">
						<th>NIT</th>
						<th><input type="text" name="nit" class="form-control-sm" required="requerido"></th>
						<th>
							<button name="operacion" value="buscarCliente" class="btn btn-success">
								<span class="fas fa-search" aria-hidden="true"></span>
							</button>
						</th>
					</thead>
					<tbody>
						<tr>
							<th>Nit</th>
							<th>Nombre</th>
							<th>Telefono</th>
						</tr>
						<tr>
							<td><?php echo $nit; ?></td>
							<td><?php echo $nombre; ?></td>
							<td><?php echo $telefono; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>
		<!-- formulario para enviar codigo de producto, cantidad, comprar y cancelar venta -->
		<form action="modelo.php" method="post">
			<div class="form-group">
				<table class="table table-bordered">
						<tr>
							<th>Codigo</th>
							<th>Cantidad</th>							
						</tr>
						<tr>
							<td><input type="text" name="codigo" class="form-control-sm"></td>
							<td><input type="text" name="cantidad" class="form-control-sm"></td>
							<td>
								<button class="btn btn-primary" name="operacion" value="buscarArticulo">
									<span class="fas fa-shopping-cart"></span>
								</button>
							</td>
						</tr>
						<tr>
							<th>Codigo</th>
							<th>Cantidad</th>
							<th>Descripción</th>
							<th>Precio</th>
							<th>Subtotal</th>
						</tr>
					<?php foreach ($articulos as $value): ?>
						<tr>
							<td><?php echo $value->codigo; ?></td>
							<td><?php echo $value->cantidad; ?></td>
							<td><?php echo $value->descripcion; ?></td>
							<td><?php echo $value->precio; ?></td>
							<td><?php echo $value->cantidad*$value->precio; ?></td>
						</tr>
						<?php $total += ($value->cantidad*$value->precio); ?>
					<?php endforeach; ?>
						<tr>
							<td align="center">
								<input type="submit" name="operacion" value="cancelar" class="btn btn-danger">
							</td>
							<td align="center">
								<input type="submit" name="operacion" value="facturar" class="btn btn-primary">
							</td>
							<td colspan="2">
								<h3>Total</h3>
							</td>
							<td>
								<?php echo "<h3>Q.".$total."</h3>"; ?>
							</td>
						</tr>
				</table>
			</div>
		</form>
	</div>

</body>
</html>

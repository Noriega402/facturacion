<?php 

	/*echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";*/
	session_start();

	$operacion = $_REQUEST['operacion'];

	switch ($operacion) {
		case 'buscarCliente':
			buscarCliente();
			break;
		case 'buscarArticulo':
			buscarArticulo();
			break;
		case 'cancelar':
			cancelar();
			break;
		case 'facturar':
			facturar();
			break;
		default:
			echo "Opcion no encontrada";
			break;
	}

	function buscarCliente(){
		$documento = $_REQUEST['nit'];

		require_once "config/conexion.php";

		$sql = "SELECT* FROM clientes WHERE nit = '$documento'";

		$cliente = $conexion->query($sql)->fetch(PDO::FETCH_OBJ);
		$_SESSION['cliente'] = $cliente;
		header("Location: index.php");
	}

	function buscarArticulo(){
		$codigo = $_REQUEST['codigo'];
		$cantidad = $_REQUEST['cantidad'];

		require_once "config/conexion.php";

		$sql = "SELECT* FROM articulos WHERE codigo = '$codigo'";

		$articulo = $conexion->query($sql)->fetch(PDO::FETCH_OBJ);
		$articulo->cantidad = $cantidad;

		$_SESSION['articulos'][] =  $articulo;
		header("Location: index.php");
		/*echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";*/
	}

	function facturar(){
		require_once "config/conexion.php";

		$cliente = $_SESSION['cliente'];
		$articulos = $_SESSION['articulos'];

		$sql1 = "INSERT INTO ventas (nit) VALUES ('$cliente->nit')";
		$conexion->query($sql1);

		$venta = $conexion->lastInsertId();//sirve para capturar el ultimo id insertado en db.

		foreach ($articulos as $key => $value){
			$conexion->query("INSERT INTO detalle_venta (idVenta, idArticulo, cantidad)
								VALUES ($venta,$value->codigo, $value->cantidad)");
		}
		/*session_destroy();
		header("Location: index.php");*/
		imprimir();
	}

	function imprimir(){
		include ('config/conexion.php');
		include ('lib/fpdf/fpdf.php');

		$cliente = $_SESSION['cliente'];
		$articulos = $_SESSION['articulos'];

		$detalles = $conexion->query("SELECT ventas.idVenta, ventas.nit, clientes.nombre, clientes.telefono,
										articulos.codigo, articulos.descripcion, articulos.precio,
										detalle_venta.cantidad
									FROM ventas
									INNER JOIN detalle_venta ON ventas.idVenta = detalle_venta.idVenta
									INNER JOIN clientes ON ventas.nit = clientes.nit
									INNER JOIN articulos ON detalle_venta.idArticulo = articulos.codigo")->fetchAll(PDO::FETCH_OBJ);
		$pdf = new FPDF();

		//AddPage añade una nuavea pagina.
		$pdf->AddPage();
		//SetFont(fuente de letra,estilo de fuente B=negrita, I=italica, U=subindice,Tamaño de letra);
		$pdf->SetFont('Arial','B',36);
		//SetXY(posicion en X,posicion en Y);
		$pdf->SetXY(10,10);
		//cell(ancho,alto,texto que se añade,borde 1=si 0=no,salto de linea 0=sigue en la misma linea, 1=comienzo de la siguiente line, 2=debajo, posicion de texto C=centrado L=izquierda, R=derecha)
		$pdf->Cell(210,30,"Industrias DENC",0,1,'C');
		//Image(nombre de imagen,posicion en X,posicion en Y,ancho,altura ,formato de imagen);
		$pdf->Image('img/logo.jpg',10,10,35,25,'JPG');
		//SetFont(agregar fuente de letra,estilo de letra,tamaño de letra)
		$pdf->SetFont('Arial','B',22);
		$pdf->Cell(210,20,"Factura de venta",0,1,'C');
		$pdf->SetFont('Arial','B',12);

		//cell(ancho,alto,texto que se añade,borde 1=si 0=no,salto de linea 0=sigue en la misma linea, 1=comienzo de la siguiente line, 2=debajo, posicion de texto C=centrado L=izquierda, R=derecha)
		$pdf->Cell(10,10,"Nit:",0,0,'L');
		$pdf->Cell(40,10,$cliente->nit,0,1,'L');

		$pdf->Cell(20,10,"Nombre:",0,0,'L');
		$pdf->Cell(40,10,$cliente->nombre,0,1,'L');

		$pdf->Cell(22,10,"Telefono:",0,0,'L');
		$pdf->Cell(40,10,$cliente->telefono,0,1,'L');

		$pdf->Cell(15,10,"Cant.",1,0,'C');
		$pdf->Cell(90,10,"Descripcion",1,0,'C');
		$pdf->Cell(40,10,"Precio",1,0,'C');
		$pdf->Cell(40,10,"Subtotal",1,1,'C');

		$pdf->SetFont('Arial','I',10);
		//$total = 0;
		foreach ($articulos as $key => $value) {
			$pdf->Cell(15,10,$value->cantidad,1,0,'C');
			$pdf->Cell(90,10,$value->descripcion,1,0,'C');
			$pdf->Cell(40,10,$value->precio,1,0,'C');
			$pdf->Cell(40,10,$value->precio*$value->cantidad,1,1,'C');
		}

		$pdf->Cell(40,10,"Total",1,0,'C');

		$pdf->Output('Industrias DENC','I');

	}

	function cancelar(){
		session_destroy();
		header("Location: index.php");
	}
	/*
	SELECT ventas.nit, clientes.nombre, articulos.descripcion
	FROM ventas
	INNER JOIN detalle_venta ON ventas.idVenta = detalle_venta.idVenta
	INNER JOIN clientes ON ventas.nit = clientes.nit
	INNER JOIN articulos ON detalle_venta.idArticulo = articulos.codigo
	WHERE ventas.nit = 37348051 AND ventas.idVenta = 1


	SELECT ventas.idVenta, ventas.nit, clientes.nombre, clientes.telefono, articulos.codigo, articulos.descripcion, articulos.precio, detalle_venta.cantidad
	FROM ventas
	INNER JOIN detalle_venta ON ventas.idVenta = detalle_venta.idVenta
	INNER JOIN clientes ON ventas.nit = clientes.nit
	INNER JOIN articulos ON detalle_venta.idArticulo = articulos.codigo
	 */
?>
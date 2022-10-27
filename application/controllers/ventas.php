<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Venta extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		//$this->load->model("usuario_model");
		$this->load->model("usuario_model");
		$this->load->model("venta_model");
		$this->load->model("producto_model");
		$this->load->helper('numeroLetras');
	}


	public function index()
	{
		$data['listaVentas'] = $this->venta_model->lista();
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('venta/index', $data);
		$this->load->view('layouts/footer');
	}

	public function buscar_en_bd_cliente()
	{

		// aca empieza

		$palabra_buscar = $_POST['palabra'];

		$data = array(
			"opcion" => "buscadorCliente",
			"clientes" => $this->venta_model->buscar($palabra_buscar),

		);
		$this->load->view('venta/VO_venta', $data);
	}
	// public function reducirStock()
	// {
	// 	$idCarrito = $_POST['idCarrito'];
	// 	$qtotal=$this->venta_model->cantidad($idCarrito);
	// 	foreach ($qtotal->result() as $row) {
	// 		$viamonq = $row->stock;
	// 	}
	// 	$cantidadDeseada = $_POST['cantidad'];
	// 	$data['stock'] = $viamontq-$cantidadDeseada;
	// 	$this->producto_model->update($idCarrito,$data);

	
	// }
	public function buscar_en_bd_producto()
	{

		// aca empieza
		$palabra_buscar = $_POST['palabraProducto'];

		$data = array(
			"opcion" => "buscadorProducto",
			"productos" => $this->venta_model->buscarProducto($palabra_buscar),

		);
		$this->load->view('venta/VO_venta', $data);
	}
	//ingrasamos venta
	public function carrito()
	{
		$venta = json_decode($_POST["arreglo"]);
		$ventasTotal['precioTotal'] = $_POST["ventasTotal"];
		$ventasTotal['idCliente'] = $_POST["idCliente"];
		//$ventasTotal['idUsuario'] = 1;
		$ventasTotal['idUsuario'] = $this->session->userdata('idUsuario');
		$this->venta_model->insert($ventasTotal);
		$ventas = $this->venta_model->ultimoIdVenta();
		foreach ($ventas as $row) {
			$idVenta = $row->idVenta;
		};

		foreach ($venta as $prod) {
			$idCarrito = $prod->idCarrito;
			$cantidad = $prod->cantidad;
			$precio = $prod->precio;

			$data = array(
				"idProducto" => $idCarrito,
				"cantidad" => $cantidad,
				"precioUnitario" => $precio,
				"idVenta" => $idVenta,
			);
			
			$idVenta = $data['idVenta'];
			$this->venta_model->Reg_venta($data);


		}
		echo $idVenta;
		//redirect('venta','refresh');

		}


		public function delete($id){
			$data = array('estado' => 0 );
			$this->venta_model->delete($id,$data);
			redirect('venta','refresh');
			
		}

		public function imprimir($id)
		{
			$ventas = $this->venta_model->listaventa($id);
			$detallesCliente = $this->venta_model->detallesCliente($id);
			$ttal=0;
			foreach ($detallesCliente as $row) {
				$nombreCliente = $row->nombres .' ' .$row->primerApellido .' ' . $row->segundoApellido;
				$nit = $row->nit;
				$vf = $row->vf;
				$ttal = $row->precioTotal;
			}
			//$nombresX = $this->session->userdata('login');
			$detallesUsuario = $this->usuario_model->get($this->session->userdata('idUsuario'));
			foreach ($detallesUsuario->result() as $key) {
				$nombreEmpleado = $key->nombres. ' ' .$key->primerApellido;
			}
			$this->pdf = new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages(); //numeracion
			$this->pdf->SetTitle('Recibo SVES'); //titulo de los plantas del documento o del pdf
			$this->pdf->SetLeftMargin(15); //margen izq.
			$this->pdf->SetRightMargin(15); //margen derecho
			$this->pdf->SetFillColor(230, 243, 250); //color de griss
			$this->pdf->SetFont('Arial', 'B', 18); //tipo de letra y tama;o

			$this->pdf->Ln(10);
			$this->pdf->cell(50); //tamanio de la celda
			$this->pdf->Cell(80, 10, 'RECIBO DE VENTAS', 0, 0, 'C', 1);
			$this->pdf->Ln(20);
			$this->pdf->SetFont('Arial', '', 15);
			$this->pdf->Cell(1, 0, '--SELECTRONIK--', 0, 0, 'L', 1);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(1, 0, 'Expertos en Seguridad Electronica', 0, 0, 'L', 1);
			$this->pdf->Ln(4);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(1, 0, '   Avenida Ricardo Freyre N#345', 0, 0, 'L', 1);
			$this->pdf->Ln(4);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(1, 0, '  Telf. 75928470 - CASA MATRIZ', 0, 0, 'L', 1);
			$this->pdf->Ln(4);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(1, 0, 'email. Selectronik-seguridad@gmail.com', 0, 0, 'L', 1);
			$this->pdf->Ln(15);

			$this->pdf->SetFillColor(255, 255, 255); //color de griss
			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(20, 8, utf8_decode('Señor(es):'), 0, 0, 'L', 1);
			$this->pdf->Cell(10, 8, $nombreCliente, 0, 0, 'L', 0);
			//$this->pdf->Cell(40,6,utf8_decode('Menos Vendido'),1,0,'C',1);
			//  $this->pdf->SetFont('Arial', 'B', 24);
			//  $this->pdf->Cell(65);
			//$this->pdf->Image('img/logo1.jpeg',15,10,-300);
			// $this->pdf->Cell(10, 8, ''.$D22N.jpg, 0, 0, 'L', 1);
			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Ln(8);
			$this->pdf->Cell(20, 5, 'Nit:', 0, 0, 'L', 1);
			$this->pdf->Cell(10, 5, $nit, 0, 0, 'L', 1);
			$this->pdf->Ln(7);
			$this->pdf->Cell(20, 5, 'Usuario:', 0, 0, 'L', 1);
			$this->pdf->Cell(10, 5, $nombreEmpleado, 0, 0, 'L', 1);
			$this->pdf->Ln(8);
			$this->pdf->Cell(20, 5, 'Fecha :', 0, 0, 'L', 1);
			$this->pdf->Cell(10, 5, $vf, 0, 0, 'L', 1);

			
			//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
			//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

			$this->pdf->Ln(15); //espaciado luego del titulo del documento
			$this->pdf->SetFillColor(230, 243, 250);
			$this->pdf->SetFont('Arial', 'B', 12);
			
			$this->pdf->Cell(15, 5, 'Cant.', 'TBLR', 0, 'L', 1);
			$this->pdf->Cell(90, 5, utf8_decode('Producto'), 'TBLR', 0, 'L', 1);
			
			$this->pdf->Cell(40, 5, utf8_decode('Precio Unitario'), 'TBLR', 0, 'R', 1);
			$this->pdf->Cell(30, 5, utf8_decode('Precio'), 'TBLR', 0, 'R', 1);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', '', 10);
			$num = 1;
			foreach ($ventas as $row) {
				$cantidad = $row->cantidad;
				$nombreProducto = $row->nombreProducto;
				
				$precioUnitario = $row->precioUnitario;
				$tt = $cantidad * $precioUnitario;

				$this->pdf->SetFillColor(255,255,255);
    			$this->pdf->SetFont('Arial','',10);
				$this->pdf->Cell(15, 5, $cantidad, 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(90, 5, $nombreProducto, 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(40, 5, $precioUnitario, 'TBLR', 0, 'R', 0);
				$this->pdf->Cell(30, 5, $tt, 'TBLR', 0, 'R', 0);
				$this->pdf->Ln(5);
				$num++;
			}
			
			$this->pdf->SetFont('Arial', 'B', 12);
			$this->pdf->Cell(145, 5, '		Total a Pagar', 0, 0, 'R', 1);
			$this->pdf->Cell(30, 5, 'Bs: '.$ttal, 'TBLR', 0, 'R', 1);
			
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Ln(10);
			$this->pdf->Cell(10, 10, 'Son : '.convertir($ttal), 0, 0, 'L', 1);
			// $this->pdf->Ln(10);
			// $this->pdf->Cell(10, 10, 'Son : '.ucfirst(convertir($ttal)), 0, 0, 'L', 1);

			$this->pdf->Ln(25);
			// $this->pdf->SetFont('Arial', 'B', 8);
			// $this->pdf->Cell(0, 0, '<<ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LEY.>>', 0, 0, 'R', 1);
			// $this->pdf->Ln(4);
			// $this->pdf->SetFont('Arial', '', 8);
			// $this->pdf->Cell(0, 0, 'Ley N# 453: Tienes derecho a un trato equitativo sin discriminacion en la oferta de servicios.', 0, 0, 'C', 1);
			// $this->pdf->Ln(4);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(0, 0, 'Si tiene alguna consulta acerca de esta factura, le rogamos que se ponga en contacto con Soporte Tecnico.', 0, 0, 'C', 1);
			$this->pdf->Ln(4);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Cell(0, 0, 'Telf.75928470 email. Selectronik-seguridad@gmail.com', 0, 0, 'C', 1);

			$this->pdf->Output("Listacarrito.pdf", "I");
		}
	}


	//$this->pdf->SetFont('Arial', 'B', 24);
	//$this->pdf->Cell(65);
	//$this->pdf->Cell(10, 8, '     Bs.- '.$ttal, 0, 0, 'L', 1);
// $this->pdf = new Pdf();
// 		$this->pdf->AddPage();
// 		$this->pdf->AliasNbPages(); //numeracion
// 		$this->pdf->SetTitle('Lista de conductores'); //titulo de los plantas del documento o del pdf
// 		$this->pdf->SetLeftMargin(15); //margen izq.
// 		$this->pdf->SetRightMargin(15); //margen derecho
// 		$this->pdf->SetFillColor(210, 210, 210); //color de griss
// 		$this->pdf->SetFont('Arial', 'B', 11); //tipo de letra y tama;o
// 		$this->pdf->cell(30); //tamanio de la celda
// 		$this->pdf->Cell(120, 10, 'Lista de conductores', 0, 0, 'C', 1);
// 		//ancho, alto, texto, borde, orden de sig celda, Alineacion LCR, FILL 0 para NO y 1 para SI
// 		//orden de la sig celda    (0 derecha    1 siguiente linea   2 debajo)

// 		$this->pdf->Ln(15); //espaciado luego del titulo del documento
// 		$this->pdf->SetFont('Arial', 'B', 9);
// 		$this->pdf->Cell(10, 5, 'Nro', 'TBLR', 0, 'L', 1);
// 		$this->pdf->Cell(50, 5, 'Nombre', 'TBLR', 0, 'L', 1);
// 		$this->pdf->Ln(5);
// 		$this->pdf->SetFont('Arial', '', 9);
// 		$num = 1;
// 		foreach($ventas as $row) {
// 			$producto = $row->producto;
			
// 			$this->pdf->Cell(10, 5, $num, 'TBLR', 0, 'L', 0);
// 			$this->pdf->Cell(30, 5, $producto, 'TBLR', 0, 'L', 0);
// 			$this->pdf->Ln(5);
// 			$num++;
// 		}
// 		$this->pdf->Output("Listacarrito.pdf", "I");
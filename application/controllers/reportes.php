<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("reporte_model");
		//$this->load->model("cliente_model");
		$this->load->model("venta_model");
	}


	public function index()
	{
		//$listaClientes=$this->personas_model->listarpersonas();
		//$listaVentas=$this->ventas_model->listarVenta();
		//$data['clientes']=$listaClientes;
		//$data['ventas']=$listaVentas;
		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('reporte/index');  //,$data 
		$this->load->view('layouts/footer');
		
	}

	public function reporfechas()
	{
		//$id=$this->input->post('idCliente');
		$fechaInicio=$this->input->post('fechaInicio');
		$fechaFinal=$this->input->post('fechaFinal');
		
		$resultado = $this->reporte_model->dbreporfechas($fechaInicio,$fechaFinal);
		echo json_encode($resultado);
	}

	// public function totalmes()
	// {
	// 	//$fechaInicio=$this->input->post('fechaInicio');
	// 	//$fechaFinal=$this->input->post('fechaFinal');
	// 	$mesactual=$this->input->post('mesactual');
	// 	$anioactual=$this->input->post('anioactual');
	// 	//$resultado = $this->reportes_model->ventasmes($fechaInicio,$fechaFinal);

	// 	$array = array();

	// 	for ($i=0; $i < 5 ; $i++) { 
	// 		$fechaInicio=$anioactual.'/'.$mesactual.'/'.'01';
	// 		$fechaFinal=$anioactual.'/'.$mesactual.'/'.'31';
	// 		$resultado = $this->reportes_model->ventasmes($fechaInicio,$fechaFinal);

	// 		$array[$i] = $resultado;
	// 		$mesactual--;
	// 	}

	// 	echo json_encode($array);
	// }


	public function reporXproductos()
	{
		$fechaInicio=$this->input->post('fechaInicio');
		$fechaFinal=$this->input->post('fechaFinal');
		
		$resultado = $this->reporte_model->dbreporfechasXproductos($fechaInicio,$fechaFinal);
		echo json_encode($resultado);
	}


	public function reporteAnulados()
	{
		$fechaInicio=$this->input->post('fechaInicio');
		$fechaFinal=$this->input->post('fechaFinal');
		
		$resultado = $this->reporte_model->dbreporfechasAnulados($fechaInicio,$fechaFinal);
		echo json_encode($resultado);
	}

	public function reporteGlobalPDF($fechaInicio,$fechaFinal)
	{

		$this->load->library('pdf');

		//$id=$this->input->post('idCliente');
		//$fechaInicio=$this->input->post('fechaInicio');
		//$fechaFinal=$this->input->post('fechaFinal');

		$datos = $this->reporte_model->dbreporfechas($fechaInicio,$fechaFinal);
		//$datos=$datos->result();

		$this->pdf = new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages(); //numeracion
			$this->pdf->SetTitle('Recibo SVES'); //titulo de los plantas del documento o del pdf
			$this->pdf->SetLeftMargin(15); //margen izq.
			$this->pdf->SetRightMargin(15); //margen derecho
			$this->pdf->SetFillColor(230, 243, 250); //color de griss
			$this->pdf->SetFont('Arial', 'B', 18); //tipo de letra y tama;o
			
			$this->pdf->Ln(10);
			$this->pdf->cell(40); //tamanio de la celda
			$this->pdf->Cell(95, 10, 'REPORTE RESUMEN VENTAS', 0, 0, 'C', 1);
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

	    $montototal=0;

	    foreach ($datos as $row) {
			$montototal+=$row->subTotal;
			}


			$fechaInicio = date("d/m/Y", strtotime($fechaInicio));
			$fechaFinal = date("d/m/Y", strtotime($fechaFinal));

		// informacion general
		$this->pdf->SetFillColor(230, 243, 250); // color datos
	    $this->pdf->SetFont('Arial','B',10);
	    $this->pdf->Cell(30,6,utf8_decode('Fecha Inicio'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaInicio,1,0,'C',0);
	    $this->pdf->Cell(30);
	    $this->pdf->Cell(45,6,utf8_decode('Total Movimientos'),1,0,'C',1);
	    $this->pdf->Cell(45,6,'Bs.-  '.$montototal,1,0,'C',0);
	    $this->pdf->Ln(6);
	   	$this->pdf->Cell(30,6,utf8_decode('Fecha Final'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaFinal,1,0,'C',0);
	    $this->pdf->Cell(30);
	    //$this->pdf->Cell(45,6,utf8_decode('Total Utilidad'),1,0,'C',1);
	    //$this->pdf->Cell(45,6,'Bs.-  '.$utilidad,1,0,'C',0); // utilidad
	    $this->pdf->Ln(12);



		// cabecera de la tabla
		$this->pdf->SetFillColor(230, 243, 250); // color cabecera tabla
	    $this->pdf->SetFont('Arial','B',12);
	    $this->pdf->Cell(10,6,utf8_decode('N??'),1,0,'C',1);
	    $this->pdf->Cell(40,6,'Cliente',1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode('Producto'),1,0,'C',1);
	    $this->pdf->Cell(20,6,'Cantidad',1,0,'C',1);
	    $this->pdf->Cell(22,6,'Precio(Bs)',1,0,'C',1);
	    $this->pdf->Cell(27,6,'SubTotal(Bs)',1,0,'C',1);
	    $this->pdf->Cell(23,6,'Fecha',1,0,'C',1);
	    //$this->pdf->Cell(20,6,'Usuario',1,0,'C',1);
	    $this->pdf->Ln(6);


	    $cont=0;
		foreach ($datos as $row) {
			$cont++;
			$cliente=$row->cliente;
			$producto=$row->producto;
			$cantidad=$row->cantidad;
			$precio=$row->precioUnitario;
			$subTotal=$row->subTotal;
			$fecha=$row->fecha;
			$usuario=$row->login;

		$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(10,6,utf8_decode($cont),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($cliente),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($producto),1,0,'C',1);
	    $this->pdf->Cell(20,6,$cantidad,1,0,'C',1);
	    $this->pdf->Cell(22,6,$precio,1,0,'C',1);
	    $this->pdf->Cell(27,6,$subTotal,1,0,'C',1);
	    $this->pdf->Cell(23,6,$fecha,1,0,'C',1);
	    //$this->pdf->Cell(20,6,$usuario,1,0,'C',1);
	    $this->pdf->Ln(6);
		}

		// fila para el total
		// $this->pdf->SetFillColor(230, 243, 250);
    	// $this->pdf->SetFont('Arial','B',12); // color final tabla
    	// //$this->pdf->Cell(90); // posiciona en 85
	    // $this->pdf->Cell(110,6,'Total',1,0,'R',1);
	    // $this->pdf->Cell(27,6,$montototal,1,0,'C',1);
	    // $this->pdf->Cell(45,6,'',1,0,'C',1);
	    // $this->pdf->Ln(6);
		$this->pdf->SetFillColor(230, 243, 250);
    	$this->pdf->SetFont('Arial','B',12); // color final tabla
    	//$this->pdf->Cell(90); // posiciona en 85
	    $this->pdf->Cell(110,6,'',1,0,'R',1);
	    $this->pdf->Cell(22,6,'Total',1,0,'C',1);
	    $this->pdf->Cell(27,6,$montototal,1,0,'C',1);
		$this->pdf->Cell(23,6,'',1,0,'R',1);
	    $this->pdf->Ln(6);


		// crear y lanzar el pdf
		$ahora=time();
        $ahora = date("d-m-Y H:i:s", $ahora); 

		$this->pdf->Output("Reporte-".$ahora.".pdf","I");
	}

	//SEGUNDA OPCION POR PORDUCTO

	public function reporteXarticulosPDF($fechaInicio,$fechaFinal)
	{

		$datos = $this->reporte_model->dbreporfechasXproductos($fechaInicio,$fechaFinal);
		//$datos=$datos->result();

		$this->pdf=new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Recibo Global");
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('Arial','','12');
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'',0,0,'C');

		$this->pdf->Ln(12);
		

		// Cabecera principal
		// $this->pdf->SetFillColor(230, 243, 250);
	    // $this->pdf->SetFont('Arial','B',14);
	    // //Movernos a la derecha
		// $this->pdf->Cell(40);
	    // $this->pdf->Cell(90,6,utf8_decode('REPORTE PRODUCTOS VENDIDOS'),0,0,'C',1);
	    // $this->pdf->Ln(12);

		$this->pdf->SetFillColor(230, 243, 250);
	    $this->pdf->SetFont('Arial','B',18);
	    //Movernos a la derecha
		$this->pdf->Cell(38);
	    $this->pdf->Cell(110,10,utf8_decode('REPORTE PRODUCTOS VENDIDOS'),0,0,'C',1);
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

	    $mayor=0;
		$menor=100000;
	    foreach ($datos as $row) {
	    	if ($row->cantidad>$mayor) {
	    		$mayor=$row->cantidad;
	    	}
	    	if ($row->cantidad<$menor) {
	    		$menor=$row->cantidad;
	    	}
			}

		$ProductoMay="";
		$ProductoMen="";

			foreach ($datos as $row) {
	    	if ($row->cantidad==$mayor) {
	    		$ProductoMay=$row->producto;
	    	}
	    	if ($row->cantidad==$menor) {
	    		$ProductoMen=$row->producto;
	    	}
			}


			$fechaInicio = date("d/m/Y", strtotime($fechaInicio));
			$fechaFinal = date("d/m/Y", strtotime($fechaFinal));

		// informacion general
		$this->pdf->SetFillColor(230, 243, 250);
	    $this->pdf->SetFont('Arial','B',10);
	    $this->pdf->Cell(30,6,utf8_decode('Fecha Inicio'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaInicio,1,0,'C',0);
	    $this->pdf->Cell(40);
	    $this->pdf->Cell(40,6,utf8_decode('M??s Vendido'),1,0,'C',1);
	    $this->pdf->Cell(40,6,$ProductoMay,1,0,'C',0);
	    $this->pdf->Ln(6);
	   	$this->pdf->Cell(30,6,utf8_decode('Fecha Final'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaFinal,1,0,'C',0);
	    $this->pdf->Cell(40);
	    $this->pdf->Cell(40,6,utf8_decode('Menos Vendido'),1,0,'C',1);
	    $this->pdf->Cell(40,6,$ProductoMen,1,0,'C',0);
	    $this->pdf->Ln(12);



		// cabecera de la tabla
		$this->pdf->SetFillColor(230, 243, 250);
	    $this->pdf->SetFont('Arial','B',12);
	    $this->pdf->Cell(10,6,utf8_decode('N??'),1,0,'C',1);
	    $this->pdf->Cell(85,6,utf8_decode('Producto'),1,0,'C',1);
	    $this->pdf->Cell(40,6,'Cantidad vendida',1,0,'C',1);
	    $this->pdf->Cell(45,6,'Total Movimiento(Bs)',1,0,'C',1);
	    //$this->pdf->Cell(40,6,'Utilidad (Bs)',1,0,'C',1);
	    $this->pdf->Ln(6);


	    $cont=0;
	    $TotalMovimiento=0;

		foreach ($datos as $row) {
			$cont++;
			$TotalMovimiento+=$row->subTotal;
			$producto=$row->producto;
			$cantidad=$row->cantidad;
			$subTotal=$row->subTotal;
		// contenido de la tabla
		$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(10,6,utf8_decode($cont),1,0,'C',1);
	    $this->pdf->Cell(85,6,utf8_decode($producto),1,0,'C',1);
	    $this->pdf->Cell(40,6,$cantidad,1,0,'C',1);
	    $this->pdf->Cell(45,6,$subTotal,1,0,'C',1);
	    //$this->pdf->Cell(40,6,"",1,0,'C',1);
	    $this->pdf->Ln(6);

		}

		// fila para el total
		$this->pdf->SetFillColor(230, 243, 250);
    	$this->pdf->SetFont('Arial','B',12);
    	//$this->pdf->Cell(90); // posiciona en 85
	    $this->pdf->Cell(135,6,'Total',1,0,'R',1);
	    $this->pdf->Cell(45,6,$TotalMovimiento,1,0,'C',1);
	    //$this->pdf->Cell(40,6,"",1,0,'C',1);
	    $this->pdf->Ln(6);


		// crear y lanzar el pdf
		$ahora=time();
        $ahora = date("d-m-Y H:i:s", $ahora); 

		$this->pdf->Output("Reporte-".$ahora.".pdf","I");
	}


	
	//ANULADAS
	public function reporteAnuladasPDF($fechaInicio,$fechaFinal)
	{

		$datos = $this->reporte_model->dbreporfechasAnulados($fechaInicio,$fechaFinal);
		//$datos=$datos->result();

		$this->pdf = new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages(); //numeracion
			$this->pdf->SetTitle('Recibo SVES'); //titulo de los plantas del documento o del pdf
			$this->pdf->SetLeftMargin(15); //margen izq.
			$this->pdf->SetRightMargin(15); //margen derecho
			$this->pdf->SetFillColor(230, 243, 250); //color de griss
			$this->pdf->SetFont('Arial', 'B', 18); //tipo de letra y tama;o
			
			$this->pdf->Ln(10);
			$this->pdf->cell(45); //tamanio de la celda
			$this->pdf->Cell(100, 10, 'REPORTE VENTAS ANULADAS', 0, 0, 'C', 1);
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

	    $montototal=0;

	    foreach ($datos as $row) {
			$montototal+=$row->subTotal;
			}


			$fechaInicio = date("d/m/Y", strtotime($fechaInicio));
			$fechaFinal = date("d/m/Y", strtotime($fechaFinal));

		// informacion general
		$this->pdf->SetFillColor(230, 243, 250); // color datos
	    $this->pdf->SetFont('Arial','B',10);
	    $this->pdf->Cell(30,6,utf8_decode('Fecha Inicio'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaInicio,1,0,'C',0);
	    $this->pdf->Cell(30);
	    $this->pdf->Cell(45,6,utf8_decode('Total Movimientos'),1,0,'C',1);
	    $this->pdf->Cell(45,6,'Bs.-  '.$montototal,1,0,'C',0);
	    $this->pdf->Ln(6);
	   	$this->pdf->Cell(30,6,utf8_decode('Fecha Final'),1,0,'C',1);
	    $this->pdf->Cell(30,6,$fechaFinal,1,0,'C',0);
	    $this->pdf->Cell(30);
	    //$this->pdf->Cell(45,6,utf8_decode('Total Utilidad'),1,0,'C',1);
	    //$this->pdf->Cell(45,6,'Bs.-  '.$utilidad,1,0,'C',0); // utilidad
	    $this->pdf->Ln(12);



		// cabecera de la tabla
		$this->pdf->SetFillColor(230, 243, 250); // color cabecera tabla
	    $this->pdf->SetFont('Arial','B',12);
	    $this->pdf->Cell(10,6,utf8_decode('N??'),1,0,'C',1);
	    $this->pdf->Cell(40,6,'Cliente',1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode('Producto'),1,0,'C',1);
	    $this->pdf->Cell(20,6,'Cantidad',1,0,'C',1);
	    $this->pdf->Cell(22,6,'Precio(Bs)',1,0,'C',1);
	    $this->pdf->Cell(27,6,'SubTotal(Bs)',1,0,'C',1);
	    $this->pdf->Cell(23,6,'Fecha',1,0,'C',1);
	    //$this->pdf->Cell(20,6,'Usuario',1,0,'C',1);
	    $this->pdf->Ln(6);


	    $cont=0;
		foreach ($datos as $row) {
			$cont++;
			$cliente=$row->cliente;
			$producto=$row->producto;
			$cantidad=$row->cantidad;
			$precio=$row->precioUnitario;
			$subTotal=$row->subTotal;
			$fecha=$row->fecha;
			$usuario=$row->login;

		$this->pdf->SetFillColor(255,255,255);
    	$this->pdf->SetFont('Arial','',10);
    	$this->pdf->Cell(10,6,utf8_decode($cont),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($cliente),1,0,'C',1);
	    $this->pdf->Cell(40,6,utf8_decode($producto),1,0,'C',1);
	    $this->pdf->Cell(20,6,$cantidad,1,0,'C',1);
	    $this->pdf->Cell(22,6,$precio,1,0,'C',1);
	    $this->pdf->Cell(27,6,$subTotal,1,0,'C',1);
	    $this->pdf->Cell(23,6,$fecha,1,0,'C',1);
	    //$this->pdf->Cell(20,6,$usuario,1,0,'C',1);
	    $this->pdf->Ln(6);
		}

		// fila para el total
		$this->pdf->SetFillColor(230, 243, 250);
    	$this->pdf->SetFont('Arial','B',12); // color final tabla
    	//$this->pdf->Cell(90); // posiciona en 85
	    $this->pdf->Cell(110,6,'',1,0,'R',1);
	    $this->pdf->Cell(22,6,'Total',1,0,'C',1);
	    $this->pdf->Cell(27,6,$montototal,1,0,'C',1);
		$this->pdf->Cell(23,6,'',1,0,'R',1);
	    $this->pdf->Ln(6);


		// crear y lanzar el pdf
		$ahora=time();
        $ahora = date("d-m-Y H:i:s", $ahora); 

		$this->pdf->Output("Reporte-".$ahora.".pdf","I");
	}


}
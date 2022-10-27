<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablero extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("producto_model");
		$this->load->model("reporte_model");
		$this->load->model("cliente_model");
	}


	public function index()
	{

		$fecha = date('Y-m-d h:i:s a', time());
		$fechaComoEntero = strtotime($fecha);
		$anioActual = date("Y", $fechaComoEntero); 
		$mesActual = date("m", $fechaComoEntero); 

		$fechaInicio=$anioActual.'-'.$mesActual.'-'.'01';
		$fechaFinal=$anioActual.'-'.$mesActual.'-'.'31';

		$listaProductos=$this->producto_model->listarProducto();
		$listaClientes=$this->cliente_model->listarCliente();
		// $listaCategoria=$this->producto_model->listarCategoria();
		// $listaMarca=$this->producto_model->listarMarca();
		$data['producto']=$listaProductos;
		$data['cliente']=$listaClientes;
		// $data['categorias']=$listaCategoria;
		// $data['marcas']=$listaMarca;

		$totalVentasDia=$this->reporte_model->ventasHoy(); 
		$totalVentasMes=$this->reporte_model->ventasmes($fechaInicio,$fechaFinal);
		// $capitalPrincipal=$this->reporte_model->capitalPrincipal();  
		// $totalCreditos=$this->reporte_model->totalCreditos();
		
		$data['totalVentasDia']=$totalVentasDia;
		$data['totalVentasMes']=$totalVentasMes;
		// $data['capitalPrincipal']=$capitalPrincipal;
		// $data['totalCredito']=$totalCreditos;


		$this->load->view('layouts/header'); 
		$this->load->view('layouts/aside'); 
		$this->load->view('tablero/index' ,$data); //
		$this->load->view('layouts/footer');
	}


	
	
	

	


	public function getProducto(){
		$id=$_POST['id'];
		$user= $this->producto_model->get($id);

		echo json_encode($user->result());
	}
	



}
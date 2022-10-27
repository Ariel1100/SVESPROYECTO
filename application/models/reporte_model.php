<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model
{
// 	// para reportes ventas
	public function dbreporfechas($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("u.login, concat((c.nombres),(' '), IFNULL((c.primerApellido),('')),(' '), IFNULL((c.segundoApellido),(''))) as cliente, p.nombreProducto as producto, d.cantidad, d.precioUnitario, (d.cantidad* d.precioUnitario) as subTotal  , DATE_FORMAT((v.fechaRegistro),('%d/%m/%Y')) as fecha")
						->from('venta v')
						->join('cliente c','v.idCliente=c.idCliente')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('producto p','d.idProducto=p.idProducto')
						->where('DATE(v.fechaRegistro)>=',$fechaInicio)
						->where('DATE(v.fechaRegistro)<=',$fechaFinal)
						->where('v.estado',1)
						->get();
		return $query->result();	
	}

	
	// 	// para reportes ventas anuladas
	public function dbreporfechasAnulados($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("u.login, concat((c.nombres),(' '), IFNULL((c.primerApellido),('')),(' '), IFNULL((c.segundoApellido),(''))) as cliente, p.nombreProducto as producto, d.cantidad, d.precioUnitario, (d.cantidad* d.precioUnitario) as subTotal  , DATE_FORMAT((v.fechaRegistro),('%d/%m/%Y')) as fecha")
						->from('venta v')
						->join('cliente c','v.idCliente=c.idCliente')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('producto p','d.idProducto=p.idProducto')
						->where('DATE(v.fechaRegistro)>=',$fechaInicio)
						->where('DATE(v.fechaRegistro)<=',$fechaFinal)
						->where('v.estado',0)
						->get();
		return $query->result();	
	}

	
// 	// para reportes ventas
	public function dbreporfechasXproductos($fechaInicio,$fechaFinal)
	{
		
		$query=$this->db->select("p.nombreProducto as producto, sum(d.cantidad) as cantidad, d.precioUnitario, sum(d.cantidad* d.precioUnitario) as subTotal ")
						->from('venta v')
						->join('cliente c','v.idCliente=c.idCliente')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('producto p','d.idProducto=p.idProducto')
						->where('DATE(v.fechaRegistro)>=',$fechaInicio)
						->where('DATE(v.fechaRegistro)<=',$fechaFinal)
						->where('v.estado',1)
						->group_by('p.nombreProducto')
						->get();
		return $query->result();	
	}


// 	// para reportes compras
// 	public function dbreporfechasXarticulosC($fechaInicio,$fechaFinal)
// 	{
		
// 		$query=$this->db->select("a.nombre as articulo, sum(d.cantidad) as cantidad, d.precioCompra, sum(d.cantidad* d.precioCompra) as subTotal")
// 						->from('compra c')
// 						->join('usuario u','c.idUsuario=u.idUsuario')
// 						->join('detallecompra d','c.idCompra=d.idCompra')
// 						->join('articulo a','d.idArticulo=a.idArticulo')
// 						->where('DATE(c.fechaHora)>=',$fechaInicio)
// 						->where('DATE(c.fechaHora)<=',$fechaFinal)
// 						->where('c.estado',1)
// 						->group_by('a.nombre')
// 						->get();
// 		return $query->result();	
	
// 	}


	public function ventasHoy()
	{
		//$hoy=date_default_timezone_get();
		$hoy = date('Y-m-d');

		
		$query=$this->db->select('sum(d.cantidad* d.precioUnitario) as totalVentaDia')
						->from('venta v')
						->join('cliente c','v.idCliente=c.idCliente')
						->join('usuario u','v.idUsuario=u.idUsuario')
						->join('detalleventa d','v.idVenta=d.idVenta')
						->join('producto p','d.idProducto=p.idProducto')
						->where('DATE(v.fechaRegistro)',$hoy)
						->where('v.estado',1)
						->get();
		return $query->result();	
	}

	public function ventasmes($fechaInicio,$fechaFinal)
	{
		$query=$this->db->select(' sum(v.precioTotal) as totalmes')
						->from('venta v')
						->where('DATE(v.fechaRegistro)>=',$fechaInicio)
						->where('DATE(v.fechaRegistro)<=',$fechaFinal)
						->where('v.estado',1)
						->get();
		return $query->result();	
			
	}




	// public function capitalTarjetas()
	// {
		
	// 	$query=$this->db->select('sum(stock*precioCompra) as capitalTarjetas')
	// 					->from('articulo')
	// 					->where('estado',1)
	// 					->get();
	// 	return $query->result();	
	// }

	// public function capitalPrincipal()
	// {
		
	// 	$query=$this->db->select('montoCapital')
	// 					->from('capital')
	// 					->get();
	// 	return $query->result();	
	// }







	

	
	
}
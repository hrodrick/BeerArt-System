<?php 
namespace Models;

use Models\LineaPedido as LineaPedido;

class Pedido {

	private $id;
	private $cliente;
	private $sucursal;
	private $fecha;
	private $estado; // 3 estados 'En Preparacion' - 'Enviado' - 'Entregado'
	private $pedido;

	function __construct(){
		$this->id=0;
		$this->cliente=0;
		$this->sucursal=0;
		$this->fecha=date('Y-m-d H:i:s');
		$this->estado=0;
		$this->pedido=array();
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getCliente(){
		return $this->cliente;
	}

	function setCliente($cliente){
		$this->cliente=$cliente;
	}

	function getSucursal(){
		return $this->sucursal;
	}

	function setSucursal($sucursal){
		$this->sucursal=$sucursal;
	}

	function getFecha(){
		return $this->fecha;
	}

	function setFecha($fecha){
		$this->fecha=$fecha;
	}

	function getEstado(){
		return $this->estado;
	}

	function setEstado($estado){
		$this->estado=$estado;
	}

	function getPedido(){
		return $this->pedido;
	}

	function addLinea($linea){
		$ok=0;
		foreach ($this->pedido as $value) {
			if($value->getCerveza()->getId() == $linea->getCerveza()->getId() && $value->getEnvase()->getId() == $linea->getEnvase()->getId()){
				$value->setCantidad($value->getCantidad()+$linea->getCantidad());
				$ok=1;
			}
		}
		if(!$ok){		
			$this->pedido[]=$linea;
		}
	}

	function addArray($array){
		array_push($this->pedido, $array);
	}

	function contarLineas(){
		return count($this->pedido);
	}

	function delLinea($id){
		unset($this->pedido[$id]);
	}

	function getTotal(){
		$total=0;
		foreach ($this->pedido as $key => $value) {
			$total+=$value->getSubtotal();
		}
		return $total;
	}
}
?>
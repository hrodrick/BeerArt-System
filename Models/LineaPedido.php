<?php 
namespace Models;

use Models\Cerveza as Cerveza;
use Models\Envase as Envase;

class LineaPedido {

	private $id;
	private $idPedido;
	private $cerveza;
	private $envase;
	private $precioUnitario;
	private $cantidad;

	function __construct($cerveza,$envase,$precioUnitario,$cantidad){
		$this->id=0;
		$this->idPedido=0;
		$this->cerveza=$cerveza;
		$this->envase=$envase;
		$this->precioUnitario=$precioUnitario;
		$this->cantidad=$cantidad;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getIdPedido(){
		return $this->idPedido;
	}

	function setIdPedido($idPedido){
		$this->idPedido=$idPedido;
	}

	function getCerveza(){
		return $this->cerveza;
	}

	function setCerveza($cerveza){
		$this->cerveza=$cerveza;
	}

	function getEnvase(){
		return $this->envase;
	}

	function setEnvase($envase){
		$this->envase=$envase;
	}

	function getPrecioUnitario(){
		return $this->precioUnitario;
	}

	function setPrecioUnitario($precioUnitario){
		$this->precioUnitario=$precioUnitario;
	}

	function getCantidad(){
		return $this->cantidad;
	}

	function setCantidad($cantidad){
		$this->cantidad=$cantidad;
	}

	function getSubtotal(){
		return $this->getCerveza()->getPrecioXLitro()*$this->getEnvase()->getCoeficiente()*$this->getCantidad();
	}
}
?>

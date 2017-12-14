<?php 
namespace Models;

use Models\Envio as Envio;

class Envio {

	private $id;
	private $idPedido;
	private $domicilio;
	private $horario;

	function __construct($idPedido,$domicilio,$horario){
		$this->id=0;
		$this->idPedido=$idPedido;
		$this->domicilio=$domicilio;
		$this->horario=$horario;
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

	function getDomicilio(){
		return $this->domicilio;
	}

	function setDomicilio($domicilio){
		$this->domicilio=$domicilio;
	}

	function getHorario(){
		return $this->horario;
	}

	function setHorario($horario){
		$this->horario=$horario;
	}	
}
?>
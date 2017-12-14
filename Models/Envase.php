<?php 
namespace Models;

class Envase {

	private $id;
	private $tipo;
	private $capacidad;
	private $coeficiente;
	private $foto;
	private $standBy;

	function __construct($tipo,$capacidad,$coeficiente,$foto,$standBy=0){
		$this->id=0;
		$this->tipo=$tipo;
		$this->capacidad=$capacidad;
		$this->coeficiente=$coeficiente;
		$this->foto=$foto;
		$this->standBy=$standBy;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getTipo(){
		return $this->tipo;
	}

	function setTipo($tipo){
		$this->tipo=$tipo;
	}

	function getCapacidad(){
		return $this->capacidad;
	}

	function setCapacidad($capacidad){
		$this->capacidad=$capacidad;
	}

	function getCoeficiente(){
		return $this->coeficiente;
	}

	function setCoeficiente($coeficiente){
		$this->coeficiente=$coeficiente;
	}

	function getFoto(){
		return $this->foto;
	}

	function setFoto($foto){
		$this->foto=$foto;
	}

	function getStandBy(){
		return $this->standBy;
	}

	function setStandBy($standBy){
		$this->standBy=$standBy;
	}
}
?>
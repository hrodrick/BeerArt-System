<?php 
namespace Models;

class EnvxcerDTO {

	private $id;
	private $idCerveza;
	private $idEnvase;
	private $tiene;
	private $tipo;
	private $capacidad;
	private $coeficiente;
	private $foto;
	private $standBy;

	function __construct($id=0,$idCerveza,$idEnvase,$tiene,$tipo,$capacidad,$coeficiente,$foto,$standBy=0){
		$this->id=$id;
		$this->idCerveza=$idCerveza;
		$this->idEnvase=$idEnvase;
		$this->tiene=$tiene;
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

	function getIdCerveza(){
		return $this->idCerveza;
	}

	function setIdCerveza($idCerveza){
		$this->idCerveza=$idCerveza;
	}

	function getIdEnvase(){
		return $this->idEnvase;
	}

	function setIdEnvase($idEnvase){
		$this->idEnvase=$idEnvase;
	}

	function getTiene(){
		return $this->tiene;
	}

	function setTiene($tiene){
		$this->tiene=$tiene;
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

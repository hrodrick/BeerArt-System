<?php 
namespace Models;

class Usuario extends Persona{

	private $idRol;
	private $standBy;

	function __construct($idRol=0,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$standBy=0){
		parent::__construct($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password);
		$this->idRol=$idRol;
		$this->standBy=$standBy;
	}

	function getIdRol(){
		return $this->idRol;
	}

	function setIdRol($idRol){
		$this->idRol=$idRol;
	}

	function getStandBy(){
		return $this->standBy;
	}

	function setStandBy($standBy){
		$this->standBy=$standBy;
	}	
}
?>

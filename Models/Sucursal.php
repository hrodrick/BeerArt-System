<?php 
namespace Models;

class Sucursal {

	private $id;
	private $nombre;
	private $domicilio;
	private $localidad;
	private $telefono;
	private $standBy;

	function __construct($nombre,$domicilio,$localidad,$telefono,$standBy=0){
		$this->id=0;
		$this->nombre=$nombre;
		$this->domicilio=$domicilio;
		$this->localidad=$localidad;
		$this->telefono=$telefono;
		$this->standBy=$standBy;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getNombre(){
		return $this->nombre;
	}

	function setNombre($nombre){
		$this->nombre=$nombre;
	}

	function getDomicilio(){
		return $this->domicilio;
	}

	function setDomicilio($domicilio){
		$this->domicilio=$domicilio;
	}

	function getLocalidad(){
		return $this->localidad;
	}

	function setLocalidad($localidad){
		$this->localidad=$localidad;
	}

	function getTelefono(){
		return $this->telefono;
	}

	function setTelefono($telefono){
		$this->telefono=$telefono;
	}

	function getStandBy(){
		return $this->standBy;
	}

	function setStandBy($standBy){
		$this->standBy=$standBy;
	}
}

?>
<?php 
namespace Models;

class Rol {

	private $id;
	private $rol;
	private $descripcion;
	private $permisos;
	private $standBy;

	function __construct($rol,$descripcion,$permisos,$standBy=0){
		$this->id=0;
		$this->rol=$rol;
		$this->descripcion=$descripcion;
		$this->permisos=$permisos;
		$this->standBy=$standBy;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getRol(){
		return $this->rol;
	}

	function setRol($rol){
		$this->rol=$rol;
	}

	function getDescripcion(){
		return $this->descripcion;
	}

	function setDescripcion($descripcion){
		$this->descripcion=$descripcion;
	}

	function getPermisos(){
		return $this->permisos;
	}

	function setPermisos($permisos){
		$this->permisos=$permisos;
	}

	function getStandBy(){
		return $this->standBy;
	}

	function setStandBy($standBy){
		$this->standBy=$standBy;
	}
}
?>
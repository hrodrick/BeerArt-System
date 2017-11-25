<?php
namespace Models;

class Cerveza {

	private $id;
	private $tipo;
	private $descripcion;
	private $precioXLitro;
	private $foto;
	private $standBy;

	function __construct($tipo,$descripcion,$precioXLitro,$foto='',$standBy=0){
		$this->id=0;
		$this->tipo=$tipo;
		$this->descripcion=$descripcion;
		$this->precioXLitro=$precioXLitro;
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

	function getDescripcion(){
		return $this->descripcion;
	}

	function setDescripcion($descripcion){
		$this->descripcion=$descripcion;
	}

	function getPrecioXLitro(){
		return $this->precioXLitro;
	}

	function setPrecioXLitro($precioXLitro){
		$this->precioXLitro=$precioXLitro;
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
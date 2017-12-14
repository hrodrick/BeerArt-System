<?php 
namespace Models;

class Envxcer {

	private $id;
	private $idcer;
	private $idenv;
	private $tiene;

	function __construct($idcer,$idenv,$tiene){
		$this->idcer=$idcer;
		$this->idenv=$idenv;
		$this->tiene=$tiene;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}
	function getIdCer(){
		return $this->idcer;
	}

	function setIdCer($idcer){
		$this->idcer=$idcer;
	}

	function getIdEnv(){
		return $this->idenv;
	}

	function setIdEnv($idenv){
		$this->idenv=$idenv;
	}

	function getTiene(){
		return $this->tiene;
	}

	function setTiene($tiene){
		$this->tiene=$tiene;
	}	
}
?>
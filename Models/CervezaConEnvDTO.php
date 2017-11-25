<?php 
namespace Models;
use Models\Cerveza as Cerveza;

class CervezaConEnvDTO extends Cerveza{

	private $envases;

	function __construct($id=0,$tipo,$descripcion,$precioXLitro,$foto,$standBy=0){
		parent::__construct($tipo,$descripcion,$precioXLitro,$foto,$standBy=0);
		parent::setId($id);
		$this->envases=array();
	}

	function addEnvase($obj){
		$this->envases[]=$obj;
	}

	function contarEnvases(){
		return count($this->envases);
	}

	function getEnvases(){
		return $this->envases;
	}
}
?>

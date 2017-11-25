<?php
namespace Daos\Lista;

trait tListaDAO{

	private $id=0;
	private $session;
	private $lista=array();
	private $listaPaginada=array();

	function insertar($obj){
		if(isset($_SESSION[$this->session]) && (!empty($_SESSION[$this->session]))){
			$this->ordenarListado('id','asc');
			$this->id=end($this->lista)->getId();
		}
		$this->id+=1;
		$obj->setId($this->id);
		$this->lista[]=$obj;
		$_SESSION[$this->session]=$this->lista;		
	}

	function eliminar($id){
		foreach ($this->lista as $key => $value) {
			if($value->getId()==$id){
				unset($this->lista[$key]);
				$_SESSION[$this->session]=$this->lista;	
			}
		}
	}

	function modificarStandBy($id){
		print($this->session.'<BR>');
		foreach ($this->lista as $key => $value) {
			if($value->getId()==$id){
				$value->setStandBy(!$value->getStandBy());
				$_SESSION[$this->session]=$this->lista;	
			}
		}		
	}

	function modificar($obj){
		foreach ($this->lista as $key => $value) {
			if($value->getId()==$obj->getId()){
				$this->lista[$key]=$obj;
				$_SESSION[$this->session]=$this->lista;	
			}
		}
	}

	function listar($page,$campo,$orden){
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$this->ordenarListado($campo,$orden);		
		$this->listaPaginada = array_slice($this->lista,$page1,PAGINATION);		
		return $this->listaPaginada;
	}

	function listAll(){
		return $this->lista;
	}

	function contar(){
		return count($this->lista);
	}

	abstract public function ordenarListado();

	function buscarId($id){
		foreach ($this->lista as $key => $value) {
			if($value->getId()==$id){
				$obj=$value;
			}
		}
		return $obj;
	}
}
?>

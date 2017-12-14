<?php
namespace Daos\Lista;

use Models\Envxcer as Envxcer;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\Lista\tListaDAO as tListaDAO;
use Daos\iDao as iDao;

class ListaEnvxcerDAO extends SingletonAbstractDAO implements iDao{

	use tListaDAO;

	function __construct(){
		$this->session='Envxcer';
		if(isset($_SESSION[$this->session])){
			$this->lista=$_SESSION[$this->session];
		}
	}

	function ordenarListado($campo,$orden){
	   	$aux=array();
	   	$resultado=array();
	   	foreach ($this->lista as $key => $obj) {
	   		switch ($campo) {
	   			case 'id':
	        		$aux[$key] = $obj->getId();
	   				break;				
	   		}
	    }
		($orden=='asc')?asort($aux):arsort($aux);
	    foreach ($aux as $key => $valor) {
        	$resultado[] = $this->lista[$key];
    	}
    	$this->lista=$resultado;
		$_SESSION[$this->session]=$resultado;			
	}

	function listarXCerveza($id,$page,$campo,$orden){
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}
		$listaFiltrada=array();
		foreach ($this->lista as $key => $value) {
			if($value->getIdCer()==$id){
				$listaFiltrada[]=$value;
			}
		}
		$this->ordenarListado($campo,$orden);		
		$this->listaPaginada = array_slice($listaFiltrada,$page1,PAGINATION);		
		return $this->listaPaginada;
	}	
}
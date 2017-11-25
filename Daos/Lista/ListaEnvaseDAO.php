<?php
namespace Daos\Lista;

use Models\Envase as Envase;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\Lista\tListaDAO as tListaDAO;
use Daos\iDao as iDao;

class ListaEnvaseDAO extends SingletonAbstractDAO implements iDao{

	use tListaDAO;

	function __construct(){
		$this->session='Envases';
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
	   			case 'tipo':
	        		$aux[$key] = $obj->getTipo();
	   				break;
	   			case 'capacidad':
	        		$aux[$key] = $obj->getCapacidad();
	   				break;
	   			case 'coeficiente':
	        		$aux[$key] = $obj->getCoeficiente();
	   				break;	 
	   			case 'standBy':
	        		$aux[$key] = $obj->getStandBy();
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
}
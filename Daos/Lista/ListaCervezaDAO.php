<?php
namespace Daos\Lista;

use Models\Cerveza as Cerveza;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\Lista\tListaDAO as tListaDAO;
use Daos\iDao as iDao;

class ListaCervezaDAO extends SingletonAbstractDAO implements iDao{

	use tListaDAO;

	function __construct(){
		$this->session='Cervezas';		
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
	   			case 'precioXLitro':
	        		$aux[$key] = $obj->getPrecioXLitro();
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

?>
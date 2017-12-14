<?php
namespace Daos\Lista;

use Models\Rol as Rol;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\Lista\tListaDAO as tListaDAO;
use Daos\iDao as iDao;

class ListaRolDAO extends SingletonAbstractDAO implements iDao{

	use tListaDAO;

	function __construct(){
		$this->session='Roles';		
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
	   			case 'rol':
	        		$aux[$key] = $obj->getRol();
	   				break; 	
	   			case 'permisos':
	        		$aux[$permisos] = $obj->getPermisos();
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
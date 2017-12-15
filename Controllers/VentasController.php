<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBEnvaseDAO as DBEnvaseDAO;
use Daos\DB\DBEnvxcerDAO as DBEnvxcerDAO;
use Daos\DB\DBPedidoDAO as DBPedidoDAO;


class VentasController{

	private $datosTipoCerveza;
	private $datosEnvase;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosTipoCerveza = ListaCervezaDAO::getInstance();
		$this->datosTipoCerveza = DBCervezaDAO::getInstance();
		$this->datosPedido = DBPedidoDAO::getInstance();
	}
	
	public function litrosVendidosEntreFechas(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}
		require(URL_VISTA_BACK."litrosVendidosEntreFechas.php");
	}
	

	public function ltsVendEntreFechas($inicio, $fin){
		
		$cervezas = array();
		$ltsVendidos = array();
		
		if(strtotime($inicio) > strtotime($fin)){
			$msj = "Error: la fecha de 'desde' debe ser menor a la de 'hasta'";
		}else{
			
			$cervezas = $this->datosPedido->litrosVendidosEntreFechas($inicio, $fin);
			foreach ($cervezas as $cerv) {
				$lts = 0;
				foreach ($cerv->getListaEnvases() as $env) {
					$lts += $env->getCapacidad(); 
				}
				array_push($ltsVendidos, $lts);
			}
		}

		$totalCount = count($cervezas);

		var_dump($ltsVendidos);
		var_dump($cervezas);

		require(URL_VISTA_BACK."litrosVendidosEntreFechas.php");
	}

/*
	public function ltsVendEntreFechas($inicio, $fin){
		if(strtotime($inicio) > strtotime($fin)){
			$msj = "Error: la fecha de 'desde' debe ser menor a la de 'hasta'";
		}else{
			$cervezas = array();
			$cervezas = $this->datosPedido->litrosVendidosEntreFechas($inicio, $fin);
			$cerIds = array_keys($cervezas);
			
			foreach ($cerIds as $cerId) {
				array_push( $cervezas, $this->datosTipoCerveza->buscarId($cerId) );
			}

			$totalCount = count($cervezas);
		}

		require(URL_VISTA_BACK."litrosVendidosEntreFechas.php");
	}
*/

}

?>

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

	public function ltsVendEntreFechas($inicio, $fin){
		if(strtotime($inicio) > strtotime($fin)){
			$msj = "Error: la fecha de 'desde' debe ser menor a la de 'hasta'";
		}
		$cervezas = array();
		$litrosPorCerveza = $this->datosPedido->litrosVendidosEntreFechas($inicio, $fin);
		$cerIds = array_keys($litrosPorCerveza);
		
		foreach ($cerIds as $cerId) {
			array_push( $cervezas, $this->datosTipoCerveza->buscarId($cerId) );
		}

		$totalCount = count($cervezas);


		require(URL_VISTA_BACK."litrosVendidosEntreFechas.php");
	}


}

?>
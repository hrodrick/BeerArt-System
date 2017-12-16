<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBEnvaseDAO as DBEnvaseDAO;
use Daos\DB\DBEnvxcerDAO as DBEnvxcerDAO;
use Daos\DB\DBPedidoDAO as DBPedidoDAO;
use PDOException;


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
		
		try{
			if(strtotime($inicio) > strtotime($fin)){
				$msj = "Error: la fecha de 'desde' debe ser menor a la de 'hasta'";
			}else{
				
				$cervezas = $this->datosPedido->litrosVendidosEntreFechas($inicio, $fin);
				
			}
		}
		catch(PDOException $ex){
			$msj = "Query Error: ".$ex->getMessage();
		}
		/* MUESTRA CADA OBJETO ORDENADAMENTE.
		foreach ($cervezas as $cer) {
			echo 'CERVEZA: <br>';
				var_dump($cer->getCerveza());
				echo "<br>";
			foreach ($cer->getListaEnvasesDTO() as $env) {
				echo 'ENVASE: <br>';
				var_dump($env->getEnvase());
				echo "<br>";
				echo 'litros vendidos: ';
					var_dump($env->getCantidadHistoricaVendida());
					echo "<br>";
			}
			
		}
		*/

		$totalCount = count($cervezas);

		require(URL_VISTA_BACK."litrosVendidosEntreFechas.php");
	}

}

?>

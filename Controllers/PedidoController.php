<?php
namespace Controllers;

use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBEnvaseDAO as DBEnvaseDAO;
use Daos\DB\DBClienteDAO as DBClienteDAO;
use Daos\DB\DBPedidoDAO as DBPedidoDAO;
use Daos\DB\DBEnvioDAO as DBEnvioDAO;
use Daos\DB\DBLineaPedidoDAO as DBLineaPedidoDAO;
use Daos\DB\DBSucursalDAO as DBSucursalDAO;
use Models\Cerveza as Cerveza;
use Models\Envase as Envase;
use Models\Pedido as Pedido;
use Models\Envio as Envio;
use Models\LineaPedido as LineaPedido;
use Models\Sucursal as Sucursal;
use Models\Usuario as Usuario;
use Utils\Thumb as Thumb;

class PedidoController{

	private $datosTipoCerveza;
	private $datosEnvase;
	private $datosPedido;	
	private $datosLineaPedido;	
	private $datosSucursal;	
	private $datosCliente;

	function __construct(){
		$this->datosTipoCerveza = DBCervezaDAO::getInstance();
		$this->datosEnvase = DBEnvaseDAO::getInstance();
		$this->datosPedido = DBPedidoDAO::getInstance();		
		$this->datosEnvio = DBEnvioDAO::getInstance();		
		$this->datosLineaPedido = DBLineaPedidoDAO::getInstance();		
		$this->datosSucursal = DBSucursalDAO::getInstance();		
		$this->datosCliente = DBClienteDAO::getInstance();
	}

	public function addCart($cantidad,$idCerveza,$idEnvase){
		$cerveza=$this->datosTipoCerveza->buscarId($idCerveza);
		$envase=$this->datosEnvase->buscarId($idEnvase);
		$linea=new LineaPedido($cerveza,$envase,$cerveza->getPrecioXLitro()*$envase->getCoeficiente(),$cantidad);

		if(!isset($_SESSION['pedido'])){
			$pedido=new Pedido();
			$_SESSION['pedido']=$pedido;
		}

		$_SESSION['pedido']->addLinea($linea);		
		$cerveza = $this->datosTipoCerveza->productoConEnv($idCerveza);
		header("Location: ".DIR."Front/producto/".base64_encode($idCerveza));
	}

	public function nuevo($lugar,$dom,$horario=0,$suc){
		/*
		$dir1='San Martín 3000, Mar del Plata';
		print('<BR>Direccion envio: '.$dir1);
		foreach ($sucursales as $key => $value) {	
			$dir2=$value->getDomicilio().', '.$value->getLocalidad();
			$distancia=$this->getDistance($dir1,$dir2,'K');	
			print('<BR>'.$key.' - '.$dir2);
			print(' - Distancia: '.$distancia);
			if($key==0){
				$menor=$distancia;
			}
			if($distancia<$menor){
				$menor=$distancia;
			}
		}
		print('<BR>Distancia Menor: '.$menor);
		*/
		if($lugar==1){
			foreach ($_SESSION['sucursales'] as $key => $value) {
				$dir2=$value->getDomicilio().', '.$value->getLocalidad();
				$distancia=$this->getDistance($dom,$dir2,'K');
				$distancia=0;
				if($key==0){
					$menor=$distancia;
					$suc=$value->getId();
				}
				if($distancia<$menor){
					$menor=$distancia;
					$suc=$value->getId();
				}				
			}
		}
		$_SESSION['pedido']->setSucursal($suc);
		$_SESSION['pedido']->setCliente($_SESSION['usuario']->getId());
		$idPedido=$this->datosPedido->insertar($_SESSION['pedido']);

		foreach ($_SESSION['pedido']->getPedido() as $key => $value) {
			$value->setIdPedido($idPedido);
			$this->datosLineaPedido->insertar($value);
		}
		if($lugar==1){
			$envio = new Envio($idPedido,$dom,$horario);
			$this->datosEnvio->insertar($envio);
		}
		$_SESSION['pedido']=NULL;
		header("Location: ".DIR."Pedido/enviado/");	
	}


	public function myCart(){	
		require(URL_VISTA_FRONT."myCart.php");
	}

	public function enviado(){ 
		$msg = 'Su pedido esta siendo procesado';
		require(URL_VISTA_FRONT."ok.php");	
	}

	public function pedidos($page=1){
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
	    $totalCount=$this->datosPedido->contarPorCliente($_SESSION['usuario']);
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION_FRONT;
	    	$countPages = ceil($countPages);
		}	
		$listaLineasPedido=array();
		$pedidos=$this->datosPedido->listarPorCliente($_SESSION['usuario'],$page);
		foreach ($pedidos as $key => $valuePedidos) {
			$listaLineasPedido=$this->datosLineaPedido->listarPorPedido($valuePedidos->getId());
			foreach ($listaLineasPedido as $key => $valueListaPedido) {
				$valueListaPedido->setCerveza($this->datosTipoCerveza->buscarId($valueListaPedido->getCerveza()));
				$valueListaPedido->setEnvase($this->datosEnvase->buscarId($valueListaPedido->getEnvase()));
				$valuePedidos->addLinea($valueListaPedido);
			}
		}

		require(URL_VISTA_FRONT."pedidos.php");	
	}

	public function estadoPedidos($page=1,$campo='fecha',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
		$cliente='';
		$sucursal='';
	    $totalCount=$this->datosPedido->contarSinEntregados();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	
		$listaLineasPedido=array();
		$pedidos=$this->datosPedido->listarSinEntregados($page,$campo,$orden);
		foreach ($pedidos as $key => $valuePedidos) {
			$listaLineasPedido=$this->datosLineaPedido->listarPorPedido($valuePedidos->getId());
			$sucursal=$this->datosSucursal->buscarId($valuePedidos->getSucursal());
			$valuePedidos->setSucursal($sucursal);
			$cliente=$this->datosCliente->buscarId($valuePedidos->getCliente());
			$valuePedidos->setCliente($cliente);			
			foreach ($listaLineasPedido as $key => $valueListaPedido) {
				$valueListaPedido->setCerveza($this->datosTipoCerveza->buscarId($valueListaPedido->getCerveza()));
				$valueListaPedido->setEnvase($this->datosEnvase->buscarId($valueListaPedido->getEnvase()));
				$valuePedidos->addLinea($valueListaPedido);
			}
		}
		require(URL_VISTA_BACK."estadoPedidos.php");	
	}

	public function cambioEstado($estado,$idPedido,$page){
		$fecha='';
		if($estado==2){
			$fecha=date('Y-m-d H:i:s');
		}
		$this->datosPedido->actualizarEstado($idPedido,$estado);
		$this->estadoPedidos($page);
	}

	public function borrarLinea($id){	
		$_SESSION['pedido']->delLinea(base64_decode($id));
		require(URL_VISTA_FRONT."myCart.php");
	}

	public function confirmar(){
		$menor=0;
		$sucursales=$this->datosSucursal->listAll();
		$_SESSION['sucursales']=$sucursales;

		require(URL_VISTA_FRONT."confirmar.php");		
	}

	public function reorder($page,$campo,$orden){
		$this->datosCliente->listarAll($page,$campo,$orden);
		header("Location: ".DIR."Pedido/listadoPorCliente/".$page."/".$campo."/".$orden);		
	}

	public function listadoPorCliente($page=1,$campo='apellido',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$clientes = array();
	    $totalCount=$this->datosCliente->contarCliente();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $clientes=$this->datosCliente->listarAll($page,$campo,$orden);
		require(URL_VISTA_BACK."listadoClientes.php");
	}

	public function pedidosPorCliente($id,$page=1,$campo,$orden='asc'){
		$idCliente=base64_decode($id);
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
		$cliente=$this->datosCliente->buscarId($idCliente);		
	    $totalCount=$this->datosPedido->contarPorCliente($cliente);
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION_FRONT;
	    	$countPages = ceil($countPages);
		}	
		$listaLineasPedido=array();
		$pedidos=$this->datosPedido->listarPorCliente($cliente,$page);
		foreach ($pedidos as $key => $valuePedidos) {
			$listaLineasPedido=$this->datosLineaPedido->listarPorPedido($valuePedidos->getId());
			foreach ($listaLineasPedido as $key => $valueListaPedido) {
				$valueListaPedido->setCerveza($this->datosTipoCerveza->buscarId($valueListaPedido->getCerveza()));
				$valueListaPedido->setEnvase($this->datosEnvase->buscarId($valueListaPedido->getEnvase()));
				$valuePedidos->addLinea($valueListaPedido);
			}
		}

		require(URL_VISTA_BACK."pedidosPorCliente.php");	
	}

	public function listadoPorSucursal($page=1,$campo='nombre',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$sucursales= array();
	    $totalCount=$this->datosSucursal->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $sucursales=$this->datosSucursal->listAll($page,$campo,$orden);
		require(URL_VISTA_BACK."listadoSucursales.php");
	}

	public function pedidosPorSucursal($id,$page=1,$campo,$orden='asc'){
		$idSucursal=base64_decode($id);
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
		$sucursal=$this->datosSucursal->buscarId($idSucursal);		
	    $totalCount=$this->datosPedido->contarPorSucursal($sucursal);
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION_FRONT;
	    	$countPages = ceil($countPages);
		}	
		$listaLineasPedido=array();
		$pedidos=$this->datosPedido->listarPorSucursal($sucursal,$page);
		foreach ($pedidos as $key => $valuePedidos) {
			$listaLineasPedido=$this->datosLineaPedido->listarPorPedido($valuePedidos->getId());
			$valuePedidos->setSucursal($sucursal);
			$cliente=$this->datosCliente->buscarId($valuePedidos->getCliente());
			$valuePedidos->setCliente($cliente);				
			foreach ($listaLineasPedido as $key => $valueListaPedido) {
				$valueListaPedido->setCerveza($this->datosTipoCerveza->buscarId($valueListaPedido->getCerveza()));
				$valueListaPedido->setEnvase($this->datosEnvase->buscarId($valueListaPedido->getEnvase()));
				$valuePedidos->addLinea($valueListaPedido);
			}
		}

		require(URL_VISTA_BACK."pedidosPorSucursal.php");	
	}

	public function listadoPorFecha(){
		require(URL_VISTA_BACK."ingFecha.php");
	}

	public function pedidosPorFecha($fecha,$page=1,$campo='fecha',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
	    $totalCount=$this->datosPedido->contarPorFecha($fecha);
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION_FRONT;
	    	$countPages = ceil($countPages);
		}	
		$listaLineasPedido=array();
		$pedidos=$this->datosPedido->listadoPorFecha($fecha,$page);
		foreach ($pedidos as $key => $valuePedidos) {
			$listaLineasPedido=$this->datosLineaPedido->listarPorPedido($valuePedidos->getId());
			$sucursal=$this->datosSucursal->buscarId($valuePedidos->getSucursal());
			$valuePedidos->setSucursal($sucursal);
			$cliente=$this->datosCliente->buscarId($valuePedidos->getCliente());
			$valuePedidos->setCliente($cliente);			
			foreach ($listaLineasPedido as $key => $valueListaPedido) {
				$valueListaPedido->setCerveza($this->datosTipoCerveza->buscarId($valueListaPedido->getCerveza()));
				$valueListaPedido->setEnvase($this->datosEnvase->buscarId($valueListaPedido->getEnvase()));
				$valuePedidos->addLinea($valueListaPedido);
			}
		}

		require(URL_VISTA_BACK."pedidosPorFecha.php");	
	}

	/**
	*
	* Author: CodexWorld
	* Function Name: getDistance()
	* $addressFrom => From address.
	* $addressTo => To address.
	* $unit => Unit type.
	*
	**/
	function getDistance($addressFrom, $addressTo, $unit){
	    //Change address format
	    $key='AIzaSyAhR7ve8wyFLlIlYqdrqGckZWcQHhNPV7Q';
	    $key1='AIzaSyCTuazTT4ftRrTOscHQYPabgJPLiBS9YXc';
	    $formattedAddrFrom = str_replace(' ','+',$addressFrom);
	    $formattedAddrTo = str_replace(' ','+',$addressTo);
	    
	    //Send request and receive json data
	    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$key1);
	    $outputFrom = json_decode($geocodeFrom);
	    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$key1);
	    $outputTo = json_decode($geocodeTo);
	    
	    //Get latitude and longitude from geo data
	    $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
	    $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
	    $latitudeTo = $outputTo->results[0]->geometry->location->lat;
	    $longitudeTo = $outputTo->results[0]->geometry->location->lng;
	    
	    //Calculate distance from latitude and longitude
	    $theta = $longitudeFrom - ($longitudeTo);
	    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    $unit = strtoupper($unit);
	    if ($unit == "K") {
	        return ($miles * 1.609344);
	    } else if ($unit == "N") {
	        return ($miles * 0.8684);
	    } else {
	        return $miles;
	    }
	}	
}
?>

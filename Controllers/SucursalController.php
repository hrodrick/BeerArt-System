<?php
namespace Controllers;

use Daos\Lista\ListaSucursalDAO as ListaSucursalDAO;
use Daos\DB\DBSucursalDAO as DBSucursalDAO;
use Models\Sucursal as Sucursal;

class SucursalController{

	private $datosSucursal;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosSucursal = ListaSucursalDAO::getInstance();
		$this->datosSucursal = DBSucursalDAO::getInstance();
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function sucadd(){
		$nombre='';
		$domicilio='';
		$localidad='';
		$telefono=''; 		
		require(URL_VISTA_BACK."sucadd.php");
	}

	public function nuevo($nombre,$domicilio,$localidad,$telefono){
		$obj=$this->datosSucursal->buscarNombre($nombre);	
		$msg;
		$c=new Sucursal($nombre,$domicilio,$localidad,$telefono);
		print_r($obj);
		if(!is_object($obj)){		
			$this->datosSucursal->insertar($c);
			$nombre='';
			$domicilio='';
			$localidad='';
			$telefono='';
	 		$msg="<<< La carga fue exitosa >>>"; 			
		}
		require(URL_VISTA_BACK."sucadd.php");
	}

	public function borrar($id,$page,$campo,$orden){
		$this->datosSucursal->eliminar(base64_decode($id));
		header("Location: ".DIR."Sucursal/listado/".$page."/".$campo."/".$orden);
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosSucursal->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Sucursal/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosSucursal->ordenarListado($campo,$orden);
		header("Location: ".DIR."Sucursal/listado/".$page."/".$campo."/".$orden);		
	}

	public function edit($id,$page,$campo,$orden){
		$obj=$this->datosSucursal->buscarId(base64_decode($id));
		require(URL_VISTA_BACK."sucedit.php");
	}

	public function editado($nombre,$domicilio,$localidad,$telefono,$page,$campo,$orden,$id,$standBy){
		$c=new Sucursal($nombre,$domicilio,$localidad,$telefono,$standBy);
		$c->setId($id);
		$this->datosSucursal->modificar($c);
		header("Location: ".DIR."Sucursal/listado/".$page."/".$campo."/".$orden);
	}

	public function listado($page=1,$campo='id',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$sucursales = array();
	    $totalCount=$this->datosSucursal->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $sucursales=$this->datosSucursal->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."suclist.php");
	}

	
	public function nuevos(){

		$suc=array(
				array('nombre'=>'Del Centro',
				      'domicilio'=>'San Martin 2521',
				      'telefono'=>'22352561235',
				      'localidad'=>'Mar del Plata'
				      ),
				array('nombre'=>'Del Puerto',
				      'domicilio'=>'12 de Octubre 3021',
				      'telefono'=>'22352561235',
				      'localidad'=>'Mar del Plata'
				      ),
				array('nombre'=>'Que Gauchito',
				      'domicilio'=>'Gaucho 2521',
				      'telefono'=>'22352561235',
				      'localidad'=>'Mar del Plata'
				      )
		);

		$lista=array();
		$id=0;
		foreach ($suc as $value) {
			$nombre=$value['nombre'];
			$domicilio=$value['domicilio'];
			$localidad=$value['localidad'];
			$telefono=$value['telefono'];
			$c=new Sucursal($nombre,$domicilio,$localidad,$telefono);
			$this->datosSucursal->insertar($c);
		}
		$this->sucadd();
	}	
}
?>
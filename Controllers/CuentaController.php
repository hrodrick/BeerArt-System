<?php
namespace Contcuentalers;

use Daos\Lista\ListaCuentaDAO as ListaCuentaDAO;
use Daos\DB\DBCuentaDAO as DBCuentaDAO;
use Models\Cuenta as Cuenta;

class CuentaContcuentaler{

	private $datosCuenta;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosCuenta = ListaCuentaDAO::getInstance();
		$this->datosCuenta = DBCuentaDAO::getInstance();
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function cuentaadd(){
		require(URL_VISTA_BACK."cuentaadd.php");
	}

	public function nuevo($cuenta,$descripcion){
		$c=new Cuenta($cuenta,$descripcion);
		$this->datosCuenta->insertar($c);
		$this->cuentaadd();
	}

	public function borrar($id,$page,$campo,$orden){
		$this->datosCuenta->eliminar(base64_decode($id));
		header("Location: ".DIR."Cuenta/listado/".$page."/".$campo."/".$orden);
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosCuenta->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Cuenta/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosCuenta->ordenarListado($campo,$orden);
		header("Location: ".DIR."Cuenta/listado/".$page."/".$campo."/".$orden);		
	}

	public function edit($id,$page,$campo,$orden){
		$obj=$this->datosCuenta->buscarId(base64_decode($id));
		require(URL_VISTA_BACK."cuentaedit.php");
	}

	public function editado($cuenta,$descripcion,$permisos,$page,$campo,$orden,$id,$standBy){
		$c=new Cuenta($cuenta,$descripcion,$permisos,$standBy);
		$c->setId($id);
		$this->datosCuenta->modificar($c);
		header("Location: ".DIR."Cuenta/listado/".$page."/".$campo."/".$orden);
	}

	public function listado($page=1,$campo='id',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$cuentaes = array();
	    $totalCount=$this->datosCuenta->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $cuentaes=$this->datosCuenta->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."cuentalist.php");
	}
	
	public function nuevos(){
		$cuenta=array(
				array('cuenta'=>'Administrador',
				      'descripcion'=>'Acceso total',
				      'permisos',1
				      ),
				array('cuenta'=>'Personal',
				      'descripcion'=>'Acceso restringido',
				      'permisos',2
				      )
		);

		$lista=array();
		$id=0;
		foreach ($cuenta as $value) {
			$cuenta=$value['cuenta'];
			$descripcion=$value['descripcion'];
			$c=new Cuenta($cuenta,$descripcion,$permisos);
			$this->datosCuenta->insertar($c);
		}
		$this->cuentaadd();
	}	
}
?>
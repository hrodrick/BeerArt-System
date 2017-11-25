<?php
namespace Controllers;

use Daos\Lista\ListaRolDAO as ListaRolDAO;
use Daos\DB\DBRolDAO as DBRolDAO;
use Models\Rol as Rol;

class RolController{

	private $datosRol;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosRol = ListaRolDAO::getInstance();
		$this->datosRol = DBRolDAO::getInstance();
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function roladd(){
 		$rol='';
 		$descripcion='';
 		$permisos=1;
		require(URL_VISTA_BACK."roladd.php");
	}

	public function nuevo($rol,$descripcion,$permisos){
		$obj=$this->datosRol->buscarRol($rol);
		$c=new Rol($rol,$descripcion,$permisos);
		if(!is_object($obj)){
			$this->datosRol->insertar($c);
 			$rol='';
 			$descripcion='';
 			$permisos=1;			
 		}
		require(URL_VISTA_BACK."roladd.php");
	}

	public function borrar($id,$page,$campo,$orden){
		$this->datosRol->eliminar(base64_decode($id));
		header("Location: ".DIR."Rol/listado/".$page."/".$campo."/".$orden);
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosRol->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Rol/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosRol->ordenarListado($campo,$orden);
		header("Location: ".DIR."Rol/listado/".$page."/".$campo."/".$orden);		
	}

	public function edit($id,$page,$campo,$orden){
		$obj=$this->datosRol->buscarId(base64_decode($id));
		require(URL_VISTA_BACK."roledit.php");
	}

	public function editado($rol,$descripcion,$permisos,$page,$campo,$orden,$id,$standBy){
		$c=new Rol($rol,$descripcion,$permisos,$standBy);
		$c->setId($id);
		$this->datosRol->modificar($c);
		header("Location: ".DIR."Rol/listado/".$page."/".$campo."/".$orden);
	}

	public function listado($page=1,$campo='id',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$roles = array();
	    $totalCount=$this->datosRol->contar();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $roles=$this->datosRol->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."rollist.php");
	}
	
	public function nuevos(){
		$rol=array(
				array('rol'=>'Administrador',
				      'descripcion'=>'Acceso total',
				      'permisos',1
				      ),
				array('rol'=>'Personal',
				      'descripcion'=>'Acceso restringido',
				      'permisos',2
				      )
		);

		$lista=array();
		$id=0;
		foreach ($rol as $value) {
			$rol=$value['rol'];
			$descripcion=$value['descripcion'];
			$c=new Rol($rol,$descripcion,$permisos);
			$this->datosRol->insertar($c);
		}
		$this->roladd();
	}	
}
?>
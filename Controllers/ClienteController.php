<?php
namespace Controllers;

use Daos\Lista\ListaUsuarioDAO as ListaUsuarioDAO;
use Daos\DB\DBClienteDAO as DBClienteDAO;
use Models\Usuario as Usuario;

class ClienteController{

	private $datosUsuario;

	function __construct(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		//$this->datosUsuario = ListaUsuarioDAO::getInstance();
		$this->datosUsuario = DBClienteDAO::getInstance();
	}

 	public function index(){
		require(URL_VISTA_BACK."home.php");
	}

 	public function cliadd(){
 		$idRol=0;
 		$nombre='';
 		$apellido='';
 		$domicilio='';
 		$localidad='';
 		$telefono='';
 		$dni='';
 		$email=''; 		
		require(URL_VISTA_BACK."cliadd.php");
	}

	public function nuevo($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol){
		$obj=$this->datosUsuario->buscarEmail($email);		
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password);
		if(!is_object($obj)){
			$this->datosUsuario->insertar($c);
	 		$idRol=0;
	 		$nombre='';
	 		$apellido='';
	 		$domicilio='';
	 		$localidad='';
	 		$telefono='';
	 		$dni='';
	 		$email=''; 	
		}
		require(URL_VISTA_BACK."cliadd.php");
	}

	public function borrar($id,$page,$campo,$orden){
		$this->datosUsuario->eliminar(base64_decode($id));
		header("Location: ".DIR."Cliente/listado/".$page."/".$campo."/".$orden);
	}

	public function standBy($id,$page,$campo,$orden){
		$this->datosUsuario->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Cliente/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		$this->datosUsuario->ordenarListado($campo,$orden);
		header("Location: ".DIR."Cliente/listado/".$page."/".$campo."/".$orden);		
	}

	public function edit($id,$page,$campo,$orden){
		$obj=$this->datosUsuario->buscarId(base64_decode($id));	
		require(URL_VISTA_BACK."cliedit.php");
	}

	public function editado($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol,$page,$campo,$orden,$id,$standBy,$contra){
		$password=(empty($password))?$contra:md5($password);
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$standBy);
		$c->setId($id);
		$this->datosUsuario->modificar($c);
		header("Location: ".DIR."Cliente/listado/".$page."/".$campo."/".$orden);
	}

	public function listado($page=1,$campo='id',$orden='asc'){
	    $countPages = 0;
	    $totalCount = 0;
		$sucursales = array();
	    $totalCount=$this->datosUsuario->contarCliente();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $sucursales=$this->datosUsuario->listar($page,$campo,$orden);

		require(URL_VISTA_BACK."clilist.php");
	}
}
?>
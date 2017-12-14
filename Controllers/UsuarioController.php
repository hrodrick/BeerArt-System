<?php
namespace Controllers;

use Daos\Lista\ListaUsuarioDAO as ListaUsuarioDAO;
use Daos\DB\DBUsuarioDAO as DBUsuarioDAO;
use Daos\DB\DBRolDAO as DBRolDAO;
use Models\Usuario as Usuario;

class UsuarioController{

	private $datosUsuario;
	private $datosRol;

	function __construct(){	
		//$this->datosUsuario = ListaUsuarioDAO::getInstance();
		$this->datosUsuario = DBUsuarioDAO::getInstance();
		$this->datosRol = DBRolDAO::getInstance();
	}

 	public function index(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}	 		
		require(URL_VISTA_BACK."home.php");
	}

 	public function useradd(){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}		 		
 		$idRol=1;
 		$nombre='';
 		$apellido='';
 		$domicilio='';
 		$localidad='';
 		$telefono='';
 		$dni='';
 		$email=''; 	 		
 		$roles=$this->datosRol->listAll();
		require(URL_VISTA_BACK."useradd.php");
	}

 	public function userin(){
		require(URL_VISTA_BACK."userin.php");
	}

 	public function chq($user,$pass){
 		$obj=$this->datosUsuario->buscarEmail($user);
 		$rol=$this->datosRol->buscarId($obj->getIdRol());
 		$obj->setIdRol($rol);
 		if(is_object($obj)&&$obj->getPassword()==md5($pass)){
			$_SESSION['usuario']=$obj;
			header("Location: ".DIR."Usuario/index");
 		}else{
			if(!is_object($obj)){
				$error='Usuario';
			}else{
				if($obj->getPassword()!=md5($pass)){
					$error='Password';
				}
			}
		 	require(URL_VISTA_BACK."userin.php");	
		}		 		
	}

	public function logOut(){
		$_SESSION['usuario'];
		session_destroy();
		$this->userin();
	}

	public function nuevo($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		$obj=$this->datosUsuario->buscarEmail($email);			
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password);
		$msg;
		if(!is_object($obj)){
			$this->datosUsuario->insertar($c);
	 		$idRol=1;
	 		$nombre='';
	 		$apellido='';
	 		$domicilio='';
	 		$localidad='';
	 		$telefono='';
	 		$dni='';
	 		$email=''; 	
	 		$msg="<<< La carga fue exitosa >>>"; 	 		
		}		
 		$roles=$this->datosRol->listAll();
		require(URL_VISTA_BACK."useradd.php");	}

	public function borrar($id,$page,$campo,$orden){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		$this->datosUsuario->eliminar(base64_decode($id));
		header("Location: ".DIR."Usuario/listado/".$page."/".$campo."/".$orden);
	}

	public function standBy($id,$page,$campo,$orden){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		$this->datosUsuario->modificarStandBy(base64_decode($id));
		header("Location: ".DIR."Usuario/listado/".$page."/".$campo."/".$orden);		
	}

	public function reorder($page,$campo,$orden){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}			
		$this->datosUsuario->ordenarListado($campo,$orden);
		header("Location: ".DIR."Usuario/listado/".$page."/".$campo."/".$orden);		
	}

	public function edit($id,$page=1,$campo='id',$orden='asc'){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}				
		$error=0;
		$obj=$this->datosUsuario->buscarId(base64_decode($id));
 		$roles=$this->datosRol->listAll();	
		require(URL_VISTA_BACK."useredit.php");
	}

	public function editado($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol,$page,$campo,$orden,$id,$standBy,$contra,$emailOld){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}				
		$error=0;
		$password=(empty($password))?$contra:md5($password);
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$standBy);
		$c->setId($id);
		$obj=$this->datosUsuario->buscarEmail($email);
		if(($email!=$emailOld)&&(is_object($obj))){
			$error=1;
			$roles=$this->datosRol->listAll();	
			require(URL_VISTA_BACK."useredit.php");
		}
		if(!$error){
			$this->datosUsuario->modificar($c);
			header("Location: ".DIR."Usuario/listado/".$page."/".$campo."/".$orden);
		}
	}

	public function listado($page=1,$campo='id',$orden='asc'){
		if(!isset($_SESSION['usuario'])){
			header("Location: ".DIR."Usuario/userin");
		}
	    $countPages = 0;
	    $totalCount = 0;
		$usuarios = array();
	    $totalCount=$this->datosUsuario->contarUsuario();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION;
	    	$countPages = ceil($countPages);
		}	    
	    $usuarios=$this->datosUsuario->listar($page,$campo,$orden);

	    foreach ($usuarios as $key => $usuario) {
	    	$rol=$this->datosRol->buscarId($usuario->getIdRol());
	    	$usuario->setIdRol($rol);
	    }

		require(URL_VISTA_BACK."userlist.php");
	}
}
?>
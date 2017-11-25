<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBClienteDAO as DBClienteDAO;
use Models\Cerveza as Cerveza;
use Models\Usuario as Usuario;
use Utils\Thumb as Thumb;

class FrontController{

	private $datosTipoCerveza;
	private $datosCliente;

	function __construct(){
		$this->datosTipoCerveza = DBCervezaDAO::getInstance();
		$this->datosCliente = DBClienteDAO::getInstance();
	}

 	public function inicio(){
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
	    $totalCount=$this->datosTipoCerveza->contarActivos();
	    if($totalCount>0){
	    	$countPages = $totalCount / 2;
	    	$countPages = ceil($countPages);
		}	    
		$cervezas = $this->datosTipoCerveza->listarSinStandByLimit();
		shuffle($cervezas); 		
		require(URL_VISTA_FRONT."inicio.php");
	}

 	public function userin(){
		require(URL_VISTA_FRONT."userin.php");
	}

 	public function chq($user,$pass){
 		$obj=$this->datosCliente->buscarEmail($user);
 		if(is_object($obj)&&$obj->getPassword()==md5($pass)){
			$_SESSION['cliente']=$obj;
			header("Location: ".DIR."Front/inicio");
 		}else{
			if(!is_object($obj)){
				$error='Cliente';
			}else{
				if($obj->getPassword()!=md5($pass)){
					$error='Password';
				}
			}
		 	require(URL_VISTA_FRONT."userin.php");	
		}		 		
	}

	public function logOut(){
		session_destroy();
		header("Location: ".DIR);
	}

	public function exitoso(){
		require(URL_VISTA_FRONT."exitoso.php");	}

 	public function contacto(){	
		require(URL_VISTA_FRONT."contacto.php");
	}

 	public function productos(){
		require(URL_VISTA_FRONT."productos.php");
	}

	public function producto($id){
		$cerveza = $this->datosTipoCerveza->productoConEnv(base64_decode($id));

		require(URL_VISTA_FRONT."producto.php");
	}

 	public function registro(){
 		$idRol=0;
 		$nombre='';
 		$apellido='';
 		$domicilio='';
 		$localidad='';
 		$telefono='';
 		$dni='';
 		$email=''; 		
		require(URL_VISTA_FRONT."registro.php");
	}

	public function nuevo($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol){
		$obj=$this->datosCliente->buscarEmail($email);		
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password);
		if(!is_object($obj)){
			$this->datosCliente->insertar($c);
			require(URL_VISTA_FRONT."exitoso.php");
		}else{
			require(URL_VISTA_FRONT."registro.php");
		}
	}

	public function edit($id){
		$obj=$this->datosCliente->buscarId(base64_decode($id));	
		require(URL_VISTA_FRONT."useredit.php");
	}

	public function editado($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$idRol,$id,$standBy,$contra,$emailOld){
		$error=0;
		$password=(empty($password))?$contra:md5($password);
		$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,$standBy);
		$c->setId($id);
		$obj=$this->datosCliente->buscarEmail($email);
		if(($email!=$emailOld)&&(is_object($obj))){
			$error=1;
			require(URL_VISTA_BACK."useredit.php");
		}
		if(!$error){
			$this->datosCliente->modificar($c);
			$_SESSION['cliente']=$c;
			header("Location: ".DIR."Front/inicio");
		}
	}

	public function listBeer($page=1){
	    $countPages = 0;
	    $totalCount = 0;
		$cervezas = array();
	    $totalCount=$this->datosTipoCerveza->contarActivos();
	    if($totalCount>0){
	    	$countPages = $totalCount / PAGINATION_FRONT;
	    	$countPages = ceil($countPages);
		}	    
		//$cervezas = $this->datosTipoCerveza->listarSinStandBy($page);
		//$cervezas = $this->datosTipoCerveza->listarConEnv1($page);
		$cervezas = $this->datosTipoCerveza->listarConEnv2($page);

		require(URL_VISTA_FRONT."productos.php");
	}
}
?>
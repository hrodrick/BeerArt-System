<?php
namespace Controllers;

use Daos\Lista\ListaCervezaDAO as ListaCervezaDAO;
use Daos\DB\DBCervezaDAO as DBCervezaDAO;
use Daos\DB\DBClienteDAO as DBClienteDAO;
use Models\Cerveza as Cerveza;
use Models\Usuario as Usuario;
use Utils\Thumb as Thumb;
use Utils\PHPMailer\PHPMailer as PHPMailer;

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
 		$obj=$this->datosCliente->buscarEmailHabilitado($user);
 		if(is_object($obj)&&$obj->getPassword()==md5($pass)){
			$_SESSION['usuario']=$obj;
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

	public function facebookChq($usuario){
		if(isset($usuario)){
	        $objeto = json_decode($usuario);
	        $id=0;
	        $nombre= $objeto->name;
	        $apellido = $objeto->surname;
	        $email= $objeto->email;
	        $password= $objeto->password;
	        $password= "";
	        
	        $user = new Usuario(0,$nombre,$apellido,"","","", "" ,$email,$password);
			
	        $cuentaExistente = $this->datosCliente->buscarEmail($email);
	        
	        if(is_object($cuentaExistente)){
	            $_SESSION['usuario'] = $cuentaExistente;
	        }else{
	        	$id=$this->datosCliente->insertar($user);
	        	$user->setId($id);
	        	$_SESSION['usuario'] = $user;
	        }
	        header("Location: ".DIR."Front/inicio");
      	}
	}

	public function logOut(){
		session_destroy();
		header("Location: ".DIR);
	}

	public function exitoso(){
		require(URL_VISTA_FRONT."exitoso.php");	}

 	public function contacto(){
 		$nombre = '';
 		$email = '';
		if(isset($_SESSION['usuario'])){
			$nombre=$_SESSION['usuario']->getNombre().' '.$_SESSION['usuario']->getApellido();
			$email=$_SESSION['usuario']->getEmail();
		}
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
		$id=0;

		if(!is_object($obj)){
			$c=new Usuario($idRol,$nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password,1);
			$id=$this->datosCliente->insertar($c);
			$c->setId($id);
			$this->sendEmailNewUser($c);
			require(URL_VISTA_FRONT."exitoso.php");
		}else{
			require(URL_VISTA_FRONT."registro.php");
		}
	}

	public function sendEmailNewUser($obj){
		$msg = '<strong>Gracias por registrarse en Choppenhauer Beer</strong><BR>';
		$alink = '<a href="http://www.techmdq.com.ar/beer/Front/habilitar/'.base64_encode($obj->getId()).'">Habilitar cuenta</a>';
		$link = 'Si no puede acceder al link copie y pegue en el explorador la siguiente url:<BR>
				http://www.techmdq.com.ar/beer/Front/habilitar/'.base64_encode($obj->getId());
		$mail = new PHPMailer(true);

		try{
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = HOST;
			$mail->Username = FROM;
			$mail->Password = PASS;
			$mail->Port = PORT;

			$mail->setFrom(FROM,FROMNAME);
			$mail->AddAddress($obj->getEmail(),$obj->getApellido().', '.$obj->getNombre());
			$mail->addBCC('info.choppenhauer@techmdq.com.ar','Choppenhauer Beer');
			$mail->IsHTML(true);
			$mail->Subject = FROMNAME.' Nuevo usuario';	
			$mail->AddAttachment(URL_IMG.'header-email.jpg');
			$body=file_get_contents(URL_VISTA_FRONT.'emailRegistro.php');
			$body=str_replace('%msg%',$msg,$body);
			$body=str_replace('%alink%',$alink,$body);
			$body=str_replace('%link%',$link,$body);
			$mail->Body = $body;
			$exito = $mail->send();
		}catch (Exception $e){
			echo $mail->ErrorInfo;
			exit();
		}
	}

	public function sendContacto($nombre,$email,$consulta){
		$msg = '<strong>Gracias por Contactarse con Choppenhauer Beer</strong><BR>';
		$alink = $nombre.'<BR>';
		$link = $consulta;
		$mail = new PHPMailer(true);

		try{
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = HOST;
			$mail->Username = FROM;
			$mail->Password = PASS;
			$mail->Port = PORT;

			$mail->setFrom(FROM,FROMNAME);
			$mail->AddAddress($email,$nombre);
			$mail->addBCC('info.choppenhauer@techmdq.com.ar','Choppenhauer Beer');
			$mail->IsHTML(true);
			$mail->Subject = FROMNAME.' Contacto';	
			$mail->AddAttachment(URL_IMG.'header-email.jpg');
			$body=file_get_contents(URL_VISTA_FRONT.'emailRegistro.php');
			$body=str_replace('%msg%',$msg,$body);
			$body=str_replace('%alink%',$alink,$body);
			$body=str_replace('%link%',$link,$body);
			$mail->Body = $body;
			$exito = $mail->send();
		}catch (Exception $e){
			echo $mail->ErrorInfo;
			exit();
		}
		$msg = 'Gracias por contactarnos';
		require(URL_VISTA_FRONT."ok.php");		
	}

	public function habilitar($id){
		$this->datosCliente->habilitar(base64_decode($id));
		$msg = 'Su cuenta ha sido habilitada';
		require(URL_VISTA_FRONT."ok.php");	
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
			$_SESSION['usuario']=$c;
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
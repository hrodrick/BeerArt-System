<?php 
namespace Models;

abstract class Persona {

	private $id;
	private $nombre;
	private $apellido;
	private $domicilio;
	private $localidad;
	private $telefono;
	private $dni;
	private $email;
	private $password;

	function __construct($nombre,$apellido,$domicilio,$localidad,$telefono,$dni,$email,$password=''){
		$this->id=0;
		$this->nombre=$nombre;
		$this->apellido=$apellido;
		$this->domicilio=$domicilio;
		$this->localidad=$localidad;
		$this->telefono=$telefono;
		$this->dni=$dni;
		$this->email=$email;
		$this->password=$password;
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id=$id;
	}

	function getNombre(){
		return $this->nombre;
	}

	function setNombre($nombre){
		$this->nombre=$nombre;
	}

	function getApellido(){
		return $this->apellido;
	}

	function setApellido($apellido){
		$this->apellido=$apellido;
	}

	function getDomicilio(){
		return $this->domicilio;
	}

	function setDomicilio($domicilio){
		$this->domicilio=$domicilio;
	}

	function getLocalidad(){
		return $this->localidad;
	}

	function setLocalidad($localidad){
		$this->Localidad=$localidad;
	}

	function getTelefono(){
		return $this->telefono;
	}

	function setTelefono($telefono){
		$this->telefono=$telefono;
	}

	function getDni(){
		return $this->dni;
	}

	function setDni($dni){
		$this->dni=$dni;
	}

	function getEmail(){
		return $this->email;
	}

	function setEmail($email){
		$this->email=$email;
	}

	function getPassword(){
		return $this->password;
	}

	function setPassword($password){
		$this->password=$password;
	}	
}
?>

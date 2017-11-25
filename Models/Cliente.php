<?php 
namespace Models;

class Cliente extends Persona{

	function __construct($nombre,$apellido,$domicilio,$localidad,$telefono,$dni){
		parent::__construct($nombre,$apellido,$domicilio,$localidad,$telefono,$dni);
	}
}
?>
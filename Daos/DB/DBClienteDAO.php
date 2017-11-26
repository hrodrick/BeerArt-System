<?php 
namespace Daos\DB;

use Models\Usuario as Usuario;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;
use \PDOException as PDOException;

class DBClienteDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'usuarios';

	function __construct(){

	}

	function insertar($obj){
	
		$query = 'INSERT INTO '.$this->table.' (idRol, nombre, apellido, domicilio, localidad, telefono, dni, email, password, standBy) VALUES (:idRol, :nombre, :apellido, :domicilio, :localidad, :telefono, :dni, :email, :password, :standBy)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :idRol, :nombre, :apellido, :domicilio, :localidad, :telefono, :dni, :email, :password, :standBy)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$idRol = $obj->getIdRol();
		$nombre = $obj->getNombre();
		$apellido = $obj->getApellido();
		$domicilio = $obj->getDomicilio();
		$localidad = $obj->getLocalidad();
		$telefono = $obj->getTelefono();
		$dni = $obj->getDni();
		$email = $obj->getEmail();
		$password = md5($obj->getPassword());
		$standBy = $obj->getStandBy();	

		$command->bindParam(':idRol', $idRol);
		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':localidad', $localidad);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':dni', $dni);
		$command->bindParam(':email', $email);
		$command->bindParam(':password', $password);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();	
	}

	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET idRol = :idRol, nombre = :nombre, apellido = :apellido, domicilio = :domicilio, localidad = :localidad, telefono = :telefono, dni = :dni, email = :email, password = :password, standBy = :standBy WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$idRol = $obj->getIdRol();
		$nombre = $obj->getNombre();
		$apellido = $obj->getApellido();
		$domicilio = $obj->getDomicilio();
		$localidad = $obj->getLocalidad();
		$telefono = $obj->getTelefono();
		$dni = $obj->getDni();
		$email = $obj->getEmail();
		$password = md5($obj->getPassword());
		$standBy = $obj->getStandBy();	

		$command->bindParam(':id', $id);
		$command->bindParam(':idRol', $idRol);
		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':localidad', $localidad);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':dni', $dni);
		$command->bindParam(':email', $email);
		$command->bindParam(':password', $password);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();
	}

	function listar($page,$campo,$orden){
		$usuarios = array();		
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE idRol = 0 ORDER BY '.$campo.' '.$orden.' LIMIT '.$page1.', '.PAGINATION;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contarCliente();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION;
		  	$countPages = ceil($countPages);
		}

		foreach($result as $row)
		{
			$c = new Usuario($row['idRol'],$row['nombre'],$row['apellido'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['dni'],$row['email'],$row['password'],$row['standBy']);
			$c->setId($row['id']);

			$usuarios[] = $c;
		}
		return $usuarios;
	}

	function listarAll($page,$campo,$orden){
		$usuarios = array();		
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$query = 'SELECT * FROM '.$this->table.' ORDER BY '.$campo.' '.$orden.' LIMIT '.$page1.', '.PAGINATION;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contarClientes();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION;
		  	$countPages = ceil($countPages);
		}

		foreach($result as $row)
		{
			$c = new Usuario($row['idRol'],$row['nombre'],$row['apellido'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['dni'],$row['email'],$row['password'],$row['standBy']);
			$c->setId($row['id']);

			$usuarios[] = $c;
		}
		return $usuarios;
	}

	function contarCliente(){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE idRol = 0';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}	

	function contarClientes(){
		$query = 'SELECT COUNT(*) FROM '.$this->table;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

	function buscarId($id){
		$obj='';
		$query = 'SELECT * FROM '.$this->table.' WHERE id='.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Usuario($row['idRol'],$row['nombre'],$row['apellido'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['dni'],$row['email'],$row['password'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}		

	function buscarEmail($email){
		$obj='';
		$query = 'SELECT * FROM '.$this->table.' WHERE email='.'"'.$email.'"';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Usuario($row['idRol'],$row['nombre'],$row['apellido'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['dni'],$row['email'],$row['password'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}		
}
?>
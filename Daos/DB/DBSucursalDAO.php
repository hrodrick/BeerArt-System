<?php 
namespace Daos\DB;

use Models\Sucursal as Sucursal;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBSucursalDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'sucursales';

	function __construct(){

	}

	function insertar($obj){
	
		$query = 'INSERT INTO '.$this->table.' (nombre, domicilio, localidad, telefono, standBy) VALUES (:nombre, :domicilio, :localidad, :telefono, :standBy)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :nombre, :domicilio, :localidad, :telefono, :standBy)';


		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$nombre = $obj->getNombre();
		$domicilio = $obj->getDomicilio();
		$localidad = $obj->getLocalidad();
		$telefono = $obj->getTelefono();
		$standBy = $obj->getStandBy();	

		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':localidad', $localidad);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();	
	}

	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET nombre = :nombre, domicilio = :domicilio, localidad = :localidad, telefono = :telefono, standBy = :standBy WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$nombre = $obj->getNombre();
		$domicilio = $obj->getDomicilio();
		$localidad = $obj->getLocalidad();
		$telefono = $obj->getTelefono();
		$standBy = $obj->getStandBy();

		$command->bindParam(':id', $id);
		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':localidad', $localidad);
		$command->bindParam(':telefono', $telefono);
		$command->bindParam(':standBy', $standBy);
		$command->execute();
	}

	function listar($page,$campo,$orden){
		$sucursales = array();		
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

		foreach($result as $row)
		{
			$c = new Sucursal($row['nombre'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['standBy']);
			$c->setId($row['id']);

			$sucursales[] = $c;
		}
		return $sucursales;
	}

	function listAll(){
		$sucursales = array();			
		$query = 'SELECT * FROM '.$this->table.' WHERE standBy = 0 ORDER BY nombre asc';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Sucursal($row['nombre'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['standBy']);
			$c->setId($row['id']);

			$sucursales[] = $c;
		}
		return $sucursales;		
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
			$obj = new Sucursal($row['nombre'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	

	function buscarNombre($nombre){
		$obj='';
		$query = 'SELECT * FROM '.$this->table.' WHERE nombre='.'"'.$nombre.'"';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Sucursal($row['nombre'],$row['domicilio'],$row['localidad'],$row['telefono'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}			
}
?>
<?php
namespace Daos\DB;

use Models\Rol as Rol;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBRolDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'roles';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (rol, descripcion, permisos, standBy) VALUES (:rol, :descripcion, :permisos, :standBy)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :rol, :descripcion, :permisos, :standBy)';


		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$rol = $obj->getRol();
		$descripcion = $obj->getDescripcion();
		$permisos = $obj->getPermisos();
		$standBy = $obj->getStandBy();

		$command->bindParam(':rol', $rol);
		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':permisos', $permisos);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();	
	}
		
	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET rol = :rol, descripcion = :descripcion, permisos = :permisos, standBy = :standBy WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$rol = $obj->getRol();
		$descripcion = $obj->getDescripcion();
		$permisos = $obj->getPermisos();		
		$standBy = $obj->getStandBy();

		$command->bindParam(':id', $id);
		$command->bindParam(':rol', $rol);
		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':permisos', $permisos);		
		$command->bindParam(':standBy', $standBy);
		$command->execute();
	}

	function listar($page,$campo,$orden){
		$roles=array();		
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

		$totalCount=$this->contar();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION;
		  	$countPages = ceil($countPages);
		}

		foreach($result as $row)
		{
			$c = new Rol($row['rol'],$row['descripcion'],$row['permisos'],$row['standBy']);
			$c->setId($row['id']);

			$roles[] = $c;
		}
		return $roles;
	}

	function listAll(){
		$query = 'SELECT * FROM '.$this->table.' ORDER BY rol asc';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Rol($row['rol'],$row['descripcion'],$row['permisos'],$row['standBy']);
			$c->setId($row['id']);

			$roles[] = $c;
		}
		return $roles;		
	}

	function buscarId($id){

		$query = 'SELECT * FROM '.$this->table.' WHERE id='.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Rol($row['rol'],$row['descripcion'],$row['permisos'],$row['standBy']);	
			$obj->setId($row['id']);

		}
		return $obj;
	}		

	function buscarRol($rol){

		$query = 'SELECT * FROM '.$this->table.' WHERE rol='.'"'.$rol.'"';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();
		$obj = '';
		foreach($result as $row)
		{
			$obj = new Rol($row['rol'],$row['descripcion'],$row['permisos'],$row['standBy']);	
			$obj->setId($row['id']);

		}
		return $obj;
	}		
}
?>
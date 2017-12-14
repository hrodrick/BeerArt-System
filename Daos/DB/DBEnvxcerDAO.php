<?php
namespace Daos\DB;

use Models\Envxcer as Envxcer;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBEnvxcerDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'envxcer';

	function __construct(){

	}

	function eliminarPorCervezas($id){
		$query = 'DELETE FROM '.$this->table.' WHERE idcer = '.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->execute();			
	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (idcer, idenv, tiene) VALUES (:idcer, :idenv, :tiene)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :idcer, :idenv)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$idcer = $obj->getIdCer();
		$idenv = $obj->getIdEnv();
		$tiene = $obj->getTiene();

		$command->bindParam(':idcer', $idcer);
		$command->bindParam(':idenv', $idenv);
		$command->bindParam(':tiene', $tiene);

		$command->execute();
	}

	function insertarGetId($obj){
		$query = 'INSERT INTO '.$this->table.' (idcer, idenv, tiene) VALUES (:idcer, :idenv, :tiene)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :idcer, :idenv)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$idcer = $obj->getIdCer();
		$idenv = $obj->getIdEnv();
		$tiene = $obj->getTiene();

		$command->bindParam(':idcer', $idcer);
		$command->bindParam(':idenv', $idenv);
		$command->bindParam(':tiene', $tiene);

		$command->execute();

		return $connection->lastInsertId();		
	}

	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET idcer = :idcer, idenv = :idenv, tiene = :tiene WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$idcer = $obj->getIdCer();
		$idenv = $obj->getIdEnv();
		$tiene = $obj->getTiene();

		$command->bindParam(':id', $id);
		$command->bindParam(':idcer', $idcer);
		$command->bindParam(':idenv', $idenv);
		$command->bindParam(':tiene', $tiene);
	
		$command->execute();
	}

	function listar($page,$campo,$orden){
		$cervezas=array();	
		$envxcer=array();
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
			$c = new Envxcer($row['idcer'],$row['idenv'],$row['tiene']);
			$c->setId($row['id']);
			$envxcer[] = $c;
		}
		return $envxcer;
	}

	function listAll(){
		$envxcer=array();
		$query = 'SELECT * FROM '.$this->table.' ORDER BY tipo asc';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Envxcer($row['idcer'],$row['idenv'],$row['tiene']);
			$c->setId($row['id']);
			$envxcer[] = $c;
		}
		return $envxcer;		
	}

	function listarXCerveza($idCerveza){
		$envxcer=array();
		$query = 'SELECT * FROM '.$this->table.' WHERE idcer = '. $idCerveza;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Envxcer($row['idcer'],$row['idenv'],$row['tiene']);
			$c->setId($row['id']);

			$envxcer[] = $c;
		}
		return $envxcer;		
	}

	function buscarId($id){
		$obj;
		$query = 'SELECT * FROM '.$this->table.' WHERE id='.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Envxcer($row['idcer'],$row['idenv'],$row['tiene']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	

	function buscarCerEnv($idCer, $idEnv){
		$obj='';
		$query = 'SELECT * FROM '.$this->table.' WHERE idcer='.$idCer. ' AND idenv='.$idEnv;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Envxcer($row['idcer'],$row['idenv'],$row['tiene']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	

	function contarXCerveza($id){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE idcer = '.$id;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

}
?>
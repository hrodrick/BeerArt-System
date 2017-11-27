<?php
namespace Daos\DB;

use Models\Envase as Envase;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBEnvaseDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'envases';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (tipo, capacidad, coeficiente, foto, standBy) VALUES (:tipo, :capacidad, :coeficiente, :foto, :standBy)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :tipo, :coeficiente, :capacidad, :foto, :standBy)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$tipo = $obj->getTipo();
		$capacidad = $obj->getCapacidad();
		$coeficiente = $obj->getCoeficiente();
		$foto = $obj->getFoto();
		$standBy = $obj->getStandBy();


		$command->bindParam(':tipo', $tipo);
		$command->bindParam(':capacidad', $capacidad);
		$command->bindParam(':coeficiente', $coeficiente);
		$command->bindParam(':foto', $foto);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();
	}

	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET tipo = :tipo, capacidad = :capacidad, coeficiente = :coeficiente, foto = :foto, standBy = :standBy WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$tipo = $obj->getTipo();
		$capacidad = $obj->getCapacidad();
		$coeficiente = $obj->getCoeficiente();
		$foto = $obj->getFoto();
		$standBy = $obj->getStandBy();

		$command->bindParam(':id', $id);
		$command->bindParam(':tipo', $tipo);
		$command->bindParam(':capacidad', $capacidad);
		$command->bindParam(':coeficiente', $coeficiente);
		$command->bindParam(':foto', $foto);
		$command->bindParam(':standBy', $standBy);	
		$command->execute();
	}

	function listar($page,$campo,$orden){
		$cervezas=array();		
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

		$envases = array();

		foreach($result as $row)
		{
			$c = new Envase($row['tipo'],$row['capacidad'],$row['coeficiente'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$envases[] = $c;
		}
		return $envases;
	}

	function listAll(){
		$query = 'SELECT * FROM '.$this->table.' ORDER BY tipo asc';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$envases = array();

		foreach($result as $row)
		{
			$c = new Envase($row['tipo'],$row['capacidad'],$row['coeficiente'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$envases[] = $c;
		}
		return $envases;		
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
			$obj = new Envase($row['tipo'],$row['capacidad'],$row['coeficiente'],$row['foto'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	

	function buscarTipo($tipo){
		$obj='';

		$query = 'SELECT * FROM '.$this->table.' WHERE tipo='.'"'.$tipo.'"';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();
		
		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$obj = new Envase($row['tipo'],$row['capacidad'],$row['coeficiente'],$row['foto'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	
}
?>
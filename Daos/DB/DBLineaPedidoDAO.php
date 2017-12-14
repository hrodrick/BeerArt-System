<?php
namespace Daos\DB;

use Models\Cerveza as Cerveza;
use Models\Envase as Envase;
use Models\LineaPedido as LineaPedido;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBLineaPedidoDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'lineapedido';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (idPedido, idCerveza, idEnvase, precioUnitario, cantidad) VALUES (:idPedido, :idCerveza, :idEnvase, :precioUnitario, :cantidad)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :idPedido, :idCerveza, :idEnvase, :precioUnitario, :cantidad)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$idPedido = $obj->getIdPedido();
		$idCerveza = $obj->getCerveza()->getId();
		$idEnvase = $obj->getEnvase()->getId();
		$precioUnitario = $obj->getPrecioUnitario();
		$cantidad = $obj->getCantidad();

		$command->bindParam(':idPedido', $idPedido);
		$command->bindParam(':idCerveza', $idCerveza);
		$command->bindParam(':idEnvase', $idEnvase);
		$command->bindParam(':precioUnitario', $precioUnitario);
		$command->bindParam(':cantidad', $cantidad);
		$command->execute();	
	}	

	function modificar($obj){

	}

	function listar($page,$campo,$orden){

	}

	function contarPorCerveza($id){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE idCerveza = '.$id;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

	function listarPorPedido($idPedido){
		$query = 'SELECT * FROM '.$this->table.' WHERE idPedido = '. $idPedido;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$p = new LineaPedido($row['idCerveza'],$row['idEnvase'],$row['precioUnitario'],$row['cantidad']);
			$p->setId($row['id']);
			$p->setIdPedido($row['idPedido']);

			$pedidos[] = $p;
		}
		return $pedidos;
	}

	function buscarId($id){

	}	
}
?>
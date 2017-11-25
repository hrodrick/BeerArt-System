<?php
namespace Daos\DB;

use Models\Cerveza as Cerveza;
use Models\Envase as Envase;
use Models\Pedido as Pedido;
use Models\Usuario as Usuario;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBPedidoDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'pedidos';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (cliente, sucursal, fecha, estado) VALUES (:cliente, :sucursal, :fecha, :estado)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :cliente, :sucursal, :fecha, :estado)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$cliente = $obj->getCliente();
		$sucursal = $obj->getSucursal();
		$fecha = $obj->getFecha();
		$estado = $obj->getEstado();

		$command->bindParam(':cliente', $cliente);
		$command->bindParam(':sucursal', $sucursal);
		$command->bindParam(':fecha', $fecha);
		$command->bindParam(':estado', $estado);
		$command->execute();

		return $connection->lastInsertId();			
	}	

	function modificar($obj){

	}

	function listar($page, $campo, $orden){

	}

	function listarPorCliente($obj,$page){
		$pedidos=array();
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION_FRONT;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE cliente = '. $obj->getId() .' ORDER BY fecha desc LIMIT '.$page1.', '.PAGINATION_FRONT;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contarPorCliente($obj);

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION_FRONT;
		  	$countPages = ceil($countPages);
		}		

		foreach($result as $row)
		{
			$p = new Pedido();
			$p->setId($row['id']);
			$p->setCliente($row['cliente']);
			$p->setSucursal($row['sucursal']);
			$p->setFecha($row['fecha']);
			$p->setEstado($row['estado']);

			$pedidos[] = $p;
		}
		return $pedidos;
	}

	function buscarId($id){

	}

	function contarPorCliente($obj){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE cliente = '.$obj->getId();
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

}
?>
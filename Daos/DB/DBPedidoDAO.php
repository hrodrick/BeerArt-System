<?php
namespace Daos\DB;

use Models\Cerveza as Cerveza;
use Models\Envase as Envase;
use Models\Pedido as Pedido;
use Models\LineaPedido as LineaPedido;
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
		$query = 'INSERT INTO '.$this->table.' (cliente, sucursal, fecha, estado, fechaEntrega) VALUES (:cliente, :sucursal, :fecha, :estado, :fechaEntrega)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :cliente, :sucursal, :fecha, :estado)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$cliente = $obj->getCliente();
		$sucursal = $obj->getSucursal();
		$fecha = $obj->getFecha();
		$estado = $obj->getEstado();
		$entrega = $obj->getFechaEntrega();

		$command->bindParam(':cliente', $cliente);
		$command->bindParam(':sucursal', $sucursal);
		$command->bindParam(':fecha', $fecha);
		$command->bindParam(':estado', $estado);
		$command->bindParam(':fechaEntrega', $entrega);
		$command->execute();

		return $connection->lastInsertId();			
	}	

	function modificar($obj){

	}

	function actualizarEstado($idPedido,$estado){
		$query = 'UPDATE '.$this->table.' SET estado = :estado WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $idPedido;
		$estado = $estado;

		$command->bindParam(':id', $id);
		$command->bindParam(':estado', $estado);
		$command->execute();		
	}

	function listar($page, $campo, $orden){
		$pedidos=array();
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$query = 'SELECT * FROM '.$this->table.' ORDER BY '.$campo.' ' .$orden.' LIMIT '.$page1.', '.PAGINATION;
		
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
			$p = new Pedido();
			$p->setId($row['id']);
			$p->setCliente($row['cliente']);
			$p->setSucursal($row['sucursal']);
			$p->setFecha($row['fecha']);
			$p->setEstado($row['estado']);
			$p->setFechaEntrega($row['fechaEntrega']);

			$pedidos[] = $p;
		}
		return $pedidos;
	}

	function listarPorFecha($page){
		$pedidos=array();
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$query = 'SELECT * FROM '.$this->table.' ORDER BY fecha desc LIMIT '.$page1.', '.PAGINATION;
		
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
			$p = new Pedido();
			$p->setId($row['id']);
			$p->setCliente($row['cliente']);
			$p->setSucursal($row['sucursal']);
			$p->setFecha($row['fecha']);
			$p->setEstado($row['estado']);
			$p->setFechaEntrega($row['fechaEntrega']);

			$pedidos[] = $p;
		}
		return $pedidos;
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
			$p->setFechaEntrega($row['fechaEntrega']);

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

	function listarPorSucursal($obj,$page){
		$pedidos=array();
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION_FRONT;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE sucursal = '. $obj->getId() .' ORDER BY fecha desc LIMIT '.$page1.', '.PAGINATION_FRONT;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contarPorSucursal($obj);

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
			$p->setFechaEntrega($row['fechaEntrega']);

			$pedidos[] = $p;
		}
		return $pedidos;
	}

	function contarPorSucursal($obj){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE sucursal = '.$obj->getId();
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

	function listadoPorFecha($fecha,$page){
		$pedidos=array();
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION_FRONT;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE fecha LIKE "'. $fecha.'%" ORDER BY fecha desc LIMIT '.$page1.', '.PAGINATION_FRONT;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contarPorFecha($fecha);

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
			$p->setFechaEntrega($row['fechaEntrega']);

			$pedidos[] = $p;
		}
		return $pedidos;
	}

	function contarPorFecha($fecha){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE fecha LIKE "'.$fecha.'%"';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}	

	function litrosVendidosEntreFechas($fechaIni,$fechaFin){

		$fechaIni = $fechaIni.' 00:00:00';
		$fechaFin = $fechaFin.' 23:59:59';

		$query = 'SELECT l.idCerveza as "idCerveza", SUM(e.capacidad * l.cantidad) as "litrosVendidos"
					FROM pedidos p 
					INNER JOIN lineapedido l ON l.idPedido = p.id
					INNER JOIN envases e ON l.idEnvase = e.id
				WHERE p.fecha BETWEEN "'. $fechaIni.'" AND "'. $fechaFin .'" 
				GROUP BY l.idCerveza
				ORDER BY l.idCerveza asc;';
		

		/* Query original en la db
SELECT l.idCerveza as "idCerveza", SUM(e.capacidad * l.cantidad) as "litrosVendidos"
		FROM pedidos p 
	INNER JOIN lineapedido l ON l.idPedido = p.id
	INNER JOIN envases e ON l.idEnvase = e.id
		WHERE p.fecha BETWEEN "2017-11-22 00:00:00" AND "2017-11-24 23:59:59"
	GROUP BY l.idCerveza	
    ORDER BY l.idCerveza asc;
		*/

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$litrosXcerveza = array();			

		foreach($result as $row)
		{
			$litrosXcerveza[$row["idCerveza"]] = $row["litrosVendidos"];
		}

		return $litrosXcerveza;
	}	
}
?>
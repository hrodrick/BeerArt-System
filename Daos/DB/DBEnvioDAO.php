<?php
namespace Daos\DB;

use Models\Envio as Envio;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;

class DBEnvioDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'envios';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (idPedido, domicilio) VALUES (:idPedido, :domicilio)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :idPedido, :domicilio)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$idPedido = $obj->getIdPedido();
		$domicilio = $obj->getDomicilio();

		$command->bindParam(':idPedido', $idPedido);
		$command->bindParam(':domicilio', $domicilio);
		$command->execute();
	
	}	

	function modificar($obj){

	}

	function listar($page,$campo,$orden){

	}

	function buscarId($id){

	}
}
?>
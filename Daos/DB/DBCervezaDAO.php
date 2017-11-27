<?php
namespace Daos\DB;

use Models\Cerveza as Cerveza;
use Models\Envxcer as Envxcer;
use Models\Envase as Envase;
use Models\CervezaConEnvDTO as CervezaConEnvDTO;
use Daos\SingletonAbstractDAO as SingletonAbstractDAO;
use Daos\iDao as iDao;
use Daos\DB\Connection as Connection;
use Daos\DB\tDBDAO as tDBDAO;
use \Exception as Exception;
use \PDOExeption as PDOExeption;

class DBCervezaDAO extends SingletonAbstractDAO implements iDao{

	use tDBDAO;

	protected $table = 'cervezas';

	function __construct(){

	}

	function insertar($obj){
		$query = 'INSERT INTO '.$this->table.' (tipo, descripcion, precioXLitro, foto, standBy) VALUES (:tipo, :descripcion, :precioXLitro, :foto, :standBy)';
		//$query = 'INSERT INTO '.$this->table.' VALUES (0, :tipo, :descripcion, :precioXLitro, :foto, :standBy)';
		try{
			$pdo = new Connection();
			//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$connection = $pdo->Connect();	
			$command = $connection->prepare($query);
			$tipo = $obj->getTipo();
			$descripcion = $obj->getDescripcion();
			$precioXLitro = $obj->getPrecioXLitro();
			$foto = $obj->getFoto();
			$standBy = $obj->getStandBy();

			$command->bindParam(':tipo', $tipo);
			$command->bindParam(':descripcion', $descripcion);
			$command->bindParam(':precioXLitro', $precioXLitro);
			$command->bindParam(':foto', $foto);
			$command->bindParam(':standBy', $standBy);	
			$command->execute();
		}
		catch(PDOException $e){
			throw new $e;
		}
	}

	function modificar($obj){
		$query = 'UPDATE '.$this->table.' SET tipo = :tipo, descripcion = :descripcion, precioXLitro = :precioXLitro, foto = :foto, standBy = :standBy WHERE id = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $obj->getId();
		$tipo = $obj->getTipo();
		$descripcion = $obj->getDescripcion();
		$precioXLitro = $obj->getPrecioXLitro();
		$foto = $obj->getFoto();
		$standBy = $obj->getStandBy();

		$command->bindParam(':id', $id);
		$command->bindParam(':tipo', $tipo);
		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':precioXLitro', $precioXLitro);
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

		foreach($result as $row)
		{
			$c = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$cervezas[] = $c;
		}
		return $cervezas;
	}

	function listarSinStandBy($page){
		$cervezas=array();		
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION_FRONT;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE standBy = 0 ORDER BY tipo asc LIMIT '.$page1.', '.PAGINATION_FRONT;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contar();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION_FRONT;
		  	$countPages = ceil($countPages);
		}

		foreach($result as $row)
		{
			$c = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$cervezas[] = $c;
		}
		return $cervezas;
	}

	function listarSinStandByLimit(){

		$query = 'SELECT * FROM '.$this->table.' WHERE standBy = 0 ORDER BY RAND() LIMIT 3';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$cervezas[] = $c;
		}
		return $cervezas;
	}

	function listAll(){
		$query = 'SELECT * FROM '.$this->table.' ORDER BY tipo asc';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$c->setId($row['id']);

			$cervezas[] = $c;
		}
		return $cervezas;		
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
			$obj = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
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
			$obj = new Cerveza($row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$obj->setId($row['id']);

		}
		return $obj;
	}	

	function contarActivos(){
		$query = 'SELECT COUNT(*) FROM '.$this->table.' WHERE standBy = 0';
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

	function listarConEnv($page,$campo,$orden){
		$cervezasDTO=array();		
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
			$c = new CervezaConEnvDTO($row['id'],$row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);

			$cervezasDTO[] = $c;
		}
		return $cervezasDTO;
	}		

	function listarConEnv1($page=1,$campo='tipo',$orden='asc'){
		$cervezasDTO=array();
		$envase;		
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION;
		}

		$query = 'SELECT c.id AS cer_id, c.tipo AS cer_tipo, c.descripcion AS cer_descripcion, c.precioXLitro AS cer_precioXLitro, c.foto AS cer_foto, c.standBy AS cer_standBy, '
			 .'exc.id, exc.idcer, exc.idenv, exc.tiene, e.id AS env_id, e.tipo AS env_tipo, e.capacidad AS env_capacidad, e.coeficiente AS env_coeficiente, e.foto AS env_foto, e.standBy AS env_standBy FROM cervezas AS c '
			 .'INNER JOIN envxcer AS exc ON c.id = exc.idcer AND exc.tiene = 1 '
			 .'INNER JOIN envases AS  e  ON e.id = exc.idenv '
			 .'WHERE c.standBy = 0 ';
			 //.'ORDER BY c.tipo asc LIMIT '.$page1.', '.PAGINATION_FRONT;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contar();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION_FRONT;
		  	$countPages = ceil($countPages);
		}
		$idCer=0;
		foreach($result as $row)
		{
			if($row['cer_id']!=$idCer){
				if($idCer!=0){
					$cervezasDTO[] = $c;
				}
				$idCer=$row['cer_id'];
				$c = new CervezaConEnvDTO($row['cer_id'],$row['cer_tipo'],$row['cer_descripcion'],$row['cer_precioXLitro'],$row['cer_foto'],$row['cer_standBy']);
			}
			$envase=new Envase($row['env_id'],$row['env_tipo'],$row['env_capacidad'],$row['env_coeficiente'],$row['env_foto'],$row['env_standBy']);
			$c->addEnvase($envase);
		}
		return $cervezasDTO;
	}			

	function listarConEnv2($page=1,$campo='tipo',$orden='asc'){
		$cervezasDTO=array();
		$envase;		
		$page1=0;
		if($page>0){
			$page1 = ($page-1) * PAGINATION_FRONT;
		}

		$query = 'SELECT * FROM '.$this->table.' WHERE NOT standBy ORDER BY '.$campo.' '.$orden.' LIMIT '.$page1.', '.PAGINATION_FRONT;

		$queryEnv = 'SELECT exc.id, exc.idcer, exc.idenv, exc.tiene,env_id, e.tipo AS env_tipo, e.capacidad AS env_capacidad, e.coeficiente AS env_coeficiente, e.foto AS env_foto, e.standBy AS env_standBy FROM envxcer AS exc'
			 .'INNER JOIN envases AS  e  ON e.id = exc.idenv '
			 .'WHERE exc.tiene = 1 AND exc.idcer = ';			 
			 //.'ORDER BY c.tipo asc LIMIT '.$page1.', '.PAGINATION_FRONT;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		$totalCount=$this->contar();

		if ($totalCount) {
		  	$countPages = $totalCount / PAGINATION_FRONT;
		  	$countPages = ceil($countPages);
		}

		foreach($result as $row)
		{
			$c = new CervezaConEnvDTO($row['id'],$row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);
			$queryEnv = 0;
			$queryEnv += $c->getId();
			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($queryEnv);
			$command->execute();

			$resultEnv = $command->fetchAll();

			foreach ($resultEnv as $rowEnv) {
				$envase=new Envase($rowEnv['env_id'],$rowEnv['env_tipo'],$rowEnv['env_capacidad'],$rowEnv['env_coeficiente'],$rowEnv['env_foto'],$rowEnv['env_standBy']);
				$c->addEnvase($envase);				
			}


			$cervezasDTO[] = $c;
		}
		return $cervezasDTO;
	}	

	function productoConEnv($id,$page=1,$campo='tipo',$orden='asc'){
		$cervezasDTO;
		$envase;		

		$query = 'SELECT * FROM '.$this->table.' WHERE id = '.$id;

		$queryEnv = 'SELECT exc.id, exc.idcer, exc.idenv, exc.tiene,e.id AS env_id, e.tipo AS env_tipo, e.capacidad AS env_capacidad, e.coeficiente AS env_coeficiente, e.foto AS env_foto, e.standBy AS env_standBy FROM envxcer AS exc '
			 .'INNER JOIN envases AS  e  ON e.id = exc.idenv '
			 .'WHERE exc.tiene = 1 AND exc.idcer = '.$id;			 
			 //.'ORDER BY c.tipo asc LIMIT '.$page1.', '.PAGINATION_FRONT;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		$result = $command->fetchAll();

		foreach($result as $row)
		{
			$c = new CervezaConEnvDTO($row['id'],$row['tipo'],$row['descripcion'],$row['precioXLitro'],$row['foto'],$row['standBy']);

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($queryEnv);
			$command->execute();

			$resultEnv = $command->fetchAll();

			foreach ($resultEnv as $rowEnv) {
				$envase=new Envase($rowEnv['env_tipo'],$rowEnv['env_capacidad'],$rowEnv['env_coeficiente'],$rowEnv['env_foto'],$rowEnv['env_standBy']);
				$envase->setId($rowEnv['env_id']);
				$c->addEnvase($envase);	
		
			}

			$cervezasDTO = $c;
		}
		return $cervezasDTO;
	}	
}
?>

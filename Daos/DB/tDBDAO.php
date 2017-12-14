<?php
namespace Daos\DB;

trait tDBDAO{

	function eliminar($id){
		$query = 'DELETE FROM '.$this->table.' WHERE id = '.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->execute();	
	}

	function modificarStandBy($id){
		$query = 'UPDATE '.$this->table.' SET standBy = NOT standBy WHERE id = '.$id;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->execute();	
	}	

	function contar(){
		$query = 'SELECT COUNT(*) FROM '.$this->table;
		
		$pdo = new Connection();
		$connection = $pdo->Connect();
		$total = $connection->prepare($query);
		$total->execute();
		$totalCount=$total->fetchColumn();
		return $totalCount;
	}

	function ordenarListado($campo,$orden){
		return $this->listar(1,$campo,$orden);
	}	

}
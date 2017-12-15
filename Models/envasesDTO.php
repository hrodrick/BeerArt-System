<?php namespace Models;

	class EnvasesDTO
	{
		private $envase;
		private $cantidadHistoricaVendida; //int : la cantidad que se vendió.
		
		function __construct()
		{
		
		}

		public function setEnvase($envase){
			$this->envase = $envase;
		}
		public function setCantidadHistoricaVendida($cantVendida){
			$this->cantidadHistoricaVendida = $cantVendida;
		}

		public function getEnvase(){
			return $this->envase;
		}
		public function getCantidadHistoricaVendida(){
			return $this->cantidadHistoricaVendida;
		}

	}




?>
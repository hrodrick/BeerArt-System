<?php namespace Models;

	class LitrosXcervezaDTO
	{
		private $cerveza;
		private $listaEnvasesDTO;

		function __construct()
		{
			$listaEnvasesDTO = array();
		}

		public function setCerveza($cerveza){
			$this->cerveza = $cerveza;
		}
		
		public function setListaEnvasesDTO($listaEnvasesDTO){
			$this->listaEnvasesDTO = $listaEnvasesDTO;
		}

		public function addEnvaseDTO($envaseDTO){
			array_push($listaEnvasesDTO, $envaseDTO);
		}

		public function getCerveza(){
			return $this->cerveza;
		}
		public function getListaEnvasesDTO(){
			return $this->listaEnvasesDTO;
		}

	}




?>
<?php
namespace Daos;

interface iDao{
	public function insertar($obj);
	public function eliminar($id);
	public function modificarStandBy($id);
	public function modificar($obj);
	public function listar($page,$campo,$orden);
	public function contar();
	public function buscarId($id);
}
?>
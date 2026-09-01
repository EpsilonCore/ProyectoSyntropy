<?php
class CentrosAcopioController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
		if (!$conexionbd) {
			die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
		}
		require "CentrosAcopioModel.php";
		$this->modeloObj = new CentrosAcopioModel($conexionbd);
	}

	public function getAllCentrosAcopio()
	{
		return ["status" => "ok", "mensaje" => "Centros de acopio obtenidos correctamente.", "data" => $this->modeloObj->getAllCentrosAcopio()];
	}

	public function buscarCentroAcopio()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idCentroAcopio)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el ID del centro de acopio.", "data" => null];
		}
		$centro = $this->modeloObj->buscarCentroAcopio($datos->idCentroAcopio);
		if ($centro) {
			return ["status" => "ok", "mensaje" => "Centro de acopio encontrado.", "data" => $centro];
		}
		return ["status" => "no_encontrado", "mensaje" => "No se encontró el centro de acopio.", "data" => null];
	}

	public function crearCentroAcopio()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->tipoResiduo) || !isset($datos->capacidad) || !isset($datos->barrio) || !isset($datos->calle) || !isset($datos->numero)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->crearCentroAcopio($datos->tipoResiduo, $datos->capacidad, $datos->barrio, $datos->calle, $datos->numero);
		if ($resultado) {
			return ["status" => "creado", "mensaje" => "Centro de acopio creado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo crear el centro de acopio.", "data" => null];
	}

	public function eliminarCentroAcopio()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idCentroAcopio)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->eliminarCentroAcopio($datos->idCentroAcopio);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Centro de acopio eliminado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo eliminar el centro de acopio.", "data" => null];
	}

	public function actualizarCentroAcopio()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idCentroAcopio) || !isset($datos->tipoResiduo) || !isset($datos->capacidad) || !isset($datos->barrio) || !isset($datos->calle) || !isset($datos->numero)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->actualizarCentroAcopio($datos->idCentroAcopio, $datos->tipoResiduo, $datos->capacidad, $datos->barrio, $datos->calle, $datos->numero);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Centro de acopio actualizado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo actualizar el centro de acopio.", "data" => null];
	}
}

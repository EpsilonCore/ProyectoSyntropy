<?php
class CamionController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
		if (!$conexionbd) {
			die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
		}
		require "CamionModel.php";
		$this->modeloObj = new CamionModel($conexionbd);
	}

	public function getAllMatriculas()
	{
		return ["status" => "ok", "mensaje" => "Camiones obtenidos correctamente.", "data" => $this->modeloObj->getAllMatriculas()];
	}

	// Recibe la matrícula como parámetro (la extrae el router de la URL),
	// antes intentaba leerla del body y nunca llegaba ningún valor.
	public function buscarMatricula($matricula)
	{
		$camion = $this->modeloObj->buscarMatricula($matricula);
		if ($camion) {
			return ["status" => "ok", "mensaje" => "Camión encontrado.", "data" => $camion];
		}
		return ["status" => "no_encontrado", "mensaje" => "No se encontró un camión con esa matrícula.", "data" => null];
	}

	public function crearCamion()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->matricula) || !isset($datos->capacidadCarga) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->ubicacion)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->crearCamion($datos->matricula, $datos->capacidadCarga, $datos->tipo, $datos->estado, $datos->ubicacion);
		if ($resultado) {
			return ["status" => "creado", "mensaje" => "Camión creado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo crear el camión.", "data" => null];
	}

	public function actualizarCamion()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->matricula) || !isset($datos->capacidadCarga) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->ubicacion)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->actualizarCamion($datos->matricula, $datos->capacidadCarga, $datos->tipo, $datos->estado, $datos->ubicacion);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Camión actualizado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo actualizar el camión.", "data" => null];
	}

	public function eliminarCamion()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->matricula)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->eliminarCamion($datos->matricula);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Camión eliminado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo eliminar el camión.", "data" => null];
	}
}

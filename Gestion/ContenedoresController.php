<?php
class ContenedoresController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
		if (!$conexionbd) {
			die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
		}
		require "ContenedorModel.php";
		$this->modeloObj = new ContenedorModel($conexionbd);
	}

	public function getAllContenedores()
	{
		return ["status" => "ok", "mensaje" => "Contenedores obtenidos correctamente.", "data" => $this->modeloObj->getAllContenedores()];
	}

	public function buscarContenedor()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idContenedor)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el ID del contenedor.", "data" => null];
		}
		$contenedor = $this->modeloObj->buscarContenedor($datos->idContenedor);
		if ($contenedor) {
			return ["status" => "ok", "mensaje" => "Contenedor encontrado.", "data" => $contenedor];
		}
		return ["status" => "no_encontrado", "mensaje" => "No se encontró el contenedor.", "data" => null];
	}

	public function crearContenedor()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->tipo) || !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio) || !isset($datos->capCarga) || !isset($datos->estado)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		try {
			$resultado = $this->modeloObj->crearContenedor($datos->capCarga, $datos->tipo, $datos->estado, $datos->calle, $datos->numero, $datos->barrio);
		} catch (Exception $e) {
			return ["status" => "datos_invalidos", "mensaje" => "No se pudo geocodificar la dirección proporcionada.", "data" => null];
		}
		if ($resultado) {
			return ["status" => "creado", "mensaje" => "Contenedor creado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo crear el contenedor.", "data" => null];
	}

	public function eliminarContenedor()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idContenedor)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el ID del contenedor.", "data" => null];
		}
		$resultado = $this->modeloObj->eliminarContenedor($datos->idContenedor);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Contenedor eliminado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo eliminar el contenedor.", "data" => null];
	}

	public function actualizarContenedor()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idContenedor) || !isset($datos->capCarga) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->actualizarContenedor($datos->idContenedor, $datos->capCarga, $datos->tipo, $datos->estado, $datos->calle, $datos->numero, $datos->barrio);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Contenedor actualizado correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo actualizar el contenedor.", "data" => null];
	}
}

<?php
class IncidenciaController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
		if (!$conexionbd) {
			die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
		}
		require "IncidenciaModel.php";
		$this->modeloObj = new IncidenciaModel($conexionbd);
	}

	public function getAllIncidencias()
	{
		return ["status" => "ok", "mensaje" => "Incidencias obtenidas correctamente.", "data" => $this->modeloObj->getAllIncidencias()];
	}

	public function buscarIncidencia()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idIncidencia)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el ID de la incidencia.", "data" => null];
		}
		$incidencia = $this->modeloObj->buscarIncidencia($datos->idIncidencia);
		if ($incidencia) {
			return ["status" => "ok", "mensaje" => "Incidencia encontrada.", "data" => $incidencia];
		}
		return ["status" => "no_encontrado", "mensaje" => "No se encontró la incidencia.", "data" => null];
	}

	public function crearIncidencia()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		// Se agregó tipoContenedor a la validación: antes se usaba sin chequear si venía en el body.
		if (!$datos || !isset($datos->mail) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->imagen)
			|| !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio) || !isset($datos->tipoContenedor)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		try {
			$resultado = $this->modeloObj->crearIncidencia(
				$datos->mail, $datos->tipo, $datos->estado, $datos->imagen,
				$datos->calle, $datos->numero, $datos->barrio, $datos->tipoContenedor
			);
		} catch (Exception $e) {
			// El Model lanza excepción si la geocodificación falla; sin este catch la API se caía sin responder.
			return ["status" => "datos_invalidos", "mensaje" => "No se pudo geocodificar la dirección proporcionada.", "data" => null];
		}
		if ($resultado) {
			return ["status" => "creado", "mensaje" => "Incidencia creada correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo crear la incidencia.", "data" => null];
	}

	public function AsignarOperario()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idIncidencia)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el ID de la incidencia.", "data" => null];
		}
		$nombreAsignador = $_SESSION['nombre_completo'] ?? null;
		if (!$nombreAsignador) {
			return ["status" => "no_autorizado", "mensaje" => "No se pudo identificar al usuario que asigna la incidencia. Volvé a iniciar sesión.", "data" => null];
		}
		$resultado = $this->modeloObj->AsignarOperario($datos->idIncidencia, $nombreAsignador);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Incidencia asignada correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo asignar la incidencia.", "data" => null];
	}

	public function AsignarCuadrilla()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idIncidencia) || !isset($datos->idCuadrilla)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->AsignarCuadrilla($datos->idIncidencia, $datos->idCuadrilla);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Cuadrilla asignada correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo asignar la cuadrilla.", "data" => null];
	}

	public function eliminarIncidencia()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idIncidencia)) {
			return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios.", "data" => null];
		}
		$resultado = $this->modeloObj->eliminarIncidencia($datos->idIncidencia);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Incidencia eliminada correctamente.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudo eliminar la incidencia.", "data" => null];
	}
}

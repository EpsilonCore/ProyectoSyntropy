<?php
class NotificacionController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
		if (!$conexionbd) {
			die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
		}
		require_once __DIR__ . "/NotificacionModel.php";
		$this->modeloObj = new NotificacionModel($conexionbd);
	}

	public function getMisNotificaciones()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->mail)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el mail del usuario.", "data" => null];
		}
		if (($_SESSION['mail'] ?? null) !== $datos->mail) {
			return ["status" => "no_autorizado", "mensaje" => "Volvé a iniciar sesión.", "data" => null];
		}
		$notificaciones = $this->modeloObj->getNotificacionesPorMail($datos->mail);
		return ["status" => "ok", "mensaje" => "Notificaciones obtenidas correctamente.", "data" => $notificaciones ?: []];
	}

	public function marcarLeidas()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->mail)) {
			return ["status" => "datos_invalidos", "mensaje" => "Falta el mail del usuario.", "data" => null];
		}
		if (($_SESSION['mail'] ?? null) !== $datos->mail) {
			return ["status" => "no_autorizado", "mensaje" => "Volvé a iniciar sesión.", "data" => null];
		}
		$resultado = $this->modeloObj->marcarTodasLeidas($datos->mail);
		if ($resultado) {
			return ["status" => "ok", "mensaje" => "Notificaciones marcadas como leídas.", "data" => null];
		}
		return ["status" => "error", "mensaje" => "No se pudieron marcar las notificaciones.", "data" => null];
	}
}

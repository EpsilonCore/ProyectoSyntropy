<?php
class ContenedoresController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost","root","","syntropy");
		if (!$conexionbd){
			die("Error de conexion ". mysqli_connect_error());
		}
		require "ContenedorModel.php";
		$this->modeloObj = new ContenedorModel($conexionbd);
	}

	
	public function getAllContenedores()
	{
		return $this->modeloObj->getAllContenedores();
	}
	public function buscarContenedor(){
		$json = file_get_contents('php://input');
			$datos = json_decode($json);
		return $this->modeloObj -> buscarContenedor($datos->idContenedor);
	}
	public function crearContenedor(){
		$json = file_get_contents('php://input');
			$datos = json_decode($json);
			if(!$datos|| !isset($datos->tipo) || !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio) || !isset($datos->capCarga) || !isset($datos->estado)){
				return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
			}
			$cap = $datos->capCarga;
			$t = $datos->tipo;
			$e = $datos->estado;
			$c = $datos->calle;
			$n = $datos->numero;
			$b = $datos->barrio;

		$resultado= $this->modeloObj -> crearContenedor($cap, $t, $e, $c,$n,$b);

		if ($resultado) {
        return ["status" => "creado", "mensaje" => "Contenedor creado correctamente"];
    } else {
        return ["status" => "error", "mensaje" => "No se pudo crear el contenedor"];
    }
	}
	public function eliminarContenedor()
	{
		$json = file_get_contents('php://input');
			$datos = json_decode($json);
			$id = $datos->idContenedor;
		$resultado = $this->modeloObj->eliminarContenedor($id);

if ($resultado) {
    return ["status" => "ok", "mensaje" => "Contenedor eliminado correctamente"];
} else {
    return ["status" => "error", "mensaje" => "No se pudo eliminar el contenedor"];
}
	}
	public function actualizarContenedor()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->idContenedor) || !isset($datos->capCarga) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio)) {
			return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
		}
		$id = $datos->idContenedor;
		$cap = $datos->capCarga;
		$t = $datos->tipo;
		$e = $datos->estado;
		$c = $datos->calle;
		$n = $datos->numero;
		$b = $datos->barrio;

		$resultado = $this->modeloObj->actualizarContenedor($id, $cap, $t, $e, $c, $n, $b);
		if ($resultado) {
    return ["status" => "ok", "mensaje" => "Contenedor actualizado correctamente"];
} else {
    return ["status" => "error", "mensaje" => "No se pudo actualizar el contenedor"];
}
	}
}
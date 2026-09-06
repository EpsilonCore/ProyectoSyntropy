<?php
class CuadrillaController
{
    private $modeloObj;

    public function __construct()
    {
        $conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
        if (!$conexionbd) {
            die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
        }
        require "CuadrillaModel.php";
        $this->modeloObj = new CuadrillaModel($conexionbd);
    }

    public function getAllCuadrillas()
    {
        return ["status" => "ok", "mensaje" => "Cuadrillas obtenidas correctamente.", "data" => $this->modeloObj->getAllCuadrillas()];
    }

    public function getRecolectoresDisponibles()
    {
        return ["status" => "ok", "mensaje" => "Recolectores obtenidos correctamente.", "data" => $this->modeloObj->getRecolectoresDisponibles()];
    }

    public function crearCuadrilla()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->nombre) || empty($datos->miembros) || !is_array($datos->miembros)) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios: nombre y al menos un miembro Recolector.", "data" => null];
        }

        $resultado = $this->modeloObj->crearCuadrilla($datos->nombre, $datos->miembros);

        if ($resultado) {
            return ["status" => "creado", "mensaje" => "Cuadrilla creada correctamente.", "data" => null];
        }
        return ["status" => "error", "mensaje" => "No se pudo crear la cuadrilla. Verificá que todos los miembros tengan rol Recolector y estén activos.", "data" => null];
    }

    public function eliminarCuadrilla()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || !isset($datos->idCuadrilla)) {
            return ["status" => "datos_invalidos", "mensaje" => "Falta el ID de la cuadrilla.", "data" => null];
        }

        $resultado = $this->modeloObj->eliminarCuadrilla($datos->idCuadrilla);

        if ($resultado) {
            return ["status" => "ok", "mensaje" => "Cuadrilla eliminada correctamente.", "data" => null];
        }
        return ["status" => "error", "mensaje" => "No se pudo eliminar la cuadrilla.", "data" => null];
    }
}

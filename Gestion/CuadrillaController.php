<?php
class CuadrillaController
{
    private $modeloObj;

    public function __construct()
    {
        $conexionbd = mysqli_connect("localhost", "root", "", "syntropy");

        if (!$conexionbd) {
            throw new RuntimeException("Error de conexión a la base de datos.");
        }

        mysqli_set_charset($conexionbd, "utf8mb4");

        require_once "CuadrillaModel.php";
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

        if (
            !$datos ||
            !isset($datos->nombre) ||
            !is_string($datos->nombre) ||
            trim($datos->nombre) === "" ||
            !isset($datos->miembros) ||
            !is_array($datos->miembros) ||
            count($datos->miembros) === 0
        ) {
            return [
                "status" => "datos_invalidos",
                "mensaje" => "Faltan campos obligatorios: nombre y al menos un miembro Recolector.",
                "data" => null
            ];
        }

        $nombre = trim($datos->nombre);
        $miembros = array_values(array_unique(array_filter(
            array_map(
                static fn($mail) => is_string($mail) ? trim($mail) : "",
                $datos->miembros
            ),
            static fn($mail) => $mail !== ""
        )));

        if (count($miembros) === 0) {
            return [
                "status" => "datos_invalidos",
                "mensaje" => "Debés seleccionar al menos un Recolector válido.",
                "data" => null
            ];
        }

        $resultado = $this->modeloObj->crearCuadrilla($nombre, $miembros);

        if ($resultado) {
            return ["status" => "creado", "mensaje" => "Cuadrilla creada correctamente.", "data" => null];
        }
        return ["status" => "error", "mensaje" => "No se pudo crear la cuadrilla. Verificá que todos los miembros tengan rol Recolector y estén activos.", "data" => null];
    }

    public function eliminarCuadrilla()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (
            !$datos ||
            !isset($datos->idCuadrilla) ||
            filter_var($datos->idCuadrilla, FILTER_VALIDATE_INT) === false ||
            (int) $datos->idCuadrilla <= 0
        ) {
            return [
                "status" => "datos_invalidos",
                "mensaje" => "Falta un ID de cuadrilla válido.",
                "data" => null
            ];
        }

        $idCuadrilla = (int) $datos->idCuadrilla;
        $resultado = $this->modeloObj->eliminarCuadrilla($idCuadrilla);

        if ($resultado) {
            return ["status" => "ok", "mensaje" => "Cuadrilla eliminada correctamente.", "data" => null];
        }
        return ["status" => "error", "mensaje" => "No se pudo eliminar la cuadrilla.", "data" => null];
    }
}

<?php
class RutaController
{
    private $modeloObj;

    public function __construct()
    {
        $conexionbd = mysqli_connect("localhost", "root", "", "syntropy");
        if (!$conexionbd) {
            die(json_encode(["status" => "error", "mensaje" => "Error de conexión: " . mysqli_connect_error(), "data" => null]));
        }
        require "RutasModel.php";
        $this->modeloObj = new RutasModel($conexionbd);
    }

    public function getAllRutas()
    {
        return ["status" => "ok", "mensaje" => "Rutas obtenidas correctamente.", "data" => $this->modeloObj->getAllRutas()];
    }

    public function crearRuta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (
            !$datos || empty($datos->nombre) || empty($datos->matricula)
            || empty($datos->paradas) || !is_array($datos->paradas) || count($datos->paradas) < 2
        ) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan datos o la ruta necesita al menos 2 paradas.", "data" => null];
        }

        foreach ($datos->paradas as $parada) {
            if (!isset($parada->lat) || !isset($parada->lon)) {
                return ["status" => "datos_invalidos", "mensaje" => "Cada parada necesita latitud y longitud.", "data" => null];
            }
        }

        $paradas = array_map(function ($p) {
            return [
                'lat' => $p->lat,
                'lon' => $p->lon,
                'idContenedor' => $p->idContenedor ?? null,
                'idAcopio' => $p->idAcopio ?? null,
            ];
        }, $datos->paradas);

        try {
            $idRuta = $this->modeloObj->crearRuta($datos->nombre, $datos->matricula, $paradas);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo guardar la ruta.", "data" => null];
        }

        return ["status" => "creado", "mensaje" => "Ruta guardada correctamente.", "data" => ["idRuta" => $idRuta]];
    }
}

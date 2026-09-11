<?php
require_once __DIR__ . '/../Gestion/geocodificacion.php';

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

    public function calcularCamino()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->paradas) || !is_array($datos->paradas) || count($datos->paradas) < 2) {
            return ["status" => "datos_invalidos", "mensaje" => "Se necesitan al menos 2 paradas para calcular el camino.", "data" => null];
        }

        $puntos = array_map(function ($p) {
            return ['lat' => $p->lat, 'lon' => $p->lon];
        }, $datos->paradas);

        try {
            $geocodificador = new geocodificacion();
            $resultado = $geocodificador->calcularRutaCalles($puntos);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo calcular el camino por calles.", "data" => null];
        }

        if ($resultado === null) {
            return ["status" => "error", "mensaje" => "OSRM no pudo calcular un camino entre esos puntos.", "data" => null];
        }

        return ["status" => "ok", "mensaje" => "Camino calculado correctamente.", "data" => $resultado];
    }

    public function getRutaPorId($idRuta)
    {
        if (!ctype_digit((string)$idRuta)) {
            return ["status" => "datos_invalidos", "mensaje" => "El id de la ruta no es válido.", "data" => null];
        }

        try {
            $paradas = $this->modeloObj->getParadasPorRuta((int)$idRuta);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudieron obtener las paradas de la ruta.", "data" => null];
        }

        return ["status" => "ok", "mensaje" => "Paradas obtenidas correctamente.", "data" => $paradas];
    }

    public function eliminarRuta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->idRuta) || !ctype_digit((string)$datos->idRuta)) {
            return ["status" => "datos_invalidos", "mensaje" => "Falta el id de la ruta a eliminar.", "data" => null];
        }

        try {
            $filasAfectadas = $this->modeloObj->eliminarRuta((int)$datos->idRuta);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo eliminar la ruta.", "data" => null];
        }

        if ($filasAfectadas === 0) {
            return ["status" => "no_encontrado", "mensaje" => "No existe una ruta con ese id.", "data" => null];
        }

        return ["status" => "ok", "mensaje" => "Ruta eliminada correctamente.", "data" => null];
    }

    public function crearRuta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (
            !$datos || empty($datos->nombre)
            || empty($datos->paradas) || !is_array($datos->paradas) || count($datos->paradas) < 2
        ) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan datos o la ruta necesita al menos 2 paradas.", "data" => null];
        }

        foreach ($datos->paradas as $parada) {
            if (!isset($parada->lat) || !isset($parada->lon)) {
                return ["status" => "datos_invalidos", "mensaje" => "Cada parada necesita latitud y longitud.", "data" => null];
            }
        }

        $matricula = $datos->matricula ?? '';
        if (trim($matricula) === '') {
            $matricula = null;
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
            $idRuta = $this->modeloObj->crearRuta($datos->nombre, $matricula, $paradas);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo guardar la ruta.", "data" => null];
        }

        return ["status" => "creado", "mensaje" => "Ruta guardada correctamente.", "data" => ["idRuta" => $idRuta]];
    }
}

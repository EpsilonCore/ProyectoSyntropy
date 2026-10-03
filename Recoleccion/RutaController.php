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
        try {
            $rutas = $this->modeloObj->getAllRutas();
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudieron obtener las rutas: " . $e->getMessage(), "data" => null];
        }
        return ["status" => "ok", "mensaje" => "Rutas obtenidas correctamente.", "data" => $rutas];
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

        $paradas = array_map(function ($p) {
            return [
                'lat' => $p->lat,
                'lon' => $p->lon,
                'idContenedor' => $p->idContenedor ?? null,
                'idAcopio' => $p->idAcopio ?? null,
            ];
        }, $datos->paradas);

        try {
            $idRuta = $this->modeloObj->crearRuta($datos->nombre, $paradas);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo guardar la ruta.", "data" => null];
        }

        return ["status" => "creado", "mensaje" => "Ruta guardada correctamente.", "data" => ["idRuta" => $idRuta]];
    }

    public function AsignarCuadrilla(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos || empty($datos->idRuta) || empty($datos->idCuadrilla)){
            return ["status" => "datos_invalidos", "mensaje" => "Faltan datos o los datos no son válidos.", "data" => null];
        }

        try {
            $resultado = $this->modeloObj->AsignarCuadrilla((int)$datos->idRuta, (int)$datos->idCuadrilla);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo asignar la cuadrilla a la ruta.", "data" => null];
        }

        if (!$resultado['ok']) {
            if ($resultado['motivo'] === 'sin_camion') {
                return ["status" => "sin_camion", "mensaje" => "Esa cuadrilla todavía no tiene un camión asignado. Asignale uno antes de asignarla a una ruta.", "data" => null];
            }
            return ["status" => "no_encontrado", "mensaje" => "No existe una ruta o cuadrilla con ese id.", "data" => null];
        }

        return ["status" => "ok", "mensaje" => "Cuadrilla asignada correctamente.", "data" => null];
    }

    public function getRutasPorMail()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->mail)) {
            return ["status" => "datos_invalidos", "mensaje" => "Falta el mail del usuario.", "data" => null];
        }

        try {
            $rutas = $this->modeloObj->getRutasPorMail($datos->mail);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudieron obtener las rutas.", "data" => null];
        }

        return ["status" => "ok", "mensaje" => "Rutas obtenidas correctamente.", "data" => $rutas];
    }

    public function iniciarRuta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->idRuta) || !ctype_digit((string)$datos->idRuta) || empty($datos->mail)) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan el id de la ruta y el mail del usuario.", "data" => null];
        }

        try {
            $resultado = $this->modeloObj->iniciarRuta((int)$datos->idRuta, $datos->mail);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo iniciar la ruta.", "data" => null];
        }

        return $this->responderCambioDeEstado($resultado, "Ruta iniciada correctamente.");
    }

    public function finalizarRuta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        if (!$datos || empty($datos->idRuta) || !ctype_digit((string)$datos->idRuta) || empty($datos->mail)) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan el id de la ruta y el mail del usuario.", "data" => null];
        }

        try {
            $resultado = $this->modeloObj->finalizarRuta((int)$datos->idRuta, $datos->mail);
        } catch (Exception $e) {
            return ["status" => "error", "mensaje" => "No se pudo finalizar la ruta.", "data" => null];
        }

        return $this->responderCambioDeEstado($resultado, "Ruta finalizada correctamente.");
    }

    private function responderCambioDeEstado($resultado, $mensajeOk)
    {
        if ($resultado['ok']) {
            return ["status" => "ok", "mensaje" => $mensajeOk, "data" => null];
        }
        if ($resultado['motivo'] === 'no_encontrado') {
            return ["status" => "no_encontrado", "mensaje" => "No se encontró la ruta o no pertenece a tu cuadrilla.", "data" => null];
        }
        if ($resultado['motivo'] === 'ruta_en_curso') {
            return ["status" => "no_disponible", "mensaje" => "Tu cuadrilla ya tiene una ruta en curso.", "data" => null];
        }
        return ["status" => "no_disponible", "mensaje" => "La ruta no está en un estado válido para esta acción.", "data" => null];
    }
}

<?php

require_once __DIR__ . "/../Gestion/geocodificacion.php";
require_once __DIR__ . "/../Gestion/ContenedorModel.php";
require_once __DIR__ . "/../Gestion/CuadrillaModel.php";

class IncidenciaModel{
    private $mail;
    private $ID_operario;
    private $tipo;
    private $estado;
    private $imagen;
    private $calle;
    private $numero;
    private $barrio;
    private $conexion;
    private $geocodificador;
    private $fecha;
    private $tipoContenedor;
    private $contenedorModel;
    private $cuadrillaModel;
    private $distanciaMinimaMetros = 30;

    public function __construct($bd)
    {
        $this->conexion = $bd;
        $this->geocodificador = new geocodificacion();
        $this->contenedorModel = new ContenedorModel($bd);
        $this->cuadrillaModel = new CuadrillaModel($bd);
    }

    public function getAllIncidencias()
    {
        $sql = "SELECT i.*, c.nombre AS nombre_cuadrilla
                FROM incidencia i
                LEFT JOIN cuadrilla c ON c.ID_cuadrilla = i.ID_cuadrilla";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $incidencias= [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $incidencias[] = $fila;
        }

        mysqli_stmt_close($stmt);
        return $incidencias;
    }


    public function buscarIncidencia($id)
    {
        $sql = "SELECT * FROM incidencia WHERE ID_incidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $incidencia = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);
        return $incidencia;
    }

        public function crearIncidencia($m, $t, $e, $i, $c, $n, $b, $tipoContenedor, $idContenedor = null){
        if($idContenedor !== null){
            $contenedor = $this->buscarContenedorPorId($idContenedor);
            if(!$contenedor){
                throw new Exception("El contenedor seleccionado no existe");
            }
            $c = $contenedor['calle'];
            $n = $contenedor['numero'];
            $b = $contenedor['barrio'];
            $tipoContenedor = $contenedor['tipo'];
            $lat = $contenedor['lat'];
            $lon = $contenedor['lon'];
        } else {
            $direccion = $this->geocodificador->GYSDireccion($c, $n, $b);
            if($direccion === null){
                throw new Exception("No se pudo geocodificar la dirección");
            }
            $lat = $direccion['lat'];
            $lon = $direccion['lon'];
            $cercano = $this->buscarContenedorCercano($lat, $lon);
            if($cercano){
                return $cercano;
            }
        }

        date_default_timezone_set('America/Montevideo');
        $this->fecha = date('Y-m-d H:i:s');

        mysqli_begin_transaction($this->conexion);
        try {
            if($idContenedor === null){
                $idContenedor = $this->crearContenedorNuevo($t, $tipoContenedor, $c, $n, $b, $lat, $lon);
            }
            $sql = "INSERT INTO incidencia (mail, tipo, estado, imagen, calle, numero, barrio, lat, lon, fecha_creacion, tipoContenedor, ID_contenedor) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conexion, $sql);
            if($stmt === false){
                throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
            }
            $this->mail = $m;
            $this->tipo = $t;
            $this->estado = $e;
            $this->imagen = $i;
            $this->calle = $c;
            $this->numero = $n;
            $this->barrio = $b;
            $this->tipoContenedor = $tipoContenedor;

            $stmt->bind_param('sssssisddssi', $this->mail, $this->tipo, $this->estado, $this->imagen, $this->calle, $this->numero, $this->barrio, $lat, $lon, $this->fecha, $this->tipoContenedor, $idContenedor);
            if(!$stmt->execute()){
                throw new Exception("Error al crear la incidencia: " . $stmt->error);
            }
            $stmt->close();

            mysqli_commit($this->conexion);
            return true;
        } catch (Exception $ex) {
            mysqli_rollback($this->conexion);
            error_log("Error en crearIncidencia: " . $ex->getMessage());
            return false;
        }
    }

    private function buscarContenedorPorId($id){
        $sql = "SELECT ID_contenedor, tipo, calle, numero, barrio, lat, lon FROM contenedor WHERE ID_contenedor = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $contenedor = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);
        return $contenedor;
    }

    private function buscarContenedorCercano($lat, $lon){
        $sql = "SELECT ID_contenedor, tipo, capacidadCarga, estado, calle, numero, barrio, lat, lon FROM contenedor";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $cercano = null;
        $menorDistancia = $this->distanciaMinimaMetros;
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $distancia = $this->distanciaMetros($lat, $lon, $fila['lat'], $fila['lon']);
            if($distancia <= $menorDistancia){
                $menorDistancia = $distancia;
                $cercano = $fila;
            }
        }
        mysqli_stmt_close($stmt);
        return $cercano;
    }

        private function distanciaMetros($lat1, $lon1, $lat2, $lon2){
        $metrosPorGradoLat = 111000;
        $metrosPorGradoLon = 91000;
        $difLat = ($lat2 - $lat1) * $metrosPorGradoLat;
        $difLon = ($lon2 - $lon1) * $metrosPorGradoLon;
        return sqrt($difLat * $difLat + $difLon * $difLon);
    }

    private function crearContenedorNuevo($tipoIncidencia, $tipoContenedor, $calle, $numero, $barrio, $lat, $lon){
        $estado = 'Media capacidad';
        if($tipoIncidencia === 'lleno'){
            $estado = 'Lleno';
        } elseif($tipoIncidencia === 'desbordado'){
            $estado = 'Desbordado';
        }
        $capacidad = 0;

        $sql = "INSERT INTO contenedor (tipo, capacidadCarga, estado, calle, numero, barrio, lat, lon) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        if($stmt === false){
            throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
        }
        $stmt->bind_param('sissisdd', $tipoContenedor, $capacidad, $estado, $calle, $numero, $barrio, $lat, $lon);
        if(!$stmt->execute()){
            throw new Exception("No se pudo crear el contenedor: " . $stmt->error);
        }
        $stmt->close();
        return mysqli_insert_id($this->conexion);
    }


    public function AsignarOperario($idIncidencia, $nombreAsignador){
        $sql = "UPDATE incidencia SET ID_operario = ? WHERE ID_incidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $stmt->bind_param('si', $nombreAsignador, $idIncidencia);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else {
            $stmt->close();
            return false;
        }
    }

    public function AsignarCuadrilla($idIncidencia, $idCuadrilla){
        $sql = "UPDATE incidencia SET ID_cuadrilla = ? WHERE ID_incidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $stmt->bind_param('ii', $idCuadrilla, $idIncidencia);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else {
            $stmt->close();
            return false;
        }
    }

    public function eliminarIncidencia($id)
    {
        $sql = "DELETE FROM incidencia WHERE ID_incidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $resultado = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $resultado;
    }

    public function getIncidenciasPorMail($mail) {
    $sql = "SELECT i.*
            FROM incidencia i
            INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = i.ID_cuadrilla
            WHERE ic.mail = ?
            ORDER BY (i.estado = 'Terminada') ASC, i.fecha_creacion DESC";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function marcarRealizada($idIncidencia, $mail) {
    $sql = "SELECT i.ID_cuadrilla
            FROM incidencia i
            INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = i.ID_cuadrilla
            WHERE i.ID_incidencia = ? AND ic.mail = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param('is', $idIncidencia, $mail);
    $stmt->execute();
    $incidencia = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$incidencia) {
        return false;
    }

    $sql = "UPDATE incidencia SET estado = 'Terminada' WHERE ID_incidencia = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param('i', $idIncidencia);
    $stmt->execute();
    $stmt->close();

    $this->cuadrillaModel->liberarCamionSiCorresponde($incidencia['ID_cuadrilla']);
    return true;
}


}
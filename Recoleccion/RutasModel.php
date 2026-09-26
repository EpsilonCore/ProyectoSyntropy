<?php
class RutasModel {
    private $conexion;


public function __construct($bd){
    $this->conexion = $bd;
}

public function crearRuta($nombre, array $paradas){
    date_default_timezone_set('America/Montevideo');
    $fecha = date('Y-m-d H:i:s');

    $sql = "INSERT INTO ruta(nombre, estado, fecha_creacion) VALUES (?, 'Planificada', ?)";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la conexion:" . mysqli_error($this->conexion));
    }
    $stmt->bind_param("ss", $nombre, $fecha);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->close();
    $idRuta = mysqli_insert_id($this->conexion);

    $sqlParada = "INSERT INTO rutaparada(ID_ruta, orden, ID_contenedor, ID_acopio, lat, lon, estado) VALUES (?, ?, ?, ?, ?, ?, 'Pendiente')";
    $stmtParada = mysqli_prepare($this->conexion, $sqlParada);
    if(!$stmtParada){
        throw new Exception("Error al preparar la conexion:" . mysqli_error($this->conexion));
    }

    $orden = 1;
    foreach($paradas as $parada){
        $idContenedor = $parada['ID_contenedor'] ?? null;
        $idAcopio = $parada['ID_acopio'] ?? null;
        $lat = $parada['lat'] ?? null;
        $lon = $parada['lon'] ?? null;

        $stmtParada->bind_param("iiiidd", $idRuta, $orden, $idContenedor, $idAcopio, $lat, $lon);
        if(! $stmtParada->execute()){
            throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
        }

        $orden++;
    }
    $stmtParada->close();

    return $idRuta;
}

public function getAllRutas(){
    $sql = "SELECT r.ID_ruta, r.nombre, r.estado, r.fecha_creacion, r.ID_Cuadrilla,
    c.nombre AS cuadrilla_nombre,
    cc.matricula AS camion_matricula,
    COUNT(p.ID_parada) AS cantidad_paradas
    FROM ruta r
    LEFT JOIN rutaparada p ON p.ID_ruta = r.ID_ruta
    LEFT JOIN cuadrilla c ON c.ID_cuadrilla = r.ID_Cuadrilla
    LEFT JOIN camioncuadrilla cc ON cc.ID_cuadrilla = r.ID_Cuadrilla
    GROUP BY r.ID_ruta
    ORDER BY r.fecha_creacion DESC";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $rutas = [];
    while($fila = mysqli_fetch_assoc($resultado)){
        $rutas[] = $fila;
    }
    mysqli_stmt_close($stmt);
    return $rutas;
}

public function getParadasPorRuta($idRuta){
    $sql = "SELECT orden, ID_contenedor, ID_acopio, lat, lon, estado
            FROM rutaparada
            WHERE ID_ruta = ?
            ORDER BY orden ASC";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("i", $idRuta);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $resultado = $stmt->get_result();
    $paradas = [];
    while($fila = mysqli_fetch_assoc($resultado)){
        $paradas[] = $fila;
    }
    $stmt->close();
    return $paradas;
}

public function eliminarRuta($idRuta){
    // Primero las paradas (dependen de la ruta por clave foránea), después la ruta.
    $sqlParadas = "DELETE FROM rutaparada WHERE ID_ruta = ?";
    $stmtParadas = mysqli_prepare($this->conexion, $sqlParadas);
    if(!$stmtParadas){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmtParadas->bind_param("i", $idRuta);
    if(! $stmtParadas->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmtParadas->close();

    $sqlRuta = "DELETE FROM ruta WHERE ID_ruta = ?";
    $stmtRuta = mysqli_prepare($this->conexion, $sqlRuta);
    if(!$stmtRuta){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmtRuta->bind_param("i", $idRuta);
    if(! $stmtRuta->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $filasAfectadas = $stmtRuta->affected_rows;
    $stmtRuta->close();

    return $filasAfectadas;
}

public function AsignarCuadrilla($idRuta, $idCuadrilla){
    // Solo se puede asignar la ruta a una cuadrilla que ya tenga un camión asignado.
    $sql = "SELECT 1 FROM camioncuadrilla WHERE ID_cuadrilla = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("i", $idCuadrilla);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $tieneCamion = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$tieneCamion) {
        return ["ok" => false, "motivo" => "sin_camion"];
    }
    $sqlExiste = "SELECT 1 FROM ruta WHERE ID_ruta = ?";
    $stmtExiste = mysqli_prepare($this->conexion, $sqlExiste);
    if(!$stmtExiste){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmtExiste->bind_param("i", $idRuta);
    if(! $stmtExiste->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $rutaExiste = $stmtExiste->get_result()->fetch_assoc();
    $stmtExiste->close();

    if (!$rutaExiste) {
        return ["ok" => false, "motivo" => "no_encontrado"];
    }

    $sql = "UPDATE ruta SET ID_Cuadrilla = ? WHERE ID_ruta = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("ii", $idCuadrilla, $idRuta);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->close();
    return ["ok" => true, "motivo" => null];
}
}
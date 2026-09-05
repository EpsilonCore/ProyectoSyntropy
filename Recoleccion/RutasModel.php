<?php
class RutasModel {
    private $conexion;


public function __construct($bd){
    $this->conexion = $bd;
}

public function crearRuta($nombre, $matricula, array $paradas){
    date_default_timezone_set('America/Montevideo');
    $fecha = date('Y-m-d H:i:s');

    $sql = "INSERT INTO ruta(nombre, matricula, estado, fecha_creacion) VALUES (?, ?, 'Planificada', ?)";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la conexion:" . mysqli_error($this->conexion));
    }
    $stmt->bind_param("sss", $nombre, $matricula, $fecha);
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

        $stmtParada->bind_param("iiidd", $idRuta, $orden, $idContenedor, $idAcopio, $lat, $lon);
        if(! $stmtParada->execute()){
            throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
        }

        $orden++;
    }
    $stmtParada->close();

    return $idRuta;
}

public function getAllRutas(){
    $sql = "SELECT r.ID_ruta, r.nombre, r.matricula, r.estado, r.fecha_creacion,
    COUNT(p.ID_parada) AS cantidad_paradas
    FROM ruta r
    LEFT JOIN ruta_parada p ON p.ID_ruta = r.ID_ruta
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
}
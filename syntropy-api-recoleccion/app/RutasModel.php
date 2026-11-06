<?php
require_once __DIR__ . "/CuadrillaModel.php";
require_once __DIR__ . "/IncidenciaModel.php";

class RutasModel {
    private $conexion;
    private $cuadrillaModel;
    private $incidenciaModel;

public function __construct($bd){
    $this->conexion = $bd;
    $this->cuadrillaModel = new CuadrillaModel($bd);
    $this->incidenciaModel = new IncidenciaModel($bd);
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
        $idContenedor = $parada['idContenedor'] ?? null;
        $idAcopio = $parada['idAcopio'] ?? null;
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
    LEFT JOIN camioncuadrilla cc ON cc.ID_cuadrilla = r.ID_Cuadrilla AND cc.fecha_liberacion IS NULL
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
    $sql = "SELECT 1 FROM camioncuadrilla WHERE ID_cuadrilla = ? AND fecha_liberacion IS NULL";
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

// Rutas del recolector
public function getRutasPorMail($mail){
    $sql = "SELECT r.ID_ruta, r.nombre, r.estado, r.fecha_inicio, r.fecha_fin,
    COUNT(p.ID_parada) AS cantidad_paradas
    FROM ruta r
    INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = r.ID_Cuadrilla
    LEFT JOIN rutaparada p ON p.ID_ruta = r.ID_ruta
    WHERE ic.mail = ?
    GROUP BY r.ID_ruta
    ORDER BY (r.estado = 'Finalizada') ASC, r.fecha_creacion DESC";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("s", $mail);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $resultado = $stmt->get_result();
    $rutas = [];
    while($fila = mysqli_fetch_assoc($resultado)){
        $rutas[] = $fila;
    }
    $stmt->close();
    return $rutas;
}

private function buscarRutaDeIntegrante($idRuta, $mail){
    $sql = "SELECT r.estado, r.ID_Cuadrilla
            FROM ruta r
            INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = r.ID_Cuadrilla
            WHERE r.ID_ruta = ? AND ic.mail = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("is", $idRuta, $mail);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $ruta = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $ruta;
}

// Inicio de ruta
public function iniciarRuta($idRuta, $mail){
    $ruta = $this->buscarRutaDeIntegrante($idRuta, $mail);
    if (!$ruta) {
        return ["ok" => false, "motivo" => "no_encontrado"];
    }
    if (!in_array($ruta['estado'], ['Planificada', 'Pendiente'])) {
        return ["ok" => false, "motivo" => "estado_invalido"];
    }

    $sql = "SELECT 1 FROM ruta WHERE ID_Cuadrilla = ? AND estado = 'En Curso'";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("i", $ruta['ID_Cuadrilla']);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $rutaEnCurso = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($rutaEnCurso) {
        return ["ok" => false, "motivo" => "ruta_en_curso"];
    }

    date_default_timezone_set('America/Montevideo');
    $fechaHora = date('Y-m-d H:i:s');

    $sql = "UPDATE ruta SET estado = 'En Curso', fecha_inicio = ?, iniciada_por = ? WHERE ID_ruta = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("ssi", $fechaHora, $mail, $idRuta);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->close();
    return ["ok" => true, "motivo" => null];
}

// Fin de ruta
public function finalizarRuta($idRuta, $mail){
    $ruta = $this->buscarRutaDeIntegrante($idRuta, $mail);
    if (!$ruta) {
        return ["ok" => false, "motivo" => "no_encontrado"];
    }
    if ($ruta['estado'] !== 'En Curso') {
        return ["ok" => false, "motivo" => "estado_invalido"];
    }

    date_default_timezone_set('America/Montevideo');
    $fechaHora = date('Y-m-d H:i:s');

    $sql = "UPDATE ruta SET estado = 'Finalizada', fecha_fin = ?, finalizada_por = ? WHERE ID_ruta = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("ssi", $fechaHora, $mail, $idRuta);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->close();

    $this->cuadrillaModel->liberarCamionSiCorresponde($ruta['ID_Cuadrilla']);
    return ["ok" => true, "motivo" => null];
}
// Contenedores de la ruta del recolector
public function getParadasPorRutaDeIntegrante($idRuta, $mail){
    $sql = "SELECT p.ID_parada, p.orden, p.ID_contenedor, p.ID_acopio, p.estado,
    c.calle, c.numero, c.barrio, c.tipo,
    a.calle AS calle_acopio, a.numero AS numero_acopio, a.barrio AS barrio_acopio
    FROM rutaparada p
    INNER JOIN ruta r ON r.ID_ruta = p.ID_ruta
    INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = r.ID_Cuadrilla
    LEFT JOIN contenedor c ON c.ID_contenedor = p.ID_contenedor
    LEFT JOIN centro_acopio a ON a.ID_acopio = p.ID_acopio
    WHERE p.ID_ruta = ? AND ic.mail = ?
    ORDER BY p.orden ASC";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("is", $idRuta, $mail);
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
// Sugerencia de ruta
public function getCentroAcopio($idAcopio){
    $sql = "SELECT ID_acopio, tipoResiduo, calle, numero, barrio, lat, lon
            FROM centro_acopio
            WHERE ID_acopio = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("i", $idAcopio);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $centro = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $centro;
}

public function getContenedoresParaSugerir($tipo){
    $sql = "SELECT ID_contenedor, capacidadCarga, estado, calle, numero, barrio, lat, lon
            FROM contenedor
            WHERE tipo = ? AND estado IN ('Lleno', 'Desbordado')
            AND ID_contenedor NOT IN (
                SELECT p.ID_contenedor
                FROM rutaparada p
                INNER JOIN ruta r ON r.ID_ruta = p.ID_ruta
                WHERE p.ID_contenedor IS NOT NULL
                AND r.estado IN ('Planificada', 'Pendiente', 'En Curso')
            )";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("s", $tipo);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $resultado = $stmt->get_result();
    $contenedores = [];
    while($fila = mysqli_fetch_assoc($resultado)){
        $fila['capacidadCarga'] = (int)$fila['capacidadCarga'];
        $fila['lat'] = (float)$fila['lat'];
        $fila['lon'] = (float)$fila['lon'];
        $contenedores[] = $fila;
    }
    $stmt->close();
    return $contenedores;
}

public function getCapacidadMaximaCamion(){
    $sql = "SELECT MAX(capacidadCarga) AS maxima FROM camion WHERE estado = 'Disponible'";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $fila = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $fila['maxima'] === null ? null : (int)$fila['maxima'];
}

// Marcar contenedor
public function marcarParada($idParada, $estado, $mail, $tipoIncidencia){
    $sql = "SELECT p.ID_contenedor, p.estado, r.estado AS estado_ruta, r.ID_Cuadrilla
    FROM rutaparada p
    INNER JOIN ruta r ON r.ID_ruta = p.ID_ruta
    INNER JOIN integrante_cuadrilla ic ON ic.ID_cuadrilla = r.ID_Cuadrilla
    WHERE p.ID_parada = ? AND ic.mail = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("is", $idParada, $mail);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $parada = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$parada) {
        return ["ok" => false, "motivo" => "no_encontrado"];
    }
    if ($parada['estado_ruta'] !== 'En Curso') {
        return ["ok" => false, "motivo" => "estado_invalido"];
    }
    if (!$parada['ID_contenedor']) {
        return ["ok" => false, "motivo" => "sin_contenedor"];
    }
    if ($parada['estado'] !== 'Pendiente') {
        return ["ok" => false, "motivo" => "ya_marcada"];
    }

    if ($estado === 'No recogido') {
        $creada = $this->incidenciaModel->crearIncidencia($mail, $tipoIncidencia, 'Pendiente', '', null, null, null, null, $parada['ID_contenedor'], $parada['ID_Cuadrilla']);
        if (!$creada) {
            throw new Exception("No se pudo crear la incidencia.");
        }
    }

    $sql = "UPDATE rutaparada SET estado = ? WHERE ID_parada = ?";
    $stmt = mysqli_prepare($this->conexion, $sql);
    if(!$stmt){
        throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->bind_param("si", $estado, $idParada);
    if(! $stmt->execute()){
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($this->conexion));
    }
    $stmt->close();
    return ["ok" => true, "motivo" => null];
}
}
<?php
class CuadrillaModel
{
    private $conexion;

    public function __construct($bd)
    {
        $this->conexion = $bd;
    }

    // Usuarios habilitados para integrar una cuadrilla: rol Recolector y cuenta activa.
    public function getRecolectoresDisponibles()
    {
        $sql = "SELECT mail, nombre, apellido, nickname
                FROM usuario
                WHERE rol = 'Recolector' AND estado = 'Activo'";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $recolectores = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $recolectores[] = $fila;
        }
        mysqli_stmt_close($stmt);
        return $recolectores;
    }

    public function getAllCuadrillas()
    {
        $sql = "SELECT c.ID_cuadrilla, c.nombre, c.fecha_creacion, c.estado,
                       cc.matricula AS camion_matricula, cc.fecha AS camion_fecha
                FROM cuadrilla c
                LEFT JOIN camioncuadrilla cc ON cc.ID_cuadrilla = c.ID_cuadrilla
                    AND cc.fecha_liberacion IS NULL
                WHERE c.estado = 'Activa'
                ORDER BY c.fecha_creacion DESC";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $cuadrillas = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $fila['miembros'] = $this->getMiembros($fila['ID_cuadrilla']);
            $cuadrillas[] = $fila;
        }
        mysqli_stmt_close($stmt);
        return $cuadrillas;
    }

    public function getMiembros($idCuadrilla)
    {
        $sql = "SELECT u.mail, u.nombre, u.apellido, u.nickname
                FROM integrante_cuadrilla ic
                JOIN usuario u ON u.mail = ic.mail
                WHERE ic.ID_cuadrilla = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idCuadrilla);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $miembros = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $miembros[] = $fila;
        }
        mysqli_stmt_close($stmt);
        return $miembros;
    }

    // Verifica que todos los mails recibidos sean usuarios Recolector y estén activos.
    private function validarRecolectores(array $mails)
    {
        if (empty($mails)) {
            return false;
        }
        $placeholders = implode(',', array_fill(0, count($mails), '?'));
        $sql = "SELECT mail FROM usuario
                WHERE rol = 'Recolector' AND estado = 'Activo' AND mail IN ($placeholders)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $tipos = str_repeat('s', count($mails));
        mysqli_stmt_bind_param($stmt, $tipos, ...$mails);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $validos = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $validos[] = $fila['mail'];
        }
        mysqli_stmt_close($stmt);

        return count($validos) === count(array_unique($mails));
    }

    public function crearCuadrilla($nombre, array $miembros)
    {
        if (!$this->validarRecolectores($miembros)) {
            return false;
        }

        mysqli_begin_transaction($this->conexion);
        try {
            date_default_timezone_set('America/Montevideo');
            $fecha = date('Y-m-d H:i:s');
            $fechaSolo = date('Y-m-d');
            $estado = 'Activa';

            $sql = "INSERT INTO cuadrilla (nombre, fecha_creacion, estado) VALUES (?,?,?)";
            $stmt = mysqli_prepare($this->conexion, $sql);
            if (!$stmt) {
                throw new Exception("Error al preparar 'cuadrilla': " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, "sss", $nombre, $fecha, $estado);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al insertar en 'cuadrilla': " . mysqli_stmt_error($stmt));
            }
            $idCuadrilla = mysqli_insert_id($this->conexion);
            mysqli_stmt_close($stmt);

            $sqlMiembro = "INSERT INTO integrante_cuadrilla (ID_cuadrilla, mail, rol, fecha) VALUES (?,?,?,?)";
            $stmtMiembro = mysqli_prepare($this->conexion, $sqlMiembro);
            $rolMiembro = 'Recolector';
            foreach (array_unique($miembros) as $mail) {
                mysqli_stmt_bind_param($stmtMiembro, "isss", $idCuadrilla, $mail, $rolMiembro, $fechaSolo);
                if (!mysqli_stmt_execute($stmtMiembro)) {
                    throw new Exception("Error al asignar miembro '$mail': " . mysqli_stmt_error($stmtMiembro));
                }
            }
            mysqli_stmt_close($stmtMiembro);

            mysqli_commit($this->conexion);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conexion);
            error_log("Error en crearCuadrilla: " . $e->getMessage());
            return false;
        }
    }

    // Camiones que se pueden ofrecer para asignar (solo los libres).
    public function getCamionesDisponibles()
    {
        $sql = "SELECT matricula, tipo, capacidadCarga, ubicacion
                FROM camion
                WHERE estado = 'Disponible'";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $camiones = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $camiones[] = $fila;
        }
        mysqli_stmt_close($stmt);
        return $camiones;
    }

    // Asignación de camión
    public function asignarCamion($idCuadrilla, $matricula)
    {
        mysqli_begin_transaction($this->conexion);
        try {
            $sql = "SELECT estado FROM camion WHERE matricula = ? FOR UPDATE";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "s", $matricula);
            mysqli_stmt_execute($stmt);
            $camion = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            if (!$camion) {
                mysqli_rollback($this->conexion);
                return ["ok" => false, "motivo" => "no_encontrado"];
            }
            if ($camion['estado'] !== 'Disponible') {
                mysqli_rollback($this->conexion);
                return ["ok" => false, "motivo" => "no_disponible"];
            }

            date_default_timezone_set('America/Montevideo');
            $fecha = date('Y-m-d');
            $fechaHora = date('Y-m-d H:i:s');

            // Camión anterior de la cuadrilla
            $sql = "SELECT matricula FROM camioncuadrilla
                    WHERE ID_cuadrilla = ? AND fecha_liberacion IS NULL";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "i", $idCuadrilla);
            mysqli_stmt_execute($stmt);
            $anterior = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            if ($anterior && $anterior['matricula'] !== $matricula) {
                $sql = "UPDATE camion SET estado = 'Disponible' WHERE matricula = ?";
                $stmt = mysqli_prepare($this->conexion, $sql);
                mysqli_stmt_bind_param($stmt, "s", $anterior['matricula']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $sql = "UPDATE camioncuadrilla SET fecha_liberacion = ?
                        WHERE ID_cuadrilla = ? AND matricula = ? AND fecha_liberacion IS NULL";
                $stmt = mysqli_prepare($this->conexion, $sql);
                mysqli_stmt_bind_param($stmt, "sis", $fechaHora, $idCuadrilla, $anterior['matricula']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            $sql = "UPDATE camion SET estado = 'En Servicio' WHERE matricula = ?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "s", $matricula);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al actualizar el estado del camión: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);

            $sql = "INSERT INTO camioncuadrilla (ID_cuadrilla, matricula, fecha)
                    VALUES (?, ?, ?)
                    ON DUPLICATE KEY UPDATE matricula = VALUES(matricula), fecha = VALUES(fecha), fecha_liberacion = NULL";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $idCuadrilla, $matricula, $fecha);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al registrar la asignación: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);

            mysqli_commit($this->conexion);
            return ["ok" => true];
        } catch (Exception $e) {
            mysqli_rollback($this->conexion);
            error_log("Error en asignarCamion: " . $e->getMessage());
            return ["ok" => false, "motivo" => "error"];
        }
    }

    // Liberación de camión
    public function liberarCamionSiCorresponde($idCuadrilla)
    {
        try {
            $sql = "SELECT
                        (SELECT COUNT(*) FROM ruta
                         WHERE ID_Cuadrilla = ? AND estado <> 'Finalizada')
                      + (SELECT COUNT(*) FROM incidencia
                         WHERE ID_cuadrilla = ? AND (estado IS NULL OR estado <> 'Terminada'))
                        AS pendientes";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $idCuadrilla, $idCuadrilla);
            mysqli_stmt_execute($stmt);
            $fila = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            if ($fila['pendientes'] > 0) {
                return false;
            }

            mysqli_begin_transaction($this->conexion);

            $sql = "SELECT matricula FROM camioncuadrilla
                    WHERE ID_cuadrilla = ? AND fecha_liberacion IS NULL FOR UPDATE";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "i", $idCuadrilla);
            mysqli_stmt_execute($stmt);
            $asignacion = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            if (!$asignacion) {
                mysqli_rollback($this->conexion);
                return false;
            }

            date_default_timezone_set('America/Montevideo');
            $fechaHora = date('Y-m-d H:i:s');

            $sql = "UPDATE camion SET estado = 'Disponible' WHERE matricula = ?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "s", $asignacion['matricula']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $sql = "UPDATE camioncuadrilla SET fecha_liberacion = ?
                    WHERE ID_cuadrilla = ? AND matricula = ? AND fecha_liberacion IS NULL";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "sis", $fechaHora, $idCuadrilla, $asignacion['matricula']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            mysqli_commit($this->conexion);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conexion);
            error_log("Error en liberarCamionSiCorresponde: " . $e->getMessage());
            return false;
        }
    }

    // Baja lógica, igual que se hace con usuario.estado.
    public function eliminarCuadrilla($id)
    {
        $sql = "UPDATE cuadrilla SET estado = 'Inactiva' WHERE ID_cuadrilla = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $ejecutado = mysqli_stmt_execute($stmt);

        if ($ejecutado) {
            $filas = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $filas > 0;
        }
        error_log("Error al eliminar cuadrilla: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return false;
    }
}

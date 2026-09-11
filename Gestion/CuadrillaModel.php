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
        $sql = "SELECT ID_cuadrilla, nombre, fecha_creacion, estado
                FROM cuadrilla
                WHERE estado = 'Activa'
                ORDER BY fecha_creacion DESC";
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

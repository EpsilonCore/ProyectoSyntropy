<?php

class NotificacionModel
{
    private $conexion;

    public function __construct($bd)
    {
        $this->conexion = $bd;
    }

    public function crearNotificacion($mail, $idIncidencia, $mensaje)
    {
        date_default_timezone_set('America/Montevideo');
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT INTO notificacion (mail, ID_incidencia, mensaje, leida, fecha) VALUES (?, ?, ?, 0, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('siss', $mail, $idIncidencia, $mensaje, $fecha);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function getNotificacionesPorMail($mail)
    {
        $sql = "SELECT ID_notificacion, ID_incidencia, mensaje, leida, fecha
                FROM notificacion
                WHERE mail = ?
                ORDER BY fecha DESC, ID_notificacion DESC
                LIMIT 30";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $notificaciones = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $notificaciones;
    }

    public function marcarTodasLeidas($mail)
    {
        $sql = "UPDATE notificacion SET leida = 1 WHERE mail = ? AND leida = 0";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('s', $mail);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}

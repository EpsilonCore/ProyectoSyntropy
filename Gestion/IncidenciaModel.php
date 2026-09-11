<?php

require_once __DIR__ . "/../Gestion/geocodificacion.php";
require_once __DIR__ . "/../Gestion/ContenedorModel.php";

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

    public function __construct($bd)
    {
        $this->conexion = $bd;
        $this->geocodificador = new geocodificacion();
        $this->contenedorModel = new ContenedorModel($bd);
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

    public function crearIncidencia($m, $t, $e, $i, $c, $n,$b, $tipoContenedor){
            $sql = "INSERT INTO incidencia (mail, tipo, estado, imagen, calle, numero, barrio, lat, lon, fecha_creacion, tipoContenedor) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $direccion = $this->geocodificador->GYSDireccion($c, $n, $b);
            if($direccion === null){
                throw new Exception("No se pudo geocodificar la dirección");
            }
            date_default_timezone_set('America/Montevideo');
            $fecha = date('Y-m-d H:i:s');
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

            $this->fecha = $fecha;

            $stmt->bind_param('sssssisddss', $this->mail, $this->tipo, $this->estado,  $this->imagen,  $this->calle,  $this->numero,  $this->barrio, $direccion['lat'], $direccion['lon'], $this->fecha, $this->tipoContenedor);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }
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


}
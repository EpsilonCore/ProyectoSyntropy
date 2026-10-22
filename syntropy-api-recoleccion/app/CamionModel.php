<?php
class CamionModel
{
    private $Matricula;
    private $CapCarga;
    private $Tipo;
    private $Estado;
    private $Ubicacion;
    private $conexion;

    public function __construct($bd)
    {
        $this->conexion = $bd;
    }

    public function getAllMatriculas()
    {
        $sql = "SELECT matricula, estado, tipo, capacidadCarga, ubicacion FROM camion";
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

    public function buscarMatricula($Matricula)
    {
        $sql = "SELECT matricula, capacidad, tipo, estado, ubicacion FROM camion WHERE matricula = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "s", $Matricula);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $camion = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);
        return $camion;
    }

    public function crearCamion($m, $cap, $t, $e, $u){
            $sql = "INSERT INTO camion (matricula, tipo, capacidadCarga, estado, ubicacion) VALUES (?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conexion, $sql);
            $this->Matricula = $m;
            $this->CapCarga = $cap;
            $this->Tipo = $t;
            $this->Estado = $e;
            $this->Ubicacion = $u;

            $stmt->bind_param('ssiss',$this->Matricula,$this->Tipo, $this->CapCarga,  $this->Estado, $this->Ubicacion);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }

        }
        public function actualizarCamion($m, $cap, $t, $e, $u){
            $sql = "UPDATE camion SET tipo=?, capacidadCarga=?, estado=?, ubicacion=? WHERE matricula=?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            $this->Matricula = $m;
            $this->CapCarga = $cap;
            $this->Tipo = $t;
            $this->Estado = $e;
            $this->Ubicacion = $u;

            $stmt->bind_param('sisss', $this->Tipo, $this->CapCarga,  $this->Estado, $this->Ubicacion,  $this->Matricula);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }
        }
        public function eliminarCamion($m){
            $sql = "DELETE FROM camion WHERE matricula=?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            $this->Matricula = $m;

            $stmt->bind_param('s', $this->Matricula);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }
        }
}

<?php
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

    public function __construct($bd)
    {
        $this->conexion = $bd;
    }

    public function getAllIncidencias()
    {
        $sql = "SELECT ID_incidencia, mail, ID_operario, tipo, estado, imagen, calle, numero, barrio FROM incidencia";
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
        $sql = "SELECT ID_incidencia, mail, ID_operario, tipo, estado, imagen, calle, numero, barrio FROM incidencia WHERE idIncidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $incidencia = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);
        return $incidencia;
    }

    public function crearIncidencia($m, $t, $e, $i, $c, $n,$b){
            $sql = "INSERT INTO incidencia (mail, ID_operario, tipo, estado, imagen, calle, numero, barrio) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conexion, $sql);
            $this->mail = $m;
            $this->ID_operario = "";
            $this->tipo = $t;
            $this->estado = $e;
            $this->imagen = $i;
            $this->calle = $c;
            $this->numero = $n;
            $this->barrio = $b;

            $stmt->bind_param('sissssis', $this->mail, $this->ID_operario, $this->tipo, $this->estado,  $this->imagen,  $this->calle,  $this->numero,  $this->barrio);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }
        }

    public function AsignarOperario($idIncidencia, $idOperario){
        $sql = "UPDATE incidencia SET ID_operario = ? WHERE ID_incidencia = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $stmt->bind_param('ss', $idOperario, $idIncidencia);
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


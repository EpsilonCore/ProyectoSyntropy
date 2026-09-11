<?php
class CentrosAcopioModel
{
    private $tipoResiduo;
    private $capacidad;
    private $barrio;
    private $calle;
    private $numero;
    private $conexion;
    private $latitud;
    private $longitud;
    private $geocodificador;

    public function __construct($bd)
    {
        $this->conexion = $bd;
        $this->geocodificador = new geocodificacion();
    }

    public function getAllCentrosAcopio()
    {
        $sql = "SELECT ID_acopio, tipoResiduo, capacidad, barrio, calle, numero FROM centro_acopio";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $centrosAcopio= [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $centrosAcopio[] = $fila;
        }

        mysqli_stmt_close($stmt);
        return $centrosAcopio;
    }

    public function buscarCentroAcopio($id)
    {
        $sql = "SELECT ID_acopio, tipoResiduo, capacidad, barrio, calle, numero FROM centro_acopio WHERE ID_acopio = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $centroAcopio = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);
        return $centroAcopio;
    }
    
    public function crearCentroAcopio($tipoResiduo, $capacidad, $barrio, $calle, $numero)
    {
        $ubicacion = $this->geocodificador->GYSDireccion($calle, $numero, $barrio);
        if($ubicacion === null){
            throw new Exception("No se pudo geocodificar la dirección proporcionada.");
        }
        $sql = "INSERT INTO centro_acopio (tipoResiduo, capacidad, barrio, calle, numero, lat, lon) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $this->tipoResiduo = $tipoResiduo;
        $this->capacidad = $capacidad;
        $this->barrio = $barrio;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->latitud = $ubicacion['lat'];
        $this->longitud = $ubicacion['lon'];

        mysqli_stmt_bind_param($stmt, 'sisssdd', $this->tipoResiduo, $this->capacidad, $this->barrio, $this->calle, $this->numero, $this->latitud, $this->longitud);
        
        if ($stmt->execute()) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    public function actualizarCentroAcopio($id, $tipoResiduo, $capacidad, $barrio, $calle, $numero)
    {
        $ubicacion = $this->geocodificador->GYSDireccion($calle, $numero, $barrio);
        if($ubicacion === null){
            throw new Exception("No se pudo geocodificar la dirección proporcionada.");
        }
        $sql = "UPDATE centro_acopio SET tipoResiduo = ?, capacidad = ?, barrio = ?, calle = ?, numero = ?, lat = ?, lon = ? WHERE ID_acopio = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, 'sisssddi', $tipoResiduo, $capacidad, $barrio, $calle, $numero, $ubicacion['lat'], $ubicacion['lon'], $id);

        if ($stmt->execute()) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    public function eliminarCentroAcopio($id)
    {
        $sql = "DELETE FROM centro_acopio WHERE ID_acopio = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $resultado = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $resultado;
    }
}
<?php
class CentrosAcopioController
{
    private $modeloObj;
    
    public function __construct(){
        
        $conexionbd = mysqli_connect("localhost","root","","syntropy");
        if (!$conexionbd){
            die("Error de conexion ". mysqli_connect_error());
        }
        require "CentrosAcopioModel.php";
        $this->modeloObj = new CentrosAcopioModel($conexionbd);
    }
    public function getAllCentrosAcopio()
    {
        return $this->modeloObj->getAllCentrosAcopio();
    }

    public function buscarCentroAcopio(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        return $this->modeloObj -> buscarCentroAcopio($datos->idCentroAcopio);
    }
    public function crearCentroAcopio(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos|| !isset($datos->tipoResiduo) || !isset($datos->capacidad) || !isset($datos->barrio) || !isset($datos->calle) || !isset($datos->numero)){
            http_response_code(400);
            return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
    }
        $tipoResiduo = $datos->tipoResiduo;
        $capacidad = $datos->capacidad;
        $barrio = $datos->barrio;
        $calle = $datos->calle;
        $numero = $datos->numero;

        $resultado= $this->modeloObj -> crearCentroAcopio($tipoResiduo, $capacidad, $barrio, $calle,$numero);

        if ($resultado) {
            return ["status" => "success", "mensaje" => "Centro de acopio creado correctamente"];
        } else {
            return ["status" => "error", "mensaje" => "No se pudo crear el centro de acopio"];
        }
    }
    public function eliminarCentroAcopio(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos || !isset($datos->idCentroAcopio)){
            http_response_code(400);
            return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
        }
        $idCentroAcopio = $datos->idCentroAcopio;
        $resultado= $this->modeloObj -> eliminarCentroAcopio($idCentroAcopio);

        if ($resultado) {
            return ["status" => "success", "mensaje" => "Centro de acopio eliminado correctamente"];
        } else {
            return ["status" => "error", "mensaje" => "No se pudo eliminar el centro de acopio"];
        }
    }
    public function actualizarCentroAcopio(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos || !isset($datos->idCentroAcopio) || !isset($datos->tipoResiduo) || !isset($datos->capacidad) || !isset($datos->barrio) || !isset($datos->calle) || !isset($datos->numero)){
            http_response_code(400);
            return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
        }
        $idCentroAcopio = $datos->idCentroAcopio;
        $tipoResiduo = $datos->tipoResiduo;
        $capacidad = $datos->capacidad;
        $barrio = $datos->barrio;
        $calle = $datos->calle;
        $numero = $datos->numero;

        $resultado= $this->modeloObj -> actualizarCentroAcopio($idCentroAcopio, $tipoResiduo, $capacidad, $barrio, $calle,$numero);

        if ($resultado) {
            return ["status" => "success", "mensaje" => "Centro de acopio actualizado correctamente"];
        } else {
            return ["status" => "error", "mensaje" => "No se pudo actualizar el centro de acopio"];
        }
    }
}
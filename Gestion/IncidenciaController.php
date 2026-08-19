<?php

class IncidenciaController{
    private $modeloObj;

    public function __construct(){
        $conexionbd = mysqli_connect("localhost","root","","syntropy");
        if(!$conexionbd){
            die("Error de conexion ". mysqli_connect_error());
        }
        require "IncidenciaModel.php";
        $this->modeloObj = new IncidenciaModel($conexionbd);
    }

    public function getAllIncidencias(){
        return $this->modeloObj->getAllIncidencias();
    }

    public function buscarIncidencia(){
        $json = file_get_contents('php://input');
            $datos = json_decode($json);
        return $this->modeloObj -> buscarIncidencia($datos->idIncidencia);
    }

    public function crearIncidencia(){
        $json = file_get_contents('php://input');
            $datos = json_decode($json);
            if(!$datos|| !isset($datos->mail) || !isset($datos->tipo) || !isset($datos->estado) || !isset($datos->imagen) || !isset($datos->calle) || !isset($datos->numero) || !isset($datos->barrio)){
                http_response_code(400);
                return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
            }
            $m = $datos->mail;
            $t = $datos->tipo;
            $e = $datos->estado;
            $i = $datos->imagen;
            $c = $datos->calle;
            $n = $datos->numero;
            $b = $datos->barrio;
 
        $resultado= $this->modeloObj -> crearIncidencia($m, $t, $e, $i, $c,$n,$b);

        if ($resultado) {
        return ["status" => "success", "mensaje" => "Incidencia creada correctamente"];
    } else {
        return ["status" => "error", "mensaje" => "No se pudo crear la incidencia"];
    }
    }

    public function AsignarOperario(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos || !isset($datos->idIncidencia) || !isset($datos->idOperario)){
            http_response_code(400);
            return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
        } else{
            
            $resultado = $this->modeloObj->AsignarOperario($datos->idIncidencia, $datos->idOperario);
            if ($resultado) {
                return ["status" => "success", "mensaje" => "Operario asignado correctamente"];
            } else {
                return ["status" => "error", "mensaje" => "No se pudo asignar el operario"];
            }
        }
        
    }

    public function eliminarIncidencia(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        if(!$datos || !isset($datos->idIncidencia)){
            http_response_code(400);
            return ['status' => 'error', 'mensaje' => 'Faltan campos obligatorios'];
        } else{
            $resultado = $this->modeloObj->eliminarIncidencia($datos->idIncidencia);
            if ($resultado) {
                return ["status" => "success", "mensaje" => "Incidencia eliminada correctamente"];
            } else {
                return ["status" => "error", "mensaje" => "No se pudo eliminar la incidencia"];
            }
        }
    }
}
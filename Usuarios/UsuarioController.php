<?php
class UsuarioController
{
	private $modeloObj;

	public function __construct()
	{
		$conexionbd = mysqli_connect("localhost","root","","syntropy");
		if (!$conexionbd){
			die(json_encode(["status" => "error", "mensaje" => "Error de conexion ". mysqli_connect_error()]));
		}
		require "UsuarioModel.php";
		$this->modeloObj = new UsuarioModel($conexionbd);
	}

	//Mostrar todos los usuarios
	public function getAllUsuarios()
	{
		return ["status" => "ok", "usuarios" => $this->modeloObj->getAllUsuarios()];
	}

	//Buscar usuario
	public function buscarMail($mail){
		return ["status" => "ok", "usuario" => $this->modeloObj -> buscarMail($mail)];
	}

	//Registrar Usuario
	//public function crearUsuario($nombre, $apellido, $mail, $a2f,$contrasenia){
		public function crearUsuario(){
			$json = file_get_contents('php://input');
		$datos = json_decode($json);
		if (!$datos || !isset($datos->mail) || !isset($datos->contrasenia) || !isset($datos->nombre) || !isset($datos->apellido)|| !isset($datos->usuario)  ) {
            return ["status" => "datos_invalidos", "mensaje" => "Faltan campos obligatorios o el JSON está mal formado."];
        }
		$usuario = $datos->usuario;
        $mail = $datos->mail;
        $nombre = $datos->nombre;
        $apellido = $datos->apellido;
        $contrasenia = $datos->contrasenia;
        $a2f = isset($datos->a2f) ? $datos->a2f : 0; 
        $rol = isset($datos->rol) ? $datos->rol : 'Vecino';
        $rolesValidos = ['Vecino', 'Operario', 'Administrador', 'Recolector'];
        if (!in_array($rol, $rolesValidos, true)) {
            return ["status" => "datos_invalidos", "mensaje" => "Rol inválido."];
        }
		$UsuarioExistente = $this->modeloObj->buscarMail($datos->mail);
		if($UsuarioExistente){
			return ["status"=>"datos_invalidos", "mensaje" => "Este mail ya esta registrado, utilice otro mail"];
		} 
		$resultado = $this->modeloObj->crearUsuario($nombre, $apellido, $contrasenia,$mail, $a2f,$rol, $usuario);
		if($resultado){
			return ["status"=>"ok","mensaje"=>"Solicitud enviada. Su cuenta se encuentra en espera de aprobacion por un administrador."];
		} else {
			return ["status"=>"error","mensaje"=>"No se pudo crear el usuario"];
		}
	}

	//Login de usuario
	public function loguearUsuario(){
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }
    $json = file_get_contents('php://input');
    $datos = json_decode($json);
    
    if (!$datos || !isset($datos->contrasenia) || (empty($datos->mail) && empty($datos->nickname))) {
        return ["status" => "datos_invalidos", "mensaje" => "Faltan datos de login."];
    }

    $usuarioEncontrado = null;

    if (!empty($datos->mail)) {
        $usuarioEncontrado = $this->modeloObj->buscarMail($datos->mail);
    }

    if ($usuarioEncontrado) {
        
        if (password_verify($datos->contrasenia, $usuarioEncontrado['contrasena'])) {
            $estadoEncontrado = null;
            $estadoEncontrado = $this->modeloObj->buscarEstado($usuarioEncontrado['mail']);
            
            if ($estadoEncontrado['estado'] === 'Pendiente') {
                $this->modeloObj->registrarAcceso($estadoEncontrado['mail'], 'Fallido - Cuenta pendiente');
                return ["status" => "cuenta_pendiente", "mensaje" => "Cuenta pendiente."];
                
            } elseif ($estadoEncontrado['estado'] === 'Rechazado') {
                $this->modeloObj->registrarAcceso($estadoEncontrado['mail'], 'Fallido - Cuenta rechazada');
                return ["status" => "no_permitido", "mensaje" => "Cuenta rechazada."];
                
            } else {
                $this->modeloObj->registrarAcceso($estadoEncontrado['mail'], 'Exitoso');
                unset($usuarioEncontrado['contrasena']);
                $_SESSION['rol'] = $usuarioEncontrado['rol'];
                $_SESSION['mail'] = $usuarioEncontrado['mail'];
                $_SESSION['nombre_completo'] = trim($usuarioEncontrado['nombre'] . ' ' . $usuarioEncontrado['apellido']);
                return ["status" => "ok","mensaje" => "Login exitoso.","rol" => $usuarioEncontrado['rol'],"usuario" => $usuarioEncontrado];
            }
            
        } else {
            return ["status" => "no_autorizado", "mensaje" => "Contraseña incorrecta"];
        }
        
    } else {
        return ["status" => "no_autorizado", "mensaje" => "Este usuario/mail no está registrado"];
    }
}
	public function eliminarUsuario(){
        $json = file_get_contents('php://input');
        $datos = json_decode($json);

    if (!$datos || !isset($datos->mail)) {
        return [
            "status" => "no_autorizado", 
            "mensaje" => "No se recibió el correo electrónico"
        ];
    }

    $resultado = $this->modeloObj->eliminarUsuario($datos->mail);
    
    if($resultado){
        return["status" => "ok", "mensaje" => "Usuario eliminado con éxito"];
    } else {
        return ["status" => "error", "mensaje" => "No se pudo eliminar el usuario en la base de datos"];
    }
}

	public function responderSolicitud() {
    $json = file_get_contents('php://input');
    $datos = json_decode($json);

    if (!isset($datos->mail) || !isset($datos->decision)) {
        return ["status" => "error", "mensaje" => "Faltan datos de decisión."];
    }

    if (!in_array($datos->decision, ['Aceptado', 'Rechazado'])) {
        return ["status" => "error", "mensaje" => "Decisión inválida."];
    }

    $resultado = $this->modeloObj->actualizarEstadoUsuario($datos->mail, $datos->decision);

    if ($resultado) {
        return ["status" => "ok", "mensaje" => "Usuario " . strtolower($datos->decision) . " con éxito."];
    }
    return ["status" => "error", "mensaje" => "No se pudo procesar la solicitud."];
}
public function getAllPendientes(){
    $json = file_get_contents('php://input');
    $datos = json_decode($json);

    return ["status" => "ok", "usuarios" => $this->modeloObj->getAllPendientes()];
}
public function modificarUsuario() {
    $datos = json_decode(file_get_contents('php://input'));

    if (
        !$datos ||
        empty($datos->mail) ||
        empty($datos->nombre) ||
        empty($datos->apellido) ||
        empty($datos->nickname) ||
        empty($datos->rol)
    ) {
        return ["status" => "datos_invalidos", "mensaje" => "Faltan datos obligatorios."];
    }

    $rolesValidos = ['Vecino', 'Operario', 'Administrador', 'Recolector'];
    if (!in_array($datos->rol, $rolesValidos, true)) {
        return ["status" => "datos_invalidos", "mensaje" => "Rol inválido."];
    }

    if ($resultado = $this->modeloObj->modificarUsuario(
        $datos->mail,
        $datos->nombre,
        $datos->apellido,
        $datos->nickname,
        $datos->rol
    )) {
    return [
        "status" => "ok",
        "mensaje" => "Usuario actualizado."
    ];
} else {
    return [
        "status" => "error",
        "mensaje" => "No se pudo actualizar el usuario."
    ];
}
}
}
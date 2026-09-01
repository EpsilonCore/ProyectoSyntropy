<?php
error_reporting(0); 
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PATCH, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
require_once 'UsuarioController.php';
$controladorObj = new UsuarioController();

$method =           $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'],    PHP_URL_PATH);
$resultado = "";

switch ($method) {
	case 'GET':
		$mail = '';
		//Mostrar todos los usuarios
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Usuarios'){
					
			$resultado = $controladorObj->getAllUsuarios();
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/ListarPendientes'){
			$resultado = $controladorObj->getAllPendientes();
		}

		//Buscar usuario
		if(strpos($uri, '/miApi/Usuario/') === 0){
			$mail = trim(str_replace('/miApi/Usuario/', '', $uri));
		}
		if(!empty($mail)){
			$resultado = $controladorObj -> buscarMail($mail);
			}
        
break;
		case 'POST':
		
		//Registrar un usuario
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Registrar'){

			$resultado = $controladorObj->crearUsuario();
		//Loguear usuario
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Login'){
			$resultado = $controladorObj->LoguearUsuario();
			}
break;
		case 'DELETE':

		//Eliminar usuario
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Borrar'){
			$resultado = $controladorObj->eliminarUsuario();
			}
		break;
		case 'PATCH':
		if($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Actualizar'){
			$resultado = $controladorObj->responderSolicitud();
			}
			if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Modificar') {
    		$resultado = $controladorObj->modificarUsuario();
}
		break;
    default:
        http_response_code(405);
       $resultado = ["error" => "Método no permitido"];
        break;

	
 

}

$codigoshttp = [
    "ok"                 => 200,
    "creado"             => 201,
    "datos_invalidos"    => 400,
    "no_autorizado"      => 401,
    "cuenta_pendiente"   => 403,
    "no_encontrado"      => 404,
    "error"              => 500,
];

http_response_code($codigoshttp[$resultado["status"]] ?? 500);
echo json_encode($resultado);

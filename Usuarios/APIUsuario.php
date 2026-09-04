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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function verificarRol(array $rolesPermitidos)
{
    $rolActual = $_SESSION['rol'] ?? 'Vecino';
    if (!in_array($rolActual, $rolesPermitidos, true)) {
        return ["status" => "prohibido", "mensaje" => "No tenés permiso para realizar esta acción.", "data" => null];
    }
    return null;
}

require_once 'UsuarioController.php';
$controladorObj = new UsuarioController();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$resultado = ["status" => "no_encontrado", "mensaje" => "Ruta no encontrada.", "data" => null];

switch ($method) {
    case 'GET':
        $mail = '';

        // Todo lo de GET requiere Administrador: listar usuarios, pendientes o buscar por mail.
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Usuarios') {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->getAllUsuarios();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/ListarPendientes') {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->getAllPendientes();
        }
        if (strpos($uri, '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Usuario/') === 0) {
            $mail = trim(str_replace('/Proyecto/ProyectoSyntropy/Usuarios/miApi/Usuario/', '', $uri));
        }
        if (!empty($mail)) {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->buscarMail($mail);
        }
        break;

    case 'POST':
        // loguearse o crear una cuenta nueva.
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Registrar') {
            $resultado = $controladorObj->crearUsuario();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Login') {
            $resultado = $controladorObj->LoguearUsuario();
        }
        break;

    case 'DELETE':
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Borrar') {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->eliminarUsuario();
        }
        break;

    case 'PATCH':
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Actualizar') {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->responderSolicitud();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Usuarios/miApi/Modificar') {
            $resultado = verificarRol(['Administrador']) ?? $controladorObj->modificarUsuario();
        }
        break;

    default:
        $resultado = ["status" => "no_permitido", "mensaje" => "Método no permitido.", "data" => null];
        break;
}

$codigosHttp = [
    "ok"               => 200,
    "creado"           => 201,
    "datos_invalidos"  => 400,
    "no_autorizado"    => 401,
    "cuenta_pendiente" => 403,
    "prohibido"        => 403,
    "no_encontrado"    => 404,
    "no_permitido"     => 405,
    "error"            => 500,
];

http_response_code($codigosHttp[$resultado["status"]] ?? 500);
echo json_encode($resultado);

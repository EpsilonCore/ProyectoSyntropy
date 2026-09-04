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

require_once 'CamionController.php';
require_once 'RutaController.php';
$controladorCamion = new CamionController();
$controladorRuta = new RutaController();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$resultado = ["status" => "no_encontrado", "mensaje" => "Ruta no encontrada.", "data" => null];

$rolesCamiones = ['Administrador'];
                
$rolesRutas = ['Administrador', 'Operario'];

switch ($method) {
    case 'GET':
        $matricula = '';

        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/Camiones') {
            $resultado = verificarRol($rolesRutas) ?? $controladorCamion->getAllMatriculas();
        }
        if (strpos($uri, '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/Camion/') === 0) {
            $matricula = trim(str_replace('/Proyecto/ProyectoSyntropy/Recoleccion/miApi/Camion/', '', $uri));
        }
        if (!empty($matricula)) {
            $resultado = verificarRol($rolesCamiones) ?? $controladorCamion->buscarMatricula($matricula);
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/Rutas') {
            $resultado = verificarRol($rolesRutas) ?? $controladorRuta->getAllRutas();
        }
        break;

    case 'POST':
        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/RegistrarCamion') {
            $resultado = verificarRol($rolesCamiones) ?? $controladorCamion->crearCamion();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/Rutas/Registrar') {
            $resultado = verificarRol($rolesRutas) ?? $controladorRuta->crearRuta();
        }
        break;

    case 'PATCH':
        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/ActualizarCamion') {
            $resultado = verificarRol($rolesCamiones) ?? $controladorCamion->actualizarCamion();
        }
        break;

    case 'DELETE':
        if ($uri === '/Proyecto/ProyectoSyntropy/Recoleccion/miApi/EliminarCamion') {
            $resultado = verificarRol($rolesCamiones) ?? $controladorCamion->eliminarCamion();
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
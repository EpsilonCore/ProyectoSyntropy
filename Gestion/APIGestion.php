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

require_once 'ContenedoresController.php';
require_once 'CentrosAcopioController.php';
require_once 'IncidenciaController.php';

$controladorContenedor   = new ContenedoresController();
$controladorCentroAcopio = new CentrosAcopioController();
$controladorIncidencia   = new IncidenciaController();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$resultado = ["status" => "no_encontrado", "mensaje" => "Ruta no encontrada.", "data" => null];

switch ($method) {
    case 'GET':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Contenedores') {
            $resultado = $controladorContenedor->getAllContenedores();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/CentrosAcopio') {
            $resultado = $controladorCentroAcopio->getAllCentrosAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Incidencias') {
            $resultado = $controladorIncidencia->getAllIncidencias();
        }
        break;

    case 'POST':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/RegistrarContenedor') {
            $resultado = $controladorContenedor->crearContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Registrar') {
            $resultado = $controladorCentroAcopio->crearCentroAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Registrar') {
            $resultado = $controladorIncidencia->crearIncidencia();
        }
        break;

    case 'DELETE':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/EliminarContenedor') {
            $resultado = $controladorContenedor->eliminarContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Borrar') {
            $resultado = $controladorCentroAcopio->eliminarCentroAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Borrar') {
            $resultado = $controladorIncidencia->eliminarIncidencia();
        }
        break;

    case 'PATCH':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/ActualizarContenedor') {
            $resultado = $controladorContenedor->actualizarContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Modificar') {
            $resultado = $controladorCentroAcopio->actualizarCentroAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/AsignarOperario') {
            $resultado = $controladorIncidencia->AsignarOperario();
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
    "no_encontrado"    => 404,
    "no_permitido"     => 405,
    "error"            => 500,
];

http_response_code($codigosHttp[$resultado["status"]] ?? 500);
echo json_encode($resultado);

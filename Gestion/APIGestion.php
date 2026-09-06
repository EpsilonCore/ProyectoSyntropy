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

require_once 'ContenedoresController.php';
require_once 'CentrosAcopioController.php';
require_once 'IncidenciaController.php';
require_once 'CuadrillaController.php';

$controladorContenedor   = new ContenedoresController();
$controladorCentroAcopio = new CentrosAcopioController();
$controladorIncidencia   = new IncidenciaController();
$controladorCuadrilla    = new CuadrillaController();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$resultado = ["status" => "no_encontrado", "mensaje" => "Ruta no encontrada.", "data" => null];

$soloAdministrador = ['Administrador'];
$administradorUOperario = ['Administrador', 'Operario'];

switch ($method) {
    case 'GET':
        // Abierto a cualquier logueado: lo usa mapa.html para pintar el mapa, además del panel.
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Contenedores') {
            $resultado = $controladorContenedor->getAllContenedores();
        }
        // Panel de Centros de Acopio: exclusivo de Administrador.
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/CentrosAcopio') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCentroAcopio->getAllCentrosAcopio();
        }
        // Abierto a cualquier logueado: lo usa mapa.html, además del panel de Incidencias.
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Incidencias') {
            $resultado = $controladorIncidencia->getAllIncidencias();
        }
        // Panel de Cuadrillas: exclusivo de Administrador.
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Cuadrillas/Cuadrillas') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCuadrilla->getAllCuadrillas();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Cuadrillas/Recolectores') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCuadrilla->getRecolectoresDisponibles();
        }
        break;

    case 'POST':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/RegistrarContenedor') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorContenedor->crearContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Registrar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCentroAcopio->crearCentroAcopio();
        }
        // Abierto a cualquier logueado: cualquier vecino puede reportar una incidencia desde index.html.
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Registrar') {
            $resultado = $controladorIncidencia->crearIncidencia();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Cuadrillas/Registrar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCuadrilla->crearCuadrilla();
        }
        break;

    case 'DELETE':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/EliminarContenedor') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorContenedor->eliminarContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Borrar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCentroAcopio->eliminarCentroAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Borrar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorIncidencia->eliminarIncidencia();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Cuadrillas/Borrar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCuadrilla->eliminarCuadrilla();
        }
        break;

    case 'PATCH':
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/ActualizarContenedor') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorContenedor->actualizarContenedor();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Modificar') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorCentroAcopio->actualizarCentroAcopio();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/AsignarOperario') {
            $resultado = verificarRol($administradorUOperario) ?? $controladorIncidencia->AsignarOperario();
        }
        if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/AsignarCuadrilla') {
            $resultado = verificarRol($soloAdministrador) ?? $controladorIncidencia->AsignarCuadrilla();
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

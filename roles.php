<?php


function iniciarSesionSiHaceFalta()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


function rolActual()
{
    iniciarSesionSiHaceFalta();
    return $_SESSION['rol'] ?? 'Vecino';
}

function verificarRol(array $rolesPermitidos)
{
    if (!in_array(rolActual(), $rolesPermitidos, true)) {
        return ["status" => "prohibido", "mensaje" => "No tenés permiso para realizar esta acción.", "data" => null];
    }
    return null;
}

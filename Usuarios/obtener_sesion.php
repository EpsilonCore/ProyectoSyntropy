<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['usuario'])) {
    echo json_encode(["rol"=> $_SESSION['rol']]);
}else {
    echo json_encode(["rol"=>"Vecino"]);
}

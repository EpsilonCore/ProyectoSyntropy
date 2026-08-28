<?php
header('Content-Type: application/json');
require_once 'ContenedoresController.php';
require_once 'CentrosAcopioController.php';
require_once 'IncidenciaController.php';
$controladorContenedor= new ContenedoresController();
$controladorCentroAcopio= new CentrosAcopioController();
$controladorIncidencia= new IncidenciaController();

$method =           $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'],    PHP_URL_PATH);

switch ($method) {
	case 'GET';

		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Contenedores'){
					
			echo json_encode( $controladorContenedor->getAllContenedores() );
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/CentrosAcopio'){
			echo json_encode($controladorCentroAcopio->getAllCentrosAcopio());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Incidencias'){
			echo json_encode($controladorIncidencia->getAllIncidencias());
		}
	
        
break;
    case 'POST';
    if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/RegistrarContenedor'){
			echo json_encode($controladorContenedor->crearContenedor());
			
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Registrar'){
			echo json_encode($controladorCentroAcopio->crearCentroAcopio());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Registrar'){
			echo json_encode($controladorIncidencia->crearIncidencia());
		}
break; 
		case 'DELETE':
		if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/EliminarContenedor') {
			echo json_encode($controladorContenedor->eliminarContenedor());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Borrar'){
			echo json_encode($controladorCentroAcopio->eliminarCentroAcopio());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/Borrar'){
			echo json_encode($controladorIncidencia->eliminarIncidencia());
		}
		break;
		case 'PATCH';
		if ($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/ActualizarContenedor') {
			echo json_encode($controladorContenedor->actualizarContenedor());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/CentrosAcopio/Modificar'){
			echo json_encode($controladorCentroAcopio->actualizarCentroAcopio());
		}
		if($uri === '/Proyecto/ProyectoSyntropy/Gestion/miApi/Incidencias/AsignarOperario'){
			echo json_encode($controladorIncidencia->AsignarOperario());
		}
		break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
	//case 'POST':
	
	//default:
		// Maneja métodos no permitidos

}
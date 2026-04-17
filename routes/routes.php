<?php
    require_once __DIR__ . "/../controllers/citas.controller.php";
    require_once __DIR__ . "/../controllers/pacientes.controller.php";
    require_once __DIR__ . "/../controllers/usuarios.controller.php";

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    if (in_array('citas', $uri, true)) {
        $idTipoRuta = array_search('citas', $uri);
    } else if (in_array('pacientes', $uri, true)) {
        $idTipoRuta = array_search('pacientes', $uri);
    } else if (in_array('usuarios', $uri, true)) {
        $idTipoRuta = array_search('usuarios', $uri);
    } else {
        http_response_code(400);
        echo json_encode(['message' => "Ruta no valida"]);
        exit;
    }

    if ($idTipoRuta === false) {
        http_response_code(400);
        echo json_encode(['message' => "Ruta no encontrada"]);
        exit;
    }

    $tipoRuta = $uri[$idTipoRuta];
    $id = $uri[$idTipoRuta + 1] ?? null;

    if ($tipoRuta === 'citas') {
        $controller = new CitasController();

        switch ($method) {
            case 'GET':
                if ($id) {
                    $controller->getOneCitaController($id);
                } else {
                    $controller->getAllCitasController();
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input", true));
                $controller->insertCitaController(
                    $data['PacienteId'],
                    $data['Fecha'],
                    $data['HoraInicio'],
                    $data['HoraFin'],
                    $data['Estado'],
                    $data['Motivo']
                );
                break;
            case 'PUT':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                } else {
                    $data = json_decode(file_get_contents("php://input"), true);
                    $controller->updateCitaController(
                        $id,
                        $data['PacienteId'],
                        $data['Fecha'],
                        $data['HoraInicio'],
                        $data['HoraFin'],
                        $data['Estado'],
                        $data['Motivo']
                    );
                    break;
                }
            case 'DELETE':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                } else {
                    $controller->deleteCitaController($id);
                    break;
                }
            default:
                http_response_code(400);
                echo json_encode(['message' => "Metodo no valido"]);
                break;
        }
    } else if ($tipoRuta === 'pacientes') {
        $controller = new PacientesController();
        switch ($method) {
            case 'GET':
                if ($id) {
                    $controller->getOnePacienteController($id);
                } else {
                    $controller->getAllPacientesController();
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->insertPacienteController(
                    $data['DNI'],
                    $data['Nombre'],
                    $data['Direccion'],
                    $data['CodigoPostal'],
                    $data['Telefono'],
                    $data['Genero'],
                    $data['FechaNacimiento'],
                    $data['Correo']
                );
                break;
            case 'PUT':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                }
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->updatePacienteController(
                    $id,
                    $data['DNI'],
                    $data['Nombre'],
                    $data['Direccion'],
                    $data['CodigoPostal'],
                    $data['Telefono'],
                    $data['Genero'],
                    $data['FechaNacimiento'],
                    $data['Correo']
                );
                break;
            case 'DELETE':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                }
                $controller->deletePacienteController($id);
                break;
            default:
                http_response_code(400);
                echo json_encode(['message' => "Metodo no permitido"]);
                break;
        }
    } else if ($tipoRuta === 'usuarios') {
        $controller = new UsuariosController();
        switch ($method) {
            case 'GET':
                if ($id) {
                    $controller->getOneUsuarioController($id);
                } else {
                    $controller->getAllUsuariosController();
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->insertUsuarioController(
                    $data['Usuario'],
                    $data['Password'],
                    $data['Estado']
                );
                break;
            case 'PUT':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                }
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->updateUsuarioController(
                    $id,
                    $data['Usuario'],
                    $data['Password'],
                    $data['Estado']
                );
                break;
            case 'DELETE':
                if (!$id) {
                    http_response_code(400);
                    echo json_encode(['message' => "ID requerido"]);
                    exit;
                }
                $controller->deleteUsuarioController($id);
                break;
            default:
                http_response_code(400);
                echo json_encode(['message' => "Metodo no permitido"]);
                break;
        }
    }
?>
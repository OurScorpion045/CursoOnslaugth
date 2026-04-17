<?php
    require_once __DIR__ . "/../models/usuarios.model.php";

    class UsuariosController {
        private $model;

        function __construct() {
            $this->model = new UsuariosModel();
        }

        function getAllUsuariosController() {
            $result = $this->model->getAllUsuarios();
            http_response_code(200);
            echo json_encode($result);
        }

        function getOneUsuarioController($id) {
            $result = $this->model->getOneUsuario($id);
            http_response_code(200);
            echo json_encode($result);
        }

        function insertUsuarioController($usuario, $password, $estado) {
            if (empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            } else {
                $result = $this->model->insertUsuario($usuario, $password, $estado);
                http_response_code(200);
                echo json_encode($result);
            }
        }

        function updateUsuarioController($id, $usuario, $password, $estado) {
            if (empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            } else {
                $result = $this->model->updateUsuario($id, $usuario, $password, $estado);
                http_response_code(200);
                echo json_encode($result);
            }
        }

        function deleteUsuarioController($id) {
            $result = $this->model->deleteUsuario($id);
            http_response_code(200);
            echo json_encode($result);
        }
    }
?>
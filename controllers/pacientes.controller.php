<?php
    require_once __DIR__ . "/../models/pacientes.model.php";

    class PacientesController {
        private $model;

        function __construct() {
            $this->model = new PacientesModel();
        }

        function getAllPacientesController() {
            $result = $this->model->getAllPacientes();
            http_response_code(200);
            echo json_encode($result);
        }

        function getOnePacienteController($id) {
            $result = $this->model->getOnePaciente($id);
            http_response_code(200);
            echo json_encode($result);
        }

        function insertPacienteController($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            if (empty($dni) || empty($nombre) || empty($direccion) || empty($codigoPostal) || empty($telefono) || empty($genero) || empty($fechaNacimiento) || empty($correo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            } else {
                $result = $this->model->insertPaciente($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo);
                http_response_code(200);
                echo json_encode($result);
            }
        }

        function updatePacienteController($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            if (empty($dni) || empty($nombre) || empty($direccion) || empty($codigoPostal) || empty($telefono) || empty($genero) || empty($fechaNacimiento) || empty($correo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            } else {
                $result = $this->model->updatePaciente($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo);
                http_response_code(200);
                echo json_encode($result);
            }
        }

        function deletePacienteController($id) {
            $result = $this->model->deletePaciente($id);
            http_response_code(200);
            echo json_encode($result);
        }
    }
?>
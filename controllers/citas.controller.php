<?php
    require_once __DIR__ . "/../models/citas.model.php";

    class CitasController {
        private $model;

        function __construct() {
            $this->model = new CitasModel();
        }

        function getAllCitasController() {
            $result = $this->model->getAllCitas();
            http_response_code(200);
            echo json_encode($result);
        }

        function getOneCitaController($id) {
            $result = $this->model->getOneCita($id);
            http_response_code(200);
            echo json_encode($result);
        }

        function insertCitaController($pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            if (empty($pacienteId) || empty($fecha) || empty($horaInicio) || empty($horaFin) || empty($estado) || empty($motivo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
                return;
            }
            $result = $this->model->insertCita($pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo);
            http_response_code(200);
            echo json_encode($result);
        }

        function updateCitaController($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            $result = $this->model->updateCita($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo);
            http_response_code(200);
            echo json_encode($result);
        }

        function deleteCitaController($id) {
            $result = $this->model->deleteCita($id);
            http_response_code(200);
            echo json_encode($result);
        }
    }
?>
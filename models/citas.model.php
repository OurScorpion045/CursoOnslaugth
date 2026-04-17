<?php
    require_once __DIR__ . "/../config/database.php";

    class CitasModel {
        private $database;
        private $connection;

        function __construct() {
            $this->database = new DataBase();
            $this->connection = $this->database->getConnection();
        }

        function getAllCitas() {
            $sql = "SELECT * FROM citas ORDER BY CitaId DESC";
            $stmt = $this->connection->prepare($sql);
            return ($stmt->execute()) ? $stmt->fetchAll() : "Error al listar citas";
        }

        function getOneCita($id) {
            $sql = "SELECT * FROM citas WHERE CitaId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? $stmt->fetch() : "Error al seleccionar cita";
        }

        function insertCita($pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            $sql = "INSERT INTO citas (PacienteId, Fecha, HoraInicio, HoraFin, Estado, Motivo) VALUES (:PacienteId, :Fecha, :HoraInicio, :HoraFin, :Estado, :Motivo)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":PacienteId", $pacienteId);
            $stmt->bindParam(":Fecha", $fecha);
            $stmt->bindParam(":HoraInicio", $horaInicio);
            $stmt->bindParam(":HoraFin", $horaFin);
            $stmt->bindParam(":Estado", $estado);
            $stmt->bindParam(":Motivo", $motivo);
            return ($stmt->execute()) ? "Cita insertada correctamente" : "Error al insertar cita";
        }

        function updateCita($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            $sql = "UPDATE citas SET PacienteId = :PacienteId, Fecha = :Fecha, HoraInicio = :HoraInicio, HoraFin = :HoraFin, Estado = :Estado, Motivo = :Motivo WHERE CitaId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":PacienteId", $pacienteId);
            $stmt->bindParam(":Fecha", $fecha);
            $stmt->bindParam(":HoraInicio", $horaInicio);
            $stmt->bindParam(":HoraFin", $horaFin);
            $stmt->bindParam(":Estado", $estado);
            $stmt->bindParam(":Motivo", $motivo);
            return ($stmt->execute()) ? "Informacion de cita actualizada correctamente" : "Error al actualizar informacion de cita";
        }

        function deleteCita($id) {
            $sql = "DELETE FROM citas WHERE CitaId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? "Cita eliminada correctamente" : "Error al eliminar cita";
        }
    }
?>
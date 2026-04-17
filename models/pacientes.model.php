<?php
    require_once __DIR__ . "/../config/database.php";

    class PacientesModel {
        private $database;
        private $connection;

        function __construct() {
            $this->database = new DataBase();
            $this->connection = $this->database->getConnection();
        }

        function getAllPacientes() {
            $sql = "SELECT * FROM pacientes ORDER BY PacienteId DESC";
            $stmt = $this->connection->prepare($sql);
            return ($stmt->execute()) ? $stmt->fetchAll() : "Error al listar pacientes";
        }

        function getOnePaciente($id) {
            $sql = "SELECT * FROM pacientes WHERE PacienteId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? $stmt->fetch() : "Error al seleccionar paciente";
        }

        function insertPaciente($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            $sql = "INSERT INTO pacientes(DNI, Nombre, Direccion, CodigoPostal, Telefono, Genero, FechaNacimiento, Correo) VALUES (:DNI, :Nombre, :Direccion, :CodigoPostal, :Telefono, :Genero, :FechaNacimiento, :Correo)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":DNI", $dni);
            $stmt->bindParam(":Nombre", $nombre);
            $stmt->bindParam(":Direccion", $direccion);
            $stmt->bindParam(":CodigoPostal", $codigoPostal);
            $stmt->bindParam(":Telefono", $telefono);
            $stmt->bindParam(":Genero", $genero);
            $stmt->bindParam(":FechaNacimiento", $fechaNacimiento);
            $stmt->bindParam(":Correo", $correo);
            return ($stmt->execute()) ? "Paciente insertado correctamente" : "Error al insertar paciente";
        }

        function updatePaciente($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            $sql = "UPDATE pacientes SET DNI = :DNI, Nombre = :Nombre, Direccion = :Direccion, CodigoPostal = :CodigoPostal, Telefono = :Telefono, Genero = :Genero, FechaNacimiento = :FechaNacimiento, Correo = :Correo WHERE PacienteId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":DNI", $dni);
            $stmt->bindParam(":Nombre", $nombre);
            $stmt->bindParam(":Direccion", $direccion);
            $stmt->bindParam(":CodigoPostal", $codigoPostal);
            $stmt->bindParam(":Telefono", $telefono);
            $stmt->bindParam(":Genero", $genero);
            $stmt->bindParam(":FechaNacimiento", $fechaNacimiento);
            $stmt->bindParam(":Correo", $correo);
            return ($stmt->execute()) ? "Paciente actualizado correctamente" : "Error al actualizar paciente";
        }

        function deletePaciente($id) {
            $sql = "DELETE FROM pacientes WHERE PacienteId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? "Paciente eliminado correctamente" : "Error al eliminar paciente";
        }
    }
?>
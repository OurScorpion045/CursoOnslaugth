<?php
    require_once __DIR__ . "/../config/database.php";

    class UsuariosModel {
        private $database;
        private $connection;

        function __construct() {
            $this->database = new DataBase();
            $this->connection = $this->database->getConnection();
        }

        function getAllUsuarios() {
            $sql = "SELECT * FROM usuarios ORDER BY UsuarioId DESC";
            $stmt = $this->connection->prepare($sql);
            return ($stmt->execute()) ? $stmt->fetchAll() : "Error al listar usuarios";
        }

        function getOneUsuario($id) {
            $sql = "SELECT * FROM usuarios WHERE UsuarioId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? $stmt->fetch() : "Error al seleccionar usuario";
        }

        function insertUsuario($usuario, $password, $estado) {
            $sql = "INSERT INTO usuarios (Usuario, Password, Estado) VALUES (:Usuario, :Password, :Estado)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":Usuario", $usuario);
            $stmt->bindParam(":Password", $password);
            $stmt->bindParam(":Estado", $estado);
            return ($stmt->execute()) ? "Usuario insertado correctamente" : "Error al insertar usuario";
        }

        function updateUsuario($id, $usuario, $password, $estado) {
            $sql = "UPDATE usuarios SET Usuario = :Usuario, Password = :Password, Estado = :Estado WHERE UsuarioId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":Usuario", $usuario);
            $stmt->bindParam(":Password", $password);
            $stmt->bindParam(":Estado", $estado);
            return ($stmt->execute()) ? "Usuario actualizado correctamente" : "Error al actualizar usuario";
        }

        function deleteUsuario($id) {
            $sql = "DELETE FROM usuarios WHERE UsuarioId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id);
            return ($stmt->execute()) ? "Usuario eliminado correctamente" : "Error al eliminar usuario";
        }
    }
?>
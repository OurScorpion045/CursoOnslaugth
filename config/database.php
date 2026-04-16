<?php

    class DataBase {
        private $host = "localhost";
        private $dbname = "apirest";
        private $user = "root";
        private $password = "";
        private $connection;

        function __construct() {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
                $this->connection = new PDO($dsn, $this->user, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Error de conexion: " . $e->getMessage());
            }
        }

        function getConnection() {
            return $this->connection;
        }
    }

?>
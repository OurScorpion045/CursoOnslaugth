<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    require_once __DIR__ . "/routes/routes.php";
?>
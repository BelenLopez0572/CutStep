<?php
<<<<<<< HEAD
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '12345678';
$DB_NAME = 'usuarios';
$DB_PORT = 3306;

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

if ($mysqli->connect_errno) {
    http_response_code(500);
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
=======

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '12345678';       
$DB_NAME = 'login_cut';
$DB_PORT = '3306';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_errno) {
    http_response_code(500);
    die("Error conexión DB: " . $mysqli->connect_error);
}

// usar utf8
$mysqli->set_charset("utf8mb4");
>>>>>>> 87436fbef9cf013795a14a149f771ab25f61f80a

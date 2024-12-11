<?php
$host = "db";
$user = "appuser";
$password = "appuserpassword";
$database = "appdb";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

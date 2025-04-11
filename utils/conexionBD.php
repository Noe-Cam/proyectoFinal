<?php
$servername="localhost";
$username="programador";
$password='carpool';
$dbname='carpool';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar conexión
if ($conn->connect_error) {
    die("Fallo en la conexión: " . $conn->connect_error);
}